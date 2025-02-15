<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body{
            font-family: Arial, sans-serif;
            background-color:#f0f8ff;
            margin: 0;
            padding: 20px;
        }
        .form-header{
            margin-bottom: 20px;
            color:#007bff;
            font-size: 2rem;
        }
        .form-label {
            font-weight: bold;
            color: #0056b3;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-container {
            max-width: 100%;
            padding-left: 0;
        }
        .main-container{
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            font-size: 20px;
        }
        hr{
            border-top: 3px  solid rgb(156, 194, 234);
        }
        .form-header{
            font-size: 25px;
            font-weight: 800;
            font-style:normal;
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
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Work Order Details</h2>
            <button class="btn btn-primary">Assign Work</button>
        </div>
        <div class="row">
            <?php foreach($work_order as $w) {?>
            <!-- Left Side: Work Order Details -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Work Order:</h5>
                        <p><strong>Job ID:</strong> </p>
                        <p><strong>Date:</strong> <?=$w->date ?></p>
                        <p><strong>Service:</strong><?=$w->name ?></p>
                        <h5>Customer Details</h5>
                        <p><strong>Name:</strong> <?=$w->cust_name ?> </p>
                        <p><strong>Contact:</strong> <?=$w->phone ?> </p>
                        <p><strong>Address:</strong> <?=$w->address ?> </p>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <!-- Right Side: Staff Selection in Grid -->
            <div class="col-md-6">
                <div class="card">
                <div class="card-body">
                <h5 class="card-title">Assign Staff</h5>
                <div class="row row-cols-2 g-3">
                    <?php foreach ($staff as $s) { ?>
                        <div class="col">
                            <div class="staff-card p-3 position-relative border rounded shadow-sm">
                                <input type="checkbox" class="select-checkbox position-absolute top-0 end-0 m-2">
                                <h6 class="fw-bold"><?= $s->emp_name ?></h6>
                                <p class="text-muted mb-0"><?= $s->position_id ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button class="btn btn-success mt-3 w-100">Assign Selected Staff</button>
            </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
