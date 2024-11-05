-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 02:00 AM
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
-- Database: `angkatan3_medsos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `id_user`, `content`, `foto`, `created_at`, `updated_at`) VALUES
(9, 1, '<p>hello world</p>', '', '2024-11-04 08:30:02', '2024-11-04 08:30:02'),
(10, 1, '<p>coba 123</p>', 'course-1.jpg', '2024-11-04 08:40:17', '2024-11-04 08:40:17'),
(11, 1, '<p>coba lagi tweet tanpa gambar</p>', '', '2024-11-04 08:41:51', '2024-11-04 08:41:51'),
(12, 1, '<p>coba header</p>', '', '2024-11-04 08:44:08', '2024-11-04 08:44:08'),
(13, 1, '<p>coba header 1</p>', '', '2024-11-04 08:48:10', '2024-11-04 08:48:10'),
(14, 1, '<p>coba header 1</p>', '', '2024-11-04 08:48:23', '2024-11-04 08:48:23'),
(15, 1, '<p>coba pake ob start</p>', '', '2024-11-04 08:48:44', '2024-11-04 08:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `email`, `description`, `password`, `foto`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'Atio Wahyudi Saputra ', 'atio.wahyudi', 'atio02@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, quam doloribus atque repudiandae ullam et doloremque velit ipsum maiores similique, exercitationem repellendus fugiat repellat! Repellat?', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'team-1.jpg', 'sports-car-futuristic-mountain-sunset-scenery-digital-art-2k-wallpaper-uhdpaper.com-537@0@i.jpg', '2024-11-04 01:33:29', '2024-11-04 07:34:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
