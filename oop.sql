-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2021 at 08:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(8, 'JavaScript es6', 'yessss'),
(9, 'C / C++', 'the most powerful languages ever made'),
(16, 'new 1', 'sad');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 : unapproved; 1 :approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author`, `email`, `body`, `creation_date`, `post_id`, `status`) VALUES
(25, 'asd', 'asd@dasd', 'asfdsf', '2020-12-21 16:01:49', 10, 1),
(26, 'mohammad mohammmadi', 'mohamma@gmail.com', 'sadasdsad', '2020-12-16 20:25:40', 12, 0),
(31, 'mohammad mohammadi', 'm@gmail.com', '123asd', '2021-01-03 15:05:33', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `photo` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 : draft, 1 : published',
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(3) NOT NULL,
  `cat_id` int(3) NOT NULL,
  `tags` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `photo`, `status`, `creation_date`, `user_id`, `cat_id`, `tags`, `description`) VALUES
(10, 'new post 1222222', 'post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post post', 'IMG_0648.JPG', 1, '2020-11-14 19:12:34', 25, 8, 'post post post,tags', 'post post post post post post post post post description'),
(13, 'JavaScript es6', 'this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js this is a post about js', 'laravel.jpg', 1, '2020-12-17 19:13:43', 24, 8, 'js', 'great things about it'),
(14, 'this is the best language for you :: C', 'C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST C is the most Powerful Language for everyone that wants to be THE BEST \r\nthanks.', '1.PNG', 1, '2020-12-21 17:57:41', 10, 9, 'C, C++, c language, c family', 'what is C, where we use c, is C so hard'),
(15, 'post', 'just a post', '4.PNG', 1, '2020-12-22 12:00:26', 27, 9, 'post tags', 'postt'),
(16, 'JavaScript es6', 'thisi sa letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love a letter to my love', '2.PNG', 1, '2020-12-24 11:59:57', 10, 9, 'js', 'desc'),
(17, 'new', 'sadsadadasdffsa', 'fade.gif', 1, '2021-01-03 15:06:43', 10, 5, 'html, html 5', 'html is a programming language'),
(18, 'seo menu 222222', 'adsfsdfdsf', '1.PNG', 1, '2021-01-03 15:24:03', 10, 6, 'html, html 5', 'sdfdsf');

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
  `role` int(1) NOT NULL DEFAULT 0 COMMENT 'admin(3) > adminstrtor(2) > editor(1) > subscriber(0)',
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `about` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `role`, `register_date`, `about`, `image`) VALUES
(10, 'admin', 'admin@site.com', '$2y$12$AjNPP8xHOBh8J4Rrww/xH.L/C7uy.wlVumqp03dgnpyh5Isg1rMbu', 'ali333', 'hoseini333', 3, '2020-11-12 17:53:14', 'as about 2333', ''),
(24, 'adddd', 'asd@dsad.copmdasd', '$2y$12$ohpqsz4X5f2iYwZ4DLIVyuX37C9ZbiosGgtg.kocFx/5HgXYKLNHW', 'asd', 'hasan', 1, '2020-11-26 16:15:54', 'asdasd', ''),
(27, 'srush', 'sorush@gmail.com', '$2y$12$E0QvXcVWRELgjirSRopZe.N768iTvqqqoyO2mnMMYBL4INdLolS7W', 'sorush', 'hamdi', 1, '2020-12-17 16:30:33', 'this is sorush', ''),
(47, 'erfan_1365', 'erfan_mola@gmail.com', '$2y$12$gyDjUe2RY3IEKlWtsoUPle.91uZ0qpEZQZ1XjrkxhdkETFOPV8Cey', 'erfan', 'mola', 0, '2020-12-21 16:34:27', 'I am a linux system manager', ''),
(48, 'mohammad', 'moh@gmail.com', '$2y$12$GKMKLXqOYu1nFn3rhREG4.wrN1akqQY4zNi4RBE.u6XSsEZOLSe7a', 'mm', 'mm', 2, '2020-12-22 12:01:57', 'me', ''),
(49, 'ali123', 'aa@ggmail.com', '$2y$12$8nErmWOR5D3t.AuKvk3G2evA0EeKJT2bnCB1VaozcfdGEkXWUrDya', 'aa', 'aa', 0, '2020-12-22 12:04:55', '', ''),
(50, 'mohammad123', 'm.mohammadi.developer@gmail.com', '$2y$12$46VHK9BKwLVmzyDFTaOOFuurPNp7sicxq5FhbrtIsge1bwDGbIgMO', 'mohammad', 'mohammadi', 0, '2021-01-03 15:20:58', 'Hey Admin I want to be Administrator', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
