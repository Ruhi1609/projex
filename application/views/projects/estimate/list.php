<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimate List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        
        #searchBar {
            max-width: 250px;
         }
        



    </style>
</head>
<body>
    <div class="sidebar">
        <h2>PROJEX</h2>
        <div class="menu-item" onclick="window.location.href='<?=base_url();?>dashboard'">Dashboard</div>
        <div class="menu-item active">Estimates</div>
        <div class="menu-item" onclick="window.location.href='<?=base_url();?>project/quotation'">Quotation</div>
        <div class="menu-item" onclick="window.location.href='<?=base_url();?>project/work_order'">Work Order</div>
        <hr>
        <div class="menu-item"><a href="<?=base_url();?>logout" style="color: white;">Logout</a></div>
    </div>
    <div class="content">
        <h1 class="mb-3">ESTIMATE</h1>
        <div class="header d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center" style="flex: 1;">
                    <input type="text" class="form-control me-2" id="searchBar" placeholder="Search estimates..." onkeyup="searchTable()">
                </div>
                <a href="<?=base_url();?>project/estimate/add">
                    <button class="btn btn-primary">+ New Estimate</button>
                </a>
        </div>
        <div class="table-container">
        <table class="table table-bordered table-hover text-center">
    <thead>
        <tr>
            <th>$slno</th>
            <th>Lead Number</th>
            <th>Customer </th>
            <th>Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $slno= 1;?>
        <?php if (!empty($leads)): ?>
            <?php foreach ($leads as $lead): ?>
                <?php $status ="ESTIMATE"?>
                    <?php
                    if(isset($leads->derived_id)){
                        $status= "QUOTATION";}
                    ?> 
                <tr>
                    <td><?=$slno?></td>
                    <td  onclick="estimate_preview(<?=$lead->lead_id?>)"><?= $lead->lead_number ?></td>
                    <td onclick="estimate_preview(<?=$lead->lead_id?>)" >
                        <?= $lead->cust_name ?>
                    </td>
                    <td  onclick="estimate_preview(<?=$lead->lead_id?>)" ><?= $lead->date ?></td>
                    <td  onclick="estimate_preview(<?=$lead->lead_id?>)"><?= $status ?></td>
                    <td  onclick="estimate_preview(<?=$lead->lead_id?>)"><?=$lead->amount?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url();?>project/estimate/edit/<?= $lead->lead_id ?>">✏ Edit</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('<?= base_url();?>project/estimate/delete_estimate/<?= $lead->lead_id ?>')">🗑 Delete</a></li>
                                <li><a class="dropdown-item" href="<?= base_url();?>project/quotation/add/<?=$lead->lead_id?>">🔄 Convert to Quotation</a></li>
                                <li><a class="dropdown-item" href="#">📄 Convert to Work Order</a></li>
                                <li><a class="dropdown-item" href="#">📧 Send to Customer</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
       <?php $slno++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No leads found.</td> 
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<div class="modal fade" id="Estimate_modal" tabindex="-1" aria-labelledby="EstimateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="EstimateModalLabel">Estimate Preview</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#Estimate_modal').on('hidden.bs.modal', function () {
                location.reload();
            });
        });

    function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("searchBar");
    filter = input.value.toLowerCase();
    table = document.querySelector(".table tbody");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
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

function estimate_preview(lead_id) {
    $('#Estimate_modal').modal('show');

    var path = "<?=base_url();?>project/estimate/preview/" + lead_id;

    $.post(path, function(result) {
        $('#Estimate_modal .modal-body').html(result); 
    }).fail(function() {
        $('#Estimate_modal .modal-body').html('<p>Error loading data. Please try again.</p>');
    });
}
function printModalContent() {
    var modalContent = document.querySelector("#Estimate_modal .modal-body").innerHTML;
    
    var newWin = window.open('', '', 'width=800, height=600');
    newWin.document.write(`
        <html>
        <head>
            <title>Print Estimate</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .modal-body { text-align: center; }
                .hidden-print { display: none !important; }
            </style>
        </head>
        <body onload="window.print(); window.close();">
            ${modalContent}
        </body>
        </html>
    `);
    newWin.document.close();
}



function edit(lead_id){
            window.location.href = "<?=base_url();?>project/estimate/edit/" + lead_id;
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
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                success: function(response) {
                    Swal.fire({
                        position: 'top-end', 
                        title: 'Deleted!',
                        text: 'Estimate deleted successfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Reload the page or remove row dynamically
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete the estimate. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
}

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
