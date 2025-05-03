-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 03 mai 2025 à 02:20
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fiche_patient`
--

-- --------------------------------------------------------

--
-- Structure de la table `allergies`
--

CREATE TABLE `allergies` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `allergen` varchar(100) DEFAULT NULL,
  `reaction` varchar(100) DEFAULT NULL,
  `severity` varchar(50) DEFAULT NULL,
  `documentation_date` date DEFAULT NULL,
  `start_date` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `allergies`
--

INSERT INTO `allergies` (`id`, `patient_id`, `allergen`, `reaction`, `severity`, `documentation_date`, `start_date`) VALUES
(1, 1, 'Penicillin G benzathine', 'Hives', 'Severe', '2012-08-15', '2010'),
(5, 9, 'peniciline', 'urticaire', NULL, NULL, NULL),
(6, 10, 'poussiere', 'toux', NULL, NULL, NULL),
(7, 11, 'knolo', 'toko', NULL, NULL, NULL),
(8, 12, 'polen', 'toux', NULL, NULL, NULL),
(9, 13, 'chat', 'toux', NULL, NULL, NULL),
(10, 14, 'polen', 'toux', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `immunizations`
--

CREATE TABLE `immunizations` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `vaccine` varchar(100) DEFAULT NULL,
  `lot_number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `immunizations`
--

INSERT INTO `immunizations` (`id`, `patient_id`, `vaccine`, `lot_number`, `date`, `status`) VALUES
(1, 1, 'Influenza Virus Vaccine', '1', '2010-08-15', 'Completed');

-- --------------------------------------------------------

--
-- Structure de la table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `medication` varchar(100) DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medications`
--

INSERT INTO `medications` (`id`, `patient_id`, `medication`, `instructions`, `dosage`, `start_date`, `status`) VALUES
(1, 1, 'Albuterol 0.09 MG/ACTUAT', '2 puffs every 6 hours PRN wheezing', '0.09 MG', '2012-08-10', 'Active');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `name`, `dob`, `sex`, `phone`, `address`) VALUES
(1, 'Adam Everyman', '1962-10-22', 'Male', NULL, NULL),
(5, 'rached ', '2004-10-20', 'Homme', NULL, NULL),
(6, 'ahmed elarbi', '2003-12-18', 'Homme', NULL, NULL),
(7, 'zakaria', '2001-11-20', 'Homme', NULL, NULL),
(8, 'hamma', '1888-05-08', 'Homme', NULL, NULL),
(9, 'rached hammami', '2000-12-02', 'Homme', '2516418900', 'beni khiar'),
(10, 'kamel eder', '2003-07-11', 'Homme', '22411844', 'beni khiari'),
(11, 'ashref korked', '2003-05-22', 'Femme', '52119737', 'beni knoul '),
(12, 'aziz khiaeri', '2003-07-30', 'Homme', '29632160', 'beni khaled'),
(13, 'amira', '2000-06-08', 'Femme', '26478951', 'gabes'),
(14, 'fatnassi', '2014-02-28', 'Homme', '2689319112', 'tunis');

-- --------------------------------------------------------

--
-- Structure de la table `problems`
--

CREATE TABLE `problems` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `onset_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `problems`
--

INSERT INTO `problems` (`id`, `patient_id`, `name`, `onset_date`, `status`) VALUES
(1, 1, 'Costal Chondritis', '2012-08-15', 'Active'),
(2, 1, 'Asthma', '2011-09-25', 'Active');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$cApgsShGZGwJkfpsdAMITemYAhszodiicqNLRo9.UHXguvyWxgo1q');

-- --------------------------------------------------------

--
-- Structure de la table `vital_signs`
--

CREATE TABLE `vital_signs` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `test` varchar(100) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vital_signs`
--

INSERT INTO `vital_signs` (`id`, `patient_id`, `date`, `test`, `result`, `details`) VALUES
(1, 1, '2012-08-15', 'Height', '70 in', ''),
(2, 1, '2012-08-15', 'Weight', '195 lb', ''),
(3, 1, '2012-08-15', 'Body Mass Index Calculated', '28', ''),
(4, 1, '2012-08-15', 'BP Systolic', '155 mm[Hg]', ''),
(5, 1, '2012-08-15', 'BP Diastolic', '92 mm[Hg]', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Index pour la table `immunizations`
--
ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Index pour la table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `vital_signs`
--
ALTER TABLE `vital_signs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `vital_signs`
--
ALTER TABLE `vital_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `allergies`
--
ALTER TABLE `allergies`
  ADD CONSTRAINT `allergies_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `immunizations`
--
ALTER TABLE `immunizations`
  ADD CONSTRAINT `immunizations_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `medications`
--
ALTER TABLE `medications`
  ADD CONSTRAINT `medications_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `problems_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vital_signs`
--
ALTER TABLE `vital_signs`
  ADD CONSTRAINT `vital_signs_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
