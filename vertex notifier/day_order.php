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
            background: none; /* Set background to none for transparency */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            max-width: 600px;
            width: 80%;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 32px;
        }

        label {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }

        p {
            font-size: 20px;
            color: #555;
            margin-top: 10px;
            font-weight: bold;
        }

        .back-btn {
            margin-top: 30px;
            padding: 12px 24px;
            font-size: 18px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .back-btn:hover {
            background-color: #0056B3;
        }

        @media (max-width: 767px) {
            h2 {
                font-size: 28px;
            }

            label {
                font-size: 20px;
            }

            p {
                font-size: 18px;
            }

            .container {
                width: 90%;
            }

            .back-btn {
                margin-top: 20px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-calendar-day"></i> Today Day Order</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "order_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $device_date = null;

        if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false)) {
            $device_date = date('Y-m-d');
        } else {
            $device_date = date('Y-m-d');
        }

        $sql = "SELECT * FROM day_order WHERE date='$device_date'";
        $result = $conn->query($sql);

        if ($result !== false) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $day_data = $row['day'];

                echo "<label>" . $device_date . "</label>";
                echo "<p>" . $day_data . "</p>";
            } else {
                echo "<p>No day order data found for " . $device_date . ".</p>";
            }
        } else {
            echo "<p>Error occurred while querying the database.</p>";
        }

        $conn->close();
        ?>
        <button class="back-btn" onclick="location.href='index.html'">Back to Home</button>
    </div>

    <!-- Bootstrap JS and jQuery (optional, needed for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
