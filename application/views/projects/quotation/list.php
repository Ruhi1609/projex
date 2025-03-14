<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        <div class="menu-item"onclick="window.location.href='<?=base_url();?>project/estimate'">Estimates</div>
        <div class="menu-item active" onclick="window.location.href='<?=base_url();?>project/quotation'">Quotation</div>
        <div class="menu-item" onclick="window.location.href='<?=base_url();?>project/work_order'">Work Order</div>
        <hr>
        <div class="menu-item"><a href="<?=base_url();?>logout" style="color: white;">Logout</a></div>
    </div>
    <div class="content">
        <h1>QUOTATION</h1>
        <div class="header d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control me-2" id="searchBar" placeholder="Search quotations..." onkeyup="searchTable()">
            <a href="<?=base_url();?>project/quotation/add">
                <button class="btn btn-primary">+ New Quotation</button>
            </a>
        </div>
        <div class="table-container">
        <table class="table table-bordered table-hover text-center">
    <thead>
        <tr>
            <th>$slno</th>
            <th>Quotation Number</th>
            <th>Customer </th>
            <th>Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $slno= 1;?>
        <?php if (!empty($quotation)): ?>
            <?php foreach ($quotation as $q): ?>
                <?php if($q->confirm == '1'){
                    $status = '<i class="fa-solid fa-check-circle"></i> QUO CONFIRMED';
                    $bg ="green";
                } else { ?> <?php $status = '<i class="fa-solid fa-clock"></i> QUOTATION';$bg ="orange"; } ?>
                <tr>
                    <td><?=$slno?></td>
                    <td onclick="quotation_preview(<?=$q->lead_id?>)"><?= $q->lead_number ?></td>
                    <td onclick="quotation_preview(<?=$q->lead_id?>)"><?= $q->cust_name ?></td>
                    <td onclick="quotation_preview(<?=$q->lead_id?>)"><?= $q->date ?></td>
                    <td> <p style=" color:<?=$bg?>; font-weight:bold;"><?= $status ?></p></td>
                    <td><?=$q->amount?></td>
                    <td>
                    <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url();?>project/quotation/edit/<?= $q->lead_id ?>">✏ Edit</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"onclick="confirmDelete('<?= base_url('project/quotation/delete/') . $q->lead_id ?>','<?=$q->confirm?>')">🗑 Delete</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmQuotation(<?= $q->lead_id ?>)">✔ Confirm Quotation</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="undoQuotation(<?= $q->lead_id ?>)">↩️ Undo Quotation</a></li>
                                <li><a class="dropdown-item" href="<?= base_url();?>project/work_order/add/<?= $q->lead_id ?>">📄 Convert to Work Order</a></li>
                                <li><a class="dropdown-item" href="#">📧 Send to Customer</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
       <?php $slno++; ?>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No quotation found.</td> 
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<div class="modal fade" id="Quotation_modal" tabindex="-1" aria-labelledby="QuotationModalLabel" aria-hidden="true">
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

function quotation_preview(lead_id = 0) {
    $('#Quotation_modal').modal('show');

    var path = "<?=base_url();?>project/quotation/preview/" + lead_id;

    $.post(path, function(result) {
        $('#Quotation_modal .modal-body').html(result); 
    }).fail(function() {
        $('#Quotation_modal .modal-body').html('<p>Error loading data. Please try again.</p>');
    });
}
$(document).ready(function() {
            $('#Quotation_modal').on('hidden.bs.modal', function () {
                location.reload();
            });
        });
function printModalContent() {
    var modalContent = document.querySelector("#Quotation_modal .modal-body").innerHTML;
    
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
</script>
<script>
        function edit(lead_id){
            window.location.href = "<?=base_url();?>project/estimate/edit/" + lead_id;
        }
    </script>
    <script>
        function edit(lead_id){
            window.location.href = "<?=base_url();?>project/quotation/edit/" + lead_id;
        }
</script>
<script>
// Show success message after deletion
$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('deleted') === 'success') {
        Swal.fire({
            title: 'Deleted!',
            text: 'Quotation deleted successfully.',
            icon: 'success',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'OK'
        }).then(() => {
            window.history.replaceState(null, "", window.location.pathname);
        });
    }
});

// Confirm delete function
function confirmDelete(deleteUrl,status) {
    if (status == '1') {
        Swal.fire({
            title: 'Deletion Blocked',
            text: 'You cannot delete this quotation  as it is already confirmed.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        });
        return;
    }
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
<script>
function confirmQuotation(lead_id) {
    Swal.fire({
        title: 'Confirm Quotation?',
        text: "Are you sure you want to confirm this quotation?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url('project/quotation/status') ?>",
                type: "POST",
                data: { lead_id: lead_id, confirm: 1 }, // Ensure confirm = 1
                success: function(response) {
                    try {
                        let res = JSON.parse(response);
                        if (res.status === "success") {
                            Swal.fire("Confirmed!", "Quotation has been confirmed.", "success")
                                .then(() => {
                                    window.location.reload(); // Reload page after confirmation
                                });
                        } else {
                            Swal.fire("Error!", res.message || "Failed to confirm quotation.", "error");
                        }
                    } catch (e) {
                        Swal.fire("Error!", "Invalid server response.", "error");
                    }
                },
                error: function() {
                    Swal.fire("Error!", "Something went wrong!", "error");
                }
            });
        }
    });
}

function undoQuotation(lead_id) {
    Swal.fire({
        title: 'Undo Confirmation?',
        text: "Are you sure you want to undo this confirmation?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Undo'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url('project/quotation/status') ?>",
                type: "POST",
                data: { lead_id: lead_id, confirm: 0 }, // Ensure confirm = 0
                success: function(response) {
                    try {
                        let res = JSON.parse(response);
                        if (res.status === "success") {
                            Swal.fire("Undone!", "Quotation confirmation has been undone.", "success")
                                .then(() => {
                                    window.location.reload(); // Reload page after undo
                                });
                        } else {
                            Swal.fire("Error!", res.message || "Failed to undo confirmation.", "error");
                        }
                    } catch (e) {
                        Swal.fire("Error!", "Invalid server response.", "error");
                    }
                },
                error: function() {
                    Swal.fire("Error!", "Something went wrong!", "error");
                }
            });
        }
    });
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>