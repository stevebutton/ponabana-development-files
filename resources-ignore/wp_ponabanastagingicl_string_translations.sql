-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: internal-db.s14582.gridserver.com
-- Generation Time: Feb 19, 2014 at 08:06 AM
-- Server version: 5.1.72-rel14.10
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db14582_ponabanastaging`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_ponabanastagingicl_string_translations`
--

CREATE TABLE IF NOT EXISTS `wp_ponabanastagingicl_string_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `string_id` bigint(20) unsigned NOT NULL,
  `language` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `value` text,
  `translator_id` bigint(20) unsigned DEFAULT NULL,
  `translation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `string_language` (`string_id`,`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `wp_ponabanastagingicl_string_translations`
--

INSERT INTO `wp_ponabanastagingicl_string_translations` (`id`, `string_id`, `language`, `status`, `value`, `translator_id`, `translation_date`) VALUES
(1, 136, 'fr', 0, 'Voter', NULL, '2014-02-19 11:27:25'),
(2, 5, 'fr', 1, 'récents commentaires', NULL, '2014-02-19 19:34:48'),
(3, 7, 'fr', 1, 'Catégories', NULL, '2014-02-19 19:36:29'),
(4, 10, 'fr', 1, 'Calendrier', NULL, '2014-02-19 11:36:43'),
(5, 4, 'fr', 1, 'Les messages récents', NULL, '2014-02-19 11:37:20'),
(6, 113, 'fr', 1, 'Question Catégorie', NULL, '2014-02-19 11:43:53'),
(7, 112, 'fr', 1, 'Sélectionnez une catégorie de question', NULL, '2014-02-19 11:44:15'),
(8, 115, 'fr', 1, 'Votre question', NULL, '2014-02-19 11:45:17'),
(9, 117, 'fr', 1, 'Détails concernant la question', NULL, '2014-02-19 11:46:02'),
(10, 118, 'fr', 1, 'Diffusez cette question comme privé.', NULL, '2014-02-19 11:47:19'),
(11, 120, 'fr', 1, 'Poser une question', NULL, '2014-02-19 11:48:02'),
(12, 202, 'fr', 1, 'Poser une question page', NULL, '2014-02-19 11:48:26'),
(13, 56, 'fr', 1, 'S''il vous plaît, entrez votre question', NULL, '2014-02-19 11:49:38'),
(14, 125, 'fr', 1, 'Besoin de réponse', NULL, '2014-02-19 11:51:01'),
(15, 132, 'fr', 1, 'Répondu', NULL, '2014-02-19 11:51:41'),
(16, 81, 'fr', 1, 'répondu', NULL, '2014-02-19 11:51:47'),
(17, 89, 'fr', 1, 'Résolu', NULL, '2014-02-19 11:52:28'),
(18, 91, 'fr', 1, 'Fermé', NULL, '2014-02-19 11:53:12'),
(19, 124, 'fr', 1, 'Les commentaires sont fermés.', NULL, '2014-02-19 11:53:30'),
(20, 177, 'fr', 1, 'Cette question a été fermé', NULL, '2014-02-19 11:53:52'),
(21, 133, 'fr', 1, 'En retard', NULL, '2014-02-19 11:54:44'),
(22, 205, 'fr', 1, 'Question en souffrance - Time Frame', NULL, '2014-02-19 11:55:06'),
(23, 222, 'fr', 1, 'Une question sera marqué comme étant en souffrance si passe cette période de temps, à partir de la date à laquelle la question a été soumise', NULL, '2014-02-19 11:55:25'),
(24, 134, 'fr', 1, 'File', NULL, '2014-02-19 11:55:55'),
(25, 127, 'fr', 1, 'Tous', NULL, '2014-02-19 11:56:41'),
(26, 130, 'fr', 1, 'Poser une question', NULL, '2014-02-19 11:57:45'),
(27, 126, 'fr', 1, 'Sélectionnez une catégorie', NULL, '2014-02-19 11:58:30'),
(28, 109, 'fr', 1, 'voir', NULL, '2014-02-19 20:00:04'),
(29, 29, 'fr', 1, 'Voir la réponse', NULL, '2014-02-19 12:00:11'),
(30, 20, 'fr', 1, 'Voir la question', NULL, '2014-02-19 12:00:27'),
(31, 83, 'fr', 1, 'vues', NULL, '2014-02-19 12:00:43'),
(32, 135, 'fr', 1, 'Voir', NULL, '2014-02-19 12:00:54'),
(33, 144, 'fr', 1, 'Vues', NULL, '2014-02-19 12:01:05'),
(34, 148, 'fr', 1, 'Vue d''ensemble', NULL, '2014-02-19 12:01:33'),
(35, 110, 'fr', 1, 'réponse', NULL, '2014-02-19 12:02:46'),
(36, 33, 'fr', 1, 'Réponse', NULL, '2014-02-19 20:03:24'),
(37, 137, 'fr', 1, 'Désolé, mais rien ne correspond à votre filtre.', NULL, '2014-02-19 12:05:25'),
(38, 95, 'fr', 1, 'Désolé, mais rien ne correspond à votre filtre.', NULL, '2014-02-19 12:05:32'),
(39, 131, 'fr', 1, 'statut:', NULL, '2014-02-19 12:07:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
