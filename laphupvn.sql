-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2025 at 04:24 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laphupvn`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dietrich, Kuhic and Wiza', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(2, 'Langosh Inc', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(3, 'Schuster, Bayer and Schaefer', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(4, 'Ziemann, Rau and Batz', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(5, 'Tremblay, Zemlak and Johns', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(6, 'Kautzer, Bergnaum and Wolf', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(7, 'Wilderman PLC', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(8, 'Langworth-Fay', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(9, 'Satterfield-Barton', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(10, 'Welch Ltd', '2025-06-29 09:23:55', '2025-06-29 09:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'rerum', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(2, 'omnis', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(3, 'animi', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(4, 'voluptatem', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(5, 'perferendis', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(6, 'sapiente', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(7, 'illum', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(8, 'veritatis', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(9, 'quis', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(10, 'eum', '2025-06-29 09:23:55', '2025-06-29 09:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laptops`
--

CREATE TABLE `laptops` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laptops`
--

INSERT INTO `laptops` (`id`, `brand_id`, `category_id`, `model`, `price`, `stock`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 2, 'Model-100', '1444.11', 10, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(2, 10, 8, 'Model-010', '1232.13', 70, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(3, 6, 10, 'Model-938', '839.54', 89, 'Voluptas cupiditate consequatur similique enim et est. Aliquid ad nesciunt in sint sint saepe. Quia odio eum excepturi eligendi qui harum voluptatem.', '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(4, 7, 3, 'Model-666', '531.91', 100, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(5, 2, 8, 'Model-746', '1631.36', 96, 'Occaecati corporis harum ut nesciunt repellendus. Soluta dolorem molestias aut ut dicta. Esse molestiae dolorem velit odit atque ratione. Est amet ut et ut.', '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(6, 6, 7, 'Model-857', '2344.47', 45, 'Laudantium temporibus maiores fugiat reprehenderit. Labore eaque architecto molestiae nostrum. Ex similique ut aut dolor. Ut sed nam aspernatur sint.', '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(7, 4, 2, 'Model-396', '2129.84', 94, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(8, 6, 6, 'Model-272', '1345.02', 85, 'Asperiores ipsa dolor non voluptas cupiditate placeat. Enim hic iusto quis fugiat. Aliquam et rem voluptatum reiciendis expedita et necessitatibus. Sed quia dolorem corrupti deleniti temporibus.', '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(9, 3, 7, 'Model-439', '1784.16', 42, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL),
(10, 5, 1, 'Model-739', '2753.33', 22, 'Eos voluptas voluptate doloribus. Omnis explicabo sequi amet impedit. Quasi qui blanditiis ipsam assumenda aut qui. Necessitatibus voluptates aut qui eum. Tenetur quod qui veritatis provident.', '2025-06-29 09:23:56', '2025-06-29 09:23:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laptop_images`
--

CREATE TABLE `laptop_images` (
  `id` bigint UNSIGNED NOT NULL,
  `laptop_id` bigint UNSIGNED NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laptop_images`
--

INSERT INTO `laptop_images` (`id`, `laptop_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 2, 'https://via.placeholder.com/640x480.png/002277?text=electronics+laptop+sapiente', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 10, 'https://via.placeholder.com/640x480.png/009966?text=electronics+laptop+adipisci', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 10, 'https://via.placeholder.com/640x480.png/00dd22?text=electronics+laptop+neque', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 3, 'https://via.placeholder.com/640x480.png/00ffee?text=electronics+laptop+alias', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 2, 'https://via.placeholder.com/640x480.png/003344?text=electronics+laptop+laboriosam', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 4, 'https://via.placeholder.com/640x480.png/0088ee?text=electronics+laptop+numquam', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 9, 'https://via.placeholder.com/640x480.png/0033aa?text=electronics+laptop+inventore', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 4, 'https://via.placeholder.com/640x480.png/005533?text=electronics+laptop+nostrum', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 3, 'https://via.placeholder.com/640x480.png/00dddd?text=electronics+laptop+eius', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 10, 'https://via.placeholder.com/640x480.png/00dd11?text=electronics+laptop+officia', '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `laptop_promotions`
--

CREATE TABLE `laptop_promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `laptop_id` bigint UNSIGNED NOT NULL,
  `promotion_id` bigint UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laptop_promotions`
--

INSERT INTO `laptop_promotions` (`id`, `laptop_id`, `promotion_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 10, 2, '2025-07-16', '2025-08-08', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 10, 5, NULL, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 10, 4, '2025-06-04', '2025-07-23', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 7, 2, '2025-06-08', '2025-07-12', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 9, 9, '2025-07-02', '2025-07-04', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 5, 6, '2025-06-17', '2025-07-22', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 9, 8, '2025-07-19', '2025-07-21', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 2, 7, '2025-06-13', '2025-07-29', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 8, 5, '2025-07-18', '2025-07-31', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 2, 1, '2025-07-15', '2025-08-01', '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `laptop_variants`
--

CREATE TABLE `laptop_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `laptop_id` bigint UNSIGNED NOT NULL,
  `variant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `specifications` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laptop_variants`
--

INSERT INTO `laptop_variants` (`id`, `laptop_id`, `variant_name`, `price`, `stock`, `specifications`, `created_at`, `updated_at`) VALUES
(1, 1, '8GB RAM', '3071.13', 15, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 2, '1TB HDD', '2676.14', 22, 'Alias nihil rem quis sint fuga beatae.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 8, '8GB RAM', '1742.84', 47, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 10, '512GB SSD', '3282.39', 16, 'Repellat id et omnis reiciendis doloribus similique doloribus dignissimos in consequatur.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 7, '16GB RAM', '1398.27', 18, 'Sint enim commodi ea eos et et.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 9, '16GB RAM', '3448.24', 21, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 5, '512GB SSD', '850.17', 10, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 5, '512GB SSD', '2913.81', 39, 'Qui voluptatem at qui dolor qui ex voluptas enim non est vitae nihil.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 10, '1TB HDD', '2304.98', 17, 'Hic reiciendis temporibus fugiat error harum ut et ducimus asperiores itaque totam doloribus harum.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 9, '1TB HDD', '1006.03', 29, 'Consectetur sint necessitatibus qui pariatur atque et asperiores sint velit ut.', '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_01_01_000000_create_roles_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2025_06_25_101311_create_brands_table', 1),
(6, '2025_06_25_101430_create_categories_table', 1),
(7, '2025_06_25_101507_create_laptops_table', 1),
(8, '2025_06_25_103040_create_orders_table', 1),
(9, '2025_06_25_103252_create_laptop_variants_table', 1),
(10, '2025_06_25_103331_create_laptop_images_table', 1),
(11, '2025_06_25_103454_create_order_items_table', 1),
(12, '2025_06_25_103521_create_payments_table', 1),
(13, '2025_06_25_103548_create_shipping_addresses_table', 1),
(14, '2025_06_25_103626_create_promotions_table', 1),
(15, '2025_06_25_103709_create_laptop_promotions_table', 1),
(16, '2025_06_25_103740_create_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','confirmed','shipped','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `total_amount`, `payment_method`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 10, '2025-06-29 09:23:56', '3567.11', 'paypal', 'shipped', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 8, '2025-06-29 09:23:56', '4100.05', 'credit_card', 'confirmed', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 5, '2025-06-29 09:23:56', '2374.44', 'credit_card', 'delivered', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 9, '2025-06-29 09:23:56', '3675.43', 'paypal', 'delivered', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 4, '2025-06-29 09:23:56', '4549.91', 'credit_card', 'confirmed', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 8, '2025-06-29 09:23:56', '3660.45', 'paypal', 'shipped', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 10, '2025-06-29 09:23:56', '2937.35', 'credit_card', 'delivered', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 1, '2025-06-29 09:23:56', '2127.39', 'paypal', 'cancelled', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 7, '2025-06-29 09:23:56', '1142.75', 'credit_card', 'pending', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 6, '2025-06-29 09:23:56', '2102.74', 'credit_card', 'shipped', NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `laptop_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `laptop_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 8, 9, 2, '2015.12', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 7, 8, 3, '2915.52', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 4, 9, 3, '646.61', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 5, 8, 3, '2063.24', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 4, 2, 3, '1404.42', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 4, 1, 1, '976.87', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 2, 7, 1, '910.34', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 9, 5, 2, '1811.89', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 10, 3, 2, '1746.21', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 10, 7, 3, '2773.49', '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('unpaid','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `amount`, `payment_date`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 6, '4285.42', '2025-06-29 09:23:56', 'unpaid', 'paypal', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 2, '1829.48', '2025-06-29 09:23:56', 'paid', 'cash', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 6, '1852.32', '2025-06-29 09:23:56', 'failed', 'bank_transfer', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 3, '3738.00', '2025-06-29 09:23:56', 'paid', 'cash', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 7, '3516.38', '2025-06-29 09:23:56', 'unpaid', 'paypal', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 9, '1196.43', '2025-06-29 09:23:56', 'unpaid', 'paypal', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 3, '1925.58', '2025-06-29 09:23:56', 'failed', 'paypal', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 1, '4098.29', '2025-06-29 09:23:56', 'paid', 'credit_card', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 10, '2126.99', '2025-06-29 09:23:56', 'refunded', 'cash', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 5, '2539.34', '2025-06-29 09:23:56', 'paid', 'credit_card', '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `discount_percentage`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Decentralized real-time encryption', '90.92', '2025-07-08', '2025-08-08', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 'Organized zeroadministration data-warehouse', '58.35', '2025-07-23', '2025-08-08', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 'Right-sized heuristic capacity', '76.84', '2025-07-09', '2025-08-10', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 'Synchronised bifurcated analyzer', '91.72', '2025-06-08', '2025-08-17', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 'Optional holistic service-desk', '94.84', '2025-06-17', '2025-07-18', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 'Secured static middleware', '4.38', '2025-05-30', '2025-06-25', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 'Multi-lateral well-modulated installation', '92.66', '2025-07-07', '2025-07-28', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 'Secured systemic budgetarymanagement', '29.70', '2025-07-17', '2025-08-06', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 'Universal uniform approach', '29.62', '2025-07-15', '2025-07-26', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 'Grass-roots national methodology', '45.98', '2025-06-11', '2025-07-16', '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `laptop_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `laptop_id`, `customer_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 10, 7, 2, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 3, 4, 3, 'Quia laudantium quis dolores omnis vitae earum suscipit ipsa laboriosam et esse.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 7, 3, 3, 'Dolores nihil corporis autem quia temporibus et.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 5, 1, 3, 'Animi sint fugiat consectetur quaerat minima adipisci rem sed ut sed rerum necessitatibus.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 4, 8, 4, 'Fuga provident aperiam omnis in sit dolorum atque sint rerum ut accusamus consectetur.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 6, 6, 3, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 5, 7, 2, NULL, '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 5, 3, 1, 'Quo odit velit sequi porro assumenda dolor velit quod.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 7, 8, 3, 'Ut repudiandae doloremque fuga dolores maiores est dolorem nemo qui est.', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 9, 5, 1, 'Ratione maiores repellat ipsam quaerat est qui magnam ipsum rerum.', '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'laborum', '2025-06-29 09:23:53', '2025-06-29 09:23:53'),
(2, 'est', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(3, 'pariatur', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(4, 'labore', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(5, 'dolor', '2025-06-29 09:23:55', '2025-06-29 09:23:55'),
(6, 'autem', '2025-06-29 09:23:55', '2025-06-29 09:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `customer_id`, `order_id`, `address`, `city`, `postal_code`, `country`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '27937 Emiliano Island Apt. 233', 'East Mertie', '73171', 'Philippines', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(2, 5, 10, '6582 Lowell Springs Apt. 284', 'Lake Reidport', '41787-7628', 'Holy See (Vatican City State)', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(3, 6, 10, '3448 Jan Crossroad', 'East Erwin', '92622', 'Equatorial Guinea', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(4, 2, 8, '95930 Hill Mountains', 'Port Jameson', '25843', 'Antigua and Barbuda', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(5, 8, 3, '825 Lueilwitz Harbors', 'New Shanon', '56213', 'Jordan', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(6, 7, 4, '14322 Hansen Keys', 'Hintzton', '53108', 'Mongolia', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(7, 2, 1, '383 Jakubowski Brooks Apt. 964', 'Robertmouth', '71977-0978', 'Tuvalu', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(8, 7, 9, '9039 Krista Oval Suite 730', 'Romaguerachester', '01957', 'Norfolk Island', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(9, 5, 7, '7857 Richard Inlet', 'Port Jamie', '13404-0878', 'Belgium', '2025-06-29 09:23:56', '2025-06-29 09:23:56'),
(10, 10, 9, '83496 Rolfson Lake Suite 721', 'East Royal', '62823', 'Congo', '2025-06-29 09:23:56', '2025-06-29 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `name`, `phone`, `address`, `role_id`, `created_at`, `updated_at`, `last_login`, `deleted_at`) VALUES
(1, 'jberge', 'zelda.torphy@example.org', '$2y$12$K0/jbJ/liq4aXKsrfynrD.AvpavgjuzyHSaAox25b1RRi7Q4hG05S', 'Alessandra Goyette', NULL, '4973 Hyman Land Apt. 386\nO\'Connerberg, GA 96936-6784', 1, '2025-06-29 09:23:53', '2025-06-29 09:23:55', '2025-06-08 16:47:02', NULL),
(2, 'derek.emmerich', 'lucious92@example.net', '$2y$12$Qa09IneYg7.SVD.3cE787u1nFW1mSR/7xJaS5aCq35eefl394a3eW', 'Adelia Larson', '201.773.3664', '9577 Raleigh Spurs Suite 376\nWest Rheahaven, MD 14817-7996', 1, '2025-06-29 09:23:54', '2025-06-29 09:23:55', '2025-06-15 20:24:18', NULL),
(3, 'bo73', 'bahringer.kelvin@example.org', '$2y$12$wwPoFlDfVV0oLJSQVB37OeZkQinAFnSszowXYtlGvYrv9S3VlvVpS', 'Marcella Beier', '+1-270-889-1588', '455 Hansen Center Apt. 427\nSaigebury, WI 99532', 1, '2025-06-29 09:23:54', '2025-06-29 09:23:55', NULL, NULL),
(4, 'grady.devyn', 'sharon.jacobson@example.com', '$2y$12$9.I/hCZ2Vg96mfEygGT9huNLc/Z5H376hBSyvR6mZs4PhoPwYd.dS', 'Kelsie Schiller', NULL, '34329 Schmeler Shoal Apt. 256\nEdisonland, MS 61960', 1, '2025-06-29 09:23:54', '2025-06-29 09:23:55', '2025-06-01 02:55:22', NULL),
(5, 'shaag', 'hking@example.org', '$2y$12$YEQ1USmmXvWaIdJ3wnM63uFLYXEvBixW0Z93z/nVbg8sqC.3enoG6', 'Prof. Marilyne Wehner', '870.273.5371', '73406 Florida Tunnel\nNeldatown, SD 07162-9217', 1, '2025-06-29 09:23:54', '2025-06-29 09:23:55', NULL, NULL),
(6, 'tbartoletti', 'jeanette53@example.net', '$2y$12$gO4p5Jrwuxufcm2GAuFA.eOMAVOM6MU5yEy1rCJKEr.IgZi9sgCLC', 'Tracey Nolan', '(563) 916-7682', '889 Lindsay Courts Apt. 440\nNew Daniela, ME 57401', 1, '2025-06-29 09:23:54', '2025-06-29 09:23:55', '2025-06-06 20:48:32', NULL),
(7, 'ypouros', 'qhuels@example.net', '$2y$12$Wy5MEr5oSDtyJYvvdlTwCOEdAJaWfRMuUvXwmDflvFVC8euJyqE5a', 'Nicolette Kozey', '1-240-698-5298', NULL, 1, '2025-06-29 09:23:55', '2025-06-29 09:23:55', NULL, NULL),
(8, 'quinn52', 'omcglynn@example.org', '$2y$12$QdWQ295ThI6KEnvRNp4d1uP8ZsQ9H/yXXCcLyPItc4jh0syo4X.fW', 'Camden Gaylord', NULL, NULL, 1, '2025-06-29 09:23:55', '2025-06-29 09:23:55', '2025-06-16 14:04:06', NULL),
(9, 'trey93', 'ihammes@example.net', '$2y$12$LeYuvWFAmW6.y4grymYpeOLuI/53eG3tFxNiYkSznz/0W3aBDfZ2W', 'D\'angelo Wiegand Jr.', NULL, NULL, 1, '2025-06-29 09:23:55', '2025-06-29 09:23:55', NULL, NULL),
(10, 'sbechtelar', 'halvorson.carson@example.net', '$2y$12$7VMCu2WxziJEOnpfQDE6/./vnsExYWoTINfyc9ZdBxt3cO4vrwqT2', 'Jamaal Ernser', '+16782402255', NULL, 1, '2025-06-29 09:23:55', '2025-06-29 09:23:55', '2025-06-02 18:32:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

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
-- Indexes for table `laptops`
--
ALTER TABLE `laptops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laptops_brand_id_foreign` (`brand_id`),
  ADD KEY `laptops_category_id_foreign` (`category_id`);

--
-- Indexes for table `laptop_images`
--
ALTER TABLE `laptop_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laptop_images_laptop_id_foreign` (`laptop_id`);

--
-- Indexes for table `laptop_promotions`
--
ALTER TABLE `laptop_promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laptop_promotions_laptop_id_foreign` (`laptop_id`),
  ADD KEY `laptop_promotions_promotion_id_foreign` (`promotion_id`);

--
-- Indexes for table `laptop_variants`
--
ALTER TABLE `laptop_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laptop_variants_laptop_id_foreign` (`laptop_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_laptop_id_foreign` (`laptop_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_laptop_id_foreign` (`laptop_id`),
  ADD KEY `reviews_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_addresses_customer_id_foreign` (`customer_id`),
  ADD KEY `shipping_addresses_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laptops`
--
ALTER TABLE `laptops`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laptop_images`
--
ALTER TABLE `laptop_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laptop_promotions`
--
ALTER TABLE `laptop_promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laptop_variants`
--
ALTER TABLE `laptop_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laptops`
--
ALTER TABLE `laptops`
  ADD CONSTRAINT `laptops_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `laptops_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `laptop_images`
--
ALTER TABLE `laptop_images`
  ADD CONSTRAINT `laptop_images_laptop_id_foreign` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`);

--
-- Constraints for table `laptop_promotions`
--
ALTER TABLE `laptop_promotions`
  ADD CONSTRAINT `laptop_promotions_laptop_id_foreign` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`),
  ADD CONSTRAINT `laptop_promotions_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`);

--
-- Constraints for table `laptop_variants`
--
ALTER TABLE `laptop_variants`
  ADD CONSTRAINT `laptop_variants_laptop_id_foreign` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_laptop_id_foreign` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_laptop_id_foreign` FOREIGN KEY (`laptop_id`) REFERENCES `laptops` (`id`);

--
-- Constraints for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `shipping_addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `shipping_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
