<?php
session_start();
include('./including/connect.php'); // Include the database connection

// Initialize variables
$search_results = [];
$show_all_hotels = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_hotel'])) {
    $User_id = $_SESSION['User_id'] ?? null; // Ensure user_id is stored in the session
    $hotel_id = $_POST['hotel_id'];

    if (!$User_id) {
        echo "<p style='color: red; text-align: center;'>Please log in to book a hotel.</p>";
    } else {
        // Check available rooms
        $room_check = $con->prepare("SELECT Rooms FROM Hotels WHERE Hotel_id = ?");
        $room_check->bind_param("i", $hotel_id);
        $room_check->execute();
        $result = $room_check->get_result();
        $room_data = $result->fetch_assoc();

        if ($room_data['Rooms'] <= 0) {
            echo "<p style='color: red; text-align: center;'>No rooms available for this hotel.</p>";
        } else {
            // Insert into hotel_purchase_request table
            $sql = "INSERT INTO hotel_purchase_request (User_id, hotel_id, status) VALUES (?, ?, 'Pending')";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ii", $User_id, $hotel_id);

            if ($stmt->execute()) {
                // Decrement room count
                $update_rooms = $con->prepare("UPDATE Hotels SET Rooms = Rooms - 1 WHERE Hotel_id = ?");
                $update_rooms->bind_param("i", $hotel_id);
                $update_rooms->execute();
                echo "<p style='color: green; text-align: center;'>Booking request sent successfully!</p>";
            } else {
                echo "<p style='color: red; text-align: center;'>Error sending booking request: " . $con->error . "</p>";
            }

            $stmt->close();
        }

        $room_check->close();
    }
}

// Handle hotel search functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['book_hotel'])) {
    $hotel_name = $_POST['hotel_name'];

    // Prepare the SQL query for searching hotels by name
    $sql = "SELECT * FROM Hotels WHERE Hotel_name LIKE ?";
    $stmt = $con->prepare($sql);
    $search_term = "%" . $hotel_name . "%";
    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the search results
    if ($result->num_rows > 0) {
        $search_results = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $search_results = [];
    }

    $stmt->close();
    $show_all_hotels = false; // Don't show all hotels if search is performed
}

// Fetch all hotels if no search is performed
if ($show_all_hotels) {
    $sql = "SELECT * FROM Hotels";
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
    <title>Hotel Listings</title>
    <style>
       

        /* Search Form Styling */
        .search-form {
            max-width: 100%;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 10px;
        }

        .search-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-form button {
            width: 100%;
            padding: 10px;
            background-color: rgb(86, 78, 112);
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-form button:hover {
            background-color: rgb(66, 58, 92);
        }

        /* Hotels Display Grid */
        .hotels-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .hotel-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
        }

        .hotel-card h3 {
            margin-bottom: 10px;
            color: rgb(86, 78, 112);
        }

        .hotel-card p {
            margin-bottom: 5px;
            color: #555;
        }

        .card-footer {
            padding: 10px;
        }

        .card-footer button {
            background-color: #005f99;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .card-footer button:hover {
            background-color: #003d66;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include('navbar.php'); ?>

    <!-- Search Form -->
    <section class="search-form">
        <form action="" method="POST">
            <input type="text" name="hotel_name" placeholder="Search by hotel name" required>
            <button type="submit">Search</button>
        </form>
    </section>

    <!-- Hotel Listings -->
    <section class="hotels-container">
        <?php if (!empty($search_results)): ?>
            <?php foreach ($search_results as $hotel): ?>
                <div class="hotel-card">
                    <h3><?= htmlspecialchars($hotel['Hotel_name']) ?></h3>
                    <p><strong>Amenities:</strong> <?= htmlspecialchars($hotel['Amenities']) ?></p>
                    <p><strong>Room Type:</strong> <?= htmlspecialchars($hotel['Room_type']) ?></p>
                    <p><strong>Price per Night:</strong> $<?= htmlspecialchars($hotel['Price_per_night']) ?></p>
                    <p><strong>Rooms Available:</strong> <?= htmlspecialchars($hotel['Rooms']) ?></p>

                    <div class="card-footer">
                        <form method="POST" action="">
                            <input type="hidden" name="hotel_id" value="<?= $hotel['Hotel_id'] ?>">
                            <button type="submit" name="book_hotel">Book Now</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">No hotels found.</p>
        <?php endif; ?>
    </section>
</body>
</html>
