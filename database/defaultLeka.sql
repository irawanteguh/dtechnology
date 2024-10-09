DROP TABLE IF EXISTS dt01_hrd_position_dt;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS dt01_hrd_assessment_dt;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS dt01_hrd_activity_dt;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS dt01_hrd_position_ms;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS dt01_hrd_klinis_ms;

CREATE TABLE `dt01_hrd_klinis_ms` (
  `KLINIS_ID` varchar(36) NOT NULL,
  `NAME` varchar(1000) NOT NULL,
  `AREA` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `NOMOR` int(11) DEFAULT 0,
  PRIMARY KEY (`KLINIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS dt01_gen_level_fungsional_ms;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS dt01_gen_enviroment_ms;

CREATE TABLE `dt01_gen_enviroment_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `ENV_ID` varchar(36) NOT NULL,
  `ENVIRONMENT_NAME` varchar(1000) NOT NULL,
  `DEV` varchar(1000) NOT NULL,
  `PROD` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ENV_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS dt01_gen_modules_ms;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO dt01_gen_modules_ms VALUES ("01b1b52a-7d47-4352-b145-37d9bb2646c3", "Tilaka", "", "45304d5b-390d-4618-a08d-793b475f37b7", "tilaka", "", "Y", "bi bi-filetype-pdf", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("029f2730-7ee9-4383-a409-4b5fe0d61fcc", "Calendar", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-calendar3", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("07eab05f-be52-45ce-8a53-8dd69df443f4", "User", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "user", "N", "bi bi-layers", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("1048ed1d-fef4-4e19-9df3-21c5fdec338f", "Meeting", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "meeting", "N", "fa-solid fa-handshake", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("113cf5a2-ff11-4091-99d5-afb1c525b23d", "Training", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "training", "N", "bi bi-bookmark-star-fill", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("1226a31c-fe9d-4102-9750-a4571a08a8b5", "Setting", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "setting", "N", "bi bi-gear", "0", "8", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("123f022c-72ae-401b-9144-624dad3a906a", "Years", "", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "monev", "kunjunganyears", "N", "bi bi-layers", "0", "3", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "Sign Document", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "signdocument", "N", "bi bi-vector-pen", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("1d1d4319-e834-4876-87a9-f3148e17514a", "Daily", "", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "monev", "kunjungandaily", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("1eebee7e-a774-4572-a660-8ab49f6a734a", "Dashboard", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "dashboard", "dashboard", "N", "bi bi-grid", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "Employee", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "employee", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO dt01_gen_modules_ms VALUES ("266bd8f2-8e09-404b-985e-0196c14218fa", "Human Resource", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "hrd", "", "Y", "bi bi-people", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "Meeting", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "meeting", "schedulemeeting", "N", "fa-solid fa-handshake", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("2acf8f9e-9143-4089-b4af-4da2aa25dab6", "Head of Division approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-ui-checks", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("361f2f6f-ab8c-4abe-827e-985d40f04f31", "Activity", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "activity", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO dt01_gen_modules_ms VALUES ("39425516-e7b9-42f9-b23b-02bf04bae967", "supervisor approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-ui-checks", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("3d143838-e2e4-4d31-99a7-af6f1dca434d", "Activity", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "activity", "N", "bi bi-calendar3", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("45304d5b-390d-4618-a08d-793b475f37b7", "Bridging System", "", "", "", "", "C", "", "0", "997", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("4610c39b-de32-450b-812d-db8c37fcc643", "Repository Document", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "repodocument", "N", "bi bi-archive", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("47b4877d-7fdf-41de-a2ec-c6f467250478", "RKK", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "rkk", "N", "bi bi-people", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("49e22574-cb55-450f-9d47-6b895b2caed3", "Modules", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "mastermodules", "N", "bi bi-code-slash", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "Master System", "", "266bd8f2-8e09-404b-985e-0196c14218fa", "hrd", "", "Y", "bi bi-database-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "Submission", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-patch-plus", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "Registrasi", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "registrasi", "N", "bi bi-people", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("5e9a1b26-93fe-4dbc-af0e-2967710e4483", "Role", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "role", "N", "bi bi-layers", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("635e52ec-e7d3-4a67-9616-fdadd0eceb61", "Nurse/Midwife Committee", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "komiteperawat", "", "Y", "fa-solid fa-user-nurse", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("65e39b7b-a4ee-4045-a6f0-73667f5026d8", "Daily", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "report", "daily", "N", "fa-solid fa-money-bill-trend-up", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("68228796-8ea0-4b51-9fef-f9ba7a365f3e", "Payroll", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "payroll", "", "N", "bi bi-cash-stack", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "IT Operation", "", "", "", "", "C", "", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("78d3e701-b660-4ea5-abb8-c935d1387e2d", "FAQ", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "faq", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "Master Client", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "masterclient", "N", "bi bi-database-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:59:33");
INSERT INTO dt01_gen_modules_ms VALUES ("7c69522f-cebf-4377-945a-3324b0a26baa", "Developer", "", "", "", "", "C", "", "0", "999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "Domisili", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "domisili", "N", "bi bi-compass", "0", "999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:25:26");
INSERT INTO dt01_gen_modules_ms VALUES ("868afde4-08e8-4899-b596-301c1bae2258", "Service API", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "logservice", "N", "bi bi-layers", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "Master System", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "mastersystem", "", "Y", "bi bi-database-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("951544df-6ad1-482d-89e0-4bd3d348e215", "User Access", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "useraccess", "N", "bi bi-layers", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("988c76dd-f5d3-4aca-bea2-1249f980bfc9", "Master Root System", "", "7c69522f-cebf-4377-945a-3324b0a26baa", "masterroot", "", "Y", "bi bi-database-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:59:33");
INSERT INTO dt01_gen_modules_ms VALUES ("99d2e39c-89a0-48bc-9117-2770c2d65caa", "SPK", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "", "N", "bi bi-people", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "Apps", "", "", "", "", "C", "", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("a12feb54-1885-4be6-aa09-2c3523eec3dc", "Emergency Contact", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "emergencycontact", "N", "bi bi-book-half", "0", "2", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "Department", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "department", "N", "fa-solid fa-building-circle-check", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("a894d7ed-a10e-4359-804e-8223fde34bbd", "Monitoring Evaluasi", "", "", "", "", "C", "", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("aa816bb5-2197-4c1a-90b2-f1e955063ca8", "Backup Database", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "backupdb", "N", "bi bi-database-fill", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("abdabe47-4395-4f92-a66d-3d8844ff34bc", "Absence", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "absence", "absence", "N", "bi bi-clock", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "HR approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-ui-checks", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("b56ff379-5619-4064-b572-407671edc15e", "Education", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "education", "N", "bi bi-book-half", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "Careers", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "careers", "", "Y", "bi bi-person-raised-hand", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("bacde412-a651-4c8c-8237-155b39a4595b", "Connections", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "connection", "N", "bi bi-link-45deg", "0", "7", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "Overview", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "overview", "N", "bi bi-speedometer2", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("c3ef6c77-86a0-40dc-8f33-087871394836", "Document", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "document", "N", "bi bi-archive", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("cbb9bd4f-15d9-4799-a942-b8601961adeb", "RKK", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "rkk", "N", "bi bi-bookmark-star-fill", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("cda2e6e6-99f8-415d-b52b-320b51b0028a", "Report", "", "", "", "", "C", "", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "Table Database", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "tabledb", "N", "bi bi-table", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("d52c72cb-f61b-4354-9ffd-6200d2d7da85", "Substitute approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "cuti", "", "N", "bi bi-ui-checks", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "Mapping Role", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "mappingrole", "N", "bi bi-layers", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "Careers List", "", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "careers", "careerslist", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "Kunjungan", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "monev", "", "Y", "bi bi-layers", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO dt01_gen_modules_ms VALUES ("eeb5b08f-596b-4966-8649-f3f119325a67", "Careers Apply", "", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "careers", "careersapply", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("ef759cae-8fd6-4e36-9790-439e03c3a503", "Paid leave", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "cuti", "", "Y", "bi bi-airplane", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "Medical devices", "", "", "", "", "C", "", "0", "997", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO dt01_gen_modules_ms VALUES ("f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "Support", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "support", "", "Y", "bi bi-person-raised-hand", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("f71515e5-57b8-41de-9c49-5e494c497563", "Position", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "position", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO dt01_gen_modules_ms VALUES ("f7d07231-f33e-4050-a6f8-c846cc6aa031", "Validation", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "validation", "N", "fa-solid fa-list-check", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO dt01_gen_modules_ms VALUES ("f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "Group Activity", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "groupactivity", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO dt01_gen_modules_ms VALUES ("f9afc38a-bb61-4f98-b593-211766ec6133", "Leka", "", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "medicaldevice", "leka", "N", "bi bi-grid", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "Profile", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "profile", "", "Y", "bi bi-people", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO dt01_gen_modules_ms VALUES ("fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "Position", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "position", "N", "bi bi-book-half", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");



DROP TABLE IF EXISTS dt01_gen_organization_ms;

CREATE TABLE `dt01_gen_organization_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `CODE` varchar(6) NOT NULL,
  `ORG_NAME` varchar(4000) NOT NULL,
  `WEBSITE` varchar(1000) NOT NULL,
  `TRIAL` varchar(1) NOT NULL DEFAULT 'Y',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `LAST_UPDATED_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO dt01_gen_organization_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2K9UWX", "RSU Mutiasari", "", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-03-13 14:31:56", "", "2024-07-23 08:12:16");
INSERT INTO dt01_gen_organization_ms VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "6FRWNG", "Aktivo Indonesia Sukses", "", "N", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 12:16:20", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 12:16:20");

DROP TABLE IF EXISTS dt01_gen_referensi_dt;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1d388997-3327-4746-8e80-0d49f37d1303", "forking postman collection", "informasi langkah-langkah forking postman collection", "https://satusehat.kemkes.go.id/platform/docs/id/postman-workshop/forking/#forking-api", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9fd2c349-c12b-470c-867c-f21b80df021c", "import postman collection", "formasi langkah-langkah import postman collection.", "https://satusehat.kemkes.go.id/platform/docs/id/postman-workshop/import/#import-api", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b18e4ceb-2363-4377-985c-b35dcc0a4408", "Certification Practice Statement", "", "https://repository.tilaka.id/CP_CPS.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c491f152-a328-4868-9331-87142f3f6415", "Kebijakan Privasi", "", "https://repository.tilaka.id/kebijakan-privasi.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d00e3b9e-933b-42d8-a493-19a41a01cc9a", "Perjanjian Pemilik Sertifikat", "", "https://repository.tilaka.id/perjanjian-pemilik-sertifikat.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d2b728d9-4f81-44bd-b2dc-acdf546123d8", "Kebijakan Jaminan", "", "https://repository.tilaka.id/kebijakan-jaminan.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d326eb39-6755-4ff8-a094-d396102424e3", "Postman Collection Satu Sehat", "Akses Postman Collection SATUSEHAT melalui web browser Anda.", "https://s.id/PostmanSATUSEHAT", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e4ff825f-b7d1-4aee-98a7-ae71409de23d", "Link 8", "", "", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO dt01_gen_referensi_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ed77c32b-e6ea-4883-971e-999b2d522b10", "Link 9", "", "", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");



DROP TABLE IF EXISTS dt01_gen_role_access;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO dt01_gen_role_access VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "89eb6ef1-715a-435b-9b3a-a6622df99f76", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:21", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23");
INSERT INTO dt01_gen_role_access VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ecd1c53c-c835-4087-8a2e-169f02415d94", "55b16625-efca-4093-8df0-20fc838f21b1", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:22:37", "", "2024-07-13");
INSERT INTO dt01_gen_role_access VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "f78c6ab9-daa5-4529-907c-1d58d096c8eb", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "77738726-a358-414d-8043-1b3defa6d1d0", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23");



DROP TABLE IF EXISTS dt01_gen_role_dt;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0029ec33-e60c-4002-82e0-530b63016c27", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "002f4be8-5c6a-417a-9862-c4112c06c0e0", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "266bd8f2-8e09-404b-985e-0196c14218fa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "015a8377-6c52-4160-b88a-1fde8a97f06e", "64502c81-163a-4ded-a7c9-3136024d26d8", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0182cb9e-f9d3-4dd0-b299-c0069a351c20", "6a954648-6b0b-4db0-88f2-7446218b85f5", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01c57db4-8d4e-4b03-b05f-07db19bfebf3", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01e57543-9716-40c8-bfda-b4958a5ebec8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "025e0311-5831-44d8-9731-b15c7d71aa8e", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "026f9d98-d93b-4fca-a781-2f3eff591e65", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02dab332-b2c8-43d7-8589-ccaaa82400ce", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02ddc524-e9fb-4e28-b3e0-1e965609fe15", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "03084e5d-2989-4876-8355-31a3a1088909", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "035dba8c-8b85-4a17-89f8-5443fbc23590", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "03dc0497-a3a3-4288-b7c8-491e32acf938", "64502c81-163a-4ded-a7c9-3136024d26d8", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "043eabb4-3c75-4e84-b01d-fce1e083bd12", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "04ca3fe0-e910-4dbf-9a22-c1d18ac2681a", "77738726-a358-414d-8043-1b3defa6d1d0", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0501fce3-d0b6-414e-baad-3676736daabf", "6a954648-6b0b-4db0-88f2-7446218b85f5", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06222353-23f4-4571-b0aa-850e44259793", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06a5c0cc-9fda-43ce-bfc5-5a8ef3d4f9ab", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06ed7617-9e5e-4035-9765-526f2cf5a144", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "07a2ff5c-0131-4206-8f2b-88b94d8bc470", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0817608d-077b-4cae-a7c2-f4307e021bfe", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "08bbb927-a8ab-4d0d-a216-3d9a399ab6db", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0996026a-ff80-4021-9506-9099e86662d8", "6a954648-6b0b-4db0-88f2-7446218b85f5", "07eab05f-be52-45ce-8a53-8dd69df443f4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-20 11:47:28", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0a150278-d4d6-47b7-ab61-e75daeec8d3e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0ad5ec46-4d00-4fe9-83ff-fa25419f2132", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0afdef1b-5b94-47b0-80b2-58fa82a6aa08", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "0b354ee8-881c-459c-ac0e-28766eec4052", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0b5c1317-5d0f-458a-b5fa-3b02a0be2b9f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0b7e657b-97e2-44f1-be6e-5769e218cc97", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0baf07f8-37ba-4e50-9854-4297a47935a1", "64502c81-163a-4ded-a7c9-3136024d26d8", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "0bcec148-179d-44ab-bed0-02ef8adcdaa7", "77738726-a358-414d-8043-1b3defa6d1d0", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0c0c20c0-ba51-4144-b61a-25a2c2fe7710", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0c2f15ef-1de7-4d19-961c-da951c362da1", "64502c81-163a-4ded-a7c9-3136024d26d8", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0de9b39a-70c6-4882-a4a8-9365e6230c45", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e108cdf-bb3f-409c-82db-3344da2c4481", "6a954648-6b0b-4db0-88f2-7446218b85f5", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e8e9c87-7dec-4aff-a811-fefa42004c5b", "6a954648-6b0b-4db0-88f2-7446218b85f5", "47b4877d-7fdf-41de-a2ec-c6f467250478", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0eb2cbf3-0154-4cfd-90fb-ba513d3d09b7", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0eda2b57-84d1-4c6b-a501-cb6d83abb995", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "868afde4-08e8-4899-b596-301c1bae2258", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0edbfff0-545b-4338-9f31-702d5dad797a", "64502c81-163a-4ded-a7c9-3136024d26d8", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "0f96fc19-a78d-41f2-b5ab-ed1578b14aaa", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "10d5ed5a-6960-48ea-835f-1562886090f6", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "10efdc1d-3c51-4a71-a56b-8a9e90d0dc3b", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "117e32f8-a450-4563-a404-0cfbd379d5d1", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "11a1e209-845e-4c4b-b367-eb2e4526effd", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "11a921e5-884c-4c7e-8d1a-0dabebdc0587", "77738726-a358-414d-8043-1b3defa6d1d0", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "11d4bf97-8f2e-41bb-8849-4072daf981e9", "77738726-a358-414d-8043-1b3defa6d1d0", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1283daaf-d3ca-4a21-9cf7-cbf453166f19", "64502c81-163a-4ded-a7c9-3136024d26d8", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12bb2f26-3056-40b9-a2fe-81f1d6829084", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12d36403-8f2d-4592-86b6-55e778e3e652", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "4610c39b-de32-450b-812d-db8c37fcc643", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13053dd1-6d1e-4da8-8d72-3c230deb10df", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13b7c83c-36e3-4dfa-a9e0-edb4e209a39f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13fe6cdb-1d54-4b29-abcf-c0a404e9eca9", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "14b17641-e8ec-440b-9652-8c9776cfb08f", "77738726-a358-414d-8043-1b3defa6d1d0", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "14be757c-5d55-4f7c-82a6-b1c7bc8b4491", "6a954648-6b0b-4db0-88f2-7446218b85f5", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "155629ee-ed4a-4f04-b943-a2be0597e175", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "156e6319-8d4d-46cf-98ed-240b1f9d91a8", "6a954648-6b0b-4db0-88f2-7446218b85f5", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "15e1d6de-a2e7-4d20-9d98-caece1cbcd00", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "17e0864e-83d8-4557-8931-4e18d0f7e768", "64502c81-163a-4ded-a7c9-3136024d26d8", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1949cc9d-2488-46cd-86d8-94280555a9a6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "19b27bdd-52dd-4671-88f8-44709d81de9e", "64502c81-163a-4ded-a7c9-3136024d26d8", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "1b25e9fe-41d1-41d4-a286-cdc9eacc13c5", "77738726-a358-414d-8043-1b3defa6d1d0", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1bc2a88f-cff9-4986-8ec5-3d1910f3580c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ca5ded7-ed17-43f2-bcff-39d4ae1d650d", "64502c81-163a-4ded-a7c9-3136024d26d8", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1cd01b6e-b398-40fc-98e3-29ebc00024a5", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1d6fef80-d33b-40d5-a2fb-554c41bc4596", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1d970793-38a1-4f41-a5d5-12db3fd23684", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1deb6414-b74d-473a-8e57-dc4630dab542", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1dec2d85-77fd-489e-9701-df913c3bb8bc", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ee7a69e-1808-46e6-8ad3-7fe3c138c2dc", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1f0bbd74-4f02-4719-867e-fd274657a6cc", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1f56e9a6-5899-40a0-a04f-6d8d63147e5d", "64502c81-163a-4ded-a7c9-3136024d26d8", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1f9af6d2-3bde-4583-8998-66f392893c51", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "1f9beecc-90e1-465f-82a5-5d78053b63ae", "77738726-a358-414d-8043-1b3defa6d1d0", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "204fe811-a83e-4ab2-b8ed-8f10c68dc96d", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "20b63fbd-17c0-4763-92ba-5cec5504c53a", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "219afa3a-3639-4605-b556-a63ab14b91fb", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "224c32a5-52d6-4a2b-bcf2-080b07414a5f", "64502c81-163a-4ded-a7c9-3136024d26d8", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2273a3b6-3ac7-4d27-82c0-701a8d5b3c4c", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2424bb86-2568-4fad-ab3b-f61c805e3f8e", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2469b500-ffe7-4658-965a-fec63fde0d69", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "259a06d5-7753-4d7b-a709-65889eb956bf", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "25fbd28f-c00b-4262-9bf3-1f3b50d2fc5a", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "868afde4-08e8-4899-b596-301c1bae2258", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "25fed72d-9e54-4e05-b752-65d7ba82703f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "26d9eee6-d23a-497f-bbf0-a618176412ff", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "26fc3f07-bfac-4acf-a6a4-ae6efa06d412", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "273f5550-86e1-49ec-ab1b-246c6a4789d5", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "278bdb5b-edb7-4031-9081-ae62a5e82ed4", "77738726-a358-414d-8043-1b3defa6d1d0", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "28d9552b-e057-4a52-9645-9b10380454bc", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "295e2f7d-9af3-4989-a827-9e5a42439813", "77738726-a358-414d-8043-1b3defa6d1d0", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "29612966-aef0-421a-84fc-b973374e16bd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b934419-dd25-4649-9a1e-9c023e49073a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b9e9a73-908c-4e52-8491-70ac7fb09eca", "6a954648-6b0b-4db0-88f2-7446218b85f5", "7c69522f-cebf-4377-945a-3324b0a26baa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "2c4e58ea-f62f-4de6-b662-c2d99b9eb487", "77738726-a358-414d-8043-1b3defa6d1d0", "951544df-6ad1-482d-89e0-4bd3d348e215", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2c73123b-5630-4405-803f-e2e3352b8de6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "eeb5b08f-596b-4966-8649-f3f119325a67", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2d5405fa-4f97-49b2-88dd-baec48c5f95e", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "123f022c-72ae-401b-9144-624dad3a906a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2e916cbe-28c4-484d-8bad-8f3e18e64154", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f240980-343c-45ad-b390-0115693580c9", "64502c81-163a-4ded-a7c9-3136024d26d8", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f4cd1da-c4ed-4059-84f0-d308a4ea00c3", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f4f3b78-d97f-4f8c-97de-d219a9c5763c", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "31ec4113-c2f8-4fa0-9ed7-9faa6b7cecae", "64502c81-163a-4ded-a7c9-3136024d26d8", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "325b6974-8341-42c7-9fba-36032d26f46f", "77738726-a358-414d-8043-1b3defa6d1d0", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32ae660a-ef1d-4c48-9ea7-95ad0ffeb384", "6a954648-6b0b-4db0-88f2-7446218b85f5", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32d755ba-5c44-49d6-aeef-db1b1689ec42", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "33df9934-fd0d-4e25-b5ae-dfa212996eaa", "77738726-a358-414d-8043-1b3defa6d1d0", "f9afc38a-bb61-4f98-b593-211766ec6133", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "34084880-736c-4ac2-8a6b-28faa9b3b231", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3461d551-fc5e-4b35-8f88-8d305756325e", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "34c4db66-d1ba-439f-99df-2db3abf76c70", "6a954648-6b0b-4db0-88f2-7446218b85f5", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "35acca2d-b7d8-4794-a5dc-fdb5f8a8cd6c", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "361447a8-03ea-4269-8f68-af40f1b5ee71", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3674fbb6-898d-41cf-ad22-f4532402877c", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "376bd38c-416c-4956-9ee3-12194f896586", "77738726-a358-414d-8043-1b3defa6d1d0", "868afde4-08e8-4899-b596-301c1bae2258", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "37c9eb18-75ea-4f7b-82d3-07bd750b8e5c", "77738726-a358-414d-8043-1b3defa6d1d0", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "37d619ce-2852-4215-ac15-397a4326194f", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "385df03e-65f6-4965-a1e8-6926f86cfb19", "64502c81-163a-4ded-a7c9-3136024d26d8", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b3939f5-aac5-430f-bfb9-113bd7a7edd4", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b95b543-ff03-41c4-af60-a43072a2b2fe", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b9cec3d-7aad-43da-aeb8-b3dfa71777a8", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f71515e5-57b8-41de-9c49-5e494c497563", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3c1e1e82-9a15-4d9b-bbdf-f3fee3e657a5", "6a954648-6b0b-4db0-88f2-7446218b85f5", "49e22574-cb55-450f-9d47-6b895b2caed3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:30:42");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3c6ae0b1-c284-4c4b-b1bd-d63640386de1", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3c6f82a2-a8f0-42f8-a2a7-3e30355bad1a", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "3c7a9dd7-e0cb-44f8-bdf7-eb348000e908", "77738726-a358-414d-8043-1b3defa6d1d0", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3d6167e9-d883-4a93-b48b-c1e61d90eab6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3ddaec45-af26-4e98-8803-77f39e141ed9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3e0f529e-ef4b-44fb-af94-6f60cc8f0b4c", "64502c81-163a-4ded-a7c9-3136024d26d8", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3eb9fb14-2abd-47a4-80f5-bb8523e3b7da", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "bacde412-a651-4c8c-8237-155b39a4595b", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "3fae3643-8503-4ba5-82e6-03ab2d4d5c45", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "40adb892-412a-4289-b8a3-b35bc2ea44ab", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "40f12d06-4894-44ca-a299-0b1a14f831ef", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "41393c0f-7b7a-4b3a-a596-c0697c26eb36", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4145c359-25f5-4881-9f81-be12a6481243", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4188ca6a-6484-402e-8e53-be2103d1c0d8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "418f7b4b-da97-4e2d-b06b-c39719a3e04a", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4270bee5-998f-4f7d-9057-73b183827ceb", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "4282570d-e9d7-4def-b706-d442b954ff8e", "77738726-a358-414d-8043-1b3defa6d1d0", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "43581f7c-d2fd-42bb-b348-70cdcda66f93", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4366b996-bed1-4c42-b92d-8c4386c586f1", "64502c81-163a-4ded-a7c9-3136024d26d8", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44b1909d-3478-4b96-bbe9-f62f55d99901", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "452bf64d-e88f-4135-99d9-db6283f80cdf", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45ced394-94b1-4d55-a9a9-4502066542d3", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "45e69eee-b92c-4ba3-bc85-7a6276e37448", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45eb676b-ad96-4721-9791-3f69fb324091", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45ec95fa-4e10-4dab-a36e-547432fe1734", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "464c788c-c845-4b52-b2ab-bd7672fa18a1", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "46a36ca6-3ed2-499a-ac79-c7ceac7c74db", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "47021dae-7e1a-4d00-bf6f-0cd38d3e21aa", "64502c81-163a-4ded-a7c9-3136024d26d8", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "484f679f-aa97-41e7-9667-6280250003d0", "77738726-a358-414d-8043-1b3defa6d1d0", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4884520f-6aac-4d95-b8b6-924ffee49d5b", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4885cc01-4b59-44e9-a8b2-63c718625552", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "48a69a86-14d9-4ee6-bdc7-ef455410add3", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4934b3b2-d20e-4a44-9cc7-3a86cf0e5d91", "6a954648-6b0b-4db0-88f2-7446218b85f5", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4976ffbd-b437-4b2a-acfd-6c89bb2d9c2a", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "49981229-751b-45bf-b2b7-02800af0c545", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "47b4877d-7fdf-41de-a2ec-c6f467250478", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4a9276e5-d6db-451f-bf97-1f495a4f8287", "64502c81-163a-4ded-a7c9-3136024d26d8", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4b2bbcb3-5688-4327-b47b-16aff77ea6bd", "64502c81-163a-4ded-a7c9-3136024d26d8", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4b508dfc-693a-4f92-847c-7f09d69fd234", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4c69021d-01a0-4085-9a6f-b8af9577299a", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4d7f1a98-f848-44f3-bae9-87efcce9cc66", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4dd3bd38-dcee-428c-a255-81e77a8a4f94", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "4dd3e1d6-71f7-4051-ab83-90bd2de8a3d2", "77738726-a358-414d-8043-1b3defa6d1d0", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4de05d42-7e0b-44fb-a67c-39a1d6a25ecd", "6a954648-6b0b-4db0-88f2-7446218b85f5", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4e19e4c8-a31a-43bd-b205-8a704c26337a", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "4e2edebc-ab08-4fe8-a9cf-dbf05ea60e2e", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4eefb394-221e-4aac-a7a0-51dbe1aff584", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f166b42-18b7-46e8-bb29-9cfa22639f75", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f625dea-2dcf-4af1-b5fb-793b20d482e8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4fab9c66-ef56-4b56-9e69-4d405bf2b6cb", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4fcdd1f2-a59c-46b7-8c51-e478e3e48f9a", "6a954648-6b0b-4db0-88f2-7446218b85f5", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "500008e4-309d-41f1-a3c7-addc27e92cab", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "50456331-e2a5-46bb-937c-383d60bc056f", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "50f6c7eb-24ad-4379-af29-72bf169e8400", "6a954648-6b0b-4db0-88f2-7446218b85f5", "4610c39b-de32-450b-812d-db8c37fcc643", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "5160d592-8085-4fff-ade1-5111fba6f0d3", "77738726-a358-414d-8043-1b3defa6d1d0", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5167f8b5-08d2-491b-8d35-81ef84411adc", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52b83d97-7525-4656-ab08-4f9b370d94fe", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52cd795f-5c08-4fa5-ae20-064146461b78", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "530bc982-c125-4409-b7bd-674547aec880", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "53e4914e-2873-4c31-abcc-0676b11fb809", "64502c81-163a-4ded-a7c9-3136024d26d8", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5402cc4c-1cc2-4500-849e-06541ade4834", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "540aa73e-431e-43da-b9bc-0a8e255b9764", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "5485fa7b-d60d-49aa-b1dd-044afeccddf7", "77738726-a358-414d-8043-1b3defa6d1d0", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "548950b2-4c93-4f10-8ba5-359928473501", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "553f4942-ba2a-4410-849b-171821fae0f2", "64502c81-163a-4ded-a7c9-3136024d26d8", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "55500c11-ea6c-44ac-a3b0-2df6e8859509", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "5597b25a-697b-4305-b3fd-f36b0212aa75", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5644ca98-3407-46ef-a25f-b96ea0a11daf", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "564ce1fb-4912-4fb3-9fb6-d8b3c8e7479e", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5681c3fc-a80c-4ea0-9fe4-64e835e6d925", "64502c81-163a-4ded-a7c9-3136024d26d8", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "56952bf0-75fc-494d-ab48-d3a73f48d715", "64502c81-163a-4ded-a7c9-3136024d26d8", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "56a05ae6-78e7-4034-a10e-e8ef3731f216", "77738726-a358-414d-8043-1b3defa6d1d0", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "56e60283-39f1-4e22-88fc-2ee17746e5de", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "574e6166-9751-4173-aa8a-bccd8d767b20", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "57ce98b8-dcc3-4f75-b9e3-9d897d5f5ea4", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "58161ac3-a672-45c0-8dc0-b42b71ccc297", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-18 09:40:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "583d0863-43a7-4b5b-8acd-9cfd7aa66678", "6a954648-6b0b-4db0-88f2-7446218b85f5", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "58d8bdd1-97c1-40ce-8e3b-cd2e1bfc8544", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "5942f1cf-0865-4cc6-b819-8601a9a504a6", "77738726-a358-414d-8043-1b3defa6d1d0", "07eab05f-be52-45ce-8a53-8dd69df443f4", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "599a15f1-7493-407c-bf01-5b9c7b19d140", "64502c81-163a-4ded-a7c9-3136024d26d8", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "5ae2ce5a-acfb-482f-91e7-40e3a57cb62a", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5b880513-76d1-4938-8b1b-87e547f93a07", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "5beed648-72be-4207-a792-d7033fbe7344", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c176aa4-077f-40d7-984d-cd2bd3643f4b", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c4c0779-070b-4bb9-87f2-83fbcca4cbae", "6a954648-6b0b-4db0-88f2-7446218b85f5", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c84e28a-78ba-4fea-9255-8e72d90b8795", "6a954648-6b0b-4db0-88f2-7446218b85f5", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5d16402d-eddc-44d3-ba30-d79248c9aaa6", "64502c81-163a-4ded-a7c9-3136024d26d8", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5d38e13c-6eff-4f3c-b321-81fe8a5c0bf3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5e248e65-07ab-4122-a779-6e8117c671af", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ec6d173-195c-4c87-ad98-d578300513ce", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "5f558840-376a-4c63-a4fd-5386c5c61b82", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6026b12a-bfed-426c-acb8-e01916b97ecf", "64502c81-163a-4ded-a7c9-3136024d26d8", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "60b08c07-6e8f-4652-8f45-31010662b6d4", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "60dfdf52-685d-49ad-92bd-60f00e2d40f9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "639f1309-67ec-42ca-8634-0b2ac8fd0bc0", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6417c46d-d054-418c-ac27-7d7b0a3a84de", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6450030b-4c78-4a5e-ba2d-20234e553c65", "64502c81-163a-4ded-a7c9-3136024d26d8", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "64707bc0-2ff7-47ac-a5ca-e50989b5e4a7", "64502c81-163a-4ded-a7c9-3136024d26d8", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65010331-bfca-4e4a-990c-a77a171cef95", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6551b6e7-8d7e-45c4-87f2-cfc0a2c54701", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65838dd7-98ed-4c5d-a06b-541788f503a0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "6669dff1-1917-425b-bdfa-a166c2931898", "77738726-a358-414d-8043-1b3defa6d1d0", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "666c66db-e19d-4cbf-8c87-ba32d87dd4d2", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "6709c07f-7f01-4d74-94a5-e200f82b23a6", "77738726-a358-414d-8043-1b3defa6d1d0", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "6739f641-b5ff-4e56-9de6-8b25fcf079ef", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "7c69522f-cebf-4377-945a-3324b0a26baa", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "67483cc9-4064-4bfc-9af4-1324c69a0b9a", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "67b125b4-73df-4cfb-88dd-1839cfb3e7bc", "77738726-a358-414d-8043-1b3defa6d1d0", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "69740967-74a0-4c91-8d73-1352a9d9c5d9", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "69dca67d-e018-4f8e-b7e3-f5b6a699b099", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a030c88-0735-4108-a841-6ea81adef44d", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "6b9a0c0f-1458-466c-9a4f-af84dfda2e46", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6bcbf32c-89cc-4d2c-a60e-965e3fac7d3e", "64502c81-163a-4ded-a7c9-3136024d26d8", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6c786a19-1226-4abe-a3fb-db20b1889265", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6cfa8efc-1c35-468f-80dc-5577f074afde", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d214f07-42d1-4c37-9c83-80f37e26cb42", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d669579-20ad-465c-a9a0-217e896ff47b", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d875aa1-32e7-4602-80f2-b06ed7631d64", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6dcd34eb-6063-495a-b45b-722cd8943ee9", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6e8420ab-c0d1-404f-963e-b3077ffcb797", "6a954648-6b0b-4db0-88f2-7446218b85f5", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6eaaa4e2-aa1a-4e98-895e-d7ca4f301331", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "47b4877d-7fdf-41de-a2ec-c6f467250478", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6f23d6c5-564f-444f-bbd7-fb2341e691a9", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6f57ebca-f56e-4705-b35c-d0adad73a44e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "70c1713c-f3f2-497e-8304-51f88f4f269e", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "711434a6-4c82-4b5e-a716-5e7bdd7ebf4c", "64502c81-163a-4ded-a7c9-3136024d26d8", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "725310d7-a89e-4e2f-839e-aad3718b33a1", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7342288f-0906-4a33-b2d6-cf4c054d55ac", "6a954648-6b0b-4db0-88f2-7446218b85f5", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "736f1d50-c32b-4a90-a198-a3a5201d47b6", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "73ffbdcd-3d91-4633-9ced-4a1cc14e3997", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "7436bf10-c7c0-451a-a256-6aea973d69a1", "77738726-a358-414d-8043-1b3defa6d1d0", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7524c2e3-5fed-422e-aa1f-0446de57c729", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "75cdd40a-296c-4527-a77b-4cef491296b4", "64502c81-163a-4ded-a7c9-3136024d26d8", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "75d9cf17-7b88-4c05-bdfe-0b5f3948df30", "64502c81-163a-4ded-a7c9-3136024d26d8", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "76b98aa2-2428-4626-9ae5-b88db88abd80", "77738726-a358-414d-8043-1b3defa6d1d0", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "77051ebb-b73b-4d0a-a198-283a512c43c0", "64502c81-163a-4ded-a7c9-3136024d26d8", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "77075d32-212c-4330-8bf6-7fcf27f28643", "64502c81-163a-4ded-a7c9-3136024d26d8", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "77e9de47-9312-48c5-b4e5-b444dae244a8", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "77ea8597-c3b1-492f-9010-2d914b5557bf", "77738726-a358-414d-8043-1b3defa6d1d0", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "78d5d507-68c0-46ed-a026-e041a3e06e8d", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "78f74425-849c-4b57-a720-3e120f2fb709", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "79159a22-f94c-418c-bdd9-a04f8c180b43", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "7a10429d-32fa-472b-bd23-84a419c3695b", "77738726-a358-414d-8043-1b3defa6d1d0", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7ad3ca13-1d78-498d-ba59-2cdbdc163c20", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7b9b439b-42bd-4ee4-b43c-b34749b8bdce", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c61a663-4042-4fb3-ba33-5ff889953159", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c72eeca-f0c8-49fd-ae41-a0b77d1cf480", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7cbd8194-f4da-4db1-adac-191a90a81752", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "7d4b464a-e2c5-48b9-b208-9ba557e420b1", "77738726-a358-414d-8043-1b3defa6d1d0", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "7d6abb4a-5170-48e8-8947-8627095b2ab7", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7fa37b08-4a56-4c46-bc9a-594fa5155328", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7fcdd090-1d69-443b-a1f2-8df150d286a7", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "801287fb-88de-4bfe-bc14-af11be08bf7a", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f71515e5-57b8-41de-9c49-5e494c497563", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "80390789-56e0-4ec7-949f-68ab2318411f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "80598e69-cf5d-4beb-bc12-e4f12693090a", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "81194483-bcc8-4e39-81aa-956679044464", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "81a3d647-9a93-4a11-bb30-a6d455c93846", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "81f68156-5c51-4698-a6db-a3537f41a2a3", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "823db3aa-ee08-46fa-8f9d-b29414425f39", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "82668ea5-024f-4525-8c08-c27909867115", "77738726-a358-414d-8043-1b3defa6d1d0", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "82910b7f-49f4-4cba-bc40-832eb8eb3995", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "82c1f478-e82b-46af-99da-ae0553c68092", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "8339a65a-e04a-4ad0-9f5a-086c0493f91c", "77738726-a358-414d-8043-1b3defa6d1d0", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "834151cd-7bf0-49e0-acf8-33705336fe41", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8358c956-bc8d-4485-9416-56ebadfc11c7", "6a954648-6b0b-4db0-88f2-7446218b85f5", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:30:42");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "845ec93e-9dfe-46fc-a29c-8be7b434fc83", "6a954648-6b0b-4db0-88f2-7446218b85f5", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "849366bb-a3d0-415c-8416-8890ea6f1ecf", "6a954648-6b0b-4db0-88f2-7446218b85f5", "951544df-6ad1-482d-89e0-4bd3d348e215", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:42:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "849704bd-07f7-4ebe-a41d-699f5f0ec5bc", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "84cd0e59-d45b-4a31-aa14-cd2c159f2323", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "85157dcd-8033-40ce-bd49-b1d148226c6d", "64502c81-163a-4ded-a7c9-3136024d26d8", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "8543bd01-a434-4313-a19e-4fc761c28f7f", "77738726-a358-414d-8043-1b3defa6d1d0", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8572df4c-eb5f-4181-b3c9-0164f7aad64d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "858400ff-195d-4543-92eb-c0567b7067f4", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8676c319-38af-4f59-9887-892045f77f99", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "266bd8f2-8e09-404b-985e-0196c14218fa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "869e20c6-61d6-4609-ad2c-04737558522f", "64502c81-163a-4ded-a7c9-3136024d26d8", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "86af7d56-16eb-4e88-b7e7-971a7fec98ab", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "86ff3504-6667-4d60-a697-832a443b7ec1", "77738726-a358-414d-8043-1b3defa6d1d0", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "8718d158-611f-4a16-8cbc-3e0157544f1b", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "88b94db5-1afd-4579-b800-ce6587acace7", "64502c81-163a-4ded-a7c9-3136024d26d8", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89093d23-c020-4466-b02b-2815d94940b7", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b91787b-ab0e-4609-96de-db37754a4e2d", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b98d03f-1d67-41bf-9822-5a6973402664", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "8c9c4b08-1897-4c53-a3a5-135edb5edc81", "77738726-a358-414d-8043-1b3defa6d1d0", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8e004fdc-7fc5-46a7-9dc7-ac24fbb9db73", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "8e254f5f-ec76-47b2-b4cd-43cdc57550ab", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8e582ac3-80f5-4316-b57f-fe196197f9af", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "8ef08c43-d2af-46e2-8a5d-77e93e09f7ff", "77738726-a358-414d-8043-1b3defa6d1d0", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8f30bf18-6b60-48fd-b806-ac8977f3bdd6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8fcd1693-9840-4651-ad88-254c1be6058b", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "90550405-802e-41d0-b99d-f37a35b0548c", "77738726-a358-414d-8043-1b3defa6d1d0", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "90c3f612-3d93-49a8-96c3-e617d451e1e9", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "90d0ccf5-2eea-46cb-b5c9-a0fee92e3ec8", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "90ec4424-5dcf-4e5e-b448-7d67dcac3766", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "91022b9d-9374-4647-a1d1-152ec7cabb4a", "64502c81-163a-4ded-a7c9-3136024d26d8", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "92082509-cbf8-4f30-9463-f68cf1ccbb0b", "77738726-a358-414d-8043-1b3defa6d1d0", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "92764384-3c98-4eba-9b01-4650a2b67750", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "94146168-659c-4d09-a21f-aa0abb516980", "77738726-a358-414d-8043-1b3defa6d1d0", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "948acec9-3e81-4a2e-9788-9526e094698a", "77738726-a358-414d-8043-1b3defa6d1d0", "b56ff379-5619-4064-b572-407671edc15e", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "94993be2-461f-4efa-8d0a-1045163ee1a1", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "94f06ccc-c248-4f59-846b-2b43ce0caa83", "64502c81-163a-4ded-a7c9-3136024d26d8", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "954700c6-f853-4d06-b3da-386e58d21064", "64502c81-163a-4ded-a7c9-3136024d26d8", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "96817ae1-1940-4c34-8ae7-64b631503373", "64502c81-163a-4ded-a7c9-3136024d26d8", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "97250c2f-b22e-4c5b-bd35-b00be2a98537", "77738726-a358-414d-8043-1b3defa6d1d0", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "978f6993-30f6-4e2d-8b43-1d47da7f428f", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "97ceffe8-ee82-43b8-8272-e76419a29880", "77738726-a358-414d-8043-1b3defa6d1d0", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "980f5a72-b238-4ce4-b812-bc29f3a036bb", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98207d80-06ad-4a7e-a332-aaee6cbed7dd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98302201-1548-429d-bca9-41be3973c673", "64502c81-163a-4ded-a7c9-3136024d26d8", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98783853-4767-4e21-8bdd-2f7f86980a52", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98f01f27-8602-44a9-b72c-46543e17a616", "6a954648-6b0b-4db0-88f2-7446218b85f5", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9978e3cd-4e86-4fc3-a4ec-226bb62df3c7", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "998ea5b5-b782-4756-82b8-2cd013384e42", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9ad62dd6-6d45-492e-972b-501ca0cbf702", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "9b73d33a-d719-4589-8a5b-762234f5f793", "77738726-a358-414d-8043-1b3defa6d1d0", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9bddc681-1eea-42ae-ac01-693ebc8c568b", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9c2bd381-c028-4e9e-a085-53bd23f5567d", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9d3b4773-9eb5-41f6-84e0-aa1bdcc75e99", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9d6cbd4b-a02c-440f-bbff-cd45255208cf", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9da39fce-0ab2-4567-b69e-264955bf76b9", "6a954648-6b0b-4db0-88f2-7446218b85f5", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9da57bba-b7e6-4b3b-a36a-48c8484e92b9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9eaaccf0-7036-4ad1-a9a5-35c6d4353717", "6a954648-6b0b-4db0-88f2-7446218b85f5", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9eb13056-cc4a-4ee2-a8be-898f099c32b7", "6a954648-6b0b-4db0-88f2-7446218b85f5", "123f022c-72ae-401b-9144-624dad3a906a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "9f26ee87-c374-4d3d-a44b-daf318cf8b84", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "b56ff379-5619-4064-b572-407671edc15e", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "9f7b09ec-d7db-4a28-874c-af56ad2ca445", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9ffcbd61-29f6-439e-ad1c-ebd3be7b9bcd", "6a954648-6b0b-4db0-88f2-7446218b85f5", "bacde412-a651-4c8c-8237-155b39a4595b", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a052244e-8536-4a1a-8ccf-b56d23135902", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "a0b534c6-081a-495f-a2d8-f8f91d204928", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "123f022c-72ae-401b-9144-624dad3a906a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "a0d2d5d9-4142-47c4-a6a4-163cf0b8ef32", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a0fe88e1-0b77-4853-a3df-44b3c5aa19c3", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "a1f1d3b2-a4c9-4dbf-b78c-6559432adfb2", "77738726-a358-414d-8043-1b3defa6d1d0", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a21a983f-5c39-49e9-a97a-fc9b360b0bb2", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2a84a47-42d5-4ed4-9ce4-f8a05621172e", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2a914f3-2e46-4d94-9fe8-4c72d5d5d122", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2d40ad4-54e7-4b1a-bf54-538e80819028", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a530d9dd-4b1a-4a44-aa54-21f6299006ea", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a53aab7b-5915-4808-b998-2e4d7742d9a6", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a55b00a5-8ba1-4450-9678-4ed187cf867f", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "a6184e20-1419-4cd7-81c3-f28c4deb996d", "77738726-a358-414d-8043-1b3defa6d1d0", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a62f3c89-e543-4c57-8068-03d8e3a07cff", "64502c81-163a-4ded-a7c9-3136024d26d8", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a63aa45d-c5e2-4e48-895d-2698cfd968a3", "64502c81-163a-4ded-a7c9-3136024d26d8", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "a63dfa73-4c2e-4309-b30b-50c403fde477", "77738726-a358-414d-8043-1b3defa6d1d0", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a6485677-eff9-4129-9639-0f34d1401b66", "64502c81-163a-4ded-a7c9-3136024d26d8", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "a6a86906-1794-4090-bb02-54e4bee0f17b", "77738726-a358-414d-8043-1b3defa6d1d0", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a6d21301-9007-4edb-a3bf-fe5e126e5ff6", "64502c81-163a-4ded-a7c9-3136024d26d8", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a7431997-4397-4528-ac76-a8a494859d7b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "a7440d41-8a14-4afc-8884-0438bd34948b", "77738726-a358-414d-8043-1b3defa6d1d0", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a7b6e615-9d01-4448-8b86-d0e851c90fd6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a88af91b-c969-422f-9be5-43ade9a5df1f", "64502c81-163a-4ded-a7c9-3136024d26d8", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "a9a78ac7-2761-422e-ac87-c2779043b40f", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "aa2e0349-877e-45cc-9e37-55bebfa520a8", "64502c81-163a-4ded-a7c9-3136024d26d8", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac53d969-5e6c-4a11-890a-7cfeb3b625f9", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f9afc38a-bb61-4f98-b593-211766ec6133", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-18 09:40:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac59edd5-aa1e-4a0f-a553-a5bee9945bf8", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "acf6fb51-b2a9-4bad-bb96-14cc58167ce5", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "ad1bf366-1496-4886-b2e3-82200f965f19", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae3c1cb5-0750-4538-adf6-d4792164d20e", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae501e57-63fd-436c-a0df-c966acc1ab24", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae92a183-eb31-496d-a082-562b4559ed55", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "aef494fb-bc7c-4de3-b23c-1775237ceddc", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "afb0a017-9697-4d50-9a12-a8dcc7835630", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b0d54c29-5cf9-4000-a555-695877461fb1", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b1137505-f149-4f5b-85bb-17886b0c88d1", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b11ff0b6-3abb-4bce-9f20-c2782d839555", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b12b9174-78e1-4ea0-9c70-74f05147c2ed", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b1b8c407-5b91-48ad-b26e-5167101730da", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "b1f633b1-b845-49a9-9c89-4494e4e4ceac", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "b2a52ffd-c313-4ce5-8e42-892ef739e30c", "77738726-a358-414d-8043-1b3defa6d1d0", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b304c82a-aedd-47f5-a226-a26f1c58c7d0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b3441353-afb9-4e36-85bd-449ee93d8ecb", "64502c81-163a-4ded-a7c9-3136024d26d8", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b4b54c0c-495b-44b5-be10-97a27c50fa9a", "64502c81-163a-4ded-a7c9-3136024d26d8", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b4e233d5-2665-4254-a982-7d0d510abf2a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b4f5ce28-210d-413a-8419-2a3e5817b638", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "b5dcb1a1-33dc-4d50-aaa5-c098022725c8", "77738726-a358-414d-8043-1b3defa6d1d0", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b5f24265-2a73-4f5f-a108-d89312327438", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b61a32c8-1d68-4925-be5d-913b66e271c8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "b56ff379-5619-4064-b572-407671edc15e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b7694941-eb01-4007-ab14-12c03949a101", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b7f5d21c-b1ec-4977-8efb-73089825f6d0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b82fa907-2ab0-431a-abc1-7979ee9cf969", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b8764207-31b0-40f6-b091-bdd6dacd0061", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b8c7ab5e-68ad-4e30-8f7a-cd7debe4c8a9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "b97e9169-b68d-4342-bdc1-a2aad6801e43", "77738726-a358-414d-8043-1b3defa6d1d0", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b9b77023-76e5-49ab-82d8-d6a1c533c596", "6a954648-6b0b-4db0-88f2-7446218b85f5", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:30:42");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bae99fa6-bd9e-4b6d-89e8-e74e6c90369c", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb64a4fc-5dd1-40f1-8f51-1ddb10f344fd", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb86f78d-f7a3-481a-af74-cbe0342ee429", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bc829fc2-d164-4bb4-b078-f048d8a57985", "64502c81-163a-4ded-a7c9-3136024d26d8", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bca64b24-c47e-46bd-a829-cb265d44da33", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bd674a19-82ee-4675-94dc-3ec928e7f8d2", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bd894681-4f9e-4dcd-9012-08a7f6174958", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bdd55273-3abd-4a6c-b42e-d219b94a5cbb", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "bdfd5c3f-583e-4816-8c4a-ba63b525edad", "77738726-a358-414d-8043-1b3defa6d1d0", "123f022c-72ae-401b-9144-624dad3a906a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "beafdbf4-c6b7-48f7-8a0c-d3bf030a947f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f71515e5-57b8-41de-9c49-5e494c497563", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "bec149ff-f7b4-4638-a659-8a36abe83ab0", "77738726-a358-414d-8043-1b3defa6d1d0", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bee00e12-52e7-4681-a30f-8ac19489c829", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf53d228-c4b2-4b05-9c12-7f618494fcf5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "bfb25170-e7db-4a22-a511-07317f690ec6", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "bfcf8543-0ebb-449f-b34b-86ee065901a1", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c029e021-eaba-43d8-9114-076ab55df3fe", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1606d9d-6330-420e-a452-439b68b317b5", "64502c81-163a-4ded-a7c9-3136024d26d8", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "c19c5b46-2331-4174-a147-f1a3c11eddfb", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1b869bf-2a6c-4473-8b02-cd55d1fb78dc", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1c74841-8125-4d78-a839-54ea954b44dd", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1fee360-5f44-4d0f-ae83-261438c850b7", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c21de226-e5c2-4577-af95-7b4442f54267", "64502c81-163a-4ded-a7c9-3136024d26d8", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c268836e-9f05-4c32-bf78-b8c0c63552dc", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c2ac28de-3294-4230-aa8b-2e0976e88036", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "c2c06011-7d4a-4259-a354-79b837a540b0", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c2c580ce-4183-41b2-a813-e9f0d15e6ae7", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c4109229-9841-4f78-b238-003b9d2a8f43", "64502c81-163a-4ded-a7c9-3136024d26d8", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c45057e6-ca02-47b4-aa98-4dbf68124d6a", "6a954648-6b0b-4db0-88f2-7446218b85f5", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c477059c-d2d1-4108-b1e6-44959e1eefc9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "c491b259-221d-4c46-a129-aa01d7a9dd40", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c5a9119d-b99b-4308-9c71-bb519ff75243", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "b56ff379-5619-4064-b572-407671edc15e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c5ca2ba6-5581-4801-8f1b-a01c2d61e39a", "64502c81-163a-4ded-a7c9-3136024d26d8", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "c6c5b9f8-1d99-4da7-b2be-c05a4cf940f6", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "c7888baa-25fa-4dba-b780-8f255cf927ab", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c7adaa42-de9e-4a9b-9f05-74a819c2dfad", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c7b5b8a2-6c33-4a5f-80a2-6915bb047bc7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "c87f73d3-d4cf-4425-869a-a19026854770", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c9ed8e30-485f-4c4d-a124-07ca014c8d8d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca1753d7-a2c1-4d5f-8ebc-4f46cc733e13", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca50ff7c-7a67-448c-9d00-fd274a9984d0", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "ca53100d-f52a-44fc-ab85-27292dd92db9", "77738726-a358-414d-8043-1b3defa6d1d0", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "ca582f0b-6920-4362-bb3a-aeebc6847d07", "77738726-a358-414d-8043-1b3defa6d1d0", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca8a5d94-7745-4837-a095-44511cb7463e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb131fe1-1005-44d1-ba5e-e6623f93ecfc", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb9dbd08-b4c8-4781-99c6-0d5cd9ca771c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "cc3c2b45-11b6-45c6-8e4e-e9a10ff9c00a", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cc599145-449a-427b-af8a-7b803cd4ba3d", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cc7c3539-52ed-4904-8c16-ba49197952a0", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "cc9b947b-3758-4d5d-b453-304240dc31ee", "77738726-a358-414d-8043-1b3defa6d1d0", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd00c401-fc68-47cd-a297-e1202aacb01f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd0b41b2-6997-4fdd-81e9-3233906453ed", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd0b8515-1c15-4a12-91aa-be3de6f80840", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cdc04918-35be-4935-b066-4b8ca0ecc842", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cdcc31a8-d4ff-4c78-8b47-bf0f7dfa47bb", "64502c81-163a-4ded-a7c9-3136024d26d8", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d068f8ac-b0ef-47bd-af57-be5f29a06257", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d1c46a49-69d6-46ba-8e68-0f0df7df98bd", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d1fb2046-af88-4513-8526-eb4b30a44b5a", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d2063b87-80cb-40bc-b580-640aa34f148c", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d288e9b7-7423-4258-914a-6f7244f47e53", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d295a3bd-a7ac-47e3-9199-292095a9599c", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d2988af9-cec0-43a4-acdb-6ed601e079a1", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "d2f603fe-c5db-49a0-91cd-ed1294709e1e", "77738726-a358-414d-8043-1b3defa6d1d0", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d4187b81-5d0a-4c51-901b-716d3b30d7c9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "123f022c-72ae-401b-9144-624dad3a906a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d50f88ad-ae76-4906-af94-8ecc23794e21", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d73fb7a6-7e4c-4922-a38b-ab6ed9cada46", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d79c2b4d-3cb7-42fc-88d6-91182bd7a8c0", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d7b4f490-57b1-4c61-b8b7-471d8b06495e", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "d7d6e5cd-4148-4b9a-804b-cd57a733a4bf", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d7f08be4-a3a9-470d-8c04-8bff0f246b23", "64502c81-163a-4ded-a7c9-3136024d26d8", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d7f66ba1-205f-440d-ada5-3674d58dde3b", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d82d7b65-27d7-49c8-bce7-b03b7b99c1e3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "d82f7947-bffb-42c3-b0d7-afaf45515a19", "77738726-a358-414d-8043-1b3defa6d1d0", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d844c0ee-00fa-4e68-ae26-d04428f66583", "6a954648-6b0b-4db0-88f2-7446218b85f5", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d88f65e8-5640-45d6-bbec-ff863db94ac7", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "d8d02e3d-29dd-4cae-9236-660d20e2a35e", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "d913d42c-f9f8-492d-bc21-46ec67a2f648", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "d93a2b6f-b995-4d0d-85f3-e6cfe820ee04", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d94c0a0b-69b1-41dc-aa92-24db19945b1d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "d96292f3-09bc-4e92-8099-7acacc3f46b6", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "d97f3409-c0a4-4da9-85f3-67d9f5c824b1", "77738726-a358-414d-8043-1b3defa6d1d0", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d9cff002-10fe-4126-8873-fc7c211b2a0e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d9d6fbf6-255a-4e6f-85a5-371ab616f4e9", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "da1e904b-a169-4e1f-965c-707944710f67", "6a954648-6b0b-4db0-88f2-7446218b85f5", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dade1d5c-3f2a-4ce6-981f-ddae38f57b86", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db3944cc-0065-48c7-8873-27cc0b57f53f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "b56ff379-5619-4064-b572-407671edc15e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "dcc82f79-b134-4192-905a-3eab4611d7bd", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dcf9edd8-c445-4250-a06f-a444b98791c0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "de6c2220-a7fb-4011-8a21-4316f3bcd179", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "df09bf8e-6885-4828-a0b2-1be36d548848", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df757839-a7e1-404b-b61c-f40a8499d650", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "dff85df8-cdfc-4692-a263-7f9f68c13444", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e00859ce-a7e4-456f-8efd-b1e5ab4e6890", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e06a0c32-f5cf-446e-8731-6d47ef059452", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e0df0602-b397-4e06-902d-92a15c6c76f3", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e1256edc-a6ce-4fe6-9c0c-9755c3c28c54", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e15349c6-42d3-4d03-a443-9fe7721bac9d", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e185be55-0cb8-4d95-902c-e034a3c726b6", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e1a4ba8e-fcf2-4d30-915a-837faca2c200", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e2824743-f863-4390-9930-9fb14ecf285b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e2923e8b-a625-4758-8f25-237fb4e1d8f7", "6a954648-6b0b-4db0-88f2-7446218b85f5", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e2b44658-b013-4abd-938b-d6f7e498c5ee", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e302e8b7-6f99-4593-8de7-03f10e881312", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e3a36a82-6a22-403d-af09-cbdbd7a9b754", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e3ae3bce-990d-4ea9-bd55-8d6842e595e6", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e4346d64-3d40-4fd3-a8af-4b8874705486", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e45fba59-ec97-4146-8be1-102676f22d7b", "77738726-a358-414d-8043-1b3defa6d1d0", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e4b19862-a49a-46d2-bedc-f52c7387f9e9", "77738726-a358-414d-8043-1b3defa6d1d0", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e4cc8f2b-206a-4100-b52c-2d1cf4027eac", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e4ea7412-74e5-4472-9d83-1b3030ef38b0", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e5a172b8-dd77-4bb4-8af3-6a542725a63d", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e612eccb-7f97-4c68-a1fc-c04f462b5fd2", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e6d37669-32cb-4028-b7d2-702d8ae2d919", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e7719df4-8ae0-48b0-8ccd-f92d30767b40", "6a954648-6b0b-4db0-88f2-7446218b85f5", "266bd8f2-8e09-404b-985e-0196c14218fa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e7d15491-5ecd-4154-abf0-5d3776f33fa7", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e81705fb-95e9-4286-ab7a-78ebcdb15ff0", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e876c029-e119-410e-b97c-9e49c10bc354", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e8b5dbc1-d2c8-46a2-87e0-824b030d7776", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e8c96319-f744-48e3-a511-eab78704dadb", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e8f860bc-23aa-4504-8fc5-c2843fd9706f", "77738726-a358-414d-8043-1b3defa6d1d0", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "e90d6bd6-1262-4f4f-999b-01db7c37bdcd", "77738726-a358-414d-8043-1b3defa6d1d0", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e965ca37-65d8-4566-90bf-adaebbfefa05", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e98fb7bd-462d-487a-9736-880f1fe64e51", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e9a9268b-885b-4aec-80be-eaa448b0f7de", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e9f8002e-deec-49ef-8a25-ca8e93703621", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ea179c19-719b-4dad-9163-b71c8b703a3a", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eabb199d-bb62-41d6-922d-ff3b43f3d5d6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eaf5ca7c-44f9-4faf-905e-60d5f2b24080", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec24938f-b2d6-4117-8dcf-ca0e8e86f29a", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec4250c8-2899-4fce-922a-7c875d22a28f", "64502c81-163a-4ded-a7c9-3136024d26d8", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "ecea6c28-46c7-4055-bc65-eaa09e643dec", "77738726-a358-414d-8043-1b3defa6d1d0", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ed3a55cd-c5d5-4fbe-ac50-ecfe1c148d23", "64502c81-163a-4ded-a7c9-3136024d26d8", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ed58a492-7115-45e2-97d7-c34babcd6471", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eda5d579-fb6b-461c-a0fb-623980d00dc2", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee158d27-d762-46fb-9a1e-562c6131f009", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "ee2ae5c2-15fa-4999-84c2-5ad1ec755e2d", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee473723-8634-4a74-b071-fa6e818da9f2", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee5f1a1a-7e9f-413a-8614-ad717a7b1364", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee672c64-c113-4238-9d62-33cda8bac84e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eebda58d-8f61-4e4b-9197-7c4818af7de0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eed3808f-cecf-448e-b448-511899270b52", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ef9267ad-4224-4f7e-8fef-0a3e9fe6048e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "efcf45e6-1460-43d6-ac94-90f48697057c", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f045ebda-ac11-4c35-b4c5-6a12f20785e4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:02");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f05df83b-7dc8-4b2a-9311-ca3243dbd919", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f1e6ff5e-178b-4e98-89ed-4278f2966756", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2983133-0bc9-4f94-80da-29dc653fe03a", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2ac538c-e15b-4f82-8d96-afe556337256", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "f3f749eb-9cf9-4dfc-9828-3873799dd790", "77738726-a358-414d-8043-1b3defa6d1d0", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4248d15-f72f-4a17-be63-4942223c4cca", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f435214c-82a8-4eb4-ad93-00647fad0e0e", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4ae5589-ad36-4e4a-b0f3-c07bd3db5062", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4c46e5b-8200-4500-9efe-9c5118e3c756", "6a954648-6b0b-4db0-88f2-7446218b85f5", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "f4d10f0a-6dec-4316-af0c-d9045e48ce1b", "77738726-a358-414d-8043-1b3defa6d1d0", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5e923dd-fdff-4784-a06a-f097185621f6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "868afde4-08e8-4899-b596-301c1bae2258", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f875af03-7463-431a-97e6-2fee862d1abc", "64502c81-163a-4ded-a7c9-3136024d26d8", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8a11fa4-e6f4-4509-956d-19383f9eb8f2", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8ac2598-d52c-4440-a1e7-88c4d4a2b03f", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8d1d43b-aa50-42d2-b829-97e1ad8c5414", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f9088f75-7865-4880-aa8a-cdb79a1710f0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "39425516-e7b9-42f9-b23b-02bf04bae967", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f9d4d8f1-75ae-4248-bccd-74828330292e", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:55");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb0d75f2-7ec5-4f62-beb6-83a9d8f32196", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb4eb5be-c216-4b9c-b1e1-34ae6c778212", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:03");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fbd0ea3a-609d-4676-9fbe-9528fe8703fc", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO dt01_gen_role_dt VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "fbdbe0c7-e79e-4f0c-a791-f358b0dfd52f", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:49");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fcc45995-83c7-4147-8725-83dcaf32e0f3", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:33:19");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fdba2ee5-1031-411d-9013-a87e9a0cf004", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:24:48");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fe7777b8-1b69-40bd-a044-00a56c25743c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-22 22:12:56");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ff2d20a4-366c-4c8b-abbd-825640317706", "64502c81-163a-4ded-a7c9-3136024d26d8", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12");
INSERT INTO dt01_gen_role_dt VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ffadbaf6-c0e4-43e6-85d5-57ae86d7f606", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");



DROP TABLE IF EXISTS dt01_gen_role_ms;

CREATE TABLE `dt01_gen_role_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `ROLE_ID` varchar(36) NOT NULL,
  `ROLE` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO dt01_gen_role_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "Komite Keperawatan", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21");
INSERT INTO dt01_gen_role_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "HRD", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21");
INSERT INTO dt01_gen_role_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "Default", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21");
INSERT INTO dt01_gen_role_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "64502c81-163a-4ded-a7c9-3136024d26d8", "Finance", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21");
INSERT INTO dt01_gen_role_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a954648-6b0b-4db0-88f2-7446218b85f5", "Developer", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21");
INSERT INTO dt01_gen_role_ms VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "Developer", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_ms VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "77738726-a358-414d-8043-1b3defa6d1d0", "IT Operation", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_ms VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "7dfcce8a-31a0-419a-87be-924fb46fd439", "Default", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20");
INSERT INTO dt01_gen_role_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "Monev", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21");
INSERT INTO dt01_gen_role_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "IT Operation", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21");



DROP TABLE IF EXISTS dt01_gen_struktur_ms;

CREATE TABLE `dt01_gen_struktur_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `STRUKTUR_ID` varchar(36) NOT NULL,
  `NAME` varchar(1000) NOT NULL,
  `STRUKTUR_HEADER_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `nomor` int(11) DEFAULT 0,
  PRIMARY KEY (`STRUKTUR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "00bf74a5-85d1-4068-a2ee-ecd1309a5b05", "FARMASI DEPO RANAP", "d019dcdf-60df-4f15-a28b-50a7c687549a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01f54eb6-6729-42bf-8798-ff72f03da804", "SMF MATA", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "026c3be2-488f-4330-a002-150096b5253c", "SATUAN PELAKSANA PERBENDAHARAAN DAN VERIFIKASI", "2d2fbea4-dbba-4c95-acb7-6ad19a9f3a49", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0896bcb1-e6e9-421d-b0c9-6d05867c5680", "PPK 3", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0940e88b-bc07-4fd4-a26b-e37da3dd30d4", "SMF PATALOGI ANATOMI", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "SATUAN PELAKSANA SDM KEPERAWATAN", "c18f5706-b2c6-46a6-8c76-b2fbf9d99fb9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2059a8a3-f622-4ce9-a275-7721dd3bf2e7", "PERAWAT LANTAI 8", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "23aa93b2-2375-46fc-af61-c80dda6637a0", "WAKIL DIREKTUR ADMINISTRASI UMUM DAN KEUANGAN", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "2");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "242d3e42-ad68-4503-9ca1-02ed1c05451d", "INSTALASI RAWAT JALAN", "2e5c9ed3-df58-4215-8f98-4a30d30daccb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "26987a38-2693-4c66-9812-0ca500ffdb6f", "PERAWAT LANTAI 11", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2a60adc3-f81b-4d99-a473-ece6f5ecc28d", "INSTALASI GAWAT DARURAT", "2e5c9ed3-df58-4215-8f98-4a30d30daccb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2a80b7a2-7d5f-4e2f-8b86-c843a9436b63", "SMF THT-KL", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2bd1e5eb-d44b-42b2-b34e-f7aa80188aba", "SATUAN PELAKSANA PERENCANAAN DAN ANGGARAN", "2d2fbea4-dbba-4c95-acb7-6ad19a9f3a49", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2c310ebe-09b5-4675-a564-344860a9121f", "SMF RADIOTERAPI", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2ce55b4f-d08e-46e2-ac71-18bc876444fc", "SATUAN PELAKSANA SIMRS", "a9a79e90-bae2-4809-b6eb-0f09977b39b6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2d2fbea4-dbba-4c95-acb7-6ad19a9f3a49", "BAGIAN KEUANGAN DAN PERENCANAAN", "23aa93b2-2375-46fc-af61-c80dda6637a0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "3");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2e5c9ed3-df58-4215-8f98-4a30d30daccb", "BAGIAN PELAYANAN MEDIS", "e49abef4-da29-4e1a-b1ba-802248c1f134", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f4a9864-0515-40e0-b49e-2837b56a9c77", "SMF PENYAKIT DALAM", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "31926b1f-11c6-4a38-b8fc-0d006c45f2e1", "SMF PARU", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32ecedb6-0291-4290-be9b-2289ff06f067", "BAGIAN UMUM, PEMASARAN DAN SDM", "23aa93b2-2375-46fc-af61-c80dda6637a0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "3");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "345aecdd-d92a-46c7-a2a2-6a956c356901", "SMF PATALOGI KLINIK", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "35b14a5e-66f5-404d-a53b-aa00a99a6927", "KOMITE FARMASI DAN TERAPI", "cea3eef3-7c1f-4152-8151-da49798fd88e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "36c01134-be65-4fac-9053-9f7d5e367565", "SMF UMUM", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "36db1f6a-6134-457d-9a89-f66dcf511b0b", "LOUNDRY DAN MORTUARY", "75552dd2-c342-4166-8fff-3af05e488e6e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "385f4a80-154f-4a9b-ab75-1a132f598a08", "SMF ANAK", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "DIREKTUR", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "1");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3f2e6137-334e-4f7f-8b69-e5ae147a8ce0", "PERAWAT JAGA UTAMA", "c18f5706-b2c6-46a6-8c76-b2fbf9d99fb9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4016d8ef-7162-4ae9-a2c6-940879108d64", "PERAWAT LANTAI 5", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "407a87b7-bf13-465c-8ae7-5cef98740c02", "PERAWAT POLI", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44dadee4-b285-4c95-b571-891be7eec9f6", "PPTK KEU", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4adac0c4-2ea0-4e0d-a8d2-fbc2c7d5a7b7", "SATUAN PELAKSANA LOGISTIK KEPERAWATAN", "c18f5706-b2c6-46a6-8c76-b2fbf9d99fb9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4d60bf0d-eeb0-4abd-8f00-834615a297a8", "FISIOTHERAPI", "75552dd2-c342-4166-8fff-3af05e488e6e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4dc6b20e-9cdf-4f93-9c2d-586c44aa9a29", "CLEANING SERVICE", "5e9b5ebd-107a-48cc-b449-e88e5509af97", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4e126c60-2714-46a9-8522-e366eee399cb", "INSTALASI BEDAH SENTRAL", "2e5c9ed3-df58-4215-8f98-4a30d30daccb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4e403a31-ff02-4538-8075-76f42d5ba2ee", "FARMASI KLINIS", "d019dcdf-60df-4f15-a28b-50a7c687549a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f8c8371-4d86-4abb-9087-9a685b169552", "SMF KEBIDANAN", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4fd0cc5c-7ca6-48ff-90f6-e053429f50d5", "KOMITE TENAGA KESEHATAN LAINNYA", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "53261c5c-c7f0-40b8-8aa8-a6d4ad81ddd5", "PPTK MEDIK", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5e9b5ebd-107a-48cc-b449-e88e5509af97", "SATUAN PELAKSANA RUMAH TANGGA DAN PERLENGKAPAN", "32ecedb6-0291-4290-be9b-2289ff06f067", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5f34f31a-0b79-4365-8155-17d6400b9d80", "SMF REHAB MEDIK", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6344ef69-9d08-4cb3-9f98-021e12f48a0c", "PPTK UMUM", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "649d608f-4d6d-49d9-ab0f-7bd9b9dba9c0", "TIM PROGRAM PENGENDALIAN RESISTENSI ANTIMIKROBA", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "66a567a6-72a8-436f-9e88-5c740cbddc5e", "INSTALASI REHABILITASI MEDIK", "6cc21c2f-62e3-4484-be8f-806d4c8d6e7d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6b4da054-7270-4023-9ae1-97e7b1a02d4e", "PPTK PENUNJANG", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6cc21c2f-62e3-4484-be8f-806d4c8d6e7d", "BAGIAN PELAYANAN PENUNJANG MEDIS", "e49abef4-da29-4e1a-b1ba-802248c1f134", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "3");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6e0efcc6-c3c9-47f5-a650-b9fcf2be80b6", "PERAWAT MOD / PPI / MPP", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "71b1b46b-363d-47b5-8199-e6e3045f4df7", "PERAWAT LANTAI 6", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7352d9c1-9399-4f9d-8d8d-c0df6399d4a8", "KOMITE PKRS", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "73585d09-7a38-4e07-94d3-adae387b4a39", "PERAWAT OK", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "739ee927-4454-4fd9-8d1c-21e1fa8a03d6", "ATEM", "75552dd2-c342-4166-8fff-3af05e488e6e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "75552dd2-c342-4166-8fff-3af05e488e6e", "INSTALASI PENUNJANG KHUSUS", "6cc21c2f-62e3-4484-be8f-806d4c8d6e7d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "793f1ea9-40a1-4547-9a3a-b49d873aa727", "SMF GIZI KLINIK", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c527665-31bb-493f-adca-3c36e31cf8b9", "SMF RADIOLOGI", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7f2aa222-04bf-4a94-ae7c-135e7eaebe02", "PERAWAT NPP", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "801198fe-b5cd-4c59-9d81-0fa9a35442d9", "SATUAN PELAKSANA PEMASARAN DAN INFORMASI", "32ecedb6-0291-4290-be9b-2289ff06f067", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "85183582-fdad-4e2b-a73c-0f9e9482e508", "PPK 1", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8569f440-814e-4260-946e-10461ceabb81", "INSTALASI RAWAT INAP", "2e5c9ed3-df58-4215-8f98-4a30d30daccb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89752cd2-1b40-44e2-9208-df444da05373", "INSTALASI LABORATORIUM", "6cc21c2f-62e3-4484-be8f-806d4c8d6e7d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "899980ce-5f82-4963-a5ed-473b7ff132c4", "KOMITE ETIK DAN PENELITIAN", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8ad68b16-0ed0-40de-9203-c3fd62a8363d", "CSSD", "75552dd2-c342-4166-8fff-3af05e488e6e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8cc834ae-6afc-4679-960e-629f746bbcaa", "SECURITY", "5e9b5ebd-107a-48cc-b449-e88e5509af97", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8f88069e-ed09-4d16-9372-9454a324df72", "SATUAN PELAKSANA SEKRETARIAT DAN LEGAL", "32ecedb6-0291-4290-be9b-2289ff06f067", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9173069e-1609-4698-a0df-0b12fb998656", "SATUAN PELAKSANA MUTU KEPERAWATAN", "c18f5706-b2c6-46a6-8c76-b2fbf9d99fb9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "93d36151-3255-4c77-86cd-67ff25dfccc9", "SMF SARAF", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "93e0141e-c03f-496c-976d-02a0dab22c7f", "PERAWAT IGD", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9430adad-a0bb-4c2d-b016-f55717f194ba", "SMF JANTUNG", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "993ea455-f22e-4230-a099-d5c52c5751c5", "SATUAN PELAKSANA PEMBERDAYAAN SDM", "32ecedb6-0291-4290-be9b-2289ff06f067", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9b438884-69ae-4e05-bead-0c6ebf816cbe", "INSTALASI REKAM MEDIS", "6cc21c2f-62e3-4484-be8f-806d4c8d6e7d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a7461a4e-caac-43c7-9fe0-f15576063c64", "SATUAN PENGAWAS INTERNAL", "cea3eef3-7c1f-4152-8151-da49798fd88e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a9a79e90-bae2-4809-b6eb-0f09977b39b6", "BAGIAN DATA DAN TEKNOLOGI INFORMASI", "23aa93b2-2375-46fc-af61-c80dda6637a0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "3");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "acd1d0eb-043b-4482-8457-0bd02d7b2169", "SATUAN PELAKSANA ADMINISTRASI KEPEGAWAIAN", "32ecedb6-0291-4290-be9b-2289ff06f067", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b3038d51-c496-4c0b-a3c9-9956ff4c787e", "INSTALASI GIZI", "6cc21c2f-62e3-4484-be8f-806d4c8d6e7d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b88d4ada-c8fd-439d-9311-068611915e8c", "PPTK PERAWAT", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b98f5c86-ce54-46be-a3a2-6b1630d64b9d", "INSTALASI RAWAT KHUSUS", "2e5c9ed3-df58-4215-8f98-4a30d30daccb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b9f0e138-7539-4d8d-a37f-0b6acaa1a387", "PERAWAT LANTAI 7", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ba262cbc-ec03-4855-afe0-ca10d76f3dcd", "KETUA TIM KOORDINASI PENDIDIKAN", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bc146afe-5f8f-4b18-9c36-c1a65a4978b8", "KOMITE MEDIK", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bd2ba7f4-a3c6-46ee-b53e-9f4a1945e7c7", "KESLING", "75552dd2-c342-4166-8fff-3af05e488e6e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c18f5706-b2c6-46a6-8c76-b2fbf9d99fb9", "BAGIAN PELAYANAN KEPERAWATAN", "e49abef4-da29-4e1a-b1ba-802248c1f134", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "3");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c2dc7a06-aecf-4421-9681-5f9a5434a3d3", "SATUAN PELAKSANA MOBILISASI DANA", "2d2fbea4-dbba-4c95-acb7-6ad19a9f3a49", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c3e2a4c2-cda6-4c50-9c1c-e413053d6770", "PERAWAT HD", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c4262683-5c03-4a45-aa14-158e7e2ef8e7", "FARMASI CRITICAL CARE", "d019dcdf-60df-4f15-a28b-50a7c687549a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c4391082-c3bf-4861-a440-375e75b3ab30", "DRIVER", "5e9b5ebd-107a-48cc-b449-e88e5509af97", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca57c126-282a-457e-973a-c47378974ce4", "PERAWAT LANTAI 4", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cc0984fc-19d5-4881-ac7b-6825fc7c8041", "SATUAN PELAKSANA SISTEM INFORMASI DAN APLIKASI", "a9a79e90-bae2-4809-b6eb-0f09977b39b6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cc0e34e4-4c6c-469b-b3fb-0c82acc5f515", "FARMASI GUDANG", "d019dcdf-60df-4f15-a28b-50a7c687549a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ce9668bd-3961-4d3c-a65c-9b28c72b2967", "PERAWAT LANTAI 9", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cea3eef3-7c1f-4152-8151-da49798fd88e", "SPI DAN KOMITE", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d019dcdf-60df-4f15-a28b-50a7c687549a", "INSTALASI FARMASI", "6cc21c2f-62e3-4484-be8f-806d4c8d6e7d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d2d3778a-2ff1-4a5a-b4ae-140a099f9f4a", "PERAWAT LANTAI 10", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d577e64b-a246-4f05-b423-27d051c21e14", "PERAWAT BIDAN VK", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d5fb9c01-0b26-4094-8c3d-e62f91f54ce0", "SATUAN PELAKSANA PEMELIHARAAN DAN PENGEMBANGAN SISTEM", "a9a79e90-bae2-4809-b6eb-0f09977b39b6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d78efdd1-4466-4c2f-89f1-a3446e6b29b9", "INSTALASI RADIOTERAPI", "2e5c9ed3-df58-4215-8f98-4a30d30daccb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8182a08-4dfd-4c33-8c33-420464eeceaa", "GUDANG LOGISTIK", "5e9b5ebd-107a-48cc-b449-e88e5509af97", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8609b04-1e52-44b7-8e29-7b638f7563d4", "SATUAN PELAKSANA PENGOLAH DATA DAN ANALISA DATA RS", "a9a79e90-bae2-4809-b6eb-0f09977b39b6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d89eaffa-f69b-44bf-95ba-f1a35e41ae34", "SMF BEDAH", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dae4d359-b0a6-480c-a96d-bc30a2f8d972", "SATUAN PELAKSANA PEMELIHARAAN RUMAH SAKIT (IPSRS)", "32ecedb6-0291-4290-be9b-2289ff06f067", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dd8dd7ff-2a54-4247-9883-164b1c52435d", "SATUAN PELAKSANA AKUNTANSI", "2d2fbea4-dbba-4c95-acb7-6ad19a9f3a49", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "de67dce5-120d-4c3f-98df-ab7513a27be9", "PENGURUS BARANG", "5e9b5ebd-107a-48cc-b449-e88e5509af97", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e1fffe10-9059-4aeb-8524-f11bfefb7ef7", "PERAWAT ICU - ICCU", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e252e822-1662-4352-9890-2bc667021ea7", "BAGIAN SUMBER DAYA MANUSIA", "23aa93b2-2375-46fc-af61-c80dda6637a0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "3");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e40cd462-3158-48d9-b964-3db9d7a46495", "KOMITE KEPERAWATAN", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e429eb23-d444-4d3c-a814-3c038121cb56", "SMF PSIKIATRI", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e43bae14-bc31-4f40-a658-09648f7c3f22", "SMF GIGI DAN MULUT", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e49abef4-da29-4e1a-b1ba-802248c1f134", "WAKIL DIREKTUR PELAYANAN", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "2");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ea447a66-aa77-49bd-ade5-018e8e726c28", "SMF ANESTESI", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ead3d7f5-bd7f-4001-af21-c52b23ebc3f2", "PPK 2", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec4242e5-d8ce-4ccc-91a4-a886c5aa8886", "FARMASI RAJAL", "d019dcdf-60df-4f15-a28b-50a7c687549a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec4971d7-72a4-44a0-94ab-e60357d4402d", "FARMASI IGD", "d019dcdf-60df-4f15-a28b-50a7c687549a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec8fabaa-6c41-4132-b5b0-7e34bb8acff7", "SMF KULIT DAN KELAMIN", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee4182ed-9d6e-4651-92f1-51a765ffb1ba", "SATUAN PELAKSANA PENDIDIKAN DAN PELATIHAN", "32ecedb6-0291-4290-be9b-2289ff06f067", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "efc1c7dd-ce76-478d-81d7-1b293143cd97", "INSTALASI RADIOLOGI", "6cc21c2f-62e3-4484-be8f-806d4c8d6e7d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f151e68c-0d9c-4499-8e02-25a938502e16", "PEJABAT PENGADAAN 2", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f203f150-5dea-4f67-97a7-599ba0578bae", "PEJABAT PENGADAAN 1", "", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f286651f-014d-4d56-9873-7a0eb0766b23", "KOMITE MUTU DAN KESELAMATAN PASIEN", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2da87c5-cd31-4ac9-a951-47c8bdc9a76c", "PERAWAT ICU - HCU", "0fa63f21-e9a6-40d7-8bc3-741b97ae0cef", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f34b3969-8f33-43c7-b39f-3eab5cf8423e", "KOMITE PPI", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");
INSERT INTO dt01_gen_struktur_ms VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fda56472-ac10-4517-9b98-9e4f62c6ad10", "KOMITE ETIK DAN HUKUM RS", "3b5bd5e4-b33f-4db7-b099-289bb1029158", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-06-18 14:38:45", "0");



DROP TABLE IF EXISTS dt01_gen_user_data;

CREATE TABLE `dt01_gen_user_data` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `USER_ID` varchar(36) NOT NULL,
  `USERNAME` varchar(4000) NOT NULL,
  `USER_IDENTIFIER` varchar(1000) NOT NULL,
  `PASSWORD` varchar(4000) NOT NULL DEFAULT '3832333435363731',
  `NIK` varchar(100) NOT NULL COMMENT 'Nomor Induk Kepegawaian',
  `NIP` varchar(100) DEFAULT NULL COMMENT 'NIP PNS Jika DiPerlukan',
  `NAME` varchar(1000) NOT NULL,
  `SEX_ID` varchar(1) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `IDENTITY_NO` varchar(16) DEFAULT NULL COMMENT 'No KTP',
  `NPWP_NO` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(4000) DEFAULT NULL,
  `KATEGORI_ID` varchar(36) DEFAULT NULL,
  `SUSPENDED` varchar(1) NOT NULL DEFAULT 'N',
  `REGISTER_ID` varchar(36) NOT NULL,
  `TILAKA_ID` varchar(100) NOT NULL,
  `REVOKE_ID` varchar(39) NOT NULL,
  `ISSUE_ID` varchar(42) NOT NULL,
  `CERTIFICATE` varchar(1) NOT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `PLACE_BIRTH` varchar(100) DEFAULT NULL,
  `IMAGE_PROFILE` varchar(1) NOT NULL DEFAULT 'N',
  `IMAGE_IDENTITY` varchar(1) NOT NULL DEFAULT 'N',
  `NAME_IDENTITY` varchar(255) DEFAULT NULL,
  `PLACE_OF_BIRTH` varchar(255) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `KLINIS_ID` varchar(36) DEFAULT NULL,
  `MARITAL_ID` varchar(100) DEFAULT NULL,
  `RELIGION_ID` varchar(100) DEFAULT NULL,
  `ETHNIC_ID` varchar(100) DEFAULT NULL,
  `BLOOD_TYPE` varchar(3) DEFAULT NULL,
  `RHESUS` varchar(3) DEFAULT NULL,
  `CLOTHES_SIZE` varchar(10) DEFAULT NULL,
  `PHONE` varchar(255) DEFAULT NULL,
  `DUTY_DAYS` int(11) DEFAULT 0,
  `DUTY_HOURS` int(11) DEFAULT 0,
  `HOURS_MONTH` int(11) DEFAULT 0,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO dt01_gen_user_data VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "55b16625-efca-4093-8df0-20fc838f21b1", "1521027", "", "3832333435363731", "1521027", "", "Teguh Irawan", "L", "", "", "", "", "b9710449-f5e4-4553-a962-f3b0f574dbc4", "N", "", "", "", "", "", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-05-08 15:18:08", "", "N", "N", "", "", "0000-00-00", "0e7e7a12-eecf-4f27-96fb-e70908d1b7ae", "", "", "", "", "", "", "", "20", "6", "7200");
INSERT INTO dt01_gen_user_data VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "Admin_6FRWNG", "", "3832333435363731", "6FRWNG", "", "Administrator Aktivo Indonesia Sukses", "", "", "", "", "", "", "N", "", "", "", "", "", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "N", "N", "", "", "", "", "", "", "", "", "", "", "", "0", "0", "0");


DROP TABLE IF EXISTS dt01_hrd_todo_dt;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS dt01_receivedata_data_leka;

CREATE TABLE `dt01_receivedata_data_leka` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `ENCOUNTER_ID` varchar(36) DEFAULT NULL,
  `DEVICE_ID` text DEFAULT NULL,
  `EXAM_ID` text DEFAULT NULL,
  `ID_NUMBER` text DEFAULT NULL,
  `NAME` text DEFAULT NULL,
  `SEX` text DEFAULT NULL,
  `BOD` text DEFAULT NULL,
  `AGE` text DEFAULT NULL,
  `NATION` text DEFAULT NULL,
  `ADDRESS` text DEFAULT NULL,
  `PHOTO` text DEFAULT NULL,
  `QRCODE` text DEFAULT NULL,
  `HEIGHT_VALUE` text DEFAULT NULL,
  `HEIGHT_NORMAL` text DEFAULT NULL,
  `HEIGHT_NOTE` text DEFAULT NULL,
  `WEIGHT_VALUE` text DEFAULT NULL,
  `WEIGHT_NORMAL` text DEFAULT NULL,
  `WEIGHT_NOTE` text DEFAULT NULL,
  `BMI_VALUE` text DEFAULT NULL,
  `BMI_NORMAL` text DEFAULT NULL,
  `BMI_NOTE` text DEFAULT NULL,
  `FAT_DBZ_VALUE` text DEFAULT NULL,
  `FAT_DBZ_NORMAL` text DEFAULT NULL,
  `FAT_DBZ_NOTE` text DEFAULT NULL,
  `FAT_DBZLV_VALUE` text DEFAULT NULL,
  `FAT_DBZLV_NORMAL` text DEFAULT NULL,
  `FAT_DBZLV_NOTE` text DEFAULT NULL,
  `FAT_GL_VALUE` text DEFAULT NULL,
  `FAT_GL_NORMAL` text DEFAULT NULL,
  `FAT_GL_NOTE` text DEFAULT NULL,
  `FAT_GY_VALUE` text DEFAULT NULL,
  `FAT_GY_NORMAL` text DEFAULT NULL,
  `FAT_GY_NOTE` text DEFAULT NULL,
  `FAT_JCDX_VALUE` text DEFAULT NULL,
  `FAT_JCDX_NORMAL` text DEFAULT NULL,
  `FAT_JCDX_NOTE` text DEFAULT NULL,
  `FAT_JRL_VALUE` text DEFAULT NULL,
  `FAT_JRL_NORMAL` text DEFAULT NULL,
  `FAT_JRL_NOTE` text DEFAULT NULL,
  `FAT_JRLV_VALUE` text DEFAULT NULL,
  `FAT_JRLV_NORMAL` text DEFAULT NULL,
  `FAT_JRLV_NOTE` text DEFAULT NULL,
  `FAT_NZZF_VALUE` text DEFAULT NULL,
  `FAT_NZZF_NORMAL` text DEFAULT NULL,
  `FAT_NZZF_NOTE` text DEFAULT NULL,
  `FAT_QZTZ_VALUE` text DEFAULT NULL,
  `FAT_QZTZ_NORMAL` text DEFAULT NULL,
  `FAT_QZTZ_NOTE` text DEFAULT NULL,
  `FAT_TSFL_VALUE` text DEFAULT NULL,
  `FAT_TSFL_NORMAL` text DEFAULT NULL,
  `FAT_TSFL_NOTE` text DEFAULT NULL,
  `FAT_TSFLV_VALUE` text DEFAULT NULL,
  `FAT_TSFLV_NORMAL` text DEFAULT NULL,
  `FAT_TSFLV_NOTE` text DEFAULT NULL,
  `FAT_XBNYL_VALUE` text DEFAULT NULL,
  `FAT_XBNYL_NORMAL` text DEFAULT NULL,
  `FAT_XBNYL_NOTE` text DEFAULT NULL,
  `FAT_XBNYLV_VALUE` text DEFAULT NULL,
  `FAT_XBNYLV_NORMAL` text DEFAULT NULL,
  `FAT_XBNYLV_NOTE` text DEFAULT NULL,
  `FAT_XBWYL_VALUE` text DEFAULT NULL,
  `FAT_XBWYL_NORMAL` text DEFAULT NULL,
  `FAT_XBWYL_NOTE` text DEFAULT NULL,
  `FAT_XBWYLV_VALUE` text DEFAULT NULL,
  `FAT_XBWYLV_NORMAL` text DEFAULT NULL,
  `FAT_XBWYLV_NOTE` text DEFAULT NULL,
  `FAT_ZFL_VALUE` text DEFAULT NULL,
  `FAT_ZFL_NORMAL` text DEFAULT NULL,
  `FAT_ZFL_NOTE` text DEFAULT NULL,
  `FAT_ZFLV_VALUE` text DEFAULT NULL,
  `FAT_ZFLV_NORMAL` text DEFAULT NULL,
  `FAT_ZFLV_NOTE` text DEFAULT NULL,
  `BLOOD_HIGH_VALUE` text DEFAULT NULL,
  `BLOOD_HIGH_NORMAL` text DEFAULT NULL,
  `BLOOD_HIGH_NOTE` text DEFAULT NULL,
  `BLOOD_LOW_VALUE` text DEFAULT NULL,
  `BLOOD_LOW_NORMAL` text DEFAULT NULL,
  `BLOOD_LOW_NOTE` text DEFAULT NULL,
  `BLOOD_RATE_VALUE` text DEFAULT NULL,
  `BLOOD_RATE_NORMAL` text DEFAULT NULL,
  `BLOOD_RATE_NOTE` text DEFAULT NULL,
  `SPO2_SP_VALUE` text DEFAULT NULL,
  `SPO2_SP_NORMAL` text DEFAULT NULL,
  `SPO2_SP_NOTE` text DEFAULT NULL,
  `TIWEN_VALUE` text DEFAULT NULL,
  `TIWEN_NORMAL` text DEFAULT NULL,
  `TIWEN_NOTE` text DEFAULT NULL,
  `ECG_DATA_VALUE` text DEFAULT NULL,
  `ECG_RESULT_VALUE` text DEFAULT NULL,
  `ECG_XINLV_VALUE` text DEFAULT NULL,
  `ECG12_DATA_VALUE` text DEFAULT NULL,
  `ECG12_DATA_NORMAL` text DEFAULT NULL,
  `ECG12_DATA_NOTE` text DEFAULT NULL,
  `ECG12_RESULT_VALUE` text DEFAULT NULL,
  `ECG12_RESULT_NORMAL` text DEFAULT NULL,
  `ECG12_RESULT_NOTE` text DEFAULT NULL,
  `ECG12_HEART_RATE_VALUE` text DEFAULT NULL,
  `ECG12_HEART_RATE_NORMAL` text DEFAULT NULL,
  `ECG12_HEART_RATE_NOTE` text DEFAULT NULL,
  `ECG12_P_AXIS_VALUE` text DEFAULT NULL,
  `ECG12_P_AXIS_NORMAL` text DEFAULT NULL,
  `ECG12_P_AXIS_NOTE` text DEFAULT NULL,
  `ECG12_PR_VALUE` text DEFAULT NULL,
  `ECG12_PR_NORMAL` text DEFAULT NULL,
  `ECG12_PR_NOTE` text DEFAULT NULL,
  `ECG12_QRS_VALUE` text DEFAULT NULL,
  `ECG12_QRS_NORMAL` text DEFAULT NULL,
  `ECG12_QRS_NOTE` text DEFAULT NULL,
  `ECG12_QRS_AXIS_VALUE` text DEFAULT NULL,
  `ECG12_QRS_AXIS_NORMAL` text DEFAULT NULL,
  `ECG12_QRS_AXIS_NOTE` text DEFAULT NULL,
  `ECG12_QT_VALUE` text DEFAULT NULL,
  `ECG12_QT_NORMAL` text DEFAULT NULL,
  `ECG12_QT_NOTE` text DEFAULT NULL,
  `ECG12_QTC_VALUE` text DEFAULT NULL,
  `ECG12_QTC_NORMAL` text DEFAULT NULL,
  `ECG12_QTC_NOTE` text DEFAULT NULL,
  `ECG12_RV5_VALUE` text DEFAULT NULL,
  `ECG12_RV5_NORMAL` text DEFAULT NULL,
  `ECG12_RV5_NOTE` text DEFAULT NULL,
  `ECG12_SAMPLE_RATE_VALUE` text DEFAULT NULL,
  `ECG12_SAMPLE_RATE_NORMAL` text DEFAULT NULL,
  `ECG12_SAMPLE_RATE_NOTE` text DEFAULT NULL,
  `ECG12_SAMPLE_TIME_VALUE` text DEFAULT NULL,
  `ECG12_SAMPLE_TIME_NORMAL` text DEFAULT NULL,
  `ECG12_SAMPLE_TIME_NOTE` text DEFAULT NULL,
  `ECG12_SV1_VALUE` text DEFAULT NULL,
  `ECG12_SV1_NORMAL` text DEFAULT NULL,
  `ECG12_SV1_NOTE` text DEFAULT NULL,
  `ECG12_T_AXIS_VALUE` text DEFAULT NULL,
  `ECG12_T_AXIS_NORMAL` text DEFAULT NULL,
  `ECG12_T_AXIS_NOTE` text DEFAULT NULL,
  `XT_TYPE_VALUE` text DEFAULT NULL,
  `XT_TYPE_NORMAL` text DEFAULT NULL,
  `XT_TYPE_NOTE` text DEFAULT NULL,
  `XT_VALUE_VALUE` text DEFAULT NULL,
  `XT_VALUE_NORMAL` text DEFAULT NULL,
  `XT_VALUE_NOTE` text DEFAULT NULL,
  `NS_VALUE` text DEFAULT NULL,
  `NS_NORMAL` text DEFAULT NULL,
  `NS_NOTE` text DEFAULT NULL,
  `DGC_VALUE` text DEFAULT NULL,
  `DGC_NORMAL` text DEFAULT NULL,
  `DGC_NOTE` text DEFAULT NULL,
  `XHDB_HXBYJ_VALUE` text DEFAULT NULL,
  `XHDB_HXBYJ_NORMAL` text DEFAULT NULL,
  `XHDB_HXBYJ_NOTE` text DEFAULT NULL,
  `XHDB_VALUE_VALUE` text DEFAULT NULL,
  `XHDB_VALUE_NORMAL` text DEFAULT NULL,
  `XHDB_VALUE_NOTE` text DEFAULT NULL,
  `XZSX_CHD_VALUE` text DEFAULT NULL,
  `XZSX_CHD_NORMAL` text DEFAULT NULL,
  `XZSX_CHD_NOTE` text DEFAULT NULL,
  `XZSX_CHOL_VALUE` text DEFAULT NULL,
  `XZSX_CHOL_NORMAL` text DEFAULT NULL,
  `XZSX_CHOL_NOTE` text DEFAULT NULL,
  `XZSX_HDL_VALUE` text DEFAULT NULL,
  `XZSX_HDL_NORMAL` text DEFAULT NULL,
  `XZSX_HDL_NOTE` text DEFAULT NULL,
  `XZSX_LDL_VALUE` text DEFAULT NULL,
  `XZSX_LDL_NORMAL` text DEFAULT NULL,
  `XZSX_LDL_NOTE` text DEFAULT NULL,
  `XZSX_TG_VALUE` text DEFAULT NULL,
  `XZSX_TG_NORMAL` text DEFAULT NULL,
  `XZSX_TG_NOTE` text DEFAULT NULL,
  `NYFX_BIL_VALUE` text DEFAULT NULL,
  `NYFX_BIL_NORMAL` text DEFAULT NULL,
  `NYFX_BIL_NOTE` text DEFAULT NULL,
  `NYFX_BLD_VALUE` text DEFAULT NULL,
  `NYFX_BLD_NORMAL` text DEFAULT NULL,
  `NYFX_BLD_NOTE` text DEFAULT NULL,
  `NYFX_CA_VALUE` text DEFAULT NULL,
  `NYFX_CA_NORMAL` text DEFAULT NULL,
  `NYFX_CA_NOTE` text DEFAULT NULL,
  `NYFX_CRE_VALUE` text DEFAULT NULL,
  `NYFX_CRE_NORMAL` text DEFAULT NULL,
  `NYFX_CRE_NOTE` text DEFAULT NULL,
  `NYFX_GLU_VALUE` text DEFAULT NULL,
  `NYFX_GLU_NORMAL` text DEFAULT NULL,
  `NYFX_GLU_NOTE` text DEFAULT NULL,
  `NYFX_KET_VALUE` text DEFAULT NULL,
  `NYFX_KET_NORMAL` text DEFAULT NULL,
  `NYFX_KET_NOTE` text DEFAULT NULL,
  `NYFX_LEU_VALUE` text DEFAULT NULL,
  `NYFX_LEU_NORMAL` text DEFAULT NULL,
  `NYFX_LEU_NOTE` text DEFAULT NULL,
  `NYFX_MA_VALUE` text DEFAULT NULL,
  `NYFX_MA_NORMAL` text DEFAULT NULL,
  `NYFX_MA_NOTE` text DEFAULT NULL,
  `NYFX_NIT_VALUE` text DEFAULT NULL,
  `NYFX_NIT_NORMAL` text DEFAULT NULL,
  `NYFX_NIT_NOTE` text DEFAULT NULL,
  `NYFX_PH_VALUE` text DEFAULT NULL,
  `NYFX_PH_NORMAL` text DEFAULT NULL,
  `NYFX_PH_NOTE` text DEFAULT NULL,
  `NYFX_PRO_VALUE` text DEFAULT NULL,
  `NYFX_PRO_NORMAL` text DEFAULT NULL,
  `NYFX_PRO_NOTE` text DEFAULT NULL,
  `NYFX_SG_VALUE` text DEFAULT NULL,
  `NYFX_SG_NORMAL` text DEFAULT NULL,
  `NYFX_SG_NOTE` text DEFAULT NULL,
  `NYFX_UBG_VALUE` text DEFAULT NULL,
  `NYFX_UBG_NORMAL` text DEFAULT NULL,
  `NYFX_UBG_NOTE` text DEFAULT NULL,
  `NYFX_VC_VALUE` text DEFAULT NULL,
  `NYFX_VC_NORMAL` text DEFAULT NULL,
  `NYFX_VC_NOTE` text DEFAULT NULL,
  `ZYBS_VALUE` text DEFAULT NULL,
  `ZYBS_NORMAL` text DEFAULT NULL,
  `ZYBS_NOTE` text DEFAULT NULL,
  `ZYBS_1` text DEFAULT NULL,
  `ZYBS_2` text DEFAULT NULL,
  `ZYBS_3` text DEFAULT NULL,
  `ZYBS_4` text DEFAULT NULL,
  `ZYBS_5` text DEFAULT NULL,
  `ZYBS_6` text DEFAULT NULL,
  `ZYBS_7` text DEFAULT NULL,
  `ZYBS_8` text DEFAULT NULL,
  `ZYBS_9` text DEFAULT NULL,
  `YTB_HIP_VALUE` text DEFAULT NULL,
  `YTB_HIP_NORMAL` text DEFAULT NULL,
  `YTB_HIP_NOTE` text DEFAULT NULL,
  `YTB_WAIST_VALUE` text DEFAULT NULL,
  `YTB_WAIST_NORMAL` text DEFAULT NULL,
  `YTB_WAIST_NOTE` text DEFAULT NULL,
  `YTB_WHR_VALUE` text DEFAULT NULL,
  `YTB_WHR_NORMAL` text DEFAULT NULL,
  `YTB_WHR_NOTE` text DEFAULT NULL,
  `FGN_BZ_VALUE` text DEFAULT NULL,
  `FGN_BZ_NORMAL` text DEFAULT NULL,
  `FGN_BZ_NOTE` text DEFAULT NULL,
  `FGN_FEV1_VALUE` text DEFAULT NULL,
  `FGN_FEV1_NORMAL` text DEFAULT NULL,
  `FGN_FEV1_NOTE` text DEFAULT NULL,
  `FGN_FVC_VALUE` text DEFAULT NULL,
  `FGN_FVC_NORMAL` text DEFAULT NULL,
  `FGN_FVC_NOTE` text DEFAULT NULL,
  `FGN_PEF_VALUE` text DEFAULT NULL,
  `FGN_PEF_NORMAL` text DEFAULT NULL,
  `FGN_PEF_NOTE` text DEFAULT NULL,
  `SHILI_LEFT_EYE_VALUE` text DEFAULT NULL,
  `SHILI_LEFT_EYE_NORMAL` text DEFAULT NULL,
  `SHILI_LEFT_EYE_NOTE` text DEFAULT NULL,
  `SHILI_RIGHT_EYE_VALUE` text DEFAULT NULL,
  `SHILI_RIGHT_EYE_NORMAL` text DEFAULT NULL,
  `SHILI_RIGHT_EYE_NOTE` text DEFAULT NULL,
  `SEMANG_VALUE` text DEFAULT NULL,
  `SEMANG_NORMAL` text DEFAULT NULL,
  `SEMANG_NOTE` text DEFAULT NULL,
  `XLCP_HMDJL_VALUE` text DEFAULT NULL,
  `XLCP_HMDJL_NORMAL` text DEFAULT NULL,
  `XLCP_HMDJL_NOTE` text DEFAULT NULL,
  `XLCP_LNYY_VALUE` text DEFAULT NULL,
  `XLCP_LNYY_NORMAL` text DEFAULT NULL,
  `XLCP_LNYY_NOTE` text DEFAULT NULL,
  `XLCP_QXJKD_VALUE` text DEFAULT NULL,
  `XLCP_QXJKD_NORMAL` text DEFAULT NULL,
  `XLCP_QXJKD_NOTE` text DEFAULT NULL,
  `XLCP_RGZA_VALUE` text DEFAULT NULL,
  `XLCP_RGZA_NORMAL` text DEFAULT NULL,
  `XLCP_RGZA_NOTE` text DEFAULT NULL,
  `XLCP_SHMYD_VALUE` text DEFAULT NULL,
  `XLCP_SHMYD_NORMAL` text DEFAULT NULL,
  `XLCP_SHMYD_NOTE` text DEFAULT NULL,
  `XLCP_ZCJKPD_VALUE` text DEFAULT NULL,
  `XLCP_ZCJKPD_NORMAL` text DEFAULT NULL,
  `XLCP_ZCJKPD_NOTE` text DEFAULT NULL,
  `XLCP_EQ_VALUE` text DEFAULT NULL,
  `XLCP_EQ_NORMAL` text DEFAULT NULL,
  `XLCP_EQ_NOTE` text DEFAULT NULL,
  `XLCP_HFXX_VALUE` text DEFAULT NULL,
  `XLCP_HFXX_NORMAL` text DEFAULT NULL,
  `XLCP_HFXX_NOTE` text DEFAULT NULL,
  `XLCP_PSTR_VALUE` text DEFAULT NULL,
  `XLCP_PSTR_NORMAL` text DEFAULT NULL,
  `XLCP_PSTR_NOTE` text DEFAULT NULL,
  `XLCP_SMZKPG_VALUE` text DEFAULT NULL,
  `XLCP_SMZKPG_NORMAL` text DEFAULT NULL,
  `XLCP_SMZKPG_NOTE` text DEFAULT NULL,
  `XLCP_UCLA_VALUE` text DEFAULT NULL,
  `XLCP_UCLA_NORMAL` text DEFAULT NULL,
  `XLCP_UCLA_NOTE` text DEFAULT NULL,
  `XLCP_ZPYY_VALUE` text DEFAULT NULL,
  `XLCP_ZPYY_NORMAL` text DEFAULT NULL,
  `XLCP_ZPYY_NOTE` text DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS dt01_satusehat_bundle;

CREATE TABLE `dt01_satusehat_bundle` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `LOCATION` varchar(500) DEFAULT NULL,
  `RESOURCE_TYPE` varchar(100) DEFAULT NULL,
  `RESOURCE_ID` varchar(100) DEFAULT NULL,
  `ETAG` varchar(100) DEFAULT NULL,
  `STATUS` varchar(500) DEFAULT NULL,
  `LAST_MODIFIED` varchar(500) DEFAULT NULL,
  `JENIS` varchar(1) DEFAULT NULL,
  `NOTE` varchar(500) DEFAULT NULL,
  `ENVIRONMENT` varchar(500) DEFAULT NULL,
  `AKTIF` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO dt01_satusehat_bundle VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "581db76c-0596-4d7a-ab41-bb8a02fe8da3", "9ee99380-a6f6-4707-87fb-ba3e4183810c", "https://api-satusehat-stg.kemkes.go.id/fhir-r4/v1/Observation/2b63a0fe-4160-4ccb-abfc-620f4e06a4b3/_history/MTcyMTYzMjM4NjUyMjY5NjAwMA", "Observation", "2b63a0fe-4160-4ccb-abfc-620f4e06a4b3", "W/\&quot;MTcyMTYzMjM4NjUyMjY5NjAwMA\&quot;", "201 Created", "2024-07-22T07:13:06.522696+00:00", "1", "", "", "1", "MIDDLEWARE", "2024-07-22 14:13:09");
INSERT INTO dt01_satusehat_bundle VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5f17131a-bd46-43ae-a17c-c58daf74b09a", "9ee99380-a6f6-4707-87fb-ba3e4183810c", "https://api-satusehat-stg.kemkes.go.id/fhir-r4/v1/Observation/753aa38c-64a0-472e-b24a-8f5f51b0df89/_history/MTcyMTYzMjM4NjUyMjY5NjAwMA", "Observation", "753aa38c-64a0-472e-b24a-8f5f51b0df89", "W/\&quot;MTcyMTYzMjM4NjUyMjY5NjAwMA\&quot;", "201 Created", "2024-07-22T07:13:06.522696+00:00", "1", "", "", "1", "MIDDLEWARE", "2024-07-22 14:13:09");
INSERT INTO dt01_satusehat_bundle VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "70992a51-3a55-4583-81f9-53fbb8d7a9cc", "9ee99380-a6f6-4707-87fb-ba3e4183810c", "https://api-satusehat-stg.kemkes.go.id/fhir-r4/v1/Observation/e53e7794-a8fb-46f4-b6e4-02e9d2dd07ad/_history/MTcyMTYzMjM4NjUyMjY5NjAwMA", "Observation", "e53e7794-a8fb-46f4-b6e4-02e9d2dd07ad", "W/\&quot;MTcyMTYzMjM4NjUyMjY5NjAwMA\&quot;", "201 Created", "2024-07-22T07:13:06.522696+00:00", "1", "", "", "1", "MIDDLEWARE", "2024-07-22 14:13:09");
INSERT INTO dt01_satusehat_bundle VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bcb08922-0e50-4260-9529-9c1093bbe5e1", "9ee99380-a6f6-4707-87fb-ba3e4183810c", "https://api-satusehat-stg.kemkes.go.id/fhir-r4/v1/Observation/ece1906b-dd3a-427d-877f-1d4a2facb71a/_history/MTcyMTYzMjM4NjUyMjY5NjAwMA", "Observation", "ece1906b-dd3a-427d-877f-1d4a2facb71a", "W/\&quot;MTcyMTYzMjM4NjUyMjY5NjAwMA\&quot;", "201 Created", "2024-07-22T07:13:06.522696+00:00", "1", "", "", "1", "MIDDLEWARE", "2024-07-22 14:13:09");
INSERT INTO dt01_satusehat_bundle VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c6ba7ef5-a358-4c12-bcc4-ca7e216e870d", "9ee99380-a6f6-4707-87fb-ba3e4183810c", "https://api-satusehat-stg.kemkes.go.id/fhir-r4/v1/Observation/a720c7b4-b532-4afb-a836-ced8d7609acb/_history/MTcyMTYzMjM4NjUyMjY5NjAwMA", "Observation", "a720c7b4-b532-4afb-a836-ced8d7609acb", "W/\&quot;MTcyMTYzMjM4NjUyMjY5NjAwMA\&quot;", "201 Created", "2024-07-22T07:13:06.522696+00:00", "1", "", "", "1", "MIDDLEWARE", "2024-07-22 14:13:09");
INSERT INTO dt01_satusehat_bundle VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d0cb9f99-46b6-4040-b52c-4d77ea40a897", "9ee99380-a6f6-4707-87fb-ba3e4183810c", "https://api-satusehat-stg.kemkes.go.id/fhir-r4/v1/Observation/c69e149d-464d-4d9b-86e4-038c0f3c9f35/_history/MTcyMTYzMjM4NjUyMjY5NjAwMA", "Observation", "c69e149d-464d-4d9b-86e4-038c0f3c9f35", "W/\&quot;MTcyMTYzMjM4NjUyMjY5NjAwMA\&quot;", "201 Created", "2024-07-22T07:13:06.522696+00:00", "1", "", "", "1", "MIDDLEWARE", "2024-07-22 14:13:09");



DROP TABLE IF EXISTS dt01_service_api_logs_out;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;