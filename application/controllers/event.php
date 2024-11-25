<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
   {
       parent::__construct();

  $this->load->model('Admin_model');

   }
    public function index()
    {

       $a = $this
            ->db
            ->query("SELECT * FROM event");
        $result = $a->result_array();
        $data['event'] = $result;
       
       $this
            ->load
            ->view('include/header');
        $this
            ->load
            ->view('include/sidebar');
        $this
            ->load
            ->view('Event/dash_event',$data);
        $this
            ->load
            ->view('include/footer');
        
    }


 public function add_event()
    {
       
        $this
            ->load
            ->view('include/header');
        $this
            ->load
            ->view('include/sidebar');
        $this
            ->load
            ->view('Event/add_event');
        $this
            ->load
            ->view('include/footer');
    }

    public function edit_event($id)
    {
        extract($_REQUEST);
        $a = $this->db->query("SELECT * FROM event where id='$id'");
        $result = $a->row();
        $data['event'] = $result;
        $this
            ->load
            ->view('include/header');
        $this
            ->load
            ->view('include/sidebar');
        $this
            ->load
            ->view('Event/add_event', $data);
        $this
            ->load
            ->view('include/footer');

    }

    public function add_event_insert()
    {
        extract($_REQUEST);
        //echo "<pre>";
        //print_r($_REQUEST);die;
        $this
            ->form_validation
            ->set_error_delimiters('<div class="error">', '</div>');
        $this
            ->form_validation
            ->set_rules('title', 'name', 'required');
        //  $this->form_validation->set_rules('content', 'Content', 'required',array('required' => 'You must provide a %s.'));
        $this
            ->form_validation
            ->set_rules('s_content', 'Content', 'required');
        if ($this
            ->form_validation
            ->run() == false)
        {

            $this
                ->load
                ->view('include/header');
            $this
                ->load
                ->view('include/sidebar');
            $this
                ->load
                ->view('Event/add_event');
            $this
                ->load
                ->view('include/footer');
        }
        else
        {
            if (!empty($_FILES['photo']['name']))
            {
                $config['upload_path'] = './uploads/Event/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1024;
                $config['file_name'] = $_FILES['photo']['name'];
                $this
                    ->load
                    ->library('upload', $config);

                if (!$this
                    ->upload
                    ->do_upload('photo'))
                {
                    $error = array(
                        'error' => $this
                            ->upload
                            ->display_errors()
                    );
                    $this
                        ->load
                        ->view('include/header');
                    $this
                        ->load
                        ->view('include/sidebar');
                    $this
                        ->load
                        ->view('Event/add_event', $error);
                    $this
                        ->load
                        ->view('include/footer');
                }
                else
                {

                    $uploadedImage = $this
                        ->upload
                        ->data();
                    $this->Admin_model->resizeImage($uploadedImage['file_name']);
                    $filename = base_url() . "uploads/Event/" . $uploadedImage['file_name'];
                }
            }

            if (!empty($_FILES['banner']['name']))
            {
                $config['upload_path'] = './uploads/Event/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1024;
                $config['file_name'] = $_FILES['banner']['name'];
                $this
                    ->load
                    ->library('upload', $config);

                if (!$this
                    ->upload
                    ->do_upload('banner'))
                {
                    $error = array(
                        'error' => $this
                            ->upload
                            ->display_errors()
                    );
                    $this
                        ->load
                        ->view('include/header');
                    $this
                        ->load
                        ->view('include/sidebar');
                    $this
                        ->load
                        ->view('Event/add_event', $error);
                    $this
                        ->load
                        ->view('include/footer');
                }
                else
                {

                    $uploadedImage = $this
                        ->upload
                        ->data();
                    $this->Admin_model->resizeImage($uploadedImage['file_name']);
                    $filename1 = base_url() . "uploads/Event/" . $uploadedImage['file_name'];
                }
            }
        
            if ($id == "")
            {
                //echo"sioh";die;
/**/
                $this
                    ->db
                    ->query("INSERT INTO `event`(`title`, `s_content`, `b_content`, `photo`, `banner`, `start_date`, `end_date`, `status`, `location`, `map`, `meta_title`, `metat_keyword`, `meta_description`) VALUES ('$title','$s_content', '$b_content', '$filename', '$filename1', '$start_date', '$end_date', '$status', '$location', '$map', '$meta_title', '$meta_keyword', '$meta_description')");
            }
            else
            {
                if ($filename == '')
                {

                    $this
                        ->db
                        ->query("UPDATE `event` SET `title`='$title',`s_content`='$s_content',`b_content`='$b_content',`start_date`='$start_date',`end_date`='$end_date',`status`='$status',`location`='$location',`map`='',`meta_title`='$meta_title',`metat_keyword`='$meta_keyword',`meta_description`='$meta_description' WHERE `id` = '$id'");

                }
                else
                {
                    //  print_r($oldimage);
                    $ss = explode('uploads/Testimonials/', $oldimage);
                    // print_r($ss);
                    $oldpath = './uploads/Testimonials/' . $ss[1];
                    unlink($oldpath);

                     $this
                        ->db
                        ->query("UPDATE `event` SET `title`='$title',`s_content`='$s_content',`b_content`='$b_content',`photo`='$filename',`start_date`='$start_date',`end_date`='$end_date',`status`='$status',`location`='$location',`map`='',`meta_title`='$meta_title',`metat_keyword`='$meta_keyword',`meta_description`='$meta_description' WHERE `id` = '$id'");
                }



                if ($filename1 == '')
                {

                    $this
                        ->db
                        ->query("UPDATE `event` SET `title`='$title',`s_content`='$s_content',`b_content`='$b_content',`start_date`='$start_date',`end_date`='$end_date',`status`='$status',`location`='$location',`map`='',`meta_title`='$meta_title',`metat_keyword`='$meta_keyword',`meta_description`='$meta_description' WHERE `id` = '$id'");

                }
                else
                {
                    //  print_r($oldimage);
                    $ss = explode('uploads/Testimonials/', $oldimage);
                    // print_r($ss);
                    $oldpath = './uploads/Testimonials/' . $ss[1];
                    unlink($oldpath);

                     $this
                        ->db
                        ->query("UPDATE `event` SET `title`='$title',`s_content`='$s_content',`b_content`='$b_content',`banner`='$filename1',`start_date`='$start_date',`end_date`='$end_date',`status`='$status',`location`='$location',`map`='',`meta_title`='$meta_title',`metat_keyword`='$metat_keyword',`meta_description`='$meta_description' WHERE `id` = '$id'");
                }

            }

            redirect('admin/event');

            exit;
        }

    }

    public function delete_event($id)
    {
       $v=$this->db->query("DELETE FROM `event` WHERE id='$id'");
       if($v)
       {
         redirect('admin/event');
       }

    }




  }