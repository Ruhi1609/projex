<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Body and Background */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4f94d4, #a3c8e1); /* Light Blue to Dark Blue */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Main Form Container */
        .login-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: left;
        }

        /* Header */
        h1 {
            color: #2e4c74;
            font-size: 28px;
            text-align: center;
            font-weight: 600;
            margin-bottom: 30px;
        }

        /* Form Elements Styling */
        label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
            color: #333333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f5f5f5;
            transition: 0.3s ease-in-out;
        }

        input:focus {
            outline: none;
            border-color: #4f94d4;
            background-color: #ffffff;
        }

        /* Show Password Icon */
        .password-container {
            position: relative;
        }

        .password-container input {
            padding-right: 10px; /* Space for the icon */
        }

        .show-password-icon {
            position: absolute;
            right: 10px;
            top: 63%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #4f94d4;
        }

        /* Button Styling */
        button {
            width: 100%;
            background: #4f94d4; /* Light Blue */
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #3578b0; /* Darker Blue */
        }

        /* Sign-Up Link */
        .signup-link {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #555555;
        }

        .signup-link a {
            color: #4f94d4;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
        <form action="<?=base_url();?>Login/login_process"  method="post">
            <div class="form-section">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-section password-container">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>
                <i id="togglePassword" class="fas fa-eye show-password-icon"></i>
            </div>
            <button type="submit">Sign In</button>
            <p class="signup-link">Don't have an account? <a href="signup">Sign Up</a></p>
        </form>
    </div>

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
