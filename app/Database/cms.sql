-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 11:48 AM
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
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(10, '1737031915_47d2d222c450600366bc.png', 'ci4', 'ci4', '2025-01-16 12:33:46', '2025-01-16 12:51:55'),
(11, '1737047103_bd79b1d99cab2dbc20c7.png', 'js', 'js', '2025-01-16 17:05:03', '2025-01-16 17:05:03'),
(12, '1737047139_efe458661ed2cfe9b8fe.png', 'flutter', 'flutter', '2025-01-16 17:05:39', '2025-01-16 17:05:39'),
(13, '1737047157_1be941c6e7f297166755.png', 'git', 'git', '2025-01-16 17:05:57', '2025-01-16 17:05:57'),
(14, '1737047173_9af4fe6e2a2d7653044f.png', 'laravel', 'laravel', '2025-01-16 17:06:13', '2025-01-16 17:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `content`, `created_at`, `updated_at`) VALUES
(1, 34, 'Ilham Mustaqim', 'Bermanfaat sekali', '2025-01-19 03:22:28', '2025-01-19 03:22:28'),
(3, 34, 'Karang', 'Semangat', '2025-01-19 03:29:37', '2025-01-19 03:29:37'),
(4, 34, 'Bintang', 'Terimakasih tutorialnya', '2025-01-20 03:21:32', '2025-01-20 03:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-01-14-033411', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1736826698, 1),
(3, '2025-01-14-033411', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1736847927, 2),
(4, '2025-01-14-100621', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1736849215, 3),
(5, '2025-01-14-101101', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1736849488, 4),
(6, '2025-01-14-101144', 'App\\Database\\Migrations\\CreatePostsTable', 'default', 'App', 1736849528, 5),
(7, '2025-01-14-101227', 'App\\Database\\Migrations\\CreateTagsTable', 'default', 'App', 1736849566, 6),
(8, '2025-01-14-101300', 'App\\Database\\Migrations\\CreatePostTagsTable', 'default', 'App', 1736849609, 7),
(9, '2025-01-14-101342', 'App\\Database\\Migrations\\CreateCommentsTable', 'default', 'App', 1736849647, 8),
(12, '2025-01-17-021716', 'App\\Database\\Migrations\\AddDescriptionToPosts', 'default', 'App', 1737164902, 9),
(13, '2025-01-18-015132', 'App\\Database\\Migrations\\AddPenulisToUserRole', 'default', 'App', 1737165129, 10);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `description`, `image`, `category_id`, `created_by`, `created_at`, `updated_at`) VALUES
(34, 'Instalasi Laravel 8', 'instalasi-laravel-8', '<p>Laravel adalah framework PHP yang sangat populer untuk membangun aplikasi web. Dalam artikel ini, Anda akan belajar cara menginstal Laravel 8 dengan mudah, bahkan jika Anda pemula.<br><img src=\"http://localhost:8080/uploads/posts/1737251693_adb47fc8234e9802850a.png\"></p><h4>Cara Instalasi Laravel 8</h4><p>Berikut langkah-langkah yang perlu Anda ikuti:</p><ol><li>Buka terminal dan jalankan perintah berikut: composer create-project --prefer-dist laravel/laravel nama-proyek</li></ol>', 'Belajar laravel dari zero to hero', '1739938086_d576c7af532da31825b0.png', 14, 3, '2025-01-19 01:55:27', '2025-02-19 04:10:29'),
(38, 'Membangun API dengan CodeIgniter 4', 'membangun-api-dengan-codeigniter-4', '<p>Panduan membuat API dengan CI4</p>', 'Panduan membuat API dengan CI4', '1739938365_673981314d61bfa0523a.png', 10, 3, '2025-02-19 04:12:45', '2025-02-19 04:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `tag_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(45, 34, 48, NULL, NULL),
(46, 34, 54, NULL, NULL),
(47, 34, 56, NULL, NULL),
(48, 38, 3, NULL, NULL),
(49, 38, 54, NULL, NULL),
(50, 38, 56, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(3, 'codeigniter', 'codeigniter', '2025-01-17 15:37:31', '2025-01-17 15:54:35'),
(48, 'laravel', 'laravel', '2025-01-19 15:49:37', '2025-01-19 15:49:37'),
(49, 'flutter', 'flutter', '2025-01-19 15:49:37', '2025-01-19 15:49:37'),
(54, 'PHP', 'php', '2025-01-20 03:22:50', '2025-01-20 03:22:50'),
(55, 'Bootstrap', 'bootstrap', '2025-02-19 04:04:04', '2025-02-19 04:04:04'),
(56, 'API', 'api', '2025-02-19 04:04:21', '2025-02-19 04:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','penulis') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Ilham', 'ilham@gmial.com', '123', 'admin', NULL, NULL),
(3, 'Ilham Mustaqim', 'ilhammstqm8@gmail.com', '$2y$10$vUPR094nURzZ7L2I/32fpOEyF6n7bDso.6aEDTs/KtSwdRZTVU.2a', 'admin', '2025-01-18 02:27:20', '2025-01-18 05:57:07'),
(4, 'muhsin', 'muhsin8@gmail.com', '$2y$10$c5HTqUEbYT3wAB1U90HBguHbn.X83pRKbaphf49lH97QT6Va5SDnm', 'penulis', '2025-01-18 02:59:31', '2025-01-18 02:59:31'),
(5, 'techmood.id', '231111021@student.unu-jogja.ac.id', '$2y$10$fFwnyfdl8iVE9SC3MiEqOO6UOgsJ.eydcujww9a252VscI8R0AaXa', 'user', '2025-01-18 06:10:07', '2025-01-18 06:10:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_created_by_foreign` (`created_by`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tags_post_id_foreign` (`post_id`),
  ADD KEY `post_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
