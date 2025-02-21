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
                                <td>
                                 <?php 
                                    $max_perc = 0; 
                                     foreach ($percentage as $perc) {
                                         if ($perc->work_ord_id == $m->work_ord_id) {
                                             $max_perc = $perc->max_perc;
                                            break;  }
                                     }
                                    ?>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-success" role="progressbar" 
                                            style="width: <?= $max_perc ?>%;" 
                                            aria-valuenow="<?= $max_perc ?>" aria-valuemin="0" aria-valuemax="100">
                                            <?= $max_perc ?>%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                <span class="status-display font-weight-bold"></span>
                                    <select class="form-control status-dropdown" data-id="<?= $m->work_ord_id ?>">
                                        <option value="Pending" <?= ($m->status == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                        <option value="Approved" <?= ($m->status == 'Approved') ? 'selected' : '' ?>>Approved</option>
                                        <option value="Rejected" <?= ($m->status == 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                                        <option value="In Progress" <?= ($m->status == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                                        <option value="Completed" <?= ($m->status == 'Completed') ? 'selected' : '' ?>>Completed</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= base_url('project/my_work/progress/' . $m->work_ord_id) ?>">Start Work</a></li>
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
    <script>
    // $(document).ready(function() {
    //     $(".dropdown-menu .dropdown-item").on("click", function(e) {
    //         e.preventDefault();
    //         let selectedStatus = $(this).data("status"); 
    //         $("#status-btn").text(selectedStatus); 
    //     });
    // });
</script>
<script>
$(document).ready(function() {
    function updateDropdownColor(selectElement) {
        let selectedValue = selectElement.val();
        let parentTd = selectElement.closest("td");

        // Remove previous classes
        parentTd.removeClass("bg-warning bg-info bg-danger bg-primary bg-success text-white text-dark");

        // Apply color based on the selected value
        switch (selectedValue) {
            case "Pending":
                parentTd.addClass("bg-warning text-dark");
                break;
            case "Approved":
                parentTd.addClass("bg-info text-dark");
                break;
            case "Rejected":
                parentTd.addClass("bg-danger text-white");
                break;
            case "In Progress":
                parentTd.addClass("bg-primary text-white");
                break;
            case "Completed":
                parentTd.addClass("bg-success text-white");
                break;
        }
    }

    // Apply color on page load
    $(".status-dropdown").each(function() {
        updateDropdownColor($(this));
    });

    // Change status display and color when selection changes
    $(".status-dropdown").on("change", function() {
        let selectElement = $(this);
        let status = selectElement.val();
        let work_ord_id = selectElement.data('id');

        updateDropdownColor(selectElement);

        // AJAX request to update status
        $.ajax({
            url: "<?= base_url('project/my_work/update_status/') ?>" + work_ord_id, 
            type: "POST",
            data: { work_ord_id: work_ord_id, status: status },
            success: function(response) {
                Swal.fire("Success!", "Status updated successfully!", "success");
                setTimeout(function() {
                    location.reload(); // Reload after a delay for better UX
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire("Error!", "Failed to update status!", "error");
            }
        });
    });
});
</script>
</body>
</html>
