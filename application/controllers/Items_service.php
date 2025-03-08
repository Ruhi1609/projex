<?php
class Items_service extends CI_Controller {
    public function index() {
        $items = $this->db->query("SELECT * FROM item_service_tb")->result();
        // echo '<pre>'; print_r($items);exit();
        $this->load->view('item_service/list',['items'=> $items]);
    }
    function  add(){
        $this->load->view('item_service/form');

    }
    function process(){
        $data = $_POST;
        // print_r($data); exit();
        if($data['item_id']){
            $item_id=$data['item_id'];
            $item = [
                "name" => $data['itemname'],
                "item_code" =>$data['itemcode'],
                "type" => $data['type'],
                "quantity" => $data['itemstock'],
                "price" =>$data['price'],
                "stock" =>$data['itemstock'],
                "category"=>$data['category']
            ];
            $this->db->update("item_service_tb", $item,array("item_id"=>$item_id));
           
        }else{
            $item = [
                "name" => $data['itemname'],
                "item_code" =>$data['itemcode'],
                "type" => $data['type'],
                "quantity" => $data['itemstock'],
                "price" =>$data['price'],
                "stock" =>$data['itemstock'],
                "category"=>$data['category']
            ];
            $this->db->insert("item_service_tb", $item);
           

        }
        $this->index();
        
    }

    function edit($item_id=0){
        $data['items'] = $this->db->query("SELECT * FROM item_service_tb WHERE item_id = $item_id")->result();

        $this->load->view('item_service/form',$data);


    }
    function delete($item_id=0){
        $this->db->query("DELETE  FROM item_service_tb where item_id=$item_id");
        $this->index();
    }
   
}