-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 04:22 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loansapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_perfornamce`
--

CREATE TABLE `api_perfornamce` (
  `id` int(11) NOT NULL,
  `request_tally` int(2) NOT NULL,
  `request_state` varchar(10) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api_perfornamce`
--

INSERT INTO `api_perfornamce` (`id`, `request_tally`, `request_state`, `details`) VALUES
(1, 1, 'FAIL', 'Value was not a Number!'),
(2, 1, 'FAIL', 'Account Number did not have 10 digits!'),
(3, 1, 'PASS', 'Account Has at least one Outstanding Loan!'),
(4, 1, 'PASS', 'Account Has at least one Outstanding Loan!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(150) NOT NULL,
  `pwd` varchar(150) NOT NULL,
  `pwd2` varchar(150) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pwd`, `pwd2`, `status`) VALUES
(1, 'api-admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_perfornamce`
--
ALTER TABLE `api_perfornamce`
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
-- AUTO_INCREMENT for table `api_perfornamce`
--
ALTER TABLE `api_perfornamce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
