<?php
class Login extends CI_Controller {   
public function index(){
    $this->load->view("login");
}
public function login_process()
{
    $this->load->library('session');
    $data = $_POST;

    $email  = $data['username'];
    $password  = $data['password'];
    // echo $email; exit();
    $result = $this->db->query("SELECT L.* FROM login L WHERE email = '$email'")->result();
   
    // $result = $this->db->query("SELECT L.*,C.cust_id,C.cust_name FROM login L JOIN customer_tb C on C.login_id = L.login_id WHERE email = '$email'")->result();
    //  echo '<pre>'; print_r($result);exit();
    if (count($result) > 0) {
        $r = $result[0];
        if ($r->password == $password) {
            // If the password matches, load the dashboard
            $res['login_id']    = $r->login_id;
            $res['email']       = $r->email;
            $this->session->set_userdata($res);
            if($r->type == 'customer')
            {
                redirect('Cust_dashboard');
            }
             elseif ($r->type =='employee')
            {
                redirect('project/My_work',$res);
            }
            else
            {
            $this->load->view("dashboard", $res);
            }
        } else {
            $data['error_message'] = 'Invalid password. Please try again.';
            $this->load->view("login", $data);
        }
    } else {
        // If email doesn't exist, load login view with an error message
        $data['error_message'] = 'Email not found. Please check your credentials.';
        $this->load->view("login", $data);
    }
}
function log_out(){
    $this->load->library('session');
    $this->session->sess_destroy();
    redirect('login');
}

}


