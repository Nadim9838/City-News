-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 07:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `city_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(30, 'Business', 1),
(32, 'Education', 1),
(33, 'Politics', 2),
(34, 'Sport', 2);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(41, 'Is nuclear power gaining new energy?', 'A decade ago, it seemed as though the global nuclear industry was in an irreversible decline.\r\n\r\nConcerns over safety, cost, and what to do with radioactive waste had sapped enthusiasm for a technology once seen as a revolutionary source of abundant cheap energy.\r\n\r\nYet now there is widespread talk of a revival, fuelled by tech giants Microsoft, Google and Amazon all announcing investments in the sector, as well as the growing pressures on wealthy nations to curb their carbon emissions.\r\n\r\nBut h', '30', '25, Nov, 2024', 24, 'news-1.webp'),
(42, 'Pant becomes most expensive player in IPL history', 'Rishabh Pant became the most expensive player in the history of the Indian Premier League as he was signed by Lucknow Super Giants for 27 crore (£2.54m) at the mega auction in Saudi Arabia.\r\n\r\nThe India wicketkeeper, 27, was the subject of a bidding war between the Super Giants and his former side, Delhi Capitals.\r\n\r\nPant, who returned to the game in this year IPL after an 14-month lay-off following a car accident, beat the record set earlier in the day when Shreyas Iyer was signed for 26.75 c  ', '34', '25, Nov, 2024', 24, 'news-2.webp'),
(43, 'Study in Scotland finds zero cervical cancer cases among women vaccinated early', 'A population-based observational study from 1988 to 2016 in Scotland has found zero cervical cancer cases in women who were fully vaccinated with a HPV vaccine when they were 12-13 years of age. The HPV immunisation programme began in Scotland in 2008. Women who were vaccinated with three doses of a bivalent HPV vaccine at 14 to 22 years of age as part of a catch-up programme (2008-2011) had a significant reduction — (3.2 cases per 100 000 population) — in cervical cancer incidence compared with', '32', '25, Nov, 2024', 24, 'news-3.jpg'),
(44, 'Adani indictment forces adjournment in both Houses', '                    The Winter Session of Parliament began on Monday (November 25, 2024) but faced early adjournments in both Houses. In the Upper House, proceedings were disrupted as Opposition wanted a discussion on the “Adani scam.” The House will meet again on Wednesday (November 27).\r\nThere will be no sitting of Parliament on Tuesday to commemorate the 75th anniversary of the Constituent Assembly’s adoption of the Constitution in 1949. ', '33', '25, Nov, 2024', 24, 'news-4.jpeg'),
(45, 'Trump threatens sweeping new tariffs on Mexico, Canada and China on first day in office', '                    U.S. President-elect Donald Trump is threatening to impose sweeping new tariffs on Mexico, Canada and China as soon as he takes office as part of his effort to crack down on illegal immigration and drugs.\r\n\r\nThe tariffs, if implemented, could dramatically raise prices on everything from gas to automobiles to agricultural products. The U.S. is the largest importer of goods in the world, with Mexico, China and Canada its top three suppliers, according to the most recent U.S. Ce', '33', '26, Nov, 2024', 27, 'news-5.jpg'),
(46, 'Border-Gavaskar Trophy first Test: India lords over Australia at Perth on day 4', 'A blue patch shimmered in the stands as Indian fans congregated to celebrate a great triumph. The Tricolour fluttered, drums echoed, a conch lent a deep acoustic vibe and on the turf Jasprit Bumrah’s men were tightening their hold on the first Test at the Optus Stadium in Perth on Monday (November 25, 2024).', '34', '26, Nov, 2024', 27, 'news-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `website_name` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `footer` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `website_name`, `logo`, `footer`) VALUES
(1, 'City News', 'logo.png', '© Copyright 2024 City News | Powered by Nadim Ahmad');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(24, 'Nadim', 'Ahmad', 'admin', '0192023a7bbd73250516f069df18b500', 1),
(27, 'Rafiq', 'Ahmad', 'rafeek', 'ab9701c0fe423d019b298af5da45bda1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
