<?php
include('./including/connect.php'); // Database connection
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['User_id'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit;
}

$user_id = $_SESSION['User_id']; // Get user ID from session

// Fetch the flight booking requests for this user
$sql_flights = "SELECT pr.request_id, pr.flight_id, f.Departure_city, f.Destination_city, f.Departure_date, pr.request_date, pr.request_status 
                FROM purchase_request pr
                JOIN flights f ON pr.flight_id = f.Flight_id
                WHERE pr.user_id = ?";  // Only fetch requests for the logged-in user
$stmt_flights = $con->prepare($sql_flights);
$stmt_flights->bind_param("i", $user_id);
$stmt_flights->execute();
$flight_requests_result = $stmt_flights->get_result();
$flight_requests = $flight_requests_result->fetch_all(MYSQLI_ASSOC);

// Fetch the hotel booking requests for this user
$sql_hotels = "SELECT hr.request_id, hr.hotel_id, h.Hotel_name, hr.status 
               FROM hotel_purchase_request hr
               JOIN Hotels h ON hr.hotel_id = h.Hotel_id
               WHERE hr.user_id = ?";  // Only fetch requests for the logged-in user
$stmt_hotels = $con->prepare($sql_hotels);
$stmt_hotels->bind_param("i", $user_id);
$stmt_hotels->execute();
$hotel_requests_result = $stmt_hotels->get_result();
$hotel_requests = $hotel_requests_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: rgb(86, 78, 112);
            color: #fff;
        }

        .navbar h1 {
            font-size: 1.5rem;
        }

        .navbar nav a {
            margin-left: 15px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        /* Section Heading */
        .requests {
            padding: 2rem;
            text-align: center;
        }

        .requests h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
        }

        .requests p {
            margin-bottom: 20px;
            font-size: 1rem;
            color: #555;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            margin: 0 auto;
            max-width: 90%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #005f99;
            color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styles */
        .approve, .reject {
            padding: 6px 12px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            border-radius: 4px;
            color: #fff;
        }

        .approve {
            background-color: #28a745;
            margin-right: 5px;
        }

        .reject {
            background-color: #dc3545;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar h1 {
                font-size: 1.2rem;
            }

            th, td {
                font-size: 0.9rem;
            }

            .approve, .reject {
                font-size: 0.8rem;
                padding: 5px 10px;
            }
        }

        .table-container {
            margin-top: 2rem;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <h1>SkySafe Travel</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="search.php">Flights</a>
            <a href="hotels.php">Hotels</a>
            <a href="contact.php">Contact Us</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <section class="requests">
        <h2>My Booking Requests</h2>
        <p>View and manage your flight and hotel booking requests below:</p>

        <div class="table-container">
            <!-- Flight Requests Table -->
            <h3>Flight Booking Requests</h3>
            <table>
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Flight ID</th>
                        <th>Departure City</th>
                        <th>Destination City</th>
                        <th>Departure Date</th>
                        <th>Request Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($flight_requests as $request): ?>
                        <tr>
                            <td><?= htmlspecialchars($request['request_id']) ?></td>
                            <td><?= htmlspecialchars($request['flight_id']) ?></td>
                            <td><?= htmlspecialchars($request['Departure_city']) ?></td>
                            <td><?= htmlspecialchars($request['Destination_city']) ?></td>
                            <td><?= htmlspecialchars($request['Departure_date']) ?></td>
                            <td><?= htmlspecialchars($request['request_date']) ?></td>
                            <td><?= htmlspecialchars($request['request_status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <!-- Hotel Requests Table -->
            <h3>Hotel Booking Requests</h3>
            <table>
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Hotel ID</th>
                        <th>Hotel Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hotel_requests as $request): ?>
                        <tr>
                            <td><?= htmlspecialchars($request['request_id']) ?></td>
                            <td><?= htmlspecialchars($request['hotel_id']) ?></td>
                            <td><?= htmlspecialchars($request['Hotel_name']) ?></td>
                            <td><?= htmlspecialchars($request['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </section>
</body>
</html>
