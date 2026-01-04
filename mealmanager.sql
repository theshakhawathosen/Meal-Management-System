-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 01:43 PM
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
-- Database: `mealmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `bazars`
--

CREATE TABLE `bazars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `details` longtext NOT NULL,
  `amount` float NOT NULL,
  `shopper` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`shopper`)),
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bazars`
--

INSERT INTO `bazars` (`id`, `details`, `amount`, `shopper`, `date`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Odit dolore ut asper', 33, '[\"1\",\"22\",\"23\"]', '2001-02-08', 1, '2024-09-26 00:13:33', '2024-09-26 00:13:33'),
(3, 'afsdsasdasfdas<br />\r\ndf<br />\r\nasdf<br />\r\nas<br />\r\ndf<br />\r\nasdf', 453, '[\"22\",\"23\"]', '2024-09-26', 0, '2024-09-26 00:23:02', '2024-09-26 00:23:02'),
(4, 'afsd', 4, '[\"1\",\"22\"]', '2024-09-26', 0, '2024-09-26 00:25:48', '2024-09-26 00:25:48');

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
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'other',
  `amount` float NOT NULL,
  `details` text DEFAULT NULL,
  `shopper` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`shopper`)),
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `user_id`, `type`, `amount`, `details`, `shopper`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'other', 11.3333, 'Ut est molestiae nul', '[\"1\",\"22\",\"23\"]', '2018-02-03', 1, '2024-09-26 00:11:15', '2024-09-26 00:11:15'),
(2, 22, 'other', 11.3333, 'Ut est molestiae nul', '[\"1\",\"22\",\"23\"]', '2018-02-03', 1, '2024-09-26 00:11:15', '2024-09-26 00:11:15'),
(3, 23, 'other', 11.3333, 'Ut est molestiae nul', '[\"1\",\"22\",\"23\"]', '2018-02-03', 1, '2024-09-26 00:11:15', '2024-09-26 00:11:15'),
(4, 1, 'other', 33, 'Cum ad quidem vel qu', '[\"1\",\"22\"]', '1981-05-18', 1, '2024-09-26 00:12:46', '2024-09-26 00:12:46'),
(5, 22, 'other', 33, 'Cum ad quidem vel qu', '[\"1\",\"22\"]', '1981-05-18', 1, '2024-09-26 00:12:46', '2024-09-26 00:12:46'),
(6, 23, 'other', 33, 'Cum ad quidem vel qu', '[\"1\",\"22\"]', '1981-05-18', 1, '2024-09-26 00:12:46', '2024-09-26 00:12:46'),
(7, 1, 'other', 25, 'Sit dolores eum nem', '[\"1\",\"22\",\"23\"]', '1992-12-10', 1, '2024-09-26 00:12:56', '2024-09-26 00:12:56'),
(8, 22, 'other', 25, 'Sit dolores eum nem', '[\"1\",\"22\",\"23\"]', '1992-12-10', 1, '2024-09-26 00:12:56', '2024-09-26 00:12:56'),
(9, 23, 'other', 25, 'Sit dolores eum nem', '[\"1\",\"22\",\"23\"]', '1992-12-10', 1, '2024-09-26 00:12:56', '2024-09-26 00:12:56'),
(10, 1, 'other', 7.66667, 'sdf', '[\"22\",\"23\"]', '2024-09-26', 1, '2024-09-26 00:13:07', '2024-09-26 00:13:07'),
(11, 22, 'other', 7.66667, 'sdf', '[\"22\",\"23\"]', '2024-09-26', 1, '2024-09-26 00:13:07', '2024-09-26 00:13:07'),
(12, 23, 'other', 7.66667, 'sdf', '[\"22\",\"23\"]', '2024-09-26', 1, '2024-09-26 00:13:07', '2024-09-26 00:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `deposites`
--

CREATE TABLE `deposites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposites`
--

INSERT INTO `deposites` (`id`, `user_id`, `amount`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 23, 500, '2024-09-26', 1, '2024-09-26 00:03:54', '2024-09-26 00:04:03'),
(2, 23, 333, '2024-09-26', 1, '2024-09-26 00:06:03', '2024-09-26 00:07:00'),
(3, 1, 456, '2024-09-26', 1, '2024-09-26 00:10:32', '2024-09-26 00:10:32');

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
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `user_id`, `amount`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 23, 3, '2024-09-26', 1, '2024-09-26 00:07:20', '2024-09-26 00:07:34'),
(2, 1, 5, '2024-09-26', 1, '2024-09-26 00:10:44', '2024-09-26 00:10:44'),
(3, 22, 5, '2024-09-26', 1, '2024-09-26 00:10:44', '2024-09-26 00:10:44'),
(4, 23, 5, '2024-09-26', 1, '2024-09-26 00:10:44', '2024-09-26 00:10:44');

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_23_123124_create_deposites_table', 1),
(5, '2024_09_24_060339_create_meals_table', 2),
(11, '2024_09_24_090346_create_costs_table', 3),
(12, '2024_09_24_170559_create_bazars_table', 3),
(13, '2024_09_25_124826_create_notifications_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('14278824-c773-44e9-8d1a-8f3f6004b31e', 'App\\Notifications\\SendUserNotification', 'App\\Models\\User', 22, '[{\"stitle\":\"Deposite Deleted!\",\"title\":\"22 Tk Deposite Deleted!\",\"messege\":\"22 tk deposite Deleted by Admin\",\"userurl\":\"http:\\/\\/127.0.0.1:8000\\/user\\/my-deposite\",\"adminurl\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/deposite\"}]', '2024-09-26 00:25:33', '2024-09-26 00:24:51', '2024-09-26 00:25:33'),
('1627c6db-f496-4c2f-aac5-4d8f2b1a740a', 'App\\Notifications\\SendAdminNotification', 'App\\Models\\User', 1, '[{\"stitle\":\"Deposite Request Found!\",\"title\":\"Shakhawat Hosen - send Deposite Request\",\"messege\":\"An Admin update bazar. Check pending deposite history\",\"userurl\":\"http:\\/\\/127.0.0.1:8000\\/user\\/request-deposite\",\"adminurl\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/pending-deposite\",\"newuser\":{\"id\":22,\"name\":\"Shakhawat Hosen\",\"email\":\"shakhawat90831@gmail.com\",\"phone\":null,\"photo\":\"http:\\/\\/127.0.0.1:8000\\/upload\\/user\\/shakhawat-hosen_1727331791.jpg\",\"role\":\"user\",\"status\":1,\"balance\":0,\"created_at\":\"2024-09-26T06:00:58.000000Z\",\"updated_at\":\"2024-09-26T06:23:11.000000Z\"}}]', '2024-09-26 00:24:45', '2024-09-26 00:24:39', '2024-09-26 00:24:45'),
('9f5250d9-40a0-40ca-bcda-dcdc3636704b', 'App\\Notifications\\SendUserNotification', 'App\\Models\\User', 22, '[{\"stitle\":\"Admin delete your Meal\",\"title\":\"Admin delete your Meal\",\"messege\":\"An Admin Delete your meal. Check your meal history\",\"userurl\":\"http:\\/\\/127.0.0.1:8000\\/user\\/my-meal\",\"adminurl\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/meals\"}]', '2024-09-26 00:25:30', '2024-09-26 00:25:27', '2024-09-26 00:25:30'),
('afe8c41e-8a2d-4f89-9f81-f92429b5c52a', 'App\\Notifications\\SendUserNotification', 'App\\Models\\User', 22, '[{\"stitle\":\"Deposite Deleted!\",\"title\":\"345 Tk Deposite Deleted!\",\"messege\":\"345 tk deposite Deleted by Admin\",\"userurl\":\"http:\\/\\/127.0.0.1:8000\\/user\\/my-deposite\",\"adminurl\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/deposite\"}]', '2024-09-26 00:25:36', '2024-09-26 00:24:48', '2024-09-26 00:25:36'),
('c162055a-a820-45ec-8cca-e27e2da5461a', 'App\\Notifications\\SendAdminNotification', 'App\\Models\\User', 1, '[{\"stitle\":\"Bazar Request Found!\",\"title\":\"Shakhawat Hosen - send bazar Request\",\"messege\":\"An Admin update bazar. Check pending bazar history\",\"userurl\":\"http:\\/\\/127.0.0.1:8000\\/user\\/request-bazar\",\"adminurl\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/pending-bazar\",\"newuser\":{\"id\":22,\"name\":\"Shakhawat Hosen\",\"email\":\"shakhawat90831@gmail.com\",\"phone\":null,\"photo\":\"http:\\/\\/127.0.0.1:8000\\/upload\\/user\\/shakhawat-hosen_1727331791.jpg\",\"role\":\"user\",\"status\":1,\"balance\":0,\"created_at\":\"2024-09-26T06:00:58.000000Z\",\"updated_at\":\"2024-09-26T06:23:11.000000Z\"}}]', '2024-09-26 00:25:54', '2024-09-26 00:25:48', '2024-09-26 00:25:54'),
('c5993bde-e97e-4de7-86ef-af758deabed1', 'App\\Notifications\\SendUserNotification', 'App\\Models\\User', 22, '[{\"stitle\":\"Admin delete your Meal\",\"title\":\"Admin delete your Meal\",\"messege\":\"An Admin Delete your meal. Check your meal history\",\"userurl\":\"http:\\/\\/127.0.0.1:8000\\/user\\/my-meal\",\"adminurl\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/meals\"}]', '2024-09-26 00:25:35', '2024-09-26 00:25:24', '2024-09-26 00:25:35'),
('f1d023a5-c6a4-455c-b79c-6b0dfcad9f87', 'App\\Notifications\\SendAdminNotification', 'App\\Models\\User', 1, '[{\"stitle\":\"Meal Request Found!\",\"title\":\"Shakhawat Hosen - send meal Request\",\"messege\":\"An Admin update bazar. Check pending meal history\",\"userurl\":\"http:\\/\\/127.0.0.1:8000\\/user\\/request-meal\",\"adminurl\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/pending-meals\",\"newuser\":{\"id\":22,\"name\":\"Shakhawat Hosen\",\"email\":\"shakhawat90831@gmail.com\",\"phone\":null,\"photo\":\"http:\\/\\/127.0.0.1:8000\\/upload\\/user\\/shakhawat-hosen_1727331791.jpg\",\"role\":\"user\",\"status\":1,\"balance\":0,\"created_at\":\"2024-09-26T06:00:58.000000Z\",\"updated_at\":\"2024-09-26T06:23:11.000000Z\"}}]', '2024-09-26 00:25:15', '2024-09-26 00:25:09', '2024-09-26 00:25:15');

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
('4RyEIz39RsAxT5lgveqHS2ggWN0q009raBkUafcR', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTmp5UEdSRU1qREZyeE0zNUY1NXpTRXZTNEVuSk1tTTRpNE9UbEJkbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3BlbmRpbmctYmF6YXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9sb2dvdXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyMjt9', 1727331965),
('Fjj0Fmob6PS3NEjuU94FJUleHyv6QDrR3PcePwF7', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVzExQnJMRThEMzFodTd3RFZCRlVkZjNRckFXR3Vad1hRbmlJb0NhciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7fQ==', 1727329534),
('fOt3uPlQJ9ZtWJUycjdN6w0H3s0rCdFgeovBDNIx', 23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSFlNejVER3NrUlh4WU92QWx5emVJWVk0emcyMXhGUlJUYWlUdG5nbSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjM7fQ==', 1727330537),
('IVJby6ziSXnhDuggRUdofJmZIIH6gCYnQAANS3Fq', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib3pKUmhKSzhwWDV5WWpicjUwSENZaEhOYUZ5Qmh5T3NSb1V6TnlGeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9fQ==', 1727329113),
('JDqZV6kEWypVHVLExJW1c7CxbmnfXmnRzOk6LJDs', 23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVzB3OWsyZ0w3MGhxQ0R4WWY5eFlVOXNhMnA2UkN3VnA3UFVheFFQbSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjM7fQ==', 1727331973),
('mfGKt9VAgnIlPFKK8dx0FbJ1Yqgj3jCx5Fa0zgrn', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWFpDVmNqNFpkN1hRd1Z3cVRwajM1VFBTWUFZRFRXbkN3VkNlTVpaOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjI7fQ==', 1727330461),
('NinuxMO8BmZZHcpxOJfbc4t60CRDFwhRdcIO9VbY', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidUhVRHlsWUF4STQyY2MxTDRFdHcwYzZMOXRuN1UxTFY1SWw4TUpaYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7fQ==', 1727329622),
('OU6ByXRY28ua7TrRL10MJKw3XULBYJYJhEYaGROr', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQUllWVRTakZ5RlpXT1I1MnhqTGpmUHBYVkZ4ZzBLUUFBNVRBUERNZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7fQ==', 1727329715),
('P9BegoOi0o6BXuISjsOk8QliH1egQ5pyT1aR2nI2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVlA3UVE2UHcyNGRXSW5Ka1B5YXo5aVVoVVdSVnNMdTdqZ203M0RhWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZW5kaW5nLWJhemFyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1727331960),
('rZjue9w5gcQXfP2XHKSBmYayAzLfzUuZ30Vc4Dtk', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicXBMOHdTM3BXZjlsR2Nsa0l0Z1hrZHpzU2Y0b00wa1l0MWg3NkhmMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7fQ==', 1727329415),
('sdQqeWTB28AlIrHWSKacJPITvp5pF1eJnwETbphh', 20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ0FkenFRNXQ2Vm0zdEdNWEJCU2NmREszNDBNejRDNk11b0RRUGJIZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjA7fQ==', 1727330288),
('th5HmBUncBTWeQrHulHSPVJ4ot6uW76L4pYJWFKy', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNGw3d05SUjlXQlVXbWZubDlMeDZmNDlyM3Bjd296dVRYcGtCcTBiNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7fQ==', 1727329555),
('VEJJ7oYDNc8Ytpbw230hdUxs3ADBEJMASkVyCZ0I', 21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSURsOU5rVzdxTDhmbXdFVUZMb0FFNWRkZmlGNkpUZnhyVkxyUnFFSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIvbG9nb3V0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjE7fQ==', 1727330373);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `balance` float NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `photo`, `role`, `status`, `balance`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shakhawat', 'shakhawat9083@gmail.com', '01646362556', 'http://127.0.0.1:8000/upload/user/shakhawat_1727256756.jpg', 'admin', 1, 1000, NULL, '2024-09-23 11:19:24', '2024-09-25 03:32:38'),
(22, 'Shakhawat Hosen', 'shakhawat90831@gmail.com', NULL, 'http://127.0.0.1:8000/upload/user/shakhawat-hosen_1727331791.jpg', 'user', 1, 0, NULL, '2024-09-26 00:00:58', '2024-09-26 00:23:11'),
(23, 'HELLO BD', 'bdhello722@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocLaaeWIpSneo6F7SAhOpJHeksMIKkOeSTkBxUTCJdFqytnvAA=s96-c', 'user', 1, 0, NULL, '2024-09-26 00:01:58', '2024-09-26 00:02:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bazars`
--
ALTER TABLE `bazars`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `costs_user_id_foreign` (`user_id`);

--
-- Indexes for table `deposites`
--
ALTER TABLE `deposites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposites_user_id_foreign` (`user_id`);

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
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meals_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- AUTO_INCREMENT for table `bazars`
--
ALTER TABLE `bazars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deposites`
--
ALTER TABLE `deposites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `costs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deposites`
--
ALTER TABLE `deposites`
  ADD CONSTRAINT `deposites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
