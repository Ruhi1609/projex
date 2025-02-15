<?php
class Work_assign extends CI_Controller{
        public function add($id=0)
        {
            $data['staff']      = $this->db->query("SELECT emp_id,emp_name,dept_id,position_id FROM employee_tb ")->result();
            $data['work_order'] =$this->db->query("SELECT W.w_number,W.date,C.cust_name,I.name,CO.address,CO.phone FROM work_order_tb W LEFT OUTER JOIN customer_tb C ON W.cust_id=C.cust_id LEFT OUTER JOIN item_service_tb I ON I.item_id=W.service_id  LEFT OUTER JOIN contact_tb CO ON CO.contact_id=C.contact_id WHERE work_ord_id=$id")->result();
        
            //  echo '<pre>';print_r($data);exit();
        $this->load->view('projects/work_assign',$data);

        }
}