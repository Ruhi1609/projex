<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Progress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .main-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .form-header {
            color: #007bff;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .btn-sm {
            font-size: 0.9rem;
            padding: 10px;
        }
        .progress {
            height: 25px;
        }
        .work-control {
            flex-grow: 1;
        }
        .materials {
            margin-top: auto; /* Push to bottom */
        }
    </style>
</head>
<body>
<div class="container mt-4"> 
    <div class="row">
        <!-- Left Panel: Job Details -->
        <div class="col-md-3">
            <?php foreach ($progress as $p) { ?>
                <div class="card p-3 main-container">
                    <h5 class="form-header">Job Details</h5>
                    <p><strong>Job Number:</strong> <?= $p->work_ord_id ?> </p>
                    <p><strong>Service:</strong> <?= $p->name ?> </p>
                    <p><strong>Customer:</strong> <?= $p->cust_name ?> </p>
                    <p><strong>Status:</strong> <?//= $p->status ?> </p>
                    <p><strong>Work Completed:</strong> </p>
                    <p><strong>Days Spent:</strong> </p>
                </div>
            <?php } ?>
        </div>

        <!-- Middle Panel: Work Control & Materials (Wider) -->
        <div class="col-md-6">
            <div class="card p-3 main-container">
                <div class="work-control">
                    <h5 class="form-header">Work Control</h5>
                    <!-- Buttons Side by Side -->
                    <div class="d-flex gap-2">
                        <button id="start-btn" value="<?= $p->work_ord_id ?>" class="btn btn-primary btn-sm w-100">Start Work</button>
                        <button id="stop-btn"  value="<?=$p->work_ord_id ?>" class="btn btn-danger btn-sm w-100" disabled>Stop Work</button>
                    </div>

                    <!-- Progress Bar -->
                    <div class="progress mt-3">
                        <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>

                    <!-- Interactive Slider -->
                    <label for="progress-slider">Adjust Progress:</label>
                    <input type="range" id="progress-slider" class="form-range" min="0" max="100" step="1" value="0">
                </div>
                <!-- Materials Section at Bottom -->
                <div class="materials mt-4">
                    <h5 class="form-header">Materials Required</h5>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Sl No</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $slno = 1;
                            if (!empty($item_array)):
                                foreach ($item_array as $i): ?>
                                    <tr>
                                        <td><?= $slno ?></td>
                                        <td><?= $i->name ?></td>
                                        <td><?= $i->quantity ?></td>
                                        <td><?= $i->price ?></td>
                                        <td><?= $i->amount ?></td>
                                    </tr>
                                    <?php $slno++; ?>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="5">Materials not found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Panel: Job Log -->
        <div class="col-md-3">
            <div class="card p-3 main-container">
                <h5 class="form-header">Job Log</h5>
                <ul class="list-group">
                    <li class="list-group-item">Day 1: Work Started</li>
                    <li class="list-group-item">Day 3: Materials Ordered</li>
                    <li class="list-group-item">Day 5: 50% Completed</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
    let work_ord_id = "<?= $p->work_ord_id ?>";
    


let progress = 0;

// Update the progress bar and slider when the user moves the slider
$("#progress-slider").on("input", function() {
    progress = $(this).val();
    updateProgressBar(progress);
});

// Function to update the progress bar
function updateProgressBar(progress) {
    $("#progress-bar").css("width", progress + "%");
    $("#progress-bar").attr("aria-valuenow", progress);
    $("#progress-bar").text(progress + "%");
}

// Start button functionality
$("#start-btn").on("click", function() {
    let work_ord_id = $(this).val();
    // alert(work_ord_id);
    $.ajax({
        url:"<?=base_url('project/my_work/start')?>",
        type:"POST",
        data:{work_ord_id:work_ord_id},
        success:function(response){
            Swal.fire("Success!","work started!","success");
            $("#progress-slider").prop("disabled",false);
            $("#stop-btn").prop("disabled",false);
            $("#start-btn").prop("disabled",true);
        },
        error:function(){
            Swal.fire("Error!","Failed to start work!","error");
        }
    });
});

// Stop button functionality
$("#stop-btn").on("click", function() {
    let work_ord_id = $(this).val();
    let progress = $("#progress-slider").val();
    $.ajax({
        url:"<?=base_url('project/my_work/stop')?>",
        type:"POST",
        data:{work_ord_id:work_ord_id, progress:  progress},
        success:function(response){
            Swal.fire("success!","Work stopped!","success");
            $("#progress-slider").prop("disabled", true); 
            $("#stop-btn").prop("disabled",true);
            $("#start-btn").prop("disabled", false);
        },
        error:function(){
            Swal.fire("Error!","failed to stop work!","error");
        } 

    });
    console.log(data);
    // alert(data);
});
    });
</script>
</body>
</html>
