-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 03 nov. 2017 à 09:27
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
-- Structure de la table `customer_clear`
--

DROP TABLE IF EXISTS `customer_clear`;
CREATE TABLE IF NOT EXISTS `customer_clear` (
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
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `customer_clear`
--

INSERT INTO `customer_clear` (`id`, `firstname`, `lastname`, `birthDate`, `phoneNumber`, `nationality`, `ssn`, `address`, `city`, `postcode`, `country`, `cardNumber`, `expirationDate`, `cvv`) VALUES
(173, 'Chris', 'Evans', '1981-06-13', '0466676869', 'American', '223051303507686', '3 Arts Entertainment', 'Beverly Hills', '90212', 'USA', '4485388639123111', '2019-03-01', 587),
(171, 'Bob', 'Dylan', '1941-05-24', '0444454647', 'American', '293061303508680', '1230 Avenue of the Americas', 'New York', '10020', 'USA', '4851150580479611', '2024-05-01', 123),
(172, 'Zinedine', 'Zidane', '1972-06-23', '0455565758', 'Francaise', '193061303507681', 'Avenida de Concha Espina, 1', 'Madrid', '28036', 'Spain', '4916678838816138', '2020-11-01', 256);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
