<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #007bff;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h4 {
            margin-bottom: 30px;
            text-align: center;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        /* Profile Container */
        .profile-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
            margin-left: 320px; /* Leave space for sidebar */
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        /* Profile Icon */
        .profile-icon {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            border: 2px solid #ddd;
            background-color: #eaeaea;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 80px;
            color: #999;
            overflow: hidden;
        }

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Profile Info */
        .profile-info {
            font-size: 20px;
            color: #333;
            flex: 1;
        }

        .profile-info p {
            margin: 10px 0;
            font-size: 22px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4><b>PROJEX</b></h4>
        <a href="<?= base_url(); ?>cust_dashboard">Dashboard</a>
        <a href="<?= base_url(); ?>project/cus_work_status">Work Status</a>
        <a href="<?= base_url(); ?>cust_dashboard/view_profile">Profile</a>
        <a href="<?= base_url(); ?>logout">Logout</a>
    </div>

    <!-- Profile Container -->
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-icon">
                <?php if ($cust_id) { ?>
                    <?php
                    $base_path = 'profile/';
                    $image_path = '';

                    if (file_exists($base_path . $cust_id . '.png')) {
                        $image_path = base_url($base_path . $cust_id . '.png');
                    } elseif (file_exists($base_path . $cust_id . '.jpg')) {
                        $image_path = base_url($base_path . $cust_id . '.jpg');
                    } elseif (file_exists($base_path . $cust_id . '.jpeg')) {
                        $image_path = base_url($base_path . $cust_id . '.jpeg');
                    } else {
                        $image_path = base_url('profile/default.png'); 
                    }
                    ?>
                    <img src="<?= $image_path; ?>" alt="Profile Picture" />
                <?php } else { ?>
                    <i class="fas fa-user"></i>
                <?php } ?>
            </div>

            <div class="profile-info" id="profileDetails">
                <?php foreach ($customer_details as $cust) { ?>
                    <p><strong>Name:</strong> <?= $cust->cust_name ?></p>
                    <p><strong>Phone:</strong> <?= $cust->phone ?></p>
                    <p><strong>Email:</strong> <?= $cust->email ?></p>
                    <p><strong>Address:</strong> <?= !empty($cust->address) ? $cust->address : 'N/A'; ?></p>
                    <p><strong>District:</strong> <?= !empty($cust->district_id) ? $cust->district_id : 'N/A'; ?></p>
                    <p><strong>State:</strong> <?= !empty($cust->state_id) ? $cust->state_id : 'N/A'; ?></p>
                    <button class="btn btn-edit" onclick="edit(<?= $cust->cust_id ?>)">Edit</button>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        function edit(cust_id) {
            window.location.href = "<?= base_url() ?>customer/edit/" + cust_id;
        }
    </script>
</body>
</html>
