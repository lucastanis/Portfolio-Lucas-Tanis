-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 nov 2024 om 15:35
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verkiezing_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `party_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `party_id`) VALUES
(1, 'Mark Rutte', 1),
(2, 'Wouter Koolmees', 2),
(3, 'Geert Wilders', 3),
(4, 'Sigrid Kaag', 2),
(5, 'Tom van der Lee', 1),
(6, 'Mirjam Bakker', 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(17, 'testgebruiker_1', 'testgebruiker_1@gmail.com', 'test voor testgebruiker_1', '2024-10-16 09:39:17'),
(18, 'testgebruiker_1', 'testgebruiker_1@gmail.com', 'test voor testgebruiker_1', '2024-10-16 10:08:49');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parties`
--

CREATE TABLE `parties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `parties`
--

INSERT INTO `parties` (`id`, `name`) VALUES
(1, 'VVD'),
(2, 'D66'),
(3, 'PVV'),
(5, 'ChristenUnie');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('voter','candidate','party','election_type','admin') DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `reset_token`, `created_at`) VALUES
(25, 'admin', 'admin@example.com', '$2y$10$CqJHsSKo88u4s7bL24eWp.IvKydxjNbosS0MME4UzAlgtGmeBvw7.', 'admin', NULL, '2024-10-09 14:12:42'),
(33, 'testgebruiker_1', 'testgebruiker_1@gmail.com', '$2y$10$W.FH1DrM.lQK0u.d/OQvleOnfAXeDQuLV0jsuEtk7GUA8Mk3hbUMW', 'voter', NULL, '2024-10-14 12:26:28'),
(34, 'testgebruiker_2', 'testgebruiker_2@gmail.com', '$2y$10$F/a4c8/RnuowDYBiU.dIne4T7hd0SrvM/kAcqKi56fxcTgAatgtiC', 'voter', NULL, '2024-10-14 12:32:46'),
(35, 'testgebruiker_3', 'testgebruiker_3@gmail.com', '$2y$10$D6bkpgqVv7eQ0uUIMfQ0a.s3B4qLatBJnuB.Lvl1ymyhU1iTAYr..', 'voter', NULL, '2024-10-14 12:43:15'),
(36, 'testgebruiker_4', 'testgebruiker_4@gmail.com', '$2y$10$quGk5PGXdAaMQnrS1Z9XxOUFSRVJcY7JzLjdo/Mi9MBpHtfhgZqIe', 'voter', NULL, '2024-10-14 12:48:07');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `gekozen_partij` int(11) DEFAULT NULL,
  `gekozen_kandidaat` int(11) DEFAULT NULL,
  `vote_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `votes`
--

INSERT INTO `votes` (`id`, `username`, `gekozen_partij`, `gekozen_kandidaat`, `vote_time`) VALUES
(1, 'testgebruiker', 3, 1, '2024-10-14 12:30:56'),
(2, 'testgebruiker_2', 1, 2, '2024-10-14 12:33:21'),
(3, 'testgebruiker_3', 2, 2, '2024-10-14 12:43:33'),
(4, 'testgebruiker_4', 2, 2, '2024-10-14 12:48:23'),
(6, 'jacob', 2, 4, '2024-10-14 15:09:49'),
(7, 'emely', 1, 5, '2024-10-14 15:43:07'),
(8, 'kerel', 2, 2, '2024-10-15 09:05:53'),
(9, 'test', 1, 5, '2024-10-15 09:26:10'),
(10, 'jamal', 2, 2, '2024-10-15 09:33:06'),
(11, 'jemoeder', 3, 3, '2024-10-15 09:34:52'),
(12, 'jevader', 3, 3, '2024-10-15 09:35:43'),
(13, 'ermin', 3, 3, '2024-10-15 09:40:42'),
(14, 'ama', 5, 6, '2024-10-15 10:53:51'),
(15, 'test123', 5, 6, '2024-10-15 13:07:36'),
(16, 'arda', 5, 6, '2024-10-16 09:19:35'),
(17, 'rob', 5, 6, '2024-10-21 20:54:21'),
(18, 'emre', 1, 1, '2024-10-22 10:39:47'),
(19, 'younes', 2, 2, '2024-10-22 11:33:11');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_id` (`party_id`);

--
-- Indexen voor tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gekozen_partij` (`gekozen_partij`),
  ADD KEY `gekozen_kandidaat` (`gekozen_kandidaat`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `parties`
--
ALTER TABLE `parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT voor een tabel `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`);

--
-- Beperkingen voor tabel `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`gekozen_partij`) REFERENCES `parties` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`gekozen_kandidaat`) REFERENCES `candidates` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
