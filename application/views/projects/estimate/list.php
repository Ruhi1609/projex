<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimate List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #007bff;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
            height: 100vh;
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 22px;
            text-align: center;
        }

        .menu-item {
            margin: 15px 0;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .menu-item:hover, .menu-item.active {
            background: #0056b3;
        }

        .content {
            flex: 1;
            padding: 20px;
            background: #f9faff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #007bff;
        }

        .table-container {
            margin-top: 30px;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f8ff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .status-pending { color:rgb(223, 137, 75); font-weight: bold; }
        .status-approved { color: #28a745; font-weight: bold; }
        .status-rejected { color: #dc3545; font-weight: bold; }

    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <div class="menu-item active" onclick="window.location.href='estimate_list.php'">Estimates</div>
        <div class="menu-item" onclick="window.location.href='work_orders.php'">Work Orders</div>
        <div class="menu-item" onclick="window.location.href='payments.php'">Payments</div>
        <div class="menu-item" onclick="window.location.href='profile.php'">Profile</div>
        <hr>
        <div class="menu-item"><a href="logout" style="color: white;">Logout</a></div>
    </div>

    <div class="content">
        <div class="header">
            <h1>Estimate List</h1>
            <a href="<?=base_url();?>project/estimate/add"><button class="btn btn-primary">+ New Estimate</button></a>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Estimate </th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Worksheet</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> <?php $sl_no = 1;
                        // foreach ($estimate as $e) { ?>
                    <tr>
                        <td><?//= $sl_no ?></td>
                        <td><?//= $e->estimate ?></td>
                        <td><?//= $e->date?></td>
                        <td><?//= $e->customer?></td>
                        
                    </tr>
                    <?php //$sl_no++; } ?>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">✏ Edit</a></li>
                                    <li><a class="dropdown-item" href="#">🗑 Delete</a></li>
                                    <li><a class="dropdown-item" href="#">🔄 Convert to Quotation</a></li>
                                    <li><a class="dropdown-item" href="#">📄 Convert to Work Order</a></li>
                                    <li><a class="dropdown-item" href="#">📧 Send to Customer</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <!-- More Rows Dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
