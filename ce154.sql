-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 03:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ce154`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`user_id`, `game_id`) VALUES
(2, 3),
(2, 4),
(2, 5),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 13),
(4, 8),
(4, 10),
(4, 11),
(4, 12),
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `genre` varchar(3) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `image`, `genre`, `rating`) VALUES
(1, 'Sid Meier\'s Civilization V: Brave New World', 'images/SidMeier.jpg', 'str', 85),
(2, 'Crusader Kings II', 'images/CrusaderKings2.jpg', 'str', 82),
(3, 'Warcraft III: Reforged ', 'images/Warcraft3.jpg', 'str', 60),
(4, 'Else Heart.Break()', 'images/ElseHeart.jpg', 'rpg', 79),
(5, 'Shadowrun: Dragonfall - Director\'s Cut', 'images/ShadowrunDDC.jpg', 'rpg', 87),
(6, 'Stardew Valley', 'images/StardewValley.jpg', 'rpg', 89),
(7, 'Disco Elysium', 'images/DiscoElysium.jpg', 'rpg', 91),
(8, 'RimWorld', 'images/RimWorld.jpg', 'sim', 87),
(9, 'Tom Clancy\'s Rainbow Six® Siege', 'images/Rainbow6S.jpg', 'fps', 0),
(10, 'Euro Truck Simulator 2', 'images/EuroTruckSimulator2.jpg', 'sim', 79),
(11, 'Farming Simulator 19', 'images/FarmingSimulator19.jpg', 'sim', 73),
(12, 'Train Simulator 2020', 'images/TrainSimulator2020.jpg', 'sim', 0),
(13, 'Project Zomboid', 'images/ProjectZomboid.jpg', 'rpg', 87),
(14, 'Shadowrun Returns', 'images/ShadowrunReturns.jpg', 'rpg', 76),
(15, 'Shadowrun: Hong Kong - Extended Edition', 'images/ShadowrunHongKongExtendedEdition.jpg', 'rpg', 81),
(16, 'Cave Story+', 'images/CaveStory.jpg', '???', 81),
(17, 'Sorcery! Parts 1 & 2', 'images/SorceryParts12.jpg', '???', 69),
(18, 'Dwarf Fortress', 'images/DwarfFortress.png', '???', 0),
(19, 'League of Legends', 'images/lol.jpg', '???', 79);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` varchar(3) NOT NULL,
  `title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `title`) VALUES
('???', 'Other'),
('fps', 'First Person Shooter'),
('rpg', 'Role-Playing Game'),
('sim', 'Simulation Game'),
('str', 'Strategy');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `review` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `game_id`, `rating`, `title`, `review`) VALUES
(1, 1, 2, 100, 'jwalto', 'Very Nice game 10/10'),
(2, 2, 2, 87, 'pwillic', 'Really good game.\r\nSadly it\'s made by paradox so if you want to play with all the content you\'ll have to pay 100-200 euros for DLCs');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(40) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pass`, `salt`, `is_admin`) VALUES
(1, 'jwalto', '244cad413fa94db1c686ff5bfc6777241ceaa3ea', 'abc123', 1),
(2, 'pwillic', '38bf8a5df0a227b697045c1b29a25a759e391f9b', 'java123', 0),
(3, 'rpgs', 'ba494cde63bd5d092e916b4083e27cda7c306d43', 'html42', 0),
(4, 'sims', 'c65e822545b8596c484112ac62a9194c6043c724', 'eadlc', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre` (`genre`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
