-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2016 at 03:27 PM
-- Server version: 5.7.12-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hariomjyotish_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `givenName` varchar(50) NOT NULL,
  `familyName` varchar(50) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `birthday` varchar(15) NOT NULL,
  `anniversary` varchar(15) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`seq`, `title`, `fullName`, `givenName`, `familyName`, `phone`, `email`, `birthday`, `anniversary`, `active`) VALUES
(1, 'ShrRel', 'ShrRel', 'ShrRel', '', '9022326007<br/>', 'shr.makwana@gmail.com', '1996-07-11', '', 1),
(2, 'Mom', 'Mom', 'Mom', '', '9876543210<br/>', 'shraddha.mak1911@gmail.com\r\n', '1970-11-05', '1966-12-28', 1),
(3, 'Dad', 'Dad', 'Dad', '', '9123456789<br/>', 'hemal0105@gmail.com', '', '', 1),
(4, 'Rel', 'Rel', 'Rel', '', '8080606587<br/>', 'hemal0105@yahoo.com<br/>', '1990-05-01', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fixed_events`
--

DROP TABLE IF EXISTS `fixed_events`;
CREATE TABLE IF NOT EXISTS `fixed_events` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_name` varchar(50) NOT NULL,
  `e_message` varchar(500) NOT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fixed_events`
--

INSERT INTO `fixed_events` (`e_id`, `e_name`, `e_message`) VALUES
(1, 'birthday', 'Happy Birthdazdy! Enjoy 1sdd23456.'),
(2, 'anniversary', 'Happy Anndfsdfsdfiversery 123!');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_events`
--

DROP TABLE IF EXISTS `scheduled_events`;
CREATE TABLE IF NOT EXISTS `scheduled_events` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_name` varchar(50) NOT NULL,
  `e_message` varchar(500) NOT NULL,
  `e_date` varchar(20) NOT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scheduled_events`
--

INSERT INTO `scheduled_events` (`e_id`, `e_name`, `e_message`, `e_date`) VALUES
(1, 'Holiiiii festival', 'Happy Holiiiiiiiiiiii have fun', '2016-06-09'),
(2, 'diwali', 'Happy Diwali :)', '2016-06-21'),
(3, 'abc111111', 'abc!!!!!!', '2016-06-22'),
(4, 'dasasasasa', 'sdasdasd', '2016-06-01'),
(5, 'asdasd', 'afdadf', '2016-06-18'),
(6, 'adfad', 'asdad', '2016-06-01'),
(7, 'abc', 'abc', '2016-06-18'),
(8, 'acasdads', 'kjgkhhhasdda', '2016-06-15'),
(9, 'adasdasdasd', 'asdadasdasdasd', '2016-06-18'),
(10, 'ajsgdkjsjdgfs.dkfbv', 'dzdkhfnbvdsaf.hkdgb', '2016-06-18'),
(11, 'abca', 'akhagsdkh', '2016-06-18'),
(12, 'asassaasdfdfadf', 'adfsdfsdfsdfsdf', '2016-06-18'),
(13, 'abvcasdjggafkhvsd', '.ajbsddasf ghsbdvc', '2016-06-18'),
(14, 'asdasd', 'sadfsdf', '2016-06-18'),
(15, 'abc', 'akjsdbaksmndb', '2016-06-18'),
(16, 'abcas.kdnas.d', 'as.mbcsda,nf.', '2016-06-18'),
(17, 'aasdfsdfsdf', 'fdgdfg', '2016-06-18'),
(18, 'fghhjfgh', 'fghfg', '2016-06-18'),
(19, 'abvakshgd', 'kefbw,dnf', '2016-06-18'),
(20, 'sdfkgshdvhfksd', 'df.jd.fmgb v', '2016-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`seq`, `email`, `password`) VALUES
(1, 'shraddha.mak1911@gmail.com', '123456789'),
(2, 'hemal0105@yahoo.com', 'hemal0105'),
(3, 'hemal0105', '987654321');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
