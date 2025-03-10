<?php
class Signup extends CI_Controller {   
public function index(){
    $this->load->view("signup_new");
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
        "email"  =>$data['email'],
        "phone" => $data['contact'],
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
    $cust_id = $this->db->insert_id();

    // Handle profile picture upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $config['upload_path'] = 'profile/'; // Target folder
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name'] = $cust_id . '.jpg'; // File saved as cust_id.jpg
        $config['overwrite'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_picture')) {
            $uploadData = $this->upload->data();
            $profileImage = 'profile/' . $uploadData['file_name'];

            // Update customer profile with the image path
            $this->db->where('cust_id', $cust_id);
            $this->db->update('customer_tb', ['profile_picture' => $profileImage]);
        } else {
            $error = $this->upload->display_errors();
            echo "Profile picture upload failed: " . $error;
            return;
        }
    }

    if ($result) {
        redirect("login");
    }
}


}