-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 07:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u599000394_sis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_history`
--

CREATE TABLE `academic_history` (
  `id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `semester` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `school_year` text NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1 COMMENT '1= New,\r\n2= Regular,\r\n3= Returnee,\r\n4= Transferee',
  `end_status` tinyint(3) NOT NULL DEFAULT 0 COMMENT '0=pending,\r\n1=Completed,\r\n2=Dropout,\r\n3=failed,\r\n4=Transferred-out,\r\n5=Graduated',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `id` int(30) NOT NULL,
  `department_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `department_id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(14, 17, 'RICHARD', 'Handles purchasings of the company', 1, 0, '2024-01-16 12:26:51', '2024-01-16 12:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(12, 'PUBLIC RELATIONS', 'Handle company relations with the public, monitor social media presence, give the public ongoing activities in the company, handle client  client ', 1, 1, '2024-01-16 11:15:54', '2024-01-16 12:00:36'),
(13, 'FINANCIAL DEPARTMENT ', 'Plays a key role to optimize the company\'s financial resources by organizing, planning, controlling and managing financial risk.', 1, 0, '2024-01-16 11:27:17', '2024-01-16 11:33:02'),
(14, 'INVESTMENT DEPARTMENT', 'Seeks to acquire opportunities locally, regionally and internationally through identifying real estate opportunities', 1, 0, '2024-01-16 11:30:07', NULL),
(15, 'PROJECTS MANAGEMENT DEPARTMENT', 'The primary responsibility of this department is to offer turnkey solutions, from planning, designing, and through execution', 1, 0, '2024-01-16 11:36:11', NULL),
(16, 'LEGAL AFFAIRS DEPARTMENT', 'This legal representative of the company, is in charge of providing legal consultations to all other departments, drafting contracts and other agreements regarding client engagement', 1, 0, '2024-01-16 11:39:32', NULL),
(17, 'PROCUREMENT DEPARTMENT', 'Seeks to implement and manage all the company\'s purchasing operations', 1, 0, '2024-01-16 11:41:37', NULL),
(18, 'MARKETING AND PUBLIC RELATIONS DEPARTMENT', 'Person In Charge: OMODING PAUL\r\nRESPONSIBILITIES:\r\n1.Manage Social Media accounts\r\n2.Set up meetings.', 1, 0, '2024-01-16 11:47:51', '2024-01-29 10:44:21'),
(19, 'INFORMATION TECHNOLOGY DEPARTTMENT', 'Provides the vision, correct guidance, and leadership in providing all technical and telephone services', 1, 0, '2024-01-16 11:51:07', NULL),
(20, 'CUSTOMER SERVICE DEPARTMENT', 'Responsible for responding to customers\' inquiries and complaints and feefback', 1, 0, '2024-01-16 11:59:23', NULL),
(21, 'ENGINEERING CONSULTANCY DEPARTMENT', 'Plays a pivotal role in managing the design phase for development projects which span from masterplan designs to buildings', 1, 0, '2024-01-16 12:03:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `house_type` varchar(255) NOT NULL DEFAULT '',
  `options` varchar(255) NOT NULL DEFAULT '',
  `amount` decimal(65,0) NOT NULL,
  `house_image` varchar(255) NOT NULL,
  `house_owner_first_name` varchar(255) NOT NULL,
  `house_owner_last_name` varchar(255) NOT NULL,
  `house_owner_contact` int(18) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `dob` date NOT NULL,
  `documents` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `land`
--

CREATE TABLE `land` (
  `id` int(255) NOT NULL,
  `land_type` varchar(255) NOT NULL,
  `roll` varchar(255) NOT NULL,
  `land_image` varchar(255) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `land_owner_contact` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `documents` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `land`
--

INSERT INTO `land` (`id`, `land_type`, `roll`, `land_image`, `First_Name`, `Last_Name`, `land_owner_contact`, `dob`, `documents`, `Address`, `details`, `status`, `amount`) VALUES
(1, 'Mailo', 'Bs23457', '', 'Titus', 'Zera', '760317540', '2024-02-19', '', 'Nateete', 'Mailo land for sale', '1', '0'),
(7, 'Mailo', 'ABCDEFG', '', 'KATO', 'PEREZ', '760317540', '2024-05-19', '', 'NTINDA', 'MAILO LAND FOR SALE', '1', '0'),
(9, 'Mailo', '3', '', 'clare', 'claire', '0756017670', '2023-11-12', '', 'Ntinda', 'For sale', '1', '20,000,000'),
(10, 'Free hold', '54', '', 'Kevin', 'Muwanguzi', '0754830208', '2023-05-12', '', 'Mbale', 'for sale in mbale 1ache', '1', '40,000,000'),
(11, 'Mailo', '40', '', 'Zera', 'Waswa', '0704955089', '2023-05-08', '', 'Mulanga', 'For sale', '0', '21,000,000'),
(12, 'Lease', '67', '', 'Lord', 'Mufiga', '0704955087', '2022-05-12', '', 'Mufinha', 'For sale', '1', '10,000,000'),
(13, 'Lease', '90', '', 'Joshue', 'Omoding', '0760317645', '2022-02-05', '', '', '', '0', '12,000,000'),
(14, 'Lease', '11', 'Photo_2142244575.jpg', 'Kidandi', 'Irene', '0756017675', '2023-11-11', 'documents_1608632465.pdf', 'Namugongo', 'For Sale', '', '31,000,000'),
(18, 'Free hold', '243', 'Photo_2093922812.png', 'Kidandi', 'Liberty', '0754830208', '2022-12-12', 'documents_629335721.pdf', 'Mutongo', 'For sale', '', '3,000,000'),
(22, 'Mailo', '125', 'Photo_1729165131.jpg', 'Kidandi', 'Amos', '0760317540', '2023-11-12', 'documents_559973334.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(23, 'Mailo', '125', 'Photo_392999626.jpg', 'Kidandi', 'Amos', '0760317540', '2023-11-12', 'documents_901516566.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(24, 'Mailo', '125', 'Photo_198637854.jpg', 'Kidandi', 'Amos', '0760317540', '2023-11-12', 'documents_258924471.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(25, 'Mailo', '267', 'Photo_110494189.jpg', 'Kidandi', 'Omiden', '0760317540', '2023-02-12', 'documents_1299013462.pdf', 'Munyonyo', 'Sold', '', '2,000,000'),
(26, 'Mailo', '267', 'Photo_206564756.jpg', 'Kidandi', 'Omiden', '0760317540', '2023-02-12', 'documents_475031527.pdf', 'Munyonyo', 'Sold', '', '2,000,000'),
(27, 'Mailo', '267', 'Photo_1197360768.jpg', 'Kidandi', 'Omiden', '0760317540', '2023-02-12', 'documents_502655841.pdf', 'Munyonyo', 'Sold', '', '2,000,000'),
(28, 'Mailo', '12345', 'Photo_1677867969.jpg', 'Kidandi', 'Omiden', '0760317540', '2023-11-12', 'documents_286151993.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(29, 'Mailo', '12345', 'Photo_1405648009.jpg', 'Kidandi', 'Omiden', '0760317540', '2023-11-12', 'documents_475148692.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(30, 'Mailo', '12345', 'Photo_1306156448.jpg', 'Kidandi', 'Omiden', '0760317540', '2023-11-12', 'documents_1692224263.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(31, 'Mailo', '235', 'Photo_277766583.jpg', 'Titus', 'Omiden', '0760317540', '2022-12-12', 'documents_605642628.pdf', 'Munyonyo', 'Salke', '', '2,000,000'),
(32, 'Mailo', '257', 'Photo_143297253.jpg', 'Titus', 'Kayongo', '0760317540', '0000-00-00', 'documents_2146285900.pdf', 'Munyonyo', 'For sale', '', '2,000,000'),
(33, 'Mailo', '257', 'Photo_1607793817.jpg', 'Titus', 'Kayongo', '0760317540', '0000-00-00', 'documents_218314943.pdf', 'Munyonyo', 'For sale', '', '2,000,000'),
(34, 'Mailo', '9', 'Photo_1777700103.jpg', 'Titus', 'Omiden', '0760317540', '2023-11-12', 'documents_109773814.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(35, 'Mailo', '9', 'Photo_1920815803.jpg', 'Titus', 'Omiden', '0760317540', '2023-11-12', 'documents_898484992.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(36, 'Mailo', '9', 'Photo_1529315517.jpg', 'Titus', 'Omiden', '0760317540', '2023-11-12', 'documents_771032778.pdf', 'Munyonyo', 'Sale', '', '2,000,000'),
(37, 'Mailo', '44', 'Photo_1298530341.jpg', 'Titus', 'Omiden', '0760317540', '2022-11-11', 'documents_527145544.pdf', 'Munyonyo', 'For sale', '', '2,000,000'),
(38, 'Mailo', '19', 'Photo_1197133605.jpg', 'Titus', 'Omiden', '0760317540', '2022-12-12', 'documents_2116074269.pdf', 'Munyonyo', 'For sale', '', '2,000,000'),
(39, 'Mailo', '19', 'Photo_221276418.jpg', 'Titus', 'Omiden', '0760317540', '2022-12-12', 'documents_749905753.pdf', 'Munyonyo', 'For sale', '', '2,000,000'),
(40, 'Lease', '24', 'Photo_373478466.jpg', 'Titus', 'Omiden', '0760317540', '2023-12-12', 'documents_439231651.pdf', 'Munyonyo', 'For sale', '', '2,000,000'),
(41, 'Mailo', '123', 'Photo_38302166.jpg', 'Titus', 'Omiden', '0760317540', '2023-02-12', 'documents_1883901981.pdf', 'Munyonyo', 'For sale', '', '2,000,000');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(30) NOT NULL,
  `roll` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact` text NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `dob` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `roll`, `firstname`, `middlename`, `lastname`, `gender`, `contact`, `present_address`, `permanent_address`, `dob`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(6, 'A01035605', 'RICHARD', '', 'WEALTH', 'Male', '+256789936149', 'KISASI', '100 ACRES FOR FARMLAND', '2016-07-07', 1, 0, '2024-01-16 09:53:26', '2024-01-16 09:54:08'),
(7, '01', 'Sakina', '', 'Babgey', 'Female', '0706188158', 'KIRA', 'The client has land that she is selling in busunju (Namigavu) near Isbat university.\r\nLand size : 3.5 acres\r\nTenure: private mile land title\r\nDistance from main road : 1.5 km\r\nprice: 56m slightly negotiable\r\n\r\nNote: Urgent sale', '2024-02-07', 1, 0, '2024-02-07 15:18:42', '2024-03-01 20:36:53'),
(8, '02', 'Timuntu ', '', 'Zubair', 'Male', '0754909281', 'Bweyogerere', 'Client has two 3 properties on sale \r\n\r\nNamamve near roofings\r\n12 decimals\r\nprivate title\r\n45m\r\n\r\n12  decimals\r\nlocation: mukoono near mpooma secondary\r\nprivate title\r\nprice : 18m\r\n\r\nBweyogerere Butto\r\n20 decimals\r\nprivate title\r\nPrice : 170m', '2024-02-07', 1, 0, '2024-02-07 15:27:25', NULL),
(9, '03', 'Mr. Robert ', '', 'Mr. Robert ', 'Male', '+256701526900', 'Kampala - Uganda ', '20-30 decimals along Namugongo - Bweyogerere road for commercial use. Budget is 250m.', '2024-02-18', 1, 0, '2024-02-19 05:23:00', NULL),
(10, '09', 'Titus', '', 'ref', 'Male', '0756017575', 'Namugongo', 'Land', '2024-03-02', 1, 0, '2024-03-02 20:56:43', NULL);

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
(1, 'name', 'Customer Management System'),
(6, 'short_name', 'Chayil Realtors'),
(11, 'logo', 'uploads/logo-1703396974.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1703396975.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `otp` varchar(6) NOT NULL,
  `otp_expiry` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `email`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`, `otp`, `otp_expiry`) VALUES
(1, 'Zera', NULL, 'Admin', 'admin', 'tituszera@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, '2021-01-20 14:02:37', '2024-02-27 22:42:41', '', NULL),
(11, 'CLARE', NULL, 'AINE', 'Clare', 'clare@gmail.com', '1a56ecb4cb782ae0719ddd1f88b566e6', NULL, NULL, 1, 1, '2024-01-10 23:51:55', '2024-02-27 15:48:17', '', NULL),
(12, 'RICHARD', NULL, 'WEALTH', 'wealth', '', 'fc8d906ee769a1cd83cb5bd878494294', NULL, NULL, 1, 1, '2024-01-11 06:35:15', '2024-01-18 11:40:49', '', NULL),
(13, 'OMODING', NULL, 'JEFF PAUL', 'jeff', '', 'f865a8202e101116022da0c4b8029199', NULL, NULL, 2, 1, '2024-01-17 08:33:53', NULL, '', NULL),
(14, 'MUSISI', NULL, 'SALIM', 'salim', '', 'f865a8202e101116022da0c4b8029199', NULL, NULL, 2, 1, '2024-01-17 08:41:04', '2024-01-17 08:41:33', '', NULL),
(15, 'JACOB', NULL, 'ANGOLOL', 'jacob', '', 'f865a8202e101116022da0c4b8029199', NULL, NULL, 2, 1, '2024-01-18 12:41:53', NULL, '', NULL),
(17, 'Kato', NULL, 'Perez', 'Kato', 'Katoperez23@gmail.com', 'e1aa538d29017debe540309cd6f42d03', NULL, NULL, 2, 1, '2024-02-27 15:47:08', '2024-02-27 18:31:32', '', NULL),
(20, 'Titus', NULL, 'Zera', 'Titus', 'Tituszera@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL, 1, 1, '2024-02-28 22:29:41', '2024-03-02 12:03:49', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_history`
--
ALTER TABLE `academic_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land`
--
ALTER TABLE `land`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `academic_history`
--
ALTER TABLE `academic_history`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `land`
--
ALTER TABLE `land`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_history`
--
ALTER TABLE `academic_history`
  ADD CONSTRAINT `academic_history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `academic_history_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_list`
--
ALTER TABLE `course_list`
  ADD CONSTRAINT `course_list_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
