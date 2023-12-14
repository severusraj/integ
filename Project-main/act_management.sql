-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 10:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `act_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_ticketcost` decimal(10,2) DEFAULT NULL,
  `event_video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `event_location`, `event_description`, `event_image`, `user_id`, `event_ticketcost`, `event_video`) VALUES
(1, 'Genshin Meetup', '2023-12-23', 'Olongapo', 'UwU', '../uploads/images/6579ac914e132_ameliimoo_0076.jpg', 2, 10.00, '../uploads/videos/6579ac914e320_I02uM4zgrhK6fEJX.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ticket_price` decimal(10,2) DEFAULT NULL,
  `ticket_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `user_id`, `event_id`, `purchase_date`, `ticket_price`, `ticket_code`) VALUES
(15, 2, 1, '2023-12-13 20:21:39', 10.00, 'ed2e8fbe684ad822'),
(16, 2, 1, '2023-12-13 20:21:39', 10.00, '5209451efe8158ea'),
(17, 1, 1, '2023-12-13 20:30:39', 10.00, '5a2238fe0799cb57'),
(18, 1, 1, '2023-12-13 20:30:39', 10.00, '4a10f530c7b857c7'),
(19, 1, 1, '2023-12-13 20:30:39', 10.00, 'db396dec74948f53'),
(20, 1, 1, '2023-12-13 20:33:08', 10.00, '90e047cb250d0537'),
(21, 1, 1, '2023-12-13 20:33:08', 10.00, '0f550d1bc5e8af8c'),
(22, 1, 1, '2023-12-13 20:40:51', 10.00, '80f58cae586fc50c'),
(23, 1, 1, '2023-12-13 20:40:51', 10.00, '6e0d9a45f90d585b'),
(24, 1, 1, '2023-12-13 20:40:51', 10.00, '0ac8a102a406bf2e'),
(25, 1, 1, '2023-12-13 20:41:43', 10.00, '1b9a12c2c9396574'),
(26, 1, 1, '2023-12-13 20:41:43', 10.00, '7220cfb0608f9e26'),
(27, 2, 1, '2023-12-13 21:00:44', 10.00, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_management`.`users` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_management`.`users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
