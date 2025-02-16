DROP TABLE IF EXISTS `dt01_gen_document_file_dt`;

CREATE TABLE `dt01_gen_document_file_dt` (
  `ORG_ID` varchar(36) NOT NULL,
  `NO_FILE` varchar(100) NOT NULL,
  `FILENAME` varchar(1000) DEFAULT NULL,
  `SOURCE_FILE` varchar(255) DEFAULT NULL,
  `JENIS_DOC` varchar(10) DEFAULT NULL,
  `ASSIGN` varchar(1000) DEFAULT NULL,
  `USER_IDENTIFIER` varchar(1000) DEFAULT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  `LINK` varchar(1000) DEFAULT NULL,
  `PASIEN_IDX` varchar(1000) DEFAULT NULL,
  `TRANSAKSI_IDX` varchar(1000) DEFAULT NULL,
  `REQUEST_ID` varchar(36) DEFAULT NULL,
  `STATUS_SIGN` varchar(1) NOT NULL DEFAULT '0' COMMENT '0 : File Not Uploaded / File Belum Di Upload\r\n1 : Files Have Been Uploaded / File Sudah Di Upload\r\n2 : Request Sign Success / Sedang Process Pengajuan Tanda Tangan\r\n3 : Request Sign Gagal / Sedang Process Pengajuan Tanda Tangan\r\n4 : Sign Success / Tanda Tangan Berhasil\r\n5 : Sign Gagal/ Tanda Tangan Berhasil',
  `STATUS_FILE` varchar(1) DEFAULT '0',
  `NOTE` text NOT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`NO_FILE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `dt01_gen_document_ms`;

CREATE TABLE `dt01_gen_document_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `JENIS_DOC` varchar(10) NOT NULL,
  `DOCUMENT_NAME` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`JENIS_DOC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dt01_gen_document_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "001", "Resume Medis", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-15 10:27:29");
INSERT INTO `dt01_gen_document_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "002", "Surat Keputusan Direktur", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-15 10:27:29");
INSERT INTO `dt01_gen_document_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "003", "Surat Edaran Direktur", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-15 10:27:29");



DROP TABLE IF EXISTS `dt01_gen_enviroment_ms`;

CREATE TABLE `dt01_gen_enviroment_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `ENV_ID` varchar(36) NOT NULL,
  `ENVIRONMENT_NAME` varchar(1000) NOT NULL,
  `DEV` varchar(1000) NOT NULL,
  `PROD` varchar(1000) DEFAULT NULL,
  `URUT` int(10) NOT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ENV_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "14c65d63-a28a-4a44-bdda-de1bd7a3c5e9", "ORGID_SATUSEHAT", "", "", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "195a0602-bf50-4cc6-a8da-3a1099698c20", "CLIENTID_SATUSEHAT", "", "", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "2621c461-0ecf-491e-8495-99166b904b2d", "END_VALID_ACTIVITY", "", "", "20", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "3081bc4b-375f-444e-b84d-583414ea6015", "CERTIFICATE", "PERSONAL", "PERSONAL", "16", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "3494fa6b-f012-4c40-8cae-70ab8a398b89", "KEY_EKLAIM", "", "", "16", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "4cf1de59-1805-4649-bfd9-054b067d527d", "CLIENT_ID_TILAKA", "237ebed6-7af1-4299-9657-eb7d8bea47aa", "237ebed6-7af1-4299-9657-eb7d8bea47aa", "6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "4cf2982c-8906-43d4-8a69-bca58f0cbdf0", "SERVER_EKLAIM", "", "", "16", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "4f07a29b-f73b-4c9a-8900-da9a7d716524", "MAX_VALUE_ASSESSMENT", "", "", "19", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "53958b2a-6f73-4e4f-9703-40b64959d755", "CLIENT_SECRET_TILAKA", "d1654018-0368-46ee-b78f-7523b1060b9a", "d1654018-0368-46ee-b78f-7523b1060b9a", "7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "5a9bc4e9-77f9-441d-8e69-2785a7e147f8", "TILAKA_BASE_URL", "https://sb-api.tilaka.id/", "https://sb-api.tilaka.id/", "8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "678bb734-3849-4a84-8c1b-3526c6029f95", "TILAKALITE_URL", "", "", "9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "67aeb868-636b-4e86-9cc1-690bbba5216d", "PATHFILE_POST_TILAKA", "", "", "10", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "6938614d-276b-4161-a470-32156c1e3980", "PATHFILE_GET_TILAKA", "", "", "11", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "6bba06d0-4387-4585-95d1-42f3cbd6d682", "END_VALID_ASSESSMENT", "", "", "22", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "7b31610f-f3de-4dde-86b6-6c22e8a2f309", "COORDINATE_X", "10", "10", "14", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "89d877ee-ba14-45df-9ac0-c82060acc3e1", "CLIENTSECRET_SATUSEHAT", "", "", "3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "a7a2ef53-c1df-4911-9e02-f4bebfa9e4ee", "COORDINATE_Y", "10", "10", "15", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "ae4ade89-db55-4d46-a7e9-25ceeeb56a50", "MAX_VALUE_ACTIVITY", "", "", "18", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "b61b421d-b824-41a5-ad14-a4c412e4e11e", "HEIGHT", "50", "50", "12", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "c952ea22-ef19-4aa6-9a11-0b639cdb9dbc", "ORG_ID", "c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "17", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 10:25:12");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "dcfbceb0-9532-4e1f-99bf-776e406fe274", "AUTHURL_SATUSEHAT", "", "", "4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "dfefa28c-c03a-425c-9557-ebb6d37ba4ee", "WIDTH", "50", "50", "13", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "e847ce7a-835f-4a9a-a163-1f9e874497a0", "START_VALID_ASSESSMENT", "", "", "21", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "f7c0b2fb-956f-4938-b3f4-dba592c29d1f", "BASEURL_SATUSEHAT", "", "", "5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "fda0e07a-f1f9-4a7e-9b7f-5b2501dd5e8d", "PAGE", "1", "1", "16", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-26 09:21:18");



DROP TABLE IF EXISTS `dt01_gen_level_fungsional_ms`;

CREATE TABLE `dt01_gen_level_fungsional_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `LEVEL_ID` varchar(36) NOT NULL,
  `LEVEL` varchar(100) NOT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) NOT NULL,
  `LAST_UPDATE_DATE` datetime NOT NULL,
  PRIMARY KEY (`LEVEL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `dt01_gen_modules_ms`;

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
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`MODULES_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dt01_gen_modules_ms` VALUES ("01b1b52a-7d47-4352-b145-37d9bb2646c3", "Tilaka", "", "45304d5b-390d-4618-a08d-793b475f37b7", "tilaka", "", "Y", "bi bi-filetype-pdf", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("029f2730-7ee9-4383-a409-4b5fe0d61fcc", "Request", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "request", "N", "bi bi-file-earmark-spreadsheet", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("04ee7f51-5847-4099-9d70-7b4f4d9a989c", "Environment", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "environment", "N", "bi bi-layers", "0", "6", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("07eab05f-be52-45ce-8a53-8dd69df443f4", "User List", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "user", "N", "bi bi-layers", "0", "3", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1048ed1d-fef4-4e19-9df3-21c5fdec338f", "Meeting", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "meeting", "N", "fa-solid fa-handshake", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("113cf5a2-ff11-4091-99d5-afb1c525b23d", "Training", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "training", "N", "bi bi-bookmark-star-fill", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1226a31c-fe9d-4102-9750-a4571a08a8b5", "Setting", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "setting", "N", "bi bi-gear", "0", "8", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("123f022c-72ae-401b-9144-624dad3a906a", "Years", "", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "monev", "kunjunganyears", "N", "bi bi-layers", "0", "3", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "Sign Document", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "signdocument", "N", "bi bi-vector-pen", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1d1d4319-e834-4876-87a9-f3148e17514a", "Daily", "", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "monev", "kunjungandaily", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1eebee7e-a774-4572-a660-8ab49f6a734a", "Dashboard", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "dashboard", "dashboard", "N", "bi bi-grid", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "Employee", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "employee", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("266bd8f2-8e09-404b-985e-0196c14218fa", "Human Resource", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "hrd", "", "Y", "bi bi-people", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "Meeting", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "meeting", "schedulemeeting", "N", "fa-solid fa-handshake", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2acf8f9e-9143-4089-b4af-4da2aa25dab6", "Item Master", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "masterbarang", "N", "bi bi-ui-checks", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("361f2f6f-ab8c-4abe-827e-985d40f04f31", "Activity", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "activity", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("39425516-e7b9-42f9-b23b-02bf04bae967", "Supervisor approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-ui-checks", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("3d143838-e2e4-4d31-99a7-af6f1dca434d", "Activity", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "activity", "N", "bi bi-calendar3", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("45304d5b-390d-4618-a08d-793b475f37b7", "Bridging System", "", "", "", "", "C", "", "0", "997", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("4610c39b-de32-450b-812d-db8c37fcc643", "Repository Document", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "repodocument", "N", "bi bi-archive", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("47b4877d-7fdf-41de-a2ec-c6f467250478", "RKK", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "rkk", "N", "bi bi-people", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("49e22574-cb55-450f-9d47-6b895b2caed3", "Modules", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "mastermodules", "N", "bi bi-code-slash", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "Master System", "", "266bd8f2-8e09-404b-985e-0196c14218fa", "hrd", "", "Y", "bi bi-database-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "Submission", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-patch-plus", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "Registrasi", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "registrasi", "N", "bi bi-people", "0", "1", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5e882da7-5b62-4031-8ea2-a849d1e0aa65", "Repository Document Bulk", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "repodocumentbulk", "N", "bi bi-archive", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5e9a1b26-93fe-4dbc-af0e-2967710e4483", "Role List", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "role", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("635e52ec-e7d3-4a67-9616-fdadd0eceb61", "Nurse/Midwife Committee", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "komiteperawat", "", "Y", "fa-solid fa-user-nurse", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("65e39b7b-a4ee-4045-a6f0-73667f5026d8", "Daily", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "report", "daily", "N", "fa-solid fa-money-bill-trend-up", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("68228796-8ea0-4b51-9fef-f9ba7a365f3e", "Payroll", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "payroll", "", "N", "bi bi-cash-stack", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "IT Operation", "", "", "", "", "C", "", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("71dfb7c2-4abf-4f93-b989-7d78f255a074", "Registrasi", "", "df495870-8f19-41a1-943e-5d36ea0553db", "tilakaV2", "registrasi", "N", "bi bi-people", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("78d3e701-b660-4ea5-abb8-c935d1387e2d", "FAQ", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "faq", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "Master Client", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "masterclient", "N", "bi bi-database-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:59:33");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7c69522f-cebf-4377-945a-3324b0a26baa", "Developer", "", "", "", "", "C", "", "0", "999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "Domisili", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "domisili", "N", "bi bi-compass", "0", "999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:25:26");
INSERT INTO `dt01_gen_modules_ms` VALUES ("868afde4-08e8-4899-b596-301c1bae2258", "Service API", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "logservice", "N", "bi bi-layers", "0", "5", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "Master System", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "mastersystem", "", "Y", "bi bi-database-fill", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("951544df-6ad1-482d-89e0-4bd3d348e215", "User Access", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "useraccess", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("988c76dd-f5d3-4aca-bea2-1249f980bfc9", "Master Root System", "", "7c69522f-cebf-4377-945a-3324b0a26baa", "masterroot", "", "Y", "bi bi-database-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:59:33");
INSERT INTO `dt01_gen_modules_ms` VALUES ("99d2e39c-89a0-48bc-9117-2770c2d65caa", "SPK", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "", "N", "bi bi-people", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "Apps", "", "", "", "", "C", "", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a12feb54-1885-4be6-aa09-2c3523eec3dc", "Emergency Contact", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "emergencycontact", "N", "bi bi-book-half", "0", "2", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "Department", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "department", "N", "fa-solid fa-building-circle-check", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a894d7ed-a10e-4359-804e-8223fde34bbd", "Monitoring Evaluasi", "", "", "", "", "C", "", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("aa816bb5-2197-4c1a-90b2-f1e955063ca8", "Backup Database", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "backupdb", "N", "bi bi-database-fill", "0", "3", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("abdabe47-4395-4f92-a66d-3d8844ff34bc", "Absence", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "absence", "absence", "N", "bi bi-clock", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ac2e3614-bff5-4855-b14f-6efeb598855c", "Report KPI", "", "266bd8f2-8e09-404b-985e-0196c14218fa", "hrd", "reportkpi", "N", "bi bi-speedometer2", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "Stock Opname", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "stockopname", "N", "bi bi-ui-checks", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b56ff379-5619-4064-b572-407671edc15e", "Education", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "education", "N", "bi bi-book-half", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "Careers", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "careers", "", "Y", "bi bi-person-raised-hand", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("bacde412-a651-4c8c-8237-155b39a4595b", "Connections", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "connection", "N", "bi bi-link-45deg", "0", "7", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "Overview", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "overview", "N", "bi bi-speedometer2", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c3ef6c77-86a0-40dc-8f33-087871394836", "Document", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "document", "N", "bi bi-archive", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cbb9bd4f-15d9-4799-a942-b8601961adeb", "RKK", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "rkk", "N", "bi bi-bookmark-star-fill", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cda2e6e6-99f8-415d-b52b-320b51b0028a", "Report", "", "", "", "", "C", "", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "Table Database", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "tabledb", "N", "bi bi-table", "0", "4", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d52c72cb-f61b-4354-9ffd-6200d2d7da85", "Substitute approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-ui-checks", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "Mapping Role", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "mappingrole", "N", "bi bi-layers", "0", "2", "0", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("df495870-8f19-41a1-943e-5d36ea0553db", "Tilaka V2", "", "45304d5b-390d-4618-a08d-793b475f37b7", "tilakaV2", "", "Y", "bi bi-filetype-pdf", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "Careers List", "", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "careers", "careerslist", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "Kunjungan", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "monev", "", "Y", "bi bi-layers", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("eeb5b08f-596b-4966-8649-f3f119325a67", "Careers Apply", "", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "careers", "careersapply", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ef759cae-8fd6-4e36-9790-439e03c3a503", "Logistic", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "logistik", "", "Y", "bi bi-box", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "Medical devices", "", "", "", "", "C", "", "0", "997", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "Support", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "support", "", "Y", "bi bi-person-raised-hand", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f71515e5-57b8-41de-9c49-5e494c497563", "Position", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "position", "N", "bi bi-person-lines-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f7d07231-f33e-4050-a6f8-c846cc6aa031", "Validation", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "validation", "N", "fa-solid fa-list-check", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "Group Activity", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "groupactivity", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f9afc38a-bb61-4f98-b593-211766ec6133", "Leka", "", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "medicaldevice", "leka", "N", "bi bi-grid", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "Profile", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "profile", "", "Y", "bi bi-people", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "Position", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "position", "N", "bi bi-book-half", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");



DROP TABLE IF EXISTS `dt01_gen_organization_ms`;

CREATE TABLE `dt01_gen_organization_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `CODE` varchar(6) NOT NULL,
  `ORG_NAME` varchar(4000) NOT NULL,
  `WEBSITE` varchar(1000) DEFAULT NULL,
  `TRIAL` varchar(1) NOT NULL DEFAULT 'Y',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `LAST_UPDATED_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dt01_gen_organization_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "A9C3X7", "RS Panti Wilasa \"dr.Cipto\"", "", "N", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:49:02", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:49:02");



DROP TABLE IF EXISTS `dt01_gen_referensi_dt`;

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




DROP TABLE IF EXISTS `dt01_gen_role_access`;

CREATE TABLE `dt01_gen_role_access` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `ROLE_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` date DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dt01_gen_role_access` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "3ad9a274-a63a-4787-bf01-045f134bca98", "55b16625-efca-4093-8df0-20fc838f21b1", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:30:37", "", "2024-11-11");



DROP TABLE IF EXISTS `dt01_gen_role_dt`;

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

INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "08dbd932-4760-4b86-a712-3b8f35eba993", "6a954648-6b0b-4db0-88f2-7446218b85f5", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "09bb8e9d-050b-43f2-8aeb-f25c9842fad5", "6a954648-6b0b-4db0-88f2-7446218b85f5", "4610c39b-de32-450b-812d-db8c37fcc643", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "137d9ba6-c9d8-420a-bb7b-5f831185a5a8", "6a954648-6b0b-4db0-88f2-7446218b85f5", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "1445ed73-3f84-4b08-b9fb-31b20b57718b", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "156dd307-7328-485b-98b9-be6a52dd7c05", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f9afc38a-bb61-4f98-b593-211766ec6133", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "16bd928d-89a8-4c88-afa2-9c76860fba06", "6a954648-6b0b-4db0-88f2-7446218b85f5", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "188c8d8e-1b91-4dc0-843d-448edc18a453", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f71515e5-57b8-41de-9c49-5e494c497563", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "1a5c8a44-2ca1-48f4-a0c7-d73b7004ff59", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "1df199fc-d4d6-44c3-a2aa-619c7e83a981", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "2157e572-4abd-4834-a9cf-804b49099cdf", "6a954648-6b0b-4db0-88f2-7446218b85f5", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "29d9fe20-2ee7-49bb-95c7-c1204b86a84d", "6a954648-6b0b-4db0-88f2-7446218b85f5", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "32a09df0-dc7c-43ba-9b69-e50df4b7c94d", "6a954648-6b0b-4db0-88f2-7446218b85f5", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "33637fac-4910-4d95-a2cd-368f4c651784", "6a954648-6b0b-4db0-88f2-7446218b85f5", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "362e49f2-2b86-4bad-a994-25f73f267eba", "6a954648-6b0b-4db0-88f2-7446218b85f5", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "37d6efa7-f8ef-436b-873a-6db24f19a6cb", "6a954648-6b0b-4db0-88f2-7446218b85f5", "6b2a3be9-6716-42b3-9df1-cdd0d68dfc52", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:10:54");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "3afee680-5eb1-47d1-85cc-197d5a2e9003", "6a954648-6b0b-4db0-88f2-7446218b85f5", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "3f1e3f0f-39e0-4178-bfde-46de6382d738", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:55:01", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "429b561a-84bf-476a-a544-be4f68f4c614", "6a954648-6b0b-4db0-88f2-7446218b85f5", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "43cbf970-e4ec-4901-9f0f-3715e6e60e06", "6a954648-6b0b-4db0-88f2-7446218b85f5", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "455efd07-2cf6-4bbf-8df7-b01d40d3e682", "6a954648-6b0b-4db0-88f2-7446218b85f5", "868afde4-08e8-4899-b596-301c1bae2258", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "486f07d9-591c-41b2-ab44-99da7adf047a", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "490f5a51-975e-4276-a83c-e134b300d47b", "6a954648-6b0b-4db0-88f2-7446218b85f5", "df495870-8f19-41a1-943e-5d36ea0553db", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:55:44", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "4aecd6eb-7dc9-4040-92d6-47dac9501d68", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "4c6d7b31-5431-4e25-aa88-c6a76724ec44", "6a954648-6b0b-4db0-88f2-7446218b85f5", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:55:22", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "4d73381a-cef2-45f0-842b-901094486c2b", "6a954648-6b0b-4db0-88f2-7446218b85f5", "b56ff379-5619-4064-b572-407671edc15e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "4ec8dd9e-1a54-4b80-b632-30c267793fc6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "526eadfb-f13e-4b58-a157-9b5320eb995c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "527edc68-78f4-49b2-be70-e507525ebf9d", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "541e771d-74bf-47e5-b33f-546d87032b6a", "6a954648-6b0b-4db0-88f2-7446218b85f5", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "549f4c40-6237-4ee3-b2e7-8f19ea453a6e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "55edbeed-25e3-4079-a507-78336e347833", "6a954648-6b0b-4db0-88f2-7446218b85f5", "49e22574-cb55-450f-9d47-6b895b2caed3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "5c64e270-00b0-4551-9129-21cc937e51a6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "07eab05f-be52-45ce-8a53-8dd69df443f4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "5cfac6de-dcd8-4de4-bf32-7f03a456299f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "7c69522f-cebf-4377-945a-3324b0a26baa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "615a5652-60a5-4b1d-94bb-87e366510a13", "6a954648-6b0b-4db0-88f2-7446218b85f5", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "6aa1ec2b-6ca5-4618-a510-5a79fa773186", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2b01f779-9d92-439b-8afd-a114c4ecfae6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:10:54");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "6e5d44c4-857a-4a57-87bb-7b7bdd79d6ae", "6a954648-6b0b-4db0-88f2-7446218b85f5", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "6e8086ef-61a5-4f06-b440-83455cf5e9ad", "6a954648-6b0b-4db0-88f2-7446218b85f5", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "6f80009d-b65b-405d-a32b-a27cb98e3cb2", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "6fe02abe-337c-40eb-be6d-1ca755805b5d", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "740d4063-e200-44b5-ad1b-f6e05a1e0527", "6a954648-6b0b-4db0-88f2-7446218b85f5", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "7a48a0c0-cc73-463c-be0a-4e0e0070ca75", "6a954648-6b0b-4db0-88f2-7446218b85f5", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "8101594d-c436-421c-b29d-74171fbaa275", "6a954648-6b0b-4db0-88f2-7446218b85f5", "71dfb7c2-4abf-4f93-b989-7d78f255a074", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:55:44", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "8967e90a-612d-45d0-b79f-1211d1f7b204", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "98360711-028c-4e6a-afd4-940478534098", "6a954648-6b0b-4db0-88f2-7446218b85f5", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "99be7a40-ecb1-41c9-8ea5-89a1bae21781", "6a954648-6b0b-4db0-88f2-7446218b85f5", "47b4877d-7fdf-41de-a2ec-c6f467250478", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "9bf782d4-c728-4348-8b2c-5a28d5594707", "6a954648-6b0b-4db0-88f2-7446218b85f5", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:10:54");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "9d746c0b-24f2-4d0c-8aa2-9b681dd0f98c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "21dff9a1-aaf1-4cc6-8e76-ab3d14121993", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:10:54");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "9ea6746a-158e-461d-a438-8d52c13a3bf3", "6a954648-6b0b-4db0-88f2-7446218b85f5", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "a518a901-2a59-4a78-b2d2-8783c0b34d7c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "a9390a79-d99b-4e7a-9a8a-0f8ecb40693b", "6a954648-6b0b-4db0-88f2-7446218b85f5", "bacde412-a651-4c8c-8237-155b39a4595b", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "ad2067ff-f908-4a4d-b38b-e63b5c70c697", "6a954648-6b0b-4db0-88f2-7446218b85f5", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "b0e5739e-519c-413e-bd71-e65e4ec58d28", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:10:55");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "b3ae4397-0f7a-4329-8b53-03267e951b4c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "266bd8f2-8e09-404b-985e-0196c14218fa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "b4961d89-2e90-4f7d-bdfe-912534570a9c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "39425516-e7b9-42f9-b23b-02bf04bae967", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "b89e96e0-5662-4564-865c-c33a31562776", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "b9b473a7-65d1-4f74-833b-d04af90a9965", "6a954648-6b0b-4db0-88f2-7446218b85f5", "eeb5b08f-596b-4966-8649-f3f119325a67", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "bbe67505-0f57-4c51-8309-216c5c5f86be", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "c64661d4-5418-491c-9c86-2ae47d128f3d", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "c945ed10-82f0-4607-b6e4-126326dbb1b9", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "db100e43-000c-48d4-b1b1-914eaf108180", "6a954648-6b0b-4db0-88f2-7446218b85f5", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "dcd0a4bd-8b01-4378-b376-2ff6fe00bcb1", "6a954648-6b0b-4db0-88f2-7446218b85f5", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "e5f6eef1-d69c-41f3-aa58-1e18e9ff9ee3", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "e6d1a154-1dd1-471b-9780-cf10ac603e7e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "123f022c-72ae-401b-9144-624dad3a906a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "e79b8d68-4e83-4e89-8124-76d0f1da996a", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "e94e2419-0294-4cc6-a06c-cb3d97ae3f7c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "e9af1ae0-3b32-4151-8a83-fc9b00f8c9fc", "6a954648-6b0b-4db0-88f2-7446218b85f5", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "efba65fa-fcfd-4310-887d-7fbcfd352c72", "6a954648-6b0b-4db0-88f2-7446218b85f5", "951544df-6ad1-482d-89e0-4bd3d348e215", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "f2d39eec-6153-41eb-a216-2324b7112ea9", "6a954648-6b0b-4db0-88f2-7446218b85f5", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "f5ce7424-f66f-4b63-ae01-e314459aa4f4", "6a954648-6b0b-4db0-88f2-7446218b85f5", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "f7110342-8d26-4ecd-8e28-69568d2eaeb8", "6a954648-6b0b-4db0-88f2-7446218b85f5", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "fa7687c8-3ac2-40fa-a8bd-d12c1f9cdd93", "6a954648-6b0b-4db0-88f2-7446218b85f5", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "faf07b0f-4242-4c6c-84d3-b10a9e543b9d", "6a954648-6b0b-4db0-88f2-7446218b85f5", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "fc355589-19f0-40c6-b135-60f419495d00", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "fc7df4d8-88fe-40b1-a03a-e0d8cef9f8b1", "6a954648-6b0b-4db0-88f2-7446218b85f5", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-28 12:08:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 11:56:09");



DROP TABLE IF EXISTS `dt01_gen_role_ms`;

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

INSERT INTO `dt01_gen_role_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "Admin Tilaka", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:48:53", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:48:53");
INSERT INTO `dt01_gen_role_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "62bbb558-dbb3-426a-9847-d535bf0596c4", "Default", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:48:53", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:48:53");
INSERT INTO `dt01_gen_role_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "67865cf2-792a-4557-82a3-a0edb6947738", "IT Operation", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:48:53", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:48:53");
INSERT INTO `dt01_gen_role_ms` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "6a954648-6b0b-4db0-88f2-7446218b85f5", "Developer", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-11 04:33:28", "", "2024-11-11 04:33:28");



DROP TABLE IF EXISTS `dt01_gen_user_data`;

CREATE TABLE `dt01_gen_user_data` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `USER_ID` varchar(36) NOT NULL,
  `USERNAME` varchar(4000) NOT NULL,
  `PASSWORD` varchar(4000) NOT NULL DEFAULT '3832333435363731',
  `NAME` varchar(1000) NOT NULL,
  `NAME_IDENTITY` varchar(255) DEFAULT NULL,
  `NIK` varchar(100) NOT NULL COMMENT 'Nomor Induk Kepegawaian',
  `NIP` varchar(100) DEFAULT NULL COMMENT 'NIP PNS Jika DiPerlukan',
  `IDENTITY_NO` varchar(16) DEFAULT NULL COMMENT 'No KTP',
  `NPWP_NO` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `SEX_ID` varchar(1) NOT NULL,
  `ADDRESS` varchar(4000) DEFAULT NULL,
  `KLINIS_ID` varchar(36) DEFAULT NULL,
  `MARITAL_ID` varchar(100) DEFAULT NULL,
  `RELIGION_ID` varchar(100) DEFAULT NULL,
  `KATEGORI_ID` varchar(36) DEFAULT NULL,
  `PLACE_BIRTH` varchar(100) DEFAULT NULL,
  `IMAGE_PROFILE` varchar(1) NOT NULL DEFAULT 'N',
  `IMAGE_IDENTITY` varchar(1) NOT NULL DEFAULT 'N',
  `PLACE_OF_BIRTH` varchar(255) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `ETHNIC_ID` varchar(100) DEFAULT NULL,
  `BLOOD_TYPE` varchar(3) DEFAULT NULL,
  `RHESUS` varchar(3) DEFAULT NULL,
  `CLOTHES_SIZE` varchar(10) DEFAULT NULL,
  `PHONE` varchar(255) DEFAULT NULL,
  `DUTY_DAYS` int(11) DEFAULT 0,
  `DUTY_HOURS` int(11) DEFAULT 0,
  `HOURS_MONTH` int(11) DEFAULT 0,
  `REGISTER_ID` varchar(36) DEFAULT NULL,
  `USER_IDENTIFIER` varchar(1000) DEFAULT NULL,
  `REVOKE_ID` varchar(39) DEFAULT NULL,
  `ISSUE_ID` varchar(42) DEFAULT NULL,
  `CERTIFICATE` varchar(1) DEFAULT NULL,
  `CERTIFICATE_INFO` varchar(100) DEFAULT NULL,
  `START_ACTIVE` datetime DEFAULT NULL,
  `EXPIRED_DATE` datetime DEFAULT NULL,
  `REASON_CODE` varchar(1) DEFAULT NULL,
  `SUSPENDED` varchar(1) NOT NULL DEFAULT 'N',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dt01_gen_user_data` VALUES ("c6da4a54-3a97-4165-9b49-d89aaa12c1b4", "55b16625-efca-4093-8df0-20fc838f21b1", "1521027", "3832333435363731", "Teguh Irawan", "Teguh Irawan", "12345", "", "8374916052831472", "", "hereuquebutre-2042@yopmail.com", "L", "", "", "", "", "", "", "N", "Y", "", "", "", "", "", "", "", "0", "0", "0", "", "", "", "", "", "", "", "", "", "N", "1", "", "2024-11-28 09:41:22");



DROP TABLE IF EXISTS `dt01_hrd_activity_dt`;

CREATE TABLE `dt01_hrd_activity_dt` (
  `ORG_ID` varchar(36) NOT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `ACTIVITY_ID` varchar(36) NOT NULL,
  `START_DATE` date DEFAULT NULL,
  `START_TIME_IN` varchar(5) DEFAULT NULL,
  `START_TIME_OUT` varchar(5) DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `END_TIME_IN` varchar(5) NOT NULL,
  `END_TIME_OUT` varchar(5) NOT NULL,
  `QTY` int(11) NOT NULL DEFAULT 0,
  `DURASI` int(11) NOT NULL DEFAULT 0,
  `TOTAL` int(11) NOT NULL DEFAULT 0,
  `ACTIVITY` text NOT NULL,
  `USER_ID` varchar(36) NOT NULL,
  `ATASAN_ID` varchar(36) NOT NULL,
  `VALIDASI_BY` varchar(36) NOT NULL,
  `VALIDASI_DATE` datetime DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '0' COMMENT '0 : Baru\r\n1 : Disetujui\r\n2 : Revisi\r\n9 : Di Tolak',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `dt01_hrd_assessment_dt`;

CREATE TABLE `dt01_hrd_assessment_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `PERIODE` varchar(7) DEFAULT NULL,
  `ASSESSMENT_ID` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `NILAI` int(11) DEFAULT NULL,
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `dt01_hrd_klinis_ms`;

CREATE TABLE `dt01_hrd_klinis_ms` (
  `KLINIS_ID` varchar(36) NOT NULL,
  `NAME` varchar(1000) NOT NULL,
  `AREA` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `NOMOR` int(11) DEFAULT 0,
  PRIMARY KEY (`KLINIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `dt01_hrd_position_dt`;

CREATE TABLE `dt01_hrd_position_dt` (
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
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `dt01_hrd_position_ms`;

CREATE TABLE `dt01_hrd_position_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `POSITION_ID` varchar(36) NOT NULL,
  `POSITION` varchar(500) DEFAULT NULL,
  `RVU` int(11) DEFAULT NULL,
  `LEVEL_FUNGSIONAL` varchar(36) NOT NULL,
  `LEVEL` int(11) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) NOT NULL,
  `LAST_UPDATE_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `KATEGORI_ID` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`POSITION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `dt01_hrd_todo_dt`;

CREATE TABLE `dt01_hrd_todo_dt` (
  `ORG_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) NOT NULL,
  `TODO_ID` varchar(36) NOT NULL,
  `TODO` varchar(4000) NOT NULL,
  `PRIORITY` varchar(1) NOT NULL DEFAULT '1',
  `STATUS` varchar(1) NOT NULL DEFAULT '0',
  `DUE_DATE` date DEFAULT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`TODO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `dt01_service_api_logs_out`;

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




