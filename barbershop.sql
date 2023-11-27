-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 17. 19:36
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `barbershop`
--
CREATE DATABASE IF NOT EXISTS `barbershop` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `barbershop`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adminok`
--

CREATE TABLE `adminok` (
  `id` int(11) NOT NULL,
  `fnev` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jelszo` char(64) NOT NULL,
  `so` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `adminok`
--

INSERT INTO `adminok` (`id`, `fnev`, `email`, `jelszo`, `so`) VALUES
(1, 'Szakker123', 'szakonyi.adam.bosco@gmail.com', 'dc0ac5066e0b9bd6009b107f23bfad3580dcce39e8d777b1e47f4affe9350a31', '4Zm1Vx8Lx');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalasok`
--

CREATE TABLE `foglalasok` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `telszam` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kezdes` datetime NOT NULL,
  `vege` datetime NOT NULL,
  `szolgID` int(11) NOT NULL,
  `teljesitve` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `foglalasok`
--

INSERT INTO `foglalasok` (`id`, `nev`, `telszam`, `email`, `kezdes`, `vege`, `szolgID`, `teljesitve`) VALUES
(7, 'Szakonyi Ádám', '06308317023', 'szakonyi.adam.bosco@gmail.com', '2023-11-15 11:00:00', '2023-11-15 12:15:00', 4, 1),
(8, 'Szakonyi Ádám', '06308317023', 'szakonyi.adam.bosco@gmail.com', '2023-11-15 14:00:00', '2023-11-15 15:15:00', 4, 0),
(9, 'Szakonyi Ádám', '06308317023', 'szakonyi.adam.bosco@gmail.com', '2023-11-15 16:30:00', '2023-11-15 17:45:00', 4, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szolgaltatasok`
--

CREATE TABLE `szolgaltatasok` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `koltseg` int(11) NOT NULL,
  `ido` varchar(50) NOT NULL,
  `idoegyseg` int(11) NOT NULL,
  `aktiv` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `szolgaltatasok`
--

INSERT INTO `szolgaltatasok` (`id`, `nev`, `koltseg`, `ido`, `idoegyseg`, `aktiv`) VALUES
(1, 'Hajvágás Egyhosszra', 1800, '45 perc', 3, 1),
(2, 'Hajvágás', 3300, '1 óra', 4, 1),
(3, 'Szakáll igazítás', 2000, '30 perc', 2, 1),
(4, 'Haj- és szakállvágás', 4800, '1 óra 30 perc', 6, 1),
(5, 'Gyermek Hajvágás', 2300, '45 perc', 3, 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `adminok`
--
ALTER TABLE `adminok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `foglalasok`
--
ALTER TABLE `foglalasok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `szolgaltatasok`
--
ALTER TABLE `szolgaltatasok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `adminok`
--
ALTER TABLE `adminok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `foglalasok`
--
ALTER TABLE `foglalasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT a táblához `szolgaltatasok`
--
ALTER TABLE `szolgaltatasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
