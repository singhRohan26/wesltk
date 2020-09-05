-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2020 at 10:39 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_foodx`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `city_id` varchar(20) NOT NULL,
  `state_id` varchar(20) NOT NULL,
  `country_id` varchar(20) NOT NULL,
  `type` enum('Home','Office','Other') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `name`, `address`, `pincode`, `city_id`, `state_id`, `country_id`, `type`, `created_at`) VALUES
(1, 1, 'Rohan', '308-A j&k pocket,dilshad-garden', 110095, 'Delhi', 'Delhi', 'India', 'Home', '2020-08-29 20:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `phone`, `created_at`, `name`) VALUES
(1, 'admin@wesltk.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '8383908866', '2020-08-09 12:00:09', 'Wesltk');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'Active',
  `deleted_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `name`, `status`, `deleted_status`) VALUES
(1, 'American', 'Active', '0'),
(2, 'Bakery', 'Active', '0'),
(3, 'Indian', 'Active', '0'),
(4, 'Biryani', 'Active', '0'),
(5, 'Bengali', 'Active', '0'),
(6, 'Biryani', 'Active', '0'),
(7, 'Cafe', 'Active', '0'),
(8, 'Chinese', 'Active', '0'),
(9, 'Deserts', 'Active', '0'),
(10, 'Fast food', 'Active', '0'),
(11, 'Healty food', 'Active', '0'),
(12, 'Street food', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `admin_product_menu`
--

CREATE TABLE `admin_product_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_product_menu`
--

INSERT INTO `admin_product_menu` (`id`, `name`, `status`, `deleted_status`) VALUES
(2, 'Beauty Product', 'Active', '0'),
(3, 'Frozen food', 'Active', '0'),
(4, 'Groceries', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `admin_service_menu`
--

CREATE TABLE `admin_service_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_service_menu`
--

INSERT INTO `admin_service_menu` (`id`, `name`, `status`, `deleted_status`) VALUES
(1, 'demo', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu_product`
--

CREATE TABLE `menu_product` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `deleted_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_product`
--

INSERT INTO `menu_product` (`id`, `vendor_id`, `name`, `status`, `deleted_status`) VALUES
(1, 1, 'Dal', 'Active', '0'),
(2, 1, 'Mccains', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `menu_restaurant`
--

CREATE TABLE `menu_restaurant` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_restaurant`
--

INSERT INTO `menu_restaurant` (`id`, `vendor_id`, `name`, `status`, `deleted_status`) VALUES
(1, 1, 'Test', 'Active', '1'),
(2, 1, 'Dinner', 'Active', '0'),
(3, 1, 'Lunch', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `menu_servcie`
--

CREATE TABLE `menu_servcie` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('catring','salon') NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_servcie`
--

INSERT INTO `menu_servcie` (`id`, `name`, `type`, `vendor_id`, `status`, `deleted_status`) VALUES
(1, 'test1', 'catring', 1, 'Active', '0'),
(2, 'demo1', 'catring', 1, 'Active', '0'),
(5, 'test_sal1', 'salon', 1, 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `status` enum('Processing','Accepted','Out for delivery','Completed') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `address_id`, `unique_id`, `vendor_id`, `user_id`, `sub_total`, `status`, `created_at`) VALUES
(1, 2, 38516472, 1, 1, 100, 'Processing', '2020-09-03 09:08:44'),
(2, 3, 13287965, 1, 1, 100, 'Processing', '2020-09-03 09:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`id`, `name`, `email`, `phone`, `address`, `date`, `time`) VALUES
(1, 'Ram', 'ram@gmail.com', '7458868452', '', '2020-09-10', '21:09:00'),
(2, 'Ram', 'ram@gmail.com', '7458868452', '', '2020-09-10', '21:09:00'),
(3, 'Ram', 'ram@gmail.com', '2784783478', '', '2020-09-12', '22:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `unique_id`, `product_id`, `qty`, `price`, `created_at`) VALUES
(1, 13287965, 22, 1, 100, '2020-09-03 09:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `heading` text NOT NULL,
  `message` text NOT NULL,
  `page_id` enum('about','term','faq','privacy','help','data_usage') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `heading`, `message`, `page_id`) VALUES
(1, '<font color=\"#000000\"><b>About us</b></font>', '<p open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham ....</p>', 'about'),
(3, '<font color=\"#000000\">FAQ</font>', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham ....</p>', 'faq'),
(4, '<b><font color=\"#000000\">Privacy Policy</font></b>', '<p></p><div style=\"text-align: start;\"><p open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0);\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham ....</p></div>', 'privacy');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `admin_menu_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `admin_product_menu_id` int(11) NOT NULL,
  `menu_product_id` int(11) NOT NULL,
  `admin_service_menu_id` int(11) NOT NULL,
  `service_menu_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` varchar(12) NOT NULL,
  `description` varchar(500) NOT NULL,
  `product_type` enum('Veg','Non-veg') NOT NULL,
  `quantity` int(11) NOT NULL,
  `form_type` enum('food','services','products') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `deleted_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `admin_menu_id`, `menu_id`, `admin_product_menu_id`, `menu_product_id`, `admin_service_menu_id`, `service_menu_id`, `name`, `price`, `description`, `product_type`, `quantity`, `form_type`, `status`, `deleted_status`) VALUES
(2, 1, 2, 0, 0, 0, 0, 'Veg thaali', '150', 'Dal-makhni, 2 chapati , raita , Paneer butter masala, rice, salads', 'Veg', 0, 'food', 'Active', '0'),
(4, 0, 0, 4, 1, 0, 0, 'Masoor daal', '120', 'Masoor dal', 'Veg', 50, 'products', 'Active', '0'),
(7, 1, 1, 0, 0, 0, 0, 'Test', '100', 'Desc', 'Veg', 0, 'food', 'Active', '0'),
(19, 3, 3, 0, 0, 0, 0, 'Chicken Biryani', '450', 'Chicken biryani with boneless chicken served with green chutney and salad', 'Non-veg', 0, 'food', 'Active', '0'),
(20, 8, 2, 0, 0, 0, 0, 'Veg chowmein', '100', 'Spicy Veg chowmein served  with mayonise', 'Veg', 0, 'food', 'Active', '0'),
(21, 0, 0, 4, 2, 0, 0, 'Veggie Nuggets', '120', 'Readymade crispy veg snacks', 'Veg', 10, 'products', 'Active', '0'),
(22, 0, 0, 0, 0, 1, 2, 'Ram', '100', 'Demo', 'Veg', 0, 'services', 'Active', '0'),
(23, 0, 0, 0, 0, 1, 5, '121212', 'Y2IY', 'Demo', 'Veg', 0, 'services', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image`) VALUES
(5, 2, '312.jpg'),
(6, 2, '75.jpg'),
(7, 3, '788.jpg'),
(8, 4, '8290.jpg'),
(9, 5, '8193.jpeg'),
(10, 6, '4145.jpeg'),
(11, 7, '8851.png'),
(12, 8, '2444.png'),
(14, 9, '2013.jpg'),
(15, 10, '8708.jpg'),
(16, 11, '4213.jpg'),
(17, 12, '6862.jpg'),
(18, 13, '6166.jpg'),
(19, 14, '4510.jpg'),
(20, 15, '3585.jpeg'),
(21, 16, '206.jpg'),
(22, 17, '8407.jpg'),
(23, 18, '9389.jpg'),
(24, 19, '5453.jpeg'),
(25, 20, '3813.jpg'),
(26, 21, '3349.jpg'),
(27, 22, '9595.jpg'),
(28, 23, '4157.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `is_forgot` enum('Active','Inactive') NOT NULL,
  `image` varchar(255) NOT NULL,
  `source` enum('self','google','facebook','') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`, `status`, `is_forgot`, `image`, `source`, `created_at`) VALUES
(1, 'Rohan Singh', 'rohan@gmail.com', '8383908866', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Active', 'Active', '5987.jpg', 'self', '2020-08-15 00:35:51'),
(2, 'Ram', 'ram@gmail.com', '7458868452', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'Active', 'Active', '', 'self', '2020-08-15 15:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `website` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `is_forgot` enum('Active','Inactive') NOT NULL,
  `address_line_1` varchar(50) NOT NULL,
  `address_line_2` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `landline` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `name`, `email`, `phone`, `password`, `website`, `category`, `image`, `status`, `is_forgot`, `address_line_1`, `address_line_2`, `area`, `state_id`, `city_id`, `country_id`, `zipcode`, `landline`, `created_at`) VALUES
(1, 'Bikanervala', 'ram.bikaner@gmail.com', '898928923', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'http://localhost/wesltk/privacy-policy', 'food,product,service', '1079967070.png', 'Active', 'Active', '', '', '', 0, 0, 0, 0, '', '2020-08-15 16:39:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_product_menu`
--
ALTER TABLE `admin_product_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_service_menu`
--
ALTER TABLE `admin_service_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_product`
--
ALTER TABLE `menu_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_restaurant`
--
ALTER TABLE `menu_restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_servcie`
--
ALTER TABLE `menu_servcie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admin_product_menu`
--
ALTER TABLE `admin_product_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_service_menu`
--
ALTER TABLE `admin_service_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_product`
--
ALTER TABLE `menu_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_restaurant`
--
ALTER TABLE `menu_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_servcie`
--
ALTER TABLE `menu_servcie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
