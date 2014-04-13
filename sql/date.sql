SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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

CREATE TABLE IF NOT EXISTS `brand_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `brand_likes` (`id`, `brand_id`, `user_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 2),
(4, 1, 2),
(5, 5, 2);

CREATE TABLE IF NOT EXISTS `profile` (
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `profile` (`id`, `nickname`, `name`, `password`, `email`, `gender`, `birthdate`, `profile_pic`, `description`, `preferences`, `preferredagelow`, `preferredagehigh`) VALUES
(1, 'victov', 'Victor Veldstra', 'victov', 'bla@blabla.com', 0, '1994-10-03', '', 'has lots of swag', 1, 16, 20),
(2, 'kurl', 'Madeleine', 'yologirl123', 'bla@blabla.eu', 1, '1997-07-13', '', 'very seksie kurl', 0, 0, 0),
(3, 'logintest', 'Henk', 'test', 'test@test.com', 1, '1991-04-29', '', 'login tester', 0, 20, 25);
