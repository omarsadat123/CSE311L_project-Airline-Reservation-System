-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 05:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_agency(sample)`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `flight_id`, `booking_date`, `total_price`) VALUES
(1, 1, 1, '2024-11-01', 600.00),
(2, 2, 2, '2024-11-10', 900.00);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_id` int(11) NOT NULL,
  `departure_city` varchar(100) NOT NULL,
  `destination_city` varchar(100) NOT NULL,
  `departure_date` date NOT NULL,
  `flight_duration` time NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `airline` varchar(100) NOT NULL,
  `flight_class` enum('economy','business','first') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `departure_city`, `destination_city`, `departure_date`, `flight_duration`, `price`, `airline`, `flight_class`) VALUES
(1, 'New York', 'London', '2024-12-01', '06:45:00', 600.00, 'British Airways', 'economy'),
(2, 'Tokyo', 'Los Angeles', '2024-11-30', '10:00:00', 900.00, 'UnitedAir', 'business'),
(3, 'Paris', 'New York', '2024-12-05', '08:00:00', 750.00, 'Air France', 'economy');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `price_per_night` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`, `city`, `rating`, `price_per_night`) VALUES
(1, 'JW Mariott', 'New York', 4.5, 300.00),
(2, 'Hilton Tokyo', 'Tokyo', 4.8, 450.00),
(3, 'Le Bleu', 'Paris', 5.0, 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bookings`
--

CREATE TABLE `hotel_bookings` (
  `hotel_booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `booking_status` enum('confirmed','pending','canceled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_bookings`
--

INSERT INTO `hotel_bookings` (`hotel_booking_id`, `user_id`, `hotel_id`, `check_in_date`, `check_out_date`, `room_type`, `total_price`, `booking_status`) VALUES
(1, 1, 1, '2024-12-01', '2024-12-05', 'Suite', 1200.00, 'confirmed'),
(2, 2, 2, '2024-11-30', '2024-12-05', 'Deluxe', 2250.00, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `multi_city_flights`
--

CREATE TABLE `multi_city_flights` (
  `multi_city_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `multi_city_flights`
--

INSERT INTO `multi_city_flights` (`multi_city_id`, `booking_id`, `flight_id`, `sequence`) VALUES
(1, 1, 1, 1),
(2, 1, 3, 2),
(3, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requests`
--

CREATE TABLE `purchase_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `request_date` date NOT NULL,
  `request_status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_requests`
--

INSERT INTO `purchase_requests` (`request_id`, `user_id`, `flight_id`, `request_date`, `request_status`) VALUES
(1, 1, 1, '2024-10-01', 'pending'),
(2, 2, 2, '2024-10-05', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_role` enum('admin','user') DEFAULT 'user',
  `reg_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `user_role`, `reg_email`) VALUES
(1, 'Thomas Muller', 'esmullert@gmail.com', 'password1', 'user', 'user1@example.com'),
(2, 'John Doe', 'John.Doe@gmail.com', 'password2', 'user', 'user2@example.com'),
(3, 'Mike Oxmal', 'michael.oxmal@yahoo.com', 'password3', 'user', 'user3@example.com'),
(4, 'Midhat Shazzad', 'midhatshazzad@gmail.com', 'adminpassword1', 'admin', 'user4@example.com'),
(5, 'Omar Sadat', 'omarsadat@gmail.com', 'adminpassword2', 'admin', 'user5@example.com'),
(6, 'Owaes Bin Omar', 'owaesomar@gmail.com', 'adminpassword3', 'admin', 'user6@example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  ADD PRIMARY KEY (`hotel_booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `multi_city_flights`
--
ALTER TABLE `multi_city_flights`
  ADD PRIMARY KEY (`multi_city_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `purchase_requests`
--
ALTER TABLE `purchase_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `reg_email` (`reg_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  MODIFY `hotel_booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `multi_city_flights`
--
ALTER TABLE `multi_city_flights`
  MODIFY `multi_city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_requests`
--
ALTER TABLE `purchase_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);

--
-- Constraints for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  ADD CONSTRAINT `hotel_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `hotel_bookings_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`);

--
-- Constraints for table `multi_city_flights`
--
ALTER TABLE `multi_city_flights`
  ADD CONSTRAINT `multi_city_flights_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `multi_city_flights_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);

--
-- Constraints for table `purchase_requests`
--
ALTER TABLE `purchase_requests`
  ADD CONSTRAINT `purchase_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `purchase_requests_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
