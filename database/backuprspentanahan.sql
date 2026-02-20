/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.3-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dtech
-- ------------------------------------------------------
-- Server version	11.8.3-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `dt01_gen_callback_it`
--

DROP TABLE IF EXISTS `dt01_gen_callback_it`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_callback_it` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `CALLBACK_ID` varchar(36) NOT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`CALLBACK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_callback_it`
--

LOCK TABLES `dt01_gen_callback_it` WRITE;
/*!40000 ALTER TABLE `dt01_gen_callback_it` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_callback_it` VALUES
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','1de75e7e-d38d-453d-9b89-4765d4aa328a','http://localhost/dtechnology/index.php/tilakaV2/registrasi?request_id=ba14c63d-a824-44d8-ba21-c94ece84d367&register_id=ba14c63d-a824-44d8-ba21-c94ece84d367&reason_code=0&status=S','1','6652e626-4438-4bff-aeef-164598310b94','2026-01-15 21:49:21'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','2bc80712-5965-4b86-b888-e2cebec82852','http://localhost/dtechnology/index.php/tilakaV2/registrasi?request_id=ba14c63d-a824-44d8-ba21-c94ece84d367&tilaka_name=pkum02&tilaka-name=pkum02&request-id=ba14c63d-a824-44d8-ba21-c94ece84d367','1','6652e626-4438-4bff-aeef-164598310b94','2026-02-03 23:33:14'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','9073f7f4-bb96-4cf3-9eb7-d3c88941286c','http://localhost/dtechnology/index.php/tilakaV2/registrasi?user_identifier=pkum02&request_id=d5f092d4-2b83-463b-9c44-c691474e8c19&status=Sukses','1','6652e626-4438-4bff-aeef-164598310b94','2026-02-04 13:58:57'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','bbda9c1d-f2c3-47e4-b70d-8598a34abea5','http://localhost/dtechnology/index.php/tilakaV2/registrasi?request_id=31b4cc06-0c8c-4f0a-96ec-a9a428f8b751&register_id=31b4cc06-0c8c-4f0a-96ec-a9a428f8b751&reason_code=0&status=S','1','6652e626-4438-4bff-aeef-164598310b94','2026-01-15 21:34:52');
/*!40000 ALTER TABLE `dt01_gen_callback_it` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_department_ms`
--

DROP TABLE IF EXISTS `dt01_gen_department_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_department_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `DEPARTMENT_ID` varchar(36) NOT NULL,
  `HEADER_ID` varchar(36) DEFAULT NULL,
  `DEPARTMENT` varchar(1000) DEFAULT NULL,
  `JABATAN` varchar(1000) DEFAULT NULL,
  `LEVEL_ID` int(11) DEFAULT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `CODE` varchar(100) DEFAULT NULL,
  `HOLDING` varchar(1) DEFAULT 'N',
  `HEAD_KOORDINATOR` varchar(1) DEFAULT 'N',
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`DEPARTMENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_department_ms`
--

LOCK TABLES `dt01_gen_department_ms` WRITE;
/*!40000 ALTER TABLE `dt01_gen_department_ms` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `dt01_gen_department_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_document_file_dt`
--

DROP TABLE IF EXISTS `dt01_gen_document_file_dt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_document_file_dt` (
  `ORG_ID` varchar(36) NOT NULL,
  `NO_FILE` varchar(100) NOT NULL,
  `FILENAME` varchar(1000) DEFAULT NULL,
  `JENIS_DOC` varchar(10) DEFAULT NULL,
  `ASSIGN` varchar(1000) DEFAULT NULL,
  `STATUS_SIGN` varchar(2) NOT NULL DEFAULT '0' COMMENT '0 : File Not Uploaded / File Belum Di Upload\r\n1 : Files Have Been Uploaded / File Sudah Di Upload\r\n2 : Request Sign Success / Sedang Process Pengajuan Tanda Tangan\r\n3 : Request Sign Gagal / Sedang Process Pengajuan Tanda Tangan\r\n4 : Sign Success / Tanda Tangan Berhasil\r\n5 : Sign Gagal/ Tanda Tangan Berhasil',
  `LINK` varchar(1000) DEFAULT NULL,
  `PASIEN_IDX` varchar(1000) DEFAULT NULL,
  `TRANSAKSI_IDX` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `REQUEST_ID` varchar(36) DEFAULT NULL,
  `NOTE` text DEFAULT NULL,
  `SOURCE_FILE` varchar(255) DEFAULT NULL,
  `STATUS_FILE` varchar(1) DEFAULT '0' COMMENT '0 : File Tidak Ada\r\n1 : File Ada\r\n2 : File Dilakukan Merge',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `USER_IDENTIFIER` varchar(1000) DEFAULT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`NO_FILE`,`ACTIVE`,`CREATED_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_document_file_dt`
--

LOCK TABLES `dt01_gen_document_file_dt` WRITE;
/*!40000 ALTER TABLE `dt01_gen_document_file_dt` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_document_file_dt` VALUES
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','9e4f78a7-7a7f-4b3c-849c-aef385cb9fe4','3d49e7f35e0b4eebaa7e_9e4f78a7-7a7f-4b3c-849c-aef385cb9fe4.pdf','xxx','123456','97',NULL,'Testing 1','Testing 1','1','2026-02-03 23:38:27',NULL,'user_identifier: pkum02 / email: gacrossolohoi-2761@yopmail.com tidak bisa melakukan quicksign','DTECHNOLOGY','1','6652e626-4438-4bff-aeef-164598310b94','pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260205_083924','d41b074ea932438c81cc_RPP20250618000001_20260205_083924.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-05 08:39:25',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260205_085036.pdf','9aa517c7bbdd4d0bbc39_RPP20250618000001_20260205_085036.pdf.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-05 08:50:44',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260205_092335.pdf','38c724cb484746549168_RPP20250618000001_20260205_092335.pdf.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-05 09:24:27',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260205_092921.pdf','9a960905ab154d56a541_RPP20250618000001_20260205_092921.pdf.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-05 09:30:29',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260205_095844','a4ddecb7b84c45309759_RPP20250618000001_20260205_095844.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-05 09:58:51',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260206_114857','19a3b1818e0e4cf5ab81_RPP20250618000001_20260206_114857.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-06 11:49:01',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260207_150606.pdf','aa6a210590944066923b_RPP20250618000001_20260207_150606.pdf.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-07 15:06:15',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260207_151256.pdf','492d6828059c4385a208_RPP20250618000001_20260207_151256.pdf.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-07 15:13:00',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','RPP20250618000001_20260207_153538','5faf4d71efba4e028ca0_RPP20250618000001_20260207_153538.pdf','rekam_medi','123456','97',NULL,'No.Rawat: 2025/06/18/000001','No.Rawat: 2025/06/18/000001','1','2026-02-07 15:35:43',NULL,'Kuota tanda tangan sudah habis atau tidak cukup untuk requestsign ini','DTECHNOLOGY','1',NULL,'pkum02',NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','Testing File',NULL,'xxx','123456','0',NULL,'Note 1','Note 1','1','2026-02-04 15:05:13',NULL,'Error uploading file','DTECHNOLOGY','1',NULL,NULL,NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','Testing File',NULL,'xxx','123456','0',NULL,'Note 1','Note 1','1','2026-02-05 09:50:34',NULL,'Error uploading file','DTECHNOLOGY','1',NULL,NULL,NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','Testing File',NULL,'xxx','123456','0',NULL,'Note 1','Note 1','1','2026-02-05 09:50:36',NULL,'Error uploading file','DTECHNOLOGY','1',NULL,NULL,NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','Testing File',NULL,'xxx','123456','0',NULL,'Note 1','Note 1','1','2026-02-05 09:50:37',NULL,'Error uploading file','DTECHNOLOGY','1',NULL,NULL,NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','Testing File',NULL,'xxx','123456','0',NULL,'Note 1','Note 1','1','2026-02-05 09:50:38',NULL,'Error uploading file','DTECHNOLOGY','1',NULL,NULL,NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','Testing File',NULL,'xxx','123456','0',NULL,'Note 1','Note 1','1','2026-02-05 09:50:39',NULL,'Error uploading file','DTECHNOLOGY','1',NULL,NULL,NULL),
('b12234f2-b27e-4920-a935-2077fa4783d8','Testing_File',NULL,'xxx','123456','0',NULL,'Note 1','Note 1','1','2026-02-04 14:07:15',NULL,'Error uploading file','DTECHNOLOGY','1',NULL,NULL,NULL);
/*!40000 ALTER TABLE `dt01_gen_document_file_dt` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_document_ms`
--

DROP TABLE IF EXISTS `dt01_gen_document_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_document_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `JENIS_DOC` varchar(10) NOT NULL,
  `DOCUMENT_NAME` varchar(100) DEFAULT NULL,
  `JENIS_ID` varchar(1) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`JENIS_DOC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_document_ms`
--

LOCK TABLES `dt01_gen_document_ms` WRITE;
/*!40000 ALTER TABLE `dt01_gen_document_ms` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_document_ms` VALUES
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','xxx','Testing Type Document','1','1','55b16625-efca-4093-8df0-20fc838f21b1','2025-03-14 22:06:13');
/*!40000 ALTER TABLE `dt01_gen_document_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_enviroment_ms`
--

DROP TABLE IF EXISTS `dt01_gen_enviroment_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_enviroment_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `ENV_ID` varchar(36) NOT NULL,
  `ENVIRONMENT_NAME` varchar(1000) NOT NULL,
  `DEV` varchar(1000) DEFAULT NULL,
  `PROD` varchar(1000) DEFAULT NULL,
  `JENIS` varchar(1) DEFAULT '0',
  `URUT` int(11) DEFAULT 0,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ENV_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_enviroment_ms`
--

LOCK TABLES `dt01_gen_enviroment_ms` WRITE;
/*!40000 ALTER TABLE `dt01_gen_enviroment_ms` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_enviroment_ms` VALUES
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','0a9b8755-68ff-410f-aa9d-721d07f15c4a','WA_GATEWAY','http://192.168.102.13:5001','http://192.168.102.13:5001','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','2621c461-0ecf-491e-8495-99166b904b2d','END_VALID_ACTIVITY','5','7','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','3494fa6b-f012-4c40-8cae-70ab8a398b89','KEY_EKLAIM','af88024790f81eb9fafb3266bf0aae2c38f01f06b0f437ab2dac6686ecbd427f','af88024790f81eb9fafb3266bf0aae2c38f01f06b0f437ab2dac6686ecbd427f','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','3fa57f8f-e17e-4491-a935-fd5454c541e4','CHECK_DATA_HOLDING','FALSE','FALSE','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2025-12-04 07:37:55'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','4b57850c-0445-4b5a-b397-57a09479f0bd','CLIENTID_SATUSEHAT','wYiLSpaT4s7GR24ZqGvC1iyG2GBDZeYGEYvDeonE750ahy8h','wYiLSpaT4s7GR24ZqGvC1iyG2GBDZeYGEYvDeonE750ahy8h','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','4cf1de59-1805-4649-bfd9-054b067d527d','CLIENT_ID_TILAKA','e2532b39-0c33-49dc-a934-72ada8c3f40a','4017c5fa-4a35-4806-adef-8fa9a5b98247','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','4cf2982c-8906-43d4-8a69-bca58f0cbdf0','SERVER_EKLAIM','http://192.168.56.101/','http://192.168.56.101/','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','4f07a29b-f73b-4c9a-8900-da9a7d716524','MAX_VALUE_ASSESSMENT','30','60','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','53958b2a-6f73-4e4f-9703-40b64959d755','CLIENT_SECRET_TILAKA','DZ8jl8k36aeLYe9ATezLDu1e8F8C0QE3','tbjJkNbgaSg7NpQgXVtmBR7hb3vtyEYN','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','573a2b21-138b-4bcf-87a0-33ed3db1a574','AUTHURL_SATUSEHAT','https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1','https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','5a9bc4e9-77f9-441d-8e69-2785a7e147f8','TILAKA_BASE_URL','https://api.tilaka.id/','https://sb-api.tilaka.id/','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','678bb734-3849-4a84-8c1b-3526c6029f95','TILAKALITE_URL','http://10.10.11.253:8088/','http://192.168.2.52:8088/','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','67aeb868-636b-4e86-9cc1-690bbba5216d','PATHFILE_POST_TILAKA','/assets/document','http://10.10.11.250/webappsagus/berkasrawat/pages/upload/','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','6938614d-276b-4161-a470-32156c1e3980','PATHFILE_GET_TILAKA','Z:document','http://10.10.11.250/webappsagus/berkasrawat/pages/upload/','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','69723f27-ec38-4d73-920f-b51b6a2c444b','CERTIFICATE','PERSONAL','CORPORATE','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','6ac2fbad-c514-4fcd-813d-b4845a5a5999','MIDDLEWARE_NOTIFICATION','TRUE','TRUE','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2025-07-09 09:45:37'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','6bba06d0-4387-4585-95d1-42f3cbd6d682','END_VALID_ASSESSMENT','2','7','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','7b31610f-f3de-4dde-86b6-6c22e8a2f309','COORDINATE_X','26','60','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','8385c7e8-a501-4495-a99e-6ffc6f30bb53','PARTNERS','1','','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','89ab97b9-c675-4e51-a292-14619aa6aa5d','SIGNATUREIMAGES','DEFAULT','FLEXIBLE','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','90ff66de-ace0-491d-9843-74f8b7d57886','CLIENTSECRET_SATUSEHAT','dcBZIfHwKr81OivmudeTJr8411fTJSFRikeNdniISGZ9GrXAvHpsjQlrkumHBXiC','dcBZIfHwKr81OivmudeTJr8411fTJSFRikeNdniISGZ9GrXAvHpsjQlrkumHBXiC','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','a7a2ef53-c1df-4911-9e02-f4bebfa9e4ee','COORDINATE_Y','24','20','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','ae4ade89-db55-4d46-a7e9-25ceeeb56a50','MAX_VALUE_ACTIVITY','70','40','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','b0034df2-52e3-4467-9b9f-f42359891bf4','BASE_URL','http://192.168.102.13/dtechnology/index.php','http://192.168.102.13/dtechnology/index.php','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','b61b421d-b824-41a5-ad14-a4c412e4e11e','HEIGHT','30','62','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','c1be4e4f-9674-4ab5-bf9d-d6ac9707aaf7','POSITIONSIGN','DEFAULT','TAG','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','c952ea22-ef19-4aa6-9a11-0b639cdb9dbc','ORG_ID','be3d71bc-484e-4971-9590-e31e10516c25','be3d71bc-484e-4971-9590-e31e10516c25','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 10:25:12'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','d1f96ded-4df9-4c4a-9b28-14814d91e392','PATHFILE_POST_DTECH','\\\\192.168.102.50\\nas\\document\\','\\\\192.168.102.50\\nas\\document\\','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','dd94948b-d9c2-4acb-a0b9-e4258b213337','SATUSEHAT_BASE_URL','https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1','https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','dfefa28c-c03a-425c-9557-ebb6d37ba4ee','WIDTH','40','62','1',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','e847ce7a-835f-4a9a-a163-1f9e874497a0','START_VALID_ASSESSMENT','1','1','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18'),
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','fda0e07a-f1f9-4a7e-9b7f-5b2501dd5e8d','PAGE','1','1','0',0,'1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-26 09:21:18');
/*!40000 ALTER TABLE `dt01_gen_enviroment_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_master_ms`
--

DROP TABLE IF EXISTS `dt01_gen_master_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_master_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `MASTER_ID` varchar(36) NOT NULL,
  `CODE` varchar(100) DEFAULT NULL,
  `MASTER_NAME` varchar(1000) DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `COLOR` varchar(100) DEFAULT NULL,
  `ICON` varchar(100) DEFAULT NULL,
  `JENIS_ID` varchar(100) DEFAULT NULL,
  `URUT` int(11) DEFAULT 0,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`MASTER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_master_ms`
--

LOCK TABLES `dt01_gen_master_ms` WRITE;
/*!40000 ALTER TABLE `dt01_gen_master_ms` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_master_ms` VALUES
('be3d71bc-484e-4971-9590-e31e10516c25','0998f038-ea8b-42b8-a7c4-77bfd3d43bb4','2','Request Sign','Waiting Signing User','info','','Statussign_1',2,'1','55b16625-efca-4093-8df0-20fc838f21b1','2025-01-03 21:34:16'),
('be3d71bc-484e-4971-9590-e31e10516c25','0edaebdc-578a-4da8-bd0e-6983290c68f4','1','Upload File','Waiting Request Sign','info','','Statussign_1',2,'1','55b16625-efca-4093-8df0-20fc838f21b1','2025-01-03 21:34:16'),
('be3d71bc-484e-4971-9590-e31e10516c25','21ae6cfe-b859-485b-8f5f-6715b3704e61','99','Failed Process','Please Check Response','danger','','Statussign_1',2,'1','55b16625-efca-4093-8df0-20fc838f21b1','2025-01-03 21:34:16'),
('be3d71bc-484e-4971-9590-e31e10516c25','43fca9ab-d42c-45a9-a7a4-a4fe29ca630f','98','Software','','info','','Statussign_1',2,'1','55b16625-efca-4093-8df0-20fc838f21b1','2025-01-03 21:34:16'),
('be3d71bc-484e-4971-9590-e31e10516c25','76548dc0-9aa9-4ab1-9d31-858f08aced4f','4','Process Download','Waiting Download','info','','Statussign_1',2,'1','55b16625-efca-4093-8df0-20fc838f21b1','2025-01-03 21:34:16'),
('be3d71bc-484e-4971-9590-e31e10516c25','78be5ec4-358b-47c7-9c12-2d27b555989b','3','File In Process','Waiting Process','success','','Statussign_1',2,'1','55b16625-efca-4093-8df0-20fc838f21b1','2025-01-03 21:34:16'),
('be3d71bc-484e-4971-9590-e31e10516c25','7ccbcea0-895a-4e78-b179-cc64e9879fa6','0','New Document','Waiting Upload Tilaka Lite','warning','','Statussign_1',2,'1','55b16625-efca-4093-8df0-20fc838f21b1','2025-01-03 21:34:16'),
('be3d71bc-484e-4971-9590-e31e10516c25','f5eeac74-cdaf-4868-817e-574c98e755a1','5','Finish','Document Available','success','','Statussign_1',2,'1','55b16625-efca-4093-8df0-20fc838f21b1','2025-01-03 21:34:16');
/*!40000 ALTER TABLE `dt01_gen_master_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_modules_ms`
--

DROP TABLE IF EXISTS `dt01_gen_modules_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_modules_ms` (
  `MODULES_ID` varchar(36) NOT NULL,
  `MODULES_NAME` varchar(100) NOT NULL,
  `VERSION` varchar(100) NOT NULL,
  `MODULES_HEADER_ID` varchar(36) NOT NULL,
  `PACKAGE` varchar(100) NOT NULL,
  `DEF_CONTROLLER` varchar(100) NOT NULL,
  `PARENT` varchar(1) NOT NULL DEFAULT 'N',
  `ICON` varchar(500) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '0',
  `URUT` int(11) NOT NULL DEFAULT 0,
  `QUICK` varchar(1) DEFAULT 'N',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`MODULES_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_modules_ms`
--

LOCK TABLES `dt01_gen_modules_ms` WRITE;
/*!40000 ALTER TABLE `dt01_gen_modules_ms` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_modules_ms` VALUES
('01b1b52a-7d47-4352-b145-37d9bb2646c3','Tilaka','','45304d5b-390d-4618-a08d-793b475f37b7','tilaka','','Y','bi bi-filetype-pdf','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('029f2730-7ee9-4383-a409-4b5fe0d61fcc','Request','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','request','N','bi bi-file-earmark-spreadsheet','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('039076f7-393b-4079-b65e-08a8eb673970','Master Suppliers','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','mastersuppliers','N','bi bi-database-add','0',10,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('04dec2e8-317f-419d-8c38-61b23616e272','Akreditasi RS','','a894d7ed-a10e-4359-804e-8223fde34bbd','akreditasi','','Y','bi bi-layers','0',998,'N','1','','2024-04-29 23:10:27'),
('04ee7f51-5847-4099-9d70-7b4f4d9a989c','Environment','','6c105bb7-633d-4f59-b0d0-37b6dcc59bb7','operation','environment','N','bi bi-layers','0',6,'N','1','','2024-04-29 23:10:27'),
('04fb4f1f-0728-46cf-8a81-4b951687b44c','Overview','','f56a43c9-f28d-4230-a0ce-7bf5cd86f2df','support','overview','N','bi bi-question-octagon','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('0502bd27-48bf-4d6a-86f0-f7fbe482e9e9','Simulasi Unit Cost','','cda2e6e6-99f8-415d-b52b-320b51b0028a','unitcost','unitcost','N','bi-journal-bookmark','0',1,'Y','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('06901f1c-9a61-46d0-9ace-f01c20635b4b','Buku Dagang','','cda2e6e6-99f8-415d-b52b-320b51b0028a','bukudagang','bukudagang','N','bi-journal-bookmark','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('07eab05f-be52-45ce-8a53-8dd69df443f4','User List','','8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614','mastersystem','user','N','bi-people','0',1,'N','9','','2024-04-29 23:10:27'),
('084bfaa9-8dda-4c7f-a54e-882496b77866','Repository Document','','c820e1c6-18d9-4ab1-9fc1-df6e57a6f484','bsre','repodocument','N','bi bi-archive','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('09939c62-e760-4858-ab0c-81640ccfece0','Piutang','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','','Y','bi bi-layers','0',6,'N','1','','2024-04-29 23:10:27'),
('0c00c0bb-a973-4d30-84b7-ed486a839431','Payment','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','payment','N','bi bi-cash-coin','0',10,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('0f614e4d-26f8-4bc2-a58f-2cb974dce6d0','Piutang Lainnya','','09939c62-e760-4858-ab0c-81640ccfece0','sb','piutangbpjs','N','bi-wallet2','0',5,'N','1','','2024-04-29 23:10:27'),
('0fa18822-c902-4e86-9878-4e7822c4ed77','Director Approval','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvaldirector','N','bi bi-ui-checks','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('0fc5b5fd-f7bd-4139-8568-c5187c5e6539','Import Data','','8ff4efe7-c59a-4e50-8665-cac5174e9ee4','assets','importdata','N','bi-file-earmark-text','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('1048ed1d-fef4-4e19-9df3-21c5fdec338f','Meeting','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','meeting','N','fa-solid fa-handshake','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('113cf5a2-ff11-4091-99d5-afb1c525b23d','Training','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','training','N','bi bi-bookmark-star-fill','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('1226a31c-fe9d-4102-9750-a4571a08a8b5','Setting','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','setting','N','bi bi-gear','0',8,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('123f022c-72ae-401b-9144-624dad3a906a','Years','','ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a','monev','kunjunganyears','N','bi bi-layers','0',3,'N','1','','2024-04-29 23:10:27'),
('1493764d-621d-404e-a5f4-fec983fba347','Risk Management','','a894d7ed-a10e-4359-804e-8223fde34bbd','risk','','Y','bi bi-layers','0',998,'N','1','','2024-04-29 23:10:27'),
('15631583-ee35-4d29-9815-b868148c39d7','Reserve','','45689c70-720c-4b4b-b757-f7f1fc80ad47','ok','reserve','N','bi bi-calendar-plus','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('171a2550-9fa1-4fe8-84c3-7b61b7cc2c55','Sign Document','','01b1b52a-7d47-4352-b145-37d9bb2646c3','tilaka','signdocument','N','bi bi-vector-pen','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('186c47fa-906d-410d-b41c-355eb52e7d10','Document','','8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614','mastersystem','document','N','bi-file-earmark-text','0',1,'N','1','','2024-04-29 23:10:27'),
('18fe701d-5240-4a47-9b4e-8413a1cb2d7c','Panduan Praktek Klinis','','73917c12-47af-4672-b57a-45b8cffb8e4e','casemix','masterppk','N','i bi-cloud-arrow-up','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('1d1d4319-e834-4876-87a9-f3148e17514a','Daily','','ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a','monev','kunjungandaily','N','bi bi-layers','0',1,'N','1','','2024-04-29 23:10:27'),
('1d64cd6c-a3d8-4b27-8eb3-b0526c7c0a59','CFO Approval','','92525e76-d778-43c8-945b-f2b4bf192627','paymentponew','paymentcfo','N','bi bi-person-check','0',7,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('1eebee7e-a774-4572-a660-8ab49f6a734a','Dashboard','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','dashboard','dashboard','N','bi bi-grid','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('2306f09a-42b9-4b2e-8ea4-4b3cbe830fe3','Import ASPAK SARANA','','8ff4efe7-c59a-4e50-8665-cac5174e9ee4','assets','importaspaksarana','N','bi-file-earmark-text','0',2,'Y','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('2352e62f-8145-4895-a130-9973e021961d','Goods Receipt','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','penerimaanbarang','N','bi bi-ui-checks','0',10,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('266ad13d-4096-4e9b-a1b4-46b46eff0a6c','Employee','','4ca01133-e004-428d-bc56-4e9e2dbdbbd6','hrd','employee','N','bi bi-person-badge','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:31:40'),
('266bd8f2-8e09-404b-985e-0196c14218fa','Human Resource','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','hrd','','Y','bi bi-people','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('28f66f08-643f-4808-9eca-956a43889705','Income','','cda2e6e6-99f8-415d-b52b-320b51b0028a','report','','Y','fa-solid fa-money-bill-trend-up','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('2980ec1e-cdbc-4e8c-a000-78cbdacabb34','Meeting','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','meeting','schedulemeeting','N','fa-solid fa-handshake','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('2acf8f9e-9143-4089-b4af-4da2aa25dab6','Master Item','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','masterbarang','N','bi bi-database-add','0',10,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('2b3eeae4-dbca-4acb-be9a-d434f15cd','Tickets List','','f56a43c9-f28d-4230-a0ce-7bf5cd86f2df','support','eticketlist','N','bi bi-question-octagon','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('2d595ebf-2f7c-4746-b4ec-fdfc0dec29e6','Grouping iDRG','','73917c12-47af-4672-b57a-45b8cffb8e4e','casemix','groupingidrg','N','bi-archive','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('2f7dcd72-126e-44e0-a777-4e5aaaaf65cf','Complaint Instalasi','','bc12409b-555f-4bc5-abff-39de931a3b24','crm','handlinginstalasi','N','bi-person-rolodex','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('32c77b91-425e-48fe-b7fc-8d6fce762bd1','Chief Medical Officer','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvalcmo','N','bi bi-ui-checks','0',10,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('3305ffa5-cf74-4201-ba82-06778d0fd10e','Surat Menyurat','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','surat','','Y','bi bi-envelope-paper','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('337a0c78-4b48-482c-a24e-d60d5d6fc2d4','Cash Advance','','cda2e6e6-99f8-415d-b52b-320b51b0028a','pettycash','','Y','fa-solid fa-money-bill-trend-up','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('33ecb1e0-a8f2-47ed-8919-3c4bd057abf1','Manager Approval','','337a0c78-4b48-482c-a24e-d60d5d6fc2d4','pettycash','pettycashmanager','N','fa-solid fa-money-bill-trend-up','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('351be4d9-c967-4d44-a1e6-171a98eec8cc','Director Approval','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','appdirector','N','bi bi-ui-checks','0',7,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('35e888f3-2365-41ff-8d77-26cbffbb4d4b','Location','','8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614','mastersystem','location','N','bi bi-geo-alt','0',3,'N','9','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('361f2f6f-ab8c-4abe-827e-985d40f04f31','Activity','','4ca01133-e004-428d-bc56-4e9e2dbdbbd6','hrd','activity','N','bi bi-person-badge','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:31:40'),
('369829a1-0c08-4672-a98a-b4bb20c03a87','Simulasi Claim iDRG','','73917c12-47af-4672-b57a-45b8cffb8e4e','casemix','claimidrg','N','i bi-cloud-arrow-up','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('381292cf-8f11-4b9d-a7ab-0975ca73d6c9','Visual Grafik','','682c463e-6e88-42fd-8b84-62cc47182405','mutu','grafik','N','bi-bar-chart-line','0',1,'N','1','','2024-04-29 23:10:27'),
('38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','Logistic 2.0.0.0','2.0.0.0','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','logistiknew','','Y','bi bi-box','0',7,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('38eab206-952d-4f00-8ef6-f683526ebd9e','Finance Approval','','d7ca1a2b-e684-4b50-824d-50540afaa994','paymentpo','paymentfinance','N','bi bi-patch-plus','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('39425516-e7b9-42f9-b23b-02bf04bae967','Vice Director Approval','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','appvice','N','bi bi-ui-checks','0',6,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('39f6caf9-433f-4266-b6bf-20b8451b5b3c','Director Approval','','92525e76-d778-43c8-945b-f2b4bf192627','paymentponew','paymentdirector','N','bi bi-person-check','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('3d143838-e2e4-4d31-99a7-af6f1dca434d','Activity','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','kpi','activity','N','bi bi-calendar3','0',3,'Y','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('3ed94f2b-9bca-41d4-b2dd-306d36bdefdb','Coordinator Approval','','92525e76-d778-43c8-945b-f2b4bf192627','paymentponew','paymentcoordinator','N','bi bi-person-check','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('41d5b303-d4e8-4197-af7b-14a00e070236','Vice Director Approval','','92525e76-d778-43c8-945b-f2b4bf192627','paymentponew','paymentvice','N','bi-person-check','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('43aff7d4-245c-4e5c-8433-cf173ca745fb','Finance Approval','','337a0c78-4b48-482c-a24e-d60d5d6fc2d4','pettycash','pettycashfinance','N','bi bi-patch-plus','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('445c4e53-96b5-4f04-b7d9-60cc6ae88fe1','Registration','','8a89a915-4ec5-41e7-b55c-a357ff7e5e45','admission','registration','N','fa-solid fa-building-circle-check','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('45304d5b-390d-4618-a08d-793b475f37b7','Bridging System','','','','','C','','0',997,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('45689c70-720c-4b4b-b757-f7f1fc80ad47','Operating Room','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','ok','','Y','fa-solid fa-bed-pulse','0',10,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('4610c39b-de32-450b-812d-db8c37fcc643','Repository Document','','01b1b52a-7d47-4352-b145-37d9bb2646c3','tilaka','repodocument','N','bi bi-archive','0',2,'N','9','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('46ea998e-6d8d-4aaa-9709-a3cb26268995','Chief Pharmacist Officer','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvalcpo','N','bi bi-ui-checks','0',6,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('47b4877d-7fdf-41de-a2ec-c6f467250478','Clinical Auth','','635e52ec-e7d3-4a67-9616-fdadd0eceb61','komiteperawat','clinicalauth','N','bi bi-people','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('49e22574-cb55-450f-9d47-6b895b2caed3','Modules','','988c76dd-f5d3-4aca-bea2-1249f980bfc9','masterroot','mastermodules','N','bi bi-code-slash','0',0,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('4a0e79e8-e219-49a5-bfc4-70d2c9368bc0','Session Whatsapp','','be411246-2878-4dba-b320-554e78749094','whatsapp','sessionwhatsapp','N','bi bi-box-arrow-in-right','0',5,'N','1','','2024-04-29 23:10:27'),
('4b005992-9db9-45ff-a44a-507a11392603','Coordinator Approval','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvalkoordinator','N','bi bi-ui-checks','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('4ca01133-e004-428d-bc56-4e9e2dbdbbd6','Master System','','266bd8f2-8e09-404b-985e-0196c14218fa','hrd','','Y','bi bi-database-fill','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('50e11dfd-7c94-4f7e-a66b-347b7e506fe5','Manager Approval','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','appmanager','N','bi bi-patch-plus','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('510acdce-1c9c-49ab-8f91-fc8a77fc4dc4','Registrasi','','01b1b52a-7d47-4352-b145-37d9bb2646c3','tilaka','registrasi','N','bi bi-people','0',1,'N','9','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('5174bbc4-245d-40cc-91de-b5ec0963bcdf','Summary','','78e83b81-6a97-4037-aaa3-ba964365c43c','piutang','summary','N','bi-file-earmark-medical','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('5324920b-b8e8-4a30-8cd7-a609b5905a71','Request','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','request','N','bi bi-file-earmark-spreadsheet','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('55df0fd0-271f-47ad-9e6f-f32cc2005d40','Calendar','','45689c70-720c-4b4b-b757-f7f1fc80ad47','ok','calendar','N','bi bi-calendar3','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('56f6fcfd-ece1-493f-80f3-1948fe769fbd','Procurement','','a894d7ed-a10e-4359-804e-8223fde34bbd','monevpo','monpo','N','bi bi-layers','0',0,'N','1','','2024-04-29 23:10:27'),
('589cf172-5ae7-4793-aa9e-f6ffe9c0e374','Forecasting','','b23033e4-2079-44e0-89b0-c26a45c74802','farmasi','forecasting','N','bi bi-graph-up','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('5a5c9286-bdcf-4e39-8c45-169dc334317c','Finance Approval','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvalfinance','N','bi bi-ui-checks','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('5e882da7-5b62-4031-8ea2-a849d1e0aa65','Repository Document','','df495870-8f19-41a1-943e-5d36ea0553db','tilakaV2','repodocument','N','bi bi-archive','0',2,'D','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('5e9a1b26-93fe-4dbc-af0e-2967710e4483','Role List','','8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614','mastersystem','role','N','bi-person-badge','0',2,'N','1','','2024-04-29 23:10:27'),
('6329ddd6-a27c-427c-bd82-2ee278145a01','Piutang','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','piutangsum','N','bi-box-arrow-in-down','0',10,'N','1','','2024-04-29 23:10:27'),
('635e52ec-e7d3-4a67-9616-fdadd0eceb61','Nurse/Midwife Committee','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','komiteperawat','','Y','fa-solid fa-user-nurse','0',6,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('65e39b7b-a4ee-4045-a6f0-73667f5026d8','Daily','','cda2e6e6-99f8-415d-b52b-320b51b0028a','report','daily','N','fa-solid fa-money-bill-trend-up','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('67075482-7943-4031-bb64-bd22997e5b3e','Sign Document','','df495870-8f19-41a1-943e-5d36ea0553db','tilakaV2','signdocument','N','bi bi-vector-pen','0',3,'N','9','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('68228796-8ea0-4b51-9fef-f9ba7a365f3e','Payroll','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','payroll','','N','bi bi-cash-stack','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('682c463e-6e88-42fd-8b84-62cc47182405','Indikator Mutu','','a894d7ed-a10e-4359-804e-8223fde34bbd','mutu','','Y','bi bi-layers','0',998,'N','1','','2024-04-29 23:10:27'),
('687b3adc-f1ad-4849-8bef-ee2121faddcc','Submission','','337a0c78-4b48-482c-a24e-d60d5d6fc2d4','pettycash','pettycashit','N','fa-solid fa-money-bill-trend-up','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('6a3b9836-1cc2-4b8a-ba2f-a5dad734412c','Rawat Jalan','','825a61cb-a0ba-4e96-8dd8-6a93bc938ec2','monevfarmasi','rawatjalan','N','bi bi-layers','0',1,'N','1','','2024-04-29 23:10:27'),
('6a46e562-67e5-43e9-bbce-e2a6fd0927b4','Provider','','8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614','mastersystem','provider','N','bi-building','0',1,'N','9','','2024-04-29 23:10:27'),
('6c105bb7-633d-4f59-b0d0-37b6dcc59bb7','IT Operation','','','','','C','','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('6e7b2a67-7d3e-4149-8a1b-4ac778d0881e','Schedule Shift','','266bd8f2-8e09-404b-985e-0196c14218fa','hrd','shift','N','bi bi-speedometer2','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('6f16eda7-a88e-4ee2-a29c-cc4eeef7ebc2','Trend Kunjungan','','bc12409b-555f-4bc5-abff-39de931a3b24','crm','kunjungan','N','bi bi-graph-up','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('7111d133-d00a-4eda-8094-8bcceb227664','Director Approval','','d7ca1a2b-e684-4b50-824d-50540afaa994','paymentpo','paymentdirector','N','bi bi-patch-plus','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('71dfb7c2-4abf-4f93-b989-7d78f255a074','Registrasi','','df495870-8f19-41a1-943e-5d36ea0553db','tilakaV2','registrasi','N','bi bi-people','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('72fd278b-75dd-4a48-b435-f7efb996969b','Indikator Unit','','682c463e-6e88-42fd-8b84-62cc47182405','mutu','indikatorunit','N','bi-bar-chart-line','0',1,'N','1','','2024-04-29 23:10:27'),
('7320e775-9948-444e-b068-8e69745e77ab','Anamnesa Rawat Jalan','','635e52ec-e7d3-4a67-9616-fdadd0eceb61','komiteperawat','anamnesarj','N','bi bi-people','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('73917c12-47af-4672-b57a-45b8cffb8e4e','Casemix','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','casemix','','Y','bi bi-person-raised-hand','0',11,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('73a00c77-2213-4317-8249-b9c668dafec5','Visual Grafik','','a0803958-f45b-4857-8125-34e5aec072a1','po','grafik','N','bi-bar-chart-line','0',1,'N','1','','2024-04-29 23:10:27'),
('746012a8-b265-45d6-8f37-3b44f0134a5d','Mutasi Rekening','','cda2e6e6-99f8-415d-b52b-320b51b0028a','rekening','mutasi','N','bi bi-journal-text','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('77893ebe-697b-4a04-a158-5387c98a0041','Attachment Claim','','73917c12-47af-4672-b57a-45b8cffb8e4e','casemix','attachmentclaim','N','bi bi-question-octagon','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('78d3e701-b660-4ea5-abb8-c935d1387e2d','FAQ','','f56a43c9-f28d-4230-a0ce-7bf5cd86f2df','support','faq','N','bi bi-question-octagon','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('78e83b81-6a97-4037-aaa3-ba964365c43c','Piutang','','cda2e6e6-99f8-415d-b52b-320b51b0028a','piutang','','Y','bi-wallet2','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d','Master Client','','988c76dd-f5d3-4aca-bea2-1249f980bfc9','masterroot','masterclient','N','bi bi-database-fill','0',0,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:59:33'),
('790fa060-ce1a-4819-aee5-89f71d23af32','Detail Pendapatan','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','detailpendapatan','N','bi-cash-stack','0',2,'N','1','','2024-04-29 23:10:27'),
('7bbea57e-90f9-4443-a040-eccb68adf3d3','Details Of Clinical Authority','','635e52ec-e7d3-4a67-9616-fdadd0eceb61','komiteperawat','details','N','bi bi-people','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('7c69522f-cebf-4377-945a-3324b0a26baa','Developer','','','','','C','','0',999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('7e0b2ac1-cdac-4eee-8392-fa92e227fa2c','Template Design','','988c76dd-f5d3-4aca-bea2-1249f980bfc9','masterroot','templatedev','N','bi bi-compass','0',999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:25:26'),
('7fbc53be-5182-4868-9051-bd0fead47b5e','Request Payment','','92525e76-d778-43c8-945b-f2b4bf192627','paymentponew','paymentrequest','N','bi bi-receipt','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('8004f8a1-e87b-4440-8421-db2f1e0fe1bb','Asuransi','','78e83b81-6a97-4037-aaa3-ba964365c43c','piutang','asuransi','N','bi-file-earmark-medical','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('8145d693-aa4c-4303-916c-d6bd6eac9d2d','Piutang BPJS','','09939c62-e760-4858-ab0c-81640ccfece0','sb','piutangbpjs','N','bi-file-earmark-medical','0',2,'N','1','','2024-04-29 23:10:27'),
('8153a09f-882f-4922-bd38-2d6b0e66d997','Self Assessment','','04dec2e8-317f-419d-8c38-61b23616e272','akreditasi','selfassessment','N','bi-bar-chart-line','0',1,'N','1','','2024-04-29 23:10:27'),
('825a61cb-a0ba-4e96-8dd8-6a93bc938ec2','Farmasi','','a894d7ed-a10e-4359-804e-8223fde34bbd','monevfarmasi','','Y','bi bi-layers','0',998,'N','1','','2024-04-29 23:10:27'),
('842e2951-3e7b-4d46-adc4-899ae8dc215b','Chief Medical Device','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvalcmd','N','bi bi-ui-checks','0',7,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('868afde4-08e8-4899-b596-301c1bae2258','Service API','','6c105bb7-633d-4f59-b0d0-37b6dcc59bb7','operation','logservice','N','bi bi-layers','0',5,'N','1','','2024-04-29 23:10:27'),
('8961b50e-6274-49de-a0b2-203e2139f5c4','Upload Claim','','73917c12-47af-4672-b57a-45b8cffb8e4e','casemix','uploadclaim','N','i bi-cloud-arrow-up','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('8a89a915-4ec5-41e7-b55c-a357ff7e5e45','Admission InPatient','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','admission','','Y','fa-solid fa-building-circle-check','0',9,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('8ace90ab-ffeb-49ab-a9ce-9dbf1d9b99d3','Indikasi Fragmentasi','','73917c12-47af-4672-b57a-45b8cffb8e4e','casemix','fragmentasi','N','bi bi-question-octagon','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('8b5e1a58-998a-405e-aa30-ece15e455973','History','','','','','A','bi bi-clock-history','0',997,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('8c9136b3-7e71-41b0-ba29-8856fd434a17','View Tickets','','f56a43c9-f28d-4230-a0ce-7bf5cd86f2df','support','eticketview','N','bi bi-question-octagon','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('8f476463-92c6-42e4-a6fb-4678a1354542','Handling Complaint','','bc12409b-555f-4bc5-abff-39de931a3b24','crm','handling','N','bi bi-exclamation-circle-fill','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614','Master System','','6c105bb7-633d-4f59-b0d0-37b6dcc59bb7','mastersystem','','Y','bi bi-database-fill','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('8ff4efe7-c59a-4e50-8665-cac5174e9ee4','Assets','','cda2e6e6-99f8-415d-b52b-320b51b0028a','assets','','Y','bi-collection','0',12,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('92525e76-d778-43c8-945b-f2b4bf192627','Payment Procurement','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','paymentponew','','Y','bi bi-wallet2','0',8,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('938f304c-fb90-49e8-a85d-4c3340b325d5','Document Legal','','ee9b62a0-72f3-42a9-af3f-3faadca592df','document','documentlegal','N','bi bi-person-raised-hand','0',999999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('951544df-6ad1-482d-89e0-4bd3d348e215','User Access','','6c105bb7-633d-4f59-b0d0-37b6dcc59bb7','operation','useraccess','N','bi bi-layers','0',1,'N','1','','2024-04-29 23:10:27'),
('959f12c0-0fd7-42c2-ad45-9905afae026b','Chief Technology Officer','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvalcto','N','bi bi-ui-checks','0',8,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('95b76da7-5f06-4bcf-b7c5-1db3c29bd743','Finance Approval','','92525e76-d778-43c8-945b-f2b4bf192627','paymentponew','paymentfinance','N','bi bi-cash-stack','0',6,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('97ec06dd-7c5b-41ad-bdc5-f6b9bc04d826','Status','','a0803958-f45b-4857-8125-34e5aec072a1','po','status','N','bi-journal-minus','0',5,'N','1','','2024-04-29 23:10:27'),
('988c76dd-f5d3-4aca-bea2-1249f980bfc9','Master Root System','','7c69522f-cebf-4377-945a-3324b0a26baa','masterroot','','Y','bi bi-database-fill','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:59:33'),
('990e096c-bb43-45ed-b15d-5d4c9639fbc8','MCU','','78e83b81-6a97-4037-aaa3-ba964365c43c','piutang','mcu','N','bi-heart-pulse','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('99d2e39c-89a0-48bc-9117-2770c2d65caa','SPK','','635e52ec-e7d3-4a67-9616-fdadd0eceb61','komiteperawat','','N','bi bi-people','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('99df9a77-d5a1-48b1-b3b5-a771ded109bf','Request Payment','','d7ca1a2b-e684-4b50-824d-50540afaa994','paymentpo','paymentrequest','N','bi bi-receipt','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('9a1cc085-6cc0-40ee-85fc-849357638db3','SmartBoard','','a894d7ed-a10e-4359-804e-8223fde34bbd','sb','','Y','bi bi-layers','0',998,'N','1','','2024-04-29 23:10:27'),
('9b873e90-d8fd-48f3-8c98-ec2aff0c207f','Apps','','','','','C','','0',1,'N','0','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('9ba71b79-b3dc-41f3-810d-016524a87fdc','Register','','45689c70-720c-4b4b-b757-f7f1fc80ad47','ok','register','N','bi bi-calendar-week','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('a0803958-f45b-4857-8125-34e5aec072a1','Purchase Order','','a894d7ed-a10e-4359-804e-8223fde34bbd','po','','Y','bi bi-layers','0',998,'N','1','','2024-04-29 23:10:27'),
('a12feb54-1885-4be6-aa09-2c3523eec3dc','Emergency Contact','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','emergencycontact','N','bi bi-book-half','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('a1933745-b711-4e3a-948c-330fd60c23ba','SPU','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','spu','N','bi bi-file-earmark-spreadsheet','0',0,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('a2d9bdb5-2973-4d60-8cbd-4d88b4286f32','Department','','8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614','mastersystem','department','N','fa-solid fa-building-circle-check','0',3,'N','9','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('a3e946b9-29c1-4263-a911-87bc6eba561e','Hospital Insight','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','insight','N','bi-activity','0',2,'N','1','','2024-04-29 23:10:27'),
('a6ff226b-2db1-445c-9fdb-482e6177d67f','Chief Financial Officer','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvalcfo','N','bi bi-ui-checks','0',9,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('a7da4795-00da-4e08-b273-f2a734dec0f6','BPJS','','78e83b81-6a97-4037-aaa3-ba964365c43c','piutang','bpjs','N','bi-person-badge','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('a894d7ed-a10e-4359-804e-8223fde34bbd','Monitoring Evaluasi','','','','','C','','0',4,'N','0','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('a9387d17-2917-4707-bf88-236df398669d','Surat Masuk','','3305ffa5-cf74-4201-ba82-06778d0fd10e','surat','suratmasuk','N','bi bi-envelope-arrow-down','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('a94724c0-551e-4c2a-80a3-3c551aaa3e97','CMO Approval','','92525e76-d778-43c8-945b-f2b4bf192627','paymentponew','paymentcmo','N','bi bi-person-check','0',8,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('aa816bb5-2197-4c1a-90b2-f1e955063ca8','Backup Database','','6c105bb7-633d-4f59-b0d0-37b6dcc59bb7','operation','backupdb','N','bi bi-database-fill','0',3,'N','1','','2024-04-29 23:10:27'),
('aba0746b-5fc8-4fb7-aa74-f1487cf42e2d','Medication Dispanse','','f48e1e18-d42f-4d70-83e1-6210cdc22e5a','md','','Y','bi bi-filetype-pdf','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('abdabe47-4395-4f92-a66d-3d8844ff34bc','Absence','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','absence','absence','N','bi bi-clock','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('ac002403-e625-4592-b10a-1550e0eeaf02','Patient History','','fce6c4d3-42bc-490a-8b8f-5a150fcfeb4f','patientservice','history','N','bi-clipboard-heart','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('ac2e3614-bff5-4855-b14f-6efeb598855c','Report KPI','','266bd8f2-8e09-404b-985e-0196c14218fa','hrd','reportkpi','N','bi bi-speedometer2','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4','Stock Opname','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','stockopname','N','bi bi-boxes','0',10,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('adb30400-f2f2-4eeb-9c79-dc65748f3314','Detail Pengeluaran','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','detailpengeluaran','N','bi-wallet2','0',3,'N','1','','2024-04-29 23:10:27'),
('ae4f6173-4853-4a37-a935-143cc3c99f87','Visual Grafik','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','grafik','N','bi-bar-chart-line','0',1,'N','1','','2024-04-29 23:10:27'),
('afdccf7a-59da-4300-beb5-f4eb08cd7f59','Complaint Manager','','bc12409b-555f-4bc5-abff-39de931a3b24','crm','handlingmanager','N','bi bi-person-lines-fill','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('afee1cd8-72fd-42dc-b5a3-bfb9ec5dc276','Detail Selisih','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','','N','bi-calculator','0',4,'N','1','','2024-04-29 23:10:27'),
('b0613c2a-ce2a-4a2e-bc30-08857c34b2b5','Piutang Asuransi','','09939c62-e760-4858-ab0c-81640ccfece0','sb','piutangbpjs','N','bi-shield-check','0',4,'N','1','','2024-04-29 23:10:27'),
('b23033e4-2079-44e0-89b0-c26a45c74802','Farmasi','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','farmasi','','Y','bi bi-capsule','0',11,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('b56ff379-5619-4064-b572-407671edc15e','Education','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','education','N','bi bi-book-half','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('b76026f2-1c07-4ac4-888c-d33a86ad910e','Manager Approval','','38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca','logistiknew','approvalmanager','N','bi bi-ui-checks','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7','Careers','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','careers','','Y','bi bi-person-raised-hand','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('bacde412-a651-4c8c-8237-155b39a4595b','Connections','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','connection','N','bi bi-link-45deg','0',7,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('bc12409b-555f-4bc5-abff-39de931a3b24','Customer Relationship Management','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','crm','','Y','bi bi-people-fill','0',11,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('bc60eda3-abcc-4469-9392-91614e7e9521','Commissioner Approval','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','appcom','N','bi bi-ui-checks','0',8,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('be411246-2878-4dba-b320-554e78749094','Whatsapp','','45304d5b-390d-4618-a08d-793b475f37b7','whatsapp','','Y','bi bi-whatsapp','0',998,'N','9','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('c1c69eb9-a775-4b56-a7ce-6deb3fec8fab','Overview','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','overview','N','bi bi-speedometer2','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('c23d0cb1-f394-4b6c-b35d-e5d0c119f816','Canister','','aba0746b-5fc8-4fb7-aa74-f1487cf42e2d','md','canister','N','bi bi-filetype-pdf','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('c3ef6c77-86a0-40dc-8f33-087871394836','Document','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','document','N','bi bi-archive','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('c5a700bc-e6d0-495d-8b17-754b5033d5ec','Registration','','c820e1c6-18d9-4ab1-9fc1-df6e57a6f484','bsre','registrasi','N','bi bi-people','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('c7e5c5cc-ce6d-4c2e-a05e-bf4e2bd9df41','List Assets','','8ff4efe7-c59a-4e50-8665-cac5174e9ee4','assets','listassets','N','bi-file-earmark-text','0',2,'Y','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('c80fa5ef-7696-4975-9089-a327269cb974','Piutang MCU','','09939c62-e760-4858-ab0c-81640ccfece0','sb','piutangbpjs','N','bi-heart-pulse','0',3,'N','1','','2024-04-29 23:10:27'),
('c820e1c6-18d9-4ab1-9fc1-df6e57a6f484','BSRe','','45304d5b-390d-4618-a08d-793b475f37b7','bsre','','Y','bi bi-filetype-pdf','0',998,'N','9','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('cbb9bd4f-15d9-4799-a942-b8601961adeb','Clinical Authority','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','rkk','N','bi bi-bookmark-star-fill','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('cda2e6e6-99f8-415d-b52b-320b51b0028a','Finance','','','','','C','','0',3,'N','0','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('cdb63dd6-768a-41c7-b56e-01c5e803397f','Lainnya','','78e83b81-6a97-4037-aaa3-ba964365c43c','piutang','lain','N','bi-credit-card-2-front','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('cded1e6e-e203-4dda-ae26-a0c8b30d9f2e','Manager Approval SPU','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','managerspu','N','bi bi-file-earmark-spreadsheet','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('cee04ef5-5635-4e4f-b703-ab50e6ef866a','Master Indikator','','682c463e-6e88-42fd-8b84-62cc47182405','mutu','indikator','N','bi-bar-chart-line','0',1,'N','1','','2024-04-29 23:10:27'),
('d00ef65d-9af6-405c-a8ef-b5e3dc312416','Quick Report','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','quickreport','N','bi bi-layers','0',8,'N','1','','2024-04-29 23:10:27'),
('d014e2f9-3d6d-49c7-8a00-63fde9a58b40','Table Database','','6c105bb7-633d-4f59-b0d0-37b6dcc59bb7','operation','tabledb','N','bi bi-table','0',4,'N','9','','2024-04-29 23:10:27'),
('d18f825c-eab9-4e5e-9822-23afa290ba9c','Hutang','','a0803958-f45b-4857-8125-34e5aec072a1','po','hutang','N','bi-journal-minus','0',5,'N','1','','2024-04-29 23:10:27'),
('d52c72cb-f61b-4354-9ffd-6200d2d7da85','Finance Approval','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','appfinance','N','bi bi-ui-checks','0',5,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('d7ca1a2b-e684-4b50-824d-50540afaa994','Payment Procurement','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','paymentpo','','Y','bi bi-box','0',8,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('d97e8a15-4a46-4389-a8ff-ab0f694d6d95','Mapping Role','','8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614','mastersystem','mappingrole','N','bi-link','0',4,'N','9','','2024-04-29 23:10:27'),
('df495870-8f19-41a1-943e-5d36ea0553db','Tilaka V2','','45304d5b-390d-4618-a08d-793b475f37b7','tilakaV2','','Y','bi bi-filetype-pdf','0',998,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('dfff16fd-8bc6-410b-8500-3548cf245a86','Manager Approval','','d7ca1a2b-e684-4b50-824d-50540afaa994','paymentpo','paymentmanager','N','bi bi-person-check','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('e3a75d9b-132f-47a5-8d3c-fbe2681474a5','Careers List','','b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7','careers','careerslist','N','bi bi-question-octagon','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('e68bda4d-9e9f-4a89-bd23-ca80983eca32','Daily','','28f66f08-643f-4808-9eca-956a43889705','report','incomedaily','N','fa-solid fa-money-bill-trend-up','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('eaaba437-4823-4819-a912-7bbf789959fe','Vice Director Approval','','d7ca1a2b-e684-4b50-824d-50540afaa994','paymentpo','paymentvice','N','bi bi-patch-plus','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('ebcdc5f7-660b-48cf-99d9-cdf72948af96','Disposisi','','3305ffa5-cf74-4201-ba82-06778d0fd10e','surat','disposisi','N','bi bi-list-check','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a','Kunjungan','','a894d7ed-a10e-4359-804e-8223fde34bbd','monev','','Y','bi-bank','0',998,'N','1','','2024-04-29 23:10:27'),
('ed75d745-1e43-47d4-9c7c-ac9d7b3a46cf','Monitoring Asset','','8ff4efe7-c59a-4e50-8665-cac5174e9ee4','assets','monitoringasset','N','bi-file-earmark-text','0',1,'Y','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('ee9b62a0-72f3-42a9-af3f-3faadca592df','Repository Document','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','document','','Y','bi bi-file-earmark-pdf','0',999999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('eeb5b08f-596b-4966-8649-f3f119325a67','Careers Apply','','b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7','careers','careersapply','N','bi bi-question-octagon','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('ef4a7111-1066-40c6-b43a-2642601c2502','Buku Dagang','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','bukudagang','N','bi-journal-bookmark','0',7,'N','1','','2024-04-29 23:10:27'),
('ef759cae-8fd6-4e36-9790-439e03c3a503','Logistic','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','logistik','','Y','bi bi-box','0',7,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('f0f67e7f-5548-44b0-81aa-a60b3bcc39a0','Import ASPAK ALKES','','8ff4efe7-c59a-4e50-8665-cac5174e9ee4','assets','importaspakalkes','N','bi-file-earmark-text','0',3,'Y','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('f48e1e18-d42f-4d70-83e1-6210cdc22e5a','Medical devices','','','','','C','','0',997,'N','0','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('f56a43c9-f28d-4230-a0ce-7bf5cd86f2df','Support Center','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','support','','Y','bi bi-person-raised-hand','0',999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('f6467930-50af-4ced-a3c7-e8bca55176f9','Manager Approval','','92525e76-d778-43c8-945b-f2b4bf192627','paymentponew','paymentmanager','N','bi bi-person-check','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('f71515e5-57b8-41de-9c49-5e494c497563','Position','','4ca01133-e004-428d-bc56-4e9e2dbdbbd6','hrd','position','N','bi bi-person-lines-fill','0',4,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:31:40'),
('f7d07231-f33e-4050-a6f8-c846cc6aa031','Validation','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','kpi','validation','N','fa-solid fa-list-check','0',4,'Y','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('f88541a9-c8a2-4194-a3a5-6f24e910366f','Presence','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','kpi','absensi','N','fa-solid fa-list-check','0',4,'Y','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:00:57'),
('f977f8cb-2d62-4f85-a403-93f7ec1fcde1','Group Activity','','4ca01133-e004-428d-bc56-4e9e2dbdbbd6','hrd','groupactivity','N','bi bi-person-badge','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:31:40'),
('f9afc38a-bb61-4f98-b593-211766ec6133','Leka','','f48e1e18-d42f-4d70-83e1-6210cdc22e5a','medicaldevice','leka','N','bi bi-grid','0',1,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('f9e7f495-3ac1-4e07-99cc-14160791c745','Request','','ef759cae-8fd6-4e36-9790-439e03c3a503','logistik','requestnew','N','bi bi-file-earmark-spreadsheet','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('fbd656eb-4a2f-4e32-b45c-44467a89a9aa','Profile','','9b873e90-d8fd-48f3-8c98-ec2aff0c207f','profile','','Y','bi bi-person','0',2,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('fce6c4d3-42bc-490a-8b8f-5a150fcfeb4f','Patient Services','','','','','C','','0',2,'N','0','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('fd4bd82d-b1c2-4560-95ed-5124ca53e6c1','Position','','fbd656eb-4a2f-4e32-b45c-44467a89a9aa','profile','position','N','bi bi-book-half','0',3,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('ff61f738-5cd8-49f9-9005-7236fdefdc6c','Validation Document','','73917c12-47af-4672-b57a-45b8cffb8e4e','casemix','validdoc','N','bi bi-question-octagon','0',9999,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 09:08:59'),
('ff681bdf-ca8d-4657-87d6-22f660434797','Management','','','','','A','bi bi-speedometer2','0',997,'N','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 08:56:49'),
('ffe927bc-c43b-4a68-a58f-0544a6e77742','Mutasi Rekening','','9a1cc085-6cc0-40ee-85fc-849357638db3','sb','mutasi','N','bi-bank','0',10,'N','1','','2024-04-29 23:10:27');
/*!40000 ALTER TABLE `dt01_gen_modules_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_organization_ms`
--

DROP TABLE IF EXISTS `dt01_gen_organization_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_organization_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `HEADER_ID` varchar(36) DEFAULT NULL,
  `CODE` varchar(6) DEFAULT NULL,
  `ORG_NAME` varchar(4000) NOT NULL,
  `WEBSITE` varchar(1000) DEFAULT NULL,
  `TRIAL` varchar(1) NOT NULL DEFAULT 'Y',
  `HOLDING` varchar(1) DEFAULT 'N',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_organization_ms`
--

LOCK TABLES `dt01_gen_organization_ms` WRITE;
/*!40000 ALTER TABLE `dt01_gen_organization_ms` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_organization_ms` VALUES
('a4b44702-bd9c-4a73-b80c-f5aa8d221912','e2a69450-cbc1-4793-a059-a3a80f0189b0',NULL,'RS PKU Muhammadiyah Petanahan',NULL,'N','N','1',NULL,'2026-01-15 12:12:57'),
('e2a69450-cbc1-4793-a059-a3a80f0189b0',NULL,NULL,'RS PKU Muhammadiyah Petanahan',NULL,'N','Y','1',NULL,'2026-01-15 12:14:02');
/*!40000 ALTER TABLE `dt01_gen_organization_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_referensi_dt`
--

DROP TABLE IF EXISTS `dt01_gen_referensi_dt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_referensi_dt` (
  `ORG_ID` varchar(36) NOT NULL,
  `REF_ID` varchar(36) NOT NULL,
  `REFERENSI` varchar(100) NOT NULL,
  `NOTE` varchar(4000) NOT NULL,
  `LINK` varchar(1000) NOT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`REF_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_referensi_dt`
--

LOCK TABLES `dt01_gen_referensi_dt` WRITE;
/*!40000 ALTER TABLE `dt01_gen_referensi_dt` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_referensi_dt` VALUES
('be3d71bc-484e-4971-9590-e31e10516c25','1d388997-3327-4746-8e80-0d49f37d1303','forking postman collection','informasi langkah-langkah forking postman collection','https://satusehat.kemkes.go.id/platform/docs/id/postman-workshop/forking/#forking-api','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17'),
('be3d71bc-484e-4971-9590-e31e10516c25','9fd2c349-c12b-470c-867c-f21b80df021c','import postman collection','formasi langkah-langkah import postman collection.','https://satusehat.kemkes.go.id/platform/docs/id/postman-workshop/import/#import-api','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17'),
('be3d71bc-484e-4971-9590-e31e10516c25','b18e4ceb-2363-4377-985c-b35dcc0a4408','Certification Practice Statement','','https://repository.tilaka.id/CP_CPS.pdf','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17'),
('be3d71bc-484e-4971-9590-e31e10516c25','c491f152-a328-4868-9331-87142f3f6415','Kebijakan Privasi','','https://repository.tilaka.id/kebijakan-privasi.pdf','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17'),
('be3d71bc-484e-4971-9590-e31e10516c25','d00e3b9e-933b-42d8-a493-19a41a01cc9a','Perjanjian Pemilik Sertifikat','','https://repository.tilaka.id/perjanjian-pemilik-sertifikat.pdf','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17'),
('be3d71bc-484e-4971-9590-e31e10516c25','d2b728d9-4f81-44bd-b2dc-acdf546123d8','Kebijakan Jaminan','','https://repository.tilaka.id/kebijakan-jaminan.pdf','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17'),
('be3d71bc-484e-4971-9590-e31e10516c25','d326eb39-6755-4ff8-a094-d396102424e3','Postman Collection Satu Sehat','Akses Postman Collection SATUSEHAT melalui web browser Anda.','https://s.id/PostmanSATUSEHAT','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17'),
('be3d71bc-484e-4971-9590-e31e10516c25','e4ff825f-b7d1-4aee-98a7-ae71409de23d','Mail Hostinger','Akses Email Hostinger','https://mail.hostinger.com/','1','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17'),
('be3d71bc-484e-4971-9590-e31e10516c25','ed77c32b-e6ea-4883-971e-999b2d522b10','Link 9','','','0','ab24ee31-f74c-4f86-a07b-27196b57e7a6','2024-04-27 22:59:17');
/*!40000 ALTER TABLE `dt01_gen_referensi_dt` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_role_access`
--

DROP TABLE IF EXISTS `dt01_gen_role_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_role_access` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `ROLE_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_role_access`
--

LOCK TABLES `dt01_gen_role_access` WRITE;
/*!40000 ALTER TABLE `dt01_gen_role_access` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_role_access` VALUES
('b12234f2-b27e-4920-a935-2077fa4783d8','438ed798-a4dc-4c83-93c5-3aa656b93aba','6652e626-4438-4bff-aeef-164598310b94','346ddd36-438f-45a9-a22f-1b11b6dc32e4','1','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:43:19','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:43:19');
/*!40000 ALTER TABLE `dt01_gen_role_access` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_role_dt`
--

DROP TABLE IF EXISTS `dt01_gen_role_dt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_role_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `ROLE_ID` varchar(36) DEFAULT NULL,
  `MODULES_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_role_dt`
--

LOCK TABLES `dt01_gen_role_dt` WRITE;
/*!40000 ALTER TABLE `dt01_gen_role_dt` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_role_dt` VALUES
('b12234f2-b27e-4920-a935-2077fa4783d8','325b2154-413a-4c18-bdba-2b026912425d','346ddd36-438f-45a9-a22f-1b11b6dc32e4','5e882da7-5b62-4031-8ea2-a849d1e0aa65','1','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:10','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:10'),
('b12234f2-b27e-4920-a935-2077fa4783d8','b1d4450d-9f15-45a7-9348-d047c7f0f927','346ddd36-438f-45a9-a22f-1b11b6dc32e4','171a2550-9fa1-4fe8-84c3-7b61b7cc2c55','1','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:05','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:05'),
('b12234f2-b27e-4920-a935-2077fa4783d8','e2802476-3160-41aa-8c3b-4072a90c63cd','346ddd36-438f-45a9-a22f-1b11b6dc32e4','df495870-8f19-41a1-943e-5d36ea0553db','1','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:08','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:08'),
('b12234f2-b27e-4920-a935-2077fa4783d8','f0d24cd5-1ca0-4da2-b70d-1dca2dc4985e','346ddd36-438f-45a9-a22f-1b11b6dc32e4','01b1b52a-7d47-4352-b145-37d9bb2646c3','1','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:05','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:04'),
('b12234f2-b27e-4920-a935-2077fa4783d8','fb7c9e45-50b0-4541-a3ef-eeb0e13811fd','346ddd36-438f-45a9-a22f-1b11b6dc32e4','45304d5b-390d-4618-a08d-793b475f37b7','1','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:02','6652e626-4438-4bff-aeef-164598310b94','2025-11-27 11:44:02');
/*!40000 ALTER TABLE `dt01_gen_role_dt` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_role_ms`
--

DROP TABLE IF EXISTS `dt01_gen_role_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_role_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `ROLE_ID` varchar(36) NOT NULL,
  `ROLE` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATED_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_role_ms`
--

LOCK TABLES `dt01_gen_role_ms` WRITE;
/*!40000 ALTER TABLE `dt01_gen_role_ms` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_role_ms` VALUES
('b12234f2-b27e-4920-a935-2077fa4783d8','346ddd36-438f-45a9-a22f-1b11b6dc32e4','Default','1','6652e626-4438-4bff-aeef-164598310b94','2025-11-26 21:29:02','6652e626-4438-4bff-aeef-164598310b94','2025-11-26 21:29:02'),
('b12234f2-b27e-4920-a935-2077fa4783d8','34c2e933-4b1b-47cd-8497-71de44ac4e01','Administrator Tilaka','1','6652e626-4438-4bff-aeef-164598310b94','2025-11-17 16:05:58','6652e626-4438-4bff-aeef-164598310b94','2025-11-17 16:05:58');
/*!40000 ALTER TABLE `dt01_gen_role_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_user_asst_dt`
--

DROP TABLE IF EXISTS `dt01_gen_user_asst_dt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_user_asst_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `ASST_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_user_asst_dt`
--

LOCK TABLES `dt01_gen_user_asst_dt` WRITE;
/*!40000 ALTER TABLE `dt01_gen_user_asst_dt` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `dt01_gen_user_asst_dt` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_gen_user_data`
--

DROP TABLE IF EXISTS `dt01_gen_user_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_gen_user_data` (
  `GROUP_ID` varchar(36) DEFAULT NULL,
  `ORG_ID` varchar(36) DEFAULT NULL,
  `USER_ID` varchar(36) NOT NULL,
  `USERNAME` varchar(4000) NOT NULL,
  `PASSWORD` varchar(4000) NOT NULL DEFAULT '3832333435363731',
  `NAME` varchar(1000) NOT NULL,
  `NAME_IDENTITY` varchar(1000) DEFAULT NULL,
  `NIK` varchar(100) DEFAULT NULL COMMENT 'Nomor Induk Kepegawaian',
  `NIP` varchar(100) DEFAULT NULL COMMENT 'NIP PNS Jika DiPerlukan',
  `IDENTITY_NO` varchar(16) DEFAULT NULL COMMENT 'No KTP',
  `NPWP_NO` varchar(100) DEFAULT NULL,
  `SEX_ID` varchar(1) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(4000) DEFAULT NULL,
  `KATEGORI_ID` varchar(36) DEFAULT NULL,
  `USER_IDENTIFIER` varchar(1000) DEFAULT NULL,
  `REGISTER_ID` varchar(36) DEFAULT NULL,
  `TILAKA_ID` varchar(100) DEFAULT NULL,
  `REVOKE_ID` varchar(39) DEFAULT NULL,
  `ISSUE_ID` varchar(42) DEFAULT NULL,
  `CERTIFICATE` varchar(1) DEFAULT NULL,
  `CERTIFICATE_INFO` varchar(100) DEFAULT NULL,
  `START_ACTIVE` datetime DEFAULT NULL,
  `EXPIRED_DATE` datetime DEFAULT NULL,
  `PLACE_BIRTH` varchar(100) DEFAULT NULL,
  `IMAGE_PROFILE` varchar(1) NOT NULL DEFAULT 'N',
  `IMAGE_IDENTITY` varchar(1) NOT NULL DEFAULT 'N',
  `LEVEL_USER` varchar(36) NOT NULL DEFAULT 'a3b109d6-b792-4883-b176-31bc762de98d',
  `KLINIS_ID` varchar(36) DEFAULT NULL,
  `DUTY_DAYS` int(11) DEFAULT 0,
  `DUTY_HOURS` int(11) DEFAULT 0,
  `HOURS_MONTH` int(11) DEFAULT 0,
  `SUSPENDED` varchar(1) NOT NULL DEFAULT 'N',
  `KOLEGIUM_ID` varchar(36) DEFAULT NULL,
  `REASON_CODE` varchar(1) DEFAULT NULL,
  `NO_HP` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `ACTIVE_ID` varchar(36) DEFAULT NULL,
  `ACTIVE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_gen_user_data`
--

LOCK TABLES `dt01_gen_user_data` WRITE;
/*!40000 ALTER TABLE `dt01_gen_user_data` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_gen_user_data` VALUES
('e2a69450-cbc1-4793-a059-a3a80f0189b0','a4b44702-bd9c-4a73-b80c-f5aa8d221912','50ca9a23-6c77-4a09-937e-0ef3734498f5','123456','3832333435363731','Administrator 2','Administrator 2','123456',NULL,'1243453534534534',NULL,NULL,'gacrossolohoi-2761@yopmail.com',NULL,NULL,'pkum02','ba14c63d-a824-44d8-ba21-c94ece84d367',NULL,NULL,NULL,'3','Aktif','2026-01-15 11:44:58','2027-01-15 11:44:57',NULL,'N','Y','a3b109d6-b792-4883-b176-31bc762de98d',NULL,0,0,0,'N',NULL,NULL,'081288646630','1',NULL,'2026-01-15 12:22:00',NULL,NULL),
('e2a69450-cbc1-4793-a059-a3a80f0189b0','a4b44702-bd9c-4a73-b80c-f5aa8d221912','6652e626-4438-4bff-aeef-164598310b94','root','3832333435363731','Administrator 1','Administrator 1','null',NULL,'4353423423423423',NULL,NULL,'pruwoufaloihoi-2459@yopmail.com',NULL,NULL,'pkum01','31b4cc06-0c8c-4f0a-96ec-a9a428f8b751',NULL,NULL,NULL,'2','Registered',NULL,NULL,NULL,'N','Y','83e9982c-814a-4349-89fb-cbee6f34e340',NULL,0,0,0,'N',NULL,NULL,'081288646630','1',NULL,'2026-01-15 12:15:32',NULL,NULL);
/*!40000 ALTER TABLE `dt01_gen_user_data` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_hrd_position_dt`
--

DROP TABLE IF EXISTS `dt01_hrd_position_dt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_hrd_position_dt` (
  `GROUP_ID` varchar(36) DEFAULT NULL,
  `ORG_ID` varchar(36) NOT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) NOT NULL,
  `POSITION_ID` varchar(36) NOT NULL,
  `ATASAN_ID` varchar(36) NOT NULL,
  `START_DATE` date DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `POSITION_PRIMARY` varchar(1) NOT NULL DEFAULT 'N',
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_hrd_position_dt`
--

LOCK TABLES `dt01_hrd_position_dt` WRITE;
/*!40000 ALTER TABLE `dt01_hrd_position_dt` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `dt01_hrd_position_dt` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_hrd_position_ms`
--

DROP TABLE IF EXISTS `dt01_hrd_position_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_hrd_position_ms` (
  `GROUP_ID` varchar(36) DEFAULT NULL,
  `ORG_ID` varchar(36) DEFAULT NULL,
  `POSITION_ID` varchar(36) NOT NULL,
  `POSITION` varchar(500) DEFAULT NULL,
  `DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `BAGIAN_ID` varchar(36) DEFAULT NULL,
  `UNIT_ID` varchar(36) DEFAULT NULL,
  `SUBUNIT_ID` varchar(36) DEFAULT NULL,
  `LEVEL_FUNGSIONAL` varchar(36) DEFAULT NULL,
  `LEVEL` int(11) DEFAULT NULL,
  `RVU` int(11) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) NOT NULL,
  `LAST_UPDATE_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`POSITION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_hrd_position_ms`
--

LOCK TABLES `dt01_hrd_position_ms` WRITE;
/*!40000 ALTER TABLE `dt01_hrd_position_ms` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `dt01_hrd_position_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_med_kolegium_ms`
--

DROP TABLE IF EXISTS `dt01_med_kolegium_ms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_med_kolegium_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `KOLEGIUM_ID` varchar(36) NOT NULL,
  `KOLEGIUM` varchar(1000) DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `DESCRIPTION_ENG` varchar(1000) DEFAULT NULL,
  `ICON` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  PRIMARY KEY (`KOLEGIUM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_med_kolegium_ms`
--

LOCK TABLES `dt01_med_kolegium_ms` WRITE;
/*!40000 ALTER TABLE `dt01_med_kolegium_ms` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `dt01_med_kolegium_ms` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_sek_surat_hd`
--

DROP TABLE IF EXISTS `dt01_sek_surat_hd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_sek_surat_hd` (
  `GROUP_ID` varchar(36) DEFAULT NULL,
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `NO_URUT` varchar(100) DEFAULT NULL,
  `NO_AGENDA` varchar(100) DEFAULT NULL,
  `KODE_SURAT` varchar(100) DEFAULT NULL,
  `TANGGAL_SURAT` date DEFAULT NULL,
  `NOMOR_SURAT` varchar(1000) DEFAULT NULL,
  `TANGGAL_MASUK_SURAT` date DEFAULT NULL,
  `ASAL_SURAT` varchar(1) DEFAULT NULL,
  `DARI_TEXT` varchar(1000) DEFAULT NULL,
  `DARI_ID` varchar(36) DEFAULT NULL,
  `PERIHAL` varchar(1000) DEFAULT NULL,
  `RINGKASAN` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_sek_surat_hd`
--

LOCK TABLES `dt01_sek_surat_hd` WRITE;
/*!40000 ALTER TABLE `dt01_sek_surat_hd` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `dt01_sek_surat_hd` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_sek_surat_it`
--

DROP TABLE IF EXISTS `dt01_sek_surat_it`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_sek_surat_it` (
  `GROUP_ID` varchar(36) DEFAULT NULL,
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `SURAT_ID` varchar(36) DEFAULT NULL,
  `FROM_ORG_ID` varchar(36) DEFAULT NULL,
  `FROM_DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `FROM_USER_ID` varchar(36) DEFAULT NULL,
  `FROM_DATETIME` datetime DEFAULT NULL,
  `TO_ORG_ID` varchar(36) DEFAULT NULL,
  `TO_DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `TO_USER_ID` varchar(36) DEFAULT NULL,
  `TO_DATETIME` datetime DEFAULT NULL,
  `RESPONSE` varchar(1) DEFAULT 'N',
  `HAPUS_ID` varchar(36) DEFAULT NULL,
  `HAPUS_DATETIME` datetime DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_sek_surat_it`
--

LOCK TABLES `dt01_sek_surat_it` WRITE;
/*!40000 ALTER TABLE `dt01_sek_surat_it` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `dt01_sek_surat_it` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `dt01_service_api_logs_out`
--

DROP TABLE IF EXISTS `dt01_service_api_logs_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dt01_service_api_logs_out` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `REQUEST_ID` varchar(13) NOT NULL,
  `REQUEST_METHOD` varchar(6) DEFAULT NULL,
  `REQUEST_URL` text DEFAULT NULL,
  `REQUEST_HEADERS` text DEFAULT NULL,
  `REQUEST_BODY` text DEFAULT NULL,
  `USER_AGENT` text DEFAULT NULL,
  `REMOTE_ADDRESS` varchar(15) DEFAULT NULL,
  `RESPONSE_STATUS` varchar(3) DEFAULT NULL,
  `RESPONSE_HEADERS` text DEFAULT NULL,
  `RESPONSE_BODY` text DEFAULT NULL,
  `APPCONNECT_TIME_US` decimal(18,0) DEFAULT NULL,
  `CONNECT_TIME_US` decimal(18,0) DEFAULT NULL,
  `NAMELOOKUP_TIME_US` decimal(18,0) DEFAULT NULL,
  `PRETRANSFER_TIME_US` decimal(18,0) DEFAULT NULL,
  `REDIRECT_TIME_US` decimal(18,0) DEFAULT NULL,
  `STARTTRANSFER_TIME_US` decimal(18,0) DEFAULT NULL,
  `TOTAL_TIME_US` decimal(18,0) DEFAULT NULL,
  `SOURCE` varchar(1000) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`REQUEST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt01_service_api_logs_out`
--

LOCK TABLES `dt01_service_api_logs_out` WRITE;
/*!40000 ALTER TABLE `dt01_service_api_logs_out` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `dt01_service_api_logs_out` VALUES
('be3d71bc-484e-4971-9590-e31e10516c25','1768487413800','POST','https://sb-api.tilaka.id/generateUUID?name=Administrator+1&email=pruwoufaloihoi-2459@yopmail.com','{\"Host\":\"localhost\",\"User-Agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:140.0) Gecko\\/20100101 Firefox\\/140.0\",\"Accept\":\"application\\/json, text\\/javascript, *\\/*; q=0.01\",\"Accept-Language\":\"en-US,en;q=0.5\",\"Accept-Encoding\":\"gzip, deflate, br, zstd\",\"X-Requested-With\":\"XMLHttpRequest\",\"Content-Type\":\"multipart\\/form-data; boundary=----geckoformboundary50e9755fc0370de32f3d38004ac9859f\",\"Content-Length\":\"214\",\"Origin\":\"http:\\/\\/localhost\",\"Connection\":\"keep-alive\",\"Referer\":\"http:\\/\\/localhost\\/dtechnology\\/index.php\\/tilakaV2\\/registrasi\",\"Cookie\":\"ci_session=hhst46avj7l6hcdvblncg4sc5mka5dbv\",\"Sec-Fetch-Dest\":\"empty\",\"Sec-Fetch-Mode\":\"cors\",\"Sec-Fetch-Site\":\"same-origin\",\"Priority\":\"u=0\"}','','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','127.0.0.1','200','{\"url\":\"https:\\/\\/sb-api.tilaka.id\\/generateUUID?name=Administrator+1&email=pruwoufaloihoi-2459@yopmail.com\",\"content_type\":\"application\\/json\",\"http_code\":200,\"header_size\":296,\"request_size\":1615,\"filetime\":-1,\"ssl_verify_result\":19,\"redirect_count\":0,\"total_time\":0.239253,\"namelookup_time\":0.000215,\"connect_time\":0.041535,\"pretransfer_time\":0.115175,\"size_upload\":0,\"size_download\":84,\"speed_download\":351,\"speed_upload\":0,\"download_content_length\":84,\"upload_content_length\":0,\"starttransfer_time\":0.239213,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"10.122.1.11\",\"certinfo\":[],\"primary_port\":443,\"local_ip\":\"192.168.2.52\",\"local_port\":56018,\"http_version\":2,\"protocol\":2,\"ssl_verifyresult\":0,\"scheme\":\"https\",\"appconnect_time_us\":115091,\"connect_time_us\":41535,\"namelookup_time_us\":215,\"pretransfer_time_us\":115175,\"redirect_time_us\":0,\"starttransfer_time_us\":239213,\"total_time_us\":239253}','{\"success\":true,\"message\":\"Success\",\"data\":[\"31b4cc06-0c8c-4f0a-96ec-a9a428f8b751\"]}',115091,41535,215,115175,0,239213,239253,'TILAKA-UUID','2026-01-15 21:30:13'),
('be3d71bc-484e-4971-9590-e31e10516c25','1768487415352','POST','https://sb-api.tilaka.id/registerForKycCheck','{\"Host\":\"localhost\",\"User-Agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:140.0) Gecko\\/20100101 Firefox\\/140.0\",\"Accept\":\"application\\/json, text\\/javascript, *\\/*; q=0.01\",\"Accept-Language\":\"en-US,en;q=0.5\",\"Accept-Encoding\":\"gzip, deflate, br, zstd\",\"X-Requested-With\":\"XMLHttpRequest\",\"Content-Type\":\"multipart\\/form-data; boundary=----geckoformboundary50e9755fc0370de32f3d38004ac9859f\",\"Content-Length\":\"214\",\"Origin\":\"http:\\/\\/localhost\",\"Connection\":\"keep-alive\",\"Referer\":\"http:\\/\\/localhost\\/dtechnology\\/index.php\\/tilakaV2\\/registrasi\",\"Cookie\":\"ci_session=hhst46avj7l6hcdvblncg4sc5mka5dbv\",\"Sec-Fetch-Dest\":\"empty\",\"Sec-Fetch-Mode\":\"cors\",\"Sec-Fetch-Site\":\"same-origin\",\"Priority\":\"u=0\"}','{\"registration_id\":\"31b4cc06-0c8c-4f0a-96ec-a9a428f8b751\",\"email\":\"pruwoufaloihoi-2459@yopmail.com\",\"name\":\"Administrator 1\",\"company_name\":\"RS PKU Muhammadiyah Petanahan\",\"date_expire\":\"2026-01-18 23:59\",\"nik\":\"4353423423423423\",\"photo_ktp\":\"data:image\\/jpeg;base64,\\/9j\\/4AAQSkZJRgABAQAAAQABAAD\\/2wCEAAkGBxMTEhUSExIVFRUVFxcXFxYYFxgdFxcXGBcaGBUaFxgaHSggGholHRgYITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGxAQGi0mICUtLy0tLS0rLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf\\/AABEIALUBFwMBIgACEQEDEQH\\/xAAcAAABBQEBAQAAAAAAAAAAAAAAAQIDBAUGBwj\\/xABGEAACAQIDBAYFCQUIAQUAAAABAhEAAwQSIRMxQfAFIjJRYXEGFIGR0QcjQlKhosHh8RYzYpKxJDRDU3KDssIVNVSzw9L\\/xAAZAQEAAwEBAAAAAAAAAAAAAAAAAQIDBAX\\/xAAsEQACAgEEAQIEBgMAAAAAAAAAAQIREgMhMVEEQWEyUnGxBSMzNIHwQqHR\\/9oADAMBAAIRAxEAPwD1GiikoANFLNITQBRTC9N2tASUVHtaNqKAkpai2tG2oCSiotrRtaAlomotrRthQE1JUW1FG2oCSlqLaija0BLSVGLwo2ooCWkqLail2tASUVFthQbooCWiotqKNrQEooio9sKQXqAloqLbUC7QE1FMDg04GgFpKIpaASiiigH0UTSEUAMagdiTA1J0ipLrVDhW1Y8d3l31KVkN0hbuVTB6ze4D3b6abojsL9740MRMfCkKCuhRivQ5XOTfIm1H1F+98aNqPqL9741DRV8I9FM5dk6XRPYX73xpDdH1F+98aZa30ymEehnKuSbaj6i\\/e+NI15RqUQe\\/41FWb0\\/0eb9tbYj97acyARlRwzaMCDoNxFHCPQU5dmt6wu7KkndqfjT3vKPoLpE6tx3ca4e56IFbitbIZLYw0KwTM+zv3btyGyTajOpUJA0y6CCJ\\/wBlrjDIyW0OS+rX0M3LrXDmtOwyzIMOZJhlAEjWqUui9v5jr9uv1U95+Pj9tOLj6id29vjXEYv0Sv3gpulM9yWvsjEGWxeGuQjAT1bNgqD\\/AAL30+\\/6NYlgrMLTXVe6RckZJa6jqzW3RoByBjkZXBAAMaiHXRKv5jsTfWJKpHmfjTtssE5E0ji3H21zD9DOLNpDbS4Uxd+8yEjKyXLl9l7QgmLqaeBrPwvotfR0ukqVtix8xPzTZb2IbKSVn5pLy7PcJQSBAiaXRCb+Y7bbLE5Fjzb40G8v1F+98a5nF9F3zgThUVCbiXrbEsQEFzPlYaHNGYSNKz+lPR7FXGxNwG1OJTEWSvWBCNbC4clySDBtg5QBG3uanjLS6IUn8x223X6ie9vZxoW+sxlTylvjXGYn0ZvPbbDF0KNde495xL3QyQm0VSvXV2kEEACzbjuDsP6PXmvpiLwtljcstcQZdcuHW27K+TOIcHqTDLod5mKXRKb+Y7D1hD9FPefZxp21H1F+98a4nGeitxrZsoLNoG9irpYLOrO\\/qsKpXVBcLCSQrIuh4dZhixRS4AcqMwBkBo6wB4iZqyin6FXJrhlraj6i\\/e+NJtR9RfvfGoqKnCPRGcuyd7i\\/UX73xpu1H1F+98abc4eQplFCPQc5dk21H1F+98aVbi6\\/Nr9741BT04+VQ4R6CnLsntgNovVbgJ0PkeBotv8AZUSCD40t5ofz5NY6kUt0dGlNvZlkGlpqGnVkbBRRRQD4ooikoCHEHSoMEe15+H41NiKgwJ7Xn4fjVo8lZ8C3hrSht1GI53U1d3lXTyjiezHsk+dQkVLaPCnMs0utiasitb6ZUgXXfTWWrWVG0UU+2s1LIGgVldNdIXEu2wlu+wtl7tzLbYpctjD3gFDqCGbabMZO1JBiNa3FWKWs5OzSOxwoudJhEtANt9rmz3BNsq+EukhmTMuVb6mAd2a0Dv1uLjMSbuHdLWK2FsWVuK46zm7K3dqp6zG3NtsyAjR+FddQeeRVMS+XscBhlxmxui4b4f1RrlvKbhLXhO+RNu4DA2W5g0iYIGjauYlcSpCXzh1ZbLZjIOZC5uwTnMXGRM0ZQFbWunceVPCaVpjRTK\\/Q425jMQmKdsuIdFuXCUVLxU2hhyy5SV2Zm5AAU5iT3SKrocflSyy3Tc2wYksUVkbDXSVN21mCqL6GBOga2Dv17jZmmstMfcZexx1rE4snDkriSiLaS8coRna6Ct4sk5ptzbYMk6q+tb3oxacWybhuFjdvj5wsTkW9cW1GbgbYXXjoeNaYFORdaVRGVjTSUppKuUCiilCmgHPw8qZUjrrvikkefnUJksQLTljWO6mlqUbjRhBa30mK7Y8qfYGtR4vtisdU30eS5ZOlPqOzUlYHSFFFFAPpDS0GgK+IqDAHtedT4ndUGBPa8\\/GrR5Kz4GdNYrZWLl3Ln2aM2UHVsomJjSYislemi1sXLVsOGuLbhnKwWKqD2TxYAjhBrdxwQ22F2BbIhsxIEHTU6VlXeirBBAELtGu9S46\\/OFiWMow1zSfAit1fBzSS5DDdJ571yyqH5ogOxIgZrausDeScxEcMpM7gdUGao+pWxcN0KM7alhMmVVTPhCrpu0Bq3bPCrPdFLHOCd1Mcwal55mkI41CYaKCY7NZ2oAWVLAXCFAIntspYKO8idKz8H01cK2SbSgviHsXOsepkL5SFOssFBidAd50rVXDIF2aqoSCMoUBYO8Zd0eFU7d\\/C2wtoHDoLZYqgyAIU0chdwIziTwz+NGmSmU8Z03iLVnGXjbtOMODkyllDFEL3M2adFBUab2DDSJq5iOk7i33tAWiq2y8l2GTqjIbzZYQM2YAamFLd4Fi3ew1xTaBssLouE2xlIcZoukrubrNDHvbXfVYjAFze\\/spd1INyLZZky5TLbyuURviBVNy23Rnp6WgNh7Ti2t27ee26l8uVVuNbVgp1LMQIXWJOu6Yb3pVcCkG0u0a4AiQdLZS9cR2IPWzCww0iDOmmu5h72EVEVGw6opJRVKBQVXaEoBuIVs0jg08aq3LeCKtby4XJcdmZItw7rJZiPpMMjEneMp7qlJ9k2uitiemLqm66i09tLC3gRnDS\\/wC6WSIObK5iAR1frVBh\\/SS6XtK1kRcfIzKHPXF27aYbotldmpKsdc5AJyknobCWritAturgK3ZIYZdA28EZTu7jSW+jLAKFbNtTaBW2QiA2wd4Qx1QfCpd3yVWPRz2E9Irr4fbbFJnDGA+ipiFtsJkSWXaRA36HQHS8\\/SF7b3bSraK21nPmMI5KC2lwxBdgzNlXUALPbU1eTo+0qlFtW1UtmKhFClpDZiAILSAZ8BUR6Hw5Z3OHslrgK3G2ay6mJDmOsDA0PcKvUuytx6JOhcUb1lLpAUmcwB7LKxVx4EEEEcCCKugaz5mobOHVFVVUKqgBVUAKANwAGgFTKN+79aEAAO\\/3VlekPTS4XJNsvnzfSiMuXw\\/i+ytMgjfpXIfKGdLGv+Z\\/0rLWk4wbTOrwtOOrrxhNbb\\/Yf+3S\\/wDtz\\/OPhR+3Q\\/yW\\/nHwriqz+kel7drTtP8AVHD\\/AFHh\\/WuFeRqvhnuz8DxIK5Kv5Z6IfThf8hv5x8KT9t1\\/yG\\/nHwry9elrjanJbU7iQSf600dL3AdSjjyj8eYrXPX7OTDwL+F\\/7\\/6epftuv+Q384+FL+3Cx+4b+cf\\/AJrg8DjFurmX2juqyKyfk6q5Z2R\\/DvFkrS2+rPXehMXtrK3QMuaTE7oJG8eVOxfbHP8ASqfoh\\/c7Pk3\\/ADbuq5i+2PKupu42zw5QUNVxXCbLdmpKjs7qkqhcJooooB9FFFAV8RuqDADtedT4iq+BHa041aPJSfAnSoQ2bm0UsgEsAJJVesdCYI03d1c2cBgI1uNKggqzZisDIQYBkjNEknrcZrqsayKjtcyhIhs0BYOmpPDWueTpXDEE+rHMe0MqwCzJM7jBcpwk74rRmSQmEfCYfaOLh1WCNTpZVtFAWTADe4gbqtnpi2GYNmUKJLMOrEuNNZ\\/w3O7chNZt67htk1xMLnK3LltlIGaWUu5G8ldN3dw0io+kOkcK6lWtNkAZWKwJ2RCgLrJU7VyDoYkgdarqRRxs6G10khEyR1S0x9EHKZ47xUa9N2DueRIEwdcy5lI7wRuise70jYYgHDsdSokLuKbQ5YbjK747XhWpgcNZdLbLaVRCsoKiVgdXwBG6lXwRxyi1eURr3rwnUMI4HjHl4b6wMb0fhFunPnD3WCGCYJvMSOECSoE\\/6R3V0mICxJ714rvLADeRxj8JOlczi8TbS4c2EthTeNsXHbKGY52dpNs9abYOk9reDNWk0RFMbgHwQa3dts\\/WL7OC2XQMzjLugG8RruYhQdAKjwF3BqBdtm6RluMCFVlKrAcCBv66iEglm1k5qanSNiUDYK0pYwMzxoi2TbKzb1aCgAH+WBJjRcJ00t0gDo+e0SJ1GTYm5pkjS4ANSJ2MiSQKpZei7iOjcKVS4TcK3MioVLkQ6Jb3LpDIigk+yCapWsHgWVHQ3YeSmVrhIEpbbqjgzIg1BksSO0TUuI6ftIhRLG0tw7gKZtyiTaAOUooY22UagBl3GdNHotLN6yrCyFUNdUKVgqVuOjzpoSQSR3njvqy34oq7S3sb0diMPh7YyZlRi7gQxywCzD+EQNBugaaCpsP6SYd2Cq8ljbA0bXaLmTeO6PeKsjB28oXIMoEAdwKlf6EjyNZePvYezcC+rpoEfMB1jlz5RbQKc2XJrqIzKeNGmiFTN+4J4UwrWWnToNu7cA\\/dgkBmAzZQCTIkZZMZhIiDxqOz6SqSFKtmOY9UqywrFSwYkSsDMDAkGrZURizYJ4U7h5msrA+kC3SYRgArMCcoBCQHB10MsPCNZqRelwcU2GKDqrmzZteyjdiNB14mfommQxZerkPlBP7j\\/c\\/6V2UDvrj\\/AJQ1jYf7n\\/SsfJf5T\\/vqdn4b+5j\\/AD9mcPjcRs7bP9UT7eH2xXAtcJMkySfeTXX+k7HYGOLKPtn8Kd6Gej9oja4nNDdlFVmZl8QoJC\\/1ri0qUbPV85ueqo9IzsD0ZfxSqtu0TGkwYA8SdK1sf6H3bFqcskkSQZGnCK9R6MeyUGyIyjSAIyxwIIEVSx\\/StkyoLMNxK23ZR5sFj7aS1JMwjpRXJ490TcNq+BuD6Ec91dXWB6Y4Q2r4cRleGUj7a3bbSAe8A1XV3qR2+BJrKD9D1X0RH9js+Tf82q5iu2PLnfVX0Q\\/udnyb\\/m3fVrFHrjyrsXwI8XU\\/Xl9X9y3ZqaorNSmqEiGilpKAfSGlFFAV8RUGB+l5+FT4gaVWwf0vOrR5KT4JMdcYW2NtZeDlGnaOgnXcDqfAGsm10hi9AcOSSYJmFWLaydCZBuZo8CO6t2OdKced5rUxRhf+RxfVHq0E5MxklVBKloA1JAzDzAid1azoQZHurJ6Q6Pvu90reIVkYIouOuVsiZD1dB1gxIAmDvI0qDF9GYouWtXwCA2RGuXIlS5t5t4K\\/uw2knUzoQxNoNJmyV9lJmHCq\\/ReAuIhW5cNxsxhiSTkACpP8RCyf4mNTssVrF2YyVA14jx1A9hIB+yqDdI3ReINtxa1GYIxYsCIPVnqEazH26VbuAxpvke6RPA8J\\/LfWU2BxRuE7UbMsxAzMDlJ03Lp1OpE6Hr76iSJix3SWPxis+xtK66BJHWLQrEklgMsZxrGuXfuoTHYl3bqBFDrlJttJQ5pnrjrCF1GnW75CwXejcWMoF6YAzS7AmFAYTlJ6zSQ29fGaudEYa+mfbOHkjLE6QNdIETpoO72mEtyW9iHE4zE5cwSGNlWC7NiDdKnOuYN1YIXqwSZ91W\\/jMcJZbKuOqFGUqxIRHbtssAnaJJgglNDqD0gGke2mRVq9yMl0Y+JxOKS1mW3tXN1gFVAsWlLESGuDrMFABnQuNDEUX8Vi17NtWU3oPUYEWpIB7WplDroIuITEGtgNHdTjuo0wmUOh7917StfQJckyomBr4n2Txjuir4UndTRTnep34Kiga0xjTtw8\\/wClMogLNcf8oP8Ag\\/7n\\/SuwFcj8oY\\/cf7n\\/AErHyf0n\\/fU7vw39zH+fszz3p4\\/MtPeoPkWE\\/ZNdj6P9G7bDWlDsmVRqhiYEbxr41xXpKfmD\\/qX+tdP8nfSs2cqkZkJUg+8H3GvOW0L9z2PJ3169jq8DgzalGcvCnVj1vMniarP0KzttdvcUCIVW6kb9VOk8JqXD3XuFioaey3VBiPb+VOsYkhWUbhodCNd9Vbrcpj6Hnnyj5S6LO6fbJGn9fdUfRjzbA+qSPx\\/Gs30zxgfFlQZyQD57z\\/Wpug70lh4A\\/gfwrVx\\/KK+NqJeT9dj2r0Q\\/udnyb\\/m1XMUOuKq+iH9zs+Tf829lW8T2xHdXUvgR5up+vL6v7luzUtR2akqhIUUUUA6iikoCC\\/uqvgT2vOrGIqtgvpVaHJSfBbz8yKReeTUWLxC27b3HMKiljr3CdKor6Q4fKGzkAqG7DaAhDqYIkC4kgbprW0Y02U8f0daa9dIxJt3GAzQewoFk75AWcqgmRmDxrAhlzoW1mBOIEq1wz1S4m4l4hWnqlWWSe5zu30Yu5gLpZmks7IpOW6MxOQoJIAIGVG7hM\\/SM329H7BjqGFLlRneBnnNAJgbz5TVS10Zr9HgJH\\/kGAy5c2edc8yOvoRmA07xv0roFvIxgOhJkgBlkgGDoO46VS\\/Z6xIOQyDIhmgHKEkaxOUD3VJg+hrNohkU5huOZidA4179Lj++pWxDpk2Jsab41Xv8ArDThv3e3jurl8d0ZYzM5v2wwvB3zqGXVrltFIka5nIBJJ6sbt3XXdw37xuzb5EbuHf4Twrm8TawTXHRkuA3GJeJC3Hzva11GYiW3bhlnctWy7KqPRUudHIuXNiwgFzaLCKCblk5Cbh1Nw5jDnSSR2eMSdHWbarOKQKpCsQkIQuzfQ5oD\\/wBnlm1EFtBvq7jPU0uMjXLoe08E5j1GxB2rEeBKyTwmpcH0BhrtpLi25S4FuKCIKyhCH6wYBzEnSip8B2uTNwPRdu2UCYsFg4yZ0DMNmqJlQsdOyFLakgqJnU3sJ6M7N7bi\\/cYW4gMB1l67MHjQnO+YMACIjWTN9PR6yCCFIIuG4NdM5IYk5YkyBqdYkbiQdGY0ifOrJIo5Mjp43e2kzeApdofD3CtHZRDKcgpc\\/gPdQGkRB9lQ7A1jNKqk1ILVLs53\\/ZuqMicSOY3e\\/wCFcd8oQ\\/cf7n\\/Su4W3XC\\/KniUtjD52idrHeexuArDXd6bSO78PqPkRlJ0t\\/szzz0mH9nY9xU\\/eA\\/GofQnAYjO+ItaW0IVydzsdQo7yJk9wPjVPpnpkXENpEJzQJO+ZBAAFewWOhhhMJhsKAJVS9w99wwXP8xYeQFcaTjpuz0PInHU104Mq4O5ZcTcOR+IMfj\\/UVT6TuMUK2QQijtb5J+r9Y+NbSYUHUjStHB4QM66aL1j7N32xWCttI0lOo7s+d8fh3s37lu727bsrHvIO\\/wBu\\/wBtaPQN+Liyd8j36\\/hXbfLT0baXZXgoF12KkjiiqSZ7yCV1ry6xfZGB+qZruktqODTnjJS6Ppf0RH9js+Tf82q3ie2PKqPoNeD4DDuNzKT99qv4o9ceVX\\/wRjNp60mu2W7FSmorIqWqFgNJRRQDwaKKKAr4jdUGA+l5+P4VYxI0qrgxv8\\/Huq0eSk+B3Sd7LaZgocrBCmSJBEHdwMH2bxvHNjHW8xdsFNxxGoOWNkt0kgghesSJAOo8a6TpBLhttstH0y+8SesCN07wazdrjlZVyW2VWQF5UF1KHOYneGjcF3cd1aMyQYXF2nuKnqxEk9ZrYhWW2rbyNInLPesd1JhenbuVNrhXVrgVhERDARMnq6kg8R1SQJgNbG47KpNlQ5HZAkT1pLMXgDsaSCdYJ3VPh8VjGcZ7KKmbUyJyyg0Oc6wXaY+iBAJqCdiFfSEwM2HuzBkBSSI4id4IBIjWI4mKcvTxiTYuhesdxkAKp1A3kluHca2xzyaWedTU7ldjLwfSQu6GwyjqHrjSSbZ08i49qnurJ6Q6Rtg3c2BDMrZR1CzXlzubjKAjGAFcwdczQYDBj015jGg1kDcN0ifpDhPwO44mJvY0PIVNmbuUROcWxtJYjKRwtxv3ndwMlexl3elkh4wCkW1ulZEKxWQwEpuZ1ceIUNrIFdJ0NiBctBhbNoAumzIgrs3KRHDs8JHdI1rPOLxug2OudSxhYyR84qdfUgxlPGPYIbOO6Qlc2HXQozRl7Gu0US\\/bECOHW8KgUdKeed9JANYGJxeNAtlbIc7HM6wJ2gVmKgltJIVfDNx1yxW8V0hMGyugcEgAhiU+aYAuDGcaiRow1EVNkVZ0OyHcPtpRaXkisJ7+PyStsZyohSBlDB2klsw0KKvdrcGnAb1u7IB3SAYJ1E8D4ipshxSEyLzFKBz+lHt+2nAc61NihuX9f1p3PJNBPOgpJ551qABbnnU15V8uh\\/uf+\\/8A\\/VXqpXnnWuc9MfQ610hstpduJsc8ZMuufLM5gQOyPfUPgtF07Z458nPRXrHSNhSJVG2reVvrD7+Qe2vb\\/SHC5mRpI0InnnSsX0U9FML0fcdkxJe46kddrcqiMNpAAGksoadxy10WJxVllIa9bGmac6CAGyTv3Zur5mKxnpuUaOjT1VGVmTbVzCgiO+N\\/21uYK1kBB1J7tw8P61UwmJwwbTEWmPV0zp\\/iEC3ub6RIA750qy\\/SNlS4a9bU29bksoyDQy8nqiGXU\\/WHfVNLRcd2aavkRlsuDyT5asYGxNi1P7q0WPncb4WwfbXnde1+kvoXg8Xibt+5jWR5RWRXtQh0touoJBLaQd5NUML8lOCuAm3jbrgEq2U2jlYb1MLoa2xZhmjqPk2\\/9Mwv+lv\\/AJH9tbWK7Y8qZ0B0SuFw9vDozMLYIDNGYyxbWI76fiT1xVpcFI\\/EW7AqWorNSxWRsFFLRQC0UUUBXxG6oMAO1591T4ioMCO151aPJSfAdKpmtMBc2cgfOaDJBBmW09+nfWQmCxQSUxaBQq5WjMCAvWLE6mT1ic30iOE1s47Bi7bNtiQDxEA6EERPlWUPRa1BG0ukERBYEdhk3BY0zZh3HXia0aMlwI+Cxaz\\/AGjMQJVQFDMMyb5GkqHHdLT4UiYbFKPnMWikKhOi75GcmRuIVxw1E6U9fRxA5cXbuYlm7SwM0TChY3qD7W4MQZL3o\\/bYAF7hK21thpEwouLJAGrHaHU9w3azFE2ircwWPkqL4HUPzhCxnLLlgZcxIAbU75HnU2I6PxhnJiAJUjVdzFpB7O5RpHGde+o8T6MyRkvMo68ggEktbCad2oBPeZ9l3orogWCWNxnZlVTIUL1d2URpx99EgT4PDXVDB7mcl1I0UQvVzLu8G9++sjFdE4s3HK4soheVALSq5gw01Unr3wRuIWyOBrfuqGEeIP0eBB4+VZLdAg3drmQfOZ9LQDboEOG3jfmjU75GlTRVMsdC2L1tCL9wOxKmVJy\\/u0VozcM4cx\\/FWgBz+RrGsejqrcFwXNQ915yLnzXBBIcaTv3gg6SNBC4noBXvG8WEl7TwEAPzYgAtMMd\\/WiQCRuiBOxtA8Ps\\/I0hbn9azej+iEtNnEEhMi9UAhc7OQOJBlRE\\/4a1pAc\\/rpUkCrzp8KTLzJpQOf0o9\\/wBtAKTzJ+FMJ51\\/GgHnWlC8\\/rQgBzyKWOedaJ5\\/Sk\\/GhIp55+NNIoFKOed5oQY9z0YssSXNxiQyklz1gwcMCNFM7RtY4DurLw9nBu6iLwA+bBZ1FtbdvLdtoVDaW+shBidVUkEgV1p55OtVGsWkIuZLatMBsqg5rjQYaJli0eJNRRbIwdhhbgW222VVUqpLhINl7uHUEghs0u8ToZE66VA4wt647umIm5lLLKqp69lO1bMkSLDTmyweqTJFdSuEths+zQNBGbKuaCSzCYkgkkx3k0lnBWkELatqIAhUUCA2YDQRAJJ8zShZiYXoLD3keReAJKPmeC+XMJJQ66udQRqIbVYG7h7AQQCTLMxnUyxJJ95pLGHVBlRFQSTCgASd5gcfGpY5\\/OiRFgTz+VU8T2x5eNXQOfyNU8X2x5VE+C0OS3Z3VLUdmpayNxDSUoooBxoiiaIoCDEbqr4L6X5fjVq8KoK+RvA76mLplZK0XiY5FEnzpLbAjQ\\/0pwFbHONC8\\/kKcOeRRPDn7KbM8\\/DSg2Qubn9KDzuFEc\\/kKXd4e6gCByfyonn9KRn5k0gHtoSBbn86BzzupQOedaUnn8\\/jQgQCOeRRPPOlJPs+z8qAOf0oAOu78Kco5g0acxSE+H2fnQDueNNPOg\\/Gga\\/p+dAWORQCb+fhTgOfyFBPO\\/8AKmk8\\/ppQCnndpSjnnfSCl554mhIHnnfWX0pcErnOVVKMCZyli8atu0HD+KeFae7kD86iv2ywAHep48GDH7BQgfbuhtVYEeB0qviLxLi0uhK5mfTqrMafxEjSRGhPCDNcwyMZZFJ7yNR5Eis+90TlcvZy2y6lbhInMJGUx9IjrcRq2s7qglF7A9hZk6bzqSJMHx041PPPP41VwWGFtcoiNNAIUAAAQJPd31Z388mpIsSeedKqXx1xVp2AEnn8KpWzmbNVZvY001vZetbqlplvdT6yNgiigUUA+koiigEYVTv2Zq7TStAZAzpuPspHxVzuFabWqYcOKm2Q4pmacXc8KX1253CtD1aj1emTIxXRQ9dudwpPXLlaPq1J6uKZMYooeu3O7+tHrtzuFX\\/VxRsBTJjFGecZc7hR65c7q0PVxR6sKZMYoz\\/XLnhS+uXO4Vf9WFHqw7qZMYozzjLvhR63c7hWh6vQMMKZMYrooeuXO4e6k9dudwrQ9Wo9XpkxijPOMueFHrlzwrQ9X8KBhxzupkxiujP9dudwo9dueFaHq1L6uKZMYozhjbvcKPXLncK0PVqPV6ZMYrooeu3O4U31y53CtHYUnq4pkxiujPOLudw576eMZc8Oftq9sBSiwORTJjFFAIzHrGr1i1FSrajhUgFQWACiiloBKKKKAdRRRQBFFFFAJNBFFFAFAoooAJpC1FFAOIppNFFALRH20UUATSA\\/CiigFIpKKKAU0UUUAUUUUACg8aKKAPyoiiigBqOfwoooANJFFFALlpRRRQC5eHnTRrHjRRQAd8UUUUB\\/\\/9k=\",\"consent_text\":\"Syarat dan Ketentuan Sebagaimana Yang Telah Di Atur Oleh RS PKU Muhammadiyah Petanahan\",\"is_approved\":true,\"version\":\"TNT \\u2013 v.1.0.1\",\"hash_consent\":\"3791b8193255d07d4783ea2480dd5f0fbaffba8ec8fd11d5823665eaf4ac6714\",\"consent_timestamp\":\"2026-01-15 21:30:13\"}','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','127.0.0.1','200','{\"url\":\"https:\\/\\/sb-api.tilaka.id\\/registerForKycCheck\",\"content_type\":\"application\\/json\",\"http_code\":200,\"header_size\":299,\"request_size\":13302,\"filetime\":-1,\"ssl_verify_result\":19,\"redirect_count\":0,\"total_time\":1.347526,\"namelookup_time\":0.000322,\"connect_time\":0.05749,\"pretransfer_time\":0.120368,\"size_upload\":11735,\"size_download\":124,\"speed_download\":92,\"speed_upload\":8708,\"download_content_length\":124,\"upload_content_length\":11735,\"starttransfer_time\":1.347469,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"10.122.1.11\",\"certinfo\":[],\"primary_port\":443,\"local_ip\":\"192.168.2.52\",\"local_port\":56038,\"http_version\":2,\"protocol\":2,\"ssl_verifyresult\":0,\"scheme\":\"https\",\"appconnect_time_us\":120082,\"connect_time_us\":57490,\"namelookup_time_us\":322,\"pretransfer_time_us\":120368,\"redirect_time_us\":0,\"starttransfer_time_us\":1347469,\"total_time_us\":1347526}','{\"success\":true,\"message\":\"Data Diterima\",\"data\":[\"31b4cc06-0c8c-4f0a-96ec-a9a428f8b751\",\"pruwoufaloihoi-2459@yopmail.com\"]}',120082,57490,322,120368,0,1347469,1347526,'TILAKA-REGISTERKYC','2026-01-15 21:30:15'),
('be3d71bc-484e-4971-9590-e31e10516c25','1768488229943','POST','https://sb-api.tilaka.id/generateUUID?name=Administrator+2&email=gacrossolohoi-2761@yopmail.com','{\"Host\":\"localhost\",\"User-Agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:140.0) Gecko\\/20100101 Firefox\\/140.0\",\"Accept\":\"application\\/json, text\\/javascript, *\\/*; q=0.01\",\"Accept-Language\":\"en-US,en;q=0.5\",\"Accept-Encoding\":\"gzip, deflate, br, zstd\",\"X-Requested-With\":\"XMLHttpRequest\",\"Content-Type\":\"multipart\\/form-data; boundary=----geckoformboundary596b572b161ef48df5de8bcd6f063fca\",\"Content-Length\":\"214\",\"Origin\":\"http:\\/\\/localhost\",\"Connection\":\"keep-alive\",\"Referer\":\"http:\\/\\/localhost\\/dtechnology\\/index.php\\/tilakaV2\\/registrasi\",\"Cookie\":\"ci_session=jsg60q4tgcte5am3pjdv3tjoprkis4rs\",\"Sec-Fetch-Dest\":\"empty\",\"Sec-Fetch-Mode\":\"cors\",\"Sec-Fetch-Site\":\"same-origin\",\"Priority\":\"u=0\"}','','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','127.0.0.1','200','{\"url\":\"https:\\/\\/sb-api.tilaka.id\\/generateUUID?name=Administrator+2&email=gacrossolohoi-2761@yopmail.com\",\"content_type\":\"application\\/json\",\"http_code\":200,\"header_size\":296,\"request_size\":1614,\"filetime\":-1,\"ssl_verify_result\":19,\"redirect_count\":0,\"total_time\":0.209006,\"namelookup_time\":0.0003,\"connect_time\":0.067579,\"pretransfer_time\":0.126658,\"size_upload\":0,\"size_download\":84,\"speed_download\":401,\"speed_upload\":0,\"download_content_length\":84,\"upload_content_length\":0,\"starttransfer_time\":0.208949,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"10.122.1.11\",\"certinfo\":[],\"primary_port\":443,\"local_ip\":\"192.168.2.52\",\"local_port\":38798,\"http_version\":2,\"protocol\":2,\"ssl_verifyresult\":0,\"scheme\":\"https\",\"appconnect_time_us\":126437,\"connect_time_us\":67579,\"namelookup_time_us\":300,\"pretransfer_time_us\":126658,\"redirect_time_us\":0,\"starttransfer_time_us\":208949,\"total_time_us\":209006}','{\"success\":true,\"message\":\"Success\",\"data\":[\"ba14c63d-a824-44d8-ba21-c94ece84d367\"]}',126437,67579,300,126658,0,208949,209006,'TILAKA-UUID','2026-01-15 21:43:49'),
('be3d71bc-484e-4971-9590-e31e10516c25','1768488230762','POST','https://sb-api.tilaka.id/registerForKycCheck','{\"Host\":\"localhost\",\"User-Agent\":\"Mozilla\\/5.0 (X11; Linux x86_64; rv:140.0) Gecko\\/20100101 Firefox\\/140.0\",\"Accept\":\"application\\/json, text\\/javascript, *\\/*; q=0.01\",\"Accept-Language\":\"en-US,en;q=0.5\",\"Accept-Encoding\":\"gzip, deflate, br, zstd\",\"X-Requested-With\":\"XMLHttpRequest\",\"Content-Type\":\"multipart\\/form-data; boundary=----geckoformboundary596b572b161ef48df5de8bcd6f063fca\",\"Content-Length\":\"214\",\"Origin\":\"http:\\/\\/localhost\",\"Connection\":\"keep-alive\",\"Referer\":\"http:\\/\\/localhost\\/dtechnology\\/index.php\\/tilakaV2\\/registrasi\",\"Cookie\":\"ci_session=jsg60q4tgcte5am3pjdv3tjoprkis4rs\",\"Sec-Fetch-Dest\":\"empty\",\"Sec-Fetch-Mode\":\"cors\",\"Sec-Fetch-Site\":\"same-origin\",\"Priority\":\"u=0\"}','{\"registration_id\":\"ba14c63d-a824-44d8-ba21-c94ece84d367\",\"email\":\"gacrossolohoi-2761@yopmail.com\",\"name\":\"Administrator 2\",\"company_name\":\"RS PKU Muhammadiyah Petanahan\",\"date_expire\":\"2026-01-18 23:59\",\"nik\":\"1243453534534534\",\"photo_ktp\":\"data:image\\/jpeg;base64,\\/9j\\/4AAQSkZJRgABAQAAAQABAAD\\/2wCEAAkGBxMTEhUSExIVFRUVFxcXFxYYFxgdFxcXGBcaGBUaFxgaHSggGholHRgYITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGxAQGi0mICUtLy0tLS0rLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf\\/AABEIALUBFwMBIgACEQEDEQH\\/xAAcAAABBQEBAQAAAAAAAAAAAAAAAQIDBAUGBwj\\/xABGEAACAQIDBAYFCQUIAQUAAAABAhEAAwQSIRMxQfAFIjJRYXEGFIGR0QcjQlKhosHh8RYzYpKxJDRDU3KDssIVNVSzw9L\\/xAAZAQEAAwEBAAAAAAAAAAAAAAAAAQIDBAX\\/xAAsEQACAgEEAQIEBgMAAAAAAAAAAQIREgMhMVEEQWEyUnGxBSMzNIHwQqHR\\/9oADAMBAAIRAxEAPwD1GiikoANFLNITQBRTC9N2tASUVHtaNqKAkpai2tG2oCSiotrRtaAlomotrRthQE1JUW1FG2oCSlqLaija0BLSVGLwo2ooCWkqLail2tASUVFthQbooCWiotqKNrQEooio9sKQXqAloqLbUC7QE1FMDg04GgFpKIpaASiiigH0UTSEUAMagdiTA1J0ipLrVDhW1Y8d3l31KVkN0hbuVTB6ze4D3b6abojsL9740MRMfCkKCuhRivQ5XOTfIm1H1F+98aNqPqL9741DRV8I9FM5dk6XRPYX73xpDdH1F+98aZa30ymEehnKuSbaj6i\\/e+NI15RqUQe\\/41FWb0\\/0eb9tbYj97acyARlRwzaMCDoNxFHCPQU5dmt6wu7KkndqfjT3vKPoLpE6tx3ca4e56IFbitbIZLYw0KwTM+zv3btyGyTajOpUJA0y6CCJ\\/wBlrjDIyW0OS+rX0M3LrXDmtOwyzIMOZJhlAEjWqUui9v5jr9uv1U95+Pj9tOLj6id29vjXEYv0Sv3gpulM9yWvsjEGWxeGuQjAT1bNgqD\\/AAL30+\\/6NYlgrMLTXVe6RckZJa6jqzW3RoByBjkZXBAAMaiHXRKv5jsTfWJKpHmfjTtssE5E0ji3H21zD9DOLNpDbS4Uxd+8yEjKyXLl9l7QgmLqaeBrPwvotfR0ukqVtix8xPzTZb2IbKSVn5pLy7PcJQSBAiaXRCb+Y7bbLE5Fjzb40G8v1F+98a5nF9F3zgThUVCbiXrbEsQEFzPlYaHNGYSNKz+lPR7FXGxNwG1OJTEWSvWBCNbC4clySDBtg5QBG3uanjLS6IUn8x223X6ie9vZxoW+sxlTylvjXGYn0ZvPbbDF0KNde495xL3QyQm0VSvXV2kEEACzbjuDsP6PXmvpiLwtljcstcQZdcuHW27K+TOIcHqTDLod5mKXRKb+Y7D1hD9FPefZxp21H1F+98a4nGeitxrZsoLNoG9irpYLOrO\\/qsKpXVBcLCSQrIuh4dZhixRS4AcqMwBkBo6wB4iZqyin6FXJrhlraj6i\\/e+NJtR9RfvfGoqKnCPRGcuyd7i\\/UX73xpu1H1F+98abc4eQplFCPQc5dk21H1F+98aVbi6\\/Nr9741BT04+VQ4R6CnLsntgNovVbgJ0PkeBotv8AZUSCD40t5ofz5NY6kUt0dGlNvZlkGlpqGnVkbBRRRQD4ooikoCHEHSoMEe15+H41NiKgwJ7Xn4fjVo8lZ8C3hrSht1GI53U1d3lXTyjiezHsk+dQkVLaPCnMs0utiasitb6ZUgXXfTWWrWVG0UU+2s1LIGgVldNdIXEu2wlu+wtl7tzLbYpctjD3gFDqCGbabMZO1JBiNa3FWKWs5OzSOxwoudJhEtANt9rmz3BNsq+EukhmTMuVb6mAd2a0Dv1uLjMSbuHdLWK2FsWVuK46zm7K3dqp6zG3NtsyAjR+FddQeeRVMS+XscBhlxmxui4b4f1RrlvKbhLXhO+RNu4DA2W5g0iYIGjauYlcSpCXzh1ZbLZjIOZC5uwTnMXGRM0ZQFbWunceVPCaVpjRTK\\/Q425jMQmKdsuIdFuXCUVLxU2hhyy5SV2Zm5AAU5iT3SKrocflSyy3Tc2wYksUVkbDXSVN21mCqL6GBOga2Dv17jZmmstMfcZexx1rE4snDkriSiLaS8coRna6Ct4sk5ptzbYMk6q+tb3oxacWybhuFjdvj5wsTkW9cW1GbgbYXXjoeNaYFORdaVRGVjTSUppKuUCiilCmgHPw8qZUjrrvikkefnUJksQLTljWO6mlqUbjRhBa30mK7Y8qfYGtR4vtisdU30eS5ZOlPqOzUlYHSFFFFAPpDS0GgK+IqDAHtedT4ndUGBPa8\\/GrR5Kz4GdNYrZWLl3Ln2aM2UHVsomJjSYislemi1sXLVsOGuLbhnKwWKqD2TxYAjhBrdxwQ22F2BbIhsxIEHTU6VlXeirBBAELtGu9S46\\/OFiWMow1zSfAit1fBzSS5DDdJ571yyqH5ogOxIgZrausDeScxEcMpM7gdUGao+pWxcN0KM7alhMmVVTPhCrpu0Bq3bPCrPdFLHOCd1Mcwal55mkI41CYaKCY7NZ2oAWVLAXCFAIntspYKO8idKz8H01cK2SbSgviHsXOsepkL5SFOssFBidAd50rVXDIF2aqoSCMoUBYO8Zd0eFU7d\\/C2wtoHDoLZYqgyAIU0chdwIziTwz+NGmSmU8Z03iLVnGXjbtOMODkyllDFEL3M2adFBUab2DDSJq5iOk7i33tAWiq2y8l2GTqjIbzZYQM2YAamFLd4Fi3ew1xTaBssLouE2xlIcZoukrubrNDHvbXfVYjAFze\\/spd1INyLZZky5TLbyuURviBVNy23Rnp6WgNh7Ti2t27ee26l8uVVuNbVgp1LMQIXWJOu6Yb3pVcCkG0u0a4AiQdLZS9cR2IPWzCww0iDOmmu5h72EVEVGw6opJRVKBQVXaEoBuIVs0jg08aq3LeCKtby4XJcdmZItw7rJZiPpMMjEneMp7qlJ9k2uitiemLqm66i09tLC3gRnDS\\/wC6WSIObK5iAR1frVBh\\/SS6XtK1kRcfIzKHPXF27aYbotldmpKsdc5AJyknobCWritAturgK3ZIYZdA28EZTu7jSW+jLAKFbNtTaBW2QiA2wd4Qx1QfCpd3yVWPRz2E9Irr4fbbFJnDGA+ipiFtsJkSWXaRA36HQHS8\\/SF7b3bSraK21nPmMI5KC2lwxBdgzNlXUALPbU1eTo+0qlFtW1UtmKhFClpDZiAILSAZ8BUR6Hw5Z3OHslrgK3G2ay6mJDmOsDA0PcKvUuytx6JOhcUb1lLpAUmcwB7LKxVx4EEEEcCCKugaz5mobOHVFVVUKqgBVUAKANwAGgFTKN+79aEAAO\\/3VlekPTS4XJNsvnzfSiMuXw\\/i+ytMgjfpXIfKGdLGv+Z\\/0rLWk4wbTOrwtOOrrxhNbb\\/Yf+3S\\/wDtz\\/OPhR+3Q\\/yW\\/nHwriqz+kel7drTtP8AVHD\\/AFHh\\/WuFeRqvhnuz8DxIK5Kv5Z6IfThf8hv5x8KT9t1\\/yG\\/nHwry9elrjanJbU7iQSf600dL3AdSjjyj8eYrXPX7OTDwL+F\\/7\\/6epftuv+Q384+FL+3Cx+4b+cf\\/AJrg8DjFurmX2juqyKyfk6q5Z2R\\/DvFkrS2+rPXehMXtrK3QMuaTE7oJG8eVOxfbHP8ASqfoh\\/c7Pk3\\/ADbuq5i+2PKupu42zw5QUNVxXCbLdmpKjs7qkqhcJooooB9FFFAV8RuqDADtedT4iq+BHa041aPJSfAnSoQ2bm0UsgEsAJJVesdCYI03d1c2cBgI1uNKggqzZisDIQYBkjNEknrcZrqsayKjtcyhIhs0BYOmpPDWueTpXDEE+rHMe0MqwCzJM7jBcpwk74rRmSQmEfCYfaOLh1WCNTpZVtFAWTADe4gbqtnpi2GYNmUKJLMOrEuNNZ\\/w3O7chNZt67htk1xMLnK3LltlIGaWUu5G8ldN3dw0io+kOkcK6lWtNkAZWKwJ2RCgLrJU7VyDoYkgdarqRRxs6G10khEyR1S0x9EHKZ47xUa9N2DueRIEwdcy5lI7wRuise70jYYgHDsdSokLuKbQ5YbjK747XhWpgcNZdLbLaVRCsoKiVgdXwBG6lXwRxyi1eURr3rwnUMI4HjHl4b6wMb0fhFunPnD3WCGCYJvMSOECSoE\\/6R3V0mICxJ714rvLADeRxj8JOlczi8TbS4c2EthTeNsXHbKGY52dpNs9abYOk9reDNWk0RFMbgHwQa3dts\\/WL7OC2XQMzjLugG8RruYhQdAKjwF3BqBdtm6RluMCFVlKrAcCBv66iEglm1k5qanSNiUDYK0pYwMzxoi2TbKzb1aCgAH+WBJjRcJ00t0gDo+e0SJ1GTYm5pkjS4ANSJ2MiSQKpZei7iOjcKVS4TcK3MioVLkQ6Jb3LpDIigk+yCapWsHgWVHQ3YeSmVrhIEpbbqjgzIg1BksSO0TUuI6ftIhRLG0tw7gKZtyiTaAOUooY22UagBl3GdNHotLN6yrCyFUNdUKVgqVuOjzpoSQSR3njvqy34oq7S3sb0diMPh7YyZlRi7gQxywCzD+EQNBugaaCpsP6SYd2Cq8ljbA0bXaLmTeO6PeKsjB28oXIMoEAdwKlf6EjyNZePvYezcC+rpoEfMB1jlz5RbQKc2XJrqIzKeNGmiFTN+4J4UwrWWnToNu7cA\\/dgkBmAzZQCTIkZZMZhIiDxqOz6SqSFKtmOY9UqywrFSwYkSsDMDAkGrZURizYJ4U7h5msrA+kC3SYRgArMCcoBCQHB10MsPCNZqRelwcU2GKDqrmzZteyjdiNB14mfommQxZerkPlBP7j\\/c\\/6V2UDvrj\\/AJQ1jYf7n\\/SsfJf5T\\/vqdn4b+5j\\/AD9mcPjcRs7bP9UT7eH2xXAtcJMkySfeTXX+k7HYGOLKPtn8Kd6Gej9oja4nNDdlFVmZl8QoJC\\/1ri0qUbPV85ueqo9IzsD0ZfxSqtu0TGkwYA8SdK1sf6H3bFqcskkSQZGnCK9R6MeyUGyIyjSAIyxwIIEVSx\\/StkyoLMNxK23ZR5sFj7aS1JMwjpRXJ490TcNq+BuD6Ec91dXWB6Y4Q2r4cRleGUj7a3bbSAe8A1XV3qR2+BJrKD9D1X0RH9js+Tf82q5iu2PLnfVX0Q\\/udnyb\\/m3fVrFHrjyrsXwI8XU\\/Xl9X9y3ZqaorNSmqEiGilpKAfSGlFFAV8RUGB+l5+FT4gaVWwf0vOrR5KT4JMdcYW2NtZeDlGnaOgnXcDqfAGsm10hi9AcOSSYJmFWLaydCZBuZo8CO6t2OdKced5rUxRhf+RxfVHq0E5MxklVBKloA1JAzDzAid1azoQZHurJ6Q6Pvu90reIVkYIouOuVsiZD1dB1gxIAmDvI0qDF9GYouWtXwCA2RGuXIlS5t5t4K\\/uw2knUzoQxNoNJmyV9lJmHCq\\/ReAuIhW5cNxsxhiSTkACpP8RCyf4mNTssVrF2YyVA14jx1A9hIB+yqDdI3ReINtxa1GYIxYsCIPVnqEazH26VbuAxpvke6RPA8J\\/LfWU2BxRuE7UbMsxAzMDlJ03Lp1OpE6Hr76iSJix3SWPxis+xtK66BJHWLQrEklgMsZxrGuXfuoTHYl3bqBFDrlJttJQ5pnrjrCF1GnW75CwXejcWMoF6YAzS7AmFAYTlJ6zSQ29fGaudEYa+mfbOHkjLE6QNdIETpoO72mEtyW9iHE4zE5cwSGNlWC7NiDdKnOuYN1YIXqwSZ91W\\/jMcJZbKuOqFGUqxIRHbtssAnaJJgglNDqD0gGke2mRVq9yMl0Y+JxOKS1mW3tXN1gFVAsWlLESGuDrMFABnQuNDEUX8Vi17NtWU3oPUYEWpIB7WplDroIuITEGtgNHdTjuo0wmUOh7917StfQJckyomBr4n2Txjuir4UndTRTnep34Kiga0xjTtw8\\/wClMogLNcf8oP8Ag\\/7n\\/SuwFcj8oY\\/cf7n\\/AErHyf0n\\/fU7vw39zH+fszz3p4\\/MtPeoPkWE\\/ZNdj6P9G7bDWlDsmVRqhiYEbxr41xXpKfmD\\/qX+tdP8nfSs2cqkZkJUg+8H3GvOW0L9z2PJ3169jq8DgzalGcvCnVj1vMniarP0KzttdvcUCIVW6kb9VOk8JqXD3XuFioaey3VBiPb+VOsYkhWUbhodCNd9Vbrcpj6Hnnyj5S6LO6fbJGn9fdUfRjzbA+qSPx\\/Gs30zxgfFlQZyQD57z\\/Wpug70lh4A\\/gfwrVx\\/KK+NqJeT9dj2r0Q\\/udnyb\\/m1XMUOuKq+iH9zs+Tf829lW8T2xHdXUvgR5up+vL6v7luzUtR2akqhIUUUUA6iikoCC\\/uqvgT2vOrGIqtgvpVaHJSfBbz8yKReeTUWLxC27b3HMKiljr3CdKor6Q4fKGzkAqG7DaAhDqYIkC4kgbprW0Y02U8f0daa9dIxJt3GAzQewoFk75AWcqgmRmDxrAhlzoW1mBOIEq1wz1S4m4l4hWnqlWWSe5zu30Yu5gLpZmks7IpOW6MxOQoJIAIGVG7hM\\/SM329H7BjqGFLlRneBnnNAJgbz5TVS10Zr9HgJH\\/kGAy5c2edc8yOvoRmA07xv0roFvIxgOhJkgBlkgGDoO46VS\\/Z6xIOQyDIhmgHKEkaxOUD3VJg+hrNohkU5huOZidA4179Lj++pWxDpk2Jsab41Xv8ArDThv3e3jurl8d0ZYzM5v2wwvB3zqGXVrltFIka5nIBJJ6sbt3XXdw37xuzb5EbuHf4Twrm8TawTXHRkuA3GJeJC3Hzva11GYiW3bhlnctWy7KqPRUudHIuXNiwgFzaLCKCblk5Cbh1Nw5jDnSSR2eMSdHWbarOKQKpCsQkIQuzfQ5oD\\/wBnlm1EFtBvq7jPU0uMjXLoe08E5j1GxB2rEeBKyTwmpcH0BhrtpLi25S4FuKCIKyhCH6wYBzEnSip8B2uTNwPRdu2UCYsFg4yZ0DMNmqJlQsdOyFLakgqJnU3sJ6M7N7bi\\/cYW4gMB1l67MHjQnO+YMACIjWTN9PR6yCCFIIuG4NdM5IYk5YkyBqdYkbiQdGY0ifOrJIo5Mjp43e2kzeApdofD3CtHZRDKcgpc\\/gPdQGkRB9lQ7A1jNKqk1ILVLs53\\/ZuqMicSOY3e\\/wCFcd8oQ\\/cf7n\\/Su4W3XC\\/KniUtjD52idrHeexuArDXd6bSO78PqPkRlJ0t\\/szzz0mH9nY9xU\\/eA\\/GofQnAYjO+ItaW0IVydzsdQo7yJk9wPjVPpnpkXENpEJzQJO+ZBAAFewWOhhhMJhsKAJVS9w99wwXP8xYeQFcaTjpuz0PInHU104Mq4O5ZcTcOR+IMfj\\/UVT6TuMUK2QQijtb5J+r9Y+NbSYUHUjStHB4QM66aL1j7N32xWCttI0lOo7s+d8fh3s37lu727bsrHvIO\\/wBu\\/wBtaPQN+Liyd8j36\\/hXbfLT0baXZXgoF12KkjiiqSZ7yCV1ry6xfZGB+qZruktqODTnjJS6Ppf0RH9js+Tf82q3ie2PKqPoNeD4DDuNzKT99qv4o9ceVX\\/wRjNp60mu2W7FSmorIqWqFgNJRRQDwaKKKAr4jdUGA+l5+P4VYxI0qrgxv8\\/Huq0eSk+B3Sd7LaZgocrBCmSJBEHdwMH2bxvHNjHW8xdsFNxxGoOWNkt0kgghesSJAOo8a6TpBLhttstH0y+8SesCN07wazdrjlZVyW2VWQF5UF1KHOYneGjcF3cd1aMyQYXF2nuKnqxEk9ZrYhWW2rbyNInLPesd1JhenbuVNrhXVrgVhERDARMnq6kg8R1SQJgNbG47KpNlQ5HZAkT1pLMXgDsaSCdYJ3VPh8VjGcZ7KKmbUyJyyg0Oc6wXaY+iBAJqCdiFfSEwM2HuzBkBSSI4id4IBIjWI4mKcvTxiTYuhesdxkAKp1A3kluHca2xzyaWedTU7ldjLwfSQu6GwyjqHrjSSbZ08i49qnurJ6Q6Rtg3c2BDMrZR1CzXlzubjKAjGAFcwdczQYDBj015jGg1kDcN0ifpDhPwO44mJvY0PIVNmbuUROcWxtJYjKRwtxv3ndwMlexl3elkh4wCkW1ulZEKxWQwEpuZ1ceIUNrIFdJ0NiBctBhbNoAumzIgrs3KRHDs8JHdI1rPOLxug2OudSxhYyR84qdfUgxlPGPYIbOO6Qlc2HXQozRl7Gu0US\\/bECOHW8KgUdKeed9JANYGJxeNAtlbIc7HM6wJ2gVmKgltJIVfDNx1yxW8V0hMGyugcEgAhiU+aYAuDGcaiRow1EVNkVZ0OyHcPtpRaXkisJ7+PyStsZyohSBlDB2klsw0KKvdrcGnAb1u7IB3SAYJ1E8D4ipshxSEyLzFKBz+lHt+2nAc61NihuX9f1p3PJNBPOgpJ551qABbnnU15V8uh\\/uf+\\/8A\\/VXqpXnnWuc9MfQ610hstpduJsc8ZMuufLM5gQOyPfUPgtF07Z458nPRXrHSNhSJVG2reVvrD7+Qe2vb\\/SHC5mRpI0InnnSsX0U9FML0fcdkxJe46kddrcqiMNpAAGksoadxy10WJxVllIa9bGmac6CAGyTv3Zur5mKxnpuUaOjT1VGVmTbVzCgiO+N\\/21uYK1kBB1J7tw8P61UwmJwwbTEWmPV0zp\\/iEC3ub6RIA750qy\\/SNlS4a9bU29bksoyDQy8nqiGXU\\/WHfVNLRcd2aavkRlsuDyT5asYGxNi1P7q0WPncb4WwfbXnde1+kvoXg8Xibt+5jWR5RWRXtQh0touoJBLaQd5NUML8lOCuAm3jbrgEq2U2jlYb1MLoa2xZhmjqPk2\\/9Mwv+lv\\/AJH9tbWK7Y8qZ0B0SuFw9vDozMLYIDNGYyxbWI76fiT1xVpcFI\\/EW7AqWorNSxWRsFFLRQC0UUUBXxG6oMAO1591T4ioMCO151aPJSfAdKpmtMBc2cgfOaDJBBmW09+nfWQmCxQSUxaBQq5WjMCAvWLE6mT1ic30iOE1s47Bi7bNtiQDxEA6EERPlWUPRa1BG0ukERBYEdhk3BY0zZh3HXia0aMlwI+Cxaz\\/AGjMQJVQFDMMyb5GkqHHdLT4UiYbFKPnMWikKhOi75GcmRuIVxw1E6U9fRxA5cXbuYlm7SwM0TChY3qD7W4MQZL3o\\/bYAF7hK21thpEwouLJAGrHaHU9w3azFE2ircwWPkqL4HUPzhCxnLLlgZcxIAbU75HnU2I6PxhnJiAJUjVdzFpB7O5RpHGde+o8T6MyRkvMo68ggEktbCad2oBPeZ9l3orogWCWNxnZlVTIUL1d2URpx99EgT4PDXVDB7mcl1I0UQvVzLu8G9++sjFdE4s3HK4soheVALSq5gw01Unr3wRuIWyOBrfuqGEeIP0eBB4+VZLdAg3drmQfOZ9LQDboEOG3jfmjU75GlTRVMsdC2L1tCL9wOxKmVJy\\/u0VozcM4cx\\/FWgBz+RrGsejqrcFwXNQ915yLnzXBBIcaTv3gg6SNBC4noBXvG8WEl7TwEAPzYgAtMMd\\/WiQCRuiBOxtA8Ps\\/I0hbn9azej+iEtNnEEhMi9UAhc7OQOJBlRE\\/4a1pAc\\/rpUkCrzp8KTLzJpQOf0o9\\/wBtAKTzJ+FMJ51\\/GgHnWlC8\\/rQgBzyKWOedaJ5\\/Sk\\/GhIp55+NNIoFKOed5oQY9z0YssSXNxiQyklz1gwcMCNFM7RtY4DurLw9nBu6iLwA+bBZ1FtbdvLdtoVDaW+shBidVUkEgV1p55OtVGsWkIuZLatMBsqg5rjQYaJli0eJNRRbIwdhhbgW222VVUqpLhINl7uHUEghs0u8ToZE66VA4wt647umIm5lLLKqp69lO1bMkSLDTmyweqTJFdSuEths+zQNBGbKuaCSzCYkgkkx3k0lnBWkELatqIAhUUCA2YDQRAJJ8zShZiYXoLD3keReAJKPmeC+XMJJQ66udQRqIbVYG7h7AQQCTLMxnUyxJJ95pLGHVBlRFQSTCgASd5gcfGpY5\\/OiRFgTz+VU8T2x5eNXQOfyNU8X2x5VE+C0OS3Z3VLUdmpayNxDSUoooBxoiiaIoCDEbqr4L6X5fjVq8KoK+RvA76mLplZK0XiY5FEnzpLbAjQ\\/0pwFbHONC8\\/kKcOeRRPDn7KbM8\\/DSg2Qubn9KDzuFEc\\/kKXd4e6gCByfyonn9KRn5k0gHtoSBbn86BzzupQOedaUnn8\\/jQgQCOeRRPPOlJPs+z8qAOf0oAOu78Kco5g0acxSE+H2fnQDueNNPOg\\/Gga\\/p+dAWORQCb+fhTgOfyFBPO\\/8AKmk8\\/ppQCnndpSjnnfSCl554mhIHnnfWX0pcErnOVVKMCZyli8atu0HD+KeFae7kD86iv2ywAHep48GDH7BQgfbuhtVYEeB0qviLxLi0uhK5mfTqrMafxEjSRGhPCDNcwyMZZFJ7yNR5Eis+90TlcvZy2y6lbhInMJGUx9IjrcRq2s7qglF7A9hZk6bzqSJMHx041PPPP41VwWGFtcoiNNAIUAAAQJPd31Z388mpIsSeedKqXx1xVp2AEnn8KpWzmbNVZvY001vZetbqlplvdT6yNgiigUUA+koiigEYVTv2Zq7TStAZAzpuPspHxVzuFabWqYcOKm2Q4pmacXc8KX1253CtD1aj1emTIxXRQ9dudwpPXLlaPq1J6uKZMYooeu3O7+tHrtzuFX\\/VxRsBTJjFGecZc7hR65c7q0PVxR6sKZMYoz\\/XLnhS+uXO4Vf9WFHqw7qZMYozzjLvhR63c7hWh6vQMMKZMYrooeuXO4e6k9dudwrQ9Wo9XpkxijPOMueFHrlzwrQ9X8KBhxzupkxiujP9dudwo9dueFaHq1L6uKZMYozhjbvcKPXLncK0PVqPV6ZMYrooeu3O4U31y53CtHYUnq4pkxiujPOLudw576eMZc8Oftq9sBSiwORTJjFFAIzHrGr1i1FSrajhUgFQWACiiloBKKKKAdRRRQBFFFFAJNBFFFAFAoooAJpC1FFAOIppNFFALRH20UUATSA\\/CiigFIpKKKAU0UUUAUUUUACg8aKKAPyoiiigBqOfwoooANJFFFALlpRRRQC5eHnTRrHjRRQAd8UUUUB\\/\\/9k=\",\"consent_text\":\"Syarat dan Ketentuan Sebagaimana Yang Telah Di Atur Oleh RS PKU Muhammadiyah Petanahan\",\"is_approved\":true,\"version\":\"TNT \\u2013 v.1.0.1\",\"hash_consent\":\"407be5681d19e675a56bcc3c6a986786d0c66fa73480da2d1410e789a0f9d9c4\",\"consent_timestamp\":\"2026-01-15 21:43:49\"}','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','127.0.0.1','200','{\"url\":\"https:\\/\\/sb-api.tilaka.id\\/registerForKycCheck\",\"content_type\":\"application\\/json\",\"http_code\":200,\"header_size\":298,\"request_size\":13301,\"filetime\":-1,\"ssl_verify_result\":19,\"redirect_count\":0,\"total_time\":0.584496,\"namelookup_time\":0.00047,\"connect_time\":0.04147,\"pretransfer_time\":0.088125,\"size_upload\":11734,\"size_download\":123,\"speed_download\":210,\"speed_upload\":20075,\"download_content_length\":123,\"upload_content_length\":11734,\"starttransfer_time\":0.584436,\"redirect_time\":0,\"redirect_url\":\"\",\"primary_ip\":\"10.122.1.11\",\"certinfo\":[],\"primary_port\":443,\"local_ip\":\"192.168.2.52\",\"local_port\":38814,\"http_version\":2,\"protocol\":2,\"ssl_verifyresult\":0,\"scheme\":\"https\",\"appconnect_time_us\":87763,\"connect_time_us\":41470,\"namelookup_time_us\":470,\"pretransfer_time_us\":88125,\"redirect_time_us\":0,\"starttransfer_time_us\":584436,\"total_time_us\":584496}','{\"success\":true,\"message\":\"Data Diterima\",\"data\":[\"ba14c63d-a824-44d8-ba21-c94ece84d367\",\"gacrossolohoi-2761@yopmail.com\"]}',87763,41470,470,88125,0,584436,584496,'TILAKA-REGISTERKYC','2026-01-15 21:43:50');
/*!40000 ALTER TABLE `dt01_service_api_logs_out` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-02-15 11:24:32
