<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation Form</title>
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
            min-height: 100vh;
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
            flex-grow: 1; 
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
            margin-top: auto; 
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
<?php 
        $lead_id = '';
        $lead_date = '';
        $cust_id ='';
        $type='';
        $item_id='';
        $final_est_amount = 0;
        $final_service_amt=0;
        $service_id='';
        $lead_id='';
        if(isset($lead)){
        foreach ($lead as $l) {
            $lead_number    = $l->lead_number;
            $lead_date  =$l->date;
            $cust_id    =$l->cust_id;
            $item_id    =$l->item_id;
            $final_est_amount = $l->amount;
            $final_service_amt =$l->price;
            $service_id  =$l->service_id;
            $lead_id =$l->lead_id;          
?><?php }}?>
    <h4 class="mb-3">Create Quotation</h4>
    <form class="d-flex flex-column" action="<?=base_url()?>project/quotation/process" method="post">
        <div class="form-wrapper d-flex">           
            <div class="left-section">
                <input type="hidden" value="<?=$lead_id?>" name="lead_id" >
                <input type="hidden" value="<?=$mode?>" name="mode">
                <input type="hidden" name="removed_items" id="removed_items" value="[]">

                <div class="row">
                    <div class="col-md-6">
                        <label for="estimate_number" class="form-label">Quotation Number</label>
                        <input type="text" class="form-control" id="quotation_number" name="quotation_number" placeholder="quotation_number" value="<?= isset($lead_number) ? $lead_number : ''; ?>" required> 
                    </div>
                    <div class="col-md-6">
                        <label for="estimate_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="quotation_date" name="quotation_date" value="<?= isset($lead_date) ? $lead_date:'';?>"required>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="customer" class="form-label">Customer</label>
                    <select class="form-select" id="customer" name="customer" required>
                        <option value="">Select Customer</option>
                        <?php foreach ($customer as $cust) 
                        {
                            $selected = '';
                            if($cust->cust_id == $cust_id)
                            {
                                $selected = 'selected="selected"';
                            }
                            ?>
                                <option <?= $selected ?> value="<?= $cust->cust_id ?>" data-name="<?= $cust->cust_name ?>"><?= $cust->cust_name ?></option>
                            <?php }; ?>
                    </select>
                </div>
            </div>

           
            <div class="vertical-line"></div>

           
            <div class="right-section">
                <div class="row">
                    <div class="col-md-6">
                        <label for="service" class="form-label">Service</label>
                        <select class="form-select" id="service" name="service" onchange="get_service_details(this.value)" required>
                            <option value="">Select Service</option>
                            <?php foreach ($services as $s) 
                        {
                           $selected = '';
                            if($s->service_id == $service_id)
                            {
                                $selected = 'selected="selected"';
                            } 
                            ?>
                                <option <?= $selected ?> value="<?= $s->service_id ?>" data-name="<?= $s->name ?>"><?= $s->name ?></option>
                            <?php }; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="item" class="form-label">Item</label>
                            <select class="form-select" id="item" name="item" onchange="get_item_details(this.value)" required>
                             <option value="">Select Item</option>
                             <?php foreach ($items as $i) 
                        {
                           $selected = '';
                            if($i->item_id == $item_id)
                            {
                                $selected = 'selected="selected"';
                            } 
                            ?>
                                <option <?= $selected ?> value="<?= $i->item_id ?>" data-name="<?= $i->name ?>"><?= $i->name ?></option>
                            <?php }; ?>
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
                <?php if(isset($lead_data)){echo $lead_data;}?>
 
              </tbody>
            </table>
         </div> 
                <div class="bottom-section">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Additional details..."></textarea>
                        </div>
                        <div class="col-md-6 text-end row">
                            <div class="col-md-6">
                            <h5>Service Charge</h5>
                            <h3 id="service_charge"><?=$final_service_amt?></h3>
                            <input type="hidden" name="service_amount" id="service_amount" value="<?=$final_service_amt?>">
                            </div>
                            <div class="col-md-6">
                            <h5>Total Amount</h5>
                            <h3 id="estimate_amount"><?=$final_est_amount?></h3>
                            <input id="total_est_amount" type="hidden" value="<?=$final_est_amount?>" name="total_est_amount" id="">
                            </div>
                            
                            
                        </div>
                    </div>

                   
                    <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">Save Quotation</button>

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
<?php if($mode == 'edit'){?>
    $(window).on('load', function(){
        get_service_details(<?=$service_id?>);
        updateEstimateAmount(); 
        $(".quantity").each(function () {
            let price = $(this).closest("tr").find("input[name='price[]']").val();
            updateAmount(this, price);
        });
    });
<?php } ?>
function addItemToTable(item) {
    var tableBody = $("#itemTableBody");
    if ($("#row_" + item.item_id).length) {
        alert("Item already added!");
        return;
    }

    var newRow = `
    <tr id="row_${item.item_id}">
        <td>${tableBody.children().length + 1}</td> <!-- Auto increment row number -->
        <td>${item.name}</td>
        <td><input type="hidden" name="item_id[]" value="${item.item_id}">
            <input type="number" name="quantity[]" class="form-control quantity" min="1" value="1" 
                   onkeyup="updateAmount(this, ${item.price})">
        </td>
        <td> <input type="hidden" name="price[]" value="${item.price}">${item.price}</td>

        <td>
            <input type="text" name="amount[]" class="form-control amount" value="${item.price}" readonly>
        </td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('${item.item_id}')">Remove</button></td>
    </tr>
`;


    tableBody.append(newRow);
    let newQuantityInput = $("#row_" + item.item_id).find(".quantity");
    updateAmount(newQuantityInput[0], item.price);
    updateEstimateAmount();
}

function updateAmount(input, price) {
    var quantity = parseInt($(input).val()) || 1; 
    var amountField = $(input).closest("tr").find(".amount");

    var newAmount = price * quantity;
    amountField.val(newAmount.toFixed(2)); 

    updateEstimateAmount(); 
}

function updateServiceCharge(data) {
    var serviceCharge = parseFloat(data) || 0;
    $("#service_charge").text(`₹${serviceCharge.toFixed(2)}`);
    $("#service_amount").val(serviceCharge.toFixed(2));
    updateEstimateAmount();
}

function updateEstimateAmount() {
    var totalEstimate = 0;

    $(".amount").each(function () {
        var value = parseFloat($(this).val()) || 0; 
        totalEstimate += value;
    });

    var serviceCharge = parseFloat($("#service_amount").val()) || 0; 
    var finalTotal = totalEstimate + serviceCharge; 

    $("#estimate_amount").text(`₹${finalTotal.toFixed(2)}`);
    $("#total_est_amount").val(finalTotal.toFixed(2));
}

// Function to remove a row when clicking "Remove" button
let removedItems = [];

function removeRow(itemId, rowId) {
    let rowElement = document.getElementById("row_" + rowId);
    
    if (rowElement) {
        removedItems.push(itemId); // Store removed item IDs
        rowElement.remove(); // Remove the row from the DOM

        // Update the hidden input field to track removed items
        document.getElementById("removed_items").value = JSON.stringify(removedItems);
    } else {
        console.error("Error: Row with ID 'row_" + rowId + "' not found.");
    }
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
