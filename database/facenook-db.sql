-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2023 at 02:59 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facenook-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id`, `user_id`, `post`, `image`, `date`) VALUES
(1, 1, 'Test', 'Screenshot (21).png', '2023-10-06 04:21:08'),
(2, 1, 'Test 2', 'Screenshot (20).png', '2023-10-06 04:21:35'),
(3, 1, 'test 3', 'Screenshot (25).png', '2023-10-06 04:30:07'),
(4, 1, 'test 4', 'qoutes.png', '2023-10-06 04:38:35'),
(5, 3, 'This is my work', 'facenook.jpg', '2023-10-06 04:45:50'),
(6, 4, 'Testing', 'images (2).jpg', '2023-10-09 04:14:39'),
(7, 4, 'Testing 1000000', 'Screenshot (13).png', '2023-10-09 04:15:37'),
(8, 1, 'ffff', '', '2023-10-21 10:04:34'),
(11, 4, '', 'anime.jpg', '2023-10-23 12:30:14'),
(12, 1, '', 'carserv.jpg', '2023-10-25 14:25:41'),
(13, 1, '', 'FB_IMG_16735745054116147.jpg', '2023-10-26 12:25:26'),
(14, 1, '', 'paanoKung.jpg', '2023-10-26 12:25:56'),
(10, 1, 'uihdid hdwe eh fwe uwehwh ehfhe iehieu euhuiwef ewuhuie euhuiewhur ehruieh erhuwfein ', '', '2023-10-21 10:34:41'),
(15, 1, '', 'theres-a-lot-of-competition-competitive.gif', '2023-10-26 12:26:26'),
(16, 1, '', 'wyd.jpg', '2023-10-26 12:26:59'),
(17, 1, '', 'girl meme.jfif', '2023-10-26 12:33:31'),
(18, 1, 'Bahu kunong Duga', 'bahug.jfif', '2023-10-26 12:34:39'),
(19, 5, 'Photo lab sa ta run', 'dulce.jfif', '2023-10-26 12:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `birth_date` varchar(11) NOT NULL,
  `school` varchar(100) NOT NULL,
  `biography` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `profile`, `address`, `birth_date`, `school`, `biography`, `username`, `password`, `role`, `date`) VALUES
(1, 'Roland Clarion', 'johny.jfif', 'San Carlos City', '2023-10-25', 'CPSU', 'I am Who I am', 'yoyan', '1a1dc91c907325c69271ddf0c944bc72', 'user', '2023-10-13 11:39:51'),
(2, 'Group 1', '', '', '0000-00-00', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2023-10-13 11:39:51'),
(3, 'Paolo Lumanog', 'c3.jpg', 'San Carlos City', '2023-10-26', 'CPSU', 'gwapo', 'paolo', '1a1dc91c907325c69271ddf0c944bc72', 'user', '2023-10-13 11:39:51'),
(4, 'Lowie Libongcogon', 'vesper.jfif', 'San Carlos City', '2015-11-23', 'CPSU', 'akoy pinaka gwapo sa tanan', 'lowe', '1a1dc91c907325c69271ddf0c944bc72', 'user', '2023-10-13 11:39:51'),
(5, 'Generous Salumag', 'bahug.jfif', 'San Carlos City', '2023-10-26', 'CPSU', 'Ako ang pina ka gwapa', 'gene', '1a1dc91c907325c69271ddf0c944bc72', 'user', '2023-10-16 12:52:27'),
(11, 'Maribel Balancar', 'caila.jpg', 'San Carlos City', '2023-10-26', 'CPSU', 'Muse ng BSIT 3C', 'maribel', '1a1dc91c907325c69271ddf0c944bc72', 'user', '2023-10-26 13:00:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
