<?php
include('./including/connect.php'); // Database connection
session_start();

// Fetch flight requests where status is "Pending"
$sql_flights = "SELECT pr.request_id, u.Name AS user_name, f.Flight_id, f.Airline, f.Departure_city, f.Destination_city, pr.request_status 
                FROM purchase_request pr
                JOIN users u ON pr.user_id = u.User_id
                JOIN flights f ON pr.flight_id = f.Flight_id
                WHERE pr.request_status = 'Pending'";  // Only show pending requests
$flight_requests_result = $con->query($sql_flights);
$flight_requests = $flight_requests_result->fetch_all(MYSQLI_ASSOC);

// Fetch hotel requests where status is "Pending"
$sql_hotels = "SELECT hr.request_id, u.Name AS user_name, h.Hotel_id, h.Hotel_name, h.Room_type, h.Price_per_night, hr.status 
               FROM hotel_purchase_request hr
               JOIN users u ON hr.user_id = u.User_id
               JOIN Hotels h ON hr.hotel_id = h.Hotel_id
               WHERE hr.status = 'Pending'";  // Only show pending requests
$hotel_requests_result = $con->query($sql_hotels);
$hotel_requests = $hotel_requests_result->fetch_all(MYSQLI_ASSOC);

// Handle flight approval and rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Flight Approval
    if (isset($_POST['approve_flight'])) {
        $request_id = $_POST['request_id'];
        $flight_id = $_POST['flight_id'];

        // Update the status to "Approved"
        $sql = "UPDATE purchase_request SET request_status = 'Approved' WHERE request_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $stmt->close();

        // No need to decrement the seat again, as it was decremented already
        echo "<script>alert('Flight Request Approved');</script>";
    } 
    // Flight Rejection
    elseif (isset($_POST['reject_flight'])) {
        $request_id = $_POST['request_id'];
        $flight_id = $_POST['flight_id'];

        // Update the status to "Rejected"
        $sql = "UPDATE purchase_request SET request_status = 'Rejected' WHERE request_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();

        // Increment the seat back to available
        $sql_update_seats = "UPDATE flights SET Total_seats = Total_seats + 1 WHERE Flight_id = ?";
        $stmt_update_seats = $con->prepare($sql_update_seats);
        $stmt_update_seats->bind_param("s", $flight_id);
        $stmt_update_seats->execute();
        $stmt_update_seats->close();

        echo "<script>alert('Flight Request Rejected, Seat Re-Added');</script>";
    }

    // Hotel Approval
    if (isset($_POST['approve_hotel'])) {
        $request_id = $_POST['request_id'];
        $hotel_id = $_POST['hotel_id'];

        // Update the status to "Approved"
        $sql = "UPDATE hotel_purchase_request SET status = 'Approved' WHERE request_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('Hotel Request Approved');</script>";
    } 
    // Hotel Rejection
    elseif (isset($_POST['reject_hotel'])) {
        $request_id = $_POST['request_id'];
        $hotel_id = $_POST['hotel_id'];

        // Update the status to "Rejected"
        $sql = "UPDATE hotel_purchase_request SET status = 'Rejected' WHERE request_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();

        // Increment the room back to available
        $sql_update_rooms = "UPDATE Hotels SET Rooms = Rooms + 1 WHERE Hotel_id = ?";
        $stmt_update_rooms = $con->prepare($sql_update_rooms);
        $stmt_update_rooms->bind_param("s", $hotel_id);
        $stmt_update_rooms->execute();
        $stmt_update_rooms->close();

        echo "<script>alert('Hotel Request Rejected, Room Re-Added');</script>";
    }

    // After action, redirect to refresh the page and show updated requests
    header("Location: pending-request.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests</title>
    <style>
        /* General Styles */
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
            display: flex;
            justify-content: space-between;
        }

        .table-container div {
            width: 48%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <h1>SkySafe Admin Panel</h1>
        <nav>
            <a href="admin-dashboard.php">Dashboard</a>
            <a href="admin-add-flight.php">Add Flights</a>
            <a href="admin-add-hotel.php">Add Hotels</a>
            <a href="index.php">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <section class="requests">
        <h2>Pending Booking Requests</h2>
        <p>Review and manage booking requests from users.</p>

        <div class="table-container">
            <!-- Flight Requests Table -->
            <div>
                <h3>Flight Requests</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>User Name</th>
                            <th>Flight</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($flight_requests as $request): ?>
                            <tr>
                                <td><?= htmlspecialchars($request['request_id']) ?></td>
                                <td><?= htmlspecialchars($request['user_name']) ?></td>
                                <td><?= htmlspecialchars($request['Airline']) ?> (<?= htmlspecialchars($request['Flight_id']) ?>)</td>
                                <td><?= htmlspecialchars($request['request_status']) ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="request_id" value="<?= htmlspecialchars($request['request_id']) ?>">
                                        <input type="hidden" name="flight_id" value="<?= htmlspecialchars($request['Flight_id']) ?>">
                                        <button type="submit" name="approve_flight" class="approve">Approve</button>
                                        <button type="submit" name="reject_flight" class="reject">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Hotel Requests Table -->
            <div>
                <h3>Hotel Requests</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>User Name</th>
                            <th>Hotel</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hotel_requests as $request): ?>
                            <tr>
                                <td><?= htmlspecialchars($request['request_id']) ?></td>
                                <td><?= htmlspecialchars($request['user_name']) ?></td>
                                <td><?= htmlspecialchars($request['Hotel_name']) ?> (<?= htmlspecialchars($request['Hotel_id']) ?>)</td>
                                <td><?= htmlspecialchars($request['status']) ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="request_id" value="<?= htmlspecialchars($request['request_id']) ?>">
                                        <input type="hidden" name="hotel_id" value="<?= htmlspecialchars($request['Hotel_id']) ?>">
                                        <button type="submit" name="approve_hotel" class="approve">Approve</button>
                                        <button type="submit" name="reject_hotel" class="reject">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
