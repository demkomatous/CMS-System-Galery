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
-- Struktura tabulky `galery_photos`
--

CREATE TABLE `galery_photos` (
  `ID` int(11) NOT NULL,
  `header` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `Date` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `UpdateDate` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `UpdatedTimes` bigint(20) NOT NULL,
  `URL` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `uploader` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `galery_photos`
--

INSERT INTO `galery_photos` (`ID`, `header`, `description`, `autor`, `Date`, `UpdateDate`, `UpdatedTimes`, `URL`, `uploader`) VALUES
(11, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(12, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(13, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(14, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(15, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(16, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(17, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(18, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(19, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(20, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(21, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(22, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(23, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(24, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(25, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(26, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(27, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(28, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(29, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(30, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(31, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(32, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(33, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(34, 'Savanna koza', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool Kozel', 'KOZEL', '28.12. 2003', '12.08.2021', 3, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(35, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(36, 'Savanna sunrise', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Savannnaaaaaaa', '28.12. 2003', '', 0, 'https://static.posters.cz/image/1300/art-photo/sunrise-i95174.jpg', 0),
(64, 'Only', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Super Cool', 'Ich', '13.08.2021', '13.08.2021', 5, 'Media/Nabídka - Banner1628847395289.png', 46),
(65, 'dsxdsxdsd', 'The photo was taken at 5 o\'clock. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ', 'Jarabi', '13.08.2021', '', 0, 'Media/MD1628857050271.jpg', 46),
(67, 'srh', 'sh', 'sh', '13.08.2021', '', 0, 'Media/AgentGelehad1628860010697.png', 46),
(68, 'srh', 'sh', 'sh', '13.08.2021', '', 0, 'Media/AgentGelehad1628860022281.png', 46),
(69, 'srh', 'Seminář', 'sh', '13.08.2021', '14.08.2021', 1, 'Media/4ITa1628860064787.PNG', 46),
(70, 'srh', 'sh', 'sh', '13.08.2021', '', 0, 'Media/4ITa1628860109903.PNG', 46),
(71, 'srh', 'sh', 'sh', '13.08.2021', '', 0, 'Media/duha1628860136030.png', 46),
(72, 'srh', 'sh', 'sh', '13.08.2021', '', 0, 'Media/duha1628860168182.png', 46);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `galery_photos`
--
ALTER TABLE `galery_photos`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `galery_photos`
--
ALTER TABLE `galery_photos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
