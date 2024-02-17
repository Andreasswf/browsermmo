-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 17 feb 2024 kl 16:08
-- Serverversion: 10.4.28-MariaDB
-- PHP-version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `browsermmo`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `maxhealth` int(11) NOT NULL,
  `maxenergy` int(11) NOT NULL,
  `intellect` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `energy` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `crit` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `rarity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `item`
--

INSERT INTO `item` (`id`, `strength`, `maxhealth`, `maxenergy`, `intellect`, `health`, `energy`, `defense`, `crit`, `accuracy`, `name`, `description`, `image`, `rarity`) VALUES
(1, 0, 0, 25, 0, 0, 0, 0, 0, 0, 'Hallon', '+25 maxenergi (utrustning).', '', 0),
(2, 10, 0, 0, 0, 0, 0, 0, 0, 12, 'Pinne', '+ 10 slemstyrka, +12 pricksäkerhet', '', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `playerEquipment`
--

CREATE TABLE `playerEquipment` (
  `id` int(11) NOT NULL,
  `slot_1` int(11) NOT NULL,
  `slot_2` int(11) NOT NULL,
  `slot_3` int(11) NOT NULL,
  `slot_4` int(11) NOT NULL,
  `slot_5` int(11) NOT NULL,
  `slot_6` int(11) NOT NULL,
  `slot_7` int(11) NOT NULL,
  `slot_8` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `playerEquipment`
--

INSERT INTO `playerEquipment` (`id`, `slot_1`, `slot_2`, `slot_3`, `slot_4`, `slot_5`, `slot_6`, `slot_7`, `slot_8`) VALUES
(21, 1, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `playerInventory`
--

CREATE TABLE `playerInventory` (
  `id` int(11) NOT NULL,
  `slot_1` int(11) NOT NULL,
  `slot_2` int(11) NOT NULL,
  `slot_3` int(11) NOT NULL,
  `slot_4` int(11) NOT NULL,
  `slot_5` int(11) NOT NULL,
  `slot_6` int(11) NOT NULL,
  `slot_7` int(11) NOT NULL,
  `slot_8` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `playerInventory`
--

INSERT INTO `playerInventory` (`id`, `slot_1`, `slot_2`, `slot_3`, `slot_4`, `slot_5`, `slot_6`, `slot_7`, `slot_8`) VALUES
(21, 1, 2, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `stats`
--

CREATE TABLE `stats` (
  `id` int(255) NOT NULL,
  `level` int(255) NOT NULL,
  `xp` int(255) NOT NULL,
  `money` int(255) NOT NULL,
  `health` int(255) NOT NULL,
  `energy` int(255) NOT NULL,
  `strength` int(255) NOT NULL,
  `accuracy` int(255) NOT NULL,
  `defense` int(255) NOT NULL,
  `intellect` int(255) NOT NULL,
  `crit` int(255) NOT NULL,
  `maxhealth` int(255) NOT NULL,
  `maxenergy` int(255) NOT NULL,
  `lasthealthupdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lastenergyupdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `stats`
--

INSERT INTO `stats` (`id`, `level`, `xp`, `money`, `health`, `energy`, `strength`, `accuracy`, `defense`, `intellect`, `crit`, `maxhealth`, `maxenergy`, `lasthealthupdate`, `lastenergyupdate`) VALUES
(21, 1, 119, 779, 10, 10, 10, 10, 10, 10, 10, 10, 10, '2024-02-17 14:30:25', '2024-02-17 14:30:25');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `creationDate`) VALUES
(21, 'Roland', '$2y$12$7jxeJ3OyH5V78r141gn66.mt2Jo20VkOTQa9AB9fSQ23Npw0fBtEq', 'andreasswf@gmail.com', '2024-02-04 21:20:31');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `playerEquipment`
--
ALTER TABLE `playerEquipment`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `playerInventory`
--
ALTER TABLE `playerInventory`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
