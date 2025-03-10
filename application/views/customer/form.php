<!DOCTYPE html>
<?php //print_r($employees)?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f9ff;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }
        .form-container {
            width: 100%;
            height: 100vh;
            background-color: #ffffff;
            padding: 25px;
            padding-bottom: 10px;
            overflow-y: auto;
        }
        hr {
            border-top: 3px solid rgb(156, 194, 234);
        }
        .form-header {
            color: #007bff;
            margin-bottom: 20px;
        }
        .btn-md {
            width: 200px;
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="form-container">
                <h1 class="form-header">Customer Form</h1>
                <form action="<?=base_url();?>customer/process" method="post">
                <?php 
                $cust_id = '';
                $contact_id ='';
                $login_id ='';
                $customer_name='';
                $phone_number='';
                $email='';
                $address='';
                $state='';
                $district='';
                $gender='';
                $dob='';
                $password='';

            if(isset($customer)){
            foreach ($customer as $cust) {
                $customer_name = $cust->cust_name;
                $cust_id = $cust->cust_id;
                $contact_id =$cust->contact_id;
                $login_id =$cust->login_id;
                $phone_number=$cust->phone;
                $email=$cust->email;
                $address=$cust->address;
                $state=$cust->state_id;
                $district=$cust->district_id;
                $gender=$cust->gender;
                $dob=$cust->dob;
                $password=$cust->password;


           
            ?><?php }}?>
                    <div class="d-flex justify-content-end mb-1">
                        <button type="submit" class="btn btn-primary btn-md">Save and Continue</button>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="emp_name">Customer Name</label>
                            <input type="text" class="form-control" id="cust_name" name="name" placeholder="Enter name" value="<?=$customer_name?>"  required>
                            <input type="hidden"  name="cust_id" value="<?=$cust_id?>">
                            <input type="hidden" name="login_id" value="<?=$login_id?>" >
                            <input type="hidden"name="contact_id" value="<?=$contact_id?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cust_img">Upload Image</label>
                            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" multiple>
                            <small class="form-text text-muted">Allowed formats: JPG, PNG</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="M" <?=  $gender == ' M' ? 'selected' : ''; ?>>Male</option>
                                <option value="F" <?=  $gender == ' F' ? 'selected' : ''; ?>>Female</option>
                                <option value="O" <?=  $gender == ' O' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">DOB</label>
                            <input type="date" class="form-control" id="dob" name="dob"  value="<?= $dob ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="phone">Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="<?=$phone_number ?>" required>
                        </div>
                    </div>

                    <!-- Email, Password, Confirm Password in One Row -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mail">E-mail</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Enter E-mail" value="<?= $email ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?=$password?>" required>
                                <div class="input-group-append">
                                    <span class="input-group-text eye-icon" onclick="togglePassword('password', this)">👁</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" value="<?=$password?>" required>
                                <div class="input-group-append">
                                    <span class="input-group-text eye-icon" onclick="togglePassword('confirmPassword', this)">👁</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function togglePassword(inputId, icon) 
                        {
                        var passwordField = document.getElementById(inputId);
                        if (passwordField.type === "password") 
                        {
                            passwordField.type = "text";
                            icon.textContent = "👁"; // Change to hide icon
                        } 
                        else 
                            {
                            passwordField.type = "password";
                            icon.textContent = "👁"; // Change back to show icon
                            }
                        }
                    </script>
                    <script>
                        function togglePassword(inputId, icon) 
                        {
                        var passwordField = document.getElementById(inputId);
                        if (passwordField.type === "password") 
                        {
                            passwordField.type = "text";
                            icon.textContent = "👁"; 
                        } 
                        else 
                            {
                            passwordField.type = "password";
                            icon.textContent = "👁"; 
                            }
                        }
                        </script>

                    <!-- Address, District, State in Another Row -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?= $address?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="district">District</label>
                            <input type="text" class="form-control" id="district" name="district" placeholder="Enter district" value="<?= $district ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter state"  value="<?= $state?>" required>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
