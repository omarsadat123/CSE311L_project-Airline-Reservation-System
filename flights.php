<!DOCTYPE html>
<link rel="stylesheet" href="styles.css">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights</title>
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
.results {
    padding: 2rem;
    text-align: center;
}

.results h2 {
    margin-bottom: 20px;
}

    </style>
</head>
<body>
    <header class="navbar">
        <h1>SkySafe Travel</h1>
        <nav>
            <a href="index.html">Home</a>
			<a href="search.html">Flights</a>
			<a href="hotels.html">Hotels</a>
			<a href="contact.html">Contact Us</a>
			<a href="index.html">Logout</a>

        </nav>
    </header>
    <section class="results">
        <h2>Available Flights</h2>
        <p>Flight details will be shown here.</p>
    </section>
</body>
</html>
