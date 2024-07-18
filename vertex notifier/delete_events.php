<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "order_db");

// Ensure 'del' parameter is set and is a non-empty string
if (isset($_GET['del']) && $_GET['del'] !== '') {
    $delete = $_GET['del'];

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM events WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $delete); // Assuming 'title' is a VARCHAR type, use "s" for string

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($connection);
            header("Location: events_control.php"); // Redirect using header
            exit();
        } else {
            echo "Something went wrong: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Something went wrong with the prepared statement: " . mysqli_error($connection);
    }
} else {
    echo "Invalid or missing 'del' parameter.";
}

mysqli_close($connection);
?>
