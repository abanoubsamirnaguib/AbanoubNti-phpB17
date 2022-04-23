-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2022 at 06:14 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task4`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `flat` varchar(255) DEFAULT NULL,
  `floor` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` enum('m','l') NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT curdate(),
  `updated_at` timestamp NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(500) NOT NULL,
  `name_ar` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name_en`, `name_ar`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Iphone', 'ايفون', 'default.jpg', 1, '2022-04-22 22:00:00', '2022-04-22 22:00:00'),
(2, 'plants', 'اعشاب', 'default.jpg', 1, '2022-04-22 22:00:00', '2022-04-22 22:00:00'),
(3, 'dell', 'ديل', 'default.jpg', 1, '2022-04-22 22:00:00', '2022-04-22 22:00:00'),
(4, 'samsung', 'سامسونج', 'default.jpg', 1, '2022-04-22 22:00:00', '2022-04-22 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `user_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(500) NOT NULL,
  `name_en` varchar(500) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_ar`, `name_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mobile', ' موبيل  ', 1, '2022-04-22 22:00:00', '2022-04-22 22:00:00'),
(2, 'laptop', ' لابتوب  ', 1, '2022-04-22 22:00:00', '2022-04-22 22:00:00'),
(3, 'TV', ' تلفزيون  ', 1, '2022-04-22 22:00:00', '2022-04-22 22:00:00'),
(4, 'plants', ' اعشاب  ', 1, '2022-04-22 22:00:00', '2022-04-22 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(500) NOT NULL,
  `discount` float UNSIGNED DEFAULT NULL,
  `discount type` enum('PRODUCT','EVENT') DEFAULT NULL,
  `mini_order_value` int(11) NOT NULL,
  `max_discount_value` int(11) NOT NULL,
  `max_number_of_usage` int(11) NOT NULL,
  `start_date_time` timestamp NOT NULL DEFAULT curdate(),
  `end_date_time` timestamp NOT NULL DEFAULT curdate(),
  `created_at` timestamp NOT NULL DEFAULT curdate(),
  `updated_at` timestamp NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(500) NOT NULL,
  `total` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `adress_id` bigint(20) UNSIGNED DEFAULT NULL,
  `Payment_d` bigint(20) UNSIGNED DEFAULT NULL,
  `delivered_at` timestamp NOT NULL DEFAULT curdate(),
  `created_at` timestamp NOT NULL DEFAULT curdate(),
  `updated_at` timestamp NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visa` tinyint(1) DEFAULT NULL,
  `cash` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `desc_en` text DEFAULT NULL,
  `desc_ar` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `Brand_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `price`, `quantity`, `desc_en`, `desc_ar`, `status`, `created_at`, `updated_at`, `image`, `sub_category_id`, `Brand_id`) VALUES
(1, 'ايفون', NULL, 20000, 10, 'mobile', 'موبيل', 1, '2022-04-22 23:27:21', '2022-04-22 23:27:21', 'iphone13.jpg', 4, 1),
(2, 'tv samsund lg', NULL, 1200, 5, 'tv samsung', 'سامسونج تلفاز', 1, '2022-04-22 23:30:18', '2022-04-22 23:30:18', 'lg.jpg', 2, 4),
(3, 'laptop', NULL, 1900, 6, 'dell laptop g56', 'لابتوب', 1, '2022-04-22 23:30:18', '2022-04-22 23:30:18', 'dell.jpg', 1, 3),
(4, 'chebsi', NULL, 60, 60, 'plants', 'نبات', 1, '2022-04-22 23:37:18', '2022-04-22 23:37:18', 'chepsi.jpg', 3, 2),
(5, 'mac', NULL, 15000, 12, 'maccccc laptop', 'ماااك لابتوب', 1, '2022-04-22 23:40:10', '2022-04-22 23:40:10', 'mac.jpg', 4, 1),
(6, 'lenovo laptop', NULL, 15060, 95, 'laptop lenovno hj345', 'لينوفوا لاب توب', 1, '2022-04-22 23:40:10', '2022-04-22 23:40:10', 'laptop.jpg', 1, 1),
(7, 'feta cheese', NULL, 90, 15, 'fetaaa food', 'جبنه فيتا', 1, '2022-04-22 23:43:21', '2022-04-22 23:43:21', 'feta.png', 3, 2),
(8, 'mobile a50', NULL, 6000, 61, 'a 51 mobile samsung', 'موبيل سامسونج ', 1, '2022-04-22 23:43:21', '2022-04-22 23:43:21', 'a50.jpg', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_spec`
--

CREATE TABLE `product_spec` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spec_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_spec`
--

INSERT INTO `product_spec` (`id`, `spec_id`, `product_id`, `value`) VALUES
(1, 3, 1, 'blue'),
(2, 2, 1, '8'),
(3, 1, 1, '128'),
(4, 5, 4, 'chesse'),
(5, 6, 4, '75 gm'),
(6, 6, 2, '40 in'),
(7, 5, 7, 'chesse'),
(8, 2, 3, '8 gb'),
(9, 2, 6, '16 gb'),
(10, 3, 3, 'black'),
(11, 6, 3, '20 in');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(500) NOT NULL,
  `name_ar` varchar(500) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comments` text DEFAULT NULL,
  `rate` enum('1','2','3','4','5') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `comments`, `rate`, `created_at`, `user_id`, `product_id`) VALUES
(1, 'very good', '4', '0000-00-00 00:00:00', 29, 3),
(2, 'amazing', '2', '0000-00-00 00:00:00', 29, 5),
(3, 'like it', '4', '0000-00-00 00:00:00', 29, 7),
(4, NULL, '4', '0000-00-00 00:00:00', 29, 3),
(5, NULL, '4', '0000-00-00 00:00:00', 29, 5),
(6, NULL, '5', '0000-00-00 00:00:00', 29, 7);

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specs`
--

INSERT INTO `specs` (`id`, `name`) VALUES
(1, 'storage'),
(2, 'ram'),
(3, 'color'),
(4, 'weight'),
(5, 'flavor'),
(6, 'size');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(500) NOT NULL,
  `name_en` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name_ar`, `name_en`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'لاب توب ', 'laptop dell', 'default.jpg', 2, '2022-04-22 23:07:45', '2022-04-22 23:07:49'),
(2, 'تلفزيون سامسونج', 'Tv samsung', 'default.jpg', 3, '2022-04-22 23:07:42', '2022-04-22 23:07:55'),
(3, 'اعشاب شاى', 'plants tea', 'default.jpg', 4, '2022-04-22 23:07:39', '2022-04-22 23:08:02'),
(4, 'ايفون ابل', 'iphone apple', 'default.jpg', 1, '2022-04-22 23:07:34', '2022-04-22 23:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` enum('m','l') NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `image` varchar(500) DEFAULT 'default.jpg',
  `verification_code` int(8) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `RememberToken` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `gender`, `status`, `image`, `verification_code`, `email_verified_at`, `RememberToken`, `created_at`, `updated_at`) VALUES
(1, 'abanoub', 'samir', 'abanoub@gmail.com', '123456', '012346578910', 'm', 1, 'default.jpg', NULL, '2022-04-20 19:02:42', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Abanoub', 'Samir', 'Abanoubsamir@gmail.com', '$2y$10$dErnm5qmsBbDq2OUYJr30OkXEBRCERb4xtX0ONLCzZxlMaOu/cXni', '01221966084', 'm', 1, '626328d7d914c.jpeg', 37589, '2022-04-20 20:16:07', '6262a9758564c4.18194809', '2022-04-20 20:15:53', '2022-04-20 20:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `adress_id` (`adress_id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `Payment_d` (`Payment_d`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_category_id` (`sub_category_id`),
  ADD KEY `Brand_id` (`Brand_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Order_id` (`Order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_spec`
--
ALTER TABLE `product_spec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spec_id` (`spec_id`),
  ADD KEY `product_spec_ibfk_2` (`product_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `wishes`
--
ALTER TABLE `wishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_spec`
--
ALTER TABLE `product_spec`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `wishes`
--
ALTER TABLE `wishes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`adress_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`Payment_d`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`Brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_spec`
--
ALTER TABLE `product_spec`
  ADD CONSTRAINT `product_spec_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`),
  ADD CONSTRAINT `product_spec_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `wishes`
--
ALTER TABLE `wishes`
  ADD CONSTRAINT `wishes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
