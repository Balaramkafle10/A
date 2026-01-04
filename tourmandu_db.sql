-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 02:42 AM
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
-- Database: `tourmandu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_form`
--

CREATE TABLE `book_form` (
  `book_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `guests` int(11) NOT NULL,
  `arrivals` date NOT NULL,
  `leaving` date NOT NULL,
  `package_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_status` enum('Pending','Paid','Failed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_form`
--

INSERT INTO `book_form` (`book_id`, `name`, `email`, `phone`, `address`, `guests`, `arrivals`, `leaving`, `package_id`, `customer_id`, `payment_status`) VALUES
(2, 'ram ram', 'ram20@gmail.com', '9843238782', 'Lokhanthali', 10, '2025-12-24', '2025-12-25', 2, 1, 'Pending'),
(3, 'Balaram Kafle', 'jackymessi7@gmail.com', '9843238782', 'Lokhanthali', 2, '2025-12-29', '2026-01-03', 2, 2, 'Pending'),
(4, 'Balaram Kafle', 'jackymessi7@gmail.com', '9843238782', 'Lokhanthali', 1, '2025-12-29', '2025-12-31', 6, 2, 'Pending'),
(5, 'Balaram Kafle', 'b@gmail.com', '9843238782', 'Lokhanthali', 2, '2025-12-29', '2026-01-01', 19, 2, 'Pending'),
(8, 'Balaram Kafle', 'jackymessi7@gmail.com', '9843238782', 'Lokhanthali', 1, '2026-01-14', '2026-01-16', 40, 2, 'Pending'),
(9, 'Balaram Kafleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'b@gmail.com', '9843238782', 'Lokhanthali', 2, '2026-01-20', '2026-01-25', 2, 1, 'Pending'),
(10, 'ram Kafleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'b@gmail.com', '9843238782', 'Lokhanthali', 2, '2026-01-20', '0000-00-00', 2, 1, 'Pending'),
(11, 'Balaram Kafleuuuu', 'jackymessi7@gmail.com', '9843238782', 'Lokhanthali', 1, '2026-01-05', '2026-01-07', 6, 1, 'Pending'),
(12, 'aram Kafleuuuu', 'jackymessi7@gmail.com', '9843238782', 'Lokhanthali', 1, '2026-01-05', '0000-00-00', 6, 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `customer_id`, `Name`, `Email`, `Message`, `created_at`) VALUES
(1, 1, 'Balaram Kafle', 'balaramk@gmail.com', 'hi', '2025-12-24 03:28:13'),
(3, 1, 'Balaram Kafle', 'b@gmail.com', 'khfiyfyfknbugoufoy', '2025-12-28 04:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `Name`, `Address`, `Email`, `phoneNumber`, `userName`, `Password`, `is_admin`) VALUES
(1, 'Admin', 'Baneshwor', 'balaramk@gmail.com', '9849426293', 'bk', '123', 1),
(2, 'Rohit Kafle', 'Bhaktpur', 'kaflerohit@gmail.com', '9876544326', 'rk', 'r123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `price` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `image`, `location`, `duration`, `price`) VALUES
(2, 'ilam.jpg', 'Ilam', '6Days/5Night', 12000),
(6, 'sddefault.jpg', 'Chitawan National Park', '3Days/2Night', 7000),
(19, 'download.jpeg', 'Phewa Lake', '4day/3Night', 8000),
(20, 'national-parks-banner.jpg', 'Rara', '7Days/6Night', 18000),
(40, 'chitlang-photo.jpg', 'lalitpur', '3Days', 2500),
(41, 'pathivara-tour-package-945x474.jpg', 'phewa lakhe', '2Days/1Night', 10000),
(56, 'download.jpeg', 'Phewa', '2Days/1Night', 1245);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `gateway` varchar(20) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Paid','Failed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_form`
--
ALTER TABLE `book_form`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `fk_package` (`package_id`),
  ADD KEY `fk_customers` (`customer_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_form`
--
ALTER TABLE `book_form`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_form`
--
ALTER TABLE `book_form`
  ADD CONSTRAINT `fk_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_package` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contactus`
--
ALTER TABLE `contactus`
  ADD CONSTRAINT `contactus_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `book_form` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
