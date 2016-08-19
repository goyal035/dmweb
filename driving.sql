-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2016 at 03:09 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `driving`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `language` varchar(20) NOT NULL DEFAULT 'eng',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `keyword`, `content`, `language`, `created`, `modified`) VALUES
(1, 'BACK_REGISTER', '{{user}},{{email}},{{password}}', 'Hello {{user}},\r\n\r\nYou are registered successfully on our website. Your credetials are :\r\nEmail = {{email}}\r\nPassword = {{password}}\r\n\r\n\r\nThank You.', 'eng', '2016-06-07 00:00:00', '2016-06-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `desscription` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `keyword`, `title`, `desscription`, `created`, `modified`) VALUES
(1, 'Site.title', 'Instructor', 'Header Title', '2016-06-05 00:00:00', '2016-06-05 00:00:00'),
(2, 'Site.email', 'goyal@mailinator.com', 'Admin Email', '2016-06-05 00:00:00', '2016-06-05 00:00:00'),
(3, 'Site.admin_rec_per_pg', '10', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Site.front_rec_per_pg', '10', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` tinyint(3) DEFAULT '2' COMMENT '1=>admin; 2=>trainer; 3=>User',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '0=>Inactive; 1=>active,2=>delete',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `password`, `role`, `status`, `created`, `modified`) VALUES
(1, 'Ganpat', 'Goyall', NULL, 'admin@admin.com', '8914264e9261fb81b6b43e26222e276b7f8294ae', 1, 1, '2016-06-05 10:37:31', '2016-06-05 14:28:54'),
(4, 'Tester', 'Tester', NULL, 'admn@admin.com', '8914264e9261fb81b6b43e26222e276b7f8294ae', 2, 1, '2016-06-05 19:12:26', '2016-06-10 09:44:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
