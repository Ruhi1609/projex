<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work order List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <h2>PROJEX</h2>
        <div class="menu-item" onclick="window.location.href='<?=base_url();?>dashboard'">Dashboard</div>
        <div class="menu-item"onclick="window.location.href='<?=base_url();?>project/estimate'">Estimates</div>
        <div class="menu-item" onclick="window.location.href='<?=base_url();?>project/quotation'">Quotation</div>
        <div class="menu-item active" onclick="window.location.href='<?=base_url();?>project/work_order'">Work Order</div>
        <hr>
        <div class="menu-item"><a href="<?=base_url();?>logout" style="color: white;">Logout</a></div>
    </div>
    <div class="content">
        <div class="header">
            <h1>Work order List</h1>
            <a href="<?=base_url();?>project/work_order/add"><button class="btn btn-primary">+ New Work order</button></a>
        </div>
        <div class="table-container">
        <table class="table table-bordered table-hover text-center">
    <thead>
        <tr>
            <th>$slno</th>
            <th>Work order Number</th>
            <th>Date</th>
            <th>Customer </th>
            <th>Staff</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $slno= 1;?>
        <?php if (!empty($work_order)): ?>
            <?php foreach ($work_order as $w): ?>
                <tr>
                    <td><?=$slno?></td>
                    <td><?= $w->w_number ?></td>
                    <td><?= $w->date ?></td>
                    <td><?= $w->cust_name ?></td>
                    <td><?= $w->emp_name?></td>
                    <?php
                    $statusColors = [
                        "Pending" => "yellow",
                        "Approved" => "blue",
                        "Rejected" => "red",
                        "In Progress" => "blue",
                        "Completed" => "green"
                        ];

                    $bg = isset($statusColors[$w->status]) ? $statusColors[$w->status] : "black";
                        ?>
                            <td>
                                <p style="color: <?= $bg ?>; font-weight: bold;"><?= $w->status ?></p>
                            </td>
                    <td><?= $w->amount?></td>
                    <td>
                    <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <!-- <li><a class="dropdown-item" href="<?//= base_url();?>project/work_order/edit/<?//= $w->work_ord_id ?>">✏ Edit</a></li> -->
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('<?= base_url();?>project/work_order/delete/<?= $w->work_ord_id ?>')">🗑 Delete</a></li>
                                <li><a class="dropdown-item" href="<?= base_url();?>project/work_assign/add/<?= $w->work_ord_id ?>">📄 assign Work</a></li>
                                <li><a class="dropdown-item" href="#">📧 Send to Customer</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
       <?php $slno++; ?>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No work order found.</td> 
            </tr>
        <?php endif; ?>
    </tbody>
</table>
        </div>
    </div>
    <!-- <script>
        function edit(lead_id){
            window.location.href = "<?=base_url();?>project/work_order/edit/" + lead_id;
        }
</script> -->
<script>
function confirmDelete(deleteUrl) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        }
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>