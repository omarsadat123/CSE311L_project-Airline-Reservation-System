
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Agency</title>
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
    </style>
</head>
<body>
    <header class="navbar">
    <h1>SkySafe Travel</h1>
    <nav>
		<a href="index.html">Home</a>
		<a href="search.html">Flights</a>
		<a href="hotels.html">Hotels</a>
		<a href="login.html">Login</a>

    </nav>
</header>

    
    <section class="hero">
        <h2>Find Your Perfect Flight</h2>
        <form class="search-bar">
            <label>Departure City</label>
            <input type="text" placeholder="Enter city" required>
            <label>Destination City</label>
            <input type="text" placeholder="Enter city" required>
            <label>Departure Date</label>
            <input type="date" required>
            <label>Return Date</label>
            <input type="date">
            <button type="submit">Search Flights</button>
        </form>
    </section>
</body>
</html>
