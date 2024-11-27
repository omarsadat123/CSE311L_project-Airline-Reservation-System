



<?php 
include('./including/connect.php');

// Start session
session_start();

// Check if the login form is submitted
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to get the user by email
    $sql = "SELECT u.User_id, u.Name, u.Password, u.Role
            FROM users u
            JOIN users_email ue ON u.User_id = ue.User_id
            WHERE ue.Email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password (assuming the password is hashed)
        if (($password === $user['Password'])) {
            $_SESSION['User_id'] = $user['User_id'];
            $_SESSION['Role'] = $user['Role'];
            $_SESSION['Name'] = $user['Name'];

            // Redirect based on role
            if ($user['Role'] === 'Admin') {
                echo "<script>
                alert('Login successful');
                window.location.href = 'admin-dashboard.php';
                </script>";
            } else {
                echo "<script>
                alert('Login successful');
                window.location.href = 'index.php';
                </script>";
            }
            exit;
        } else {
            echo "<script>alert('Incorrect password.')</script>";
        }
    } else {
        echo "<script>alert('User not found.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* General Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
            color: #333;
        }

.login-container {
            width: 350px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            text-align: center;
        }
.login-container .close-btn{
            position: absolute;
            top: 315px;
            right: 10px;
            background: none; /* Remove background */
            border: none; /* Remove border */
            font-size: 18px;
            cursor: pointer;
            color: #555; /* Button text color */
            font-weight: bold;
            padding-right: 800px; /* Remove padding */
            text-align: right;
        }

.login-container .close-btn:hover {
            color: red;
            background: none; /* Change color on hover */
        }

        h2 {
            margin-bottom: 22px;
            color: #005f99;
        }

        label {
            text-align: left;
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #005f99;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #004080;
        }

        .additional-links {
            margin-top: 20px;
            font-size: 14px;
        }

        .additional-links a {
            color: #005f99;
            text-decoration: none;
            font-weight: bold;
        }

        .additional-links a:hover {
            text-decoration: underline;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            margin-top: 15px;
        }

        .dropbtn {
            background-color: transparent;
            color: #005f99;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    <div class="login-container">
    <button class="close-btn" onclick="closeForm()">X</button>
        <h2>Login</h2>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>

            <div class="dropdown">
                <button class="dropbtn">Forgot Password?</button>
                <div class="dropdown-content">
                    <a href="forgot-password.html">Reset Password</a>
                </div>
            </div>
        </form>

        <div class="additional-links">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>

<script>
    function closeForm() {
        // Redirect to index.php
        window.location.href = 'index.php';
    }
</script>
