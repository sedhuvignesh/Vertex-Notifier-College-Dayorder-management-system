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
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: -260px;
            height: 100%;
            width: 250px;
            background-color: #2c3e50; /* Sidebar color */
            padding-top: 50px;
            transition: 0.3s;
            z-index: 2;
            display: flex;
            flex-direction: column;
        }

        #toggleSidebarBtn {
            position: fixed;
            left: 10px;
            top: 10px;
            background-color: #2c3e50; /* Button color */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
            z-index: 3;
        }

        #toggleSidebarBtn:hover {
            background-color: #34495e; /* Darker button color on hover */
        }

        .sidebar-btn {
            padding: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            text-align: left;
            color: #ecf0f1; /* Text color */
            margin-bottom: 10px;
            background-color: #2c3e50; /* Button color */
            display: flex;
            align-items: center;
        }

        .sidebar-btn i {
            margin-right: 10px;
        }

        .sidebar-btn:hover {
            background-color: #34495e; /* Darker button color on hover */
        }

        .events-container {
            text-align: center;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 800px;
            width: 80%;
            margin: auto; /* Center the container */
            margin-top: 50px; /* Adjusted margin for better positioning */
        }

        .college-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .college-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .college-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .event-card {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            cursor: pointer;
            text-align: left; /* Align text to the left within event cards */
        }

        .event-card:hover {
            transform: scale(1.05);
        }

        .event-date {
            font-size: 18px;
            color: #007BFF;
            margin-bottom: 10px;
        }

        .event-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .event-description {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .event-image {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
            border-radius: 8px;
        }

        .view-details {
            color: #007BFF;
            font-size: 14px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .view-details:hover {
            color: #0056B3;
        }

        @media only screen and (max-width: 768px) {
            #sidebar {
                left: -250px;
            }

            #toggleSidebarBtn {
                left: 10px;
            }
        }
    </style>
</head>

<body>
    <div id="sidebar">
        <button class="sidebar-btn" onclick="location.href='index.html'">
            <i class="fas fa-home"></i> Home
        </button>
    </div>

    <button id="toggleSidebarBtn" onclick="toggleSidebar()">☰</button>

    <div class="events-container">
        <div class="college-header">
            <img src="./picture/ngplogo.png" alt="College Logo" class="college-logo">
            <div class="college-name">Dr.N.G.P. Arts and Science College</div>
        </div>

        <?php
        // Database configuration
        $servername = "localhost"; // Replace this with the correct hostname or IP address of your MySQL server
        $username = "root";
        $password = "";
        $dbname = "order_db";
        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to get events from the database
        $sql = "SELECT * FROM events";
        $result = $conn->query($sql);

        // Display events
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $formattedDate = date("F j, Y", strtotime($row['Date'])); // Format the date
                echo '<div class="event-card" onclick="showDetails(\'' . $row['title'] . '\', \'' . $row['description'] . '\')">';
                echo '<div class="event-date">' . $formattedDate . '</div>';
                echo '<div class="event-title">' . $row['title'] . '</div>';
                echo '<div class="event-description">' . $row['description'] . '</div>';
                echo '</div>';
            }
        } else {
            echo "No events found.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <div id="eventDetailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="eventDetailsTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="eventDetailsBody"></div>
            </div>
        </div>
    </div>

    <!-- Include necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var sidebarBtn = document.getElementById('toggleSidebarBtn');

            if (sidebar.style.left === '-260px') {
                sidebar.style.left = '0';
            } else {
                sidebar.style.left = '-260px';
            }
        }

        function showDetails(title, description) {
            // Display event details in a modal
            $('#eventDetailsTitle').text(title);
            $('#eventDetailsBody').text(description);
            $('#eventDetailsModal').modal('show');
        }
    </script>
</body>

</html>
