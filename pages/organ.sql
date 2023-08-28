-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2020 at 11:33 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organ`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ad_id` int(10) NOT NULL,
  `ad_name` varchar(200) NOT NULL,
  `ad_email` varchar(200) NOT NULL,
  `ad_cont` bigint(15) NOT NULL,
  `ad_addr` varchar(500) NOT NULL,
  `ad_pass` varchar(500) NOT NULL,
  `salt` text NOT NULL,
  `ad_flag` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ad_id`, `ad_name`, `ad_email`, `ad_cont`, `ad_addr`, `ad_pass`, `salt`, `ad_flag`) VALUES
(1, 'Ashwini hospital', 'ashwinih@gmail.com', 9876543211, 'solapur', '$2y$10$SoLvUtgLdaup/aU6tWAowOZ3wQtU/p3uxt/LszwO9OCMi6LREVB4.', 'ac046b15f95747619a0e6b1762bdb18cfd6ca507cfd700da8e86aec53a44679569d4ac7367dc7257a01ff2f1443b4a6a8617be0c582bdb075e08f166e1afb44e', 1),
(2, 'Solapur Rugnalaya Solapur', 'Solapurh@gmail.com', 3453435434, 'solapur', '$2y$10$EztbTBo.6McSyjqduDxjXOhpjsfuUY5j7wb5KgZNY3/2iZyvYC/Kq', '68c8603a8ce6342fe945fa0f1ab797a52129a64679bf285a9801de75bf457c360569b904e49005571580e71b9cdd56999e74034f6a65d06bf71b54e1df83c70c', 1),
(3, 'Civil hospital', 'civilh@gmail.com', 3455645746, 'solapur', '$2y$10$jYnR7SosEmHg9yWHWEvUy.QuF5hBXnsOudd9sXdIx9VmjUTHbZXmO', '202e316ed2d60090df8d707ea9fac17fc41add905190c48019464bf775e5a2d639505a427ed64ea82b12a6c661d047e83772ec4ec657276b5d03e706cb55a49a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `donner`
--

CREATE TABLE `donner` (
  `d_id` int(10) NOT NULL,
  `d_name` varchar(200) NOT NULL,
  `d_cont` bigint(15) NOT NULL,
  `d_email` varchar(200) NOT NULL,
  `d_age` smallint(5) NOT NULL,
  `d_bgrp` varchar(50) NOT NULL,
  `d_gender` varchar(50) NOT NULL,
  `d_addr` varchar(500) NOT NULL,
  `d_organ` varchar(500) NOT NULL,
  `d_exdt` varchar(100) NOT NULL,
  `d_flag` int(10) NOT NULL,
  `ad_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donner`
--

INSERT INTO `donner` (`d_id`, `d_name`, `d_cont`, `d_email`, `d_age`, `d_bgrp`, `d_gender`, `d_addr`, `d_organ`, `d_exdt`, `d_flag`, `ad_id`) VALUES
(1, 'Rajesh Katare', 8007026979, 'r@g.c', 29, 'A-', 'Male', 'solapur', 'Any body Part,Heart,Lungs,Liver', '1583967600', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requester`
--

CREATE TABLE `requester` (
  `r_id` int(10) NOT NULL,
  `r_name` varchar(200) NOT NULL,
  `r_cont` bigint(15) NOT NULL,
  `r_email` varchar(200) NOT NULL,
  `r_age` smallint(5) NOT NULL,
  `r_bgrp` varchar(50) NOT NULL,
  `r_gender` varchar(50) NOT NULL,
  `r_addr` varchar(500) NOT NULL,
  `r_organ` varchar(500) NOT NULL,
  `r_ondt` varchar(100) NOT NULL,
  `r_flag` int(10) NOT NULL,
  `ad_id` int(10) NOT NULL,
  `acc_to` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requester`
--

INSERT INTO `requester` (`r_id`, `r_name`, `r_cont`, `r_email`, `r_age`, `r_bgrp`, `r_gender`, `r_addr`, `r_organ`, `r_ondt`, `r_flag`, `ad_id`, `acc_to`) VALUES
(1, 'shubham mahindrakar', 8862080189, 'shubham888mahi@gmail.com', 25, 'A Positive', 'Male', 'damani nagar solapur', 'corneas,Kidneys,Heart,Lungs', '1583017200', 1, 1, 0),
(2, 'Rajesh katare', 9876543211, 'shubham@gmail.com', 25, 'A Positive', 'Male', 'damani nagar ,solapur', 'Kidneys', '1583017200', 1, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `donner`
--
ALTER TABLE `donner`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `requester`
--
ALTER TABLE `requester`
  ADD PRIMARY KEY (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ad_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `donner`
--
ALTER TABLE `donner`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `requester`
--
ALTER TABLE `requester`
  MODIFY `r_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
