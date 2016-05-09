-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Mai 2016 um 16:13
-- Server-Version: 5.6.25
-- PHP-Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bilderdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_fotogalerien`
--

CREATE TABLE IF NOT EXISTS `tbl_fotogalerien` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `fk_fotos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_fotos`
--

CREATE TABLE IF NOT EXISTS `tbl_fotos` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `foto_path` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `image` blob NOT NULL,
  `fk_fotogalerie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_fotos_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_fotos_tags` (
  `id` int(11) NOT NULL,
  `fk_tags` int(11) NOT NULL,
  `fk_fotos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `userId` int(11) NOT NULL,
  `vorname` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `nachname` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `passwort` varchar(300) COLLATE utf8_german2_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_users_fotogalerien`
--

CREATE TABLE IF NOT EXISTS `tbl_users_fotogalerien` (
  `id` int(11) NOT NULL,
  `fk_users` int(11) NOT NULL,
  `fk_fotogalerie` int(11) NOT NULL,
  `owner` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_fotogalerien`
--
ALTER TABLE `tbl_fotogalerien`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tbl_fotos`
--
ALTER TABLE `tbl_fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tbl_fotos_tags`
--
ALTER TABLE `tbl_fotos_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indizes für die Tabelle `tbl_users_fotogalerien`
--
ALTER TABLE `tbl_users_fotogalerien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_fotogalerien`
--
ALTER TABLE `tbl_fotogalerien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_fotos`
--
ALTER TABLE `tbl_fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_fotos_tags`
--
ALTER TABLE `tbl_fotos_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tbl_users_fotogalerien`
--
ALTER TABLE `tbl_users_fotogalerien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
