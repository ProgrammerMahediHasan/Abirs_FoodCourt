-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 07:14 PM
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
-- Database: `laravel_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_analyses`
--

CREATE TABLE `lar_analyses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `analyst_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `value` decimal(12,2) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_cache`
--

CREATE TABLE `lar_cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_cache_locks`
--

CREATE TABLE `lar_cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_categories`
--

CREATE TABLE `lar_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_categories`
--

INSERT INTO `lar_categories` (`id`, `name`, `description`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Burgers', 'All types of beef and chicken burgers', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(2, 'Pizza', 'Freshly baked pizzas with various toppings', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(3, 'Pasta', 'Italian style pasta dishes', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(4, 'Rice Items', 'Rice-based meals and platters', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(5, 'Chicken', 'Grilled, fried, and spicy chicken items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(6, 'Beef', 'Beef curry, steak, and specialty items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(7, 'Seafood', 'Fish, prawn, and seafood dishes', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(8, 'Vegetarian', 'Healthy vegetarian food items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(9, 'Fast Food', 'Quick snacks and fast food items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(10, 'Snacks', 'Light snacks and finger foods', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(11, 'Desserts', 'Sweet desserts and bakery items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(12, 'Ice Cream', 'Different flavors of ice cream', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(13, 'Cold Drinks', 'Soft drinks and chilled beverages', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(14, 'Hot Drinks', 'Tea, coffee, and hot beverages', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(15, 'Juices', 'Fresh fruit juices and smoothies', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(16, 'Breakfast', 'Morning breakfast meals', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(17, 'Lunch Specials', 'Special lunch combo meals', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(18, 'Dinner Specials', 'Chef’s special dinner items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(19, 'Combo Meals', 'Value combo meal packages', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(20, 'Kids Menu', 'Food items specially for kids', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `lar_customers`
--

CREATE TABLE `lar_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_customers`
--

INSERT INTO `lar_customers` (`id`, `name`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john@example.com', '01710000001', '123 Main Street, Dhaka', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(2, 'Jane Smith', 'jane@example.com', '01710000002', '456 Park Avenue, Dhaka', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(3, 'Robert Brown', 'robert@example.com', '01710000003', '789 Lake Road, Chittagong', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(4, 'Emily Davis', 'emily@example.com', '01710000004', '12 River Street, Khulna', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(5, 'Michael Johnson', 'michael@example.com', '01710000005', '34 Hill Street, Sylhet', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(6, 'Sophia Wilson', 'sophia@example.com', '01710000006', '56 Garden Road, Rajshahi', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(7, 'Daniel Martinez', 'daniel@example.com', '01710000007', '78 Lakeview Avenue, Barisal', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(8, 'Olivia Taylor', 'olivia@example.com', '01710000008', '90 Sunrise Street, Rangpur', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(9, 'William Anderson', 'william@example.com', '01710000009', '101 Sunset Boulevard, Comilla', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(10, 'Ava Thomas', 'ava@example.com', '01710000010', '202 Ocean Drive, Mymensingh', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(12, 'MAHEDI HASAN', 'afranabir03@gmail.com', '01632606827', 'Narayanganj,Siddhirganj', 1, '2026-01-04 23:22:23', '2026-01-04 23:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `lar_failed_jobs`
--

CREATE TABLE `lar_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_jobs`
--

CREATE TABLE `lar_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_job_batches`
--

CREATE TABLE `lar_job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_menus`
--

CREATE TABLE `lar_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_menus`
--

INSERT INTO `lar_menus` (`id`, `category_id`, `name`, `description`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Classic Beef Burger', 'Juicy beef patty with cheese and lettuce', 250.00, 'menus/bqcdUyKLjvbxwDyK49LxR47CWgtZxvWBzDN9Mifr.jpg', 1, '2026-01-05 04:05:13', '2026-01-17 22:06:56'),
(2, 1, 'Chicken Burger', 'Crispy chicken burger with mayo', 220.00, 'menus/eVupJelhG1z4lqk69TK3Iu5X5rA2ii8YlgufS7YP.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:24:24'),
(3, 2, 'Margherita Pizza', 'Classic cheese pizza with tomato sauce', 550.00, 'menus/l6AAfapgQrYtJCMEgQi9Xp9cwkQFM9dkGVeDvyAk.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:23:09'),
(4, 2, 'Pepperoni Pizza', 'Pepperoni pizza with mozzarella cheese', 650.00, 'menus/gTUHdkrQ8l1K5HMmkPFiOQni2jyF2cDsQP1MBqnO.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:21:07'),
(5, 3, 'Creamy Alfredo Pasta', 'Pasta in creamy alfredo sauce', 480.00, 'menus/3LgjysvQ3LMS1tzmerjqhgTySctwEZcpHIQpqTGc.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:20:01'),
(6, 3, 'Spicy Arrabiata Pasta', 'Pasta with spicy tomato sauce', 460.00, 'menus/dQzH6a4kMM1IEAy8vemydB6ykuwa6VboJqU8xWGs.jpg', 0, '2026-01-05 04:05:13', '2026-01-09 00:18:56'),
(7, 4, 'Chicken Fried Rice', 'Fried rice with chicken and vegetables', 380.00, 'menus/rYKGBIH2yunJdSB3urpuVHvecKLSgcPwpfQMyDQM.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:17:45'),
(8, 4, 'Beef Biryani', 'Traditional beef biryani with spices', 420.00, 'menus/sCbQ9pLHwplgM5o6GlbOjKRxFsg5jo6uo3vIelnT.webp', 1, '2026-01-05 04:05:13', '2026-01-09 00:16:15'),
(9, 5, 'Grilled Chicken', 'Grilled chicken served with sauce', 520.00, 'menus/HvRm8CVyZdx0bx2a6bvPkwSU3yOggwGbq5ka71f3.webp', 1, '2026-01-05 04:05:13', '2026-01-09 00:14:55'),
(10, 6, 'Beef Steak', 'Tender beef steak with gravy', 850.00, 'menus/RLi0Oli12rj9vLmc3tBhsPp87JxqTaYExn2gkNUe.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:11:25'),
(11, 7, 'Fried Prawns', 'Crispy fried prawns', 600.00, 'menus/oerb5OwVCdNuO788TWTC8gYe51Duhg9L0kmGvIQ1.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:09:02'),
(12, 8, 'Vegetable Curry', 'Mixed vegetable curry', 300.00, 'menus/Lcs6qQX1HAo1PImn2EG916XRikm4y7hBnMyx0k0b.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:07:28'),
(13, 9, 'French Fries', 'Golden crispy french fries', 180.00, 'menus/kPUJaUiv8osQtVEAs1Rx9vG5DUrGtDN02iwYteTa.webp', 1, '2026-01-05 04:05:13', '2026-01-09 00:05:52'),
(14, 10, 'Chicken Nuggets', 'Crunchy chicken nuggets', 260.00, 'menus/khvmTnj1gosqA1l56AoVR7gLsNnO3NHXiBcGCjje.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:03:22'),
(15, 11, 'Chocolate Cake', 'Rich chocolate layered cake', 320.00, 'menus/eyxEtJpmDVAgP1UgmGaVWUCHpahBgzYfh8NybkMg.jpg', 1, '2026-01-05 04:05:13', '2026-01-09 00:01:41'),
(16, 12, 'Vanilla Ice Cream', 'Classic vanilla ice cream scoop', 150.00, 'menus/5vXOzQ0yK7mtos6Hs7oIU64dZQvtvlyaGJ1tmAYE.webp', 1, '2026-01-05 04:05:13', '2026-01-09 00:00:32'),
(17, 13, 'Coca Cola', 'Chilled soft drink', 60.00, 'menus/codUFf0kQkQPBVBPha8QF4P1vxdHOseQFYwko6bJ.jpg', 1, '2026-01-05 04:05:13', '2026-01-08 23:58:52'),
(18, 14, 'Hot Coffee', 'Freshly brewed hot coffee', 120.00, 'menus/U30P2W7AxZQ4lCbS5lM6T3hMXbutxSJotdobwarM.jpg', 1, '2026-01-05 04:05:13', '2026-01-08 23:56:38'),
(19, 15, 'Orange Juice', 'Freshly squeezed orange juice', 140.00, 'menus/LkFLF63OQ80ycLcydMA0SfMWpglSNeEvYMy1yQQE.jpg', 1, '2026-01-05 04:05:13', '2026-01-08 23:55:28'),
(20, 20, 'Kids Mini Burger', 'Small burger specially for kids', 160.00, 'menus/59Yq75xudE6DmNHzc6JcuVOFlMA3IjsfYMrvwJ9C.jpg', 1, '2026-01-05 04:05:13', '2026-01-08 23:53:18'),
(22, 10, 'sandwich', 'a popular food featuring fillings like meat, cheese, vegetables, or spreads layered between slices of bread', 100.00, 'menus/iZ3EtjlRleNLMiNwRvmwekPYMS1CbGaE8kizQkjU.jpg', 1, '2026-01-08 23:52:05', '2026-01-08 23:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `lar_migrations`
--

CREATE TABLE `lar_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_migrations`
--

INSERT INTO `lar_migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_03_165547_create_categories_table', 1),
(5, '2026_01_04_055650_create_menus_table', 1),
(6, '2026_01_04_121119_create_customers_table', 1),
(7, '2026_01_04_143024_create_restaurants_table', 1),
(9, '2026_01_04_152533_create_restaurants_table', 2),
(10, '2026_01_09_165332_create_orders_table', 3),
(11, '2026_01_11_040306_create_personal_access_tokens_table', 3),
(13, '2026_01_12_033634_create_orders_table', 4),
(14, '2026_01_12_033653_create_orders_items_table', 4),
(15, '2026_01_17_060540_create_payment_methods_table', 5),
(16, '2026_01_17_060540_create_payments_table', 5),
(17, '2026_01_17_060541_create_invoices_table', 5),
(18, '2026_01_17_061458_create_payment_methods_table', 6),
(19, '2026_01_17_061529_create_payments_table', 6),
(20, '2026_01_17_061634_create_invoices_table', 6),
(21, '2026_01_18_042429_create_purchases_table', 7),
(22, '2026_01_18_042547_create_stocks_table', 7),
(23, '2026_01_18_045704_create_purchases_table', 8),
(24, '2026_01_18_054917_create_suppliers_table', 9),
(25, '2026_01_18_055118_create_products_table', 9),
(26, '2026_01_18_055141_create_purchase_orders_table', 9),
(27, '2026_01_18_055242_create_purchase_order_items_table', 9),
(28, '2026_01_18_055307_create_stock_transactions_table', 9),
(29, '2026_01_18_183101_add_is_active_to_categories_table', 10),
(30, '2026_01_19_065146_create_stocks_table', 11),
(31, '2026_01_19_122806_add_payment_fields_to_orders_table', 12),
(32, '2026_01_19_123404_add_payment_columns_to_orders_table', 13),
(33, '2026_01_19_123741_add_payment_columns_to_orders_table', 13),
(34, '2026_01_19_124354_add_payment_columns_to_orders_table', 13),
(35, '2026_01_19_160159_create_analyses_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `lar_orders`
--

CREATE TABLE `lar_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_type` enum('dine_in','takeaway','delivery') NOT NULL DEFAULT 'dine_in',
  `status` enum('pending','confirmed','preparing','ready','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `invoice_token` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `ordered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_orders`
--

INSERT INTO `lar_orders` (`id`, `order_no`, `customer_id`, `restaurant_id`, `order_type`, `status`, `payment_status`, `payment_method`, `invoice_token`, `subtotal`, `tax`, `discount`, `total`, `note`, `ordered_at`, `created_at`, `updated_at`) VALUES
(10, 'ORD-20260119-0001', 12, 13, 'dine_in', 'pending', NULL, NULL, NULL, 660.00, 0.00, 0.00, 660.00, NULL, '2026-01-19 01:36:27', '2026-01-19 01:36:27', '2026-01-19 01:36:28'),
(12, 'ORD-20260119-0002', 12, 14, 'takeaway', 'pending', NULL, NULL, NULL, 440.00, 0.00, 0.00, 440.00, NULL, '2026-01-19 01:45:54', '2026-01-19 01:45:54', '2026-01-19 01:45:54'),
(13, 'ORD-20260119-0003', 12, 16, 'takeaway', 'confirmed', 'paid', 'cash', 'INV-20260119-V6HOY', 2350.00, 0.00, 0.00, 2350.00, NULL, '2026-01-19 05:19:31', '2026-01-19 05:19:31', '2026-01-19 09:10:20'),
(14, 'ORD-1768845139', 1, 11, 'dine_in', 'confirmed', 'paid', 'cash', 'INV-20260119-ZIMC2', 180.00, 0.00, 0.00, 180.00, NULL, '2026-01-19 11:52:19', '2026-01-19 11:52:19', '2026-01-19 12:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `lar_order_items`
--

CREATE TABLE `lar_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(8,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_order_items`
--

INSERT INTO `lar_order_items` (`id`, `order_id`, `menu_id`, `quantity`, `unit_price`, `total_price`, `special_request`, `created_at`, `updated_at`) VALUES
(1, 10, 2, 3, 220.00, 660.00, NULL, '2026-01-19 01:36:27', '2026-01-19 01:36:27'),
(2, 12, 2, 2, 220.00, 440.00, NULL, '2026-01-19 01:45:54', '2026-01-19 01:45:54'),
(3, 13, 2, 5, 220.00, 1100.00, NULL, '2026-01-19 05:19:31', '2026-01-19 05:19:31'),
(4, 13, 1, 5, 250.00, 1250.00, NULL, '2026-01-19 05:19:31', '2026-01-19 05:19:31'),
(5, 14, 17, 3, 60.00, 180.00, NULL, '2026-01-19 11:52:19', '2026-01-19 11:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `lar_password_reset_tokens`
--

CREATE TABLE `lar_password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_personal_access_tokens`
--

CREATE TABLE `lar_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_products`
--

CREATE TABLE `lar_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit` varchar(255) NOT NULL DEFAULT 'piece',
  `current_stock` decimal(10,2) NOT NULL DEFAULT 0.00,
  `reorder_level` decimal(10,2) NOT NULL DEFAULT 10.00,
  `last_purchase_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_purchase_orders`
--

CREATE TABLE `lar_purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` date NOT NULL,
  `expected_delivery_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `status` enum('draft','pending','approved','received','cancelled') NOT NULL DEFAULT 'draft',
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `shipping` decimal(15,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_purchase_order_items`
--

CREATE TABLE `lar_purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `received_quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_restaurants`
--

CREATE TABLE `lar_restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_restaurants`
--

INSERT INTO `lar_restaurants` (`id`, `name`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Kacchi Bhai', 'info@kacchibhai.com', '01711000001', 'Dhanmondi, Dhaka', 1, '2026-01-09 23:26:32', '2026-01-09 23:52:09'),
(12, 'Sultan\'s Dine', 'contact@sultandine.com', '01711000002', 'Gulshan, Dhaka', 1, '2026-01-09 23:52:44', '2026-01-09 23:53:15'),
(13, 'Takeout', 'order@takeout.com', '01711000003', 'Banani, Dhaka', 1, '2026-01-10 00:13:05', '2026-01-10 00:13:13'),
(14, 'Chillox', 'hello@chillox.com', '01711000004', 'Mirpur, Dhaka', 1, '2026-01-10 00:13:58', '2026-01-10 00:14:04'),
(16, 'Burger King', 'support@burgerking.com', 'support@burgerking.com', 'Uttara, Dhaka', 1, '2026-01-10 00:17:02', '2026-01-10 00:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `lar_sessions`
--

CREATE TABLE `lar_sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_sessions`
--

INSERT INTO `lar_sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8zprOkPq57k1KSw6ZabvmKiXTT4ISK7QHuFnB5RV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRFM0cG5vVDdOeVdiVTJTVEd2YUFxRWdsVkpmdFRTTmFKc1hWMEczVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2ODg0NDMxMjt9fQ==', 1768844312),
('Glh1ERZrKJyVuVIuVuaZUutd4VmsWVW1wmztPcea', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaGozSjRNYTNTUUN1RktBRkJOUkZ6cE9Vd0t5MUZFejBtY1A0VGNZVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768845029),
('lwRChFEADWWaFrVa9nP7qIg2XSdR0PTavMj1cCsr', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRDh6dGlSTnpFZzNGQUtZZFJ5ejR1N1FSNGlDT3FwVlZsdVVMRTlRMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvb3JkZXJzLzE0L3BheW1lbnQiO3M6NToicm91dGUiO3M6MTk6Im9yZGVycy5wYXltZW50LmZvcm0iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2ODg0NTA3MDt9fQ==', 1768846403);

-- --------------------------------------------------------

--
-- Table structure for table `lar_stocks`
--

CREATE TABLE `lar_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `current_quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(255) NOT NULL DEFAULT 'pcs',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_stocks`
--

INSERT INTO `lar_stocks` (`id`, `menu_id`, `current_quantity`, `unit`, `created_at`, `updated_at`) VALUES
(1, 2, 15, 'pcs', '2026-01-19 01:13:41', '2026-01-19 05:19:31'),
(2, 1, 5, 'pcs', '2026-01-19 01:28:03', '2026-01-19 05:19:31'),
(4, 17, 7, 'pcs', '2026-01-19 11:51:43', '2026-01-19 11:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `lar_stock_transactions`
--

CREATE TABLE `lar_stock_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('in','out') NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_suppliers`
--

CREATE TABLE `lar_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `supplier_type` varchar(255) NOT NULL DEFAULT 'food',
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `payment_terms` varchar(255) NOT NULL DEFAULT 'cash',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_suppliers`
--

INSERT INTO `lar_suppliers` (`id`, `name`, `company_name`, `phone`, `email`, `address`, `supplier_type`, `balance`, `payment_terms`, `is_active`, `created_at`, `updated_at`) VALUES
(12, 'MAHEDI HASAN', 'Abir\'s FoodCourt', '01632606827', 'afranabir03@gmail.com', 'Narayanganj,Siddhirganj, Mouchak Bus Stand\r\nSiddhirganj, Hajera Market, Narayanganj', 'meat', 0.00, 'cod', 1, '2026-01-18 23:55:21', '2026-01-18 23:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `lar_users`
--

CREATE TABLE `lar_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_users`
--

INSERT INTO `lar_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'MAHEDI HASAN', 'afranabir03@gmail.com', NULL, '$2y$12$8BCHy7bzop/2n2BjLLgVUuen55ktPk2CRlDC1imJEcTL0ubIa/nwa', NULL, '2026-01-04 08:36:34', '2026-01-04 08:36:34'),
(7, 'Pollob Sagor', 'pollob@example.com', NULL, '$2y$12$0c1b79cYLW1RZNSPp4U.fOFH6Kw1.s2gB/IU0TQBrxYPJCAJ//ipO', NULL, '2026-01-05 07:26:42', '2026-01-05 07:26:42'),
(8, 'MAHEDI HASAN', 'mahedihasanabir8@gmail.com', NULL, '$2y$12$I1oHvDK8idceY4HPNVH5yO3OjkJi5k4MJGWJuQcEhlhqG8Y/ZlWZy', NULL, '2026-01-09 06:01:04', '2026-01-09 06:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('F7lOOiZUNgHgIofDcX1wW0vE5MsOTGxKU9xgKPBr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDcwQlFuOWczMDVGT2ZtV0c1ZVVkUGhlVTdva0RDOThIeWZSODdiZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767675088);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_analyses`
--
ALTER TABLE `lar_analyses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_cache`
--
ALTER TABLE `lar_cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `lar_cache_locks`
--
ALTER TABLE `lar_cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `lar_categories`
--
ALTER TABLE `lar_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_categories_name_unique` (`name`);

--
-- Indexes for table `lar_customers`
--
ALTER TABLE `lar_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_failed_jobs`
--
ALTER TABLE `lar_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lar_jobs`
--
ALTER TABLE `lar_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_jobs_queue_index` (`queue`);

--
-- Indexes for table `lar_job_batches`
--
ALTER TABLE `lar_job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_menus`
--
ALTER TABLE `lar_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_migrations`
--
ALTER TABLE `lar_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_orders`
--
ALTER TABLE `lar_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_orders_order_no_unique` (`order_no`),
  ADD KEY `lar_orders_customer_id_status_index` (`customer_id`,`status`),
  ADD KEY `lar_orders_restaurant_id_ordered_at_index` (`restaurant_id`,`ordered_at`);

--
-- Indexes for table `lar_order_items`
--
ALTER TABLE `lar_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_order_items_menu_id_foreign` (`menu_id`),
  ADD KEY `lar_order_items_order_id_menu_id_index` (`order_id`,`menu_id`);

--
-- Indexes for table `lar_password_reset_tokens`
--
ALTER TABLE `lar_password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `lar_personal_access_tokens`
--
ALTER TABLE `lar_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_personal_access_tokens_token_unique` (`token`),
  ADD KEY `lar_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `lar_personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `lar_products`
--
ALTER TABLE `lar_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_products_code_unique` (`code`),
  ADD KEY `lar_products_category_id_foreign` (`category_id`),
  ADD KEY `lar_products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `lar_purchase_orders`
--
ALTER TABLE `lar_purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_purchase_orders_po_number_unique` (`po_number`),
  ADD KEY `lar_purchase_orders_supplier_id_foreign` (`supplier_id`),
  ADD KEY `lar_purchase_orders_created_by_foreign` (`created_by`),
  ADD KEY `lar_purchase_orders_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `lar_purchase_order_items`
--
ALTER TABLE `lar_purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `lar_purchase_order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `lar_restaurants`
--
ALTER TABLE `lar_restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_sessions`
--
ALTER TABLE `lar_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_sessions_user_id_index` (`user_id`),
  ADD KEY `lar_sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `lar_stocks`
--
ALTER TABLE `lar_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_stocks_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `lar_stock_transactions`
--
ALTER TABLE `lar_stock_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_stock_transactions_product_id_foreign` (`product_id`),
  ADD KEY `lar_stock_transactions_created_by_foreign` (`created_by`),
  ADD KEY `lar_stock_transactions_reference_type_reference_id_index` (`reference_type`,`reference_id`);

--
-- Indexes for table `lar_suppliers`
--
ALTER TABLE `lar_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_users`
--
ALTER TABLE `lar_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_users_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_analyses`
--
ALTER TABLE `lar_analyses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_categories`
--
ALTER TABLE `lar_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lar_customers`
--
ALTER TABLE `lar_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lar_failed_jobs`
--
ALTER TABLE `lar_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_jobs`
--
ALTER TABLE `lar_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_menus`
--
ALTER TABLE `lar_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lar_migrations`
--
ALTER TABLE `lar_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `lar_orders`
--
ALTER TABLE `lar_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lar_order_items`
--
ALTER TABLE `lar_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lar_personal_access_tokens`
--
ALTER TABLE `lar_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_products`
--
ALTER TABLE `lar_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lar_purchase_orders`
--
ALTER TABLE `lar_purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lar_purchase_order_items`
--
ALTER TABLE `lar_purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lar_restaurants`
--
ALTER TABLE `lar_restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lar_stocks`
--
ALTER TABLE `lar_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lar_stock_transactions`
--
ALTER TABLE `lar_stock_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lar_suppliers`
--
ALTER TABLE `lar_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lar_users`
--
ALTER TABLE `lar_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lar_orders`
--
ALTER TABLE `lar_orders`
  ADD CONSTRAINT `lar_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `lar_customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lar_orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `lar_restaurants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lar_order_items`
--
ALTER TABLE `lar_order_items`
  ADD CONSTRAINT `lar_order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `lar_menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lar_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `lar_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_products`
--
ALTER TABLE `lar_products`
  ADD CONSTRAINT `lar_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `lar_categories` (`id`),
  ADD CONSTRAINT `lar_products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `lar_suppliers` (`id`);

--
-- Constraints for table `lar_purchase_orders`
--
ALTER TABLE `lar_purchase_orders`
  ADD CONSTRAINT `lar_purchase_orders_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `lar_users` (`id`),
  ADD CONSTRAINT `lar_purchase_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `lar_users` (`id`),
  ADD CONSTRAINT `lar_purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `lar_suppliers` (`id`);

--
-- Constraints for table `lar_purchase_order_items`
--
ALTER TABLE `lar_purchase_order_items`
  ADD CONSTRAINT `lar_purchase_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `lar_products` (`id`),
  ADD CONSTRAINT `lar_purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `lar_purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_stocks`
--
ALTER TABLE `lar_stocks`
  ADD CONSTRAINT `lar_stocks_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `lar_menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_stock_transactions`
--
ALTER TABLE `lar_stock_transactions`
  ADD CONSTRAINT `lar_stock_transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `lar_users` (`id`),
  ADD CONSTRAINT `lar_stock_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `lar_products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
