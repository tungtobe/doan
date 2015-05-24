-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2015 at 05:56 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tot_nghiep`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Attribute`
--

CREATE TABLE IF NOT EXISTS `Attribute` (
`id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `attr_name` varchar(20) DEFAULT NULL,
  `attr_type` varchar(10) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `Attribute`
--

INSERT INTO `Attribute` (`id`, `parent_id`, `attr_name`, `attr_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Name', 'Varchar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'Manufacturer', 'Varchar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 0, 'IMG', 'Varchar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 0, 'OS', 'Varchar', 1, '0000-00-00 00:00:00', '2015-05-22 16:48:18'),
(8, 0, 'CPU', 'Varchar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 0, 'GPU', 'Varchar', 1, '0000-00-00 00:00:00', '2015-05-22 17:22:31'),
(10, 0, 'Screen type', 'Varchar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 0, 'Screen resolution', 'Varchar', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 0, 'Sim', 'Integer', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 0, 'Battery', 'Integer', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 0, 'Screen size', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 0, 'CPU speed', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 0, 'Ram', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 0, 'NFC', 'Boolean', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 0, 'ROM', 'Integer', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 0, 'SD card', 'Integer', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 0, 'Price', 'Integer', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 0, 'Rear camera', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 0, 'Front camera', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 0, 'Length', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 0, 'Width', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 0, 'Thickness', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 0, 'Weight', 'Float', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Bill`
--

CREATE TABLE IF NOT EXISTS `Bill` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `Bill`
--

INSERT INTO `Bill` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(18, 1, 1, '2015-05-20 13:45:55', '2015-05-20 16:21:07'),
(19, 1, 0, '2015-05-20 17:54:10', '2015-05-20 17:54:10'),
(20, 7, 0, '2015-05-23 16:41:00', '2015-05-23 16:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `BillItem`
--

CREATE TABLE IF NOT EXISTS `BillItem` (
`id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `number` int(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `BillItem`
--

INSERT INTO `BillItem` (`id`, `bill_id`, `item_id`, `updated_at`, `number`, `created_at`) VALUES
(23, 18, 1, '2015-05-20 13:46:19', 14, '2015-05-20 13:46:19'),
(24, 18, 58, '2015-05-20 13:46:19', 2, '2015-05-20 13:46:19'),
(26, 20, 4, '2015-05-23 16:41:00', 4, '2015-05-23 16:41:00'),
(27, 20, 25, '2015-05-23 16:41:00', 6, '2015-05-23 16:41:00'),
(28, 20, 83, '2015-05-23 16:41:00', 9, '2015-05-23 16:41:00'),
(29, 20, 111, '2015-05-23 16:41:00', 7, '2015-05-23 16:41:00'),
(46, 19, 1, '2015-05-24 15:45:22', 5, '2015-05-24 15:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`id`, `user_id`, `item_id`, `content`, `created_at`, `updated_at`) VALUES
(7, 2, 1, 'sản phẩm dùng tốt', '2015-05-20 13:41:23', '2015-05-20 13:41:23'),
(8, 2, 1, 'Lấy được thiện cảm người dùng', '2015-05-20 13:42:34', '2015-05-20 13:42:34'),
(9, 1, 4, 'Test comment', '2015-05-21 16:11:25', '2015-05-21 16:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `FavoriteItem`
--

CREATE TABLE IF NOT EXISTS `FavoriteItem` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `FavoriteItem`
--

INSERT INTO `FavoriteItem` (`id`, `user_id`, `item_id`, `updated_at`, `created_at`) VALUES
(11, 1, 58, '2015-05-19 06:36:27', '2015-05-19 06:36:27'),
(12, 1, 1, '2015-05-20 13:43:42', '2015-05-20 13:43:42'),
(13, 1, 13, '2015-05-21 17:54:16', '2015-05-21 17:54:16'),
(14, 1, 15, '2015-05-21 18:20:37', '2015-05-21 18:20:37'),
(15, 1, 8, '2015-05-21 18:27:43', '2015-05-21 18:27:43'),
(16, 2, 4, '2015-05-23 02:10:10', '2015-05-23 02:10:10'),
(17, 7, 4, '2015-05-23 16:40:24', '2015-05-23 16:40:24'),
(18, 7, 25, '2015-05-23 16:40:29', '2015-05-23 16:40:29'),
(19, 7, 111, '2015-05-23 16:40:35', '2015-05-23 16:40:35'),
(20, 7, 83, '2015-05-23 16:40:40', '2015-05-23 16:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE IF NOT EXISTS `Item` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`id`, `name`, `status`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'iPhone 6 Plus 128GB', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 'Samsung Galaxy Note Edge', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(8, 'iPhone 6 128GB', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(13, 'iPhone 6 Plus 64GB', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(15, 'iPhone 6 Plus 16GB', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(16, 'iPhone 6 64GB', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(17, 'Samsung Galaxy Note 4', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(18, 'iPhone 6 16GB', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(20, 'iPhone 5S 16GB', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(24, 'Nokia Lumia 930', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(25, 'Sony Xperia Z1 C6902', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(26, 'OPPO R5 Gilded', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(27, 'Samsung Galaxy A7', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(28, 'Samsung Galaxy Alpha', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(29, 'OPPO R5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(30, 'OPPO Find 7a', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(31, 'Samsung Galaxy A5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(32, 'Pantech Vega Iron 2 A910S', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(33, 'OPPO N1 Mini', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(34, 'Nokia Lumia 830', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(35, 'OPPO R1K R8001', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(36, 'Sony Xperia T2 Ultra', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(37, 'iPhone 4S 8GB', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(38, 'OPPO R1 R829', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(39, 'HTC Desire 816', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(40, 'Sony Xperia M2 Aqua', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(41, 'Samsung Galaxy A3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(42, 'Samsung Galaxy E7', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(43, 'HTC Desire 820Q', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(44, 'HTC Desire 816G', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(45, 'Sony Xperia C3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(46, 'OPPO Mirror 3', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(47, 'LG G3 Stylus', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(48, 'Pantech Vega Iron A870S', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(49, 'Samsung Galaxy E5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(50, 'Lenovo P70', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(51, 'HTC Desire 620G', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(52, 'Nokia Lumia 1320', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(53, 'OPPO Find 5 Mini R827', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(54, 'Samsung Galaxy Grand Prime G530', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(55, 'Nokia Lumia 730 Dual SIM', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(56, 'OPPO YoYo R2001', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(57, 'HTC DESIRE 616', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(58, 'Asus Zenfone 5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(59, 'LG L80 D380', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(60, 'LG L Fino (L70 Plus)', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(83, 'Sony Xperia Z3 Compact', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(110, 'HTC Desire Eye.', 1, '2015-05-22 16:32:14', '0000-00-00 00:00:00', NULL),
(111, 'Sony Xperia Z2 .', 1, '2015-05-22 16:30:25', '0000-00-00 00:00:00', NULL),
(117, 'Test Item', 1, '2015-05-24 15:44:24', '2015-05-24 14:30:46', '2015-05-24 08:44:24'),
(118, 'test i', 1, '2015-05-24 15:44:22', '2015-05-24 15:23:34', '2015-05-24 08:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `Relationship`
--

CREATE TABLE IF NOT EXISTS `Relationship` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rel_user_id` int(11) NOT NULL,
  `rel_type` int(2) NOT NULL COMMENT '1 : quan hệ bạn bè, 2 quan hệ chuyên gia',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `Relationship`
--

INSERT INTO `Relationship` (`id`, `user_id`, `rel_user_id`, `rel_type`, `updated_at`, `created_at`) VALUES
(8, 2, 2, 1, '2015-03-29 04:07:16', '2015-03-29 04:07:16'),
(21, 2, 1, 2, '2015-05-20 13:38:07', '2015-05-20 13:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `Setting`
--

CREATE TABLE IF NOT EXISTS `Setting` (
`id` int(2) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Setting`
--

INSERT INTO `Setting` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'unchange', 1, '2015-05-19 02:52:48', '2015-05-19 06:52:39'),
(2, 'changed', 60, '2015-05-19 02:52:48', '2015-05-24 15:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `remember_token` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `role`, `status`, `updated_at`, `created_at`, `remember_token`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 1, '2015-05-23 16:39:45', '2015-03-24 08:07:43', '2jMh8v5NHhBCNYZkKQiAVoqhJBbVqCg6qRUxVLdFp41Zx2zTi5rJ3VVfWqZ4'),
(2, 'tungtobe', 'e02c85c710255a33bafb6c29c661d8c0', 1, 1, '2015-05-23 02:49:24', '2015-03-24 08:19:08', 'Xx32fEuohQgMvAC5rnWHUn6DFJKreus0o31VGIE11FckHbBWdEeCX0uhBYf0'),
(5, 'tungtobe3', '1599c7ddba4fe65da7436d31945be51f', 0, 0, '2015-05-23 02:51:29', '2015-05-05 17:00:48', 'OYRDLOE44KYzRKKHinmILJ5mERkNLctfigX9JYo0qCfXvSA5GGDydmZmIrOO'),
(6, 'tungtobe5', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2015-05-23 02:49:26', '2015-05-22 15:30:19', ''),
(7, 'tungtobe10', '1599c7ddba4fe65da7436d31945be51f', 1, 1, '2015-05-23 16:40:08', '2015-05-23 14:36:18', 'HCIyhqJee7RIFnOdi82Nhny7qBi8Fk1HRI97bPFR2MQVq6FziY7ZrbwY9TfX');

-- --------------------------------------------------------

--
-- Table structure for table `Value`
--

CREATE TABLE IF NOT EXISTS `Value` (
`id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `attr_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2797 ;

--
-- Dumping data for table `Value`
--

INSERT INTO `Value` (`id`, `item_id`, `attr_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Apple', NULL, NULL),
(2, 1, 6, 'https://www.thegioididong.com/images/42/70260/iphone-6-plus-128gb.png', NULL, NULL),
(3, 1, 7, 'iOS', NULL, NULL),
(4, 1, 8, 'Apple A8', NULL, NULL),
(5, 1, 9, 'PowerVR GX6450', NULL, NULL),
(6, 1, 10, 'IPS', NULL, NULL),
(7, 1, 11, '1080x1920', NULL, NULL),
(8, 1, 12, '1', NULL, NULL),
(9, 1, 13, '2915', NULL, NULL),
(10, 1, 14, '5.5', NULL, NULL),
(11, 1, 15, '1.4', NULL, NULL),
(12, 1, 16, '1.0', NULL, NULL),
(13, 1, 17, '1', NULL, NULL),
(14, 1, 18, '128', NULL, NULL),
(15, 1, 19, '0', NULL, NULL),
(16, 1, 20, '25590000', NULL, NULL),
(17, 1, 24, '8.0', NULL, NULL),
(18, 1, 25, '1.2', NULL, NULL),
(19, 1, 26, '158.1', NULL, NULL),
(20, 1, 27, '77.88', NULL, NULL),
(21, 1, 28, '7.1', NULL, NULL),
(22, 1, 29, '172.0', NULL, NULL),
(67, 4, 5, 'Samsung', NULL, NULL),
(68, 4, 6, 'https://www.thegioididong.com/images/42/69704/samsung-galaxy-note-edge.png', NULL, NULL),
(69, 4, 7, 'Android', NULL, NULL),
(70, 4, 8, 'Qualcomm Snapdragon 805', NULL, NULL),
(71, 4, 9, 'Adreno 420', NULL, NULL),
(72, 4, 10, 'TFT', NULL, NULL),
(73, 4, 11, '1440x2560', NULL, NULL),
(74, 4, 12, '1', NULL, NULL),
(75, 4, 13, '3000', NULL, NULL),
(76, 4, 14, '5.6', NULL, NULL),
(77, 4, 15, '2.7', NULL, NULL),
(78, 4, 16, '3.0', NULL, NULL),
(79, 4, 17, '1', NULL, NULL),
(80, 4, 18, '32', NULL, NULL),
(81, 4, 19, '128', NULL, NULL),
(82, 4, 20, '20990000', NULL, NULL),
(83, 4, 24, '16.0', NULL, NULL),
(84, 4, 25, '3.7', NULL, NULL),
(85, 4, 26, '151.3', NULL, NULL),
(86, 4, 27, '82.4', NULL, NULL),
(87, 4, 28, '8.3', NULL, NULL),
(88, 4, 29, '174.0', NULL, NULL),
(147, 8, 5, 'Apple', NULL, NULL),
(148, 8, 6, 'https://www.thegioididong.com/images/42/70257/iphone-6-128gb.png', NULL, NULL),
(149, 8, 7, 'iOS', NULL, NULL),
(150, 8, 8, 'Apple A8', NULL, NULL),
(151, 8, 9, 'PowerVR GX6450', NULL, NULL),
(152, 8, 10, 'IPS', NULL, NULL),
(153, 8, 11, '750x1334', NULL, NULL),
(154, 8, 12, '1', NULL, NULL),
(155, 8, 13, '1810', NULL, NULL),
(156, 8, 14, '4.7', NULL, NULL),
(157, 8, 15, '1.4', NULL, NULL),
(158, 8, 16, '1.0', NULL, NULL),
(159, 8, 17, '1', NULL, NULL),
(160, 8, 18, '128', NULL, NULL),
(161, 8, 19, '0', NULL, NULL),
(162, 8, 20, '22990000', NULL, NULL),
(163, 8, 24, '8.0', NULL, NULL),
(164, 8, 25, '1.2', NULL, NULL),
(165, 8, 26, '138.1', NULL, NULL),
(166, 8, 27, '67.0', NULL, NULL),
(167, 8, 28, '6.9', NULL, NULL),
(168, 8, 29, '124.0', NULL, NULL),
(248, 13, 5, 'Apple', NULL, NULL),
(249, 13, 6, 'https://www.thegioididong.com/images/42/70259/iphone-6-plus-64gb-128gb-copy.png', NULL, NULL),
(250, 13, 7, 'iOS', NULL, NULL),
(251, 13, 8, 'Apple A8', NULL, NULL),
(252, 13, 9, 'PowerVR GX6450', NULL, NULL),
(253, 13, 10, 'IPS', NULL, NULL),
(254, 13, 11, '1080x1920', NULL, NULL),
(255, 13, 12, '1', NULL, NULL),
(256, 13, 13, '2915', NULL, NULL),
(257, 13, 14, '5.5', NULL, NULL),
(258, 13, 15, '1.4', NULL, NULL),
(259, 13, 16, '1.0', NULL, NULL),
(260, 13, 17, '1', NULL, NULL),
(261, 13, 18, '64', NULL, NULL),
(262, 13, 19, '0', NULL, NULL),
(263, 13, 20, '22990000', NULL, NULL),
(264, 13, 24, '8.0', NULL, NULL),
(265, 13, 25, '1.2', NULL, NULL),
(266, 13, 26, '158.1', NULL, NULL),
(267, 13, 27, '77.8', NULL, NULL),
(268, 13, 28, '7.1', NULL, NULL),
(269, 13, 29, '172.0', NULL, NULL),
(292, 15, 5, 'Apple', NULL, NULL),
(293, 15, 6, 'https://www.thegioididong.com/images/42/69783/iphone-6-plus-16gb-99.png', NULL, NULL),
(294, 15, 7, 'iOS', NULL, NULL),
(295, 15, 8, 'Apple A8', NULL, NULL),
(296, 15, 9, 'PowerVR GX6450', NULL, NULL),
(297, 15, 10, 'IPS', NULL, NULL),
(298, 15, 11, '1080x1920', NULL, NULL),
(299, 15, 12, '1', NULL, NULL),
(300, 15, 13, '2915', NULL, NULL),
(301, 15, 14, '5.5', NULL, NULL),
(302, 15, 15, '1.4', NULL, NULL),
(303, 15, 16, '1.0', NULL, NULL),
(304, 15, 17, '1', NULL, NULL),
(305, 15, 18, '16', NULL, NULL),
(306, 15, 19, '0', NULL, NULL),
(307, 15, 20, '20390000', NULL, NULL),
(308, 15, 24, '8.0', NULL, NULL),
(309, 15, 25, '1.2', NULL, NULL),
(310, 15, 26, '158.1', NULL, NULL),
(311, 15, 27, '77.8', NULL, NULL),
(312, 15, 28, '7.1', NULL, NULL),
(313, 15, 29, '172.0', NULL, NULL),
(314, 16, 5, 'Apple', NULL, NULL),
(315, 16, 6, 'https://www.thegioididong.com/images/42/70258/iphone-6-64gb.png', NULL, NULL),
(316, 16, 7, 'iOS', NULL, NULL),
(317, 16, 8, 'Apple A8', NULL, NULL),
(318, 16, 9, 'PowerVR GX6450', NULL, NULL),
(319, 16, 10, 'IPS', NULL, NULL),
(320, 16, 11, '750x1334', NULL, NULL),
(321, 16, 12, '1', NULL, NULL),
(322, 16, 13, '1810', NULL, NULL),
(323, 16, 14, '4.7', NULL, NULL),
(324, 16, 15, '1.4', NULL, NULL),
(325, 16, 16, '1.0', NULL, NULL),
(326, 16, 17, '1', NULL, NULL),
(327, 16, 18, '64', NULL, NULL),
(328, 16, 19, '0', NULL, NULL),
(329, 16, 20, '20390000', NULL, NULL),
(330, 16, 24, '8.0', NULL, NULL),
(331, 16, 25, '1.2', NULL, NULL),
(332, 16, 26, '138.1', NULL, NULL),
(333, 16, 27, '67.0', NULL, NULL),
(334, 16, 28, '6.9', NULL, NULL),
(335, 16, 29, '129.0', NULL, NULL),
(336, 17, 5, 'Samsung', NULL, NULL),
(337, 17, 6, 'https://www.thegioididong.com/images/42/68096/samsung-galaxy-note-4-icon-1.png', NULL, NULL),
(338, 17, 7, 'Android', NULL, NULL),
(339, 17, 8, 'Exynos 5433', NULL, NULL),
(340, 17, 9, 'Mali-T760', NULL, NULL),
(341, 17, 10, 'TFT', NULL, NULL),
(342, 17, 11, '1440x2560', NULL, NULL),
(343, 17, 12, '1', NULL, NULL),
(344, 17, 13, '3220', NULL, NULL),
(345, 17, 14, '5.7', NULL, NULL),
(346, 17, 15, '1.3', NULL, NULL),
(347, 17, 16, '3.0', NULL, NULL),
(348, 17, 17, '1', NULL, NULL),
(349, 17, 18, '32', NULL, NULL),
(350, 17, 19, '128', NULL, NULL),
(351, 17, 20, '17990000', NULL, NULL),
(352, 17, 24, '16.0', NULL, NULL),
(353, 17, 25, '3.7', NULL, NULL),
(354, 17, 26, '153.5', NULL, NULL),
(355, 17, 27, '78.6', NULL, NULL),
(356, 17, 28, '8.5', NULL, NULL),
(357, 17, 29, '176.0', NULL, NULL),
(358, 18, 5, 'Apple', NULL, NULL),
(359, 18, 6, 'https://www.thegioididong.com/images/42/60831/iphone-6-1.png', NULL, NULL),
(360, 18, 7, 'iOS', NULL, NULL),
(361, 18, 8, 'Apple A8', NULL, NULL),
(362, 18, 9, 'PowerVR GX6450', NULL, NULL),
(363, 18, 10, 'IPS', NULL, NULL),
(364, 18, 11, '750x1334', NULL, NULL),
(365, 18, 12, '1', NULL, NULL),
(366, 18, 13, '1810', NULL, NULL),
(367, 18, 14, '4.7', NULL, NULL),
(368, 18, 15, '1.4', NULL, NULL),
(369, 18, 16, '1.0', NULL, NULL),
(370, 18, 17, '1', NULL, NULL),
(371, 18, 18, '16', NULL, NULL),
(372, 18, 19, '0', NULL, NULL),
(373, 18, 20, '17790000', NULL, NULL),
(374, 18, 24, '8.0', NULL, NULL),
(375, 18, 25, '1.2', NULL, NULL),
(376, 18, 26, '138.1', NULL, NULL),
(377, 18, 27, '67.0', NULL, NULL),
(378, 18, 28, '6.9', NULL, NULL),
(379, 18, 29, '124.0', NULL, NULL),
(402, 20, 5, 'Apple', NULL, NULL),
(403, 20, 6, 'https://www.thegioididong.com/images/42/60546/iphone-5s-16gb-1-400x533.png', NULL, NULL),
(404, 20, 7, 'iOS', NULL, NULL),
(405, 20, 8, 'Apple A7', NULL, NULL),
(406, 20, 9, 'PowerVR G6430', NULL, NULL),
(407, 20, 10, 'IPS', NULL, NULL),
(408, 20, 11, '640x1136', NULL, NULL),
(409, 20, 12, '1', NULL, NULL),
(410, 20, 13, '1560', NULL, NULL),
(411, 20, 14, '4.0', NULL, NULL),
(412, 20, 15, '1.3', NULL, NULL),
(413, 20, 16, '1.0', NULL, NULL),
(414, 20, 17, '0', NULL, NULL),
(415, 20, 18, '16', NULL, NULL),
(416, 20, 19, '0', NULL, NULL),
(417, 20, 20, '13990000', NULL, NULL),
(418, 20, 24, '8.0', NULL, NULL),
(419, 20, 25, '1.2', NULL, NULL),
(420, 20, 26, '123.8', NULL, NULL),
(421, 20, 27, '58.6', NULL, NULL),
(422, 20, 28, '7.6', NULL, NULL),
(423, 20, 29, '112.0', NULL, NULL),
(490, 24, 5, 'Nokia', NULL, NULL),
(491, 24, 6, 'https://www.thegioididong.com/images/42/61383/nokia-lumia-930-lumia-icon-png.png', NULL, NULL),
(492, 24, 7, 'Windows phone', NULL, NULL),
(493, 24, 8, 'Qualcomm Snapdragon 800', NULL, NULL),
(494, 24, 9, 'Adreno 330', NULL, NULL),
(495, 24, 10, 'TFT', NULL, NULL),
(496, 24, 11, '1080x1920', NULL, NULL),
(497, 24, 12, '1', NULL, NULL),
(498, 24, 13, '2420', NULL, NULL),
(499, 24, 14, '5.0', NULL, NULL),
(500, 24, 15, '2.2', NULL, NULL),
(501, 24, 16, '2.0', NULL, NULL),
(502, 24, 17, '1', NULL, NULL),
(503, 24, 18, '32', NULL, NULL),
(504, 24, 19, '0', NULL, NULL),
(505, 24, 20, '10990000', NULL, NULL),
(506, 24, 24, '20.0', NULL, NULL),
(507, 24, 25, '1.2', NULL, NULL),
(508, 24, 26, '137.0', NULL, NULL),
(509, 24, 27, '71.0', NULL, NULL),
(510, 24, 28, '9.8', NULL, NULL),
(511, 24, 29, '167.0', NULL, NULL),
(512, 25, 5, 'Sony', NULL, NULL),
(513, 25, 6, 'https://www.thegioididong.com/images/42/60103/sony-xperia-z1-c6902.png', NULL, NULL),
(514, 25, 7, 'Android', NULL, NULL),
(515, 25, 8, 'Qualcomm MSM8974', NULL, NULL),
(516, 25, 9, 'Adreno 330', NULL, NULL),
(517, 25, 10, 'TFT', NULL, NULL),
(518, 25, 11, '1080x1920', NULL, NULL),
(519, 25, 12, '1', NULL, NULL),
(520, 25, 13, '3000', NULL, NULL),
(521, 25, 14, '5.0', NULL, NULL),
(522, 25, 15, '2.2', NULL, NULL),
(523, 25, 16, '2.0', NULL, NULL),
(524, 25, 17, '1', NULL, NULL),
(525, 25, 18, '16', NULL, NULL),
(526, 25, 19, '64', NULL, NULL),
(527, 25, 20, '10490000', NULL, NULL),
(528, 25, 24, '20.7', NULL, NULL),
(529, 25, 25, '2.0', NULL, NULL),
(530, 25, 26, '144.0', NULL, NULL),
(531, 25, 27, '74.0', NULL, NULL),
(532, 25, 28, '8.5', NULL, NULL),
(533, 25, 29, '170.0', NULL, NULL),
(534, 26, 5, 'Oppo', NULL, NULL),
(535, 26, 6, 'https://www.thegioididong.com/images/42/71045/oppo-r5-gilded-01-400x533.png', NULL, NULL),
(536, 26, 7, 'Android', NULL, NULL),
(537, 26, 8, 'Snapdragon 615', NULL, NULL),
(538, 26, 9, 'Adreno 405', NULL, NULL),
(539, 26, 10, 'TFT', NULL, NULL),
(540, 26, 11, '1080x1920', NULL, NULL),
(541, 26, 12, '1', NULL, NULL),
(542, 26, 13, '2000', NULL, NULL),
(543, 26, 14, '5.2', NULL, NULL),
(544, 26, 15, '1.5', NULL, NULL),
(545, 26, 16, '2.0', NULL, NULL),
(546, 26, 17, '0', NULL, NULL),
(547, 26, 18, '16', NULL, NULL),
(548, 26, 19, '0', NULL, NULL),
(549, 26, 20, '10490000', NULL, NULL),
(550, 26, 24, '13.0', NULL, NULL),
(551, 26, 25, '5.0', NULL, NULL),
(552, 26, 26, '148.9', NULL, NULL),
(553, 26, 27, '74.5', NULL, NULL),
(554, 26, 28, '4.85', NULL, NULL),
(555, 26, 29, '155.0', NULL, NULL),
(556, 27, 5, 'Samsung', NULL, NULL),
(557, 27, 6, 'https://www.thegioididong.com/images/42/70761/samsung-galaxy-a7-icon-2-400x500.png', NULL, NULL),
(558, 27, 7, 'Android', NULL, NULL),
(559, 27, 8, 'Snapdragon 615', NULL, NULL),
(560, 27, 9, 'Adreno 405', NULL, NULL),
(561, 27, 10, 'TFT', NULL, NULL),
(562, 27, 11, '1080x1920', NULL, NULL),
(563, 27, 12, '2', NULL, NULL),
(564, 27, 13, '2600', NULL, NULL),
(565, 27, 14, '5.5', NULL, NULL),
(566, 27, 15, '0.0', NULL, NULL),
(567, 27, 16, '2.0', NULL, NULL),
(568, 27, 17, '0', NULL, NULL),
(569, 27, 18, '16', NULL, NULL),
(570, 27, 19, '64', NULL, NULL),
(571, 27, 20, '9990000', NULL, NULL),
(572, 27, 24, '13.0', NULL, NULL),
(573, 27, 25, '5.0', NULL, NULL),
(574, 27, 26, '151.0', NULL, NULL),
(575, 27, 27, '76.3', NULL, NULL),
(576, 27, 28, '6.3', NULL, NULL),
(577, 27, 29, '133.0', NULL, NULL),
(578, 28, 5, 'Samsung', NULL, NULL),
(579, 28, 6, 'https://www.thegioididong.com/images/42/69412/samsung-galaxy-alpha-400x533.png', NULL, NULL),
(580, 28, 7, 'Android', NULL, NULL),
(581, 28, 8, 'Exynos 5430', NULL, NULL),
(582, 28, 9, 'Mali-T628', NULL, NULL),
(583, 28, 10, 'TFT', NULL, NULL),
(584, 28, 11, '720x1280', NULL, NULL),
(585, 28, 12, '1', NULL, NULL),
(586, 28, 13, '1860', NULL, NULL),
(587, 28, 14, '4.7', NULL, NULL),
(588, 28, 15, '1.8', NULL, NULL),
(589, 28, 16, '2.0', NULL, NULL),
(590, 28, 17, '1', NULL, NULL),
(591, 28, 18, '32', NULL, NULL),
(592, 28, 19, '0', NULL, NULL),
(593, 28, 20, '9490000', NULL, NULL),
(594, 28, 24, '12.0', NULL, NULL),
(595, 28, 25, '2.1', NULL, NULL),
(596, 28, 26, '132.4', NULL, NULL),
(597, 28, 27, '65.5', NULL, NULL),
(598, 28, 28, '6.7', NULL, NULL),
(599, 28, 29, '115.0', NULL, NULL),
(600, 29, 5, 'Oppo', NULL, NULL),
(601, 29, 6, 'https://www.thegioididong.com/images/42/70238/oppo-r5-400x533-400x533.png', NULL, NULL),
(602, 29, 7, 'Android', NULL, NULL),
(603, 29, 8, 'Snapdragon 615', NULL, NULL),
(604, 29, 9, 'Adreno 405', NULL, NULL),
(605, 29, 10, 'TFT', NULL, NULL),
(606, 29, 11, '1080x1920', NULL, NULL),
(607, 29, 12, '1', NULL, NULL),
(608, 29, 13, '2000', NULL, NULL),
(609, 29, 14, '5.2', NULL, NULL),
(610, 29, 15, '1.5', NULL, NULL),
(611, 29, 16, '2.0', NULL, NULL),
(612, 29, 17, '0', NULL, NULL),
(613, 29, 18, '16', NULL, NULL),
(614, 29, 19, '0', NULL, NULL),
(615, 29, 20, '10000000', NULL, NULL),
(616, 29, 24, '13.0', NULL, NULL),
(617, 29, 25, '5.0', NULL, NULL),
(618, 29, 26, '148.9', NULL, NULL),
(619, 29, 27, '74.5', NULL, NULL),
(620, 29, 28, '4.85', NULL, NULL),
(621, 29, 29, '155.0', NULL, NULL),
(622, 30, 5, 'Oppo', NULL, NULL),
(623, 30, 6, 'https://www.thegioididong.com/images/42/67774/oppo-find-7a-1-400x533.png', NULL, NULL),
(624, 30, 7, 'Android', NULL, NULL),
(625, 30, 8, 'Qualcomm Snapdragon 801', NULL, NULL),
(626, 30, 9, 'Adreno 330', NULL, NULL),
(627, 30, 10, 'IPS', NULL, NULL),
(628, 30, 11, '1080x1920', NULL, NULL),
(629, 30, 12, '1', NULL, NULL),
(630, 30, 13, '2800', NULL, NULL),
(631, 30, 14, '5.5', NULL, NULL),
(632, 30, 15, '2.3', NULL, NULL),
(633, 30, 16, '2.0', NULL, NULL),
(634, 30, 17, '1', NULL, NULL),
(635, 30, 18, '16', NULL, NULL),
(636, 30, 19, '128', NULL, NULL),
(637, 30, 20, '8990000', NULL, NULL),
(638, 30, 24, '13.0', NULL, NULL),
(639, 30, 25, '5.0', NULL, NULL),
(640, 30, 26, '152.6', NULL, NULL),
(641, 30, 27, '75.0', NULL, NULL),
(642, 30, 28, '9.2', NULL, NULL),
(643, 30, 29, '170.0', NULL, NULL),
(644, 31, 5, 'Samsung', NULL, NULL),
(645, 31, 6, 'https://www.thegioididong.com/images/42/70049/samsung-galaxy-a500-400x533-400x533.png', NULL, NULL),
(646, 31, 7, 'Android', NULL, NULL),
(647, 31, 8, 'Qualcomm Snapdragon 410', NULL, NULL),
(648, 31, 9, 'Adreno 306', NULL, NULL),
(649, 31, 10, 'TFT', NULL, NULL),
(650, 31, 11, '720x1280', NULL, NULL),
(651, 31, 12, '2', NULL, NULL),
(652, 31, 13, '2300', NULL, NULL),
(653, 31, 14, '5.0', NULL, NULL),
(654, 31, 15, '1.2', NULL, NULL),
(655, 31, 16, '2.0', NULL, NULL),
(656, 31, 17, '0', NULL, NULL),
(657, 31, 18, '16', NULL, NULL),
(658, 31, 19, '64', NULL, NULL),
(659, 31, 20, '8990000', NULL, NULL),
(660, 31, 24, '13.0', NULL, NULL),
(661, 31, 25, '5.0', NULL, NULL),
(662, 31, 26, '139.3', NULL, NULL),
(663, 31, 27, '69.7', NULL, NULL),
(664, 31, 28, '6.7', NULL, NULL),
(665, 31, 29, '123.0', NULL, NULL),
(666, 32, 5, 'Pantech', NULL, NULL),
(667, 32, 6, 'https://www.thegioididong.com/images/42/70115/pantech-vega-iron-2-a910s-1-400x533.png', NULL, NULL),
(668, 32, 7, 'Android', NULL, NULL),
(669, 32, 8, 'Qualcomm Snapdragon 801', NULL, NULL),
(670, 32, 9, 'Adreno 330', NULL, NULL),
(671, 32, 10, 'TFT', NULL, NULL),
(672, 32, 11, '1080x1920', NULL, NULL),
(673, 32, 12, '1', NULL, NULL),
(674, 32, 13, '3220', NULL, NULL),
(675, 32, 14, '5.3', NULL, NULL),
(676, 32, 15, '2.26', NULL, NULL),
(677, 32, 16, '3.0', NULL, NULL),
(678, 32, 17, '1', NULL, NULL),
(679, 32, 18, '32', NULL, NULL),
(680, 32, 19, '2', NULL, NULL),
(681, 32, 20, '8990000', NULL, NULL),
(682, 32, 24, '13.0', NULL, NULL),
(683, 32, 25, '2.0', NULL, NULL),
(684, 32, 26, '144.2', NULL, NULL),
(685, 32, 27, '73.5', NULL, NULL),
(686, 32, 28, '7.9', NULL, NULL),
(687, 32, 29, '152.0', NULL, NULL),
(688, 33, 5, 'Oppo', NULL, NULL),
(689, 33, 6, 'https://www.thegioididong.com/images/42/69066/oppo-n1-mini-png.png', NULL, NULL),
(690, 33, 7, 'Android', NULL, NULL),
(691, 33, 8, 'Qualcomm Snapdragon 400', NULL, NULL),
(692, 33, 9, 'Adreno 305', NULL, NULL),
(693, 33, 10, 'IPS', NULL, NULL),
(694, 33, 11, '720x1280', NULL, NULL),
(695, 33, 12, '1', NULL, NULL),
(696, 33, 13, '2140', NULL, NULL),
(697, 33, 14, '5.0', NULL, NULL),
(698, 33, 15, '1.6', NULL, NULL),
(699, 33, 16, '2.0', NULL, NULL),
(700, 33, 17, '1', NULL, NULL),
(701, 33, 18, '16', NULL, NULL),
(702, 33, 19, '0', NULL, NULL),
(703, 33, 20, '8490000', NULL, NULL),
(704, 33, 24, '13.0', NULL, NULL),
(705, 33, 25, '13.0', NULL, NULL),
(706, 33, 26, '148.4', NULL, NULL),
(707, 33, 27, '72.2', NULL, NULL),
(708, 33, 28, '9.2', NULL, NULL),
(709, 33, 29, '151.0', NULL, NULL),
(710, 34, 5, 'Nokia', NULL, NULL),
(711, 34, 6, 'https://www.thegioididong.com/images/42/69721/nokia-lumia-830-png-1.png', NULL, NULL),
(712, 34, 7, 'Windows phone', NULL, NULL),
(713, 34, 8, 'Qualcomm Snapdragon 400', NULL, NULL),
(714, 34, 9, 'Adreno 305', NULL, NULL),
(715, 34, 10, 'IPS', NULL, NULL),
(716, 34, 11, '720x1280', NULL, NULL),
(717, 34, 12, '1', NULL, NULL),
(718, 34, 13, '2200', NULL, NULL),
(719, 34, 14, '5.0', NULL, NULL),
(720, 34, 15, '1.2', NULL, NULL),
(721, 34, 16, '1.0', NULL, NULL),
(722, 34, 17, '1', NULL, NULL),
(723, 34, 18, '16', NULL, NULL),
(724, 34, 19, '128', NULL, NULL),
(725, 34, 20, '7990000', NULL, NULL),
(726, 34, 24, '10.0', NULL, NULL),
(727, 34, 25, '1.0', NULL, NULL),
(728, 34, 26, '139.4', NULL, NULL),
(729, 34, 27, '70.7', NULL, NULL),
(730, 34, 28, '8.5', NULL, NULL),
(731, 34, 29, '150.0', NULL, NULL),
(732, 35, 5, 'Oppo', NULL, NULL),
(733, 35, 6, 'https://www.thegioididong.com/images/42/70845/oppo-r1k-r8001-400x533.png', NULL, NULL),
(734, 35, 7, 'Android', NULL, NULL),
(735, 35, 8, 'Qualcomm Snapdragon 400', NULL, NULL),
(736, 35, 9, 'Adreno 305', NULL, NULL),
(737, 35, 10, 'IPS', NULL, NULL),
(738, 35, 11, '720x1280', NULL, NULL),
(739, 35, 12, '1', NULL, NULL),
(740, 35, 13, '2410', NULL, NULL),
(741, 35, 14, '5.0', NULL, NULL),
(742, 35, 15, '1.6', NULL, NULL),
(743, 35, 16, '1.0', NULL, NULL),
(744, 35, 17, '0', NULL, NULL),
(745, 35, 18, '16', NULL, NULL),
(746, 35, 19, '0', NULL, NULL),
(747, 35, 20, '7990000', NULL, NULL),
(748, 35, 24, '13.0', NULL, NULL),
(749, 35, 25, '5.0', NULL, NULL),
(750, 35, 26, '142.7', NULL, NULL),
(751, 35, 27, '70.4', NULL, NULL),
(752, 35, 28, '7.1', NULL, NULL),
(753, 35, 29, '134.0', NULL, NULL),
(754, 36, 5, 'Sony', NULL, NULL),
(755, 36, 6, 'https://www.thegioididong.com/images/42/61309/sony-xperia-t2-ultra-icon.png', NULL, NULL),
(756, 36, 7, 'Android', NULL, NULL),
(757, 36, 8, 'Qualcomm MSM8928', NULL, NULL),
(758, 36, 9, 'Adreno 305', NULL, NULL),
(759, 36, 10, 'TFT', NULL, NULL),
(760, 36, 11, '720x1280', NULL, NULL),
(761, 36, 12, '2', NULL, NULL),
(762, 36, 13, '3000', NULL, NULL),
(763, 36, 14, '6.0', NULL, NULL),
(764, 36, 15, '1.4', NULL, NULL),
(765, 36, 16, '1.0', NULL, NULL),
(766, 36, 17, '1', NULL, NULL),
(767, 36, 18, '8', NULL, NULL),
(768, 36, 19, '32', NULL, NULL),
(769, 36, 20, '7490000', NULL, NULL),
(770, 36, 24, '13.0', NULL, NULL),
(771, 36, 25, '1.1', NULL, NULL),
(772, 36, 26, '165.2', NULL, NULL),
(773, 36, 27, '83.8', NULL, NULL),
(774, 36, 28, '7.7', NULL, NULL),
(775, 36, 29, '171.8', NULL, NULL),
(776, 37, 5, 'Apple', NULL, NULL),
(777, 37, 6, 'https://www.thegioididong.com/images/42/60686/iphone-4s-8gb.png', NULL, NULL),
(778, 37, 7, 'iOS', NULL, NULL),
(779, 37, 8, 'Apple A5', NULL, NULL),
(780, 37, 9, 'PowerVR SGX543MP3', NULL, NULL),
(781, 37, 10, 'IPS', NULL, NULL),
(782, 37, 11, '640x960', NULL, NULL),
(783, 37, 12, '1', NULL, NULL),
(784, 37, 13, '1420', NULL, NULL),
(785, 37, 14, '3.5', NULL, NULL),
(786, 37, 15, '1.0', NULL, NULL),
(787, 37, 16, '512.0', NULL, NULL),
(788, 37, 17, '0', NULL, NULL),
(789, 37, 18, '8', NULL, NULL),
(790, 37, 19, '0', NULL, NULL),
(791, 37, 20, '6990000', NULL, NULL),
(792, 37, 24, '8.0', NULL, NULL),
(793, 37, 25, '0.3', NULL, NULL),
(794, 37, 26, '115.2', NULL, NULL),
(795, 37, 27, '58.6', NULL, NULL),
(796, 37, 28, '9.3', NULL, NULL),
(797, 37, 29, '140.0', NULL, NULL),
(798, 38, 5, 'Oppo', NULL, NULL),
(799, 38, 6, 'https://www.thegioididong.com/images/42/61238/oppo-r1-r829t.png', NULL, NULL),
(800, 38, 7, 'Android', NULL, NULL),
(801, 38, 8, 'MTK 6582', NULL, NULL),
(802, 38, 9, 'Mali-400MP', NULL, NULL),
(803, 38, 10, 'IPS', NULL, NULL),
(804, 38, 11, '720x1280', NULL, NULL),
(805, 38, 12, '2', NULL, NULL),
(806, 38, 13, '2410', NULL, NULL),
(807, 38, 14, '5.0', NULL, NULL),
(808, 38, 15, '1.3', NULL, NULL),
(809, 38, 16, '1.0', NULL, NULL),
(810, 38, 17, '0', NULL, NULL),
(811, 38, 18, '16', NULL, NULL),
(812, 38, 19, '0', NULL, NULL),
(813, 38, 20, '6990000', NULL, NULL),
(814, 38, 24, '8.0', NULL, NULL),
(815, 38, 25, '5.0', NULL, NULL),
(816, 38, 26, '142.7', NULL, NULL),
(817, 38, 27, '70.4', NULL, NULL),
(818, 38, 28, '7.1', NULL, NULL),
(819, 38, 29, '140.0', NULL, NULL),
(820, 39, 5, 'Htc', NULL, NULL),
(821, 39, 6, 'https://www.thegioididong.com/images/42/66599/htc-desire-816-1-400x533.png', NULL, NULL),
(822, 39, 7, 'Android', NULL, NULL),
(823, 39, 8, 'Qualcomm Snapdragon 400', NULL, NULL),
(824, 39, 9, 'Adreno 305', NULL, NULL),
(825, 39, 10, 'TFT', NULL, NULL),
(826, 39, 11, '720x1280', NULL, NULL),
(827, 39, 12, '2', NULL, NULL),
(828, 39, 13, '2600', NULL, NULL),
(829, 39, 14, '5.5', NULL, NULL),
(830, 39, 15, '1.6', NULL, NULL),
(831, 39, 16, '1.0', NULL, NULL),
(832, 39, 17, '0', NULL, NULL),
(833, 39, 18, '8', NULL, NULL),
(834, 39, 19, '128', NULL, NULL),
(835, 39, 20, '6990000', NULL, NULL),
(836, 39, 24, '13.0', NULL, NULL),
(837, 39, 25, '5.0', NULL, NULL),
(838, 39, 26, '156.6', NULL, NULL),
(839, 39, 27, '78.7', NULL, NULL),
(840, 39, 28, '7.99', NULL, NULL),
(841, 39, 29, '165.0', NULL, NULL),
(842, 40, 5, 'Sony', NULL, NULL),
(843, 40, 6, 'https://www.thegioididong.com/images/42/69830/sony-xperia-m2-aqua.png', NULL, NULL),
(844, 40, 7, 'Android', NULL, NULL),
(845, 40, 8, 'Qualcomm Snapdragon 400', NULL, NULL),
(846, 40, 9, 'Adreno 305', NULL, NULL),
(847, 40, 10, 'IPS', NULL, NULL),
(848, 40, 11, '540x960', NULL, NULL),
(849, 40, 12, '1', NULL, NULL),
(850, 40, 13, '2300', NULL, NULL),
(851, 40, 14, '4.8', NULL, NULL),
(852, 40, 15, '1.2', NULL, NULL),
(853, 40, 16, '1.0', NULL, NULL),
(854, 40, 17, '1', NULL, NULL),
(855, 40, 18, '8', NULL, NULL),
(856, 40, 19, '32', NULL, NULL),
(857, 40, 20, '6990000', NULL, NULL),
(858, 40, 24, '8.0', NULL, NULL),
(859, 40, 25, '1.1', NULL, NULL),
(860, 40, 26, '140.0', NULL, NULL),
(861, 40, 27, '72.0', NULL, NULL),
(862, 40, 28, '8.6', NULL, NULL),
(863, 40, 29, '149.0', NULL, NULL),
(864, 41, 5, 'Samsung', NULL, NULL),
(865, 41, 6, 'https://www.thegioididong.com/images/42/70050/samsung-galaxy-a3-400x400-400x400.png', NULL, NULL),
(866, 41, 7, 'Android', NULL, NULL),
(867, 41, 8, 'Qualcomm Snapdragon 410', NULL, NULL),
(868, 41, 9, 'Adreno 306', NULL, NULL),
(869, 41, 10, 'TFT', NULL, NULL),
(870, 41, 11, '540x960', NULL, NULL),
(871, 41, 12, '2', NULL, NULL),
(872, 41, 13, '1900', NULL, NULL),
(873, 41, 14, '4.5', NULL, NULL),
(874, 41, 15, '1.2', NULL, NULL),
(875, 41, 16, '1.0', NULL, NULL),
(876, 41, 17, '0', NULL, NULL),
(877, 41, 18, '16', NULL, NULL),
(878, 41, 19, '64', NULL, NULL),
(879, 41, 20, '6990000', NULL, NULL),
(880, 41, 24, '8.0', NULL, NULL),
(881, 41, 25, '5.0', NULL, NULL),
(882, 41, 26, '130.1', NULL, NULL),
(883, 41, 27, '65.5', NULL, NULL),
(884, 41, 28, '6.9', NULL, NULL),
(885, 41, 29, '110.3', NULL, NULL),
(886, 42, 5, 'Samsung', NULL, NULL),
(887, 42, 6, 'https://www.thegioididong.com/images/42/70735/samsung-galaxy-e7-400x533.png', NULL, NULL),
(888, 42, 7, 'Android', NULL, NULL),
(889, 42, 8, 'Qualcomm Snapdragon 410', NULL, NULL),
(890, 42, 9, 'Adreno 306', NULL, NULL),
(891, 42, 10, 'TFT', NULL, NULL),
(892, 42, 11, '720x1280', NULL, NULL),
(893, 42, 12, '2', NULL, NULL),
(894, 42, 13, '2950', NULL, NULL),
(895, 42, 14, '5.5', NULL, NULL),
(896, 42, 15, '1.2', NULL, NULL),
(897, 42, 16, '2.0', NULL, NULL),
(898, 42, 17, '0', NULL, NULL),
(899, 42, 18, '16', NULL, NULL),
(900, 42, 19, '64', NULL, NULL),
(901, 42, 20, '6990000', NULL, NULL),
(902, 42, 24, '13.0', NULL, NULL),
(903, 42, 25, '5.0', NULL, NULL),
(904, 42, 26, '151.3', NULL, NULL),
(905, 42, 27, '77.2', NULL, NULL),
(906, 42, 28, '7.3', NULL, NULL),
(907, 42, 29, '0.0', NULL, NULL),
(908, 43, 5, 'Htc', NULL, NULL),
(909, 43, 6, 'https://www.thegioididong.com/images/42/70961/htc-desire-820q-1-400x533.png', NULL, NULL),
(910, 43, 7, 'Android', NULL, NULL),
(911, 43, 8, 'Qualcomm Snapdragon 410', NULL, NULL),
(912, 43, 9, 'Adreno 306', NULL, NULL),
(913, 43, 10, 'TFT', NULL, NULL),
(914, 43, 11, '720x1280', NULL, NULL),
(915, 43, 12, '2', NULL, NULL),
(916, 43, 13, '2600', NULL, NULL),
(917, 43, 14, '5.5', NULL, NULL),
(918, 43, 15, '1.2', NULL, NULL),
(919, 43, 16, '1.0', NULL, NULL),
(920, 43, 17, '0', NULL, NULL),
(921, 43, 18, '16', NULL, NULL),
(922, 43, 19, '128', NULL, NULL),
(923, 43, 20, '6890000', NULL, NULL),
(924, 43, 24, '13.0', NULL, NULL),
(925, 43, 25, '8.0', NULL, NULL),
(926, 43, 26, '157.7', NULL, NULL),
(927, 43, 27, '78.7', NULL, NULL),
(928, 43, 28, '7.7', NULL, NULL),
(929, 43, 29, '155.0', NULL, NULL),
(930, 44, 5, 'Htc', NULL, NULL),
(931, 44, 6, 'https://www.thegioididong.com/images/42/70122/htc-desire-816g-400x533.png', NULL, NULL),
(932, 44, 7, 'Android', NULL, NULL),
(933, 44, 8, 'MT6592', NULL, NULL),
(934, 44, 9, 'Mali 450 MP', NULL, NULL),
(935, 44, 10, 'TFT', NULL, NULL),
(936, 44, 11, '720x1280', NULL, NULL),
(937, 44, 12, '2', NULL, NULL),
(938, 44, 13, '2600', NULL, NULL),
(939, 44, 14, '5.5', NULL, NULL),
(940, 44, 15, '1.7', NULL, NULL),
(941, 44, 16, '1.0', NULL, NULL),
(942, 44, 17, '0', NULL, NULL),
(943, 44, 18, '8', NULL, NULL),
(944, 44, 19, '32', NULL, NULL),
(945, 44, 20, '6490000', NULL, NULL),
(946, 44, 24, '13.0', NULL, NULL),
(947, 44, 25, '5.0', NULL, NULL),
(948, 44, 26, '156.6', NULL, NULL),
(949, 44, 27, '78.7', NULL, NULL),
(950, 44, 28, '7.99', NULL, NULL),
(951, 44, 29, '165.0', NULL, NULL),
(952, 45, 5, 'Sony', NULL, NULL),
(953, 45, 6, 'https://www.thegioididong.com/images/42/69129/sony-xperia-c3.png', NULL, NULL),
(954, 45, 7, 'Android', NULL, NULL),
(955, 45, 8, 'Qualcomm Snapdragon 400', NULL, NULL),
(956, 45, 9, 'Adreno 305', NULL, NULL),
(957, 45, 10, 'IPS', NULL, NULL),
(958, 45, 11, '720x1280', NULL, NULL),
(959, 45, 12, '2', NULL, NULL),
(960, 45, 13, '2500', NULL, NULL),
(961, 45, 14, '5.5', NULL, NULL),
(962, 45, 15, '1.2', NULL, NULL),
(963, 45, 16, '1.0', NULL, NULL),
(964, 45, 17, '1', NULL, NULL),
(965, 45, 18, '8', NULL, NULL),
(966, 45, 19, '32', NULL, NULL),
(967, 45, 20, '5990000', NULL, NULL),
(968, 45, 24, '8.0', NULL, NULL),
(969, 45, 25, '5.0', NULL, NULL),
(970, 45, 26, '156.2', NULL, NULL),
(971, 45, 27, '78.7', NULL, NULL),
(972, 45, 28, '7.6', NULL, NULL),
(973, 45, 29, '149.7', NULL, NULL),
(974, 46, 5, 'Oppo', NULL, NULL),
(975, 46, 6, 'https://www.thegioididong.com/images/42/70844/oppo-mirror-3-400x533.png', NULL, NULL),
(976, 46, 7, 'Android', NULL, NULL),
(977, 46, 8, 'Qualcomm Snapdragon 410', NULL, NULL),
(978, 46, 9, 'Adreno 306', NULL, NULL),
(979, 46, 10, 'IPS', NULL, NULL),
(980, 46, 11, '720x1280', NULL, NULL),
(981, 46, 12, '2', NULL, NULL),
(982, 46, 13, '2000', NULL, NULL),
(983, 46, 14, '4.7', NULL, NULL),
(984, 46, 15, '1.2', NULL, NULL),
(985, 46, 16, '1.0', NULL, NULL),
(986, 46, 17, '0', NULL, NULL),
(987, 46, 18, '8', NULL, NULL),
(988, 46, 19, '128', NULL, NULL),
(989, 46, 20, '5690000', NULL, NULL),
(990, 46, 24, '8.0', NULL, NULL),
(991, 46, 25, '5.0', NULL, NULL),
(992, 46, 26, '137.0', NULL, NULL),
(993, 46, 27, '68.0', NULL, NULL),
(994, 46, 28, '8.95', NULL, NULL),
(995, 46, 29, '126.0', NULL, NULL),
(996, 47, 5, 'Lg', NULL, NULL),
(997, 47, 6, 'https://www.thegioididong.com/images/42/69898/lg-g3-stylus-1-400x533.png', NULL, NULL),
(998, 47, 7, 'Android', NULL, NULL),
(999, 47, 8, 'MTK 6582', NULL, NULL),
(1000, 47, 9, 'Mali-400', NULL, NULL),
(1001, 47, 10, 'IPS', NULL, NULL),
(1002, 47, 11, '540x960', NULL, NULL),
(1003, 47, 12, '2', NULL, NULL),
(1004, 47, 13, '3000', NULL, NULL),
(1005, 47, 14, '5.5', NULL, NULL),
(1006, 47, 15, '1.3', NULL, NULL),
(1007, 47, 16, '1.0', NULL, NULL),
(1008, 47, 17, '0', NULL, NULL),
(1009, 47, 18, '8', NULL, NULL),
(1010, 47, 19, '32', NULL, NULL),
(1011, 47, 20, '5490000', NULL, NULL),
(1012, 47, 24, '13.0', NULL, NULL),
(1013, 47, 25, '1.3', NULL, NULL),
(1014, 47, 26, '149.3', NULL, NULL),
(1015, 47, 27, '75.9', NULL, NULL),
(1016, 47, 28, '10.2', NULL, NULL),
(1017, 47, 29, '163.0', NULL, NULL),
(1018, 48, 5, 'Pantech', NULL, NULL),
(1019, 48, 6, 'https://www.thegioididong.com/images/42/70111/pantech-vega-iron-a870s-1-400x533.png', NULL, NULL),
(1020, 48, 7, 'Android', NULL, NULL),
(1021, 48, 8, 'Qualcomm Snapdragon 600', NULL, NULL),
(1022, 48, 9, 'Adreno 320', NULL, NULL),
(1023, 48, 10, 'IPS', NULL, NULL),
(1024, 48, 11, '720x1280', NULL, NULL),
(1025, 48, 12, '1', NULL, NULL),
(1026, 48, 13, '2150', NULL, NULL),
(1027, 48, 14, '5.0', NULL, NULL),
(1028, 48, 15, '1.7', NULL, NULL),
(1029, 48, 16, '2.0', NULL, NULL),
(1030, 48, 17, '1', NULL, NULL),
(1031, 48, 18, '32', NULL, NULL),
(1032, 48, 19, '2', NULL, NULL),
(1033, 48, 20, '5490000', NULL, NULL),
(1034, 48, 24, '13.0', NULL, NULL),
(1035, 48, 25, '2.0', NULL, NULL),
(1036, 48, 26, '136.3', NULL, NULL),
(1037, 48, 27, '67.7', NULL, NULL),
(1038, 48, 28, '8.8', NULL, NULL),
(1039, 48, 29, '154.0', NULL, NULL),
(1040, 49, 5, 'Samsung', NULL, NULL),
(1041, 49, 6, 'https://www.thegioididong.com/images/42/70730/samsung-galaxy-e5-400x533.png', NULL, NULL),
(1042, 49, 7, 'Android', NULL, NULL),
(1043, 49, 8, 'Qualcomm Snapdragon 410', NULL, NULL),
(1044, 49, 9, 'Adreno 306', NULL, NULL),
(1045, 49, 10, 'TFT', NULL, NULL),
(1046, 49, 11, '720x1280', NULL, NULL),
(1047, 49, 12, '2', NULL, NULL),
(1048, 49, 13, '2400', NULL, NULL),
(1049, 49, 14, '5.0', NULL, NULL),
(1050, 49, 15, '1.2', NULL, NULL),
(1051, 49, 16, '1.0', NULL, NULL),
(1052, 49, 17, '0', NULL, NULL),
(1053, 49, 18, '16', NULL, NULL),
(1054, 49, 19, '64', NULL, NULL),
(1055, 49, 20, '5490000', NULL, NULL),
(1056, 49, 24, '8.0', NULL, NULL),
(1057, 49, 25, '5.0', NULL, NULL),
(1058, 49, 26, '141.6', NULL, NULL),
(1059, 49, 27, '70.2', NULL, NULL),
(1060, 49, 28, '7.3', NULL, NULL),
(1061, 49, 29, '0.0', NULL, NULL),
(1062, 50, 5, 'Lenovo', NULL, NULL),
(1063, 50, 6, 'https://www.thegioididong.com/images/42/71129/lenovo-p70-533-400x533.png', NULL, NULL),
(1064, 50, 7, 'Android', NULL, NULL),
(1065, 50, 8, 'MTK 6752', NULL, NULL),
(1066, 50, 9, 'Mali-T760', NULL, NULL),
(1067, 50, 10, 'IPS', NULL, NULL),
(1068, 50, 11, '720x1280', NULL, NULL),
(1069, 50, 12, '2', NULL, NULL),
(1070, 50, 13, '4000', NULL, NULL),
(1071, 50, 14, '5.0', NULL, NULL),
(1072, 50, 15, '1.7', NULL, NULL),
(1073, 50, 16, '2.0', NULL, NULL),
(1074, 50, 17, '0', NULL, NULL),
(1075, 50, 18, '16', NULL, NULL),
(1076, 50, 19, '32', NULL, NULL),
(1077, 50, 20, '5390000', NULL, NULL),
(1078, 50, 24, '13.0', NULL, NULL),
(1079, 50, 25, '5.0', NULL, NULL),
(1080, 50, 26, '142.0', NULL, NULL),
(1081, 50, 27, '71.8', NULL, NULL),
(1082, 50, 28, '8.9', NULL, NULL),
(1083, 50, 29, '149.0', NULL, NULL),
(1084, 51, 5, 'Htc', NULL, NULL),
(1085, 51, 6, 'https://www.thegioididong.com/images/42/70357/htc-desire-620g-1-400x533.png', NULL, NULL),
(1086, 51, 7, 'Android', NULL, NULL),
(1087, 51, 8, 'MT6592', NULL, NULL),
(1088, 51, 9, 'Mali 450 MP', NULL, NULL),
(1089, 51, 10, 'TFT', NULL, NULL),
(1090, 51, 11, '720x1280', NULL, NULL),
(1091, 51, 12, '2', NULL, NULL),
(1092, 51, 13, '2100', NULL, NULL),
(1093, 51, 14, '5.0', NULL, NULL),
(1094, 51, 15, '1.7', NULL, NULL),
(1095, 51, 16, '1.0', NULL, NULL),
(1096, 51, 17, '0', NULL, NULL),
(1097, 51, 18, '8', NULL, NULL),
(1098, 51, 19, '32', NULL, NULL),
(1099, 51, 20, '5190000', NULL, NULL),
(1100, 51, 24, '8.0', NULL, NULL),
(1101, 51, 25, '5.0', NULL, NULL),
(1102, 51, 26, '150.1', NULL, NULL),
(1103, 51, 27, '72.7', NULL, NULL),
(1104, 51, 28, '9.6', NULL, NULL),
(1105, 51, 29, '160.0', NULL, NULL),
(1106, 52, 5, 'Nokia', NULL, NULL),
(1107, 52, 6, 'https://www.thegioididong.com/images/42/60671/nokia-lumia-1320.png', NULL, NULL),
(1108, 52, 7, 'Windows phone', NULL, NULL),
(1109, 52, 8, 'Qualcomm Snapdragon S4', NULL, NULL),
(1110, 52, 9, 'Adreno 305', NULL, NULL),
(1111, 52, 10, 'IPS', NULL, NULL),
(1112, 52, 11, '720x1280', NULL, NULL),
(1113, 52, 12, '1', NULL, NULL),
(1114, 52, 13, '3400', NULL, NULL),
(1115, 52, 14, '6.0', NULL, NULL),
(1116, 52, 15, '1.7', NULL, NULL),
(1117, 52, 16, '1.0', NULL, NULL),
(1118, 52, 17, '0', NULL, NULL),
(1119, 52, 18, '8', NULL, NULL),
(1120, 52, 19, '64', NULL, NULL),
(1121, 52, 20, '4990000', NULL, NULL),
(1122, 52, 24, '5.0', NULL, NULL),
(1123, 52, 25, '0.3', NULL, NULL),
(1124, 52, 26, '164.2', NULL, NULL),
(1125, 52, 27, '85.9', NULL, NULL),
(1126, 52, 28, '9.8', NULL, NULL),
(1127, 52, 29, '220.0', NULL, NULL),
(1128, 53, 5, 'Oppo', NULL, NULL),
(1129, 53, 6, 'https://www.thegioididong.com/images/42/61086/oppo-find-5-mini-r827.png', NULL, NULL),
(1130, 53, 7, 'Android', NULL, NULL),
(1131, 53, 8, 'ARM 7', NULL, NULL),
(1132, 53, 9, 'Mali-400MP', NULL, NULL),
(1133, 53, 10, 'IPS', NULL, NULL),
(1134, 53, 11, '540x960', NULL, NULL),
(1135, 53, 12, '2', NULL, NULL),
(1136, 53, 13, '2000', NULL, NULL),
(1137, 53, 14, '4.7', NULL, NULL),
(1138, 53, 15, '1.3', NULL, NULL),
(1139, 53, 16, '1.0', NULL, NULL),
(1140, 53, 17, '0', NULL, NULL),
(1141, 53, 18, '4', NULL, NULL),
(1142, 53, 19, '32', NULL, NULL),
(1143, 53, 20, '4990000', NULL, NULL),
(1144, 53, 24, '8.0', NULL, NULL),
(1145, 53, 25, '2.0', NULL, NULL),
(1146, 53, 26, '137.0', NULL, NULL),
(1147, 53, 27, '68.0', NULL, NULL),
(1148, 53, 28, '7.7', NULL, NULL),
(1149, 53, 29, '128.0', NULL, NULL),
(1150, 54, 5, 'Samsung', NULL, NULL),
(1151, 54, 6, 'https://www.thegioididong.com/images/42/69824/samsung-galaxy-grand-prime-g530-1-400x533.png', NULL, NULL),
(1152, 54, 7, 'Android', NULL, NULL),
(1153, 54, 8, 'Qualcomm Snapdragon 410', NULL, NULL),
(1154, 54, 9, 'Adreno 306', NULL, NULL),
(1155, 54, 10, 'TFT', NULL, NULL),
(1156, 54, 11, '540x960', NULL, NULL),
(1157, 54, 12, '2', NULL, NULL),
(1158, 54, 13, '2600', NULL, NULL),
(1159, 54, 14, '5.0', NULL, NULL),
(1160, 54, 15, '1.2', NULL, NULL),
(1161, 54, 16, '1.0', NULL, NULL),
(1162, 54, 17, '0', NULL, NULL),
(1163, 54, 18, '8', NULL, NULL),
(1164, 54, 19, '64', NULL, NULL),
(1165, 54, 20, '4990000', NULL, NULL),
(1166, 54, 24, '8.0', NULL, NULL),
(1167, 54, 25, '5.0', NULL, NULL),
(1168, 54, 26, '144.8', NULL, NULL),
(1169, 54, 27, '72.1', NULL, NULL),
(1170, 54, 28, '8.6', NULL, NULL),
(1171, 54, 29, '156.0', NULL, NULL),
(1172, 55, 5, 'Nokia', NULL, NULL),
(1173, 55, 6, 'https://www.thegioididong.com/images/42/69723/nokia-lumia-730-dual-sim.png', NULL, NULL),
(1174, 55, 7, 'Windows phone', NULL, NULL),
(1175, 55, 8, 'Qualcomm Snapdragon 400', NULL, NULL),
(1176, 55, 9, 'Adreno 305', NULL, NULL),
(1177, 55, 10, 'TFT', NULL, NULL),
(1178, 55, 11, '720x1280', NULL, NULL),
(1179, 55, 12, '2', NULL, NULL),
(1180, 55, 13, '2220', NULL, NULL),
(1181, 55, 14, '4.7', NULL, NULL),
(1182, 55, 15, '1.2', NULL, NULL),
(1183, 55, 16, '1.0', NULL, NULL),
(1184, 55, 17, '1', NULL, NULL),
(1185, 55, 18, '8', NULL, NULL),
(1186, 55, 19, '128', NULL, NULL),
(1187, 55, 20, '4690000', NULL, NULL),
(1188, 55, 24, '6.7', NULL, NULL),
(1189, 55, 25, '5.0', NULL, NULL),
(1190, 55, 26, '134.7', NULL, NULL),
(1191, 55, 27, '68.5', NULL, NULL),
(1192, 55, 28, '8.9', NULL, NULL),
(1193, 55, 29, '134.0', NULL, NULL),
(1194, 56, 5, 'Oppo', NULL, NULL),
(1195, 56, 6, 'https://www.thegioididong.com/images/42/67985/oppo-yoyo-r2001.png', NULL, NULL),
(1196, 56, 7, 'Android', NULL, NULL),
(1197, 56, 8, 'MTK 6582M', NULL, NULL),
(1198, 56, 9, 'Mali-400MP', NULL, NULL),
(1199, 56, 10, 'IPS', NULL, NULL),
(1200, 56, 11, '540x960', NULL, NULL),
(1201, 56, 12, '2', NULL, NULL),
(1202, 56, 13, '1900', NULL, NULL),
(1203, 56, 14, '4.7', NULL, NULL),
(1204, 56, 15, '1.3', NULL, NULL),
(1205, 56, 16, '1.0', NULL, NULL),
(1206, 56, 17, '0', NULL, NULL),
(1207, 56, 18, '4', NULL, NULL),
(1208, 56, 19, '32', NULL, NULL),
(1209, 56, 20, '4290000', NULL, NULL),
(1210, 56, 24, '5.0', NULL, NULL),
(1211, 56, 25, '2.0', NULL, NULL),
(1212, 56, 26, '138.5', NULL, NULL),
(1213, 56, 27, '69.5', NULL, NULL),
(1214, 56, 28, '9.2', NULL, NULL),
(1215, 56, 29, '145.0', NULL, NULL),
(1216, 57, 5, 'Htc', NULL, NULL),
(1217, 57, 6, 'https://www.thegioididong.com/images/42/69021/htc-desire-616-1-400x533.png', NULL, NULL),
(1218, 57, 7, 'Android', NULL, NULL),
(1219, 57, 8, 'MT6592', NULL, NULL),
(1220, 57, 9, 'Mali 450 MP4', NULL, NULL),
(1221, 57, 10, 'IPS', NULL, NULL),
(1222, 57, 11, '720x1280', NULL, NULL),
(1223, 57, 12, '2', NULL, NULL),
(1224, 57, 13, '2000', NULL, NULL),
(1225, 57, 14, '5.0', NULL, NULL),
(1226, 57, 15, '1.4', NULL, NULL),
(1227, 57, 16, '1.0', NULL, NULL),
(1228, 57, 17, '0', NULL, NULL),
(1229, 57, 18, '4', NULL, NULL),
(1230, 57, 19, '32', NULL, NULL),
(1231, 57, 20, '4290000', NULL, NULL),
(1232, 57, 24, '8.0', NULL, NULL),
(1233, 57, 25, '2.0', NULL, NULL),
(1234, 57, 26, '142.0', NULL, NULL),
(1235, 57, 27, '71.9', NULL, NULL),
(1236, 57, 28, '9.2', NULL, NULL),
(1237, 57, 29, '150.0', NULL, NULL),
(1238, 58, 5, 'Asus', NULL, NULL),
(1239, 58, 6, 'https://www.thegioididong.com/images/42/68097/asus-zenfone-5-icon.png', NULL, NULL),
(1240, 58, 7, 'Android', NULL, NULL),
(1241, 58, 8, 'Intel Atom Z2560', NULL, NULL),
(1242, 58, 9, 'PowerVR SGX544', NULL, NULL),
(1243, 58, 10, 'IPS', NULL, NULL),
(1244, 58, 11, '720x1280', NULL, NULL),
(1245, 58, 12, '2', NULL, NULL),
(1246, 58, 13, '2110', NULL, NULL),
(1247, 58, 14, '5.0', NULL, NULL),
(1248, 58, 15, '1.6', NULL, NULL),
(1249, 58, 16, '2.0', NULL, NULL),
(1250, 58, 17, '0', NULL, NULL),
(1251, 58, 18, '8', NULL, NULL),
(1252, 58, 19, '64', NULL, NULL),
(1253, 58, 20, '3990000', NULL, NULL),
(1254, 58, 24, '8.0', NULL, NULL),
(1255, 58, 25, '2.0', NULL, NULL),
(1256, 58, 26, '148.2', NULL, NULL),
(1257, 58, 27, '72.8', NULL, NULL),
(1258, 58, 28, '10.3', NULL, NULL),
(1259, 58, 29, '145.0', NULL, NULL),
(1765, 83, 5, 'Sony', NULL, NULL),
(1766, 83, 6, 'https://www.thegioididong.com/images/42/69724/sony-xperia-z3-compact-png.png', NULL, NULL),
(1767, 83, 7, 'Android', NULL, NULL),
(1768, 83, 8, 'Qualcomm Snapdragon 801', NULL, NULL),
(1769, 83, 9, 'Adreno 330', NULL, NULL),
(1770, 83, 10, 'IPS', NULL, NULL),
(1771, 83, 11, '720x1280', NULL, NULL),
(1772, 83, 12, '1', NULL, NULL),
(1773, 83, 13, '2600', NULL, NULL),
(1774, 83, 14, '4.6', NULL, NULL),
(1775, 83, 15, '2.5', NULL, NULL),
(1776, 83, 16, '2.0', NULL, NULL),
(1777, 83, 17, '1', NULL, NULL),
(1778, 83, 18, '16', NULL, NULL),
(1779, 83, 19, '64', NULL, NULL),
(1780, 83, 20, '11990000', NULL, NULL),
(1781, 83, 24, '20.7', NULL, NULL),
(1782, 83, 25, '2.2', NULL, NULL),
(1783, 83, 26, '127.3', NULL, NULL),
(1784, 83, 27, '64.9', NULL, NULL),
(1785, 83, 28, '8.6', NULL, NULL),
(1786, 83, 29, '129.0', NULL, NULL),
(2521, 60, 6, 'https://www.thegioididong.com/images/42/69895/lg-l-fino.png', NULL, NULL),
(2639, 111, 5, 'Sony', NULL, NULL),
(2640, 111, 6, 'https://www.thegioididong.com/images/42/61386/sony-xperia-z2-png.png', NULL, NULL),
(2641, 111, 7, 'Android', NULL, NULL),
(2642, 111, 8, 'Qualcomm MSM8974AB', NULL, NULL),
(2643, 111, 9, 'Adreno 330', NULL, NULL),
(2644, 111, 10, 'IPS', NULL, NULL),
(2645, 111, 11, '1080x1920', NULL, NULL),
(2646, 111, 12, '1', NULL, NULL),
(2647, 111, 13, '3200', NULL, NULL),
(2648, 111, 14, '5.2', NULL, NULL),
(2649, 111, 15, '2.3', NULL, NULL),
(2650, 111, 16, '3.0', NULL, NULL),
(2651, 111, 17, '0', NULL, NULL),
(2652, 111, 18, '16', NULL, NULL),
(2653, 111, 19, '64', NULL, NULL),
(2654, 111, 20, '11990000', NULL, NULL),
(2655, 111, 24, '20.7', NULL, NULL),
(2656, 111, 25, '2.2', NULL, NULL),
(2657, 111, 26, '146.8', NULL, NULL),
(2658, 111, 27, '73.3', NULL, NULL),
(2659, 111, 28, '8.2', NULL, NULL),
(2660, 111, 29, '163.0', NULL, NULL),
(2662, 110, 5, 'Htc', NULL, NULL),
(2663, 110, 6, 'https://www.thegioididong.com/images/42/70104/htc-desire-eye-icon.png', NULL, NULL),
(2664, 110, 7, 'Android', NULL, NULL),
(2665, 110, 8, 'Qualcomm Snapdragon 801', NULL, NULL),
(2666, 110, 9, 'Adreno 330', NULL, NULL),
(2667, 110, 10, 'IPS', NULL, NULL),
(2668, 110, 11, '1080x1920', NULL, NULL),
(2669, 110, 12, '1', NULL, NULL),
(2670, 110, 13, '2400', NULL, NULL),
(2671, 110, 14, '5.2', NULL, NULL),
(2672, 110, 15, '2.26', NULL, NULL),
(2673, 110, 16, '2.0', NULL, NULL),
(2674, 110, 17, '0', NULL, NULL),
(2675, 110, 18, '16', NULL, NULL),
(2676, 110, 19, '128', NULL, NULL),
(2677, 110, 20, '12490000', NULL, NULL),
(2678, 110, 24, '13.0', NULL, NULL),
(2679, 110, 25, '13.0', NULL, NULL),
(2680, 110, 26, '151.7', NULL, NULL),
(2681, 110, 27, '73.8', NULL, NULL),
(2682, 110, 28, '8.5', NULL, NULL),
(2683, 110, 29, '154.0', NULL, NULL),
(2712, 117, 6, 'dantri.com', NULL, NULL),
(2713, 117, 17, '0', NULL, NULL),
(2714, 117, 20, '300000', NULL, NULL),
(2716, 59, 5, 'Lg', NULL, NULL),
(2717, 59, 6, 'https://www.thegioididong.com/images/42/68635/lg-l80-dual.png', NULL, NULL),
(2718, 59, 7, 'Android', NULL, NULL),
(2719, 59, 8, 'Qualcomm Snapdragon 200', NULL, NULL),
(2720, 59, 9, 'Adreno 302', NULL, NULL),
(2721, 59, 10, 'IPS', NULL, NULL),
(2722, 59, 11, '480x800', NULL, NULL),
(2723, 59, 12, '2', NULL, NULL),
(2724, 59, 13, '2540', NULL, NULL),
(2725, 59, 14, '5.0', NULL, NULL),
(2726, 59, 15, '1.2', NULL, NULL),
(2727, 59, 16, '1.0', NULL, NULL),
(2728, 59, 17, '0', NULL, NULL),
(2729, 59, 18, '4', NULL, NULL),
(2730, 59, 19, '32', NULL, NULL),
(2731, 59, 20, '3790000', NULL, NULL),
(2732, 59, 24, '5.0', NULL, NULL),
(2733, 59, 25, '0.3', NULL, NULL),
(2734, 59, 26, '139.24', NULL, NULL),
(2735, 59, 27, '73.18', NULL, NULL),
(2736, 59, 28, '9.7', NULL, NULL),
(2737, 59, 29, '133.0', NULL, NULL),
(2738, 59, 1, 'LG L80 D380', '2015-05-24 15:01:18', '2015-05-24 15:01:18'),
(2739, 110, 1, 'HTC Desire Eye.', '2015-05-24 15:01:18', '2015-05-24 15:01:18'),
(2740, 111, 1, 'Sony Xperia Z2 .', '2015-05-24 15:01:18', '2015-05-24 15:01:18'),
(2741, 117, 1, 'Test Item', '2015-05-24 15:01:18', '2015-05-24 15:01:18'),
(2742, 1, 1, 'iPhone 6 Plus 128GB', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2743, 4, 1, 'Samsung Galaxy Note Edge', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2744, 8, 1, 'iPhone 6 128GB', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2745, 13, 1, 'iPhone 6 Plus 64GB', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2746, 15, 1, 'iPhone 6 Plus 16GB', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2747, 16, 1, 'iPhone 6 64GB', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2748, 17, 1, 'Samsung Galaxy Note 4', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2749, 18, 1, 'iPhone 6 16GB', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2750, 20, 1, 'iPhone 5S 16GB', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2751, 24, 1, 'Nokia Lumia 930', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2752, 25, 1, 'Sony Xperia Z1 C6902', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2753, 26, 1, 'OPPO R5 Gilded', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2754, 27, 1, 'Samsung Galaxy A7', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2755, 28, 1, 'Samsung Galaxy Alpha', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2756, 29, 1, 'OPPO R5', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2757, 30, 1, 'OPPO Find 7a', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2758, 31, 1, 'Samsung Galaxy A5', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2759, 32, 1, 'Pantech Vega Iron 2 A910S', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2760, 33, 1, 'OPPO N1 Mini', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2761, 34, 1, 'Nokia Lumia 830', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2762, 35, 1, 'OPPO R1K R8001', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2763, 36, 1, 'Sony Xperia T2 Ultra', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2764, 37, 1, 'iPhone 4S 8GB', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2765, 38, 1, 'OPPO R1 R829', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2766, 39, 1, 'HTC Desire 816', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2767, 40, 1, 'Sony Xperia M2 Aqua', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2768, 41, 1, 'Samsung Galaxy A3', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2769, 42, 1, 'Samsung Galaxy E7', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2770, 43, 1, 'HTC Desire 820Q', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2771, 44, 1, 'HTC Desire 816G', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2772, 45, 1, 'Sony Xperia C3', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2773, 46, 1, 'OPPO Mirror 3', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2774, 47, 1, 'LG G3 Stylus', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2775, 48, 1, 'Pantech Vega Iron A870S', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2776, 49, 1, 'Samsung Galaxy E5', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2777, 50, 1, 'Lenovo P70', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2778, 51, 1, 'HTC Desire 620G', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2779, 52, 1, 'Nokia Lumia 1320', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2780, 53, 1, 'OPPO Find 5 Mini R827', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2781, 54, 1, 'Samsung Galaxy Grand Prime G530', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2782, 55, 1, 'Nokia Lumia 730 Dual SIM', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2783, 56, 1, 'OPPO YoYo R2001', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2784, 57, 1, 'HTC DESIRE 616', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2785, 58, 1, 'Asus Zenfone 5', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2786, 60, 1, 'LG L Fino (L70 Plus)', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2787, 83, 1, 'Sony Xperia Z3 Compact', '2015-05-24 15:03:54', '2015-05-24 15:03:54'),
(2792, 118, 1, 'test i', NULL, NULL),
(2793, 118, 6, 'ladskf', NULL, NULL),
(2794, 118, 17, '0', NULL, NULL),
(2795, 118, 20, '300000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Vote`
--

CREATE TABLE IF NOT EXISTS `Vote` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `Vote`
--

INSERT INTO `Vote` (`id`, `user_id`, `item_id`, `type`, `created_at`, `updated_at`) VALUES
(26, 1, 36, 1, '2015-05-19 06:34:30', '2015-05-19 06:34:30'),
(28, 1, 58, 1, '2015-05-19 06:36:26', '2015-05-19 06:36:26'),
(29, 2, 1, 1, '2015-05-20 13:40:57', '2015-05-20 13:41:00'),
(31, 1, 1, 1, '2015-05-20 13:43:41', '2015-05-20 13:43:41'),
(32, 1, 111, 1, '2015-05-20 17:54:54', '2015-05-20 17:54:54'),
(33, 1, 4, 2, '2015-05-21 16:11:17', '2015-05-22 17:02:37'),
(34, 1, 13, 1, '2015-05-21 17:54:08', '2015-05-21 17:54:12'),
(35, 1, 16, 1, '2015-05-21 18:28:03', '2015-05-21 18:28:03'),
(36, 2, 4, 1, '2015-05-23 02:10:13', '2015-05-23 02:10:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Attribute`
--
ALTER TABLE `Attribute`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `attr_id` (`id`);

--
-- Indexes for table `Bill`
--
ALTER TABLE `Bill`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `BillItem`
--
ALTER TABLE `BillItem`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `FavoriteItem`
--
ALTER TABLE `FavoriteItem`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Item`
--
ALTER TABLE `Item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Relationship`
--
ALTER TABLE `Relationship`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Setting`
--
ALTER TABLE `Setting`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Value`
--
ALTER TABLE `Value`
 ADD PRIMARY KEY (`id`), ADD KEY `value` (`value`(255));

--
-- Indexes for table `Vote`
--
ALTER TABLE `Vote`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Attribute`
--
ALTER TABLE `Attribute`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `Bill`
--
ALTER TABLE `Bill`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `BillItem`
--
ALTER TABLE `BillItem`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `FavoriteItem`
--
ALTER TABLE `FavoriteItem`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Item`
--
ALTER TABLE `Item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `Relationship`
--
ALTER TABLE `Relationship`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `Setting`
--
ALTER TABLE `Setting`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Value`
--
ALTER TABLE `Value`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2797;
--
-- AUTO_INCREMENT for table `Vote`
--
ALTER TABLE `Vote`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
