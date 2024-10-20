-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2024 at 06:58 PM
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
  `role_id` int(11) NOT NULL,
  `account_status_id` int(11) NOT NULL DEFAULT 1,
  `branch_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`account_id`, `ac_username`, `ac_email`, `ac_password`, `role_id`, `account_status_id`, `branch_id`) VALUES
(1, 'jcdavid', 'jcdavid@gmail.com', '$2y$10$iAp34p.CeIZRqYDlgM.AOuFM7Q2d2uifCpbl14xbsnptXoiRozEqy', 1, 1, 1),
(2, 'golden', 'golden@gmail.com', '$2y$10$92lKJT/9e9JSzuGmEZ1N8.cPldvOQexUuU2k97F5GykS0rP4l5tqq', 1, 1, 1),
(3, 'john erick', 'johnerick@gmail.com', '$2y$10$OZIIZnjXfRrVNX5G389R3.emX0dGaTb35PIQAbOqKhEB6qYWnoAuC', 2, 1, 1),
(4, 'lugo', 'lugo@gmail.com', '$2y$10$m5gg4RhBizZnqOJXR6IFIemRMw/0bex4eY4mxCNpgys2aQDRr.auq', 2, 1, 1),
(6, 'admin', 'admin@gmail.com', '$2y$10$t3.cWIceqWE/cDo9lNYXAuK2fSFiRplX6QHlbuTR8TlGJU1cRtkA6', 2, 1, 1),
(7, 'juan', 'cashier@gmail.com', '$2y$10$oxj3kjSVZEBHBEFS5EkT8OgwTkRezxKytLTgdov6Vs8qhCmOPPe9K', 3, 1, 2),
(8, 'jhyra', 'cashier2@gmail.com', '$2y$10$kxW2vsZVDHzuZg.oHujg7OQUWUrr77JZ9tDMhY1GYojPNliEi3cnC', 3, 1, 1),
(9, 'lugs', 'lugs@gmail.com', '$2y$10$Sgyb8CATbHXkScwxoZmHtOMypd5SCn/fB1jgZ/elykNOe02fN/X0m', 1, 1, 1),
(10, 'user', 'jc.david@gmail.com', '$2y$10$nyGPsjX/.61ru7G2mZBrguQXH4/Kca7Y/T1UYioBVbxmAosIEAMHS', 1, 1, 1);

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
(3, 'John Erick', '', 'Llanita', '09565535401', 'Male', 'Quezon City'),
(4, 'Christian', '', 'Lugo', '09512847442', 'Male', 'Bayan Glori'),
(6, 'Jc', '', 'David', '09565535401', 'Male', 'Bayan Glori'),
(7, 'Juan', '', 'David', '09565535401', 'Male', 'Cielito Caloocan'),
(8, 'jhy', '', 'mariano', '09512847442', 'Female', 'Bayan Glori'),
(9, 'Christian', '', 'Lugo', '09565535401', 'Male', 'Bayan Glori'),
(10, 'Juan Carlo', 'Domingo', 'David', '09565535401', 'Male', 'Montecillo subd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_status`
--

CREATE TABLE `tbl_account_status` (
  `account_status_id` int(11) NOT NULL,
  `account_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account_status`
--

INSERT INTO `tbl_account_status` (`account_status_id`, `account_status`) VALUES
(1, 'Active'),
(2, 'Deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_log`
--

CREATE TABLE `tbl_audit_log` (
  `log_user_id` int(11) DEFAULT NULL,
  `log_username` varchar(50) DEFAULT NULL,
  `log_user_type` varchar(50) DEFAULT NULL,
  `log_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit_log`
--

INSERT INTO `tbl_audit_log` (`log_user_id`, `log_username`, `log_user_type`, `log_date`) VALUES
(6, 'admin', '2', '2024-09-30 10:59:21'),
(6, 'admin', '2', '2024-09-30 11:01:52'),
(6, 'admin', '2', '2024-09-30 12:35:36'),
(1, 'jcdavid', '1', '2024-09-30 12:35:48'),
(6, 'admin', '2', '2024-09-30 12:36:16'),
(6, 'admin', '2', '2024-09-30 12:42:43'),
(1, 'jcdavid', '1', '2024-09-30 13:16:16'),
(1, 'jcdavid', '1', '2024-09-30 13:43:01'),
(1, 'jcdavid', '1', '2024-09-30 13:43:09'),
(6, 'admin', '2', '2024-10-01 10:31:02'),
(6, 'admin', '2', '2024-10-01 10:33:28'),
(8, 'jhyra', '3', '2024-10-01 10:37:55'),
(6, 'admin', '2', '2024-10-01 10:38:36'),
(6, 'admin', '2', '2024-10-06 08:39:35'),
(6, 'admin', '2', '2024-10-06 09:34:25'),
(1, 'jcdavid', '1', '2024-10-06 10:51:44'),
(1, 'jcdavid', '1', '2024-10-20 10:35:02'),
(6, 'admin', '2', '2024-10-20 11:06:07'),
(8, 'jhyra', '3', '2024-10-20 11:07:22'),
(1, 'jcdavid', '1', '2024-10-20 11:13:02'),
(8, 'jhyra', '3', '2024-10-20 11:16:32'),
(1, 'jcdavid', '1', '2024-10-20 11:19:34'),
(8, 'jhyra', '3', '2024-10-20 11:22:04'),
(6, 'admin', '2', '2024-10-20 11:24:31'),
(1, 'jcdavid', '1', '2024-10-20 11:44:22'),
(6, 'admin', '2', '2024-10-20 11:46:02'),
(1, 'jcdavid', '1', '2024-10-20 11:52:35'),
(6, 'admin', '2', '2024-10-20 11:52:48'),
(1, 'jcdavid', '1', '2024-10-20 11:58:33'),
(2, 'golden', '1', '2024-10-20 12:36:39'),
(1, 'jcdavid', '1', '2024-10-20 12:45:03'),
(1, 'jcdavid', '1', '2024-10-20 13:06:57'),
(6, 'admin', '2', '2024-10-20 13:14:25'),
(1, 'jcdavid', '1', '2024-10-20 13:14:50'),
(8, 'jhyra', '3', '2024-10-20 14:04:19'),
(6, 'admin', '2', '2024-10-20 14:21:37'),
(8, 'jhyra', '3', '2024-10-20 14:21:49'),
(6, 'admin', '2', '2024-10-20 14:28:51'),
(8, 'jhyra', '3', '2024-10-20 14:29:22'),
(8, 'jhyra', '3', '2024-10-20 14:30:42'),
(6, 'admin', '2', '2024-10-20 14:44:52'),
(8, 'jhyra', '3', '2024-10-20 14:45:12'),
(6, 'admin', '2', '2024-10-20 15:08:58'),
(7, 'juan', '3', '2024-10-20 15:11:24'),
(7, 'juan', '3', '2024-10-20 15:13:42'),
(6, 'admin', '2', '2024-10-20 15:17:56'),
(8, 'jhyra', '3', '2024-10-20 15:18:47'),
(1, 'jcdavid', '1', '2024-10-20 16:10:03'),
(8, 'jhyra', '3', '2024-10-20 16:10:37'),
(7, 'juan', '3', '2024-10-20 16:35:25'),
(7, 'juan', '3', '2024-10-20 16:36:36'),
(8, 'jhyra', '3', '2024-10-20 16:45:14'),
(7, 'juan', '3', '2024-10-20 16:45:28'),
(6, 'admin', '2', '2024-10-20 16:53:09'),
(7, 'juan', '3', '2024-10-20 16:53:29'),
(6, 'admin', '2', '2024-10-20 16:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_trail`
--

CREATE TABLE `tbl_audit_trail` (
  `trail_user_id` int(11) DEFAULT NULL,
  `trail_username` varchar(50) DEFAULT NULL,
  `trail_activity` varchar(50) DEFAULT NULL,
  `trail_user_type` varchar(50) DEFAULT NULL,
  `trail_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit_trail`
--

INSERT INTO `tbl_audit_trail` (`trail_user_id`, `trail_username`, `trail_activity`, `trail_user_type`, `trail_date`) VALUES
(6, 'admin', 'Updated Product', 'Admin', '2024-09-30 10:52:49'),
(6, 'admin', 'Updated Product', 'Admin', '2024-09-30 10:53:53'),
(6, 'admin', 'Updated Product ID: 2', 'Admin', '2024-09-30 11:04:10'),
(6, 'admin', 'Updated Product ID: 3', 'Admin', '2024-10-20 13:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE `tbl_branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`branch_id`, `branch_name`) VALUES
(1, 'Bagbag'),
(2, 'Sauyo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `item_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qnty` float NOT NULL,
  `order_date` date DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `branch_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`item_id`, `prod_id`, `prod_qnty`, `order_date`, `status_id`, `branch_id`, `account_id`) VALUES
(85, 1, 2.5, '2024-10-20', 3, 2, 1),
(96, 3, 5, '2024-10-20', 3, 2, 1),
(99, 2, 1, '2024-10-20', 2, 2, 2),
(100, 3, 1, '2024-10-20', 2, 1, 8),
(101, 4, 2, '2024-10-20', 2, 2, 7),
(102, 2, 2, '2024-10-20', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_type` int(11) NOT NULL,
  `prod_stocks` float NOT NULL,
  `prod_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`prod_id`, `prod_name`, `prod_price`, `prod_type`, `prod_stocks`, `prod_img`) VALUES
(1, 'Fresh Beef Steak', 370, 1, 38, 'Fresh beefsteak.jpg'),
(2, 'Ground Beef', 360, 1, 38, 'Groundbeef.png'),
(3, 'Roast Beef', 370, 1, 5, 'roastbeef.jpg'),
(4, 'Fresh Pork Chops', 390, 2, 48, 'Freshporkchops.png'),
(5, 'Fresh Pork Ribs', 340, 2, 42, 'Fresh Pork ribs.jpg'),
(6, 'Fresh Bacon', 370, 2, 50, 'freshbacon.jpg'),
(7, 'Pork Ham', 340, 2, 50, 'Pork Ham.png'),
(8, 'Pork Sausage', 310, 2, 50, 'Pork Sausage.jpg'),
(9, 'Chicken Breast', 310, 3, 42.5, 'Chickenbreast.png'),
(10, 'Chicken Thigh', 320, 3, 50, 'Chickenthigh.png'),
(11, 'Chicken Wings', 290, 3, 50, 'chickenwings.png'),
(12, 'Drumsticks', 300, 3, 50, 'drumsticks.png'),
(13, 'One Whole Chicken', 360, 3, 45, '1wholechicken.jpg'),
(14, 'Fresh Lamb Chops', 610, 4, 50, 'Freshlambchops.jpg'),
(15, 'Fresh Lamb Legs', 990, 4, 50, 'freshlamblegs.jpg'),
(16, 'Fresh Salami', 375, 5, 50, 'fresh salami.jpg'),
(17, 'Fresh Pastrami', 315, 5, 49, 'fresh pastrami.jpg'),
(18, 'Roast Beef', 870, 5, 50, 'roastbeef.jpg'),
(19, 'Pork Liempo', 290, 2, 50, 'PorkLiempo.png'),
(20, 'Pork Kasim', 230, 2, 50, 'Porkkasim.png'),
(21, 'Pork Lomo', 210, 2, 50, 'PorkLomo.png');

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
-- Table structure for table `tbl_qr_img`
--

CREATE TABLE `tbl_qr_img` (
  `qr_id` int(11) NOT NULL,
  `qr_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_qr_img`
--

INSERT INTO `tbl_qr_img` (`qr_id`, `qr_img`) VALUES
(1, 'Qr_code.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

CREATE TABLE `tbl_receipt` (
  `receipt_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `receipt_img` varchar(255) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `deposit_amount` int(11) NOT NULL,
  `uploaded_date` date NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`receipt_id`, `account_id`, `receipt_img`, `receipt_number`, `deposit_amount`, `uploaded_date`, `branch_id`) VALUES
(22, 1, '66fa6ba96e5a3.jpeg', '3212313131313', 120, '2024-09-30', 1),
(23, 2, '6714fb451e31a.jpeg', '2131231231321', 1850, '2024-10-20', 1),
(24, 1, '6715020241c7c.jpeg', '3212313131313', 1000, '2024-10-20', 1),
(25, 1, '671502ba6f0da.jpeg', '3212313131313', 400, '2024-10-20', 1),
(26, 1, '67152b6e7562a.jpeg', '3212313131313', 720, '2024-10-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `report_id` int(11) NOT NULL,
  `rp_name` varchar(50) NOT NULL,
  `rp_email` varchar(150) NOT NULL,
  `rp_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reports`
--

INSERT INTO `tbl_reports` (`report_id`, `rp_name`, `rp_email`, `rp_message`) VALUES
(1, 'Jc David', 'jcdavid123c@gmail.com', 'magandaaa'),
(2, 'Jc David', 'jcdavid123c@gmail.com', 'bulok');

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
(4, 'TO CLAIM'),
(5, 'CANCELED');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_activity` varchar(100) NOT NULL,
  `activity_date` date NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`user_id`, `user_name`, `user_type`, `user_activity`, `activity_date`, `branch_id`) VALUES
(8, 'jhyra', '3', 'Claimed item Fresh Beef Steak', '2024-10-01', 1),
(7, 'juan', '3', 'Accept item ', '2024-10-20', 2),
(7, 'juan', '3', 'Claimed items', '2024-10-20', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tbl_account_status`
--
ALTER TABLE `tbl_account_status`
  ADD PRIMARY KEY (`account_status_id`);

--
-- Indexes for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  ADD PRIMARY KEY (`branch_id`);

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
-- Indexes for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`report_id`);

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
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_account_status`
--
ALTER TABLE `tbl_account_status`
  MODIFY `account_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_product_type`
--
ALTER TABLE `tbl_product_type`
  MODIFY `prod_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
