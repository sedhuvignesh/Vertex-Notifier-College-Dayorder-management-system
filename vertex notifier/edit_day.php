<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "order_db");

$edit = $_GET['edit'];

$sql = "SELECT * FROM day_order WHERE date = '$edit'";

$run = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_array($run)) {
    $date = $row['date'];
    $day = $row['day'];
}
?>

<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "order_db");


if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $day = $_POST['day'];
    $edit = $_GET['edit'];

    $sql = "UPDATE day_order SET date='$date', day='$day' WHERE date='$edit'";

    if (mysqli_query($connection, $sql)) {
        echo '<script> location.replace("day_control.php")</script>';
    } else {
        echo "Something went wrong: " . $connection->error;
    }
}
?>

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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            z-index: 3;
        }

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .row {
            margin-right: 0;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .btn-container {
            margin-bottom: 20px;
        }

        .btn-container a {
            text-decoration: none;
        }

        .btn-container .btn {
            margin-right: 10px;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #2c3e50;
            padding-top: 50px;
            transition: 0.3s;
            z-index: 2;
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
            color: #ecf0f1;
            margin-bottom: 10px;
            background-color: #2c3e50;
        }

        .sidebar-btn:hover {
            background-color: #34495e;
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
        <div class="row">
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
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h1>DAY ORDER CONTROL</h1>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" name="date" class="form-control" placeholder="Enter Date" value="<?php echo $date; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Day</label>
                                    <input type="text" name="day" class="form-control" placeholder="Enter Day" value="<?php echo $day ?>">
                                </div>
                                <br />
                                <input type="submit" class="btn btn-primary" name="submit" value="Edit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');

            if (sidebar.style.left === '-250px') {
                sidebar.style.left = '0';
                content.style.marginLeft = '250px';
            } else {
                sidebar.style.left = '-250px';
                content.style.marginLeft = '0';
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
