CREATE DATABASE  IF NOT EXISTS `easy-learning` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `easy-learning`;
-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: easy-learning
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `amministratore`
--

DROP TABLE IF EXISTS `amministratore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amministratore` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ultimo_accesso` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amministratore`
--

LOCK TABLES `amministratore` WRITE;
/*!40000 ALTER TABLE `amministratore` DISABLE KEYS */;
INSERT INTO `amministratore` VALUES ('marchese89@hotmail.com','$2y$10$YRnL8g8nNah4NgP63/cvsOIXdJTCNlJMXriGl.WGU2SEBNb34k4pq','2022-11-03 14:48:52');
/*!40000 ALTER TABLE `amministratore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area_tematica`
--

DROP TABLE IF EXISTS `area_tematica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area_tematica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_tematica`
--

LOCK TABLES `area_tematica` WRITE;
/*!40000 ALTER TABLE `area_tematica` DISABLE KEYS */;
INSERT INTO `area_tematica` VALUES (5,'Altro'),(2,'Scuole Superiori'),(1,'Università');
/*!40000 ALTER TABLE `area_tematica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_prodotto` int NOT NULL,
  `tipo_prodotto` int NOT NULL,
  `id_studente` int NOT NULL,
  PRIMARY KEY (`id_prodotto`,`tipo_prodotto`,`id_studente`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `studente_idx` (`id_studente`),
  CONSTRAINT `id_studente` FOREIGN KEY (`id_studente`) REFERENCES `studente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,20,0,2),(2,5,2,2),(3,12,5,2),(4,22,0,2);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `corso`
--

DROP TABLE IF EXISTS `corso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `corso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `materia` int DEFAULT NULL,
  `insegnante` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `materia_idx` (`materia`),
  KEY `insegnante_idx` (`insegnante`),
  CONSTRAINT `insegnante` FOREIGN KEY (`insegnante`) REFERENCES `insegnante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `materia` FOREIGN KEY (`materia`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corso`
--

LOCK TABLES `corso` WRITE;
/*!40000 ALTER TABLE `corso` DISABLE KEYS */;
INSERT INTO `corso` VALUES (6,'Analisi Matematica',8,3),(7,'Geometria',8,3),(8,'Algebra',8,3);
/*!40000 ALTER TABLE `corso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `esercizio`
--

DROP TABLE IF EXISTS `esercizio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `esercizio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) DEFAULT NULL,
  `traccia` varchar(255) DEFAULT NULL,
  `svolgimento` varchar(255) DEFAULT NULL,
  `corso_ex` int DEFAULT NULL,
  `prezzo` int DEFAULT NULL,
  `insegn` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `insegn_idx` (`insegn`),
  KEY `corso_ex_idx` (`corso_ex`),
  CONSTRAINT `corso_ex` FOREIGN KEY (`corso_ex`) REFERENCES `corso` (`id`),
  CONSTRAINT `insegn` FOREIGN KEY (`insegn`) REFERENCES `insegnante` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `esercizio`
--

LOCK TABLES `esercizio` WRITE;
/*!40000 ALTER TABLE `esercizio` DISABLE KEYS */;
INSERT INTO `esercizio` VALUES (5,'Esercizio di prova','file_esercizi/4.png','file_esercizi/5.png',6,5,3);
/*!40000 ALTER TABLE `esercizio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fattura`
--

DROP TABLE IF EXISTS `fattura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fattura` (
  `numero` int NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fattura`
--

LOCK TABLES `fattura` WRITE;
/*!40000 ALTER TABLE `fattura` DISABLE KEYS */;
INSERT INTO `fattura` VALUES (12);
/*!40000 ALTER TABLE `fattura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insegnante`
--

DROP TABLE IF EXISTS `insegnante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `insegnante` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cf` varchar(16) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `doc_id` varchar(255) DEFAULT NULL,
  `codice_fiscale` varchar(255) DEFAULT NULL,
  `titolo_di_studio` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `utente_i` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cf_UNIQUE` (`cf`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `doc_id_UNIQUE` (`doc_id`),
  UNIQUE KEY `titolo_di_studio_UNIQUE` (`titolo_di_studio`),
  UNIQUE KEY `cv_UNIQUE` (`cv`),
  UNIQUE KEY `foto_UNIQUE` (`foto`),
  UNIQUE KEY `utente_UNIQUE` (`utente_i`),
  CONSTRAINT `utente_i` FOREIGN KEY (`utente_i`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insegnante`
--

LOCK TABLES `insegnante` WRITE;
/*!40000 ALTER TABLE `insegnante` DISABLE KEYS */;
INSERT INTO `insegnante` VALUES (3,'MRCNNG89L11I872V','file_insegnanti/foto/2','file_insegnanti/doc_id/2','file_insegnanti/codice_f/2','file_insegnanti/titolo_studio/1.pdf','file_insegnanti/cv/1.pdf',20);
/*!40000 ALTER TABLE `insegnante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lezione`
--

DROP TABLE IF EXISTS `lezione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lezione` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `corso_lez` int NOT NULL,
  `presentazione` varchar(255) NOT NULL,
  `lezione` varchar(255) NOT NULL,
  `prezzo` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `corso_lez_idx` (`corso_lez`),
  CONSTRAINT `corso_lez` FOREIGN KEY (`corso_lez`) REFERENCES `corso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lezione`
--

LOCK TABLES `lezione` WRITE;
/*!40000 ALTER TABLE `lezione` DISABLE KEYS */;
INSERT INTO `lezione` VALUES (20,'Introduzione',1,6,'file_lezioni/1.png','file_lezioni/2.png',5),(22,'acascas',2,6,'file_lezioni/3.png','file_lezioni/4.png',6);
/*!40000 ALTER TABLE `lezione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `area_tematica` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `area_tematica_idx` (`area_tematica`),
  CONSTRAINT `area_tematica` FOREIGN KEY (`area_tematica`) REFERENCES `area_tematica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (8,'Matematica',2);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaggi_chat`
--

DROP TABLE IF EXISTS `messaggi_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messaggi_chat` (
  `id_chat` int NOT NULL,
  `messaggio` mediumtext,
  `autore` int NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_chat`,`data`,`autore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaggi_chat`
--

LOCK TABLES `messaggi_chat` WRITE;
/*!40000 ALTER TABLE `messaggi_chat` DISABLE KEYS */;
INSERT INTO `messaggi_chat` VALUES (1,'Ciao, come stai?',0,'2022-12-02 12:45:55'),(1,'eh',1,'2022-12-02 12:47:01'),(1,'pipetta!',0,'2022-12-02 13:38:28'),(1,'una madre potentissima!',1,'2022-12-02 14:21:04'),(1,'hhh',0,'2022-12-02 16:01:25'),(1,'una madre poderosa!',0,'2022-12-03 11:26:09'),(1,'che vale più di ogni cosa',1,'2022-12-03 11:26:22'),(1,'salve professore',0,'2022-12-03 11:28:01'),(1,'una somma genitrice, che sa, fa e dice!',1,'2022-12-03 11:28:23'),(4,'salve',0,'2022-12-03 11:29:09'),(4,'sale a te',1,'2022-12-03 11:29:37');
/*!40000 ALTER TABLE `messaggi_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordine`
--

DROP TABLE IF EXISTS `ordine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente` int DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `fattura` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_idx` (`cliente`),
  CONSTRAINT `cliente` FOREIGN KEY (`cliente`) REFERENCES `studente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordine`
--

LOCK TABLES `ordine` WRITE;
/*!40000 ALTER TABLE `ordine` DISABLE KEYS */;
INSERT INTO `ordine` VALUES (51,2,'2022-12-02 09:11:17','fatture/1.pdf'),(52,2,'2022-12-02 15:43:35','fatture/2.pdf'),(53,2,'2022-12-02 16:05:19','fatture/3.pdf');
/*!40000 ALTER TABLE `ordine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preventivo`
--

DROP TABLE IF EXISTS `preventivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `preventivo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `studente` int NOT NULL,
  `insegnante_p` int NOT NULL,
  `prezzo` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `insegnante_idx` (`insegnante_p`),
  KEY `studente_idx` (`studente`),
  CONSTRAINT `insegnante_p` FOREIGN KEY (`insegnante_p`) REFERENCES `insegnante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `studente` FOREIGN KEY (`studente`) REFERENCES `studente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preventivo`
--

LOCK TABLES `preventivo` WRITE;
/*!40000 ALTER TABLE `preventivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `preventivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodotti_ordine`
--

DROP TABLE IF EXISTS `prodotti_ordine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prodotti_ordine` (
  `id_ordine` int NOT NULL,
  `prodotto` int NOT NULL,
  `tipo` int NOT NULL,
  `prezzo` int NOT NULL,
  PRIMARY KEY (`id_ordine`,`prodotto`,`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodotti_ordine`
--

LOCK TABLES `prodotti_ordine` WRITE;
/*!40000 ALTER TABLE `prodotti_ordine` DISABLE KEYS */;
INSERT INTO `prodotti_ordine` VALUES (51,5,2,5),(51,20,0,5),(52,12,5,20),(53,22,0,6);
/*!40000 ALTER TABLE `prodotti_ordine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `richieste_lezioni`
--

DROP TABLE IF EXISTS `richieste_lezioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `richieste_lezioni` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) DEFAULT NULL,
  `studente` int DEFAULT NULL,
  `insegnante` int DEFAULT NULL,
  `traccia` varchar(255) DEFAULT NULL,
  `svolgimento` varchar(255) DEFAULT NULL,
  `prezzo` int DEFAULT NULL,
  `evasa` int DEFAULT '0',
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `richieste_lezioni`
--

LOCK TABLES `richieste_lezioni` WRITE;
/*!40000 ALTER TABLE `richieste_lezioni` DISABLE KEYS */;
INSERT INTO `richieste_lezioni` VALUES (5,'prima lezione',1,3,'file_richieste_lezioni/1.png','file_richieste_lezioni/12.png',15,1,'2022-11-17 13:25:24'),(6,'seconda lezione',1,3,'file_richieste_lezioni/2.png',NULL,NULL,0,'2022-11-17 13:34:46'),(7,'terza lezione',1,3,'file_richieste_lezioni/3.png','file_richieste_lezioni/8.png',20,1,'2022-11-17 13:37:18'),(8,'prova uno',1,3,'file_richieste_lezioni/7.png','file_richieste_lezioni/9.png',12,1,'2022-11-23 10:05:40'),(9,'prova due',1,3,'file_richieste_lezioni/10.png','file_richieste_lezioni/11.png',20,1,'2022-11-24 15:03:33'),(10,'espressione',2,3,'file_richieste_lezioni/13.png','file_richieste_lezioni/14.png',6,1,'2022-11-30 10:13:04'),(11,'aaaaaa',2,3,'file_richieste_lezioni/15.png','file_richieste_lezioni/16.png',12,1,'2022-12-01 13:46:29'),(12,'AXXaxAXaax',2,3,'file_richieste_lezioni/17.png','file_richieste_lezioni/18.png',20,1,'2022-12-02 15:41:52');
/*!40000 ALTER TABLE `richieste_lezioni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studente`
--

DROP TABLE IF EXISTS `studente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utente_s` int DEFAULT NULL,
  `via` varchar(255) DEFAULT NULL,
  `n_civico` varchar(6) DEFAULT NULL,
  `citta` varchar(255) DEFAULT NULL,
  `provincia` varchar(2) DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  `cf` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `utente_s_idx` (`utente_s`),
  CONSTRAINT `utente_s` FOREIGN KEY (`utente_s`) REFERENCES `utente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studente`
--

LOCK TABLES `studente` WRITE;
/*!40000 ALTER TABLE `studente` DISABLE KEYS */;
INSERT INTO `studente` VALUES (1,21,'via Roma','1','Roma','RM','00100','MRCNNG89L11I872V'),(2,22,'via  Teodoro Mesimerio','1','Spadola','VV','89822','BRBTRS54H60I744L');
/*!40000 ALTER TABLE `studente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `codice_attivaz` char(6) DEFAULT NULL,
  `data_iscrizione` datetime DEFAULT NULL,
  `ultimo_accesso` datetime DEFAULT NULL,
  `stato_account` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (20,'marchese.antoniogiovanni@gmail.com','$2y$10$zJ23fCeURPf5l4KY1nFkw.uid0WT/Uetxy5PoOnm137mhsJGfLtoa','Antonio Giovanni','Marchese','eL6kQ7','2022-10-17 15:34:49','2022-12-03 10:54:10',1),(21,'email@gmail.com','$2y$10$HJQo7tdzsvYmfvOjP5Mzl.Svfaso4G8JC5V6dAS8Y55IKAF.UeEPC','Antonio','Marchese','U1fprE','2022-11-08 10:01:51','2022-11-30 08:43:45',1),(22,'terry54.b@gmail.com','$2y$10$CYPyTizfcTQbRDSlZBZia.k0vQ8PPzxOhWJM6.CJCYJvH5LmEhXWe','Teresa','Barbieri','WyQQvd','2022-11-29 09:12:11','2022-12-03 11:25:00',1);
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-04 17:29:21
