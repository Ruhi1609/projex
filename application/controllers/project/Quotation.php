<?php
class Quotation extends CI_Controller{
    public function index()
    {
        $data['quotation'] = $this->db->query("SELECT L.*,C.cust_name FROM lead_tb L LEFT OUTER JOIN customer_tb C ON C.cust_id = L.cust_id WHERE L.type='QUOTATION'")->result();
        // echo '<pre>';print_r($data);exit();
   $this->load->view('projects/quotation/list',$data);
    }

    public function add($id=0)
    {
        $data['services'] = $this->db->query("SELECT name,item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['items']    = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        $data['mode']     = 'add';
        if($id)
        {
        $data['lead'] = $this->db->query("SELECT L.*,C.cust_name,I.item_id,I.price FROM lead_tb L JOIN customer_tb C ON C.cust_id = L.cust_id LEFT OUTER JOIN lead_item LI ON LI.lead_id = L.lead_id LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE L.lead_id = $id")->result();
        $data['lead_item'] = $this->db->query("SELECT * FROM lead_item WHERE lead_id = $id")->result();
        $data['customer'] = $this->db->query("SELECT cust_id,cust_name FROM customer_tb")->result();
        $data['services'] = $this->db->query("SELECT name,item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['items'] = $this->db->query("SELECT name,item_id FROM item_service_tb WHERE type = 'product'")->result();
        $lead_query=$this->db->query("SELECT I.item_id,I.name,I.price AS item_price,LI.*  FROM lead_item LI  LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  WHERE LI.lead_id = $id")->result();
        $count    = count($lead_query);
        $slno     =1;
        $lead_data ='';
        foreach ($lead_query as $l) {
            $lead_data .= '<tr id="row_'.$count.'">';
            $lead_data .= '<td><label>'.$slno.'</label></td>';
            $lead_data .= '<td>'.$l->name.'</td>';
            $lead_data .= '<td>
                            <input type="hidden" name="item_id[]" value="'.$l->item_id.'">
                            <input type="number" name="quantity[]" onchange="updateAmount(this, '.$l->item_price.')" class="form-control quantity" min="1" value="'.$l->quantity.'">
                          </td>';
            $lead_data .= '<td><input type="hidden" name="price[]" value="'.$l->item_price.'">'.$l->item_price.'</td>';
            $lead_data  .= '<td><input type="text" name="amount[]" class="form-control amount" value="'.($l->quantity * $l->item_price).'" readonly></td>';
            $lead_data  .= '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('.$l->item_id.', '.$count.')">Remove</button></td>';

            $lead_data .= '</tr>';
    
            $slno++; 
        }
        $data['lead_data']=$lead_data;
        $data['service_id']    = $this->db->query("SELECT service_id FROM lead_tb WHERE lead_id=".$id)->row()->service_id;
        }
        $this->load->view('projects/quotation/form',$data);
    }

function process()
{
    $this->load->library('session');
    $data = $_POST;
    $mode = $data['mode'];

    if ($mode == 'add') {
        $lead_array = [
            'type'       => 'QUOTATION',
            'cust_id'    => $data['customer'],
            'lead_number'=> $data['quotation_number'],
            'date'       => $data['quotation_date'],
            'amount'     => $data['total_est_amount'],
            'login_id'   => $this->session->userdata('login_id'),
            'service_id' => $data['service'],
            'derived_id' => $data['lead_id']
        ];
        $this->db->insert('lead_tb', $lead_array);
        $lead_id = $this->db->insert_id();  
    } else {
        $lead_id = $data['lead_id']; 

        if (!$lead_id) {
            show_error("Invalid lead ID", 400);
            return;
        }

        $lead_array = [
            'type'       => 'QUOTATION',
            'cust_id'    => $data['customer'],
            'lead_number'=> $data['quotation_number'],
            'date'       => $data['quotation_date'],
            'amount'     => $data['total_est_amount'],
            'login_id'   => $this->session->userdata('login_id'),
            'service_id' => $data['service'],
            'derived_id' => $data['lead_id']
        ];
        $this->db->update('lead_tb', $lead_array, ["lead_id" => $lead_id]);
    }

    // Remove deleted items if provided
    if (!empty($data['removed_items'])) {
        $removed_items = json_decode($data['removed_items'], true);
        if (!empty($removed_items)) {
            $this->db->where_in('item_id', $removed_items);
            $this->db->where('lead_id', $lead_id);
            $this->db->delete('lead_item');
        }
    }

    $lead_items = [];
    $item_ids   = $data['item_id'] ?? [];
    $quantities = $data['quantity'] ?? [];
    $amounts    = $data['amount'] ?? [];
    $prices     = $data['price'] ?? [];

    foreach ($item_ids as $key => $item_id) {
        $lead_items[] = [
            'item_id'  => $item_id,
            'quantity' => $quantities[$key],
            'amount'   => $amounts[$key],
            'lead_id'  => $lead_id,
            'price'    => $prices[$key]
        ];
    }

    foreach ($lead_items as $row) {
        $existing = $this->db->get_where('lead_item', [
            'lead_id' => $lead_id,
            'item_id' => $row['item_id']
        ])->row();

        if ($existing) {
            $this->db->update('lead_item', $row, [
                "lead_id" => $lead_id, 
                "item_id" => $row['item_id']
            ]);
        } else {
            $this->db->insert('lead_item', $row);
        }
    }
    redirect("project/quotation");
}

    function edit($lead_id = 0){
        $data['lead'] = $this->db->query("
            SELECT L.*,C.cust_name,I.item_id,I.price 
            FROM lead_tb L 
            JOIN customer_tb C ON C.cust_id = L.cust_id 
            LEFT OUTER JOIN lead_item LI ON LI.lead_id = L.lead_id 
            LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  
            WHERE L.lead_id = $lead_id GROUP BY L.lead_id")->result();
    
        $data['lead_item'] = $this->db->query("SELECT * FROM lead_item WHERE lead_id = $lead_id")->result();
        $data['customer'] = $this->db->query("SELECT cust_id, cust_name FROM customer_tb")->result();
        $data['services'] = $this->db->query("SELECT name, item_id as service_id FROM item_service_tb WHERE type = 'service'")->result();
        $data['items'] = $this->db->query("SELECT name, item_id FROM item_service_tb WHERE type = 'product'")->result();
    
        $lead_query = $this->db->query("
            SELECT I.item_id, I.name, I.price AS item_price, LI.*  
            FROM lead_item LI  
            LEFT OUTER JOIN item_service_tb I ON I.item_id = LI.item_id  
            WHERE LI.lead_id = $lead_id")->result();
    
        $count = count($lead_query);
        $slno = 1;
        $lead_data = '';
        $data['mode'] = 'edit';
    
        foreach ($lead_query as $l) {
            $lead_data .= '<tr id="row_'.$count.'">';
            $lead_data .= '<td><label>'.$slno.'</label></td>';
            $lead_data .= '<td>'.$l->name.'</td>';
            $lead_data .= '<td>
                            <input type="hidden" name="item_id[]" value="'.$l->item_id.'">
                            <input type="number" name="quantity[]" onchange="updateAmount(this, '.$l->item_price.')" class="form-control quantity" min="1" value="'.$l->quantity.'">
                          </td>';
            $lead_data .= '<td><input type="hidden" name="price[]" value="'.$l->item_price.'">'.$l->item_price.'</td>';
            $lead_data  .= '<td><input type="text" name="amount[]" class="form-control amount" value="'.($l->quantity * $l->item_price).'" readonly></td>';
            $lead_data  .= '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('.$l->item_id.', '.$count.')">Remove</button></td>';

            $lead_data .= '</tr>';
    
            $slno++; 
        }
    
        $data['lead_data'] = $lead_data;
        $data['service_id'] = $this->db->query("SELECT service_id FROM lead_tb WHERE lead_id=".$lead_id)->row()->service_id;
        // echo '<pre>';print_r($data);exit();
        $this->load->view('projects/quotation/form',$data);
    }
    public function delete($lead_id = 0) {
        $lead = $this->db->get_where('lead_tb', ['lead_id' => $lead_id])->row();
    
        if ($lead) {
            $this->db->query("DELETE  FROM lead_tb where lead_id = $lead_id");
            $this->db->query("DELETE  FROM lead_item where lead_id = $lead_id");
            redirect('project/quotation?deleted=success'); 
        } else {
            redirect('project/quotation?deleted=error');
        }
    }
    
    
    
public function status()
{
    $lead_id = $this->input->post('lead_id');
    $confirm = $this->input->post('confirm'); 

    if ($lead_id !== null && ($confirm === '0' || $confirm === '1')) {
        $this->db->where('lead_id', $lead_id);
        $this->db->update('lead_tb', ['confirm' => $confirm]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode(["status" => "success", "confirm" => $confirm]);
        } else {
            echo json_encode(["status" => "error", "message" => "No rows updated"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid lead ID or confirmation value"]);
    }
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
    $this->load->view('projects/quotation/preview',$data);
}

}