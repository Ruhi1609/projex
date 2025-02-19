<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }
        .form-header {
            margin-bottom: 20px;
            color: #007bff;
            font-size: 2rem;
        }
        .staff-card {
            position: relative;
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .select-checkbox {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        .work-assign-container {
            display: flex;
            gap: 20px;
        }
        .work-order-section, .assign-staff-section {
            flex: 1;
            min-width: 300px;
        }
        .card {
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Work Order Details</h2>
    </div>

    <!-- Work Order & Assign Staff Side by Side -->
    <div class="d-flex flex-wrap gap-3 align-items-stretch">
        <!-- Left Side: Work Order Details -->
        <div class="work-order-section flex-fill">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Work Order</h5>
                    <?php foreach ($work_order as $w) { ?>
                        <form action="<?= base_url(); ?>project/work_assign/process" method="post">
                            <input type="hidden" name="work_ord_id" value="<?= $w->work_ord_id ?>">
                            <p><strong>Job ID:</strong> <?= $w->work_ord_id ?></p>
                            <p><strong>Date:</strong> <?= $w->date ?></p>
                            <p><strong>Service:</strong> <?= $w->name ?></p>
                            <h5>Customer Details</h5>
                            <p><strong>Name:</strong> <?= $w->cust_name ?> </p>
                            <p><strong>Contact:</strong> <?= $w->phone ?> </p>
                            <p><strong>Address:</strong> <?= $w->address ?> </p>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Right Side: Assign Staff -->
        <div class="assign-staff-section flex-fill">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Assign Staff</h5>
                    <div class="row row-cols-2 g-2">
                        <?php foreach ($staff as $s) { ?>
                            <div class="col">
                                <div class="staff-card p-3 position-relative border rounded shadow-sm">
                                    <input type="checkbox" name="staff_id" value="<?= $s->emp_id ?>" class="select-checkbox position-absolute top-0 end-0 m-2">
                                    <h6 class="fw-bold"><?= $s->emp_name ?></h6>
                                    <p class="text-muted mb-0"><?= $s->position_id ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" id="assignBtn" class="btn btn-success mt-3 w-100">Assign Selected Staff</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("assignBtn").addEventListener("click", function (event) {
    let checkboxes = document.querySelectorAll(".select-checkbox:checked");

    if (checkboxes.length > 0) {
        Swal.fire({
            title: "Success!",
            text: "Staff assigned successfully!",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    } else {
        event.preventDefault(); // Prevent form submission if no staff is selected
        Swal.fire({
            title: "Oops!",
            text: "Please select at least one staff member before assigning.",
            icon: "warning",
            confirmButtonColor: "#d33",
            confirmButtonText: "OK"
        });
    }
});
</script>

</body>
</html>
