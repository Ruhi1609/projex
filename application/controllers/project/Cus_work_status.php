<?php
class Cus_work_status extends CI_Controller {
    public function index() {
        $this->load->library('session');
        $login_id = $this->session->userdata('login_id');
        $cust_id = $this->db->query("SELECT C.cust_id FROM customer_tb C LEFT OUTER JOIN login L on L.login_id = C.login_id WHERE L.login_id =" .$login_id )->row()->cust_id;
        $data['estimate'] = $this->db->query("SELECT lead_number,amount,date FROM lead_tb WHERE type='ESTIMATE' AND  cust_id=".$cust_id)->result();
        $data['quotation'] =$this->db->query("SELECT lead_number,amount,date,confirm FROM lead_tb WHERE type='QUOTATION' AND cust_id=".$cust_id)->result();
        $data['work_order'] =$this->db->query("SELECT w_number,date,amount FROM work_order_tb WHERE cust_id=".$cust_id)->result();
        $work_ids = $this->db->query("SELECT work_ord_id FROM work_order_tb WHERE cust_id =".$cust_id)->result_array();
        $work_id_list = array_column($work_ids, 'work_ord_id');
        if (!empty($work_id_list)) {
        $work_id_str = implode(',', $work_id_list);
         $data['work_assign'] = $this->db->query("SELECT W.w_number, E.emp_name, E.position_id, MAX(WJ.percentage) as max_perc FROM work_order_tb W LEFT OUTER JOIN employee_tb E ON E.emp_id = W.staff_id LEFT OUTER JOIN work_ord_job_tb WJ ON WJ.work_ord_id = W.work_ord_id WHERE W.work_ord_id IN ($work_id_str) AND W.cust_id = $cust_id GROUP BY W.w_number, E.emp_name, E.position_id ")->result();
            } else {
                $data['work_assign'] = []; 
            }

        $data['wo_status']=$this->db->query("SELECT W.w_number,W.status FROM work_order_tb W  WHERE  W.cust_id=".$cust_id)->result();
        // echo '<pre>';print_r($data['work_assign']);exit();
        $this->load->view('customer/cus_work_status',$data);
    }

}