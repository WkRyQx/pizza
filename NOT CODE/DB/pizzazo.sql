-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Sze 22. 14:33
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pizzazo`
--
CREATE DATABASE IF NOT EXISTS `pizzazo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `pizzazo`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznaló`
--

CREATE TABLE `felhasznaló` (
  `email` varchar(255) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `szallitasicim` varchar(255) NOT NULL,
  `pontok` int(11) NOT NULL,
  `kuponok` varchar(255) NOT NULL,
  `reg_datum` date NOT NULL,
  `szerpkor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles`
--

CREATE TABLE `rendeles` (
  `rendeles_id` int(11) NOT NULL,
  `rendeles_datuma` date NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelesek`
--

CREATE TABLE `rendelesek` (
  `termek_id` int(11) NOT NULL,
  `rendeles_id` int(11) NOT NULL,
  `ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szamla`
--

CREATE TABLE `szamla` (
  `szamla_id` int(11) NOT NULL,
  `kiallitas_datuma` int(11) NOT NULL,
  `fizetes_mod` int(11) NOT NULL,
  `rendeles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szerepkör`
--

CREATE TABLE `szerepkör` (
  `szerepkor_id` int(11) NOT NULL,
  `megnevezes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termék`
--

CREATE TABLE `termék` (
  `ternek_id` int(11) NOT NULL,
  `tipus` varchar(255) NOT NULL,
  `termek_nev` varchar(255) NOT NULL,
  `meret` int(11) NOT NULL,
  `ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznaló`
--
ALTER TABLE `felhasznaló`
  ADD PRIMARY KEY (`email`),
  ADD KEY `szerpkor_id` (`szerpkor_id`);

--
-- A tábla indexei `rendeles`
--
ALTER TABLE `rendeles`
  ADD PRIMARY KEY (`rendeles_id`),
  ADD KEY `email` (`email`);

--
-- A tábla indexei `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD KEY `termek_id` (`termek_id`),
  ADD KEY `rendeles_id` (`rendeles_id`);

--
-- A tábla indexei `szamla`
--
ALTER TABLE `szamla`
  ADD PRIMARY KEY (`szamla_id`),
  ADD KEY `rendeles_id` (`rendeles_id`);

--
-- A tábla indexei `szerepkör`
--
ALTER TABLE `szerepkör`
  ADD PRIMARY KEY (`szerepkor_id`);

--
-- A tábla indexei `termék`
--
ALTER TABLE `termék`
  ADD PRIMARY KEY (`ternek_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `rendeles`
--
ALTER TABLE `rendeles`
  MODIFY `rendeles_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `szamla`
--
ALTER TABLE `szamla`
  MODIFY `szamla_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `szerepkör`
--
ALTER TABLE `szerepkör`
  MODIFY `szerepkor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `termék`
--
ALTER TABLE `termék`
  MODIFY `ternek_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `felhasznaló`
--
ALTER TABLE `felhasznaló`
  ADD CONSTRAINT `felhasznaló_ibfk_1` FOREIGN KEY (`szerpkor_id`) REFERENCES `szerepkör` (`szerepkor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `rendeles`
--
ALTER TABLE `rendeles`
  ADD CONSTRAINT `rendeles_ibfk_1` FOREIGN KEY (`email`) REFERENCES `felhasznaló` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD CONSTRAINT `rendelesek_ibfk_1` FOREIGN KEY (`termek_id`) REFERENCES `termék` (`ternek_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rendelesek_ibfk_2` FOREIGN KEY (`rendeles_id`) REFERENCES `rendeles` (`rendeles_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `szamla`
--
ALTER TABLE `szamla`
  ADD CONSTRAINT `szamla_ibfk_1` FOREIGN KEY (`rendeles_id`) REFERENCES `rendeles` (`rendeles_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
