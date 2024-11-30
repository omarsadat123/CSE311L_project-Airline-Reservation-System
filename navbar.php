
<?php
// Start the session
session_start();

// Check if the session variable 'Name' is set
$user_name = isset($_SESSION['Name']) ? $_SESSION['Name'] : null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
     /* General reset */
     * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        /* Navbar container */
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center; /* Ensures vertical alignment */
            background-color: #564E70; /* Dark purple */
            padding: 15px 30px; /* Extra padding for spacing */
            color: #fff;
        }

        /* Logo styling */
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #FFD700; /* Gold color */
            cursor: pointer;
        }

        /* Menu styling */
        .menu {
            display: flex;
            gap: 30px; /* Adds equal spacing between menu items */
            align-items: center; /* Centers menu items vertically */
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            font-size: 18px; /* Slightly larger font size */
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .menu a:hover {
            color: #FFD700; /* Highlight on hover */
        }

        /* Button styling */
        .loginBtn {
            background-color: #FFD700; /* Gold color */
            color: #564E70; /* Dark purple */
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .loginBtn:hover {
            background-color: #fff;
            color: #564E70;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        /* Button styling */
        .authBtn {
            background-color: #FFD700; /* Gold color */
            color: #564E70; /* Dark purple */
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .authBtn:hover {
            background-color: #fff;
            color: #564E70;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

</style>
</head>
<body>
    <!-- navbar.php -->
<div class="nav">
    <!-- Logo -->
    <h1 class="logo">SkySafe Travel</h1>
    
    <!-- Menu Items -->
    <div class="menu">
    <a href="index.php" onclick="loadPage('index.php')">Home</a>
    <a href="search.php" onclick="loadPage('flights.php')">Flights</a>
    <a href="hotels.php" onclick="loadPage('hotels.php')">Hotels</a>
    <a href="my-bookings.php" onclick="loadPage('my-bookings.php')">My Bookings</a>
    <a href="contact.php" onclick="loadPage('contact.php')">Contact Us</a>
</div>
    <!-- Login/Logout and Signup Buttons -->
    <!-- Auth Section -->
    <div class="auth">
        <?php if (isset($_SESSION['User_id'])): ?>
            <span class="welcome">Welcome, <?php echo htmlspecialchars($user_name); ?>!</span>
            <button class="authBtn" onclick="window.location.href='logout.php'">Logout</button>
        <?php else: ?>
            <button class="authBtn" onclick="window.location.href='login.php'">Login</button>
            <button class="authBtn" onclick="window.location.href='signup.php'">Register</button>
        <?php endif; ?>
    </div>
</div>
</body>
</html>

<script>
    // Load content dynamically
    function loadPage(page) {
        fetch(page)
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data;
            })
            .catch(error => console.error('Error loading page:', error));
    }

    // Load the home page by default
    window.onload = () => loadPage('home.html');
</script>