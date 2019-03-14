-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2019 at 03:45 PM
-- Server version: 5.5.58-0+deb7u1-log
-- PHP Version: 5.6.31-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `unn_w16030457`
--

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_activity`
--

CREATE TABLE IF NOT EXISTS `timesheets_activity` (
`activity_id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_activity`
--

INSERT INTO `timesheets_activity` (`activity_id`, `type`) VALUES
(5, 'Absent'),
(3, 'Holiday'),
(1, 'Normal'),
(4, 'Overtime'),
(2, 'Sick');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_contact`
--

CREATE TABLE IF NOT EXISTS `timesheets_contact` (
`contact_id` int(11) NOT NULL,
  `contact_name` text NOT NULL,
  `contact_email` text NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `contact_message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timesheets_contact`
--

INSERT INTO `timesheets_contact` (`contact_id`, `contact_name`, `contact_email`, `contact_number`, `contact_message`) VALUES
(4, 'Some Guy', 'someguy@email.com', '07745678945', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_department`
--

CREATE TABLE IF NOT EXISTS `timesheets_department` (
`department_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_department`
--

INSERT INTO `timesheets_department` (`department_id`, `name`) VALUES
(1, 'Finance'),
(2, 'Human Resource'),
(5, 'IT Services'),
(4, 'Research & Development'),
(3, 'Sales & Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_job`
--

CREATE TABLE IF NOT EXISTS `timesheets_job` (
`job_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_job`
--

INSERT INTO `timesheets_job` (`job_id`, `department_id`, `title`) VALUES
(1, 4, 'Software Engineer'),
(2, 4, 'Senior Software Engineer'),
(3, 4, 'Apprentice Software Engineer'),
(5, 4, 'Software Architect'),
(6, 4, 'UX Designer'),
(7, 1, 'Accountant'),
(8, 1, 'Financial Analyst'),
(9, 1, 'Assistant Accountant'),
(10, 2, 'HR Administrator'),
(11, 2, 'HR Advisor'),
(12, 3, 'Sales Consutant '),
(13, 3, 'Bid Co-ordinator'),
(14, 3, 'Sales Advisor'),
(15, 5, 'IT Support First Line '),
(16, 5, 'IT Support Second Line'),
(17, 5, 'IT Support Technician');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_person`
--

CREATE TABLE IF NOT EXISTS `timesheets_person` (
`person_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `contracted_hours` float NOT NULL,
  `title` varchar(4) COLLATE utf8_bin NOT NULL,
  `forename` varchar(50) COLLATE utf8_bin NOT NULL,
  `surname` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone_number` int(15) NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `address_line_1` varchar(50) COLLATE utf8_bin NOT NULL,
  `address_line_2` varchar(50) COLLATE utf8_bin NOT NULL,
  `address_line_3` varchar(50) COLLATE utf8_bin NOT NULL,
  `address_line_4` varchar(50) COLLATE utf8_bin NOT NULL,
  `address_line_5` varchar(50) COLLATE utf8_bin NOT NULL,
  `post_code` varchar(8) COLLATE utf8_bin NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_person`
--

INSERT INTO `timesheets_person` (`person_id`, `user_id`, `job_id`, `team_id`, `department_id`, `contracted_hours`, `title`, `forename`, `surname`, `phone_number`, `email`, `address_line_1`, `address_line_2`, `address_line_3`, `address_line_4`, `address_line_5`, `post_code`, `date_of_birth`) VALUES
(1, 1, 6, 5, 4, 37.5, 'Dr', 'Mara', 'Jerrom', 533, 'mjerrom0@printfriendly.com', '51', 'The Green', 'WESTERN CENTRAL LONDON', '', '', 'WC85 9TH', '1964-08-17'),
(2, 2, 2, 6, 4, 40, 'Rev', 'Abner', 'Souley', 307, 'asouley1@g.co', '88', 'Chester Road', 'KILMARNOCK', '', '', 'KA2 7CH', '1957-03-05'),
(3, 3, 4, 6, 4, 37.5, 'Ms', 'Sibella', 'Apfel', 584, 'sapfel2@histats.com', '619', 'London Road', 'SOUTHEND-ON-SEA ', '', '', 'SS45 9MN', '1994-08-11'),
(4, 4, 1, 5, 4, 40, 'Ms', 'Tyson', 'de Cullip', 362, 'tdecullip3@51.la', '861', 'North Road', 'CARDIFF', '', '', 'CF39 1PQ', '1962-08-17'),
(5, 5, 5, 7, 4, 37.5, 'Mr', 'Mae', 'Pikett', 729, 'mpikett4@youtube.com', '987', 'North Street', 'ILFORD', '', '', 'IG86 0BY', '1955-03-26'),
(6, 6, 2, 6, 4, 35, 'Ms', 'Katuscha', 'Kment', 214, 'kkment5@tumblr.com', '8601', 'The Grove', 'WARRINGTON', '', '', 'WA42 0PK', '1981-10-05'),
(7, 7, 2, 5, 4, 35, 'Ms', 'Valaria', 'Biasini', 985, 'vbiasini6@google.co.jp', '720', 'Windsor Road', 'EAST CENTRAL LONDON', '', '', 'EC52 2LZ', '1975-09-24'),
(8, 8, 3, 7, 4, 35, 'Mrs', 'Kathie', 'Silman', 124, 'ksilman7@census.gov', '26', 'George Street', 'SHEFFIELD', '', '', 'S34 0SO', '1975-12-28'),
(9, 9, 3, 7, 4, 40, 'Mr', 'Briant', 'Conneau', 661, 'bconneau8@altervista.org', '933', 'Manchester Road', 'WAKEFIELD', '', '', 'WF90 4IK', '1975-02-03'),
(10, 10, 3, 7, 4, 35, 'Dr', 'Madelina', 'Loomis', 263, 'mloomis9@furl.net', '517', 'Station Road', 'ROCHESTER', '', '', 'ME67 3TN', '1962-10-01'),
(11, 11, 5, 6, 4, 40, 'Mrs', 'Clemmy', 'Kurtis', 668, 'ckurtisa@disqus.com', '8665', 'Green Lane', 'DURHAM', '', '', 'DH29 9DB', '1999-07-26'),
(12, 12, 2, 5, 4, 35, 'Dr', 'Bryn', 'Sandifer', 571, 'bsandiferb@devhub.com', '7992', 'The Avenue', 'LEICESTER', '', '', 'LE28 7WX', '1981-03-18'),
(13, 13, 4, 5, 4, 35, 'Dr', 'Gracie', 'Swanson', 318, 'gswansonc@google.com.au', '77', 'St. John’s Road', 'SWANSEA', '', '', 'SA28 8EA', '1969-01-08'),
(14, 14, 2, 5, 4, 35, 'Ms', 'Wildon', 'Wickling', 595, 'wwicklingd@soup.io', '517', 'Station Road', 'ROCHESTER', '', '', 'ME67 3TN', '1993-01-14'),
(15, 15, 4, 7, 4, 40, 'Mr', 'Gardie', 'Dudney', 525, 'gdudneye@gnu.org', '7133', 'Queensway', 'LINCOLN', '', '', 'LN11 3DV', '1990-03-11'),
(16, 16, 2, 5, 4, 40, 'Mr', 'Mariana', 'Tooth', 162, 'mtoothf@unicef.org', '88', 'London Road', 'DUNDEE', '', '', 'DD87 0SE', '1984-06-29'),
(17, 17, 9, 1, 1, 35, 'Rev', 'Eulalie', 'Killick', 126, 'ekillick0@tmall.com', '8796', 'George Street', 'NEWPORT', '', '', 'NP92 0MA', '1955-07-19'),
(18, 18, 8, 1, 1, 37.5, 'Mr', 'Elysha', 'Ricarde', 593, 'ericarde1@accuweather.com', '7557', 'St. John’s Road', 'BRISTOL', '', '', 'BS95 3QV', '1999-12-25'),
(19, 19, 9, 1, 1, 35, 'Mr', 'Frederik', 'Gehrts', 682, 'fgehrts2@bing.com', '9602', 'Alexander Road', 'KILMARNOCK', '', '', 'KA69 6EX', '1983-12-22'),
(20, 20, 7, 1, 1, 35, 'Dr', 'Cecil', 'Rounsefull', 467, 'crounsefull3@hexun.com', '2', 'Manchester Road', 'SOUTHEND-ON-SEA', '', '', 'SS94 4QG', '1994-09-06'),
(21, 21, 7, 1, 1, 35, 'Mr', 'Beitris', 'Olpin', 458, 'bolpin4@cdc.gov', '82', 'West Street', 'CROYDON', '', '', 'CR57 7YB', '1988-02-02'),
(22, 22, 11, 2, 2, 37.5, 'Ms', 'Staci', 'Clapton', 762, 'sclapton0@hexun.com', '743', 'Highfield Road', 'WATFORD', '', '', 'WD72 2TL', '1963-01-30'),
(23, 23, 10, 2, 2, 35, 'Ms', 'Gerek', 'Posselt', 201, 'gposselt1@com.com', '8549', 'West Street', 'OXFORD', '', '', 'OX98 1NX', '1997-03-13'),
(24, 24, 11, 2, 2, 37.5, 'Ms', 'Gardy', 'Bowmer', 894, 'gbowmer2@facebook.com', '6', 'Main Street', 'HEMEL HEMPSTEAD', '', '', 'HP79 8EJ', '1955-06-24'),
(25, 25, 13, 3, 3, 37.5, 'Mr', 'Shara', 'Pechan', 412, 'spechan0@nydailynews.com', '8145', 'Park Road', 'PLYMOUTH', '', '', 'PL60 6YA', '1962-02-22'),
(26, 26, 12, 4, 3, 37.5, 'Mrs', 'Frants', 'Fleeman', 934, 'ffleeman1@java.com', '694', 'Windsor Road', 'CLEVELAND', '', '', 'TS21 0CQ', '1961-07-26'),
(27, 27, 12, 4, 3, 35, 'Mrs', 'Sanson', 'Kemmons', 127, 'skemmons2@imdb.com', '409', 'Victoria Road', 'SLOUGH', '', '', 'SL91 9GU', '1960-12-08'),
(28, 28, 13, 4, 3, 35, 'Ms', 'Zedekiah', 'Drage', 259, 'zdrage3@moonfruit.com', '8934', 'St. John’s Road', 'CAMBRIDGE', '', '', 'CB56 1MO', '1974-12-22'),
(29, 29, 12, 4, 3, 35, 'Ms', 'August', 'Comello', 783, 'acomello4@sina.com.cn', '52', 'Park Avenue', 'ROCHESTER', '', '', 'ME24 8QO', '1972-03-11'),
(30, 30, 14, 3, 3, 37.5, 'Mr', 'Conny', 'Leneham', 823, 'cleneham5@pbs.org', '239', 'Church Road', 'SALISBURY', '', '', 'SP72 4BK', '1997-01-20'),
(31, 31, 15, 8, 5, 40, 'Mr', 'Guy', 'Giddons', 872, 'ggiddons0@feedburner.com', '637', 'Chester Road', 'NORWICH', '', '', 'NR84 2OV', '1994-05-03'),
(32, 32, 15, 8, 5, 40, 'Mr', 'Whitman', 'Grindlay', 131, 'wgrindlay1@ehow.com', '39', 'Queensway', 'ILFORD', '', '', 'IG30 4UO', '1966-02-07'),
(33, 33, 17, 8, 5, 35, 'Dr', 'Nani', 'Trustie', 567, 'ntrustie2@alexa.com', '8428', 'The Drive', 'CHELMSFORD', '', '', 'CM51 0JE', '1977-09-11'),
(34, 34, 15, 8, 5, 35, 'Ms', 'Mordy', 'Backshell', 656, 'mbackshell3@phoca.cz', '681', 'Kingsway', 'BRADFORD', '', '', 'BD48 2MZ', '1997-12-23'),
(35, 35, 16, 8, 5, 37.5, 'Mr', 'Geoff', 'Greenroad', 152, 'ggreenroad4@icq.com', '819', 'Manchester Road', 'SOUTHAMPTON', '', '', 'SO42 0IF', '1969-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_project`
--

CREATE TABLE IF NOT EXISTS `timesheets_project` (
`project_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_project`
--

INSERT INTO `timesheets_project` (`project_id`, `name`) VALUES
(2, 'Biodex'),
(5, 'Cookley'),
(1, 'Kanlam'),
(3, 'Sonsing'),
(4, 'Vagram');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_role`
--

CREATE TABLE IF NOT EXISTS `timesheets_role` (
`role_id` int(11) NOT NULL,
  `role_type` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_role`
--

INSERT INTO `timesheets_role` (`role_id`, `role_type`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_team`
--

CREATE TABLE IF NOT EXISTS `timesheets_team` (
`team_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_team`
--

INSERT INTO `timesheets_team` (`team_id`, `department_id`, `name`) VALUES
(1, 1, 'Accounts'),
(2, 2, 'Human Resources'),
(3, 3, 'New Customers'),
(4, 3, 'Customer Retention'),
(5, 4, 'Moblie'),
(6, 4, 'New Technologies'),
(7, 4, 'Legacy '),
(8, 5, 'IT Services');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_timesheet`
--

CREATE TABLE IF NOT EXISTS `timesheets_timesheet` (
`timesheet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `date` date NOT NULL,
  `note` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_timesheet`
--

INSERT INTO `timesheets_timesheet` (`timesheet_id`, `user_id`, `project_id`, `activity_id`, `time_in`, `time_out`, `date`, `note`) VALUES
(1, 1, 5, 1, '08:50:41', '12:19:42', '2019-03-01', 'a odio in hac habitasse platea dictumst maecenas'),
(2, 2, 5, 1, '07:36:58', '12:29:37', '2019-03-01', 'amet lobortis sapien sapien non'),
(3, 3, 5, 1, '07:04:23', '12:09:33', '2019-03-01', 'sapien urna pretium nisl ut'),
(4, 4, 3, 1, '08:53:31', '12:00:48', '2019-03-01', 'et ultrices posuere cubilia curae mauris viverra diam vitae'),
(5, 5, 2, 1, '08:25:47', '12:21:04', '2019-03-01', 'tempus semper est quam pharetra magna ac consequat metus sapien'),
(6, 6, 3, 1, '07:46:00', '12:05:24', '2019-03-01', 'quisque ut erat curabitur gravida nisi at nibh in hac'),
(7, 7, 4, 1, '07:46:07', '12:21:49', '2019-03-01', 'tortor duis mattis egestas metus aenean fermentum donec ut'),
(8, 8, 3, 1, '07:58:08', '12:11:54', '2019-03-01', 'leo maecenas pulvinar lobortis est phasellus'),
(9, 9, 1, 1, '09:14:01', '12:11:22', '2019-03-01', 'quis lectus suspendisse potenti in eleifend quam a odio'),
(10, 10, 5, 2, '07:02:16', '12:28:32', '2019-03-01', 'congue vivamus metus arcu adipiscing molestie hendrerit at'),
(11, 11, 2, 1, '08:05:38', '12:05:01', '2019-03-01', 'sem fusce consequat nulla nisl nunc nisl duis bibendum'),
(12, 12, 5, 5, '07:42:21', '12:20:40', '2019-03-01', 'et ultrices posuere cubilia curae mauris viverra diam vitae'),
(13, 13, 1, 1, '07:20:48', '12:11:30', '2019-03-01', 'non mauris morbi non lectus aliquam sit'),
(14, 14, 3, 1, '09:25:46', '12:23:59', '2019-03-01', 'cursus id turpis integer aliquet massa'),
(15, 15, 5, 1, '07:39:37', '12:12:59', '2019-03-01', 'vestibulum ac est lacinia nisi venenatis tristique'),
(16, 16, 3, 1, '07:27:30', '12:05:23', '2019-03-01', 'ligula pellentesque ultrices phasellus id sapien in sapien'),
(17, 17, 4, 1, '08:48:35', '12:19:31', '2019-03-01', 'potenti cras in purus eu magna vulputate luctus cum sociis'),
(18, 18, 1, 1, '08:25:24', '12:15:31', '2019-03-01', 'non velit nec nisi vulputate nonummy'),
(19, 19, 4, 3, '09:21:35', '12:00:44', '2019-03-01', 'cras pellentesque volutpat dui maecenas tristique est et tempus semper'),
(20, 20, 2, 1, '08:01:45', '12:23:37', '2019-03-01', 'lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi'),
(21, 21, 2, 1, '09:05:21', '12:17:19', '2019-03-01', 'sapien arcu sed augue aliquam'),
(22, 22, 4, 3, '09:00:04', '12:25:18', '2019-03-01', 'at vulputate vitae nisl aenean lectus pellentesque eget nunc'),
(23, 23, 4, 1, '07:19:36', '12:27:34', '2019-03-01', 'rutrum rutrum neque aenean auctor gravida sem'),
(24, 24, 1, 1, '07:32:25', '12:07:37', '2019-03-01', 'quis justo maecenas rhoncus aliquam lacus morbi quis'),
(25, 25, 1, 1, '07:02:58', '12:28:11', '2019-03-01', 'sit amet nunc viverra dapibus'),
(26, 26, 2, 1, '07:08:46', '12:29:03', '2019-03-01', 'pede ullamcorper augue a suscipit nulla'),
(27, 27, 4, 1, '08:19:01', '12:14:51', '2019-03-01', 'vel nisl duis ac nibh fusce lacus'),
(28, 28, 5, 1, '09:23:46', '12:25:53', '2019-03-01', 'vitae quam suspendisse potenti nullam porttitor lacus at turpis donec'),
(29, 29, 4, 5, '07:53:16', '12:27:37', '2019-03-01', 'molestie sed justo pellentesque viverra pede'),
(30, 30, 3, 1, '07:09:14', '12:18:25', '2019-03-01', 'facilisi cras non velit nec nisi vulputate'),
(31, 31, 4, 1, '08:25:56', '12:17:33', '2019-03-01', 'suspendisse ornare consequat lectus in'),
(32, 32, 1, 1, '08:34:10', '12:11:14', '2019-03-01', 'nulla facilisi cras non velit nec nisi'),
(33, 33, 4, 1, '08:07:20', '12:16:17', '2019-03-01', 'ut mauris eget massa tempor convallis nulla neque libero'),
(34, 34, 1, 1, '08:05:42', '12:07:13', '2019-03-01', 'mi in porttitor pede justo eu massa donec dapibus'),
(35, 35, 4, 1, '08:58:53', '12:10:43', '2019-03-01', 'vehicula condimentum curabitur in libero ut massa volutpat convallis'),
(36, 1, 2, 1, '12:55:00', '16:33:00', '2019-03-01', 'orci luctus et ultrices posuere cubilia curae nulla dapibus dolor'),
(37, 2, 1, 1, '13:07:00', '17:02:00', '2019-03-01', 'non pretium quis lectus suspendisse potenti'),
(38, 3, 4, 1, '12:55:00', '15:47:00', '2019-03-01', 'amet sapien dignissim vestibulum vestibulum ante'),
(39, 4, 2, 4, '13:10:00', '17:28:00', '2019-03-01', 'lectus vestibulum quam sapien varius ut blandit non interdum in'),
(40, 5, 5, 1, '13:00:00', '17:05:00', '2019-03-01', 'adipiscing elit proin risus praesent lectus vestibulum'),
(41, 6, 4, 1, '13:05:00', '15:30:00', '2019-03-01', 'viverra pede ac diam cras pellentesque'),
(42, 7, 5, 1, '13:08:00', '17:20:00', '2019-03-01', 'amet consectetuer adipiscing elit proin risus praesent lectus vestibulum quam'),
(43, 8, 1, 1, '13:14:00', '17:23:00', '2019-03-01', 'consequat dui nec nisi volutpat eleifend donec ut'),
(44, 9, 3, 2, '13:27:00', '16:09:00', '2019-03-01', 'praesent blandit nam nulla integer pede justo lacinia eget'),
(45, 10, 5, 1, '13:29:00', '15:35:00', '2019-03-01', 'dapibus dolor vel est donec odio justo sollicitudin ut'),
(46, 11, 3, 1, '13:06:00', '15:32:00', '2019-03-01', 'nisi eu orci mauris lacinia sapien quis libero'),
(47, 12, 2, 1, '13:07:00', '16:15:00', '2019-03-01', 'euismod scelerisque quam turpis adipiscing'),
(48, 13, 3, 1, '13:20:00', '16:22:00', '2019-03-01', 'velit id pretium iaculis diam erat'),
(49, 14, 5, 1, '13:08:00', '16:47:00', '2019-03-01', 'aliquam augue quam sollicitudin vitae consectetuer eget rutrum'),
(50, 15, 1, 1, '13:25:00', '16:11:00', '2019-03-01', 'non mattis pulvinar nulla pede ullamcorper augue a'),
(51, 16, 4, 1, '12:41:00', '16:42:00', '2019-03-01', 'pellentesque quisque porta volutpat erat quisque'),
(52, 17, 2, 4, '12:48:00', '16:40:00', '2019-03-01', 'condimentum neque sapien placerat ante nulla justo aliquam'),
(53, 18, 5, 1, '12:34:00', '16:05:00', '2019-03-01', 'quisque erat eros viverra eget congue eget semper rutrum'),
(54, 19, 3, 1, '12:35:00', '17:06:00', '2019-03-01', 'vivamus tortor duis mattis egestas metus aenean'),
(55, 20, 2, 5, '12:38:00', '15:45:00', '2019-03-01', 'platea dictumst aliquam augue quam'),
(56, 21, 5, 1, '12:34:00', '15:53:00', '2019-03-01', 'penatibus et magnis dis parturient montes nascetur ridiculus mus'),
(57, 22, 5, 1, '12:30:00', '17:22:00', '2019-03-01', 'orci luctus et ultrices posuere cubilia curae'),
(58, 23, 1, 1, '13:02:00', '17:30:00', '2019-03-01', 'quam pede lobortis ligula sit amet eleifend pede libero'),
(59, 24, 1, 1, '13:22:00', '15:39:00', '2019-03-01', 'donec semper sapien a libero nam dui proin leo'),
(60, 25, 1, 1, '13:24:00', '17:28:00', '2019-03-01', 'viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum'),
(61, 26, 2, 1, '13:16:00', '15:42:00', '2019-03-01', 'erat curabitur gravida nisi at'),
(62, 27, 5, 1, '12:35:00', '16:07:00', '2019-03-01', 'eu est congue elementum in hac habitasse platea dictumst morbi'),
(63, 28, 2, 1, '12:40:00', '16:29:00', '2019-03-01', 'parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum'),
(64, 29, 3, 1, '12:35:00', '15:35:00', '2019-03-01', 'justo maecenas rhoncus aliquam lacus morbi quis'),
(65, 30, 2, 1, '12:49:00', '15:38:00', '2019-03-01', 'sed lacus morbi sem mauris laoreet ut rhoncus'),
(66, 31, 5, 1, '12:34:00', '17:18:00', '2019-03-01', 'justo morbi ut odio cras mi pede malesuada'),
(67, 32, 2, 1, '13:03:00', '15:54:00', '2019-03-01', 'et tempus semper est quam pharetra'),
(68, 33, 3, 1, '13:28:00', '15:49:00', '2019-03-01', 'augue aliquam erat volutpat in congue etiam justo'),
(69, 34, 2, 1, '13:02:00', '16:47:00', '2019-03-01', 'molestie lorem quisque ut erat'),
(70, 35, 3, 1, '12:39:00', '17:05:00', '2019-03-01', 'aliquam quis turpis eget elit sodales scelerisque mauris sit amet');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_user`
--

CREATE TABLE IF NOT EXISTS `timesheets_user` (
`user_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `passwordHash` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_user`
--

INSERT INTO `timesheets_user` (`user_id`, `username`, `passwordHash`) VALUES
(1, 'admin', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(2, 'Abner', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(3, 'Sibella', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(4, 'Tyson', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(5, 'Mae', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(6, 'Katuscha', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(7, 'Valaria', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(8, 'Kathie', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(9, 'Briant', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(10, 'Madelina', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(11, 'Clemmy', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(12, 'Bryn', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(13, 'Gracie', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(14, 'Wildon', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(15, 'Gardie', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(16, 'Mariana', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(17, 'Eulalie', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(18, 'Elysha', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(19, 'Frederik', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(20, 'Cecil', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(21, 'Beitris', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(22, 'Staci', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(23, 'Gerek', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(24, 'Gardy', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(25, 'Shara', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(26, 'Frants', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(27, 'Sanson', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(28, 'Zedekiah', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(29, 'August', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(30, 'Conny', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(31, 'Guy', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(32, 'Whitman', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(33, 'Nani', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(34, 'Mordy', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2'),
(35, 'Geoff', '$2y$10$9JBV7e9JB.RhlZDn7eDJ3.z061hHfbOEPURE.JpOYWxOm6A/AnCj2');

-- --------------------------------------------------------

--
-- Table structure for table `timesheets_user_role`
--

CREATE TABLE IF NOT EXISTS `timesheets_user_role` (
`user_role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `timesheets_user_role`
--

INSERT INTO `timesheets_user_role` (`user_role_id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 4, 2),
(6, 5, 2),
(7, 6, 2),
(8, 7, 2),
(9, 8, 2),
(10, 9, 2),
(11, 10, 2),
(12, 11, 2),
(13, 12, 2),
(14, 13, 2),
(15, 14, 2),
(16, 15, 2),
(17, 16, 2),
(18, 17, 2),
(19, 18, 2),
(20, 19, 2),
(21, 20, 2),
(22, 21, 2),
(23, 22, 2),
(24, 23, 2),
(25, 24, 2),
(26, 25, 2),
(27, 26, 2),
(28, 27, 2),
(29, 28, 2),
(30, 29, 2),
(31, 30, 2),
(32, 31, 2),
(33, 32, 2),
(34, 33, 2),
(35, 34, 2),
(36, 35, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timesheets_activity`
--
ALTER TABLE `timesheets_activity`
 ADD PRIMARY KEY (`activity_id`), ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `timesheets_contact`
--
ALTER TABLE `timesheets_contact`
 ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `timesheets_department`
--
ALTER TABLE `timesheets_department`
 ADD PRIMARY KEY (`department_id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `timesheets_job`
--
ALTER TABLE `timesheets_job`
 ADD PRIMARY KEY (`job_id`), ADD UNIQUE KEY `title` (`title`), ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `timesheets_person`
--
ALTER TABLE `timesheets_person`
 ADD PRIMARY KEY (`person_id`), ADD UNIQUE KEY `user_id` (`user_id`), ADD KEY `job_id` (`job_id`), ADD KEY `team_id` (`team_id`), ADD KEY `department_id` (`department_id`), ADD KEY `forename` (`forename`), ADD KEY `surname` (`surname`);

--
-- Indexes for table `timesheets_project`
--
ALTER TABLE `timesheets_project`
 ADD PRIMARY KEY (`project_id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `timesheets_role`
--
ALTER TABLE `timesheets_role`
 ADD PRIMARY KEY (`role_id`), ADD UNIQUE KEY `role_type` (`role_type`), ADD UNIQUE KEY `role_type_2` (`role_type`);

--
-- Indexes for table `timesheets_team`
--
ALTER TABLE `timesheets_team`
 ADD PRIMARY KEY (`team_id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `timesheets_timesheet`
--
ALTER TABLE `timesheets_timesheet`
 ADD PRIMARY KEY (`timesheet_id`), ADD KEY `user_id` (`user_id`), ADD KEY `project_id` (`project_id`), ADD KEY `date` (`date`);

--
-- Indexes for table `timesheets_user`
--
ALTER TABLE `timesheets_user`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `userID` (`user_id`);

--
-- Indexes for table `timesheets_user_role`
--
ALTER TABLE `timesheets_user_role`
 ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timesheets_activity`
--
ALTER TABLE `timesheets_activity`
MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `timesheets_contact`
--
ALTER TABLE `timesheets_contact`
MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `timesheets_department`
--
ALTER TABLE `timesheets_department`
MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `timesheets_job`
--
ALTER TABLE `timesheets_job`
MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `timesheets_person`
--
ALTER TABLE `timesheets_person`
MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `timesheets_project`
--
ALTER TABLE `timesheets_project`
MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `timesheets_role`
--
ALTER TABLE `timesheets_role`
MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `timesheets_team`
--
ALTER TABLE `timesheets_team`
MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `timesheets_timesheet`
--
ALTER TABLE `timesheets_timesheet`
MODIFY `timesheet_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `timesheets_user`
--
ALTER TABLE `timesheets_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `timesheets_user_role`
--
ALTER TABLE `timesheets_user_role`
MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
