-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 08:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(5, 'Html 5', 'this the best thing you can learn first'),
(6, 'CSS', ''),
(8, 'JavaScript', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 : unapproved; 1 :approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author`, `email`, `body`, `creation_date`, `post_id`, `status`) VALUES
(1, 'mohammad', 'm@gmail.com', 'this is just a comment', '2020-12-03 11:42:28', 5, 1),
(2, 'medi', 'ma@gmail.com', 'rthis is a fucking comment', '2020-12-03 11:55:43', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `photo` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 : draft, 1 : published',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(3) NOT NULL,
  `cat_id` int(3) NOT NULL,
  `tags` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `photo`, `status`, `creation_date`, `user_id`, `cat_id`, `tags`, `description`) VALUES
(10, 'new post 1222222', 'post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post', 'IMG_0648.JPG', 0, '2020-11-14 19:12:34', 25, 8, 'post post post,tags', 'post post post post post post post post post description'),
(12, 'asda1222222', 'asdsa', '77F7C42E-F583-478A-9579-7E6789AEB7AB.JPG', 0, '2020-11-26 16:23:51', 25, 5, 'asdsad', 'asdsad');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0' COMMENT 'admin(3) > adminstrtor(2) > editor(1) > subscriber(0)',
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `about` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `role`, `register_date`, `about`, `image`) VALUES
(10, 'admin', 'admin@site.com', '$2y$12$AjNPP8xHOBh8J4Rrww/xH.L/C7uy.wlVumqp03dgnpyh5Isg1rMbu', 'ali333', 'hoseini333', 3, '2020-11-12 17:53:14', 'as about 2333', ''),
(24, 'dasdsad', 'asd@dsad.copmdasd', '$2y$12$Dzu.ECefH.TlEHagcXq.DuMKlr4bxgd2nHTWpF4vCiQalCN6HJYZ2', 'asd', 'asda', 1, '2020-11-26 16:15:54', 'asdasd', ''),
(25, 'abc', 'alih@gmail.com33', '$2y$12$Ry.KbN06G.WBIKneMwNkpuLblgW3PGkG8iwV8HnytDXY9saLtnjtS', 'ad', 'asd', 1, '2020-11-26 16:16:33', 'asd', ''),
(26, 'ali', 'ali@gmail.com', '$2y$12$eI7UaFHYkE1gDwdL3uVXbezYBObHKkd/t18LdHFduAAlEjOOn3m4S', '', '', 0, '2020-11-28 09:21:06', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
