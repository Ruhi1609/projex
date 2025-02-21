<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Work Status</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .status-pending { background-color: #ffc107; color: #000; }
        .status-accepted { background-color: #28a745; color: #fff; }
        .status-overdue { background-color: #dc3545; color: #fff; }
        .status-in-progress { background-color: #007bff; color: #fff; }
        .status-completed { background-color: #17a2b8; color: #fff; }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4">Customer Work Status</h2>

    <!-- Summary Cards -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <h5>Total Estimates</h5>
            <span class="badge bg-success">10</span>
        </div>
        <div class="col-md-4">
            <h5>Total Quotations</h5>
            <span class="badge bg-info">5</span>
        </div>
        <div class="col-md-4">
            <h5>Total Work Orders</h5>
            <span class="badge bg-warning">8</span>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by Customer Name...">
        </div>
        <div class="col-md-3">
            <select id="statusFilter" class="form-control">
                <option value="">Filter by Status</option>
                <option value="Accepted">Accepted</option>
                <option value="Pending">Pending</option>
                <option value="Overdue">Overdue</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <div class="col-md-3 text-end">
            <button class="btn btn-primary" id="toggleView">Toggle List/Grid</button>
        </div>
    </div>

    <!-- Work Status Grid -->
    <div id="workContainer" class="row">
        <!-- <?php foreach ($work_status as $work) { ?>
            <div class="col-md-4 work-card" data-status="<?//= strtolower($work->status) ?>" data-customer="<?//= strtolower($work->customer_name) ?>"> -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= $work->customer_name ?></h5>
                        <p><strong>Estimate:</strong> $<?//= number_format($work->estimate_amount, 2) ?></p>
                        <p><strong>Quotation:</strong> $<?//= number_format($work->quotation_amount, 2) ?></p>
                        <p><strong>Work Order:</strong> <?//= $work->work_order_id ?></p>
                        <p><strong>Work Assigned:</strong> <?//= $work->assigned_staff ?: 'Not Assigned' ?></p>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<script>
    $(document).ready(function() {
        // Search Filter
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".work-card").filter(function() {
                $(this).toggle($(this).data("customer").includes(value));
            });
        });

        // Status Filter
        $("#statusFilter").on("change", function() {
            var status = $(this).val().toLowerCase();
            $(".work-card").each(function() {
                if (status === "" || $(this).data("status") === status) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Toggle List/Grid View
        let isGridView = true;
        $("#toggleView").click(function() {
            if (isGridView) {
                $("#workContainer").removeClass("row").addClass("table-responsive");
                $(".work-card").each(function() {
                    $(this).removeClass("col-md-4").addClass("table table-bordered");
                });
                isGridView = false;
            } else {
                $("#workContainer").removeClass("table-responsive").addClass("row");
                $(".work-card").each(function() {
                    $(this).removeClass("table table-bordered").addClass("col-md-4");
                });
                isGridView = true;
            }
        });
    });
</script>

</body>
</html>
