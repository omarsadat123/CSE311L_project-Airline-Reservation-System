<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | SkySafe</title>
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

        /* Hero Section */
        .bg {
            background-image: url(./img/p1.jpg);
            background-size: cover;
            
            height: 20em;
            width: 100%;
            display: flex;
            align-items: center;
            padding-left: 30px;
        }

        .bg h1 {
            font-size: 36px;
            color: #fff;
        }

        .bg h4 {
            color: #f0f0f0;
        }

        /* Trending Destinations */
        .trending, .deals, .Airline {
            margin: 40px 30px;
            text-align: center;
        }

        .dealContainer {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .dealContainer .box {
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
        }

        /* Airlines Section */
        .air {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 20px;
        }

        /* Footer Styling */
        footer {
            background-color: #333;
            color: white;
            padding: 20px 30px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contact {
            text-align: left;
        }

        .copy {
            text-align: right;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="nav">
        <h1 class="logo">Cholo Palai</h1>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="login.php">Flights</a>
            <a href="contact.php">Contact Us</a>
        </div>

        <?php if (isset($_SESSION['User_id'])): ?>
            <button class="loginBtn" onclick="window.location.href='logout.php'">Logout</button>
        <?php else: ?>
            <button class="loginBtn" onclick="window.location.href='login.php'">Login/Register</button>
        <?php endif; ?>
    </div>

    <!-- Hero Section -->
    <div class="bg">
        <div>
            <h1>Where to Fly?</h1>
            <h4>Find Cheap Flights, Airline Tickets in Bangladesh</h4>
        </div>
    </div>

    <!-- Trending Destinations -->
    <div class="hero">
        <div class="trending">
            <h1>Trending Destinations</h1>
            <p>Expand your travel horizons with us! Diversify your journey to explore beautiful new destinations.</p>
            <div class="dealContainer">
                <img src="./img/cox.webp" class="box" width="320" height="156" alt="Cox's Bazar">
                <img src="./img/chit.jpg" class="box" width="320" height="156" alt="Chittagong">
                <img src="./img/joss.jpg" class="box" width="320" height="156" alt="Jossore">
                <img src="./img/syl.jpg" class="box" width="320" height="156" alt="Sylhet">
            </div>
        </div>

        <!-- Top Deals -->
        <div class="deals">
            <h1>Top Flight Deals</h1>
            <div class="dealContainer">
                <img src="./img/box1.png" class="box" width="320" height="156" alt="Deal 1">
                <img src="./img/box2.png" class="box" width="320" height="156" alt="Deal 2">
                <img src="./img/box3.png" class="box" width="320" height="156" alt="Deal 3">
            </div>
        </div>
    </div>

    <!-- Popular Airlines -->
    <div class="Airline">
        <h1>Most Popular Airlines</h1>
        <p>Discover top airlines on Cholo Palai and seamlessly search any flight and get any online ticket instantly.</p>
        <div class="air">
            <img src="./img/novo.png" alt="NovoAir" width="180">
            <img src="./img/us.png" alt="US Bangla" width="180">
            <img src="./img/biman.png" alt="Biman Bangladesh" width="180">
            <img src="./img/emi.png" alt="Emirates" width="180">
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="contact">
                <p>Email: cholopalai@project.com</p>
                <p>Phone: +123 456 7890</p>
            </div>
            <p class="copy">© Midhat Sadat Owaes</p>
        </div>
    </footer>
</body>
</html>
