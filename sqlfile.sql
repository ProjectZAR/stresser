-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql3.blazingfast.io:3306
-- Généré le :  jeu. 23 nov. 2017 à 21:27
-- Version du serveur :  10.1.28-MariaDB-1~xenial
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `altgennc_lol`
--

-- --------------------------------------------------------

--
-- Structure de la table `2authsettings`
--

CREATE TABLE `2authsettings` (
  `secret` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `2authsettings`
--

INSERT INTO `2authsettings` (`secret`) VALUES
('66PUM3ZT5GIRPD3S'),
('66PUM3ZT5GIRPD3S');

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `id` int(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `client` varchar(64) NOT NULL,
  `action` varchar(6444) NOT NULL,
  `date` int(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id`, `admin`, `client`, `action`, `date`) VALUES
(13, 'livepreview', 'Alex', 'User updated to plan: admin', 1511381933),
(14, 'livepreview', 'livepreview', 'Users expire updated from 1519935533 to 01-03-2018', 1511382018),
(15, 'livepreview', 'The1NOlnyKing', 'User updated to plan: admin', 1511387147),
(16, 'The1NOlnyKing', 'The1NOlnyKing', 'Users expire updated from 1519940747 to 01-03-2018', 1511393451),
(17, 'livepreview', 'The1NOlnyKing', 'User updated to plan: Non', 1511393584),
(18, 'livepreview', 'The1NOlnyKing', 'Users expire updated from 0 to 01-03-2018', 1511393604),
(19, 'livepreview', 'livepreview', 'User updated to plan: VIP LifeTime', 1511394357);

-- --------------------------------------------------------

--
-- Structure de la table `affiliateWithdraws`
--

CREATE TABLE `affiliateWithdraws` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `withdrawAmount` varchar(255) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `paymentAddress` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `affiliateWithdraws`
--

INSERT INTO `affiliateWithdraws` (`ID`, `userID`, `withdrawAmount`, `paymentMethod`, `paymentAddress`, `status`, `date`) VALUES
(1, 3, '30', 'BTC', 'ADDRESSHERE', 0, 0),
(2, 3, '30', 'BTC', 'ADDRESSHERE', 0, 2323);

-- --------------------------------------------------------

--
-- Structure de la table `api`
--

CREATE TABLE `api` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `api` varchar(1024) NOT NULL,
  `slots` int(3) NOT NULL,
  `methods` varchar(100) NOT NULL,
  `vip` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bans`
--

CREATE TABLE `bans` (
  `username` varchar(15) NOT NULL,
  `reason` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bans`
--

INSERT INTO `bans` (`username`, `reason`) VALUES
('The1NOlnyKing', ''),
('The1NOlnyKing', ''),
('The1NOlnyKing', ''),
('The1NOlnyKing', 'Testing');

-- --------------------------------------------------------

--
-- Structure de la table `blacklist`
--

CREATE TABLE `blacklist` (
  `ID` int(11) NOT NULL,
  `data` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id` int(3) NOT NULL,
  `question` varchar(1024) NOT NULL,
  `answer` varchar(5000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(3, 'What\'s the difference between normal and VIP packages?', 'VIP packages will send an attack with VIP servers and normal servers.\nNormal packages will send an attack with normal servers only.\nThis keeps the power for VIP strong and much harder hitting, making it worthy for the price.'),
(4, 'What powers the Layer 7 attack methods?', 'We don\'t use old methods like XML-RPC, Joomla or even proxies.\r\nOur Layer 7 is is powered by 2 botnets (1 for normal and 1 for VIP) which means that our power doesn\'t rely on exploits or proxies which will die quickly.'),
(5, 'Why are VIP packages double the price of normal packages?', 'VIP packages are double the price because of the drastically large amount of power per attack.\r\nVIP attacks have more than twice the amount of power (on average) than normal attacks, making VIP packages worth more than double the amount or normal packages.');

-- --------------------------------------------------------

--
-- Structure de la table `fe`
--

CREATE TABLE `fe` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `giftcards`
--

CREATE TABLE `giftcards` (
  `ID` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `planID` int(11) NOT NULL,
  `claimedby` int(11) NOT NULL,
  `dateClaimed` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `iplogs`
--

CREATE TABLE `iplogs` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `logged` varchar(15) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loginlogs`
--

CREATE TABLE `loginlogs` (
  `username` varchar(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `loginlogs`
--

INSERT INTO `loginlogs` (`username`, `ip`, `date`, `country`) VALUES
('livepreview', '69.204.55.202', 1511385130, 'United States'),
('livepreview', '74.192.60.138', 1511385768, 'United States'),
('livepreview', '69.204.55.202', 1511385806, 'United States'),
('The1NOlnyKing', '108.162.216.121', 1511386566, 'United States'),
(' livepreview - ', '108.162.216.121', 1511386680, 'XX'),
(' livepreview - ', '108.162.216.121', 1511386680, 'XX'),
(' livepreview - ', '108.162.216.121', 1511386692, 'XX'),
(' livepreview - ', '108.162.216.121', 1511386692, 'XX'),
('livepreview - f', '108.162.216.121', 1511386727, 'XX'),
(' livepreview - ', '108.162.216.121', 1511386773, 'XX'),
(' livepreview - ', '108.162.216.121', 1511386773, 'XX'),
('livepreview ', '108.162.216.121', 1511386860, 'United States'),
('The1NOlnyKing', '108.162.216.121', 1511387208, 'United States'),
('The1NOlnyKing', '108.162.216.121', 1511388080, 'United States'),
('The1NOlnyKing', '108.162.216.121', 1511392530, 'United States'),
('livepreview ', '108.162.216.121', 1511393499, 'United States'),
('livepreview ', '108.162.216.121', 1511396479, 'United States'),
('livepreview ', '108.162.216.121', 1511396593, 'United States'),
('livepreview', '108.162.216.121', 1511404185, 'United States'),
('livepreview', '74.192.60.138', 1511408905, 'United States'),
('livepreview ', '69.204.55.202', 1511411979, 'United States');

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `ip` varchar(1024) NOT NULL,
  `port` int(5) NOT NULL,
  `time` int(4) NOT NULL,
  `method` varchar(10) NOT NULL,
  `date` int(11) NOT NULL,
  `chart` varchar(255) NOT NULL,
  `stopped` int(1) NOT NULL DEFAULT '0',
  `handler` varchar(50) NOT NULL,
  `vip` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `logs`
--

INSERT INTO `logs` (`id`, `user`, `ip`, `port`, `time`, `method`, `date`, `chart`, `stopped`, `handler`, `vip`) VALUES
(157, 'The1NOlnyKing', '47.183.115.235', 57611, 300, 'UDP', 1511389448, '22-11', 1, 'Legion4', 1),
(158, 'The1NOlnyKing', '47.183.115.235', 57611, 300, 'UDP', 1511389549, '22-11', 1, 'Legion4', 1),
(159, 'The1NOlnyKing', '47.183.115.235', 57611, 300, 'UDP', 1511389552, '22-11', 1, 'Legion4', 1),
(160, 'The1NOlnyKing', '47.183.115.235', 57611, 300, 'UDP', 1511389554, '22-11', 0, 'Legion4', 1),
(161, 'The1NOlnyKing', '47.183.115.235', 57611, 300, 'UDP', 1511393045, '22-11', 0, 'UDP', 1),
(162, 'livepreview', '47.183.115.235', 57611, 300, 'UDP', 1511412287, '23-11', 1, 'GhostStresset', 1),
(163, 'livepreview', '47.183.115.235', 57611, 300, 'UDP', 1511412345, '23-11', 0, 'GhostStresset', 1),
(164, 'livepreview', '47.183.115.235', 57611, 300, 'UDP', 1511412649, '23-11', 1, 'GhostStresset', 1),
(165, 'livepreview', '47.183.115.235', 57611, 300, 'UDP', 1511412716, '23-11', 1, 'GhostStresset', 1),
(166, 'livepreview', '47.183.115.235', 57611, 300, 'UDP', 1511412739, '23-11', 1, 'GhostStresset', 1),
(167, 'livepreview', '47.183.115.235', 57611, 600, 'UDP', 1511412770, '23-11', 0, 'GhostStresset', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `messageid` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `content` text NOT NULL,
  `sender` varchar(30) NOT NULL,
  `date` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`messageid`, `ticketid`, `content`, `sender`, `date`) VALUES
(5, 9, 'bey', 'Admin', 1511394407),
(6, 9, 'bey', 'Admin', 1511394413);

-- --------------------------------------------------------

--
-- Structure de la table `methods`
--

CREATE TABLE `methods` (
  `id` int(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `type` varchar(6) NOT NULL,
  `command` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `title` varchar(1024) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `paid` float NOT NULL,
  `plan` int(11) NOT NULL,
  `user` int(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tid` varchar(30) NOT NULL,
  `date` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ping_sessions`
--

CREATE TABLE `ping_sessions` (
  `ID` int(11) NOT NULL,
  `ping_key` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ping_ip` varchar(25) NOT NULL,
  `ping_port` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ping_sessions`
--

INSERT INTO `ping_sessions` (`ID`, `ping_key`, `user_id`, `ping_ip`, `ping_port`) VALUES
(104, '5a448e415a21677d8a162270801ee29b', 43, '47.183.115.235', '57611'),
(105, '6c9beb385afc53e21b45b7a881dc93bc', 43, '47.183.115.235', '57611'),
(106, '535afc17eabb3dc76eee0e113c5220a3', 43, '47.183.115.235', '57611'),
(107, '8277f2f7ff12ff254056eec9a3c6674b', 43, '47.183.115.235', '57611'),
(108, '5d25563287cc4cdcab024d9f440eefc1', 43, '47.183.115.235', '57611'),
(109, 'b6fef4ca197a3d9a1a2948a1d905609d', 42, '47.183.115.235', '57611'),
(110, '5af16ed670ea01e859b6470a8611742f', 42, '47.183.115.235', '57611'),
(111, '2317105e6402669060989980641ad897', 42, '47.183.115.235', '57611'),
(112, 'cb9471ca2f1ffbf12c63e9e88c8a51d0', 42, '47.183.115.235', '57611'),
(113, '24ae4029fcd171727a8e0a6e2778534a', 42, '47.183.115.235', '57611'),
(114, '7861729bc76f7c4aad3ab26ea5a47e38', 42, '47.183.115.235', '57611');

-- --------------------------------------------------------

--
-- Structure de la table `plans`
--

CREATE TABLE `plans` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `vip` int(11) NOT NULL,
  `mbt` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `length` int(11) NOT NULL,
  `price` float NOT NULL,
  `concurrents` int(11) NOT NULL,
  `private` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `plans`
--

INSERT INTO `plans` (`ID`, `name`, `vip`, `mbt`, `unit`, `length`, `price`, `concurrents`, `private`) VALUES
(34, '', 5000, 5000, 'Years', 25, 160, 16, 0),
(35, '', 5000, 5000, 'Years', 25, 160, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `report` varchar(644) NOT NULL,
  `date` int(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `servers`
--

CREATE TABLE `servers` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `slots` int(3) NOT NULL,
  `methods` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `sitename` varchar(1024) NOT NULL,
  `stripePubKey` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cooldown` int(11) NOT NULL,
  `cooldownTime` int(11) NOT NULL,
  `paypal` varchar(50) NOT NULL,
  `bitcoin` varchar(50) NOT NULL,
  `stripe` int(11) NOT NULL,
  `maintaince` varchar(100) NOT NULL,
  `rotation` int(1) NOT NULL DEFAULT '0',
  `system` varchar(7) NOT NULL,
  `maxattacks` int(5) NOT NULL,
  `testboots` int(1) NOT NULL,
  `cloudflare` int(1) NOT NULL,
  `skype` varchar(200) NOT NULL,
  `key` varchar(100) NOT NULL,
  `issuerId` varchar(50) NOT NULL,
  `coinpayments` varchar(50) NOT NULL,
  `ipnSecret` varchar(100) NOT NULL,
  `google_site` varchar(644) NOT NULL,
  `google_secret` varchar(644) NOT NULL,
  `btc_address` varchar(64) NOT NULL,
  `secretKey` varchar(50) NOT NULL,
  `cbp` int(1) NOT NULL,
  `paypal_email` varchar(64) NOT NULL,
  `theme` varchar(64) NOT NULL,
  `logo` varchar(64) NOT NULL,
  `stripeSecretKey` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `smtpsettings`
--

CREATE TABLE `smtpsettings` (
  `host` varchar(255) NOT NULL,
  `auth` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `port` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `subject` varchar(1024) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `date` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `content`, `status`, `username`, `date`) VALUES
(8, 'dfgdf', 'gdfgdfg', 'Waiting for admin response', 'shadow', 1477157708),
(9, 'ticket', 'loli', 'Closed', 'livepreview', 1511381911);

-- --------------------------------------------------------

--
-- Structure de la table `tos`
--

CREATE TABLE `tos` (
  `archive` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `membership` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `referral` varchar(50) NOT NULL,
  `referralbalance` int(3) NOT NULL DEFAULT '0',
  `testattack` int(1) NOT NULL,
  `activity` int(64) NOT NULL DEFAULT '0',
  `2auth` int(11) NOT NULL,
  `referedBy` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `affiliateWithdraws`
--
ALTER TABLE `affiliateWithdraws`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fe`
--
ALTER TABLE `fe`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `giftcards`
--
ALTER TABLE `giftcards`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `iplogs`
--
ALTER TABLE `iplogs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageid`);

--
-- Index pour la table `methods`
--
ALTER TABLE `methods`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ping_sessions`
--
ALTER TABLE `ping_sessions`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `reports`
--
ALTER TABLE `reports`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `key` (`key`),
  ADD KEY `sitename` (`sitename`(767));

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `affiliateWithdraws`
--
ALTER TABLE `affiliateWithdraws`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `fe`
--
ALTER TABLE `fe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `giftcards`
--
ALTER TABLE `giftcards`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `iplogs`
--
ALTER TABLE `iplogs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `methods`
--
ALTER TABLE `methods`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `ping_sessions`
--
ALTER TABLE `ping_sessions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT pour la table `plans`
--
ALTER TABLE `plans`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT pour la table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
