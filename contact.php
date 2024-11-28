




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Travel Agency</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        

        h2 {
            color: #0078D7;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        section {
            padding: 40px 0;
        }

        .services, .team {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding-top: 30px;
            justify-content: space-around;
        }

        .service, .team-member {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 30%;
            min-width: 280px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .service h3, .team-member h3 {
            color: #0078D7;
            margin-bottom: 10px;
        }

        #contact .form-group {
            margin-bottom: 15px;
        }

        #contact label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        #contact input, #contact textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        #contact button {
            background: #0078D7;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        #contact button:hover {
            background: #005bb5;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 40px;
        }

       
        
    </style>
</head>
<body>

   <?php include 'navbar.php'; ?>

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

    <!-- Members Section -->
    <section id="member">
        <div class="container">
            <h2>Members</h2>
            <p>Welcome to our company! We pride ourselves on delivering exceptional service and creating memorable experiences for our clients. With a team of experts dedicated to innovation and quality, we aim to meet and exceed expectations.</p>
            <div class="team">
                <div class="team-member">
                    <h3>Omar Sadat</h3>
                </div>
                <div class="team-member">
                    <h3>Midhat</h3>
                </div>
                <div class="team-member">
                    <h3>Owaes Bin</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Ready to start your journey? Reach out to us with any questions or booking requests. We're here to help make your travel dreams a reality!</p>
            <form action="" method="">
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

