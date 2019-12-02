-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Dez 2019 um 22:47
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
-- Erstellt am: 13. Nov 2019 um 22:05
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
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
(2, '2019-11-30', 10, 3, 0),
(3, '2019-11-30', 6, 3, 0),
(4, '2019-11-30', 1, 4, 0),
(5, '2019-11-30', 13, 3, 0),
(6, '2019-11-30', 2, 3, 0),
(7, '2019-11-30', 12, 3, 0),
(8, '2019-11-30', 8, 4, 0),
(9, '2019-11-30', 8, 3, 0),
(10, '2019-11-30', 12, 3, 0),
(11, '2019-11-30', 5, 4, 0),
(12, '2020-01-01', 10, 1, 0),
(13, '2020-01-01', 6, 1, 1),
(14, '2020-01-01', 5, 1, 1),
(15, '2020-01-01', 1, 1, 1),
(16, '2020-01-01', 9, 1, 1),
(17, '2020-01-01', 8, 1, 1),
(18, '2020-01-01', 13, 1, 0),
(19, '2020-01-01', 11, 1, 1),
(20, '2020-01-01', 12, 1, 0),
(21, '2020-01-01', 2, 1, 1),
(22, '2020-01-01', 3, 1, 0),
(23, '2020-01-01', 4, 1, 0),
(24, '2020-01-01', 10, 3, 0),
(37, '2020-01-05', 10, 1, 0),
(38, '2020-01-05', 6, 1, 0),
(39, '2020-01-05', 5, 1, 0),
(40, '2020-01-05', 1, 1, 0),
(41, '2020-01-05', 9, 1, 0),
(42, '2020-01-05', 8, 1, 0),
(43, '2020-01-05', 13, 1, 0),
(44, '2020-01-05', 11, 1, 0),
(45, '2020-01-05', 12, 1, 0),
(46, '2020-01-05', 2, 1, 0),
(47, '2020-01-05', 3, 1, 0),
(48, '2020-01-05', 4, 1, 0),
(61, '2020-07-16', 10, 1, 0),
(62, '2020-07-16', 6, 1, 0),
(63, '2020-07-16', 5, 1, 0),
(64, '2020-07-16', 1, 1, 0),
(65, '2020-07-16', 9, 1, 0),
(66, '2020-07-16', 8, 1, 0),
(67, '2020-07-16', 13, 1, 0),
(68, '2020-07-16', 11, 1, 0),
(69, '2020-07-16', 12, 1, 0),
(70, '2020-07-16', 2, 1, 0),
(71, '2020-07-16', 3, 1, 0),
(72, '2020-07-16', 4, 1, 0),
(73, '2020-12-16', 10, 1, 0),
(74, '2020-12-16', 6, 1, 0),
(75, '2020-12-16', 5, 1, 0),
(76, '2020-12-16', 1, 1, 0),
(77, '2020-12-16', 9, 1, 0),
(78, '2020-12-16', 8, 1, 0),
(79, '2020-12-16', 13, 1, 0),
(80, '2020-12-16', 11, 1, 0),
(81, '2020-12-16', 12, 1, 0),
(82, '2020-12-16', 2, 1, 0),
(83, '2020-12-16', 3, 1, 0),
(84, '2020-12-16', 4, 1, 0),
(85, '2020-12-16', 1, 2, 1),
(86, '2021-11-25', 10, 1, 0),
(87, '2021-11-25', 6, 1, 0),
(88, '2021-11-25', 5, 1, 0),
(89, '2021-11-25', 1, 1, 0),
(90, '2021-11-25', 9, 1, 0),
(91, '2021-11-25', 8, 1, 0),
(92, '2021-11-25', 13, 1, 0),
(93, '2021-11-25', 11, 1, 0),
(94, '2021-11-25', 12, 1, 0),
(95, '2021-11-25', 2, 1, 0),
(96, '2021-11-25', 3, 1, 0),
(97, '2021-11-25', 4, 1, 0),
(98, '2021-11-25', 10, 2, 0),
(99, '2021-11-28', 10, 1, 0),
(100, '2021-11-28', 6, 1, 0),
(101, '2021-11-28', 5, 1, 0),
(102, '2021-11-28', 1, 1, 0),
(103, '2021-11-28', 9, 1, 0),
(104, '2021-11-28', 8, 1, 0),
(105, '2021-11-28', 13, 1, 0),
(106, '2021-11-28', 11, 1, 0),
(107, '2021-11-28', 12, 1, 0),
(108, '2021-11-28', 2, 1, 0),
(109, '2021-11-28', 3, 1, 0),
(110, '2021-11-28', 4, 1, 0),
(111, '2021-11-28', 5, 2, 0),
(112, '2021-11-29', 10, 1, 0),
(113, '2021-11-29', 6, 1, 0),
(114, '2021-11-29', 5, 1, 0),
(115, '2021-11-29', 1, 1, 0),
(116, '2021-11-29', 9, 1, 0),
(117, '2021-11-29', 8, 1, 0),
(118, '2021-11-29', 13, 1, 0),
(119, '2021-11-29', 11, 1, 0),
(120, '2021-11-29', 12, 1, 0),
(121, '2021-11-29', 2, 1, 0),
(122, '2021-11-29', 3, 1, 0),
(123, '2021-11-29', 4, 1, 0),
(124, '2021-11-29', 10, 2, 0),
(125, '2021-12-02', 15, 1, 0),
(126, '2021-12-02', 10, 1, 0),
(127, '2021-12-02', 6, 1, 0),
(128, '2021-12-02', 5, 1, 0),
(129, '2021-12-02', 1, 1, 0),
(130, '2021-12-02', 9, 1, 0),
(131, '2021-12-02', 8, 1, 0),
(132, '2021-12-02', 13, 1, 0),
(133, '2021-12-02', 11, 1, 0),
(134, '2021-12-02', 12, 1, 0),
(135, '2021-12-02', 14, 1, 0),
(136, '2021-12-02', 2, 1, 0),
(137, '2021-12-02', 3, 1, 0),
(138, '2021-12-02', 4, 1, 0),
(139, '2021-12-02', 15, 2, 1),
(140, '2021-12-03', 15, 1, 0),
(141, '2021-12-03', 10, 1, 0),
(142, '2021-12-03', 6, 1, 0),
(143, '2021-12-03', 5, 1, 0),
(144, '2021-12-03', 1, 1, 0),
(145, '2021-12-03', 9, 1, 0),
(146, '2021-12-03', 8, 1, 0),
(147, '2021-12-03', 13, 1, 0),
(148, '2021-12-03', 11, 1, 0),
(149, '2021-12-03', 12, 1, 0),
(150, '2021-12-03', 14, 1, 0),
(151, '2021-12-03', 2, 1, 0),
(152, '2021-12-03', 3, 1, 0),
(153, '2021-12-03', 4, 1, 0),
(154, '2021-12-03', 15, 2, 1),
(155, '2021-12-03', 1, 3, 0),
(156, '2021-12-03', 15, 3, 1),
(157, '2021-12-03', 11, 4, 1),
(158, '2021-12-04', 15, 1, 0),
(159, '2021-12-04', 10, 1, 0),
(160, '2021-12-04', 6, 1, 0),
(161, '2021-12-04', 5, 1, 0),
(162, '2021-12-04', 1, 1, 0),
(163, '2021-12-04', 9, 1, 0),
(164, '2021-12-04', 8, 1, 0),
(165, '2021-12-04', 13, 1, 0),
(166, '2021-12-04', 11, 1, 0),
(167, '2021-12-04', 12, 1, 0),
(168, '2021-12-04', 14, 1, 0),
(169, '2021-12-04', 2, 1, 0),
(170, '2021-12-04', 3, 1, 0),
(171, '2021-12-04', 4, 1, 0);

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

--
-- Daten für Tabelle `games`
--

INSERT INTO `games` (`id`, `date`, `king`, `amount`, `nextGame`) VALUES
(1, '2019-08-14', 6, 1, '2019-08-15'),
(2, '2019-08-15', 1, 3, '2019-08-19'),
(3, '2019-08-19', 5, 7, '2019-10-17'),
(4, '2019-10-17', 1, 2, '2019-11-05'),
(9, '2019-11-05', 10, 0, '2019-11-10'),
(13, '2019-11-10', 8, 30, '2019-11-11'),
(14, '2019-11-11', 8, 30, '2019-11-12'),
(15, '2019-11-12', 8, 30, '2019-11-13'),
(16, '2019-11-13', 8, 30, '2019-11-14'),
(17, '2019-11-14', 8, 30, '2019-11-15'),
(18, '2019-11-15', 8, 30, '2019-11-16'),
(19, '2019-11-16', 8, 30, '2019-11-17'),
(20, '2019-11-17', 8, 99, '2019-11-18'),
(21, '2019-11-18', 8, 99, '2019-11-19'),
(22, '2019-11-19', 8, 99, '2019-11-20'),
(23, '2019-11-20', 8, 99, '2019-11-21'),
(24, '2019-11-21', 8, 99, '2019-11-22'),
(25, '2019-11-22', 8, 99, '2019-11-23'),
(26, '2019-11-23', 8, 99, '2019-11-24'),
(27, '2019-11-24', 8, 99, '2019-11-25'),
(28, '2019-11-25', 8, 99, '2019-11-26'),
(29, '2019-11-26', 8, 99, '2019-11-27'),
(30, '2019-11-27', 8, 99, '2019-11-28'),
(31, '2019-11-28', 8, 99, '2019-11-29'),
(32, '2019-11-29', 8, 99, '2019-11-30'),
(33, '2019-11-30', 8, 99, '2020-01-01'),
(34, '2020-01-01', 8, 3, '2020-01-05'),
(36, '2020-01-05', 10, 0, '2020-07-16'),
(38, '2020-07-16', 10, 0, '2020-12-16'),
(39, '2020-12-16', 1, 42, '2021-11-25'),
(40, '2021-11-25', 10, 0, '2021-11-28'),
(41, '2021-11-28', 5, 3, '2021-11-29'),
(42, '2021-11-29', 10, 1, '2021-12-02'),
(43, '2021-12-02', 15, 0, '2021-12-03'),
(44, '2021-12-03', 15, 0, '2021-12-04'),
(45, '2021-12-04', NULL, NULL, NULL);

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

--
-- Daten für Tabelle `game_user`
--

INSERT INTO `game_user` (`id`, `game`, `user`, `present`, `pumps`) VALUES
(1, 1, 10, 1, 30),
(2, 1, 1, 1, 1),
(3, 1, 1, 1, 1),
(4, 1, 1, 1, 1),
(5, 1, 1, 1, 1),
(6, 1, 1, 1, 1),
(7, 1, 1, 1, 1),
(8, 1, 1, 1, 1),
(9, 1, 1, 1, 1),
(10, 1, 1, 1, 1),
(11, 1, 1, 1, 1),
(12, 1, 1, 1, 1),
(13, 1, 1, 1, 1),
(14, 1, 1, 1, 1),
(15, 1, 1, 1, 1),
(16, 1, 1, 1, 1),
(17, 1, 1, 1, 1),
(18, 1, 1, 1, 1),
(19, 1, 1, 1, 1),
(20, 1, 1, 1, 1),
(21, 1, 1, 1, 1),
(22, 1, 1, 1, 1),
(23, 1, 1, 1, 1),
(24, 1, 1, 1, 1),
(25, 1, 1, 1, 1),
(26, 1, 1, 1, 1),
(27, 1, 1, 1, 1),
(28, 1, 1, 1, 1),
(29, 1, 1, 1, 1),
(30, 1, 1, 1, 1),
(31, 1, 1, 1, 1),
(32, 1, 1, 1, 1),
(33, 1, 1, 1, 1),
(34, 1, 1, 1, 1),
(35, 1, 1, 1, 1),
(36, 1, 1, 1, 1),
(37, 1, 1, 1, 1),
(38, 1, 1, 1, 1),
(39, 1, 1, 1, 1),
(40, 1, 1, 1, 1),
(41, 1, 1, 1, 1),
(42, 1, 1, 1, 1),
(43, 1, 1, 1, 1),
(44, 1, 1, 1, 1),
(45, 1, 1, 1, 1),
(46, 1, 1, 1, 1),
(47, 1, 1, 1, 1),
(48, 1, 1, 1, 1),
(49, 1, 1, 1, 1),
(50, 1, 1, 1, 1),
(51, 1, 1, 1, 1),
(52, 1, 1, 1, 1),
(53, 1, 1, 1, 1),
(54, 1, 1, 1, 1),
(55, 1, 1, 1, 1),
(56, 33, 10, 1, 2),
(57, 33, 6, 1, 1),
(58, 33, 5, 0, 0),
(59, 33, 1, 1, 4),
(60, 33, 9, 1, 2),
(61, 33, 8, 1, 99),
(62, 33, 13, 1, 2),
(63, 33, 11, 1, 1),
(64, 33, 12, 1, 0),
(65, 33, 2, 1, 1),
(66, 33, 3, 1, 0),
(67, 33, 4, 1, 5),
(68, 34, 10, 1, 1),
(69, 34, 6, 1, 0),
(70, 34, 5, 1, 2),
(71, 34, 1, 0, 0),
(72, 34, 9, 1, 1),
(73, 34, 8, 1, 1),
(74, 34, 13, 0, 0),
(75, 34, 11, 1, 0),
(76, 34, 12, 1, 0),
(77, 34, 2, 0, 0),
(78, 34, 3, 1, 0),
(79, 34, 4, 1, 2),
(92, 36, 10, 0, 0),
(93, 36, 6, 0, 0),
(94, 36, 5, 0, 0),
(95, 36, 1, 0, 0),
(96, 36, 9, 0, 0),
(97, 36, 8, 0, 0),
(98, 36, 13, 0, 0),
(99, 36, 11, 0, 0),
(100, 36, 12, 0, 0),
(101, 36, 2, 0, 0),
(102, 36, 3, 0, 0),
(103, 36, 4, 0, 0),
(116, 38, 10, 0, 0),
(117, 38, 6, 0, 0),
(118, 38, 5, 0, 0),
(119, 38, 1, 0, 0),
(120, 38, 9, 0, 0),
(121, 38, 8, 0, 0),
(122, 38, 13, 0, 0),
(123, 38, 11, 0, 0),
(124, 38, 12, 0, 0),
(125, 38, 2, 0, 0),
(126, 38, 3, 0, 0),
(127, 38, 4, 0, 0),
(128, 39, 10, 0, 0),
(129, 39, 6, 0, 0),
(130, 39, 5, 0, 0),
(131, 39, 1, 0, 0),
(132, 39, 9, 0, 0),
(133, 39, 8, 0, 0),
(134, 39, 13, 0, 0),
(135, 39, 11, 0, 0),
(136, 39, 12, 0, 0),
(137, 39, 2, 0, 0),
(138, 39, 3, 0, 0),
(139, 39, 4, 0, 0),
(140, 40, 10, 0, 0),
(141, 40, 6, 0, 0),
(142, 40, 5, 0, 0),
(143, 40, 1, 0, 0),
(144, 40, 9, 0, 0),
(145, 40, 8, 0, 0),
(146, 40, 13, 0, 0),
(147, 40, 11, 0, 0),
(148, 40, 12, 0, 0),
(149, 40, 2, 0, 0),
(150, 40, 3, 0, 0),
(151, 40, 4, 0, 0),
(152, 41, 10, 0, 0),
(153, 41, 6, 0, 0),
(154, 41, 5, 1, 3),
(155, 41, 1, 0, 0),
(156, 41, 9, 0, 0),
(157, 41, 8, 0, 0),
(158, 41, 13, 0, 0),
(159, 41, 11, 0, 0),
(160, 41, 12, 0, 0),
(161, 41, 2, 0, 0),
(162, 41, 3, 0, 0),
(163, 41, 4, 0, 0),
(164, 42, 10, 1, 1),
(165, 42, 6, 0, 0),
(166, 42, 5, 0, 0),
(167, 42, 1, 0, 0),
(168, 42, 9, 0, 0),
(169, 42, 8, 0, 0),
(170, 42, 13, 0, 0),
(171, 42, 11, 0, 0),
(172, 42, 12, 0, 0),
(173, 42, 2, 0, 0),
(174, 42, 3, 0, 0),
(175, 42, 4, 0, 0),
(176, 43, 15, 0, 0),
(177, 43, 10, 0, 0),
(178, 43, 6, 0, 0),
(179, 43, 5, 0, 0),
(180, 43, 1, 0, 0),
(181, 43, 9, 0, 0),
(182, 43, 8, 0, 0),
(183, 43, 13, 0, 0),
(184, 43, 11, 0, 0),
(185, 43, 12, 0, 0),
(186, 43, 14, 0, 0),
(187, 43, 2, 0, 0),
(188, 43, 3, 0, 0),
(189, 43, 4, 0, 0),
(190, 44, 15, 0, 0),
(191, 44, 10, 0, 0),
(192, 44, 6, 0, 0),
(193, 44, 5, 0, 0),
(194, 44, 1, 0, 0),
(195, 44, 9, 0, 0),
(196, 44, 8, 0, 0),
(197, 44, 13, 0, 0),
(198, 44, 11, 0, 0),
(199, 44, 12, 0, 0),
(200, 44, 14, 0, 0),
(201, 44, 2, 0, 0),
(202, 44, 3, 0, 0),
(203, 44, 4, 0, 0),
(204, 45, 15, 0, 0),
(205, 45, 10, 0, 0),
(206, 45, 6, 0, 0),
(207, 45, 5, 0, 0),
(208, 45, 1, 1, 0),
(209, 45, 9, 0, 0),
(210, 45, 8, 0, 0),
(211, 45, 13, 0, 0),
(212, 45, 11, 0, 0),
(213, 45, 12, 0, 0),
(214, 45, 14, 0, 0),
(215, 45, 2, 0, 0),
(216, 45, 3, 0, 0),
(217, 45, 4, 0, 0);

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
(3, 1, 'Klingeln'),
(4, 0.1, 'Verlorene Runde');

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

--
-- Daten für Tabelle `securitytokens`
--

INSERT INTO `securitytokens` (`id`, `user_id`, `identifier`, `token`, `created_at`) VALUES
(0, 1, '91f5db7a36bca6ad27ca30d2436b884e', '985c7c6d0237007ca028dc39d1963869', '2019-11-04 21:13:53');

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
(1, 'HanKes', '$2y$10$nvV6tDPxWBTK2CSM4jbILeaw48GUlnh89ernGaatddp.WbsQXxrlC', 'hannes.kessling@gmail.de', 'Hannes', 'Keßling', 0, 1),
(2, 'Tester1', '$2y$10$7691kLH.LwKra54KGQ1Yp.JWNkxtU9cexDPHyfc/tMBMkUkIeyaTm', 'test@test.test', 'Test', 'Testermann', 0, 0),
(3, 'Tester2', '$2y$10$dGX8rE1TZV8C8Zy2FHUOfu.06ajoR8P/3Ch.B6jTlZm4AO23XX7Z6', 'Test2@test.de', 'Testi', 'Testermann', 0, 0),
(4, 'Tester3', '$2y$10$bjcnPuD6QMxQl.sY2BiYdeS8HEdggOVLWinaugNGzEiApz5J7ME/S', 'Test2@test.de', 'Tester', 'Testermann', 0, 0),
(5, 'Furz', '$2y$10$s6sJdJ2ab.X/2Z0h5uzgjuFmVLxDod.Oh0doSVAGJwXuTqKAZDm4C', 'ABC@bombe.de', 'Testaa', 'Testamann', 0, 0),
(6, 'Arsch123', '$2y$10$Mb/ATna0MNLEoNkA74eoVeNcWCu4UzoIwhIdMkpYNVFRwwx3YfRwm', 'niko@stinkt.hart', 'Bääääääh', 'Kotz', 0, 0),
(8, 'Niggo', '$2y$10$hBXnOaW2xSiQm02fDn8GHePs/GXRK93IiJRbsUHm..6agPlnJJf52', 'niko.ist@doof.de', 'Niko', 'Theders', 0, 1),
(9, 'Ich', '$2y$10$66R7cO5REfrlXLQ60GuEReLrULDPAB0mDSgd7CEtQW1Gu97YoeYeG', 'hankes@freenet.de', 'Hannes', 'Keßling', 0, 0),
(10, 'admin', '$2y$10$UmcqwV4jEiKMEDK8n.EjW.f0kWdaquiCwqIbZPOqwXQl2T5TmEvN6', 'hankes1202@gmail.com', 'Hannes', 'Keßling', 0, 0),
(11, 'Test42', '$2y$10$LgNJjW.7eMoFwU2Yc/3njO9EqIky.IdAXciz/I5WTBBxdrjJVMchu', 'test@test.test', 'Niko', 'Theders', 0, 0),
(12, 'Test43', '$2y$10$AoXYnknA6ysIHyxeMMqY9OpfWTZ8acNRLhkjWV3RA3Smfqe5dFFmK', 'test@test.test', 'Ich', 'Bin Cool', 0, 0),
(13, 'tesssst', '$2y$10$469qxVzMm3MJO9x8mNQwN.28RH3HQFtDxhQG.nEliXm50s5ExOES6', 'test.test.test@test.de', 'Hannes', 'Test', 0, 0),
(14, 'TestABC', '$2y$10$OOQlz2XmIs1jfgjr/MRbkuH8kG51zX5ixcYvQKqRDjfSm4l7HNGKK', 'djfkgh@xn--fsdglkj-80a.pfdoigh', 'Hallo', 'I Bims', 1, 0),
(15, 'ABC', '$2y$10$ww8TaQXfMYcVgE5A3q0ibe7Qd5w4EFbSEaG0EYFKUfB0LH5Yg6yky', 'lskjkfghd@fdgslkgsjh.sdhgkjh', 'sfjklgh', 'jgsdhfgk', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT für Tabelle `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT für Tabelle `game_user`
--
ALTER TABLE `game_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT für Tabelle `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `puns`
--
ALTER TABLE `puns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
