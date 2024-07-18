<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "order_db");


$edit = $_GET['edit'];

$sql = "SELECT * FROM events WHERE id = '$edit'";
$run = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_array($run)) {
    $id = $row['id'];
    $date = $row['Date'];
    $title = $row['title'];
    $description = $row['description'];
}

if (isset($_POST['submit'])) {
    $edit = $_GET['edit'];
    $date = $_POST['date'];
    $title = $_POST['title'];
    $description = $_POST['description'];
   

    $sql = "UPDATE events SET Date = '$date', title = '$title', description = '$description' WHERE id = '$edit'";

    if (mysqli_query($connection, $sql)) {
        echo '<script> location.replace("events_control.php")</script>';
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
    <title>VERTEX NOTIFY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1>EVENT CONTROL</h1>
                    </div>
                    <div class="card-body">
                        <form action="edit_events.php?edit=<?php echo $id; ?>" method="post">
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" name="id" class="form-control" placeholder="Enter ID" value="<?php echo $id; ?>" readonly>
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" placeholder="Enter Date" value="<?php echo $date; ?>">
                                <label>TITLE</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $title; ?>">
                                <label>DESCRIPTION</label>
                                <input type="text" name="description" class="form-control" placeholder="Enter Description" value="<?php echo $description; ?>">
                                <label for="description">Description:</label>
                		<textarea class="form-control" name="description" required></textarea>
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
