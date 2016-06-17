-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jun 17, 2016 at 09:05 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `communication_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversation_tb`
--

CREATE TABLE `conversation_tb` (
  `conversation_id` int(11) NOT NULL,
  `conversation_title` text NOT NULL,
  `conversation_trigger` int(11) NOT NULL,
  `conversation_priority` int(11) NOT NULL,
  `conversation_sharp` int(11) NOT NULL,
  `conversation_speed` int(11) NOT NULL,
  `conversation_dialogFile` longtext NOT NULL,
  `conversation_client` int(11) NOT NULL,
  `conversation_dis` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation_tb`
--

INSERT INTO `conversation_tb` (`conversation_id`, `conversation_title`, `conversation_trigger`, `conversation_priority`, `conversation_sharp`, `conversation_speed`, `conversation_dialogFile`, `conversation_client`, `conversation_dis`) VALUES
(1, 'A New Conversation', 1, 1, 135, 110, '', 4, 1),
(2, 'A New Conversation', 1, 1, 135, 110, '', 4, 1),
(3, 'A New Conversation', 1, 1, 135, 110, '', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_tb`
--

CREATE TABLE `group_tb` (
  `group_id` int(11) NOT NULL,
  `group_pepperTalkParent` int(11) NOT NULL,
  `group_dis` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_tb`
--

INSERT INTO `group_tb` (`group_id`, `group_pepperTalkParent`, `group_dis`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 4, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pepperTalk_tb`
--

CREATE TABLE `pepperTalk_tb` (
  `pepperTalk_id` int(11) NOT NULL,
  `pepperTalk_group` int(11) NOT NULL,
  `pepperTalk_conversation` int(11) NOT NULL,
  `pepperTalk_text` text NOT NULL,
  `pepperTalk_output` int(11) DEFAULT NULL,
  `pepperTalk_dis` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pepperTalk_tb`
--

INSERT INTO `pepperTalk_tb` (`pepperTalk_id`, `pepperTalk_group`, `pepperTalk_conversation`, `pepperTalk_text`, `pepperTalk_output`, `pepperTalk_dis`) VALUES
(1, 0, 1, 'Hi do you have a question?', NULL, 1),
(2, 1, 1, 'I like football', NULL, 1),
(3, 2, 1, 'I''m from the UK', NULL, 1),
(4, 0, 2, 'Hi do you have a question?', NULL, 1),
(5, 3, 2, 'I like football', NULL, 1),
(6, 4, 2, 'I''m from the UK', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting_tb`
--

CREATE TABLE `setting_tb` (
  `setting_id` int(11) NOT NULL,
  `setting_choose` text NOT NULL,
  `setting_dis` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trigger_tb`
--

CREATE TABLE `trigger_tb` (
  `trigger_id` int(11) NOT NULL,
  `trigger_name` text NOT NULL,
  `trigger_dis` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trigger_tb`
--

INSERT INTO `trigger_tb` (`trigger_id`, `trigger_name`, `trigger_dis`) VALUES
(1, 'Detect human', 1),
(2, 'Touch hand', 1),
(3, 'Touch head', 1),
(4, 'Talk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userReply_tb`
--

CREATE TABLE `userReply_tb` (
  `userReply_id` int(11) NOT NULL,
  `userReply_group` int(11) NOT NULL,
  `userReply_answer` text NOT NULL,
  `userReply_dis` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userReply_tb`
--

INSERT INTO `userReply_tb` (`userReply_id`, `userReply_group`, `userReply_answer`, `userReply_dis`) VALUES
(1, 1, 'Do you like sports?', 1),
(2, 1, 'What sports do you like?', 1),
(3, 2, 'Where are you from?', 1),
(4, 3, 'Do you like sports?', 1),
(5, 3, 'What sports do you like?', 1),
(6, 4, 'Where are you from?', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversation_tb`
--
ALTER TABLE `conversation_tb`
  ADD PRIMARY KEY (`conversation_id`),
  ADD KEY `conversation_trigger` (`conversation_trigger`);

--
-- Indexes for table `group_tb`
--
ALTER TABLE `group_tb`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_pepperTalkParent` (`group_pepperTalkParent`);

--
-- Indexes for table `pepperTalk_tb`
--
ALTER TABLE `pepperTalk_tb`
  ADD PRIMARY KEY (`pepperTalk_id`),
  ADD KEY `pepperTalk_group` (`pepperTalk_group`),
  ADD KEY `pepperTalk_conversation` (`pepperTalk_conversation`);

--
-- Indexes for table `setting_tb`
--
ALTER TABLE `setting_tb`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `trigger_tb`
--
ALTER TABLE `trigger_tb`
  ADD PRIMARY KEY (`trigger_id`);

--
-- Indexes for table `userReply_tb`
--
ALTER TABLE `userReply_tb`
  ADD PRIMARY KEY (`userReply_id`),
  ADD KEY `userReply_group` (`userReply_group`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversation_tb`
--
ALTER TABLE `conversation_tb`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `group_tb`
--
ALTER TABLE `group_tb`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pepperTalk_tb`
--
ALTER TABLE `pepperTalk_tb`
  MODIFY `pepperTalk_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `setting_tb`
--
ALTER TABLE `setting_tb`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trigger_tb`
--
ALTER TABLE `trigger_tb`
  MODIFY `trigger_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userReply_tb`
--
ALTER TABLE `userReply_tb`
  MODIFY `userReply_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversation_tb`
--
ALTER TABLE `conversation_tb`
  ADD CONSTRAINT `conversation_trigger` FOREIGN KEY (`conversation_trigger`) REFERENCES `trigger_tb` (`trigger_id`);

--
-- Constraints for table `group_tb`
--
ALTER TABLE `group_tb`
  ADD CONSTRAINT `group_pepperTalkParent` FOREIGN KEY (`group_pepperTalkParent`) REFERENCES `pepperTalk_tb` (`pepperTalk_id`);

--
-- Constraints for table `pepperTalk_tb`
--
ALTER TABLE `pepperTalk_tb`
  ADD CONSTRAINT `pepperTalk_conversation` FOREIGN KEY (`pepperTalk_conversation`) REFERENCES `conversation_tb` (`conversation_id`);

--
-- Constraints for table `userReply_tb`
--
ALTER TABLE `userReply_tb`
  ADD CONSTRAINT `userReply_group` FOREIGN KEY (`userReply_group`) REFERENCES `group_tb` (`group_id`);
