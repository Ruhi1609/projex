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
    $result = $this->db->query("SELECT L.* FROM login L WHERE email = '$email'")->result();
   
    if (count($result) > 0) {
        $r = $result[0];
        if ($r->password == $password) {
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
            redirect("dashboard");
            }
        } else {
            $data['error_message'] = 'Invalid password. Please try again.';
            $this->load->view("login", $data);
        }
    } else {
        $data['error_message'] = 'Email not found. Please check your credentials.';
        $this->load->view("login", $data);
    }
}


}


