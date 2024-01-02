-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 05:39 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_book`
--

CREATE TABLE `ci_book` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_price` float NOT NULL,
  `book_pd` date NOT NULL,
  `book_active` int(11) NOT NULL,
  `book_trash` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_book`
--

INSERT INTO `ci_book` (`id`, `book_name`, `book_price`, `book_pd`, `book_active`, `book_trash`) VALUES
(1, 'PHP', 100, '2023-04-14', 1, 0),
(2, 'JAVA', 150, '2023-04-14', 1, 0),
(3, 'C++', 250, '2023-04-14', 1, 0),
(4, 'Node', 520, '2023-04-28', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_book`
--
ALTER TABLE `ci_book`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_book`
--
ALTER TABLE `ci_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
