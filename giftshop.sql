-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 09:34 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giftshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_options`
--

CREATE TABLE `card_options` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active;2=inactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_options`
--

INSERT INTO `card_options` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Pin', 1, '2020-12-07 15:05:14'),
(2, 'Loaded Gmail', 1, '2020-12-07 15:05:17'),
(3, 'Recharge Service', 1, '2020-12-07 15:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `card_types`
--

CREATE TABLE `card_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active; 2=inactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_types`
--

INSERT INTO `card_types` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'USA Region', 1, '2020-12-07 15:06:10'),
(2, 'India Region', 1, '2020-12-07 15:06:13'),
(3, 'Korea Region', 1, '2020-12-07 15:06:31'),
(4, 'Australia Region', 1, '2020-12-07 15:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact_request`
--

CREATE TABLE `contact_request` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `currency_orders`
--

CREATE TABLE `currency_orders` (
  `id` int(11) NOT NULL,
  `user_ip` varchar(50) DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `exchange_amount` float DEFAULT NULL,
  `exchange_method_id` int(11) DEFAULT NULL,
  `exchange_rate` float DEFAULT NULL,
  `exchange_type` int(2) DEFAULT NULL COMMENT '1=buy,2=sell',
  `order_amount` double DEFAULT NULL,
  `sender_bkash_number` varchar(20) DEFAULT NULL COMMENT 'buy',
  `bkash_transaction_id` varchar(50) DEFAULT NULL COMMENT 'buy',
  `received_account_mail` varchar(100) DEFAULT NULL COMMENT 'buy',
  `receiver_name` varchar(50) DEFAULT NULL,
  `sender_account_mail` varchar(50) DEFAULT NULL COMMENT 'sell',
  `payment_transaction_id` varchar(50) DEFAULT NULL COMMENT 'sell',
  `receive_bkash_number` varchar(20) DEFAULT NULL COMMENT 'sell',
  `order_email` varchar(100) DEFAULT NULL,
  `order_status` int(2) NOT NULL DEFAULT 1 COMMENT '1=pending,2=confirm,3=completed,4=cancel',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currency_orders`
--

INSERT INTO `currency_orders` (`id`, `user_ip`, `order_id`, `exchange_amount`, `exchange_method_id`, `exchange_rate`, `exchange_type`, `order_amount`, `sender_bkash_number`, `bkash_transaction_id`, `received_account_mail`, `receiver_name`, `sender_account_mail`, `payment_transaction_id`, `receive_bkash_number`, `order_email`, `order_status`, `created_at`) VALUES
(2, '::1', '9umzPYn9', 7, 2, 80.5, 1, 563.5, '012345678', 'dfff', 'maamun79@gmail.com', NULL, '', '', '', NULL, 1, '2021-01-01 00:23:44'),
(3, '::1', 'X9AoqvRt', 9, 2, 80.5, 1, 724.5, '11111111111', 'sde', 'maamun79@gmail.com', NULL, '', '', '', NULL, 1, '2021-01-02 13:44:11'),
(4, '::1', 'FgHPtB6D', 1, 1, 82.5, 1, 82.5, '01676707067', 'sdds', 'misujon58262@gmail.com', 'mamun', '', '', '', 'maamun79@gmail.com', 1, '2021-01-03 17:08:33'),
(5, '::1', 'y0Uengq3', 5, 2, 80.5, 1, 402.5, '01676707067', 'sdd', 'misujon58262@gmail.com', 'Sujon', '', '', '', 'maamun79@gmail.com', 1, '2021-01-03 17:21:01'),
(6, '::1', 'mtgq1B8X', 10, 1, 80.2, 2, 802, '', '', '', '', 'maamun79@gmail.com', 'sdd', '12345678901', '', 1, '2021-01-03 17:23:38'),
(7, '::1', 'jLoieQzj', 5, 1, 82.5, 1, 412.5, '01676707067', 'sdf', 'misujon58262@gmail.com', 'sdv', '', '', '', 'maamun79@gmail.com', 1, '2021-01-03 17:42:21'),
(8, '::1', 'kuBMmyEH', 5, 1, 80.2, 2, 401, '', '', '', '', 'maamun79@gmail.com', 'fckj ', '12345678910', '', 1, '2021-01-03 17:50:01'),
(9, '::1', 'rrUmJWQG', 1, 1, 80.2, 2, 80.2, '', '', '', '', 'maamun79@gmail.com', 'xdffv', '11111111111', '', 1, '2021-01-03 17:55:26'),
(10, '::1', '3Ce8HbYL', 5, 1, 80.2, 2, 401, '', '', '', '', 'maamun79@gmail.com', 'gvdf', '11111111111', '', 1, '2021-01-03 21:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `exchanger`
--

CREATE TABLE `exchanger` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `company_mail` varchar(100) DEFAULT NULL,
  `buy_rate` float NOT NULL COMMENT 'customer''s buy rate',
  `sell_rate` float DEFAULT NULL COMMENT 'customer''s sell rate',
  `status` int(2) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exchanger`
--

INSERT INTO `exchanger` (`id`, `name`, `company_mail`, `buy_rate`, `sell_rate`, `status`, `created_at`) VALUES
(1, 'Payoneer', 'company.payoneer@gmail.com', 82.5, 80.2, 1, '2020-12-31 13:36:11'),
(2, 'Paypal', 'company.paypal@gmail.com', 80.5, 78.2, 1, '2020-12-31 13:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `game_topup`
--

CREATE TABLE `game_topup` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `thumb` text NOT NULL,
  `banner` text NOT NULL,
  `variation` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active; 2=inactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_redem` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game_topup`
--

INSERT INTO `game_topup` (`id`, `name`, `description`, `thumb`, `banner`, `variation`, `status`, `created_at`, `is_redem`) VALUES
(1, 'Pubg Mobile', 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 'uploads/pubg.jpg', 'uploads/pubgmobile_640x241.jpg', '[{\"type_id\":1,\"type_name\":\"Pubg Mobile (Global)\",\"type_price\":100,\"type_redems\":[{\"redem_id\":1,\"redem_name\":\"Unknown Cash (UC)\",\"player_info\":[{\"pinfo_id\":1,\"pinfo_name\":\"Via Character ID\"},{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":2,\"redem_name\":\"Prime Plus Subscription\",\"player_info\":\"\"}]},{\"type_id\":2,\"type_name\":\"Pubg Mobile (KR)\",\"type_price\":50,\"type_redems\":[{\"redem_id\":1,\"redem_name\":\"Unknown Cash (UC)\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]}]', 1, '2020-11-30 02:32:45', NULL),
(2, 'Free Fire', 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 'uploads/freefire_tile.jpg', 'uploads/freefire_640x241_in.jpg', '[{\"type_id\":3,\"type_name\":\"Diamond\",\"type_price\":100,\"type_redems\":[{\"redem_id\":3,\"redem_name\":\"Regular Top Up\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":4,\"redem_name\":\"Promo 1\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":5,\"redem_name\":\"Promo 2\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":6,\"redem_name\":\"Promo 3\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]},{\"type_id\":4,\"type_name\":\"Membership\",\"type_price\":50,\"type_redems\":[{\"redem_id\":7,\"redem_name\":\"Weekly Membership\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":8,\"redem_name\":\"Monthly Membership\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":9,\"redem_name\":\"VIP Membership (Weekly+Monthly)\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]},{\"type_id\":5,\"type_name\":\"Airdrop\",\"type_price\":50,\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"type_id\":6,\"type_name\":\"Event Top Up\",\"type_price\":50,\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]', 1, '2020-11-30 02:32:45', NULL),
(3, 'Pubg Mobile', 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 'uploads/pubg.jpg', 'uploads/pubgmobile_640x241.jpg', '[{\"type_id\":1,\"type_name\":\"Pubg Mobile (Global)\",\"type_price\":100,\"type_redems\":[{\"redem_id\":1,\"redem_name\":\"Unknown Cash (UC)\",\"player_info\":[{\"pinfo_id\":1,\"pinfo_name\":\"Via Character ID\"},{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":2,\"redem_name\":\"Prime Plus Subscription\",\"player_info\":\"\"}]},{\"type_id\":2,\"type_name\":\"Pubg Mobile (KR)\",\"type_price\":50,\"type_redems\":[{\"redem_id\":1,\"redem_name\":\"Unknown Cash (UC)\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]}]', 1, '2020-11-30 02:32:45', NULL),
(4, 'Free Fire', 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 'uploads/freefire_tile.jpg', 'uploads/freefire_640x241_in.jpg', '[{\"type_id\":3,\"type_name\":\"Diamond\",\"type_price\":100,\"type_redems\":[{\"redem_id\":3,\"redem_name\":\"Regular Top Up\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":4,\"redem_name\":\"Promo 1\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":5,\"redem_name\":\"Promo 2\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":6,\"redem_name\":\"Promo 3\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]},{\"type_id\":4,\"type_name\":\"Membership\",\"type_price\":50,\"type_redems\":[{\"redem_id\":7,\"redem_name\":\"Weekly Membership\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":8,\"redem_name\":\"Monthly Membership\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":9,\"redem_name\":\"VIP Membership (Weekly+Monthly)\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]},{\"type_id\":5,\"type_name\":\"Airdrop\",\"type_price\":50,\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"type_id\":6,\"type_name\":\"Event Top Up\",\"type_price\":50,\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]', 1, '2020-11-30 02:32:45', NULL),
(5, 'Pubg Mobile', 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 'uploads/pubg.jpg', 'uploads/pubgmobile_640x241.jpg', '[{\"type_id\":1,\"type_name\":\"Pubg Mobile (Global)\",\"type_price\":100,\"type_redems\":[{\"redem_id\":1,\"redem_name\":\"Unknown Cash (UC)\",\"player_info\":[{\"pinfo_id\":1,\"pinfo_name\":\"Via Character ID\"},{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":2,\"redem_name\":\"Prime Plus Subscription\",\"player_info\":\"\"}]},{\"type_id\":2,\"type_name\":\"Pubg Mobile (KR)\",\"type_price\":50,\"type_redems\":[{\"redem_id\":1,\"redem_name\":\"Unknown Cash (UC)\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]}]', 1, '2020-11-30 02:32:45', NULL),
(6, 'Free Fire', 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 'uploads/freefire_tile.jpg', 'uploads/freefire_640x241_in.jpg', '[{\"type_id\":3,\"type_name\":\"Diamond\",\"type_price\":100,\"type_redems\":[{\"redem_id\":3,\"redem_name\":\"Regular Top Up\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":4,\"redem_name\":\"Promo 1\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":5,\"redem_name\":\"Promo 2\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":6,\"redem_name\":\"Promo 3\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]},{\"type_id\":4,\"type_name\":\"Membership\",\"type_price\":50,\"type_redems\":[{\"redem_id\":7,\"redem_name\":\"Weekly Membership\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":8,\"redem_name\":\"Monthly Membership\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":9,\"redem_name\":\"VIP Membership (Weekly+Monthly)\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]},{\"type_id\":5,\"type_name\":\"Airdrop\",\"type_price\":50,\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"type_id\":6,\"type_name\":\"Event Top Up\",\"type_price\":50,\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]', 1, '2020-11-30 02:32:45', NULL),
(7, 'Pubg Mobile', 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 'uploads/pubg.jpg', 'uploads/pubgmobile_640x241.jpg', '[{\"type_id\":1,\"type_name\":\"Pubg Mobile (Global)\",\"type_price\":100,\"type_redems\":[{\"redem_id\":1,\"redem_name\":\"Unknown Cash (UC)\",\"player_info\":[{\"pinfo_id\":1,\"pinfo_name\":\"Via Character ID\"},{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":2,\"redem_name\":\"Prime Plus Subscription\",\"player_info\":\"\"}]},{\"type_id\":2,\"type_name\":\"Pubg Mobile (KR)\",\"type_price\":50,\"type_redems\":[{\"redem_id\":1,\"redem_name\":\"Unknown Cash (UC)\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]}]', 1, '2020-11-30 02:32:45', NULL),
(8, 'Free Fire', 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.', 'uploads/freefire_tile.jpg', 'uploads/freefire_640x241_in.jpg', '[{\"type_id\":3,\"type_name\":\"Diamond\",\"type_price\":100,\"type_redems\":[{\"redem_id\":3,\"redem_name\":\"Regular Top Up\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":4,\"redem_name\":\"Promo 1\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":5,\"redem_name\":\"Promo 2\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":6,\"redem_name\":\"Promo 3\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]},{\"type_id\":4,\"type_name\":\"Membership\",\"type_price\":50,\"type_redems\":[{\"redem_id\":7,\"redem_name\":\"Weekly Membership\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":8,\"redem_name\":\"Monthly Membership\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"redem_id\":9,\"redem_name\":\"VIP Membership (Weekly+Monthly)\",\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]},{\"type_id\":5,\"type_name\":\"Airdrop\",\"type_price\":50,\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]},{\"type_id\":6,\"type_name\":\"Event Top Up\",\"type_price\":50,\"player_info\":[{\"pinfo_id\":2,\"pinfo_name\":\"Via Login Info\"}]}]', 1, '2020-11-30 02:32:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gift_cards`
--

CREATE TABLE `gift_cards` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `thumb` text NOT NULL,
  `banner` text DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT 1 COMMENT '1=regular; 2=condition;',
  `variation` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active;2=inactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gift_cards`
--

INSERT INTO `gift_cards` (`id`, `name`, `price`, `description`, `thumb`, `banner`, `type`, `variation`, `status`, `created_at`) VALUES
(1, 'Amazon Gift Cards', 25, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to buy gift cards for Amazon.de (Germany), Amazon.fr (France), Amazon.it (Italy), Amazon.es (Spain), Amazon.nl (The Netherlands) and more!  After selecting an amount of prepaid credit, be sure to select the correct country/region in the drop-down menu. Then get the code and start shopping with secure prepaid credit!', 'uploads/amazon-200w.webp', '', 1, NULL, 1, '2020-12-06 00:02:55'),
(2, 'Google Play Gift Card', 25, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to buy gift cards for Amazon.de (Germany), Amazon.fr (France), Amazon.it (Italy), Amazon.es (Spain), Amazon.nl (The Netherlands) and more!  After selecting an amount of prepaid credit, be sure to select the correct country/region in the drop-down menu. Then get the code and start shopping with secure prepaid credit!', 'uploads/google-play-340w.webp', '', 2, '[{\"region_id\":1,\"region_name\":\"USA Region\",\"region_options\":[{\"option_id\":1,\"option_name\":\"Pin\"},{\"option_id\":2,\"option_name\":\"Loaded Gmail\"},{\"option_id\":3,\"option_name\":\"Recharge Service\"}]},{\"region_id\":2,\"region_name\":\"India Region\"},{\"region_id\":3,\"region_name\":\"Korea Region\"},{\"region_id\":4,\"region_name\":\"Australia Region\"}]', 1, '2020-12-06 00:02:55'),
(3, 'Amazon Gift Cards', 25, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to buy gift cards for Amazon.de (Germany), Amazon.fr (France), Amazon.it (Italy), Amazon.es (Spain), Amazon.nl (The Netherlands) and more!  After selecting an amount of prepaid credit, be sure to select the correct country/region in the drop-down menu. Then get the code and start shopping with secure prepaid credit!', 'uploads/amazon-200w.webp', '', 1, NULL, 1, '2020-12-06 00:02:55'),
(4, 'Google Play Gift Card', 25, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to buy gift cards for Amazon.de (Germany), Amazon.fr (France), Amazon.it (Italy), Amazon.es (Spain), Amazon.nl (The Netherlands) and more!  After selecting an amount of prepaid credit, be sure to select the correct country/region in the drop-down menu. Then get the code and start shopping with secure prepaid credit!', 'uploads/google-play-340w.webp', '', 2, '[{\"region_id\":1,\"region_name\":\"USA Region\",\"region_options\":[{\"option_id\":1,\"option_name\":\"Pin\"},{\"option_id\":2,\"option_name\":\"Loaded Gmail\"},{\"option_id\":3,\"option_name\":\"Recharge Service\"}]},{\"region_id\":2,\"region_name\":\"India Region\"},{\"region_id\":3,\"region_name\":\"Korea Region\"},{\"region_id\":4,\"region_name\":\"Australia Region\"}]', 1, '2020-12-06 00:02:55'),
(5, 'Amazon Gift Cards', 25, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to buy gift cards for Amazon.de (Germany), Amazon.fr (France), Amazon.it (Italy), Amazon.es (Spain), Amazon.nl (The Netherlands) and more!  After selecting an amount of prepaid credit, be sure to select the correct country/region in the drop-down menu. Then get the code and start shopping with secure prepaid credit!', 'uploads/amazon-200w.webp', '', 1, NULL, 1, '2020-12-06 00:02:55'),
(6, 'Google Play Gift Card', 25, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to buy gift cards for Amazon.de (Germany), Amazon.fr (France), Amazon.it (Italy), Amazon.es (Spain), Amazon.nl (The Netherlands) and more!  After selecting an amount of prepaid credit, be sure to select the correct country/region in the drop-down menu. Then get the code and start shopping with secure prepaid credit!', 'uploads/google-play-340w.webp', '', 2, '[{\"region_id\":1,\"region_name\":\"USA Region\",\"region_options\":[{\"option_id\":1,\"option_name\":\"Pin\"},{\"option_id\":2,\"option_name\":\"Loaded Gmail\"},{\"option_id\":3,\"option_name\":\"Recharge Service\"}]},{\"region_id\":2,\"region_name\":\"India Region\"},{\"region_id\":3,\"region_name\":\"Korea Region\"},{\"region_id\":4,\"region_name\":\"Australia Region\"}]', 1, '2020-12-06 00:02:55'),
(7, 'Amazon Gift Cards', 25, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to buy gift cards for Amazon.de (Germany), Amazon.fr (France), Amazon.it (Italy), Amazon.es (Spain), Amazon.nl (The Netherlands) and more!  After selecting an amount of prepaid credit, be sure to select the correct country/region in the drop-down menu. Then get the code and start shopping with secure prepaid credit!', 'uploads/amazon-200w.webp', '', 1, NULL, 1, '2020-12-06 00:02:55'),
(8, 'Google Play Gift Card', 25, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to buy gift cards for Amazon.de (Germany), Amazon.fr (France), Amazon.it (Italy), Amazon.es (Spain), Amazon.nl (The Netherlands) and more!  After selecting an amount of prepaid credit, be sure to select the correct country/region in the drop-down menu. Then get the code and start shopping with secure prepaid credit!', 'uploads/google-play-340w.webp', '', 2, '[{\"region_id\":1,\"region_name\":\"USA Region\",\"region_options\":[{\"option_id\":1,\"option_name\":\"Pin\"},{\"option_id\":2,\"option_name\":\"Loaded Gmail\"},{\"option_id\":3,\"option_name\":\"Recharge Service\"}]},{\"region_id\":2,\"region_name\":\"India Region\"},{\"region_id\":3,\"region_name\":\"Korea Region\"},{\"region_id\":4,\"region_name\":\"Australia Region\"}]', 1, '2020-12-06 00:02:55'),
(9, 'Test gift card', 50, 'Amazon has different stores in each country that operate independently. Gift cards are country-specific too, so make sure to choose the right country for your gift card! An Amazon.com (United States) Gift Card, for example, will not be accepted on Amazon.co.uk (United Kingdom). So make sure you know which web shop you want to buy from. You can choose to', 'uploads/b868c6878b8b8becd64874437feec3d7shell-oils-lubricants-header.jpeg', NULL, 2, '[{\"region_id\":\"1\",\"region_name\":\"USA Region\",\"region_options\":[{\"option_id\":\"1\",\"option_name\":\"Pin\"},{\"option_id\":\"2\",\"option_name\":\"Loaded Gmail\"}]},{\"region_id\":\"2\",\"region_name\":\"India Region\",\"region_options\":[{\"option_id\":\"2\",\"option_name\":\"Loaded Gmail\"}]}]', 2, '2021-01-12 20:50:02'),
(12, 'Test', 100, 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/2b64ab64ca244260719ca7b74b7b2ec1e503148cf1bd3af800e322ccb91e3c5f20L-ROCK-DRILL-100-460.png', NULL, 2, '[{\"region_id\":\"3\",\"region_name\":\"Korea Region\",\"region_options\":[{\"option_id\":\"2\",\"option_name\":\"Loaded Gmail\"},{\"option_id\":\"3\",\"option_name\":\"Recharge Service\"}]},{\"region_id\":\"4\",\"region_name\":\"Australia Region\",\"region_options\":[{\"option_id\":\"1\",\"option_name\":\"Pin\"}]}]', 1, '2021-01-12 21:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `gift_card_orders`
--

CREATE TABLE `gift_card_orders` (
  `id` int(11) NOT NULL,
  `user_ip` varchar(50) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `gift_card_id` int(11) DEFAULT NULL,
  `card_type_id` int(11) DEFAULT NULL,
  `card_option_id` int(11) DEFAULT NULL,
  `bkash_number` varchar(20) DEFAULT NULL,
  `bkash_transaction_id` varchar(50) DEFAULT NULL,
  `order_email` varchar(50) DEFAULT NULL,
  `order_status` int(2) NOT NULL DEFAULT 1 COMMENT '1=pending,2=confirm,3=completed,4=cancel',
  `order_amount` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gift_card_orders`
--

INSERT INTO `gift_card_orders` (`id`, `user_ip`, `order_id`, `gift_card_id`, `card_type_id`, `card_option_id`, `bkash_number`, `bkash_transaction_id`, `order_email`, `order_status`, `order_amount`, `created_at`) VALUES
(2, '::1', '1Gn0tfkC', 7, 0, 0, '11111111111', 'jffh', 'maamun79@gmail.com', 2, 25, '2020-12-30 22:13:56'),
(3, '::1', 'Sm21ccmv', 7, 0, 0, '12345678910', 'ghjkj', 'maamun79@gmail.com', 3, 25, '2020-12-31 00:57:06'),
(4, '::1', 'prtMoHkf', 7, 0, 0, '12345678910', 'bvy', 'maamun79@gmail.com', 1, 25, '2020-12-31 01:11:20'),
(5, '::1', 'RCPsyCFi', 7, 0, 0, '12345678901', 'wefd', 'maamun79@gmail.com', 1, 25, '2020-12-31 01:14:07'),
(6, '::1', '6nVv70jY', 7, 0, 0, '01676707067', 'sac', 'maamun79@gmail.com', 1, 25, '2020-12-31 01:17:36'),
(7, '::1', 'seoqhhtf', 7, 0, 0, '01676707067', 'zsdd', 'maamun79@gmail.com', 1, 25, '2020-12-31 01:22:50'),
(8, '::1', 'koJ2v3pZ', 8, 1, 1, '12345678910', 'sddddf', 'maamun79@gmail.com', 1, 25, '2021-01-02 12:09:06'),
(9, '::1', '061lmEDU', 8, 1, 2, '01676707067', 'sdf', 'maamun79@gmail.com', 1, 25, '2021-01-03 15:39:39'),
(10, '::1', '7lhTFfhZ', 7, 0, 0, '01676707067', 'dffffffffffr', 'maamun79@gmail.com', 1, 25, '2021-01-03 18:08:13'),
(11, '::1', 'Uuo46c8N', 8, 1, 2, '01676707067', 'sd', 'maamun79@gmail.com', 1, 25, '2021-01-03 18:12:02'),
(12, '::1', 'm8kNUS00', 7, 0, 0, '01676707067', 'sd', 'maamun79@gmail.com', 1, 25, '2021-01-03 18:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `item_redems`
--

CREATE TABLE `item_redems` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active; 2=inactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_redems`
--

INSERT INTO `item_redems` (`id`, `title`, `status`, `created_at`) VALUES
(1, 'Unknown Cash (UC)', 1, '2020-11-30 02:33:10'),
(2, 'Prime Plus Subscription', 1, '2020-11-30 02:33:10'),
(3, 'Regular Top Up', 1, '2020-11-30 02:33:10'),
(4, 'Promo 1', 1, '2020-11-30 02:33:10'),
(5, 'Promo 2', 1, '2020-11-30 02:33:10'),
(6, 'Promo 3', 1, '2020-11-30 02:33:10'),
(7, 'Weekly Membership', 1, '2020-11-30 02:33:10'),
(8, 'Monthly Membership', 1, '2020-11-30 02:33:10'),
(9, 'VIP Membership (Weekly+Monthly)', 1, '2020-11-30 02:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active; 2=inactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Pubg Mobile (Global)', 1, '2020-11-30 02:34:03'),
(2, 'Pubg Mobile (KR)', 1, '2020-11-30 02:34:03'),
(3, 'Diamond', 1, '2020-11-30 02:34:03'),
(4, 'Membership', 1, '2020-11-30 02:34:03'),
(5, 'Airdrop', 1, '2020-11-30 02:34:03'),
(6, 'Event Top Up', 1, '2020-11-30 02:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `mi_admin`
--

CREATE TABLE `mi_admin` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_name` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_verification_code` int(15) NOT NULL,
  `user_password` text DEFAULT NULL,
  `user_salt` text DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_photo` text DEFAULT NULL,
  `user_status` varchar(11) NOT NULL DEFAULT '1' COMMENT '1=Pending; 2=Activated; 3=Deactivated',
  `user_attepts` int(11) DEFAULT 0 COMMENT 'Failed Login attempts. More then 5 will block the user',
  `user_authen_time` datetime DEFAULT NULL COMMENT 'block remove timer',
  `user_last_login` datetime DEFAULT NULL COMMENT 'Login ',
  `user_signed_up` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'User Signup Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_admin`
--

INSERT INTO `mi_admin` (`id`, `role_id`, `user_name`, `user_email`, `user_phone`, `user_verification_code`, `user_password`, `user_salt`, `user_address`, `user_photo`, `user_status`, `user_attepts`, `user_authen_time`, `user_last_login`, `user_signed_up`) VALUES
(10, 6, 'Super Admin', 'admin@gmail.com', '1676707067', 166090, '81dc9bdb52d04dc20036dbd8313ed055', '1234', '1676707067', 'staff-uploads/staff-profile/cf58565961340401add0c2e0fa09cca9IMG20200916161838.jpg', '2', 0, '0000-00-00 00:00:00', '2021-01-14 14:07:18', '2019-08-20 18:05:13'),
(32, 1, 'Rasel Rana', 'rasel@gmail.com', '1744460010', 0, '202cb962ac59075b964b07152d234b70', '123', 'Panthapath, Dhanmondhi, Dhaka, Bangladesh', 'staff-uploads/staff-profile/4a2164392b7502f324d340d9cf88682cIMG20200916162713.jpg', '2', 0, NULL, NULL, '2020-10-07 13:16:40'),
(33, 1, 'Rasel Rana', 'admind@gmail.com', '0174446001', 0, '202cb962ac59075b964b07152d234b70', '123', 'Panthapath, Dhanmondhi, Dhaka, Bangladesh', 'staff-uploads/staff-profile/38489c536ecc39a39615f7fb11d5c574IMG20200916161838.jpg', '2', 0, NULL, NULL, '2020-10-07 13:20:19'),
(34, 1, 'Test1', 'test@m.com', '01742426503', 0, 'e10adc3949ba59abbe56e057f20f883e', '123456', '51/A/1', 'staff-uploads/staff-profile/5bca6fdbdbe5197c6f3725fbc46ff949user.png', '3', 0, NULL, NULL, '2021-01-06 23:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `player_info`
--

CREATE TABLE `player_info` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 1 COMMENT '1=gmail; 2=facebook;',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active; 2=inactive;',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_info`
--

INSERT INTO `player_info` (`id`, `title`, `type`, `status`, `created_at`) VALUES
(1, 'Via Character ID', 1, 1, '2020-11-30 02:34:25'),
(2, 'Via Login Info', 1, 1, '2020-11-30 02:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `settings_meta`
--

CREATE TABLE `settings_meta` (
  `id` int(11) NOT NULL,
  `meta_name` varchar(100) DEFAULT NULL,
  `meta_value` text DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings_meta`
--

INSERT INTO `settings_meta` (`id`, `meta_name`, `meta_value`, `type`) VALUES
(3, 'banner_left', 'assets/img/banner/banner-76.jpg', 'banner'),
(4, 'banner_center', 'assets/img/banner/b84e48bfb3acc0cdec7b08fbccf6f450banner-77.jpg', 'banner'),
(5, 'banner_right', 'assets/img/banner/banner-78.jpg', 'banner'),
(6, 'feature_item', '{\"icon\":\"assets/img/icon-img/b0bfd4e853fed204a2d835a1682dd171service-1.png\",\"title\":\"Free Shipping\",\"text\":\"Free shipping on all order\"}', 'feature'),
(7, 'feature_item', '{\"icon\":\"assets/img/icon-img/service-2.png\",\"title\":\"Money Return\",\"text\":\"30 days for free return\"}', 'feature'),
(8, 'feature_item', '{\"icon\":\"assets/img/icon-img/service-3.png\",\"title\":\"Online Support\",\"text\":\"Support 24 hours a day\"}', 'feature'),
(9, 'footer_image', 'assets/img/banner/2c7865658b81ed385b2169c46f476b1abanner-80.jpg', 'footer'),
(10, 'aboutus_img', 'assets/img/icon-img/f2202f037b9d291d50da38f768adb8b1payment.png', 'footer'),
(11, 'aboutus_text', 'We are a team of designers and developers that create \r\nhigh quality Magento, Prestashop, Opencart.', 'footer'),
(12, 'facebook', 'facebook.com', 'social_icon'),
(13, 'twitter', 'twitter.com', 'social_icon'),
(14, 'instagram', 'instagram.com', 'social_icon'),
(15, 'google-plus', 'googleplus.com', 'social_icon'),
(16, 'rss', 'rss.com', 'social_icon'),
(17, 'site_logo', 'assets/img/logo/1cf30baf8eac6a4c8ab9a3c2e8d45f0clogo-4.png', 'nav_front'),
(18, 'newsletter_subscription', NULL, 'footer'),
(19, 'footer_text', 'Copyright © Soft Minion. All Right Reserved.', 'footer'),
(20, 'footer_link', 'softminion.com', 'footer'),
(21, 'contact_info', '<p style=\"line-height: 1;\"><span style=\"color: rgb(33, 37, 41); font-size: 16px; text-align: justify;\"><b>Name :</b> Shairpa Fine Clothing</span></p><p style=\"line-height: 1;\"><span style=\"color: rgb(33, 37, 41); font-size: 16px; text-align: justify;\"><b>Email : </b>info@shairpa.com</span></p><p style=\"line-height: 1;\"><span style=\"color: rgb(33, 37, 41); font-size: 16px; text-align: justify; background-color: rgb(255, 255, 255);\"><b>Phone :</b> +33 (0) 619 055 599</span></p>', 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(5) NOT NULL,
  `image` text DEFAULT NULL,
  `banner_title` varchar(100) DEFAULT NULL,
  `banner_text` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`, `banner_title`, `banner_text`) VALUES
(1, 'assets/img/slider/9089ba98c37381634a7a55126cb1d2bdslider-50.jpg', 'Exclusive Offer -20% Off This Week', 'Toy Story safe for children'),
(2, 'assets/img/slider/slider-51.jpg', 'Exclusive Offer -20% Off This Week', 'Toy Story safe for children');

-- --------------------------------------------------------

--
-- Table structure for table `topup_orders`
--

CREATE TABLE `topup_orders` (
  `id` int(11) NOT NULL,
  `user_ip` varchar(50) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `topup_id` int(11) DEFAULT NULL,
  `item_type_id` int(11) DEFAULT NULL,
  `item_redem_id` int(11) DEFAULT NULL,
  `player_info_id` int(11) DEFAULT NULL,
  `character_id` varchar(100) DEFAULT NULL,
  `character_name` varchar(100) DEFAULT NULL,
  `player_contact_number` varchar(20) DEFAULT NULL,
  `login_info_type` varchar(20) DEFAULT NULL COMMENT '1=facebook,2=google',
  `login_id` varchar(100) DEFAULT NULL,
  `login_password` varchar(100) DEFAULT NULL,
  `login_contact_number` varchar(20) DEFAULT NULL,
  `bkash_number` varchar(20) DEFAULT NULL,
  `bkash_transaction_id` varchar(50) DEFAULT NULL,
  `order_email` varchar(100) DEFAULT NULL,
  `order_status` int(2) NOT NULL DEFAULT 1 COMMENT '1=pending,2=confirm,3=completed,4=cancel',
  `order_amount` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topup_orders`
--

INSERT INTO `topup_orders` (`id`, `user_ip`, `order_id`, `topup_id`, `item_type_id`, `item_redem_id`, `player_info_id`, `character_id`, `character_name`, `player_contact_number`, `login_info_type`, `login_id`, `login_password`, `login_contact_number`, `bkash_number`, `bkash_transaction_id`, `order_email`, `order_status`, `order_amount`, `created_at`) VALUES
(2, '::1', 'xv2pwCrB', 7, 1, 1, 1, '0', 'vfddfg', '6068829238', '', '', '', '', '012456', 'jgfh', 'maamun79@gmail.com', 2, 100, '2020-12-30 18:55:48'),
(3, '::1', 'oZQ7P41f', 8, 3, 3, 2, '', '', '', 'facebook', 'wedeef', 'ssssssse', '6068829238', '01676707067', 'zsddddd', 'maamun79@gmail.com', 1, 100, '2020-12-31 01:20:59'),
(4, '::1', 'deOKE479', 8, 3, 3, 2, '', '', '', 'google', 'sedrf', 'weeeeedf', '6068829238', '01676707067', 'sssc', 'maamun79@gmail.com', 1, 100, '2020-12-31 01:47:42'),
(5, '::1', 'wCT8s94P', 7, 1, 1, 1, 'sdfv', 'dsv', '6068829238', '', '', '', '', '11111111111', 'dfvv', 'maamun79@gmail.com', 1, 100, '2021-01-02 13:37:48'),
(6, '::1', 'MjTTqQtX', 7, 2, 1, 2, 'sdfv', 'dsv', '6068829238', 'facebook', 'sddf', 'sdddde', '6068829238', '11111111111', 'dfvv', 'maamun79@gmail.com', 1, 50, '2021-01-02 13:38:49'),
(7, '::1', 'hURYY0dR', 8, 3, 3, 2, '', '', '', 'facebook', 'jfhgf', 'hgv', '6068829238', '01676707067', 'ase', 'maamun79@gmail.com', 1, 100, '2021-01-03 01:50:23'),
(8, '::1', 'uRqPXcZq', 7, 2, 1, 2, '', '', '', 'facebook', 'sddddf', 'sdddd', '6068829238', '11111111111', 'sddd', 'maamun79@gmail.com', 1, 50, '2021-01-03 12:19:12'),
(9, '::1', 'goKg5VII', 7, 1, 1, 1, 'xcccc', 'dsd', '6068829238', '', '', '', '', '11111111111', 'sde', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:21:54'),
(10, '::1', 'kA6wUHxT', 7, 1, 1, 1, 'gfdc', 'bgf', '6068829238', '', '', '', '', '11111111111', 'fdg', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:24:40'),
(11, '::1', 'KmTpYvpT', 7, 1, 1, 1, 'gfdc', 'bgf', '6068829238', '', '', '', '', '11111111111', 'fdg', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:24:55'),
(12, '::1', 'j8zfXOR2', 7, 1, 1, 1, 'rtt', 'rvtt', '6068829238', '', '', '', '', '12345678901', 'eff', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:25:45'),
(13, '::1', '6eGWajGn', 7, 1, 1, 2, '', '', '', 'facebook', 'sdf', 'dff', '6068829238', '22222222222', 'wer', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:30:15'),
(14, '::1', 'yFkx3M1w', 7, 1, 1, 2, '', '', '', 'facebook', 'sdf', 'dff', '6068829238', '22222222222', 'wer', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:34:33'),
(15, '::1', 'xdovf2sZ', 7, 1, 1, 2, '', '', '', 'facebook', 'sdf', 'dff', '6068829238', '22222222222', 'wer', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:35:02'),
(16, '::1', 'cKWmJJLy', 7, 1, 1, 2, '', '', '', 'facebook', 'sdf', 'dff', '6068829238', '22222222222', 'wer', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:35:23'),
(17, '::1', '2Lg9vQ5n', 7, 1, 1, 2, '', '', '', 'facebook', 'sdf', 'dff', '6068829238', '22222222222', 'wer', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:36:13'),
(18, '::1', 'bT0lWvPV', 7, 1, 1, 2, '', '', '', 'facebook', 'sdf', 'dff', '6068829238', '22222222222', 'wer', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:36:55'),
(19, '::1', 'UPWedQUn', 7, 1, 1, 2, '', '', '', 'facebook', 'sdf', 'dff', '6068829238', '22222222222', 'wer', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:37:21'),
(20, '::1', '23AvE71P', 7, 1, 1, 1, 'sd', 'sdd', '6068829238', '', '', '', '', '11111111111', 'dff', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:38:21'),
(21, '::1', 'ZzgTJqmb', 7, 2, 1, 2, 'sd', 'sdd', '6068829238', 'facebook', 'sdfd', 'sdd', '6068829238', '11111111111', 'dff', 'maamun79@gmail.com', 1, 50, '2021-01-03 12:40:56'),
(22, '::1', 'K7Zdc1PJ', 7, 2, 1, 2, 'sd', 'sdd', '6068829238', 'facebook', 'sdfd', 'sdd', '6068829238', '11111111111', 'dff', 'maamun79@gmail.com', 1, 50, '2021-01-03 12:42:41'),
(23, '::1', '5NecOIRw', 7, 2, 1, 2, 'sd', 'sdd', '6068829238', 'facebook', 'sdfd', 'sdd', '6068829238', '11111111111', 'dff', 'maamun79@gmail.com', 1, 50, '2021-01-03 12:43:01'),
(24, '::1', 'D4eHB9NR', 7, 1, 1, 1, 'gdh', 'gdc', '6068829238', '', '', '', '', '01676707067', 'ghd', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:44:30'),
(25, '::1', 'lyXshMtW', 7, 1, 1, 1, 'gdh', 'gdc', '6068829238', '', '', '', '', '01676707067', 'ghd', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:46:17'),
(26, '::1', '4eKLr4Sf', 7, 1, 1, 1, 'gdh', 'gdc', '6068829238', '', '', '', '', '01676707067', 'ghd', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:47:55'),
(27, '::1', 'KpC9GLyy', 7, 1, 1, 1, 'ddf', 'df', '6068829238', '', '', '', '', '01676707067', 'err', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:51:40'),
(28, '::1', 'gJnX9zSD', 8, 3, 3, 2, '', '', '', 'google', 'gghd', 'fdg', '6068829238', '01676707067', 'vfd', 'maamun79@gmail.com', 1, 100, '2021-01-03 12:59:06'),
(29, '::1', '0aunrXEt', 7, 1, 1, 1, 'sdff', 'maamun', '6068829238', '', '', '', '', '01676707067', 'asd', 'maamun79@gmail.com', 1, 100, '2021-01-03 13:27:06'),
(30, '::1', 'uWNRpuw7', 7, 2, 1, 2, 'sdff', 'maamun', '6068829238', 'facebook', 'sdf', 'sdff', '6068829238', '01676707067', 'asd', 'maamun79@gmail.com', 1, 50, '2021-01-03 13:30:19'),
(31, '::1', 'MgtXIxp4', 7, 1, 1, 2, '', '', '', 'facebook', 'sdf', 'dff', '6068829238', '01676707067', 'Ass', 'maamun79@gmail.com', 1, 100, '2021-01-03 13:32:22'),
(32, '::1', 'D1ught4B', 7, 1, 1, 1, 'wer', 'erfrf', '6068829238', '', '', '', '', '01676707067', 'asdd', 'maamun79@gmail.com', 1, 100, '2021-01-03 13:34:44'),
(33, '::1', 'wZzGNv3U', 7, 1, 1, 1, 'sdds', 'cffd', '6068829238', '', '', '', '', '01676707067', 'dfff', 'maamun79@gmail.com', 1, 100, '2021-01-03 13:38:51'),
(34, '::1', 'sih3mwc3', 7, 1, 1, 1, 'cjhj', 'dff', '6068829238', '', '', '', '', '01676707067', 'ddd', 'maamun79@gmail.com', 1, 100, '2021-01-03 13:41:10'),
(35, '::1', '0MpGYi8H', 7, 1, 1, 1, 'dsf', 'dfv', '6068829238', '', '', '', '', '01676707067', 'sdf', 'maamun79@gmail.com', 1, 100, '2021-01-03 13:42:45'),
(36, '::1', 'oPS371N7', 7, 1, 1, 1, 'dfgf', 'gfg', '6068829238', '', '', '', '', '01676707067', 'dr', 'maamun79@gmail.com', 1, 100, '2021-01-03 13:47:13'),
(37, '::1', 'lXMYs96R', 7, 1, 1, 2, '', '', '', 'google', 'sdff', 'fdvf', '6068829238', '01676707067', 'sdfr', 'maamun79@gmail.com', 1, 100, '2021-01-03 14:30:28'),
(38, '::1', '1UYiiiiD', 7, 1, 2, 0, '', '', '', '', '', '', '', '01676707067', 'sdr', 'maamun79@gmail.com', 1, 100, '2021-01-03 14:36:04'),
(39, '::1', 'YKoBCO2H', 7, 2, 1, 2, '', '', '', 'google', 'dfv', 'dfv', '6068829238', '01676707067', 'sdffr', 'maamun79@gmail.com', 1, 50, '2021-01-03 18:20:53'),
(40, '::1', 'FqwuQK2S', 8, 6, 3, 0, '', '', '', '', '', '', '', '01676707067', 'sd', 'maamun79@gmail.com', 1, 50, '2021-01-03 18:23:28'),
(41, '::1', 'H7406puu', 8, 6, 0, 0, '', '', '', '', '', '', '', '01676707067', 'sdd', 'maamun79@gmail.com', 1, 50, '2021-01-03 21:30:08'),
(42, '::1', '2StJqOyj', 8, 3, 3, 2, '', '', '', 'facebook', 'sdfv', '123', '01742426503', '01676707067', 'asddd', 'misujon58262@gmail.com', 1, 100, '2021-01-14 14:16:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `topup_management` int(1) DEFAULT NULL,
  `card_management` int(1) DEFAULT NULL,
  `currency_management` int(1) DEFAULT NULL,
  `orders` int(11) DEFAULT NULL,
  `user_management` int(11) DEFAULT NULL,
  `settings` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL COMMENT '1=active\r\n2=deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`, `topup_management`, `card_management`, `currency_management`, `orders`, `user_management`, `settings`, `status`) VALUES
(1, 'Manager', 1, 0, NULL, 0, 1, 0, '1'),
(6, 'Admin', 1, 1, 1, 1, 1, 1, '1'),
(7, 'Test', 1, 1, 1, 1, 1, 0, '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_options`
--
ALTER TABLE `card_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_types`
--
ALTER TABLE `card_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_request`
--
ALTER TABLE `contact_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_orders`
--
ALTER TABLE `currency_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchanger`
--
ALTER TABLE `exchanger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_topup`
--
ALTER TABLE `game_topup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_cards`
--
ALTER TABLE `gift_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_card_orders`
--
ALTER TABLE `gift_card_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_redems`
--
ALTER TABLE `item_redems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_admin`
--
ALTER TABLE `mi_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `player_info`
--
ALTER TABLE `player_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_meta`
--
ALTER TABLE `settings_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topup_orders`
--
ALTER TABLE `topup_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_options`
--
ALTER TABLE `card_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `card_types`
--
ALTER TABLE `card_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_request`
--
ALTER TABLE `contact_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currency_orders`
--
ALTER TABLE `currency_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exchanger`
--
ALTER TABLE `exchanger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `game_topup`
--
ALTER TABLE `game_topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gift_cards`
--
ALTER TABLE `gift_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gift_card_orders`
--
ALTER TABLE `gift_card_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item_redems`
--
ALTER TABLE `item_redems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mi_admin`
--
ALTER TABLE `mi_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `player_info`
--
ALTER TABLE `player_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings_meta`
--
ALTER TABLE `settings_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topup_orders`
--
ALTER TABLE `topup_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
