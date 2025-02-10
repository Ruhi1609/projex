<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimate Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 90%;
            min-height: 100vh; /* Full screen height */
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
            display: flex;
            flex-direction: column;
        }
        h4 {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        .btn-success {
            background-color: #007bff;
            border: none;
        }
        .btn-success:hover {
            background-color: #0056b3;
        }
        .form-wrapper {
            flex-grow: 1; /* Ensures content stretches */
            display: flex;
        }
        .left-section {
            width: 30%;
            padding-right: 15px;
            padding: 10px;
            background-color: #e1ecfb;
            border-radius: 10px;
        }
        .right-section {
            width: 70%;
            padding-left: 20px;
            display: flex;
            flex-direction: column;
        }
        .vertical-line {
            border-left: 2px solid #007bff;
            height: 100%;
        }
        .bottom-section {
            margin-top: auto; /* Pushes content to the bottom */
        }
        .item-contsiner{
            height: 20%;
        }
        #service-charge{
            height: 55px;
            background-color: #f0f8ff;
            border: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h4 class="mb-3">Create Estimate</h4>

    <form class="d-flex flex-column">
        <div class="form-wrapper d-flex">
            <!-- Left Side (20%) -->
            <div class="left-section">
                <div class="row">
                    <div class="col-md-6">
                        <label for="estimate_number" class="form-label">Estimate Number</label>
                        <input type="text" class="form-control" id="estimate_number" name="estimate_number" placeholder="EST-001" required>
                    </div>
                    <div class="col-md-6">
                        <label for="estimate_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="estimate_date" name="estimate_date" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="customer" class="form-label">Customer</label>
                    <select class="form-select" id="customer" name="customer" required>
                        <option value="">Select Customer</option>
                        <?php foreach ($customer as $cust): ?>
                                <option value="<?= $cust->cust_id ?>" data-name="<?= $cust->cust_name ?>"><?= $cust->cust_name ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Vertical Line -->
            <div class="vertical-line"></div>

            <!-- Right Side (78%) -->
            <div class="right-section">
                <div class="row">
                    <div class="col-md-6">
                        <label for="service" class="form-label">Service</label>
                        <select class="form-select" id="service" name="service" onchange="get_service_details(this.value)" required>
                            <option value="">Select Service</option>
                            <?php foreach ($services as $s): ?>
                                <option value="<?= $s->item_id ?>" data-name="<?= $s->name ?>"><?= $s->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="item" class="form-label">Item</label>
                            <select class="form-select" id="item" name="item" onchange="get_item_details(this.value)" required>
                             <option value="">Select Item</option>
                             <?php foreach ($items as $i): ?>
                                 <option value="<?= $i->item_id ?>" data-name="<?= $i->name ?>"><?= $i->name ?></option>
                             <?php endforeach; ?>
                        </select>

                    </div>
                </div>

                <div class="item-container">
                <table class="table table-bordered mt-3">
    <thead class="table-primary">
        <tr>
            <th>S.No</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="itemTableBody">
        <!-- Dynamic rows will be inserted here -->
    </tbody>
</table>

                </div>
                <!-- Notes & Estimate Amount (Fixed at the bottom) -->
                <div class="bottom-section">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Additional details..."></textarea>
                        </div>
                        <div class="col-md-6 text-end row">
                            <div class="col-md-6">
                            <h5>Service Charge</h5>
                            <h3 id="service_charge">$0.00</h3>
                            </div>
                            <div class="col-md-6">
                            <h5>Estimate Amount</h5>
                            <h3 id="estimate_amount">$0.00</h3>
                            </div>
                            
                            
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success">Save Estimate</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<script>
    function get_item_details(item_id) {
    if (item_id === "") {
        return; 
    }

    $.ajax({
        url: "<?= base_url();?>ajax/get_item_data/" + item_id, 
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (response.success) {
                addItemToTable(response.data);
            } else {
                alert("Item details not found.");
            }
        },
        error: function() {
            alert("Failed to fetch item details.");
        }
    });
}
function get_service_details(item_id){
    $.ajax({
        url: "<?= base_url();?>ajax/get_service_data/" + item_id, 
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (response.success) {
                updateServiceCharge(response.data);
            } else {
                alert("service details not found.");
            }
        },
        error: function() {
            alert("Failed to fetch service details.");
        }
    });
}
function updateServiceCharge(data) {
    alert(data);
    // Assuming the response contains a field 'service_charge' to be shown
    $("#service_charge").text(`$${parseFloat(data).toFixed(2)}`);
}

// Function to populate the table
function addItemToTable(item) {
    var tableBody = $("#itemTableBody");

    // Check if item already exists in the table
    if ($("#row_" + item.item_id).length) {
        alert("Item already added!");
        return;
    }

    var newRow = `
        <tr id="row_${item.item_id}">
            <td>${tableBody.children().length + 1}</td> <!-- Auto increment row number -->
            <td>${item.name}</td>
            <td><input type="number" class="form-control quantity" min="1" value="1" oninput="updateAmount(this, ${item.price})"></td>
            <td>${item.price}</td>
            <td class="amount">${item.price}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(${item.item_id})">Remove</button></td>
        </tr>
    `;

    tableBody.append(newRow);
    updateEstimateAmount();
}

// Function to update amount dynamically when quantity changes
function updateAmount(input, price) {
    var quantity = parseInt(input.value) || 1;
    // alert(quantity);
    var amountCell = $(input).closest("tr").find(".amount");
    amountCell.text(price * quantity);
    updateEstimateAmount();
}
function updateEstimateAmount() {
    var totalEstimate = 0;

    $(".amount").each(function () {
        totalEstimate += parseFloat($(this).text()) || 0;
    });
    // alert(totalEstimate);

    $("#estimate_amount").text(`$${totalEstimate.toFixed(2)}`); // Format as currency
}

// Function to remove a row when clicking "Remove" button
function removeRow(item_id) {
    $("#row_" + item_id).remove();
    updateRowNumbers();
    updateEstimateAmount();
}

// Function to update row numbers after deletion
function updateRowNumbers() {
    $("#itemTableBody tr").each(function (index) {
        $(this).find("td:first").text(index + 1);
    });
}

</script>
</body>
</html>
