<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
    .slider-img {
        height: 125mm !important; 
        object-fit: cover; 
        border-radius: 10px;
    }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="text-center"><b>PROJEX</b></h4>
        <a href="<?= base_url(); ?>project/dashboard">Home</a>
        <a href="<?= base_url(); ?>project/cus_work_status">Work Status</a>
        <a href="<?= base_url(); ?>project/profile">Profile</a>
        <a href="<?= base_url(); ?>logout">Logout</a>
    </div>

    <div class="main-content">
        <?php foreach($customer_details as $c) {?>
        <h2 class="text">WELCOME <strong><?=strtoupper($c->cust_name)?></strong></h2>
        <h2 class="text"><strong> Our Services</strong></h2>
        <div id="imageSlider" class="carousel slide" data-bs-ride="carousel " style="border-radius: 10px;border:2px solid #a5b6da; padding :8px;">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="<?= base_url('images/img1.jpg') ?>" class="d-block w-100 slider-img" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('images/img2.jpg') ?>" class="d-block w-100 slider-img" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('images/img3.jpg') ?>" class="d-block w-100 slider-img" alt="Slide 3">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('images/img4.jpg') ?>" class="d-block w-100 slider-img" alt="Slide 3">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('images/img7.jpg') ?>" class="d-block w-100 slider-img" alt="Slide 3">
        </div>
    </div>
</div>
        <hr style="border : 1px solid gyey;">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text">Work Requests</h2>
            <!-- <button class="btn btn-add-new" data-bs-toggle="modal" data-bs-target="#addWorkRequestModal">+ New Work Request</button> -->
            <button class="btn btn-add btn-success" onclick="addItem()">Add Work Request</button>

        </div>

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
                        <button class="btn btn-edit btn-primary" onclick="editItem('<?=$cust->work_rqst_id?>','<?= $cust->item_id ?>', '<?= $cust->notes ?>')">Edit</button>
                        <button class="btn btn-delete" onclick="confirmDelete('<?= base_url();?>project/work_request/delete/<?= $cust->work_rqst_id ?>','<?=$cust->status?>')">Delete</button>
                        </td> 
                    </tr>
                    <?php $sl_no++; endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php }?>
    </div>

    <div class="modal fade" id="addWorkRequestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Work Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="workRequestForm" method="post">
                    <div class="mb-3">
                        <label for="serviceName" class="form-label">Service Name</label>
                        <select id="serviceName" name="service_id" class="form-control" required>
                            <option value="">Select Service</option>
                            <?php foreach ($services as $service): ?>
                                <option value="<?= $service->item_id ?>"><?= $service->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea id="notes" class="form-control" name="notes" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
       
    <script>
    const base_url = '<?= base_url(); ?>';

function addItem() {
    const form = document.getElementById('workRequestForm');
    form.action = `${base_url}project/work_request/process/`;

    document.getElementById('modalTitle').textContent = 'Add Work Request';
    document.getElementById('serviceName').selectedIndex = 0; // Default to 'Select Service'
    document.getElementById('notes').value = '';

    const modal = new bootstrap.Modal(document.getElementById('addWorkRequestModal'));
    modal.show();
}

function editItem(workRqstId, itemId, notes) {
    const form = document.getElementById('workRequestForm');
    form.action = `${base_url}project/work_request/process/${workRqstId}`;

    document.getElementById('modalTitle').textContent = 'Edit Work Request';

    const serviceDropdown = document.getElementById('serviceName');
    serviceDropdown.value = itemId ? itemId : "";
    document.getElementById('notes').value = notes;

    const modal = new bootstrap.Modal(document.getElementById('addWorkRequestModal'));
    modal.show();
}


    function confirmDelete(work_rqst_id,status) {
        if (status.toLowerCase() === 'approved') {
        Swal.fire({
            title: 'Deletion Blocked',
            text: 'You cannot delete this request as it is already approved.',
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
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(work_rqst_id, {
                method: 'GET'
            }).then(response => {
                if (response.ok) {
                    Swal.fire(
                        'Deleted!',
                        'Your request has been deleted.',
                        'success'
                    ).then(() => {
                        location.reload(); 
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'There was a problem deleting the request.',
                        'error'
                    );
                }
            }).catch(() => {
                Swal.fire(
                    'Error!',
                    'Unable to process the request.',
                    'error'
                );
            });
        }
    });
}
   
    document.addEventListener("DOMContentLoaded", function() {
        new bootstrap.Carousel(document.getElementById("imageSlider"), {
            interval: 3000, 
            ride: "carousel"
        });
    });
</script>
</body>
</html>
