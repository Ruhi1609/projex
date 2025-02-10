<?php
class Estimate extends CI_Controller{
    public function index(){
    
        $this->load->view('projects/estimate/list');

    }
    function add(){
        $data['services'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['items']    = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        // echo '<pre>'; print_r($data);exit();
        $this->load->view('projects/estimate/form',$data);
    }
    public function get_all_items()
    {
        return $this->db->get('item_service_tb')->result();
    }
}