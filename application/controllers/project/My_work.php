<?php
class My_work extends CI_Controller{
    public function index()
    {
        $this->load->library('session');
        $login_id = $this->session->userdata('login_id');
        $emp_id = $this->db->query("SELECT E.emp_id FROM employee_tb E LEFT OUTER JOIN login L on L.login_id = E.login_id WHERE L.login_id =" .$login_id )->row()->emp_id;
        $data['my_work'] = $this->db->query('SELECT W.work_ord_id,W.w_number,W.date,W.status,C.cust_name,I.name FROM work_order_tb W LEFT OUTER JOIN employee_tb E ON E.emp_id=W.staff_id LEFT OUTER JOIN item_service_tb I ON I.item_id=W.service_id LEFT OUTER JOIN customer_tb C ON C.cust_id=W.cust_id  WHERE W.staff_id='.$emp_id)->result();
        // $work_id = $this->db->query("SELECT work_ord_id FROM work_ord_job_tb WHERE staff_id =".$emp_id)->result();
        // $data['percentage'] =$this->db->query("SELECT  MAX(percentage) as max_perc FROM work_ord_job_tb WHERE staff_id =".$emp_id." AND work_ord_id = ".$work_id)->result();
        $work_orders = $this->db->query("SELECT work_ord_id FROM work_ord_job_tb WHERE staff_id = ".$emp_id)->result_array();
            if (!empty($work_orders)) {
             $work_order_ids = array_column($work_orders, 'work_ord_id');
             $work_order_ids_str = implode(',', $work_order_ids);

        $data['percentage'] = $this->db->query("SELECT work_ord_id, MAX(percentage) as max_perc FROM work_ord_job_tb WHERE staff_id = ".$emp_id." AND work_ord_id IN (".$work_order_ids_str.")GROUP BY work_ord_id")->result();
        } else {
         $data['percentage'] = [];
        }


        // echo '<pre>';print_r($data);exit();
        $this->load->view('projects/my_work',$data);
        
    }
 public function progress($id = 0){
    $data['progress']= $this->db->query('SELECT WO.work_ord_id,C.cust_name,I.name FROM work_order_tb WO LEFT OUTER JOIN customer_tb C ON C.cust_id = WO.cust_id LEFT OUTER JOIN item_service_tb I ON I.item_id = WO.service_id  WHERE WO.work_ord_id='.$id)->result();
    $data['item_array'] = $this->db->query("SELECT LI.*,I.name FROM lead_item LI LEFT OUTER JOIN work_order_tb W ON W.work_ord_id=LI.lead_id LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id WHERE W.work_ord_id=".$id)->result();
    $data['percentage'] =$this->db->query("SELECT  MAX(percentage) as max_perc FROM work_ord_job_tb WHERE work_ord_id = $id ")->result();

    // echo '<pre>';print_r($data);exit();
    // if($id!=0)
    // {
    // $data['progress']= $this->db->query('SELECT WO.work_ord_id,C.cust_name,I.name FROM work_order_tb WO LEFT OUTER JOIN customer_tb C ON C.cust_id = WO.cust_id LEFT OUTER JOIN item_service_tb I ON I.item_id = WO.service_id LEFT OUTER JOIN work_ord_job_tb WJ ON WJ.work_ord_id = WO.work_ord_id WHERE WJ.work_ord_id='.$id)->result();
    // $data['item_array'] = $this->db->query("SELECT LI.*,I.name FROM lead_item LI LEFT OUTER JOIN work_order_tb W ON W.work_ord_id=LI.lead_id LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id WHERE W.work_ord_id=".$id)->result();
    // }
    //  echo '<pre>';print_r($data);exit();

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
        'stop' => date('Y-m-d H:i:s') 
    ];
    $max_job_id = $this->db->query("SELECT MAX(job_id) AS max_jobid FROM work_ord_job_tb WHERE work_ord_id =".$work_ord_id)->row()->max_jobid;
    $this->db->update('work_ord_job_tb',$data,array('job_id'=>$max_job_id));

   
    echo json_encode(["status" => "success"]);
 }
 public function update_status() {
    $work_ord_id = $this->input->post('work_ord_id');
    $status = $this->input->post('status');
    $data = array(
        'status' => $status
    );
    $message = 'success';
    // $this->db->where('work_rqst_id', $work_rqst_id);
    $this->db->update('work_order_tb', $data,array('work_ord_id'=>$work_ord_id));
    echo json_encode($message);
}

}