<?php
// Start the session
session_start();

// Prevent browser caching

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
// Check if the user is logged in
if (!isset($_SESSION['User_id']) || $_SESSION['Role'] !== 'User') {
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
    <title>User Dashboard</title>
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
        <h1>SkySafe Travel</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="search.php">Flights</a>
            <a href="hotels.php">Hotels</a>
            <a href="contact.php">Contact Us</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section class="user-dashboard">
        <h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
        <div class="search-section">
            <h3>Search for Flights and Hotels</h3>
            <p>Use the buttons above to navigate and search for available flights and hotel accommodations.</p>
        </div>
    </section>
</body>
</html>
