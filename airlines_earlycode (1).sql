-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 02:30 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airlines_earlycode`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `route_id` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `date_booked` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `route_id`, `userid`, `date_booked`) VALUES
(1, 'woczsRmrGDeuF4', '9', '2022-06-28 11:41:11'),
(2, 'woczAsmeGDeuF4', '9', '2022-06-28 11:51:45'),
(3, 'wswe2sRmrGDeuF4', '9', '2022-06-28 11:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `our_routes`
--

CREATE TABLE `our_routes` (
  `id` int(11) NOT NULL,
  `rid` varchar(30) NOT NULL,
  `from_value` varchar(50) NOT NULL,
  `to_value` varchar(50) NOT NULL,
  `price_value` varchar(50) NOT NULL,
  `no_passengers` varchar(50) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `our_routes`
--

INSERT INTO `our_routes` (`id`, `rid`, `from_value`, `to_value`, `price_value`, `no_passengers`, `date_created`) VALUES
(1, 'woczAsmeGDeuF4', 'New York', 'London', '10000', '12', '2022-06-23'),
(2, 'wswe2sRmrGDeuF4', 'Chicago', 'France', '150000', '15', '2022-06-23'),
(3, 'woczsRmrGDeuF4', 'Nigeria', 'South Africa', '3000000', '13', '2022-06-28'),
(4, 'bQe1luLsEzwHrY', 'Nigeria', 'Congo', '3000000', '2', '2022-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `email` varchar(300) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `trash_stat` varchar(30) NOT NULL,
  `profileimg` varchar(50) NOT NULL,
  `password_reset` varchar(15) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `phone`, `email`, `dob`, `user_password`, `user_role`, `trash_stat`, `profileimg`, `password_reset`, `date_created`) VALUES
(1, 'Emmanuel', 'Graham', 'chris2244', '+2348124423122', 'tester@gmail.com', '2022-06-13', '$2y$10$I4TIsiQgIcSDNRV8fQQe3ug6YbFsU4i8ji4UuGuZZCGs2XZ1C6kqC', 'admin', 'available', '', '', '2022-06-15 05:38:05'),
(9, 'Chris', 'Graham', 'chris2244', '+2348124423122', 'chrisgraham2625@gmail.com', '2022-06-14', '$2y$10$OBjD4ngP4isNbe9DanW75uIXNh/BXDNGLzDdcCBkTu6t62sKU/hRu', 'user', 'available', 'profile_user_image9.gif', '710379', '2022-06-22 05:46:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_routes`
--
ALTER TABLE `our_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `our_routes`
--
ALTER TABLE `our_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
