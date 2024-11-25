<?php
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login(){
        $this->load->view('auth/login');
        $this->load->view('include/footer');
    }

     public function register(){
        $this->load->view('auth/register');
        $this->load->view('include/footer');
    }

     public function register_process() {
        // Check if form is submitted
        if ($this->input->post()) {
            $data = array(
                'Email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );
            
            // Call the model to insert user data
            $this->user_model->register_user($data);
            
            // Redirect to login page after successful registration
            redirect('auth/login');
        } else {
            // Load the registration form view
            $this->load->view('register_view');
        }
    }

    public function login_process() {
      //print_r($this->input->post());die;
        // Check if form is submitted
        if ($this->input->post()) {
            $username = $this->input->post('email');
            $password = $this->input->post('password');
            
            // Call the model to verify user credentials
            $user = $this->User_model->login_user($username, $password);
            if ($user) {
              $userdata = [
                    'EmployeeID' => $user->EmployeeID,
                    'FullName' => $user->FirstName.' '.$user->LastName,
                    'Email' => $user->Email,
                    'Phone' => $user->Phone,
                    'Department' => $user->Department,
                    'Position' => $user->Position,
                    'HireDate' => $user->HireDate,
                    'Salary' => $user->Salary,
                    'ManagerID' => $user->ManagerID,
                    'Password' => $user->Password,
                    'Logo' => $user->Logo
                ];
            $this->session->set_userdata($userdata);
                redirect('admin/start');
            } else {
                // Invalid credentials, show login form with error
                $data['error'] = 'Invalid username or password';
                $this->load->view('auth/login', $data);
            }
        } else {
            // Load the login form view
            $this->load->view('auth/login');
        }
    }

     public function logout() {
        $this->session->sess_destroy();
        redirect(base_url().'admin');
    }


}
?>
