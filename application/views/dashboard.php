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
            background-color: #f1f9ff; 
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
            font-weight :700;
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
        .card {
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s, box-shadow 0.3s;
        background: linear-gradient(135deg, #ffffff, #e6f0ff);
        padding: 15px;
    }
    .card:hover {
        transform: scale(1.08);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
    }
    .card-body {
        display: flex;
        align-items: center;
    }
    .card-title {
        color: #007bff;
        font-size: 1.3rem;
        font-weight: bold;
        text-align: left;
        margin-left: 10px;
    }
    .card-text {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        text-align: right;
        flex-grow: 1;
    }
    .icon {
        font-size: 2rem;
        color: #007bff;
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
    <a href="<?=base_url();?>logout">Logout</a>
</div>

<div class="content">
    <div class="container">
    <h2 class="text">WELCOME <strong><?=strtoupper($admin)?> !</strong></h2>
    <h4>Overview </h4>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon fas fa-folder-open"></i>
                                <h5 class="card-title">Incoming Projects</h5>
                                <p class="card-text" id="inc_project">000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon fas fa-file-alt"></i>
                                <h5 class="card-title">Total Estimates</h5>
                                <p class="card-text" id="estimate">000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon fas fa-tasks"></i>
                                <h5 class="card-title">Running Projects</h5>
                                <p class="card-text" id="running_project">000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon fas fa-check-circle"></i>
                                <h5 class="card-title">Completed Projects</h5>
                                <p class="card-text" id="complete_project">000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center">
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
                                <th>Date/Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl_no = 1; foreach ($employee as $e) { ?>
                            <tr>
                                <td><?= $sl_no ?></td>
                                <td><?= $e->emp_name ?></td>
                                <td><?= $e->name ?></td>
                                <td><?= $e->max_stop_date ?></td>  
                                <td><?= $e->status ?></td>  
                            </tr>
                            <?php $sl_no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
    function animateNumber(id, target) {
        let current = 100;
        let duration = 3000; 
        let stepTime = Math.abs(Math.floor(duration / (target - current)));
        let interval = setInterval(() => {
            current++;
            if (current >= target) {
                current = target;
                clearInterval(interval);
            }
            document.getElementById(id).textContent = current.toString().padStart(3, '0');
        }, stepTime);
    }
    document.addEventListener("DOMContentLoaded", function () {
        animateNumber("inc_project", <?=$inc_project?>);
        animateNumber("estimate", <?=$estimate?>);
        animateNumber("running_project", <?=$running_project?>);
        animateNumber("complete_project", <?=$complete_project?>);
    });   
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('workCompletionChart').getContext('2d');
    let estimates = <?= $estimate ?>;
    let quotations = <?= $quotation ?>;
    let workOrders = <?= $work_order ?>;
    new Chart(ctx, {
        type: 'doughnut', 
        data: {
            labels: ['Estimates', 'Quotations', 'Work Orders'],
            datasets: [{
                data: [estimates, quotations, workOrders],
                backgroundColor: ['#28a745', '#ffc107', '#007bff'],
                borderColor: '#fff', 
                borderWidth: 2,
                hoverOffset: 10 
            }]
        },
        options: {
            responsive: true,
            cutout: '60%', 
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#333'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let value = tooltipItem.raw;
                            let total = estimates + quotations + workOrders;
                            let percentage = ((value / total) * 100).toFixed(1);
                            return `${tooltipItem.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
});

// Work Completion Chart - Professional Half-Pie (Semi-Circle Doughnut Chart)
// document.addEventListener("DOMContentLoaded", function() {
//     const ctx = document.getElementById('workCompletionChart').getContext('2d');

//     let estimates = <?= $estimate ?>;
//     let quotations = <?= $quotation ?>;
//     let workOrders = <?= $work_order ?>;
//     let total = estimates + quotations + workOrders;

//     new Chart(ctx, {
//         type: 'doughnut', // Using doughnut but modifying it to look like a half-pie
//         data: {
//             labels: ['Estimates', 'Quotations', 'Work Orders'],
//             datasets: [{
//                 data: [estimates, quotations, workOrders],
//                 backgroundColor: ['#007bff', '#28a745', '#ffc107'],
//                 borderWidth: 2,
//                 borderColor: '#fff',
//                 hoverOffset: 8,
//             }]
//         },
//         options: {
//             responsive: true,
//             cutout: '70%', // Creates the doughnut effect
//             rotation: -90, // Rotates the chart to start from the bottom
//             circumference: 180, // Makes it a half-pie chart
//             plugins: {
//                 legend: {
//                     position: 'top',
//                     labels: {
//                         font: {
//                             size: 14,
//                             weight: 'bold'
//                         },
//                         color: '#333'
//                     }
//                 },
//                 tooltip: {
//                     callbacks: {
//                         label: function(tooltipItem) {
//                             let value = tooltipItem.raw;
//                             let percentage = ((value / total) * 100).toFixed(1);
//                             return `${tooltipItem.label}: ${value} (${percentage}%)`;
//                         }
//                     }
//                 }
//             },
//             animation: {
//                 animateScale: true,
//                 animateRotate: true
//             }
//         }
//     });
// });
</script>
</body>
</html>
