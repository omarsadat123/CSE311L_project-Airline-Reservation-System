<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hotel</title>
    <style>
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

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background-color:  rgb(86, 78, 112);
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
    </style>
</head>
<body>
    <header class="navbar">
        <h1>SkySafe Admin Panel</h1>
        <nav>
            <a href="admin-dashboard.html">Dashboard</a>
			<a href="pending-requests.html">Pending Requests</a>
			<a href="admin-add-flight.html">Add Flights</a>
			<a href="index.html">Logout</a>

        </nav>
    </header>

    <section class="add-hotel">
        <h2>Add New Hotel</h2>

        <form action="" method="POST">
            <label for="hotel-name">Hotel Name:</label>
            <input type="text" id="hotel-name" name="hotel-name" required>

            <label for="hotel-location">Location:</label>
            <input type="text" id="hotel-location" name="hotel-location" required>

            <label for="room-type">Room Type:</label>
            <input type="text" id="room-type" name="room-type" required>

            <label for="hotel-price">Price per Night:</label>
            <input type="number" id="hotel-price" name="hotel-price" required>

            <label for="hotel-availability">Available Rooms:</label>
            <input type="number" id="hotel-availability" name="hotel-availability" required>

            <button type="submit">Add Hotel</button>
        </form>
    </section>
</body>
</html>
