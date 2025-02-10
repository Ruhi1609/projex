<?php
class Employee extends CI_Controller {
    public function index() {
        $employees = $this->db->query("SELECT E.*,C.email,C.phone FROM employee_tb E JOIN contact_tb C ON C.contact_id = E.contact_id ")->result();
        // echo '<pre>'; print_r($employees);exit();
        $this->load->view('Employee/list',['employees'=> $employees]);

    }
    function add(){
        $this->load->view('Employee/form');
    }
    function process() {
        $data = $_POST;
        // echo '<pre>'; print_r($data);exit();
        if($data['emp_id'] ){
            $contact_id = $data['contact_id'];
            $emp_data =[
                "gender"     =>$data['gender'],
                "dob"        =>$data['dob'],
                "email"      =>$data['mail'],
                "phone"      =>$data['phone'],
                "address"    =>$data['address'],
                "district_id"=>$data['district'],
                "state_id"   =>$data['state']
            ];
            $this->db->update("contact_tb",$emp_data, array("contact_id"=> $contact_id));
            $login_id = $data['login_id'];
            $login_data = [
                "email" =>$data['mail'],
                "password" =>$data['password'],
                "type"     =>'employee'
            ];
            $this->db->update("login",$login_data,array("login_id"=>$login_id));

            // $login_id=$this->db->insert_id();
            $emp_id=$data['emp_id'];
            $employee = [
                "emp_name"    => $data['name'],
                "emp_code"    => $data['emp_code'],
                "dept_id"     =>$data['department'],
                "position_id" => $data['emp_position'],
                "salary"      => $data['salary'],
                "salary_type" => $data['salary_type'],
                "type"        =>$data['emp_type'],
                // "contact_id"  =>$contact_id,
                // "login_id"       =>$login_id
            ];
            $this->db->update("employee_tb", $employee,array("emp_id"=>$emp_id));
        }
        else{
            $emp_data =[
                "gender"     =>$data['gender'],
                "dob"        =>$data['dob'],
                "email"      =>$data['mail'],
                "phone"      =>$data['phone'],
                "address"    =>$data['address'],
                "district_id"=>$data['district'],
                "state_id"   =>$data['state']
            ];
            $this->db->insert("contact_tb", $emp_data);
            $contact_id = $this->db->insert_id(); // Get the insert ID
            $login_data = [
                "email" =>$data['mail'],
                "password" =>$data['password'],
                "type"     =>'employee'
            ];
            $this->db->insert("login",$login_data);
            $login_id=$this->db->insert_id();
            $employee = [
                "emp_name"    => $data['name'],
                "emp_code"    => $data['emp_code'],
                "dept_id"     =>$data['department'],
                "position_id" => $data['emp_position'],
                "salary"      => $data['salary'],
                "salary_type" => $data['salary_type'],
                "type"        =>$data['emp_type'],
                "contact_id"  =>$contact_id,
                "login_id"       =>$login_id
            ];
            $this->db->insert("employee_tb", $employee);
        }
        
        $this->index();    
    }
    function edit($emp_id=0){
        
        $data['employees'] = $this->db->query("SELECT E.*,C.phone,C.email,C.address,C.state_id,C.district_id,C.gender,C.dob,C.phone,C.email,L.password FROM employee_tb E JOIN contact_tb C ON C.contact_id=E.contact_id JOIN login L ON L.login_id = E.login_id WHERE E.emp_id = $emp_id")->result();
        // echo '<pre>'; print_r($data);
        $this->load->view('employee/form',$data);
    }
    public function delete($emp_id = 0) {
        $this->db->where('emp_id', $emp_id);
        $query = $this->db->get('employee_tb');
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
    
            $this->db->where('emp_id', $emp_id);
            $this->db->delete('employee_tb');
        }
    
        // Redirect or refresh
        redirect('employee/index');
    }
    
}