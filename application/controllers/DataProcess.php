<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class DataProcess extends CI_Controller
{

     public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');

    }

    public function uploadMasterFile(){
      //  print_r($_REQUEST);die;
    extract($_REQUEST);
    // $dateParts = explode(" - ", $daterange);
    // // Convert dates to Y-m-d format
    //  $startDate = date("Y-m-d", strtotime($dateParts[0]));
    //  $endDate = date("Y-m-d", strtotime($dateParts[1]));

    $startDate = date("Y-m-d", strtotime($start));
    $endDate = date("Y-m-d", strtotime($end));

    $company_name = $this->Admin_model->getClientTableName($this->session->userdata()['COM_ID']);
    $company_name_process = $this->Admin_model->cleanString($company_name);

    // Define upload path
    $uploadPath = './uploads/CompanyData/' . $company_name_process . '/excelFile/Monthly/' . date('F_Y') . '/';

    // Create directory if it doesn't exist
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $config['file_name'] = $this->Admin_model->cleanString($_FILES['excel_file']['name']);
    $config['upload_path']   = $uploadPath;
    $config['allowed_types'] = 'xls|xlsx|csv';
    $config['max_size']      = 100240;

    $this->load->library('upload', $config); // Load the upload library

    if (!$this->upload->do_upload('excel_file')) {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
    } else {
        $data = array('upload_data' => $this->upload->data());
        $dataArray = $this->processExcelData($data['upload_data']['full_path']);

        
        echo "<pre>";

        //print_r($dataArray);die;
        $this->saveToDatabase($dataArray,$startDate,$endDate);
    }

    redirect(base_url('admin/start'));
    }
    // foreach ($variable as $key => $value) {
    //   # code...
    // }

   function removeDuplicates($array, $keys) {
    $tempArray = [];
    $resultArray = [];

    foreach ($array as $item) {
        $key = '';
        foreach ($keys as $k) {
            $key .= $item[$k];
        }
        
        if (!isset($tempArray[$key])) {
            $tempArray[$key] = true;
            $resultArray[] = $item;
        }
    }

    return $resultArray;
}


     private function processExcelData($filePath) {
        echo"<pre>";
        $arr_file 	= explode('.', $filePath);
                $extension 	= end($arr_file);
                if('csv' == $extension) {
                $reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                $reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreadsheet 	= $reader->load($filePath);
                $sheetData 	= $spreadsheet->getActiveSheet()->toArray();

        $excelHeaders  = array_shift($sheetData);
     //print_r($excelHeaders);die;
        // Get actual headers from the database
        $actualHeaders = $this->Admin_model->getMappingData($this->session->userdata()['COM_ID'], "excel_column");
        $excelColumns = array();

        foreach ($actualHeaders as $item) {
            $excelColumns[] = $item['excel_column'];
        }
        $currentDate = date('Y-m-d'); 

        $dataArray = array();

        foreach ($sheetData as $row) {
            $rowData = array();

            foreach ($row as $column => $value) {
                // Check if the current column in Excel matches any of the columns in the database
                foreach ($excelColumns as $header) {
                  //print_r($header);echo"<br>";
                    if ($header === $excelHeaders[$column]) {
                        // If there's a match, add the value to $rowData with the corresponding database column name
                        $rowData[strtoupper(str_replace(' ', '_', $header))] = $this->Admin_model->trimAndUpperCase($value);
                        break; // Exit the inner loop once a match is found
                    }
                }
            }

            // Add the current date to $rowData
            $rowData['DATE_CREATED'] = $currentDate;
            //$rowData['RK_PROCESS_DATE'] = 
            // Check if all database columns are present in $rowData
            $missingColumns = array_diff(array_column($excelColumns, $header), array_keys($rowData));

            if (empty($missingColumns)) {
                // If all database columns are present, add $rowData to $dataArray
                $dataArray[] = $rowData;
            }
        }
        $actualHeaders1 = $this->Admin_model->getMappingData($this->session->userdata()['COM_ID'], "Process_column");
        $excelColumns1 = array();
          
        foreach ($actualHeaders1 as $item1) {
            $excelColumns1[] = $item1['Process_column'];
        }
        echo "<pre>";
       // print_r(array_values($excelColumns1));die;
        //print_r($dataArray);die;
         $dataArray = $this->removeDuplicates($dataArray,array_values($excelColumns1));
        // foreach ($sheetData as $row) {
        //     $rowData = array();

        //     foreach ($actualHeaders as $header) {
        //         // Convert Excel column headers to uppercase and replace spaces with underscores
        //         $excelColumn = strtoupper(str_replace(' ', '_', $header['excel_column']));
        //         print_r($row[$excelColumn]);
        //         // Check if the Excel column header exists in the current row
        //         if (isset($row[$excelColumn])) {
        //             // If the header exists, assign its value to the corresponding key in $rowData
        //             $rowData[$header['excel_column']] = $row[$excelColumn];
        //         } else {
        //             // If the header doesn't exist, assign null value
        //             $rowData[$header['excel_column']] = null;
        //         }
        //     }

        //     // Add the current date to $rowData
        //     $rowData['DATE_CREATED'] = $currentDate;

        //     // Add $rowData to $dataArray
        //     $dataArray[] = $rowData;
        // }
    //echo "<pre>";
      // print_r($dataArray);  die;
        return $dataArray;
    }

    private function saveToDatabase($dataArray,$startDate,$endDate) {
       $dataArray =$this->Admin_model->filterArrayByDateRange($dataArray,$startDate,$endDate,$this->session->userdata()['COM_ID']);
         // print_r($ff);die;
      $RAW_DATA = $this->Admin_model->getClientTableName($this->session->userdata()['COM_ID']);
      if($RAW_DATA!=null){
        //array_shift($dataArray);
        // Insert data into the database
        foreach ($dataArray as $row) {
            $this->db->insert($RAW_DATA.'_RAW_DATA', $row);
        }

        $this->dataProcessForCompanyTable($dataArray,$RAW_DATA);
      }
    }

    public function dataProcessForCompanyTable($dataArray,$tableName){
      $cc =  $this->Admin_model->getAllMappingData($this->session->userdata()['COM_ID']);
      $mastertable = array();
      echo"<pre>";
        foreach ($cc as $item) {
            $mastertable[] = $item;
        }
        //print_r($dataArray);
        //print_r($mastertable);

    foreach ($dataArray as $row) {
    $insertData = array();
    
    // Loop through each mapping
    foreach ($mastertable as $map) {
        $processColumn = $map['Process_column'];
        $masterTable = $map['mastertable'];
        
        // Check if the process_column exists in the current data row
        if (array_key_exists($processColumn, $row)) {
            // If the mastertable value is not empty or null, assign it to the insert data
            if (!empty($masterTable)) {
                $insertData[$masterTable] = $row[$processColumn];
                $insertData['RK_PROCESS_DATE'] = date('Y-m-d');
            }
        }
    }
    
    // If insertData is not empty, perform the insertion
    if (!empty($insertData)) {
        $this->db->insert($tableName, $insertData);
    }
}
        //die;
        
    }














}    