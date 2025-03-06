<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimate Preview</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .estimate-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .customer-details, .table-responsive, .total-amount, .action-buttons {
            margin-bottom: 20px;
        }
        @media print {
    /* Hide all elements except the print area */
    body * {
        visibility: hidden;
    }

    #printArea, #printArea * {
        visibility: visible;
    }

    #printArea {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background: white;
        padding: 20px;
    }

    /* Hide print button and modal */
    .hidden-print, .modal-backdrop {
        display: none !important;
    }

    /* Remove default print margins */
    @page {
        margin: 0;
    }
}


    </style>
<!-- </head>
<body> -->

    <h1 class="estimate-header">QUOTATION</h1>
    <?php foreach ($lead as $l): ?>
    <div class="row">
    <div class="customer-details col-sm-4">
        <h5>Customer Details</h5>
        <p>Name : <strong><?=$l->cust_name?></strong>  </p>
        <p>Phone : <strong><?=$l->phone?></strong>  </p>
        <p>Email : <strong><?=$l->email?></strong>  </p>
        <p>Address : <strong><?=$l->address?></strong>  </p>
    </div>
    <div class="Quotation-details col-sm-4 ms-auto text-end">
        <p>Quotation number : <strong><?=$l->lead_number?></strong>  </p>
        <p>Date : <strong><?= date('d M Y', strtotime($l->date)) ?></strong></p>
        <p>Service Name : <strong><?=$l->service_name?></strong>  </p>
        <p>Service Charge : <strong><?=$l->price?></strong>  </p>
    </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Sl. No</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php $slno= 1;?>
            <?php foreach ($lead_item as $li){?>
                <tr>
                    <td><?=$slno?></td>
                    <td><?=$li->name?></td>
                    <td><?=$li->quantity?></td>
                    <td><?=$li->price?></td>
                    <td><?=$li->amount?></td>
                </tr>
                <?php $slno++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="total-amount">
        <h5>Total Amount : <?=$l->amount?></h5>
    </div>
    <?php endforeach; ?>
<!-- Print Button -->
<div class="action-buttons d-flex justify-content-center gap-3 hidden-print">
    <button class="btn btn-primary" onclick="printContent()">Print</button>
</div>

<!-- Modal for Estimate Preview -->
<div class="modal fade" id="Estimate_modal" tabindex="-1" aria-labelledby="EstimateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EstimateModalLabel">Quotation Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printArea">
                <!-- Content loaded via AJAX goes here -->
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- </body>
</html> -->
