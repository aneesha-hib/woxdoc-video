-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 04:38 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Admin', '$2y$10$ap9gMynQctLg8.MyCsq9z.0pMz2jVIYWzcCGUBZ9I1UJ38mQSWxp.');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `sex` varchar(15) NOT NULL,
  `Age` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `appointment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `created_on`, `FirstName`, `LastName`, `Email`, `Phone`, `Address`, `sex`, `Age`, `id`, `appointment_date`) VALUES
(10, '2020-11-20 10:15:27', 'Aneesh', 'Joy', 'aneesh@gmail.com', '821676070', 'ABC (H) Nadathara', 'male', 35, 111, '2020-11-20'),
(11, '2020-11-21 05:12:36', 'Amminikutty ', 'Jenson', 'amminikutty@gmail.com', '9400369253', 'Kuruthukulangara Koola (H) P O Nadathara 680751', 'female', 48, 110, '2020-11-21'),
(12, '2020-11-21 05:24:54', 'Jenson', 'Koola', 'jensonkoola@gmail.com', '8281676070', 'Kuruthukulangara Koola (H) P O Nadathara 680751', 'male', 54, 110, '2020-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `medicine_usage` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `medicine_name`, `medicine_usage`, `created_on`, `id`) VALUES
(5, 'avil', 'cold', '2020-11-19 08:22:46', 110),
(8, 'azithomizne', 'ointement', '2020-11-19 09:26:17', 110),
(19, 'K-Met 500', 'Diabetics', '2020-11-21 06:43:17', 110),
(20, 'Dolo', 'body pain , fever , throat pain', '2020-11-21 06:43:57', 110),
(21, 'rfser', 'dsfgsdt', '2020-11-23 08:00:17', 110),
(22, 'fgsd', 'fgsdt', '2020-11-23 08:00:24', 110);

-- --------------------------------------------------------

--
-- Table structure for table `patient_list`
--

CREATE TABLE `patient_list` (
  `patientlist_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `Age` int(11) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_list`
--

INSERT INTO `patient_list` (`patientlist_id`, `created_on`, `FirstName`, `LastName`, `Email`, `Phone`, `Address`, `sex`, `Age`, `id`) VALUES
(47, '2020-11-18 09:38:57', 'Luke', 'Pavil', 'pavilvjohn@gmail.com', '9746966636', 'Vezhaparambil (H) P O Poothole ', 'male', 0, 110),
(38, '2020-11-13 11:21:42', 'Sona', 'Francis', 'sona@gmail.com', '7356565282', 'kurthukulanara kula', 'male', 24, 106),
(46, '2020-11-18 09:35:37', 'John', 'Pavil', 'aneenajenson9393@gmail.com', '9961473787', 'Vezhaparambil (H) P O Poothole', 'male', 1, 110),
(48, '2020-11-19 11:43:58', 'Aneesha', 'Jenson', 'aneesha@woxro.com', '8606606046', 'Kuruthukulangara Koola (H) P O Nadathara 680751', 'female', 22, 110),
(50, '2020-11-20 04:04:53', 'Anju', 'Francis', 'anjufrancis@gmail.com', '9854786525', 'ABC (H) P O Ayyanthole', 'female', 26, 111),
(51, '2020-11-20 04:09:04', 'Alina ', 'Jolly', 'alinajolly@gmail.com', '9565412541', 'ABC (H) P O Kodakkara', 'female', 25, 111),
(52, '2020-11-20 04:39:47', 'Irene', 'Joseph', 'irenejoseph@gmail.com', '9857457845', 'ABC (H) Ollukkara', 'female', 25, 111),
(53, '2020-11-20 10:16:10', 'Aneesha', 'Jenson', 'aneesha@woxro.com', '8606606046', 'Kuruthukulangara Koola (H) P O Nadathara 680751', 'female', 22, 111),
(54, '2020-11-21 04:23:17', 'Aneena', 'Pavil', 'aneenajenson9393@gmail.com', '9961473787', 'Vezhaparambil (H) P O Poothole', 'female', 24, 110),
(69, '2020-11-21 08:03:07', 'Jenson', 'K K', 'jensonkoola@gmail.com', '8281676070', 'Kuruthukulangara Koola (H) P O Nadathara 680751', 'male', 54, 110),
(68, '2020-11-21 06:38:32', 'Amminikutty', 'Jenson', 'amminikutty@gmail.com', '9400369253', 'Kuruthukulangara Koola (H) P O Nadathara 680751', 'female', 48, 110);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `patientlist_id` int(11) NOT NULL,
  `prescriped_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `symptoms` varchar(50) NOT NULL,
  `prescription` varchar(100) NOT NULL,
  `Impression` varchar(50) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `patientlist_id`, `prescriped_date`, `symptoms`, `prescription`, `Impression`, `id`) VALUES
(47, 38, '2020-11-13 12:03:10', 'sdas', 'sdcsd', 'sdas', 106),
(44, 28, '2020-11-13 10:52:21', 'dfvsd', 'dfvs', 'dfvsd', 103),
(43, 28, '2020-11-13 10:52:10', 'egtr', 'dfg', 'dr', 103),
(46, 38, '2020-11-13 11:40:35', 'dfgas', 'sdf', 'sdfg', 106),
(62, 47, '2020-11-18 09:40:59', 'stomach pain,cough', 'Grape water', 'acidity ', 110),
(63, 46, '2020-11-19 08:35:08', 'gfhwer', 'Bravo', 'erther', 110),
(61, 46, '2020-11-18 09:37:08', 'stomach pain , fever', 'vamol , Grape water', 'acidity, viral fever', 110),
(71, 46, '2020-11-23 08:43:11', 'fever', 'Dolo', 'viral fever', 0),
(70, 47, '2020-11-19 09:27:05', 'dfgas', 'kjhg', 'sdas', 110);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscriptionId` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `subscriptionType` varchar(225) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `noOfPatients` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscriptionId`, `doctorId`, `subscriptionType`, `amount`, `noOfPatients`) VALUES
(131, 110, 'bronce', '1000', '50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `department` varchar(255) NOT NULL,
  `usertype` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `address`, `phone`, `department`, `usertype`) VALUES
(115, 'Dr. Arun George', 'arun@gmail.com', '$2y$10$q2yLvRGVIURW7UdXrIJqJudO0sbEIJsUTxClZl5EHcMbd.KGSm5VG', 'XYZ ( H )  P O nfbge', '54685475184', 'Cardiologist', NULL),
(118, 'Dr. Belma Rose', 'belma@gmail.com', '$2y$10$.FbffminW75Pa/NCy8PdNeaxgBvuMgus72Y.DtyayMoNSlRIaAurK', 'XYZ (H) P O sfuiaw', '9784578964', 'MBBS', NULL),
(111, 'Dr. Manoj', 'manoj@gmail.com', '$2y$10$A/SNPdfZSbrto8dmpOSkcO6UOj1J9kyOasMKgI7Y/xBU58RGccJla', 'ABC (H) P O Puthur', '8645784585', 'MBBS , Surgeon', NULL),
(112, 'Dr. sujatha', 'sujatha@gmail.com', '$2y$10$EfCC8XP4wZF/GqbvpIeoOeAbSjzWjhUCWHNBS9ipE/c3jlpvyEtIe', 'ABC (H) P O Chembukkavu', '8965457852', 'Pediatrician', NULL),
(110, 'Dr. Jose Paul', 'aneesha@woxro.com', '$2y$10$RE0WH0urJWtTyisqM7LWfeoH18zNyg1SkLtzpcGN6PfpOUKEGsJmK', 'ABC (H) Kizhekkekotta', '7854859545', 'Pediatrician', NULL),
(113, 'Dr. Aravind', 'aravindtp@gmail.com', '$2y$10$AIEm3n9fFFE8uVvCqRtBc.JIcMYffJZLfUwNiwtffB7Zpd6JlDhRu', 'ABC (H)  P O Nadavarambu', '9654874585', 'Oncology', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `patient_list`
--
ALTER TABLE `patient_list`
  ADD PRIMARY KEY (`patientlist_id`,`Email`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscriptionId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patient_list`
--
ALTER TABLE `patient_list`
  MODIFY `patientlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscriptionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
