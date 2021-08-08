-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 08, 2021 at 05:41 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LoginSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'vaish', '81dc9bdb52d04dc20036dbd8313ed055'),
(20, 'sad\'sad', '81dc9bdb52d04dc20036dbd8313ed055'),
(21, 'asd\'asd', '81dc9bdb52d04dc20036dbd8313ed055'),
(22, 'hi\'hi', '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'jenny', '81dc9bdb52d04dc20036dbd8313ed055'),
(24, 'hi', '81dc9bdb52d04dc20036dbd8313ed055'),
(25, 'dad', '81dc9bdb52d04dc20036dbd8313ed055'),
(26, 'heybuddy', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `deadline` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `photo`, `title`, `description`, `deadline`) VALUES
(60, '05_05_2021.jpg', 'Delta t-shirt', 'Choose the following answer', ''),
(61, '29_05_2021.jpg', 'test-1', 'Choose the following answer', '08/07/2002'),
(62, '05_05_2021.jpg', 'test-2', 'Choose the following answer', '14/12/2021'),
(63, '05_05_2021.jpg', 'test-3', 'Choose the following answer', '-Nil-'),
(64, '27_04_2021.jpg', 'test-4', 'Choose the following answer', '02/08/2021'),
(65, '29_05_2021.jpg', 'test-5', 'Choose the following answer', '02/08/2021 23:59'),
(66, '27_04_2021.jpg', 'test-5', 'Choose the following answer', '02/08/2021 19:06'),
(67, '27_04_2021.jpg', 'test-6', 'Choose the following answer', '02/08/2021 23:59'),
(68, '05_05_2021.jpg', 'test-7', 'Choose the following answer', '02/08/2021 23:59'),
(69, '29_05_2021.jpg', 'test-7', 'Choose the following answer', '03/08/2021 16:25'),
(70, '', 'test-8', '', ''),
(71, '05_05_2021.jpg', 'test-9', 'choose', '');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_id`, `title`, `votes`) VALUES
(62, 60, 'yes\r', 1),
(63, 60, 'no', 0),
(66, 61, 'Yes\r', 1),
(67, 61, 'No', 0),
(68, 62, 'Yes\r', 1),
(69, 62, 'No', 0),
(70, 63, 'Yes\r', 0),
(71, 63, 'No', 0),
(72, 64, 'Yes\r', 1),
(73, 64, 'No', 0),
(74, 65, 'Yes\r', 0),
(75, 65, 'No', 0),
(76, 66, 'Yes\r', 0),
(77, 66, 'No', 0),
(78, 67, 'Yes\r', 1),
(79, 67, 'No', 0),
(80, 68, 'Yes\r', 0),
(81, 68, 'No', 0),
(82, 69, 'Yes\r', 0),
(83, 69, 'No', 0),
(84, 70, 'Yes\r', 2),
(85, 70, 'No', 0),
(86, 71, 'yes\r', 1),
(87, 71, 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `voted`
--

CREATE TABLE `voted` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `user` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voted`
--
ALTER TABLE `voted`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `voted`
--
ALTER TABLE `voted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
