-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Mai 2016 um 13:22
-- Server-Version: 10.1.9-MariaDB
-- PHP-Version: 5.6.15

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
-- Tabellenstruktur für Tabelle `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `image_thumb_path` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `image_path` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `galery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image_tag`
--

CREATE TABLE `image_tag` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_german2_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_galery`
--

CREATE TABLE `user_galery` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `galery_id` int(11) NOT NULL,
  `owner` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `image_tag`
--
ALTER TABLE `image_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_galery`
--
ALTER TABLE `user_galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users` (`user_id`),
  ADD KEY `fk_fotogalerie` (`galery_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT für Tabelle `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT für Tabelle `image_tag`
--
ALTER TABLE `image_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT für Tabelle `user_galery`
--
ALTER TABLE `user_galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
