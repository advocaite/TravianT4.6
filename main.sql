-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 01:49 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation`
--

CREATE TABLE `activation` (
  `id` int(11) NOT NULL,
  `worldId` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(45) NOT NULL,
  `activationCode` varchar(15) NOT NULL,
  `newsletter` tinyint(1) UNSIGNED NOT NULL,
  `used` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `refUid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `reminded` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banip`
--

CREATE TABLE `banIP` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` bigint(12) UNSIGNED NOT NULL,
  `reason` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED NOT NULL,
  `blockTill` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bannerShop`
--

CREATE TABLE `bannerShop` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `expire` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clubMedals`
--

CREATE TABLE `clubMedals` (
  `id` int(11) NOT NULL,
  `worldId` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tribe` tinyint(1) UNSIGNED NOT NULL,
  `type` int(10) NOT NULL,
  `params` varchar(500) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL,
  `hidden` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `paymentAmount` double NOT NULL,
  `expiretime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `name`, `data`) VALUES
(2, '3x', '{\"speed\":\"3\",\"mapSize\":\"400\",\"startGold\":\"10000\",\"protectionHours\":\"72\",\"roundLength\":\"auto\",\"isPromoted\":\"0\",\"needPreregistrationCode\":\"0\",\"buyAnimals\":\"0\",\"buyAnimalsInterval\":\"0\",\"buyResources\":\"0\",\"buyResourcesInterval\":\"0\",\"buyTroops\":\"0\",\"buyTroopsInterval\":\"0\",\"startTimezone\":\"0\",\"instantFinishTraining\":\"0\",\"buyAdventure\":\"0\",\"activation\":\"1\"}'),
(3, 'Tx5', '{\"speed\":\"5\",\"mapSize\":\"400\",\"startGold\":\"100\",\"protectionHours\":\"48\",\"roundLength\":\"auto\",\"isPromoted\":\"1\",\"needPreregistrationCode\":\"0\",\"buyAnimals\":\"0\",\"buyAnimalsInterval\":\"0\",\"buyResources\":\"0\",\"buyResourcesInterval\":\"0\",\"buyTroops\":\"0\",\"buyTroopsInterval\":\"0\",\"startTimezone\":\"0\",\"instantFinishTraining\":\"0\",\"buyAdventure\":\"0\",\"activation\":\"1\"}'),
(4, '100x', '{\"speed\":\"100\",\"mapSize\":\"200\",\"startGold\":\"0\",\"protectionHours\":\"12\",\"roundLength\":\"7\",\"isPromoted\":\"1\",\"needPreregistrationCode\":\"0\",\"buyAnimals\":\"0\",\"buyAnimalsInterval\":\"0\",\"buyResources\":\"0\",\"buyResourcesInterval\":\"0\",\"buyTroops\":\"0\",\"buyTroopsInterval\":\"0\",\"startTimezone\":\"1\",\"instantFinishTraining\":\"0\",\"buyAdventure\":\"0\",\"activation\":\"1\"}'),
(5, '100k', '{\"speed\":\"100000\",\"mapSize\":\"200\",\"startGold\":\"500\",\"protectionHours\":\"12\",\"roundLength\":\"5\",\"isPromoted\":\"0\",\"needPreregistrationCode\":\"1\",\"buyAnimals\":\"1\",\"buyAnimalsInterval\":\"0\",\"buyResources\":\"1\",\"buyResourcesInterval\":\"0\",\"buyTroops\":\"1\",\"buyTroopsInterval\":\"0\",\"startTimezone\":\"1\",\"instantFinishTraining\":\"1\",\"buyAdventure\":\"1\",\"activation\":\"1\"}'),
(6, 'SP1', '{\"speed\":\"200000\",\"mapSize\":\"200\",\"startGold\":\"1000\",\"protectionHours\":\"6\",\"roundLength\":\"7\",\"isPromoted\":\"1\",\"needPreregistrationCode\":\"0\",\"buyAnimals\":\"1\",\"buyAnimalsInterval\":\"0\",\"buyResources\":\"1\",\"buyResourcesInterval\":\"0\",\"buyTroops\":\"1\",\"buyTroopsInterval\":\"0\",\"startTimezone\":\"1\",\"instantFinishTraining\":\"1\",\"buyAdventure\":\"1\",\"activation\":\"1\"}'),
(7, '10x', '{\"speed\":\"10\",\"mapSize\":\"400\",\"startGold\":\"50\",\"protectionHours\":\"12\",\"roundLength\":\"30\",\"isPromoted\":\"1\",\"needPreregistrationCode\":\"1\",\"buyAnimals\":\"0\",\"buyAnimalsInterval\":\"0\",\"buyResources\":\"0\",\"buyResourcesInterval\":\"0\",\"buyTroops\":\"0\",\"buyTroopsInterval\":\"0\",\"startTimezone\":\"1\",\"instantFinishTraining\":\"0\",\"buyAdventure\":\"1\",\"activation\":\"1\"}'),
(8, '5X', '{\"speed\":\"5\",\"mapSize\":\"400\",\"startGold\":\"50\",\"protectionHours\":\"48\",\"roundLength\":\"30\",\"isPromoted\":\"1\",\"needPreregistrationCode\":\"0\",\"buyAnimals\":\"0\",\"buyAnimalsInterval\":\"0\",\"buyResources\":\"0\",\"buyResourcesInterval\":\"0\",\"buyTroops\":\"0\",\"buyTroopsInterval\":\"0\",\"startTimezone\":\"1\",\"instantFinishTraining\":\"0\",\"buyAdventure\":\"0\",\"activation\":\"1\"}'),
(9, '100000x', '{\"speed\":\"100000\",\"mapSize\":\"200\",\"startGold\":\"500\",\"protectionHours\":\"12\",\"roundLength\":\"3\",\"isPromoted\":\"0\",\"needPreregistrationCode\":\"0\",\"buyAnimals\":\"1\",\"buyAnimalsInterval\":\"0\",\"buyResources\":\"1\",\"buyResourcesInterval\":\"0\",\"buyTroops\":\"1\",\"buyTroopsInterval\":\"0\",\"startTimezone\":\"1\",\"instantFinishTraining\":\"1\",\"buyAdventure\":\"1\",\"activation\":\"0\"}');

-- --------------------------------------------------------

--
-- Table structure for table `email_blacklist`
--

CREATE TABLE `email_blacklist` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gameServers`
--

CREATE TABLE `gameServers` (
  `id` int(11) NOT NULL,
  `worldId` varchar(100) NOT NULL,
  `speed` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `version` int(1) NOT NULL,
  `gameWorldUrl` varchar(500) NOT NULL,
  `startTime` int(10) UNSIGNED NOT NULL,
  `roundLength` int(10) UNSIGNED NOT NULL,
  `finished` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `registerClosed` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `activation` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `preregistration_key_only` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `hidden` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `promoted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `configFileLocation` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gameServers`
--

INSERT INTO `gameServers` (`id`, `worldId`, `speed`, `name`, `version`, `gameWorldUrl`, `startTime`, `roundLength`, `finished`, `registerClosed`, `activation`, `preregistration_key_only`, `hidden`, `promoted`, `configFileLocation`) VALUES
(9, 'dev', 5000, 'Developer', 4, 'http://dev.YOUR_DOMAIN', 1538922600, 1, 0, 0, 1, 0, 0, 0, '/home/travian/USERNAME_HERE/servers/dev/include/connection.php'),
(359, 'ts2', 100000, '100000X', 4, 'http://ts2.YOUR_DOMAIN/', 1685131200, 3, 1, 1, 1, 0, 0, 0, '/home/travian/USERNAME_HERE/servers/ts2/include/connection.php');


-- --------------------------------------------------------

--
-- Table structure for table `goldProducts`
--

CREATE TABLE `goldProducts` (
  `goldProductId` int(11) NOT NULL,
  `goldProductName` varchar(100) NOT NULL,
  `goldProductLocation` int(10) UNSIGNED NOT NULL,
  `goldProductGold` int(10) UNSIGNED NOT NULL,
  `goldProductPrice` double UNSIGNED NOT NULL,
  `goldProductMoneyUnit` varchar(100) NOT NULL,
  `goldProductImageName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `goldProductHasOffer` tinyint(3) UNSIGNED NOT NULL,
  `isBestSeller` tinyint(4) NOT NULL DEFAULT 0,
  `isBestValue` tinyint(4) NOT NULL DEFAULT 0,
  `isSMS` tinyint(4) NOT NULL DEFAULT 0,
  `isActive` tinyint(4) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goldProducts`
--

INSERT INTO `goldProducts` (`goldProductId`, `goldProductName`, `goldProductLocation`, `goldProductGold`, `goldProductPrice`, `goldProductMoneyUnit`, `goldProductImageName`, `goldProductHasOffer`, `isBestSeller`, `isBestValue`, `isSMS`, `isActive`) VALUES
(2, 'بسته A', 1, 100, 49000, 'IRR', 'Travian_Facelift_1.png', 0, 0, 0, 0, 1),
(3, 'بسته B', 1, 250, 99000, 'IRR', 'Travian_Facelift_2.png', 0, 0, 0, 0, 1),
(4, 'بسته C', 1, 500, 179000, 'IRR', 'Travian_Facelift_3.png', 0, 1, 0, 0, 1),
(5, 'بسته D', 1, 1600, 499000, 'IRR', 'Travian_Facelift_4.png', 0, 0, 0, 0, 1),
(6, 'بسته E', 1, 3500, 999000, 'IRR', 'Travian_Facelift_5.png', 0, 0, 1, 0, 1),
(7, 'Package A', 2, 30, 0.49, 'USD', 'Travian_Facelift_1.png', 0, 0, 0, 1, 1),
(8, 'Package B', 2, 100, 1.49, 'USD', 'Travian_Facelift_2.png', 0, 0, 0, 0, 1),
(9, 'Package C', 2, 250, 2.99, 'USD', 'Travian_Facelift_3.png', 0, 0, 0, 0, 1),
(10, 'Package D', 2, 600, 6.99, 'USD', 'Travian_Facelift_4.png', 0, 0, 0, 0, 1),
(11, 'Package E', 2, 1600, 13.99, 'USD', 'Travian_Facelift_5.png', 0, 1, 0, 0, 1),
(12, 'Package F', 2, 3500, 27.99, 'USD', 'Travian_Facelift_6.png', 0, 0, 0, 0, 0),
(13, 'Package G', 2, 7000, 49.99, 'USD', '4_6_5.png', 0, 0, 1, 0, 1),
(14, 'Package A', 2, 30, 0.49, 'USD', '4_6_1.png', 0, 0, 0, 1, 0),
(15, 'Package B', 2, 100, 1.49, 'USD', '4_6_2.png', 0, 0, 0, 0, 0),
(16, 'Package C', 2, 250, 2.99, 'USD', '4_6_3.png', 0, 0, 0, 0, 0),
(17, 'Package D', 2, 600, 6.99, 'USD', '4_6_4.png', 0, 0, 0, 0, 0),
(18, 'Package E', 2, 1600, 13.99, 'USD', '4_6_5.png', 0, 1, 0, 0, 0),
(19, 'Package F', 2, 3500, 27.99, 'USD', '4_6_6.png', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `handshakes`
--

CREATE TABLE `handshakes` (
  `id` int(11) NOT NULL,
  `handshakes` varchar(100) NOT NULL,
  `isSitter` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `expireTime` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `infobox`
--

CREATE TABLE `infobox` (
  `id` int(11) UNSIGNED NOT NULL,
  `autoType` tinyint(1) NOT NULL DEFAULT 0,
  `params` text NOT NULL,
  `showFrom` int(10) UNSIGNED NOT NULL,
  `showTo` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 NOT NULL,
  `content_language` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'Like: USD, Rials'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mailServer`
--

CREATE TABLE `mailServer` (
  `id` int(11) NOT NULL,
  `toEmail` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `html` longtext NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `expire` int(10) UNSIGNED NOT NULL,
  `shortDesc` text DEFAULT NULL,
  `moreLink` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `private_key` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `pin` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `package_codes`
--

CREATE TABLE `package_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `isGift` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `used` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passwordRecovery`
--

CREATE TABLE `passwordRecovery` (
  `id` int(10) UNSIGNED NOT NULL,
  `wid` int(10) UNSIGNED NOT NULL,
  `recoveryCode` varchar(255) NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentConfig`
--

CREATE TABLE `paymentConfig` (
  `id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `offerFrom` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `offer` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `mailerLock` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `notificationGroupId` varchar(50) NOT NULL DEFAULT '-1001069565293',
  `notificationLock` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `lastIncomeCheck` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `lastIncomeHash` varchar(32) DEFAULT NULL,
  `loginToken` varchar(100) DEFAULT NULL,
  `votingGold` int(10) UNSIGNED NOT NULL DEFAULT 50
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paymentLog`
--

CREATE TABLE `paymentLog` (
  `id` int(10) UNSIGNED NOT NULL,
  `worldUniqueId` int(11) NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `secureId` varchar(100) CHARACTER SET utf8 NOT NULL,
  `paymentProvider` int(10) UNSIGNED NOT NULL,
  `productId` int(10) UNSIGNED NOT NULL,
  `payPrice` double UNSIGNED DEFAULT 0,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `data` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentProviders`
--

CREATE TABLE `paymentProviders` (
  `providerId` int(10) UNSIGNED NOT NULL,
  `providerType` int(10) UNSIGNED NOT NULL,
  `location` int(10) UNSIGNED NOT NULL,
  `posId` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `img` varchar(100) CHARACTER SET utf8 NOT NULL,
  `delivery` varchar(100) CHARACTER SET utf8 NOT NULL,
  `connectInfo` text CHARACTER SET utf8 NOT NULL,
  `isProviderLoadedByHTML` tinyint(1) UNSIGNED NOT NULL,
  `hidden` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `isActive` tinyint(4) NOT NULL DEFAULT 1,
  `isSMS` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentVoucher`
--

CREATE TABLE `paymentVoucher` (
  `id` int(11) NOT NULL,
  `gold` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `worldId` varchar(100) DEFAULT NULL,
  `player` varchar(100) DEFAULT NULL,
  `reason` varchar(50) DEFAULT NULL,
  `voucherCode` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED NOT NULL,
  `used` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `usedTime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `usedWorldId` varchar(350) DEFAULT NULL,
  `usedPlayer` varchar(100) DEFAULT NULL,
  `usedEmail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preregistration_keys`
--

CREATE TABLE `preregistration_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `worldId` varchar(20) NOT NULL,
  `pre_key` varchar(32) NOT NULL,
  `used` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `taskQueue`
--

CREATE TABLE `taskQueue` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('install','uninstall','flushTokens','start-engine','stop-engine','restart-engine','') CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` enum('pending','done','failed') NOT NULL DEFAULT 'pending',
  `time` int(10) UNSIGNED NOT NULL,
  `failReason` text CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `worldUniqueId` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `answered` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `txn_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `voting_log`
--

CREATE TABLE `voting_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `wid` int(10) UNSIGNED NOT NULL,
  `uid` int(11) UNSIGNED NOT NULL,
  `ip` bigint(20) UNSIGNED DEFAULT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation`
--
ALTER TABLE `activation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminded` (`reminded`);

--
-- Indexes for table `banip`
--
ALTER TABLE `banIP`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip` (`ip`,`blockTill`);

--
-- Indexes for table `bannerShop`
--
ALTER TABLE `bannerShop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expire` (`expire`);

--
-- Indexes for table `clubMedals`
--
ALTER TABLE `clubMedals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hidden` (`hidden`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_blacklist`
--
ALTER TABLE `email_blacklist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `time` (`time`);

--
-- Indexes for table `gameServers`
--
ALTER TABLE `gameServers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `search` (`finished`,`registerClosed`,`hidden`);

--
-- Indexes for table `goldProducts`
--
ALTER TABLE `goldProducts`
  ADD PRIMARY KEY (`goldProductId`);

--
-- Indexes for table `handshakes`
--
ALTER TABLE `handshakes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `handshakes` (`handshakes`);

--
-- Indexes for table `infobox`
--
ALTER TABLE `infobox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `search` (`showTo`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailServer`
--
ALTER TABLE `mailServer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority` (`priority`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expire` (`expire`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `private_key` (`private_key`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `search` (`time`);

--
-- Indexes for table `package_codes`
--
ALTER TABLE `package_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_2` (`code`),
  ADD KEY `code` (`code`),
  ADD KEY `used` (`used`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `passwordRecovery`
--
ALTER TABLE `passwordRecovery`
  ADD PRIMARY KEY (`id`,`wid`),
  ADD KEY `recoveryCode` (`recoveryCode`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `paymentConfig`
--
ALTER TABLE `paymentConfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentLog`
--
ALTER TABLE `paymentLog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `secureId` (`secureId`),
  ADD KEY `uid` (`uid`),
  ADD KEY `paymentProvider` (`paymentProvider`),
  ADD KEY `email` (`email`),
  ADD KEY `worldUniqueId` (`worldUniqueId`);

--
-- Indexes for table `paymentProviders`
--
ALTER TABLE `paymentProviders`
  ADD PRIMARY KEY (`providerId`),
  ADD KEY `location` (`location`),
  ADD KEY `posId` (`posId`),
  ADD KEY `hidden` (`hidden`),
  ADD KEY `providerType` (`providerType`);

--
-- Indexes for table `paymentVoucher`
--
ALTER TABLE `paymentVoucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucherCode` (`voucherCode`),
  ADD KEY `gold` (`gold`),
  ADD KEY `email` (`email`),
  ADD KEY `time` (`time`),
  ADD KEY `used` (`used`);

--
-- Indexes for table `preregistration_keys`
--
ALTER TABLE `preregistration_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worldId` (`worldId`,`pre_key`,`used`);

--
-- Indexes for table `taskQueue`
--
ALTER TABLE `taskQueue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answered` (`answered`,`time`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `txn_id` (`txn_id`);

--
-- Indexes for table `voting_log`
--
ALTER TABLE `voting_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`,`type`),
  ADD KEY `wid` (`wid`),
  ADD KEY `ip` (`ip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation`
--
ALTER TABLE `activation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banip`
--
ALTER TABLE `banIP`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bannerShop`
--
ALTER TABLE `bannerShop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubMedals`
--
ALTER TABLE `clubMedals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `email_blacklist`
--
ALTER TABLE `email_blacklist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gameServers`
--
ALTER TABLE `gameServers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `goldProducts`
--
ALTER TABLE `goldProducts`
  MODIFY `goldProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `handshakes`
--
ALTER TABLE `handshakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infobox`
--
ALTER TABLE `infobox`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mailServer`
--
ALTER TABLE `mailServer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_codes`
--
ALTER TABLE `package_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passwordRecovery`
--
ALTER TABLE `passwordRecovery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentConfig`
--
ALTER TABLE `paymentConfig`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentLog`
--
ALTER TABLE `paymentLog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentProviders`
--
ALTER TABLE `paymentProviders`
  MODIFY `providerId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentVoucher`
--
ALTER TABLE `paymentVoucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preregistration_keys`
--
ALTER TABLE `preregistration_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taskQueue`
--
ALTER TABLE `taskQueue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voting_log`
--
ALTER TABLE `voting_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
