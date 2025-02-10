<!DOCTYPE html>
<?php //print_r($employees)?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
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
                <h1 class="form-header">Employee Form</h1>
                <form action="<?=base_url();?>Employee/process" method="post">
                <?php 
                $emp_id  = '';
                $contact_id ='';
                $login_id ='';

            if(isset($employees)){
            foreach ($employees as $emp) {
            $emp_name = $emp->emp_name;
            $emp_number =$emp->emp_code;
            $emp_id =$emp->emp_id;
            $emp_position=$emp->position_id;
            $department=$emp->dept_id;
            $salary = $emp->salary;
            $gender =$emp->gender;
            $address =$emp->address;
            $district =$emp->district_id;
            $state = $emp->state_id;
            $phone =$emp->phone;
            $mail=$emp->email;
            $employee_type=$emp->type;
            $salary_type=$emp->salary_type;
            $dob=$emp->dob;
            $password=$emp->password;
            $contact_id = $emp->contact_id;
            $login_id =  $emp->login_id;
            ?><?php }}?>
                
                    <div class="d-flex justify-content-end mb-1">
                        <button type="submit" class="btn btn-primary btn-md">Save and Continue</button>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="emp_name">Employee Name</label>
                            <input type="text" class="form-control" id="emp_name" name="name" placeholder="Enter name" value="<?= isset($emp_name) ? $emp_name : ''; ?>"  required>
                            <input type="hidden" name="emp_id" value="<?=$emp_id?>">
                            <input type="hidden" name="contact_id" value="<?=$contact_id?>">
                            <input type="hidden" name="login_id" value="<?=$login_id?>">
                        </div>

                        
                        <div class="form-group col-md-6">
                            <label for="emp_id">Employee ID</label>
                            <input type="text" class="form-control" id="emp_code" name="emp_code" placeholder="Enter employee ID" value="<?= isset($emp_number) ? $emp_number : ''; ?>"required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="emp_position">Employee Position</label>
                            <select class="form-control" id="emp_position" name="emp_position"  required>

                            <option value="" selected disabled>Select Position</option>
                            <option value="Interior Designer" <?= isset($emp_position) && $emp_position == 'Interior Designer' ? 'selected' : ''; ?>>Interior Designer</option>
                            <option value="Project Manager" <?= isset($emp_position) && $emp_position == 'Project Manager' ? 'selected' : ''; ?>>Project Manager</option>
                            <option value="Architect" <?= isset($emp_position) && $emp_position == 'Architect' ? 'selected' : ''; ?>>Architect</option>
                            <option value="3D Visualizer" <?= isset($emp_position) && $emp_position == '3D Visualizer' ? 'selected' : ''; ?>>3D Visualizer</option>
                            <option value="Site Supervisor" <?= isset($emp_position) && $emp_position == 'Site Supervisor' ? 'selected' : ''; ?>>Site Supervisor</option>

                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="department"required>
                                <option value="" selected disabled>Select Department</option>
                                <option value="Design" <?= isset($department) && $department == 'Design' ? 'selected' : ''; ?>>Design</option>
                                <option value="Project_management" <?= isset($department) && $department == 'Project_management' ? 'selected' : ''; ?>>Project Management</option>
                                <option value="Client_Relations" <?= isset($department) && $department == 'Client_relations' ? 'selected' : ''; ?>>Client Relations</option>
                                <option value="Construction" <?= isset($department) && $department == 'Construction' ? 'selected' : ''; ?>>Construction</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="salary">Salary</label>
                            <input type="number" class="form-control" id="salary" name="salary" placeholder="Enter salary amount" value="<?= isset($salary) ? $salary : ''; ?>"required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="M" <?= isset($gender) && $gender == ' M' ? 'selected' : ''; ?>>Male</option>
                                <option value="F" <?= isset($gender) && $gender == ' F' ? 'selected' : ''; ?>>Female</option>
                                <option value="O" <?= isset($gender) && $gender == ' O' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dob">DOB</label>
                            <input type="date" class="form-control" id="dob" name="dob"  value="<?= isset($dob) ? $dob : ''; ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="phone">Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="<?= isset($phone) ? $phone : ''; ?>" required>
                        </div>
                    </div>

                    <!-- Email, Password, Confirm Password in One Row -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mail">E-mail</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Enter E-mail" value="<?= isset($mail) ? $mail : ''; ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?= isset($password) ? $password:'';?>" required>
                                <div class="input-group-append">
                                    <span class="input-group-text eye-icon" onclick="togglePassword('password', this)">👁</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" value="<?= isset($password) ? $password:'';?>" required>
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
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?= isset($address) ? $address : ''; ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="district">District</label>
                            <input type="text" class="form-control" id="district" name="district" placeholder="Enter district" value="<?= isset($district) ? $district : ''; ?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter state"  value="<?= isset($state) ? $state : ''; ?>" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <!-- Employee Type -->
                        <div class="form-group col-md-4">
                            <label>Employee Type</label><br>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="emp_type" id="full_time" value="Full-time" 
                                <?= isset($employee_type) && trim($employee_type) == 'Full-time' ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="full_time">Full-time</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="emp_type" id="part_time" value="Part-time" <?= isset($employee_type) && trim($employee_type) == 'Part-time' ? 'checked' : ''; ?> required>

                                <label class="form-check-label" for="part_time">Part-time</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="emp_type" id="hourly" value="Hourly"<?= isset($employee_type) && trim($employee_type) == 'Hourly' ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="hourly">Hourly</label>
                            </div>
                        </div>

                        <!-- Salary Type -->
                        <div class="form-group col-md-4">
                            <label>Salary Type</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="salary_type" id="monthly" value='monthly' <?= isset($salary_type) && trim($salary_type) == 'monthly' ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="monthly">Monthly</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="salary_type" id="hourly_salary" value='hourly' <?= isset($salary_type) && trim($salary_type) == 'hourly' ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="hourly_salary">Hourly</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="salary_type" id="weekly" value='weekly' <?= isset($salary_type) && trim($salary_type) == 'weekly' ? 'checked' : ''; ?>  required>
                                <label class="form-check-label" for="weekly">Weekly</label>
                            </div>
                        </div>

                        <!-- Employee Document Upload -->
                        <div class="form-group col-md-4">
                            <label for="emp_docs">Upload Documents</label>
                            <input type="file" class="form-control-file" id="emp_docs" name="emp_docs[]" multiple required>
                            <small class="form-text text-muted">Allowed formats: PDF, DOC, JPG, PNG</small>
                        </div>
                    </div>

              

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
