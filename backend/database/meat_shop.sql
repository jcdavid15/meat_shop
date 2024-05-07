-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2024 at 06:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meat_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `account_id` int(11) NOT NULL,
  `ac_username` varchar(255) NOT NULL,
  `ac_email` varchar(255) NOT NULL,
  `ac_password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`account_id`, `ac_username`, `ac_email`, `ac_password`, `role_id`) VALUES
(1, 'jcdavid', 'jcdavid@gmail.com', '$2y$10$RODMoKIV07P52KXrI.nKHuOomcEOTiHvrlZXGH1hXVeZV.zfS5eWG', 1),
(2, 'golden', 'golden@gmail.com', '$2y$10$92lKJT/9e9JSzuGmEZ1N8.cPldvOQexUuU2k97F5GykS0rP4l5tqq', 1),
(3, 'john erick', 'johnerick@gmail.com', '$2y$10$OZIIZnjXfRrVNX5G389R3.emX0dGaTb35PIQAbOqKhEB6qYWnoAuC', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_details`
--

CREATE TABLE `tbl_account_details` (
  `account_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account_details`
--

INSERT INTO `tbl_account_details` (`account_id`, `first_name`, `middle_name`, `last_name`, `contact`, `gender`, `address`) VALUES
(1, 'Jc', 'Domingo', 'David', '09565535401', 'Male', 'Montecillo subd'),
(2, 'Golden', '', 'Miral', '09565535401', 'Male', 'Bayan Glori'),
(3, 'John Erick', '', 'Llanita', '09565535401', 'Male', 'Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `item_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qnty` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`item_id`, `prod_id`, `prod_qnty`, `order_date`, `status_id`, `account_id`) VALUES
(8, 3, 2, '0000-00-00', 1, 1),
(12, 2, 2, '0000-00-00', 1, 1),
(13, 5, 2, '2024-04-05', 4, 1),
(14, 5, 1, '2024-07-05', 2, 1),
(15, 2, 3, '0000-00-00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_type` int(11) NOT NULL,
  `prod_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`prod_id`, `prod_name`, `prod_price`, `prod_type`, `prod_img`) VALUES
(1, 'Fresh Beef Steak', 370, 1, 'img-1.webp'),
(2, 'Ground Beef', 360, 1, 'img-2.jpeg'),
(3, 'Roast Beef', 370, 1, 'img-3.jpeg'),
(4, 'Fresh Pork Chops', 390, 2, 'img-1.jpeg'),
(5, 'Fresh Pork Ribs', 340, 2, 'img-2.jpeg'),
(6, 'Fresh Bacon', 370, 2, 'img-3.jpeg'),
(7, 'Pork Ham', 340, 2, 'img-4.jpeg'),
(8, 'Pork Sausage', 310, 2, 'img-5.jpeg'),
(9, 'Chicken Breast', 310, 3, 'img-1.webp'),
(10, 'Chicken Thigh', 320, 3, 'img-2.jpeg'),
(11, 'Chicken Wings', 290, 3, 'img-3.jpeg'),
(12, 'Drumsticks', 300, 3, 'img-4.jpeg'),
(13, 'One Whole Chicken', 360, 3, 'img-5.webp'),
(14, 'Fresh Lamb Chops', 610, 4, 'img-1.jpeg'),
(15, 'Fresh Lamb Legs', 990, 4, 'img-2.jpeg'),
(16, 'Fresh Salami', 375, 5, 'img-1.jpeg'),
(17, 'Fresh Pastrami', 315, 5, 'img-2.jpeg'),
(18, 'Roast Beef', 870, 5, 'img-3.jpeg'),
(19, 'Pork Liempo', 290, 2, 'img-6.jpeg'),
(20, 'Pork Kasim', 230, 2, 'img-7.jpeg'),
(21, 'Pork Lomo', 210, 2, 'img-8.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_type`
--

CREATE TABLE `tbl_product_type` (
  `prod_type_id` int(11) NOT NULL,
  `prod_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_type`
--

INSERT INTO `tbl_product_type` (`prod_type_id`, `prod_type_name`) VALUES
(1, 'Beef'),
(2, 'Pork'),
(3, 'Chicken'),
(4, 'Lamb'),
(5, 'Deli Meats');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_name`) VALUES
(1, 'PENDING'),
(2, 'CLAIMED'),
(3, 'PROCESS'),
(4, 'TO CLAIM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  ADD PRIMARY KEY (`prod_type_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  MODIFY `prod_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
