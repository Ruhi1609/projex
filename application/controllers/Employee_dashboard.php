<?php
class Employee_dashboard extends CI_Controller{
    public function index() {
        $this->load->library('session');
        $login_id = $this->session->userdata('login_id');
        $employee_details   = $this->db->query('SELECT E.emp_name,E.emp_id FROM employee_tb E LEFT OUTER JOIN login L ON L.login_id = E.login_id WHERE L.login_id ='.$login_id)->result();
        $data['employee_details'] = $employee_details;
        // echo $login_id;
        // echo '<pre>'; print_r($data);exit();
        $this->load->view('Employee/Employee_dashboard',$data);
    }
}