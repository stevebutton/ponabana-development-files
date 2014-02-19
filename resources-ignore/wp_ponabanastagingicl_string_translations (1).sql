-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2014 at 05:40 PM
-- Server version: 5.1.44
-- PHP Version: 5.4.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db14582_ponabana`
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

UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 1,`string_id` = 136,`language` = 'fr',`status` = 0,`value` = 'Voter',`translator_id` = NULL,`translation_date` = '2014-02-19 11:27:25' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 1;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 2,`string_id` = 5,`language` = 'fr',`status` = 1,`value` = 'récents commentaires',`translator_id` = NULL,`translation_date` = '2014-02-19 19:34:48' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 2;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 3,`string_id` = 7,`language` = 'fr',`status` = 1,`value` = 'Catégories',`translator_id` = NULL,`translation_date` = '2014-02-19 19:36:29' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 3;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 4,`string_id` = 10,`language` = 'fr',`status` = 1,`value` = 'Calendrier',`translator_id` = NULL,`translation_date` = '2014-02-19 11:36:43' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 4;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 5,`string_id` = 4,`language` = 'fr',`status` = 1,`value` = 'Les messages récents',`translator_id` = NULL,`translation_date` = '2014-02-19 11:37:20' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 5;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 6,`string_id` = 113,`language` = 'fr',`status` = 1,`value` = 'Question Catégorie',`translator_id` = NULL,`translation_date` = '2014-02-19 11:43:53' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 6;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 7,`string_id` = 112,`language` = 'fr',`status` = 1,`value` = 'Sélectionnez une catégorie de question',`translator_id` = NULL,`translation_date` = '2014-02-19 11:44:15' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 7;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 8,`string_id` = 115,`language` = 'fr',`status` = 1,`value` = 'Votre question',`translator_id` = NULL,`translation_date` = '2014-02-19 11:45:17' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 8;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 9,`string_id` = 117,`language` = 'fr',`status` = 1,`value` = 'Détails concernant la question',`translator_id` = NULL,`translation_date` = '2014-02-19 11:46:02' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 9;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 10,`string_id` = 118,`language` = 'fr',`status` = 1,`value` = 'Diffusez cette question comme privé.',`translator_id` = NULL,`translation_date` = '2014-02-19 11:47:19' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 10;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 11,`string_id` = 120,`language` = 'fr',`status` = 1,`value` = 'Poser une question',`translator_id` = NULL,`translation_date` = '2014-02-19 11:48:02' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 11;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 12,`string_id` = 202,`language` = 'fr',`status` = 1,`value` = 'Poser une question page',`translator_id` = NULL,`translation_date` = '2014-02-19 11:48:26' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 12;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 13,`string_id` = 56,`language` = 'fr',`status` = 1,`value` = 'S''il vous plaît, entrez votre question',`translator_id` = NULL,`translation_date` = '2014-02-19 11:49:38' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 13;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 14,`string_id` = 125,`language` = 'fr',`status` = 1,`value` = 'Besoin de réponse',`translator_id` = NULL,`translation_date` = '2014-02-19 11:51:01' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 14;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 15,`string_id` = 132,`language` = 'fr',`status` = 1,`value` = 'Répondu',`translator_id` = NULL,`translation_date` = '2014-02-19 11:51:41' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 15;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 16,`string_id` = 81,`language` = 'fr',`status` = 1,`value` = 'répondu',`translator_id` = NULL,`translation_date` = '2014-02-19 11:51:47' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 16;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 17,`string_id` = 89,`language` = 'fr',`status` = 1,`value` = 'Résolu',`translator_id` = NULL,`translation_date` = '2014-02-19 11:52:28' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 17;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 18,`string_id` = 91,`language` = 'fr',`status` = 1,`value` = 'Fermé',`translator_id` = NULL,`translation_date` = '2014-02-19 11:53:12' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 18;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 19,`string_id` = 124,`language` = 'fr',`status` = 1,`value` = 'Les commentaires sont fermés.',`translator_id` = NULL,`translation_date` = '2014-02-19 11:53:30' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 19;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 20,`string_id` = 177,`language` = 'fr',`status` = 1,`value` = 'Cette question a été fermé',`translator_id` = NULL,`translation_date` = '2014-02-19 11:53:52' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 20;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 21,`string_id` = 133,`language` = 'fr',`status` = 1,`value` = 'En retard',`translator_id` = NULL,`translation_date` = '2014-02-19 11:54:44' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 21;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 22,`string_id` = 205,`language` = 'fr',`status` = 1,`value` = 'Question en souffrance - Time Frame',`translator_id` = NULL,`translation_date` = '2014-02-19 11:55:06' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 22;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 23,`string_id` = 222,`language` = 'fr',`status` = 1,`value` = 'Une question sera marqué comme étant en souffrance si passe cette période de temps, à partir de la date à laquelle la question a été soumise',`translator_id` = NULL,`translation_date` = '2014-02-19 11:55:25' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 23;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 24,`string_id` = 134,`language` = 'fr',`status` = 1,`value` = 'File',`translator_id` = NULL,`translation_date` = '2014-02-19 11:55:55' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 24;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 25,`string_id` = 127,`language` = 'fr',`status` = 1,`value` = 'Tous',`translator_id` = NULL,`translation_date` = '2014-02-19 11:56:41' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 25;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 26,`string_id` = 130,`language` = 'fr',`status` = 1,`value` = 'Poser une question',`translator_id` = NULL,`translation_date` = '2014-02-19 11:57:45' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 26;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 27,`string_id` = 126,`language` = 'fr',`status` = 1,`value` = 'Sélectionnez une catégorie',`translator_id` = NULL,`translation_date` = '2014-02-19 11:58:30' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 27;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 28,`string_id` = 109,`language` = 'fr',`status` = 1,`value` = 'voir',`translator_id` = NULL,`translation_date` = '2014-02-19 20:00:04' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 28;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 29,`string_id` = 29,`language` = 'fr',`status` = 1,`value` = 'Voir la réponse',`translator_id` = NULL,`translation_date` = '2014-02-19 12:00:11' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 29;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 30,`string_id` = 20,`language` = 'fr',`status` = 1,`value` = 'Voir la question',`translator_id` = NULL,`translation_date` = '2014-02-19 12:00:27' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 30;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 31,`string_id` = 83,`language` = 'fr',`status` = 1,`value` = 'vues',`translator_id` = NULL,`translation_date` = '2014-02-19 12:00:43' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 31;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 32,`string_id` = 135,`language` = 'fr',`status` = 1,`value` = 'Voir',`translator_id` = NULL,`translation_date` = '2014-02-19 12:00:54' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 32;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 33,`string_id` = 144,`language` = 'fr',`status` = 1,`value` = 'Vues',`translator_id` = NULL,`translation_date` = '2014-02-19 12:01:05' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 33;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 34,`string_id` = 148,`language` = 'fr',`status` = 1,`value` = 'Vue d''ensemble',`translator_id` = NULL,`translation_date` = '2014-02-19 12:01:33' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 34;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 35,`string_id` = 110,`language` = 'fr',`status` = 1,`value` = 'réponse',`translator_id` = NULL,`translation_date` = '2014-02-19 12:02:46' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 35;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 36,`string_id` = 33,`language` = 'fr',`status` = 1,`value` = 'Réponse',`translator_id` = NULL,`translation_date` = '2014-02-19 20:03:24' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 36;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 37,`string_id` = 137,`language` = 'fr',`status` = 1,`value` = 'Désolé, mais rien ne correspond à votre filtre.',`translator_id` = NULL,`translation_date` = '2014-02-19 12:05:25' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 37;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 38,`string_id` = 95,`language` = 'fr',`status` = 1,`value` = 'Désolé, mais rien ne correspond à votre filtre.',`translator_id` = NULL,`translation_date` = '2014-02-19 12:05:32' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 38;
UPDATE `wp_ponabanastagingicl_string_translations` SET `id` = 39,`string_id` = 131,`language` = 'fr',`status` = 1,`value` = 'statut:',`translator_id` = NULL,`translation_date` = '2014-02-19 12:07:54' WHERE `wp_ponabanastagingicl_string_translations`.`id` = 39;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
