

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="styles.css">
    <style>
   
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}


header {
    background-color: rgb(86, 78, 112);
    padding: 15px 0;
    color: #fff;
}

header nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: auto;
    padding: 0 20px;
}

header h1 {
    font-size: 1.8em;
}

header ul {
    list-style-type: none;
}

header ul li {
    display: inline;
    margin-left: 15px;
}

header ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

header ul li a:hover {
    color: #ffdd57;
}


.container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}


section {
    padding: 60px 0;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #004aad;
    font-size: 2em;
}


#about p {
    text-align: center;
    font-size: 1.2em;
    margin-bottom: 40px;
}

.services {
    display: flex;
    justify-content: space-around;
    gap: 20px;
}

.service {
    text-align: center;
    max-width: 250px;
}

.service img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

.service h3 {
    margin-top: 10px;
    color: #004aad;
}

.service p {
    color: #555;
    font-size: 0.95em;
}



#member p {
    text-align: center;
    font-size: 1.2em;
    margin-bottom: 40px;
}

.team {
    display: flex;
    justify-content: space-around;
    gap: 20px;
}

.team-member {
    text-align: center;
    max-width: 200px;
}

.team-member img {
    width: 100%;
    height: auto;
    border-radius: 50%;
}

.team-member h3 {
    margin-top: 10px;
    color: #333;
}

.team-member p {
    color: #555;
}



#contact p {
    text-align: center;
    font-size: 1.1em;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.form-group {
    width: 100%;
    max-width: 500px;
}

label {
    font-weight: bold;
    color: #333;
}

input, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
}

input:focus, textarea:focus {
    outline: none;
    border-color: #004aad;
}

button {
    width: 100%;
    max-width: 200px;
    padding: 12px;
    background-color: #004aad;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #003080;
}


footer {
    text-align: center;
    padding: 20px 0;
    background-color: #004aad;
    color: #fff;
    font-size: 0.9em;
}

@media (max-width: 768px) {
    .services {
        flex-direction: column;
        align-items: center;
    }

    header nav {
        flex-direction: column;
        text-align: center;
    }
}

    </style>
</head>
<body>

    <!-- Nav -->
    <header>
        <nav>
            <h1>SkySafe</h1>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <h2>About Us</h2>
            <p>Your journey begins here! We are a trusted air travel agency dedicated to simplifying travel booking for destinations worldwide. With years of experience, we offer expert guidance, affordable fares, and top-notch customer support. Explore the world with confidence, knowing we’ve got your back from takeoff to landing!</p>
            <div class="services">
                <div class="service">
                   
                    <h3>Flight Booking</h3>
                    <p>We offer the best flight options at competitive rates to destinations worldwide.</p>
                </div>
                <div class="service">
                    
                    <h3>Travel Support</h3>
                    <p>Our 24/7 support ensures you have a smooth experience from booking to boarding.</p>
                </div>
                <div class="service">
                   
                    <h3>Hotel Bookings</h3>
                    <p>Need a unique travel itinerary? Let us create a custom travel plan just for you.</p>
                </div>
            </div>
        </div>
    </section>
    
     <section id="member">
        <div class="container">
            <h2>Members</h2>
            <p>Welcome to our company! We pride ourselves on delivering exceptional service and creating memorable experiences for our clients. With a team of experts dedicated to innovation and quality, we aim to meet and exceed expectations.</p>
            <div class="team">
                <div class="team-member">
                  
                    <h3>Omar Sadat</h3>
                    
                </div>
                <div class="team-member">
                   
                    <h3>Midhat </h3>
                   
                </div>
                <div class="team-member">
                  
                    <h3>Owaes Bin</h3>
                    
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
    <div class="container">
        <h2>Contact Us</h2>
        <p>Ready to start your journey? Reach out to us with any questions or booking requests. We're here to help make your travel dreams a reality!</p>
        <form action="" method="" >
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>
</section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Air Travel Agency. All rights reserved.</p>
    </footer>
    
    


</body>
</html>



