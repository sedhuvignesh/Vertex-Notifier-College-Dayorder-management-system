<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> VERTEX NOTIFY </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #f4f4f4;
            color: #333;
            margin: 0;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            text-align: center;
            background-color: #fff; /* Content background color */
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 80%;
        }

        .login-logo {
            width: 80px; /* Adjust logo size */
            height: 80px; /* Adjust logo size */
            margin-bottom: 20px;
        }

        .login-header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .login-form {
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-btn,
        .back-btn {
            display: inline-block;
            width: 100%; /* Make buttons full width */
            padding: 12px 24px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 10px; /* Add margin to the top */
        }

        .login-btn {
            background-color: #007BFF;
            color: #fff;
        }

        .login-btn:hover {
            background-color: #0056B3;
        }

        .back-btn {
            background-color: #007BFF;
            color: #fff;
        }

        .back-btn:hover {
            background-color: #0056B3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="./picture/ngplogo.png" alt="College Logo" class="login-logo">
        <div class="login-header">Login</div>
        <?php
            $errorMessage = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];
                $password = $_POST["password"];

                // Replace with your database connection details
                $servername = "localhost"; // Replace this with the correct hostname or IP address of your MySQL server
                $db_username = "root"; // Your database username
                $db_password = ""; // Your database password
                $db_name = "order_db"; // Your database name

                // Create a connection
                $conn = new mysqli($servername, $db_username, $db_password, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query the database to check if the provided username and password exist
                $sql = "SELECT * FROM staff_login WHERE username = '$username' AND password = '$password'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    // Valid login, redirect to the index page
                    header("Location: day_control.php");
                    exit();
                } else {
                    // Invalid login
                    $errorMessage = "Invalid username or password.";
                }

                $conn->close();
            }
        ?>
        <form class="login-form" method="post" action="staff_login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <button class="back-btn" onclick="goBack()">Back</button>
        <?php
            if (!empty($errorMessage)) {
                echo '<p style="color: red; margin-top: 10px;">' . $errorMessage . '</p>';
            }
        ?>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
