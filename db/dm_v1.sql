-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Ápr 12. 21:53
-- Kiszolgáló verziója: 10.4.10-MariaDB
-- PHP verzió: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `dm_v1`
--
CREATE DATABASE IF NOT EXISTS `dm_v1` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `dm_v1`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `user_id` int(11) NOT NULL,
  `category` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`user_id`, `category`, `category_id`) VALUES
(1, 'AAA- kategoria - 1', 1),
(1, 'AAA- kategoria - 2', 2),
(1, 'category', 3),
(1, 'fgsdfghdfgh', 5),
(1, '111111122', 6),
(1, 'fhdfghdfghd', 7),
(4, 'bejövő levelek', 9),
(4, 'bejövő számlák', 13),
(4, 'kimenő levelek', 14),
(6, 'bejövő levelek', 19),
(6, 'bejövő számlák', 20),
(6, 'kimenő levelek', 21);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `login_log`
--

CREATE TABLE `login_log` (
  `user_id` int(11) NOT NULL,
  `login_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `login_log`
--

INSERT INTO `login_log` (`user_id`, `login_date`) VALUES
(1, '2020-04-02 09:06:50'),
(2, '2020-04-02 09:07:09'),
(3, '2020-04-02 09:07:25'),
(2, '2020-04-02 09:09:56'),
(2, '2020-04-02 09:12:31'),
(2, '2020-04-02 09:12:33'),
(3, '2020-04-02 09:12:39'),
(3, '2020-04-02 09:13:22'),
(3, '2020-04-02 09:17:54'),
(2, '2020-04-02 09:20:25'),
(2, '2020-04-02 09:41:07'),
(2, '2020-04-02 09:46:12'),
(2, '2020-04-02 10:06:50'),
(2, '2020-04-02 10:07:45'),
(2, '2020-04-02 10:10:08'),
(1, '2020-04-02 10:13:10'),
(3, '2020-04-02 10:13:40'),
(2, '2020-04-02 10:14:57'),
(2, '2020-04-02 10:23:58'),
(2, '2020-04-02 10:26:22'),
(2, '2020-04-02 10:34:17'),
(2, '2020-04-02 10:34:56'),
(2, '2020-04-02 10:36:11'),
(2, '2020-04-02 10:39:35'),
(2, '2020-04-02 10:41:06'),
(2, '2020-04-02 10:42:54'),
(2, '2020-04-02 14:40:21'),
(2, '2020-04-02 14:41:55'),
(2, '2020-04-02 14:44:47'),
(2, '2020-04-02 14:51:02'),
(2, '2020-04-02 14:52:05'),
(2, '2020-04-02 15:16:12'),
(2, '2020-04-02 15:18:08'),
(2, '2020-04-02 15:22:33'),
(2, '2020-04-02 21:28:39'),
(1, '2020-04-03 09:25:05'),
(1, '2020-04-03 09:38:17'),
(1, '2020-04-03 09:48:11'),
(1, '2020-04-03 10:10:57'),
(1, '2020-04-03 10:24:33'),
(1, '2020-04-03 10:32:24'),
(1, '2020-04-03 10:33:54'),
(1, '2020-04-03 10:35:40'),
(1, '2020-04-03 10:38:33'),
(1, '2020-04-03 10:39:25'),
(1, '2020-04-03 10:46:09'),
(1, '2020-04-03 10:48:31'),
(1, '2020-04-03 11:06:34'),
(1, '2020-04-03 11:14:23'),
(1, '2020-04-03 11:17:43'),
(1, '2020-04-03 11:22:02'),
(1, '2020-04-03 11:23:28'),
(1, '2020-04-03 11:24:29'),
(1, '2020-04-03 11:27:03'),
(1, '2020-04-03 11:31:15'),
(1, '2020-04-03 11:31:58'),
(1, '2020-04-03 11:33:25'),
(1, '2020-04-03 13:08:34'),
(1, '2020-04-03 16:22:02'),
(1, '2020-04-03 16:57:56'),
(1, '2020-04-03 16:59:21'),
(1, '2020-04-03 18:45:02'),
(1, '2020-04-03 19:09:08'),
(1, '2020-04-03 19:10:56'),
(1, '2020-04-03 19:18:05'),
(1, '2020-04-03 19:25:22'),
(1, '2020-04-03 19:26:08'),
(1, '2020-04-04 07:30:38'),
(1, '2020-04-04 07:54:50'),
(1, '2020-04-04 09:50:35'),
(1, '2020-04-04 10:32:53'),
(1, '2020-04-04 10:34:22'),
(1, '2020-04-04 10:49:49'),
(1, '2020-04-04 10:51:29'),
(1, '2020-04-04 16:25:11'),
(1, '2020-04-04 17:02:32'),
(1, '2020-04-04 17:03:58'),
(1, '2020-04-04 17:34:21'),
(1, '2020-04-04 17:37:33'),
(4, '2020-04-04 17:43:30'),
(4, '2020-04-04 18:18:02'),
(4, '2020-04-04 19:14:38'),
(4, '2020-04-04 19:15:09'),
(4, '2020-04-04 19:16:09'),
(4, '2020-04-04 19:26:01'),
(4, '2020-04-04 19:32:50'),
(4, '2020-04-04 19:33:31'),
(4, '2020-04-04 19:34:44'),
(4, '2020-04-04 19:41:31'),
(4, '2020-04-04 19:43:15'),
(4, '2020-04-04 19:43:41'),
(4, '2020-04-04 19:50:44'),
(4, '2020-04-04 19:53:53'),
(4, '2020-04-04 19:58:47'),
(4, '2020-04-05 09:22:00'),
(4, '2020-04-05 09:57:31'),
(4, '2020-04-05 09:58:20'),
(4, '2020-04-05 10:01:41'),
(4, '2020-04-05 10:06:03'),
(4, '2020-04-05 10:09:08'),
(4, '2020-04-05 10:09:33'),
(4, '2020-04-05 10:10:04'),
(4, '2020-04-05 10:13:59'),
(4, '2020-04-05 10:15:56'),
(4, '2020-04-05 10:16:21'),
(4, '2020-04-05 10:16:59'),
(4, '2020-04-05 10:18:12'),
(4, '2020-04-05 10:18:31'),
(4, '2020-04-05 10:19:23'),
(4, '2020-04-05 10:26:45'),
(4, '2020-04-05 10:27:43'),
(4, '2020-04-05 14:27:30'),
(4, '2020-04-05 14:28:51'),
(4, '2020-04-05 14:34:28'),
(4, '2020-04-05 14:35:31'),
(4, '2020-04-05 14:35:49'),
(4, '2020-04-05 15:31:40'),
(4, '2020-04-05 15:36:15'),
(4, '2020-04-05 15:36:35'),
(4, '2020-04-05 15:43:49'),
(4, '2020-04-05 15:44:25'),
(4, '2020-04-05 15:44:44'),
(4, '2020-04-05 15:45:16'),
(4, '2020-04-05 15:45:36'),
(4, '2020-04-05 15:45:59'),
(4, '2020-04-05 15:46:33'),
(4, '2020-04-05 15:47:01'),
(4, '2020-04-05 15:49:53'),
(4, '2020-04-05 15:50:16'),
(4, '2020-04-05 15:51:12'),
(4, '2020-04-05 15:52:26'),
(4, '2020-04-05 16:03:26'),
(4, '2020-04-05 16:21:13'),
(4, '2020-04-05 16:22:32'),
(4, '2020-04-05 16:23:13'),
(4, '2020-04-05 16:33:23'),
(4, '2020-04-05 16:36:47'),
(4, '2020-04-05 16:37:11'),
(4, '2020-04-05 16:50:16'),
(4, '2020-04-05 16:55:22'),
(4, '2020-04-05 16:56:20'),
(4, '2020-04-05 17:04:12'),
(4, '2020-04-05 17:55:16'),
(4, '2020-04-05 18:07:41'),
(4, '2020-04-05 18:10:58'),
(4, '2020-04-05 18:46:02'),
(4, '2020-04-05 19:32:29'),
(4, '2020-04-05 20:49:54'),
(4, '2020-04-05 20:50:20'),
(4, '2020-04-06 07:18:49'),
(4, '2020-04-06 18:26:34'),
(4, '2020-04-06 18:30:05'),
(4, '2020-04-06 18:34:36'),
(4, '2020-04-06 18:40:24'),
(4, '2020-04-06 18:42:16'),
(4, '2020-04-06 18:49:17'),
(4, '2020-04-06 18:50:45'),
(4, '2020-04-06 18:52:56'),
(4, '2020-04-06 18:55:18'),
(4, '2020-04-06 19:02:01'),
(4, '2020-04-06 19:27:01'),
(4, '2020-04-06 19:59:10'),
(4, '2020-04-06 20:05:26'),
(4, '2020-04-07 07:06:06'),
(4, '2020-04-07 07:10:17'),
(4, '2020-04-07 18:16:23'),
(4, '2020-04-07 18:22:49'),
(4, '2020-04-07 18:23:25'),
(4, '2020-04-07 18:28:05'),
(4, '2020-04-07 18:28:23'),
(4, '2020-04-07 18:31:44'),
(4, '2020-04-07 19:54:40'),
(4, '2020-04-07 20:11:34'),
(4, '2020-04-07 20:55:59'),
(4, '2020-04-07 21:22:14'),
(4, '2020-04-07 21:36:34'),
(4, '2020-04-07 21:39:53'),
(4, '2020-04-08 18:22:35'),
(4, '2020-04-08 18:24:30'),
(4, '2020-04-08 18:56:06'),
(4, '2020-04-08 19:00:40'),
(4, '2020-04-08 19:43:34'),
(4, '2020-04-08 19:45:29'),
(4, '2020-04-08 20:25:25'),
(4, '2020-04-09 18:13:00'),
(4, '2020-04-09 19:03:33'),
(4, '2020-04-09 19:21:42'),
(4, '2020-04-09 19:37:22'),
(4, '2020-04-09 19:39:58'),
(4, '2020-04-09 19:40:30'),
(4, '2020-04-09 19:57:09'),
(4, '2020-04-09 20:05:17'),
(4, '2020-04-09 20:15:03'),
(4, '2020-04-09 20:35:37'),
(4, '2020-04-09 20:37:44'),
(4, '2020-04-10 07:25:37'),
(4, '2020-04-10 07:32:50'),
(4, '2020-04-10 07:51:07'),
(4, '2020-04-10 08:18:29'),
(4, '2020-04-10 09:55:13'),
(4, '2020-04-10 17:17:19'),
(4, '2020-04-11 11:32:33'),
(4, '2020-04-11 12:33:11'),
(4, '2020-04-11 16:32:26'),
(4, '2020-04-11 16:50:16'),
(4, '2020-04-11 20:11:31'),
(4, '2020-04-11 21:48:12'),
(4, '2020-04-11 21:49:12'),
(4, '2020-04-12 09:13:15'),
(4, '2020-04-12 10:12:13'),
(4, '2020-04-12 10:36:18'),
(4, '2020-04-12 10:42:14'),
(4, '2020-04-12 11:29:11'),
(4, '2020-04-12 15:19:51'),
(4, '2020-04-12 16:00:49'),
(4, '2020-04-12 16:47:24'),
(4, '2020-04-12 17:14:13'),
(4, '2020-04-12 18:22:24'),
(4, '2020-04-12 18:39:28'),
(4, '2020-04-12 19:03:31'),
(4, '2020-04-12 19:14:58'),
(6, '2020-04-12 19:31:20'),
(6, '2020-04-12 19:31:30'),
(6, '2020-04-12 20:00:59'),
(4, '2020-04-12 20:08:32'),
(4, '2020-04-12 20:17:21'),
(6, '2020-04-12 20:27:32'),
(8, '2020-04-12 20:32:42'),
(8, '2020-04-12 20:32:50'),
(6, '2020-04-12 20:37:16'),
(6, '2020-04-12 21:12:08'),
(6, '2020-04-12 21:33:32');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `out_email_log`
--

CREATE TABLE `out_email_log` (
  `user_id` int(11) NOT NULL,
  `out_email_subject` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `out_email_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `out_email_log`
--

INSERT INTO `out_email_log` (`user_id`, `out_email_subject`, `out_email_date`) VALUES
(4, '2020/153 - grrtghertht - dfgsdfg', '2020-04-05 20:40:16'),
(4, '2020/154 - grrtghertht - dfgsdfg', '2020-04-05 20:40:54'),
(4, '2020/155 - grrtghertht - dfgsdfg', '2020-04-05 20:41:11'),
(6, '2020/1 - Turmix Bt. - bejövő számlák', '2020-04-12 20:20:20'),
(6, '2020/1 - Turmix Bt. - bejövő számlák', '2020-04-12 21:34:56'),
(6, '2020/2 - Turmix Bt. - kimenő levelek', '2020-04-12 21:35:40');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `partners`
--

CREATE TABLE `partners` (
  `user_id` int(11) NOT NULL,
  `partners_id` int(11) NOT NULL,
  `partners_name` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `partners_address` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `partners_contacts` varchar(256) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `partners`
--

INSERT INTO `partners` (`user_id`, `partners_id`, `partners_name`, `partners_address`, `partners_contacts`) VALUES
(1, 4, 'adsfgsdfg-sdfgfghdfhdfjdghsdfgaa - 2', 'dfsklghk', 'skdhfbgkédfgé'),
(3, 5, 'ccc - 1', 'ugweuioz', 'uiretzerzp'),
(1, 10, 'aaa - 5', 'aaaaaaaaaaaaaa', 'aaaaa aaaaaa@aaaaa.com'),
(1, 11, 'sdfasfasf-aasdfagfdgjfajdfwt edfsdghvcyxfaf', 'wafeawere-dfacsndjzetruqwrasfa sdfasdgad', 'gfearter5346/4613123df64gert'),
(4, 12, 'xxx - 1 partner', 'xxx cím', 'telefon: +3625252525'),
(4, 13, 'we', 'ertwerzert', 'rtzuetutz'),
(4, 18, 'xxx- 2', 'rgwtrzert', 'sdfgsdgf'),
(4, 19, 'xxx- 3', 'sagrsdfg', 'erzter'),
(4, 20, 'xxx- 4', 'sagrsdfg', 'erzter'),
(4, 21, 'xxx- 5', 'sagrsdfg', 'erzter'),
(4, 22, 'xxx- 6', 'sagrsdfg', 'erzter'),
(4, 23, 'xxx- 7', 'sagrsdfg', 'erzter'),
(4, 27, 'xxx- 11', 'sagrsdfg', 'erzter'),
(4, 28, 'xxx- 12', 'sagrsdfg', 'erzter'),
(4, 29, 'xxx- 13', 'sagrsdfg', 'erzter'),
(4, 31, 'xxx- 15', 'sagrsdfg', 'erzter'),
(4, 32, 'xxx- 16', 'sagrsdfg', 'erzter'),
(4, 33, 'xxx- 17', 'sagrsdfg', 'erzter'),
(4, 34, 'xxx- 18', 'sagrsdfg', 'erzter'),
(4, 35, 'xxx- 19', 'sagrsdfg', 'erzter'),
(4, 36, 'xxx- 20', 'sagrsdfg', 'erzter'),
(4, 37, 'xxx- 21', 'sagrsdfg', 'erzter'),
(4, 38, 'xxx- 22', 'sagrsdfg', 'erzter'),
(4, 71, 'Valmit Gyártó Kft.', '3981 Makkoshotyka, fő utca 27.', 'tel.: +3647598756, e-mail: vgy@email.hu'),
(6, 72, 'Hugó Hami Ltd.', '1489 Hamifalva, Fő utca 42/a.', 'Tel.: +3690555148, e-mail: hugohami@hh.com'),
(6, 73, 'Turmix Bt.', '1598 Zagyvaalsó, Petőfi utca 85.', '-');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login_name` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `full_name` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `target_email` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `info_email` varchar(256) COLLATE utf8_hungarian_ci NOT NULL,
  `last_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `login_name`, `password`, `full_name`, `target_email`, `info_email`, `last_number`) VALUES
(4, 'toth_peter', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'Tóth Péter', 'kotsonya@gmail.com', 'kotsonya@gmail.com', 125),
(6, 'banyai_lilla', '47bce5c74f589f4867dbd57e9ca9f808', 'Bányai Lilla', 'kotsonya.dm@gmail.com', 'kotsonya.dm@gmail.com', 2),
(8, 'szabo_janos', '47bce5c74f589f4867dbd57e9ca9f808', 'Szabó János', 'kotsonya.dm@gmail.com', 'kotsonya.dm@gmail.com', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- A tábla indexei `out_email_log`
--
ALTER TABLE `out_email_log`
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partners_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT a táblához `partners`
--
ALTER TABLE `partners`
  MODIFY `partners_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `out_email_log`
--
ALTER TABLE `out_email_log`
  ADD CONSTRAINT `out_email_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
