-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Okt 2019 um 20:49
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `k78222_kegeldb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bills`
--
-- Erstellt am: 29. Okt 2019 um 19:40
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user` int(11) NOT NULL,
  `amount` double NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `bills`:
--   `user`
--       `users` -> `id`
--

--
-- Daten für Tabelle `bills`
--

INSERT INTO `bills` (`id`, `date`, `user`, `amount`, `paid`) VALUES
(8, '2019-10-28', 6, 3, 0),
(9, '2019-10-28', 5, 7, 1),
(10, '2019-10-28', 1, 2.56, 1),
(11, '2019-10-29', 8, -1.51, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `games`
--
-- Erstellt am: 18. Aug 2019 um 12:33
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `king` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `nextGame` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `games`:
--   `king`
--       `users` -> `id`
--

--
-- Daten für Tabelle `games`
--

INSERT INTO `games` (`id`, `date`, `king`, `amount`, `nextGame`) VALUES
(1, '2019-08-14', 6, 1, '2019-08-15'),
(2, '2019-08-15', 1, 3, '2019-08-19'),
(3, '2019-08-19', 5, 7, '2019-10-17'),
(4, '2019-10-17', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `game_user`
--
-- Erstellt am: 18. Aug 2019 um 12:33
--

DROP TABLE IF EXISTS `game_user`;
CREATE TABLE `game_user` (
  `id` int(11) NOT NULL,
  `game` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `game_user`:
--   `game`
--       `games` -> `id`
--   `user`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payments`
--
-- Erstellt am: 18. Aug 2019 um 12:33
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `description` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `payments`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--
-- Erstellt am: 18. Aug 2019 um 12:33
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `password` text COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `isNew` int(1) NOT NULL,
  `isAdmin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `users`:
--

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `isNew`, `isAdmin`) VALUES
(1, 'HanKes', '$2y$10$nvV6tDPxWBTK2CSM4jbILeaw48GUlnh89ernGaatddp.WbsQXxrlC', 'hannes.kessling@gmail.com', 'Hannes', 'Keßling', 0, 1),
(2, 'Tester1', '$2y$10$7691kLH.LwKra54KGQ1Yp.JWNkxtU9cexDPHyfc/tMBMkUkIeyaTm', 'test@test.test', 'Test', 'Testermann', 0, 0),
(3, 'Tester2', '$2y$10$dGX8rE1TZV8C8Zy2FHUOfu.06ajoR8P/3Ch.B6jTlZm4AO23XX7Z6', 'Test2@test.de', 'Testi', 'Testermann', 0, 0),
(4, 'Tester3', '$2y$10$bjcnPuD6QMxQl.sY2BiYdeS8HEdggOVLWinaugNGzEiApz5J7ME/S', 'Test2@test.de', 'Tester', 'Testermann', 0, 0),
(5, 'Furz', '$2y$10$s6sJdJ2ab.X/2Z0h5uzgjuFmVLxDod.Oh0doSVAGJwXuTqKAZDm4C', 'ABC@bombe.de', 'Testaa', 'Testamann', 0, 0),
(6, 'Arsch123', '$2y$10$Mb/ATna0MNLEoNkA74eoVeNcWCu4UzoIwhIdMkpYNVFRwwx3YfRwm', 'niko@stinkt.hart', 'Bääääääh', 'Kotz', 0, 0),
(8, 'Niggo', '$2y$10$hBXnOaW2xSiQm02fDn8GHePs/GXRK93IiJRbsUHm..6agPlnJJf52', 'niko.ist@doof.de', 'Niko', 'Theders', 0, 1),
(9, 'Ich', '$2y$10$66R7cO5REfrlXLQ60GuEReLrULDPAB0mDSgd7CEtQW1Gu97YoeYeG', 'hankes@freenet.de', 'Hannes', 'Keßling', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_payment`
--
-- Erstellt am: 18. Aug 2019 um 12:33
--

DROP TABLE IF EXISTS `user_payment`;
CREATE TABLE `user_payment` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `game` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `user_payment`:
--   `game`
--       `games` -> `id`
--   `payment`
--       `payments` -> `id`
--   `user`
--       `users` -> `id`
--

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_user` (`user`);

--
-- Indizes für die Tabelle `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nextGame` (`nextGame`),
  ADD KEY `games_king` (`king`);

--
-- Indizes für die Tabelle `game_user`
--
ALTER TABLE `game_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_user-game` (`game`),
  ADD KEY `game_user-user` (`user`);

--
-- Indizes für die Tabelle `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_payment-payment` (`payment`),
  ADD KEY `user_payment-user` (`user`),
  ADD KEY `user_payment-game` (`game`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `game_user`
--
ALTER TABLE `game_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_king` FOREIGN KEY (`king`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `game_user`
--
ALTER TABLE `game_user`
  ADD CONSTRAINT `game_user-game` FOREIGN KEY (`game`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `game_user-user` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `user_payment`
--
ALTER TABLE `user_payment`
  ADD CONSTRAINT `user_payment-game` FOREIGN KEY (`game`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `user_payment-payment` FOREIGN KEY (`payment`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `user_payment-user` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
