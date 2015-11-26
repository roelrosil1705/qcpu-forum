-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2015 at 11:00 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `isisqcpu-forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessaccounts`
--

CREATE TABLE IF NOT EXISTS `accessaccounts` (
  `acc_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passsword` varchar(50) NOT NULL,
  `access_type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accessaccounts`
--

INSERT INTO `accessaccounts` (`acc_id`, `username`, `passsword`, `access_type`) VALUES
(1, 'registrar', 'registrar', 'Registrar'),
(2, 'qcpumis', 'qcpumis', 'MIS');

-- --------------------------------------------------------

--
-- Table structure for table `accounting`
--

CREATE TABLE IF NOT EXISTS `accounting` (
  `id` int(11) NOT NULL,
  `stud_num` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `date_payment` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting`
--

INSERT INTO `accounting` (`id`, `stud_num`, `payment`, `date_payment`) VALUES
(1, '12-2351', '2758.00', '12-23-14'),
(2, '12-2351', '2200.70', '8-16-14');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `stud_id` int(11) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `account_type` text NOT NULL,
  `password` text NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `birthdate` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `brgy` text NOT NULL,
  `province` text NOT NULL,
  `phone_number` text,
  `religion` varchar(50) NOT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `mother_occupation` varchar(50) DEFAULT NULL,
  `mother_education` varchar(50) DEFAULT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `father_occupation` varchar(50) DEFAULT NULL,
  `father_education` varchar(50) DEFAULT NULL,
  `primary_education` varchar(50) NOT NULL,
  `year_graduated` varchar(50) DEFAULT NULL,
  `primary_honors` varchar(50) DEFAULT NULL,
  `secondary_education` varchar(50) NOT NULL,
  `year_graduatedsec` varchar(50) DEFAULT NULL,
  `secondary_honors` varchar(50) DEFAULT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`stud_id`, `account_no`, `account_type`, `password`, `lastname`, `firstname`, `middlename`, `birthdate`, `gender`, `street`, `brgy`, `province`, `phone_number`, `religion`, `mother_name`, `mother_occupation`, `mother_education`, `father_name`, `father_occupation`, `father_education`, `primary_education`, `year_graduated`, `primary_honors`, `secondary_education`, `year_graduatedsec`, `secondary_honors`, `date_registered`) VALUES
(1, '12-2351', 'student', '638190bf025179ecebcc1b3d019a0230', 'Garma', 'Erwin', 'Bernal', 'Monday, July 05, 1993', 'Male', '615 Int C', 'BagBag', 'Novaliches, Quezon City', '09194958585', 'Catholic', 'Brenda Garma', 'OFW', 'College Graduate', 'Edgar Garma', 'Soldier', 'College Graduate', 'Dingras FaithAcademy, Inc', '2004', 'none', 'DNHS', '2008', 'none', '0000-00-00 00:00:00'),
(2, '45-6513', 'admin', '7371713832ca5a0bb0e2a6f676869246', 'Roel', 'Rosil', 'Nanar', 'April 5, 1991', 'Male', '2 Martirez St', 'Gulod', 'Novaliches, Quezon CIty', '09464187000', 'Roman Catholic', 'Letty Rosil', 'House Wife', 'Cosmetology', 'Rogelio Rosil', 'OFW', 'Machinery', 'Software Developement', '2014', 'Sumusumakumlaude', 'Hardware Developement', '2014', 'Kumukumlaude', '2015-11-24 22:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `announce_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` varchar(500) NOT NULL,
  `datePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announce_id`, `title`, `body`, `datePosted`) VALUES
(1, 'Last Day of Dropping - August 3, 2015', 'Last Day of Dropping - August 3, 2015', '2015-10-22 15:46:36'),
(2, 'October 23, 2015', 'Happy Birthday', '2015-10-22 16:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `forum-admin`
--

CREATE TABLE IF NOT EXISTS `forum-admin` (
  `admin_id` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `admin_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum-admin`
--

INSERT INTO `forum-admin` (`admin_id`, `user`, `pass`, `admin_name`) VALUES
(1, 'admin', '85c1691d7d7d1719b77d832c313e5379', 'admin_name');

-- --------------------------------------------------------

--
-- Table structure for table `forum-contents`
--

CREATE TABLE IF NOT EXISTS `forum-contents` (
  `content_id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `admin_id` text NOT NULL,
  `content_title` text NOT NULL,
  `last_post` text,
  `threads` int(11) NOT NULL,
  `posts` int(11) NOT NULL,
  `date_created` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum-contents`
--

INSERT INTO `forum-contents` (`content_id`, `discussion_id`, `admin_id`, `content_title`, `last_post`, `threads`, `posts`, `date_created`) VALUES
(1, 2, '45-6513', 'I declare food bonanza', '', 0, 0, '11-24-2015 15:58:41'),
(2, 1, '45-6513', 'Gallery', '11-26-2015  08:43:40 by Rosil Roel', 13, 0, '11-24-2015 16:00:49'),
(3, 3, '45-6513', 'Like this page', '', 0, 0, '11-24-2015 16:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `forum-discussion`
--

CREATE TABLE IF NOT EXISTS `forum-discussion` (
  `discussion_id` int(11) NOT NULL,
  `date_created` text NOT NULL,
  `admin_id` text NOT NULL,
  `discussion_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum-discussion`
--

INSERT INTO `forum-discussion` (`discussion_id`, `date_created`, `admin_id`, `discussion_name`) VALUES
(1, '11-24-2015  15:51:43', '45-6513', 'Home'),
(2, '11-24-2015  15:52:15', '45-6513', 'Announcements'),
(3, '11-24-2015  15:58:05', '45-6513', 'Comments'),
(4, '11-24-2015  16:00:27', '45-6513', 'Suggestions');

-- --------------------------------------------------------

--
-- Table structure for table `forum-replies`
--

CREATE TABLE IF NOT EXISTS `forum-replies` (
  `reply_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `account_no` text NOT NULL,
  `message` text NOT NULL,
  `date_created` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum-replies`
--

INSERT INTO `forum-replies` (`reply_id`, `thread_id`, `account_no`, `message`, `date_created`) VALUES
(1, 13, '12-2351', 'test', '0000-00-00 00:00:00'),
(2, 13, '12-2351', 'test1', '0000-00-00 00:00:00'),
(3, 13, '12-2351', '', '0000-00-00 00:00:00'),
(4, 13, '12-2351', 'adsad', '0000-00-00 00:00:00'),
(5, 13, '12-2351', 'what', '11-26-2015 10:35:59'),
(6, 13, '12-2351', 'fdfdg', '11-26-2015 10:36:09'),
(7, 13, '12-2351', 'fghfghfg', '11-26-2015 10:40:12'),
(8, 13, '12-2351', 'dfgfdgfdg', '11-26-2015 10:46:53'),
(9, 13, '12-2351', 'hfghgfh', '11-26-2015 10:47:13'),
(10, 13, '12-2351', 'khjk', '11-26-2015 10:48:20'),
(11, 13, '12-2351', 'fghfghf', '11-26-2015 10:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `forum-threads`
--

CREATE TABLE IF NOT EXISTS `forum-threads` (
  `thread_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `stud_id` text,
  `admin_id` text,
  `sticky` int(11) NOT NULL,
  `thread` text NOT NULL,
  `message` text NOT NULL,
  `last_post` text,
  `views` int(11) NOT NULL,
  `no_of_replies` int(11) NOT NULL DEFAULT '0',
  `date_created` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum-threads`
--

INSERT INTO `forum-threads` (`thread_id`, `content_id`, `stud_id`, `admin_id`, `sticky`, `thread`, `message`, `last_post`, `views`, `no_of_replies`, `date_created`) VALUES
(1, 2, '0', '45-6513', 1, 'Sala Set', 'message', '11-24-2015  16:01:46 by Rosil Roel', 1, 0, '11-24-2015 16:01:46'),
(2, 2, '0', '45-6513', 1, 'Class', '1234', '11-25-2015  09:09:49 by Rosil Roel', 1, 0, '11-25-2015 09:09:49'),
(3, 2, '0', '45-6513', 1, 'sadsfdsf', 'sdfdsfsf', '11-26-2015  08:00:18 by Rosil Roel', 1, 0, '11-26-2015 08:00:18'),
(4, 2, '0', '45-6513', 1, 'hfgh', 'fgh', '11-26-2015  08:01:24 by Rosil Roel', 1, 0, '11-26-2015 08:01:24'),
(5, 2, '0', '45-6513', 1, 'frasd', 'xcvcv', '11-26-2015  08:02:10 by Rosil Roel', 1, 0, '11-26-2015 08:02:10'),
(6, 2, '0', '45-6513', 1, 'Ayun', 'Tugtog', '11-26-2015  08:23:59 by Rosil Roel', 1, 0, '11-26-2015 08:23:59'),
(7, 2, '0', '45-6513', 1, 'Ayun', 'Tugtog', '11-26-2015  08:23:59 by Rosil Roel', 1, 0, '11-26-2015 08:23:59'),
(8, 2, '0', '45-6513', 1, 'asdadfgh', 'ghjhgjh', '11-26-2015  08:25:58 by Rosil Roel', 1, 0, '11-26-2015 08:25:58'),
(9, 2, '0', '45-6513', 1, 'gffg', 'hgjhh', '11-26-2015  08:34:40 by Rosil Roel', 1, 0, '11-26-2015 08:34:40'),
(10, 2, '0', '45-6513', 1, 'hgfhhmbnm', 'nbmbnmbnmbnm', '11-26-2015  08:35:28 by Rosil Roel', 2, 0, '11-26-2015 08:35:28'),
(11, 2, '0', '45-6513', 1, 'hgfhhmbnm', 'nbmbnmbnmbnm', '11-26-2015  08:35:28 by Rosil Roel', 2, 0, '11-26-2015 08:35:28'),
(12, 2, '0', '45-6513', 1, 'vbnbvn', 'fghgfhf', '11-26-2015  08:36:00 by Rosil Roel', 7, 0, '11-26-2015 08:36:00'),
(13, 2, '0', '45-6513', 1, 'fghfghfghfghfgh', 'bnmbnmbmbnbmb', '11-26-2015  08:43:40 by Rosil Roel', 65, 10, '11-26-2015 08:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `preenlist`
--

CREATE TABLE IF NOT EXISTS `preenlist` (
  `preenlist_id` int(11) NOT NULL,
  `preenlist_num` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `reg_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(11) NOT NULL,
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room`) VALUES
(1, 'IC101'),
(2, 'IC102'),
(3, 'IC103');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `sched_id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_description` varchar(50) NOT NULL,
  `units` int(11) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `section_id` int(11) NOT NULL,
  `section` varchar(50) DEFAULT NULL,
  `year_level` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section`, `year_level`) VALUES
(1, '11A', 'Grade 11'),
(2, '11B', 'Grade 11'),
(3, '12A', 'Grade 12'),
(4, '12B', 'Grade 12');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_description` varchar(50) NOT NULL,
  `units` int(11) NOT NULL,
  `year_level` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_code`, `subject_description`, `units`, `year_level`) VALUES
(1, 'SCI011', 'Chemistry', 2, 'Grade 11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessaccounts`
--
ALTER TABLE `accessaccounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announce_id`);

--
-- Indexes for table `forum-admin`
--
ALTER TABLE `forum-admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `forum-contents`
--
ALTER TABLE `forum-contents`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `forum-discussion`
--
ALTER TABLE `forum-discussion`
  ADD PRIMARY KEY (`discussion_id`);

--
-- Indexes for table `forum-replies`
--
ALTER TABLE `forum-replies`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `forum-threads`
--
ALTER TABLE `forum-threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `preenlist`
--
ALTER TABLE `preenlist`
  ADD PRIMARY KEY (`preenlist_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessaccounts`
--
ALTER TABLE `accessaccounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `accounting`
--
ALTER TABLE `accounting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announce_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `forum-admin`
--
ALTER TABLE `forum-admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `forum-contents`
--
ALTER TABLE `forum-contents`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `forum-discussion`
--
ALTER TABLE `forum-discussion`
  MODIFY `discussion_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `forum-replies`
--
ALTER TABLE `forum-replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `forum-threads`
--
ALTER TABLE `forum-threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `preenlist`
--
ALTER TABLE `preenlist`
  MODIFY `preenlist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
