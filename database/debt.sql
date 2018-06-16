-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2018 at 12:58 PM
-- Server version: 5.7.19
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `debt`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `loan_id` int(11) NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `loan_id`, `document`, `created_at`, `updated_at`) VALUES
(15, 14, 'photos/14/apartment-apartment-building-architecture-323705_1527961712.jpg', '2018-06-02 09:48:32', '2018-06-02 09:48:32'),
(17, 14, 'photos/14/achievement-adult-african-1035598_1527961712.jpg', '2018-06-02 09:48:32', '2018-06-02 09:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `loan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `debtor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debtor_ic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debtor_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debtor_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payback_date` date DEFAULT NULL,
  `loan_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guarantor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_ic_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `debtor_name`, `debtor_ic`, `debtor_phone`, `debtor_address`, `photo`, `note`, `amount`, `payback_date`, `loan_date`, `created_at`, `updated_at`, `guarantor_name`, `guarantor_ic_no`) VALUES
(1, 1, 'Shaadiq Hamid', '01-010101', '8990219', 'kampong rimba', 'uploads/user.png', 'kurang ajar pisin nya jelama ani, balik balik sudah ditagih duit nya nda jua ada, tapi makan nya grand berabis', '180.00', '2018-05-30', '2018-05-01', '2018-05-21 16:00:00', '2018-06-02 09:24:25', 'Jane Doe', '00-012345'),
(2, 1, 'John Doe', '01-010101', '8990219', 'kampong rimba', 'uploads/user.png', 'kurang ajar pisin nya jelama ani, balik balik sudah ditagih duit nya nda jua ada, tapi makan nya grand berabis', '180.00', '2018-05-30', '2018-05-01', '2018-05-21 16:00:00', '2018-05-21 16:00:00', 'jane doe', '00-012345'),
(3, 1, 'Syahnur Nizam', '31-013838', '8990219', 'no 48 spg 256-45 kg rimba', 'uploads/user.png', 'Bangang kali anak ani', '550.00', '2018-06-30', '2018-06-01', '2018-06-01 10:18:12', '2018-06-01 10:18:12', 'Haji Kahar', '01-012192'),
(4, 2, 'Syahnur Nizam', '31-013838', '8990219', 'no 48 spg 256-45 kg rimba', 'photos/4/syahnur_nizam_1527877764.jpg', 'Banyak banar ya kan berhutang ani', '1000.00', '2018-06-30', '2018-06-01', '2018-06-01 10:29:24', '2018-06-01 10:29:25', NULL, NULL),
(14, 1, 'Syahnur Nizam Bin Mohamad', '31-013838', '8990219', 'no 48 spg 256-45 kg rimba', 'photos/14/IMG_20171213_223822_1527961981.jpg', 'Basar banar project nya ani sampai BND 10,000 ya berhutang. Aku ani luan percaya jua kan project nya ani.', '10000.00', '2018-06-30', '2018-06-01', '2018-06-02 08:36:11', '2018-06-02 09:53:01', 'Haji Kahar', '01-012192');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_21_220220_create_jobs_table', 1),
(4, '2018_05_21_221413_create_loans_table', 2),
(5, '2018_05_21_221946_create_documents_table', 2),
(6, '2018_05_21_222917_add_user_id_to_loan', 3),
(7, '2018_05_31_141843_add_guarantor_to_debtor', 4),
(9, '2018_06_03_130743_create_likes_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'syahnur nizam', 'syahnurnizam197@Gmail.com', '$2y$10$ibcgsZ2WzTPSSkpf7G5csOm6Z0A77umc4eLN/yPbH33lMFGHh4S.W', 'OWdyXd9ffl5CYo0rMLUfIVHmlcku5nQEkCnJkmfrvdsHtl8o6gOhxCa9u1vG', '2018-05-21 14:23:36', '2018-05-21 14:23:36'),
(2, 'John Doe', 'jdoe@gmail.com', '$2y$10$jXhvhBlv//lMykwPHTa61uqJECl8xXxoSClNde8n5ahom25MfnHL2', 'ETcBUcS7c9M50Z8HDncFnKMTUOESw3v3sMakJKLMRcNMXC4oMJGj4x4WMOJN', '2018-05-31 12:45:07', '2018-05-31 12:45:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
