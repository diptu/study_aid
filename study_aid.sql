-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 11:07 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `study_aid`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `correct_ans` varchar(50) NOT NULL,
  `question_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`correct_ans`, `question_id`) VALUES
('etN85cYrpV0w', '22VL67PcA85O'),
('wjOxFrOzrWTN', 'sZZROmEyOz1H');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat-id` int(9) NOT NULL,
  `user_name` int(32) NOT NULL,
  `text` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `attachment` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `cid` int(11) NOT NULL,
  `owner` varchar(32) NOT NULL,
  `cname` varchar(32) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `access_key` varchar(32) NOT NULL,
  `semester` enum('Spring','Summer','Fall') NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`cid`, `owner`, `cname`, `about`, `access_key`, `semester`, `year`) VALUES
(1, 'mek', '299', 'junior design', 'w1MQiKOAjcFH', 'Fall', 2017),
(2, 'mek', '299.2', 'ju section 2', 'FGHIPU26KQmf', 'Fall', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(9) NOT NULL,
  `text` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `user_name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `text`, `pid`, `created_date`, `user_name`) VALUES
(1, 'reply 1st', 7, '2017-11-13', 'shadhin');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_student`
--

CREATE TABLE `enrolled_student` (
  `cid` int(9) NOT NULL,
  `user_name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolled_student`
--

INSERT INTO `enrolled_student` (`cid`, `user_name`) VALUES
(1, 'shadhin'),
(2, 'shadhin');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `user_name` varchar(32) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_name` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_type` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_name`, `password`, `user_type`) VALUES
('shadhin', '123', 'student'),
('mek', 'mek', 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` varchar(50) NOT NULL,
  `question_id` varchar(50) NOT NULL,
  `option_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `option_text`) VALUES
('bP2quddLLOxd', '22VL67PcA85O', 'aa'),
('etN85cYrpV0w', '22VL67PcA85O', 'cc'),
('jIJPMzgER3Tz', 'sZZROmEyOz1H', 'd'),
('v0nZzH3ug8db', 'sZZROmEyOz1H', 'b'),
('V2f8TgH2Lijy', '22VL67PcA85O', 'bb'),
('vRHlbhctqE6Y', '22VL67PcA85O', 'dd'),
('W0DYoJIxA7Rx', 'sZZROmEyOz1H', 'c'),
('wjOxFrOzrWTN', 'sZZROmEyOz1H', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `pid` int(9) NOT NULL,
  `text` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `cid` int(9) NOT NULL,
  `user_name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pid`, `text`, `created_date`, `attachment`, `cid`, `user_name`) VALUES
(1, 'hello', '2017-11-07', '', 1, 'shadhin'),
(2, 'hello nolo', '2017-11-07', '', 1, 'shadhin'),
(3, 'ajsd ajsd', '2017-11-07', '', 1, 'shadhin'),
(4, 'asdf', '2017-11-07', '', 1, 'shadhin'),
(5, 'hello studs\r\n', '2017-11-07', '', 1, 'mek'),
(6, 'hello studs 2', '2017-11-07', '', 2, 'mek'),
(7, 'hello 1st', '2017-11-13', '', 2, 'shadhin');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` varchar(50) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  `ques_text` text NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `quiz_id`, `ques_text`, `sn`) VALUES
('22VL67PcA85O', 'QZuCD2xKxESN', 'what is cc?', 2),
('sZZROmEyOz1H', 'QZuCD2xKxESN', 'what is a?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `each_ques_mark` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `duration` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `title`, `each_ques_mark`, `total`, `duration`, `date`, `class_id`) VALUES
('QZuCD2xKxESN', 'quiz1', 10, 2, 2, '2017-11-13 16:43:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `user_name` varchar(32) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_name` varchar(32) NOT NULL,
  `full_name` varchar(32) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `mobile_number` varchar(32) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `full_name`, `profile_pic`, `email`, `gender`, `birthday`, `mobile_number`, `address`) VALUES
('shadhin', 'MD. Shakil Khan Shadhin', 'pic.jpg', '@example.com', 'M', '2095-12-16', '+88017', 'Moakhali,Dhaka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`correct_ans`,`question_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat-id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`owner`,`cname`,`semester`,`year`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_name`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat-id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `pid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
