-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2022 at 06:47 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gcb_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE IF NOT EXISTS `banks` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(80) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`) VALUES
(1, 'ABSA Bank'),
(2, 'Ecobank');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Kitchen Appliances'),
(2, 'Fashion'),
(3, 'Laptops');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(15) NOT NULL,
  `account_firstname` varchar(70) NOT NULL,
  `account_lastname` varchar(70) NOT NULL,
  `account_balance` varchar(20) NOT NULL DEFAULT '0',
  `phone_number` varchar(40) DEFAULT NULL,
  `email_address` varchar(40) NOT NULL,
  `account_password` varchar(500) NOT NULL,
  `isBank` varchar(10) NOT NULL DEFAULT 'no',
  `api_key` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `account_number`, `account_firstname`, `account_lastname`, `account_balance`, `phone_number`, `email_address`, `account_password`, `isBank`, `api_key`) VALUES
(1, '151100000100', 'ENOS', 'JERON DONKOR', '6520', '0245775507', 'enosjeron@gmail.com', 'admin', 'no', ''),
(2, '101111334401', 'JOEL', 'AMANNOR-KONADU', '6922', '0244667032', 'amannorjoel@gmail.com', 'admin', 'no', ''),
(3, '1000000000', 'GCB', 'ECOMMERCE', '117176', '0300000000', 'gcbltd@gcbltd.com', 'admin', 'no', ''),
(4, '112233445566', 'Abena', 'Admoah', '0', NULL, 'anormah@gmail.com', 'admin', 'no', '$2y$10$PCImotX5DY4JMyJGlssKUegz3/FfCDW2fci.Im8ufvdBr7IZxNMsK'),
(5, '112233445566', 'Felix', 'Osei', '0', NULL, 'felixosei@gmail.com', '123456', 'no', '$2y$10$QJ9EIZSlXW9BtRbGDf9tQ.kb6Ymhcb4z8Wt2/2kkJF2kEe1xVL3uu');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `item_description` varchar(120) NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `item_price` varchar(20) NOT NULL,
  `item_discount` varchar(10) NOT NULL,
  `date_created` varchar(30) NOT NULL,
  `item_image` varchar(50) NOT NULL,
  `on_promo` varchar(10) NOT NULL DEFAULT 'no',
  `tab_section` varchar(30) NOT NULL DEFAULT 'New Arrival',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_description`, `item_category`, `item_price`, `item_discount`, `date_created`, `item_image`, `on_promo`, `tab_section`) VALUES
(1, 'Cooking Knife', 'chccxhff', 'Kitchen Appliances', '90', '2', '12-12-2002', '', 'no', 'New Arrival'),
(2, 'Drone Precision 3056', 'chccxhff', 'Laptops', '90', '50', '12-12-2002', '', 'yes', 'New Arrival'),
(3, 'Denim Indian Sweater', 'chccxhff', 'Fashion', '90', '2', '12-12-2002', '', 'yes', 'Best Seller'),
(4, 'Casio Wrist Watch', 'Level 3', 'Fashion', '150', '10', '12-3-2022', '', 'no', 'New Arrival'),
(5, 'Diesel Wrist Watch', 'Level 2', 'Fashion', '250', '10', '12-3-2022', '', 'no', 'New Arrival'),
(6, 'Rolex Wrist Watch', 'Level 1', 'Fashion', '2999', '10', '12-3-2022', '', 'no', 'New Arrival'),
(7, 'Dolce Wrist Watch', 'Level 0', 'Fashion', '1500', '10', '12-3-2022', '', 'no', 'New Arrival'),
(8, 'Gabana Wrist Watch', 'Level 0', 'Fashion', '1599', '10', '12-3-2022', '', 'no', 'New Arrival');

-- --------------------------------------------------------

--
-- Table structure for table `normalised_orders`
--

DROP TABLE IF EXISTS `normalised_orders`;
CREATE TABLE IF NOT EXISTS `normalised_orders` (
  `customer_id` varchar(30) NOT NULL,
  `order_id` varchar(40) NOT NULL,
  `order_date` varchar(20) NOT NULL,
  `item_count` varchar(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `order_status` varchar(10) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `normalised_orders`
--

INSERT INTO `normalised_orders` (`customer_id`, `order_id`, `order_date`, `item_count`, `amount`, `order_status`) VALUES
('2', 'RW75OQWDDB', '05/17/2022', '1', '150', '200'),
('2', '9MLGSEEJWN', '05/17/2022', '1', '90', '200'),
('2', 'E0QRJPSJQA', '05/17/2022', '1', '150', '200'),
('3', 'RWGJIPFVHT', '05/17/2022', '1', '150', '300'),
('2', '6NRVAWOZY9', '05/17/2022', '1', '90', '300'),
('2', '54XJ6VJQTU', '05/17/2022', '1', '150', '300'),
('2', '0FKVH1HPX6', '05/17/2022', '3', '430', '300'),
('2', 'QIVJNLTPOL', '05/17/2022', '2', '180', '300'),
('2', 'WRZGVXF4NF', '05/17/2022', '1', '90', '300'),
('2', 'OSVWK9AG61', '05/17/2022', '3', '430', '300'),
('2', 'LRJPRVVVEJ', '05/17/2022', '2', '400', '300'),
('2', 'U2EVOZ8HRU', '05/17/2022', '2', '3149', '300'),
('2', 'DTYXX8APAR', '05/17/2022', '4', '3489', '300'),
('2', 'Z74QXFPX7G', '05/17/2022', '1', '90', '200'),
('2', 'IYRTBLLZWN', '05/17/2022', '1', '250', '300');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) NOT NULL,
  `item_name` varchar(80) NOT NULL,
  `item_quantity` varchar(10) NOT NULL,
  `item_price` varchar(30) NOT NULL,
  `sub_total` varchar(40) NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=250 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `item_name`, `item_quantity`, `item_price`, `sub_total`, `customer_id`) VALUES
(247, 'DTYXX8APAR', 'Casio Wrist Watch', '1', '150', '150', '2'),
(248, 'DTYXX8APAR', 'Drone Precision 3056', '1', '90', '90', '2'),
(249, 'IYRTBLLZWN', 'Diesel Wrist Watch', '1', '250', '250', '2'),
(243, 'RW75OQWDDB', 'Casio Wrist Watch', '1', '150', '150', '2'),
(244, 'Z74QXFPX7G', 'Cooking Knife', '1', '90', '90', '2'),
(231, 'OSVWK9AG61', 'Diesel Wrist Watch', '1', '250', '250', '2'),
(232, 'WRZGVXF4NF', 'Cooking Knife', '1', '90', '90', '2'),
(233, 'QIVJNLTPOL', 'Cooking Knife', '1', '90', '90', '2'),
(234, 'QIVJNLTPOL', 'Drone Precision 3056', '1', '90', '90', '2'),
(235, '0FKVH1HPX6', 'Drone Precision 3056', '1', '90', '90', '2'),
(236, '0FKVH1HPX6', 'Cooking Knife', '1', '90', '90', '2'),
(237, '0FKVH1HPX6', 'Diesel Wrist Watch', '1', '250', '250', '2'),
(238, '54XJ6VJQTU', 'Casio Wrist Watch', '1', '150', '150', '2'),
(239, '6NRVAWOZY9', 'Cooking Knife', '1', '90', '90', '2'),
(240, 'RWGJIPFVHT', 'Casio Wrist Watch', '1', '150', '150', '3'),
(241, 'E0QRJPSJQA', 'Casio Wrist Watch', '1', '150', '150', '2'),
(242, '9MLGSEEJWN', 'Drone Precision 3056', '1', '90', '90', '2'),
(229, 'OSVWK9AG61', 'Drone Precision 3056', '1', '90', '90', '2'),
(230, 'OSVWK9AG61', 'Cooking Knife', '1', '90', '90', '2'),
(228, 'LRJPRVVVEJ', 'Diesel Wrist Watch', '1', '250', '250', '2'),
(227, 'LRJPRVVVEJ', 'Casio Wrist Watch', '1', '150', '150', '2'),
(226, 'U2EVOZ8HRU', 'Rolex Wrist Watch', '1', '2999', '2999', '2'),
(225, 'U2EVOZ8HRU', 'Casio Wrist Watch', '1', '150', '150', '2'),
(245, 'DTYXX8APAR', 'Rolex Wrist Watch', '1', '2999', '2999', '2'),
(246, 'DTYXX8APAR', 'Diesel Wrist Watch', '1', '250', '250', '2');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tsn_type` varchar(40) NOT NULL,
  `tsn_date` varchar(20) NOT NULL,
  `account_number` varchar(15) NOT NULL,
  `to_account_number` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `tsn_status` int(10) NOT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `tsn_type`, `tsn_date`, `account_number`, `to_account_number`, `amount`, `tsn_status`, `order_id`) VALUES
(229, 'Payment', '05/17/2022', '101111334401', '1000000000', '250', 300, 'IYRTBLLZWN'),
(228, 'Payment', '05/17/2022', '12345678910', '1000000000', '3489', 300, 'DTYXX8APAR'),
(227, 'Payment', '05/17/2022', '12345678910', '1000000000', '90', 200, 'Z74QXFPX7G'),
(226, 'Payment', '05/17/2022', '12345678910', '1000000000', '150', 200, 'RW75OQWDDB'),
(225, 'Payment', '05/17/2022', '12345678910', '1000000000', '90', 200, '9MLGSEEJWN'),
(223, 'Payment', '05/17/2022', '1000000000', '1000000000', '150', 300, 'RWGJIPFVHT'),
(224, 'Payment', '05/17/2022', '12345678910', '1000000000', '150', 200, 'E0QRJPSJQA'),
(222, 'Payment', '05/17/2022', '12345678910', '1000000000', '90', 300, '6NRVAWOZY9'),
(221, 'Payment', '05/17/2022', '12345678910', '1000000000', '150', 300, '54XJ6VJQTU'),
(220, 'Payment', '05/17/2022', '112233445566', '1000000000', '430', 300, '0FKVH1HPX6'),
(219, 'Payment', '05/17/2022', '101111334401', '1000000000', '180', 300, 'QIVJNLTPOL'),
(216, 'Payment', '05/17/2022', '101111334401', '1000000000', '400', 300, 'LRJPRVVVEJ'),
(215, 'Payment', '05/17/2022', '12345678910', '1000000000', '3149', 300, 'U2EVOZ8HRU'),
(214, 'Payment', '05/17/2022', '12345678910', '1000000000', '240', 300, '9B5X0LEOSS'),
(218, 'Payment', '05/17/2022', '101111334401', '1000000000', '90', 300, 'WRZGVXF4NF'),
(217, 'Payment', '05/17/2022', '101111334401', '1000000000', '430', 300, 'OSVWK9AG61');

-- --------------------------------------------------------

--
-- Table structure for table `valid_cards`
--

DROP TABLE IF EXISTS `valid_cards`;
CREATE TABLE IF NOT EXISTS `valid_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(20) NOT NULL,
  `card_acc_name` varchar(70) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `card_expiry` varchar(20) NOT NULL,
  `card_cvv` varchar(10) NOT NULL,
  `card_balance` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `valid_cards`
--

INSERT INTO `valid_cards` (`id`, `bank_id`, `card_acc_name`, `card_number`, `card_expiry`, `card_cvv`, `card_balance`) VALUES
(1, 1, 'BENEDICT BENEDICT', '112233445566', '12/25', '123', '10000'),
(2, 2, 'SALOMEY SALOMEY', '12345678910', '12/24', '321', '6511');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
