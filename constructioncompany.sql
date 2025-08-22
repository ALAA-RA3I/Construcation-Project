-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2025 at 04:31 PM
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
-- Database: `constructioncompany`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup_files`
--

CREATE TABLE `backup_files` (
  `id` int(11) NOT NULL,
  `project_file_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `phone_number`, `api_token`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test', 'Client', 'client@example.com', NULL, '$2y$12$xIikxKZcGqRCNssKm1t3e.dtm3rpLYKgFZkI1pJsnSMDHjxoGIiwK', '0501234567', NULL, 1, 1, NULL, NULL, '2025-07-28 15:14:11', '2025-08-07 18:39:13', NULL),
(2, 'alaa', 'rai', 'alaa@example.com', NULL, '$2y$12$oFzkY6V.RrhH4VSpmfzCBei6FV0SOOikgiUh08oXgDB0UbsmDAM5O', '0947672246', NULL, 1, NULL, NULL, NULL, '2025-08-02 17:43:28', '2025-08-02 17:43:28', NULL),
(3, 'sadas', 'asdasd', 'asd@gmail.com', NULL, '$2y$12$TgHVYPe6bg73ZwF7/s.KkOZXddOQmspqLyJrjuVtIkG.sPJs3thIO', '0947672246', NULL, 1, NULL, NULL, NULL, '2025-08-02 18:00:44', '2025-08-02 18:00:44', NULL),
(4, 'alaa', 'alaa', 'alaa@gmail.com', NULL, '$2y$12$uUm7MO6CFKBaxX0Jsb.wJeG9OvChOYwvZZkBwyrfrysX2idHJnSEK', '0947672246', NULL, 1, NULL, NULL, NULL, '2025-08-04 17:20:17', '2025-08-04 17:20:17', NULL),
(5, 'molhem', 'barakat', 'molhem@gmail.com', NULL, '$2y$12$4Owr1RcK.HsU7fAwh2GaO.ZZSfJduaLRH44qnoTGP/IQJfoG8FgD.', '0947672246', NULL, 1, NULL, NULL, NULL, '2025-08-07 17:53:45', '2025-08-07 17:53:45', NULL),
(6, 'a', 'alaa', 'molhem1@gmail.com', NULL, '$2y$12$fa773AMuRARLjSKsA/ZmuuolLRCpv.naHisFV8QgJK2nogl2Y9gpK', '0947672246', NULL, 1, NULL, NULL, NULL, '2025-08-07 18:10:56', '2025-08-07 18:10:56', NULL),
(7, 'alaa', 'alaa', 'alaa@2025.com', NULL, '$2y$12$hGJJ00exWHbNS4RNxqfbq.Acl.qBUuZ8j8.agrAlX.eq8ep3TQwyq', '0947672246', NULL, 1, NULL, NULL, NULL, '2025-08-07 18:24:40', '2025-08-07 18:24:40', NULL),
(8, 'ali', 'ali', 'ali@gmail.com', NULL, '$2y$12$CVezDPpsj42woMJHrwYIB.MDdv5WlJQLC54Zo3nF/XHe89AC66cJO', '0955612518', NULL, 1, NULL, NULL, NULL, '2025-08-12 20:23:42', '2025-08-12 20:23:42', NULL),
(9, 'george', 'wassof', 'alaaraialbalha@gmail.com', NULL, '$2y$12$7srHkGJJ0qxNLFu/muG38OP9drSdzRGyNedt/8YsdCdTBXnj7c1TW', '0947672246', NULL, 1, NULL, NULL, NULL, '2025-08-15 19:44:13', '2025-08-15 19:44:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consulting_companies`
--

CREATE TABLE `consulting_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `focal_point_first_name` varchar(255) NOT NULL,
  `focal_point_last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `land_line` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consulting_companies`
--

INSERT INTO `consulting_companies` (`id`, `name`, `email`, `focal_point_first_name`, `focal_point_last_name`, `address`, `phone_number`, `land_line`, `license_number`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vision Consultants', 'info@visionconsultants.com', 'Ahmed', 'Khaled', '123 Nile Street, Cairo, Egypt', '201237890', '2023456789', '567890', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(2, 'Future Advisory', 'contact@futureadvisory.org', 'Salma', 'Hassan', '45 Smart Village, Giza, Egypt', '2098765432', '2029876543', '123456', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consulting_engineers`
--

CREATE TABLE `consulting_engineers` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `consulting_company_id` int(11) NOT NULL,
  `engineer_specialization_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consulting_engineers`
--

INSERT INTO `consulting_engineers` (`id`, `user_id`, `consulting_company_id`, `engineer_specialization_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 12, 1, 1, NULL, NULL, NULL, '2025-07-28 15:14:04', '2025-07-28 15:14:04', NULL),
(2, 13, 1, 1, NULL, NULL, NULL, '2025-07-28 15:14:04', '2025-07-28 15:14:04', NULL),
(3, 14, 1, 1, NULL, NULL, NULL, '2025-07-28 15:14:04', '2025-07-28 15:14:04', NULL),
(4, 15, 2, 1, NULL, NULL, NULL, '2025-07-28 15:14:05', '2025-07-28 15:14:05', NULL),
(5, 16, 2, 1, NULL, NULL, NULL, '2025-07-28 15:14:05', '2025-07-28 15:14:05', NULL),
(6, 17, 2, 1, NULL, NULL, NULL, '2025-07-28 15:14:05', '2025-07-28 15:14:05', NULL),
(7, 18, 1, 1, NULL, NULL, NULL, '2025-07-28 15:14:05', '2025-07-28 15:14:05', NULL),
(8, 19, 2, 1, NULL, NULL, NULL, '2025-07-28 15:14:06', '2025-07-28 15:14:06', NULL),
(9, 20, 1, 1, NULL, NULL, NULL, '2025-07-28 15:14:06', '2025-07-28 15:14:06', NULL),
(10, 21, 1, 1, NULL, NULL, NULL, '2025-07-28 15:14:06', '2025-07-28 15:14:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `engineers`
--

CREATE TABLE `engineers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `engineer_specialization_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `engineers`
--

INSERT INTO `engineers` (`id`, `user_id`, `years_of_experience`, `engineer_specialization_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 6, 1, NULL, NULL, NULL, '2025-07-28 15:14:01', '2025-07-28 15:14:01', NULL),
(2, 3, 7, 1, NULL, NULL, NULL, '2025-07-28 15:14:01', '2025-07-28 15:14:01', NULL),
(3, 4, 1, 1, NULL, NULL, NULL, '2025-07-28 15:14:01', '2025-07-28 15:14:01', NULL),
(4, 5, 5, 1, NULL, NULL, NULL, '2025-07-28 15:14:02', '2025-07-28 15:14:02', NULL),
(5, 6, 7, 1, NULL, NULL, NULL, '2025-07-28 15:14:02', '2025-07-28 15:14:02', NULL),
(6, 7, 4, 1, NULL, NULL, NULL, '2025-07-28 15:14:02', '2025-07-28 15:14:02', NULL),
(7, 8, 6, 1, NULL, NULL, NULL, '2025-07-28 15:14:03', '2025-07-28 15:14:03', NULL),
(8, 9, 1, 1, NULL, NULL, NULL, '2025-07-28 15:14:03', '2025-07-28 15:14:03', NULL),
(9, 10, 6, 1, NULL, NULL, NULL, '2025-07-28 15:14:03', '2025-07-28 15:14:03', NULL),
(10, 11, 6, 1, NULL, NULL, NULL, '2025-07-28 15:14:03', '2025-07-28 15:14:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `engineer_specializations`
--

CREATE TABLE `engineer_specializations` (
  `id` int(11) NOT NULL,
  `name_of_major` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `engineer_specializations`
--

INSERT INTO `engineer_specializations` (`id`, `name_of_major`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Civil Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(2, 'Electrical Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(3, 'Mechanical Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(4, 'Architectural Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(5, 'Computer Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(6, 'Environmental Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(7, 'Industrial Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(8, 'Structural Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(9, 'Geotechnical Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL),
(10, 'Chemical Engineering', NULL, NULL, NULL, '2025-07-28 15:14:00', '2025-07-28 15:14:00', NULL);

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
(4, '2025_05_16_131953_create_personal_access_tokens_table', 1),
(5, '2025_05_16_162744_create_engineer_specializations_table', 1),
(6, '2025_05_16_164521_create_consulting_companies_table', 1),
(7, '2025_05_16_164918_create_consulting_engineers_table', 1),
(8, '2025_05_16_165942_create_owners_table', 1),
(9, '2025_05_16_170403_create_owner_payments_table', 1),
(10, '2025_05_16_200246_create_projects_table', 1),
(11, '2025_05_16_202420_create_project_participants_table', 1),
(12, '2025_05_16_204643_create_project_stages_table', 1),
(13, '2025_05_16_205351_create_project_bills_table', 1),
(14, '2025_05_16_205855_create_project_bill_details_table', 1),
(15, '2025_05_16_211540_create_project_files_table', 1),
(16, '2025_05_16_212402_create_backup_files_table', 1),
(17, '2025_05_16_213628_create_items_table', 1),
(18, '2025_05_16_213907_create_project_containers_table', 1),
(19, '2025_05_16_214654_create_tasks_table', 1),
(20, '2025_05_16_220342_create_task_containers_table', 1),
(21, '2025_05_16_220941_create_tickets_table', 1),
(22, '2025_05_18_194220_create_engineers_table', 1),
(23, '2025_05_18_194229_create_real_state_managers_table', 1),
(24, '2025_05_18_203504_create_permission_tables', 1),
(25, '2025_06_04_121247_add_columns_to_backup_files_table', 1),
(26, '2025_06_10_212123_remove_hash_column_from_backup_files_table', 1),
(27, '2025_06_13_213940_create_project_managers_table', 1),
(28, '2025_06_28_222449_add_start_date_and_priority_to_tasks_table', 1),
(29, '2025_06_28_222450_add_start_description_to_tasks_table', 1),
(30, '2025_06_28_222450_add_title_to_tasks_table copy', 1),
(31, '2025_06_28_222515_add_start_date_and_priority_to_project_stages_table', 1),
(32, '2025_06_28_223932_make_actual_date_of_closed_nullable_in_tasks_table copy', 1),
(33, '2025_06_28_223933_make_description_string_in_tasks_table', 1),
(34, '2025_07_03_194450_create_clients_table', 1),
(35, '2025_07_03_214116_make_api_token_nullable_in_clients_table', 1),
(36, '2025_07_05_133121_update_project_containers_table', 1),
(37, '2025_07_06_000211_add_unit_column_to_items_table', 1),
(38, '2025_07_07_122024_create_project_sales_details_table', 1),
(39, '2025_07_07_181709_create_property_books_table', 1),
(40, '2025_07_07_181800_create_property_units_table', 1),
(41, '2025_07_07_184733_create_property_book_bills_table', 1),
(42, '2025_07_07_1941191_create_user_property_unit_installments_table', 1),
(43, '2025_07_07_1958051_create_property_unit_orders_table', 1),
(44, '2025_07_07_201400_create_project_media_table', 1),
(45, '2025_07_07_201836_create_project_news_table', 1),
(46, '2025_07_13_205708_update_task_status_enum_values', 1),
(47, '2025_07_14_232929_add_contract_fields_to_property_unit_orders_table', 1),
(48, '2025_07_14_234113_update_property_unit_orders_status_enum', 1),
(49, '2025_08_07_211356_remove_national_id_from_clients', 2),
(50, '2025_08_07_211456_remove_clearance_certificate_from_property_unit_orders', 2),
(51, '2025_08_15_223230_add_email_verified_to_clients_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 27),
(2, 'App\\Models\\User', 28),
(2, 'App\\Models\\User', 29),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 12),
(4, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 16),
(4, 'App\\Models\\User', 17),
(4, 'App\\Models\\User', 18),
(4, 'App\\Models\\User', 19),
(4, 'App\\Models\\User', 20),
(4, 'App\\Models\\User', 21),
(6, 'App\\Models\\User', 22),
(6, 'App\\Models\\User', 23),
(6, 'App\\Models\\User', 24),
(6, 'App\\Models\\User', 25),
(6, 'App\\Models\\User', 26);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `user_id`, `address`, `national_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 32, 'bio1', '16838', NULL, NULL, NULL, '2025-07-28 15:14:10', '2025-07-28 15:14:10', NULL),
(2, 33, 'bio2', '16485', NULL, NULL, NULL, '2025-07-28 15:14:10', '2025-07-28 15:14:10', NULL),
(3, 34, 'bio3', '19578', NULL, NULL, NULL, '2025-07-28 15:14:10', '2025-07-28 15:14:10', NULL),
(4, 35, 'bio4', '12271', NULL, NULL, NULL, '2025-07-28 15:14:11', '2025-07-28 15:14:11', NULL),
(5, 36, 'bio5', '12740', NULL, NULL, NULL, '2025-07-28 15:14:11', '2025-07-28 15:14:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `owner_payments`
--

CREATE TABLE `owner_payments` (
  `id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `date_of_payment` date NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view statistics', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(2, 'activate user', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(3, 'view project managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(4, 'create project managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(5, 'edit project managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(6, 'delete project managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(7, 'profile project managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(8, 'view engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(9, 'create engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(10, 'edit engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(11, 'delete engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(12, 'profile engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(13, 'view consulting company', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(14, 'create consulting company', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(15, 'edit consulting company', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(16, 'delete consulting company', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(17, 'profile consulting company', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(18, 'view consulting engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(19, 'create consulting engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(20, 'edit consulting engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(21, 'delete consulting engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(22, 'profile consulting engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(23, 'view owners', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(24, 'create owners', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(25, 'edit owners', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(26, 'delete owners', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(27, 'view real estate managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(28, 'create real estate managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(29, 'edit real estate managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(30, 'delete real estate managers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(31, 'view projects', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(32, 'create projects', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(33, 'edit projects', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(34, 'delete projects', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(35, 'details projects', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(36, 'assign project engineers', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(37, 'view project department studies', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(38, 'view project department execution', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(39, 'view project resources management', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(40, 'view reports resource management', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(41, 'export reports resource management', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(42, 'view project container', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(43, 'add project container items', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(44, 'view financial payments', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(45, 'view details payments', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(46, 'add financial payments', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(47, 'view stages', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(48, 'create stages', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(49, 'edit stages', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(50, 'delete stages', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(51, 'view tasks', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(52, 'create tasks', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(53, 'edit tasks', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(54, 'delete tasks', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(55, 'done tasks', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(56, 'accept tasks', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(57, 'reject tasks', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(58, 'view diagrams', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(59, 'upload diagrams', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(60, 'update diagrams', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(61, 'delete diagrams', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(62, 'view archive diagrams', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(63, 'view items', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(64, 'create items', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(65, 'edit items', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(66, 'delete items', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(67, 'view tickets', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(68, 'create tickets', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(69, 'change tickets status', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'api_token', 'f893459f955c0992ef7510fc563942292aff9480f568b864900e6f5ab7c50b58', '[\"*\"]', '2025-07-28 15:25:59', NULL, '2025-07-28 15:15:19', '2025-07-28 15:25:59'),
(2, 'App\\Models\\Client', 1, 'api_token', '89fd0328b7bf2a4c09a28fd1c4314254239e0b2a2a908c288f77d1b91240387b', '[\"*\"]', '2025-07-28 16:33:23', NULL, '2025-07-28 15:52:03', '2025-07-28 16:33:23'),
(3, 'App\\Models\\Client', 1, 'api_token', 'a34cb8edca602bb479f8bacffd00a777c8c685df1cc7646d9a91171a7c40555b', '[\"*\"]', '2025-08-07 18:39:12', NULL, '2025-08-07 18:31:16', '2025-08-07 18:39:12'),
(4, 'App\\Models\\Client', 1, 'api_token', 'f06300b9c9f9868abb938c12cbc7194d2a2942050e5504334c35306a9e441df7', '[\"*\"]', NULL, NULL, '2025-08-07 18:39:23', '2025-08-07 18:39:23'),
(5, 'App\\Models\\User', 12, 'api_token', 'bddaf2c6756ec15dd2386edabc6eff59e3bb5407215bcd118c4ffb5aea1d3e94', '[\"*\"]', '2025-08-12 20:49:57', NULL, '2025-08-12 20:43:34', '2025-08-12 20:49:57'),
(6, 'App\\Models\\User', 12, 'api_token', '32165e3c576b3d67d28018ab3f9ca4c22de371a9861c2bfdc9f4cfda6e16e094', '[\"*\"]', '2025-08-15 11:06:47', NULL, '2025-08-15 10:58:32', '2025-08-15 11:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `project_code` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `location` varchar(255) NOT NULL,
  `area` int(11) NOT NULL,
  `number_of_floor` int(11) DEFAULT NULL,
  `status_of_sale` enum('ForSale','NotForSale') NOT NULL DEFAULT 'NotForSale',
  `expected_date_of_completed` date NOT NULL,
  `type` enum('Commercial','Residential') NOT NULL DEFAULT 'Commercial',
  `progress_status` enum('Initial','InProgress','Done') NOT NULL DEFAULT 'Initial',
  `expected_cost` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `consulting_company_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `project_code`, `description`, `location`, `area`, `number_of_floor`, `status_of_sale`, `expected_date_of_completed`, `type`, `progress_status`, `expected_cost`, `owner_id`, `consulting_company_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'midan project', 'sad241sad', 'marote', 'damascus - midan', 13434, 7, 'ForSale', '2022-01-01', 'Commercial', 'Initial', 10000000, 1, 2, 1, NULL, NULL, '2025-07-28 15:15:31', '2025-07-28 15:15:31', NULL),
(2, 'midan project', 'sad241sadasd', 'marote', 'damascus - midan', 13434, 7, 'ForSale', '2022-01-01', 'Commercial', 'Initial', 10000000, 1, 2, 1, NULL, NULL, '2025-07-28 15:15:40', '2025-07-28 15:15:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_bills`
--

CREATE TABLE `project_bills` (
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `date_of_payment` date NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_bill_details`
--

CREATE TABLE `project_bill_details` (
  `id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `cost` decimal(12,2) NOT NULL,
  `project_bill_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_containers`
--

CREATE TABLE `project_containers` (
  `id` int(11) NOT NULL,
  `quantity_available` int(11) NOT NULL DEFAULT 0,
  `expected_quantity` int(11) NOT NULL DEFAULT 0,
  `consumed_quantity` int(11) NOT NULL DEFAULT 0,
  `items_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_participant_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `file_path`, `description`, `project_id`, `project_participant_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/3e727965-96c2-4a16-977b-91872afc44da.pdf', 'file', 1, 1, 12, NULL, NULL, '2025-08-12 20:44:54', '2025-08-12 20:44:54', NULL),
(2, 'uploads/ise_6_7189.pdf', 'file', 1, 1, 12, NULL, NULL, '2025-08-12 20:49:57', '2025-08-12 20:49:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_managers`
--

CREATE TABLE `project_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_managers`
--

INSERT INTO `project_managers` (`id`, `user_id`, `years_of_experience`, `bio`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 27, 5, 'bio1', NULL, NULL, NULL, '2025-07-28 15:14:08', '2025-07-28 15:14:08', NULL),
(2, 28, 5, 'bio2', NULL, NULL, NULL, '2025-07-28 15:14:09', '2025-07-28 15:14:09', NULL),
(3, 29, 9, 'bio3', NULL, NULL, NULL, '2025-07-28 15:14:09', '2025-07-28 15:14:09', NULL),
(4, 30, 8, 'bio4', NULL, NULL, NULL, '2025-07-28 15:14:09', '2025-07-28 15:14:09', NULL),
(5, 31, 4, 'bio5', NULL, NULL, NULL, '2025-07-28 15:14:10', '2025-07-28 15:14:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_media`
--

CREATE TABLE `project_media` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_news`
--

CREATE TABLE `project_news` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_news`
--

INSERT INTO `project_news` (`id`, `project_id`, `path_file`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'asdasd.png', 'news 1', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'asdas.jpeg', 'news 2', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'asdasdas.png', 'news 1 project 2', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_participants`
--

CREATE TABLE `project_participants` (
  `id` int(11) NOT NULL,
  `participant_type` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `role` enum('project_manager','engineer','study_engineer') NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_participants`
--

INSERT INTO `project_participants` (`id`, `participant_type`, `project_id`, `participant_id`, `role`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'project_manager', 1, 2, 'project_manager', 1, NULL, NULL, '2025-07-28 15:15:31', '2025-07-28 15:15:31', NULL),
(2, 'consulting_engineer', 1, 4, 'study_engineer', 1, NULL, NULL, '2025-07-28 15:15:31', '2025-07-28 15:15:31', NULL),
(3, 'consulting_engineer', 1, 5, 'study_engineer', 1, NULL, NULL, '2025-07-28 15:15:31', '2025-07-28 15:15:31', NULL),
(4, 'consulting_engineer', 1, 6, 'study_engineer', 1, NULL, NULL, '2025-07-28 15:15:31', '2025-07-28 15:15:31', NULL),
(5, 'consulting_engineer', 1, 8, 'study_engineer', 1, NULL, NULL, '2025-07-28 15:15:31', '2025-07-28 15:15:31', NULL),
(6, 'project_manager', 2, 2, 'project_manager', 1, NULL, NULL, '2025-07-28 15:15:40', '2025-07-28 15:15:40', NULL),
(7, 'consulting_engineer', 2, 4, 'study_engineer', 1, NULL, NULL, '2025-07-28 15:15:40', '2025-07-28 15:15:40', NULL),
(8, 'consulting_engineer', 2, 5, 'study_engineer', 1, NULL, NULL, '2025-07-28 15:15:40', '2025-07-28 15:15:40', NULL),
(9, 'consulting_engineer', 2, 6, 'study_engineer', 1, NULL, NULL, '2025-07-28 15:15:40', '2025-07-28 15:15:40', NULL),
(10, 'consulting_engineer', 2, 8, 'study_engineer', 1, NULL, NULL, '2025-07-28 15:15:40', '2025-07-28 15:15:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_sales_details`
--

CREATE TABLE `project_sales_details` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `main_title` varchar(255) DEFAULT NULL,
  `marketing_description` longtext DEFAULT NULL,
  `location_link` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `diagram_image` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_sales_details`
--

INSERT INTO `project_sales_details` (`id`, `project_id`, `main_title`, `marketing_description`, `location_link`, `address`, `video_url`, `main_image`, `diagram_image`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Massa Plaza', 'Mall In Midan', 'https://maps.app.goo.gl/Hq2qjyHqo84tE25D9', 'Damascus - Midan', NULL, 'project-sales-details/2418e8c2-7280-4980-a58e-b11672e2f4ad.jpg', 'project-sales-details/db7b2573-5929-4509-8c6b-d4db546a759d.jpg', 1, NULL, NULL, '2025-07-28 15:17:54', '2025-07-28 15:17:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_stages`
--

CREATE TABLE `project_stages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `expected_closed_date` date NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_stages`
--

INSERT INTO `project_stages` (`id`, `name`, `description`, `start_date`, `priority`, `expected_closed_date`, `project_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'طابق 2', 'طابق اول يسطا1', '2022-01-01', 2, '2022-01-01', 1, 1, NULL, NULL, '2025-07-28 15:15:57', '2025-07-28 15:15:57', NULL),
(2, 'طابق 2', 'طابق اول يسطا1', '2022-01-01', 2, '2022-01-01', 1, 1, NULL, NULL, '2025-07-28 15:16:01', '2025-07-28 15:16:01', NULL),
(3, 'طابق 2', 'طابق اول يسطا1', '2022-01-01', 2, '2022-01-01', 2, 1, NULL, NULL, '2025-07-28 15:16:03', '2025-07-28 15:16:03', NULL),
(4, 'طابق 2', 'طابق اول يسطا1', '2022-01-01', 2, '2022-01-01', 2, 1, NULL, NULL, '2025-07-28 15:16:05', '2025-07-28 15:16:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_books`
--

CREATE TABLE `property_books` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `space` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `first_payment_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `description` longtext DEFAULT NULL,
  `payment_period` int(11) DEFAULT NULL,
  `available_units` int(11) NOT NULL DEFAULT 0,
  `number_of_rooms` int(11) DEFAULT NULL,
  `number_of_bathrooms` int(11) DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `diagram_image` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_books`
--

INSERT INTO `property_books` (`id`, `project_id`, `model`, `space`, `price`, `first_payment_amount`, `description`, `payment_period`, `available_units`, `number_of_rooms`, `number_of_bathrooms`, `direction`, `diagram_image`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'A', 2, 1000000.00, 100000.00, 'marota', 12, 20, 3, 3, 'south', 'property-books/5316b805-1ca5-4093-a1ec-5283b8c67bed.jpg', 1, NULL, NULL, '2025-07-28 15:20:33', '2025-07-28 15:20:33', NULL),
(2, 1, 'B', 20000, 1000000.00, 100000.00, 'marota', 12, 20, 4, 1, 'north', 'property-books/diagram_image.jpg', 1, NULL, NULL, '2025-07-28 15:21:14', '2025-07-28 15:21:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_book_bills`
--

CREATE TABLE `property_book_bills` (
  `id` int(11) NOT NULL,
  `property_book_id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_book_bills`
--

INSERT INTO `property_book_bills` (`id`, `property_book_id`, `amount`, `description`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3000000.00, NULL, 1, NULL, NULL, '2025-07-28 15:24:15', '2025-07-28 15:24:15', NULL),
(2, 1, 3000000.00, NULL, 1, NULL, NULL, '2025-07-28 15:24:22', '2025-07-28 15:24:22', NULL),
(3, 1, 4000000.00, NULL, 1, NULL, NULL, '2025-07-28 15:24:27', '2025-07-28 15:24:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_units`
--

CREATE TABLE `property_units` (
  `id` int(11) NOT NULL,
  `property_book_id` int(11) NOT NULL,
  `first_payment_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_units`
--

INSERT INTO `property_units` (`id`, `property_book_id`, `first_payment_date`, `client_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2025-07-28', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_unit_orders`
--

CREATE TABLE `property_unit_orders` (
  `id` int(11) NOT NULL,
  `priority_number` int(11) NOT NULL,
  `property_book_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `identity_file` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected','contract_ready','payment_pending','payment_completed','contract_signed','contract_finalized') DEFAULT 'pending',
  `note` longtext NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `contract_file` varchar(255) DEFAULT NULL,
  `contract_hash` varchar(255) DEFAULT NULL,
  `contract_sent_at` timestamp NULL DEFAULT NULL,
  `signature_code` varchar(255) DEFAULT NULL,
  `signature_code_sent_at` timestamp NULL DEFAULT NULL,
  `client_signed_at` timestamp NULL DEFAULT NULL,
  `company_signed_at` timestamp NULL DEFAULT NULL,
  `payment_intent_id` varchar(255) DEFAULT NULL,
  `payment_amount` decimal(12,2) DEFAULT NULL,
  `payment_completed_at` timestamp NULL DEFAULT NULL,
  `activation_token` varchar(255) DEFAULT NULL,
  `activation_token_sent_at` timestamp NULL DEFAULT NULL,
  `account_activated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_unit_orders`
--

INSERT INTO `property_unit_orders` (`id`, `priority_number`, `property_book_id`, `client_id`, `identity_file`, `status`, `note`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `contract_file`, `contract_hash`, `contract_sent_at`, `signature_code`, `signature_code_sent_at`, `client_signed_at`, `company_signed_at`, `payment_intent_id`, `payment_amount`, `payment_completed_at`, `activation_token`, `activation_token_sent_at`, `account_activated_at`) VALUES
(1, 1000, 1, 1, 'property-unit-orders/identity/25a4f5b5-be3e-4ca0-a0c9-374631f9b148.png', 'rejected', 'asd', NULL, NULL, NULL, '2025-08-07 16:51:40', '2025-08-15 20:33:51', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1000, 1, 1, 'property-unit-orders/identity/f3693ab1-9fba-499e-ae52-d8320918e8e5.jpg', 'payment_pending', 'asd', NULL, NULL, NULL, '2025-08-07 16:52:42', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1001, 1, 1, 'property-unit-orders/identity/a5c29da6-2fef-4e46-ac69-9deafe048add.png', 'payment_completed', 'asd', NULL, NULL, NULL, '2025-08-07 16:57:30', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1002, 1, 1, 'property-unit-orders/identity/dc6d965b-90bc-4332-9cf8-4016ce327a0e.pdf', 'contract_signed', 'asd', NULL, NULL, NULL, '2025-08-07 16:58:15', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1003, 1, 1, 'property-unit-orders/identity/0e1bc21f-b613-47e4-ad51-f4ff85f4d07b.png', 'pending', 'ششش', NULL, NULL, NULL, '2025-08-07 17:01:03', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1004, 1, 1, 'property-unit-orders/identity/14c4ebdb-f641-49b4-a0cf-81a4b5781b8f.png', 'pending', 'ييي', NULL, NULL, NULL, '2025-08-07 17:01:25', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1005, 1, 1, 'property-unit-orders/identity/be16d2b6-40ee-4800-9595-1e43dafc9261.png', 'pending', 'شسي', NULL, NULL, NULL, '2025-08-07 17:02:54', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1006, 1, 1, 'property-unit-orders/identity/a437a03a-ff1f-451a-b86d-8c5917169840.jpg', 'pending', 'سيشس', NULL, NULL, NULL, '2025-08-07 17:04:14', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1007, 1, 1, 'property-unit-orders/identity/750089a2-6904-4adc-92f4-329ac6a8e25c.pdf', 'pending', 'سٍيس', NULL, NULL, NULL, '2025-08-07 17:04:45', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1008, 1, 1, 'property-unit-orders/identity/6765c4a8-6c53-451f-a51f-feb63b875417.png', 'pending', 'asd', NULL, NULL, NULL, '2025-08-07 17:37:45', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1009, 1, 1, 'property-unit-orders/identity/1270cd65-6a9d-4499-8e7a-df0f4e60c2e4.jpg', 'pending', 'dsad', NULL, NULL, NULL, '2025-08-07 17:41:34', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1010, 1, 1, 'property-unit-orders/identity/512a318e-5c49-4160-9ba2-3bd2ef576942.png', 'pending', 'asd', NULL, NULL, NULL, '2025-08-07 17:42:48', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1011, 1, 1, 'property-unit-orders/identity/cadb4595-e0ff-4f13-b645-e7d3cd5aa305.jpg', 'pending', 'asd', NULL, NULL, NULL, '2025-08-07 17:45:06', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1012, 1, 1, 'property-unit-orders/identity/5b1726d5-fe6a-448d-856f-443e00065d9f.jpg', 'pending', 'asd', NULL, NULL, NULL, '2025-08-07 17:45:26', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1013, 1, 1, 'property-unit-orders/identity/4255bde2-edfa-478e-865e-27009ccbe163.jpg', 'pending', 'asd', NULL, NULL, NULL, '2025-08-07 17:47:46', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1014, 1, 1, 'property-unit-orders/identity/2ad07829-81ac-4893-a545-02bea0fbfe98.pdf', 'pending', 'asdasd', NULL, NULL, NULL, '2025-08-07 17:48:54', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1015, 1, 1, 'property-unit-orders/identity/39fcd6db-8ef2-4300-b3d5-e2ec06fd91c9.jpg', 'pending', 'asdasd', NULL, NULL, NULL, '2025-08-07 17:51:41', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1016, 1, 1, 'property-unit-orders/identity/1ecc2808-0d1b-4652-82f0-1d9816aa2515.png', 'pending', 'asdasd', NULL, NULL, NULL, '2025-08-07 17:52:41', '2025-08-15 20:33:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `real_state_managers`
--

CREATE TABLE `real_state_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `real_state_managers`
--

INSERT INTO `real_state_managers` (`id`, `user_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 22, NULL, NULL, NULL, '2025-07-28 15:14:07', '2025-07-28 15:14:07', NULL),
(2, 23, NULL, NULL, NULL, '2025-07-28 15:14:07', '2025-07-28 15:14:07', NULL),
(3, 24, NULL, NULL, NULL, '2025-07-28 15:14:07', '2025-07-28 15:14:07', NULL),
(4, 25, NULL, NULL, NULL, '2025-07-28 15:14:08', '2025-07-28 15:14:08', NULL),
(5, 26, NULL, NULL, NULL, '2025-07-28 15:14:08', '2025-07-28 15:14:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-07-28 15:13:59', '2025-07-28 15:13:59'),
(2, 'projectManager', 'web', '2025-07-28 15:14:00', '2025-07-28 15:14:00'),
(3, 'engineer', 'web', '2025-07-28 15:14:00', '2025-07-28 15:14:00'),
(4, 'consultingEngineer', 'web', '2025-07-28 15:14:00', '2025-07-28 15:14:00'),
(5, 'owner', 'web', '2025-07-28 15:14:00', '2025-07-28 15:14:00'),
(6, 'realStateManager', 'web', '2025-07-28 15:14:00', '2025-07-28 15:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(31, 2),
(31, 3),
(31, 4),
(31, 5),
(31, 6),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(35, 5),
(36, 2),
(37, 1),
(37, 2),
(37, 3),
(37, 4),
(38, 1),
(38, 2),
(38, 3),
(38, 4),
(38, 5),
(39, 1),
(39, 2),
(39, 3),
(39, 4),
(39, 5),
(40, 1),
(40, 2),
(40, 4),
(40, 5),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(42, 3),
(43, 2),
(44, 1),
(44, 2),
(44, 4),
(44, 5),
(45, 1),
(45, 2),
(45, 4),
(45, 5),
(46, 2),
(47, 1),
(47, 2),
(47, 3),
(47, 4),
(47, 5),
(48, 2),
(49, 2),
(50, 2),
(51, 1),
(51, 2),
(51, 3),
(51, 4),
(51, 5),
(52, 2),
(53, 2),
(54, 2),
(55, 3),
(56, 4),
(57, 4),
(58, 1),
(58, 2),
(58, 3),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 1),
(62, 2),
(62, 3),
(62, 4),
(63, 1),
(63, 2),
(63, 3),
(63, 4),
(64, 4),
(65, 4),
(66, 4),
(67, 2),
(67, 3),
(67, 4),
(68, 2),
(68, 3),
(68, 4),
(69, 2),
(69, 3),
(69, 4);

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
('lanmlYEs404SoRId9uQQDjITo52qpEXSOm6NYOF2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSXNyMjk0WEQzZUxrVWk1b3d5eGtjZDBrVVlSWDh2RGZDT3hiQXVmaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9teS1vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUzOiJsb2dpbl9jbGllbnRfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1755301883),
('Q0NQPAnGilGY8wqfRsFp8QfBoflJW9feFQeiuqNz', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36 Edg/139.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0VObG9PTWFEcXZnTXZKVFdNUlIySElWRkhmaWpzS21aZEpGTDNzViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9teS1vcmRlcnMiO31zOjUzOiJsb2dpbl9jbGllbnRfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1755301483);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `dead_line` date NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('ToDo','Doing','pendingApproval','waitingTicket','Done') DEFAULT 'ToDo',
  `type_of_task` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `actual_date_of_closed` date DEFAULT NULL,
  `stage_id` int(11) NOT NULL,
  `employee_assigned` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `start_date`, `priority`, `dead_line`, `title`, `description`, `status`, `type_of_task`, `note`, `actual_date_of_closed`, `stage_id`, `employee_assigned`, `supervisor_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-01-01', 2, '2022-01-03', 'task 2', 'hi', 'ToDo', 'طابق eثاني صب', 'important', NULL, 1, 1, 2, 1, NULL, NULL, '2025-07-28 15:16:19', '2025-07-28 15:16:19', NULL),
(2, '2021-01-01', 2, '2022-01-03', 'task 1', 'hi', 'ToDo', 'طابق eثاني صب', 'important', NULL, 1, 1, 2, 1, NULL, NULL, '2025-07-28 15:16:23', '2025-07-28 15:16:23', NULL),
(3, '2021-01-01', 2, '2022-01-03', 'task 1', 'hi', 'ToDo', 'طابق eثاني صب', 'important', NULL, 2, 1, 2, 1, NULL, NULL, '2025-07-28 15:16:30', '2025-07-28 15:16:30', NULL),
(4, '2021-01-01', 2, '2022-01-03', 'task 1', 'hi', 'ToDo', 'طابق eثاني صب', 'important', NULL, 3, 1, 2, 1, NULL, NULL, '2025-07-28 15:16:32', '2025-07-28 15:16:32', NULL),
(5, '2021-01-01', 2, '2022-01-03', 'task 1', 'hi', 'ToDo', 'طابق eثاني صب', 'important', NULL, 3, 1, 2, 1, NULL, NULL, '2025-07-28 15:16:33', '2025-07-28 15:16:33', NULL),
(6, '2021-01-01', 2, '2022-01-03', 'task 1', 'hi', 'ToDo', 'طابق eثاني صب', 'important', NULL, 4, 1, 2, 1, NULL, NULL, '2025-07-28 15:16:35', '2025-07-28 15:16:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_containers`
--

CREATE TABLE `task_containers` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('Open','Closed') NOT NULL DEFAULT 'Open',
  `task_id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `is_active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'User', 'admin@example.com', '$2y$12$kpRv0tcwPA8BabNm80iW2eZT8n58hwYCYkaU6gSFyHscEREC71XxG', '1234567890', 1, NULL, NULL, NULL, '2025-07-28 15:14:01', '2025-07-28 15:14:01', NULL),
(2, 'Engineer1', 'Lastname1', 'engineer1@example.com', '$2y$12$xmPNgYHnEqp7QHvIcoecfuD1.GT4JXOYW9MpanMqd0L3D72Ci.ZU.', '0500000001', 1, NULL, NULL, NULL, '2025-07-28 15:14:01', '2025-07-28 15:14:01', NULL),
(3, 'Engineer2', 'Lastname2', 'engineer2@example.com', '$2y$12$OGccTTr/8k0eGm6TDX6LiuaZQM3tw4OUN.0dJXKmFIQptXP3NUAVG', '0500000002', 1, NULL, NULL, NULL, '2025-07-28 15:14:01', '2025-07-28 15:14:01', NULL),
(4, 'Engineer3', 'Lastname3', 'engineer3@example.com', '$2y$12$FfkDvuKbFCSFaCB1G29mReqskfLx37LpnNP133pwLs0nMnFbQOHh6', '0500000003', 1, NULL, NULL, NULL, '2025-07-28 15:14:01', '2025-07-28 15:14:01', NULL),
(5, 'Engineer4', 'Lastname4', 'engineer4@example.com', '$2y$12$/355PxtpDRNjRxey.KNVNeNQ7MxknBi/bdQeS2U2mWqY8fAdvPXZO', '0500000004', 1, NULL, NULL, NULL, '2025-07-28 15:14:02', '2025-07-28 15:14:02', NULL),
(6, 'Engineer5', 'Lastname5', 'engineer5@example.com', '$2y$12$7w8lUsC7f4oQgnn9DVg22eL14BULDR9hoUKt6EESxb9RHC4Op51Am', '0500000005', 1, NULL, NULL, NULL, '2025-07-28 15:14:02', '2025-07-28 15:14:02', NULL),
(7, 'Engineer6', 'Lastname6', 'engineer6@example.com', '$2y$12$1kWr8.yRc8TOM6n/XF9CR.amY6k7lCGg9q.wv1eqdte7LzYdDojEW', '0500000006', 1, NULL, NULL, NULL, '2025-07-28 15:14:02', '2025-07-28 15:14:02', NULL),
(8, 'Engineer7', 'Lastname7', 'engineer7@example.com', '$2y$12$fBp4X8hVjZ5kczEKo1HX9eufxWlTD4w7Fc4HQmzYmVJx..XeZU/ka', '0500000007', 1, NULL, NULL, NULL, '2025-07-28 15:14:03', '2025-07-28 15:14:03', NULL),
(9, 'Engineer8', 'Lastname8', 'engineer8@example.com', '$2y$12$4i8urPfLHcqTSbftceZgFuKjr1EADneamrLTUF9urNbAKp6hJPBIi', '0500000008', 1, NULL, NULL, NULL, '2025-07-28 15:14:03', '2025-07-28 15:14:03', NULL),
(10, 'Engineer9', 'Lastname9', 'engineer9@example.com', '$2y$12$YAiNvT0pu2YCHbzFYh9v0OJN8acZLk6OFCAsPA3MbrowUW/AtO7p.', '0500000009', 1, NULL, NULL, NULL, '2025-07-28 15:14:03', '2025-07-28 15:14:03', NULL),
(11, 'Engineer10', 'Lastname10', 'engineer10@example.com', '$2y$12$gnPBdSUJPpw/04DLyS9uduyugkyIYQ2DZO3RUklQOoYa3mYIzzk2i', '05000000010', 1, NULL, NULL, NULL, '2025-07-28 15:14:03', '2025-07-28 15:14:03', NULL),
(12, 'ConsultingEngineer1', 'Lastname1', 'consultingengineer1@example.com', '$2y$12$tAoHRVt48Dqn9iIgB11IyuBaEoW7rV1dJB3G6w0dKGzGeDfxNYcxi', '0500000011', 1, NULL, NULL, NULL, '2025-07-28 15:14:04', '2025-07-28 15:14:04', NULL),
(13, 'ConsultingEngineer2', 'Lastname2', 'consultingengineer2@example.com', '$2y$12$w5Qr6qaoUOYIG9Fko2SdSuELain7IBnVONpk2uz3kawJCe59zqvz6', '0500000012', 1, NULL, NULL, NULL, '2025-07-28 15:14:04', '2025-07-28 15:14:04', NULL),
(14, 'ConsultingEngineer3', 'Lastname3', 'consultingengineer3@example.com', '$2y$12$YGtNkdZviXVzSRQJNmENIOlErFv.obhLi2UxvKIsrl89zy01gGAgq', '0500000013', 1, NULL, NULL, NULL, '2025-07-28 15:14:04', '2025-07-28 15:14:04', NULL),
(15, 'ConsultingEngineer4', 'Lastname4', 'consultingengineer4@example.com', '$2y$12$XjPzWKD.9MdxFxr4lsX0RuuRWdB5simFvDg5ctBaOO/HBgfVJIPmG', '0500000014', 1, NULL, NULL, NULL, '2025-07-28 15:14:05', '2025-07-28 15:14:05', NULL),
(16, 'ConsultingEngineer5', 'Lastname5', 'consultingengineer5@example.com', '$2y$12$3B44PXXgUOi1eyufDo5gTeqviKW6.RA/FcPUxYzLH0xklbxsYeoe.', '0500000015', 1, NULL, NULL, NULL, '2025-07-28 15:14:05', '2025-07-28 15:14:05', NULL),
(17, 'ConsultingEngineer6', 'Lastname6', 'consultingengineer6@example.com', '$2y$12$uXSc9hMd2CIyh/dzbWCf2uzVaPDUWnswvaNIXPaM0b6xRku9UAPmO', '0500000016', 1, NULL, NULL, NULL, '2025-07-28 15:14:05', '2025-07-28 15:14:05', NULL),
(18, 'ConsultingEngineer7', 'Lastname7', 'consultingengineer7@example.com', '$2y$12$LzFEGO2KQ.rehMPXadx4ouW1YHT/GGiYqZYYPPRBjT5hiHzq8yx5O', '0500000017', 1, NULL, NULL, NULL, '2025-07-28 15:14:05', '2025-07-28 15:14:05', NULL),
(19, 'ConsultingEngineer8', 'Lastname8', 'consultingengineer8@example.com', '$2y$12$FyAxbhni9qd3bKB2Pl7fT.OCtdTC0YPZuVweYYntBQsiiWkEa2Aiy', '0500000018', 1, NULL, NULL, NULL, '2025-07-28 15:14:06', '2025-07-28 15:14:06', NULL),
(20, 'ConsultingEngineer9', 'Lastname9', 'consultingengineer9@example.com', '$2y$12$0vnCHEal4HVNaO0zXci.z.b6ZnhdxipSVDouov.Ad6dSNqtv8zJRy', '0500000019', 1, NULL, NULL, NULL, '2025-07-28 15:14:06', '2025-07-28 15:14:06', NULL),
(21, 'ConsultingEngineer10', 'Lastname10', 'consultingengineer10@example.com', '$2y$12$bnn.3vAZ8hbkjTFn5wC3Tev1uvHspLr5gYPRk/2NxTrwQyHgscZWG', '05000000110', 1, NULL, NULL, NULL, '2025-07-28 15:14:06', '2025-07-28 15:14:06', NULL),
(22, 'RealStateManager1', 'Lastname1', 'realstatemanager1@example.com', '$2y$12$NHfFty5JI9zia.DChgYv6eMFmiRaNgrX9VbOOfbh1aFyHdRxSdidK', '0500000021', 1, NULL, NULL, NULL, '2025-07-28 15:14:07', '2025-07-28 15:14:07', NULL),
(23, 'RealStateManager2', 'Lastname2', 'realstatemanager2@example.com', '$2y$12$RbQ29yO3YIUe2a4Gk3/BgO4b3iQEaumndHwkiGvxRAiRlReR2ppVC', '0500000022', 1, NULL, NULL, NULL, '2025-07-28 15:14:07', '2025-07-28 15:14:07', NULL),
(24, 'RealStateManager3', 'Lastname3', 'realstatemanager3@example.com', '$2y$12$GNhZFvGVl5OOzmOoNZVvTu..fE42snIv4iOXkKoLZjgIQSLcQK352', '0500000023', 1, NULL, NULL, NULL, '2025-07-28 15:14:07', '2025-07-28 15:14:07', NULL),
(25, 'RealStateManager4', 'Lastname4', 'realstatemanager4@example.com', '$2y$12$RDyqyD.e3KNsfOlNPGKKXuZ4ZSDeMolvWDYUJQCtELE2TRXC/VRXG', '0500000024', 1, NULL, NULL, NULL, '2025-07-28 15:14:08', '2025-07-28 15:14:08', NULL),
(26, 'RealStateManager5', 'Lastname5', 'realstatemanager5@example.com', '$2y$12$x792iePqaXrgW8a7zvbUMe9kQq/0mBBn2DjaiQ0N6qDN329ql8BS2', '0500000025', 1, NULL, NULL, NULL, '2025-07-28 15:14:08', '2025-07-28 15:14:08', NULL),
(27, 'projectManager1', 'Lastname1', 'projectManager1@example.com', '$2y$12$nlSPKUqhHmksa38wO8eb9OECq4zsyk2.fXrtWUulueGS.6M3JNoQ6', '0500000021', 1, NULL, NULL, NULL, '2025-07-28 15:14:08', '2025-07-28 15:14:08', NULL),
(28, 'projectManager2', 'Lastname2', 'projectManager2@example.com', '$2y$12$y9wJ9T72ubAdou.hVlDlDOSreblUANZuq9N8yWZODs50aJXltiIke', '0500000022', 1, NULL, NULL, NULL, '2025-07-28 15:14:09', '2025-07-28 15:14:09', NULL),
(29, 'projectManager3', 'Lastname3', 'projectManager3@example.com', '$2y$12$S3QoDH.Qvl35/9sWaxbMMuBsl3oqRoFLiIk62rGNnO4yFR0Le42hK', '0500000023', 1, NULL, NULL, NULL, '2025-07-28 15:14:09', '2025-07-28 15:14:09', NULL),
(30, 'projectManager4', 'Lastname4', 'projectManager4@example.com', '$2y$12$LkmIPg11B2kL/urORRdode5qejXIRNJGqLflDa7Cyg88a4hifdtDq', '0500000024', 1, NULL, NULL, NULL, '2025-07-28 15:14:09', '2025-07-28 15:14:09', NULL),
(31, 'projectManager5', 'Lastname5', 'projectManager5@example.com', '$2y$12$h85NpTLz5KJ2YVJ.t8gPse38OSdr0od2f2KqA686jBaRroGOl76G6', '0500000025', 1, NULL, NULL, NULL, '2025-07-28 15:14:10', '2025-07-28 15:14:10', NULL),
(32, 'owner1', 'Lastname1', 'owner1@example.com', '$2y$12$pxVzAdEvi/C3KOUCx3pjyuymzF3/mmJZuvLd4Pgbbbq0pNLdsOB0C', '0500000021', 1, NULL, NULL, NULL, '2025-07-28 15:14:10', '2025-07-28 15:14:10', NULL),
(33, 'owner2', 'Lastname2', 'owner2@example.com', '$2y$12$p8gsm/z1Oc8.xb.VDbPR4uRpdakxF2rPi26opJxQh1L3t8UTj8QOK', '0500000022', 1, NULL, NULL, NULL, '2025-07-28 15:14:10', '2025-07-28 15:14:10', NULL),
(34, 'owner3', 'Lastname3', 'owner3@example.com', '$2y$12$dNUGsvcfcQgddBPlITlhve6GZGboFTDlBtYf4RYfmZtg4Co5aWFD.', '0500000023', 1, NULL, NULL, NULL, '2025-07-28 15:14:10', '2025-07-28 15:14:10', NULL),
(35, 'owner4', 'Lastname4', 'owner4@example.com', '$2y$12$ZpsLMTU3y2ii/bKct8GEFeres2VNsRHj0OXIsGFxy26gOyzXYBhmm', '0500000024', 1, NULL, NULL, NULL, '2025-07-28 15:14:11', '2025-07-28 15:14:11', NULL),
(36, 'owner5', 'Lastname5', 'owner5@example.com', '$2y$12$PfYrz.PmUdBCdI8VSmHtDekNTvr16sDtEKMCJJ9bhAZdL0yT92aBa', '0500000025', 1, NULL, NULL, NULL, '2025-07-28 15:14:11', '2025-07-28 15:14:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_property_unit_installments`
--

CREATE TABLE `user_property_unit_installments` (
  `id` int(11) NOT NULL,
  `property_unit_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `property_book_bill_id` int(11) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_property_unit_installments`
--

INSERT INTO `user_property_unit_installments` (`id`, `property_unit_id`, `client_id`, `due_date`, `is_paid`, `property_book_bill_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2025-07-31', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 1, '2025-08-28', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backup_files`
--
ALTER TABLE `backup_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_files_project_file_id_foreign` (`project_file_id`),
  ADD KEY `backup_files_created_by_foreign` (`created_by`),
  ADD KEY `backup_files_updated_by_foreign` (`updated_by`),
  ADD KEY `backup_files_deleted_by_foreign` (`deleted_by`);

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD KEY `clients_created_by_foreign` (`created_by`),
  ADD KEY `clients_updated_by_foreign` (`updated_by`),
  ADD KEY `clients_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `consulting_companies`
--
ALTER TABLE `consulting_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consulting_companies_email_unique` (`email`),
  ADD KEY `consulting_companies_created_by_foreign` (`created_by`),
  ADD KEY `consulting_companies_updated_by_foreign` (`updated_by`),
  ADD KEY `consulting_companies_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `consulting_engineers`
--
ALTER TABLE `consulting_engineers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consulting_engineers_user_id_foreign` (`user_id`),
  ADD KEY `consulting_engineers_consulting_company_id_foreign` (`consulting_company_id`),
  ADD KEY `consulting_engineers_engineer_specialization_id_foreign` (`engineer_specialization_id`),
  ADD KEY `consulting_engineers_created_by_foreign` (`created_by`),
  ADD KEY `consulting_engineers_updated_by_foreign` (`updated_by`),
  ADD KEY `consulting_engineers_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `engineers`
--
ALTER TABLE `engineers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `engineers_user_id_foreign` (`user_id`),
  ADD KEY `engineers_engineer_specialization_id_foreign` (`engineer_specialization_id`),
  ADD KEY `engineers_created_by_foreign` (`created_by`),
  ADD KEY `engineers_updated_by_foreign` (`updated_by`),
  ADD KEY `engineers_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `engineer_specializations`
--
ALTER TABLE `engineer_specializations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `engineer_specializations_created_by_foreign` (`created_by`),
  ADD KEY `engineer_specializations_updated_by_foreign` (`updated_by`),
  ADD KEY `engineer_specializations_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_created_by_foreign` (`created_by`),
  ADD KEY `items_updated_by_foreign` (`updated_by`),
  ADD KEY `items_deleted_by_foreign` (`deleted_by`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `owners_national_id_unique` (`national_id`),
  ADD KEY `owners_user_id_foreign` (`user_id`),
  ADD KEY `owners_created_by_foreign` (`created_by`),
  ADD KEY `owners_updated_by_foreign` (`updated_by`),
  ADD KEY `owners_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `owner_payments`
--
ALTER TABLE `owner_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_payments_owner_id_foreign` (`owner_id`),
  ADD KEY `owner_payments_created_by_foreign` (`created_by`),
  ADD KEY `owner_payments_updated_by_foreign` (`updated_by`),
  ADD KEY `owner_payments_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_owner_id_foreign` (`owner_id`),
  ADD KEY `projects_consulting_company_id_foreign` (`consulting_company_id`),
  ADD KEY `projects_created_by_foreign` (`created_by`),
  ADD KEY `projects_updated_by_foreign` (`updated_by`),
  ADD KEY `projects_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_bills`
--
ALTER TABLE `project_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_bills_project_id_foreign` (`project_id`),
  ADD KEY `project_bills_created_by_foreign` (`created_by`),
  ADD KEY `project_bills_updated_by_foreign` (`updated_by`),
  ADD KEY `project_bills_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_bill_details`
--
ALTER TABLE `project_bill_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_bill_details_project_bill_id_foreign` (`project_bill_id`),
  ADD KEY `project_bill_details_created_by_foreign` (`created_by`),
  ADD KEY `project_bill_details_updated_by_foreign` (`updated_by`),
  ADD KEY `project_bill_details_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_containers`
--
ALTER TABLE `project_containers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_containers_project_id_items_id_unique` (`project_id`,`items_id`),
  ADD KEY `project_containers_items_id_foreign` (`items_id`),
  ADD KEY `project_containers_created_by_foreign` (`created_by`),
  ADD KEY `project_containers_updated_by_foreign` (`updated_by`),
  ADD KEY `project_containers_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_files_project_id_foreign` (`project_id`),
  ADD KEY `project_files_project_participant_id_foreign` (`project_participant_id`),
  ADD KEY `project_files_created_by_foreign` (`created_by`),
  ADD KEY `project_files_updated_by_foreign` (`updated_by`),
  ADD KEY `project_files_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_managers`
--
ALTER TABLE `project_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_managers_user_id_foreign` (`user_id`),
  ADD KEY `project_managers_created_by_foreign` (`created_by`),
  ADD KEY `project_managers_updated_by_foreign` (`updated_by`),
  ADD KEY `project_managers_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_media`
--
ALTER TABLE `project_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_media_project_id_foreign` (`project_id`),
  ADD KEY `project_media_created_by_foreign` (`created_by`),
  ADD KEY `project_media_updated_by_foreign` (`updated_by`),
  ADD KEY `project_media_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_news`
--
ALTER TABLE `project_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_news_project_id_foreign` (`project_id`),
  ADD KEY `project_news_created_by_foreign` (`created_by`),
  ADD KEY `project_news_updated_by_foreign` (`updated_by`),
  ADD KEY `project_news_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_participants`
--
ALTER TABLE `project_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_participants_project_id_foreign` (`project_id`),
  ADD KEY `project_participants_created_by_foreign` (`created_by`),
  ADD KEY `project_participants_updated_by_foreign` (`updated_by`),
  ADD KEY `project_participants_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_sales_details`
--
ALTER TABLE `project_sales_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_sales_details_project_id_foreign` (`project_id`),
  ADD KEY `project_sales_details_created_by_foreign` (`created_by`),
  ADD KEY `project_sales_details_updated_by_foreign` (`updated_by`),
  ADD KEY `project_sales_details_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `project_stages`
--
ALTER TABLE `project_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_stages_project_id_foreign` (`project_id`),
  ADD KEY `project_stages_created_by_foreign` (`created_by`),
  ADD KEY `project_stages_updated_by_foreign` (`updated_by`),
  ADD KEY `project_stages_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `property_books`
--
ALTER TABLE `property_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_books_project_id_foreign` (`project_id`),
  ADD KEY `property_books_created_by_foreign` (`created_by`),
  ADD KEY `property_books_updated_by_foreign` (`updated_by`),
  ADD KEY `property_books_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `property_book_bills`
--
ALTER TABLE `property_book_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_book_bills_property_book_id_foreign` (`property_book_id`),
  ADD KEY `property_book_bills_created_by_foreign` (`created_by`),
  ADD KEY `property_book_bills_updated_by_foreign` (`updated_by`),
  ADD KEY `property_book_bills_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `property_units`
--
ALTER TABLE `property_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_units_property_book_id_foreign` (`property_book_id`),
  ADD KEY `property_units_client_id_foreign` (`client_id`),
  ADD KEY `property_units_created_by_foreign` (`created_by`),
  ADD KEY `property_units_updated_by_foreign` (`updated_by`),
  ADD KEY `property_units_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `property_unit_orders`
--
ALTER TABLE `property_unit_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_unit_orders_property_book_id_foreign` (`property_book_id`),
  ADD KEY `property_unit_orders_client_id_foreign` (`client_id`),
  ADD KEY `property_unit_orders_created_by_foreign` (`created_by`),
  ADD KEY `property_unit_orders_updated_by_foreign` (`updated_by`),
  ADD KEY `property_unit_orders_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `real_state_managers`
--
ALTER TABLE `real_state_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `real_state_managers_user_id_foreign` (`user_id`),
  ADD KEY `real_state_managers_created_by_foreign` (`created_by`),
  ADD KEY `real_state_managers_updated_by_foreign` (`updated_by`),
  ADD KEY `real_state_managers_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_stage_id_foreign` (`stage_id`),
  ADD KEY `tasks_employee_assigned_foreign` (`employee_assigned`),
  ADD KEY `tasks_supervisor_id_foreign` (`supervisor_id`),
  ADD KEY `tasks_created_by_foreign` (`created_by`),
  ADD KEY `tasks_updated_by_foreign` (`updated_by`),
  ADD KEY `tasks_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `task_containers`
--
ALTER TABLE `task_containers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_containers_task_id_foreign` (`task_id`),
  ADD KEY `task_containers_items_id_foreign` (`items_id`),
  ADD KEY `task_containers_created_by_foreign` (`created_by`),
  ADD KEY `task_containers_updated_by_foreign` (`updated_by`),
  ADD KEY `task_containers_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_task_id_foreign` (`task_id`),
  ADD KEY `tickets_created_by_foreign` (`created_by`),
  ADD KEY `tickets_updated_by_foreign` (`updated_by`),
  ADD KEY `tickets_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`),
  ADD KEY `users_updated_by_foreign` (`updated_by`),
  ADD KEY `users_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `user_property_unit_installments`
--
ALTER TABLE `user_property_unit_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_property_unit_installments_property_unit_id_foreign` (`property_unit_id`),
  ADD KEY `user_property_unit_installments_client_id_foreign` (`client_id`),
  ADD KEY `user_property_unit_installments_property_book_bill_id_foreign` (`property_book_bill_id`),
  ADD KEY `user_property_unit_installments_created_by_foreign` (`created_by`),
  ADD KEY `user_property_unit_installments_updated_by_foreign` (`updated_by`),
  ADD KEY `user_property_unit_installments_deleted_by_foreign` (`deleted_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backup_files`
--
ALTER TABLE `backup_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `consulting_companies`
--
ALTER TABLE `consulting_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consulting_engineers`
--
ALTER TABLE `consulting_engineers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `engineers`
--
ALTER TABLE `engineers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `engineer_specializations`
--
ALTER TABLE `engineer_specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `owner_payments`
--
ALTER TABLE `owner_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_bills`
--
ALTER TABLE `project_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_bill_details`
--
ALTER TABLE `project_bill_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_containers`
--
ALTER TABLE `project_containers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_managers`
--
ALTER TABLE `project_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_media`
--
ALTER TABLE `project_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_news`
--
ALTER TABLE `project_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_participants`
--
ALTER TABLE `project_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_sales_details`
--
ALTER TABLE `project_sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_stages`
--
ALTER TABLE `project_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_books`
--
ALTER TABLE `property_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_book_bills`
--
ALTER TABLE `property_book_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_units`
--
ALTER TABLE `property_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property_unit_orders`
--
ALTER TABLE `property_unit_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `real_state_managers`
--
ALTER TABLE `real_state_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `task_containers`
--
ALTER TABLE `task_containers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_property_unit_installments`
--
ALTER TABLE `user_property_unit_installments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `backup_files`
--
ALTER TABLE `backup_files`
  ADD CONSTRAINT `backup_files_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `backup_files_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `backup_files_project_file_id_foreign` FOREIGN KEY (`project_file_id`) REFERENCES `project_files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `backup_files_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `clients_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `clients_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `consulting_companies`
--
ALTER TABLE `consulting_companies`
  ADD CONSTRAINT `consulting_companies_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `consulting_companies_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `consulting_companies_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `consulting_engineers`
--
ALTER TABLE `consulting_engineers`
  ADD CONSTRAINT `consulting_engineers_consulting_company_id_foreign` FOREIGN KEY (`consulting_company_id`) REFERENCES `consulting_companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consulting_engineers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `consulting_engineers_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `consulting_engineers_engineer_specialization_id_foreign` FOREIGN KEY (`engineer_specialization_id`) REFERENCES `engineer_specializations` (`id`),
  ADD CONSTRAINT `consulting_engineers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `consulting_engineers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `engineers`
--
ALTER TABLE `engineers`
  ADD CONSTRAINT `engineers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `engineers_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `engineers_engineer_specialization_id_foreign` FOREIGN KEY (`engineer_specialization_id`) REFERENCES `engineer_specializations` (`id`),
  ADD CONSTRAINT `engineers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `engineers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `engineer_specializations`
--
ALTER TABLE `engineer_specializations`
  ADD CONSTRAINT `engineer_specializations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `engineer_specializations_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `engineer_specializations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `items_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `items_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `owners_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `owners_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `owners_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `owners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `owner_payments`
--
ALTER TABLE `owner_payments`
  ADD CONSTRAINT `owner_payments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `owner_payments_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `owner_payments_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `owner_payments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_consulting_company_id_foreign` FOREIGN KEY (`consulting_company_id`) REFERENCES `consulting_companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_bills`
--
ALTER TABLE `project_bills`
  ADD CONSTRAINT `project_bills_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_bills_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_bills_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_bills_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_bill_details`
--
ALTER TABLE `project_bill_details`
  ADD CONSTRAINT `project_bill_details_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_bill_details_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_bill_details_project_bill_id_foreign` FOREIGN KEY (`project_bill_id`) REFERENCES `project_bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_bill_details_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_containers`
--
ALTER TABLE `project_containers`
  ADD CONSTRAINT `project_containers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_containers_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_containers_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_containers_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_containers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_files`
--
ALTER TABLE `project_files`
  ADD CONSTRAINT `project_files_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_files_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_files_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_files_project_participant_id_foreign` FOREIGN KEY (`project_participant_id`) REFERENCES `project_participants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_files_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_managers`
--
ALTER TABLE `project_managers`
  ADD CONSTRAINT `project_managers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_managers_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_managers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_media`
--
ALTER TABLE `project_media`
  ADD CONSTRAINT `project_media_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_media_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_media_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_media_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_news`
--
ALTER TABLE `project_news`
  ADD CONSTRAINT `project_news_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_news_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_news_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_news_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_participants`
--
ALTER TABLE `project_participants`
  ADD CONSTRAINT `project_participants_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_participants_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_participants_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_participants_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_sales_details`
--
ALTER TABLE `project_sales_details`
  ADD CONSTRAINT `project_sales_details_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_sales_details_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_sales_details_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_sales_details_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_stages`
--
ALTER TABLE `project_stages`
  ADD CONSTRAINT `project_stages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_stages_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `project_stages_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_stages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `property_books`
--
ALTER TABLE `property_books`
  ADD CONSTRAINT `property_books_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_books_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_books_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_books_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `property_book_bills`
--
ALTER TABLE `property_book_bills`
  ADD CONSTRAINT `property_book_bills_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_book_bills_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_book_bills_property_book_id_foreign` FOREIGN KEY (`property_book_id`) REFERENCES `property_books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_book_bills_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `property_units`
--
ALTER TABLE `property_units`
  ADD CONSTRAINT `property_units_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_units_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_units_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_units_property_book_id_foreign` FOREIGN KEY (`property_book_id`) REFERENCES `property_books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_units_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `property_unit_orders`
--
ALTER TABLE `property_unit_orders`
  ADD CONSTRAINT `property_unit_orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_unit_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_unit_orders_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `property_unit_orders_property_book_id_foreign` FOREIGN KEY (`property_book_id`) REFERENCES `property_books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_unit_orders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `real_state_managers`
--
ALTER TABLE `real_state_managers`
  ADD CONSTRAINT `real_state_managers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `real_state_managers_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `real_state_managers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `real_state_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_employee_assigned_foreign` FOREIGN KEY (`employee_assigned`) REFERENCES `project_participants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `project_stages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `project_participants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `task_containers`
--
ALTER TABLE `task_containers`
  ADD CONSTRAINT `task_containers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `task_containers_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `task_containers_items_id_foreign` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_containers_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_containers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_property_unit_installments`
--
ALTER TABLE `user_property_unit_installments`
  ADD CONSTRAINT `user_property_unit_installments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_property_unit_installments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_property_unit_installments_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_property_unit_installments_property_book_bill_id_foreign` FOREIGN KEY (`property_book_bill_id`) REFERENCES `property_book_bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_property_unit_installments_property_unit_id_foreign` FOREIGN KEY (`property_unit_id`) REFERENCES `property_units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_property_unit_installments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
