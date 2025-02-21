<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f9ff; /* Light blue background */
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #007bff; 
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            color: white;
            padding: 12px 15px;
            text-decoration: none;
            display: block;
            font-weight: bold;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }

         .dropdown {
            display: none;
            background-color: #007bff;
            padding: 12px 15px;
        }

        .dropdown a {
             padding: 8px 8px 8px 30px;
            display: block;
        }
        .dropdown a:hover{
            background-color: #0056b3;

        }
        .dropdown a:hover .arrow-left{
        display: inline-block;
        transform: rotate(270deg); 
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
        }
        .card-body {
            background-color: #e6f0ff;
        }
        .card-title {
            color: #007bff;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h4 {
            color: #007bff;
        }
        .chart-container {
            width: 100%;
            max-width: 300px;
            margin: auto;
        }
        .arrow {
        display: inline-block;
        transition: transform 0.3s ease;
        }

        #projects-link:hover .arrow {
        transform: rotate(180deg);
        }
        .arrow-left{
        display: inline-block;
        transition: transform 0.3s ease;
        }
        .header{
            color:white;
            font-weight:bold;
        }

    </style>
</head>
<body>

<div class="sidebar">
<h4 class="text-center header">PROJEX</h4> 
    <a href="<?=base_url();?>dashboard">Dashboard</a>
    <a href="#" id="projects-link">Projects <span class="arrow">▼</span></a>
    <div class="dropdown" id="projects-dropdown"> 
        <a href="<?=base_url();?>project/work_request"><span class="arrow-left">▼ </span> Work Request</a>
        <a href="<?=base_url();?>project/estimate"><span class="arrow-left">▼ </span> Work Estimate</a>
        <a href="<?=base_url();?>project/quotation"><span class="arrow-left">▼ </span> WORK Quotation</a>
        <a href="<?=base_url();?>project/work_order"><span class="arrow-left">▼ </span> WORK Order</a>
    </div>
    <a href="<?=base_url();?>employee">Employee</a>
    <a href="<?=base_url();?>customer">Customer</a>
    <a href="<?=base_url();?>items_service">Items/Works</a>
    <a href="#">Documents</a>
    <a href="<?=base_url();?>logout">Logout</a>
</div>

<div class="content">
    <div class="container">
        <div class="row">
            <!-- Left Section: Overview -->
            <div class="col-md-8">
                <h4>Overview</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Incoming Projects</h5>
                                <p class="card-text"><?=$inc_project?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Estimates </h5>
                                <p class="card-text" ><?=$estimate?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Running Projects</h5>
                                <p class="card-text" ><?=$running_project?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Completed Projects</h5>
                                <p class="card-text" ><?=$complete_project?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section: Work Completion Chart -->
            <div class="col-md-4">
                <h4>Work Completion</h4>
                <div class="chart-container">
                    <canvas id="workCompletionChart" style="height: 300px; width:300px;"></canvas>
                </div>
            </div>
        </div>

    
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Latest Work/Service Done</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Sl no</th>
                                <th>Employee</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                    <?php $sl_no = 1;
                        foreach ($employee as $e) { ?>
                    <tr>
                        <td><?= $sl_no ?></td>
                        <td><?= $e->emp_name ?></td>
                        <td><?= $e->name ?></td>
                        <td><? ?></td>  
                        <td><?= $e->status ?></td>  
                    </tr>
                    <?php $sl_no++; } ?>
                </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
      document.addEventListener("DOMContentLoaded", function () {
        let projectsLink = document.getElementById("projects-link");
        let dropdown = document.getElementById("projects-dropdown");

        projectsLink.addEventListener("click", function (event) {
            event.preventDefault();
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function (event) {
            if (!projectsLink.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = "none";
            }
        });
    });
   

    // Work Completion Chart
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('workCompletionChart').getContext('2d');

        // Get data from PHP
        let estimates = <?= $estimate ?>;
        let quotations = <?= $quotation?>;
        let workOrders = <?= $work_order ?>;

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Estimates', 'Quotations', 'Work Orders'],
                datasets: [{
                    data: [estimates, quotations, workOrders],
                    backgroundColor: ['#28a745', '#ffc107', '#007bff']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });

</script>

</body>
</html>
