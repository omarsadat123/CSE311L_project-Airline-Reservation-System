<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Flight</title>
    <link rel="stylesheet" href="styles.css">
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

.hero {
    background: url('hero-image.jpg') no-repeat center center/cover;
   
    padding: 100px 20px;
    color: #fff;
}

.hero h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #005f99;
    text-align: center;
}

.search-bar {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 500px;
    margin: auto;
}

.hero .search-bar label {
    margin-top: 10px;
    font-weight: bold;
    color: #555;
    align-items: left;
}

.search-bar input, .search-bar button {
    padding: 10px;
    margin-top: 5px;
    width: 100%;
}

.search-bar button {
    background-color: #005f99;
    color: #fff;
    border: none;
    cursor: pointer;
    margin-top: 15px;
    font-size: 1rem;
}
.results {
    padding: 2rem;
    text-align: center;
}

.results h2 {
    margin-bottom: 20px;
}

.flight-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin: 10px auto;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.flight-card h3 {
    margin-bottom: 10px;
    color: #005f99;
}

.flight-card button {
    background-color: #005f99;
    color: #fff;
    padding: 8px 15px;
    border: none;
    cursor: pointer;
}

.admin {
    padding: 2rem;
    text-align: center;
}

.request-card {
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin: 10px auto;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.request-card p {
    margin: 5px 0;
}

.request-card .approve {
    background-color: #28a745;
    color: #fff;
    padding: 5px 10px;
    border: none;
    margin-right: 5px;
    cursor: pointer;
}

.request-card .reject {
    background-color: #dc3545;
    color: #fff;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
}

.admin-dashboard {
    padding: 2rem;
    text-align: center;
}

.admin-options {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.option-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    width: 250px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: left;
}

.option-card h3 {
    color: #005f99;
}

.option-card p {
    margin-bottom: 15px;
    font-size: 0.9rem;
    color: #555;
}

.option-card .button {
    display: inline-block;
    padding: 8px 15px;
    background-color: #008CBA;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
}

.option-card .button:hover {
    background-color: #0069D9;
}

.user-dashboard {
    padding: 2rem;
    text-align: center;
}

.search-section h3 {
    margin-bottom: 15px;
}

.search-section p {
    font-size: 1.1rem;
    color: #555;
}
.button {
    display: inline-block;
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin: 10px;
}

.button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <header class="navbar">
        <h1>SkySafe Admin Panel</h1>
        <nav>
            <a href="admin-dashboard.html">Dashboard</a>
			<a href="pending-requests.html">Pending Requests</a>
			<a href="admin-add-hotel.html">Add Hotels</a>
			<a href="index.html">Logout</a>

        </nav>
    </header>

    <section class="add-flight">
        <h2>Add New Flight</h2>

        <form action="" method="POST">
            <label for="flight-name">Flight Name:</label>
            <input type="text" id="flight-name" name="flight-name" required>

            <label for="departure-city">Departure City:</label>
            <input type="text" id="departure-city" name="departure-city" required>

            <label for="destination-city">Destination City:</label>
            <input type="text" id="destination-city" name="destination-city" required>

            <label for="departure-date">Departure Date:</label>
            <input type="date" id="departure-date" name="departure-date" required>

            <label for="arrival-date">Arrival Date:</label>
            <input type="date" id="arrival-date" name="arrival-date" required>

            <label for="flight-price">Price:</label>
            <input type="number" id="flight-price" name="flight-price" required>

            <button type="submit">Add Flight</button>
        </form>
    </section>
</body>
</html>
