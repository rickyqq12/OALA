-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2021 at 08:17 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oala`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CourseId` char(5) NOT NULL,
  `CourseName` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseId`, `CourseName`) VALUES
('ADD01', 'Penjumlahan'),
('DIV01', 'Pembagian'),
('MUL01', 'Perkalian'),
('SUB01', 'Pengurangan');

-- --------------------------------------------------------

--
-- Table structure for table `coursesolved`
--

CREATE TABLE `coursesolved` (
  `UserId` char(5) NOT NULL,
  `CourseId` char(5) NOT NULL,
  `CourseStatus` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursesolved`
--

INSERT INTO `coursesolved` (`UserId`, `CourseId`, `CourseStatus`) VALUES
('600d4', 'ADD01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentId` char(5) NOT NULL,
  `PaymentDate` date NOT NULL,
  `PaymentStatus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paymenttype`
--

CREATE TABLE `paymenttype` (
  `PaymentTypeId` char(5) NOT NULL,
  `PaymentTypeName` varchar(115) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `QuestionId` char(5) NOT NULL,
  `CourseId` char(5) DEFAULT NULL,
  `Question` varchar(255) NOT NULL,
  `Answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`QuestionId`, `CourseId`, `Question`, `Answer`) VALUES
('A-001', 'ADD01', '1+1', 2),
('A-002', 'ADD01', '3+2', 5),
('A-003', 'ADD01', '4+3', 7),
('D-001', 'DIV01', '10/5', 2),
('D-002', 'DIV01', '8/4', 2),
('D-003', 'DIV01', '4/2', 2),
('M-001', 'MUL01', '2*3', 6),
('M-002', 'MUL01', '2*1', 2),
('M-003', 'MUL01', '3*3', 9),
('S-001', 'SUB01', '9-3', 6),
('S-002', 'SUB01', '4-1', 3),
('S-003', 'SUB01', '6-4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `questionsolved`
--

CREATE TABLE `questionsolved` (
  `UserId` char(5) NOT NULL,
  `QuestionId` char(5) NOT NULL,
  `QuestionStatus` varchar(9) DEFAULT NULL,
  `UserAnswer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionsolved`
--

INSERT INTO `questionsolved` (`UserId`, `QuestionId`, `QuestionStatus`, `UserAnswer`) VALUES
('600d4', 'A-002', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `SubscriptionId` char(5) NOT NULL,
  `SubscriptionPackage` varchar(150) NOT NULL,
  `SubscriptionPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TransactionId` varchar(36) NOT NULL,
  `UserId` char(5) DEFAULT NULL,
  `SubscriptionId` char(5) DEFAULT NULL,
  `PaymentTypeId` char(5) DEFAULT NULL,
  `PaymentId` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` char(5) NOT NULL,
  `UserName` varchar(15) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `NoTelp` varchar(15) NOT NULL,
  `DOB` date NOT NULL,
  `UserSubscriptionStatus` int(11) DEFAULT 0,
  `Image` varchar(30) NOT NULL DEFAULT 'profile_pics/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `Email`, `Password`, `NoTelp`, `DOB`, `UserSubscriptionStatus`, `Image`) VALUES
('600d4', 'dummy', 'dummy@gmail.com', 'asdf1234', '082113310921', '0003-02-01', 1, 'profile_pics/dummy.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseId`);

--
-- Indexes for table `coursesolved`
--
ALTER TABLE `coursesolved`
  ADD PRIMARY KEY (`UserId`,`CourseId`),
  ADD KEY `CourseId` (`CourseId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentId`);

--
-- Indexes for table `paymenttype`
--
ALTER TABLE `paymenttype`
  ADD PRIMARY KEY (`PaymentTypeId`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`QuestionId`),
  ADD KEY `CourseId` (`CourseId`);

--
-- Indexes for table `questionsolved`
--
ALTER TABLE `questionsolved`
  ADD PRIMARY KEY (`UserId`,`QuestionId`),
  ADD KEY `QuestionId` (`QuestionId`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`SubscriptionId`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TransactionId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `SubscriptionId` (`SubscriptionId`),
  ADD KEY `PaymentTypeId` (`PaymentTypeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coursesolved`
--
ALTER TABLE `coursesolved`
  ADD CONSTRAINT `coursesolved_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coursesolved_ibfk_2` FOREIGN KEY (`CourseId`) REFERENCES `course` (`CourseId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`CourseId`) REFERENCES `course` (`CourseId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionsolved`
--
ALTER TABLE `questionsolved`
  ADD CONSTRAINT `questionsolved_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questionsolved_ibfk_2` FOREIGN KEY (`QuestionId`) REFERENCES `question` (`QuestionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`SubscriptionId`) REFERENCES `subscription` (`SubscriptionId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`PaymentTypeId`) REFERENCES `paymenttype` (`PaymentTypeId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
