<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

 $connection = mysqli_connect("localhost", "root", "");

// Check if the connection is successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$db = mysqli_select_db($connection, "order_db");

// Check if the database selection is successful
if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
}

// Ensure 'del' parameter is set and is a non-empty string
if (isset($_GET['del']) && $_GET['del'] !== '') {
    $delete = $_GET['del'];

    // Debugging output
    echo "Delete parameter: " . $delete;

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM day_order WHERE date = ?";

    // Debugging output
    echo "SQL Query: " . $sql;

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $delete); // Assuming 'date' is a VARCHAR type, use "s" for string

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $affectedRows = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);

            // Close the connection
            mysqli_close($connection);

            if ($affectedRows > 0) {
                header("Location: day_control.php"); // Redirect using header if rows were affected
                exit();
            } else {
                echo "No records were deleted for date: " . $delete;
            }
        } else {
            echo "Something went wrong: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Something went wrong with the prepared statement: " . mysqli_error($connection);
    }
} else {
    echo "Invalid or missing 'del' parameter.";
}

// Close the connection if it hasn't been closed already
if (isset($connection)) {
    mysqli_close($connection);
}
?>
