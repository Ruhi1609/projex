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
        #registerForm {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            margin-bottom: 15px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .profile-picture-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-picture-box {
            width: 150px;
            height: 150px;
            border: 2px dashed #007bff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .profile-picture-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <br>
    <form id="registerForm" action="<?=base_url();?>Signup/sign_up" method="POST" enctype="multipart/form-data">
    <div class="profile-picture-section">
            <label for="profile_picture">Profile Picture:</label>
            <div class="profile-picture-box" onclick="document.getElementById('profile_picture').click()">
        <img id="profileImage" src="<?= base_url('images/prof.jpg') ?>" alt="Profile Picture">
        <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg, image/png" required onchange="previewImage(event)">
    </div>

        <div class="form-section">
            <label for="name">Full Name:</label>
            <input type="text" name="name" placeholder="Full Name" required>
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
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword('password')">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
        </div>

        <div class="form-section">
            <label for="confirm_password">Confirm Password:</label>
            <div class="password-container">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <span class="toggle-password" onclick="togglePassword('confirm_password')">
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
         function previewImage(event) {
            const input = event.target;
            const file = input.files[0];
            const preview = document.getElementById('profileImage');
            
            if (file && (file.type === "image/jpeg" || file.type === "image/png")) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert("Please select a .jpg or .png image.");
                input.value = ""; 
            }
        }
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        togglePassword.addEventListener('click', function () {
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
