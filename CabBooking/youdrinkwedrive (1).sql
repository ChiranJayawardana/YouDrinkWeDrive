-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2025 at 07:05 PM
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
-- Database: `youdrinkwedrive`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_list`
--

CREATE TABLE `booking_list` (
  `id` int(30) NOT NULL,
  `ref_code` varchar(100) NOT NULL,
  `client_id` int(30) NOT NULL,
  `pickup_zone` text NOT NULL,
  `drop_zone` text NOT NULL,
  `distance` double DEFAULT NULL,
  `fee` double DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending,\r\n1 = Driver has Confirmed,\r\n2 = Pickup,\r\n3 = drop-off,\r\n4 = cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `delete_flag`, `status`, `date_created`, `date_updated`) VALUES
(1, '5 Seater', 'A 4-door passenger car with a trunk that is separate from the passengers with a three-box body: the engine, the area for passengers, and the trunk.', 0, 1, '2022-03-01 10:03:54', '2022-03-02 13:03:14'),
(2, '6 Seater', 'Quisque iaculis ipsum egestas nisi pharetra, ac laoreet felis tincidunt. Cras id gravida justo. Nulla non gravida risus, vel finibus leo. Phasellus vel eros ligula. Fusce a erat sed quam vehicula convallis.', 0, 1, '2022-03-01 10:08:10', '2022-03-27 14:45:51'),
(3, '7 Seater', 'Flexible, allowing you to switch between lots of seats or lots of boot space. The biggest manage to do both - comfortably taking six passengers and their stuff.', 0, 1, '2022-03-03 12:59:29', '2022-03-27 14:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `queries` varchar(300) NOT NULL,
  `replies` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `gender` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_added` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `contact`, `address`, `email`, `password`, `image_path`, `status`, `delete_flag`, `date_created`, `date_added`) VALUES
(1, 'Elizabeth', 'J.', 'Watson', 'Female', '1478555560', '85 Sycamore Lake Road', 'elizabeth@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/clients/1.png?v=1644995661', 1, 0, '2022-02-27 13:06:42', '2022-03-27 21:10:54'),
(2, 'Christine', 'M.', 'Moore', 'Female', '7412589666', '12 Bleck Street, PA', 'christine@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/clients/2.png?v=1648043485', 1, 0, '2022-03-01 19:36:24', '2022-03-27 21:10:40'),
(3, 'Luciano', 'B.', 'Fridley', 'Male', '7896585555', '372 Saint Marys Avenue', 'lsmith@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 13:13:38', '2022-03-27 21:11:06'),
(4, 'Matt', 'P.', 'Melton', 'Male', '4589658888', '870 School House Road', 'mattb@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 13:34:09', '2022-03-27 21:11:16'),
(5, 'James', 'P.', 'Luis', 'Male', '7850000010', '49 Poco Mas Drive', 'jamesp@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 13:39:25', '2022-03-27 21:11:28'),
(6, 'Timothy', 'E.', 'Maurer', 'Male', '1458965555', '75 Brannon Avenue', 'timothye@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 13:41:16', '2022-03-27 21:11:37'),
(7, 'Ebony', 'S.', 'Coulter', 'Female', '7850002145', '35 Simpson Street', 'ebonys@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 13:54:26', '2022-03-27 21:11:52'),
(8, 'Jason', 'F.', 'Billingsley', 'Male', '1458965555', '90 Jadewood Farms', 'jasonk@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 13:56:19', '2022-03-27 21:12:06'),
(9, 'Daniel', 'J.', 'Amos', 'Male', '4565550010', '77 Driftwood Road', 'daniel@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 13:59:54', '2022-03-27 21:12:17'),
(10, 'Edith', 'D.', 'Collins', 'Male', '1458965555', '90 Glory Road', 'edith@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 14:09:00', '2022-03-27 21:12:31'),
(11, 'Gina', 'J.', 'Bernard', 'Female', '1456854100', '41 Coulter Lane', 'ginac@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-01 14:14:37', '2022-03-27 21:12:47'),
(12, 'Thomas', 'J.', 'Greenwood', 'Male', '4569000010', '70 Elk Avenue', 'thomas@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/clients/12.png?v=1648370087', 1, 0, '2022-03-01 14:19:47', '2022-03-27 21:12:59'),
(13, 'Peter', 'J.', 'Fidley', 'Male', '1456985555', '42 Ridge Road', 'peter@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-27 21:10:14', NULL),
(14, 'John', 'H.', 'Hampton', 'Male', '4789652210', '50 Pooh Bear Lane', 'johnhm@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-27 22:20:32', NULL),
(15, 'Maria', 'J.', 'Connors', 'Female', '1478523655', '76 Richland Avenue', 'mariaj@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-27 22:21:08', NULL),
(16, 'Karen', 'M.', 'Brewer', 'Female', '1458888888', '591 Leisure Lane', 'karenb@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-27 22:21:53', NULL),
(17, 'Norma', 'K.', 'Gravelle', 'Female', '1458965555', '66 Blane Street', 'normak@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-27 22:24:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `driver_list`
--

CREATE TABLE `driver_list` (
  `id` int(11) NOT NULL,
  `reg_code` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `driver_identity` varchar(200) NOT NULL,
  `driver_name` text NOT NULL,
  `driver_contact` text NOT NULL,
  `driver_address` text NOT NULL,
  `password` text NOT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `delete_flag` tinyint(1) DEFAULT 0,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Cab Booking System'),
(6, 'short_name', 'CBS - PHP'),
(11, 'logo', 'uploads/1648050060_cbslg.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1648048980_cbss22.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Liam', 'admin', 'd00f5d5217896fb7fd601412cb890830', 'uploads/1624000_adminicn.png', NULL, 1, '2022-01-19 14:02:37', '2025-12-22 21:32:46'),
(8, 'Martha', 'Heath', 'martha', '3003051F6D158F6687B8A820C46BFA80', 'uploads/avatar-8.png?v=1648396920', NULL, 2, '2022-03-01 16:14:00', '2022-03-27 21:47:00'),
(9, 'Andrew', 'Stokes', 'andrew', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/avatar-9.png?v=1648396901', NULL, 2, '2022-03-27 21:46:41', '2022-03-27 21:46:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_list`
--
ALTER TABLE `booking_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `driver_list`
--
ALTER TABLE `driver_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_driver_id` (`driver_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
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
-- AUTO_INCREMENT for table `booking_list`
--
ALTER TABLE `booking_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `driver_list`
--
ALTER TABLE `driver_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
