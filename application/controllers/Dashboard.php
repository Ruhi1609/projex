<?php
class Dashboard extends CI_Controller {
    public function index() {
        // Data for the overview and deals section (this can be fetched from the database)
        $data = [
            'draftWorksCount' => 5,
            'completedWorksCount' => 10,
            'deals' => [
                ['customer' => 'John Doe', 'item' => 'Web Design', 'status' => 'Pending'],
                ['customer' => 'Jane Smith', 'item' => 'SEO Service', 'status' => 'Completed'],
                ['customer' => 'Mark Lee', 'item' => 'Mobile App', 'status' => 'Pending']
            ]
        ];

        // Load the view and pass the data
        $this->load->view('Dashboard', $data);
    }
}