-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 05:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nba2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `players_tbl`
--

CREATE TABLE `players_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `jersey` int(11) NOT NULL,
  `team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players_tbl`
--

INSERT INTO `players_tbl` (`id`, `name`, `jersey`, `team`) VALUES
(1, 'Kyrie Irving', 2, 7),
(2, 'Kevin Durant', 35, 13),
(3, 'Jimmy Butler', 25, 12),
(4, 'Jason Tatum', 0, 1),
(5, 'Lebron James', 23, 6),
(6, 'Stephen Curry', 30, 5),
(7, 'Ja Morant', 12, 8),
(8, 'James Harden', 1, 11),
(9, 'Luka Doncic', 77, 7),
(10, 'Chris Paul', 3, 13),
(11, 'Kawhi Leonard', 2, 14),
(12, 'Nikola Jokic', 15, 9),
(13, 'Giannis Antetokounmpo', 34, 4),
(14, 'Trae Young', 11, 14),
(15, 'De\'Aaron Fox', 5, 15),
(16, 'Spencer Dinwiddie', 21, 2),
(17, 'Dovovan Mitchell', 45, 3),
(18, 'Anthony Edwards', 1, 17),
(19, 'Devin Booker', 1, 13),
(20, 'Jalen Brunson', 11, 18),
(21, 'Jamal Murray', 27, 9),
(22, 'Anthony Davis', 3, 6),
(23, 'Russell Westbrook', 0, 14),
(24, 'Joel Embiid', 21, 11),
(30, 'Dino Quiroga', 13, 12),
(33, 'Dave', 22, 5);

-- --------------------------------------------------------

--
-- Table structure for table `teams_tbl`
--

CREATE TABLE `teams_tbl` (
  `id` int(11) NOT NULL,
  `abbr` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams_tbl`
--

INSERT INTO `teams_tbl` (`id`, `abbr`, `name`, `division`) VALUES
(1, 'BOS', 'Boston Celtics', 'Atlantic'),
(2, 'BKN', 'Brooklyn Nets', 'Atlantic'),
(3, 'CLE', 'Cleveland Cavaliers', 'Central'),
(4, 'MIL', 'Milwaukee Bucks', 'Central'),
(5, 'GSW', 'Golden State Warriors', 'Pacific'),
(6, 'LAL', 'Los Angeles Lakers', 'Pacific'),
(7, 'DAL', 'Dallas Mavericks', 'Southwest'),
(8, 'MEM', 'Memphis Grizzlies', 'Southwest'),
(9, 'DEN', 'Denver Nuggets', 'Northwest'),
(10, 'UTA', 'Utah Jazz', 'Northwest'),
(11, 'PHI', 'Philadelphia 76ers', 'Atlantic'),
(12, 'MIA', 'Miami Heat', 'Southeast'),
(13, 'PHX', 'Phoenix Suns', 'Pacific'),
(14, 'LAC', 'Los Angeles Clippers', 'Pacific'),
(15, 'ATL', 'Atlanta Hawks', 'Southeast'),
(16, 'SAC', 'Sacramento Kings', 'Pacific'),
(17, 'MIN', 'Minnesota Timberwolves', 'Northwest'),
(18, 'NYK', 'New York Knicks', 'Atlantic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players_tbl`
--
ALTER TABLE `players_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams_tbl`
--
ALTER TABLE `teams_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `players_tbl`
--
ALTER TABLE `players_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `teams_tbl`
--
ALTER TABLE `teams_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
