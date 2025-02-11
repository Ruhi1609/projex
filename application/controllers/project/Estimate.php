<?php
class Estimate extends CI_Controller{
    public function index(){

        $data['leads'] = $this->db->query("SELECT * FROM lead_tb")->result();
        // echo '<pre>'; print_r($data['leads']); exit();
        $this->load->view('projects/estimate/list',$data);

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
    function process()
    {
        $this->load->library('session');
        $data=$_POST;
        print_r($data);
        $lead_array =[
            'type'  => 'ESTIMATE',
            'cust_id'  => $data['customer'],
            'lead_number'  => $data['estimate_number'],
            'date'  => $data['estimate_date'],
            'login_id'  => $this->session->userdata('login_id'),
        ];
        echo '<pre>'; print_r($lead_array);
        $this->db->insert('lead_tb',$lead_array);
        // $data=$this->load->view('projects/estimate/list', $data); 

    }
    public function get_estimates()
    {
        $query = $this->db->get('lead_tb'); 
        return $query->result();
    }
}