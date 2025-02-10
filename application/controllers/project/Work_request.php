<?php
class Work_request extends CI_Controller {
  public function index() {
    // $data = $this->db->query("SELECT * FROM work_request")->result();
    $data['services'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'service'")->result();
    $data['cust_service'] = $this->db->query("SELECT C.cust_name,W.*,I.name FROM work_request W JOIN item_service_tb I on I.item_id = W.item_id LEFT OUTER JOIN customer_tb C ON C.cust_id = W.cust_id")->result();

    $this->load->view('Projects/work_request',$data);
    }
     function process(){
        $this->load->library('session');
        $data=$_POST;
        $login_id = $this->session->userdata('login_id');
        $cust_id = $this->db->query("SELECT C.cust_id FROM customer_tb C LEFT OUTER JOIN login L on L.login_id = C.login_id WHERE L.login_id =" .$login_id )->row()->cust_id;

            $work_request=[
                "item_id" => $data['service_id'],
                "notes"   => $data['notes'],
                "cust_id" => $cust_id
            ];
            $this->db->insert("work_request", $work_request);
            redirect('Cust_dashboard');

    }
    function delete($work_rqst_id=0){
        $this->db->query("DELETE  FROM work_request where work_rqst_id=$work_rqst_id");
        redirect('Cust_dashboard');

    }
    public function update_status() {
        $work_rqst_id = $this->input->post('work_rqst_id');
        $status = $this->input->post('status');
        $data = array(
            'status' => $status
        );
        $message = 'success';
        // $this->db->where('work_rqst_id', $work_rqst_id);
        $this->db->update('work_request', $data,array('work_rqst_id'=>$work_rqst_id));
        echo json_encode($message);
    }
    
    

}