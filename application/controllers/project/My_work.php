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
 public function progress($id = 0){
    $data['progress']= $this->db->query('SELECT WO.work_ord_id,C.cust_name,I.name FROM work_order_tb WO LEFT OUTER JOIN customer_tb C ON C.cust_id = WO.cust_id LEFT OUTER JOIN item_service_tb I ON I.item_id = WO.service_id  WHERE work_ord_id='.$id)->result();
    $data['item_array'] = $this->db->query("SELECT LI.*,I.name FROM lead_item LI LEFT OUTER JOIN work_order_tb W ON W.work_ord_id=LI.lead_id LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id WHERE W.work_ord_id=".$id)->result();
    // echo '<pre>';print_r($data);exit();
    $this->load->view('projects/work_progress',$data);
 }
 public function start(){
    $this->load->library('session');
    $login_id = $this->session->userdata('login_id');
    $emp_id = $this->db->query("SELECT E.emp_id FROM employee_tb E LEFT OUTER JOIN login L on L.login_id = E.login_id WHERE L.login_id =" .$login_id )->row()->emp_id;
    $work_ord_id=$this->input->post('work_ord_id');
    echo $work_ord_id;
    $data =[
        'work_ord_id' =>$work_ord_id,
        'start' =>date('Y-m-d H:i:s'),
        'staff_id'=>$emp_id
    ];
    // echo '<pre>';print_r($data); exit();
    $this->db->insert('work_ord_job_tb',$data);
    echo json_encode(["status"  => "success"]);
 }
 public function stop(){
    $work_ord_id = $this->input->post('work_ord_id');
    $progress = $this->input->post('progress');
    $data = [
        'percentage' => $progress,
        'stop' => date('Y-m-d H:i:s') // Log stop time
    ];
    $this->db->update('work_ord_job_tb',$data,array('work_ord_id'=>$work_ord_id));

   
    echo json_encode(["status" => "success"]);
 }
}