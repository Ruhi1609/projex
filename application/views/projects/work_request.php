<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Request</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f9ff; /* Light blue */
        }
        .container {
            padding: 20px 30px 20px 0px;
            max-width: 80%;
            margin: 0 auto;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .modal-content {
            background-color: #e6f0ff;
        }
        .btn-edit {
            background-color: #ffc107;
            color: white;
            border: none;
            padding: 5px 10px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
        }
        .status-pending { color: #ffc107; font-weight: bold; }
        .status-approved { color: #28a745; font-weight: bold; }
        .status-rejected { color: #dc3545; font-weight: bold; }
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

    <table class="table table-striped text-center">
        <thead class="thead-dark">
            <tr>
                <th>S.No</th>
                <th>Customer Name</th>
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
                        <td><?= $cust->cust_name?></td>
                        <td><?= $cust->name ?></td>
                        <td><?= $cust->notes ?></td>
                        <td class="status-<?= strtolower($cust->status) ?>"><?= $cust->status ?>
                        <?php if (strtolower($cust->status) === 'approved') : ?>
        <p>
                                <a href="<?= base_url(); ?>project/estimate/add/<?=$cust->work_rqst_id?>" class="btn btn-link">
                                    <i class="fa fa-file"></i> Make Estimate
                                </a>
                            </p>
                        <?php endif; ?>
                        </td>
                        <td>
                        <select class="form-control status-dropdown" data-id="<?= $cust->work_rqst_id ?>">
                         <option value="Pending" >Pending</option>
                         <option value="Approved" >Approved</option>
                        <option value="Rejected" >Rejected</option>
                        </select>
                        </td>
                    </tr>
                    <?php $sl_no++; endforeach; ?>
                </tbody>
    </table>
</div>
</div>

<!-- Modal for Adding Work Request -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
 $(document).ready(function() {
    // Event listener for dropdown change
    $('.status-dropdown').on('change', function() {
        var status = $(this).val(); 
        var work_rqst_id = $(this).data('id');
        $.ajax({
            url: '<?=base_url()?>project/work_request/update_status/'+work_rqst_id, 
            type: "POST",
            data: { work_rqst_id: work_rqst_id, status: status },
            success: function(response) {
                // alert("success")
                window.location.reload();
            },
            error: function(xhr, status, error) {
                // Handle the error response (optional)
                alert('Error updating status.');
            }
        });
    });
});
</script>
</body>
</html>
