<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style></style>
</head>
<style>
.sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #007bff; 
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            color: white;
            padding: 12px 15px;
            text-decoration: none;
            display: block;
            font-weight: bold;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }
        .header{
            font-weight:bold;
        }
        .dropdown {
            display: none;
            background-color: #007bff;
            padding: 12px 15px;
        }

        .dropdown a {
             padding: 8px 8px 8px 30px;
            display: block;
        }
        .dropdown a:hover{
            background-color: #0056b3;

        }
        .dropdown a:hover .arrow-left{
        display: inline-block;
        transform: rotate(270deg); 
        }
        .arrow {
        display: inline-block;
        transition: transform 0.3s ease;
        }

        #projects-link:hover .arrow {
        transform: rotate(180deg);
        }
        .arrow-left{
        display: inline-block;
        transition: transform 0.3s ease;
        }
        </style>
<body>
<div class="sidebar">
    <h4 class="text-center">PROJEX</h4>
    <a href="<?=base_url();?>dashboard">Dashboard</a>
    <a href="#" id="projects-link">Projects <span class="arrow">▼</span></a>
    <div class="dropdown" id="projects-dropdown"> 
        <a href="<?=base_url();?>project/estimate"><span class="arrow-left">▼ </span> Work Estimate</a>
        <a href="<?=base_url();?>project/quotation"><span class="arrow-left">▼ </span> WORK Quotation</a>
        <a href="<?=base_url();?>project/work_order"><span class="arrow-left">▼ </span> WORK Order</a>
    </div>
    <a href="<?=base_url();?>employee">Employee</a>
    <a href="<?=base_url();?>customer">Customer</a>
    <a href="<?=base_url();?>items_service">Items/Works</a>
    <a href="<?=base_url();?>logout">Logout</a>
</div>
</body>
<script>
     document.addEventListener("DOMContentLoaded", function () {
        let projectsLink = document.getElementById("projects-link");
        let dropdown = document.getElementById("projects-dropdown");

        projectsLink.addEventListener("click", function (event) {
            event.preventDefault();
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function (event) {
            if (!projectsLink.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = "none";
            }
        });
    });
</script>
</html>