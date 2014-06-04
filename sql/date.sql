-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 04 jun 2014 om 11:13
-- Serverversie: 5.6.15-log
-- PHP-versie: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `date`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Gegevens worden uitgevoerd voor tabel `brands`
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
-- Tabelstructuur voor tabel `brand_likes`
--

CREATE TABLE IF NOT EXISTS `brand_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `brand_likes`
--

INSERT INTO `brand_likes` (`id`, `brand_id`, `user_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 2),
(4, 1, 2),
(5, 5, 2),
(6, 3, 3),
(7, 6, 3),
(8, 12, 3),
(9, 15, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liker` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `likes`
--

INSERT INTO `likes` (`id`, `liker`, `likes`) VALUES
(1, 3, 4),
(2, 3, 6),
(3, 5, 3),
(4, 3, 5),
(5, 3, 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `messages`
--

INSERT INTO `messages` (`id`, `from`, `to`, `subject`, `body`) VALUES
(1, 2, 3, 'meet up', 'ey kurl, wunt some fuk?'),
(2, 4, 3, 'awh bla', '\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. In vulputate pellentesque sapien, ac volutpat turpis facilisis ut. Suspendisse cursus, quam et ullamcorper ultricies, dolor metus ultrices lectus, sed tempus ipsum risus sit amet urna. Morbi eu ligula non augue lacinia rhoncus quis vitae purus. Sed posuere aliquam ligula. Suspendisse viverra sem in porta convallis. Aliquam aliquet leo tellus, a convallis nibh varius at. Sed ultrices tortor malesuada eros dapibus aliquet.\n\nNulla commodo bibendum libero eget molestie. Sed cursus mi a magna pretium, non interdum justo mattis. Mauris ac feugiat risus. Donec accumsan adipiscing justo, sit amet consequat tortor vestibulum ut. Aenean convallis neque urna, a commodo magna auctor ac. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed nulla libero, ultricies at lectus a, ultricies tincidunt massa.\n\nNullam condimentum eros in odio suscipit, tincidunt vulputate elit adipiscing. Etiam condimentum, orci sed mattis adipiscing, ligula metus dignissim orci, eget pulvinar arcu enim quis lectus. Nulla porta eros vel ligula luctus, in dignissim nisl tristique. Etiam viverra in urna ut dignissim. Vestibulum at augue sit amet turpis facilisis egestas. Donec quis elementum nisl. Vestibulum mattis nec leo pharetra fringilla. Aenean tincidunt leo at elit fermentum, condimentum laoreet sapien cursus. Quisque imperdiet nunc quis sagittis bibendum. Mauris eget pharetra lectus. Aliquam non commodo nulla, semper scelerisque felis. Mauris sed vulputate lorem. Nunc dapibus augue ac est sollicitudin porta.\n\nAenean pellentesque, odio id adipiscing fringilla, diam orci scelerisque lorem, eu suscipit neque leo ut tellus. Nullam aliquet turpis velit, vitae suscipit lectus imperdiet in. Phasellus ut massa quam. Donec vel venenatis odio, tempus congue ipsum. Vivamus vel bibendum lacus. Etiam dictum suscipit mi, eget porttitor metus dictum in. Donec volutpat dignissim nibh, in rutrum erat congue at. Maecenas elementum blandit justo, et viverra sapien volutpat non. Vestibulum varius semper tincidunt. Fusce sem ligula, faucibus eu tempus id, bibendum eget dolor. Suspendisse id augue nec massa rhoncus pulvinar a a massa. Vestibulum euismod porta accumsan. Sed malesuada lorem ligula, vel semper ipsum tempus ac. In elit diam, scelerisque id vulputate sed, ultricies eget mauris. Aliquam pharetra volutpat dui ac fermentum.\n\nPhasellus ultricies arcu vel augue eleifend, eget ultricies tortor lacinia. Donec vel mi varius, pulvinar tellus in, pellentesque nisl. Quisque in gravida lectus. Curabitur a tincidunt est. Donec lorem metus, auctor non odio dignissim, rhoncus laoreet enim. Curabitur bibendum orci euismod leo malesuada, vitae posuere nisl scelerisque. Maecenas tincidunt, enim ut pharetra pretium, erat mi malesuada metus, sed dapibus turpis odio eu elit. Ut sodales tellus a tortor sagittis, vel venenatis sapien congue. Sed sagittis posuere tristique. Donec nec facilisis orci, quis convallis orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras molestie leo lectus, id venenatis elit fermentum at. Curabitur lacinia, elit quis varius lobortis, augue felis ornare augue, eu adipiscing arcu nulla eu lectus. Cras massa neque, interdum vel mollis in, pretium eu sem. Cras consequat venenatis tortor vel aliquam. '),
(5, 3, 1, 'blahtesting', 'blablabla                    '),
(4, 5, 6, 'i like ponies', 'i really like ponies, you too?'),
(6, 3, 5, 'hola', 'test blah blah\r\nomg so funky                    '),
(9, 5, 3, 'another newline test', 'dear Henk,\r<br />\r<br />this is another newline test.\r<br />if everything is correct, the newlines are now captured                    ');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `birthdate` date NOT NULL,
  `profile_pic` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `preferences` tinyint(4) NOT NULL,
  `preferredagelow` int(11) NOT NULL,
  `preferredagehigh` int(11) NOT NULL,
  `personality` varchar(50) NOT NULL,
  `personality_lookingfor` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `profile`
--

INSERT INTO `profile` (`id`, `nickname`, `name`, `password`, `email`, `gender`, `birthdate`, `profile_pic`, `description`, `preferences`, `preferredagelow`, `preferredagehigh`, `personality`, `personality_lookingfor`) VALUES
(1, 'victov', 'Victor Veldstra', 'victov', 'bla@blabla.com', 0, '1994-10-03', '', 'has lots of swag', 1, 16, 20, '', ''),
(2, 'kurl', 'Alice', 'yologirl123', 'bla@blabla.eu', 1, '1997-07-13', '', 'very seksie kurl', 0, 0, 0, '', ''),
(3, 'logintest', 'Henk', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', 1, '1991-04-29', '1371846580579.png', 'login tester', 0, 20, 25, 'I30-N25S25-T37.5-J33.334', 'I20E30-S25N25-F37.5T12.5-P33.334J16.668'),
(4, 'sjon', 'Bob', 'b9a407081a6325e2a4ecd31d6849e2ef', 'test@test.nl', 0, '1992-04-20', '', 'I am bob', 1, 20, 33, '', ''),
(5, 'wdf', 'sdfs', '098f6bcd4621d373cade4e832627b4f6', 'test@test.eu', 1, '1993-02-16', '', 'sfeasds', 1, 44, 55, '', ''),
(6, 'vrouwtest', 'VrouwDinges', '098f6bcd4621d373cade4e832627b4f6', 'vrouw@test.nl', 0, '1993-02-16', '', 'ik ben een vrouw', 0, 22, 23, '', ''),
(7, 'testvrouw', 'Zwangere vrouw', '098f6bcd4621d373cade4e832627b4f6', 'zv@hahapoep.nl', 1, '1981-01-30', '', 'Ik ben zwanger en ik ben een vrouw', 0, 55, 88, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
