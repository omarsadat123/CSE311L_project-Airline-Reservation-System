<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests</title>
    
    <style>
    /* General Styles */
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

/* Navbar */
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

/* Section Heading */
.requests {
    padding: 2rem;
    text-align: center;
}

.requests h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 10px;
}

.requests p {
    margin-bottom: 20px;
    font-size: 1rem;
    color: #555;
}

/* Table Styles */
.table-container {
    overflow-x: auto;
    margin: 0 auto;
    max-width: 90%;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

thead {
    background-color: #005f99;
    color: #fff;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

/* Button Styles */
.approve, .reject {
    padding: 6px 12px;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
    border-radius: 4px;
    color: #fff;
}

.approve {
    background-color: #28a745;
    margin-right: 5px;
}

.reject {
    background-color: #dc3545;
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar h1 {
        font-size: 1.2rem;
    }

    th, td {
        font-size: 0.9rem;
    }

    .approve, .reject {
        font-size: 0.8rem;
        padding: 5px 10px;
    }
}

    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <h1>SkySafe Admin Panel</h1>
        <nav>
            <a href="admin-dashboard.html">Dashboard</a>
            <a href="admin-add-flight.html">Add Flights</a>
            <a href="admin-add-hotel.html">Add Hotels</a>
            <a href="index.html">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <section class="requests">
        <h2>Pending Booking Requests</h2>
        <p>Review and manage booking requests from users.</p>
        
        <!-- Table for Pending Requests -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>User Name</th>
                        <th>Flight</th>
                        <th>Hotel</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows for pending requests will be populated here -->
                    <tr>
                        <td>101</td>
                        <td>John Doe</td>
                        <td>Flight A123</td>
                        <td>Hotel XYZ</td>
                        <td>Pending</td>
                        <td>
                            <button class="approve">Approve</button>
                            <button class="reject">Reject</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
