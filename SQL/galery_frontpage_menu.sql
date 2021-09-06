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
-- Struktura tabulky `galery_frontpage_menu`
--

CREATE TABLE `galery_frontpage_menu` (
  `ID` int(11) NOT NULL,
  `URL` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `value` varchar(1000) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `galery_frontpage_menu`
--

INSERT INTO `galery_frontpage_menu` (`ID`, `URL`, `value`) VALUES
(1, 'index.php', 'Domů'),
(2, 'Upload.php', 'Nahrát obrázek'),
(3, 'Favourite.php', 'Oblíbené obrázky'),
(4, 'edit.php', 'Moje příspěvky'),
(5, 'view.php', 'Všechny příspěvky');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `galery_frontpage_menu`
--
ALTER TABLE `galery_frontpage_menu`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `galery_frontpage_menu`
--
ALTER TABLE `galery_frontpage_menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
