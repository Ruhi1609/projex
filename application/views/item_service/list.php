<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items/Service List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            min-height: 100vh;
        }
        .container {
            padding: 20px 30px 20px 0px;
            max-width: 80%;
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
        .main-container{
            height:100vh;
            width:100%;
            display:flex;
        }
        .left-container{
            width: 20%;
        }
    </style>
</head>
<body>
<div class="main-container">
    <div class="left-container">
        <?php $this->load->view("common/sidebar");?>
    </div>
    <div class="container">
        <!-- Search Bar and Add New Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control search-bar" id="searchBar" placeholder="Search customer...">
            <a href="<?=base_url();?>items_service/add"><button class="btn btn-add-new">+ Add New Item_service</button></a>
        </div>

        <!-- Employee List Table -->
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Item name</th>
                        <th scope="col">Item type</th>
                        <th scope="col">quantity</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl_no = 1;
                        foreach ($items as $i) { ?>
                    <tr>
                        <td><?= $sl_no ?></td>
                        <td><?= $i->name ?></td>
                        <td><?= $i->type ?></td>
                        <td><?= $i->quantity ?></td>
                        <td>
                            <button class="btn btn-edit" onclick="edit(<?= $i->item_id ?>)">Edit</button>
                            <button class="btn btn-delete" onclick="delete_item(<?= $i->item_id ?>)">Delete</button>
                        </td>  
                    </tr>
                    <?php $sl_no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <script>
        function edit(item_id){
            window.location.href = "<?=base_url()?>items_service/edit/" + item_id;
        }

        function delete_item(item_id){
            window.location.href ="<?=base_url()?>items_service/delete/" + item_id;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
