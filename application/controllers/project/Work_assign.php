<?php
class Work_assign extends CI_Controller{
        public function add($id=0)
        {
            $data['staff']      = $this->db->query("SELECT emp_id,emp_name,dept_id,position_id FROM employee_tb ")->result();
            $data['work_order'] =$this->db->query("SELECT W.work_ord_id,W.w_number,W.date,C.cust_name,I.name,CO.address,CO.phone FROM work_order_tb W LEFT OUTER JOIN customer_tb C ON W.cust_id=C.cust_id LEFT OUTER JOIN item_service_tb I ON I.item_id=W.service_id  LEFT OUTER JOIN contact_tb CO ON CO.contact_id=C.contact_id WHERE work_ord_id=$id")->result();
            $data['work_assign']=$this->db->query("SELECT work_ord_id,item_id,job_number FROM work_ord_job_tb ")->result();

            //  echo '<pre>';print_r($data);exit();
        $this->load->view('projects/work_assign',$data);

        }
        function process(){
        $this->load->library('session');
        $data=$_POST;
        // echo '<prev>';print_r($data);exit();
        // $mode=$data['mode'];
        // if($mode== 'add')
        // {
            $work_ord_id = $data['work_ord_id'];
            $work_assign_array=[
                'staff_id' =>$data['staff_id'],
            ];
            $this->db->update('work_order_tb',$work_assign_array,array('work_ord_id'=>$work_ord_id));
            redirect("project/work_order");
        // }

    }
}

        
           