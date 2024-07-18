
<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "order_db");

if (isset($_POST['submit'])) {
    $date = $_POST['Date'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "INSERT INTO events (Date, title, description, image) VALUES ('$date', '$title', '$description', '$image')";

    if (mysqli_query($connection, $sql)) {
        echo '<script> location.replace("events_control.php")</script>';
    } else {
        echo "Something went wrong: " . $connection->error;
    }
}

$sql = "SELECT * FROM events";
$run = mysqli_query($connection, $sql);
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
            left: 0;
            background-color: #2c3e50;
            padding-top: 50px;
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
            margin-left: 250px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <button class="sidebar-btn" onclick="location.href='events_control.php'">
                    <i class="fas fa-calendar-alt"></i> Event Control
                </button>
                <!-- Add other sidebar buttons as needed -->
                <button class="sidebar-btn" onclick="location.href='day_control.php'">
                    <i class="fas fa-calendar-alt"></i> Day Control
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
            <div class="col-md-9 content">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="mb-0">Event CONTROL</h1>
                    </div>
                    <div class="card-body">
                        <div class="btn-container">
                            <a href="add_events.php" class="btn btn-success text-light">Add New</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($run)) {
                                    $id = $row['id'];
                                    $date = $row['Date'];
                                    $title = $row['title'];
                                    $description = $row['description'];
                                  
                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $date ?></td>
                                        <td><?php echo $title ?></td>
                                        <td><?php echo $description ?></td>
                                        
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href='edit_events.php?edit=<?php echo $id ?>' class="btn btn-success text-light">Edit</a>
                                                <a href='delete_events.php?del=<?php echo $id ?>' class="btn btn-danger text-light">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
