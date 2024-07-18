<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> VERTEX NOTIFY </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
        }

        #toggleSidebarBtn {
            position: fixed;
            left: 10px;
            top: 10px;
            background-color: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
            z-index: 3; /* Keep the toggle button on top */
        }

        .container-fluid {
            margin-top: 20px;
            display: flex;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #2c3e50; /* Sidebar color */
            padding-top: 50px;
            transition: 0.3s;
            z-index: 2; /* Ensure the sidebar is below the toggle button */
        }

        .sidebar-btn {
            padding: 15px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
            width: 100%;
            text-align: left;
            color: #ecf0f1; /* Text color */
            margin-bottom: 10px;
            background-color: #2c3e50; /* Button color */
        }

        .sidebar-btn:hover {
            background-color: #34495e; /* Darker button color on hover */
        }

        .content {
            margin-left: 0;
            padding: 15px;
            transition: 0.3s;
            width: 100%;
        }
    </style>
</head>
<body>
    <button id="toggleSidebarBtn" class="btn btn-dark" onclick="toggleSidebar()">☰</button>

    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <button class="sidebar-btn" onclick="location.href='day_control.php'">
                <i class="fas fa-calendar-alt"></i> Day Order Control
            </button>
            <button class="sidebar-btn" onclick="location.href='events_control.php'">
                <i class="fas fa-calendar-alt"></i> Events Control
            </button>
            <button class="sidebar-btn" onclick="location.href='stafflogin_control.php'">
                <i class="fas fa-calendar-alt"></i> Staff Login Control
            </button>
            <button class="sidebar-btn" onclick="location.href='studentlogin_control.php'">
                <i class="fas fa-calendar-alt"></i> Student Login Control
            </button>
            <button class="sidebar-btn" onclick="location.href='logout.php'">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>

        <!-- Main Content -->
        <div class="content">
             <div class="col-md-9 content">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="mb-0">DAY ORDER CONTROL</h1>
                    </div>
                    <div class="card-body">
                        <div class="btn-container">
                            <a href="add_day.php" class="btn btn-success text-light">Add New</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $connection = mysqli_connect("localhost", "root", "");
				$db = mysqli_select_db($connection, "order_db");

                                $sql = "select * from day_order";
                                $run = mysqli_query($connection, $sql);
                                $id = 1;

                                while ($row = mysqli_fetch_array($run)) {
                                    $date = $row['date'];
                                    $day = $row['day'];
                                ?>

                                <tr>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $day ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href='edit_day.php?edit=<?php echo $date ?>' class="btn btn-success text-light">Edit</a>
                                            <a href='delete_day.php?del=<?php echo $date ?>' class="btn btn-danger text-light">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $id++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');

            if (sidebar.style.left === '-250px') {
                sidebar.style.left = '0';
            } else {
                sidebar.style.left = '-250px';
            }
        }
    </script>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');

            if (sidebar.style.left === '-250px') {
                sidebar.style.left = '0';
            } else {
                sidebar.style.left = '-250px';
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
