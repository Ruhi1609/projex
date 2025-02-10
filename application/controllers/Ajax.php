<?php
class Ajax extends CI_Controller{
    function get_item_data($item_id=''){
        $query = $this->db->query("SELECT * FROM item_service_tb WHERE item_id=".$item_id);
        $item = $query->row();
    
        if ($item) {
            echo json_encode(["success" => true, "data" => $item]);
        } else {
            echo json_encode(["success" => false]);
        }

    }
    function get_service_data($item_id=''){
        $query = $this->db->query("SELECT price FROM item_service_tb WHERE item_id=".$item_id);
        $service = $query->row()->price;
    
        if ($service) {
            echo json_encode(["success" => true, "data" => $service]);
        } else {
            echo json_encode(["success" => false]);
        }

    }
}