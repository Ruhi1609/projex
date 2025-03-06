<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            width: 500px;
            text-align: left;
            color: white;
            padding-left: 5%;
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

        .container h1 {
            font-size: 32px;
            font-weight: bold;
        }

        .container p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            margin: 20px 0;
            position: relative;
        }

        .input-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-field input {
            width: 100%;
            padding: 12px 40px 12px 40px;
            border: none;
            border-radius: 10px;
            font-size: 18px;
        }

        .input-field i {
            position: absolute;
            left: 15px;
            top: 65%;
            transform: translateY(-50%);
            color: #1a73e8;
            font-size: 18px;
        }

        #togglePassword{
            left:23rem !important;
        }

        .input-field input:focus {
            outline: none;
        }

        .password-container {
            position: relative;
        }

        .show-password-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #1a73e8;
            font-size: 18px;
        }

        .submit-btn {
            width: 100%;
            background: #2d80ed;
            color: white;
            border: none;
            padding: 16px;
            border-radius: 10px;
            font-size: 20px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: #0f5bbd;
        }
        .signup-link {
            margin-top: 30px;
            text-align: center;
            font-size: 18px !important;
            color:rgb(239, 241, 243);
        }

        .signup-link a {
            color:rgb(3, 15, 30);
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcomes you to,</h2>
        <h1>PROJEX</h1>
        <p>Turning Ideas into Reality!</p>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"> <?php echo $error_message; ?> </p>
        <?php endif; ?>
        <form action="<?=base_url();?>Login/login_process" method="post">
            <div class="input-field">
                <label for="username">Username</label>
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Enter Username" required>
            </div>
            <div class="input-field password-container">
                <label for="password">Password</label>
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>
                <i id="togglePassword" class="fas fa-eye show-password-icon"></i>
            </div>
            <button class="submit-btn" type="submit">Sign In</button> <br>
            <p class="signup-link">Don't have an account? <a href="signup">Sign Up</a></p>
        </form>
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
