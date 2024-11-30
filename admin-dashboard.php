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
            top: -400px;
            /* Hidden initially */
            left: 50%;
            transform: translateX(-50%);
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s, top 0.5s;
            /* Smooth animation */
        }

        .form-container.active {
            top: 100px;
           
            /* Final visible position */
            opacity: 1;
            visibility: visible;
            /* Ensure it's visible */
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
            background: none;
            /* Remove background */
            border: none;
            /* Remove border */
            font-size: 20px;
            cursor: pointer;
            color: #555;
            /* Button text color */
            font-weight: bold;
            padding-right: 5px;
            /* Remove padding */
            text-align: right;
        }

        .form-container .close-btn:hover {
            color: red;
            background: none;
            /* Change color on hover */
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            text-align: left;
            /* Align label text to the left */
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
       
    <li><a href="javascript:void(0);" onclick="toggleForm('insertForm', ['addHotelForm', 'flightsContainer', 'hotelsContainer'])">Add Flights</a></li>
    <li><a href="javascript:void(0);" onclick="toggleSection('flightsContainer', ['insertForm', 'addHotelForm', 'hotelsContainer'])">Show Flights</a></li>
    <li><a href="javascript:void(0);" onclick="toggleForm('addHotelForm', ['insertForm', 'flightsContainer', 'hotelsContainer'])">Add Hotels</a></li>
    <li><a href="javascript:void(0);" onclick="toggleSection('hotelsContainer', ['insertForm', 'addHotelForm', 'flightsContainer'])">Show Hotels</a></li>

            <li><a href="pending-request.php">Pending Requests</a></li>
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
                <input type="hidden" name="action" value="add_flight">
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

        <div class="form-container" id="addHotelForm">
            <button class="close-btn" onclick="closeHotelForm()">X</button>
            <h2>Add Hotel</h2>
            <form action="admin-dashboard.php" method="POST">
                <input type="hidden" name="action" value="add_hotel">
                <label for="hotel_name">Hotel Name:</label>
                <input type="text" id="hotel_name" name="hotel_name" required>

                <label for="amenities">Amenities:</label>
                <textarea id="amenities" name="amenities" rows="3" required></textarea>

                <label for="room_type">Room Type:</label>
                <input type="text" id="room_type" name="room_type" required>

                <label for="price_per_night">Price per Night:</label>
                <input type="number" id="price_per_night" name="price_per_night" step="0.01" required>

                <button type="submit" name="submit">Add Hotel</button>
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
                        <td>$". htmlspecialchars($row['Price']) . "</td>
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
    <div class="hotels-container" id="hotelsContainer" style="display: none;">
        <h2 style="margin-top: 230px;">Hotels List</h2>
        <table border="1" style="width: 100%; text-align: center; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr style="background-color: #005f99; color: white;">
                    <th>Hotel Name</th>
                    <th>Amenities</th>
                    <th>Room Type</th>
                    <th>Price per Night</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch hotels from the database
                $sql = "SELECT * FROM hotels"; // Replace 'hotels' with your table name
                $result = $con->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>" . htmlspecialchars($row['Hotel_name']) . "</td>
                        <td>" . htmlspecialchars($row['Amenities']) . "</td>
                        <td>" . htmlspecialchars($row['Room_type']) . "</td>
                        <td>$" . htmlspecialchars($row['Price_per_night']) . "</td>
                        <td>
                            <form action='' method='POST' style='display: inline;'>
                                <input type='hidden' name='delete_hotel_id' value='" . htmlspecialchars($row['Hotel_id']) . "'>
                                <button type='submit' name='deleteHotel' style='background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hotels available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>



    <script>
        function toggleSection(showId, allIds = []) {
    // Hide all other sections/forms
    allIds.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.remove('active');
            element.style.display = 'none'; // Ensure hidden
        }
    });

    // Show the target section
    const showElement = document.getElementById(showId);
    if (showElement) {
        const isHidden = !showElement.classList.contains('active');
        if (isHidden) {
            showElement.classList.add('active');
            showElement.style.display = 'block';
        } else {
            showElement.classList.remove('active');
            showElement.style.display = 'none';
        }
    }
}

function toggleForm(formId, allIds = []) {
    // Hide all other forms
    allIds.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.remove('visible');
            element.style.display = 'hidden'; // Ensure hidden
             // Use a timeout to ensure the "display: none" is applied after animation ends
             setTimeout(() => {
                element.classList.remove('active');
                element.style.display = 'none';
            }, 10); // Match CSS transition duration (0.3s)
        }
    });

    // Show the target form
    const formElement = document.getElementById(formId);
    if (formElement) {
        formElement.style.display = 'block'; // Ensure it's visible for animation
        setTimeout(() => {
            formElement.classList.add('active'); // Mark as active
            formElement.classList.remove('hidden'); // Remove hidden class
            formElement.classList.add('visible'); // Add visible class for animation
        }, 10); // Short delay to ensure CSS transition is triggered
    }
}

 //Function to close Hotel form
        function closeHotelForm() {
            const hotelFormContainer = document.getElementById('addHotelForm');
            hotelFormContainer.classList.remove('active');
        }
        function closeForm() {
            const formContainer = document.getElementById('insertForm');
            formContainer.classList.remove('active');
        }

       
    </script>

</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_flight':
            addFlight($_POST, $con);
            break;

        case 'add_hotel':
            addHotel($_POST, $con);
            break;

        default:
            break;
    }
}
function addFlight($data, $con)
{
    $flight_number = $data['flight_number'] ?? '';
    $seat_class = $data['seat_class'] ?? '';
    $airline = $data['airline'] ?? '';
    $departure_city = $data['departure_city'] ?? '';
    $destination_city = $data['destination_city'] ?? '';
    $departure_date = $data['departure_date'] ?? '';
    $price = $data['price'] ?? '';

    if (empty($flight_number) || empty($seat_class) || empty($airline) || empty($departure_city) || empty($destination_city) || empty($departure_date) || empty($price)) {
        echo "<script>
    alert('All fields are required.');
</script>";
        return;
    }

    $sql = "INSERT INTO flights (Flight_number, Seat_class, Airline, Departure_city, Destination_city, Departure_date, Price) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssd", $flight_number, $seat_class, $airline, $departure_city, $destination_city, $departure_date, $price);

    if ($stmt->execute()) {
        echo "<script>
    alert('Flight inserted successfully!');
</script>";
    } else {
        echo "<script>
    alert('Error inserting flight: " . $stmt->error . "');
</script>";
    }

    $stmt->close();
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
<?php

function addHotel($data, $con)
{
    $hotel_name = $data['hotel_name'] ?? '';
    $amenities = $data['amenities'] ?? '';
    $room_type = $data['room_type'] ?? '';
    $price_per_night = $data['price_per_night'] ?? '';

    if (empty($hotel_name) || empty($amenities) || empty($room_type) || empty($price_per_night)) {
        echo "<script>
            alert('All fields are required.');
        </script>";
        return;
    }

    $sql = "INSERT INTO hotels (Hotel_name, Amenities, Room_type, Price_per_night) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssd", $hotel_name, $amenities, $room_type, $price_per_night);

    if ($stmt->execute()) {
        echo "<script>
            alert('Hotel added successfully!');
            window.location.href = 'admin-dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Error inserting hotel: " . $stmt->error . "');
        </script>";
    }

    $stmt->close();
}
?>


<?php
if (isset($_POST['deleteHotel'])) {
    $hotel_id = $_POST['delete_hotel_id'];

    // Prepare SQL query to delete hotel
    $sql = "DELETE FROM hotels WHERE Hotel_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $hotel_id);

    if ($stmt->execute()) {
        echo "<script>alert('Hotel deleted successfully!'); window.location.href='admin-dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting hotel: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>