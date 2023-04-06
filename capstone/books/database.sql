-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 10:44 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `base_id` int(11) NOT NULL,
  `id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `pub` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`base_id`, `id`, `title`, `author`, `pub`, `thumb`, `date`) VALUES
(1, '-tIvygEACAAJ', 'The Republic of India', 'Alan Gledhill', 'N/A', 'https://via.placeholder.com/150x200?text=No+Image', '2023-03-31 00:08:40'),
(2, 'En3lvgEACAAJ', 'The Republic of India', 'Alan Gledhill', 'N/A', 'http://books.google.com/books/content?id=En3lvgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-03-31 00:08:41'),
(3, 'va9_zgEACAAJ', 'India Book of Records 2021', 'Team Book India', 'Diamond Pocket Books Pvt Limited', 'http://books.google.com/books/content?id=va9_zgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-03-31 00:08:41'),
(4, 'TQjYaXkTqdcC', 'The End of India', 'Khushwant Singh', 'Penguin Books India', 'http://books.google.com/books/content?id=TQjYaXkTqdcC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-03-31 00:08:41'),
(5, 'GA9uAAAAMAAJ', 'Data India', '', 'N/A', 'http://books.google.com/books/content?id=GA9uAAAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-03-31 00:08:41'),
(6, 'SM4cAQAAMAAJ', 'Near East and India', '', 'N/A', 'http://books.google.com/books/content?id=SM4cAQAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-03-31 00:08:41'),
(7, 'NVZ7FbjyimoC', 'Agricultural Situation in India', '', 'N/A', 'http://books.google.com/books/content?id=NVZ7FbjyimoC&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-03-31 00:08:41'),
(8, 'sUwEAAAAMBAJ', 'LIFE', '', 'N/A', 'http://books.google.com/books/content?id=sUwEAAAAMBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2023-03-31 00:08:41'),
(9, 'NRE7AQAAMAAJ', 'Statistics of British India', '', 'N/A', 'http://books.google.com/books/content?id=NRE7AQAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-03-31 00:08:42'),
(10, 'm4AoAAAAMAAJ', 'Lac in India', 'India. Directorate of Economics and Statistics', 'N/A', 'http://books.google.com/books/content?id=m4AoAAAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2023-03-31 00:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE `search_history` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `search_history`
--

INSERT INTO `search_history` (`id`, `title`, `date`) VALUES
(1, 'quid', '2023-03-19 11:18:19'),
(2, 'quaid', '2023-03-19 11:18:27'),
(3, 'quaid', '2023-03-19 11:22:44'),
(4, 'black', '2023-03-19 11:22:59'),
(5, 'black', '2023-03-19 11:24:14'),
(6, 'black', '2023-03-19 11:24:16'),
(7, 'black', '2023-03-19 11:24:33'),
(8, 'black', '2023-03-19 11:25:42'),
(9, 'black', '2023-03-19 13:07:08'),
(10, 'pakistan', '2023-03-30 17:50:33'),
(11, 'pakistan', '2023-03-30 18:45:50'),
(12, 'pakistan', '2023-03-30 18:49:15'),
(13, 'pakistan', '2023-03-30 18:49:28'),
(14, 'pakistan', '2023-03-30 18:53:04'),
(15, 'pakistan', '2023-03-30 18:53:26'),
(16, 'pakistan', '2023-03-30 18:54:16'),
(17, 'pakistan', '2023-03-30 18:57:11'),
(18, 'pakistan', '2023-03-30 18:57:28'),
(19, 'pakistan', '2023-03-30 18:57:44'),
(20, 'pakistan', '2023-03-30 18:58:10'),
(21, 'pakistan', '2023-03-30 18:58:42'),
(22, 'pakistan', '2023-03-30 18:59:30'),
(23, 'ahmed', '2023-03-30 18:59:41'),
(24, 'ahmed', '2023-03-30 19:01:21'),
(25, 'ahmed', '2023-03-30 19:03:01'),
(26, 'india', '2023-03-30 19:03:28'),
(27, 'india', '2023-03-30 19:08:16'),
(28, 'india', '2023-03-30 19:08:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`base_id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `base_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
