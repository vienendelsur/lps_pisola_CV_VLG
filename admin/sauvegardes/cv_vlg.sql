-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Novembre 2017 à 17:37
-- Version du serveur :  10.1.8-MariaDB
-- Version de PHP :  5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cv_vlg`
--
CREATE DATABASE IF NOT EXISTS `cv_vlg` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cv_vlg`;

-- --------------------------------------------------------

--
-- Structure de la table `t_competences`
--

DROP TABLE IF EXISTS `t_competences`;
CREATE TABLE `t_competences` (
  `id_competence` int(3) NOT NULL,
  `competence` varchar(30) NOT NULL,
  `c_niveau` int(3) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_competences`
--

INSERT INTO `t_competences` (`id_competence`, `competence`, `c_niveau`, `utilisateur_id`) VALUES
(4, 'coucou', 100, 1),
(8, 'toto', 100, 1),
(9, 'vélo', 80, 1),
(10, 'Bootstrap', 10, 1),
(11, 'gabarits', 50, 1),
(12, 'cuisine', 50, 1),
(13, 'hitites', 50, 1),
(14, 'j''aime pas ', 120, 1),
(15, 'les huîtres', 100, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_experiences`
--

DROP TABLE IF EXISTS `t_experiences`;
CREATE TABLE `t_experiences` (
  `id_experience` int(3) NOT NULL,
  `e_titre` varchar(50) NOT NULL,
  `e_soustitre` varchar(50) NOT NULL,
  `e_dates` varchar(50) NOT NULL,
  `e_description` text NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_experiences`
--

INSERT INTO `t_experiences` (`id_experience`, `e_titre`, `e_soustitre`, `e_dates`, `e_description`, `utilisateur_id`) VALUES
(5, 'titr', 'sousit', 'dates', 'tesxte', 1),
(8, 'Titre de l''exp.', 'sous-titre de l''exp.', 'depuis 2015', '<h3>et l&agrave; je mets un texte plus long avec le style dont j&#39;ai besoin</h3>\r\n\r\n<p><strong>une liste</strong></p>\r\n\r\n<ul>\r\n	<li>ceci</li>\r\n	<li>cela</li>\r\n	<li>et encore &ccedil;a</li>\r\n</ul>\r\n\r\n<blockquote>\r\n<p>&nbsp;Longtemps je me suis couch&eacute; dans le temps.</p>\r\n</blockquote>\r\n', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_formations`
--

DROP TABLE IF EXISTS `t_formations`;
CREATE TABLE `t_formations` (
  `id_formation` int(3) NOT NULL,
  `f_titre` varchar(50) NOT NULL,
  `f_soustitre` varchar(50) NOT NULL,
  `f_dates` varchar(50) NOT NULL,
  `f_description` text NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_loisirs`
--

DROP TABLE IF EXISTS `t_loisirs`;
CREATE TABLE `t_loisirs` (
  `id_loisir` int(3) NOT NULL,
  `loisir` varchar(50) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_loisirs`
--

INSERT INTO `t_loisirs` (`id_loisir`, `loisir`, `utilisateur_id`) VALUES
(1, 'Opéra', 1),
(6, 'moisi', 1),
(7, 'plein', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_realisations`
--

DROP TABLE IF EXISTS `t_realisations`;
CREATE TABLE `t_realisations` (
  `id_realisation` int(3) NOT NULL,
  `r_titre` varchar(50) NOT NULL,
  `r_soustitre` varchar(50) NOT NULL,
  `r_dates` varchar(50) NOT NULL,
  `r_description` text NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_realisations`
--

INSERT INTO `t_realisations` (`id_realisation`, `r_titre`, `r_soustitre`, `r_dates`, `r_description`, `utilisateur_id`) VALUES
(2, 'proust', 'proust', 'proust', 'L''œuvre romanesque de Marcel Proust est une réflexion majeure sur le temps et la mémoire affective comme sur les fonctions de l''art qui doit proposer ses propres mondes, mais c''est aussi une réflexion sur l''amour et la jalousie, avec un sentiment de l''échec et du vide de l''existence qui colore en gris la vision proustienne où l''homosexualité tient une place importante. La Recherche constitue également une vaste comédie humaine de plus de deux cents acteurs. Proust recrée des lieux révélateurs, qu''il s''agisse des lieux de l''enfance dans la maison de Tante Léonie à Combray ou des salons parisiens qui opposent les milieux aristocratiques et bourgeois, ces mondes étant traités parfois avec une plume acide par un auteur à la fois fasciné et ironique. Ce théâtre social est animé par des personnages très divers dont Marcel Proust ne cache pas les traits comiques : ces figures sont souvent inspirées par des personnes réelles ce qui fait de À la recherche du temps perdu un roman à clés et le tableau d''une époque. La marque de Proust est aussi dans son style dont on remarque les phrases souvent très longues, qui suivent la spirale de la création en train de se faire, cherchant à atteindre une totalité de la réalité qui échappe toujours', 1),
(3, 'papi fait du ski', 'il est très bon', '2015', 'et il neige', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_reseaux`
--

DROP TABLE IF EXISTS `t_reseaux`;
CREATE TABLE `t_reseaux` (
  `id_reseau` int(3) NOT NULL,
  `reseau` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_reseaux`
--

INSERT INTO `t_reseaux` (`id_reseau`, `reseau`, `url`, `utilisateur_id`) VALUES
(1, 'facebook', 'https://www.facebook.com/isola.patrick', 1),
(2, 'LinkedIn', 'https://www.linkedin.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_titre_cv`
--

DROP TABLE IF EXISTS `t_titre_cv`;
CREATE TABLE `t_titre_cv` (
  `id_titre_cv` int(2) NOT NULL,
  `titre_cv` text NOT NULL,
  `accroche` text NOT NULL,
  `logo` varchar(20) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_titre_cv`
--

INSERT INTO `t_titre_cv` (`id_titre_cv`, `titre_cv`, `accroche`, `logo`, `utilisateur_id`) VALUES
(3, 'Titre de mon CV voilà', 'ceci est accrocheur', 'toto.gif', 1),
(4, 'Titre de mon CV voilà', 'ceci est accrocheur n''est-ce pas ? ', 'toto.gif', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateurs`
--

DROP TABLE IF EXISTS `t_utilisateurs`;
CREATE TABLE `t_utilisateurs` (
  `id_utilisateur` int(3) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` int(10) UNSIGNED ZEROFILL NOT NULL,
  `mdp` varchar(12) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `avatar` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` enum('F','H') NOT NULL,
  `etat_civil` enum('M.','Mme','','') NOT NULL,
  `adresse` text NOT NULL,
  `code_postal` int(5) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `site_web` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_utilisateurs`
--

INSERT INTO `t_utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `email`, `telephone`, `mdp`, `pseudo`, `avatar`, `age`, `date_naissance`, `sexe`, `etat_civil`, `adresse`, `code_postal`, `ville`, `pays`, `site_web`) VALUES
(1, 'Patrick', 'Isola', 'patrick.isola@lepoles.com', 0663741135, '123456', 'VienenDelSur', 'toto.gif', 52, '1964-11-18', 'H', 'M.', '16, avenue de Laumière', 75019, 'Paris', 'France', 'www.isola.name');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_competences`
--
ALTER TABLE `t_competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `t_formations`
--
ALTER TABLE `t_formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  ADD PRIMARY KEY (`id_loisir`);

--
-- Index pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  ADD PRIMARY KEY (`id_realisation`);

--
-- Index pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  ADD PRIMARY KEY (`id_reseau`);

--
-- Index pour la table `t_titre_cv`
--
ALTER TABLE `t_titre_cv`
  ADD PRIMARY KEY (`id_titre_cv`);

--
-- Index pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_competences`
--
ALTER TABLE `t_competences`
  MODIFY `id_competence` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  MODIFY `id_experience` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_formations`
--
ALTER TABLE `t_formations`
  MODIFY `id_formation` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  MODIFY `id_loisir` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  MODIFY `id_realisation` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  MODIFY `id_reseau` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_titre_cv`
--
ALTER TABLE `t_titre_cv`
  MODIFY `id_titre_cv` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  MODIFY `id_utilisateur` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
