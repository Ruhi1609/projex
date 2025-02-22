<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Work Status</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-container {
            display: flex;
            height: 100vh;
        }
        /* Sidebar */
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
        /* Container for main content */
        .content {
            flex-grow: 1;
            margin-left: 270px; /* Push content to the right */
            padding: 20px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .work-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            height: 500px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .work-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
            border-bottom: 2px solid #ddd;
            width: 100%;
            padding-bottom: 10px;
        }
        .work-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 18px;
            width: 100%;
        }
        .work-list li {
            margin-bottom: 12px;
        }
        /* Status Dropdown */
        .status-dropdown {
            font-size: 18px;
            padding: 6px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        .selected-status {
            font-weight: bold;
        }
        /* Progress Bar */
        .progress {
            width: 100%;
            height: 30px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            text-align: center;
            font-weight: bold;
            line-height: 30px;
            background-color: #28a745 !important;
        }
        .scrollable-container {
    max-height: 400px; /* Adjust the height as needed */
    overflow-y: auto;
    padding-right: 10px;
}
.scrollable-container::-webkit-scrollbar {
    display: none; /* Hide scrollbar for Chrome, Safari, and Edge */
}

    </style>
</head>
<body>

<div class="main-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center"><b>PROJEX</b></h4>
        <a href="<?= base_url(); ?>cust_dashboard">Home</a>
        <a href="<?= base_url(); ?>project/cus_work_status">Work Status</a>
        <a href="<?= base_url(); ?>project/profile">Profile</a>
        <a href="<?= base_url(); ?>logout">Logout</a>
    </div>

    <div class="content">
        <h2 class="text-center mb-4">Customer Work Status</h2>
        <div class="grid-container">
        <?php if (!empty($estimate)) { ?>
        <div class="work-card">
        <p class="work-title">Estimate</p>
            <div class="scrollable-container">
                <?php $sl_no = 1;
                foreach ($estimate as $e) { ?>
                <?php if ($sl_no > 1) { ?> 
                <hr style="border: 1px solid black;">
                <?php } ?>
                    <ul class="work-list">
                        <li>Estimate Number: <strong><?=$e->lead_number?></strong></li>
                        <li>Estimate Date: <strong><?=$e->date?></strong></li>
                        <li>Estimate Amount:<strong> <?=$e->amount?></strong></li>
                        <li>Status: <strong>ESTIMATE</strong></li>
                    </ul>
                 <?php $sl_no++; } ?>
             </div>
            </div>
            <?php } ?>
                    <?php if (!empty($quotation)) { ?>
                <div class="work-card">
                    <p class="work-title">Quotation</p>
                    <div class="scrollable-container">
                         <?php $sl_no = 1;
                            foreach ($quotation as $q) { ?>
                                <?php if($q->confirm == '1'){
                                    $status = '<i class="fa-solid fa-check-circle"></i> QUO CONFIRMED';
                                     $bg ="green";
                                } else { ?> <?php $status = '<i class="fa-solid fa-clock"></i> QUOTATION';$bg ="orange"; } ?>
                         <?php if ($sl_no > 1) { ?> 
                     <hr style="border: 1px solid black;">
                     <?php } ?>
                    <ul class="work-list">
                        <li>Quotation Number: <strong><?=$q->lead_number?></strong></li>
                        <li>Quotation Date: <strong><?=$q->date?></strong></li>
                        <li>Quotation Amount:<strong> <?=$q->amount?></strong></li>
                        <li>Status: <strong style=" color:<?=$bg?>"><?=$status?></strong></li>
                    </ul>
                    <?php $sl_no++; } ?>
                    </div>
                </div>
                     <?php } ?>
                     <?php if (!empty($work_order)) { ?>
        <div class="work-card">
        <p class="work-title">Work Order</p>
            <div class="scrollable-container">
                <?php $sl_no = 1;
                foreach ($work_order as $w) { ?>
                <?php if ($sl_no > 1) { ?> 
                <hr style="border: 1px solid black;">
                <?php } ?>
                    <ul class="work-list">
                        <li>Work order Number: <strong><?=$w->w_number?></strong></li>
                        <li>Work order Date: <strong><?=$w->date?></strong></li>
                        <li> Amount:<strong> <?=$q->amount?></strong></li>
                        <li>Status: <strong>Work Order</strong></li>
                    </ul>
                 <?php $sl_no++; } ?>
             </div>
            </div>
            <?php } ?>
            <?php if (!empty($work_assign)) { ?>

            <div class="work-card">
                <p class="work-title">Work Assigned</p>
                <div class="scrollable-container">
                <?php $sl_no = 1; 
                    foreach ($work_assign as $wa) { ?>
                <?php if ($sl_no > 1) { ?> 
                <hr style="border: 1px solid black;">
                <?php } ?>  
                <ul class="work-list">
                    <li>Work order Number: <strong><?=$wa->w_number?></strong></li>
                    <li>Assigned To: <strong><?=$wa->emp_name?></strong></li>
                    <li>Role: <strong><?=$wa->position_id?></strong></li>
                    <li>progress:</li>
                    <li>
                        <div class="progress">
                            <!-- <div id="progressBar" class="progress-bar" style="width: 100%;"><?=$wa->max_perc?></div> -->
                            <div class="progress-bar bg-success" 
                                            style="width: <?= $wa->max_perc ?>%;" 
                                            aria-valuenow="<?= $wa->max_perc ?>" aria-valuemin="0" aria-valuemax="100">
                                            <?= $wa->max_perc ?>%
                                        </div>
                        </div>
                    </li>
                </ul>
                <?php $sl_no++; } ?>
            </div>
            </div>
            <?php } ?>
            <?php if (!empty($wo_status)) { ?>
            
            <div class="work-card">
                <p class="work-title">Status</p>
                <div class="scrollable-container">
                <?php $sl_no = 1; 
                    foreach ($wo_status as $s) { ?>
                <?php if ($sl_no > 1) { ?> 
                <hr style="border: 1px solid black;">
                <?php } ?>  
                <ul class="work-list">
                    <li>Work order Number: <strong><?=$s->w_number?></strong></li>
                    <!-- <li>Last updated: <strong><??></strong></li> -->
                    <?php
                    $statusColors = [
                        "Pending" => "yellow",
                        "Approved" => "blue",
                        "Rejected" => "red",
                        "In Progress" => "blue",
                        "Completed" => "green"
                        ];

                    $bg = isset($statusColors[$s->status]) ? $statusColors[$s->status] : "black";
                        ?>
                    <li>Status: <strong style="color: <?= $bg ?>; font-weight: bold;"><?=$s->status?></strong></li>
                </ul>
                <?php $sl_no++; } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Status Dropdown - Change only selected status text color
        $("#statusDropdown").on("change", function() {
            var selectedStatus = $(this).val();
            var statusText = $("#selectedStatus");
            statusText.removeClass("text-success text-danger text-primary");

            if (selectedStatus === "Approved") {
                statusText.addClass("text-success").text("Approved");
            } else if (selectedStatus === "Rejected") {
                statusText.addClass("text-danger").text("Rejected");
            } else {
                statusText.addClass("text-primary").text("In Progress");
            }
        });
    });
</script>

</body>
</html>
