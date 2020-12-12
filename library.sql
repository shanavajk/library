-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2020 at 07:48 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `book_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_name`, `created_date`) VALUES
(1, 'Agustina Block', '2020-12-11 10:26:59'),
(2, 'Queenie Pagac', '2020-12-11 10:27:00'),
(3, 'Ceasar Keeling', '2020-12-11 10:27:00'),
(4, 'Dr. Grace Thompson', '2020-12-11 10:27:00'),
(5, 'Prof. Abelardo Jenkins PhD', '2020-12-11 10:27:00'),
(6, 'Dr. Cora Towne', '2020-12-11 10:27:01'),
(7, 'Maureen Bradtke', '2020-12-11 10:27:01'),
(8, 'Ben Dietrich', '2020-12-11 10:27:01'),
(9, 'Miss Augusta Sawayn IV', '2020-12-11 10:27:01'),
(10, 'Dr. Gennaro Emard Sr.', '2020-12-11 10:27:02'),
(11, 'Ms. Ivory Sauer PhD', '2020-12-11 10:27:03'),
(12, 'Nikolas Rau', '2020-12-11 10:27:03'),
(13, 'Ubaldo Beer', '2020-12-11 10:27:04'),
(14, 'Trevor Quitzon II', '2020-12-11 10:27:04'),
(15, 'Miss Myrna Dare PhD', '2020-12-11 10:27:05'),
(16, 'Dr. Liliane Koelpin', '2020-12-11 10:27:05'),
(17, 'Janice Kautzer DVM', '2020-12-11 10:27:05'),
(18, 'Stephanie Hagenes', '2020-12-11 10:27:05'),
(19, 'May Jacobs', '2020-12-11 10:27:05'),
(20, 'Ellen Tillman', '2020-12-11 10:27:06'),
(21, 'AI Learning', '2020-12-11 15:42:13'),
(22, 'Machine Learning', '2020-12-11 15:49:24'),
(23, 'Java Programming', '2020-12-11 15:52:45'),
(24, 'java', '2020-12-11 15:58:11'),
(25, 'C Programming', '2020-12-11 16:00:58'),
(27, 'Laravel', '2020-12-11 16:06:56'),
(28, 'NodeJS', '2020-12-11 16:08:43'),
(29, 'Visual Basic', '2020-12-11 16:22:24'),
(30, 'VCC', '2020-12-11 16:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `book_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `return_status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Issued, 2-Returned',
  `rent` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_issues`
--

INSERT INTO `book_issues` (`id`, `book_id`, `person_id`, `issue_date`, `return_date`, `return_status`, `rent`, `updated_at`) VALUES
(1, 21, 17, '2020-12-01', '2020-12-05', 2, 8, '2020-12-11 17:08:03'),
(2, 21, 10, '2020-12-01', '2020-12-09', 2, 16, '2020-12-11 18:07:19'),
(3, 3, 17, '2020-12-02', NULL, 1, 0, '2020-12-11 18:38:19'),
(4, 25, 17, '2020-12-01', NULL, 1, 0, '2020-12-11 18:47:30'),
(5, 8, 17, '2020-12-01', NULL, 1, 0, '2020-12-11 19:05:32'),
(6, 6, 17, '2020-12-01', NULL, 1, 0, '2020-12-11 19:07:17'),
(7, 21, 9, '2020-12-04', NULL, 1, 0, '2020-12-11 19:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_11_075118_create_books_table', 1),
(5, '2020_12_11_101202_create_people_table', 1),
(6, '2020_12_11_140011_create_book_issues_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `created_date`) VALUES
(1, 'Elissa Stark', '2020-12-11 11:11:15'),
(2, 'Prof. Skylar Fadel I', '2020-12-11 11:11:15'),
(3, 'Jamarcus Howell', '2020-12-11 11:11:15'),
(4, 'Jarrell Jacobs DDS', '2020-12-11 11:11:15'),
(5, 'Eldred Koepp', '2020-12-11 11:11:15'),
(6, 'Kailee Walker', '2020-12-11 11:11:15'),
(7, 'Dixie Wolff', '2020-12-11 11:11:15'),
(8, 'Celestino Hand', '2020-12-11 11:11:15'),
(9, 'Caroline McDermott', '2020-12-11 11:11:15'),
(10, 'Amari Pagac Sr.', '2020-12-11 11:11:15'),
(11, 'Lura Reichert V', '2020-12-11 11:11:15'),
(12, 'Elsie Wiza', '2020-12-11 11:11:15'),
(13, 'Dr. Erling Olson DDS', '2020-12-11 11:11:15'),
(14, 'Lenna Johns', '2020-12-11 11:11:15'),
(15, 'Leopold Wiza', '2020-12-11 11:11:15'),
(16, 'Joanne Hodkiewicz', '2020-12-11 11:11:16'),
(17, 'Adelia Toy', '2020-12-11 11:11:16'),
(18, 'Shayna Farrell', '2020-12-11 11:11:16'),
(19, 'Fletcher Robel', '2020-12-11 11:11:16'),
(20, 'Miss Hallie Stoltenberg', '2020-12-11 11:11:16'),
(21, 'Shanavaj', '2020-12-11 16:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$0./5BBx80RWSoi4dqD63vOAdk0QlmLUs15ruFdM1yQKIFnXh7PZpS', NULL, '2020-12-11 05:10:06', '2020-12-11 05:10:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
