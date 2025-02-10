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
            background-color: #007bff; /* Blue background */
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
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center">Admin Dashboard</h4>
    <a href="#">Dashboard</a>
    <a href="#">Projects</a>
    <a href="#">Employee</a>
    <a href="#">Customer</a>
    <a href="#">Items/Works</a>
    <a href="#">Documents</a>
    <a href="#">Logout</a>
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
                                <h5 class="card-title">Total Projects</h5>
                                <p class="card-text" id="totalProjects">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Running Projects</h5>
                                <p class="card-text" id="runningProjects">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Completed Projects</h5>
                                <p class="card-text" id="completedProjects">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Incoming Projects</h5>
                                <p class="card-text" id="incomingProjects">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section: Work Completion Chart -->
            <div class="col-md-4">
                <h4>Work Completion</h4>
                <div class="chart-container">
                    <canvas id="workCompletionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Latest Work/Service Done -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Latest Work/Service Done</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Employee</th>
                                <th>Service</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="latestWorkTable">
                            <!-- Latest work data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Sample data for the dashboard
    const totalProjects = 20;
    const runningProjects = 8;
    const completedProjects = 10;
    const incomingProjects = 2;

    const workCompletionPercentage = (completedProjects / totalProjects) * 100;

    const latestWork = [
        { employee: 'John Doe', service: 'Web Development', date: '2025-02-01' },
        { employee: 'Jane Smith', service: 'Graphic Design', date: '2025-02-02' },
        { employee: 'Mark Lee', service: 'SEO Optimization', date: '2025-02-03' }
    ];

    // Update Overview
    document.getElementById('totalProjects').textContent = totalProjects;
    document.getElementById('runningProjects').textContent = runningProjects;
    document.getElementById('completedProjects').textContent = completedProjects;
    document.getElementById('incomingProjects').textContent = incomingProjects;

    // Populate Latest Work Table
    const latestWorkTable = document.getElementById('latestWorkTable');
    latestWork.forEach(work => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${work.employee}</td>
            <td>${work.service}</td>
            <td>${work.date}</td>
        `;
        latestWorkTable.appendChild(row);
    });

    // Work Completion Chart
    const ctx = document.getElementById('workCompletionChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Completed Work', 'Remaining Work'],
            datasets: [{
                data: [workCompletionPercentage, 100 - workCompletionPercentage],
                backgroundColor: ['#28a745', '#dc3545']
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
</script>

</body>
</html>
