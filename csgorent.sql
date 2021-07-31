-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 08 jul 2021 kl 20:23
-- Serverversion: 8.0.21-0ubuntu0.20.04.4
-- PHP-version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `csgorent`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `loan`
--

CREATE TABLE `loan` (
  `loanID` int NOT NULL,
  `userID` int NOT NULL,
  `skinID` int NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `expired` tinyint NOT NULL,
  `price` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellstruktur `skin`
--

CREATE TABLE `skin` (
  `skinID` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `market_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `icon_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `link` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `steamID` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `float_value` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `patternSeed` varchar(256) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `skin`
--

INSERT INTO `skin` (`skinID`, `name`, `market_name`, `icon_url`, `link`, `price`, `steamID`, `float_value`, `patternSeed`) VALUES
('17465071086', 'AUG | Sweeper', 'AUG | Sweeper (Field-Tested)', '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpot6-iFBRw7P7NYjV9_92wkZSSlfv1MLDum25V4dB8xLDHrI2tjgbm-kRoa2HycofEcQc8ZgvZ-gDvwby705S17pXLmyBruCQ8pSGKnwGWryQ', 'steam://rungame/730/76561202255233023/+csgo_econ_action_preview%20S76561199014079472A17465071086D7387601498835967584', '0.04', '1053813744', 'not_found', 'not_found'),
('18846727029', 'Nova | Sand Dune', 'Nova | Sand Dune (Battle-Scarred)', '-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpouLWzKjhz3MzbcDNG09SzlZaS2aD1Ye-EwzsBupZw27yZrNui0QXnqkc9Mmj0cdWVcgQ3YlnZ-Ve8xbzxxcjrb0JelWM', 'steam://rungame/730/76561202255233023/+csgo_econ_action_preview%20S76561199014079472A18846727029D2630179200312175225', '0.04', '1053813744', '0.5825390815734863', '99');

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE `user` (
  `userID` int NOT NULL,
  `firstName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `middleName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lastName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `subscription` enum('free','budget','enkel','standard','premium','admin') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `personNummer` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tradeUrl` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `apiKey` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `expiration` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`userID`, `firstName`, `middleName`, `lastName`, `subscription`, `personNummer`, `tradeUrl`, `email`, `apiKey`, `expiration`) VALUES
(0, 'Anton', 'Persson', 'Somoza', 'admin', '200109155770', NULL, NULL, NULL, NULL),
(1, 'Eric', 'Richard', 'Locher', 'admin', '200111290771', NULL, NULL, NULL, NULL),
(2, 'Niklas', '', 'Jörgensen', 'admin', '200108111873', NULL, NULL, NULL, NULL),
(12, 'test', 'test', 'test', 'free', '200108111873', NULL, NULL, NULL, NULL),
(13, 'test', 'test', 'test', 'free', '200108111873', NULL, NULL, '8jkL1tvlRMBP1eqYT9Am', '2021-06-21'),
(14, 'test', 'test', 'test', 'free', '200108111873', NULL, NULL, 'NxlPGRw1Fp20tDJFPA76', '2021-06-21');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loanID`,`userID`,`skinID`);

--
-- Index för tabell `skin`
--
ALTER TABLE `skin`
  ADD PRIMARY KEY (`skinID`),
  ADD UNIQUE KEY `skinID` (`skinID`);

--
-- Index för tabell `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `loan`
--
ALTER TABLE `loan`
  MODIFY `loanID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `user`
--
ALTER TABLE `user`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
