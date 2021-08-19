-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2021 at 04:10 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pharmacy_delar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `email`, `password`, `role`, `status`) VALUES
('Abhijit', 'abhijit22@gmail.com', 'admin', 'Admin', 'active'),
('user2', 'user2@gmail.com', 'user2', 'User', 'Active'),
('user', 'user@gmail.com', 'user1', 'User', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(30) NOT NULL AUTO_INCREMENT,
  `cat_id` int(30) NOT NULL,
  `b_name` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`brand_id`,`cat_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `cat_id`, `b_name`, `status`) VALUES
(3, 1, 'A - Pandom - SR', 'Available'),
(4, 1, 'A - Quin', 'Available'),
(5, 4, 'jonshon and jonshon', 'Available'),
(6, 2, 'jonshon and jonshon', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `p_id` int(30) NOT NULL,
  `qty` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`,`email`,`p_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `email`, `p_id`, `qty`, `date`, `time`) VALUES
(2, 'abhijit22@gmail.com', 11, '1', '2021-08-14', '18:34:09'),
(3, 'abhijit22@gmail.com', 12, '2', '2021-08-18', '11:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(30) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `status`) VALUES
(1, 'Drugs', 'Unavailable'),
(2, 'Skin care items', 'Unavailable'),
(3, 'Food and beverages', 'Available'),
(4, 'Personal hygiene', 'Available'),
(5, 'VMS ( vitamins, minerals and supplements)', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `o_id` int(30) NOT NULL AUTO_INCREMENT,
  `billno` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `cl_name` varchar(30) NOT NULL,
  `cl_no` int(30) NOT NULL,
  `p_mt` varchar(30) NOT NULL,
  `place` varchar(30) NOT NULL,
  `s_price` int(30) NOT NULL,
  `c_price` int(30) NOT NULL,
  `profit` int(30) NOT NULL,
  `p_id` int(30) NOT NULL,
  `qty` int(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`o_id`,`billno`,`email`,`p_id`),
  KEY `p_id` (`p_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `billno`, `email`, `cl_name`, `cl_no`, `p_mt`, `place`, `s_price`, `c_price`, `profit`, `p_id`, `qty`, `date`, `time`) VALUES
(4, '2', 'abhijit22@gmail.com', 'baba', 2147483647, 'online', 'out_of_guwahati', 44000, 40000, 4000, 9, 2, '2020-02-06', '21:03:24'),
(6, '3', 'user@gmail.com', 'abhijit das', 2147483647, 'cash', 'guwahati', 44000, 40000, 4000, 9, 2, '2021-02-06', '21:23:50'),
(13, '9', 'user@gmail.com', '', 0, '', '', 1210000, 1100000, 110000, 9, 55, '2021-06-01', '00:20:24'),
(16, '10', 'user@gmail.com', 'Abhijit', 2147483647, 'online', 'out_of_guwahati', 1408000, 1280000, 128000, 9, 64, '2021-08-07', '13:11:28'),
(17, '10', 'user@gmail.com', 'Abhijit', 2147483647, 'online', 'out_of_guwahati', 2046000, 1860000, 186000, 9, 93, '2021-08-08', '18:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `p_id` int(30) NOT NULL AUTO_INCREMENT,
  `brand_id` int(30) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `profit` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`p_id`,`brand_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `brand_id`, `p_name`, `price`, `profit`, `qty`, `image`, `status`) VALUES
(9, 3, 'Naprosyn SR', 20000, 10, 1, 'IMG20210127134939.jpg', 'Available'),
(11, 4, 'Troxip-OD', 15000, 10, 17, 'fdsfedf.jpg', 'Available'),
(12, 3, 'Pan-42', 700, 100, 50000, 'book7.jpeg', 'Available'),
(14, 4, 'peracetamol', 200, 20, 2000, 'book8.jpg', 'Available');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`email`) REFERENCES `admin` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
