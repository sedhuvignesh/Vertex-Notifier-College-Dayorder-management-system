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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: #f4f4f4;
        }

        .container {
            text-align: center;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff; /* Match home page background color */
            border-radius: 15px;
            max-width: 600px;
            width: 80%;
        }

        h2 {
            margin-bottom: 20px;
            color: #007BFF;
            font-size: 36px; /* Match home page font size */
            font-weight: bold;
        }

        label {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        p {
            font-size: 20px;
            color: #555;
            margin-top: 10px;
            font-weight: bold;
        }

        .search-form {
            margin-top: 20px;
        }

        .search-form label {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .search-form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-btn,
        .back-btn {
            padding: 12px 24px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        .search-btn {
            background-color: #007BFF;
            color: #fff;
            border: none;
        }

        .search-btn:hover,
        .back-btn:hover {
            background-color: #0056B3;
        }

        .back-btn {
            margin-top: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
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

            .search-form label {
                font-size: 16px;
            }

            .search-form input[type="date"] {
                font-size: 14px;
            }

            .search-btn,
            .back-btn {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $servername = "localhost"; // Replace this with the correct hostname or IP address of your MySQL server
        $username = "root";
        $password = "";
        $dbname = "order_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['selected_date'])) {
            $selected_date = $_POST['selected_date'];

            // Query to get the day order data for the selected date
            $sql = "SELECT day FROM day_order WHERE date='$selected_date'";
            $result = $conn->query($sql);

            if ($result !== false) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $day_data = $row['day'];

                    echo "<h2><i class='fas fa-calendar-alt'></i> Search Day Orders</h2>";
                    echo "<label>Selected Date</label>";
                    echo "<p>$selected_date</p>";
                    echo "<p>$day_data</p>";
                    echo "<button class='back-btn' onclick='goBack()'>Back</button>";
                } else {
                    echo "<h2><i class='fas fa-calendar-alt'></i> Search Day Orders</h2>";
                    echo "<p>No day order data found for $selected_date.</p>";
                    echo "<button class='back-btn' onclick='goBack()'>Back</button>";
                }
            } else {
                echo "<h2><i class='fas fa-calendar-alt'></i> Search Day Orders</h2>";
                echo "<p>Error occurred while querying the database.</p>";
                echo "<button class='back-btn' onclick='goBack()'>Back</button>";
            }
        } else {
            echo "<h2><i class='fas fa-calendar-alt'></i> Search Day Orders</h2>";
            echo "<form method='post' class='search-form'>";
            echo "<label>Select a Date</label>";
            echo "<input type='date' name='selected_date' required>";
            echo "<br>";
            echo "<button type='submit' class='search-btn'>Search</button>";
            echo "</form>";
            echo "<button class='back-btn' onclick='goBack()'>Back to Home</button>";
        }

        $conn->close();
        ?>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <!-- Bootstrap JS and jQuery (optional, needed for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
