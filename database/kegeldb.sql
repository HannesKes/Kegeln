-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Aug 2019 um 17:56
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `kegeldb`
--
CREATE DATABASE IF NOT EXISTS `kegeldb` DEFAULT CHARACTER SET utf8 COLLATE utf8_german2_ci;
USE `kegeldb`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--
-- Erstellt am: 06. Aug 2019 um 18:40
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `password` text COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `isNew` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `users`:
--

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `isNew`) VALUES
(1, 'HanKes', '$2y$10$nvV6tDPxWBTK2CSM4jbILeaw48GUlnh89ernGaatddp.WbsQXxrlC', 'hannes.kessling@gmail.com', 'Hannes', 'Keßling', 0),
(2, 'Tester1', '$2y$10$7691kLH.LwKra54KGQ1Yp.JWNkxtU9cexDPHyfc/tMBMkUkIeyaTm', 'test@test.test', 'Test', 'Testermann', 1),
(3, 'Tester2', '$2y$10$dGX8rE1TZV8C8Zy2FHUOfu.06ajoR8P/3Ch.B6jTlZm4AO23XX7Z6', 'Test2@test.de', 'Testi', 'Testermann', 1),
(4, 'Tester3', '$2y$10$bjcnPuD6QMxQl.sY2BiYdeS8HEdggOVLWinaugNGzEiApz5J7ME/S', 'Test2@test.de', 'Tester', 'Testermann', 1),
(5, 'Furz', '$2y$10$s6sJdJ2ab.X/2Z0h5uzgjuFmVLxDod.Oh0doSVAGJwXuTqKAZDm4C', 'ABC@bombe.de', 'Testaa', 'Testamann', 1),
(6, 'Arsch123', '$2y$10$Mb/ATna0MNLEoNkA74eoVeNcWCu4UzoIwhIdMkpYNVFRwwx3YfRwm', 'niko@stinkt.hart', 'Bääääääh', 'Kotz', 1),
(7, '', '$2y$10$e.eIWy9kD0XMhgVGS3Lz0.IJYIL/th5wy3hvEoUBN8Pmu5a.AOIJ.', '', '', '', 1),
(8, 'a', '$2y$10$NXUfeUHCjEuLSEdSQykdV.JFqQZSdx4DlrgcKmMdHMASA2haVkFhO', '', '', '', 1),
(9, 'sdfsdf', '$2y$10$AZuPBytTqBbwFs1H/bFTy.wULiwAw1/8tInuMstU3NN9lbEXOMxc.', 'dsfsf', 'sfsdfs', 'sfdsfsd', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
