<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100vh;
            background: linear-gradient(to right, #1a73e8 30%, #ffffff 70%);
        }

        .container {
            width: 60%;
            padding-left: 5%;
            color: white;
        }

        .image-container {
            width: 500px;
            height: 100vh;
            background: url('<?= base_url('images/login.jpg') ?>') no-repeat center;
            background-size: cover;
            border-radius: 0;
            position: absolute;
            right: 0;
            top: 0;
            mask-image: linear-gradient(to right, rgba(0, 0, 0, -1.3), rgba(0, 0, 0, 1));
            -webkit-mask-image: linear-gradient(to right, rgba(0, 0, 0, -1.3), rgba(0, 0, 0, 1));
        }

        h1 {
    font-size: 36px;
    font-weight: bold;
    text-align: center; 
      }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-section {
            flex: 1 1 45%;
            min-width: 220px;
        }

        label {
            display: block;
            font-size: 20px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="number"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-size: 18px;
            border: none;
        }

        button[type="submit"] {
            width: 100%;
            background: #2d80ed;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 22px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background: #0f5bbd;
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
            font-size: 20px;
        }

        .login-link a {
            color: #f1f1f1;
            text-decoration: none;
            font-weight: bold;
        }
        .password-container {
    position: relative;
    display: flex;
    align-items: center;
    width: fit-content;
}

input[type="password"],
input[type="text"] {
    padding-right: 30px; /* Space for the eye icon */
}

.toggle-password {
    position: absolute;
    right: 10px;
    cursor: pointer;
    font-size: 20px;
    color: #666;
    user-select: none;
}



    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <br>
        <form id="registerForm" action="<?=base_url();?>Signup/sign_up" method="POST">
            <!-- <div class="form-section">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" accept="image/*" required>
            </div> -->

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
                <input type="email" name="email" placeholder="Email Address" required>
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

            <div class="form-section">
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

<div class="form-section">
    <label for="password">Password:</label>
    <div class="password-container">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <span class="toggle-password" onclick="togglePassword()">
            <i class="fa fa-eye"></i>
        </span>
    </div>
</div>
<div class="form-section">
    <label for="password">Confirm Password:</label>
    <div class="password-container">
        <input type="password" name="Confirm password" id="Confirm password" placeholder="Confirm Password" required>
        <span class="toggle-password" onclick="togglePassword()">
            <i class="fa fa-eye"></i>
        </span>
    </div>
</div>
            <button type="submit">Register</button>
        </form>

        <p class="login-link">Already have an account? <a href="Login">Sign In</a></p>
    </div>
    <div class="image-container"></div>
    <script>
        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            // Toggle the password visibility
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            
            // Toggle the icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
