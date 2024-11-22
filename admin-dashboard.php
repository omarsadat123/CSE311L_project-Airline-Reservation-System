<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    
    
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f8f9fc;
    color: #333;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: #564e70;
    color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar h1 {
    font-size: 1.75rem;
}

.navbar nav a {
    margin-left: 20px;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.navbar nav a:hover {
    color: #e0e0e0;
}

.logout {
    background-color: #e63946;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.logout:hover {
    background-color: #d32f2f;
}

/* Dashboard Content */
.dashboard-content {
    flex: 1;
    padding: 2rem;
    text-align: center;
}

.dashboard-content h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 1rem;
}

.dashboard-content p {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 2rem;
}

.admin-options {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.button {
    display: inline-block;
    background-color: #005f99;
    color: white;
    padding: 12px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #004175;
}

/* Footer */
.footer {
    background-color: #f1f1f1;
    color: #333;
    text-align: center;
    padding: 1rem;
    border-top: 1px solid #ddd;
}

.footer p {
    font-size: 0.9rem;
}

    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <h1>SkySafe Admin Panel</h1>
        <nav>
            <a href="pending-requests.php">Pending Requests</a>
            <a href="admin-add-flight.php">Add Flights</a>
            <a href="admin-add-hotel.php">Add Hotels</a>
            <a href="index.php" class="logout">Logout</a>
        </nav>
    </header>

    <!-- Dashboard Content -->
    <section class="dashboard-content">
        <h2>Welcome, Admin!</h2>
        <p>Use the links below to manage flights, hotels, and booking requests.</p>

        <!-- Admin Options -->
        <div class="admin-options">
            <a href="pending-requests.php" class="button">View Pending Requests</a>
            <a href="admin-add-flight.php" class="button">Add New Flight</a>
            <a href="admin-add-hotel.php" class="button">Add New Hotel</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 SkySafe Travels. All Rights Reserved.</p>
    </footer>
</body>
</html>
