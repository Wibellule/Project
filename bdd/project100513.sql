-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 10 Mai 2013 à 15:03
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `postscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `type`, `content`, `created`, `online`, `lft`, `rgt`, `level`, `parent_id`, `user_id`, `postscol`) VALUES
(1, 'racine', 'racine-1', 3, 'racine', '2013-05-10 11:29:51', 1, 1, 12, 0, 0, NULL, NULL),
(33, 'branche 3', 'branche-3', 1, 'branche 3', '2013-05-10 14:24:33', 1, 10, 11, 3, 30, NULL, NULL),
(34, 'branche 4', 'branche-4', 1, 'branche 4', '2013-05-10 14:45:22', 1, 4, 5, 3, 30, NULL, NULL),
(27, 'branche 1', 'branche-1', 1, 'branche 1', '2013-05-10 13:48:46', 1, 2, 9, 1, 1, NULL, NULL),
(30, 'branche 2', 'branche-2', 1, 'branche 2', '2013-05-10 13:52:31', 1, 3, 6, 2, 27, NULL, NULL);

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
  `image` longtext COLLATE utf8_unicode_ci NOT NULL,
  `short_content` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `postscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `name`, `slug`, `image`, `short_content`, `content`, `tag`, `created`, `online`, `user_id`, `postscol`) VALUES
(1, 'Comment ça marche ?', 'comment-ca-marche', '', '', '<p>\r\n	Voici comment &ccedil;a marche</p>\r\n', '', '2013-02-12 00:00:00', 0, NULL, NULL),
(2, 'Article 1', 'article-1', '<img alt="" class="entry-image" src="/Project/webroot/upload/images/standart_post_1.jpg" /> ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n<p>\r\n	Maecenas pulvinar blandit facilisis. Curabitur mollis nisl non purus ultrices convallis. Ut volutpat tristique nisl elementum ultricies. Etiam vitae neque leo. Donec eget turpis lorem. Nulla facilisi. Duis bibendum diam sed ligula euismod a interdum ipsum semper. Curabitur id lectus pulvinar erat pretium aliquet. Ut felis enim, congue ac ullamcorper id, luctus congue neque. Praesent augue mauris, lacinia quis auctor nec, vestibulum suscipit ligula. Nunc elit nisl, mollis ut consequat a, sodales eu tortor. Aenean egestas, nisi a iaculis lacinia, mauris dui accumsan dui, vel scelerisque neque nibh sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n<blockquote>\r\n	Praesent bibendum lobortis lectus, quis dictum risus faucibus sagittis. Mauris a placerat lacus. Mauris rhoncus dolor sit amet nisl volutpat at consequat tortor feugiat. Ut ornare dui eu ipsum lobortis rhoncus.</blockquote>\r\n<p>\r\n	Quisque odio urna, ultrices non volutpat lacinia, scelerisque sit amet justo. Quisque venenatis sapien id eros pulvinar sit amet posuere lacus gravida. Aenean accumsan placerat nulla, dictum semper turpis scelerisque sit amet. Cras et quam lorem. Fusce rhoncus consequat nulla ut gravida. Sed adipiscing, lacus ac commodo scelerisque, est erat eleifend augue, nec viverra ligula lacus sed arcu. Suspendisse eu massa quis tellus dapibus dignissim suscipit eget est. Sed ullamcorper elit a arcu consequat in pellentesque odio volutpat. Donec dignissim porttitor consectetur. Donec risus mauris, aliquet ut ullamcorper eu, dignissim ut nulla. Pellentesque in magna eros, eget viverra nulla. In dui eros, porttitor a vehicula et, vulputate hendrerit urna. Mauris nec nibh turpis.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Curabitur id lectus pulvinar</li>\r\n	<li>\r\n		Ut felis enim, congue</li>\r\n	<li>\r\n		Praesent augue mauris</li>\r\n	<li>\r\n		Nunc elit nisl mollis</li>\r\n</ul>\r\n<p>\r\n	Etiam auctor tincidunt augue at pharetra. Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus scelerisque tincidunt. Maecenas accumsan imperdiet faucibus. Mauris tincidunt, nulla quis rhoncus malesuada, nibh ante pulvinar dolor, ut lacinia libero risus nec orci.</p>\r\n', 'Standard', '2013-02-12 00:00:00', 1, NULL, NULL),
(3, 'Article 2', 'article-2', '<img alt="" src="/Project/webroot/upload/images/gallery_post_img_2.jpg" /> <img alt="" src="/Project/webroot/upload/images/standart_post_1.jpg" style="width: 680px; height: 234px;" />', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.', '<p>\r\n	<span style="color: rgb(144, 144, 144); font-family: ''Lucida Sans Unicode'', ''Lucida Grande'', sans-serif; font-size: 11px; line-height: 18px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</span></p>\r\n<div>\r\n	<p style="border: 0px; font-size: 11px; margin: 0px 0px 20px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(144, 144, 144); font-family: ''Lucida Sans Unicode'', ''Lucida Grande'', sans-serif; line-height: 18px;">\r\n		Maecenas pulvinar blandit facilisis. Curabitur mollis nisl non purus ultrices convallis. Ut volutpat tristique nisl elementum ultricies. Etiam vitae neque leo. Donec eget turpis lorem. Nulla facilisi. Duis bibendum diam sed ligula euismod a interdum ipsum semper. Curabitur id lectus pulvinar erat pretium aliquet. Ut felis enim, congue ac ullamcorper id, luctus congue neque. Praesent augue mauris, lacinia quis auctor nec, vestibulum suscipit ligula. Nunc elit nisl, mollis ut consequat a, sodales eu tortor. Aenean egestas, nisi a iaculis lacinia, mauris dui accumsan dui, vel scelerisque neque nibh sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 'Gallery', NULL, 1, NULL, NULL),
(4, 'Article 3', 'article-3', '<video class="entry-video video-js vjs-default-skin" controls="" data-aspect-ratio="1.78" data-setup="{}" poster="http://demo.samuli.me/_media/smartstart-wp/taste-lab.jpg">\r\n	<source src="http://demo.samuli.me/_media/smartstart-wp/taste-lab.mp4video.mp4" type="video/mp4" /></video>\r\n', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n<p>\r\n	Maecenas pulvinar blandit facilisis. Curabitur mollis nisl non purus ultrices convallis. Ut volutpat tristique nisl elementum ultricies. Etiam vitae neque leo. Donec eget turpis lorem. Nulla facilisi. Duis bibendum diam sed ligula euismod a interdum ipsum semper. Curabitur id lectus pulvinar erat pretium aliquet. Ut felis enim, congue ac ullamcorper id, luctus congue neque. Praesent augue mauris, lacinia quis auctor nec, vestibulum suscipit ligula. Nunc elit nisl, mollis ut consequat a, sodales eu tortor. Aenean egestas, nisi a iaculis lacinia, mauris dui accumsan dui, vel scelerisque neque nibh sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n<blockquote>\r\n	Praesent bibendum lobortis lectus, quis dictum risus faucibus sagittis. Mauris a placerat lacus. Mauris rhoncus dolor sit amet nisl volutpat at consequat tortor feugiat. Ut ornare dui eu ipsum lobortis rhoncus.</blockquote>\r\n<p>\r\n	Quisque odio urna, ultrices non volutpat lacinia, scelerisque sit amet justo. Quisque venenatis sapien id eros pulvinar sit amet posuere lacus gravida. Aenean accumsan placerat nulla, dictum semper turpis scelerisque sit amet. Cras et quam lorem. Fusce rhoncus consequat nulla ut gravida. Sed adipiscing, lacus ac commodo scelerisque, est erat eleifend augue, nec viverra ligula lacus sed arcu. Suspendisse eu massa quis tellus dapibus dignissim suscipit eget est. Sed ullamcorper elit a arcu consequat in pellentesque odio volutpat. Donec dignissim porttitor consectetur. Donec risus mauris, aliquet ut ullamcorper eu, dignissim ut nulla. Pellentesque in magna eros, eget viverra nulla. In dui eros, porttitor a vehicula et, vulputate hendrerit urna. Mauris nec nibh turpis.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Curabitur id lectus pulvinar</li>\r\n	<li>\r\n		Ut felis enim, congue</li>\r\n	<li>\r\n		Praesent augue mauris</li>\r\n	<li>\r\n		Nunc elit nisl mollis</li>\r\n</ul>\r\n<p>\r\n	Etiam auctor tincidunt augue at pharetra. Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus scelerisque tincidunt. Maecenas accumsan imperdiet faucibus. Mauris tincidunt, nulla quis rhoncus malesuada, nibh ante pulvinar dolor, ut lacinia libero risus nec orci.</p>\r\n', 'Video', '2013-03-11 00:00:00', 1, NULL, NULL),
(5, 'post2', 'post2', '', '', '<p>\r\n	izoejfozienc</p>\r\n', '', '2013-03-11 00:00:00', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `online` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `slug`, `thumbnail`, `description`, `content`, `type`, `created`, `online`) VALUES
(1, 'projet 1', 'projet-1', '<img alt="" src="/Project/webroot/upload/images/miniatures/boombox-thumb-4th.jpg" style="width: 220px; height: 140px;" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<img alt="" src="/Project/webroot/upload/images/boombox-thumb-4th.jpg" style="width: 220px; height: 140px;" /> ', 'animation', '2013-04-26 14:02:52', 1),
(2, 'projet 2', 'projet-2', '<img alt="" src="/Project/webroot/upload/images/miniatures/altered-thumb-4th.jpg" style="width: 220px; height: 140px;" />', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus. ', '<img alt="" src="/Project/webroot/upload/images/altered-slider-1.jpg" style="width: 680px; height: 600px;" /> <img alt="" src="/Project/webroot/upload/images/altered-slider-2.jpg" style="width: 680px; height: 600px;" /> <img alt="" src="/Project/webroot/upload/images/altered-slider-3.jpg" style="width: 680px; height: 600px;" />', 'illustration', '2013-04-26 14:13:52', 1),
(3, 'projet 3', 'projet-3', '<img alt="" src="/Project/webroot/upload/images/miniatures/impossibleisnothing-thumb-4th.jpg" style="width: 220px; height: 140px;" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<img alt="" src="/Project/webroot/upload/images/full/impossibleisnothing-thumb-2nd.jpg" style="width: 460px; height: 292px;" />', 'design', '2013-04-30 09:56:41', 1),
(4, 'projet 4', 'projet-4', '<img alt="" src="/Project/webroot/upload/images/miniatures/nothingendures-thumb-4th.jpg" style="width: 220px; height: 140px;" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<img alt="" src="/Project/webroot/upload/images/full/nothingendures-thumb-2nd.jpg" style="width: 460px; height: 292px;" />', 'photography', '2013-05-04 13:07:00', 1),
(5, 'projet 5', 'projet-5', '<img alt="" src="/Project/webroot/upload/images/miniatures/nottheend-thumb-4th.jpg" style="width: 220px; height: 140px;" />', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<img alt="" src="/Project/webroot/upload/images/full/nottheend-thumb-2nd.jpg" style="width: 460px; height: 292px;" />', 'photography', '2013-05-04 13:08:34', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `order_by` int(11) DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `image`, `content`, `order_by`, `online`, `created`) VALUES
(1, 'slider1', '<article class="slide">\r\n<img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_1.jpg" />\r\n	<div class="slide-button">\r\n		<span class="dropcap">1</span>\r\n		<h5>\r\n			Responsive Layout</h5>\r\n		<span class="description">From desktop to mobile</span></div>\r\n	<div class="slide-content">\r\n		<h2>\r\n			Responsive Layout</h2>\r\n		<p>\r\n			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n		<p>\r\n			<a class="button" href="#">Read More</a></p>\r\n	</div>\r\n</article>\r\n', '<p>\r\n	test</p>\r\n', NULL, 1, '2013-04-26 11:38:39'),
(2, 'slider2', '<article class="slide">\r\n	<img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_2.jpg" />\r\n	<div class="slide-button">\r\n		<span class="dropcap">2</span>\r\n		<h5>\r\n			Responsive Layout</h5>\r\n		<span class="description">From desktop to mobile</span></div>\r\n	<div class="slide-content">\r\n		<h2>\r\n			Responsive Layout</h2>\r\n		<p>\r\n			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n		<p>\r\n			<a class="button" href="#">Read More</a></p>\r\n	</div>\r\n</article>\r\n', '<p>\r\n	test2</p>\r\n', NULL, 1, '2013-04-26 12:23:15'),
(3, 'slider3', '<article class="slide">\r\n	<img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_1.jpg" />\r\n	<div class="slide-button">\r\n		<span class="dropcap">3</span>\r\n		<h5>\r\n			Responsive Layout</h5>\r\n		<span class="description">From desktop to mobile</span></div>\r\n	<div class="slide-content">\r\n		<h2>\r\n			Responsive Layout</h2>\r\n		<p>\r\n			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n		<p>\r\n			<a class="button" href="#">Read More</a></p>\r\n	</div>\r\n</article>\r\n', '<p>\r\n	test3</p>\r\n', NULL, 1, '2013-04-26 12:58:08'),
(4, 'slider4', '<article class="slide">\r\n	<img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_3.jpg" style="width: 940px; height: 380px;" />\r\n	<div class="slide-button">\r\n		<span class="dropcap">4</span>\r\n		<h5>\r\n			Responsive Layout</h5>\r\n		<span class="description">From desktop to mobile</span></div>\r\n	<div class="slide-content">\r\n		<h2>\r\n			Responsive Layout</h2>\r\n		<p>\r\n			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n		<p>\r\n			<a class="button" href="#">Read More</a></p>\r\n	</div>\r\n</article>\r\n', '<p>\r\n	test4</p>\r\n', NULL, 1, '2013-04-26 12:59:54'),
(5, 'slider5', '<article class="slide">\r\n	<img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_1.jpg" />\r\n	<div class="slide-button">\r\n		<span class="dropcap">5</span>\r\n		<h5>\r\n			Responsive Layout</h5>\r\n		<span class="description">From desktop to mobile</span></div>\r\n	<div class="slide-content">\r\n		<h2>\r\n			Responsive Layout</h2>\r\n		<p>\r\n			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n		<p>\r\n			<a class="button" href="#">Read More</a></p>\r\n	</div>\r\n</article>\r\n', '<p>\r\n	test5</p>\r\n', NULL, 0, '2013-04-26 13:06:54');

-- --------------------------------------------------------

--
-- Structure de la table `typeposts`
--

CREATE TABLE IF NOT EXISTS `typeposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `typeposts`
--

INSERT INTO `typeposts` (`id`, `name`, `online`) VALUES
(1, 'Standard', 1),
(2, 'Gallery', 1),
(3, 'Video', 1),
(4, 'Audio', 1),
(5, 'Link', 1),
(6, 'Quote', 1),
(7, 'Aside', 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeprojects`
--

CREATE TABLE IF NOT EXISTS `typeprojects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `typeprojects`
--

INSERT INTO `typeprojects` (`id`, `name`, `online`) VALUES
(1, 'animation', 1),
(2, 'illustration', 1),
(3, 'design', 1),
(4, 'photography', 1),
(5, 'web', 1);

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
