README.txt
door 4032322 en 3956865

Geliefde Jury,

Hier ons derde practicum voor webtechnologie. Allereerst meteen onze excuses; het is namelijk niet af. De reden is duidelijk: we zijn te laat begonnen. De opdracht was transparant en goed uit te voeren, maar niet in de tijd die wij er voor genomen hebben helaas. Desondanks willen wij toch ons resultaat aanbieden, waar we hebben geprobeerd wat features in te stoppen waar op beoordeeld kan worden. Er kan bij ons geregistreerd worden, er kan worden ingelogd, , ingelogde mensen kunnen hun profielen aanpassen en opslaan, er is een persoonlijkheids test (er helaas een bug in die er voor zorgt dat er meer dan eens een verpeste persoonlijkheids string uit komt…) en er word onderscheid gemaakt tussen lurkers en leden wat betreft het browsen van de site. Graag wil ik u waarschuwen voor de eventuele vunzige manier waarop wij her en der comments hebben geplaatst. Ik heb geprobeerd te filteren maar het kan goed zijn dat er her en der een wat minder nette opmerking tussen staat. Tevens betreuren wij het design van de website. Zoals gezegd hebben we getracht zoveel mogelijk features er in te knallen en aan styling zijn we helaas nagenoeg niet toegekomen. 
Wij hopen dat het een en ander te regelen valt met een eventuele herkansing.

Sterkte met nakijken en een vriendelijke groet,
Siemen Kraayenbrink
Victor Veldstra

======
SQL: het script gaat er van uit dat er een database genaamd 'date' is!!!
======
-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 13, 2014 at 11:33 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `date`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Coca Cola'),
(2, 'Jack Daniels'),
(3, 'Blizzard Entertainment'),
(4, 'C&A'),
(5, 'Blokker'),
(6, 'Zeeman'),
(7, 'Albert Hein'),
(8, 'Etos'),
(9, 'Valve'),
(10, 'Volvo'),
(11, 'Audi'),
(12, 'Mercedes'),
(13, 'Heineken'),
(14, 'Amstel'),
(15, 'C1000');

-- --------------------------------------------------------

--
-- Table structure for table `brand_likes`
--

CREATE TABLE `brand_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `brand_likes`
--

INSERT INTO `brand_likes` (`id`, `brand_id`, `user_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 2),
(4, 1, 2),
(5, 5, 2),
(13, 1, 3),
(14, 2, 3),
(15, 3, 3),
(16, 4, 3),
(17, 5, 3),
(18, 6, 3),
(19, 15, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `birthdate` date NOT NULL,
  `profile_pic` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `preferences` tinyint(4) NOT NULL,
  `preferredagelow` int(11) NOT NULL,
  `preferredagehigh` int(11) NOT NULL,
  `personality` varchar(20) NOT NULL,
  `personality_lookingfor` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `nickname`, `name`, `password`, `email`, `gender`, `birthdate`, `profile_pic`, `description`, `preferences`, `preferredagelow`, `preferredagehigh`, `personality`, `personality_lookingfor`) VALUES
(1, 'victov', 'Victor Veldstra', 'victov', 'bla@blabla.com', 0, '1994-10-03', '', 'has lots of swag', 1, 16, 20, '', ''),
(2, 'kurl', 'Madeleine', 'yologirl123', 'bla@blabla.eu', 1, '1997-07-13', '', 'very seksie kurl', 0, 0, 0, 'I20-N12.5S12.5-T25', 'I10E20S12.5N12.5F25'),
(3, 'logintest', 'BASSIE EN ADRIAAN', 'test', 'test@test.com', 1, '1990-02-07', '', 'victor is super cool', 0, 20, 25, 'E50-N50-T50-J50', 'I50E0S50N0F50T0P50J0'),
(4, 'henkie', 'Mustafa Baas', 'blab', 'mu@sta.fa', 0, '1980-10-10', '', 'Mustafa is leipste baas', 0, 8, 80, '', ''),
(5, 'nick', 'Nick en Simon', 'slechtemuziek', 'nick@simon.falen', 1, '1890-12-12', '', 'Onszelf vinden we in ieder geval fantastisch!', 1, 70, 80, '', ''),
(6, 'noobcake', 'Jan Peter Balkenende', '123', 'boven@de.norm', 0, '1970-08-10', '', 'Money in the bank!', 0, 20, 50, '', ''),
(7, 'Enge Man', 'Geert Wilders', 'marokko', 'geert@zachte.gee', 0, '1900-01-01', '', 'MINDER, MINDER, MINDER!', 0, 30, 60, '', '');
