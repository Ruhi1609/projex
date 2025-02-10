<?php
class Signup extends CI_Controller {   
public function index(){
    $this->load->view("sign_up");
}
public function sign_up(){
    $data = $_POST;

    // Encrypt the password using password_hash
    // $encrypted_password = password_hash($data['password'], PASSWORD_DEFAULT);

    // Prepare login data with encrypted password
    $login = [
        "email"    => $data['email'],
        "password" => $data['password'],
        "username" => $data['name'],
        "type"     => 'customer'
    ];
   
    // Insert data into the login table
    $this->db->insert("login", $login);
    $login_id = $this->db->insert_id(); // Get the insert ID

    // Prepare user details
    $userdetails = [
        "gender" => $data['gender'],
        "phone" => $data['contact'],
        "dob" => $data['dob'],
        "address" => $data['address'],
        "country_id" => $data['country'],
        "state_id" => $data['state'],
        "district_id" => $data['district'],
        "city" => $data['city'],
        "pin-code" => $data['pincode'],
        "login_id" => $login_id
    ];

    // Insert user details into the contact_tb table
    $this->db->insert("contact_tb", $userdetails);
    $result = $this->db->insert_id(); // Get the insert ID for user details
    $customer =[
        "cust_name"=> $data['name'],
        "contact_id" => $result,
        "login_id"=> $login_id
    ];
    $this->db->insert("customer_tb", $customer);

    if ($result) {
        // If the insert was successful, redirect to login page
        $this->load->view("login");
    }
}

}