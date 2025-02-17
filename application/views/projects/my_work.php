<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    
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
        .menu-item:hover, .menu-item-active {
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
    </style>
</head>
<body>
    <div class="content">
        <div class="header">
            <h1>My Works</h1>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Work Order Number</th>
                        <th>Date</th>
                        <th>Service</th>
                        <th>Customer</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $slno = 1;
                    if (!empty($my_work)): 
                        foreach ($my_work as $m): ?>
                            <tr>
                                <td><?= $slno ?></td>
                                <td><?= $m->w_number ?></td>
                                <td><?= $m->date ?></td>
                                <td><?= $m->name ?></td>
                                <td><?= $m->cust_name ?></td>
                                <td><?= $m->status ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            status
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item text-black bg-success" href="#">complete </a></li>
                                            <li><a class="dropdown-item text-black bg-info" href="#">approved </a></li>
                                            <li><a class="dropdown-item text-black bg-warning" href="#">pending </a></li>
                                            <li><a class="dropdown-item text-black bg-primary" href="#">in progress </a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Start Work</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php $slno++; ?>
                        <?php endforeach; 
                        else: ?>
                        <tr>
                            <td colspan="9">No work found.</td> 
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
