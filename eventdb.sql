-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2021 at 06:08 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(13, 'Ratul', 'ratulsikder104@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(14, 'Palash', 'palashsikder600@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `place` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `admin_id`, `title`, `description`, `image`, `place`, `address`, `date`, `status`) VALUES
(36, 13, 'Event Title One', 'What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specim', 'uploads/159703.jpg', 'shashikar', 'Shashikar, Kalkini, Madaripur', '2021-01-23', 'inactive'),
(37, 13, 'Event Title Two', 'ইংরেজি থেকে অনুবাদ করা হয়েছে-প্রকাশনা এবং গ্রাফিক ডিজাইনে, লরেম ইপসাম হ\'ল একটি স্থানধারক পাঠ্য যা সাধারণত কোনও দস্তাবেজের ভিজ্যুয়াল ফর্ম বা কোনও টাইপফেসকে অর্থবোধক সামগ্রীর উপর নির্ভর না করে প্রদর্শন করতে ব্যবহৃত হয়। চূড়ান্ত অনুলিপি উপলভ্য হওয়ার আগে প', 'uploads/1366x768-DSC100037270.jpg', 'dhaka', 'Mohammadpu, Dhaka', '2021-01-24', 'active'),
(38, 13, 'Event Title Three', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s. When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetti', 'uploads/159718.jpg', 'shashikar', 'Shashikar, Kalkini, Madaripur', '2021-01-24', 'active'),
(39, 13, 'Event Title Four', 'ince Bootstrap is developed to be mobile first, we use a handful of media queries to create sensible breakpoints for our layouts and interfaces. These breakpoints are mostly based on minimum viewport widths and allow us to scale up elements as the viewpor', 'uploads/unnamed.jpg', 'Khulna', 'Bus Stand, Khulna', '2021-01-24', 'active'),
(43, 14, 'Palash Event One', 'Send your Text Message to anyone worldwide for FREE with our International SMS Messaging Service. Send FREE SMS instantly with our incredibly fast SMS Service. The world best and fastest text messaging service online!', 'uploads/vg.png', 'Palash House', 'Shashikar, Kalkini, Madaripur', '2021-01-24', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
