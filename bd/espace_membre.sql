-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 avr. 2021 à 23:16
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `espace_membre`
--

CREATE DATABASE espace_membre;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prix_achat` double NOT NULL,
  `prix_vente` double NOT NULL,
  `stock` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `id_cat_art` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `name`, `prix_achat`, `prix_vente`, `stock`, `createdAt`, `updatedAt`, `id_cat_art`, `id_user`, `photo`) VALUES
(1, 'Fanta', 15, 17, 30, '2021-04-30 06:18:13', '2021-04-30 07:21:44', 2, 1, 1),
(2, 'Coca', 15.5, 17.5, 45, '2021-04-30 06:18:50', '2021-04-30 06:18:50', 2, 1, 2),
(3, 'Sprite', 15, 17, 30, '2021-04-30 06:23:08', '2021-04-30 06:23:08', 2, 1, 3),
(4, 'Nestle', 8, 9, 50, '2021-04-30 06:23:44', '2021-04-30 06:23:44', 3, 1, 0),
(5, 'Gant', 20, 23, 100, '2021-04-30 06:24:46', '2021-04-30 06:24:46', 4, 1, 0),
(6, 'Ballet', 7, 9, 15, '2021-04-30 06:25:15', '2021-04-30 06:25:15', 4, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cat_article`
--

CREATE TABLE `cat_article` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `id_user` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cat_article`
--

INSERT INTO `cat_article` (`id`, `name`, `createdAt`, `updatedAt`, `id_user`) VALUES
(2, 'Boissons Gazeuses', '2021-02-10 08:57:34', '2021-04-30 01:24:44', 1),
(3, 'Eau', '2021-02-10 08:58:35', '2021-04-30 01:26:56', 1),
(4, 'AccÃ©ssoires', '2021-02-10 09:09:32', '2021-02-10 09:09:32', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `date_naissance` varchar(255) NOT NULL,
  `civilite` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `date_naissance`, `civilite`, `adresse`, `email`, `password`, `profile`) VALUES
(1, 'Andelo', 'Horly', '2019-05-26', 'monsieur', 'Blablabla', 'andelomatahorly@gmail.com', 'd729333a9a3b3de0825a284d505fef44d8254b03', 1),
(2, 'Momo', 'Popo', '2021-02-03', 'monsieur', 'blalalalalalalala', 'momopopo@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat_art` (`id_cat_art`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `cat_article`
--
ALTER TABLE `cat_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `cat_article`
--
ALTER TABLE `cat_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_cat_art`) REFERENCES `cat_article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `cat_article`
--
ALTER TABLE `cat_article`
  ADD CONSTRAINT `cat_article_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
