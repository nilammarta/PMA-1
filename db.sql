-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: pma_db
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.23.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Hobbies`
--

DROP TABLE IF EXISTS `Hobbies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Hobbies` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `person_id` int NOT NULL,
  `hobby_name` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Hobbies_Persons_ID_fk` (`person_id`),
  CONSTRAINT `Hobbies_Persons_ID_fk` FOREIGN KEY (`person_id`) REFERENCES `Persons` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Hobbies`
--

/*!40000 ALTER TABLE `Hobbies` DISABLE KEYS */;
INSERT INTO `Hobbies` VALUES (8,43,'Drawing'),(11,43,'Swimming'),(33,1,'Drawing'),(34,1,'Cooking'),(47,1,'Run'),(48,69,'Run'),(49,69,'Swimming'),(50,1,'Swimming'),(51,75,'Swimming'),(54,38,'Singing'),(55,38,'Dance'),(56,39,'Swimming'),(60,3,'Swimming'),(61,3,'Cooking'),(63,2,'Singing'),(68,74,'Cooking'),(69,4,'Reading novel '),(75,2,'Cooking');
/*!40000 ALTER TABLE `Hobbies` ENABLE KEYS */;

--
-- Table structure for table `Jobs`
--

DROP TABLE IF EXISTS `Jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Jobs` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `job_name` varchar(100) NOT NULL,
  `count` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Jobs`
--

/*!40000 ALTER TABLE `Jobs` DISABLE KEYS */;
INSERT INTO `Jobs` VALUES (1,'Jobless',6),(2,'Secretary',0),(5,'Receptionist',0),(6,'Lawyer',0),(7,'Entrepreneur',0),(8,'Artist',1),(9,'Farmer',1),(10,'Fisherman',1),(11,'Doctor',0),(12,'Nurse',0),(13,'Dentist',0),(14,'Programmer',0),(15,'Police',0),(16,'Teacher',1),(17,'Reporter',1),(36,'Manager',2),(42,'Singer',2);
/*!40000 ALTER TABLE `Jobs` ENABLE KEYS */;

--
-- Table structure for table `Persons`
--

DROP TABLE IF EXISTS `Persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Persons` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(60) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` varchar(1) NOT NULL,
  `address` varchar(100) NOT NULL,
  `internal_notes` varchar(320) DEFAULT NULL,
  `role` varchar(6) NOT NULL,
  `alive` int NOT NULL,
  `last_logged_in` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Persons`
--

/*!40000 ALTER TABLE `Persons` DISABLE KEYS */;
INSERT INTO `Persons` VALUES (1,' Lala','Lulu','1200981029177918','lalalulu@gmail.com','$2y$10$FN7q5qASAUYMS32FdnnRyOAdlP/8/ic1nl6TfNS5Ajp2z1.y2qXga','2000-09-07','F','Denpasar','Data Admin ','A',1,'2024-03-26 17:21:02'),(2,'Agatha','Chelsea','1200938086866281','agatha@gmail.com','$2y$10$zO6kusi0fummMxqh30RF0eND3qKLEvqs6vLXDXoaulNP5BvYvJiIC','2000-12-12','F','Jakarta','','M',1,NULL),(3,'Kumi','Gina','1299380783699093','kumigina@gmail.com','$2y$10$38cW4wGuPBgeH7vBMaICU.2iSK/px1EJxAMeBxRdL6PHiYGQiC3pW','1999-09-17','M','Lombok','&lt;h5&gt;Kumi gina&lt;/h5&gt;','M',1,'2024-03-26 00:44:15'),(4,'Kuka','Kuki','1002986399380822','kukakuki@gmail.com','$2y$10$XG57z8dqTb42dX8bvSjF6uZOzXOuTSt1ZyPAZ3p1WfzV38IO3oa76','2003-09-03','M','Tabanan','25 March 2024','A',1,'2024-03-24 18:40:37'),(38,'Clarine','Cutie','1203099837748490','clarinecutie@gmail.com','$2y$10$USYUBHss0vOizvaWxMlTqeiIp8wbczvdOpFO2ZtjGpUMUVP89VK3e','2009-12-12','F','Denpasar','','M',1,NULL),(39,'Geisya','Gigi','1200938647783009','geisyagigi@gmail.com','$2y$10$N5RiAigcBOcyx9os5fRgiOsbx7cUg.yi2GrnKyAe5ZO3TvGMziSzy','2000-12-12','F','Tabanan','26 Februari 2024','M',1,NULL),(42,'Yuza','Gaja','1009837638890293','yuzagaja@gmail.com','$2y$10$VkfY9r8aMhOG82ESOQXNceBXyyHSZB4sPsP98XMMxIMpsoNzxYaA2','2000-12-12','M','Denpasar','','M',1,NULL),(43,'Bara','Raka','1009873556782009','bararaka@gmail.com','$2y$10$YSHqHz1bK4KJiDhcFvracOkDR9oF5pbqPRMMb/7SEpMdPQwFyxM7i','2000-12-12','M','Denpasar','','M',1,NULL),(47,'Anggis','Devaki','1200938874893000','anggisdevaki@gmail.com','$2y$10$IZT.zSP6T2jlIA.KNP0EPePDh3RUrKeuckc8bsuz2OJW0GoPk2VfO','2002-12-12','F','gianyar','','M',1,NULL),(48,'Trala','Trili','1309938874889669','tralatrili@gmail.com','$2y$10$TVuHO99KNJuNME87tyV3HurHWCcmhwjziajTtKSDqGxe3Ybe28a26','2004-12-12','F','Denpasar','','M',0,NULL),(60,'Yula','Lili','1200389300938390','yulalili@gmail.com','$2y$10$oLKr27pqPvqPi6KfABRHlOV0ROzuSmANxrgaK0uV2XG.3EYjWPK2C','2003-12-12','F','Tabanan','','M',1,NULL),(69,'Gio','Ogi','1299003987840302','gioogi@gmail.com','$2y$10$eLJcUGE10S9JhCun2biSA..H3taa6SDXNgLoVOiVHLxPzcUu5vDiW','1990-12-12','M','Jakarta','','M',1,NULL),(74,'Raka','Jiwa','1288390129387993','juliagi@gmail.com','$2y$10$jsYNkAY8CngqHPu3ULItougeP6t4hjqjhF9Ns0OnyfPOyyTyoZsHq','1945-08-18','M','Gianyar','','M',1,NULL),(75,'Yula','Hula','1200934875758393','yulahula@gmail.co','$2y$10$UWJIbzVxunB3bn1hmBmd9O9YMwhBa5iEDpmWOFoPM3X/FlCBbdzrK','1980-12-12','F','Denpasar','Meencoba panjang internal notes dengan 320 karakter kata, untuk melihat tampilan pada bagian view persons data yang berbentuk tabel. yang mana tabel ini akan menentukan batas dari setiap kolom ','M',1,NULL),(78,'Xixi','Boba','1239009457894902','xixiboba@gmail.com','$2y$10$Gjj2U75LWyHci85hrLD0o.6827fD668pC7zNg382.0BHSaxF0m3Bq','2017-12-12','M','Denpasar','','M',1,NULL);
/*!40000 ALTER TABLE `Persons` ENABLE KEYS */;

--
-- Table structure for table `Persons_Jobs`
--

DROP TABLE IF EXISTS `Persons_Jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Persons_Jobs` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `person_id` int NOT NULL,
  `job_id` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Persons_Jobs_Persons_ID_fk` (`person_id`),
  KEY `Persons_Jobs_Jobs_ID_fk` (`job_id`),
  CONSTRAINT `Persons_Jobs_Jobs_ID_fk` FOREIGN KEY (`job_id`) REFERENCES `Jobs` (`ID`),
  CONSTRAINT `Persons_Jobs_Persons_ID_fk` FOREIGN KEY (`person_id`) REFERENCES `Persons` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Persons_Jobs`
--

/*!40000 ALTER TABLE `Persons_Jobs` DISABLE KEYS */;
INSERT INTO `Persons_Jobs` VALUES (1,47,42),(2,48,1),(3,4,36),(7,3,9),(8,2,42),(13,1,36),(14,38,8),(15,39,17),(16,42,16),(17,43,10),(30,60,1),(39,69,1),(44,74,1),(45,75,1),(48,78,1);
/*!40000 ALTER TABLE `Persons_Jobs` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-27 13:44:47
