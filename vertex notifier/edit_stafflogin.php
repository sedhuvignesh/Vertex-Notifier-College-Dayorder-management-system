<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "order_db");

$edit = $_GET['edit'];

$sql = "SELECT * FROM staff_login WHERE username = '$edit'";

$run = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_array($run)) {
    $username = $row['username'];
    $password = $row['password'];
}
?>

<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "order_db");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $edit = $_GET['edit']; // Change this variable to $edit

    $sql = "UPDATE staff_login SET username='$username', password='$password' WHERE username='$edit'";

    if (mysqli_query($connection, $sql)) {
        echo '<script> location.replace("stafflogin_control.php")</script>';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1>STAFF LOGIN CONTROL</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>USERNAME</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter username"
                                       value="<?php echo $username; ?>">
                            </div>
                            <div class="form-group">
                                <label>Day</label>
                                <input type="text" name="password" class="form-control" placeholder="Enter password"
                                       value="<?php echo $password ?>">
                            </div>
                            <br/>
                            <input type="submit" class="btn btn-primary" name="submit" value="Edit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
