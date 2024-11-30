<?php
session_start();
include('./including/connect.php');

// Ensure user is logged in
/*if (!isset($_SESSION['User_id'])) {
    echo "<script>
    alert('Please log in to book a flight.');
    window.location.href = 'login.php';
    </script>";
    exit;
}*/
// Initialize variables
$search_results = [];
$show_all_flights = true;

// Handle booking request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_flight'])) {
    $User_id = $_SESSION['User_id'] ?? null; // Ensure user_id is stored in the session
    $flight_id = $_POST['flight_id'];

    if (!$User_id) {
        echo "<p style='color: red; text-align: center;'>Please log in to book a flight.</p>";
    } else {
        // Check available seats
        $seat_check = $con->prepare("SELECT Total_seats FROM flights WHERE Flight_id = ?");
        $seat_check->bind_param("s", $flight_id);
        $seat_check->execute();
        $result = $seat_check->get_result();
        $seat_data = $result->fetch_assoc();

        if ($seat_data['Total_seats'] <= 0) {
            echo "<p style='color: red; text-align: center;'>No seats available for this flight.</p>";
        } else {
            // Insert into purchase_request table
            $sql = "INSERT INTO purchase_request (user_id, flight_id, request_status) VALUES (?, ?, 'Pending')";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("is", $User_id, $flight_id);

            if ($stmt->execute()) {
                // Decrement seat count
                $update_seats = $con->prepare("UPDATE flights SET Total_seats = Total_seats - 1 WHERE Flight_id = ?");
                $update_seats->bind_param("s", $flight_id);
                $update_seats->execute();
                echo "<p style='color: green; text-align: center;'>Booking request sent successfully!</p>";
            } else {
                echo "<p style='color: red; text-align: center;'>Error sending booking request: " . $con->error . "</p>";
            }

            $stmt->close();
        }

        $seat_check->close();
    }
}

// Existing search logic (unchanged)
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['book_flight'])) {
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];
    $departure_date = $_POST['departure_date'];

    $sql = "SELECT * FROM flights WHERE Departure_city = ? AND Destination_city = ? AND Departure_date = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $departure_city, $destination_city, $departure_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $search_results = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $search_results = [];
    }
    $stmt->close();

    $show_all_flights = false;
}

// Fetch all flights when no search criteria is provided
if ($show_all_flights) {
    $sql = "SELECT * FROM flights";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $search_results = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Flights</title>
    <style>
       

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 15px;
        }

        .search-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .search-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .search-container input, .search-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-container button {
            background-color: #005f99;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-container button:hover {
            background-color: #003d66;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-header {
            background-color: #005f99;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 1.2rem;
        }

        .card-content {
            padding: 20px;
            color: #555;
        }

        .card-content p {
            margin-bottom: 10px;
        }

        .card-content p strong {
            color: #333;
        }

        .price {
            font-size: 1.4rem;
            font-weight: bold;
            color: #005f99;
            margin-top: 10px;
            text-align: center;
        }

        .card-footer {
            padding: 15px;
            text-align: center;
        }

        .card-footer button {
            padding: 10px 20px;
            background-color: #005f99;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card-footer button:hover {
            background-color: #003d66;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

    <div class="container">
        <!-- Search Form -->
        <section class="search-container">
            <form action="" method="POST">
                <label for="departure_city">Departure City</label>
                <input type="text" id="departure_city" name="departure_city" placeholder="Enter Departure City" required>

                <label for="destination_city">Destination City</label>
                <input type="text" id="destination_city" name="destination_city" placeholder="Enter Destination City" required>

                <label for="departure_date">Departure Date</label>
                <input type="date" id="departure_date" name="departure_date" required>

                <button type="submit">Search Flights</button>
            </form>
        </section>

        <!-- Results Section -->
        <?php if (!empty($search_results)): ?>
            <section class="card-grid">
                <?php foreach ($search_results as $flight): ?>
                    <div class="card">
                        <div class="card-header">
                            Flight: <?= htmlspecialchars($flight['Flight_id']) ?>
                        </div>
                        <div class="card-content">
                            <p><strong>Airline:</strong> <?= htmlspecialchars($flight['Airline']) ?></p>
                            <p><strong>Total Seats:</strong> <?= htmlspecialchars($flight['Total_seats']) ?></p>
                            <p><strong>Departure:</strong> <?= htmlspecialchars($flight['Departure_city']) ?></p>
                            <p><strong>Destination:</strong> <?= htmlspecialchars($flight['Destination_city']) ?></p>
                            <p><strong>Date:</strong> <?= htmlspecialchars($flight['Departure_date']) ?></p>
                            <p class="price">Price: $<?= htmlspecialchars($flight['Price']) ?></p>
                        </div>
                        <div class="card-footer">
                            <form method="POST" action="">
                                <input type="hidden" name="User_id" value="<?= $_SESSION['User_id'] ?? '' ?>"> 
                                <input type="hidden" name="flight_id" value="<?= htmlspecialchars($flight['Flight_id']) ?>">
                                <button type="submit" name="book_flight">Book Now</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php else: ?>
            <p style="text-align: center; margin-top: 20px;">No flights found for your search criteria.</p>
        <?php endif; ?>
    </div>
</body>
</html>
