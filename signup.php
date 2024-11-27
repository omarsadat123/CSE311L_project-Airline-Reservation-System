
<?php include('./including/connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
<style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #6a11cb 0%);
    color: #333;
}

.registration-container {
    background-color: #fff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 400px;
}
.registration-container .close-btn{
            position: absolute;
            top: 205px;
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

.registration-container .close-btn:hover {
            color: red;
            background: none; /* Change color on hover */
        }

h2 {
    text-align: center;
    color: #2575fc;
    margin-bottom: 20px;
    font-size: 1.5em;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
}

input, select {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
}

input:focus, select:focus {
    border-color: #2575fc;
    outline: none;
    box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
}

button {
    background-color: #2575fc;
    color: #fff;
    padding: 10px;
    font-size: 1em;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #1e63d9;
}

.message {
    text-align: center;
    margin-top: 10px;
    font-size: 0.9em;
    color: #2575fc;
    
}
.message a {
    
    color:  #005f99;
    font-weight: bold;
}

</style>
</head>
<body>
    <div class="registration-container">
    <button class="close-btn" onclick="closeForm()">X</button>
        <h2>Register</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            
            <input type="text" id="name" name="name" autocomplete="off" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"autocomplete="off" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"autocomplete="off" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone"autocomplete="off" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" name="Registor">Registor</button> 
            <p id="message" class="message">Already have an account? <a href="login.php">Login here</a></p>
            
        </form>
    </div>
    <script src="register.js"></script>
</body>
</html>

<script>
    function closeForm() {
        // Redirect to index.php
        window.location.href = 'index.php';
    }
</script>

<?php
// Get form data
if (isset($_POST['Registor'])) {
    // Capture  data
    $name = $_POST['name'];
    $password = $_POST['password']; // Hash password for security
    $role = $_POST['role'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Check if the account already exists with the given email or phone number
    $sql_check = "SELECT * FROM users_email WHERE Email = ? UNION SELECT * FROM users_phone WHERE Phone_Number = ?";
    $stmt_check = $con->prepare($sql_check);
    $stmt_check->bind_param("ss", $email, $phone);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // If an account already exists, show an alert
        echo "<script>alert('An account with this email or phone number already exists.');</script>";
    } else {
        // Insert into users table
        $sql_users = "INSERT INTO users (Name,Password,Role) VALUES (?, ?, ?)";
        $stmt_users = $con->prepare($sql_users);
        $stmt_users->bind_param("sss", $name, $password, $role);
        $stmt_users->execute();

        // Get the last inserted User_id
        $user_id = $stmt_users->insert_id;

        // Insert into users_email table
        $sql_email = "INSERT INTO users_email (User_id, Email) VALUES (?, ?)";
        $stmt_email = $con->prepare($sql_email);
        $stmt_email->bind_param("is", $user_id, $email);
        $stmt_email->execute();

        // Insert into users_phone table
        $sql_phone = "INSERT INTO users_phone (User_id, Phone_Number) VALUES (?, ?)";
        $stmt_phone = $con->prepare($sql_phone);
        $stmt_phone->bind_param("is", $user_id, $phone);
        $stmt_phone->execute();

        // Show success message
        echo "<script>alert('Data inserted successfully');</script>";

        // Close statements
        $stmt_users->close();
        $stmt_email->close();
        $stmt_phone->close();
    }

    // Close the check statement and database connection
    $stmt_check->close();
    $con->close();
}
?>

