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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #007bff;
            color: white;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
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
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }
        .table-container {
            margin-top: 20px;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f8ff;
        }
        .progress {
            height: 20px;
        }
        .status-dropdown {
            width: 150px;
            text-align: center;
            margin: auto;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h4 class="text-center"><strong>PROJEX</strong></h4>
    <a href="<?=base_url();?>employee_dashboard">Dashboard</a>
    <a href="<?=base_url();?>project/my_work">My Works</a>
    <a href="<?= base_url('logout'); ?>">Logout</a>
</div>
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
                            <td>
                                <?php 
                                $max_perc = 0; 
                                foreach ($percentage as $perc) {
                                    if ($perc->work_ord_id == $m->work_ord_id) {
                                        $max_perc = $perc->max_perc;
                                        break;  
                                    }
                                }
                                ?>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                        style="width: <?= $max_perc ?>%;" 
                                        aria-valuenow="<?= $max_perc ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $max_perc ?>%
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-control status-dropdown" data-id="<?= $m->work_ord_id ?>">
                                    <option value="Pending" <?= ($m->status == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                    <option value="Approved" <?= ($m->status == 'Approved') ? 'selected' : '' ?>>Approved</option>
                                    <option value="Rejected" <?= ($m->status == 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                                    <option value="In Progress" <?= ($m->status == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                                    <option value="Completed" <?= ($m->status == 'Completed') ? 'selected' : '' ?>>Completed</option>
                                </select>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?= base_url('project/my_work/progress/' . $m->work_ord_id) ?>">Start Work</a>
                            </td>
                        </tr>
                        <?php $slno++; ?>
                    <?php endforeach; 
                else: ?>
                <tr>
                    <td colspan="8">No work found.</td> 
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {
    function updateDropdownColor(selectElement) {
        let selectedValue = selectElement.val();
        let parentTd = selectElement.closest("td");
        parentTd.removeClass("bg-warning bg-info bg-danger bg-primary bg-success text-white text-dark");
        switch (selectedValue) {
            case "Pending": parentTd.addClass("bg-warning text-dark"); break;
            case "Approved": parentTd.addClass("bg-info text-dark"); break;
            case "Rejected": parentTd.addClass("bg-danger text-white"); break;
            case "In Progress": parentTd.addClass("bg-primary text-white"); break;
            case "Completed": parentTd.addClass("bg-success text-white"); break;
        }
    }
    $(".status-dropdown").each(function() { updateDropdownColor($(this)); });
    $(".status-dropdown").on("change", function() {
        let selectElement = $(this);
        let status = selectElement.val();
        let work_ord_id = selectElement.data('id');
        updateDropdownColor(selectElement);
        $.ajax({
            url: "<?= base_url('project/my_work/update_status/') ?>" + work_ord_id, 
            type: "POST",
            data: { work_ord_id: work_ord_id, status: status },
            success: function() {
                Swal.fire("Success!", "Status updated successfully!", "success");
            },
            error: function() {
                Swal.fire("Error!", "Failed to update status!", "error");
            }
        });
    });
});
</script>
</body>
</html>
