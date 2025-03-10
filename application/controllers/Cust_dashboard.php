<?php
class Cust_dashboard extends CI_Controller {
    
    public function index() {
        $this->load->library('session');
        $login_id = $this->session->userdata('login_id');
        // if($login_id == ''){
        //     redirect('login');
        // }
        $data['services'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'service'")->result();
        $cust_id = $this->db->query("SELECT C.cust_id FROM customer_tb C LEFT OUTER JOIN login L on L.login_id = C.login_id WHERE L.login_id =" .$login_id )->row()->cust_id;
        $data['cust_service'] = $this->db->query("SELECT W.notes, I.name,I.item_id,W.status,W.work_rqst_id FROM work_request W JOIN item_service_tb I on I.item_id = W.item_id  WHERE W.cust_id =".$cust_id)->result();
        $customer_details   = $this->db->query('SELECT C.cust_name,C.cust_id FROM customer_tb C LEFT OUTER JOIN login L ON L.login_id = C.login_id WHERE L.login_id ='.$login_id)->result();
        $data['customer_details'] = $customer_details;
        echo $login_id;
        // echo '<pre>';print_r($data['cust_service']); exit();
        $this->load->view('customer/cust_dashboard',$data);
    }
    function view_profile(){
        $this->load->library('session');
        $login_id = $this->session->userdata('login_id');
        $data['cust_id'] = $this->db->query("SELECT C.cust_id FROM customer_tb C LEFT OUTER JOIN login L on L.login_id = C.login_id WHERE L.login_id =" .$login_id )->row()->cust_id;
        $customer_details   = $this->db->query('SELECT C.cust_name,C.cust_id,CO.* FROM customer_tb C LEFT OUTER JOIN login L ON L.login_id = C.login_id LEFT OUTER JOIN contact_tb CO ON CO.contact_id = C.contact_id WHERE L.login_id ='.$login_id)->result();
        $data['customer_details'] = $customer_details;
        // echo '<pre>';print_r($data);exit();
        $this->load->view('customer/profile',$data);
    }
}
