<?php
class Estimate extends CI_Controller{
    public function index(){

        $data['leads'] = $this->db->query("SELECT L.*,C.cust_name FROM lead_tb L LEFT OUTER JOIN customer_tb C ON C.cust_id = L.cust_id WHERE L.type='ESTIMATE'")->result();
        // echo '<pre>';print_r($data); exit();
        $this->load->view('projects/estimate/list',$data);

    }
    function add($id=0){ 
        $data['services'] = $this->db->query("SELECT name,item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['items']    = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        $data['mode']  = 'add';
        if($id)
        {
            $data['request'] = $this->db->query("SELECT W.*,C.cust_name,I.item_id,I.price FROM work_request W JOIN customer_tb C ON C.cust_id = W.cust_id  LEFT OUTER JOIN item_service_tb I ON I.item_id = W.item_id  WHERE W.work_rqst_id = $id")->result();
            // $data['lead_item'] = $this->db->query("SELECT * FROM lead_item WHERE lead_id = $id")->result();
            $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
            $data['services'] = $this->db->query("SELECT name,item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
            $data['service_id']    = $this->db->query("SELECT item_id FROM work_request WHERE work_rqst_id=".$id)->row()->item_id;
            }
            // echo '<pre>';print_r($data['request']);exit();
    
        $this->load->view('projects/estimate/form_new',$data);
    }
    public function get_all_items()
    {
        return $this->db->get('item_service_tb')->result();
    }
    function process()
    {
        $this->load->library('session');
        $data=$_POST;
        $mode= $data['mode'];
        // echo '<pre>';print_r($data);exit();

        if($mode =='add'){
        $lead_array =[
            'type'  => 'ESTIMATE',
            'cust_id'  => $data['customer'],
            'lead_number'  => $data['estimate_number'],
            'date'  => $data['estimate_date'],
            'amount' =>$data['total_est_amount'],
            'login_id'  => $this->session->userdata('login_id'),
            'service_id' =>$data['service']

        ];
        $this->db->insert('lead_tb',$lead_array);

        $lead_id = $this->db->insert_id(); 
        $lead_items = [];
        $item_ids = $data['item_id']; 
        $quantities = $data['quantity']; 
        $amounts = $data['amount']; 
        $price =$data['price'];

        
        foreach ($item_ids as $key => $item_id) {
            $lead_items[] = [
                'item_id'  => $item_id,
                'quantity' => $quantities[$key],
                'amount'   => $amounts[$key],
                'lead_id'  => $lead_id,
                'price'    => $price[$key]
            ];
        }
       
        foreach ($lead_items as $row) {
            $this->db->insert('lead_item', $row);
        }
    }
    else{
        $lead_id= $data['lead_id'];
        $lead_array =[
            'type'  => 'ESTIMATE',
            'cust_id'  => $data['customer'],
            'lead_number'  => $data['estimate_number'],
            'date'  => $data['estimate_date'],
            'amount' =>$data['total_est_amount'],
            'login_id'  => $this->session->userdata('login_id'),
            'service_id' =>$data['service']

        ];
        $this->db->update('lead_tb',$lead_array,array("lead_id" =>$lead_id));
        $lead_items = [];
        $item_ids = $data['item_id']; 
        $quantities = $data['quantity']; 
        $amounts = $data['amount']; 
        $price =$data['price'];
        
        foreach ($item_ids as $key => $item_id) {
            $lead_items[] = [
                'item_id'  => $item_id,
                'quantity' => $quantities[$key],
                'amount'   => $amounts[$key],
                'lead_id'  => $lead_id,
                'price'    => $price[$key]
            ];
        }
        
        foreach ($lead_items as $row) 
        {
            $this->db->update('lead_item', $row,array("lead_id" => $lead_id));
        }
    }
        //  $data=$this->load->view('projects/estimate/list', $data); 
        redirect("project/Estimate");

    }
    public function get_estimates()
    {
        $query = $this->db->get('lead_tb'); 
        return $query->result();
    }
    public function delete_estimate($lead_id) {
        $this->db->query("DELETE  FROM lead_tb where lead_id = $lead_id");
        $this->db->query("DELETE  FROM lead_item where lead_id = $lead_id");
        redirect("project/estimate");
    }
    function edit($lead_id){
        $data['lead'] = $this->db->query("SELECT L.*,C.cust_name,I.item_id,I.price FROM lead_tb L JOIN customer_tb C ON C.cust_id = L.cust_id LEFT OUTER JOIN lead_item LI ON LI.lead_id = L.lead_id LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE L.lead_id = $lead_id")->result();
        $data['lead_item'] = $this->db->query("SELECT * FROM lead_item WHERE lead_id = $lead_id")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['services'] = $this->db->query("SELECT name,item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['items'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        $lead_query=$this->db->query("SELECT I.item_id,I.name,I.price AS item_price,LI.*  FROM lead_item LI  LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE LI.lead_id = $lead_id")->result();
        $count    = count($lead_query);
        $slno     =1;
        $lead_data ='';
        $data['mode']  = 'edit';   
        foreach($lead_query as $l)
        {
            $lead_data  .=  '<tr id="row_'.$count.'">';
            $lead_data  .=  '<td><label>'.$slno.'</label></td>' ;
            $lead_data  .=  '<td>'.$l->name.'</td>';
            $lead_data  .=  '<td><input type="hidden" name="item_id[]" value="'.$l->item_id.'">';
            $lead_data  .=  '<input type="number" name="quantity[]"  onchange="updateAmount(this, '.$l->item_price.')" class="form-control quantity" min="1" value="'.$l->quantity.'">
                            </td>';
            $lead_data  .= '<td><input type="hidden" name="price[] value="'.$l->item_price.'">'.$l->item_price.'</td>';
            $lead_data  .=  '<td>
                             <input type="text" name="amount[]" class="form-control amount" value="'.$l->amount.'" readonly>
                            </td>';
            $lead_data  .= '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(${item.item_id})">Remove</button></td>';
            $lead_data  .=  '</tr>';
        }
        $data['lead_data']=$lead_data;
        $data['service_id']    = $this->db->query("SELECT service_id FROM lead_tb WHERE lead_id=".$lead_id)->row()->service_id;
        $this->load->view('projects/estimate/form_new',$data);
    }
    function delete($lead_id=0){
        $this->db->query("DELETE  FROM lead_tb where lead_id = $lead_id");
        $this->index();

    }  
    function preview($lead_id=0)
{
    $data['lead'] = $this->db->query("
    SELECT L.*,C.cust_name,CO.email,CO.phone,CO.address,I.name as service_name,I.price
    FROM lead_tb L 
    JOIN customer_tb C ON C.cust_id = L.cust_id 
    LEFT OUTER JOIN item_service_tb I ON I.item_id = L.service_id 
    LEFT OUTER JOIN contact_tb CO ON CO.contact_id = C.contact_id 
    WHERE L.lead_id = $lead_id")->result();
    $data['lead_item']= $this->db->query("
    SELECT LI.*,I.name FROM lead_item LI LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id 
    WHERE LI.lead_id= $lead_id")->result();
    // echo '<pre>';print_r($data);exit();
    $this->load->view('projects/estimate/preview',$data);
}   
}