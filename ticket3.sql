-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 02:46 AM
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
-- Database: `ticket3`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `showtime_id` int(11) NOT NULL,
  `seats` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `booking_status` varchar(50) DEFAULT 'Confirmed',
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `movie_id`, `showtime_id`, `seats`, `total_price`, `payment_method`, `booking_status`, `booking_date`) VALUES
(1, 1, 0, 3, 'A5,A6,B5,B6,C5,C6,E5', 105.00, NULL, 'PAID', '2026-05-17 08:04:49'),
(2, 1, 0, 14, 'B4,C3,C5,D3,D5', 75.00, NULL, 'PAID', '2026-05-17 08:05:32'),
(3, 1, 0, 12, 'A1,A2,A3,A4,B1,B2,B3,B4', 120.00, NULL, 'PAID', '2026-05-17 08:05:58'),
(4, 1, 0, 1, 'B4,C5', 30.00, NULL, 'PAID', '2026-05-17 08:35:05'),
(5, 9, 0, 4, 'E4,E5,E6,E7', 60.00, NULL, 'PAID', '2026-05-17 09:49:18'),
(6, 1, 0, 11, 'D5,D6,E5,E6', 60.00, NULL, 'PAID', '2026-05-17 13:43:00'),
(7, 1, 0, 1, 'E5,E6,E7', 45.00, NULL, 'PAID', '2026-05-17 14:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `booking_seats`
--

CREATE TABLE `booking_seats` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `hall_id` int(11) NOT NULL,
  `hall_name` varchar(50) DEFAULT NULL,
  `total_rows` int(11) DEFAULT NULL,
  `seats_per_row` int(11) DEFAULT NULL,
  `hall_type` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`hall_id`, `hall_name`, `total_rows`, `seats_per_row`, `hall_type`, `status`) VALUES
(1, 'Hall 1', 5, 8, 'Standard', 'active'),
(2, 'Hall 2', 5, 8, 'IMAX', 'active'),
(3, 'Hall 3', 5, 8, 'VIP', 'active'),
(4, 'Hall 4', 5, 8, 'Standard', 'maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `duration` varchar(110) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `genre`, `duration`, `language`, `description`, `poster`, `status`, `created_at`) VALUES
(1, 'Avengers', 'Action', '2 Hours 15', 'English', 'Superheroes save the world', 'Avengers.jpg', 'active', '2026-05-06 03:07:03'),
(2, 'Batman', 'Action', '2 Hours 30 ', 'English', 'Dark knight fights crime', 'Batman.jpg', 'active', '2026-05-06 03:07:03'),
(3, 'Spiderman', 'Action', '2 Hours 40 ', 'English', 'Teen hero saves city', 'Spiderman.jpg', 'active', '2026-05-06 03:07:03'),
(4, 'Iron Man', 'Action', '2 Hours 45', 'English', 'Genius builds suit', 'ironman.jpg', 'active', '2026-05-06 03:07:03'),
(5, 'Mortal Combat II', 'Action', '2 Hours 30 ', 'English', 'Fantasy Martial Combat', 'mt2.0.jpg', 'active', '2026-05-14 08:15:46'),
(6, '28 Years Later: The Bone Temple', 'Horror', '2 Hours 20 ', 'English', 'Zombie horror + survival that is very tense and disturbing.', 'tbt28.webp', 'active', '2026-05-20 08:21:49'),
(7, 'The Black Phone 2', 'Horror', '2 Hours 30 ', 'English', 'Supernatural killer + very creepy psychological vibe.', 'bp2.jpg', 'active', '2026-05-29 08:27:46'),
(8, 'Smile 2', 'Horror', '2 Hours 15', 'English', 'A famous singer begins to be haunted by a creepy entity that makes its victims smile before dying.', 'smile2.jpg', 'active', '2026-05-28 08:29:17'),
(9, 'Terrifier 3', 'Horror', '2 Hours 15 ', 'English', 'Art the Clown returns to commit sadistic murders during the Christmas season with extreme gore.', 'ter3.jpg', 'active', '2026-05-26 08:31:14'),
(10, 'Insidious : The Red Door', 'Horror', '2 Hours 30 ', 'English', 'Dalton and his father re-enter the astral world to stop the disturbance of evil spirits from the past.', 'insidi.jpg', 'active', '2026-05-24 08:32:08'),
(11, 'Gayong', 'Action', '2 Hours 20', 'Malay', 'An epic martial arts film featuring Malay heritage fights with bigger and more dramatic action.', 'gayong.jpg', 'active', '2026-04-06 08:44:34'),
(12, 'Minion & Monster', 'Animation', '2 Hours 30 ', 'English', 'Minions transform into strange creatures and cause hilarious chaos in a chaotic monster world.', 'mm.jpg', 'active', '2026-06-24 08:45:24'),
(13, 'Mikael : Pemburu Dua Alam', 'Horror', '2 Hours 15 ', 'Malay', 'A hunter who faces supernatural creatures while completing a dangerous mission between two worlds.', 'kael.jpg', 'active', '2026-05-03 08:46:25'),
(14, 'Swapped', 'Animation', '2 Hours 35', 'English', 'Two individuals with different lives suddenly switch identities, forcing them to understand the challenges and secrets of each other\'s lives in a journey full of drama, comedy and emotion.', 'swap.webp', 'active', '2026-05-26 23:56:18'),
(15, 'Tarung : Unforgiven', 'Action', '2h 30', 'English', 'Filem ini mengisahkan seorang bekas juara silat yang diburu oleh dosa silam selepas berlakunya satu tragedi. Dalam usaha menyelamatkan kakaknya, dia terpaksa memasuki dunia gelanggang haram, satu ruang ganas yang bukan sahaja menguji kekuatan fizikalnya, tetapi juga memaksanya berdepan dengan masa lalu yang belum selesai. Situasi menjadi lebih getir apabila dia akhirnya menyedari bahawa lawan yang menantinya ialah seseorang yang suatu ketika dahulu pernah sangat rapat dengan dirinya.', 'Tarung_Unforgiven_Poster..jpg', 'active', '2026-05-14 17:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_status` enum('success','failed') DEFAULT 'success',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `total_sales` decimal(10,2) DEFAULT NULL,
  `total_bookings` int(11) DEFAULT NULL,
  `total_movies` int(11) DEFAULT NULL,
  `total_users` int(11) DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `total_sales`, `total_bookings`, `total_movies`, `total_users`, `generated_at`) VALUES
(1, 90.00, 3, 4, 3, '2026-05-06 03:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `hall_id` int(50) DEFAULT NULL,
  `seat_row` char(1) DEFAULT NULL,
  `seat_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `hall_id`, `seat_row`, `seat_number`) VALUES
(1, 0, 'A', 1),
(2, 0, 'A', 2),
(3, 0, 'A', 3),
(4, 0, 'A', 4),
(5, 0, 'A', 5),
(6, 0, 'B', 1),
(7, 0, 'B', 2),
(8, 0, 'B', 3),
(9, 0, 'B', 4),
(10, 0, 'B', 5),
(11, 0, 'A', 1),
(12, 0, 'A', 2),
(13, 0, 'A', 3),
(14, 0, 'A', 4),
(15, 0, 'A', 5),
(16, 0, 'B', 1),
(17, 0, 'B', 2),
(18, 0, 'B', 3),
(19, 0, 'B', 4),
(20, 0, 'B', 5);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `showtime_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  `show_time` time DEFAULT NULL,
  `hall_id` int(50) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `total_seats` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`showtime_id`, `movie_id`, `show_date`, `show_time`, `hall_id`, `price`, `total_seats`, `created_at`) VALUES
(1, 1, '2026-05-20', '10:00:00', 2, 20.00, 30, '2026-05-06 03:07:27'),
(2, 1, '2026-05-20', '20:00:00', 3, 20.00, 30, '2026-05-06 03:07:27'),
(3, 2, '2026-05-20', '13:00:00', 4, 18.00, 30, '2026-05-06 03:07:27'),
(4, 3, '2026-05-20', '21:15:00', 1, 16.00, 30, '2026-05-06 03:07:27'),
(5, 6, '2026-05-01', '20:18:15', 1, 16.00, 30, '2026-05-08 07:18:15'),
(6, 1, '2026-05-12', '15:22:01', 2, 16.00, 30, '2026-05-08 05:22:01'),
(7, 11, '2026-05-05', '17:22:31', 3, 15.00, 30, '2026-05-22 06:22:31'),
(8, 10, '2026-05-20', '12:23:17', 3, 15.00, 30, '2026-05-27 14:23:17'),
(9, 13, '2026-05-21', '13:23:40', 2, 16.00, 30, '2026-05-30 06:23:40'),
(10, 12, '2026-05-12', '15:24:07', 4, 15.00, 30, '2026-05-08 04:29:07'),
(11, 5, '2026-05-26', '13:24:33', 1, 16.00, 30, '2026-05-08 07:24:33'),
(12, 8, '2026-05-19', '18:16:04', 1, 15.00, 30, '2026-05-27 14:25:04'),
(13, 9, '2026-05-27', '16:25:27', 1, 16.00, 30, '2026-05-22 06:25:27'),
(14, 7, '2026-05-14', '20:25:55', 2, 15.00, 30, '2026-05-28 14:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Ali Ahmad', 'ali', 'ali@gmail.com', '123456', 'customer', '2026-05-06 03:06:29'),
(2, 'Siti Aisyah', 'aisyah', 'aisyah@gmail.com', '123456', 'customer', '2026-05-06 03:06:29'),
(4, 'Faizal Husain', 'Husain', 'fzhusin0909@gmail.com', 'fz123', 'customer', '2026-05-08 04:11:43'),
(5, 'Ain Binti Ali', 'Ain', 'Ain@gmail.com', '2121', 'customer', '2026-05-09 04:05:38'),
(6, 'Arif Bin Abu', 'Arif', 'Aribu@gmail.com', '123123', 'customer', '2026-05-09 04:10:33'),
(7, 'Adni Binti Husain', 'Adni', 'Adni09@gmail.com', '321321', 'customer', '2026-05-09 04:14:40'),
(9, 'Raikal Bin Aziz', 'Raikal', 'Raiziz@gmail.com', '345345', 'customer', '2026-05-09 04:17:02'),
(11, 'Administrator', 'admin', 'admin@gmail.com', 'admin123', 'admin', '2026-05-09 17:01:38'),
(0, 'Rahman Anak Lelaki Abu', 'Rahman', 'aman@gmail.com', '12123', 'customer', '2026-05-17 10:04:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `booking_seats`
--
ALTER TABLE `booking_seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seat_id` (`seat_id`,`booking_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
