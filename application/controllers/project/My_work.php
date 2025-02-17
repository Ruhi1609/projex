<?php
class My_work extends CI_Controller{
    public function index()
    {
        $this->load->library('session');
        $login_id = $this->session->userdata('login_id');
        $emp_id = $this->db->query("SELECT E.emp_id FROM employee_tb E LEFT OUTER JOIN login L on L.login_id = E.login_id WHERE L.login_id =" .$login_id )->row()->emp_id;
        $data['my_work'] = $this->db->query('SELECT W.work_ord_id,W.w_number,W.date,W.status,C.cust_name,I.name FROM work_order_tb W LEFT OUTER JOIN employee_tb E ON E.emp_id=W.staff_id LEFT OUTER JOIN item_service_tb I ON I.item_id=W.service_id LEFT OUTER JOIN customer_tb C ON C.cust_id=W.cust_id  WHERE W.staff_id='.$emp_id)->result();
        // echo '<pre>';print_r($data);exit();
        $this->load->view('projects/my_work',$data);
        
    }


}