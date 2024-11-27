<?php
// Include the database connection file
include('./including/connect.php'); // Update the path based on your directory structure

// Initialize variables for search and results
$search_results = [];
$show_all_flights = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the search criteria from the form
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];
    $departure_date = $_POST['departure_date'];

    // Prepare the SQL query for search
    $sql = "SELECT * FROM flights WHERE Departure_city = ? AND Destination_city = ? AND Departure_date = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $departure_city, $destination_city, $departure_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the matched results
    if ($result->num_rows > 0) {
        $search_results = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $search_results = [];
    }

    $stmt->close();

    // Do not show all flights if a search is performed
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
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 15px;
        }

        /* Search Form */
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

        /* Card Grid */
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
                            Flight: <?= htmlspecialchars($flight['Flight_number']) ?>
                        </div>
                        <div class="card-content">
                            <p><strong>Airline:</strong> <?= htmlspecialchars($flight['Airline']) ?></p>
                            <p><strong>Seat Class:</strong> <?= htmlspecialchars($flight['Seat_class']) ?></p>
                            <p><strong>Departure:</strong> <?= htmlspecialchars($flight['Departure_city']) ?></p>
                            <p><strong>Destination:</strong> <?= htmlspecialchars($flight['Destination_city']) ?></p>
                            <p><strong>Date:</strong> <?= htmlspecialchars($flight['Departure_date']) ?></p>
                            <p class="price">Price: $<?= htmlspecialchars($flight['Price']) ?></p>
                        </div>
                        <div class="card-footer">
                            <button>Book Now</button>
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
