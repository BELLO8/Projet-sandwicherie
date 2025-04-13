-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2020 at 05:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto`
--

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categorie`) VALUES
(1, 'Burger Ivoire'),
(2, 'Burgers'),
(3, 'Kits Burger (ivoire)'),
(4, 'Chawarma'),
(5, 'Poulet'),
(6, 'Dessert et Gâteaux'),
(7, 'Boisson');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_command` smallint(5) UNSIGNED NOT NULL,
  `nom_cli` varchar(255) NOT NULL,
  `prenom_cli` varchar(255) NOT NULL,
  `num_cli` text NOT NULL,
  `add_cli` text NOT NULL,
  `livraison` text NOT NULL,
  `date_livr` date NOT NULL,
  `produits_command` text NOT NULL,
  `status_command` tinyint(1) DEFAULT NULL,
  `date_comm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `cat_id` smallint(6) UNSIGNED DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `prix` int(11) DEFAULT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `cat_id`, `nom`, `details`, `prix`, `images`) VALUES
(1, 1, 'HAMBURGER \"ivoire\"', ' Ce HAMBURGER est composé de : Pain, viande hachée, frites,  mayonnaise, salade,  oignon, ketchup.', 300, 'Hamburger.jpg'),
(2, 1, 'EGG BURGER \"ivoire\"', ' Ce EGG BURGER est composé de : Pain, viande hachée, frites, mayonnaise, salade, omelette, oignon, ketchup.', 400, 'IMG_2330.JPG'),
(3, 1, 'DOUBLE EGG BURGER  \"ivore\"', 'Ce DOUBLE EGG BURGER est composé de : Pain, viande hachée, frites, mayonnaise, salade, 2 omelettes, oignon, ketchup.', 500, 'double.jpg'),
(4, 1, 'EGG BURGER  \"ivore\" AU SAUCISSON  ', 'Ce EGG BURGER est composé de : Pain, viande hachée, frites, mayonnaise, salade, omelette, oignon, ketchup, saucisson.', 500, 'saucis.jpg'),
(5, 1, 'CHEESEBURGER \"ivoire\"', 'Ce CHEESE BURGER est composé de : Pain , viande hachée , frites ,  mayonnaise , salade ,  omelette , oignon , ketchup , saucisson ,  fromage.', 800, 'unnamed.png'),
(6, 4, 'CHAWARMA  A LA VIANDE DE BOEUF', 'Ce CHAWARMA est composé de : Pain , frite , oignon , tomate, cornichon , viande de boeuf , salade ,sauce.', 500, 'c1.JPG'),
(7, 4, 'CHAWARMA  A LA VIANDE DE BOEUF', 'Ce CHAWARMA  est composé de : Pain , frite , oignon , tomate, cornichon , viande de boeuf , salade ,  sauce.', 1000, 'c2.jpg'),
(8, 1, 'BURGER \"ivoire\" AU PATE DE CAMPAGNE ', 'Ce BURGER AU PATE DE CAMPAGNE est composé de : Pain , paté de compagne , frites , mayonnaise , salade ,  oignon  , ketchup.', 500, 'burger_pate.JPG'),
(9, 1, 'FISH BURGER  \"ivore\"', 'Ce FISH BURGER est composé de : Pain, mayonnaise, tomate, oignon, poisson, salade et des frites.', 500, 'fishburger.jpg'),
(10, 1, 'FISH BURGER \"ivore\" A L\' OMELETTE OU AU SAUCISSON ', 'Ce FISH BURGER est composé de : Pain, mayonnaise, tomate, oignon, salade, frite, omelette ou au saucisson.', 600, 'fishom.jpg'),
(11, 1, 'FISH BURGER \"ivoire\" A OMELETTE ET AU SAUCISSON  ', 'Ce FISH BURGER A OMELETTE ET AU SAUCISSON est compose de : Pain , mayonnaise , tomate , oignon , salade , frite , omelette et au saucisson.', 700, 'fish_om.jpg'),
(13, 6, 'LAIT', 'en pot', 300, 'IMG_2305.JPG'),
(14, 6, 'GLACE', 'compose de cornets et de different saveurs', 500, 'ice.png'),
(15, 6, 'GÂTEAUX Anniversaire', 'de 5 000 fcfa à 15 000 fcfa ...', 5000, 'IMG_2934.png'),
(16, 6, 'GÂTEAUX BÂPTEME', 'de 10 000 fcfa à  20 000 fcfa ...', 10000, 'bapt.jpg'),
(17, 6, 'GÂTEAUX MARIAGE', 'de 20 000 fcfa à 40 000 fcfa ...', 20000, 'wedding_cake_PNG19454.png'),
(18, 7, 'YOUKI Cocktail', '30cl', 200, 'IMG_2209.JPG'),
(19, 7, 'YOUKI Orange', '30cl', 200, 'IMG_2214.JPG'),
(20, 7, 'YOUKI Pomme', '30cl', 250, 'IMG_2211.JPG'),
(21, 7, 'YOUKI Moka café', '30cl', 250, 'moka.jpeg'),
(22, 7, 'Coca cola', '30cl', 250, 'coca_cola_PNG8903.png'),
(23, 7, 'Fanta orange', '30cl', 250, 'fanta_PNG46.png'),
(24, 7, 'Fanta cocktail', '30cl', 250, 'fanta_PNG48.png'),
(25, 7, 'Sprite', '30cl', 250, 'sprite_PNG8922.png'),
(26, 7, 'Xxl energie', '33cl', 500, 'photo040119175729-photo1.png'),
(27, 7, 'Orangina', '33cl', 500, 'images (6).jpeg'),
(28, 7, 'Kabisa', '25cl', 500, 'images (7).jpeg'),
(29, 7, 'Cody\'s', '25cl', 500, 'codys.jpeg'),
(30, 7, 'Vimto', '33cl', 500, 'IMG_2796.png'),
(31, 7, 'King lion', '25cl', 500, 'images (11).jpeg'),
(32, 7, 'Booster ', '33cl', 600, 'IMG_2938.png'),
(33, 7, 'Malta', '33cl', 600, 'malta.JPG'),
(34, 7, 'Vody', '25cl', 600, 'images (8).jpeg'),
(35, 7, 'Fanta ', 'en cannette de 30cl', 400, 'fanta_PNG54.png'),
(36, 7, 'Youki pomme', 'en cannette de 30cl', 400, 'images (2).jpeg'),
(37, 7, 'Youki moka café', 'en cannette de 30cl', 400, 'images (1).jpeg'),
(38, 7, 'Coca cola', 'en cannette de 30cl', 400, 'coca_cola_PNG8907.png'),
(39, 7, 'Sprite', 'en cannette de 30cl', 400, 'sprite_PNG8932.png'),
(40, 7, 'Moka café', 'en bouteille cassable de 30cl', 300, 'images.jpg'),
(41, 7, 'Coca cola', 'en bouteille cassable de 30cl', 300, 'coca_cola.png'),
(42, 7, 'Tonic', 'en bouteille cassable de 30cl', 300, 'images (3).jpeg'),
(43, 7, 'Sprite', 'en bouteille cassable de 30cl', 300, 'sprite_PNG8929.png'),
(44, 4, 'CHAWARMA  AU POULET', 'composition de base poulet', 1000, 'char.jpg'),
(45, 1, 'Pack Burger \"ivoire\"', 'Hamburger + frites + salade et sucrerie.', 1500, 'IMG_2297.JPG'),
(46, 5, 'Pack poulet 1', 'Composé de frites + poulets et sucrerie.', 1200, 'IMG_22.png'),
(47, 5, 'Pack poulet 2', 'Composé de poulet + frites + salade.', 1000, 'poulet1.png'),
(48, 5, 'Pack poulet 3', 'Composé de poulet + frites + salade et cannette.', 1500, 'IMG_2290.png'),
(49, 3, 'KIT BURGER (ivoire) 1', 'composé de 1 sandwich + 1e sucrerie et 1e bouteille d\'eau mineral.', 800, 'kit.png'),
(50, 3, 'KIT BURGER (ivoire) 2', 'composé de 1 sandwich + 1 pot de lait et 1e bouteille d\'eau mineral.', 900, 'kit1.png'),
(51, 3, 'KIT BURGER (ivoire) 3', 'composé de Hamburger ou Chawarma +  1e bouteille d\'eau mineral + 1e cannette tel que : coca cola ; fanta ; sprite  ... ', 1000, 'kit900.png'),
(52, 3, 'KIT BURGER (ivoire) 4', 'composé de 1 sandwich + 1e sucrerie + 1e portion de frite + 1e portion de salade et 1e bouteille d\'eau mineral.', 1600, 'kit1500.png'),
(53, 3, 'KIT BURGER (ivoire) 5', 'composé de 1 sandwich de 700 fr + 1e cannette orangina et 1e bouteille d\'eau mineral.', 1300, 'kit1300.png'),
(54, 7, 'AMSTEL MALT', 'en bouteille', 500, 'amstel.png'),
(55, 7, 'SAC\'S', '24cl', 500, 'IMG_2320.png'),
(56, 6, 'Eskimo crème glacée', 'Vanille au glaçage de chocolat', 300, 'cm7.png'),
(57, 6, 'CORNET DE GLACE', 'Au chocolat', 300, 'cm1.png'),
(58, 6, 'CORNET DE CREME GLACEE', ' à la vanille', 300, 'cm4.png'),
(59, 6, 'CORNET DE CREME GLACEE', 'Aux pepites de chocolat', 300, 'cm3.png'),
(60, 6, 'CORNET DE CREME GLACEE', 'à la confiture de fraise', 300, 'cm6.png'),
(61, 6, 'CORNET DE CREME GLACEE', 'Au chocolat', 300, 'cm5.png'),
(62, 7, 'COMPAL 1952', 'multi-fruits composé de 10% de jus de pomme ; 10% de jus de mangue et 10% de jus d\'orange 330ml.', 500, 'IMG_2930.png'),
(63, 4, 'CHAWARMA  AU POULET', 'composition de base poulet', 500, 'cha_au_poulet.jpg'),
(64, 6, 'Eskimo crème glacée ', 'Chocolat au glaçage de chocolat', 300, 'cm2.png'),
(65, 7, 'Bavaria', 'bavaria pomme en bouteil cassable', 600, 'bav1.JPG'),
(66, 7, 'Bavaria', 'bavaria pomme en cannette', 500, 'bav2.JPG'),
(67, 7, 'Fanta cocktail', 'en bouteille cassable ', 300, 'IMG_2372.JPG'),
(68, 7, 'YOUKI cola', '30cl', 250, 'cola.jpg'),
(69, 7, 'SHAKA mixer', 'Energie-Vodka', 500, 'shaka1.jpg'),
(70, 7, 'SHAKA mixer', 'Mojito', 500, 'shaka.jpg'),
(71, 7, 'CHILL', 'au citron', 500, 'chill.jpg'),
(72, 7, 'SCHWEPPES', 'Agrumes 50cl', 500, 'sch.jpg'),
(73, 7, 'nônô ', 'banane ; fraise ; chocolat ; nature ; nature sucré ; vanille.', 300, 'nono1.jpg'),
(74, 7, 'DAMOO', 'jus de cocktail  ; jus de mangue  ; jus d\'orange ; jus de pomme.', 300, 'dammo.jpg'),
(75, 2, 'HAMBURGER', 'Composé de : pain , steak haché , oignon ,tomate , ketchup , mayonnaise,salade.', 1000, 'IMG_2182.png'),
(76, 2, 'CHEESEBURGER', 'Composé de : pain , omelette , steak haché , fromage , tomate , oignon ,salade.', 1500, 'IMG_2226.PNG'),
(77, 2, 'CHEESE BURGER au saucisson', 'Composé de : pain , fromage , steak haché , tomate , oignon , omelette , saucisson , salade.', 1600, 'che.PNG'),
(78, 2, 'FISH BURGER  ', 'Composé de : pain , poisson , salade , mayonnaise , ketchup , oignon , tomate.', 1300, 'fish_burger.JPG'),
(79, 2, 'EGG BURGER ', 'Ce EGGBURGER est composé de : pain , mayonnaise , steak haché , salade , omelette , oignon , ketchup.', 1200, 'IMG_2183egg.png'),
(80, 4, 'CHAWARMA  A LA LANGUE DE BOEUF', 'Ce CHAWARMA est composé de : Pain , frite , oignon , tomate, cornichon , langue de boeuf , salade , sauce.', 500, 'lang.jpg'),
(81, 4, 'CHAWARMA  A LA LANGUE DE BOEUF', 'Ce CHAWARMA est composé de : Pain , frite , oignon , tomate, cornichon , langue de boeuf , salade  , sauce.', 1000, 'lang1.jpg'),
(82, 2, 'FISH BURGER  AU FROMAGE', 'Ce FISH BURGER est composé de : Pain , poisson , mayonnaise , tomate , oignon , salade , fromage.', 1600, 'IMG_2198.JPG'),
(83, 2, 'EGG BURGER AU SAUCISSON  ', 'Ce EGGBURGER est composé de : pain , mayonnaise , steak haché , salade , omelette , oignon , ketchup , saucisson.', 1300, 'IMG_2183eggsau.png');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` smallint(5) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `date_post` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `texte` text NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `texte`, `images`) VALUES
(1, 'BURGER AU PATE DE CAMPAGNE DISPONIBLE', 'header-g.jpg'),
(2, 'BURGER  \"ivoire\" DISPONIBLE', 'gallery_02.JPG'),
(5, 'CHAWARMA DISPONIBLE', '31940_w1024h768c1cx2144cy1424.jpg'),
(6, 'DISPONIBLE CHEZ DAVID', 'gallery_09.JPG'),
(7, 'VOTRE DELICE NOTRE DESIR', 'shawarma.jpg'),
(8, 'DISPONIBLE', 'IMG_2242.JPG'),
(9, 'KITS BURGER chez DAVID à 1000 CFA', 'feature_bg.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_command`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cat_id` (`cat_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_command` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `fk_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
