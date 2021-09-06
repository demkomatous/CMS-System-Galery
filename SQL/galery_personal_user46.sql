-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 14. srp 2021, 16:45
-- Verze serveru: 10.4.17-MariaDB
-- Verze PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `database`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `galery_personal_user46`
--

CREATE TABLE `galery_personal_user46` (
  `ID` int(11) NOT NULL,
  `ID_photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `galery_personal_user46`
--

INSERT INTO `galery_personal_user46` (`ID`, `ID_photo`) VALUES
(104, 36),
(105, 35),
(106, 33),
(107, 28),
(108, 24),
(109, 27),
(110, 23),
(111, 20),
(112, 50),
(113, 72);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `galery_personal_user46`
--
ALTER TABLE `galery_personal_user46`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `galery_personal_user46`
--
ALTER TABLE `galery_personal_user46`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
