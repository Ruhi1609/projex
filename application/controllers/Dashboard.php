<?php
class Dashboard extends CI_Controller {
    public function index() {
        $this->load->library('session');
        $login_id = $this->session->userdata('login_id');
        $data['admin'] = $this->db->query("SELECT username FROM login WHERE login_id =".$login_id)->row()->username;
    $incoming_projects = $this->db->query("SELECT * FROM work_request ")->result();
    $data['inc_project'] = count($incoming_projects);
    $estimate = $this->db->query("SELECT * FROM lead_tb WHERE type='ESTIMATE'")->result();
    $data['estimate'] = count($estimate);
    $quotation =$this->db->query("SELECT * FROM lead_tb WHERE type='QUOTATION'")->result();
    $data['quotation'] =count($quotation);
    $work_order=$this->db->query("SELECT * FROM work_order_tb")->result();
    $data['work_order']=count($work_order);
    $running_project =$this->db->query("SELECT * FROM work_order_tb WHERE status NOT IN ('completed') ")->result();
    $data['running_project'] = count($running_project);
    $complete_project =$this->db->query("SELECT * FROM work_order_tb WHERE status ='completed'")->result();
    $data['complete_project'] = count($complete_project);
    $data['employee']= $this->db->query("SELECT E.emp_name,I.name,W.status,MAX(WO.stop) AS max_stop_date FROM work_order_tb W LEFT OUTER JOIN item_service_tb I ON I.item_id = W.service_id LEFT OUTER JOIN employee_tb E ON E.emp_id=W.staff_id LEFT OUTER JOIN work_ord_job_tb WO ON WO.staff_id = E.emp_id ")->result();
    //  echo '<pre>';print_r($data['employee']);exit();
        $this->load->view('dashboard', $data);
       
    }
}