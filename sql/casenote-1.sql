-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2018 at 08:11 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `casenote`
--

CREATE TABLE `casenote` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `health_status` varchar(255) DEFAULT NULL,
  `prescription` text,
  `diagnosis` text,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casenote`
--

INSERT INTO `casenote` (`id`, `patient_id`, `health_status`, `prescription`, `diagnosis`, `created_by`, `date_created`, `updated_by`, `date_updated`) VALUES
(7, 2, 'good', NULL, 'can go home', 1, '2018-03-05 09:50:11', NULL, NULL),
(8, 2, 'dd', NULL, 'ddd', 1, '2018-03-05 09:51:57', NULL, NULL),
(10, 9, 'Weak and vommitinga', 'yes', 'somehow', 6, '2018-04-07 18:52:08', NULL, '2018-04-07 19:28:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casenote`
--
ALTER TABLE `casenote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `casenote`
--
ALTER TABLE `casenote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
