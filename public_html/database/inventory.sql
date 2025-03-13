-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 03:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `bid` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`bid`, `brand_name`, `status`) VALUES
(1, 'Test1', '1'),
(3, 'Test 2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `parent_cat`, `category_name`, `status`) VALUES
(1, 0, 'Electronics', '1'),
(4, 0, 'Gadgets', '1'),
(33, 1, 'test11222222333', '1'),
(40, 33, 'Sample', '1'),
(45, 0, 'Drug', '1'),
(46, 0, 'Medical Supply', '1'),
(48, 0, 'Soap', '1'),
(49, 48, 'Grocery', '1'),
(50, 0, 'af', '1'),
(52, 0, 'sample sample', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sub_total` double NOT NULL,
  `vatable_sales` decimal(10,2) NOT NULL,
  `vat` double NOT NULL,
  `discount` varchar(10) NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `customer_name`, `order_date`, `sub_total`, `vatable_sales`, `vat`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES
(256, '#00001', '2024-09-18 03:39:00', 1000, 0.00, 120, '0', 1120, 1200, 80, 'Cash'),
(257, '#00001', '2024-09-18 03:43:00', 1000, 0.00, 120, '0', 1120, 1200, 80, 'Cash'),
(258, '#00001', '2024-09-19 04:01:00', 40, 35.71, 4.29, '0', 40, 40, 0, 'Cash'),
(259, '#00001', '2024-09-19 04:08:00', 20, 17.86, 2.14, '0', 20, 20, 0, 'Cash'),
(260, '#00001', '2024-09-19 04:08:00', 10.5, 9.37, 1.12, '0', 10.5, 10.5, 0, 'Cash'),
(261, '#00001', '2024-09-19 04:10:00', 2232.5, 1993.30, 239.2, '0', 2232.5, 2300, 67.5, 'Cash'),
(262, '#00001', '2024-09-19 04:28:00', 2000, 1785.71, 214.29, '0', 2000, 2000, 0, 'Cash'),
(263, '#00001', '2024-09-19 04:31:00', 20, 17.86, 2.14, '0', 20, 20, 0, 'Cash'),
(264, '#00001', '2024-09-19 05:03:00', 5000, 4464.29, 535.71, '0', 5000, 5000, 0, 'Cash'),
(265, '#00001', '2024-09-19 05:04:00', 210, 187.50, 22.5, '0', 210, 189, -21, 'Cash'),
(266, '#00001', '2024-09-19 05:12:00', 12000, 10714.29, 1285.71, '0', 12000, 12000, 0, 'Cash'),
(267, '#00001', '2024-09-19 05:14:00', 10.5, 9.37, 1.12, '10', 10.5, 10.5, 0, 'Cash'),
(268, '#00001', '2024-09-19 05:27:00', 2000, 1785.71, 214.29, '0', 2000, 2000, 0, 'Cash'),
(269, '#00001', '2024-09-19 05:29:00', 1000, 892.86, 107.14, '20', 1000, 1000, 0, 'Cash'),
(270, '#00001', '2024-09-19 05:35:00', 1000, 892.86, 107.14, '20', 1000, 1000, 0, 'Cash'),
(271, '#00001', '2024-09-19 05:42:00', 1000, 892.86, 107.14, '20', 1000, 1000, -0, 'Cash'),
(272, '#00001', '2024-09-19 05:42:00', 202, 180.36, 21.64, '20', 202, 202, 0, 'Cash'),
(273, '#00001', '2024-09-19 21:59:00', 2000, 1785.71, 214.29, '0', 2000, 2000, 0, 'Cash'),
(274, '#00001', '2024-09-19 22:16:00', 1000, 892.86, 107.14, '20', 800, 800, 0, 'Cash'),
(275, '#00001', '2024-09-19 22:17:00', 2000, 1785.71, 214.29, '20', 1600, 1600, 0, 'Cash'),
(276, '#00001', '2024-09-19 22:23:00', 1000, 892.86, 107.14, '20', 800, 800, 0, 'Cash'),
(277, '#00001', '2024-09-19 22:25:00', 1000, 892.86, 107.14, '20', 800, 800, 0, 'Cash'),
(278, '#00001', '2024-09-19 23:27:00', 1212.5, 1082.59, 129.91, '20', 970, 970, 0, 'Cash'),
(279, '#00001', '2024-09-19 23:33:00', 2000, 1785.71, 214.29, '20', 1600, 1600, 0, 'Cash'),
(280, '#00001', '2024-09-19 23:37:00', 1000, 892.86, 107.14, '20', 800, 800, 0, 'Cash'),
(281, '#00001', '2024-09-19 23:45:00', 1000, 892.86, 107.14, '0', 1000, 800, -200, 'Cash'),
(282, '#00001', '2024-09-19 23:46:00', 20, 17.86, 2.14, '20', 16, 16, 0, 'Cash'),
(283, '#00001', '2024-09-20 04:41:00', 1000, 892.86, 107.14, '20', 800, 800, 0, 'Cash'),
(284, '#00001', '2024-09-20 04:41:00', 1000, 892.86, 107.14, '20', 800, 800, 0, 'Cash'),
(285, '#00001', '2024-09-20 04:42:00', 1020, 910.71, 109.29, '0', 1020, 1020, 0, 'Cash'),
(286, '#00001', '2024-09-20 05:17:00', 2000, 1785.71, 214.29, '20', 1600, 1600, 0, 'Cash'),
(287, '#00001', '2024-09-20 05:18:00', 2000, 1785.71, 214.29, '20', 1600, 1600, 0, 'Cash'),
(288, '#00001', '2024-09-20 05:19:00', 2000, 1785.71, 214.29, '20', 1600, 1600, 0, 'Cash'),
(289, '#00001', '2024-09-20 06:39:00', 2310, 2062.50, 247.5, '20', 1848, 2000, 152, 'Cash'),
(290, '#00001', '2024-09-20 06:43:00', 338, 301.79, 36.21, '0', 338, 1000, 662, 'Cash'),
(291, '', '2024-09-20 23:47:00', 5000, 4464.29, 535.71, '20', 4000, 4000, 0, 'Cash'),
(292, '', '2024-09-21 00:06:00', 3358, 2998.21, 359.79, '20', 2686.4, 3000, 313.6, 'Cash'),
(293, '', '2024-09-21 01:10:00', 2848, 2542.86, 305.14, '20', 2278.4, 2500, 221.6, 'Cash'),
(294, '', '2024-09-23 00:26:00', 7040, 6285.71, 754.29, '20', 5632, 6000, 368, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(235, 256, 'Thermometer', 1000, 1),
(236, 257, 'Thermometer', 1000, 1),
(237, 258, 'Safeguard', 20, 2),
(238, 259, 'Safeguard', 20, 1),
(239, 260, 'Biogesics', 10.5, 1),
(240, 261, 'Thermometer', 1000, 1),
(241, 261, 'Biogesics', 10.5, 1),
(242, 261, 'test product11', 202, 1),
(243, 261, 'Sample Product', 1000, 1),
(244, 261, 'Safeguard', 20, 1),
(245, 262, 'Thermometer', 1000, 2),
(246, 263, 'Safeguard', 20, 1),
(247, 264, 'Thermometer', 1000, 5),
(248, 265, 'Biogesics', 10.5, 20),
(249, 266, 'Thermometer', 1000, 12),
(250, 267, 'Biogesics', 10.5, 1),
(251, 268, 'Thermometer', 1000, 2),
(252, 269, 'Thermometer', 1000, 1),
(253, 270, 'Thermometer', 1000, 1),
(254, 271, 'Thermometer', 1000, 1),
(255, 272, 'test product11', 202, 1),
(256, 273, 'Thermometer', 1000, 2),
(257, 274, 'Thermometer', 1000, 1),
(258, 275, 'Thermometer', 1000, 2),
(259, 276, 'Thermometer', 1000, 1),
(260, 277, 'Thermometer', 1000, 1),
(261, 278, 'Thermometer', 1000, 1),
(262, 278, 'Biogesics', 10.5, 1),
(263, 278, 'test product11', 202, 1),
(264, 279, 'Thermometer', 1000, 2),
(265, 280, 'Thermometer', 1000, 1),
(266, 281, 'Sample Product', 1000, 1),
(267, 282, 'Safeguard', 20, 1),
(268, 283, 'Thermometer', 1000, 1),
(269, 284, 'Thermometer', 1000, 1),
(270, 285, 'Thermometer', 1000, 1),
(271, 285, 'Safeguard', 20, 1),
(272, 286, 'Thermometer', 1000, 2),
(273, 287, 'Thermometer', 1000, 2),
(274, 288, 'Thermometer', 1000, 2),
(275, 289, 'Thermometer', 1000, 2),
(276, 289, 'Safeguard', 20, 5),
(277, 289, 'Biogesics', 10.5, 20),
(278, 290, 'Purified Water', 20, 1),
(279, 290, 'Kimbob', 159, 2),
(280, 291, 'Thermometer', 1000, 5),
(281, 292, 'Thermometer', 1000, 3),
(282, 292, 'Safeguard', 20, 1),
(283, 292, 'Kimbob', 159, 2),
(284, 292, 'Purified Water', 20, 1),
(285, 293, 'Thermometer', 1000, 2),
(286, 293, 'Safeguard', 20, 1),
(287, 293, 'Purified Water', 20, 1),
(288, 293, 'test product11', 202, 4),
(289, 294, 'this is a test 2', 1000, 2),
(290, 294, 'Thermometer', 1000, 5),
(291, 294, 'Safeguard', 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double NOT NULL,
  `product_stock` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `p_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES
(1, 45, 1, 'Biogesic', 10.5, 37, '2024-09-20', '1'),
(6, 46, 3, 'Thermometer', 1000, 424, '2024-09-18', '1'),
(8, 49, 1, 'Safeguard', 20, 4, '2024-09-13', '1'),
(9, 49, 3, 'test product11', 202, 11, '2024-09-13', '1'),
(10, 45, 3, 'Sample Product', 1000, 24, '2024-09-13', '1'),
(12, 49, 1, 'Purified Water', 20, 97, '2024-09-20', '1'),
(14, 52, 3, 'this is a test', 1000, 500, '2024-09-20', '1'),
(15, 1, 1, 'this is a test 2', 1000, 498, '2024-09-20', '1'),
(16, 40, 1, 'brrr', 100, 200, '2024-09-20', '1'),
(17, 46, 1, 'sdfdsg', 202, 200, '2024-09-20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `user_type` enum('Admin','Other') NOT NULL,
  `register_date` date NOT NULL,
  `last_login` datetime NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `user_type`, `register_date`, `last_login`, `notes`) VALUES
(10, 'armel', 'armelsesdoyro2612@gmail.com', '$2y$08$2aETpL75Jv62T01NOZgwTuIbVwqInJVqyFMi.ntfPRLNF6h/Ms/JW', 'Admin', '2024-09-10', '2024-09-25 08:09:20', ''),
(16, 'sample', 'sample@gmail.com', '$2y$08$Z9.f/uXcqLJr.aM.jrdqj.EsWRdCfsEwNBFda/lgUH9MT9ls95vMa', 'Admin', '2024-09-25', '2024-09-25 00:00:00', ''),
(17, 'test_test', 'testing12345@gmail.com', '$2y$08$i/pxF3axqsEV4rsTVY/FkeKEPEquuDwcm9nWfk776Wtc69hNsznOq', '', '2024-09-25', '2024-09-25 00:00:00', ''),
(18, 'dgfdhsfgg', 'joms@gmail.com', '$2y$08$UsNsb20eS98tupoLuSyadOz3lk1jJK9nVSxX8GM2YaswRO1wbWCVi', '', '2024-09-25', '2024-09-25 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `product_name` (`product_name`,`bid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `categories` (`cid`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `brands` (`bid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
