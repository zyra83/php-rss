-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 31 Juillet 2018 à 17:52
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `zebase`
--

-- --------------------------------------------------------

--
-- Structure de la table `rss_channel`
--

CREATE TABLE IF NOT EXISTS `rss_channel` (
`id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `rss_channel`
--

INSERT INTO `rss_channel` (`id`, `name`, `link`, `description`, `language`) VALUES
(1, 'pouic', 'nope', 'nope', 'nope');

-- --------------------------------------------------------

--
-- Structure de la table `rss_item`
--

CREATE TABLE IF NOT EXISTS `rss_item` (
`id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `pubDate` datetime DEFAULT NULL,
  `rss_itemcol` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `channel_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `rss_item`
--

INSERT INTO `rss_item` (`id`, `title`, `link`, `pubDate`, `rss_itemcol`, `description`, `channel_id`) VALUES
(5, 'Windows... 10...', 'http://unlien.fr', '2018-07-31 19:51:00', NULL, 'Résumé de l''actualité.', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `rss_channel`
--
ALTER TABLE `rss_channel`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rss_item`
--
ALTER TABLE `rss_item`
 ADD PRIMARY KEY (`id`), ADD KEY `aaa_idx` (`channel_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `rss_channel`
--
ALTER TABLE `rss_channel`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `rss_item`
--
ALTER TABLE `rss_item`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `rss_item`
--
ALTER TABLE `rss_item`
ADD CONSTRAINT `fk_item_channel` FOREIGN KEY (`channel_id`) REFERENCES `rss_channel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
