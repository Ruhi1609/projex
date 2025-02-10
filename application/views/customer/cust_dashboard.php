<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #007bff;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        .sidebar h4 {
            margin-bottom: 30px;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        .main-content {
            margin-left: 270px;
            padding: 20px;
            flex-grow: 1;
            width: 100%;
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

        .btn {
            padding: 5px 15px;
            font-size: 0.9rem;
            border: none;
        }

        .btn-add-new {
            background-color: #28a745;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Customer Dashboard</h4>
        <a href="<?= base_url(); ?>project/dashboard">Home</a>
        <a href="<?= base_url(); ?>project/work_requests">Work Requests</a>
        <a href="<?= base_url(); ?>project/orders">Orders</a>
        <a href="<?= base_url(); ?>project/profile">Profile</a>
        <a href="<?= base_url(); ?>login/log_out">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php foreach($customer_details as $c) {?>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">Work Requests</h2>
            <button class="btn btn-add-new" data-bs-toggle="modal" data-bs-target="#addWorkRequestModal">+ New Work Request</button>
        </div>
        <h2 class="text-primary">Welcome <?=$c->cust_name?></h2>

        <div class="table-container">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Service Name</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl_no = 1; foreach ($cust_service as $cust): ?>
                    <tr>
                        <td><?= $sl_no ?></td>
                        <td><?= $cust->name ?></td>
                        <td><?= $cust->notes ?></td>
                        <?php 
                        $bg = '#ffc107'; 

                            if ($cust->status == 'approved') {
                         $bg = '#28a745'; 
                        } elseif ($cust->status == 'rejected') {
                            $bg = '#dc3545'; 
                        }
                        ?>

                        <td class="status-<?= strtolower($cust->status) ?>" style="font-weight:bold; color:<?=$bg?>"><?= $cust->status ?></td>
                        <td>
                        <button class="btn btn-edit btn-primary" onclick="editItem('<?= $cust->name ?>', '<?= $cust->notes ?>')">Edit</button>
                            <button class="btn btn-delete" onclick="delete_item(<?=$cust->work_rqst_id?>)">Delete</button>
                        </td> 
                    </tr>
                    <?php $sl_no++; endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php }?>
    </div>

    <!-- Modal for Adding Work Request -->
    <div class="modal fade" id="addWorkRequestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Add New Work Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="workRequestForm" action="<?=base_url();?>project/work_request/process" method="post">
                        <div class="form-group mb-3">
                            <label>Service Name</label>
                            <select id="serviceName" name="service_id" class="form-control" required>
                                <option value="">Select Service</option>
                                <?php foreach ($services as $service): ?>
                                    <option value="<?= $service->item_id ?>"><?= $service->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Notes</label>
                            <textarea id="notes" name="notes" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
       
    <script>
    function editItem(name, notes) {
        $('#serviceName').val(name);
        $('#notes').val(notes);

        $('#addWorkRequestModal').modal('show');
    }

        function delete_item(work_rqst_id){
            window.location.href ="<?=base_url()?>project/work_request/delete/" + work_rqst_id;
        }
    </script>                             
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
