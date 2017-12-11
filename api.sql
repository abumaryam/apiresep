-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `copy_resepi`;
CREATE TABLE `copy_resepi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `copy_resepi` (`id`, `judul`) VALUES
(1,	'Tumis Labu Siam Sederhana'),
(2,	'Terong Balado'),
(3,	'Thai Mango Sticky Rice Dessert');

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(5,	'Desert'),
(6,	'Sayangku'),
(7,	'Kerennya'),
(8,	'bbb'),
(9,	'nmnmnm'),
(10,	'sasasasa'),
(11,	'ghgh'),
(12,	'juju'),
(13,	'satu'),
(14,	'rerere');

DROP TABLE IF EXISTS `resep`;
CREATE TABLE `resep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `bahan` text NOT NULL,
  `cara_membuat` text NOT NULL,
  `kategori_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-12-10 18:40:13
