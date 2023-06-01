-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 01 juin 2023 à 03:18
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recipe_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `recipe_id` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `date`, `recipe_id`, `user_id`) VALUES
(1, 'C\'est une recette bien util , j\'aime beaucoup. Continuez comme çaaaaaaa', '2023-05-31 16:16:40', 1, 2),
(2, 'C\'est super bien expliquée et bien realisable.', '2023-05-31 16:16:40', 1, 4),
(6, 'Ceci est un commentaire voila', '2023-06-01 01:26:59', 3, 1),
(8, 'Cool Cette recette miam miam', '2023-06-01 02:05:41', 7, 1),
(9, 'Cool Merci !!', '2023-06-01 03:36:43', 1, 3),
(11, 'Merci pour cette decouverte', '2023-06-01 04:34:01', 1, 5),
(12, 'Super cool !', '2023-06-01 05:11:07', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int NOT NULL,
  `rating` int NOT NULL,
  `recipe_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `rating`, `recipe_id`, `user_id`) VALUES
(2, 1, 7, 1),
(3, 2, 5, 1),
(4, 3, 5, 2),
(5, 2, 1, 2),
(6, 1, 1, 3),
(7, 3, 1, 4),
(8, 2, 7, 4),
(9, 3, 1, 5),
(10, 1, 3, 2),
(11, 2, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `description`, `is_enabled`, `user_id`) VALUES
(1, 'Cassoulet', 'Le cassoulet est une spécialité régionale du Languedoc, à base de haricots secs, généralement blancs, et de viande. À son origine, il était à base de fèves. Le cassoulet tient son nom de la cassole en terre cuite émaillée dite caçòla1 en occitan et fabriquée à Issel.', 1, 1),
(2, 'Couscous', 'Le couscous est d\'une part une semoule de blé dur préparée à l\'huile d\'olive (un des aliments de base traditionnel de la cuisine des pays du Maghreb) et d\'autre part, une spécialité culinaire issue de la cuisine berbère, à base de couscous, de légumes, d\'épices, d\'huile d\'olive et de viande (rouge ou de volaille) ou de poisson.', 0, 1),
(3, 'Salade Romaine', 'La salade César est une recette de cuisine de salade composée de la cuisine américaine, traditionnellement préparée en salle à côté de la table, à base de laitue romaine, œuf dur, croûtons, parmesan et de « sauce César » à base de parmesan râpé, huile d\'olive, pâte d\'anchois, ail, vinaigre de vin, moutarde, jaune d\'œuf et sauce Worcestershire.', 1, 3),
(4, 'Escalope milanaise', 'L\'escalope à la milanaise, ou escalope milanaise est une escalope panée, de viande de veau, traditionnellement prise dans le faux-filet. Historiquement, on la cuit avec du beurre. Elle est généralement servie avec salade ou frites, accompagnée de sauce mayonnaise. On peut y ajouter un filet de jus de citron.\\n\\nEn Italie, ce mets ne se sert pas avec des pâtes.', 1, 2),
(5, 'Fufu sauce Gombo', 'Le fufu sauce Gombo est une spécialité ouest-africaine à base de fufu maïs. Dans la sauce Gombo on met de la viande de boeuf fraîche, des crabes, de la peau de boeuf. .\\n\\nAu Togo et au Bénin, ce mets est très apprécié.', 1, 4),
(6, 'Salade de poulet grillé', 'Cette délicieuse salade de poulet grillé est parfaite pour les repas légers et sains. Elle est composée de morceaux de poulet tendres et juteux, d\'un mélange croquant de légumes frais et d\'une vinaigrette légère. C\'est un plat simple à préparer et plein de saveurs. Idéal pour une journée ensoleillée ou comme option de repas équilibré.\r\nCette recette de salade de poulet grillé est un excellent choix pour un repas sain, équilibré et plein de saveurs. Vous pouvez ajuster les ingrédients selon vos préférences et ajouter d\'autres légumes ou garnitures de votre choix. Profitez de cette salade fraîche et savoureuse !', 1, 1),
(7, 'Pâtes à la carbonara', 'Les pâtes à la carbonara sont un plat italien classique, délicieusement crémeux et savoureux. Elles sont préparées avec des pâtes cuites al dente, du lard ou du pancetta, des œufs, du fromage Parmesan et du poivre noir. Le résultat est une combinaison de saveurs riches et une sauce onctueuse qui en font un repas réconfortant et délicieux', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` int NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `age`, `email`, `password`) VALUES
(1, 'Mickaël Andrieu', 34, 'mickael.andrieu@exemple.com', 'S3cr3t'),
(2, 'Mathieu Nebra', 34, 'mathieu.nebra@exemple.com', 'MiamMiam'),
(3, 'Laurène Castor', 28, 'laurene.castor@exemple.com', 'laCasto28'),
(4, 'Marcel Lawson', 45, 'marcel.lawson@exemple.com', 'Marcelo2013'),
(5, 'John Doe', 25, 'johndoe@gmail.com', 'passer');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_rating_recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipe_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
