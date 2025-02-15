<?php
class Work_order extends CI_Controller{
    public function index()
    {
        $data['work_order'] = $this->db->query("SELECT W.*,C.cust_name FROM work_order_tb W LEFT OUTER JOIN customer_tb C ON C.cust_id = W.cust_id ")->result();
        // echo '<pre>';print_r($data);exit();
   $this->load->view('projects/work_order/list',$data);
    }
    public function add($id=0)
    {
        $data['services'] = $this->db->query("SELECT name,item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['items']    = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        $data['mode']  = 'add';
        if($id)
        {
        $data['work_ord_id'] = '';
        $data['lead'] = $this->db->query("SELECT L.*,C.cust_name,I.item_id,I.price FROM lead_tb L JOIN customer_tb C ON C.cust_id = L.cust_id LEFT OUTER JOIN lead_item LI ON LI.lead_id = L.lead_id LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE L.lead_id = $id")->result();
        $data['lead_item'] = $this->db->query("SELECT * FROM lead_item WHERE lead_id = $id")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['services'] = $this->db->query("SELECT name,item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['items'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        $lead_query=$this->db->query("SELECT I.item_id,I.name,I.price AS item_price,LI.*  FROM lead_item LI  LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE LI.lead_id = $id")->result();
        $count    = count($lead_query);
        $slno     =1;
        $lead_data ='';
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
        $data['lead_data']     =$lead_data;
        $data['service_id']    = $this->db->query("SELECT service_id FROM lead_tb WHERE lead_id=".$id)->row()->service_id;
        }
        // echo '<pre>';print_r($data); exit();
        $this->load->view('projects/work_order/form',$data);
    }
    function process()
    {
        $this->load->library('session');
        $data=$_POST;
        // print_r($data);exit();
        $mode=$data['mode'];

        if($mode== 'add')
        {

            $work_ord_array= [
                 'work_ord_type' =>'WORK_ORDER',
                 'cust_id' => $data['customer'],
                 'w_number' => $data['work_order_number'],
                 'date' => $data['work_order_date'],
                 'amount' => $data['total_est_amount'],
                //  'login_id' => $this->session->userdata('login_id'),
                 'service_id' => $data['service'],
                 'lead_id' =>$data['laed_id']

            ];
            $this->db->insert('work_order_tb',$work_ord_array);
            $lead_id= $this->db->insert_id();
            $lead_items=[];
            $item_ids = $data['item_id'];
            $quantities =$data['quantity'];
            $amounts =$data['amount'];
            $price =$data['price'];

            foreach ($item_ids as $key => $item_id){
            $lead_items[]=[
                    'item_id'=> $item_id,
                    'quantity' => $quantities[$key],
                    'amount' => $amounts[$key],
                    'lead_id' =>$lead_id,
                    'price' =>$price[$key]
            ];
            foreach($lead_items as $row)
            $this->db->insert('lead_item',$row);

        }
    }

    else{
        $work_ord_id= $data['work_ord_id'];
        $work_ord_array= [
            'work_ord_type' =>'WORK_ORDER',
            'cust_id' => $data['customer'],
            'w_number' => $data['work_order_number'],
            'date' => $data['work_order_date'],
            'amount' => $data['total_est_amount'],
            // 'login_id' => $this->session->userdata('login_id'),
            'service_id' => $data['service'],
            'lead_id' =>$data['lead_id']
        ];
        $this->db->update('work_order_tb',$work_ord_array,array("work_ord_id"=>$work_ord_id));
        $lead_items = [];
        $item_ids = $data['item_id']; 
        $quantities = $data['quantity']; 
        $amounts = $data['amount']; 
        $price =$data['price'];
        
        foreach ($item_ids as $key => $item_id) {
            $lead_id= $data['lead_id'];
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
    redirect("project/work_order") ;
}
    function edit($work_ord_id){
        $data['lead'] = $this->db->query("SELECT W.*,C.cust_name,I.item_id,I.price FROM work_order_tb W JOIN customer_tb C ON C.cust_id = W.cust_id LEFT OUTER JOIN lead_item LI ON LI.lead_id = W.work_ord_id LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE W.work_ord_id = $work_ord_id")->result();
        $data['lead_item'] = $this->db->query("SELECT * FROM lead_item WHERE lead_id = $work_ord_id")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['services'] = $this->db->query("SELECT name,item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['items'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        $lead_query=$this->db->query("SELECT I.item_id,I.name,I.price AS item_price,LI.*  FROM lead_item LI  LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE LI.lead_id = $work_ord_id")->result();
        $count     = count($lead_query);
        $slno      =1;
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
        $data['lead_data']     =$lead_data;
        $data['service_id']    = $this->db->query("SELECT service_id FROM work_order_tb WHERE work_ord_id=".$work_ord_id)->row()->service_id;
        // echo '<pre>';print_r($data); exit();
        $this->load->view('projects/work_order/form',$data);
    }
function delete($lead_id=0){
    $this->db->query("DELETE  FROM lead_tb where lead_id = $lead_id");
    $this->index();

}  
}