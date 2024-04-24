-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 24 apr 2024 kl 18:03
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
  `item_id` int(11) NOT NULL,
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
  `rarity` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `item`
--

INSERT INTO `item` (`item_id`, `strength`, `maxhealth`, `maxenergy`, `intellect`, `health`, `energy`, `defense`, `crit`, `accuracy`, `name`, `description`, `image`, `rarity`, `price`) VALUES
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Tomt', 'Tomt', '', '0', 0),
(1, 0, 0, 8, 0, 0, 0, 0, 0, 0, 'Hallon', '+8 maxenergi', '', 'common', 100),
(2, 10, 0, 0, 0, 0, 0, 0, 0, 0, 'Pinne', '+10 slemstyrka', '', 'common', 100),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 10, 'Glasögon', '+10 pricksäkerhet', '', 'common', 100),
(4, 0, 10, 0, 0, 0, 0, 0, 0, 0, 'Brunt skal', '+10 maxhälsa', '', 'common', 100),
(5, 0, 0, 5, 0, 0, 0, 0, 0, 0, 'Blåbär', '+5 maxenergi', '', 'common', 100),
(6, 8, 0, 0, 0, 0, 0, 0, 0, 0, 'Tagg', '+8 slemstyrka', '', 'common', 100),
(7, 0, 0, 0, 0, 0, 0, 0, 10, 0, 'Pannband', '+10 kritisk träff', '', 'common', 100),
(8, 0, 0, 7, 0, 0, 0, 0, 0, 0, 'Lingon', '+7 maxenergi', '', 'common', 100),
(9, 0, 0, 0, 0, 0, 0, 0, 0, 5, 'Skägglav', '+5 pricksäkerhet', '', 'common', 100),
(10, 0, 0, 0, 5, 0, 0, 0, 0, 0, 'Svampmössa', '+5 intellekt', '', 'common', 100),
(11, 0, 8, 0, 0, 0, 0, 0, 0, 0, 'Barkrustning', '+8 maxhälsa', '', 'common', 100),
(12, 0, 5, 0, 0, 0, 0, 0, 0, 0, 'Lövsköld', '+5 maxhälsa', '', 'common', 100),
(13, 0, 2, 2, 0, 0, 0, 0, 0, 0, 'Hjortron', '+2 energi & maxhälsa', '', 'common', 100),
(14, 4, 0, 0, 0, 0, 0, 0, 0, 4, 'Barrspjut', '+4 slemstyrka & pricksäkerhet', '', 'common', 100),
(15, 5, 0, 0, 0, 0, 0, 5, 0, 0, 'Näverbandana', '+5 slemstyrka & smidighet', '', 'common', 100),
(16, 5, 0, 0, 0, 0, 0, -5, 0, 0, 'Gruskorn', '-5 smidighet +5 slemstyrka', '', 'common', 100),
(17, -5, 5, 0, 0, 0, 0, 0, 0, 0, 'Kotte', '-5 slemstyrka +5 maxhälsa', '', 'common', 100),
(18, 0, -5, 5, 0, 0, 0, 0, 0, 0, 'Enbär', '-5 maxhälsa +5 maxenergi', '', 'common', 100),
(19, 0, -3, 0, 0, 0, 0, 8, 0, 0, 'Rönnbärsgelé', '-3 maxhälsa +8 smidighet', '', 'common', 100),
(20, 8, -4, 0, 0, 0, 0, 0, 0, 0, 'Träflisa', '-4 maxhälsa +8 slemstyrka', '', 'common', 100),
(21, 15, -8, 0, 0, 0, 0, 0, 0, 0, 'Möglig träflisa', '-8 maxhälsa +15 slemstyrka', '', 'rare', 100),
(22, 0, 0, 12, 0, 0, 0, 0, 0, 0, 'Kantarell', '+12 maxenergi', '', 'rare', 100),
(23, 0, 20, -2, 0, 0, 0, 0, 0, 0, 'Grönt skal', '+20 maxhälsa -2 maxenergi', '', 'rare', 100),
(24, 7, 0, 0, 0, 0, 0, 7, 0, 0, 'Grön näverbandana', '+7 slemstyrka & smidighet', '', 'rare', 100),
(25, 0, 0, 0, 10, 0, 0, 0, 0, 0, 'Grön svampmössa', '+10 intellekt', '', 'rare', 125),
(26, 5, 5, 5, 0, 0, 0, 0, 0, 0, 'Grön mossa', '+5 styrka, maxhälsa & maxenergi', '', 'rare', 125),
(27, 0, 0, 0, 0, 0, 0, 0, 4, 12, 'Monokel', '+12 pricksäkerhet +4 kritisk träff', '', 'rare', 200),
(28, 0, 0, 0, 0, 0, 0, 0, 25, 25, 'Slangbella', '+25 pricksäkerhet  & kritisk träff', '', 'rare', 1000),
(29, 0, 18, 0, 0, 0, 0, 0, 0, -5, 'Kvarts', '+18 maxhälsa -5 pricksäkerhet', '', 'rare', 200),
(30, 0, 0, 0, 0, 0, 0, 9, 0, 9, 'Dekorerat näverbälte', '+9 smidighet & pricksäkerhet', '', 'rare', 200),
(31, 18, 0, 0, 0, 0, 0, 0, 0, 0, 'Kvist', '+18 slemstyrka', '', 'common', 800),
(32, 0, 18, 0, 0, 0, 0, 0, 0, 0, 'Platt sten', '+18 maxhälsa', '', 'common', 800),
(33, 0, 0, 18, 0, 0, 0, 0, 0, 0, 'Sur kåda', '+18 maxenergi', '', 'common', 800),
(34, 0, 0, 0, 15, 0, 0, 0, 0, 0, 'Kottemössa', '+15 intellekt', '', 'common', 800),
(35, 0, 0, 0, 0, 0, 0, 20, 0, 0, 'Slem på burk', '+20 smidighet', '', 'common', 800),
(36, 0, 0, 0, 0, 0, 0, 0, 18, 0, 'Vitmossa', '+18 kritisk träff', '', 'common', 800),
(37, 30, 0, 0, 0, 0, 0, 0, 0, 0, 'Vässad pinne', '+30 slemstyrka', '', 'common', 3500),
(38, 0, 0, 0, 0, 0, 0, 0, 0, 30, 'Kikare', '+30 pricksäkerhet', '', 'common', 2500),
(39, 0, 45, 0, 0, 0, 0, 0, 0, 0, 'Vitt skal', '+45 maxhälsa', '', 'common', 5500),
(40, 0, 0, 0, 0, 0, 0, 0, 30, 0, 'Rotbälte', '+30 kritisk träff', '', 'common', 2500),
(41, 0, 0, 0, 0, 0, 0, 30, 0, 0, 'Rund kula', '+30 smidighet', '', 'common', 2500),
(42, 50, 0, 0, 0, 0, 0, 0, 0, 0, 'Vass flinta', '+50 slemstyrka', '', 'common', 7500),
(43, 80, 0, 0, 0, 0, 0, 0, 0, 0, 'Flintyxa', '+80 slemstyrka', '', 'epic', 6000),
(44, 0, 80, 0, 0, 0, 0, 0, 0, 0, 'Eksköld', '+80 maxhälsa', '', 'epic', 6000),
(45, 0, 0, 35, 0, 0, 0, 0, 0, 0, 'Björnbärsaft', '+35 maxenergi', '', 'epic', 6000);

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
(21, 42, 28, 39, 21, 43, 29, 0, 0),
(46, 6, 11, 23, 14, 1, 6, 19, 0),
(49, 0, 0, 0, 0, 0, 0, 0, 0),
(50, 37, 7, 23, 35, 36, 28, 7, 28),
(51, 43, 43, 44, 42, 42, 44, 42, 42),
(52, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 13, 18, 0, 0, 0, 0, 0, 0);

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
(21, 21, 21, 21, 21, 0, 0, 0, 0),
(46, 4, 8, 17, 17, 10, 0, 0, 0),
(49, 27, 6, 12, 26, 14, 14, 11, 24),
(50, 5, 0, 0, 0, 0, 0, 0, 0),
(51, 0, 0, 0, 0, 0, 0, 0, 0),
(52, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 0, 0, 0, 0, 0, 0, 0, 0);

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
  `lastenergyupdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `statpoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `stats`
--

INSERT INTO `stats` (`id`, `level`, `xp`, `money`, `health`, `energy`, `strength`, `accuracy`, `defense`, `intellect`, `crit`, `maxhealth`, `maxenergy`, `lasthealthupdate`, `lastenergyupdate`, `statpoints`) VALUES
(21, 10, 12594, 22471, 136, 21, 63, 20, 10, 10, 10, 20, 30, '2024-04-23 18:55:15', '2024-04-23 18:55:15', 0),
(46, 7, 1570, 1346, 42, 16, 48, 10, 22, 10, 10, 20, 10, '2024-03-04 18:51:23', '2024-03-04 18:51:23', 0),
(49, 7, 2115, 5454, 56, 24, 20, 12, 10, 10, 12, 52, 24, '2024-03-05 15:29:51', '2024-03-05 15:29:51', 0),
(50, 7, 2023, 2365, 48, 18, 42, 20, 10, 10, 10, 28, 20, '2024-03-09 08:01:40', '2024-03-09 08:01:40', 0),
(51, 11, 28167, 19292, 208, 1, 52, 20, 10, 10, 20, 48, 20, '2024-03-20 19:52:16', '2024-03-20 19:52:16', 0),
(52, 1, 9, 42, 20, 5, 10, 10, 10, 10, 10, 20, 10, '2024-03-23 18:37:55', '2024-03-23 18:37:55', 0),
(53, 2, 89, 123, 15, 1, 20, 10, 10, 10, 10, 20, 10, '2024-04-16 08:40:42', '2024-04-16 08:40:42', 0);

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
(21, 'Roland', '$2y$12$7jxeJ3OyH5V78r141gn66.mt2Jo20VkOTQa9AB9fSQ23Npw0fBtEq', 'andreasswf@gmail.com', '2024-02-04 21:20:31'),
(46, 'rolandtest', '$2y$12$LDMjbChN2sGXLLqQW0e6vefm6Ej8KIZN8LEDuwGNo1nOjrvFHNFWq', 'rolandtest@se.se', '2024-02-24 22:33:44'),
(49, 'snigeltest', '$2y$12$KMO89ISDU97Q155CcbsP1uXjbyEYqDUQHLFphcTpB4SSqWWNxBz8u', 'rolandroad@senap.se', '2024-03-04 19:52:05'),
(50, 'snigeltest2', '$2y$12$IJAyo2VCNsKaOrCaqw9.quR0cdvS3K/j4m498EhwiXbj4VSItqSru', 'snigsnig@se.se', '2024-03-05 16:30:13'),
(51, 'testsnigel3', '$2y$12$BHKAY04ec.UNpNkmc.RV4.fnFZ.pMS50LSYZZTCqTGMvIQA.YKLdm', 'test@se.se.se', '2024-03-09 09:01:56'),
(52, 'testtest123', '$2y$12$dh13pyt9C6nSdLU5HcQhxOy4qucpHEmuzjn1B7.C/gZgl6jcLpuii', 'bubben@se.se', '2024-03-23 19:36:47'),
(53, 'ahmed', '$2y$12$ZSioH7IuhMiP4k4PCLb44O24xM6iqF4U9uqpmPxpe/HrczjYPlSmC', 'ahmed@snigel.se', '2024-04-16 10:34:21');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

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
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
