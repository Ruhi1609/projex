<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            min-height: 100vh;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
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

        .search-bar {
            max-width: 300px;
            margin-right: 20px;
        }

        @media (max-width: 768px) {
            .search-bar {
                margin-bottom: 15px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Search Bar and Add New Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control search-bar" id="searchBar" placeholder="Search employee...">
            <a href="<?=base_url();?>employee/add"><button class="btn btn-add-new">+ Add New Employee</button></a>
        </div>

        <!-- Employee List Table -->
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Department</th>
                        <th scope="col">Position</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl_no = 1;
                        foreach ($employees as $emp) { ?>
                    <tr>
                        <td><?= $sl_no ?></td>
                        <td><?= $emp->emp_name ?></td>
                        <td><?= $emp->emp_code ?></td>
                        <td><?= $emp->dept_id ?></td>
                        <td><?= $emp->position_id ?></td>
                        <td><?= $emp->email ?></td>
                        <td><?= $emp->phone ?></td>
                        <td><?= $emp->salary ?></td> 
                        <td>
                            <button class="btn btn-edit" onclick="edit(<?= $emp->emp_id ?>)">Edit</button>
                            <button class="btn btn-delete" onclick="delete_item(<?= $emp->emp_id ?>)">Delete</button>
                        </td>  
                    </tr>
                    <?php $sl_no++; } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function edit(emp_id){
            window.location.href = "<?=base_url()?>employee/edit/" + emp_id;
        }

        function delete_item(emp_id){
            window.location.href ="<?=base_url()?>employee/delete/" + emp_id;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
