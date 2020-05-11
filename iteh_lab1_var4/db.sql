-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2020 at 04:38 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `ID_ACTOR` int(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`ID_ACTOR`, `name`) VALUES
(1, 'Bogdan Stupka'),
(2, 'Alexander Dovzhenko'),
(3, 'Vania');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `ID_FILM` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `country` varchar(100) NOT NULL,
  `quality` varchar(100) NOT NULL,
  `resolution` varchar(100) NOT NULL,
  `codec` varchar(100) NOT NULL,
  `producer` varchar(100) NOT NULL,
  `director` varchar(100) NOT NULL,
  `carrier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`ID_FILM`, `name`, `date`, `country`, `quality`, `resolution`, `codec`, `producer`, `director`, `carrier`) VALUES
(1, 'Sky', '2020-03-04', 'Moon', '4k', '100x100', 'vid', 'Nikita', 'Mihalkov', 'DVD'),
(2, 'Sun', '2020-03-05', 'Mars', '6k', '102x103', 'div', 'Guy', 'Ritchie', 'video'),
(3, 'Cloud', '2020-03-06', 'Odessa', '8k', '10x3', 'jiv', 'Alexander', 'Dovzhenko', 'CD');

-- --------------------------------------------------------

--
-- Table structure for table `film_actor`
--

CREATE TABLE `film_actor` (
  `FID_Film` int(100) NOT NULL,
  `FID_Actor` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film_actor`
--

INSERT INTO `film_actor` (`FID_Film`, `FID_Actor`) VALUES
(3, 2),
(1, 3),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `film_genre`
--

CREATE TABLE `film_genre` (
  `FID_Film` int(100) NOT NULL,
  `FID_Genre` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film_genre`
--

INSERT INTO `film_genre` (`FID_Film`, `FID_Genre`) VALUES
(3, 2),
(1, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `ID_GENRE` int(100) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`ID_GENRE`, `title`) VALUES
(1, 'horror'),
(2, 'autobiography'),
(3, 'animation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`ID_ACTOR`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`ID_FILM`);

--
-- Indexes for table `film_actor`
--
ALTER TABLE `film_actor`
  ADD KEY `FID_Film` (`FID_Film`),
  ADD KEY `FID_Actor` (`FID_Actor`);

--
-- Indexes for table `film_genre`
--
ALTER TABLE `film_genre`
  ADD KEY `FID_Film` (`FID_Film`),
  ADD KEY `FID_Genre` (`FID_Genre`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_GENRE`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `film_actor`
--
ALTER TABLE `film_actor`
  ADD CONSTRAINT `film_actor_ibfk_1` FOREIGN KEY (`FID_Film`) REFERENCES `film` (`ID_FILM`),
  ADD CONSTRAINT `film_actor_ibfk_2` FOREIGN KEY (`FID_Actor`) REFERENCES `actor` (`ID_ACTOR`);

--
-- Constraints for table `film_genre`
--
ALTER TABLE `film_genre`
  ADD CONSTRAINT `film_genre_ibfk_1` FOREIGN KEY (`FID_Film`) REFERENCES `film` (`ID_FILM`),
  ADD CONSTRAINT `film_genre_ibfk_2` FOREIGN KEY (`FID_Genre`) REFERENCES `genre` (`ID_GENRE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
