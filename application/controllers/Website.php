<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{

     public function __construct() {
        parent::__construct();
        $this->load->library('upload'); // Load the upload library
        //$this->load->library('PHPExcel');
        $this->load->model('ChartModel');
        
    }

     public function get_chart_data() {
        $chart_data = $this->ChartModel->getChartData();
        $this->output->set_content_type('application/json')->set_output(json_encode($chart_data));
    }

    public function get_country_chart(){
        $year = $this->uri->segment(3);
         $chart_data = $this->ChartModel->getCountrywise($year);
         //print_r($this->ChartModel->getCountrywise($year));die;
        $this->output->set_content_type('application/json')->set_output(json_encode($chart_data));
    }

    
    public function index()
    {
        //echo"this is test";die;
        //if ($this->Admin_model->verifyUser()) {
        $this->load->view('include/header');
        $this->load->view('website/Home');
        $this->load->view('include/footer');
        //  }
        
    }


      public function charts()
    {
         $data['supplier'] = $this->getTotalInvoiceAmountBySupplier();
         $data['company'] = $this->getTotalInvoiceAmountByCompany();
          $data['invoice_data'] = $this->get_invoice_data();
//          echo"<pre>";
// print_r($data);
        $this->load->view('include/header');
        $this->load->view('website/charts',$data);
        $this->load->view('include/footer');
        
    }

public function getTotalInvoiceAmountByCompany() {
        // Query to get total invoice amount by company name
        $query = $this->db->select('SUPPLIER_NUMBER, SUM(INVOICE_LINE_AMOUNT_NORMALIZED) AS Total_Invoice_Amount')
                          ->from('ABC_COMPANY')
                          ->group_by('SUPPLIER_NUMBER')
                          ->get();

        // Return the result as an array
        return $query->result_array();
    }

     public function get_invoice_data() {
        $this->db->select('INVOICE_POSTING_DATE, SUM(INVOICE_LINE_AMOUNT_NORMALIZED) AS Total_Invoice_Amount');
        $this->db->from('ABC_COMPANY');
        $this->db->group_by('INVOICE_POSTING_DATE');
        $query = $this->db->get();
        return $query->result_array();
    }

public function getTotalInvoiceAmountBySupplier() {
        // Query to get total invoice amount by supplier
        $query = $this->db->select('SUPPLIER_NAME, SUM(INVOICE_LINE_AMOUNT_NORMALIZED) AS Total_Invoice_Amount')
                          ->from('ABC_COMPANY')
                          ->group_by('SUPPLIER_NAME')
                          ->get();

        // Return the result as an array
        return $query->result_array();
    }

private function cleanNumber($number) {
    // Remove "$" and ","
    $cleanedNumber = str_replace(array('$', ','), '', $number);
    
    // Convert to float
   // return floatval($cleanedNumber);

    // Convert to decimal(10,2)
    return number_format((float)$cleanedNumber, 2, '.', '');
}

private function formatDate($date) {
    // Convert date to the desired format
    $formattedDate = date('Y-m-d', strtotime($date));

    return $formattedDate;
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
            ->view('website/dashbord');
    }
    public function setting()
    {
        $this
            ->load
            ->view('admin/setting');

    }


    public function category()
    {
      $t =$this->db->query("SELECT * FROM category");
      $res= $t->result_array();
      $data['cat']=$res;
        $this
            ->load
            ->view('admin/include/header');
        $this
            ->load
            ->view('admin/include/sidebar');
        $this
            ->load
            ->view('admin/Event/dash_event',$data);
        $this
            ->load
            ->view('admin/include/footer');

    }




    public function export_client_todays_case($a)
	{
	    print_r($a);

      $org_id=$this->session->userdata['admin']['org_id'];
      $today=date('Y-m-d');
      /*SELECT `case_id`, `org_id`, `c_title`, `c_no`, `c_name`, `court_cat`, `court`, `case_cat`, `case_stage`, `act`, `c_desc`, `filling_date`, `hearing_date`, `app_law`, `tot_fees`, `c_status`, `status`, `insert_date`, `assign_to` FROM `adv_case` WHERE 1*/
      $a=$this->db->query("SELECT `ac`.`org_id` as OrgnizationID,`ac`.`c_title` as CaseName,`ac`.`c_no` as CaseID,`c`.`c_name` as ClientName,`ac`.`court_cat` as CourtCategory,`ac`.`court` as CourtName,`ac`.`case_cat` as CaseCategory,`ac`.`case_stage` as CaseStage,`ac`.`act` as CaseAct,`ac`.`c_desc` as CaseDescription,`ac`.`filling_date` as CaseFillingDate,`ac`.`hearing_date` as CaseHearingDate,`ac`.`tot_fees` as Fees,`ac`.`c_status` as CaseStatud,`ac`.`insert_date` as CreatedDate FROM `adv_case` as ac INNER JOIN clents as c ON c.c_id=ac.c_name WHERE ac.hearing_date='$today' AND ac.org_id='$org_id' AND ac.assign_to='$a'");
          
          $org_name=$this->get_name('register_user','org_id',$org_id,'name')." ". $this->get_name('register_user','org_id',$org_id,'lname');
          $org_contact=$this->get_name('register_user','org_id',$org_id,'phone');
      $left_employee=$a->result_array();
      $objPHPExcel = new PHPExcel();
      $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
      $objPHPExcel->setActiveSheetIndex(0);
      $objPHPExcel->getActiveSheet()->setCellValue('A1',"Main Advocte :".$org_name);
      $objPHPExcel->getActiveSheet()->setCellValue('A2',"Coantct Detail :".$org_contact);
      $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Todays client case List');
      foreach ($left_employee as $key => $value) 
              {
              $col = 0;
                  foreach ($value as $key1 => $value1) {
          $startCell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$col);
              //  print_r($key1);
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, $key1);
        
              $col++;

              }

              }
            // Fetching the table data
              $row = 5;
              foreach($left_employee as $datas)
              {
                  $col = 0;

                  foreach ($datas as $key12 => $value12) {
      //print_r($datas[$key12]);echo "<br>";
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $datas[$key12]);

      $col++;

            }
            // die;
                  $row++;

              }
      // Rename 2nd sheet

      $objPHPExcel->getActiveSheet()->setTitle('Todays Client case List');

      // Create a new worksheet, after the default sheet

      $objPHPExcel->createSheet();



      //$file_name = str_replace(" ","_",$company_name).'_'.$cycle.'_SALLARY_SHEET.xls';
      $file_name =$today.'Todays_Client_case_List.xls';
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename='.$file_name);
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      ob_end_clean();
      $objWriter->save('php://output');
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save($fileName);
      exit;






	    
	}


    public function customeChart(){
         $this->load->view('website/custome_chart');
    }




}

