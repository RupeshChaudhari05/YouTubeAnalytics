<?php
Class Admin_model extends CI_Model {


// Read data using username and password
public function login($data) {
        //print_r($data);die;
        $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('register');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
        return true;
        } else {
        return false;
        }
}
// Read data from database to show data in admin page
public function read_user_information($username) {

        $condition = "username =" . "'" . $username . "' AND status='Active'";
        $this->db->select('*');
        $this->db->from('register');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
        return $query->result();
        } else {
        return false;
        }
}


public function uploadImage()
    {

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        $this
            ->load
            ->library('upload', $config);

        if (!$this
            ->upload
            ->do_upload('image'))
        {
            $error = array(
                'error' => $this
                    ->upload
                    ->display_errors()
            );
            $this
                ->load
                ->view('imageUploadForm', $error);
        }
        else
        {

            $uploadedImage = $this
                ->upload
                ->data();
            $this->resizeImage($uploadedImage['file_name']);

            print_r('Image Uploaded Successfully.');
            exit;
        }
    }

    public function resizeImage($filename)
    {
        $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename;
        $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/thumbnail/';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => true,
            'create_thumb' => true,
            'thumb_marker' => '_thumb',
            'width' => 150,
            'height' => 150
        );

        $this
            ->load
            ->library('image_lib', $config_manip);
        if (!$this
            ->image_lib
            ->resize())
        {
            echo $this
                ->image_lib
                ->display_errors();
        }

        $this
            ->image_lib
            ->clear();
    }


    public function getClientTableName($id) {
    // Query to fetch the company name based on the provided ID
    $query = $this->db->query("SELECT Clean_company_name FROM client_list WHERE ID = '$id'");
    
    // Check if the query returned a result
    if ($query->num_rows() > 0) {
        // Extract the company name from the query result
        $result = $query->row();
        $companyName = strtoupper($result->Clean_company_name);

    
        // Return the formatted table name
        return $companyName;
    } else {
        // Return null if no result found for the provided ID
        return null;
    }
}

public function isTableCreated($id) {
    // Get the table name based on the provided ID
    $tableName = $this->getClientTableName($id);
   
    if($tableName != null && $tableName != "") {
        // Check if the table exists in the database
        $query = $this->db->query("IF OBJECT_ID('$tableName', 'U') IS NOT NULL
            BEGIN
                SELECT 'Table exists' AS result;
            END
            ELSE
            BEGIN
                SELECT 'Table does not exist' AS result;
            END");

        // Get the result
        $result = $query->row();

        // Print the result for debugging purposes
        //print_r($result);
        
        // Return true if the table exists, otherwise false
        return ($result->result == 'Table exists') ? true : false;
    } else {
        // If table name is empty, return false
        return false;
    }
}

public function getComapnyDetail($id){
     $query = $this->db->query("SELECT * FROM client_list WHERE ID = '$id'");
      // Check if the query returned a result
    if ($query->num_rows() > 0) {
        // Extract the company name from the query result
        $result = $query->row();
        // Return the formatted table name
        return $result;
    } else {
        // Return null if no result found for the provided ID
        return null;
    }
}


public function getAllCompanyList(){
     $query = $this->db->query("SELECT * FROM client_list");
      // Check if the query returned a result
    if ($query->num_rows() > 0) {
        // Extract the company name from the query result
        $result = $query->result_array();
        // Return the formatted table name
        return $result;
    } else {
        // Return null if no result found for the provided ID
        return null;
    }
}

public function getMappingData($id, $columnName) {
    // Sanitize input to prevent SQL injection
    $id = $this->db->escape_str($id);
    $columnName = $this->db->escape_str($columnName);
    
    // Prepare the query using Query Builder to avoid SQL injection
    $query = $this->db->select($columnName)
                      ->from('mapping_table')
                      ->where('clientid', $id)
                      ->get();
    //echo $this->db->last_query();die;
    // Check if the query returned a result
    if ($query->num_rows() > 0) {
        // Extract the data from the query result
        $result = $query->result_array();
        // Return the data
        //print_r($result[$columnName]);die;
        return $result;
    } else {
        // Return null if no result found for the provided ID
        return null;
    }
}

public function getAllMappingData($id){
     $id = $this->db->escape_str($id);
     $query = $this->db->query("SELECT mastertable,Process_column FROM mapping_table WHERE clientid='$id'");
      // Check if the query returned a result
    if ($query->num_rows() > 0) {
        // Extract the company name from the query result
        $result = $query->result_array();
        // Return the formatted table name
        return $result;
    } else {
        // Return null if no result found for the provided ID
        return null;
    }
}

// Clensing Fucntions

private function cleanNumber($number) {
    // Remove "$" and ","
    $cleanedNumber = str_replace(array('$', ','), '', $number);
    
    // Convert to float
   // return floatval($cleanedNumber);

    // Convert to decimal(10,2)
    return number_format((float)$cleanedNumber, 2, '.', '');
}

function trimAndUpperCase($string) {
    // Trim whitespace from the beginning and end of the string
    $upperCaseString ="";
    if ($string !== null) {
    $trimmedString = trim($string);
    $upperCaseString = strtoupper($trimmedString);
    }
    
    // Convert the trimmed string to uppercase
    
    
    // Return the uppercase trimmed string
    return $upperCaseString;
}


function cleanString($input) {
    // Remove symbols and spaces
    $cleaned = preg_replace('/[^\w\s]/', '', $input);
    
    // Replace spaces with underscores
    $cleaned = str_replace(' ', '_', $cleaned);
    
    return $cleaned;
}

private function formatDate($date) {
    // Convert date to the desired format
    $formattedDate = date('Y-m-d', strtotime($date));

    return $formattedDate;
}

public function getDateColoumn($com_id){
        $this->db->select('Process_column');
        $this->db->from('mapping_table');
        $this->db->where('clientid', $com_id);
        $this->db->where('useforDateFilter', 'YES');
        $this->db->limit(1);
        $query = $this->db->get();
         $result = $query->row();
         return $result->Process_column;
        //echo $this->db->last_query();die;
        //print_r($result);die;
}

 public function filterArrayByDateRange($array, $startDate, $endDate,$com_id) {
    $filteredArray = array();
    $col= $this->getDateColoumn($com_id);
    // Convert start and end dates to DateTime objects for comparison
    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);

    foreach ($array as $item) {
       // print_r($item['POSTING_DATE']);die;
        // Convert the POSTING_DATE to a DateTime object for comparison
        $postingDate = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($item[$col])));
        
        // Check if the posting date is within the specified range
        if ($postingDate >= $startDateTime && $postingDate <= $endDateTime) {
            // Add the item to the filtered array
             $item[$col] = date('Y-m-d', strtotime($item[$col]));
            //$filteredArray[$col]=date('Y-m-d', strtotime($item[$col]));
            $filteredArray[] = $item;
        }
    }

    return $filteredArray;
}



}

?>