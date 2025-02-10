<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Body and Background */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4f94d4, #a3c8e1);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            background-size: cover;
        }

        /* Form Container */
        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-top: 50px;
            text-align: left;
        }

        /* Header */
        h1 {
            color: #2e4c74;
            font-size: 30px;
            text-align: center;
            font-weight: 600;
            margin-bottom: 30px;
        }

        /* Form Elements */
        label {
            font-weight: 500;
            display: block;
            color: #333;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f5f5f5;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #4f94d4;
            background-color: #fff;
        }

        .form-section {
            margin-bottom: 20px;
        }

        /* Password Field */
        .password-container {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            right: 15px;
            top: 40%;
            transform: translateY(40%);
            cursor: pointer;
            font-size: 18px;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }

        /* Button Styling */
        button {
            width: 100%;
            background: #4f94d4;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background: #3578b0;
        }

        /* Login Link */
        .login-link {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }

        .login-link a {
            color: #4f94d4;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <form id="registerForm" action="<?=base_url();?>Signup/sign_up" method="POST">
            
            <!-- Profile Picture Upload -->
            <div class="form-section">
                <label for="profile_picture">Upload Profile Picture:</label>
                <input type="file" name="profile_picture" accept="image/*" required>
            </div>

            <!-- Personal Information -->
            <div class="form-section">
                <label for="name">Full Name:</label>
                <input type="text" name="name" placeholder="Full Name" required>
            </div>
            <div class="form-section">
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" required>
            </div>
            <div class="form-section">
                <label for="contact">Contact Number:</label>
                <input type="text" name="contact" placeholder="Contact Number" required>
            </div>
            <div class="form-section">
                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" placeholder="Email Address" required>
                <span class="error-message" id="emailError"></span>
            </div>
            <div class="form-section">
                <label for="address">Address:</label>
                <input type="text" name="address" placeholder="Address" required>
            </div>
            <div class="form-section">
                <label for="country">Country:</label>
                <input type="text" name="country" placeholder="Country" required>
            </div>
            <div class="form-section">
                <label for="state">State:</label>
                <input type="text" name="state" placeholder="State" required>
            </div>
            <div class="form-section">
                <label for="district">District:</label>
                <input type="text" name="district" placeholder="District" required>
            </div>
            <div class="form-section">
                <label for="city">City:</label>
                <input type="text" name="city" placeholder="City" required>
            </div>
            <div class="form-section">
                <label for="pincode">Pincode:</label>
                <input type="number" name="pincode" placeholder="Pincode" required>
            </div>

            <!-- Gender Selection -->
            <div class="form-section">
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Password Fields -->
            <div class="form-section password-container">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="error-message" id="passwordError"></span>
                <span class="eye-icon" onclick="togglePassword('password', this)">👁</span>
            </div>
            <div class="form-section password-container">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" required>
                <span class="error-message" id="confirmPasswordError"></span>
                <span class="eye-icon" onclick="togglePassword('confirmPassword', this)">👁</span>
            </div>

            <!-- Register Button -->
            <button type="submit">Register</button>
        </form>

        <!-- Login Link -->
        <p class="login-link">Already have an account? <a href="Login">Sign In</a></p>
    </div>

    <script>
        function togglePassword(fieldId, eyeIcon) {
            const field = document.getElementById(fieldId);
            field.type = field.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
