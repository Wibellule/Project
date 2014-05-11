-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 11 Mai 2014 à 21:28
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `wibellule`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
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
  `redirection_category_id` int(11) NOT NULL,
  `display_option` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `postscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `type`, `content`, `created`, `online`, `lft`, `rgt`, `level`, `parent_id`, `redirection_category_id`, `display_option`, `user_id`, `postscol`) VALUES
(1, 'racine', 'racine-1', 3, 'racine', '2013-05-10 11:29:51', 1, 1, 10, 0, 0, 0, 0, NULL, NULL),
(38, 'Blog', 'blog', 1, '<br />\r\n', '2013-05-26 13:40:06', 1, 4, 5, 1, 1, -2, 0, NULL, NULL),
(37, 'Accueil', 'accueil', 1, 'accueil', '2013-06-19 14:44:41', 1, 2, 3, 1, 1, -1, 0, NULL, NULL),
(39, 'Portefolio', 'portefolio', 1, '<br />\r\n', '2013-05-28 11:58:04', 1, 6, 7, 1, 1, -3, 0, NULL, NULL),
(42, 'Contact', 'contact', 1, '', '2013-06-03 07:26:18', 1, 8, 9, 1, 1, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `online` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `postscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `mails`
--

INSERT INTO `mails` (`id`, `name`, `subject`, `email`, `content`, `created`, `online`, `user_id`, `postscol`) VALUES
(1, 'gyome', 'Promotion pour votre prochaine commande', 'gyome34@hotmail.com', 'test', '2013-06-14 12:35:42', 1, NULL, NULL),
(2, 'gyome', 'Test', 'gyome34@hotmail.com', 'Essai Design', '2013-06-14 14:47:52', 1, NULL, NULL),
(3, 'gyome', 'Essai', 'gyome34@hotmail.com', 'Essai du design', '2013-06-14 14:48:25', 1, NULL, NULL),
(4, 'gyome', 'test', 'gyome34@hotmail.com', 'test', '2013-06-24 09:45:25', 1, NULL, NULL),
(5, 'gyome', 'test', 'gyome34@hotmail.com', 'test', '2014-05-06 13:22:15', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `controller_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_in_menu` int(11) NOT NULL,
  `order_by` int(11) NOT NULL,
  `online` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modules_type_id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `modules`
--

INSERT INTO `modules` (`id`, `name`, `controller_name`, `action_name`, `display_in_menu`, `order_by`, `online`, `created`, `modules_type_id`, `plugin_id`) VALUES
(1, 'Catégories', 'categories', '', 0, 3, 1, '2012-11-29 22:58:29', 2, 0),
(2, 'Sliders', 'sliders', '', 0, 4, 1, '2012-11-29 22:58:46', 2, 0),
(5, 'Articles', 'posts', '', 0, 8, 1, '2012-11-29 23:00:13', 4, 0),
(6, 'Types d''article', 'typeposts', '', 0, 9, 1, '2012-11-29 23:00:35', 4, 0),
(7, 'Commentaires articles', 'postcomments', '', 0, 10, 1, '2012-11-29 23:01:11', 4, 0),
(9, 'Sites Internet', 'websites', '', 0, 0, 1, '2012-11-30 09:27:12', 5, 0),
(10, 'Liste des utilisateurs', 'users', '', 0, 1, 1, '2012-11-30 09:27:32', 5, 0),
(11, 'Plugins', 'plugins', '', 0, 2, 1, '2012-11-30 09:27:47', 5, 0),
(12, 'Projets', 'projects', '', 0, 5, 1, '2014-05-06 00:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `modulestypes`
--

CREATE TABLE `modulestypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_by` int(11) NOT NULL,
  `online` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `modulestypes`
--

INSERT INTO `modulestypes` (`id`, `name`, `order_by`, `online`, `created`, `modified`, `modified_by`) VALUES
(7, 'Tableau de bord', 0, 1, '2012-12-01 06:39:27', '2012-12-01 06:39:27', 1),
(2, 'Contenus', 1, 1, '2012-12-01 06:38:44', '2012-12-01 06:38:44', 1),
(4, 'Actualités / Blog', 2, 1, '2012-12-01 06:39:16', '2012-12-01 06:39:16', 1),
(6, 'Plugins', 3, 1, '2012-12-03 22:39:48', '2012-12-03 22:39:48', 1),
(5, 'Paramètres', 4, 1, '2012-12-01 06:39:27', '2012-12-01 06:39:27', 1);

-- --------------------------------------------------------

--
-- Structure de la table `plugins`
--

CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` int(11) NOT NULL,
  `installed` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
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
  `display_option` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `name`, `slug`, `image`, `short_content`, `content`, `tag`, `created`, `online`, `user_id`, `postscol`, `display_option`) VALUES
(1, 'Comment ça marche ?', 'comment-ca-marche', '', '', '<p>\r\n  Voici comment &ccedil;a marche</p>\r\n', '', '2013-02-12 00:00:00', 0, NULL, NULL, 0),
(2, 'Article 1', 'article-1', '<img alt="" class="entry-image" src="/Project/webroot/upload/images/standart_post_1.jpg" /> ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.', '<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n<p>\r\n  Maecenas pulvinar blandit facilisis. Curabitur mollis nisl non purus ultrices convallis. Ut volutpat tristique nisl elementum ultricies. Etiam vitae neque leo. Donec eget turpis lorem. Nulla facilisi. Duis bibendum diam sed ligula euismod a interdum ipsum semper. Curabitur id lectus pulvinar erat pretium aliquet. Ut felis enim, congue ac ullamcorper id, luctus congue neque. Praesent augue mauris, lacinia quis auctor nec, vestibulum suscipit ligula. Nunc elit nisl, mollis ut consequat a, sodales eu tortor. Aenean egestas, nisi a iaculis lacinia, mauris dui accumsan dui, vel scelerisque neque nibh sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n<blockquote>\r\n Praesent bibendum lobortis lectus, quis dictum risus faucibus sagittis. Mauris a placerat lacus. Mauris rhoncus dolor sit amet nisl volutpat at consequat tortor feugiat. Ut ornare dui eu ipsum lobortis rhoncus.</blockquote>\r\n<p>\r\n  Quisque odio urna, ultrices non volutpat lacinia, scelerisque sit amet justo. Quisque venenatis sapien id eros pulvinar sit amet posuere lacus gravida. Aenean accumsan placerat nulla, dictum semper turpis scelerisque sit amet. Cras et quam lorem. Fusce rhoncus consequat nulla ut gravida. Sed adipiscing, lacus ac commodo scelerisque, est erat eleifend augue, nec viverra ligula lacus sed arcu. Suspendisse eu massa quis tellus dapibus dignissim suscipit eget est. Sed ullamcorper elit a arcu consequat in pellentesque odio volutpat. Donec dignissim porttitor consectetur. Donec risus mauris, aliquet ut ullamcorper eu, dignissim ut nulla. Pellentesque in magna eros, eget viverra nulla. In dui eros, porttitor a vehicula et, vulputate hendrerit urna. Mauris nec nibh turpis.</p>\r\n<p>\r\n  &nbsp;</p>\r\n<ul>\r\n  <li>\r\n    Curabitur id lectus pulvinar</li>\r\n <li>\r\n    Ut felis enim, congue</li>\r\n  <li>\r\n    Praesent augue mauris</li>\r\n  <li>\r\n    Nunc elit nisl mollis</li>\r\n</ul>\r\n<p>\r\n  Etiam auctor tincidunt augue at pharetra. Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus scelerisque tincidunt. Maecenas accumsan imperdiet faucibus. Mauris tincidunt, nulla quis rhoncus malesuada, nibh ante pulvinar dolor, ut lacinia libero risus nec orci.</p>\r\n', 'Standard', '2013-02-12 00:00:00', 1, NULL, NULL, 0),
(3, 'Article 2', 'article-2', '<img alt="" src="/Project/webroot/upload/images/gallery_post_img_2.jpg" /> <img alt="" src="/Project/webroot/upload/images/standart_post_1.jpg" style="width: 680px; height: 234px;" />', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.', '<p>\r\n  <span style="color: rgb(144, 144, 144); font-family: ''Lucida Sans Unicode'', ''Lucida Grande'', sans-serif; font-size: 11px; line-height: 18px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</span></p>\r\n<div>\r\n <p style="border: 0px; font-size: 11px; margin: 0px 0px 20px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(144, 144, 144); font-family: ''Lucida Sans Unicode'', ''Lucida Grande'', sans-serif; line-height: 18px;">\r\n    Maecenas pulvinar blandit facilisis. Curabitur mollis nisl non purus ultrices convallis. Ut volutpat tristique nisl elementum ultricies. Etiam vitae neque leo. Donec eget turpis lorem. Nulla facilisi. Duis bibendum diam sed ligula euismod a interdum ipsum semper. Curabitur id lectus pulvinar erat pretium aliquet. Ut felis enim, congue ac ullamcorper id, luctus congue neque. Praesent augue mauris, lacinia quis auctor nec, vestibulum suscipit ligula. Nunc elit nisl, mollis ut consequat a, sodales eu tortor. Aenean egestas, nisi a iaculis lacinia, mauris dui accumsan dui, vel scelerisque neque nibh sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n</div>\r\n<p>\r\n  &nbsp;</p>\r\n<p>\r\n &nbsp;</p>\r\n', 'Gallery', NULL, 1, NULL, NULL, 0),
(4, 'Article 3', 'article-3', '<video class="entry-video video-js vjs-default-skin" controls="" data-aspect-ratio="1.78" data-setup="{}" poster="http://demo.samuli.me/_media/smartstart-wp/taste-lab.jpg">\r\n <source src="http://demo.samuli.me/_media/smartstart-wp/taste-lab.mp4video.mp4" type="video/mp4" /></video>\r\n', '<p>\r\n  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<p>\r\n  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n<p>\r\n  Maecenas pulvinar blandit facilisis. Curabitur mollis nisl non purus ultrices convallis. Ut volutpat tristique nisl elementum ultricies. Etiam vitae neque leo. Donec eget turpis lorem. Nulla facilisi. Duis bibendum diam sed ligula euismod a interdum ipsum semper. Curabitur id lectus pulvinar erat pretium aliquet. Ut felis enim, congue ac ullamcorper id, luctus congue neque. Praesent augue mauris, lacinia quis auctor nec, vestibulum suscipit ligula. Nunc elit nisl, mollis ut consequat a, sodales eu tortor. Aenean egestas, nisi a iaculis lacinia, mauris dui accumsan dui, vel scelerisque neque nibh sed nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n<blockquote>\r\n Praesent bibendum lobortis lectus, quis dictum risus faucibus sagittis. Mauris a placerat lacus. Mauris rhoncus dolor sit amet nisl volutpat at consequat tortor feugiat. Ut ornare dui eu ipsum lobortis rhoncus.</blockquote>\r\n<p>\r\n  Quisque odio urna, ultrices non volutpat lacinia, scelerisque sit amet justo. Quisque venenatis sapien id eros pulvinar sit amet posuere lacus gravida. Aenean accumsan placerat nulla, dictum semper turpis scelerisque sit amet. Cras et quam lorem. Fusce rhoncus consequat nulla ut gravida. Sed adipiscing, lacus ac commodo scelerisque, est erat eleifend augue, nec viverra ligula lacus sed arcu. Suspendisse eu massa quis tellus dapibus dignissim suscipit eget est. Sed ullamcorper elit a arcu consequat in pellentesque odio volutpat. Donec dignissim porttitor consectetur. Donec risus mauris, aliquet ut ullamcorper eu, dignissim ut nulla. Pellentesque in magna eros, eget viverra nulla. In dui eros, porttitor a vehicula et, vulputate hendrerit urna. Mauris nec nibh turpis.</p>\r\n<p>\r\n  &nbsp;</p>\r\n<ul>\r\n  <li>\r\n    Curabitur id lectus pulvinar</li>\r\n <li>\r\n    Ut felis enim, congue</li>\r\n  <li>\r\n    Praesent augue mauris</li>\r\n  <li>\r\n    Nunc elit nisl mollis</li>\r\n</ul>\r\n<p>\r\n  Etiam auctor tincidunt augue at pharetra. Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus scelerisque tincidunt. Maecenas accumsan imperdiet faucibus. Mauris tincidunt, nulla quis rhoncus malesuada, nibh ante pulvinar dolor, ut lacinia libero risus nec orci.</p>\r\n', 'Video', '2013-03-11 00:00:00', 1, NULL, NULL, 0),
(5, 'post2', 'post2', '', '', '<p>\r\n  izoejfozienc</p>\r\n', '', '2013-03-11 00:00:00', 0, NULL, NULL, 0),
(6, 'article 2014', 'article-2014', '', 'test', 'test', 'Standard', '2014-05-06 13:13:13', 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `postscomments`
--

CREATE TABLE `postscomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message_backoffice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
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
(1, 'projet 1', 'projet-1', '<img alt="" src="/Project/webroot/upload/images/miniatures/boombox-thumb-4th.jpg" style="width: 220px; height: 140px;" />', '<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<img alt="" src="/Project/webroot/upload/images/boombox-thumb-4th.jpg" style="width: 220px; height: 140px;" /> ', 'animation', '2013-04-26 14:02:52', 1),
(2, 'projet 2', 'projet-2', '<img alt="" src="/Project/webroot/upload/images/miniatures/altered-thumb-4th.jpg" style="width: 220px; height: 140px;" />', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus. ', '<img alt="" src="/Project/webroot/upload/images/altered-slider-1.jpg" style="width: 680px; height: 600px;" /> <img alt="" src="/Project/webroot/upload/images/altered-slider-2.jpg" style="width: 680px; height: 600px;" /> <img alt="" src="/Project/webroot/upload/images/altered-slider-3.jpg" style="width: 680px; height: 600px;" />', 'illustration', '2013-04-26 14:13:52', 1),
(3, 'projet 3', 'projet-3', '<img alt="" src="/Project/webroot/upload/images/miniatures/impossibleisnothing-thumb-4th.jpg" style="width: 220px; height: 140px;" />', '<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<img alt="" src="/Project/webroot/upload/images/full/impossibleisnothing-thumb-2nd.jpg" style="width: 460px; height: 292px;" />', 'design', '2013-04-30 09:56:41', 1),
(4, 'projet 4', 'projet-4', '<img alt="" src="/Project/webroot/upload/images/miniatures/nothingendures-thumb-4th.jpg" style="width: 220px; height: 140px;" />', '<p>\r\n  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<img alt="" src="/Project/webroot/upload/images/full/nothingendures-thumb-2nd.jpg" style="width: 460px; height: 292px;" />', 'photography', '2013-05-04 13:07:00', 1),
(5, 'projet 5', 'projet-5', '<img alt="" src="/Project/webroot/upload/images/miniatures/nottheend-thumb-4th.jpg" style="width: 220px; height: 140px;" />', '<p>\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim enim, pharetra in sodales at, interdum sit amet dui. Nullam vulputate euismod urna non pharetra. Phasellus blandit mattis ipsum, ac laoreet lorem lacinia et. Cras et ligula libero. Quisque quis magna vitae ipsum consequat varius in ut ante. Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada. In nulla nibh, congue sed molestie nec, dapibus sed purus.</p>\r\n', '<img alt="" src="/Project/webroot/upload/images/full/nottheend-thumb-2nd.jpg" style="width: 460px; height: 292px;" />', 'photography', '2013-05-04 13:08:34', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sliders`
--

CREATE TABLE `sliders` (
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
(1, 'slider1', '<article class="slide">\r\n<img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_1.jpg" />\r\n  <div class="slide-button">\r\n    <span class="dropcap">1</span>\r\n    <h5>\r\n      Responsive Layout</h5>\r\n    <span class="description">From desktop to mobile</span></div>\r\n <div class="slide-content">\r\n   <h2>\r\n      Responsive Layout</h2>\r\n    <p>\r\n     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n   <p>\r\n     <a class="button" href="#">Read More</a></p>\r\n  </div>\r\n</article>\r\n', '<p>\r\n test</p>\r\n', NULL, 1, '2013-04-26 11:38:39'),
(2, 'slider2', '<article class="slide">\r\n <img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_2.jpg" />\r\n <div class="slide-button">\r\n    <span class="dropcap">2</span>\r\n    <h5>\r\n      Responsive Layout</h5>\r\n    <span class="description">From desktop to mobile</span></div>\r\n <div class="slide-content">\r\n   <h2>\r\n      Responsive Layout</h2>\r\n    <p>\r\n     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n   <p>\r\n     <a class="button" href="#">Read More</a></p>\r\n  </div>\r\n</article>\r\n', '<p>\r\n test2</p>\r\n', NULL, 1, '2013-04-26 12:23:15'),
(3, 'slider3', '<article class="slide">\r\n <img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_1.jpg" />\r\n <div class="slide-button">\r\n    <span class="dropcap">3</span>\r\n    <h5>\r\n      Responsive Layout</h5>\r\n    <span class="description">From desktop to mobile</span></div>\r\n <div class="slide-content">\r\n   <h2>\r\n      Responsive Layout</h2>\r\n    <p>\r\n     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n   <p>\r\n     <a class="button" href="#">Read More</a></p>\r\n  </div>\r\n</article>\r\n', '<p>\r\n test3</p>\r\n', NULL, 1, '2013-04-26 12:58:08'),
(4, 'slider4', '<article class="slide">\r\n <img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_3.jpg" style="width: 940px; height: 380px;" />\r\n  <div class="slide-button">\r\n    <span class="dropcap">4</span>\r\n    <h5>\r\n      Responsive Layout</h5>\r\n    <span class="description">From desktop to mobile</span></div>\r\n <div class="slide-content">\r\n   <h2>\r\n      Responsive Layout</h2>\r\n    <p>\r\n     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n   <p>\r\n     <a class="button" href="#">Read More</a></p>\r\n  </div>\r\n</article>\r\n', '<p>\r\n test4</p>\r\n', NULL, 1, '2013-04-26 12:59:54'),
(5, 'slider5', '<article class="slide">\r\n <img alt="" class="slide-bg-image" src="/Project/webroot/upload/images/features_img_1.jpg" />\r\n <div class="slide-button">\r\n    <span class="dropcap">5</span>\r\n    <h5>\r\n      Responsive Layout</h5>\r\n    <span class="description">From desktop to mobile</span></div>\r\n <div class="slide-content">\r\n   <h2>\r\n      Responsive Layout</h2>\r\n    <p>\r\n     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec purus justo.</p>\r\n   <p>\r\n     <a class="button" href="#">Read More</a></p>\r\n  </div>\r\n</article>\r\n', '<p>\r\n test5</p>\r\n', NULL, 0, '2013-04-26 13:06:54');

-- --------------------------------------------------------

--
-- Structure de la table `typeposts`
--

CREATE TABLE `typeposts` (
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

CREATE TABLE `typeprojects` (
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

CREATE TABLE `users` (
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

-- --------------------------------------------------------

--
-- Structure de la table `websites`
--

CREATE TABLE `websites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
