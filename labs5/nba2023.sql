-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 08:26 PM
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
  `height` decimal(4,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `position` varchar(10) DEFAULT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players_tbl`
--

INSERT INTO `players_tbl` (`id`, `name`, `jersey`, `height`, `weight`, `position`, `team_id`) VALUES
(1, 'Kyrie Irving', 2, '1.88', '88.50', 'G', 7),
(2, 'Kevin Durant', 35, '2.08', '108.90', 'F', 13),
(3, 'Jimmy Butler', 25, '2.01', '104.30', 'F', 12),
(4, 'Jason Tatum', 0, '2.03', '95.30', 'F-G', 1),
(5, 'Lebron James', 23, '2.06', '113.40', 'F', 6),
(6, 'Stephen Curry', 30, '1.88', '83.90', 'G', 5),
(7, 'Ja Morant', 12, '1.88', '78.90', 'G', 8),
(8, 'James Harden', 1, '1.96', '99.80', 'G', 11),
(9, 'Luka Doncic', 77, '2.01', '104.30', 'F-G', 7),
(10, 'Chris Paul', 3, '1.83', '79.40', 'G', 13),
(11, 'Kawhi Leonard', 2, '2.01', '102.10', 'F', 14),
(12, 'Nikola Jokic', 15, '2.11', '128.80', 'C', 9),
(13, 'Giannis Antetokounmpo', 34, '2.13', '110.00', 'F', 4),
(14, 'Trae Young', 11, '1.85', '74.40', 'G', 14),
(15, 'De\'Aaron Fox', 5, '1.90', '83.90', 'G', 16),
(16, 'Spencer Dinwiddie', 21, '1.96', '97.50', 'G', 2),
(17, 'Donovan Mitchell', 45, '1.85', '97.50', 'G', 3),
(18, 'Anthony Edwards', 1, '1.93', '102.10', 'G', 17),
(19, 'Devin Booker', 1, '1.96', '93.40', 'G', 13),
(20, 'Jalen Brunson', 11, '1.88', '86.20', 'G', 18),
(21, 'Jamal Murray', 27, '1.93', '97.50', 'G', 9),
(22, 'Anthony Davis', 3, '2.08', '114.80', 'F-C', 6),
(23, 'Russell Westbrook', 0, '1.90', '90.70', 'G', 14),
(24, 'Joel Embiid', 21, '2.13', '127.00', 'C-F', 11),
(26, 'Seth Curry', 30, '1.85', '83.90', 'G', 2),
(27, 'Khris Middleton', 22, '2.01', '100.70', 'F', 4),
(28, 'Jaylen Brown', 7, '1.98', '101.20', 'G-F', 1),
(29, 'Klay Thompson', 11, '1.98', '99.80', 'G', 5),
(30, 'Karl Anthony Towns', 32, '2.13', '112.50', 'C-F', 17),
(31, 'Zion Williamson', 1, '1.98', '128.80', 'F', 24),
(32, 'Pascal Siakam', 43, '2.03', '104.30', 'F', 28),
(33, 'Zach Lavine', 8, '1.96', '90.70', 'G', 20),
(34, 'Demar Derozan', 11, '1.98', '99.80', 'G-F', 20),
(35, 'Lamelo Ball', 1, '2.01', '81.60', 'G', 19),
(36, 'Bojan Bogdanovic', 44, '2.01', '102.50', 'F', 21),
(40, 'Dino Quiroga', 13, '1.70', '70.00', 'G', 10),
(41, 'Derrick Mitchell', 7, '1.98', '95.00', 'F-G', 1),
(42, 'Jordan Thompson', 23, '1.91', '85.00', 'G', 5),
(43, 'Ethan Parker', 15, '2.06', '102.00', 'F', 6),
(44, 'Lucas Anderson', 33, '2.11', '115.00', 'F-C', 2),
(45, 'Mason Lewis', 43, '2.01', '90.00', 'C', 15),
(46, 'Benjamin Martinez', 69, '2.13', '110.00', 'G-F', 10),
(47, 'Gabriel Wright', 25, '2.08', '112.00', 'C', 20),
(48, 'Isaac Turner', 4, '1.94', '88.00', 'G', 7),
(49, 'Noah Sanchez', 21, '2.03', '98.00', 'F', 22),
(50, 'Ryan Mitchell', 30, '1.99', '94.00', 'F-G', 28);

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
(18, 'NYK', 'New York Knicks', 'Atlantic'),
(19, 'CHA', 'Charlotte Hornets', 'Southeast'),
(20, 'CHI', 'Chicago Bulls', 'Central'),
(21, 'DET', 'Detroit Pistons', 'Central'),
(22, 'HOU', 'Houston Rockets', 'Southwest'),
(23, 'IND', 'Indiana Pacers', 'Central'),
(24, 'NOP', 'New Orleans Pelicans', 'Southwest'),
(25, 'ORL', 'Orlando Magic', 'Southwest'),
(26, 'POR', 'Portland Trail Blazers', 'Northwest'),
(27, 'SAS', 'San Antonio Spurs', 'Southwest'),
(28, 'TOR', 'Toronto Raptors', 'Atlantic'),
(29, 'WAS', 'Washington Wizards', 'Southeast'),
(30, 'OKC', 'Oklahoma City Thunder', 'Northwest');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `teams_tbl`
--
ALTER TABLE `teams_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
