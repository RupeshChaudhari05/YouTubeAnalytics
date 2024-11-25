<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Admin extends CI_Controller
{

     public function __construct() {
        parent::__construct();
      if(!$this->session->has_userdata('EmployeeID')){
            redirect('login'); 
      }
      $this->load->model('Admin_model');

    }

    public function index()
    {
        //echo"this is test";die;
         
        //if ($this->Admin_model->verifyUser()) {
        //$this->load->view('admin/header');
        $this->load->view('admin/dashbord');
        //  $this->load->view('admin/footer');
        //  }
        
    }
    public function profile()
    {

        $this
            ->load
            ->view('admin/profile');

    }

    public function dashboard()
    {
        $this
            ->load
            ->view('admin/dashbord');
    }
    public function setting()
    {
        $this
            ->load
            ->view('admin/setting');

    }


    
function get_name_admin($table,$column,$value,$column_value)
{
        $ci=& get_instance();
//AND `status`='Active'
        $sql="SELECT * from `$table` where `$column`='$value'";

    $sql1=$ci->db->query($sql);

    $data2=$sql1->row();

    return  $data2->$column_value;

}

    public function companyList(){
        $data['companyDetail']= $this->Admin_model->getComapnyDetail($this->session->userdata()['COM_ID']);
        $data['list']=$this->Admin_model->getAllCompanyList();
         $this->load->view('include/header');
           $this->load->view('admin/companyList',$data);
           $this->load->view('include/footer');
    }

   public function start(){
        $data['mastercolumnlist']= $this->getmastertablecolumn();
        $data['mappedData']= $this->mappingTableData($this->session->userdata()['COM_ID']);
        $data['list']=$this->Admin_model->getAllCompanyList();
        $data['isTableCreate'] =$this->Admin_model->isTableCreated($this->session->userdata()['COM_ID']);
        //print_r($dd);die;
        //print_r($data);die;
        $this->load->view('include/header');
        $this->load->view('admin/client_integration/client_integration_add_1',$data);
        $this->load->view('include/footer');
    }

    public function midProcess(){
        $data['mastercolumnlist']= $this->getmastertablecolumn();
        $data['mappedData']= $this->mappingTableData($this->session->userdata()['COM_ID']);
        //print_r($data);die;
        $this->load->view('include/header');
      
        $this->load->view('admin/client_integration/client_integration_dash',$data);
        $this->load->view('include/footer');
    }

    public function set_session_data() {
        // Load session library if not autoloaded
        $selectedValue = $this->input->post('selectedValue');
        //print_r($selectedValue);die;
        // Set session variables
        if($selectedValue!="" || $selectedValue!=null){
        $array = array(
                        'id' => '',
                        'email' => '',
                        'COM_ID' => $selectedValue
                    );
        $this->session->set_userdata($array);
        // Echo response message
        //print_r($this->session->userdata());die;
        echo "Session set successfully!";
        }else{
            echo "Select value first!";
        }
    }

    public function getmastertablecolumn(){
        $query = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'master'");
        
        // Initialize an array to store column names
        $columnNames = array();

        // Check if the query was successful
        if ($query) {
            // Fetch the result as an array
            $result = $query->result_array();
            
            // Loop through the result to extract column names
            foreach ($result as $row) {
                $columnNames[] = $row['COLUMN_NAME'];
            }
        }

        // Return the array of column names
        return $columnNames;
 
    }


   public function uploadSampleFile(){
     echo "<pre>";
    $company_name = $this->Admin_model->getClientTableName($this->session->userdata()['COM_ID']);
    $company_name_process = $this->Admin_model->cleanString($company_name);

    // Define upload path
    $uploadPath = './uploads/CompanyData/' . $company_name_process . '/excelFile/';

    // Create directory if it doesn't exist
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $config['file_name'] = $this->Admin_model->cleanString($_FILES['sample_file']['name']);
    $config['upload_path']   = $uploadPath;
    $config['allowed_types'] = 'csv|CSV|xlsx|XLSX|xls|XLS';
    $config['max_size']      = 10240;

    $this->load->library('upload', $config); // Load the upload library

    if (!$this->upload->do_upload('sample_file')) {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
    } else {
        $data = array('upload_data' => $this->upload->data());
        $dataArray = $this->processExcelData($data['upload_data']['full_path']);

        //print_r($dataArray);die;
        $this->saveToDatabase($dataArray);
    }

    redirect(base_url('admin/start'));
}

public function setDateType(){
 extract($_REQUEST);
 if($value){
    $f= $this->session->userdata()['COM_ID'];
    $this->db->where('id', $value);
    $this->db->where('clientid', $f);
    $this->db->update('mapping_table', array('useforDateFilter' => "YES"));
    // echo   $this->db->last_query();die;
 }  
 redirect(base_url('admin/start'));  
}

    public function updateCompany() {
    // Extract request parameters
    extract($_REQUEST);

    // Clean company name
    $company_name_process = $this->Admin_model->cleanString($company_name);

    // Define upload path
    $uploadPath = './uploads/CompanyData/' . $company_name_process . '/logo/';

    // Create directory if it doesn't exist
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // Check if image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024; // 1MB max size
        $config['file_name'] = $this->Admin_model->cleanString($_FILES['image']['name']);

        // Load upload library
        $this->load->library('upload', $config);

        // Perform upload
        if (!$this->upload->do_upload('image')) {
            // If upload fails, handle the error
            $error = array(
                'error' => $this->upload->display_errors()
            );
            redirect(base_url('admin/start')); // Redirect to start page on error
        } else {
            // If upload succeeds, process the uploaded image
            $uploadedImage = $this->upload->data();
            $filename = base_url() . $uploadPath . $uploadedImage['file_name']; // Get the URL of the uploaded image
        }
    } else {
        // If no image is uploaded, set filename to null or handle accordingly
        $filename = null;
    }

    // Prepare data for insertion into the database
    $data = array(
        'CompanyName' => $company_name,
        'FirstName' => $name,
        'Email' => $email,
        'date_of_rag' => $r_date,
        'logo' => $filename,
        'Clean_company_name' => $company_name_process,
        'ID' => rand(100000, 999999) // Generate unique ID
    );

    // Perform the insert query
    $this->db->insert('client_list', $data);
    redirect(base_url('admin/start'));
}


    public function updateColumn(){
        //print_r($_REQUEST);die;
        extract($_REQUEST);
        $this->db->where('Process_column', strtoupper(str_replace(' ', '_', $excel_names)));
        $query = $this->db->get('mapping_table');
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
             $data = array(
            'mastertable'  =>  $master_column,
            // 'excel_column' => strtoupper(str_replace(' ', '_', $excel_names)),
            'sts' => 'active' // Assuming 'sts' should remain active after update
        );
        $this->db->where('clientid', $this->session->userdata()['COM_ID']);
        $this->db->where('Process_column', strtoupper(str_replace(' ', '_', $excel_names)));
        $this->db->update('mapping_table', $data);
       // echo $this->db->last_query();die;
          //  echo "Error: Master column data already exists.";
        } else {
        $data = array(
                'clientid' => $this->session->userdata()['COM_ID'],
                'mastertable' => $master_column,
                'Process_column' => strtoupper(str_replace(' ', '_', $excel_names)),
                'sts' => 'active'
                );
            //print_r($data);die;
            $this->db->insert('mapping_table', $data);
            }
         redirect(base_url('admin/start'));
    }

    public function deleteMppingData(){
        extract($_REQUEST);
         $id = $this->input->post('id'); 
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->delete("mapping_table");
            return true;
        }
    }

    public function mappingTableData($company_id){
               
                $this->db->where('clientid', $company_id);
                $query = $this->db->get('mapping_table');

                if ($query->num_rows() > 0) {
                    $result = $query->result_array();
                    return $result;
                    //print_r($result);
                } else {
                    // No records found for the specified company
                   // echo "No records found for the company with ID $company_id";
                }
    }

  
   public function uploadExcel() {
        $uploadPath = './uploads/excel_files/' . date('F_Y') . '/'; // Dynamic month-wise folder

        // Check if the month-wise folder exists, create if not
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $config['upload_path']   = $uploadPath;
        //$config['upload_path']   = './uploads/excel_files/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size']      = 10240;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('excel_file')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $dataArray = $this->processExcelData($data['upload_data']['full_path']);
            echo "<pre>";
            //print_r($dataArray);die;
            $this->saveToDatabase($dataArray);
        }
    }

    private function processExcelData($filePath) {
      
                $arr_file 	= explode('.', $filePath);
                $extension 	= end($arr_file);
                if('csv' == $extension) {
                $reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                $reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreadsheet 	= $reader->load($filePath);
                $sheetData 	= $spreadsheet->getActiveSheet()->toArray();

        

        // Extract data from Excel file
        $dataArray = array();
        foreach ($sheetData as $row) {
            // Process each row as needed strtoupper(str_replace(' ', '_', $excel_names))
            $ff = strtoupper(str_replace(' ', '_', $row['0']));
            $rowData = array(
                'clientid' => $this->session->userdata()['COM_ID'],
                'excel_column'  => $row['0'],
                'client_DataType'            => $row['1'],
                'Process_column' => $ff,
                // ''=> $this->cleanNumber($row['F']),
      
            );
            $dataArray[] = $rowData;
        }

        return $dataArray;
    }

    private function saveToDatabase($dataArray) {
        array_shift($dataArray);
        // Insert data into the database
        foreach ($dataArray as $row) {
            $this->db->insert('mapping_table', $row);
        }
    }


public function createNewTable(){
    $id=$this->session->userdata()['COM_ID'];
   $cl= $this->db->query("SELECT * FROM mapping_table WHERE clientid='$id'");
    $res= $cl->result_array();

    $columns = [];
    foreach ($res as $key => $value) {
        if($value['client_DataType']=='string'){
            $columns[] = $value['Process_column'] . ' nvarchar(255)';
        }else if($value['client_DataType']=='float'){
            $columns[] = $value['Process_column'] . ' float';
        }else if($value['client_DataType']=='bigint'){
            $columns[] = $value['Process_column'] . ' bigint';
        }else if($value['client_DataType']=='datetime'){
            $columns[] = $value['Process_column'] . ' datetime';
        }else if($value['client_DataType']=='date' || $value['client_DataType']=='Date'){
            $columns[] = $value['Process_column'] . ' date';
        }else if($value['client_DataType']=='bit'){
            $columns[] = $value['Process_column'] . ' bit';
        }else if($value['client_DataType']=='int'){
            $columns[] = $value['Process_column'] . ' int';
        }else {
            $columns[] = $value['Process_column'] . ' nvarchar(255)';
        }
    }

    $companyName = $this->Admin_model->getClientTableName($this->session->userdata()['COM_ID']);

    // Print the final table name
    //print_r($tableName);
    $query = "CREATE TABLE ".$companyName." (
    ID bigint PRIMARY KEY IDENTITY(1,1),   
    RK_DATAID bigint,
    INVOICE_DOCUMENT_TYPE nvarchar(255),
    INVOICE_DOCUMENT_NUMBER nvarchar(255),
    INVOICE_NUMBER nvarchar(255),
    INVOICE_LINE_NUMBER nvarchar(255),
    INVOICE_DISTRIBUTION_LINE_NUMBER nvarchar(255),
    INVOICE_NUMBER_2 nvarchar(255),
    INVOICE_NUMBER_3 nvarchar(255),
    INVOICE_JOURNAL_NUMBER nvarchar(255),
    INVOICE_LINE_TYPE nvarchar(255),
    INVOICE_CREATION_DATE date,
    INVOICE_RECEIPT_DATE date,
    INVOICE_POSTING_DATE date,
    INVOICE_LINE_AMOUNT_NORMALIZED float,
    INVOICE_LINE_AMOUNT_CURRENCY nvarchar(255),
    INVOICE_UNIT_PRICE_CURRENCY float,
    INVOICE_LINE_DESCRIPTION nvarchar(255),
    INVOICE_DESCRIPTION_2 nvarchar(255),
    INVOICE_CREATED_BY nvarchar(255),
    INVOICE_APPROVED_BY nvarchar(255),
    INVOICE_STATUS nvarchar(255),
    INVOICE_TYPE nvarchar(255),
    SHIPPING_CODE nvarchar(255),
    SHIPPING_MODE_TYPE nvarchar(255),
    SHIPPING_TYPE nvarchar(255),
    EXCH_MONTH nvarchar(255),
    EXCH_YEAR nvarchar(255),
    EXCH_RATE float,
    RK_NORM_SPEND_USD float,
    CREATED_DATE datetime,
    AK_EXCLUDE bit,
    RK_EXCLUSION_COMMENTS nvarchar(500),
    PK_JOB_ID bigint,
    PR_JOB_NAME bigint,
    BUSINESS_DIVISION nvarchar(255),
    DEPARTMENT_CODE nvarchar(255),
    DEPARTMENT_DESCRIPTION nvarchar(255),
    BUSINESS_UNIT_CODE nvarchar(255),
    BUSINESS_UNIT_DESC nvarchar(255),
    BUSINESS_GROUP_DESC nvarchar(255),
    COMPANY_CODE nvarchar(255),
    COMPANY_NAME nvarchar(255),
    COMPANY_COUNTBY nvarchar(255),
    COMPANY_REGION nvarchar(255),
    ARNAL_COMPANY_DE_RK_NORM_COMPANY_COUNTRY nvarchar(255),
    PLANT_TYPE nvarchar(255),
    PLANT_CODE nvarchar(255),
    PLANT_NAME nvarchar(255),
    PLANT_ADDRESS nvarchar(255),
    PLANT_CITY nvarchar(255),
    PLANT_STATE nvarchar(255),
    PLANT_ZIP_CODE nvarchar(255),
    PLANT_COUNTRY nvarchar(255),
    PLANT_REGION nvarchar(255),
    F_NORMPLANT_NAME nvarchar(255),
    SUPPLIER_NUMBER nvarchar(255),
    SUPPLIER_NAME nvarchar(255),
    SUPPLIER_ADDRESS nvarchar(255),
    SUPPLIER_CITY nvarchar(255),
    SUPPLIER_ZIP_CODE nvarchar(255),
    SUPPLIER_STATE nvarchar(255),
    SUPPLIER_COUNTRY nvarchar(255),
    SUPPLIER_PAYTERM_CODE nvarchar(255),
    SUPPLIER_PAYTERM_DESC nvarchar(255),
    SUPPLIER_TERM_TYPE nvarchar(255),
    SUPPLIER_DIVERSITY_CODE nvarchar(255),
    SUPPLIER_DUNS_NUMBER nvarchar(255),
    SUPPLIER_DUNS_SSI nvarchar(255),
    SUPPLIER_DUNS_SER nvarchar(255),
    SUPPLIER_DUNS_PAYDEX nvarchar(255),
    SUPPLIER_DUNS_GLOBAL_ULTIMATE_COMPANY_NAME nvarchar(255),
    SUPPLIER_DUNS_GLOBAL_ULTIMATE_COUNTRY nvarchar(255),
    SUPPLIER_PREFERRED_STATUS nvarchar(255),
    RE_NORM_SUPP_NUMBER nvarchar(255),
    RK_NORM_SUPP_NAME nvarchar(255),
    HE_NORM_SUPP_CITY nvarchar(255),
    AR_NORM_SUPP_STATE nvarchar(255),
    BR_NORM_SUPP_COUNTRY nvarchar(255),
    RK_NORM_SUPP_REGION nvarchar(255),
    RK_NORM_PAYMENT_TERM nvarchar(255),
    HR_NORM_NET_DAYS nvarchar(255),
    CL_ACCOUNT_CODE float,
    GLACCOUNT_NAME nvarchar(255),
    COST_CENTER_CODE nvarchar(255),
    COST_CENTER_DESCRIPTION nvarchar(255),
    CLIENT_CATEGORY_1 nvarchar(255),
    CLIENT_CATEGORY_2 nvarchar(255),
    CLIENT_CATEGORY_3 nvarchar(255),
    CLIENT_CATEGORY_4 nvarchar(255),
    PI_CATEGORY_LEVEL_1 nvarchar(255),
    EK_CATEGORY_LEVEL_2 nvarchar(255),
    PK_CATEGORY_LEVEL_B nvarchar(255),
    P_CATEGORY_LEVEL_4 nvarchar(255),
    P_CATEGORY_LEVEL_5 nvarchar(255),
    RK_CATEGORY_LEVEL_5 nvarchar(255),
    RK_CATEGORY_LEVEL_6 nvarchar(255),
    RK_CATEGORY_LEVEL_7 nvarchar(255),
    POL_NUMBER nvarchar(255),
    POL_LINE_NUMBER nvarchar(255),
    PO_DOCUMENT_DATE date,
    POL_LINE_AMOUNT_LOCAL float,
    POL_DESCRIPTION_1 nvarchar(2000),
    POL_DESCRIPTION_2 nvarchar(2000),
    PO_BUYER_CODE nvarchar(255),
    PO_BUYER_NAME nvarchar(255),
    POL_CREATED_BY nvarchar(255),
    ITEM_MATERIAL_DESCRIPTION nvarchar(255),
    ITEM_MATERIAL_GROUP_CODE nvarchar(255),
    ITEM_MATERIAL_GROUP_DESCRIPTION nvarchar(255),
    ITEM_MATERIAL_CATEGORY_CODE nvarchar(255),
    SOURCE_SYSTEM_1 nvarchar(255),
    PROFIT_CENTER_CODE nvarchar(255),
    SOURCE_FILE_NAME nvarchar(1000),
    RK_YEAR int,
    RK_MONTH varchar(255),
    RK_FISCAL_YEAR nvarchar(255),
    RK_FISCAL_QUARTER varchar,
    EK_FISCAL_MONTH varchar(255),
    MERCHANT_CATEGORY_CODE nvarchar(255),
    MERCHANT_CATEGORY_CODE_TITLE nvarchar(255),
    EXPENSE_TYPE nvarchar(255),
    PROJECT_CODE nvarchar(255),
    PROJECT_NAME nvarchar(255),
    PROJECT_DESC nvarchar(255),
    WBS_CODE nvarchar(255),
    WBS_DESC nvarchar(255),
    GR_SOURCE_SYSTEM nvarchar(255),
    SR_NUMBER nvarchar(255),
    GR_QUANTITY float,
    RK_PROCESS_DATE date
);";

 $this->db->query($query);

 $companyName = $companyName.'_RAW_DATA';
  $query1 = "CREATE TABLE ".$companyName." (
    RAW_DATA_ID bigint PRIMARY KEY IDENTITY(1,1),
    DATE_CREATED date,
   " . implode(', ', $columns) . ",
);";

 $this->db->query($query1);

    echo "Table created successfully!";

}


}

