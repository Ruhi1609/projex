<?php
class Employee_dashboard extends CI_Controller{
    public function index() {
        $this->load->library('session');
        $login_id = $this->session->userdata('login_id');
        $employee_details   = $this->db->query('SELECT E.emp_name,E.emp_id FROM employee_tb E LEFT OUTER JOIN login L ON L.login_id = E.login_id WHERE L.login_id =?',array($login_id))->result();
        $data['employee_details'] = $employee_details;
        $emp_id=$this->db->query("SELECT emp_id FROM employee_tb WHERE login_id=".$login_id)->row()->emp_id;
        $pending_work = $this->db->query("SELECT * FROM work_order_tb WHERE status != 'Completed' AND staff_id = ".$emp_id)->result();
        $data['pending_work']=count($pending_work);
        $completed_work = $this->db->query("SELECT * FROM work_order_tb WHERE status = 'Completed' AND staff_id = ".$emp_id)->result();
        $data['completed_work']=count($completed_work);
        
        // echo $login_id;
        // echo '<pre>'; print_r($data);exit();
        $this->load->view('Employee/Employee_dashboard',$data);
    }
}