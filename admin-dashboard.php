<?php

// Include the database connection file
include('./including/connect.php'); // Update the path based on your directory structure

// Start the session
session_start();

// Prevent browser caching

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
// Check if the user is logged in
if (!isset($_SESSION['User_id']) || $_SESSION['Role'] !== 'Admin') {
    // If not logged in or not a user, redirect to the login page
    header("Location: login.php");
    exit;
}

// Retrieve the user's name from the session
$user_name = $_SESSION['Name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        /* Navbar styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #005f99;
            padding: 10px 20px;
            color: #fff;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .navbar ul li a:hover {
            text-decoration: underline;
        }

        /* Admin info section */
        .admin-info {
            position: absolute;
            top: 70px;
            left: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }

        .admin-info h3 {
            color: #005f99;
            margin-bottom: 10px;
        }
        .admin-container {
            text-align: center;
            margin-top: 50px;
        }

        .insert-button {
            background-color: #005f99;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .insert-button:hover {
            background-color: #004080;
        }

        .form-container {
            position: absolute;
            top: -400px; /* Hidden initially */
            left: 50%;
            transform: translateX(-50%);
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s, top 0.5s; /* Smooth animation */
        }

.form-container.active {
            top: 100px; /* Final visible position */
            opacity: 1;
            visibility: visible; /* Ensure it's visible */
        }

.form-container h2 {
            text-align: center;
            color: #005f99;
            margin-bottom: 20px;
        }

.form-container .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none; /* Remove background */
            border: none; /* Remove border */
            font-size: 20px;
            cursor: pointer;
            color: #555; /* Button text color */
            font-weight: bold;
            padding-right: 5px; /* Remove padding */
            text-align: right;
        }

.form-container .close-btn:hover {
            color: red;
            background: none; /* Change color on hover */
        }

.form-container label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            text-align: left; /* Align label text to the left */
            padding-left: 10px;
            font-size: 14px;
        }

.form-container input {
            width: 90%; 
        }
.form-container select {
            width: 95%;
        }

.form-container input,
.form-container select {
           /* Make all input and select fields equal in width */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

.form-container button {
            width: 100%;
            padding: 10px;
            background-color: #005f99;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #004080;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">SkySafe</div>
        <ul>
            <li><a class="insert-button" onclick="toggleForm()">Add Flights</a></li>
            
            <li><a href="javascript:void(0);" onclick="toggleFlights()">Show Flights</a></li>
            <li><a href="#">Add Hotels</a></li>
            <li><a href="#">Show Hotels</a></li>
            <li><a href="">Pending Requests</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Admin Info -->
    <div class="admin-info">
        <h3>Admin Info</h3>
         <h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
    </div>

    <div class="admin-container">
    

    <div class="form-container" id="insertForm">
        <button class="close-btn" onclick="closeForm()">X</button>
        <h2>Insert Flight</h2>
        <form action="admin-dashboard.php" method="POST">
            <label for="flight_number">Flight Number:</label>
            <input type="text" id="flight_number" name="flight_number" required>

            <label for="seat_class">Seat Class:</label>
            <select id="seat_class" name="seat_class" required>
                <option value="Economy">Economy</option>
                <option value="Business">Business</option>
                <option value="First Class">First Class</option>
            </select>

            <label for="airline">Airline:</label>
            <input type="text" id="airline" name="airline" required>

            <label for="departure_city">Departure City:</label>
            <input type="text" id="departure_city" name="departure_city" required>

            <label for="destination_city">Destination City:</label>
            <input type="text" id="destination_city" name="destination_city" required>

            <label for="departure_date">Departure Date:</label>
            <input type="date" id="departure_date" name="departure_date" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" min="0" required>

            <button type="submit" name="submit">Insert Flight</button>
        </form>
    </div>
</div>


<!-- Show Flights Section -->
<div class="flights-container" id="flightsContainer" style="display: none;">
    <h2 style=" margin-top: 230px;">Flights List</h2>
    <table border="1" style="width: 100%; text-align: center; border-collapse: collapse; margin-top: 30px;">
        <thead>
            <tr style="background-color: #005f99; color: white;">
                <th>Flight Number</th>
                <th>Seat Class</th>
                <th>Airline</th>
                <th>Departure City</th>
                <th>Destination City</th>
                <th>Departure Date</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch flights from the database
            $sql = "SELECT * FROM flights"; // Replace 'flights' with your table name
            $result = $con->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['Flight_number']) . "</td>
                        <td>" . htmlspecialchars($row['Seat_class']) . "</td>
                        <td>" . htmlspecialchars($row['Airline']) . "</td>
                        <td>" . htmlspecialchars($row['Departure_city']) . "</td>
                        <td>" . htmlspecialchars($row['Destination_city']) . "</td>
                        <td>" . htmlspecialchars($row['Departure_date']) . "</td>
                        <td>$" . htmlspecialchars($row['Price']) . "</td>
                        <td>
                            <form action='' method='POST' style='display: inline;'>
                                <input type='hidden' name='delete_flight_id' value='" . htmlspecialchars($row['Flight_id']) . "'>
                                <button type='submit' name='delete' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No flights available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>




<script>
    // JavaScript function to toggle the visibility of the form
    function toggleForm() {
        const formContainer = document.getElementById('insertForm');
        formContainer.classList.add('active');
        flightsContainer.style.display = 'none';
    }

    // Function to close the form
    function closeForm() {
        const formContainer = document.getElementById('insertForm');
        formContainer.classList.remove('active');
    }


    function toggleFlights() {
    const flightsContainer = document.getElementById('flightsContainer');
    const formContainer = document.getElementById('insertForm');
    flightsContainer.style.display = flightsContainer.style.display === 'none' ? 'block' : 'none';
    formContainer.classList.remove('active');
}

</script>

</body>
</html>

<?php

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $flight_number = $_POST['flight_number'];
    $seat_class = $_POST['seat_class'];
    $airline = $_POST['airline'];
    $departure_city = $_POST['departure_city'];
    $destination_city = $_POST['destination_city'];
    $departure_date = $_POST['departure_date'];
    $price = $_POST['price'];

    // Prepare an SQL query to insert the data
    $sql = "INSERT INTO flights (Flight_number, Seat_class, Airline, Departure_city, Destination_city, Departure_date, Price) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind the statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssd", $flight_number, $seat_class, $airline, $departure_city, $destination_city, $departure_date, $price);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>
            alert('Flight inserted successfully!');
           
        </script>";// window.location.href = 'admin-dashboard.php'; // Redirect to the form page
    } else {
        echo "<script>
            alert('Error inserting flight: " . $stmt->error . "');
           
        </script>";// window.history.back(); // Go back to the form
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
}
?>
<?php
// Delete flight logic
if (isset($_POST['delete'])) {
    $flight_id = $_POST['delete_flight_id'];

    // Prepare SQL query to delete flight
    $sql = "DELETE FROM flights WHERE Flight_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $flight_id);

    if ($stmt->execute()) {
        echo "<script>alert('Flight deleted successfully!'); window.location.href='admin-dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting flight: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

