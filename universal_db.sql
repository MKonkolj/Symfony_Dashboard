-- phpMyAdmin SQL Dump
-- version 5.2.0-rc1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2022 at 06:29 PM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universal`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `manager` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `avatar`, `email`, `manager`, `payment_method`) VALUES
(1, 'Unify', 'https://11daysofglobalunity.accites.com/wp-content/uploads/2015/08/UNIFY-Logo-Vector-200-w-white.png', 'unify@test.com', 'Mirko Vrknić', 'PayPal'),
(2, 'Like Media Inc', 'https://static.vecteezy.com/system/resources/thumbnails/002/767/748/small/lm-logo-letter-initial-logo-designs-template-free-vector.jpg', 'likemanager@test.com', 'Jelisaveta Milović', 'Bitcoin'),
(3, 'Smile holding', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJWG5HUp6TKCEj4RDQ2q0PZ1vjp0YJ_LtXr1cXepxZmSeiB4qHHK0ofSaZj33H3WpKdgI&usqp=CAU', 'nezhit@test.com', 'Ozren Biber', 'PayPal'),
(4, 'Bon Ton', 'http://www.priredbaidrustvo.com/wp-content/uploads/2020/10/arno-senoner-MRjjcDIk3Gw-unsplash-300x264.jpg', 'psoglav@test.com', 'Jelisaveta  Rončević', 'PayPal'),
(5, 'C Dounts LTD', 'https://images.unsplash.com/photo-1516876437184-593fda40c7ce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1172&q=80', 'usud@test.com', 'Jelena Ivanović', 'wireTransfer'),
(6, 'Beetle Juice LTD', 'https://store-images.s-microsoft.com/image/apps.46899.14474299641789941.2b826c2b-6f48-41fa-aa11-5d2919ea820e.c9209f9a-53f6-46ef-a260-34567b96c638?mode=scale&q=90&h=200&w=200&background=%23464646', 'drekavac@test.com', 'Filip Bembara', 'Bitcoin'),
(7, 'Xiaomi Mi', 'https://logodownload.org/wp-content/uploads/2015/02/xiaomi-logo-7.png', 'babayaga@test.com', 'Fikreta Jozicić', 'Bitcoin'),
(8, 'Limited Spectre Inc', 'https://jwt.io/img/icon.svg', 'bauk@test.com', 'Milojko Stefković', 'Bitcoin'),
(9, 'Blockchain Supreme', 'https://t4.ftcdn.net/jpg/03/03/43/51/360_F_303435130_zdXyoqatlaUbVRGsLFgq6zUfknzraMgP.jpg', 'karakondzula@test.com', 'Gordana Jovanov', 'Bitcoin');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220510084901', '2022-05-10 10:53:39', 172),
('DoctrineMigrations\\Version20220512231038', '2022-05-13 01:11:17', 147);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `developer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `description`, `date`, `time`, `developer_id`, `client_id`) VALUES
(1, 'Create HTML', '2022-05-01', '00:30:00', 12, 1),
(2, 'Create HTML', '2022-04-28', '00:30:00', 12, 1),
(3, 'Create CSS', '2022-04-29', '01:35:00', 12, 1),
(4, 'Create JS', '2022-04-30', '03:45:00', 12, 1),
(5, 'Modify JS', '2022-05-01', '02:20:00', 12, 1),
(6, 'Frontend presentation', '2022-05-02', '00:59:00', 12, 1),
(7, 'Create database', '2022-05-03', '01:20:00', 12, 1),
(8, 'Change database', '2022-05-04', '00:42:00', 12, 1),
(9, 'Argue with client', '2022-05-05', '01:20:00', 12, 1),
(10, 'Create database again', '2022-05-06', '03:20:00', 12, 1),
(11, 'Symfony new', '2022-05-07', '05:15:00', 12, 1),
(12, 'Modify project', '2022-05-08', '03:20:00', 12, 1),
(13, 'Deploy', '2022-05-09', '06:00:00', 12, 1),
(14, 'Create HTML', '2022-04-28', '00:30:00', 4, 4),
(15, 'Create CSS', '2022-04-29', '01:35:00', 4, 4),
(16, 'Create JS', '2022-04-30', '03:45:00', 4, 4),
(17, 'Modify JS', '2022-05-01', '02:20:00', 4, 4),
(18, 'Frontend presentation', '2022-05-02', '00:59:00', 4, 4),
(19, 'Create database', '2022-05-03', '01:20:00', 4, 4),
(20, 'Change database', '2022-05-04', '00:42:00', 4, 4),
(21, 'Argue with client', '2022-05-05', '01:20:00', 4, 4),
(22, 'Create database again', '2022-05-06', '03:20:00', 4, 4),
(23, 'Symfony new', '2022-05-07', '05:15:00', 4, 4),
(24, 'Modify project', '2022-05-08', '03:20:00', 4, 4),
(25, 'Deploy', '2022-05-09', '06:00:00', 4, 4),
(26, 'Create HTML', '2022-04-28', '00:30:00', 7, 6),
(27, 'Create CSS', '2022-04-29', '01:35:00', 7, 6),
(28, 'Create JS', '2022-04-30', '03:45:00', 7, 6),
(29, 'Modify JS', '2022-05-01', '02:20:00', 7, 6),
(30, 'Frontend presentation', '2022-05-02', '00:59:00', 7, 6),
(31, 'Create database', '2022-05-03', '01:20:00', 7, 6),
(32, 'Change database', '2022-05-04', '00:42:00', 7, 6),
(33, 'Argue with client', '2022-05-05', '01:20:00', 7, 6),
(34, 'Create database again', '2022-05-06', '03:20:00', 7, 6),
(35, 'Symfony new', '2022-05-07', '05:15:00', 7, 6),
(36, 'Modify project', '2022-05-08', '03:20:00', 7, 6),
(37, 'Deploy', '2022-05-09', '06:00:00', 7, 6),
(38, 'Create HTML', '2022-04-28', '00:30:00', 6, 5),
(39, 'Create CSS', '2022-04-29', '01:35:00', 6, 5),
(40, 'Create JS', '2022-04-30', '03:45:00', 6, 5),
(41, 'Modify JS', '2022-05-01', '02:20:00', 6, 5),
(42, 'Frontend presentation', '2022-05-02', '00:59:00', 6, 5),
(43, 'Create database', '2022-05-03', '01:20:00', 6, 5),
(44, 'Change database', '2022-05-04', '00:42:00', 6, 5),
(45, 'Argue with client', '2022-05-05', '01:20:00', 6, 5),
(46, 'Create database again', '2022-05-06', '03:20:00', 6, 5),
(47, 'Symfony new', '2022-05-07', '05:15:00', 6, 5),
(48, 'Modify project', '2022-05-08', '03:20:00', 6, 5),
(49, 'Deploy', '2022-05-09', '06:00:00', 6, 5),
(50, 'Create HTML', '2022-04-28', '00:30:00', 6, 5),
(51, 'Create CSS', '2022-04-29', '01:35:00', 6, 5),
(52, 'Create JS', '2022-04-30', '03:45:00', 6, 5),
(53, 'Modify JS', '2022-05-01', '02:20:00', 6, 5),
(54, 'Frontend presentation', '2022-05-02', '00:59:00', 6, 5),
(55, 'Create database', '2022-05-03', '01:20:00', 6, 5),
(56, 'Change database', '2022-05-04', '00:42:00', 6, 5),
(57, 'Argue with client', '2022-05-05', '01:20:00', 6, 5),
(58, 'Create database again', '2022-05-06', '03:20:00', 6, 5),
(59, 'Symfony new', '2022-05-07', '05:15:00', 6, 5),
(60, 'Modify project', '2022-05-08', '03:20:00', 6, 5),
(61, 'Deploy', '2022-05-09', '06:00:00', 6, 5),
(64, 'Create JS', '2022-04-30', '03:45:00', 1, 6),
(65, 'Modify JS', '2022-05-01', '02:20:00', 1, 6),
(66, 'Frontend presentation', '2022-05-02', '00:59:00', 1, 6),
(67, 'Create database', '2022-05-03', '01:20:00', 1, 6),
(68, 'Change database', '2022-05-04', '00:42:00', 1, 6),
(69, 'Argue with client', '2022-05-05', '01:20:00', 1, 6),
(70, 'Create database again', '2022-05-06', '03:20:00', 1, 6),
(71, 'Symfony new', '2022-05-07', '05:15:00', 1, 6),
(72, 'Modify project', '2022-05-08', '03:20:00', 1, 6),
(73, 'Deploy', '2022-05-09', '06:00:00', 1, 6),
(74, 'Create HTML', '2022-04-28', '00:30:00', 5, 1),
(75, 'Create CSS', '2022-04-29', '01:35:00', 5, 1),
(76, 'Create JS', '2022-04-30', '03:45:00', 5, 1),
(77, 'Modify JS', '2022-05-01', '02:20:00', 5, 1),
(78, 'Frontend presentation', '2022-05-02', '00:59:00', 5, 1),
(79, 'Create database', '2022-05-03', '01:20:00', 5, 1),
(80, 'Change database', '2022-05-04', '00:42:00', 5, 1),
(81, 'Argue with client', '2022-05-05', '01:20:00', 5, 1),
(82, 'Create database again', '2022-05-06', '03:20:00', 5, 1),
(83, 'Symfony new', '2022-05-07', '05:15:00', 5, 1),
(84, 'Modify project', '2022-05-08', '03:20:00', 5, 1),
(85, 'Deploy', '2022-05-09', '06:00:00', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_bin NOT NULL,
  `roles` json NOT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `avatar_alt` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bank_acc` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `roles`, `avatar_path`, `avatar_alt`, `status`, `street`, `city`, `country`, `password`, `bank_acc`) VALUES
(1, 'Loreta', 'Ipsum', 'loretaipsum@blogtalkradio.com', '[\"ROLE_ADMIN\"]', './images/profile-images/profile-woman.png', 'Profile image of Loreta Ipsum', 1, 'Muir', 'Leskovac', 'Serbia', '$2y$13$9LMTfpyag6yfJp2jg9Qq0etSeJRAzYzKcNoP6ThtRsgc6G9BGtdhK', '1111222233334444'),
(3, 'Hilde', 'Phipson', 'hphipson2@tmall.com', '[\"ROLE_ADMIN\"]', './images/profile-images/profile-guy-two.png', 'Profile image of Hilde Phipson', 1, 'Steensland', 'Varna', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(4, 'Elisabet', 'Halloway', 'ehalloway3@epa.gov', '[\"ROLE_DEV\"]', './images/profile-images/christie-campbell.jpg', 'Profile image of Elisabet Halloway', 1, 'Moulton', 'Platičevo', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(5, 'Ailyn', 'Prine', 'aprine4@diigo.com', '[\"ROLE_DEV\"]', './images/profile-images/jurica-koletic.jpg', 'Profile image of Ailyn Prine', 1, 'Village', 'Farkaždin', 'Serbia', '$2y$13$P9B8L84vEhnzrbB637Cg/.boIvK8VJ6YYaIzjB1XF.1nN91ynFgCa', '1111222233334444'),
(6, 'Reyna', 'Skottle', 'sskottle5@is.gd', '[\"ROLE_DEV\"]', './images/profile-images/jake-nackos.jpg', 'Profile image of Reyna Skottle', 1, 'Melby', 'Svrljig', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(7, 'Jill', 'Gosz', 'jgosz6@cnbc.com', '[\"ROLE_DEV\"]', './images/profile-images/stephanie-liverani.jpg', 'Profile image of Jill Gosz', 1, 'Prairie Rose', 'Varna', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(8, 'Ronnie', 'Moxley', 'rmoxley7@shutterfly.com', '[\"ROLE_DEV\"]', './images/profile-images/profile-guy-five.png', 'Profile image of Ronnie Moxley', 1, 'Graedel', 'Klenak', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(9, 'Cris', 'Davley', 'cdavley8@blogspot.com', '[\"ROLE_DEV\"]', './images/profile-images/profile-guy-four.png', 'Profile image of Chris Davley', 1, 'Cody', 'Rekovac', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(10, 'Abdel', 'Klarzynski', 'aklarzynski9@un.org', '[\"ROLE_DEV\"]', './images/profile-images/joseph-gonzalez.jpg', 'Profile image of Abdel Klarzynski', 1, 'Schiller', 'Ruma', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(11, 'Kele', 'Jump', 'kjumpa@bandcamp.com', '[\"ROLE_DEV\"]', './images/profile-images/julian-wan.jpg', 'Profile image of Kele Jump', 1, 'Bultman', 'Beška', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(12, 'Nicholas', 'Pountney', 'ppountneyb@paypal.com', '[\"ROLE_DEV\"]', './images/profile-images/profile-guy-three.png', 'Profile image of Nicholas Pountney', 1, 'Garrison', 'Debeljača', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(13, 'Hedwiga', 'Matherson', 'hmathersonc@etsy.com', '[\"ROLE_DEV\"]', './images/profile-images/profile-woman.png', 'Profile image of Hedwiga Matherson', 1, 'Pleasure', 'Pavliš', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(14, 'Jaye', 'Bugdale', 'jbugdaled@alibaba.com', '[\"ROLE_DEV\"]', './images/profile-images/stefan-stevic.jpg', 'Profile image of Jaye Bugdale', 1, 'Parkside', 'Niš', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(15, 'Raina', 'Livingston', 'rlivingstone@ucla.edu', '[\"ROLE_DEV\"]', './images/profile-images/christie-campbell.jpg', 'Profile image of Raina Livingston', 1, 'Scott', 'Savski Venac', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444'),
(16, 'Vicky', 'Hladynets', 'cpopplestonf@paypal.com', '[\"ROLE_DEV\"]', './images/profile-images/vicky-hladynets.jpg', 'Profile image of Vicky Hladynets', 0, 'Milwaukee', 'Toba', 'Serbia', '$2y$10$DcnszsYtMjVOebNkvj8CLO48LINb7fZWuZeX2FB7TDOVatF/bK10S', '1111222233334444');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5058659764DD9267` (`developer_id`),
  ADD KEY `IDX_5058659719EB6921` (`client_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `developer_id` FOREIGN KEY (`developer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
