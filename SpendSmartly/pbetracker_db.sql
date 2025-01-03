-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 07:05 PM
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
-- Database: `pbetracker_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `year` int(5) NOT NULL,
  `note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `type`, `year`, `note`) VALUES
(1, 2, 'Electric Bill', 2023, 'December - utang kay ate Bibi'),
(2, 2, 'Store Expenses', 2023, NULL),
(3, 2, 'Store Expenses', 2024, NULL),
(4, 3, 'Electric Bill', 2023, NULL),
(5, 3, 'Electric Bill', 2024, NULL),
(11, 2, 'Internet Bill', 2023, NULL),
(12, 3, 'Internet Bill', 2024, NULL),
(13, 2, 'Water Bill', 2023, 'April to June - summer'),
(14, 3, 'Water Bill', 2024, NULL),
(15, 2, 'Educational Expenses', 2024, NULL),
(16, 2, 'Educational Expenses', 2023, NULL),
(17, 2, 'Internet Bill', 2024, NULL),
(18, 3, 'Educational Expenses', 2023, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` varchar(5) NOT NULL,
  `amount` int(20) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `user_id`, `type`, `month`, `year`, `amount`, `date_added`) VALUES
(1, 2, 'Electric Bill', 'January', '2023', 1660, '2024-01-25 07:42:41'),
(2, 2, 'Electric Bill', 'February', '2023', 3500, '2024-01-25 07:46:36'),
(3, 2, 'Electric Bill', 'March', '2023', 2000, '2024-01-25 07:53:35'),
(4, 2, 'Electric Bill', 'April', '2023', 4300, '2024-01-25 07:54:12'),
(5, 2, 'Electric Bill', 'May', '2023', 2335, '2024-01-25 07:55:03'),
(6, 2, 'Electric Bill', 'June', '2023', 1150, '2024-01-25 07:55:39'),
(7, 2, 'Electric Bill', 'July', '2023', 3645, '2024-01-25 07:56:22'),
(8, 2, 'Electric Bill', 'August', '2023', 2550, '2024-01-25 07:57:06'),
(9, 2, 'Electric Bill', 'September', '2023', 4215, '2024-01-25 07:57:53'),
(10, 2, 'Electric Bill', 'October', '2023', 1585, '2024-01-25 07:58:49'),
(11, 2, 'Electric Bill', 'November ', '2023', 3756, '2024-01-25 08:00:18'),
(12, 2, 'Electric Bill', 'December', '2023', 5000, '2024-01-25 08:00:55'),
(25, 2, 'Store Expenses', 'January', '2023', 15000, '2024-01-25 08:53:17'),
(26, 2, 'Store Expenses', 'February ', '2023', 11000, '2024-01-25 09:02:56'),
(27, 2, 'Store Expenses', 'March ', '2023', 7550, '2024-01-25 09:03:54'),
(28, 2, 'Store Expenses', 'April', '2023', 9486, '2024-01-25 09:05:13'),
(29, 2, 'Store Expenses', 'May', '2023', 5550, '2024-01-25 09:06:59'),
(30, 2, 'Store Expenses', 'June', '2023', 3000, '2024-01-25 07:55:39'),
(31, 2, 'Store Expenses', 'July', '2023', 2575, '2024-01-25 07:56:22'),
(32, 2, 'Store Expenses', 'August', '2023', 4358, '2024-01-25 07:57:06'),
(33, 2, 'Store Expenses', 'September', '2023', 6850, '2024-01-25 07:57:53'),
(34, 2, 'Store Expenses', 'October', '2023', 10378, '2024-01-25 07:58:49'),
(35, 2, 'Store Expenses', 'November ', '2023', 8452, '2024-01-25 08:00:18'),
(36, 2, 'Store Expenses', 'December ', '2023', 13560, '2024-01-25 08:09:35'),
(37, 2, 'Store Expenses ', 'January', '2024', 0, '2024-01-25 07:42:41'),
(38, 2, 'Store Expenses ', 'February', '2024', 0, '2024-01-25 07:46:36'),
(39, 2, 'Store Expenses ', 'March', '2024', 0, '2024-01-25 07:53:35'),
(40, 2, 'Store Expenses ', 'April', '2024', 0, '2024-01-25 07:54:12'),
(41, 2, 'Store Expenses ', 'May', '2024', 0, '2024-01-25 07:55:03'),
(42, 2, 'Store Expenses ', 'June', '2024', 0, '2024-01-25 07:55:39'),
(43, 2, 'Store Expenses ', 'July', '2024', 0, '2024-01-25 07:56:22'),
(44, 2, 'Store Expenses ', 'August', '2024', 0, '2024-01-25 07:57:06'),
(45, 2, 'Store Expenses ', 'September', '2024', 0, '2024-01-25 07:57:53'),
(46, 2, 'Store Expenses ', 'October', '2024', 0, '2024-01-25 07:58:49'),
(47, 2, 'Store Expenses ', 'November ', '2024', 0, '2024-01-25 08:00:18'),
(48, 2, 'Store Expenses ', 'December ', '2024', 0, '2024-01-25 08:09:35'),
(49, 3, 'Electric Bill', 'January', '2023', 1800, '2024-01-25 07:42:41'),
(50, 3, 'Electric Bill ', 'February', '2023', 500, '2024-01-25 07:46:36'),
(51, 3, 'Electric Bill', 'March', '2023', 1000, '2024-01-25 07:53:35'),
(52, 3, 'Electric Bill', 'April', '2023', 1300, '2024-01-25 07:54:12'),
(53, 3, 'Electric Bill', 'May', '2023', 850, '2024-01-25 07:55:03'),
(54, 3, 'Electric Bill', 'June', '2023', 600, '2024-01-25 07:55:39'),
(55, 3, 'Electric Bill', 'July', '2023', 1684, '2024-01-25 07:56:22'),
(56, 3, 'Electric Bill', 'August', '2023', 1500, '2024-01-25 07:57:06'),
(57, 3, 'Electric Bill', 'September', '2023', 900, '2024-01-25 07:57:53'),
(58, 3, 'Electric Bill', 'October', '2023', 486, '2024-01-25 07:58:49'),
(59, 3, 'Electric Bill', 'November ', '2023', 770, '2024-01-25 08:00:18'),
(60, 3, 'Electric Bill', 'December', '2023', 1480, '2024-01-25 08:00:55'),
(61, 3, 'Electric Bill', 'January', '2024', 0, '2024-01-25 07:42:41'),
(62, 3, 'Electric Bill', 'February', '2024', 0, '2024-01-25 07:46:36'),
(63, 3, 'Electric Bill', 'March', '2024', 0, '2024-01-25 07:53:35'),
(64, 3, 'Electric Bill', 'April', '2024', 0, '2024-01-25 07:54:12'),
(65, 3, 'Electric Bill', 'May', '2024', 0, '2024-01-25 07:55:03'),
(66, 3, 'Electric Bill', 'June', '2024', 0, '2024-01-25 07:55:39'),
(67, 3, 'Electric Bill', 'July', '2024', 0, '2024-01-25 07:56:22'),
(68, 3, 'Electric Bill', 'August', '2024', 0, '2024-01-25 07:57:06'),
(69, 3, 'Electric Bill', 'September', '2024', 0, '2024-01-25 07:57:53'),
(70, 3, 'Electric Bill ', 'October', '2024', 0, '2024-01-25 07:58:49'),
(71, 3, 'Electric Bill ', 'November ', '2024', 0, '2024-01-25 08:00:18'),
(72, 3, 'Electric Bill', 'December ', '2024', 0, '2024-01-25 08:09:35'),
(73, 2, 'Internet Bill', 'January', '2023', 2400, '2024-01-25 07:42:41'),
(74, 2, 'Internet Bill', 'February', '2023', 2400, '2024-01-25 07:46:36'),
(75, 2, 'Internet Bill', 'March', '2023', 2400, '2024-01-25 07:53:35'),
(76, 2, 'Internet Bill', 'April', '2023', 2400, '2024-01-25 07:54:12'),
(77, 2, 'Internet Bill', 'May', '2023', 2400, '2024-01-25 07:55:03'),
(78, 2, 'Internet Bill', 'June', '2023', 2400, '2024-01-25 07:55:39'),
(79, 2, 'Internet Bill', 'July', '2023', 2400, '2024-01-25 07:56:22'),
(80, 2, 'Internet Bill', 'August', '2023', 2400, '2024-01-25 07:57:06'),
(81, 2, 'Internet Bill', 'September', '2023', 2400, '2024-01-25 07:57:53'),
(82, 2, 'Internet Bill', 'October', '2023', 2400, '2024-01-25 07:58:49'),
(83, 2, 'Internet Bill', 'November ', '2023', 2400, '2024-01-25 08:00:18'),
(84, 2, 'Internet Bill', 'December', '2023', 2400, '2024-01-25 08:00:55'),
(85, 3, 'Internet Bill', 'January', '2024', 0, '2024-01-25 07:42:41'),
(86, 3, 'Internet Bill', 'February', '2024', 0, '2024-01-25 07:46:36'),
(87, 3, 'Internet Bill', 'March', '2024', 0, '2024-01-25 07:53:35'),
(88, 3, 'Internet Bill', 'April', '2024', 0, '2024-01-25 07:54:12'),
(89, 3, 'Internet Bill', 'May', '2024', 0, '2024-01-25 07:55:03'),
(90, 3, 'Internet Bill', 'June', '2024', 0, '2024-01-25 07:55:39'),
(91, 3, 'Internet Bill', 'July', '2024', 0, '2024-01-25 07:56:22'),
(92, 3, 'Internet Bill', 'August', '2024', 0, '2024-01-25 07:57:06'),
(93, 3, 'Internet Bill', 'September', '2024', 0, '2024-01-25 07:57:53'),
(94, 3, 'Internet Bill', 'October', '2024', 0, '2024-01-25 07:58:49'),
(95, 3, 'Internet Bill', 'November ', '2024', 0, '2024-01-25 08:00:18'),
(96, 3, 'Internet Bill', 'December ', '2024', 0, '2024-01-25 08:09:35'),
(98, 2, 'Water Bill', 'January', '2023', 2832, '2024-06-19 16:26:06'),
(99, 2, 'Water Bill', 'February', '2023', 2000, '2024-06-19 16:26:06'),
(100, 2, 'Water Bill', 'March', '2023', 2147, '2024-06-19 16:26:06'),
(101, 2, 'Water Bill', 'April', '2023', 3450, '2024-06-19 16:26:06'),
(102, 2, 'Water Bill', 'May', '2023', 3786, '2024-06-19 16:26:06'),
(103, 2, 'Water Bill', 'June', '2023', 3560, '2024-06-19 16:26:06'),
(104, 2, 'Water Bill', 'July', '2023', 2844, '2024-06-19 16:26:06'),
(105, 2, 'Water Bill', 'August', '2023', 2700, '2024-06-19 16:26:06'),
(106, 2, 'Water Bill', 'September', '2023', 1900, '2024-06-19 16:26:06'),
(107, 2, 'Water Bill', 'October', '2023', 2550, '2024-06-19 16:26:06'),
(108, 2, 'Water Bill', 'November', '2023', 2865, '2024-06-19 16:26:06'),
(109, 2, 'Water Bill', 'December', '2023', 3100, '2024-06-19 16:26:06'),
(110, 3, 'Water Bill', 'January', '2024', 2832, '2024-06-19 17:06:19'),
(111, 3, 'Water Bill', 'February', '2024', 3300, '2024-06-19 17:06:19'),
(112, 3, 'Water Bill', 'March', '2024', 1900, '2024-06-19 17:06:19'),
(113, 3, 'Water Bill', 'April', '2024', 2550, '2024-06-19 17:06:19'),
(114, 3, 'Water Bill', 'May', '2024', 2865, '2024-06-19 17:06:19'),
(115, 3, 'Water Bill', 'June', '2024', 3100, '2024-06-19 17:06:19'),
(116, 3, 'Water Bill', 'July', '2024', 0, '2024-06-19 17:06:19'),
(117, 3, 'Water Bill', 'August', '2024', 0, '2024-06-19 17:06:19'),
(118, 3, 'Water Bill', 'September', '2024', 0, '2024-06-19 17:06:19'),
(119, 3, 'Water Bill', 'October', '2024', 0, '2024-06-19 17:06:19'),
(120, 3, 'Water Bill', 'November', '2024', 0, '2024-06-19 17:06:19'),
(121, 3, 'Water Bill', 'December', '2024', 0, '2024-06-19 17:06:19'),
(122, 2, 'Educational Expenses', 'January', '2024', 155, '2024-06-20 05:51:54'),
(123, 2, 'Educational Expenses', 'February', '2024', 100, '2024-06-20 05:51:54'),
(124, 2, 'Educational Expenses', 'March', '2024', 85, '2024-06-20 05:51:54'),
(125, 2, 'Educational Expenses', 'April', '2024', 65, '2024-06-20 05:51:54'),
(126, 2, 'Educational Expenses', 'May', '2024', 150, '2024-06-20 05:51:54'),
(127, 2, 'Educational Expenses', 'June', '2024', 180, '2024-06-20 05:51:54'),
(128, 2, 'Educational Expenses', 'July', '2024', 0, '2024-06-20 05:51:54'),
(129, 2, 'Educational Expenses', 'August', '2024', 0, '2024-06-20 05:51:54'),
(130, 2, 'Educational Expenses', 'September', '2024', 0, '2024-06-20 05:51:54'),
(131, 2, 'Educational Expenses', 'October', '2024', 0, '2024-06-20 05:51:54'),
(132, 2, 'Educational Expenses', 'November', '2024', 0, '2024-06-20 05:51:54'),
(133, 2, 'Educational Expenses', 'December', '2024', 0, '2024-06-20 05:51:54'),
(134, 2, 'Educational Expenses', 'January', '2023', 35, '2024-06-20 10:58:43'),
(135, 2, 'Educational Expenses', 'February', '2023', 65, '2024-06-20 10:58:43'),
(136, 2, 'Educational Expenses', 'March', '2023', 50, '2024-06-20 10:58:43'),
(137, 2, 'Educational Expenses', 'April', '2023', 75, '2024-06-20 10:58:43'),
(138, 2, 'Educational Expenses', 'May', '2023', 70, '2024-06-20 10:58:43'),
(139, 2, 'Educational Expenses', 'June', '2023', 65, '2024-06-20 10:58:43'),
(140, 2, 'Educational Expenses', 'July', '2023', 0, '2024-06-20 10:58:43'),
(141, 2, 'Educational Expenses', 'August', '2023', 20, '2024-06-20 10:58:43'),
(142, 2, 'Educational Expenses', 'September', '2023', 45, '2024-06-20 10:58:43'),
(143, 2, 'Educational Expenses', 'October', '2023', 125, '2024-06-20 10:58:43'),
(144, 2, 'Educational Expenses', 'November', '2023', 180, '2024-06-20 10:58:43'),
(145, 2, 'Educational Expenses', 'December', '2023', 250, '2024-06-20 10:58:43'),
(146, 2, 'Internet Bill', 'January', '2024', 2400, '2024-06-20 14:45:01'),
(147, 2, 'Internet Bill', 'February', '2024', 2400, '2024-06-20 14:45:01'),
(148, 2, 'Internet Bill', 'March', '2024', 2400, '2024-06-20 14:45:01'),
(149, 2, 'Internet Bill', 'April', '2024', 2400, '2024-06-20 14:45:01'),
(150, 2, 'Internet Bill', 'May', '2024', 2400, '2024-06-20 14:45:01'),
(151, 2, 'Internet Bill', 'June', '2024', 2400, '2024-06-20 14:45:01'),
(152, 2, 'Internet Bill', 'July', '2024', 0, '2024-06-20 14:45:01'),
(153, 2, 'Internet Bill', 'August', '2024', 0, '2024-06-20 14:45:01'),
(154, 2, 'Internet Bill', 'September', '2024', 0, '2024-06-20 14:45:01'),
(155, 2, 'Internet Bill', 'October', '2024', 0, '2024-06-20 14:45:01'),
(156, 2, 'Internet Bill', 'November', '2024', 0, '2024-06-20 14:45:01'),
(157, 2, 'Internet Bill', 'December', '2024', 0, '2024-06-20 14:45:01'),
(158, 3, 'Educational Expenses', 'January', '2023', 500, '2024-06-21 08:03:19'),
(159, 3, 'Educational Expenses', 'February', '2023', 500, '2024-06-21 08:03:19'),
(160, 3, 'Educational Expenses', 'March', '2023', 500, '2024-06-21 08:03:19'),
(161, 3, 'Educational Expenses', 'April', '2023', 500, '2024-06-21 08:03:19'),
(162, 3, 'Educational Expenses', 'May', '2023', 500, '2024-06-21 08:03:19'),
(163, 3, 'Educational Expenses', 'June', '2023', 500, '2024-06-21 08:03:19'),
(164, 3, 'Educational Expenses', 'July', '2023', 0, '2024-06-21 08:03:19'),
(165, 3, 'Educational Expenses', 'August', '2023', 0, '2024-06-21 08:03:19'),
(166, 3, 'Educational Expenses', 'September', '2023', 500, '2024-06-21 08:03:19'),
(167, 3, 'Educational Expenses', 'October', '2023', 500, '2024-06-21 08:03:19'),
(168, 3, 'Educational Expenses', 'November', '2023', 650, '2024-06-21 08:03:19'),
(169, 3, 'Educational Expenses', 'December', '2023', 700, '2024-06-21 08:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `mobile_number` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `username`, `password`, `first_name`, `last_name`, `birthday`, `age`, `gender`, `address`, `e_mail`, `mobile_number`) VALUES
(1, 'reguleos', '123123', 'Lance', 'Briones', '2004-02-19', 20, 'Male', 'Trece Martires City, Cavite', 'lancebriones1904@gmail.com', 9661777255),
(2, 'kwinnsiii', '123123', 'Queency', 'Sese', '2003-11-14', 20, 'Female', 'Tanza, Cavite', 'queencygallanosese@gmail.com', 9651679497),
(3, 'lyecln', '123123', 'Llyle', 'Nidea', '2004-03-30', 20, 'Female', 'Trece Martires City, Cavite', 'queencygallanosese@gmail.com', 9651679497),
(10, 'cfa.shane', '123123', 'Shane', 'Aguirre', '2003-12-07', 20, 'Female', 'Trece Martires City, Cavite', 'queencygallanosese@gmail.com', 9651679497);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_profile` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
