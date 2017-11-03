-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 03 nov. 2017 à 09:26
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vtsdemo`
--

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `nationality` varchar(30) DEFAULT NULL,
  `ssn` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `cardNumber` varchar(16) DEFAULT NULL,
  `expirationDate` date DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `birthDate`, `phoneNumber`, `nationality`, `ssn`, `address`, `city`, `postcode`, `country`, `cardNumber`, `expirationDate`, `cvv`) VALUES
(122, 'lLoA1IpmP7B3J27NIAQL3g==', 'BjR9QXYgAeb0wlMgsQf9QA==', '2050-08-24', '0592968668', 'American', '267814952052542', 'b5MPvYjbl7HaX8Vs9kBuA20KTEdyQxY65QKz0sPBNRU=', 'TnFXWm+bfBEcRBExUGIl1A==', '94449', 'USA', '3947719445172781', '2024-03-04', 824),
(120, 'rWs1hMdCDobrTghBTHXGMw==', 'voZHgjXw6JgyOBpbG/FIwg==', '1953-03-31', '5468874865', 'American', '270728129664339', 'uxwh2UWo/Yn4SsZ7TU1yCGTY0wEvY65WuyVI9OdFX4o=', 'BqJf+scf9b4toKzdmtkPxA==', '37473', 'USA', '0621366626599264', '2019-04-21', 562),
(121, 'Fy9CZBJ+rfez6x4s1fRexA==', '5Oi1KbdNXETO09Ns7uka7w==', '1905-12-10', '2890616112', 'Francaise', '128585591594516', 'n3QEmBq55H1O5Laq3alwBLxQTXk+hb4P7KI/WmP/D2w=', 'tV6tjjze9StKxWYH0evMVQ==', '96641', 'Spain', '9573759085746096', '2021-05-15', 353);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
