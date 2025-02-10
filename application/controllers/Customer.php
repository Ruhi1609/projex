<?php
class Customer extends CI_Controller{
    public function index() {
        $customer = $this->db->query("SELECT C.*,CO.email,CO.phone FROM customer_tb C JOIN contact_tb CO on CO.contact_id = C.contact_id ")->result();
        $this->load->view('Customer/list',['customer'=> $customer]);

    }

    function add(){
        $this->load->view('customer/form');
    }
    function process(){
        $data=$_POST;
        // echo'<pre>'; print_r($data); exit();
            if($data['cust_id']){
                $cust_data=[
                    "gender"     =>$data['gender'],
                    "dob"        =>$data['dob'],
                    "email"      =>$data['mail'],
                    "phone"      =>$data['phone'],
                    "address"    =>$data['address'],
                    "district_id"=>$data['district'],
                    "state_id"   =>$data['state']
                ];
                $contact_id = $data['contact_id']; 

                $this->db->update("contact_tb", $cust_data, array("contact_id"=> $contact_id));
                $login_data = [
                    "email" =>$data['mail'],
                    "password" =>$data['password'],
                    "type"     =>'customer'
                ];
                $login_id = $data['login_id'];
                $this->db->update("login",$login_data,array("login_id"=>$login_id));
               
                $customer = [
                    "cust_name"    => $data['name'],
                    "contact_id"  =>$contact_id,
                    "login_id"       =>$login_id
                ];
                $cust_id = $data['cust_id'];
                $this->db->update("customer_tb", $customer,array("cust_id"=>$cust_id));
            }
            else{
                $cust_data=[
                    "gender"     =>$data['gender'],
                    "dob"        =>$data['dob'],
                    "email"      =>$data['mail'],
                    "phone"      =>$data['phone'],
                    "address"    =>$data['address'],
                    "district_id"=>$data['district'],
                    "state_id"   =>$data['state']
                ];
                $this->db->insert("contact_tb", $cust_data);
                $contact_id = $this->db->insert_id(); // Get the insert ID
                $login_data = [
                    "email" =>$data['mail'],
                    "password" =>$data['password'],
                    "type"     =>'customer'
                ];
                $this->db->insert("login",$login_data);
                $login_id=$this->db->insert_id();
                $customer = [
                    "cust_name"    => $data['name'],
                    "contact_id"  =>$contact_id,
                    "login_id"       =>$login_id
                ];
                $this->db->insert("customer_tb", $customer);
            }
        
        $this->index();

    }
    function edit($cust_id=0){
        
        $data['customer'] = $this->db->query("SELECT E.*,C.phone,C.email,C.address,C.state_id,C.district_id,C.gender,C.dob,C.phone,C.email,L.password FROM customer_tb E JOIN contact_tb C ON C.contact_id=E.contact_id JOIN login L ON L.login_id = E.login_id WHERE E.cust_id = $cust_id")->result();
        // echo '<pre>'; print_r($data);
        $this->load->view('customer/form',$data);
    }
    public function delete($cust_id = 0) {
        $this->db->where('cust_id', $cust_id);
        $query = $this->db->get('customer_tb');
        $result = $query->row();
    
        if ($result) {
            if (!empty($result->contact_id)) {
                $this->db->where('contact_id', $result->contact_id);
                $this->db->delete('contact_tb');
            }
    
            if (!empty($result->login_id)) {
                $this->db->where('login_id', $result->login_id);
                $this->db->delete('login');
            }
    
            $this->db->where('cust_id', $cust_id);
            $this->db->delete('customer_tb');
        }
    
        // Redirect or refresh
        redirect('customer/index');
    }
}