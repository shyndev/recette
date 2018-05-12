-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 12 mai 2018 à 23:59
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `recette`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_nom` text COLLATE utf8_unicode_ci NOT NULL,
  `categorie_image` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie_nom`, `categorie_image`) VALUES
(1, 'Gâteau', ''),
(2, 'Tarte', ''),
(3, 'Plat chaud', ''),
(4, 'Plat froid', ''),
(5, 'Dessert', '');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ingredient_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_nom` text COLLATE utf8_unicode_ci NOT NULL,
  `ingredient_image` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`ingredient_id`, `ingredient_nom`, `ingredient_image`) VALUES
(1, 'Oeuf', ''),
(2, 'Farine', ''),
(3, 'Pâte lasagne', ''),
(4, 'Eau', ''),
(5, 'Lait', ''),
(6, 'Oignon', ''),
(7, 'Viande hachée', ''),
(8, 'Sauce tomate', ''),
(9, 'Beurre', ''),
(10, 'Fromage râpé', ''),
(11, 'Jambon', '');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `recette_id` int(11) NOT NULL AUTO_INCREMENT,
  `recette_nom` text COLLATE utf8_unicode_ci NOT NULL,
  `recette_duree` int(11) NOT NULL,
  `recette_temperature` int(11) NOT NULL,
  `recette_image` text COLLATE utf8_unicode_ci NOT NULL,
  `recette_categorie` int(11) NOT NULL,
  `recette_details` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`recette_id`),
  KEY `recette_categorie` (`recette_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`recette_id`, `recette_nom`, `recette_duree`, `recette_temperature`, `recette_image`, `recette_categorie`, `recette_details`) VALUES
(1, 'Lasagne bolognaise', 40, 180, '', 3, 'Etape 1\nCouper l\'oignon en petits morceaux et faire revenir dans de l\'huile d\'olive.\nEtape 2\nQuand les oignons ont bien bruni, y ajouter les 350g de steak haché.\nEtape 3\nFaire cuire à feu moyen puis ajouter la sauce bolognaise.\nEtape 4\nPréparez la béchamel.\nEtape 5\nFaire fondre le beurre à feu vif.\nEtape 6\nUne fois fondu, rajouter les deux cuillères à soupe de farine puis remuer avec un fouet à feu moyen.\nEtape 7\nQuand le mélange est homogène (très rapide), rajouter progressivement le lait sans arrêter de fouetter pour éviter les grumeaux.\nEtape 8\nContinuer de remuer jusqu\'à ce que la béchamel s\'épaississe.\nEtape 9\nMélanger la sauce bolognaise faite précédemment avec la béchamel.\nEtape 10\nPuis dans un plat à gratin, verser une couche de cette préparation puis recouvrir de pâte à lasagne. Refaire la même chose jusqu\'à épuisement de la sauce (environ 2 fois).\nEtape 11\nLa dernière couche doit être une couche de sauce. Ajouter le gruyère râpé et faire cuire envrion 45 min à 180° (th.6).\nEtape 12\nPour savoir si les lasagnes sont cuites, piquer avec un couteau, les pâtes à lasagne doivent être fondantes, donc le couteau doit s\'enfoncer sans problème.');

-- --------------------------------------------------------

--
-- Structure de la table `rel_recette_ingredient`
--

DROP TABLE IF EXISTS `rel_recette_ingredient`;
CREATE TABLE IF NOT EXISTS `rel_recette_ingredient` (
  `recette_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  KEY `recette_id` (`recette_id`),
  KEY `ingredient_id` (`ingredient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `recette_ibfk_1` FOREIGN KEY (`recette_categorie`) REFERENCES `categorie` (`categorie_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `rel_recette_ingredient`
--
ALTER TABLE `rel_recette_ingredient`
  ADD CONSTRAINT `rel_recette_ingredient_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_recette_ingredient_ibfk_2` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`recette_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
