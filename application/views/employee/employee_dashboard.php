<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #007bff;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            color: white;
            display: block;
            text-decoration: none;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h5 {
            color: #007bff;
        }

        .card-body {
            background-color: #e9f7ff;
        }

        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid #007bff;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center"><strong>PROJEX</strong></h4>
    <a href="<?=base_url();?>project/my_work">My Works</a>
    <a href="<?= base_url('logout'); ?>">Logout</a>
</div>

<div class="content">
    <?php foreach ($employee_details as $e) { ?>
        <div class="header">
            <h3>WELCOME, <strong><?= strtoupper($e->emp_name ) ?> </strong>!</h3>
            <img src="https://via.placeholder.com/50" alt="Profile Picture" class="profile-icon">
        </div>

        <!-- Works Completed Section -->
        <div id="completedWorks" class="mb-4">
            <h4>Works Completed</h4>
            <div class="card">
                <div class="card-body">
                    <p>Total Completed Works: <strong><?=$completed_work?></strong></p>
                </div>
            </div>
        </div>
    <?php } ?> <!-- Closing the foreach loop properly -->

    <!-- Pending Works Section -->
    <div id="pendingWorks" class="mb-4">
        <h4>Pending Works</h4>
        <div class="card">
            <div class="card-body">
                <p>Total Pending Works: <strong><?=$pending_work?></strong></p>
            </div>
        </div>
    </div>
    
    <!-- Payment History Section -->
    <div id="paymentHistory">
        <h4>Payment History</h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2025-01-15</td>
                        <td>$2000</td>
                        <td>Paid</td>
                    </tr>
                    <tr>
                        <td>2025-01-01</td>
                        <td>$1500</td>
                        <td>Paid</td>
                    </tr>
                    <tr>
                        <td>2024-12-15</td>
                        <td>$1800</td>
                        <td>Pending</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
