<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

	public function index()
	{ 
		
		
	}

 public  function get_name($table,$column,$value,$column_value)
{
  //echo "SELECT * from `$table` where `$column`='$value' AND status='Active'";die;
  $sql=$this->db->query("SELECT * from `$table` where `$column`='$value' AND status='Active'");
  $result=$sql->row();
 return $result->$column_value;

}


  public function get_audio_service()
  {
    $response = array();
    $aa=$this->db->query("SELECT * FROM audio_service where status='Active'");
    $result=$aa->result_array();

    $response['Data'] = array();
    $arr=$aa->num_rows();

    if($arr>0){
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }

  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT);
    
    
    
  }


  public function get_paid_porotocol()
  {
    $response = array();
    $aa=$this->db->query("SELECT * FROM paid_teplet where status='Active'");
    $result=$aa->result_array();

    $response['Data'] = array();
    $arr=$aa->num_rows();

    if($arr>0){
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }

  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT);
    
  }



 public function uploadprofie1()
  {
    extract($_REQUEST);
    $json = json_decode(file_get_contents('php://input'),true);
  
   // print_r($whatsapp1);die;
   
   // $name = $json["name"]; //within square bracket should be same as Utils.imageName & Utils.image
   
    //$image 
    //= $json["image"];
    //print_r($_REQUEST);die;
    //url_right
 
    $response = array();

   /* if ($image!="N/A" && $image1!="N/A") {
       $decodedImage = base64_decode("$image");
       $return = file_put_contents("uploads/profile_image/".$mobile.".JPG", $decodedImage);
       $v="uploads/profile_image/".$mobile.".JPG";

       $decodedImage1 = base64_decode("$image1");
       $return1 = file_put_contents("uploads/profile_image/".$mobile."_right.JPG", $decodedImage1);
       $v1="uploads/profile_image/".$mobile."_right.JPG";

       $data=  $this->db->query("UPDATE `client` SET `name`='$fname' ,`url`='$v' ,`url_right`='$v1',`email`='$email',`phone`='$mobile',`degination`='$des1',`facebook`='$fb1',`des2`= '$des2', `lang`='$lang', `whatsapp1`='$whatsapp1', `city1`= '$city1', `state1`='$state1', `party1`='$party1' WHERE `id`='$userid'"); 

      
    }else if ($image=="N/A" && $image1!="N/A") {

       $decodedImage1 = base64_decode("$image1");
       $return1 = file_put_contents("uploads/profile_image/".$mobile."_right.JPG", $decodedImage1);
       $v1="uploads/profile_image/".$mobile."_right.JPG";

       $data=  $this->db->query("UPDATE `client` SET `name`='$fname' ,`url_right`='$v1',`email`='$email',`phone`='$mobile',`degination`='$des1',`facebook`='$fb1',`des2`= '$des2', `lang`='$lang', `whatsapp1`='$whatsapp1', `city1`= '$city1', `state1`='$state1', `party1`='$party1' WHERE `id`='$userid'"); 

      
    }  if ($image!="N/A" && $image1=="N/A") {
      
      $decodedImage = base64_decode("$image");
    $return = file_put_contents("uploads/profile_image/".$mobile.".JPG", $decodedImage);
    $v="uploads/profile_image/".$mobile.".JPG";


   $data=  $this->db->query("UPDATE `client` SET `name`='$fname' ,`url`='$v',`email`='$email',`phone`='$mobile',`degination`='$des1',`facebook`='$fb1',`des2`= '$des2', `lang`='$lang', `whatsapp1`='$whatsapp1', `city1`= '$city1', `state1`='$state1', `party1`='$party1' WHERE `id`='$userid'"); 

    }else{

 $data= $this->db->query("UPDATE `client` SET `name`='$fname' ,`email`='$email',`phone`='$mobile',`degination`='$des1',`facebook`='$fb1',`des2`= '$des2', `lang`='$lang', `whatsapp1`='$whatsapp1', `city1`= '$city1', `state1`='$state1', `party1`='$party1' WHERE `id`='$userid'"); 
    }
*/

    




 if($image!="N/A"){
    $decodedImage = base64_decode("$image");
    $return = file_put_contents("uploads/profile_image/".$mobile.".JPG", $decodedImage);
    $v="uploads/profile_image/".$mobile.".JPG";


   $data=  $this->db->query("UPDATE `client` SET `name`='$fname' ,`url`='$v',`email`='$email',`phone`='$mobile',`degination`='$des1',`facebook`='$fb1',`des2`= '$des2', `lang`='$lang', `whatsapp1`='$whatsapp1', `city1`= '$city1', `state1`='$state1', `party1`='$party1' WHERE `id`='$userid'"); 
    
}else{
   
   $data= $this->db->query("UPDATE `client` SET `name`='$fname' ,`email`='$email',`phone`='$mobile',`degination`='$des1',`facebook`='$fb1',`des2`= '$des2', `lang`='$lang', `whatsapp1`='$whatsapp1', `city1`= '$city1', `state1`='$state1', `party1`='$party1' WHERE `id`='$userid'"); 
}
    if($data !== false){
        $response['success'] = 1;
        $response['message'] = "Successfully Updated";
    }else{
        $response['success'] = 0;
        $response['message'] = "Updation Failed";
    }
 
    echo json_encode($response);
  }



  public function uploadprofie1()
  {
    extract($_REQUEST);
    $json = json_decode(file_get_contents('php://input'),true);
  
   // print_r($whatsapp1);die;
   
   // $name = $json["name"]; //within square bracket should be same as Utils.imageName & Utils.image
   
    //$image 
    //= $json["image"];
    //print_r($_REQUEST);die;
    
 
    $response = array();
 if($image!=""){
    $decodedImage = base64_decode("$image");
 
    $return = file_put_contents("uploads/profile_image/".$mobile.".JPG", $decodedImage);
    
    $v="uploads/profile_image/".$mobile.".JPG";


   $data=  $this->db->query("UPDATE `client` SET `name`='$fname' ,`url`='$v',`email`='$email',`phone`='$mobile',`degination`='$des1',`facebook`='$fb1',`des2`= '$des2', `lang`='$lang', `whatsapp1`='$whatsapp1', `city1`= '$city1', `state1`='$state1', `party1`='$party1' WHERE `id`='$userid'"); 
    
}else{
   
   $data= $this->db->query("UPDATE `client` SET `name`='$fname' ,`email`='$email',`phone`='$mobile',`degination`='$des1',`facebook`='$fb1',`des2`= '$des2', `lang`='$lang', `whatsapp1`='$whatsapp1', `city1`= '$city1', `state1`='$state1', `party1`='$party1' WHERE `id`='$userid'"); 
}
    if($data !== false){
       
       
        $response['success'] = 1;
        $response['message'] = "Successfully Updated";
    }else{
        $response['success'] = 0;
        $response['message'] = "Updation Failed";
    }
 
    echo json_encode($response);
  }



  public function get_video_service()
  {
    $response = array();
    $aa=$this->db->query("SELECT * FROM video_services where status='Active'");
    $result=$aa->result_array();

    $response['Data'] = array();
    $arr=$aa->num_rows();

    if($arr>0){
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }

  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT);
    
    
  }


    public function login()
  {
   //echo '<pre>';
    extract($_REQUEST);
    $response = array();
    //$email='rupeshchaudhari05@gmail.com';
    //$password='123456';
    $aa=$this->db->query("SELECT * FROM client where status='Active' AND email='$email' and password='$password' LIMIT 1");
    $result=$aa->row();

  //  $response['Data'] = array();
    $arr=$aa->num_rows();
    //print_r($arr);die;

    if($arr==1){
//print_r($result->score);
      $response['Data'][]  = $result;
     
      $response['message'] = 'Success';
      $response['status']  = 1;

/*    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }
*/
  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT);
    
    
  }


public function slider(){

  $responce=array();

    $a=$this->db->query("SELECT * FROM slider where status='Active'");

    if ($a->num_rows()>0) 

    {

    $result=$a->result_array();

    foreach ($result as $key => $value) 

    {

      $responce['Data'][]=$value;

    }

      $responce['status']="1";

      $responce["success"] = "";

    



      

    }else{

    

      $responce['success']="";

      $responce["status"]="0";

    }



    echo json_encode($responce,JSON_PRETTY_PRINT);



}


public function get_subCategory()
{

  extract($_REQUEST);
  $response = array();
    $aa=$this->db->query("SELECT * FROM sub_category where status='Active' AND cat_id='$cat_id'");
    $result=$aa->result_array();

    $response['Data'] = array();
    $arr=$aa->num_rows();

    if($arr>0){
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }

  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT); 
}


public function get_design()
{

/*$page=1;
$cat_id=4;
$sub_id=1;
*/
extract($_REQUEST);
//print_r($_REQUEST);die;

  $results_per_page = 10;  
 // $number_of_result = mysqli_num_rows($result);  
  

  $response = array();

    $aa=$this->db->query("SELECT * FROM design where status='Active' AND cateory_id='$cat_id' AND sub_id='$sub_id'");
   // $result=$aa->result_array();
    $response['Data'] = array();
    $number_of_result=$aa->num_rows();


    //determine the total number of pages available  
  $number_of_page = ceil($number_of_result / $results_per_page);  
  
    //determine which page number visitor is currently on  
    if (!isset($page)){
        $page = 1;  
    } else {  
        $page = $page;  
    }  
  
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database   
     $query=$this->db->query("SELECT * FROM design where status='Active' AND cateory_id='$cat_id' AND sub_id='$sub_id' LIMIT ". $page_first_result . ',' . $results_per_page);
     $result=$query->result_array();

 
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }



    echo json_encode($response, JSON_PRETTY_PRINT); 
}



public function getstikers()
{
  extract($_REQUEST);
  $response = array();
  if ($type=='Normal'){
    $aa=$this->db->query("SELECT * FROM stikers where status='Active' AND type='Normal'");
  }else{
    $aa=$this->db->query("SELECT * FROM stikers where status='Active' AND type='footer'");
  }
    $result=$aa->result_array();

    $response['Data'] = array();
    $arr=$aa->num_rows();

    if($arr>0){
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }

  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT); 
}


public function Get_party_protocol()
{
  extract($_REQUEST);
  $response = array();

    $aa=$this->db->query("SELECT * FROM party_template where status='Active' AND group_party='NO'");
    $result=$aa->result_array();
    $response['Data'] = array();
    $arr=$aa->num_rows();

    if($arr>0){
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }

  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT);
}


public function Transaction()
{
  extract($_REQUEST);
  $response = array();

    $aa=$this->db->query("SELECT * FROM transaction where status='Active' AND c_id='$user_id'");
    $result=$aa->result_array();
    $response['Data'] = array();
    $arr=$aa->num_rows();

    if($arr>0){
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }

  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT);
}


public function addevent()
{
  extract($_REQUEST);
  $response = array();

  
   // $response['Data'] = array();
    $aa=$this->db->query("INSERT INTO `transaction`(`amount`, `c_id`, `date_ragister`) VALUES ('$amount','$user_id',NOW())");
    $result=$aa->result_array();

      //$response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    

  

    echo json_encode($response, JSON_PRETTY_PRINT);
}
/*
public function get_tabs()
{
  extract($_REQUEST);
  $response = array();
    $response['Data'] = array();
    $type='Today';
    $cat_id='3';
    $today=date("Y-m-d");

    if($type=="Today"){

       $aa=$this->db->query("SELECT s.s_name FROM design as d INNER JOIN sub_category as s  ON d.sub_id=s.sub_id where d.status='Active' AND d.cateory_id='$cat_id' AND d.f_date='$today' ORDER BY d.d_id DESC");


    }elseif ($type=="Towmmarow") {

       $aa=$this->db->query("SELECT * FROM design where status='Active' AND cateory_id='$cat_id' AND f_date='$today' ORDER BY d_id DESC");

      
    }else{

       $aa=$this->db->query("SELECT * FROM design where status='Active' AND cateory_id='$cat_id' AND f_date='$today' ORDER BY d_id DESC");
    

    }
   // echo '<pre>';

    $result=$aa->result_array();
    //print_r($result);die;
    $arr=$aa->num_rows();

    if($arr>0){
    foreach ($result as $value)
    {
//print_r($value['sub_id']);
      $response['Data'][]  = $value;
      //$this->get_name("sub_category","sub_id",$value['sub_id'],"s_name");
      $response['message'] = 'Success';
      $response['status']  = 1;
    }

  }else{
      $response['message'] = 'No User Found';
      $response['status']  = 0;
  }

    echo json_encode($response, JSON_PRETTY_PRINT);
}
*/

public function get_daa_tabs()
{
  $response=array();
  extract($_REQUEST);
  $response['status']=0;
  $type="Today's Design";
  //  $cat_id='3';
  $today=date("Y-m-d");
  $results_per_page = 10;  
/*if($_SERVER['REQUEST_METHOD']=='POST'){*/
//echo '<pre>';

  
  

    
     // $category="SELECT * FROM `sub_category` WHERE `cat_id`='$cat_id'";
      $aa=$this->db->query("SELECT * FROM `sub_category` WHERE `cat_id`='$cat_id'");
       $arr=$aa->num_rows();
        $result=$aa->result_array();


    if($arr>0){
        foreach($result as $key=>$value){
          $name=$value['s_name'];
          $myid=$value['sub_id'];





    $aa1=$this->db->query("SELECT * FROM `design` WHERE sub_id='$myid' AND f_date ='$today'");
   // $result=$aa->result_array();

    $number_of_result=$aa1->num_rows();

    $number_of_page = ceil($number_of_result / $results_per_page);  
  
    //determine which page number visitor is currently on  
    if (!isset($page)){
        $page = 1;  
    } else {  
        $page = $page;  
    }  
  
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  






         /* echo "<pre>";
          print_r($name);*/
          //echo "SELECT * FROM `design` WHERE sub_id='$myid' AND f_date='$today'";die;
          $sub_category=$this->db->query("SELECT * FROM `design` WHERE sub_id='$myid' AND f_date='$today'  LIMIT ". $page_first_result . ',' . $results_per_page);
         // echo "SELECT * FROM `design` WHERE sub_id='$myid' AND f_date='$today'";die;
           $arr1=$sub_category->num_rows();
             
          $sub_category=$sub_category->result_array();
        // print_r($sub_category);
          
          if($arr1>0){
            foreach($sub_category as $key2=>$value2){
             
              $response['Data'][$name][]=$value2;
            }
            $response['status']=1;
            $response['message']='Success';
          }
          else{
            $response['status']=0;
            $response['message']='1st';
          }
        }
      }
      else{
        $response['status']=0;
        $response['message']='2nd';
      }
   
/*}
else{
  $response['status']=0;
  $response['message']='';
}*/
  echo json_encode($response, JSON_PRETTY_PRINT,JSON_FORCE_OBJECT);
}



/*public function get_todays_design()
{

$page=1;
$cat_id=3;
$today=date("Y-m-d");


extract($_REQUEST);
//print_r($_REQUEST);die;

  $results_per_page = 10;  
 // $number_of_result = mysqli_num_rows($result);  
  

  $response = array();

    $aa=$this->db->query("SELECT * FROM design where status='Active' AND cateory_id='$cat_id' AND f_date='$today' ORDER BY d_id DESC");
   // $result=$aa->result_array();
    $response['Data'] = array();
    $number_of_result=$aa->num_rows();


    //determine the total number of pages available  
  $number_of_page = ceil($number_of_result / $results_per_page);  
  
    //determine which page number visitor is currently on  
    if (!isset($page)){
        $page = 1;  
    } else {  
        $page = $page;  
    }  
  
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database   
     $query=$this->db->query("SELECT * FROM design where status='Active' AND cateory_id='$cat_id' AND f_date='$today'  LIMIT ". $page_first_result . ',' . $results_per_page);
     $result=$query->result_array();

 
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }



    echo json_encode($response, JSON_PRETTY_PRINT); 
}*/



public function get_notification()
{


extract($_REQUEST);
//print_r($_REQUEST);die;

  $results_per_page = 10;  
 // $number_of_result = mysqli_num_rows($result);  
  

  $response = array();

    $aa=$this->db->query("SELECT * FROM notification where status='Active'");
   // $result=$aa->result_array();
    $response['Data'] = array();
    $number_of_result=$aa->num_rows();


    //determine the total number of pages available  
  $number_of_page = ceil($number_of_result / $results_per_page);  
  
    //determine which page number visitor is currently on  
    if (!isset($page)){
        $page = 1;  
    } else {  
        $page = $page;  
    }  
  
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database   
     $query=$this->db->query("SELECT * FROM notification where status='Active' LIMIT ". $page_first_result . ',' . $results_per_page);
     $result=$query->result_array();

 
    foreach ($result as $value)
    {
      $response['Data'][]  = $value;
      $response['message'] = 'Success';
      $response['status']  = 1;
    }



    echo json_encode($response, JSON_PRETTY_PRINT); 
}


  

}
