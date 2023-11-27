-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 01:50 AM
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
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `debut` datetime NOT NULL,
  `end` datetime NOT NULL,
  `id_users` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `venue_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `title`, `description`, `debut`, `end`, `id_users`, `status`, `venue_id`, `room_id`) VALUES
(12, '4234234', '23423', '2023-11-27 11:00:00', '2023-11-27 19:00:00', 55, 'rejected', 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('available','booked') DEFAULT 'available',
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `status`, `image_path`) VALUES
(5, 'sample room', 'qeqweqweq', 'available', 'uploads/Screenshot1.png'),
(6, 'eqweqwefwef', 'wfwefwef', 'available', 'uploads/orderlist.png'),
(7, '34234', '23423423', 'available', 'uploads/Screenshot1.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'naavailable'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`, `firstname`, `lastname`, `course`, `year`, `status`) VALUES
(7, 'admin', '$2y$10$0PHFt0lzQTRE7WWNOAeLDOfavfpoF5ZokwehU56HhF9ADoWSwL8qy', 'admin', NULL, NULL, NULL, NULL, 'naavailable'),
(53, 'users', '$2y$10$7fWo38u0Ga/2I6SF/QLGTO7leQAkmr5dSbRw3WJfq9LM5f3Hed86q', 'student', NULL, NULL, NULL, NULL, 'available'),
(54, 'carl', '$2y$10$JoIXZM2jCw5Zv53GonW1geeXFwnFltsYv7UbSLAO9CTnFbcJICcG2', 'student', NULL, NULL, NULL, NULL, 'naavailable'),
(55, 'qwe', '$2y$10$BXnZ9Ykl3/zOWGoq3v/B4OsF2FsxpFrsrG5X6Cg0zxBpDoAI5UudC', 'user', NULL, NULL, NULL, NULL, 'naavailable'),
(56, 'qweqwe', '$2y$10$6WzRNUqynFIOU5P/sgUF7uASFZ7gratdvAZ4abunwtkxMvzwReuOK', 'user', 'qwe', 'rty', NULL, NULL, 'naavailable'),
(57, 'asd', '$2y$10$L3jpnyU5ta7lv9hREp3cZeWIZ3VOY/wUu7xgtdosR3wO6KlUPo8VS', 'student', 'asd', 'fgh', 'asease', '2023', 'naavailable');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `name`, `description`, `image_path`, `status`) VALUES
(7, '131231', '2312312', NULL, 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservation_venue` (`venue_id`),
  ADD KEY `fk_reservation_room` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
