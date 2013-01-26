-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 10, 2013 at 03:27 PM
-- Server version: 5.5.28
-- PHP Version: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `ann_id` int(11) NOT NULL AUTO_INCREMENT,
  `ann_description` varchar(255) NOT NULL,
  `ann_content` text NOT NULL,
  PRIMARY KEY (`ann_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`ann_id`, `ann_description`, `ann_content`) VALUES
(2, 'sdfsdf', 'sdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd dfsdfsdf da qvrd df');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_is_main` tinyint(1) NOT NULL DEFAULT '1',
  `cat_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_is_main`, `cat_parent`) VALUES
(6, 'Dtdd', 1, NULL),
(7, 'Nokia', 0, 6),
(8, 'Samsung', 0, 6),
(9, 'Laptop', 1, NULL),
(10, 'Dell', 0, 9),
(11, 'tablet', 1, 0),
(12, 'LG', 0, 6),
(17, 'Motorola', 0, 6),
(18, 'Sony', 0, 9),
(19, 'Asus', 0, 9),
(20, 'Goolge', 0, 11),
(21, 'Kindle', 0, 11),
(22, 'Camera', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_banner` varchar(255) NOT NULL,
  `deal_content` text NOT NULL,
  `deal_start` date NOT NULL,
  `deal_end` date NOT NULL,
  `pro_id` int(11) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`deal_id`, `deal_banner`, `deal_content`, `deal_start`, `deal_end`, `pro_id`) VALUES
(6, '//localhost/shop/images/banner1.png', 'sdadasdasdasdada', '2013-01-01', '2013-01-16', 0),
(7, '//localhost/shop/images/banner1.png', 'sdadasdasdasdada', '2013-01-01', '2013-01-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `mem_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_email` varchar(255) NOT NULL,
  `mem_pass` varchar(64) NOT NULL,
  `mem_first_name` varchar(255) NOT NULL,
  `mem_last_name` varchar(255) NOT NULL,
  `mem_level` int(11) NOT NULL DEFAULT '0',
  `mem_point` int(11) NOT NULL DEFAULT '0',
  `mem_phone` decimal(11,0) NOT NULL,
  `mem_address` varchar(255) NOT NULL,
  `mem_gender` tinyint(1) NOT NULL DEFAULT '0',
  `mem_birth` date NOT NULL,
  PRIMARY KEY (`mem_id`),
  UNIQUE KEY `mem_email` (`mem_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_id`, `mem_email`, `mem_pass`, `mem_first_name`, `mem_last_name`, `mem_level`, `mem_point`, `mem_phone`, `mem_address`, `mem_gender`, `mem_birth`) VALUES
(1, 'test5@email.com', 'cea1646a41a505c16b94953b5f581e51', 'asdasdasd', 'asdasdasd', 0, 0, 909090909, 'asdasdasdasdasd', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL,
  `mem_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE IF NOT EXISTS `orders_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `pro_pirce` int(11) NOT NULL,
  `order_sum` int(11) NOT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(255) NOT NULL,
  `pro_thumb` varchar(255) NOT NULL,
  `pro_description` varchar(255) NOT NULL,
  `pro_vote` int(11) NOT NULL DEFAULT '0',
  `pro_available` int(11) NOT NULL DEFAULT '0',
  `pro_price` int(11) NOT NULL DEFAULT '0',
  `pro_sim` int(11) NOT NULL DEFAULT '0',
  `pro_touch` tinyint(1) NOT NULL DEFAULT '0',
  `pro_camera` tinyint(1) NOT NULL DEFAULT '0',
  `pro_wifi` tinyint(1) NOT NULL DEFAULT '0',
  `pro_3g` tinyint(1) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_thumb`, `pro_description`, `pro_vote`, `pro_available`, `pro_price`, `pro_sim`, `pro_touch`, `pro_camera`, `pro_wifi`, `pro_3g`, `cat_id`) VALUES
(8, 'aaaaaaaaaaaaaAAAAAAaa', '', 'vvvvvvvvv', 0, 12, 120000, 1, 1, 0, 1, 1, 7),
(9, '^^^^^^^^^^^^^^^^^^^^', '/upload/1357464254\\_7.jpg', 'asdasdasd', 0, 12, 2147483647, 1, 1, 1, 1, 0, 7),
(10, '^^^^^^^^^^^^^^^^^^^^', 'upload/1357464339\\_201207111105281-1.jpg', 'asdasdasd', 0, 12, 2147483647, 1, 1, 1, 1, 0, 7),
(11, 'wwwwwwwwwwwww', '//localhost/shop/upload/1357464413\\_201207111105426.jpg', 'asdasdasd', 0, 12, 2147483647, 1, 1, 1, 1, 0, 7),
(12, 'xxxxxxxxxxxx', '//localhost/shop/upload/1357464505\\_bao-chau.jpg', 'asdasdasd', 0, 12, 2147483647, 1, 1, 1, 1, 0, 7),
(13, 'xxxxxxxxxxxx', '//localhost/shop/upload/1357464581\\_bao-chau.jpg', 'asdasdasd', 0, 12, 2147483647, 1, 1, 1, 1, 0, 7),
(14, 'xxxxxxxxxxxx', '//localhost/shop/upload/1357464599\\_bao-chau.jpg', 'asdasdasd', 0, 12, 2147483647, 1, 1, 1, 1, 0, 7),
(15, 'asdasd', '', 'asdasdasd', 0, 10, 1000000, 1, 0, 0, 1, 1, 18),
(16, '0000000000000', '', 'asdasdasd', 0, 10, 1000000, 1, 0, 0, 1, 1, 20),
(17, 'bbbbbbbbbbbb', '', 'asdasdasd', 0, 10, 700000, 1, 0, 0, 1, 1, 18),
(18, 'nnnnnnnnnn', '//localhost/shop/upload/1357779351\\_285577\\_473858919313838\\_1672100614\\_n.jpg', 'asdasdasd', 0, 10, 700000, 1, 0, 0, 1, 1, 12),
(19, '::::::::::::::::;;;;;', '', '""""""""""""""""""""""""""""', 0, 8, 60000, 1, 0, 0, 0, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE IF NOT EXISTS `staffs` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_email` varchar(255) NOT NULL,
  `staff_pass` varchar(64) NOT NULL,
  `staff_first_name` varchar(255) NOT NULL,
  `staff_last_name` varchar(255) NOT NULL,
  `staff_phone` decimal(10,0) NOT NULL,
  `staff_address` varchar(255) NOT NULL,
  `staff_gender` tinyint(1) NOT NULL DEFAULT '0',
  `staff_birth` date NOT NULL,
  `staff_kind` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `staff_email` (`staff_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `tic_id` int(11) NOT NULL AUTO_INCREMENT,
  `tic_content` text NOT NULL,
  `tic_type` int(11) NOT NULL DEFAULT '0',
  `tic_parent` int(11) DEFAULT NULL,
  `mem_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`tic_id`, `tic_content`, `tic_type`, `tic_parent`, `mem_id`) VALUES
(1, '        asdfasdfasdfasfasdfasdf', 1, NULL, NULL),
(2, 'asdasd', 1, NULL, 0);

