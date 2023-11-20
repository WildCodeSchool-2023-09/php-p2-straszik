CREATE DATABASE  IF NOT EXISTS `straszik` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `straszik`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: straszik
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actuality`
--

DROP TABLE IF EXISTS `actuality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actuality` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`,`category_id`),
  KEY `fk_actuality_categorie1_idx` (`category_id`),
  CONSTRAINT `fk_actuality_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuality`
--

LOCK TABLES `actuality` WRITE;
/*!40000 ALTER TABLE `actuality` DISABLE KEYS */;
INSERT INTO `actuality` VALUES (1,'Davele a Geispolsheim','davele_geispolsheim.jpg','Davele vous attends de pied ferme à l\'espace Malraux à Geispolsheim ! Venez consommer et profitez des nombreux goodies en vente directement sur notre stand.',2),(2,'Des concerts tout frais tout chaud !','herbscht_tour.jpg','Dans le 67 à Espace Malraux à Geispolsheim, dans le 68 à Microbrasserie Artisanale G\'sundgo à Eschentzwiller et en Allemagne au Rockcafe Altdorf à Altdorf. #lesassoiffés #microbrasserie #geispolsheim #altdorf #Eschentzwiller #espacemalraux #rockcafe',1),(3,'Retour sur le Sùmmer Tour','herbscht_tour.jpg','Le Sùmmer Tour c\'est déjà terminé ! On aimerait chaleureusement remercier tous ceux qui ont fait le déplacement pour venir nous écouter ! Nous espérons que vous avez pris autant de plaisir que nous ! Mention spéciale aux plus irréductibles qui nous soutiennent à chaque prestation. On vous aime et rdv très bientôt sans doute. Deguà Schmutz ! #lesassoiffés #concert #ete #alsacien #rock',1),(7,'Test','lesAssoifés_groupe.webp','test',2);
/*!40000 ALTER TABLE `actuality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `album` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `year` int NOT NULL,
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (1,'A Stùrz e de Nàcht',2016,'asturzadenacht.webp'),(2,'A Schlegele Esch Gwàtsch',2020,'nouvel_album.webp'),(3,'Sòmmer Zitt',2022,'sommerzitt.webp');
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Concerts'),(2,'Evénements');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concert`
--

DROP TABLE IF EXISTS `concert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `concert` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location` varchar(50) NOT NULL,
  `capacity` int NOT NULL,
  `places_availables` int DEFAULT NULL,
  `date` date NOT NULL,
  `affiche` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concert`
--

LOCK TABLES `concert` WRITE;
/*!40000 ALTER TABLE `concert` DISABLE KEYS */;
INSERT INTO `concert` VALUES (1,'Reims l\'ARENA',100,0,'2023-12-05','Test.png');
/*!40000 ALTER TABLE `concert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goodie`
--

DROP TABLE IF EXISTS `goodie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goodie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` int NOT NULL,
  `designation` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goodie`
--

LOCK TABLES `goodie` WRITE;
/*!40000 ALTER TABLE `goodie` DISABLE KEYS */;
INSERT INTO `goodie` VALUES (1,1,'Sòmmer Zitt  (Single - Téléchargement)','sommerzitt.png','Single et titre bonus de l\'EP \'Sòmmer Zitt\' \n\n\nSortie le 1er octobre 2022'),(2,5,'Sòmmer Zitt  (CD physique)','sommerzitt.png','Réédition de 4 titres du 1er album \'A Stùrz de Nàcht\', + 1 titre bonus, Sòmmer Zitt\n\nSortie le 1er octobre 2022\n\nPlaylist :\n1. S\'esch m\'r drùn\n2. Àlter Zàpfe\n3. Hitzedààs\n4. Lùmpeseckel\n5. Sòmmer Zitt (titre bonus)'),(3,15,'Les Assoiffés - A Schlegele esch gwàtsch (Album - CD physique)','nouvel_album.png','Des compositions originales 100% rock and roll qui font sonner des textes 100% en dialecte : la musique des Assoiffés se déguste sans modération !\n\n\nPlaylist :\n1. Àmerika\n2. Bràndlùlf\n3. Wisser Räuch\n4. Bari nà\n5. Schedel\'se\n6. De Trùmpete Wederhàll\n7. Mànchmòl\n8. Meschthùffe\n9. Nàckli Fiess\n10. Punks vo de Rawe\n11. A Schlegele esch gwàtsch\n12. Liewi Lieb'),(4,8,'Les Assoiffés - A Schlegele esch gwàtsch (Album Numérique)','nouvel_album.png','Des compositions originales 100% rock and roll qui font sonner des textes 100% en dialecte : la musique des Assoiffés se déguste sans modération !\n\nAlbum à télécharger immédiatement en mp3 - Format 320kbps\nComprends également le visuel du disque\n\nPlaylist :\n1. Àmerika\n2. Bràndlùlf\n3. Wisser Räuch\n4. Bari nà\n5. Schedel\'se\n6. De Trùmpete Wederhàll\n7. Mànchmòl\n8. Meschthùffe\n9. Nàckli Fiess\n10. Punks vo de Rawe\n11. A Schlegele esch gwàtsch\n12. Liewi Lieb'),(5,5,'Les Assoiffés - A Stùrz e de Nàcht (Album Numérique)','asturzadenacht.png','Premier Album 7 titres du groupe Les Assoiffés.\nDes compositions originales 100% rock and roll qui font sonner des textes 100% en dialecte : la musique des Assoiffés se déguste sans modération !\n\nAlbum à télécharger immédiatement en mp3 - Format 320kbps\nComprends également le visuel du disque\n\nPlaylist:\n1. Àller Zàpfe\n2. \'s isch m\'r nit drùm\n3. Fer dich\n4. Hitzedaas\n5. Lùmpeseckel\n6. A Stùrz e de Nàcht\n7. Sylvàner Blues'),(6,2,'Badge - Les Assoiffés - Cigogne','badge_Les_Assoiffés_Cigogne_blanc.png','Badge Les Assoiffés - Cigogne Blanc\n\nArtwork : Thomas Holfmann'),(7,3,'Badge - Les Assoiffés - A Schlegele','badge_Les_Assoiffés_A_Schlegele.png','Badge Les Assoiffés - A Schlegele\n\nArtwork : Thomas Holfmann'),(8,2,'Badge - Les Assoiffés - Caricature noir','badge_Les_Assoiffés_caricature_noir.png','Badge Les Assoiffés - caricature \ncouleur : blanc (existe aussi en noir)\n\nArtwork : Joan'),(9,1,'Badge - Les Assoiffés - Caricature blanc','badge_Les_Assoiffés_caricature_blanc.png','Badge Les Assoiffés - caricature \ncouleur : noir (existe aussi en blanc)\n\nArtwork : Joan'),(10,1,'Badge - Les Assoiffés - Pinup brun','badge_Les_Assoiffés_Pinup_brun.png','Badge Les Assoiffés - Pinup\ncouleur : brun (existe aussi en blanc et noir)\n\nArtwork : Manue Monteiro'),(11,1,'Badge - Les Assoiffés - Pinup blanc','badge_Les_Assoiffés_Pinup_blanc.png','Badge Les Assoiffés - Pinup\ncouleur : blanc (existe aussi en brun et noir)\n\nArtwork : Manue Monteiro'),(12,1,'Badge - Les Assoiffés - Pinup noir','badge_Les_Assoiffés_Pinup_noir.png','Badge Les Assoiffés - Pinup\ncouleur : noir (existe aussi en blanc et brun)\n\nArtwork : Manue Monteiro'),(13,1,'Badge - Les Assoiffés - Logo 2017 brun','badge_Les_Assoiffés_Logo_2017_brun.png','Badge Les Assoiffés - Logo\ncouleur : brun (existe aussi en noir et blanc)\n\nArtwork : Manue Monteiro'),(14,1,'Badge - Les Assoiffés - Logo 2017 blanc','badge_Les_Assoiffés_Logo_2017_blanc.png','Badge Les Assoiffés - Logo\ncouleur : noir (existe aussi en brun et noir)\n\nArtwork : Manue Monteiro'),(15,1,'Badge - Les Assoiffés - Logo 2017 noir','badge_Les_Assoiffés_Logo_2017_noir.png','Badge Les Assoiffés - Logo\ncouleur : noir (existe aussi en blanc et brun)\n\nArtwork : Manue Monteiro'),(16,12,'T-shirt - Les Assoiffés - Caricature noir homme','T-shirt_Les_Assoiffés_Caricature_noir_homme.png','T-shirt Homme\ncouleur : noir\nImpression : Logo Les Assoiffés Caricature\n\nTailles : S à XXL\n100% cotton bio - fabriqué en France\n\nArtwork par Joan'),(17,12,'T-shirt - Les Assoiffés - Caricature burgundy homme','T-shirt_Les_Assoiffés_Caricature_burgundy_homme.png','T-shirt Homme\ncouleur : burgundy\nImpression : Logo Les Assoiffés Caricature\n\nTailles : S à XXL\n100% cotton bio - fabriqué en France\n\nArtwork par Joan'),(18,12,'T-shirt - Les Assoiffés - Caricature blanc homme','T-shirt_Les_Assoiffés_Caricature_blanc_homme.png','T-shirt Homme\ncouleur : blanc\nImpression : Logo Les Assoiffés Caricature\n\nTailles : S à XXL\n100% cotton bio - fabriqué en France\n\nArtwork par Joan'),(19,12,'T-shirt - Les Assoiffés - Caricature noir femme','T-shirt_Les_Assoiffés_Caricature_noir_femme.png','T-shirt Femme\ncouleur : noir\nImpression : Logo Les Assoiffés Caricature\n\nTailles : S à M\n100% cotton bio - fabriqué en France\n\nArtwork par Joan'),(20,12,'T-shirt - Les Assoiffés - Caricature burgundy femme','T-shirt_Les_Assoiffés_Caricature_burgundy_femme.png','T-shirt Femme\ncouleur : burgundy\nImpression : Logo Les Assoiffés Caricature\n\nTailles : S à M\n100% cotton bio - fabriqué en France\n\nArtwork par Joan'),(21,12,'T-shirt - Les Assoiffés - Logo noir homme','T-shirt_Les_Assoiffés_Logo_noir_homme.png','T-shirt Homme\ncouleur : noir\nImpression : Logo Les Assoiffés\n\nTailles : S à XXL\n100% cotton bio - fabriqué en France\n\nArtwork par Manue Monteiro'),(22,12,'T-shirt - Les Assoiffés - Logo burgundy homme','T-shirt_Les_Assoiffés_Logo_burgundy_homme.png','T-shirt Homme\ncouleur : burgundy\nImpression : Logo Les Assoiffés\n\nTailles : S à XXL\n100% cotton bio - fabriqué en France\n\nArtwork par Manue Monteiro'),(23,12,'T-shirt - Les Assoiffés - Logo blanc homme','T-shirt_Les_Assoiffés_Logo_blanc_homme.png','T-shirt Homme\ncouleur : blanc\nImpression : Logo Les Assoiffés\n\nTailles : S à XXL\n100% cotton bio - fabriqué en France\n\nArtwork par Manue Monteiro'),(24,12,'T-shirt - Les Assoiffés - Logo rouge homme','T-shirt_Les_Assoiffés_Logo_rouge_homme.png','T-shirt Homme\ncouleur : rouge\nImpression : Logo Les Assoiffés\n\nTailles : S à XXL\n100% cotton bio - fabriqué en France\n\nArtwork par Manue Monteiro'),(25,12,'T-shirt - Les Assoiffés - Logo noir femme','T-shirt_Les_Assoiffés_Logo_noir_femme.png','T-shirt Femme\ncouleur : noir\nImpression : Logo Les Assoiffés\n\nTailles : S à M\n100% cotton bio - fabriqué en France\n\nArtwork par Manue Monteiro'),(26,12,'T-shirt - Les Assoiffés - Logo burgundy femme','T-shirt_Les_Assoiffés_Logo_burgundy_femme.png','T-shirt Femme\ncouleur : burgundy\nImpression : Logo Les Assoiffés\n\nTailles : S à M\n100% cotton bio - fabriqué en France\n\nArtwork par Manue Monteiro'),(27,12,'T-shirt - Les Assoiffés - Logo blanc femme','T-shirt_Les_Assoiffés_Logo_blanc_femme.png','T-shirt Femme\ncouleur : blanc\nImpression : Logo Les Assoiffés\n\nTailles : S à M\n100% cotton bio - fabriqué en France\n\nArtwork par Manue Monteiro'),(28,12,'T-shirt - Les Assoiffés - Logo rouge femme','T-shirt_Les_Assoiffés_Logo_rouge_femme.png','T-shirt Femme\ncouleur : rouge\nImpression : Logo Les Assoiffés\n\nTailles : S à M\n100% cotton bio - fabriqué en France\n\nArtwork par Manue Monteiro');
/*!40000 ALTER TABLE `goodie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newletter`
--

DROP TABLE IF EXISTS `newletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newletter` (
  `prospect_id` int NOT NULL,
  `concert_id` int NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`prospect_id`,`concert_id`),
  KEY `fk_prospect_has_concert_concert1_idx` (`concert_id`),
  KEY `fk_prospect_has_concert_prospect1_idx` (`prospect_id`),
  CONSTRAINT `fk_prospect_has_concert_concert1` FOREIGN KEY (`concert_id`) REFERENCES `concert` (`id`),
  CONSTRAINT `fk_prospect_has_concert_prospect1` FOREIGN KEY (`prospect_id`) REFERENCES `prospect` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newletter`
--

LOCK TABLES `newletter` WRITE;
/*!40000 ALTER TABLE `newletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `newletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `goodie_id` int NOT NULL,
  `user_id` int NOT NULL,
  `quantite` int NOT NULL,
  `total_price` int NOT NULL,
  PRIMARY KEY (`goodie_id`,`user_id`),
  KEY `fk_goodie_has_user_user1_idx` (`user_id`),
  KEY `fk_goodie_has_user_goodie1_idx` (`goodie_id`),
  CONSTRAINT `fk_goodie_has_user_goodie1` FOREIGN KEY (`goodie_id`) REFERENCES `goodie` (`id`),
  CONSTRAINT `fk_goodie_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prospect`
--

DROP TABLE IF EXISTS `prospect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prospect` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prospect`
--

LOCK TABLES `prospect` WRITE;
/*!40000 ALTER TABLE `prospect` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `song`
--

DROP TABLE IF EXISTS `song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `song` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `time` float NOT NULL,
  `album_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_song_album` (`album_id`),
  CONSTRAINT `fk_song_album` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `song`
--

LOCK TABLES `song` WRITE;
/*!40000 ALTER TABLE `song` DISABLE KEYS */;
INSERT INTO `song` VALUES (1,'Sòmmer Zitt',3.12,3),(2,'Àmerikà',3.21,2),(3,'Bràndlùft',3.05,2),(4,'Wisser Räuch',3.33,2),(5,'Bari Nà',2.59,2),(6,'Schedel\'se',2.26,2),(7,'De Trùmpete Mederhàll',2.45,2),(8,'Mànchmòl',4.23,2),(9,'Meschlhüffe',3.26,2),(10,'Nàckti Fiess',3.56,2),(11,'Punks Vo De Rawe',3.03,2),(12,'A Schlegele Esch Gwàtsch',5.11,2),(13,'Liewl Lieb',4.06,2),(14,'Àlter Zàpfe',3.35,1),(15,'S\'esch m\'r net drùm',3.09,1),(16,'Fer dìch',3.42,1),(17,'Hitzedaas',3.44,1),(18,'Lùmpeseckel',1.42,1),(19,'A Stùrz e de Nàcht',5.07,1),(20,'Sylvàner Blues',5.04,1),(21,'La nouvelle chanson',3,NULL);
/*!40000 ALTER TABLE `song` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket` (
  `concert_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`concert_id`,`user_id`),
  KEY `fk_concert_has_user_user1_idx` (`user_id`),
  KEY `fk_concert_has_user_concert1_idx` (`concert_id`),
  CONSTRAINT `fk_concert_has_user_concert1` FOREIGN KEY (`concert_id`) REFERENCES `concert` (`id`),
  CONSTRAINT `fk_concert_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `code_postal` int NOT NULL,
  `ville` varchar(45) NOT NULL,
  `is_Newletters` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','admin','admin@admin.fr','admin',1,'L\'adresse de l\'administrateur',01000,'Quelque part',NULL), (2, 'User', 'user', 'user@user.fr', 'user', 0, 'L\'adresse de l\'utilisateur', 01000, 'Quelque part', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_newletter`
--

DROP TABLE IF EXISTS `user_has_newletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_has_newletter` (
  `user_id` int NOT NULL,
  `newletter_prospect_id` int NOT NULL,
  `newletter_concert_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`newletter_prospect_id`,`newletter_concert_id`),
  KEY `fk_user_has_newletter_newletter1_idx` (`newletter_prospect_id`,`newletter_concert_id`),
  KEY `fk_user_has_newletter_user1_idx` (`user_id`),
  CONSTRAINT `fk_user_has_newletter_newletter1` FOREIGN KEY (`newletter_prospect_id`, `newletter_concert_id`) REFERENCES `newletter` (`prospect_id`, `concert_id`),
  CONSTRAINT `fk_user_has_newletter_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_newletter`
--

LOCK TABLES `user_has_newletter` WRITE;
/*!40000 ALTER TABLE `user_has_newletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_has_newletter` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-20 16:01:15
