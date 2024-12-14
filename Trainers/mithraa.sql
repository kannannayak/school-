-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 02:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u892124399_mithra`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_pass` varchar(255) DEFAULT NULL,
  `admin_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_pass`, `admin_created`) VALUES
(1, 'admin', 'superadmin@gmail.com', '123456', '2024-05-02 11:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `api_key`
--

CREATE TABLE `api_key` (
  `id` int(11) NOT NULL,
  `api_key_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `api_key`
--

INSERT INTO `api_key` (`id`, `api_key_id`, `status`) VALUES
(1, 'Mithra@2024', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `comments` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `phone`, `comments`) VALUES
(1, 'suruthi', 'suruthi@gmail.com', '4942489765', 'hi how are you'),
(9, 'Robin', 'robin@gmail.com', '6379957019', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `des_id` int(11) NOT NULL,
  `admin_id` int(10) DEFAULT NULL,
  `des_name` varchar(155) NOT NULL,
  `des_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => Active, 0 => Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`des_id`, `admin_id`, `des_name`, `des_status`) VALUES
(1, 1, 'Super Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(255) DEFAULT NULL,
  `game_image` text DEFAULT NULL,
  `game_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_type_web`
--

CREATE TABLE `game_type_web` (
  `game_type_id` int(11) NOT NULL,
  `game_type_name` varchar(999) DEFAULT NULL,
  `game_type_img` varchar(999) DEFAULT NULL,
  `game_type_createed_dt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_type_web`
--

INSERT INTO `game_type_web` (`game_type_id`, `game_type_name`, `game_type_img`, `game_type_createed_dt`) VALUES
(1, '3-3-3', NULL, '2024-04-16 11:58:05'),
(2, '3-6-3', NULL, '2024-04-16 11:58:05'),
(3, 'Cycle', NULL, '2024-04-16 11:58:16'),
(4, 'Doubles', NULL, '2024-04-25 05:15:39'),
(5, 'Team relay', NULL, '2024-04-25 05:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(10) NOT NULL,
  `images_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `images_name`) VALUES
(2, 'https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'),
(3, 'https://img.freepik.com/free-photo/painting-mountain-lake-with-mountain-background_188544-9126.jpg'),
(4, 'https://cdn.pixabay.com/photo/2024/04/04/12/26/ai-generated-8675021_960_720.png'),
(5, 'https://cdn.pixabay.com/photo/2024/04/04/12/26/ai-generated-8675021_960_720.png'),
(6, 'https://cdn.pixabay.com/photo/2024/04/04/12/26/ai-generated-8675021_960_720.png'),
(7, 'https://cdn.pixabay.com/photo/2024/04/04/12/26/ai-generated-8675021_960_720.png'),
(8, 'https://cdn.pixabay.com/photo/2024/04/04/12/26/ai-generated-8675021_960_720.png');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `info_id` int(11) NOT NULL,
  `about` longtext DEFAULT NULL,
  `privacy` longtext DEFAULT NULL,
  `terms` longtext DEFAULT NULL,
  `rules` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`info_id`, `about`, `privacy`, `terms`, `rules`) VALUES
(1, '<h2><strong>WSSA Mission Statement</strong></h2>\r\n\r\n<ul>\r\n	<li>As the official, worldwide governing body for sport stacking, the World Sport Stacking Association (WSSA) promotes the standardization and advancement of sport stacking rules, records and events.</li>\r\n</ul>\r\n\r\n', '<h2><strong>What does the WSSA do?</strong></h2>\r\n\r\n<ul>\r\n	<li>The WSSA is your official resource for tournaments, rules, standards and guidelines on how to put on a successful stacking event and to provide a consistent framework for stacking tournaments and events.</li>\r\n</ul>', '<h2><strong>What does the WSSA do?</strong></h2>\r\n\r\n<ul>\r\n	<li>The WSSA is your official resource for tournaments, rules, standards and guidelines on how to put on a successful stacking event and to provide a consistent framework for stacking tournaments and events.</li>\r\n</ul>', '<ul>\r\n	<li>The World Sport Stacking Association serves as the governing body for sport stacking rules and regulations. The WSSA provides a uniform framework for sport stacking events.</li>\r\n	<li>The WSSA sanctions sport stacking competitions and records worldwide. Our intent is to uphold the qualities of self-confidence, teamwork and good sportsmanship while providing a positive experience for all. At WSSA Sanctioned Tournaments,</li>\r\n	\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `my_records`
--

CREATE TABLE `my_records` (
  `record_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `total_time` time DEFAULT NULL,
  `created_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_records`
--

INSERT INTO `my_records` (`record_id`, `user_id`, `game_id`, `start_time`, `end_time`, `total_time`, `created_dt`) VALUES
(1, 21, 2, '10:10:00', '10:12:00', '00:02:00', '2024-05-02 10:17:19'),
(3, 21, 1, '00:00:10', '00:00:03', '00:00:03', '2024-05-03 07:59:26'),
(4, 21, 2, '00:00:10', '00:00:03', '00:00:07', '2024-05-03 08:37:52'),
(5, 21, 1, '00:00:10', '00:00:03', '00:00:07', '2024-05-03 08:37:52'),
(6, 21, 2, '00:00:10', '00:00:03', '00:00:07', '2024-05-03 08:37:52'),
(7, 20, 2, '00:00:10', '00:00:03', '00:00:07', '2024-05-03 08:37:52'),
(8, 21, 3, '00:00:10', '00:00:03', '00:00:02', '2024-05-03 08:37:52'),
(9, NULL, 1, '00:00:10', '00:00:07', '00:00:03', '2024-05-04 11:20:35'),
(10, NULL, 1, '00:00:10', '00:00:07', '00:00:03', '2024-05-04 11:21:54'),
(11, 21, 1, '00:00:10', '00:00:07', '00:00:03', '2024-05-06 04:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `nav_id` int(11) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `nav_icon` varchar(55) NOT NULL,
  `nav_link` varchar(255) NOT NULL,
  `child_status` tinyint(1) DEFAULT 0 COMMENT '0 => False, 1 => True',
  `nav_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => Active, 1 => Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`nav_id`, `nav_name`, `nav_icon`, `nav_link`, `child_status`, `nav_status`) VALUES
(1, 'Dashboard', 'fa fa-dashboard', 'index', 0, 0),
(4, 'Students', 'fa-solid fa-users-rectangle im', 'student_list', 0, 0),
(6, 'Coaches', 'fa-solid fa-id-card im', 'coaches_list', 0, 0),
(7, 'Groups', 'fa-solid fa-car im', 'groups', 0, 0),
(9, 'Notifi', 'fa-solid fa-user-tie im', 'notifi', 0, 0),
(13, 'Reports', 'fa-solid fa-qrcode im', 'reports', 0, 0),
(15, 'Notifications', 'fa-solid fa-message im', 'notification', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_name` varchar(999) DEFAULT NULL,
  `news_image` text DEFAULT NULL,
  `news_url` text DEFAULT NULL,
  `news_details` text DEFAULT NULL,
  `news_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_name`, `news_image`, `news_url`, `news_details`, `news_created`) VALUES
(1, 'Individual 3-6-3', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS38VcVxB02mNCnD6NxRstJibICy8_g_ghnZjTiEQN9uQ&s', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/hD2ZnEVXc78?si=sXiLwc7mur5DzIq_\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(2, 'Individual', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQarqWgL5dUItnenMuAd3Y5hrMA8RZN0ait6D2rP12C9A&s', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/MQtdQV4W4WU?si=XccsuObgdV7OqoNF\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(3, 'Individual 3-6-3', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhDVqPPdDSGwzUg2Wr-AB7TLJEZzn4wGE8E62vaa_PUw&s', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/krBMmg1AOeE?si=6vLTrQBeQGJ2l47M\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(4, 'Individual', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqH_VIm4fL-L56S2pHQ0O2jLCmTLHyDAOVlRtVH1Tg1g&s', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/krBMmg1AOeE?si=6vLTrQBeQGJ2l47M\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(5, 'Individual', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQarqWgL5dUItnenMuAd3Y5hrMA8RZN0ait6D2rP12C9A&s', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/krBMmg1AOeE?si=6vLTrQBeQGJ2l47M\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(6, 'Individual', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrOVTWWyYlzw_qoOcYzzVy6dZufZxcqD1qT5fef4VFUA&s', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/NeklKtk1Ypg?si=9MCK35T7g4vEsgSw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen>', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(7, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(8, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(10, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(11, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notifi_id` int(10) NOT NULL,
  `message` varchar(250) NOT NULL,
  `msg_sent_time` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notifi_id`, `message`, `msg_sent_time`) VALUES
(1, 'hello guys', '2024-05-02 11:09:53.048335'),
(2, 'hello guys welcome', '2024-05-02 11:09:53.048335'),
(3, 'hello guys welcome jj', '2024-05-02 11:09:53.048335'),
(4, 'hello guys welcome to mithra sports', '2024-05-02 11:09:53.048335');

-- --------------------------------------------------------

--
-- Table structure for table `registerform`
--

CREATE TABLE `registerform` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `tournament` varchar(250) NOT NULL,
  `grade` varchar(250) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `schoolname` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `district` varchar(250) NOT NULL,
  `pincode` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registerform`
--

INSERT INTO `registerform` (`id`, `name`, `email`, `gender`, `age`, `tournament`, `grade`, `phone`, `schoolname`, `address`, `district`, `pincode`) VALUES
(1, 'suruthi', 'suruthi@gmail.com', 'Female', '21', 'kkkk', '10', '4644821', 'maharishi', 'teynampet', 'chennai', '451212'),
(2, 'dhiya', 'dhiya@gmail.com', 'female', '22', 'jjjj', '8', '4931549843', 'maharishi', 'karaikudi', 'karaikudi', '456314'),
(3, 'kar', 'kar@123gmail.com', 'male', '15', 'b sjf jj aed ', '10', '1234567890', 'king', 'jhvdfvhhuh a', 'hjjddihiabe', '124563'),
(4, 'kar', 'kar@123gmail.com', 'male', '15', 'b sjf jj aed ', '10', '1234567890', 'king', 'jhvdfvhhuh a', 'hjjddihiabe', '124563'),
(5, 'kar', 'kar@123gmail.com', 'male', '15', 'b sjf jj aed ', '10', '1234567890', 'king', 'jhvdfvhhuh a', 'hjjddihiabe', '124563'),
(6, 'dhiya', 'dhiya@gmail.com', 'female', '22', 'jjjj', '8', '4931549843', 'maharishi', 'karaikudi', 'karaikudi', '456314'),
(7, 'balan', 'balan@gmail', 'Male', '22', 'jjjj', '10', '6546165215', 'amala annai', 'pudukottai', 'jjjj', '45121'),
(8, 'balan', 'balan@gmail', 'Male', '22', 'jjjj', '10', '6546165215', 'amala annai', 'pudukottai', 'jjjj', '45121'),
(9, 'balan', 'balan@gmail', 'Male', '22', 'jjjj', '10', '6546165215', 'amala annai', 'pudukottai', 'jjjj', '45121'),
(10, 'balan', 'balan@gmail', 'Male', '22', 'jjjj', '10', '6546165215', 'amala annai', 'pudukottai', 'jjjj', '45121'),
(12, 'balan', 'balan@gmail', 'Male', '22', 'jjjj', '10', '6546165215', 'amala annai', 'pudukottai', 'jjjj', '45121'),
(13, 'balan', 'balan@gmail', 'Male', '22', 'jjjj', '10', '6546165215', 'amala annai', 'pudukottai', 'jjjj', '45121'),
(14, 'wdwd', 'karth@g', 'male', '21', '1', '10', '4256317890', 'hbc', 'kholi', 'maha', '124563'),
(15, 'edvin', 'jhhjvhig@gmail', 'male', '8', '2', '10', '8547963210', 'hbc', 'jbidbcish', 'yuvg7yg', '124563'),
(16, 'nbbdcsbib', 'admin@gmail.com', 'male', '53', '1', '8', '4256317890', 'ytycgcg', 'b  gc', 'bhgcc', '456321'),
(17, 'nbbdcsbib', 'admin@gmail.com', 'male', '53', '1', '8', '4256317890', 'ytycgcg', 'b  gc', 'bhgcc', '456321'),
(18, 'suriya', 'kart@Gmail.com', 'male', '11', '1', '6', '7591534268', 'hbc', ' nbhvvu', 'yuvg7yg', '456321'),
(19, 'KARTHIK S', 'karthiksundaramoorthi3@gmail.com', 'male', '22', '1', '12', '9876543210', 'Gnhfdxcg', 'Ghbcd', 'Vhrfjmg', '0987655');

-- --------------------------------------------------------

--
-- Table structure for table `topers_list_web`
--

CREATE TABLE `topers_list_web` (
  `toper_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `name` varchar(999) DEFAULT NULL,
  `age` int(10) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `athlete` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topers_list_web`
--

INSERT INTO `topers_list_web` (`toper_id`, `game_id`, `name`, `age`, `gender`, `time`, `athlete`, `year`) VALUES
(1, 1, 'John Doe', 15, 'Male', '30', 'Runner', '2022'),
(6, 2, 'Mike Taylor', 17, 'Male', '45', 'Weightlifter', '2022'),
(7, 2, 'Emma Wilson', 19, 'Female', '15', 'Diver', '2022'),
(8, 2, 'Chris Lee', 17, 'Male', '50', 'Boxer', '2023'),
(9, 3, 'Sophia Martinez', 16, 'Female', '10', 'Long Jumper', '2022'),
(10, 3, 'David Rodriguez', 19, 'Male', '55', 'High Jumper', '2022'),
(11, 3, 'Jennifer Brown', 13, 'Female', '18', 'Sprinter', '2022'),
(12, 4, 'Balan', 22, 'Male', '30', 'Running', '2024'),
(13, 5, 'edwin', 21, 'Male', '20', 'Running', '2022'),
(14, 4, 'dhiya', 22, 'Female', '25', 'volley ball', '2022'),
(15, 4, 'sneha', 23, 'Female', '25', 'running', '2021'),
(16, 5, 'sangeetha', 27, 'Female', '30', 'hockey', '2029'),
(17, 5, 'vetri', 23, 'Male', '15', 'hockey', '2018'),
(18, 1, 'Nancy', 15, 'Female', '8', 'running', '2023'),
(19, 1, 'kishore', 25, 'Male', '15', 'running', '2023'),
(20, 1, 'Aalan', 22, 'Male', '20', 'volley ball', '2024\r\n'),
(21, 1, 'deepika', 22, 'Female', '9', 'running', '2023'),
(22, 2, 'suruthi', 10, 'Female', '7', 'running', '2026'),
(23, 2, 'kamal', 20, 'Male', '10', 'running', '2024'),
(24, 4, 'edwin', 22, 'Male', '10', 'running', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `tourn_id` int(11) NOT NULL,
  `tourn_type` varchar(255) DEFAULT NULL,
  `game_type` varchar(250) NOT NULL,
  `tourn_name` varchar(999) DEFAULT NULL,
  `tourn_image` varchar(999) DEFAULT NULL,
  `tourn_url` text DEFAULT NULL,
  `tourn_details` text DEFAULT NULL,
  `tourn_date` date DEFAULT NULL,
  `tourn_time` time DEFAULT NULL,
  `tourn_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`tourn_id`, `tourn_type`, `game_type`, `tourn_name`, `tourn_image`, `tourn_url`, `tourn_details`, `tourn_date`, `tourn_time`, `tourn_created`) VALUES
(1, '3-3-3', 'Outdoor', 'Cup Stacking Tournament 1', 'image1.jpg', 'https://example.com/tournament1', 'This tournament features the 3-3-3 cup stacking pattern.', '2024-05-15', NULL, '2024-04-18 10:09:08'),
(2, '3-6-3', 'Indoor ', 'Cup Stacking Tournament 2', 'image2.jpg', 'https://example.com/tournament2', 'This tournament features the 3-6-3 cup stacking pattern.', '2024-06-20', NULL, '2024-04-18 10:09:08'),
(3, 'cycle', 'Indoor', 'Cup Stacking Tournament 3', 'image3.jpg', 'https://example.com/tournament3', 'This tournament features the cycle cup stacking pattern.', '2024-07-25', NULL, '2024-04-18 10:09:08'),
(4, '3-3-3', 'Outdoor', 'Cup Stacking Tournament 4', 'image4.jpg', 'https://example.com/tournament4', 'Another opportunity to compete in the 3-3-3 cup stacking pattern.', '2024-08-10', NULL, '2024-04-18 10:09:08'),
(5, '3-6-3', 'Indoor', 'Cup Stacking Tournament 5', 'image5.jpg', 'https://example.com/tournament5', 'Participants will showcase their skills in the 3-6-3 cup stacking pattern.', '2024-09-15', NULL, '2024-04-18 10:09:08'),
(6, 'cycle', 'Outdoor', 'Cup Stacking Tournament 6', 'image6.jpg', 'https://example.com/tournament6', 'Join us for a thrilling competition featuring the cycle cup stacking pattern.', '2024-10-20', NULL, '2024-04-18 10:09:08'),
(7, '3-3-3', 'Indoor', 'Cup Stacking Tournament 7', 'image7.jpg', 'https://example.com/tournament7', 'This tournament is exclusively focused on the 3-3-3 cup stacking pattern.', '2024-11-25', NULL, '2024-04-18 10:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_register`
--

CREATE TABLE `tournament_register` (
  `tourn_id` int(11) NOT NULL,
  `tourn_for_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `schl_name` varchar(999) DEFAULT NULL,
  `address` varchar(999) DEFAULT NULL,
  `district` varchar(999) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `tourn_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tournament_register`
--

INSERT INTO `tournament_register` (`tourn_id`, `tourn_for_id`, `name`, `email`, `gender`, `age`, `grade`, `phone`, `schl_name`, `address`, `district`, `pincode`, `tourn_created`) VALUES
(1, 1, 'Robinson', 'robinson@gmail.com', '9887445123', '24', 'A+', '9887445123', 'Govi Hr Sec School', 'Test address', 'Tirunelveli', '627108', '2024-04-20 10:59:35'),
(2, 1, 'Robinson', 'robinson@gmail.com', '9887445123', '24', 'A+', '9887445123', 'Govi Hr Sec School', 'Test address', 'Tirunelveli', '627108', '2024-04-20 11:01:03'),
(3, 2, 'karthik', 'karthik@gmail.com', '1475896320', '23', 'o+', '1475896320', 'kingston Hr Sec School', 'Test address', 'hiruvannamalai', '604405', '2024-04-21 03:52:19'),
(4, 2, 'karthik', 'karthik@gmail.com', '1475896320', '23', 'o+', '1475896320', 'kingston Hr Sec School', 'Test address', 'hiruvannamalai', '604405', '2024-04-21 03:52:26'),
(5, 1, 'Robinson', 'robinson@gmail.com', '9887445123', '24', 'A+', '9887445123', 'Govi Hr Sec School', 'Test address', 'Tirunelveli', '627108', '2024-04-22 03:34:05'),
(6, 1, 'Robinson', 'test@gmail.com', 'Male', '22', 'A+', '9876541230', 'GHSS', 'Test', 'test', '123456', '2024-04-24 06:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `trainer_id` int(11) NOT NULL,
  `trainer_name` varchar(255) DEFAULT NULL,
  `trainer_email` varchar(999) DEFAULT NULL,
  `trainer_mobile` varchar(999) DEFAULT NULL,
  `trainer_address` text DEFAULT NULL,
  `tlog_id` varchar(999) DEFAULT NULL,
  `tlog_pass` varchar(999) DEFAULT NULL,
  `trainer_group` int(11) DEFAULT NULL,
  `trainer_location` text DEFAULT NULL,
  `trainer_school` text DEFAULT NULL,
  `trainer_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `trainer_name`, `trainer_email`, `trainer_mobile`, `trainer_address`, `tlog_id`, `tlog_pass`, `trainer_group`, `trainer_location`, `trainer_school`, `trainer_created`) VALUES
(1, 'ramesh', 'dhandapanisekar14@gmail.com', '9999999999', 'xxxxxx', 'ram@123', 'sss33', 3, 'cccc', 'fffffff', '2024-05-02 06:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `tutorial`
--

CREATE TABLE `tutorial` (
  `tut_id` int(11) NOT NULL,
  `tut_name` varchar(999) DEFAULT NULL,
  `tut_image` text DEFAULT NULL,
  `tut_url` text DEFAULT NULL,
  `tut_details` text DEFAULT NULL,
  `tut_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutorial`
--

INSERT INTO `tutorial` (`tut_id`, `tut_name`, `tut_image`, `tut_url`, `tut_details`, `tut_created`) VALUES
(1, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(2, 'Individual', 'https://www.google.com/url?sa=i&url=http%3A%2F%2Fwww.scielo.org.za%2Fscielo.php%3Fscript%3Dsci_arttext%26pid%3DS1015-51632018000100015&psig=AOvVaw3oy6iqLQTaRyb8mWY5JPhy&ust=1712904818543000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOiW2O3JuYUDFQAAAAAdAAAAABAE', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/NeklKtk1Ypg?si=9MCK35T7g4vEsgSw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(3, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(4, 'Individual', 'https://www.google.com/url?sa=i&url=http%3A%2F%2Fwww.scielo.org.za%2Fscielo.php%3Fscript%3Dsci_arttext%26pid%3DS1015-51632018000100015&psig=AOvVaw3oy6iqLQTaRyb8mWY5JPhy&ust=1712904818543000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOiW2O3JuYUDFQAAAAAdAAAAABAE', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/NeklKtk1Ypg?si=9MCK35T7g4vEsgSw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(5, 'Individual', 'https://www.google.com/url?sa=i&url=http%3A%2F%2Fwww.scielo.org.za%2Fscielo.php%3Fscript%3Dsci_arttext%26pid%3DS1015-51632018000100015&psig=AOvVaw3oy6iqLQTaRyb8mWY5JPhy&ust=1712904818543000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOiW2O3JuYUDFQAAAAAdAAAAABAE', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/NeklKtk1Ypg?si=9MCK35T7g4vEsgSw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(6, 'Individual', 'https://www.google.com/url?sa=i&url=http%3A%2F%2Fwww.scielo.org.za%2Fscielo.php%3Fscript%3Dsci_arttext%26pid%3DS1015-51632018000100015&psig=AOvVaw3oy6iqLQTaRyb8mWY5JPhy&ust=1712904818543000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOiW2O3JuYUDFQAAAAAdAAAAABAE', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/NeklKtk1Ypg?si=9MCK35T7g4vEsgSw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(7, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(8, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(10, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(11, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_web`
--

CREATE TABLE `tutorial_web` (
  `tutorial_web_id` int(11) NOT NULL,
  `tutorial_web_name` varchar(999) DEFAULT NULL,
  `tutorial_web_image` text DEFAULT NULL,
  `tutorial_web_url` text DEFAULT NULL,
  `tutorial_source_file` varchar(250) NOT NULL,
  `tutorial_web_details` text DEFAULT NULL,
  `tutorial_web_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutorial_web`
--

INSERT INTO `tutorial_web` (`tutorial_web_id`, `tutorial_web_name`, `tutorial_web_image`, `tutorial_web_url`, `tutorial_source_file`, `tutorial_web_details`, `tutorial_web_created`) VALUES
(1, 'Individual 3-6-3', 'upload/subcategory/6637313dd9ac9.png', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'upload/subcategory/6637313dd9f57.mp4', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(2, 'Individual', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZkcknvUdcJp1Gu8_qrYOno4QaZvCU4OimvDVO90PUbl9GIjObGJp2rl-fNTiB3MRb8cY&usqp=CAU', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/NeklKtk1Ypg?si=9MCK35T7g4vEsgSw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(3, 'Individual 3-6-3', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnNQ7EdSgv6jHT-iebZ6pPqy3lWs7ofzGCQrWIxLuyQyZeHsKqvplqDQY46G0TqzBo4CE&usqp=CAU', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JIdJ0Y6XaMw?si=0amwPffIZyhMD607\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(4, 'Individual', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTODodA5R0V0mFI0ou6hScjMhnzVw7equYT14mBT_Ml2ZKKsu4aq3cxbkrlpSdYbaZ5T_Q&usqp=CAU', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JIdJ0Y6XaMw?si=0amwPffIZyhMD607\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(5, 'Individual', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmOHRm1BU5P3ep9oTmw96qPjPF9ZzsW4_i93DrNwMlJAUJ40PNjcbcaxXWBciK_tnYzMQ&usqp=CAU', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JIdJ0Y6XaMw?si=0amwPffIZyhMD607\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(6, 'Individual', 'https://m.media-amazon.com/images/I/716ZmL4tVxL._AC_UF894,1000_QL80_DpWeblab_.jpg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/JIdJ0Y6XaMw?si=0amwPffIZyhMD607\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', '\r\nAt the SPEED STACKS Asian Championship Challenge Final on September 16th, 2018, Hyeon Jong Choi of South Korea set a new 3-3-3 world record with a time of 1.327 seconds. This new world record betters his previous world record of 1.335 by 0.008 seconds.', '2024-04-11 12:24:46'),
(7, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(8, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(10, 'Individual 3-6-3', 'https://www.google.com/imgres?q=3-6-3%20cup%20stacking&imgurl=https%3A%2F%2Fwww.researchgate.net%2Fpublication%2F328558530%2Ffigure%2Ffig1%2FAS%3A686323828551681%401540643760863%2F3-6-3-sport-stacking-sequence.jpg&imgrefurl=https%3A%2F%2Fwww.researchgate.net%2Ffigure%2F3-6-3-sport-stacking-sequence_fig1_328558530&docid=W3Y57Oi-Cj2BGM&tbnid=eGyCKAJkp3VeVM&vet=12ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA..i&w=741&h=417&hcb=2&ved=2ahUKEwj-q6KwybmFAxX9z6ACHYA_DMEQM3oECBoQAA', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27'),
(11, 'Individual 3-6-3', 'upload/subcategory/6634d9b81a768.png', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RFaUEYlMFZI?si=1cIoF4KXRESmwDac\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 'upload/subcategory/6634d9b81abad.mp4', 'Chan Keng Ian is on a record-breaking streak! He crushed his previous 3-6-3 world record of 1.713 seconds with a time of 1.658 at the NS Seremban Prima Sport Stacking Championships. This was one of two world records that Ian broke at this tournament which took place on June 9, 2019 in Seremban, Malaysia.', '2024-04-11 12:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `usernotification`
--

CREATE TABLE `usernotification` (
  `notif_id` int(11) NOT NULL,
  `notif_details` text DEFAULT NULL,
  `notif_files` text DEFAULT NULL,
  `notif_url` text DEFAULT NULL,
  `notif_type` varchar(255) DEFAULT NULL,
  `notif_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_uniq_id` varchar(250) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `parent_name` varchar(250) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_mobile` varchar(255) DEFAULT NULL,
  `user_age` int(11) DEFAULT NULL,
  `gender` int(10) DEFAULT NULL,
  `school_id` int(10) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `pincode` varchar(250) DEFAULT NULL,
  `user_grade` varchar(255) DEFAULT NULL,
  `user_school` text DEFAULT NULL,
  `user_location` text DEFAULT NULL,
  `login_password` varchar(250) DEFAULT NULL,
  `confirm_password` varchar(250) DEFAULT NULL,
  `ulog_id` varchar(255) DEFAULT NULL,
  `ulog_password` varchar(255) DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_approvel` int(11) NOT NULL DEFAULT 0,
  `id_proof` varchar(250) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `user_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_uniq_id`, `user_name`, `parent_name`, `user_email`, `user_mobile`, `user_age`, `gender`, `school_id`, `user_address`, `district`, `state`, `pincode`, `user_grade`, `user_school`, `user_location`, `login_password`, `confirm_password`, `ulog_id`, `ulog_password`, `trainer_id`, `group_id`, `user_approvel`, `id_proof`, `profile_pic`, `user_created`) VALUES
(1, 'MIT2377', 'dp', 'dp father', 'dp@gmail.com', '9090909090', 24, 1, 2, 'xxx street,15 yyyy village', 'vellore', 'tamilnadu', '000000000', NULL, 'abc school', 'vellore', NULL, NULL, NULL, NULL, 1, 1, 0, 'idimg', 'profimg', '2024-04-29 11:20:24'),
(19, 'MIT2362', 'mithra', 'srdc', 'srdd@gmail.comsdsaaa', '8080808087622152', 22, 7, NULL, 'bbbbb', 'vellored', 'tamilnadug\n', '000000000d', NULL, 'xyz school', NULL, NULL, NULL, NULL, NULL, 1, 2, 0, 'upload/id_proof/insuranceimg2.jpg', 'upload/profile_pic/license_sample.jpg', '2024-04-30 11:17:34'),
(20, 'MIT0288', 'mithra', 'srdc', 'srdd@gmail.comsdsaaat', '80808080876221525', 22, 2, NULL, 'bbbbb', 'vellored', 'tamilnadug\n', '000000000d', NULL, 'xyz school', NULL, NULL, NULL, NULL, NULL, 1, 3, 0, 'upload/id_proof/insuranceimg2.jpg', 'upload/profile_pic/license_sample.jpg', '2024-04-30 11:18:27'),
(21, 'MIT4675', 'dp', 'dp father', 'vineeth@gmail.com', '9400377390', 20, 0, NULL, 'alpy', 'alappuzha', 'kerala', '688002', NULL, 'TDHSS', NULL, NULL, NULL, NULL, NULL, 1, 3, 0, 'upload/id_proof/Vector (4).png', 'upload/profile_pic/Vector (3).png', '2024-04-30 14:40:44'),
(22, 'MIT7460', 'akash', 'akash', 'hhhh@gail.com', '88888888888', 24, 1, NULL, 'yyyyyyyyyyyy', 'hhhhhh', '9898', '9898', NULL, 'vvvvv', NULL, NULL, NULL, NULL, NULL, 1, 4, 0, 'upload/id_proof/insuranceimg1.jpg', 'upload/profile_pic/rcbackimg1.jpeg', '2024-05-03 09:31:36'),
(23, 'MIT9109', 'akash', 'akash', 'hhhh@gail.comd', '88888888888', 24, 1, NULL, 'yyyyyyyyyyyy', 'hhhhhh', 'tn', '99999995', NULL, 'vvvvv', NULL, '9898', '9898', NULL, NULL, 1, 5, 0, 'upload/id_proof/insuranceimg1.jpg', 'upload/profile_pic/rcbackimg1.jpeg', '2024-05-03 09:33:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_key`
--
ALTER TABLE `api_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`des_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `game_type_web`
--
ALTER TABLE `game_type_web`
  ADD PRIMARY KEY (`game_type_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `my_records`
--
ALTER TABLE `my_records`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`nav_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notifi_id`);

--
-- Indexes for table `registerform`
--
ALTER TABLE `registerform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topers_list_web`
--
ALTER TABLE `topers_list_web`
  ADD PRIMARY KEY (`toper_id`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`tourn_id`);

--
-- Indexes for table `tournament_register`
--
ALTER TABLE `tournament_register`
  ADD PRIMARY KEY (`tourn_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`tut_id`);

--
-- Indexes for table `tutorial_web`
--
ALTER TABLE `tutorial_web`
  ADD PRIMARY KEY (`tutorial_web_id`);

--
-- Indexes for table `usernotification`
--
ALTER TABLE `usernotification`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api_key`
--
ALTER TABLE `api_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `des_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_type_web`
--
ALTER TABLE `game_type_web`
  MODIFY `game_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `my_records`
--
ALTER TABLE `my_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `nav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notifi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registerform`
--
ALTER TABLE `registerform`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `topers_list_web`
--
ALTER TABLE `topers_list_web`
  MODIFY `toper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tourn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tournament_register`
--
ALTER TABLE `tournament_register`
  MODIFY `tourn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tutorial`
--
ALTER TABLE `tutorial`
  MODIFY `tut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tutorial_web`
--
ALTER TABLE `tutorial_web`
  MODIFY `tutorial_web_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usernotification`
--
ALTER TABLE `usernotification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
