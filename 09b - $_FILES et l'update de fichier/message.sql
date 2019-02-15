-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2016 at 04:44 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `winners`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmed` tinyint(1) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `hires` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `created`, `confirmed`, `name`, `email`, `message`, `hires`, `thumb`, `fichier`) VALUES
(1, '2016-01-11 15:59:57', NULL, 'dsqf', 'bob@bob.com', 'pouetpouettest                        ', 'odd-one-out-optical-illusion.png', 'odd-one-out-optical-illusion.jpeg', 'odd-one-out-optical-illusion.png'),
(3, '2016-01-11 16:15:31', NULL, 'toto', 'toto@toto.Com', 'machin                                    ', '', '', ''),
(4, '2016-01-18 13:35:20', NULL, 'erferfre', 'dfg@dg.vom', 'dlamerde', '', '', 'odd-one-out-optical-illusion.png'),
(5, '2016-01-18 16:42:13', NULL, 'lol', 'lol@lol.Com', 'dczeze                                    ', '', '', ''),
(6, '2016-01-25 12:36:46', NULL, 'test', 'test@test.com', 'pouet                                    ', '', '', ''),
(7, '2016-01-25 12:38:41', NULL, 'testrrrrrrrr', 'test@test.com', 'pouet                                    ', '', '', ''),
(8, '2016-01-25 12:39:09', NULL, 'boblechat', 'test@test.com', 'pouet                                    ', '', '', ''),
(9, '2016-01-25 12:55:27', NULL, 'test', 'test@test.com', 'pouet                                    ', '', '', ''),
(10, '2016-01-25 12:55:59', NULL, ',nn;,n', 'bob@bob.com', 'pouet                                    ', '', '', ''),
(11, '2016-01-25 12:57:04', NULL, 'testqsdqsd', 'test@test.com', 'pouet                                    ', '', '', ''),
(12, '2016-01-25 12:57:31', NULL, 'test54654', 'test@test.com', 'pouet                                    ', '', '', ''),
(13, '2016-01-25 12:58:32', NULL, 'test', 'test@test.com', 'pouet                                    ', '', '', ''),
(14, '2016-01-25 13:13:08', NULL, 'sddsad', 'zdadd@sddf.com', '                              dqsdsqsd                                          ', '', '', ''),
(15, '2016-01-25 13:14:06', NULL, 'sddsad54654654', 'zdadd@sddf.com', '                              dqsdsqsd                                          ', '', '', ''),
(16, '2016-01-25 13:14:38', NULL, 'sddsad', 'zdadd@sddf.com', '                              dqsdsqsd                                          ', '', '', ''),
(17, '2016-01-25 13:14:59', NULL, 'sddsaddsf', 'zdadd@sddf.com', '                              dqsdsqsd                                          ', '', '', ''),
(18, '2016-01-25 13:16:48', NULL, 'sddsad', 'zdadd@sddf.com', '                              dqsdsqsd                                          ', '', '', ''),
(19, '2016-02-01 16:54:13', NULL, 'hop', 'gop@gog.com', 'dsefsdfsdf', '', '', ''),
(20, '2016-02-11 16:08:47', NULL, '', '', 'hohoho', '', '', ''),
(21, '2016-02-11 16:47:09', NULL, '', '', 'dede', 'C:\\wamp\\www\\09c - $_FILES et le resize d''image/uploads/', '', ''),
(22, '2016-02-11 16:47:35', NULL, '', '', 'dede', 'C:\\wamp\\www\\09c - $_FILES et le resize d''image/uploads/248415b18d6bcc02b093157aeac88b86.jpg', '', ''),
(23, '2016-02-11 16:47:51', NULL, '', '', 'dede', 'C:\\wamp\\www\\09c - $_FILES et le resize d''image/uploads/248415b18d6bcc02b093157aeac88b86.jpg', '.jpeg', ''),
(24, '2016-02-11 16:48:16', NULL, '', '', 'dede', 'C:\\wamp\\www\\09c - $_FILES et le resize d''image/uploads/248415b18d6bcc02b093157aeac88b86.jpg', '248415b18d6bcc02b093157aeac88b86.jpeg', ''),
(25, '2016-02-11 16:50:36', NULL, '', '', 'dede', '248415b18d6bcc02b093157aeac88b86.jpg', '248415b18d6bcc02b093157aeac88b86.jpeg', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
