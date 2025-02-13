<?php
class Estimate extends CI_Controller{
    public function index(){

        $data['leads'] = $this->db->query("SELECT L.*,C.cust_name FROM lead_tb L LEFT OUTER JOIN customer_tb C ON C.cust_id = L.cust_id")->result();
        // echo '<pre>'; print_r($data['leads']); exit();
        $this->load->view('projects/estimate/list',$data);

    }
    function add(){
        $data['services'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'service'")->result();
        // echo '<pre>'; print_r($data);exit();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['items']    = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        
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
        // echo $lead_id;
        
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
        // $service=[
        //     'item_id' => $data['service'],
        //     'amount' =>  $data['service_amount'],
        //     'lead_id'  => $lead_id
        // ];
        // $this->db->insert('lead_item', $service);
         $data=$this->load->view('projects/estimate/list', $data); 

    }
    public function get_estimates()
    {
        $query = $this->db->get('lead_tb'); 
        return $query->result();
    }
    public function delete_estimate($lead_id) {
        $this->db->where('lead_id', $lead_id);
        $this->db->delete('lead_tb'); 
    }
    function edit($lead_id){
        $data['lead'] = $this->db->query("SELECT L.*,C.cust_name,I.item_id,I.price FROM lead_tb L JOIN customer_tb C ON C.cust_id = L.cust_id LEFT OUTER JOIN lead_item LI ON LI.lead_id = L.lead_id LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE L.lead_id = $lead_id")->result();
        $data['lead_item'] = $this->db->query("SELECT * FROM lead_item WHERE lead_id = $lead_id")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['services'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['items'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();

        $lead_query=$this->db->query("SELECT I.item_id,I.name,LI.*  FROM lead_item LI  LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE LI.lead_id = $lead_id")->result();
        $count    = count($lead_query);
        $slno     =1;
        $lead_data ='';
        // echo '<pre>'; print_r($lead_query); exit();
        foreach($lead_query as $l)
        {
            $lead_data  .=  '<tr id="row_'.$count.'">';
            $lead_data  .=  '<td><label>'.$slno.'</label></td>' ;
            $lead_data  .=  '<td>'.$l->name.'</td>';
            $lead_data  .=  '<td><input type="hidden" name="item_id[]" value="'.$l->item_id.'">';
            $lead_data  .=  '<input type="number" name="quantity[]" class="form-control quantity" min="1" value="'.$l->quantity.'">
                            </td>';
            $lead_data  .= '<td><input type="hidden" name="price[] value="'.$l->price.'"'.$l->price.'</td>';
            $lead_data  .=  '<td>
                             <input type="text" name="amount[]" class="form-control amount" value="'.$l->amount.'" readonly>
                            </td>';
            $lead_data  .= '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(${item.item_id})">Remove</button></td>';
            $lead_data  .=  '</tr>';
        }
        $data['lead_data']=$lead_data;
        // echo '<pre>'; print_r($data); exit();
        $this->load->view('projects/estimate/form',$data);


    }
    function delete($lead_id=0){
        $this->db->query("DELETE  FROM lead_tb where lead_id = $lead_id");
        $this->index();

    }
    
}