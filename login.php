

<?php include('./including/connect.php');

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<style>

    
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  padding: 100px 40px;
}

.container {
  background-color: #fff;
  padding:  35px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  width: 400px;
  margin: 0 auto;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
}

label {
  display: block;
  margin-bottom: 5px;
}
input[type="text"]{
    margin-bottom: 20px;
}
input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-sizing: border-box;
}
p a{
    color: #3074a4; 
}

button {
  background-color: #008CBA;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
}

button:hover {
  background-color: #0069D9;
}

.signup-link {
  text-align: center;
  margin-top: 20px;
}

.signup-link a {
  color: #008CBA;
  text-decoration: none;
}

.signup-link a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>

<div class="container">
  <h1>Login to Your Account</h1>

  <form action="user-dashboard.html" method="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" placeholder="Enter your username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required>
    <p><a href="#">Forgot password ?</a></p>

    <button type="submit">Login</button>
  </form>

  <div class="signup-link">
    <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
   
  </div>
</div>

</body>
</html>

<!--

 if ($users['Role'] === 'admin') {
                    header("Location: admin_dashboard.html");
                } else {
                    header("Location: user_dashboard.html");
                }

-->