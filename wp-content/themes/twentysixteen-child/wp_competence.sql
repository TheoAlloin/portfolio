-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 07 Juin 2016 à 16:51
-- Version du serveur :  5.7.12-0ubuntu1
-- Version de PHP :  5.6.21-8+donate.sury.org~xenial+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `wp_competence`
--

CREATE TABLE `wp_competence` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `title` text NOT NULL,
  `skill_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `wp_competence`
--

INSERT INTO `wp_competence` (`id`, `link`, `title`, `skill_desc`) VALUES
(1, 'devicon-apache-line', 'Apache', 'Serveur HTTP'),
(4, 'devicon-bitbucket-plain', 'Bitbucket', 'Outil de versionning'),
(5, 'devicon-css3-plain', 'Css3', 'Intégration'),
(6, 'devicon-debian-plain', 'Debian', 'Système d\'exploitation'),
(9, 'devicon-html5-plain', 'HTML5', 'Structurer son site web'),
(10, 'devicon-mysql-plain', 'MySQL', 'SGBDR'),
(11, 'devicon-photoshop-plain', 'PhotoShop', 'Retouche d\'images / Intégration'),
(12, 'devicon-phpstorm-plain', 'PhpStorm', 'Environnement de développement'),
(13, 'devicon-ubuntu-plain', 'Ubuntu', 'Système d\'exploitation'),
(14, 'devicon-wordpress-plain', 'WordPress', 'CMS'),
(15, 'devicon-php-plain', 'Php7', 'Langage de développement'),
(16, 'devicon-jquery-plain', 'jQuery', 'Front Office'),
(17, 'devicon-javascript-plain', 'JavaScript', 'Langage de modélisation de pages interactives'),
(18, 'devicon-git-plain', 'GIT', 'Outil de versionning');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `wp_competence`
--
ALTER TABLE `wp_competence`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `wp_competence`
--
ALTER TABLE `wp_competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
