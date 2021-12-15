-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Dec 15, 2021 at 06:10 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

DROP TABLE IF EXISTS `attendence`;
CREATE TABLE IF NOT EXISTS `attendence` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `vol_id` int(5) NOT NULL,
  `event_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `vol_id`, `event_id`) VALUES
(5, 1, 1),
(8, 3, 1),
(9, 4, 2),
(10, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `blood_donor_profile`
--

DROP TABLE IF EXISTS `blood_donor_profile`;
CREATE TABLE IF NOT EXISTS `blood_donor_profile` (
  `donor_id` int(10) NOT NULL AUTO_INCREMENT,
  `donor_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(10) NOT NULL,
  `year` year(4) NOT NULL,
  `blood_group` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `last_donate` date NOT NULL,
  `next_donate` date NOT NULL,
  `mobile_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `stdy_year` int(1) NOT NULL,
  `pincode` int(8) NOT NULL,
  PRIMARY KEY (`donor_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blood_donor_profile`
--

INSERT INTO `blood_donor_profile` (`donor_id`, `donor_name`, `dept_id`, `year`, `blood_group`, `last_donate`, `next_donate`, `mobile_no`, `password`, `is_active`, `stdy_year`, `pincode`) VALUES
(1, 'Shivani Viju', 1, 2021, 'O+', '2020-10-25', '2021-01-25', '920741', '1345', 1, 2, 788768),
(2, 'Aseel Abdulla', 1, 2021, 'A+', '2021-03-01', '2021-06-01', '9207418150', '12345', 1, 1, 4567434);

-- --------------------------------------------------------

--
-- Table structure for table `blood_request`
--

DROP TABLE IF EXISTS `blood_request`;
CREATE TABLE IF NOT EXISTS `blood_request` (
  `request_id` int(5) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_unit` int(5) NOT NULL,
  `hospital` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` int(10) NOT NULL,
  `request_date` datetime NOT NULL,
  `is_verified` tinyint(1) DEFAULT NULL,
  `is_satisfied` tinyint(1) DEFAULT NULL,
  `pincode` int(8) NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blood_request`
--

INSERT INTO `blood_request` (`request_id`, `patient_name`, `blood_group`, `no_of_unit`, `hospital`, `mobile_no`, `request_date`, `is_verified`, `is_satisfied`, `pincode`) VALUES
(1, 'Aseel', 'A+', 3, 'asdasda', 2147483647, '2021-01-29 11:22:00', 1, 1, 335354),
(2, 'Aseel', 'A+', 2, 'asdasda', 2147483647, '2021-03-18 15:08:00', 1, 1, 343456);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dept_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `name`) VALUES
(1, 'BCA'),
(2, 'BBA'),
(6, 'BCom Tax'),
(7, 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `title`, `path`, `upload_date`) VALUES
(6, 'Notice for Camp', 'MINIPROJECT_finalreport_Guide_lines2020.', '2020-12-28 08:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `total_hour` int(10) NOT NULL,
  `venue` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `event_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `start_date`, `end_date`, `name`, `description`, `total_hour`, `venue`, `is_valid`) VALUES
(1, '2020-12-29', '2020-12-29', 'NSS Day Celebration', 'Special program as part of NSS day will be held on college and students should report on 10 am on 29th De', 4, 'MES College Marampally', 1),
(2, '2020-12-30', '2021-01-06', 'Camp', 'NSS camp will start on 30th Dec 2020 to 06 Jan 2021. All go through the notice in downloads', 23, 'GVHSS Ashamannoor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `upload_date`, `path`, `title`) VALUES
(1, '2020-12-28 08:47:57', 'IMG-20191226-WA0030.jpg', 'NSS Camp'),
(2, '2020-12-28 08:49:04', 'IMG-20190924-WA0121.jpg', 'Silver Jubilee Day');

-- --------------------------------------------------------

--
-- Table structure for table `leave_request`
--

DROP TABLE IF EXISTS `leave_request`;
CREATE TABLE IF NOT EXISTS `leave_request` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) NOT NULL,
  `v_id` int(10) NOT NULL,
  `reason` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `req_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `v_id` (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_request`
--

INSERT INTO `leave_request` (`id`, `event_id`, `v_id`, `reason`, `status`, `req_time`) VALUES
(2, 1, 1, 'Cant attend due to transportation', 1, '2020-12-28 09:29:09'),
(3, 2, 3, 'Cant attend due to transportation', 0, '2021-01-25 06:04:06'),
(4, 2, 4, 'Cant attend due to transportation', 1, '2021-01-26 18:01:12'),
(5, 1, 6, 'Cant attend due to transportation', 1, '2021-03-05 08:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `notification_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notification_time`, `title`, `description`, `category`) VALUES
(1, '2020-12-28 08:34:59', 'Call for Enrollment', 'All students who want to enroll as NSS volunteer visit NSS website and register for the same.', 'public'),
(2, '2020-12-28 08:36:40', 'New Program Officers', 'New program officers for our unit have been selected .', 'public'),
(3, '2021-01-25 05:33:01', 'Event Cancelled', 'Event Seminar scheduled on 2021-01-27 is cancelled. Sorry for the inconvinience', 'public'),
(4, '2021-01-26 17:51:50', 'Event Cancelled', 'Event Meeting scheduled on 2021-01-28 is cancelled. Sorry for the inconvinience', 'public'),
(5, '2021-03-05 08:25:52', 'Event Cancelled', 'Event test event scheduled on 2021-03-10 is cancelled. Sorry for the inconvinience', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `portal_status`
--

DROP TABLE IF EXISTS `portal_status`;
CREATE TABLE IF NOT EXISTS `portal_status` (
  `id` int(5) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `portal_status`
--

INSERT INTO `portal_status` (`id`, `type`, `status`) VALUES
(1, 'registration', 0),
(2, 'enrollment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program_officers`
--

DROP TABLE IF EXISTS `program_officers`;
CREATE TABLE IF NOT EXISTS `program_officers` (
  `po_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `phone` int(12) NOT NULL,
  PRIMARY KEY (`po_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `program_officers`
--

INSERT INTO `program_officers` (`po_id`, `name`, `dept_id`, `status`, `phone`) VALUES
(1, 'Lorem', 1, 1, 845154512),
(2, 'Ipsum', 1, 0, 87115464),
(3, 'Aseel Abdulla', 1, 0, 98884353);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `user_type_id` int(2) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_type_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `type`) VALUES
(1, 'volunteer'),
(2, 'secretary'),
(3, 'blood_manager'),
(4, 'registered'),
(5, 'can_enroll');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers_profile`
--

DROP TABLE IF EXISTS `volunteers_profile`;
CREATE TABLE IF NOT EXISTS `volunteers_profile` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `guardian_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `community` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` int(8) NOT NULL,
  `place` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `user_type` int(2) NOT NULL,
  `year_of_join` year(4) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type` (`user_type`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `volunteers_profile`
--

INSERT INTO `volunteers_profile` (`id`, `name`, `gender`, `guardian_name`, `dob`, `community`, `blood_group`, `mobile_no`, `email`, `pincode`, `place`, `is_active`, `user_type`, `year_of_join`, `dept_id`, `username`, `password`) VALUES
(1, 'Aseel Abdulla', 'Male', 'Abdulla', '2000-08-05', 'OBC', 'O+', '9309409358', 'random@gmail.com', 624587, 'Manjeri', 1, 4, 2020, 1, 'aseelsm', '12345'),
(2, 'Wilfred', 'Male', 'Wilson', '2000-06-07', 'General', 'O+', '90734723444', 'random@gmail.com', 454545, 'KLM', 1, 1, 2021, 1, 'fredy', '12345'),
(3, 'Amal', 'Male', 'Sukumaran', '2021-01-15', 'OBC', 'A+', '45454464', 'random@gmail.com', 8787, 'LML', 1, 2, 2021, 1, 'amal', '12345'),
(4, 'Milan Issac', 'Male', 'Issac', '2021-01-20', 'OBC', 'O-', '5464565455', 'random@gmail.com', 4545645, 'Idukki', 1, 1, 2021, 1, 'milan', '12345'),
(5, 'Ashika', 'Female', '', '0000-00-00', '', '', '', '', 0, '', 0, 5, 0000, 1, 'ashika', '12345'),
(6, 'Test Stdent', 'Male', 'Wilson', '2000-01-01', 'OBC', 'O-', '9207418150', 'test@gmail.com', 454567, 'Manjeri', 1, 1, 2021, 1, 'test', '12345');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_donor_profile`
--
ALTER TABLE `blood_donor_profile`
  ADD CONSTRAINT `blood_donor_profile_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `volunteers_profile`
--
ALTER TABLE `volunteers_profile`
  ADD CONSTRAINT `volunteers_profile_ibfk_2` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`user_type_id`),
  ADD CONSTRAINT `volunteers_profile_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
