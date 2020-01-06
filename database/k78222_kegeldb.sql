-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Jan 2020 um 21:40
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
CREATE DATABASE IF NOT EXISTS `k78222_kegeldb` DEFAULT CHARACTER SET utf8 COLLATE utf8_german2_ci;
USE `k78222_kegeldb`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bills`
--
-- Erstellt am: 06. Jan 2020 um 20:32
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
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

INSERT INTO `bills` (`id`, `date`, `user`, `payment`, `paid`) VALUES
(1, '2020-01-06', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--
-- Erstellt am: 14. Dez 2019 um 14:44
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `game` int(11) NOT NULL,
  `content` text COLLATE utf8_german2_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `comments`:
--   `game`
--       `games` -> `id`
--   `user`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `games`
--
-- Erstellt am: 02. Dez 2019 um 21:42
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `king` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `nextGame` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `games`:
--   `king`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `game_user`
--
-- Erstellt am: 10. Nov 2019 um 20:31
--

DROP TABLE IF EXISTS `game_user`;
CREATE TABLE `game_user` (
  `id` int(11) NOT NULL,
  `game` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `present` tinyint(1) NOT NULL,
  `pumps` int(11) NOT NULL
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
-- Erstellt am: 13. Nov 2019 um 22:10
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `description` varchar(255) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `payments`:
--

--
-- Daten für Tabelle `payments`
--

INSERT INTO `payments` (`id`, `amount`, `description`) VALUES
(1, 5, 'Monatsbeitrag'),
(2, 1, 'Pumpenkönig'),
(3, 2, 'Klingeln'),
(4, 1, 'Verlorene Runde')
(5, 1, 'Schnapszahl');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `puns`
--
-- Erstellt am: 27. Nov 2019 um 20:01
--

DROP TABLE IF EXISTS `puns`;
CREATE TABLE `puns` (
  `id` int(11) NOT NULL,
  `content` varchar(500) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `puns`:
--

--
-- Daten für Tabelle `puns`
--

INSERT INTO `puns` (`id`, `content`) VALUES
(1, 'Wer kein Bier hat, der hat auch nichts zu trinken. '),
(2, 'Wir trinken auf\'s Leben, das Bier wird uns pflegen.'),
(3, 'Ein Tag hat 24 Stunden. Eine Palette Bier 24 Dosen. Das kann kein Zufall sein.'),
(4, 'Ich brauche kein Sixpack, ich kann mir ein ganzes Fass leisten.'),
(5, 'Ich habe Bierbulimie. Nach einer Kiste muss ich kotzen.'),
(6, 'Lieber Bier saufen und bumsen, als abwarten und Tee trinken.'),
(7, 'Mit des Bieres Hochgenuss, wächst des Bauches Radius. '),
(8, 'Wasser oder Bier? Bin ich dreckig oder habe ich Durst?'),
(9, 'Das Hemd verkotzt, die Hos\' verschissen, vom letzten Abend nix mehr wissen, die Treppe rauf auf allen Vier, ... - welch ein Bier! '),
(10, 'Das Leben ist ein Kampf, die Liebe ein Krampf, die Schule ein Überdruss, das Bier ein Hochgenuss.'),
(11, 'Durst wird durch Bier erst schön. '),
(12, 'Ein Bock ist jenes Tier, welches auch als Bier getrunken werden kann.'),
(13, 'Ein schäumend prickelnd Gerstensaft, gibt Herzensmut und Manneskraft. '),
(14, 'Einmal deinen Hals berühren, meinen Mund zu deinem führen, ach wie sehn\' ich mich nach dir, du heiß geliebte Flasche Bier.'),
(15, 'Alle meine Bierchen schwimmen jetzt im Klo, schwimmen jetzt im Klo, Köpfchen in die Schüssel, saufen macht uns froh! '),
(16, 'Auch Wasser ist ein edler Tropfen, mischt man es mit Malz und Hopfen. '),
(17, 'Bier am Morgen vertreibt Kummer und Sorgen!'),
(18, 'Bier hat wenig Vitamine. Darum soll man möglichst viel davon trinken. '),
(19, 'Bier ist der Beweis, dass Gott uns liebt und will, dass wir glücklich sind.'),
(20, 'Bier ist wie Klopapier. Wenn man es braucht, ist es dringend. '),
(21, 'Bier macht schön, oder hast du schon einmal einen Mann gesehen der sich schminkt?'),
(22, 'Ich sitze hier und trinke Bier. Wäre wirklich gern bei dir. Starkes Sehnen, starkes Hoffen. kann nicht kommen - bin besoffen!'),
(23, 'Der Kopf tut weh. Die Füße stinken. Höchste Zeit, ein Bier zu trinken.'),
(24, 'Wenn meine Hände zärtlich deinen Hals berühren und meine Lippen deine Öffnung spüren. Dann weiß ich du gehörst zu mir. Oh du geliebte Flasche Bier!'),
(25, 'Hopfen und Malz, ab in den Hals.'),
(26, 'Der kluge Mensch, so glaubt es mir, der redet nicht und trinkt sein Bier.'),
(27, 'Bier kalt stellen ist auch irgendwie kochen.'),
(28, 'Es gibt keine hässlichen Frauen. Es gibt nur zu wenig Bier.'),
(29, 'Bist du beim Bier, so bleib dabei.  Frau schimpft um zehn genauso wie um zwei.'),
(30, 'Mit des Bieres Hochgenuss, wächst des Bauches Radius.'),
(31, 'Wer das Bier nicht ehrt, ist des Deliriums nicht wert!'),
(32, 'Hey Baby, du siehst aus als könnte ich noch 4 Bier vertragen!'),
(33, 'Wer je den Durst mit Bier gelöscht, wird wieder danach streben! Ein guter Trunk ist niemals schlecht, drum woll’n wir noch ein’ heben!'),
(34, 'Bier trinken ist besser als Quark reden!'),
(35, 'Am Morgen ein Bier und der Tag gehört dir.'),
(36, 'Nur Wasser trinkt der Vierbeiner. Der Mensch, der findet Bier feiner.'),
(37, 'Im Himmel gibts kein Bier. Drum trinken wir es hier.'),
(38, 'Edles Bier, du tust mir gut. Gibst mir Zuversicht und Mut.'),
(39, 'Die schönste Blume, ich sag es dir, ist die auf einem Glase Bier.'),
(40, 'Bier enthält sehr viel Eisen, daher reden diejenigen die davon zuviel getrunken haben, auch nur Blech!'),
(41, 'Man kann am Abend nicht so viel Bier trinken, dass man am nächsten Morgen keinen Durst hat!'),
(42, 'Müde bin ich, geh‘ zur Ruh‘, decke meinen Bierbauch zu. Vater, lass den Kater mein, morgen nicht so grausam sein.'),
(43, 'Bitte gib mir wieder Durst, alles andre ist mir Wurst!'),
(44, 'Trinkt der Bauer zuviel Bier, melkt er glatt auch noch den Stier.'),
(45, 'Auch Wasser ist ein edler Tropfen, mischt man es nur mit edlem Malz und Hopfen.'),
(46, 'Im Suff sind alle Frauen schön.'),
(47, 'Zwischen Leber und Milz, passt immer ein Pils.'),
(48, 'Ich hatte heute ein 7-Gang-Menü: Eine Bratwurst und ein Sixpack Bier!'),
(49, 'Hopfen und Malz erleichtern die Balz!'),
(50, 'Bei kalten Wetter läuft die Nase. Bei kalten Bier passiert’s der Blase.'),
(51, 'Dem Ochsen gibt das Wasser Kraft, dem Menschen Bier und Rebensaft. Drum danke Gott als guter Christ, dass du kein Ochs‘ geworden bist.'),
(52, 'Wo früher meine Leber war, ist heute eine Minibar.'),
(53, 'Gott schuf das Wasser, doch der Mensch das Bier!'),
(54, 'Bier macht nicht glücklich. Aber es beruhigt.'),
(55, 'Lass mich Deinen Hals berühren, deinen Mund zu meinem führen. Ich liebe Dich, du bleibst bei mir, du heissgeliebte Flasche Bier.'),
(56, 'Am Morgen ein Bier und der Tag gehört dir.'),
(57, 'Kaltes Bier und heisse Weiber sind die schönsten Zeitvertreiber.'),
(58, 'Optimismus ist: Aus einem Weizenkorn wird irgendwann ein Fass Bier!'),
(59, 'Gegen Bier und Tabakdunst ist aller Weiber List umsunst !'),
(60, 'Alkohol und Nikotin rafft die halbe Menschheit hin – aber ohne Bier und Rauch, stirbt die andre Hälfte auch.'),
(61, 'Halb besoffen, ist rausgeschmissenes Geld!'),
(62, 'Bier macht schön!'),
(63, 'Man soll das Bier nicht vor dem Kater loben.'),
(64, 'Bier, mässig genossen, schadet selbst in grossen Mengen nicht.'),
(65, 'Je schlimmer das Weib, desto schöner die Kneip‘.'),
(66, 'Ein schäumend prickelnd Gerstensaft, gibt Herzensmut und Manneskraft.'),
(67, 'Jeder muss an etwas glauben. Ich glaub, ich trink noch Einen!');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `securitytokens`
--
-- Erstellt am: 04. Nov 2019 um 21:13
--

DROP TABLE IF EXISTS `securitytokens`;
CREATE TABLE `securitytokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `identifier` varchar(255) COLLATE utf8_german2_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_german2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `securitytokens`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--
-- Erstellt am: 13. Dez 2019 um 14:39
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `password` text COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_german2_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `isNew` int(1) NOT NULL,
  `isAdmin` int(1) NOT NULL,
  `passwordcode` varchar(255) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `users`:
--

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `image`, `firstname`, `lastname`, `isNew`, `isAdmin`, `passwordcode`) VALUES
(1, 'HanKes', '$2y$10$lzy98E/xUO78fHjllvDoh.TudCGiJg0OpTPQVrwmF73SiYJ3176vW', 'hannes.kessling@gmail.com', '', 'Hannes', 'Keßling', 0, 1, ''),
(2, 'Niggo', '$2y$10$hBXnOaW2xSiQm02fDn8GHePs/GXRK93IiJRbsUHm..6agPlnJJf52', 'niko.ist@doof.de', '', 'Niko', 'Theders', 0, 1, '');

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
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_user` (`user`),
  ADD KEY `comment_game` (`game`);

--
-- Indizes für die Tabelle `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`),
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
-- Indizes für die Tabelle `puns`
--
ALTER TABLE `puns`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `securitytokens`
--
ALTER TABLE `securitytokens`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `game_user`
--
ALTER TABLE `game_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `puns`
--
ALTER TABLE `puns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_game` FOREIGN KEY (`game`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
