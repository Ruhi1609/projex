<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item/Service Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="form-header">Add Item/Service</h2>
    <form action="<?= base_url();?>Items_service/process" method="POST">
    <div class="main-container" >
        <?php 
        $item_id = '';
        if(isset($items)){
        foreach ($items as $i) {
            $item_name = $i->name;
            $item_code =$i->item_code;
            $item_stock = $i->stock;
            $estimated_price = $i->price;
            $item_type = $i->type;
            $category=$i->category;
            $item_id=$i->item_id;
        ?><?php }}?>
        <div class="form-row" >
            <!-- Item/Service Name -->
            <div class="form-group col-sm-3">
                <label for="itemName"  class="form-label">Item/Service Name:</label>
                <input type="text" name="itemname" class="form-control form-control-lg" id="itemName" placeholder="Enter item or service name" value="<?= isset($item_name) ? $item_name : ''; ?>" required>
                <input type="hidden" name="item_id" value="<?=$item_id?>">
            </div>

            <!-- Item/Service Code -->
            <div class="form-group col-sm-3">
                <label for="itemCode" class="form-label">Item/Service Code:</label>
                <input type="text" name="itemcode" class="form-control form-control-lg" id="itemCode" placeholder="Enter item or service code" value="<?=isset($item_code)?$item_code:'';?>" required>
            </div>
            <div class="form-group col-sm-3">
                <label for="itemImage" class="form-label">Upload Item/Service Image:</label>
                <input type="file" class="form-control-file" id="itemImage" accept=".jpg, .jpeg, .png" required>
                <small class="form-text text-muted">Only JPG, JPEG, and PNG formats are allowed.</small>
            </div>
                    <div class="form-group col-sm-3">
                        <label for="itemStock"  class="form-label">Item stock:</label>
                        <input type="text" name="itemstock" class="form-control form-control-lg" id="itemCode" placeholder="Enter item or service stock" value="<?= isset($item_stock) ? $item_stock : ''; ?>"required>
                 </div>
            </div>
            <hr>
        <div class="form-row">
            <!-- Estimated Price -->
            <div class="form-group col-sm-3">
                <label for="estimatedPrice" class="form-label">Estimated Price:</label>
                <input type="number" name="price" class="form-control form-control-lg" id="estimatedPrice" placeholder="Enter estimated price" value="<?= isset($estimated_price) ? $estimated_price : ''; ?>"required>
            </div>

            <!-- Item Type -->
            <div class="form-group col-sm-3">
                <label for="itemType"  class="form-label">Item Type:</label>
                <select class="form-control form-control-lg" name="type" id="itemType" required>
                    <option value="" disabled selected>Select type</option>
                    <option value="product" <?= isset($item_type) && $item_type == 'product' ? 'selected' : ''; ?>>Product</option>
                    <option value="service" <?= isset($item_type) && $item_type == 'service' ? 'selected' : ''; ?>>Service</option>
                </select>
            </div>
            <div class="form-group col-sm-3">
                <label for="itemType"  class="form-label">Category:</label>
                <select class="form-control form-control-lg" name="category" id="itemType" required>
                    <option value="" disabled selected>Select categories</option>
                    <option value="stage_1" <?= isset($category) && $category == 'stage 1' ? 'selected' : ''; ?>>Stage 1</option>
                    <option value="stage_2" <?= isset($category) && $category == 'stage 2' ? 'selected' : ''; ?>>Stage 2</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-4">Save & Submit</button>
        
        
        </div>
    </form>
</div>
</body>
</html>
