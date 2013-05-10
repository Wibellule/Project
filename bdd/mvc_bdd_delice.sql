-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 17 Avril 2013 à 15:06
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mvc_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `postscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `content`, `created`, `online`, `user_id`, `postscol`) VALUES
(2, 'Comment ça marche ?', 'comment-ca-marche', '<p>\r\n	Comment &ccedil;a marche ?</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Test de contenu</p>\r\n', '2013-02-12 00:00:00', 1, NULL, NULL),
(3, 'Services', 'services', '<p>\r\n	Nos services</p>\r\n', '2013-04-17 00:00:00', 1, NULL, NULL),
(4, 'Contact', 'contact', '<p>\r\n	Contact</p>\r\n', '2013-04-17 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `postscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `mails`
--

INSERT INTO `mails` (`id`, `name`, `slug`, `content`, `created`, `online`, `user_id`, `postscol`) VALUES
(1, 'toto', 'toto', 'qsdcsqce', '2013-02-12 00:00:00', 1, NULL, NULL),
(2, 'tutu', 'tutu', NULL, '2013-02-12 00:00:00', 1, NULL, NULL),
(3, 'tata', 'tata', NULL, NULL, 1, NULL, NULL),
(4, 'blabla', 'blabla', 'eqrgverer', '2013-03-11 00:00:00', 1, NULL, NULL),
(5, 'post2', 'post2', 'izoejfozienc', '2013-03-11 00:00:00', 1, NULL, NULL),
(6, 'fgbgfb', 'rbtbtr', 'trbrbgrt', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `postscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `name`, `slug`, `content`, `created`, `online`, `user_id`, `postscol`) VALUES
(1, 'Comment ça marche ?', 'comment-ca-marche', '<p>\r\n	Voici comment &ccedil;a marche</p>\r\n', '2013-02-12 00:00:00', 1, NULL, NULL),
(2, 'tutu', 'tutu', NULL, '2013-02-12 00:00:00', 1, NULL, NULL),
(3, 'tata', 'tata', NULL, NULL, 1, NULL, NULL),
(4, 'blabla', 'blabla', 'eqrgverer', '2013-03-11 00:00:00', 1, NULL, NULL),
(5, 'post2', 'post2', 'izoejfozienc', '2013-03-11 00:00:00', 1, NULL, NULL),
(6, 'fgbgfb', 'rbtbtr', 'trbrbgrt', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `online` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `online`) VALUES
(1, 'admin', 'admin', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
