<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            min-height: 100vh;
        }
        .main-container{
            height:100vh;
            width:100%;
            display:flex;
        }
        .left-container{
            width: 20%;
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
    </style>
</head>
<body>
<div class="main-container">
    <div class="left-container">
        <?php $this->load->view("common/sidebar");?>
    </div>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control search-bar" id="searchBar" placeholder="Search customer..." onkeyup="searchTable()">
            <a href="<?=base_url();?>customer/add">
                <button class="btn btn-add-new">+ Add New Customer</button>
            </a>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-striped" id="customerTable">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl_no = 1;
                    foreach ($customer as $cust) { ?>
                    <tr>
                        <td><?= $sl_no ?></td>
                        <td><?= $cust->cust_name ?></td>
                        <td><?= $cust->email ?></td>
                        <td><?= $cust->phone ?></td>
                        <td>
                            <button class="btn btn-edit" onclick="edit(<?= $cust->cust_id ?>)">Edit</button>
                            <button class="btn btn-delete" onclick="confirmDelete('<?= base_url();?>customer/delete/<?= $cust->cust_id ?>')">Delete</button>
                        </td>  
                    </tr>
                    <?php $sl_no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchBar");
    filter = input.value.toLowerCase();
    table = document.getElementById("customerTable");
    tr = table.getElementsByTagName("tr");
    for (i = 1; i < tr.length; i++) { 
        tr[i].style.display = "none"; 
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}

function edit(cust_id) {
    window.location.href = "<?=base_url()?>customer/edit/" + cust_id;
}

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
