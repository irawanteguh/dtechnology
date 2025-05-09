DROP TABLE IF EXISTS `dt01_frm_canister_ms`;

CREATE TABLE `dt01_frm_canister_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `CANISTER_ID` varchar(36) NOT NULL,
  `MACHINE_ID` varchar(36) DEFAULT NULL,
  `OBAT_ID` varchar(36) DEFAULT NULL,
  `CANISTER_NO` int(11) DEFAULT 0,
  `STOK` int(11) DEFAULT 0,
  `MIN_STOK` int(11) DEFAULT 0,
  `ACTIVE` varchar(1) DEFAULT NULL,
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`CANISTER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_department_ms`;

CREATE TABLE `dt01_gen_department_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `DEPARTMENT_ID` varchar(36) NOT NULL,
  `HEADER_ID` varchar(36) DEFAULT NULL,
  `DEPARTMENT` varchar(1000) DEFAULT NULL,
  `LEVEL_ID` int(11) DEFAULT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `CODE` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`DEPARTMENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_document_file_dt`;

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
  PRIMARY KEY (`NO_FILE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_document_file_dt_yyyy`;

CREATE TABLE `dt01_gen_document_file_dt_yyyy` (
  `ORG_ID` varchar(36) NOT NULL,
  `NO_FILE` varchar(100) NOT NULL,
  `REQUEST_ID` varchar(36) DEFAULT NULL,
  `FILENAME` varchar(1000) DEFAULT NULL,
  `JENIS_DOC` varchar(10) DEFAULT NULL,
  `ASSIGN` varchar(1000) DEFAULT NULL,
  `USER_IDENTIFIER` varchar(1000) DEFAULT NULL,
  `LINK` varchar(1000) DEFAULT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  `PASIEN_IDX` varchar(1000) DEFAULT NULL,
  `TRANSAKSI_IDX` varchar(1000) DEFAULT NULL,
  `NOTE` text NOT NULL,
  `SOURCE_FILE` varchar(255) DEFAULT NULL,
  `STATUS_FILE` varchar(1) DEFAULT '0',
  `STATUS_SIGN` varchar(1) NOT NULL DEFAULT '0' COMMENT '0 : File Not Uploaded / File Belum Di Upload\r\n1 : Files Have Been Uploaded / File Sudah Di Upload\r\n2 : Request Sign Success / Sedang Process Pengajuan Tanda Tangan\r\n3 : Request Sign Gagal / Sedang Process Pengajuan Tanda Tangan\r\n4 : Sign Success / Tanda Tangan Berhasil\r\n5 : Sign Gagal/ Tanda Tangan Berhasil',
  `FILESIZE` float DEFAULT 0,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`NO_FILE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_document_file_dt_zzz`;

CREATE TABLE `dt01_gen_document_file_dt_zzz` (
  `ORG_ID` varchar(36) NOT NULL,
  `NO_FILE` varchar(100) NOT NULL,
  `FILENAME` varchar(1000) DEFAULT NULL,
  `JENIS_DOC` varchar(10) DEFAULT NULL,
  `ASSIGN` varchar(1000) DEFAULT NULL,
  `STATUS_SIGN` varchar(1) NOT NULL DEFAULT '0' COMMENT '0 : File Not Uploaded / File Belum Di Upload\r\n1 : Files Have Been Uploaded / File Sudah Di Upload\r\n2 : Request Sign Success / Sedang Process Pengajuan Tanda Tangan\r\n3 : Request Sign Gagal / Sedang Process Pengajuan Tanda Tangan\r\n4 : Sign Success / Tanda Tangan Berhasil\r\n5 : Sign Gagal/ Tanda Tangan Berhasil',
  `LINK` varchar(1000) DEFAULT NULL,
  `PASIEN_IDX` varchar(1000) DEFAULT NULL,
  `TRANSAKSI_IDX` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `REQUEST_ID` varchar(36) DEFAULT NULL,
  `NOTE` text NOT NULL,
  `SOURCE_FILE` varchar(255) DEFAULT NULL,
  `STATUS_FILE` varchar(1) DEFAULT '0',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `USER_IDENTIFIER` varchar(1000) DEFAULT NULL,
  `URL` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_document_ms`;

CREATE TABLE `dt01_gen_document_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `JENIS_DOC` varchar(10) NOT NULL,
  `DOCUMENT_NAME` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`JENIS_DOC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "001", "Triase IGD", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "002", "SBPK", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "003", "Hasil Labor", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "004", "Hasil Radiologi", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "005", "Resume Medis Rajal", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "006", "Resume Medis Rawat Inap", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "007", "Laporan Operasi", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "008", "SPRI", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "009", "Penilaian Awal Medis IGD", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "010", "Penilaian Awal Medis Ranap", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "011", "Resep Obat", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "012", "Partograf", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "013", "Surat Kontrol", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "014", "Hasil Labor 1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "015", "Hasil Labor 2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "016", "Hasil Labor 3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "017", "Hasil Labor 4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "018", "Hasil Radiologi 2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "019", "Resep Obat 1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "020", "Resep Obat 2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "021", "Resep Obat 3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "022", "SEP", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "023", "SEP", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "065", "Surat Keterangan Lahir", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "066", "Billing", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "067", "Resep Obat", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "068", "SKDP", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "079", "SEP Ranap", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "091", "Surat Kematian", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "092", "Hasil Labor 5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "094", "Hasil Labor 7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "095", "Hasil Labor 8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "096", "Hasil Labor 9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "097", "Hasil Labor 10", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "098", "Hasil Labor 11", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "099", "Document", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "100", "Hasil Labor 13", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "101", "Hasil Labor 14", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "102", "Hasil Labor 15", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "103", "Hasil Labor 16", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "104", "Hasil Labor 17", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "105", "Hasil Labor 18", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "106", "Hasil Labor 19", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "107", "Hasil Labor 20", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "108", "Hasil Radiologi 3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "109", "Hasil Radiologi 4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "110", "Hasil Radiologi 5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "111", "Hasil Radiologi 6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "112", "Resep Obat 4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "113", "Resep Obat 5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "114", "Resep Obat 6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "115", "Resep Obat 7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "116", "Resep Obat 8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "117", "Resep Obat 9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "118", "Resep Obat 10", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "119", "Resep Obat 11", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "120", "Resep Obat 12", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "121", "Resep Obat 13", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "122", "Resep Obat 14", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "123", "Resep Obat 15", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "124", "Resep Obat 16", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "125", "Resep Obat 17", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "126", "Resep Obat 18", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "127", "Resep Obat 19", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "xxx", "Tets", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-14 22:06:13");


DROP TABLE IF EXISTS `dt01_gen_domisili_ms`;

CREATE TABLE `dt01_gen_domisili_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `CODE` varchar(100) NOT NULL,
  `PARENT_CODE` varchar(100) DEFAULT NULL,
  `BPS_CODE` varchar(100) DEFAULT NULL,
  `NAME` text DEFAULT NULL,
  `JENIS` varchar(1) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_enviroment_ms`;

CREATE TABLE `dt01_gen_enviroment_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `ENV_ID` varchar(36) NOT NULL,
  `ENVIRONMENT_NAME` varchar(1000) NOT NULL,
  `DEV` varchar(1000) NOT NULL,
  `PROD` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `URUT` int(11) DEFAULT 0,
  PRIMARY KEY (`ENV_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2621c461-0ecf-491e-8495-99166b904b2d", "END_VALID_ACTIVITY", "5", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3494fa6b-f012-4c40-8cae-70ab8a398b89", "KEY_EKLAIM", "af88024790f81eb9fafb3266bf0aae2c38f01f06b0f437ab2dac6686ecbd427f", "af88024790f81eb9fafb3266bf0aae2c38f01f06b0f437ab2dac6686ecbd427f", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4b57850c-0445-4b5a-b397-57a09479f0bd", "CLIENTID_SATUSEHAT", "wYiLSpaT4s7GR24ZqGvC1iyG2GBDZeYGEYvDeonE750ahy8h", "wYiLSpaT4s7GR24ZqGvC1iyG2GBDZeYGEYvDeonE750ahy8h", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4cf1de59-1805-4649-bfd9-054b067d527d", "CLIENT_ID_TILAKA", "be2642fe-a581-4a69-aaad-ed8174dddc7e", "9cb698e9-9ac1-4cbf-a12a-9e1dda6e4630", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4cf2982c-8906-43d4-8a69-bca58f0cbdf0", "SERVER_EKLAIM", "http://192.168.56.101/", "http://192.168.56.101/", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f07a29b-f73b-4c9a-8900-da9a7d716524", "MAX_VALUE_ASSESSMENT", "30", "60", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "53958b2a-6f73-4e4f-9703-40b64959d755", "CLIENT_SECRET_TILAKA", "3fa22ba0-7a81-4244-9694-b857f0e83cd8", "079dead8-6798-4f92-8c0b-905a443b5d40", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "573a2b21-138b-4bcf-87a0-33ed3db1a574", "AUTHURL_SATUSEHAT", "https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1", "https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5a9bc4e9-77f9-441d-8e69-2785a7e147f8", "TILAKA_BASE_URL", "https://sb-api.tilaka.id/", "https://api.tilaka.id/", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "678bb734-3849-4a84-8c1b-3526c6029f95", "TILAKALITE_URL", "http://10.10.11.253:8088/", "http://192.168.102.240:8088/", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "67aeb868-636b-4e86-9cc1-690bbba5216d", "PATHFILE_POST_TILAKA", "/assets/document", "assets/document/", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6938614d-276b-4161-a470-32156c1e3980", "PATHFILE_GET_TILAKA", "Z:\\document", "Z:\\document", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "69723f27-ec38-4d73-920f-b51b6a2c444b", "CERTIFICATE", "PERSONAL", "PERSONAL", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6bba06d0-4387-4585-95d1-42f3cbd6d682", "END_VALID_ASSESSMENT", "2", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7b31610f-f3de-4dde-86b6-6c22e8a2f309", "COORDINATE_X", "26", "26", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "90ff66de-ace0-491d-9843-74f8b7d57886", "CLIENTSECRET_SATUSEHAT", "dcBZIfHwKr81OivmudeTJr8411fTJSFRikeNdniISGZ9GrXAvHpsjQlrkumHBXiC", "dcBZIfHwKr81OivmudeTJr8411fTJSFRikeNdniISGZ9GrXAvHpsjQlrkumHBXiC", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a7a2ef53-c1df-4911-9e02-f4bebfa9e4ee", "COORDINATE_Y", "24", "24", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae4ade89-db55-4d46-a7e9-25ceeeb56a50", "MAX_VALUE_ACTIVITY", "70", "40", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b61b421d-b824-41a5-ad14-a4c412e4e11e", "HEIGHT", "50", "50", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c952ea22-ef19-4aa6-9a11-0b639cdb9dbc", "ORG_ID", "10c84edd-500b-49e3-93a5-a2c8cd2c8524", "10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 10:25:12", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d1f96ded-4df9-4c4a-9b28-14814d91e392", "PATHFILE_POST_DTECH", "\\\\\\\\192.168.102.50\\\\nas\\\\document\\\\", "\\\\\\\\192.168.102.50\\\\nas\\\\document\\\\", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dd94948b-d9c2-4acb-a0b9-e4258b213337", "SATUSEHAT_BASE_URL", "https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1", "https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dfefa28c-c03a-425c-9557-ebb6d37ba4ee", "WIDTH", "50", "50", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e847ce7a-835f-4a9a-a163-1f9e874497a0", "START_VALID_ASSESSMENT", "1", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fda0e07a-f1f9-4a7e-9b7f-5b2501dd5e8d", "PAGE", "1", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18", "0");


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_level_user_ms`;

CREATE TABLE `dt01_gen_level_user_ms` (
  `LEVEL_ID` varchar(36) NOT NULL,
  `LEVEL` varchar(500) NOT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`LEVEL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_location_ms`;

CREATE TABLE `dt01_gen_location_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `LOCATION_ID` varchar(36) NOT NULL,
  `LOCATION` varchar(1000) DEFAULT NULL,
  `HEADER_ID` varchar(36) DEFAULT NULL,
  `TYPE` varchar(100) DEFAULT NULL,
  `LEVEL_ID` int(11) DEFAULT 0,
  `USER_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`LOCATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_master_ms`;

CREATE TABLE `dt01_gen_master_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `MASTER_ID` varchar(36) NOT NULL,
  `CODE` varchar(100) DEFAULT NULL,
  `MASTER_NAME` varchar(1000) DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `COLOR` varchar(100) DEFAULT NULL,
  `JENIS_ID` varchar(100) DEFAULT NULL,
  `URUT` int(11) DEFAULT 0,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`MASTER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0998f038-ea8b-42b8-a7c4-77bfd3d43bb4", "2", "Request Sign", "Waiting Signing User", "info", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0edaebdc-578a-4da8-bd0e-6983290c68f4", "1", "Upload File", "Waiting Request Sign", "info", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1fac526e-1cb0-4eaf-ad8f-4962a5dfd03e", "", "Update Software", "", "", "Problem_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "21ae6cfe-b859-485b-8f5f-6715b3704e61", "99", "Failed Process", "Please Check Response", "danger", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "24cdd330-d6d6-4380-bc37-0638da4e801f", "", "High", "", "", "Severity_1", "3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:26");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "25db5593-04ff-449d-b371-182174fa0d88", "16", "Payment Success", "", "success", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2d32995d-8417-452a-9e23-2c5d63c441d9", "7", "Invoice Submission", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2fa6d9c3-51bf-463c-8169-9223ce42742c", "15", "Invoice Approval Finance", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "321d63e4-4da7-46ad-b5fb-10e6ab4f0860", "", "Database Administrator", "", "", "Category_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3f573691-2f48-4956-8a3e-985bdcb3d409", "5", "PO Decline Finance", "", "danger", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "43fca9ab-d42c-45a9-a7a4-a4fe29ca630f", "98", "Software", "", "info", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "48818aff-ceb8-432e-8272-3716020924a8", "4", "PO Approval Manager", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4971f27d-94c6-45c4-a7d6-615cea506a29", "3", "PO Decline Manager", "", "danger", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4ee44c89-d999-4b65-bcba-8494767fa62f", "9", "Invoice Approval Manager", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f5e8ca1-d2d4-4041-8191-569cf51c710c", "99", "Cancelled", "", "danger", "STATUSOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "542790a6-fd64-4909-86af-cd991745c705", "92", "SPU Approved Manager", "", "success", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5b3360f1-e8b5-4ffc-b81a-41898a084094", "", "Hardware", "", "", "Category_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ddf08d6-c10d-4513-a8ef-66285ed43103", "17", "File Transfer Available", "", "primary", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65a0095d-6ebc-4400-9933-cef4d95ab793", "12", "Invoice Decline Director", "", "danger", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "75b83ec2-90a7-42fc-beb5-657474b4dcb1", "0", "New", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "76548dc0-9aa9-4ab1-9d31-858f08aced4f", "4", "Process Download", "Waiting Download", "info", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "78be5ec4-358b-47c7-9c12-2d27b555989b", "3", "File In Process", "Waiting Process", "success", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c431dcd-bc7e-4dfe-890a-636fce06724c", "94", "SPU Approved Unit", "", "success", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7ccbcea0-895a-4e78-b179-cc64e9879fa6", "0", "New Document", "Waiting Upload Tilaka Lite", "warning", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7cfbba68-4e67-4f11-92a2-b1ed56de6c9c", "", "Kesalahan Identitas Pasien", "", "", "REASONOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8a56d066-72ee-4118-b2a7-6fd2a545ce8b", "X", "Potential", "", "warning", "STATUSOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8d7cbf43-f2e5-4816-b5a7-52a4f9fb94f4", "13", "Invoice Approval Director", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9987eb7d-5720-4eeb-8adf-3031a5ced5d2", "10", "Invoice Decline Vice Director", "", "danger", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9f642ff7-4b89-49ee-bca4-acdd258f4361", "", "Low", "", "", "Severity_1", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:02");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a15d3d59-6907-49fa-a5e9-5962f4f08c85", "", "Network", "", "", "Category_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a34ae20b-d244-4b65-b783-2f07100e1bd0", "2", "Agree", "", "success", "STATUSOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a60deaa8-9051-46a7-ade1-b2ccd91d617e", "", "New Modules / Software", "", "", "Problem_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ab2c1168-6646-4a48-a002-c07e6caa9261", "1", "Cancelled", "", "danger", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac73a68c-f4a9-4d4d-9dd2-57b5ad0b421d", "0", "New", "", "info", "STATUSOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac7c9b33-b3b4-4d9a-8510-8b6dcca1e719", "8", "Invoice Decline Manager", "", "danger", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b1fb1856-c98e-468b-b353-980539de5cb1", "11", "Invoice Approval Vice Director", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b7dc8ac1-8016-43bd-925a-44fe5e77edbc", "1", "Follow Up", "", "warning", "STATUSOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b87535ed-375f-4553-813d-10f2e505d689", "91", "Waiting Manager", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb1bd472-87c7-4638-8199-1e267d8a170b", "", "Analyst", "", "", "Category_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd6ff6ce-f73f-4f4f-9f93-d38fdcdc7e12", "", "Second Options", "", "", "REASONOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc3ee53f-fd9a-4226-8549-bbf5f6fe3acc", "", "Biaya", "", "", "REASONOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc3f6d16-e705-4c4a-bdeb-7216fdf7c2c2", "93", "SPU Decline Manager", "", "danger", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e4680723-0f36-4b6e-9092-4abc804b01f1", "", "Middle", "", "", "Severity_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ea0659f9-3e51-4d69-9824-ea8d1a6a4f31", "2", "PO Approval Head Division", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ea846554-e77b-459b-bdae-d66c36a58081", "6", "PO Approval Finance", "", "info", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ecfb6733-52bb-4c90-9f5b-2de65154302b", "14", "Invoice Decline Finance", "", "danger", "PO_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ef44b16b-23bb-4642-84b1-1bee28dce574", "5", "Request Operating Room", "", "info", "STATUSOK", "0", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5eeac74-cdaf-4868-817e-574c98e755a1", "5", "Finish", "Document Available", "success", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fc26b6f3-90ea-4b77-9196-e24ba998f11b", "", "Software", "", "", "Category_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_modules_ms` VALUES ("01b1b52a-7d47-4352-b145-37d9bb2646c3", "Tilaka", "", "45304d5b-390d-4618-a08d-793b475f37b7", "tilaka", "", "Y", "bi bi-filetype-pdf", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("029f2730-7ee9-4383-a409-4b5fe0d61fcc", "Request", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "request", "N", "bi bi-file-earmark-spreadsheet", "0", "3", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("039076f7-393b-4079-b65e-08a8eb673970", "Master Suppliers", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "mastersuppliers", "N", "bi bi-database-add", "0", "10", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("04ee7f51-5847-4099-9d70-7b4f4d9a989c", "Environment", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "environment", "N", "bi bi-layers", "0", "6", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("04fb4f1f-0728-46cf-8a81-4b951687b44c", "Overview", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "overview", "N", "bi bi-question-octagon", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("07eab05f-be52-45ce-8a53-8dd69df443f4", "User List", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "user", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("084bfaa9-8dda-4c7f-a54e-882496b77866", "Repository Document", "", "c820e1c6-18d9-4ab1-9fc1-df6e57a6f484", "bsre", "repodocument", "N", "bi bi-archive", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("0c00c0bb-a973-4d30-84b7-ed486a839431", "Payment", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "payment", "N", "bi bi-cash-coin", "0", "10", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1048ed1d-fef4-4e19-9df3-21c5fdec338f", "Meeting", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "meeting", "N", "fa-solid fa-handshake", "0", "3", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("113cf5a2-ff11-4091-99d5-afb1c525b23d", "Training", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "training", "N", "bi bi-bookmark-star-fill", "0", "5", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1226a31c-fe9d-4102-9750-a4571a08a8b5", "Setting", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "setting", "N", "bi bi-gear", "0", "8", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("123f022c-72ae-401b-9144-624dad3a906a", "Years", "", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "monev", "kunjunganyears", "N", "bi bi-layers", "0", "3", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("15631583-ee35-4d29-9815-b868148c39d7", "Reserve", "", "45689c70-720c-4b4b-b757-f7f1fc80ad47", "ok", "reserve", "N", "bi bi-calendar-plus", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "Sign Document", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "signdocument", "N", "bi bi-vector-pen", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("186c47fa-906d-410d-b41c-355eb52e7d10", "Document", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "document", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1d1d4319-e834-4876-87a9-f3148e17514a", "Daily", "", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "monev", "kunjungandaily", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1eebee7e-a774-4572-a660-8ab49f6a734a", "Dashboard", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "dashboard", "dashboard", "N", "bi bi-grid", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2352e62f-8145-4895-a130-9973e021961d", "Goods Receipt", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "penerimaanbarang", "N", "bi bi-ui-checks", "0", "10", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "Employee", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "employee", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("266bd8f2-8e09-404b-985e-0196c14218fa", "Human Resource", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "hrd", "", "Y", "bi bi-people", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("28f66f08-643f-4808-9eca-956a43889705", "Income", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "report", "", "Y", "fa-solid fa-money-bill-trend-up", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "Meeting", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "meeting", "schedulemeeting", "N", "fa-solid fa-handshake", "0", "3", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2acf8f9e-9143-4089-b4af-4da2aa25dab6", "Master Item", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "masterbarang", "N", "bi bi-database-add", "0", "10", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2b3eeae4-dbca-4acb-be9a-d434f15cd", "Tickets List", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "eticketlist", "N", "bi bi-question-octagon", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "Cash Advance", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "pettycash", "", "Y", "fa-solid fa-money-bill-trend-up", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("33ecb1e0-a8f2-47ed-8919-3c4bd057abf1", "Manager Approval", "", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "pettycash", "pettycashmanager", "N", "fa-solid fa-money-bill-trend-up", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("351be4d9-c967-4d44-a1e6-171a98eec8cc", "Director Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appdirector", "N", "bi bi-ui-checks", "0", "7", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("35e888f3-2365-41ff-8d77-26cbffbb4d4b", "Location", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "location", "N", "bi bi-geo-alt", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("361f2f6f-ab8c-4abe-827e-985d40f04f31", "Activity", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "activity", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("38eab206-952d-4f00-8ef6-f683526ebd9e", "Finance Approval", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentfinance", "N", "bi bi-patch-plus", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("39425516-e7b9-42f9-b23b-02bf04bae967", "Vice Director Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appvice", "N", "bi bi-ui-checks", "0", "6", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("3d143838-e2e4-4d31-99a7-af6f1dca434d", "Activity", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "activity", "N", "bi bi-calendar3", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("43aff7d4-245c-4e5c-8433-cf173ca745fb", "Finance Approval", "", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "pettycash", "pettycashfinance", "N", "bi bi-patch-plus", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("445c4e53-96b5-4f04-b7d9-60cc6ae88fe1", "Registration", "", "8a89a915-4ec5-41e7-b55c-a357ff7e5e45", "admission", "registration", "N", "fa-solid fa-building-circle-check", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("45304d5b-390d-4618-a08d-793b475f37b7", "Bridging System", "", "", "", "", "C", "", "0", "997", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("45689c70-720c-4b4b-b757-f7f1fc80ad47", "Operating Room", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "ok", "", "Y", "fa-solid fa-bed-pulse", "0", "10", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("4610c39b-de32-450b-812d-db8c37fcc643", "Repository Document", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "repodocument", "N", "bi bi-archive", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("47b4877d-7fdf-41de-a2ec-c6f467250478", "RKK", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "rkk", "N", "bi bi-people", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("49e22574-cb55-450f-9d47-6b895b2caed3", "Modules", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "mastermodules", "N", "bi bi-code-slash", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "Master System", "", "266bd8f2-8e09-404b-985e-0196c14218fa", "hrd", "", "Y", "bi bi-database-fill", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "Manager Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appmanager", "N", "bi bi-patch-plus", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "Registrasi", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "registrasi", "N", "bi bi-people", "0", "1", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("55df0fd0-271f-47ad-9e6f-f32cc2005d40", "Calendar", "", "45689c70-720c-4b4b-b757-f7f1fc80ad47", "ok", "calendar", "N", "bi bi-calendar3", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("56f6fcfd-ece1-493f-80f3-1948fe769fbd", "Procurement", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "monevpo", "monpo", "N", "bi bi-layers", "0", "0", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5e882da7-5b62-4031-8ea2-a849d1e0aa65", "Repository Document", "", "df495870-8f19-41a1-943e-5d36ea0553db", "tilakaV2", "repodocument", "N", "bi bi-archive", "0", "2", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5e9a1b26-93fe-4dbc-af0e-2967710e4483", "Role List", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "role", "N", "bi bi-layers", "0", "2", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("635e52ec-e7d3-4a67-9616-fdadd0eceb61", "Nurse/Midwife Committee", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "komiteperawat", "", "Y", "fa-solid fa-user-nurse", "0", "6", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("65e39b7b-a4ee-4045-a6f0-73667f5026d8", "Daily", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "report", "daily", "N", "fa-solid fa-money-bill-trend-up", "0", "3", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("67075482-7943-4031-bb64-bd22997e5b3e", "Sign Document", "", "df495870-8f19-41a1-943e-5d36ea0553db", "tilakaV2", "signdocument", "N", "bi bi-vector-pen", "0", "3", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("68228796-8ea0-4b51-9fef-f9ba7a365f3e", "Payroll", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "payroll", "", "N", "bi bi-cash-stack", "0", "3", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("687b3adc-f1ad-4849-8bef-ee2121faddcc", "Submission", "", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "pettycash", "pettycashit", "N", "fa-solid fa-money-bill-trend-up", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6a3b9836-1cc2-4b8a-ba2f-a5dad734412c", "Rawat Jalan", "", "825a61cb-a0ba-4e96-8dd8-6a93bc938ec2", "monevfarmasi", "rawatjalan", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "IT Operation", "", "", "", "", "C", "", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7111d133-d00a-4eda-8094-8bcceb227664", "Director Approval", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentdirector", "N", "bi bi-patch-plus", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("71dfb7c2-4abf-4f93-b989-7d78f255a074", "Registrasi", "", "df495870-8f19-41a1-943e-5d36ea0553db", "tilakaV2", "registrasi", "N", "bi bi-people", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7320e775-9948-444e-b068-8e69745e77ab", "Anamnesa Rawat Jalan", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "anamnesarj", "N", "bi bi-people", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("73917c12-47af-4672-b57a-45b8cffb8e4e", "Casemix", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "casemix", "", "Y", "bi bi-person-raised-hand", "0", "11", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("77893ebe-697b-4a04-a158-5387c98a0041", "Attachment Claim", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "attachmentclaim", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("78d3e701-b660-4ea5-abb8-c935d1387e2d", "FAQ", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "faq", "N", "bi bi-question-octagon", "0", "4", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "Master Client", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "masterclient", "N", "bi bi-database-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:59:33");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7c69522f-cebf-4377-945a-3324b0a26baa", "Developer", "", "", "", "", "C", "", "0", "999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "Template Design", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "templatedev", "N", "bi bi-compass", "0", "999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:25:26");
INSERT INTO `dt01_gen_modules_ms` VALUES ("825a61cb-a0ba-4e96-8dd8-6a93bc938ec2", "Farmasi", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "monevfarmasi", "", "Y", "bi bi-layers", "0", "998", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("868afde4-08e8-4899-b596-301c1bae2258", "Service API", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "logservice", "N", "bi bi-layers", "0", "5", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8a89a915-4ec5-41e7-b55c-a357ff7e5e45", "Admission InPatient", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "admission", "", "Y", "fa-solid fa-building-circle-check", "0", "9", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8ace90ab-ffeb-49ab-a9ce-9dbf1d9b99d3", "Indikasi Fragmentasi", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "fragmentasi", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8c9136b3-7e71-41b0-ba29-8856fd434a17", "View Tickets", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "eticketview", "N", "bi bi-question-octagon", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "Master System", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "mastersystem", "", "Y", "bi bi-database-fill", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "Assets", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "assets", "", "Y", "fa-solid fa-building-circle-check", "0", "12", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("951544df-6ad1-482d-89e0-4bd3d348e215", "User Access", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "useraccess", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("988c76dd-f5d3-4aca-bea2-1249f980bfc9", "Master Root System", "", "7c69522f-cebf-4377-945a-3324b0a26baa", "masterroot", "", "Y", "bi bi-database-fill", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:59:33");
INSERT INTO `dt01_gen_modules_ms` VALUES ("99d2e39c-89a0-48bc-9117-2770c2d65caa", "SPK", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "", "N", "bi bi-people", "0", "4", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("99df9a77-d5a1-48b1-b3b5-a771ded109bf", "Request Payment", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentrequest", "N", "bi bi-patch-plus", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("9a1cc085-6cc0-40ee-85fc-849357638db3", "SmartBoard", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "sb", "", "Y", "bi bi-layers", "0", "998", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "Apps", "", "", "", "", "C", "", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("9ba71b79-b3dc-41f3-810d-016524a87fdc", "Register", "", "45689c70-720c-4b4b-b757-f7f1fc80ad47", "ok", "register", "N", "bi bi-calendar-week", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a12feb54-1885-4be6-aa09-2c3523eec3dc", "Emergency Contact", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "emergencycontact", "N", "bi bi-book-half", "0", "2", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a1933745-b711-4e3a-948c-330fd60c23ba", "SPU", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "spu", "N", "bi bi-file-earmark-spreadsheet", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "Department", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "department", "N", "fa-solid fa-building-circle-check", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a3e946b9-29c1-4263-a911-87bc6eba561e", "Hospital Insight", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "insight", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a894d7ed-a10e-4359-804e-8223fde34bbd", "Monitoring Evaluasi", "", "", "", "", "C", "", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("aa816bb5-2197-4c1a-90b2-f1e955063ca8", "Backup Database", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "backupdb", "N", "bi bi-database-fill", "0", "3", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("aba0746b-5fc8-4fb7-aa74-f1487cf42e2d", "Medication Dispanse", "", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "md", "", "Y", "bi bi-filetype-pdf", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("abdabe47-4395-4f92-a66d-3d8844ff34bc", "Absence", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "absence", "absence", "N", "bi bi-clock", "0", "3", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ac2e3614-bff5-4855-b14f-6efeb598855c", "Report KPI", "", "266bd8f2-8e09-404b-985e-0196c14218fa", "hrd", "reportkpi", "N", "bi bi-speedometer2", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "Stock Opname", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "stockopname", "N", "bi bi-boxes", "0", "10", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b56ff379-5619-4064-b572-407671edc15e", "Education", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "education", "N", "bi bi-book-half", "0", "3", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "Careers", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "careers", "", "Y", "bi bi-person-raised-hand", "0", "998", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("bacde412-a651-4c8c-8237-155b39a4595b", "Connections", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "connection", "N", "bi bi-link-45deg", "0", "7", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("bc60eda3-abcc-4469-9392-91614e7e9521", "Commissioner Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appcom", "N", "bi bi-ui-checks", "0", "8", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "Overview", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "overview", "N", "bi bi-speedometer2", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c23d0cb1-f394-4b6c-b35d-e5d0c119f816", "Canister", "", "aba0746b-5fc8-4fb7-aa74-f1487cf42e2d", "md", "canister", "N", "bi bi-filetype-pdf", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c3ef6c77-86a0-40dc-8f33-087871394836", "Document", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "document", "N", "bi bi-archive", "0", "5", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c5a700bc-e6d0-495d-8b17-754b5033d5ec", "Registration", "", "c820e1c6-18d9-4ab1-9fc1-df6e57a6f484", "bsre", "registrasi", "N", "bi bi-people", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c7e5c5cc-ce6d-4c2e-a05e-bf4e2bd9df41", "List Assets", "", "8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "assets", "listassets", "N", "fa-solid fa-building-circle-check", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c820e1c6-18d9-4ab1-9fc1-df6e57a6f484", "BSRe", "", "45304d5b-390d-4618-a08d-793b475f37b7", "bsre", "", "Y", "bi bi-filetype-pdf", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cbb9bd4f-15d9-4799-a942-b8601961adeb", "RKK", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "rkk", "N", "bi bi-bookmark-star-fill", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cda2e6e6-99f8-415d-b52b-320b51b0028a", "Finance", "", "", "", "", "C", "", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cded1e6e-e203-4dda-ae26-a0c8b30d9f2e", "Manager Approval SPU", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "managerspu", "N", "bi bi-file-earmark-spreadsheet", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d00ef65d-9af6-405c-a8ef-b5e3dc312416", "Quick Report", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "quickreport", "N", "bi bi-layers", "0", "1", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "Table Database", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "tabledb", "N", "bi bi-table", "0", "4", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d52c72cb-f61b-4354-9ffd-6200d2d7da85", "Finance Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appfinance", "N", "bi bi-ui-checks", "0", "5", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d7ca1a2b-e684-4b50-824d-50540afaa994", "Payment Procurement", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "paymentpo", "", "Y", "bi bi-box", "0", "8", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "Mapping Role", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "mappingrole", "N", "bi bi-layers", "0", "4", "9", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("df495870-8f19-41a1-943e-5d36ea0553db", "Tilaka V2", "", "45304d5b-390d-4618-a08d-793b475f37b7", "tilakaV2", "", "Y", "bi bi-filetype-pdf", "0", "998", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("dfff16fd-8bc6-410b-8500-3548cf245a86", "Manager Approval", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentmanager", "N", "bi bi-patch-plus", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "Careers List", "", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "careers", "careerslist", "N", "bi bi-question-octagon", "0", "9999", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("e68bda4d-9e9f-4a89-bd23-ca80983eca32", "Daily", "", "28f66f08-643f-4808-9eca-956a43889705", "report", "incomedaily", "N", "fa-solid fa-money-bill-trend-up", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("eaaba437-4823-4819-a912-7bbf789959fe", "Vice Director Approval", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentvice", "N", "bi bi-patch-plus", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "Kunjungan", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "monev", "", "Y", "bi bi-layers", "0", "998", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("eeb5b08f-596b-4966-8649-f3f119325a67", "Careers Apply", "", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "careers", "careersapply", "N", "bi bi-question-octagon", "0", "9999", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ef759cae-8fd6-4e36-9790-439e03c3a503", "Logistic", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "logistik", "", "Y", "bi bi-box", "0", "7", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "Medical devices", "", "", "", "", "C", "", "0", "997", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "Support Center", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "support", "", "Y", "bi bi-person-raised-hand", "0", "999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f71515e5-57b8-41de-9c49-5e494c497563", "Position", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "position", "N", "bi bi-person-lines-fill", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f7d07231-f33e-4050-a6f8-c846cc6aa031", "Validation", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "validation", "N", "fa-solid fa-list-check", "0", "4", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "Group Activity", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "groupactivity", "N", "bi bi-person-badge", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f9afc38a-bb61-4f98-b593-211766ec6133", "Leka", "", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "medicaldevice", "leka", "N", "bi bi-grid", "0", "1", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f9e7f495-3ac1-4e07-99cc-14160791c745", "Request", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "requestnew", "N", "bi bi-file-earmark-spreadsheet", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "Profile", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "profile", "", "Y", "bi bi-people", "0", "2", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "Position", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "position", "N", "bi bi-book-half", "0", "3", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ff61f738-5cd8-49f9-9005-7236fdefdc6c", "Validation Document", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "validdoc", "N", "bi bi-question-octagon", "0", "9999", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");


DROP TABLE IF EXISTS `dt01_gen_organization_ms`;

CREATE TABLE `dt01_gen_organization_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `CODE` varchar(6) DEFAULT NULL,
  `ORG_NAME` varchar(4000) NOT NULL,
  `WEBSITE` varchar(1000) NOT NULL,
  `TRIAL` varchar(1) NOT NULL DEFAULT 'Y',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ORG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_organization_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2K9UWX", "RSU Mutiasari", "", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-03-13 14:31:56");
INSERT INTO `dt01_gen_organization_ms` VALUES ("a4633f72-4d67-4f65-a050-9f6240704151", "", "RS Thursina", "", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-03-13 15:00:30");
INSERT INTO `dt01_gen_organization_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "", "RSIA Budhi Mulia", "", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-03-13 15:00:30");
INSERT INTO `dt01_gen_organization_ms` VALUES ("d843b43e-158e-45ce-8f68-795ae1e218d0", "", "DTechnology Corp,.", "", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-03-13 15:00:30");


DROP TABLE IF EXISTS `dt01_gen_pasien_ms`;

CREATE TABLE `dt01_gen_pasien_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `PASIEN_ID` varchar(36) NOT NULL,
  `INT_PASIEN_ID` varchar(100) DEFAULT NULL,
  `INT_PASIEN_ID_OLD` varchar(100) DEFAULT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `IDENTITY_NO` varchar(100) DEFAULT NULL,
  `SEX_ID` varchar(1) DEFAULT NULL,
  `TEMPAT_LAHIR_ID` varchar(100) DEFAULT NULL,
  `TEMPAT_LAHIR_TXT` varchar(1000) DEFAULT NULL,
  `BOD` date DEFAULT NULL,
  `MOTHER_NAME` varchar(1000) DEFAULT NULL,
  `EMAIL` varchar(1000) DEFAULT NULL,
  `PHONE` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`PASIEN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1d388997-3327-4746-8e80-0d49f37d1303", "forking postman collection", "informasi langkah-langkah forking postman collection", "https://satusehat.kemkes.go.id/platform/docs/id/postman-workshop/forking/#forking-api", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9fd2c349-c12b-470c-867c-f21b80df021c", "import postman collection", "formasi langkah-langkah import postman collection.", "https://satusehat.kemkes.go.id/platform/docs/id/postman-workshop/import/#import-api", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b18e4ceb-2363-4377-985c-b35dcc0a4408", "Certification Practice Statement", "", "https://repository.tilaka.id/CP_CPS.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c491f152-a328-4868-9331-87142f3f6415", "Kebijakan Privasi", "", "https://repository.tilaka.id/kebijakan-privasi.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d00e3b9e-933b-42d8-a493-19a41a01cc9a", "Perjanjian Pemilik Sertifikat", "", "https://repository.tilaka.id/perjanjian-pemilik-sertifikat.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d2b728d9-4f81-44bd-b2dc-acdf546123d8", "Kebijakan Jaminan", "", "https://repository.tilaka.id/kebijakan-jaminan.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d326eb39-6755-4ff8-a094-d396102424e3", "Postman Collection Satu Sehat", "Akses Postman Collection SATUSEHAT melalui web browser Anda.", "https://s.id/PostmanSATUSEHAT", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e4ff825f-b7d1-4aee-98a7-ae71409de23d", "Mail Hostinger", "Akses Email Hostinger", "https://mail.hostinger.com/", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ed77c32b-e6ea-4883-971e-999b2d522b10", "Link 9", "", "", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "00081cb8-d49c-4ebc-91e4-3f3e1e364d9d", "e2f200c2-4046-4ff2-bd22-f44d11cb1662", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "00514173-5aec-4d59-95e2-ee6b856e8ae5", "d02115c1-0221-4da2-a5c0-ffc786202947", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "00cad78d-8e80-47b4-a217-fe096309e520", "8e61fbd1-e130-458f-aec6-4ea757dfda27", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "00e3e244-e052-47c1-8fab-6723f10f8e13", "a8ebb467-bb59-4cf7-84d1-eb920ce7c95a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "00fa8679-6990-4dac-a811-032105866739", "4c6c84ed-edf5-49a5-b6c7-2f0bbc345d1b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "015089f1-6d98-46eb-8f1d-b16363c46c6d", "ef0a33d4-6320-4442-9746-82f1aaf7654a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0162eb08-eab4-4db3-af39-b856f5fbe05e", "9aec5856-fdc2-4aa9-9694-824cf15ad1ae", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01784f0b-aa27-47c9-bd87-70e95e95e119", "b7925d7a-31a9-4547-ad72-1822faf53bd3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01953c14-92c2-43e1-8988-9a3aca8ecb48", "36c1c8cc-2d71-4a0d-b41a-2448aca744f8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01b85ba3-96fa-4af6-bd0b-b4038cbc1d97", "35edfebb-aaad-42d0-98c0-c57497a964a1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01bd943a-4578-4c4a-8df9-7fde88b5e6f7", "c36a2199-12a7-4b3a-9b07-5e9411218b07", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01c34013-6a95-4fad-bf8b-6d45d789b10d", "a5505b7e-e181-4030-830e-76e81e1dd0b8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01d9ffd4-52f8-4032-b8ed-4464d2587999", "55bdc060-d49f-4a3f-9ec8-067465e94450", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-16 15:29:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-16");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "020f9602-2fa7-4ee2-a585-688e39cde33d", "cae55405-2f77-424f-8093-fd20296f4fb4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02220fc5-febd-4720-898e-17b1e540ea14", "af014497-67f1-4258-b0c9-2ce8c6bcebdc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02b9c142-7b1c-4055-a021-a9a1342dcf26", "1ddcac65-4d10-4b3a-976a-fde87aa30617", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02cbe8ad-5b7f-47b5-8034-9048bfe82221", "7613ff55-558e-469d-8b22-d6402adf5fcc", "64502c81-163a-4ded-a7c9-3136024d26d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-25 17:23:06", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02d095cf-9716-41c4-a5ea-0a383ef2d0f5", "80cee2e0-189a-4b57-b135-052dad29005c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08 16:21:57", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02e81a95-a4ec-4f40-879a-d5a7a0ecaec0", "26049bb1-0bcb-4c9c-b18c-e9e50e81276d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02f7b947-0382-4b98-be09-bc7a7051e6c2", "11a2137a-69f3-46c6-9b2f-71575fc2b60a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "036f5c5d-8bbe-460a-8318-53320395de95", "9caf2dec-c564-4be8-a213-36f85292c282", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "036fd0a6-0e2c-4817-b33f-7de7aca119a0", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "1", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "2025-03-26 08:55:18", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "2025-03-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "046141d1-5026-485c-90ba-d3306f1ba38f", "1d8779e1-1c06-4b3f-9960-1524f9c2bac4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15 10:01:32", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "04b8c826-bef6-40c6-af38-9987c437a53f", "bcbd7c11-a6eb-486c-8668-9862a7653816", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "04cac291-337f-4faf-98f4-39a889be3779", "bb5e3eae-dcf6-4d4b-aab6-8b2479d51181", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "04cf3286-9e21-47d1-8412-84ac34a50d2d", "07f1c8bc-e092-413f-9f21-5501ded456a7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "04e576bb-5eba-46cf-b299-f2c21ebb5a27", "e42803f6-39ab-45df-a4bd-4b807154cad7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "04fa103f-5929-479f-905c-13e9530db804", "c0d845c7-f599-453d-81ab-88c52890f118", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "05187e44-c505-4602-896d-66ac4e0d2318", "6ca14165-31af-46f2-898c-3fc049aec967", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26 10:23:16", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "051b3180-b298-46f1-8212-7f041fae9a46", "0f6cf205-daa8-4626-b84a-a3a70a8a7c02", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "05260cb2-66c2-45e2-9dcf-54fd9c3cf00c", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25 13:00:20", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0554584d-7ea1-4a6d-96c8-6be1437e7011", "3e818f20-b38e-44c2-8d1a-6832a026f6f1", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:25", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "05c7b45c-8f78-4f60-99c0-f70f8bc36e66", "3ce97ae3-7d62-4488-9ce6-c56b336243f4", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 13:30:58", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0634d6ee-cb06-495b-bcd8-cd4aa571991f", "bb0df4e7-0005-445b-a0a4-17150a4f2e83", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-21 09:44:05", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-21");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "063faa35-ec2f-4349-b614-fe3a8b4cdc8d", "75c67a04-f8cf-4d2a-b51c-5a2f66d04c9d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06548d06-3513-4857-8767-6467be281cf4", "8263fbc6-47d8-4cdc-8dff-2bec75de8fb1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06825357-9e35-4f0b-877a-d5588da76869", "0fdf0dc6-bcbc-4ef8-814b-02b127b690d8", "f7f8d89c-be4c-424e-a292-78529889491b", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:44:37", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06c59ad8-4f49-4fc5-a513-785458789e78", "013f9e9e-5b29-4375-884f-b2b724ed19b5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-26 22:03:33", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06ea8e7f-fae7-4b37-a6ad-beb0056f8fff", "6329ec5f-c6aa-4532-9ed5-cffe8e9c1592", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0735ed0d-0d29-4daa-944e-ca340db01bcb", "78a98b35-9c8f-4b1f-8c0c-954329d01a91", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "07768a1b-169f-4c4d-a534-bcf1da397422", "479be1c7-7536-4dca-b794-10ded02d9139", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "077a88bd-ecf9-4b72-8978-c88a6a2ef0db", "6b97fc8c-bcf3-4b05-ab0d-92ae2ea88333", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "079591ca-f251-4657-89b3-00f1db107d9d", "1e4ae1a0-fe60-43e8-8e6a-b3d35ab3c1a9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0843e1a2-c4af-4dfb-a5d6-877a10c09649", "f891d99a-fa95-43a3-802f-024a2ae63dc7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "09d3d796-00e5-4139-badb-55897fd35a61", "750f1344-b7ae-4af8-8793-9b084154e1d0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0a31bfce-1208-4a95-8dbc-75a34f3ca842", "540264bc-76c5-4012-9821-130001a3e317", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0abd0a91-9f38-49ab-9582-f56b2d0cc71d", "381099a8-cbcb-46eb-bffe-6c1403289f88", "f7f8d89c-be4c-424e-a292-78529889491b", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:42:35", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0b31daf9-0352-41e7-b849-b735f71de359", "1648eba7-46ac-43e4-a363-f8e7cae5696f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0b843ef7-1433-422b-86f4-1d8b49fd3469", "53ab62e0-9d65-4ade-b956-9209a7d0605d", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 14:53:17", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0c01f663-2eac-4884-ad74-7dcaa1b42da2", "f93b33f5-9e11-4b91-98b8-c72786f4603f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0c32d066-f9c2-4102-a64a-88cc78e89d25", "0ca4d783-2765-4fec-8937-877bcc289a11", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0cbef08a-37fb-4f95-8fbf-707e4f48bea6", "7ae5cd44-625d-442f-9eb7-52cc57cf5717", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0ce15b71-ff77-47a2-bbc1-8c151125d0ce", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:39:09", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0d78332c-db97-4b46-b41f-472caa9bfc48", "ead9c1d4-5f9c-4f3d-9288-fae601850d72", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e614386-3a0a-4b80-aee5-2fdb9efc14d9", "f17b5daa-185b-4a73-8b5d-02eb7b5c232e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e6e9ba2-8e28-42b6-b765-9edde281b805", "056dc0ba-c17c-4fee-845e-3aa51ee100fc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0f01a688-8c6a-46af-8862-7b1a7c695864", "42eefa69-43bb-40a0-abd0-75ea24982038", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0f2ce963-ec12-4dd5-832a-22d1b73ffef1", "6d645a0c-9763-4fe9-832a-f6b99350986c", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:01:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0fa8af51-f67b-4a68-87ff-6bd4457d12f2", "466ed1e2-a951-4173-a619-318f75bec4ab", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0fe8b119-4a72-401e-97b4-a7bc9c000a51", "14acc9d8-1d3e-42fc-ab95-8a8ab1aca894", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1008955b-d4c4-4a24-b190-1d195fc795fd", "4f4b3028-9e06-4ef6-8815-f68aba23cbb0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "106f9a56-bc84-43f1-b5ae-98f62703a2d1", "0fdf0dc6-bcbc-4ef8-814b-02b127b690d8", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-10 22:31:47", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-10");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "10f0328a-3f4e-4cfa-8a4a-82ee209ab711", "dad85c75-0f92-41c0-8430-8a453bcc0dac", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "11622b70-162a-4c47-8abc-c630b55432b3", "ff4353bd-6b3b-4456-b510-f9bea6e6ad9a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1282cea1-44ee-4fcf-bb15-17ac541c4e64", "2957ea96-8290-41f4-b8c2-9e69b065741f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1282e263-3475-4c41-80e6-4c7f4131fdbe", "90843691-e2c2-476b-b82b-ca28120c179d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-17 10:25:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1299266e-f3f5-4eef-a007-969164e7f9af", "a11ccf35-93ea-4d68-8795-4f49254fd905", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12a3b403-9ae3-42c8-abb4-8b4c110d8043", "446c1a79-d2f2-49c6-83f1-4cf5b4ba34ab", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12ca8d6d-9dc2-458c-920a-0a36b3a957c6", "2bbee167-9b5b-404a-951b-800cba36f1f3", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:22:16", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12cecc84-111b-4d54-bf1a-3b77b8644751", "e880ec0b-9571-473f-8711-19de67cc4055", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-17 08:19:09", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12d599c0-3b83-4eb7-8d78-d428c30db9c2", "dc93b950-55b7-4402-b68f-79df3b82795c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "133b3b8e-0d6d-401b-8190-b0fc275fb872", "d6dcfb4e-58b0-41a6-8c9c-d9e686e5b77d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1462f03d-f9ae-4973-986e-8969e306046c", "a611d2cd-1dbc-448b-bb8e-531e4c1fc252", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1489c48d-318b-4481-b5a2-e4d68e76bb4f", "406b164b-1ae5-4733-9ac1-974f7d5d8fdf", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1525edc4-194a-4cca-9025-99f158ba3d6b", "08543cbd-1788-42ef-86ea-961ac26f57fc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-24 15:04:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-24");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "155f7c37-635e-43a9-b0f6-4f11d19eac65", "006f8f10-aa25-44b5-a78b-10abb2b26359", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-27 15:30:08", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-27");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1574a4df-03f1-4e13-b8ce-f16da90b364a", "fdaa193e-58ae-4b04-b8f8-c0d8ed2da675", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "158125b3-1ac0-4928-aeae-a5cb24cde3f7", "71e3a707-281d-4843-b2ae-e289e1f033f4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "15a26fa3-7759-44c0-9f22-af46f2d0cb6b", "f2d74256-985b-4647-8c0d-c1a9d3101e64", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "15eca1d0-106b-4c34-8254-101aaa8d9253", "6e7a8181-ae7f-4d17-aeb0-37063c9c0cb0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "161327c3-d632-4c38-a0b7-05d3302f401b", "3eacb0ee-fe56-4170-912d-7049317389e8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "16156fa4-1987-4461-80c8-7ff2ec161732", "98e0192a-d390-48d8-b2c2-c01aa2f16126", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "16ccb804-0f72-4245-ab36-b165b234dea0", "1d747d03-083b-4076-be19-48cde28f186e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-09 13:36:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "170ee1d2-af4f-4e2c-a118-570a56d68e51", "42eefa69-43bb-40a0-abd0-75ea24982038", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:45:07", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "17aa28ea-a4de-415f-8265-0e86361114d2", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "f7f8d89c-be4c-424e-a292-78529889491b", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 11:52:42", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "17fd054e-f3f9-4184-b48e-56822bf0e6f6", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 11:53:22", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "19d55bf6-5961-4da1-a9b7-fcaa93b9569b", "293d9f85-9738-4c58-a35d-9186be2bf737", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1a9cc3e2-f57b-4f2f-9f89-fb6621f5e160", "3ce97ae3-7d62-4488-9ce6-c56b336243f4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1aae02a8-46b1-41d9-8dbb-8ac57643b07d", "53bc2d2e-0fe4-4b86-a159-aea1e9e99f91", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1adc10f7-22c4-446e-a6de-4273d2c33866", "55aa19b0-91bd-4ec6-ba2b-254a140dbafa", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1b181d18-3efe-4ca5-95c9-3d3d685f7e2c", "5f2976eb-85cf-4817-b448-8676576c8f68", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01 06:30:24", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1b1ab42a-0d61-46e7-8ffb-ed5afd4af00b", "1d3c2edc-8653-426c-b810-a26749184007", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 14:08:01", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1b5cea95-f415-4ba5-9903-a825779937be", "13a3a9b1-6afc-4416-bd5b-e3f64bee03e2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1bb5e937-9241-4105-a0d8-26fb01d7c0bf", "c2a7d458-a6d5-4912-b45f-4b91eaef3eba", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1bcc86d9-048a-44d1-b5bd-408031da206f", "5cfe02ac-0fd1-4bbb-b2ab-ac7d8eab1d05", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1c74bf4d-2d47-4744-8f4d-f6f1a169c857", "e684dc83-bee8-4022-890a-e7147acad6f0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1cca2696-78c2-4b00-a4ee-ed60884031ca", "f4f86483-2461-4dcd-966e-80bf8710a0a9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1d66676a-479b-45be-bc78-fc4e0263ed39", "9d8d6e7f-2f3d-4cc5-bc0a-aeaf78ec1da0", "20692618-6042-40e6-b6b4-df381bb99c52", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:53:30", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1da937c3-af7d-45ca-998d-f2a91a58ffad", "f8a40069-808c-4cbd-8799-58ead588491c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ff45aae-072d-4482-bfa3-c84573050fb1", "4607be90-ec14-44cd-9743-d46b33e7405e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ff95976-9300-422a-8a3f-14d91c170912", "9d8d6e7f-2f3d-4cc5-bc0a-aeaf78ec1da0", "e0dbcb16-a471-478c-8699-8fa92f84bc67", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 09:18:54", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "210141f7-767f-4a84-a24e-2064af424e4c", "396d6f1e-b760-4dfa-a113-a1f11fca4211", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2131264d-0930-4814-aef7-b58161b9f5ec", "38acfe3c-5b1c-4036-be32-a6d271d1d8ae", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "213a7e48-e41f-4f28-b7ce-c1552c79998a", "6f650102-9318-4b01-a73b-84ea333d3180", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "214056bd-3825-43cb-acb0-6fb4b8964b4e", "beea9c43-6b95-4fcf-ab20-92560556c633", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "21861bdd-d01c-49f1-9d7b-2855b8a2c27b", "6c25cd59-e96c-440f-82f3-f3227b6bcad2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "21baedd4-0c75-44e0-a293-3457136962ff", "381099a8-cbcb-46eb-bffe-6c1403289f88", "0aa69419-0083-4a58-8557-3781a4944b05", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:09:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "223e380e-6922-4a7d-9882-02c26ad468d7", "882ab337-bd48-4a55-aaff-375191a40f52", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "22a4b84b-e9c8-4e9b-8f6a-3b31b4215efc", "f06e54c2-bf12-40b2-8746-2a8c852118cc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "22d67fb8-9ad8-44b1-97d3-85acc25afc90", "b6f034e3-d53e-4464-91b1-0956be90b9e1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "22e609e1-4c22-4cbf-9df4-4366a52fe6bb", "75cfcf69-d09b-494e-9b5d-8bea4687cfb9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "22f8c50a-fca7-473a-b089-73e84533bd60", "1b2e4902-1825-4b87-8881-a4e70c219b4a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "233f28b3-ba92-47de-83fe-1a7245250a7c", "6d645a0c-9763-4fe9-832a-f6b99350986c", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01 20:46:36", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "23586b22-f270-48c4-9073-0e77785cccb2", "39703f6f-5ff6-4a91-aa5f-077bba2239f7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("a4633f72-4d67-4f65-a050-9f6240704151", "237183b6-5f44-46ab-8ea0-5a8e5cd78430", "0be0ff60-0584-4585-aa63-eecf572f97a5", "f932eed5-c9f9-49fa-a635-a73f7e1461ec", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:54", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "23cc1dd9-46bb-4efd-a316-32bf8d8f47f0", "9d8d6e7f-2f3d-4cc5-bc0a-aeaf78ec1da0", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-04 14:49:47", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "24388cfd-af06-4679-81c6-98cbeb8e4ccf", "60812c0e-6337-4939-a137-743f8541e538", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09 15:33:20", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2511a430-6b87-479d-9c06-cbf201dcd5d3", "c4160553-e512-4192-b1af-ec52c2a25ea6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2516299d-1eb1-4de0-9392-ca2d9d04961a", "5f850424-8f44-4810-8a94-148521454903", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "257fbe2b-06cf-45af-80bf-567bd2c72caf", "3e818f20-b38e-44c2-8d1a-6832a026f6f1", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09 10:43:02", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "25c2717f-895e-4e13-9814-32a9e35dbbd8", "3e818f20-b38e-44c2-8d1a-6832a026f6f1", "64502c81-163a-4ded-a7c9-3136024d26d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:43:11", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "25f203af-8712-4c94-a3d3-ab29f68c5a44", "e8d7a202-2d08-4081-89ae-c07ce8fa8193", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-07 15:19:35", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "262eab3d-e99e-45b1-8288-3d1f63dec625", "60812c0e-6337-4939-a137-743f8541e538", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27 11:28:52", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "266ea17e-e729-46d9-a1bc-28b77e0ac385", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2679bd1b-ff6e-49a2-9fea-0d2489975f73", "1c5fe40a-63e7-486b-805a-7bddb9d3b629", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "26f0edae-e651-46cf-8c24-9e7c43892432", "7e5da8c6-d830-46f5-b3d2-cb0e47db1a8a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "276467f1-1f87-4f03-8d40-001c6b741083", "ab001ec4-722e-4e34-8ed2-ba7e5f597620", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "27c75475-9c88-45ff-9395-03940a60242c", "c9d2d33e-60f5-4319-9c24-494b4a04c4d3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "27f17c2b-41a8-4cfd-9033-cb02c76c5113", "bc15bbd7-903a-421f-810f-f62de5a72f6a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "281088b6-08c8-4261-98b0-7f6d3f2cad78", "0a7e2cb9-7520-459a-8794-b8307cc227ad", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05 14:03:36", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "28905dc9-d973-438b-bb12-bd212a493444", "ca4247aa-a418-4ed2-b63e-ab9abecf6a19", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "29682be5-79df-4fdf-a593-75284c8c803b", "f8bfeb9b-c4a2-4cd5-bc83-bde7913002e7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "29d258e3-9578-455f-bd5f-08ed787b471d", "71513647-ce7e-419e-82ac-d54f28772669", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "29e7cf12-299e-4eec-ab6d-36c56862f854", "582222fd-23ba-459d-be5b-560c6ecc7e3d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-16 15:35:28", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-16");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "29ecc309-e659-4135-8bee-8c8def5de13e", "5f5d8e03-9c1d-48f2-ae46-63c18aa7509c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2a05225c-1481-4b43-ac43-5e551d63dbd6", "0ad8ffc1-a59a-4ef7-be84-79475ed71b8b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2a4fd3ea-8739-402a-b344-892ea5ddbbf2", "43d9e23f-e345-4526-8dbf-820820f78fd7", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20 17:05:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2a73d650-073c-4470-8adf-c0d83e6e7ee2", "c6fe7d34-689d-434c-916f-befababbdd37", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09 11:27:28", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b1df350-c7bc-4b30-b5e0-156a1b80e326", "15c54529-df9a-46eb-9692-ed6ae53f4ef1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b72fde6-4aff-4865-b399-c95aec6cfe32", "d05ff73f-dd81-4b86-b9ba-b94a66de336d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2ba5c595-0416-4185-8e6a-665c0c89c604", "9e3837eb-9799-4d43-a51c-b269ac3e9d44", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2bc3e4ec-0292-4723-ac69-718811711154", "09cc8842-fe44-4508-b25d-23a439015467", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05 15:40:49", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2bcd2069-98d8-4660-a537-0a3ffe703fa7", "a16ae6bf-9299-49ff-9fb4-04c35e04432f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2bef1d6a-cc0b-4827-afda-12781c091d63", "9c499037-d726-47cd-b5b3-248fe8b88cb7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2d5c8c28-176d-4f1f-bf10-7460da6db409", "093190bc-c921-41db-b6ad-64bf41193f15", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-15 09:23:21", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2d66ff17-3a01-4cf0-a9fa-d373c1570f15", "b7e092b7-0d64-4edf-b1e7-4888948c4984", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2df3b7df-d075-45f4-b990-9e80ba244777", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "20692618-6042-40e6-b6b4-df381bb99c52", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 11:53:30", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2df458e4-deed-4cf3-adbc-1c41127d1c98", "2dc2f922-f5d9-4136-9c4a-6bdf5c6b56c5", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 12:05:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2e915f7e-8eb7-43df-ad1d-5a608410feb5", "3e818f20-b38e-44c2-8d1a-6832a026f6f1", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-22 10:43:03", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-22");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f08c6cc-78e2-4e6f-944d-145b4e6c45bd", "b970dccc-73a7-4737-a3b7-ea2bbe8a6f97", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04 15:54:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f1d1b2d-1947-43e5-91d0-cd4f8bde2821", "02a4fc89-5beb-4201-bdd7-6b5ac3740da4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f3f1d14-6f8f-48cd-8ff7-ea64950e852a", "5dd38371-02c1-43d2-9e7e-318801fa1bf9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f762e75-451d-4ee1-baf6-68873d1d5662", "8e19d897-a8f6-487a-b618-d68fbba7821f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2fa7dfee-b60b-41d9-b3f6-fbcc18301e18", "69b4b0d0-627d-45fe-b269-203d99cde338", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2faf9f14-2bb9-441c-84d1-5aa0f8b8214b", "a72c0237-0321-4ced-a31f-923dd4f8e4ec", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2fb1dddc-8f13-4958-ac36-38048b66793b", "60812c0e-6337-4939-a137-743f8541e538", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3021a1ee-416f-4164-9566-a02955491907", "3ce97ae3-7d62-4488-9ce6-c56b336243f4", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27 11:32:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3035f39a-212f-4769-9f98-9d1814e9d287", "310e6855-8666-422b-bbed-47f8984a679f", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:30:39", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "30961cdf-5ce3-4763-b72f-04711dbf6437", "dc77d201-1f20-49ff-b363-8908eea690b7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "30d30450-79aa-4688-89d7-17d46aefd594", "1ae9811d-9db9-4b3c-b1f7-ab2e38a36292", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20 11:42:36", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3269c8fd-17f7-4bb7-8bb7-cd7dc472200f", "0ddd8475-bd29-4f67-a227-8654f2bb577b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32e4779c-d4d2-4fd7-8eb3-9753f6867d5f", "5a2daf2a-0fe0-4603-8cc2-6840ffb4e230", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32e8ec1a-d963-43f2-bfb6-608921f36c53", "7613ff55-558e-469d-8b22-d6402adf5fcc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "33077e80-c4f5-40dc-bfcf-ab7bd431b7a6", "d69006c4-3d61-4198-8946-29cd335ee285", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3319f9bb-9147-47f8-adf6-434b3266bec1", "4c940959-4210-4ce5-adb0-60c515a7f2e9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09 11:28:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "339020a9-e2c7-40dd-bb33-5bcc2adeed73", "b8f703fa-a95f-493e-aadb-3cf1a440dae6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-30 12:00:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "33b5613e-3b1d-4d0d-9cbf-6caa74612079", "97615a1a-bb92-4b36-a7a7-c2a333c1c835", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:50:47", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "343de61a-2b53-4900-af2d-28b202562060", "4b444f05-1949-4413-b8f1-2d0eeffa18d1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 15:36:05", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "34b1205c-4b61-4eb8-89c7-14f3ede1907e", "cbcf5614-91c7-41f5-b595-d2e2afd71632", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "359536a1-9ec8-4439-8115-ad7c14f9e92b", "c4cdae96-9d59-4f40-81ff-a192c65e6066", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "359ba7a3-20e4-42fc-a45a-0c03961ce9fa", "392d50ce-8252-487a-a4aa-f0ff309f13d2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3622ef00-55c2-4e2c-9d93-37ff0a60765f", "49f329b4-8f31-4f2b-ae14-8d95f9ed64e0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "36919ec6-6161-4f11-bc84-d0f7814bb798", "63a48966-aee7-47bb-b54a-2972bf668e4f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "36be53d0-811a-4ea3-a19b-4f88dfa7a0cf", "1ae9811d-9db9-4b3c-b1f7-ab2e38a36292", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20 11:42:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "36e91580-1e11-43f6-a892-258abeca5fbf", "50ca9446-db10-4d66-b118-545e32d15eef", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "374bf0ec-6538-4e2d-b7cf-b8b07ec9d05c", "c615382c-e774-442c-ac03-7812fdcdbeac", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "379481d9-016d-4069-862c-9bbe5ba9f4c5", "046a0ae2-be6b-4d01-a340-3c091952a041", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 12:13:29", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "37a2463d-8013-4091-aecf-87683a846be1", "00f8ca4d-a52c-417e-8dcb-c2b4231f46ec", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "37d01df3-3120-4e21-b350-1a71b7b9fa63", "578a9a8d-1f29-4169-944a-ae7ce76e7837", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "37ea332e-1a6c-4c26-ab6e-c79472d13d03", "bd022163-eb73-4305-b994-995237567187", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "381617e4-52f6-4e8d-8c01-5e6958b02944", "5ef2c9c5-b13f-4a84-974f-d0d6e92314f0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "386e3157-9070-43d0-b5fe-cbe017adaba6", "a2cc4741-07f7-4eb7-a3ee-0aa8b2945efd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "387a729a-9c74-4fdb-9cad-1def8f147a0c", "b4ceabb1-25e6-4f61-bbae-8038ad4a73f5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3949cd62-d502-4c97-b1e2-656f8086b8c1", "47d85313-2295-4519-907c-4a655443320e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "397adf2b-c34d-4eb7-b3c6-cb2280fc00e4", "262e69b4-55eb-434e-96d0-6a27712adf83", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3a1f88a0-e78a-40ca-8c62-56d3c089a078", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "64502c81-163a-4ded-a7c9-3136024d26d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:31:06", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-02");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b58e320-a92f-420a-96c1-d93a153f8bb9", "1aebae1c-7804-41ad-a501-9039aa21e51e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b73e57b-40dd-43be-a228-90e8fa7aeb94", "283bba05-251e-477b-8202-f1fb2d389ff4", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18 13:48:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18");
INSERT INTO `dt01_gen_role_access` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "3c29942b-260a-4f29-9120-d5ca6de8bd22", "45e2949e-da84-4b4c-b592-2b566af9c6ce", "8d352c1b-505a-4dd2-82c3-9b7c4b171819", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:54", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3c756fa7-00b5-43a4-8fc3-35cb6a20cfdc", "0bda1b36-938a-4175-98a8-52d86424eb16", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3cb59ef3-2374-44f0-beb8-4766509def35", "16a5512d-cb4b-4fe8-9330-85a8845efefe", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3cbbeee3-9a61-4532-a708-a1bd80a0e7d5", "1c0dc119-9fcc-48e6-9b51-abe2d2dfc122", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3ce9d3fa-35fe-44b8-a64d-748d30102984", "283bba05-251e-477b-8202-f1fb2d389ff4", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18 13:48:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3cf45724-bfb1-4ec3-90b7-bf7368728736", "3c64a07f-3b1d-4575-9a04-37ee1484e7e0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3d83caed-215e-4bf6-a013-919c1dd4304f", "631160ab-f79a-4ca6-9821-5e7fc673a717", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3d8c0a85-33f9-4a38-b461-19bc318c1f99", "119a5bd5-d444-4983-b9d9-3b78ef833387", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3e3f7258-70f8-43fd-818d-b2ae395aac9e", "2348dfa3-924f-4dbe-a333-f6571486f646", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3ed91886-f16b-4f0c-8244-05fcea6ebd05", "2bbee167-9b5b-404a-951b-800cba36f1f3", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 13:31:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3ee3d484-9be2-4678-a39a-ffce56263015", "046a0ae2-be6b-4d01-a340-3c091952a041", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 15:27:43", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3f48bec2-9b85-48b4-87d2-9de6f5b9534f", "d51635b3-6656-4fc4-a267-6de07ba6338c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3f8c683f-64e6-40fd-ac8e-97407c1acadf", "5f2976eb-85cf-4817-b448-8676576c8f68", "64502c81-163a-4ded-a7c9-3136024d26d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:31:46", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3f969d03-0e33-49e3-9f8c-d2e283d0d423", "ef3cb47f-6aa9-43db-8638-c117b068fae8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3fac215f-b04e-40a4-9d7a-adbbc937e28a", "3fc3a23d-bf0e-4083-8191-2cddc9d235fb", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3fda5a03-870c-41bd-9053-3900e278b4b0", "54642c6a-9d3a-4989-9c57-01b7cc4b30a0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-07 15:20:03", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4045aaae-e029-43e8-ba6b-5e9a5e33593d", "3e818f20-b38e-44c2-8d1a-6832a026f6f1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "411c665b-a299-481e-96b5-f351ec245357", "c7619cf1-9647-4909-bc30-fec5ba49dcc6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-11 12:01:11", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-11");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4189ddd1-15a3-419f-9e1d-4240a9ee06cb", "03c88e53-8543-4cc7-8590-912837193c9a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "41e3bd0f-0c27-4be9-b15c-ed127b8753e8", "858e3f1f-f98a-4af8-b196-08d543d17f51", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "42377833-14a3-4263-9ef4-dd33fe0b0ef5", "f611e4cd-42bf-4d0a-ab2b-2a09c79c6bae", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-20 17:37:01", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "42ddedf8-db9c-4b9e-acc8-25402c8bd29d", "f38789dd-3f7e-429d-8712-ef46d6303d5b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "43dd1ead-0840-4956-9a93-c837efa2a22e", "43d9e23f-e345-4526-8dbf-820820f78fd7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44235f60-902e-4e75-8ac6-6457f6194330", "0fdf0dc6-bcbc-4ef8-814b-02b127b690d8", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:30", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44585d68-bef8-4716-a262-498d313fe8c2", "d058945e-4e88-4e1a-a031-c0c6b2d9c40a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-20 17:39:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44e34608-79ef-4353-ae24-c66d3d032334", "9f9ac71e-d8b3-4ebf-b6cc-1ef7110d35cf", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "455959aa-42a1-46ca-844d-026d7bf7bded", "af27a740-d133-44e4-894d-c4877aae5a05", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "457463a1-81ed-4c8d-92d6-88d1979d4730", "5bcd7706-9e33-454c-980e-1820944b7a71", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45a1a5cd-146a-4442-8902-1e01b38bc551", "efcba1bc-e445-4719-8619-09026ca65ff9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "465f8a55-1192-437e-a900-87dbf5149fc5", "014d7b68-6917-4429-a30c-bd6fa15a60fd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "46ddc40f-5afa-4cc6-952d-a42f231e4dba", "13ea64c1-4d7a-469b-92d1-32cdb0c4779a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "478ee9c2-58be-4ef2-96f2-b7b6e2b8933a", "da27028c-f697-4a18-ae30-844145596995", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "487561a4-4414-44f1-ad24-a10df1c014d0", "2bbee167-9b5b-404a-951b-800cba36f1f3", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 13:31:55", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4935eddf-1278-4c82-ab37-3d1037dcf2f8", "0a2d058d-2d7b-4c08-a49f-a96a2053257d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "495d8f0f-5bae-4739-9ca2-231e4e540605", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "2025-03-26 08:55:15", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "2025-03-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4aac3a67-b4cd-4a8a-bd48-e8110c97832e", "30fd4706-ebe1-4624-b515-2394fe2f6cc5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05 14:05:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4b2ab118-046a-465e-a77a-0f3ad16fdcd8", "f0bc5823-f43f-4933-8a40-6f2704a79424", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-07 11:45:00", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4b8e6fd7-a1e1-452b-a017-939a66f4b065", "c2645706-6dbc-4024-937f-e619dbd9e9c8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4be71bd5-9911-4a7c-baf0-f8853323b499", "7e2d472b-ebd9-4bf3-820f-f5b97f8443b8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4c8c7710-073b-488b-84d2-52fcf83c7470", "9d8d6e7f-2f3d-4cc5-bc0a-aeaf78ec1da0", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 09:17:29", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4cc841a1-966f-4ae7-ac17-a8ed18ac5634", "41f99290-a836-4fbf-bb10-bc9580a00bd1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04 15:54:57", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4d3902c9-f63c-446a-a4bf-0aa39006255c", "2551f544-5de0-473b-a3ad-0421f482896c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4daab233-041e-4eff-a934-a5bb992e8162", "83acd6bf-fe27-477e-9fbe-887115116c5b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4ddec9ad-4f67-409a-80a3-e78f3ed1e9d0", "ff5fe7b6-3e3d-4a6e-8d1b-da82f1edae62", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4fd5431b-c2dc-465e-859d-f70559678559", "b75fe679-4933-4f3a-9550-69007fb1dccc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5060edec-14a3-4577-a231-6f1ab2befefe", "f0113459-cbc1-4e48-b106-30473d8824a6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5109db4c-0c75-4c47-b215-38849b82c9d0", "b8b8ac48-1464-4218-96fc-a20c7305dfdd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "511a993a-8cc5-42d6-9bdc-eada6c7dcaa9", "2de14354-d094-40ea-bb75-38ebd1a061cd", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 12:29:29", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "513edb5c-6793-4316-9ae5-c21e693ebe43", "75e79426-b04c-4457-9ae0-14485b7e70fc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "51406ed8-73c5-41ea-9329-1490bb197c97", "9d8d6e7f-2f3d-4cc5-bc0a-aeaf78ec1da0", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5154f57d-6bc4-4e0e-b5f0-9dcbedbc58c6", "b7544cd5-e279-4a69-b64a-d51a7cb9bcc4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "51654996-4af6-461d-9ed0-f11729fea445", "b99daad0-203d-4747-b3cc-dfc63cd0bbef", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5230dad6-0da0-44e7-bec4-c606712cac33", "0fdf0dc6-bcbc-4ef8-814b-02b127b690d8", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27 11:33:55", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52845e72-ffe4-43ca-81f5-3584e7c92cd5", "48a0dfc5-a1c7-45f7-980d-ec93210b8956", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52aca180-63b7-4e40-b59d-cf6182f3991a", "5f2976eb-85cf-4817-b448-8676576c8f68", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01 06:30:23", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52ddf1e0-2eea-4a91-bb2d-3a1f53bb4f11", "27e725bc-47c6-4c6c-9bf6-00b037facdd2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-30 13:57:22", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "53b7d126-ba73-4a36-8c74-d77dbbbeedc9", "c7e4ee4d-b525-4824-9559-9e32fca0698d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5439e686-a03c-4690-8359-8611353a506c", "9d9ffdf7-1b61-4e38-82c5-598d398d4c46", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "543f6eac-2a2f-4b53-95d6-4ad346682eab", "3c9ad388-6dc3-42a2-ae1c-ed9339e0d778", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5441d066-778d-4312-a376-205ba4af2f4a", "a651ff73-b976-4a7c-9160-6bf1e160c574", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-26 15:59:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "549a9c1a-1dcf-4487-950d-c69d6aeb0883", "9a6ed3c4-edfe-45f2-ac08-a72e03d60778", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "54f74215-d3ab-41d9-96fd-b1c994087d93", "ac6e7b86-754a-485e-abed-c5446ec4d52d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5593645d-42af-4db3-96fc-c904c5070d2a", "3c169618-5361-41d0-9940-1364ad4800db", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09 15:34:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "55e074dd-4f24-40a5-b2c2-8b2069738a5f", "1cd48d56-9660-473a-b880-77258319ffec", "af82114a-23e2-4d2f-b787-0a693fd76d54", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-21 09:16:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "55fdd666-87de-4ceb-a342-ee62d2a3a0f0", "e17497a7-771b-47a2-9d87-c7d99181c310", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5609aba8-bc85-4c52-9d62-12fa821bba81", "381099a8-cbcb-46eb-bffe-6c1403289f88", "8a0e87d7-905f-4991-a260-fbb6bf294f9f", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:52:59", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "565aac19-1eb9-44f1-a33b-23fd3e813d73", "d348524c-8beb-472c-8f83-bfbc081dbfd2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "58893f8f-c62a-48cb-9076-c9556ded4ba6", "67638490-0993-478d-85dd-04388e871712", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "58adaee6-768a-45d1-8e61-dcc93697fdf9", "1e8b9647-428a-44f8-bb9c-986a3d49cccb", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "59293b96-7afb-482b-a78d-29cf904517e1", "7a3ff5f6-68ea-4003-9c22-b5dfb3da41ed", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "59c2017f-9fbd-4be4-8d4b-1fc646a95e5e", "3153e86e-8a31-4bb6-8d87-a4cc007a9389", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "59dc821c-6939-4bfd-a3a0-ae22b57a542a", "f52297de-5836-422b-a498-274612f27ef9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5a0b13ab-5aa2-4a89-a151-9bff52fdb65b", "5f2976eb-85cf-4817-b448-8676576c8f68", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01 06:30:20", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5a13f127-2de0-4fac-96dc-a967243c3c77", "60812c0e-6337-4939-a137-743f8541e538", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09 15:33:31", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ab83992-3327-469b-a871-963c78dfa568", "53ab62e0-9d65-4ade-b956-9209a7d0605d", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:54", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ada1e4f-65a5-4d57-aab0-89f0ea637e87", "6d534245-dd49-4f6f-a0b8-5277c6a44e77", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5b741ed1-bae9-4c1f-8704-e4262d466b2c", "b519d11e-9e90-4bfc-bd7d-712edaa1a17e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5b759ba4-6f1c-4c17-b3b1-5572123feb68", "6ca14165-31af-46f2-898c-3fc049aec967", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5be178e0-67fd-4f91-9307-e4b90ba3f75e", "f6c03536-7200-4d5e-9498-4254aca663c4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-05 13:44:27", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-05");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c7a037d-9bd3-4f65-8722-cb142516c2bc", "e9c22d3e-c286-4e76-8fd3-6f9a850a3787", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c7db595-df70-4003-98a7-f01ffb605dab", "c3181732-8dbd-4165-942b-b1fc3081ccc2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c8e1629-48de-4a1a-aba7-7abee9009ae4", "517eca8c-7b76-48a1-94f8-587e4d5d8a3c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ce55d12-f243-4770-9e1f-bf7c15e98a8f", "2bbee167-9b5b-404a-951b-800cba36f1f3", "e36aed14-9eed-4435-ad86-9df696e90057", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-28 14:07:21", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-28");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5cff76c8-e610-45eb-8c84-0a7b68e60c61", "9d8d6e7f-2f3d-4cc5-bc0a-aeaf78ec1da0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-04 14:49:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5dcc2a49-1bee-4299-a3a6-6a9f965812e4", "2dc2f922-f5d9-4136-9c4a-6bdf5c6b56c5", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:51:20", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5de63d54-d3ae-4e7a-8920-ebb63f19399b", "6ca14165-31af-46f2-898c-3fc049aec967", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26 10:23:15", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5e5a77a3-8a53-424f-8c7c-7a8429d03cc1", "4778d340-6a5e-4eec-8c3c-8068ab5be6e7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ebf8377-3304-413e-9dd9-66e71bcf7212", "9bfa9b1c-258c-49c1-bc03-068fda2964c8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5f09f06a-3c21-4b45-bc28-f1ddba7e8b33", "50ca9446-db10-4d66-b118-545e32d15eef", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 09:02:31", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5f8eca7c-2e94-4287-9e32-41e5fdc3987c", "4c006940-7a0c-47ed-9638-0882b531ef5e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5fd713e1-f2c0-4793-a284-70dba18e2cfa", "e5ffa960-a2d8-41f1-b4d1-f70b40f075a7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "602ce2bf-8b12-489c-8d60-240d977233fd", "06cc4288-29a1-4a52-9b62-b3643ed5e4f3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6086165a-15c7-40d0-b6d2-3d846fa1fed6", "1a907e8d-6233-4218-904f-eb961560d1da", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-10 12:23:27", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-10");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "60eed85b-2832-4c7c-8554-8060fac861d9", "209f96a2-1a7b-44aa-a138-8cfa206e5631", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09 15:35:38", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "60f7777b-7aec-45c6-b92e-7b4f6a7b0e32", "c6ebba0b-6064-4ff1-a76f-db46a3b45bb2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2024-11-12 13:38:43", "6ca14165-31af-46f2-898c-3fc049aec967", "2024-11-12");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6101829f-d812-4165-8687-6da581b88bac", "20892226-c923-4e31-bf95-c0017435b8cb", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6121745a-1e99-4925-bc00-f5b8ece4100a", "bb0df4e7-0005-445b-a0a4-17150a4f2e83", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-08 11:35:22", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-08");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "626afb63-d3b2-4bf7-a199-26e3c111b7ca", "8d3d1d91-5ec7-4a84-90f9-ba225e4fd45a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "62a1c960-529b-4ea8-a720-435ad1acf395", "48e5941e-7a11-4feb-83eb-d2b73ab465c0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "62c98d51-587c-4515-a27c-e5dc9cf36372", "046a0ae2-be6b-4d01-a340-3c091952a041", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 12:13:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "630781ee-81b0-4af9-8d1f-5a044e443f71", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 11:53:53", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6352c231-62ee-43cc-b46b-5ebbc88d282d", "b7a10523-fe5c-4383-af00-37d605f8c313", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "63956454-14af-44be-adba-18cc7ee597aa", "53ab62e0-9d65-4ade-b956-9209a7d0605d", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:52:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "63a56d32-b3c5-415e-81e6-67f219599ba3", "43d9e23f-e345-4526-8dbf-820820f78fd7", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20 17:05:26", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "63cd6ac0-f18d-460f-8d14-9313bd627ef9", "636965aa-c0d5-4bb0-87a2-793ad177c77d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "642ec4c3-0dc8-49e3-863f-12f837427b9e", "73968d3d-de4e-4ad0-84f6-4a4600b22043", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "645bda9d-30b6-479c-9143-ee8069a53e71", "381099a8-cbcb-46eb-bffe-6c1403289f88", "116b3436-bce6-487e-817d-ec9e793e41ba", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:49:23", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6461979a-ea41-4fd3-b091-50f0f5ce9ad6", "bb0df4e7-0005-445b-a0a4-17150a4f2e83", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-14 14:27:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-14");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "64716e1e-9aea-4e0b-ae2d-956e871924a9", "9ee08ae8-83ac-4c30-9309-7a36e09b3c11", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "652d881b-53e4-4bc7-bb6a-8c2bc9d6f3e6", "2bbee167-9b5b-404a-951b-800cba36f1f3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65a85d71-cea2-4852-8e2a-8b83d90b847b", "5be20f3f-971e-4407-8a54-766418654c9a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65b7188c-bbcf-4cd0-a30f-8311cadcaef0", "5d807700-4efa-409b-b38f-6c4eb98f3d77", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65cb3e35-e642-455e-b8c5-2744c01e1049", "aca8892c-5b92-43d6-b518-9773161ae51e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65da4b75-5c49-4897-bbf8-50612b3fc610", "36feda7a-475b-4f16-8572-7b36f7fcacb4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "663556d0-6317-4646-9b4e-36f7ee3be0cf", "6055f6e3-3d12-4de0-a1b7-7271158efeb0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "666191ff-8459-48a0-bcf5-e9c460138900", "554f96ba-189a-401d-aec4-0830d946812d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "66e53108-7810-4c83-9cfb-e56e328c49f2", "40701c09-ac47-4b71-9fd2-f5e0565813fd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "66e76eaa-22cd-40c0-80bb-12d9fdf5eada", "3ba4b281-b797-41d2-83c5-e6ba193adb62", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "67bff9b5-7dc9-4dbe-bd9e-0922d700ccb1", "3e878b9a-62ca-465b-b8ea-7b48a1314b85", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "67e91a1b-5591-4e3a-b4ad-686e5eb93df5", "2de14354-d094-40ea-bb75-38ebd1a061cd", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 12:29:35", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "682f50f7-cd74-4197-a6b9-5f5f9e7f6cb3", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-30 11:55:52", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "689e257a-9b64-4f2c-b7d9-d427d0ddd3fa", "59015f8e-9fbf-4dd9-aadf-21189f1ae66a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05 13:55:16", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6980532c-fc88-4a94-9023-a8fed0da44b4", "26f4021b-285d-4924-a6b3-ad1b4504596a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "699494ae-a128-422d-b9ed-7f9bd0e5773a", "47ed6d85-abfd-42c7-9132-6efd247e0239", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "69f172aa-97f6-4f5f-ac1b-e05cd179ddc7", "136ae30e-4f66-4cea-861b-67f17b78134d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a276bc3-b0d2-4c5b-81e1-0514e22ef2a1", "dcd3e5fc-1c92-4605-ac87-f73524338950", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a398a30-51f1-46b1-bbe6-bc4e2be0739c", "d7003e62-16a4-4483-a01c-87b550369286", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a5a79f7-215c-481c-a1c0-c65f81edcea3", "a8fefdda-53aa-4ed7-a0c1-b72c446871d3", "64502c81-163a-4ded-a7c9-3136024d26d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-26 22:47:15", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a5c83ff-7415-4b15-addf-650190675776", "083bbb53-2a3a-4e16-9e2a-9aa1d06ea93a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-10 10:36:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-10");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a5d5793-085c-41f3-8589-b841bbf01708", "2c2f2551-ecf8-4fd1-a3a8-56a5af724545", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a9879e8-16a3-4e52-bf80-6d5cd2d6e919", "4a1c8be9-69f5-4d7f-817a-c8cc731c8687", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6ad4e42c-4434-458e-b851-b15bc844b3aa", "6ca14165-31af-46f2-898c-3fc049aec967", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-02 08:12:39", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-24");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6b520a4d-3276-43b1-a409-88eb28b5ea06", "bb3e12bb-6a19-4ee3-8344-43fb360ea8b1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6b815cc7-542b-49d2-b81e-ac5abd689d3b", "6ca14165-31af-46f2-898c-3fc049aec967", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26 10:23:15", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6ba77059-9ca4-4759-a672-298099958bfa", "5ace86ef-420f-4495-a6b7-359be801741d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6ceaa6e3-18fb-4d20-bc75-58ead62f3e35", "905f2400-607e-48a0-b0a3-b7c601579e4e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d22ae93-544c-4b34-ac65-405a02c3bf43", "bac4d882-1c7d-4bf2-96d4-0f9ecb1c964c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d634b5f-e645-4c8f-b9b8-3a63b438004b", "d2e843ee-d0c9-44ac-9bc3-a9110f8023b8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d6477f7-3b45-41c6-af37-c33f7ad5b85e", "1cd48d56-9660-473a-b880-77258319ffec", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-21 09:16:30", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("ed7552de-d428-4d3c-bf4a-3cb3cb11459c", "6e86fb85-87f6-4e14-b642-ae40396aa98c", "458ff920-ee42-48f5-b018-c605b41aa7dd", "9d0e6955-5522-4abe-bade-2afa2be615a8", "1", "458ff920-ee42-48f5-b018-c605b41aa7dd", "2024-07-25 23:13:54", "", "2024-07-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6ea13c7b-5d39-4749-b2a2-55779cb8f795", "6d645a0c-9763-4fe9-832a-f6b99350986c", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:52:11", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6eb5bdfb-ec3a-4048-915f-00c368bae7b9", "fba52d4e-52f6-4b37-8343-69d6ff0e9141", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6eeb379d-cbea-4b3e-aed0-65cf131f5ab6", "4f7ae95a-d115-4155-9d0d-77933c6eff6f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6ef846ee-d1ee-446e-a628-3255db837e7b", "59451e68-9a85-48b5-b63c-5726faea697f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6f2876d9-75b8-4242-a58d-fc5e0e1bb3cc", "5414d3c2-d4b5-4d9e-8c11-416eb5f16bff", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6f4bd79a-7bd7-4ac3-b67c-c719a676e0e7", "eb902aeb-e764-4768-904b-805fc497628c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "70f9d56f-9406-49bd-a381-4cfd311dc4fd", "0e8a69d6-8a9b-4f9b-a54d-276f041bbcf1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7133eb84-5cd2-4071-970c-d87e58267f57", "2ecfcf5d-939d-43c1-a345-31afd38bfb08", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "71ae8b2b-209e-4d04-a4fc-3fd446d4dd52", "dfd47676-3aa7-4062-ab9c-4a9a6e41a48f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "71f0cece-0511-494f-8957-201357c49866", "edd9a9ac-84bc-4fea-8f9c-70c19d360d90", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "720a6559-799c-47ec-9dd8-2cb3de66343b", "ea68da96-578c-4890-8a76-baf0c7cbb28f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "72126c28-f8a8-4eab-82b4-763cf41c4dce", "4364e214-84ae-4fdb-a46d-927151837db9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7224eb50-93ed-48a0-9f9c-c8f77201ac2d", "381289f4-dc4d-496e-ad53-f5acb5818bcf", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "72e16c87-a9d8-4ac7-b425-2af0b0d3345a", "6d645a0c-9763-4fe9-832a-f6b99350986c", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 10:48:16", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "72f77b50-4a71-4fe9-a652-c09a503d4a67", "76337298-ddd0-49d3-8e2a-9733d05584a4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "733676a9-3785-4306-bc38-395b81fdc55b", "cb54e4f5-7bcc-471a-9dd0-54dacda254e1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "744a0265-ae63-44f6-8f39-6a2bdf36e859", "bf803cda-7ae7-44c4-a53d-1ff94ed40572", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7484c2cd-7be5-4029-b19c-7dd6ea2226d7", "f0a70cf5-9bca-4724-b69d-9f817f94ca4a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "74d4fbc4-1443-4eb8-a548-8bac700b3df3", "48bd49a3-9027-476c-93a9-deac118df992", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "74faaef0-ddde-448c-8075-3f03b0438066", "ee8e3054-a6f0-450c-bff0-3de2e6c72c55", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "757429f1-ce44-48b1-9904-353ccfe9118f", "90302647-acd5-49f6-9313-2572a0be8c5b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7602b465-d007-4662-bd5b-5afc5ffa25b2", "3fcb5116-c802-4f8a-814c-911e0d7993c0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-06 12:00:25", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "761f82de-f184-4577-83c2-492bf5339800", "f21571af-ca92-4fb5-a7a5-c1d23f72b486", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "766c6701-5dc8-4f91-ae4e-51b01c34661b", "c4cdd66d-77e1-4908-a82e-83088e302632", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04 15:55:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "76d9af1d-c48a-4fb3-88e3-8fd3e0fe995b", "5ef2c9c5-b13f-4a84-974f-d0d6e92314f0", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:38:21", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "77c34bfb-c25f-43f8-a4a7-f06dacb13fee", "e5f6eff7-6e8e-481a-a2d6-cde8dd4f2f20", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05 15:26:18", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "787046da-5e9d-4550-b7bc-84e68c81fd17", "d0ba42c2-14df-4e5a-bd26-2243dc75d054", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "78e3657d-6b1d-4008-a660-647545bbef1a", "013f9e9e-5b29-4375-884f-b2b724ed19b5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7937b08b-1723-4f82-8c19-21e1d2e91e40", "3a065988-3513-4717-a7da-4af74a4240bc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "79402db0-79ad-403c-ab6f-89009f775919", "39116d33-6c28-49d4-8c52-34cf398e1378", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06 14:59:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "796ffe61-37a2-4977-a43a-66a892536c44", "0fdf0dc6-bcbc-4ef8-814b-02b127b690d8", "7a9f1131-3120-4b11-8117-09a860500b46", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:53:13", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "79776282-1c77-4955-ba7b-0568fad99c87", "5f2976eb-85cf-4817-b448-8676576c8f68", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01 06:30:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "79f29c21-6ea9-48ab-936d-79365160de94", "381099a8-cbcb-46eb-bffe-6c1403289f88", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27 11:32:59", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7aeaa232-2489-4612-a316-4e666a59244a", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-25 11:09:59", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7b6429b4-cb77-4aee-9de6-62de9d021b02", "60812c0e-6337-4939-a137-743f8541e538", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:04:51", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7b7f74c9-a86c-48c4-9ade-0d5a65f17e06", "209f96a2-1a7b-44aa-a138-8cfa206e5631", "dd10064c-5e93-4914-b41c-25ca8c974e98", "0", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:48:22", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7bac1ed6-02f5-430f-9df1-bd643d30f9fc", "6d645a0c-9763-4fe9-832a-f6b99350986c", "e36aed14-9eed-4435-ad86-9df696e90057", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-23 11:06:11", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c42c6bd-0c24-409a-8360-d923838d4c32", "283bba05-251e-477b-8202-f1fb2d389ff4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18 09:12:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7daa6813-0bbb-4f12-acc5-c9aecc4d40d3", "3c169618-5361-41d0-9940-1364ad4800db", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7de9fcb5-7b78-48e8-9bd3-8222754202e8", "0ec42ce1-b8df-4747-996b-a72069c97995", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7f9383e8-c45e-4c48-bfc9-4da852e43b85", "3761ee0f-9997-49ea-a7aa-c4c5ceb96991", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7faf8a51-56a1-43cc-80f9-f9da6755f0c7", "9e77c242-b273-4b4d-a807-04f9de0eda8f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7fc6a3ee-b2c3-4aa7-9a30-409cc1d0d7c7", "97615a1a-bb92-4b36-a7a7-c2a333c1c835", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-19 10:19:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-19");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "80026911-7a1a-4949-b046-6190f02b647a", "1cd48d56-9660-473a-b880-77258319ffec", "dd10064c-5e93-4914-b41c-25ca8c974e98", "0", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:46:28", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "80ea308d-4aba-4077-92cb-988557119f15", "729606ec-cb7c-4fab-9e10-e35f80e182cf", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "819c26e8-e5ad-49db-a822-66db76d36b2e", "209f96a2-1a7b-44aa-a138-8cfa206e5631", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "81cf03d0-371f-41ae-aa55-783a305d9fd3", "deaceb78-ceb3-45ea-815a-8c60170919b7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "823964e7-e4e7-45aa-8dff-b530159892a5", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "af82114a-23e2-4d2f-b787-0a693fd76d54", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-21 09:09:48", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8295b953-ef4e-4fe0-8a61-6483f2950260", "283bba05-251e-477b-8202-f1fb2d389ff4", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18 13:48:18", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "833f807d-40f9-44fb-b65d-e56159356d41", "d4fb45b9-c0d6-45c0-a30a-f1e99c33f51b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8352f553-7ffa-47ae-b6d4-01a59f86e56a", "bdb090f3-5820-48d7-952e-9ddc4e24a179", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "83bfe2d1-45cc-43c4-adb5-4398b424ec04", "1108d4f6-b0d6-4037-bcb8-3487b8f85547", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "841899e9-be34-45ab-a6b9-55e908a56fb1", "e5726261-8289-44be-9cee-d097ab4434cb", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "85057057-d2aa-4366-8fc3-ee9e9d5d07bf", "43c34b22-6edc-464b-9e83-b5cece13a93a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-21 13:50:02", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-21");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8572189d-bb3e-4ada-8eb1-ad19eefbb379", "edce951a-5972-423b-b1fd-00aba9d1f0ac", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8575dda4-4acd-4056-9e11-5c59dfab9350", "56f4c210-8b6d-4bdb-bced-c37ab6b0c3ca", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "85d170ed-4f10-40ea-a4ed-8a08d149858c", "8bae32a5-0485-460e-ad45-21e05b2e7d50", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "85f831bf-d0e8-40e5-a458-438e12a72342", "d124d465-cf7f-40cf-85dc-e0e6c07fefba", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "868a3f50-437d-4fef-9c06-c54b3a8a9b70", "751f45da-5bc4-474c-8f5b-ddd067257585", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "872032cc-0743-4a93-8a72-af7b58f04cf9", "4f526e36-db00-4343-82fc-627c04f0fc62", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "875efe50-0581-4074-a99b-496f41ecb3b4", "fc35a053-ca50-478f-8637-af7bee30253e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "88060653-92dc-4f47-a808-0b76a54bcf7b", "6e02f767-a379-4294-b040-09b363c22b78", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "887832f5-4273-47d8-9d00-912af2f13eac", "ef78ccc0-e2e1-42be-8595-42bbe771f761", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "88aa6aac-40b2-4012-8709-dafaa93a7a2d", "47809e7a-ba79-4189-8ff8-7a595721d34e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "88dff95f-e1d6-4851-97c8-f52027e71675", "046a0ae2-be6b-4d01-a340-3c091952a041", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 12:13:49", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "891c6585-759c-4975-911a-3f1a4f388a84", "128b1e01-c2ca-4e38-adbd-4f4c1ea67da9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8926500d-e751-43a2-aed2-770d031f15cf", "a0c40ac7-c57d-4091-b1ac-ab173fa9a06d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89336ea9-2047-436d-a9f3-c4d6991febe3", "b74a700d-fe01-4f9f-86be-390c00c8ff27", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "896005a2-4ebd-4118-a423-b24001ae2acb", "2de14354-d094-40ea-bb75-38ebd1a061cd", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 12:28:35", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89a0b7d9-6a0d-48c1-988c-e462f9438f4a", "3ce97ae3-7d62-4488-9ce6-c56b336243f4", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 13:31:06", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06");
INSERT INTO `dt01_gen_role_access` VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "89eb6ef1-715a-435b-9b3a-a6622df99f76", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:17:21", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89f623f1-171e-4505-93fb-ce24bf516817", "22530cc0-39fd-4641-94e1-ecf50bf249d5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8a412178-2a57-4144-8179-34c74429aefd", "e5046958-94e0-4fea-b2af-b0160af76562", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b1cd376-245b-43da-ab2b-59129f6449ee", "a461eb8e-23a2-4443-b347-4659d13ebaf8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8c255ad0-8bbf-40ef-add2-c16beb126f03", "d4fea950-a917-4221-abd1-f25cfc7e7bf9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8c7e729f-d6cb-445d-a771-94aff1151255", "e0998887-91ca-4ae4-b06a-1d8a50f4667b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8c863d63-a457-4904-9d59-c726ec1a0a4c", "39116d33-6c28-49d4-8c52-34cf398e1378", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8d26eb61-7f61-40d5-a067-a2f2c131c22e", "2e532eda-9f2a-453e-aeba-71b65a9bbcfb", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8dea8753-6435-4d4a-9441-35239ad85ca9", "f7da4a92-af4f-4d8d-afc3-1dcbfe7263f2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-30 14:59:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8dfb134e-4b7e-486b-b546-fbbafbc9b2bb", "81e82a2f-c097-4829-99c5-20d491c6e914", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8e5c3531-b72d-418c-a932-208c40fba0f5", "50ca9446-db10-4d66-b118-545e32d15eef", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06 09:17:51", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8eedf7e9-8bfa-436d-8be5-f56ccf72615b", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-21 09:09:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8ef151a5-c3f3-4b1f-bb82-ed6e09fd9d09", "5f2976eb-85cf-4817-b448-8676576c8f68", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:51:47", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8fa8175b-b0ca-4617-b771-81ef3b4fbcad", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "c70cdcda-900f-4494-a44e-dd91e351938f", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-21 09:07:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8fefe13d-0262-4253-99dc-4f27d3900b41", "eb20a1bf-7381-4c78-8383-a32798ad35a0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "900d4a20-7079-4dcd-be3a-5ffb9d180ea7", "a2f6128d-9f07-4a92-ba44-d51e568be982", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "919b8e0b-b8f7-45d7-8d1a-3590bcc11083", "1853335a-032f-4cec-b53b-ddd03fd6c2d5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "92033c77-8360-4c3c-835a-29d1aec91f28", "2d99aae4-8acb-4253-9783-f9605ddecfb8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "92b4dfae-4cdf-4208-ae70-3d20d12970dd", "7519309b-b92a-4f7d-9010-a508a0da6065", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "930463b6-2540-4b7a-bc33-d5237ce99aa7", "006f8f10-aa25-44b5-a78b-10abb2b26359", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9363b9b4-b2f5-4008-a6e8-9b3c1a2aacd6", "07f81210-23f5-45bf-a951-2f952c6a0245", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "93bd26ef-5f8d-4340-b747-67e7622f50ef", "ce391c55-d3f0-4071-b479-91752bf9d8ae", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "94034c65-4e9d-484f-aa7d-95bc25f72ebb", "9d8d6e7f-2f3d-4cc5-bc0a-aeaf78ec1da0", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-04 14:49:54", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "94307ead-8f9a-42db-8deb-700bd6520cee", "74cdf800-14df-40ac-822a-6bda332342e8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "953a8159-79f5-4e02-b984-0e03f5638cc2", "4414b8ca-e8d9-4da1-a7ef-85556dcad37d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "959d9d11-7de1-4ab9-8510-1b7495da4c68", "704b130e-bde8-42e9-90ee-09ba7edefe84", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "963158c1-81b9-4d55-a993-91df68a76aa5", "e0149ea0-6a49-4e80-b77e-90f645bab74b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9661b7e9-cf33-46ae-890d-3b13ae8b57e5", "1916acc1-a0fd-45cb-b791-7c27608e9b5b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9688f983-335c-41f0-bb69-4bfd888dea9a", "27cd4de3-c30b-4510-aae9-f914bccdbd2f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-04 15:10:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "96a8189a-bf1d-41a3-9b99-bbe4dae537b6", "bfdff33c-2ce9-4a02-9ac8-8314c4daa47c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "970e9b5e-b1a4-4939-9b92-3e86568fbd90", "a126887d-a974-4b05-8684-14ac2431841e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "972a329a-f7f5-4072-8367-4135b3fe9556", "ecd15f71-4eee-499a-8b20-3fa6d2d6c1a4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9748638b-5e96-45da-9b4a-d4fb3cc503d6", "3579a9a0-9c70-4573-b2c6-150449c7545e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "977cb338-2139-4b79-9cbe-a4dbbce9ba8e", "381099a8-cbcb-46eb-bffe-6c1403289f88", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9791dfe4-f2d5-4db8-bbff-5eeceddf1b14", "bc43cff2-16d0-4218-b5c5-0a24780ec26e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "97bcef68-c686-4195-aa23-a36c263b02d6", "f0bc5823-f43f-4933-8a40-6f2704a79424", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9893bc7a-8319-4200-b30a-7305f64775c4", "17f94077-d343-4ac5-94a9-4bf461680a97", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15 14:38:19", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98aebd08-a60e-4c16-90be-9cc464cf7e0a", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "116b3436-bce6-487e-817d-ec9e793e41ba", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:48:18", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98d423c4-96ca-49d7-85b9-80f1b26c4cdf", "e3507a93-20ff-4ce6-850e-83f94a0151c1", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27 11:28:26", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "990398da-499d-482c-a042-37dbd2d6526a", "6b27fd6f-aae4-4d09-80f6-f96ff2650b98", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-29 14:53:52", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-29");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "998bd632-6552-44b4-aed1-a0375ed6efc0", "13fb40fa-eed6-4d1f-bac6-8ceaa44d1a3d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9a374f18-4f84-4d3e-9c41-9b4cd9e0297f", "226abdb1-a5f2-4978-b031-c14d179a4bbe", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9abaa673-e204-41d8-af43-9fbdd1847261", "eb2cdacc-dba5-4205-9e2c-41e986dc09ab", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9bd187f5-97ce-4cf2-accf-8e0eacceade0", "a935e1ce-8bf4-41d8-83bb-ade718affc26", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9c20a9ec-d57b-4f84-9dee-8d06f74b2a15", "50ca9446-db10-4d66-b118-545e32d15eef", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 08:55:03", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9ce15ffc-5440-422c-af4a-6188e3c6d3d9", "89bb2210-7485-4d82-ae7a-1020a76b1bda", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9d90ef77-40af-47b9-a894-e94db186759d", "044e4e51-31f5-4773-a0fa-4f00071e8205", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9ed7bfa5-7983-4915-8f60-a13508faaf6e", "8cf86d23-5fdc-4606-9ae1-dae0ae5b71f3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9ef72cf0-756f-4bda-97eb-1a52493eec72", "5f2976eb-85cf-4817-b448-8676576c8f68", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01 06:30:26", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a008e5b5-0ba1-4e12-87ff-4a06eca1fb4d", "3153e86e-8a31-4bb6-8d87-a4cc007a9389", "af82114a-23e2-4d2f-b787-0a693fd76d54", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 12:05:28", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a0bfb498-3f5f-49c2-a398-534efb4cc997", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "dd10064c-5e93-4914-b41c-25ca8c974e98", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-21 09:06:58", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a115f7b3-2fa7-4464-a143-8541516d3b37", "dce17e86-d8ee-4fb8-8f7a-3c538c4ab142", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-20 14:58:13", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a1226a9b-1ded-4cc0-a541-05545c04edec", "1610deb3-151b-475e-aa19-718fec755595", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a193066e-112a-46f6-991a-bb9824b61e37", "f0c36e3d-7ae9-4196-8b71-0c764e4434ec", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a25464d5-d109-41c0-8782-4f3912550c17", "563b2d4a-7bde-4813-ae4d-5019f303da10", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a255a457-1e7a-476d-bdfc-11bdfda8f541", "04add30b-4268-4f18-b985-c158497234cb", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2bbce73-9ecb-4ad7-8e42-59eda9a02b12", "d6a37af9-e10b-4787-8e77-0eeaaad667c9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2f61117-fce2-46ac-8b0b-586564a6b743", "878e5893-7804-491a-a68b-e63097d78b95", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a37e79fc-5c62-48d9-9de3-382ea47953e4", "a52df16a-281e-47ff-a029-505761c79124", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15 10:03:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a3a1a718-f1c0-49f2-9216-288cbc6e4f0e", "f6a5d5a4-c8f3-418a-a85b-54e1e8f34f9c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a3b9527f-3fc0-4972-92aa-271f6e74ab29", "0d7b5bb4-38e6-494c-9789-3b1ea1ffdae9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-12 15:16:48", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-12");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a3bc26b8-8da0-42e2-b0f9-2c56d5af5c25", "63f94e81-62bc-48d9-aca6-eaee0bd451f0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a4b6ff16-88a8-4d7c-810c-3fc78d6d3162", "b74a700d-fe01-4f9f-86be-390c00c8ff27", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09 15:36:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a4c8c2ee-fff1-4647-af0a-586be23742f6", "5e183444-737b-46bf-8127-341e2bf46a78", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a5011ec6-704e-4469-93f3-9b5a9b210a16", "2dc2f922-f5d9-4136-9c4a-6bdf5c6b56c5", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-14 14:26:28", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-14");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a54f1382-0bfb-4b15-91fc-e608c286c05d", "0fdf0dc6-bcbc-4ef8-814b-02b127b690d8", "116b3436-bce6-487e-817d-ec9e793e41ba", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:48:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a5d0febb-b912-47f8-b7c4-e3b2927fe69e", "06d4c5d6-b590-41a0-b562-7838fa4089aa", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a62439da-b07d-4406-99fa-6d6ae849a9ef", "83324e42-f26d-49d6-a49f-39812803488d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a62c5c58-e6eb-4afd-837e-a2a3e16acb3d", "a8fefdda-53aa-4ed7-a0c1-b72c446871d3", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-26 15:17:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a637b6a0-9289-4aff-91d9-08226fbf7849", "9616cb8b-06d4-402b-b498-e65e5d4defef", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a64158a1-ea96-47c5-a6f7-042942cb47b6", "1c4ab1b5-c2a2-4790-b95b-735f198f9a03", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a64dafb9-25e4-4517-b684-1431a6e606a7", "ed01dbd9-4509-4c64-b3de-97ddf7f442c3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a714b9c8-f655-43f2-9925-8cb977508165", "0fdf0dc6-bcbc-4ef8-814b-02b127b690d8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-26 23:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a7836490-da2c-43dd-a71e-8fe168c844f6", "55d93d0d-90bb-447c-b3d5-e6cea92aa911", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a7d8fb30-2e89-4cf2-b76f-f88f4c408738", "6fcaea6b-5b82-4b36-b07f-f65f90c350c3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a80a1390-2ae2-4bd9-8cf0-0bf8e4dad7cc", "60812c0e-6337-4939-a137-743f8541e538", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-10 10:28:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-10");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a84411d0-539e-47af-96d3-f53ac8346d87", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "64502c81-163a-4ded-a7c9-3136024d26d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 11:52:31", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a8777fea-4595-4e87-aa59-0fb374fe2e29", "874c530c-2ae7-47ef-8063-8696ab4d2540", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a8841577-d7a7-4052-b0da-91531028527d", "ec660b67-e34f-4997-87e9-653864916a72", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a896f972-9272-4a9b-acf5-06ffbc93d3d9", "a8fefdda-53aa-4ed7-a0c1-b72c446871d3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "aac5be1a-e563-4e89-8ac5-eb98792f7d1b", "a2b94f1c-935e-4036-abbe-327f7ba756ae", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "aad98a05-e279-4d48-be47-14d4c6026422", "45691fd5-aad2-4d72-a354-c3a08b5194ec", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ab402f1d-ef96-4ff7-b60a-84692785b3e0", "bb4b5ccb-6987-4110-8011-08a9b0d0ba1e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ab64eaad-9690-4346-a8fb-570c329873fc", "e0f9f878-cede-4f81-acdb-3a4837ce5107", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ab7c7a59-e97f-427a-84c5-cee8c1438c2d", "97615a1a-bb92-4b36-a7a7-c2a333c1c835", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 14:53:27", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "abfa1e73-a98a-46d9-b2ba-a731e8eb2298", "ecc55502-f1f1-4c9c-baa5-1154417e1d41", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04 15:54:48", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac17ca54-b8b9-462d-aa19-0bffac2f3e5b", "97615a1a-bb92-4b36-a7a7-c2a333c1c835", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-11 10:36:26", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-11");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac2bd013-e674-49bb-a5a9-262db925f30d", "efcba1bc-e445-4719-8619-09026ca65ff9", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:38", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac2f08c5-1cf7-46af-a02a-a86afb42fdfd", "3fff6d55-ec0b-4207-8751-1913f684c88c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "acb795a0-e328-4318-9c60-ad09119cefab", "1e2ffe77-cc22-48c6-ad3b-0fdf6be975af", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "aceb3620-23bb-4868-ad6f-08f93a4e8a89", "617e4889-569d-404a-95a9-c2f47a6a18e5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae0b6415-be09-4011-8bad-fc8415b215d2", "64891a65-c53f-4acb-a506-5a6f28bf3b0d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae8c0ecb-f76f-4342-b3af-9ba899e96bfc", "b74a700d-fe01-4f9f-86be-390c00c8ff27", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:47:12", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "af1c4747-3dea-4c25-a4c3-1c43b53fd318", "8480b36e-40d8-472c-ac3b-2ea46dee1bbf", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "af3f60f2-0682-4020-b566-f1705a99271c", "e74937a6-931e-410a-a4cc-734635d32b4c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "afb5471f-6f0f-48fe-8aed-b62ce20efdcd", "2bf3ba9a-d91e-4003-9b01-cbca1f770717", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b09ee0ac-d392-4b52-aa2d-c36227f40649", "4b0ccb27-d0e4-4e34-8754-b8438be3e453", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b0c119a7-0b8c-4092-a332-c86b386d6e06", "3153e86e-8a31-4bb6-8d87-a4cc007a9389", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 12:05:31", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b19ffd85-6007-490d-b912-98cbd719871e", "dd9c74bb-b963-4acf-b843-482c82315982", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b22086f3-5f55-468b-a156-1cf37c6afb8c", "310e6855-8666-422b-bbed-47f8984a679f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b265087f-70d1-4a82-9cbe-0e6c3bf51384", "6c7b6d65-c57b-4087-a2ff-21e76ea11533", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b2ee9564-7d22-44a0-bb85-4c64a415d91c", "c32dda52-5b62-41c5-a8cb-dcc70bc191e7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b3083816-ff4b-433b-8772-1cb874521d53", "493de452-0453-4eca-aa95-c6bde0182969", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b32c957b-c788-441e-b3d1-a8163ec657e3", "a1485389-97f4-440a-8411-9215c997ef66", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b37ca9d3-d477-4a22-8a4d-f92f4a6916f6", "413dd6da-da7e-4d13-bf6a-77b57fa4b274", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b4521173-7251-4ca4-9090-d4cd683591d1", "c0658782-dfc7-4827-aa86-725b546508a5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b47572d2-6eb8-4e0c-8f5f-0b7221e7e3db", "eeb8b025-d5b9-4856-aef7-64a6591ebe15", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b53ff4ef-fa51-4a16-928e-560f2e8f4349", "93c5db6d-b9c5-4273-9822-57e56174b573", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b58293b2-fcdd-4faf-9f65-7efce45ce761", "53ab62e0-9d65-4ade-b956-9209a7d0605d", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:52:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b5e55464-f268-4a69-a55c-0343f1572146", "55701629-338e-4036-99fa-27199b1578ee", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15 10:18:29", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b60071fb-5c8e-4a5b-8be5-f1ce31a19ac3", "b8f703fa-a95f-493e-aadb-3cf1a440dae6", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-07 11:12:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b6dbf36c-3128-4639-9e41-e115bb9ea170", "43d9e23f-e345-4526-8dbf-820820f78fd7", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20 17:05:20", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b73f9e76-75ab-4ed5-8484-2bff9230a050", "a52391e6-5b06-48d0-b019-65c12483ebef", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b8b32875-6747-4865-89b3-cfb0dc01485d", "598e4cd9-5cfd-4f98-af00-4c88ccc349c2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b8ea70b3-fcc7-494b-b5d8-f31a74d0b549", "37365abd-1630-475f-b296-8daab2640c4a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b969c202-934f-442d-a70f-ca7806af7543", "9a0aba4e-cfe4-4aa3-bee8-907b857be69f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b9bee785-cc6b-4568-8bd6-d698728584ad", "00b66cf1-2b63-4e57-8a49-7bd639811f73", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ba2bc81e-13f2-40f3-9ae2-bd0d8cc42757", "5f2976eb-85cf-4817-b448-8676576c8f68", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ba6003e9-8293-453c-93f9-96981482c155", "c4777b18-6d9b-4411-b978-4d522ee127e1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ba78f77a-44a8-49a5-a54b-52948eee0fae", "2b009635-4c1a-4969-acef-183945b1b218", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb2b8ff8-04bf-4f4f-bd65-fe0ea2a80295", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "e36aed14-9eed-4435-ad86-9df696e90057", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 11:52:37", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bba5332b-8b59-419d-ba03-3e198d07ef5e", "b07dd30d-99de-4fb5-84ac-0a2d05daa46b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bbc610d2-2cc7-4e5c-b924-d8b782fe0277", "43ba5f32-20c2-42b5-86cd-3988a445e121", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bbdae428-b7df-4e6b-b5b1-0506f7fe4372", "5ffc0f19-6937-4e05-abb1-d5081b859314", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bc3a2ae5-b60d-4ecd-93a3-f7e129d56a35", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25 13:00:22", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bd4f72cb-5245-4947-865f-de7e22c6c58b", "7260f2aa-e1e0-4ebe-b547-e816a282950c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bddcb138-93c4-479e-a93a-6f08c38b0ead", "39116d33-6c28-49d4-8c52-34cf398e1378", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06 14:35:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "be02727c-78df-4247-a49a-d352e2dc0a99", "5d1d09e7-c9e3-4b9f-b137-f68f172007c0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "be173532-80be-459b-bbce-837ba8097837", "5ef2c9c5-b13f-4a84-974f-d0d6e92314f0", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27 11:29:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "be4cd515-85a0-4bd4-a087-64c674df3ecc", "d99179ed-ec69-44c9-b2f0-c72dc76e2a53", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-13 14:04:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-13");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "be5470c1-1c55-42b5-b7af-294ef44fb40c", "697f662f-8607-4a88-b7bb-82313244e6bf", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "be6e3ed1-5239-472d-915d-711f0915a5b3", "fabf7efa-5046-457f-a7b6-460b8317f926", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "beb5ba1b-23b6-4155-95e8-0262c49e583a", "f3ae93c6-ff11-4329-909b-45b4a8bf3483", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "beda073e-d306-4a35-8aa8-49504ca87655", "5f450877-9b9b-47d4-a162-7290d76e081e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf17b007-0056-485e-ba64-7a7e9bd6d7c0", "3e3db0dc-ac42-461f-be77-a561b1821e59", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf54550f-4eb4-4538-8d19-fbea4150f52f", "ac629eab-aac2-431f-b999-bad3c7002ff6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf71968f-bbe9-4f6d-bddc-63d0b864aed9", "a1d4e007-fa78-4e60-9da0-f8d04732cce2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf9ab713-8bb0-44b2-b6ac-0d4cfa084c7e", "f54d1177-e8c1-4cd1-b9d7-29a7e25a98a2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bfc10710-8a44-4890-aa90-28ea93d0051e", "993a7c39-3cd1-4ff0-9821-ac23ee0f032e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bfc5d643-c8a0-4878-bdce-e9e4d6369028", "53ab62e0-9d65-4ade-b956-9209a7d0605d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bff83667-e806-43d0-bd2b-4bec48b5db47", "7613ff55-558e-469d-8b22-d6402adf5fcc", "f7f8d89c-be4c-424e-a292-78529889491b", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:28:15", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c020cfb3-8ab4-4a9b-8538-51bf70b301bf", "2de14354-d094-40ea-bb75-38ebd1a061cd", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30 12:29:39", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c0308e8b-655f-42d5-8b22-bc8093ede7e9", "1ae9811d-9db9-4b3c-b1f7-ab2e38a36292", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20 11:42:19", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c05cb35a-ec9f-458b-abaf-0ed4b359c382", "44d04be4-e9a3-4af5-b728-f0f0cc95bdf7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c064aa3e-93b8-459e-aff3-26a1d4b08833", "0b9eca6b-df6c-4731-8d4b-789cea5b8888", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c0711cca-0222-454f-921e-99333d67eefd", "3a4d1307-dacd-4f49-8c7d-244bc4caad8a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c08df08d-bd92-480e-9024-6aa67cc7b9e8", "9ca9c9ef-42db-4042-9fbc-1d4ba1efda5b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-20 15:28:25", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1029f0b-d032-41c3-9ffc-de14bd64844b", "6d645a0c-9763-4fe9-832a-f6b99350986c", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:01:39", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1c712b2-b3df-4dd8-b4b9-d31da6957c05", "b7925d7a-31a9-4547-ad72-1822faf53bd3", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:49:04", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c25a26b7-5121-4b41-b5ec-a4fb944c4543", "6d645a0c-9763-4fe9-832a-f6b99350986c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c269219f-1429-41b0-9d3e-66674b1e8f6a", "b74a700d-fe01-4f9f-86be-390c00c8ff27", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09 15:36:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c2d030bf-aec4-4835-94d4-9dbb2e2beac6", "ca9bb28d-a178-41ae-a774-cdb2f815a52a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c42fcca6-0430-43c1-ae20-859e5728b25d", "5f2976eb-85cf-4817-b448-8676576c8f68", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01 06:30:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-10-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c4752c7b-846d-4535-86c8-4a2e034ab3ec", "b0396de5-2904-4383-8fe0-6fafaea560de", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c5d8b56a-15ec-4062-b0c3-d0c1f22dfcda", "854ebcc6-5e43-4292-9b25-b08075abe437", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c60be784-655c-460b-a4f3-844363ddaa3a", "2dc2f922-f5d9-4136-9c4a-6bdf5c6b56c5", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 12:05:43", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c6285659-6807-4ba5-828c-d72e0e39bf75", "399129a9-6762-4b4a-900b-1e54f9369c0e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c6580a5a-919c-4a4c-82f7-d8c5535e9107", "e121aec8-f1d3-4933-a274-f86833e8bf24", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c6729ee5-4cce-4ec1-b44d-ae67dde6f80d", "bb0df4e7-0005-445b-a0a4-17150a4f2e83", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c7946843-460b-4a36-929a-cfc627492761", "6d645a0c-9763-4fe9-832a-f6b99350986c", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-10 14:48:13", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c8331e49-083c-438e-a17c-39f2817039d1", "329928c7-035e-4520-8738-da02c38ffb97", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c8615b24-c07e-4fb4-9a5a-0309944814c8", "e5863223-c506-4100-b58b-9a5ab31851bd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c888b1b1-8a8c-493c-9c9d-eb8b5b1c3018", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25 13:00:18", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c8a44cd1-d0ba-4bd8-976c-39632dcac455", "39116d33-6c28-49d4-8c52-34cf398e1378", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-07 11:13:10", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c8ca5e2c-c69c-45f5-86c8-ada1d9116f5b", "107f16b8-f502-4b26-836e-62b5d6be5e83", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c97eccfa-cc80-4d08-b7d0-a23e17472bcd", "29e54e94-8122-4f3a-ac6c-8517e02d6b9d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c9d2e222-258a-456c-a80e-c43cc5cff307", "762cb092-2625-4471-8d1a-699681018dec", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15 14:05:49", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca3a37b3-35c3-48d2-8704-f8bbc5cdcd9d", "bb0df4e7-0005-445b-a0a4-17150a4f2e83", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-08 11:35:27", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-08");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca640895-7313-482c-98c0-79b023ae300d", "6d0a53f3-46db-45a1-8626-8123eca4ecb9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb1167df-cab3-45dd-8ca9-aec857583813", "6c34c2ba-909a-47cd-ac64-cd58e4c15664", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cc2885b8-f469-4660-9045-e652e156cf7c", "19b35207-4ffc-403a-9225-2c38c1d4a0d2", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd1317b1-cb9c-4471-a927-e614eec85f54", "c6a6ecad-1082-497b-ad22-1c5508721ecd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd68bd82-5aa9-4e2f-aab1-1efb2b6c8134", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25 13:00:16", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cdb9322f-3351-484c-a6a7-81d591bc0042", "13d1c753-c7db-4104-ac98-0d261e56f972", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ce75f2fe-eaa8-4e8e-b1b0-2656b0012db6", "d4d16eb2-f9aa-4740-b3f8-dbb2e4eb0409", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ce764537-1863-41bb-81f8-c65f78bcad80", "4c587471-fad5-42a6-a912-b925c1c5fb8b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ce8b73eb-9673-4b49-84d5-42e3f30acec4", "967132be-50b6-49cf-8dc8-95ce48250d2d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-29 14:54:15", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-29");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cf594572-7693-432c-851b-f7803c527701", "e712e160-fb48-492c-a981-dd3fe61e460d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d083a2f4-88ce-4b32-82cf-3320aeb1e00a", "064e8a5a-42b6-4e8e-be98-5452e63fda4c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d0d5f472-191a-440b-bede-9ec27fb644bd", "2902da1c-5402-4b75-bd20-727802eb5b70", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d0dad70f-0171-4c7b-9dfa-f14b5d011f78", "c01c633d-d890-447a-8382-c59e2752089a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d0f7a7cb-d8f5-4233-bb0a-b6874348ab17", "1ae9811d-9db9-4b3c-b1f7-ab2e38a36292", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20 11:42:26", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d0ff7974-a71f-4472-aa6c-2d4755f55dde", "ee491fe5-0ab6-431c-a40a-eab9902a12c5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d1ce8220-cfc0-494a-82cd-bef0347db37f", "9d7d17b6-ac9c-413c-bc26-19b1a42c4688", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d23ef513-273a-4b1c-91d1-3922ffe2f6da", "60812c0e-6337-4939-a137-743f8541e538", "20692618-6042-40e6-b6b4-df381bb99c52", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:56:02", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d26729c2-c470-43ce-8ebf-72b92c168f70", "3ce97ae3-7d62-4488-9ce6-c56b336243f4", "20692618-6042-40e6-b6b4-df381bb99c52", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:53:48", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d2ea14c7-dd97-4010-b21b-0ec10036fa7b", "21e906f1-743d-4590-a60f-a7f35988fe58", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d38eb7c0-f99c-42da-bed6-447420227f61", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d3ded53a-2d05-407f-96cf-f06e20ac97ac", "6d645a0c-9763-4fe9-832a-f6b99350986c", "f7f8d89c-be4c-424e-a292-78529889491b", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-21 09:57:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d40144cd-fe0a-4c06-a212-ab66144fbd37", "5f5277cb-f221-4cfb-83dc-c7dd6493da58", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d4d36c1b-dc91-44a2-a008-127f1a1a1f9a", "9a40d733-cdd6-4cef-9cb7-3b897add782d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-24 13:53:19", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d4f6d83c-d1a7-49ab-9639-5b35037e13de", "5a3a0c24-542c-43a6-8a61-bc1e39de4ed6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-06 15:07:18", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d514641d-3fe5-4a66-98e5-f7225e54cc1e", "d7cec0ac-dab0-4299-8fdb-d47843a0e460", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d56243ae-aed1-466d-bb8d-c758ce3d2616", "a9db481b-65bc-4060-8134-e50ea375f1af", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d574b1cd-c7bd-45ce-be55-0eda2ec01e5b", "60812c0e-6337-4939-a137-743f8541e538", "116b3436-bce6-487e-817d-ec9e793e41ba", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:49:03", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d5e55bac-841e-4042-b23f-ae12cee92480", "48333423-cef9-41d4-a6a9-4d3ae7506857", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d674fb3a-e30e-42ab-849d-cf836dea7e44", "5a8b273b-5cee-4705-8193-ca64e323607b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d7075cc7-bc11-4184-8db9-ab45f9ae7161", "d8bc8365-9274-48c8-944c-5bdc1988f7ad", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d70d71dd-92ea-4492-a797-d66b66706a83", "58fd32a8-ba60-4e73-b78e-26c90587d12d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d711a72d-4a03-4f6a-ad33-3b1d0dc8433c", "de3e9f04-317e-4a09-8d7b-03c1686b60a8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8037ba5-519c-469b-96c0-a688f1468802", "ee09f8ac-8bad-438e-9009-3c27c3026175", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8717557-5947-4981-beef-fb697dd88f95", "3fedfa37-bf45-441c-b9be-fb2670260a9c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8bda813-8ae3-49e3-98fe-500f6964052c", "110a83a0-f9d8-4f63-9903-3d7b3c2838cc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8c2dd98-afc6-44aa-988b-c9129f87c5f7", "b8f703fa-a95f-493e-aadb-3cf1a440dae6", "64502c81-163a-4ded-a7c9-3136024d26d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:42", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8cb9346-1fef-43cf-af05-c545e05014a2", "b4f44163-73a8-48d2-89f2-0c50ea071f21", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d945be1e-5a7f-4c89-8a7b-1f00f424d6fe", "adc8ffdb-8073-4f5e-a797-8e4f5eadd933", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d977b1da-fe28-4624-a4d6-5aff6c2266c7", "05be2d4b-bf12-4f59-a130-9c8f877d655e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d9a353b5-9fb4-4cc1-9c42-24ebdfe8f377", "6ca14165-31af-46f2-898c-3fc049aec967", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26 10:23:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d9cd16ad-aed5-4a75-93e5-31cc234ad8c1", "39116d33-6c28-49d4-8c52-34cf398e1378", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06 14:59:49", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-06");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dbb938be-015b-4d55-97f8-c7a26bc4d0d2", "da9456fa-5991-48cb-b4b1-b5762a2bd217", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dbec3a3f-df49-4006-8920-5c487c0885a6", "608df6fa-e28c-4233-bc24-ee8d7f342f80", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc1303f1-cfaa-466b-b800-06c9821a26cd", "82f30d7a-d4a8-497e-a97f-9cced287b63d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc6a3b9e-31b3-4c3f-98cc-24fcbb9be19d", "1916acc1-a0fd-45cb-b791-7c27608e9b5b", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:36:27", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc771ae2-39c4-43f2-8f3f-8adcedd77498", "209f96a2-1a7b-44aa-a138-8cfa206e5631", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09 15:35:41", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dcddc21d-873f-4d48-beed-db011a8a1ce4", "2dc2f922-f5d9-4136-9c4a-6bdf5c6b56c5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ddab6c89-6554-417d-8a46-5b848d53b415", "6894a095-bdf4-4f18-98a3-48fc53d53360", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ddf7a2a6-0b8d-461d-9e27-9dbd5766ae72", "c9b40792-2862-431f-bc1e-3f1e5597a8d5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "de6f9ad9-5015-4507-9ebb-21c343436b39", "34c8e6fb-a720-4e15-96c2-ab539b728e01", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ded969f2-e1c1-4b18-a09f-e2d9985fe074", "b84503c8-8dab-4a3f-b64f-90f88592b17d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df2cd8a8-8d55-4389-8dbe-8ff631a13c63", "e4720aee-7255-42f6-8ebe-f1e19c42104c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df37315f-0d5d-4878-a855-95d80cda1345", "b5a18065-54a1-4d6a-82bd-dcb82df5d16e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-12 12:56:18", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-12");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df492cd2-72cc-4ed1-952a-82fe91364f06", "2c1fd553-e64e-44df-9bd7-881c7b5dacfe", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df76a832-9ce5-44e0-a5ec-e5764d94518f", "bc96795c-0400-4ded-9bab-365641069021", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df7ee90b-778d-4d1c-8274-52bfbbd24a2a", "3c54742c-d685-47fe-a0dd-2e7c6fc14c7d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dfbc5349-3e03-4951-b470-2124a8e56dd8", "ae6ed63e-fd30-46da-8303-8005453e8a8d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dfd782ba-84af-4bf2-ac89-02de9eb673c3", "ad11e62d-6d2b-4bc7-9208-1d415fe1688a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e0803682-6ed3-400d-99ec-47fae6a6354d", "1ae9811d-9db9-4b3c-b1f7-ab2e38a36292", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e0891aa5-a247-4284-a9b5-a1f4ca4caf7f", "1cd48d56-9660-473a-b880-77258319ffec", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e130082d-5a06-490a-b9e2-d4560a8b7c47", "ec75b073-15ec-4bb6-bae1-183522333fba", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e15b4d06-c19a-408b-acfa-6ca263254b63", "17e92cd3-fb9a-4083-b95f-450e3efbefe0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e16b9268-78ee-4bb5-889f-688d72020fca", "371680d8-a4c0-40c7-ae7c-dcdb1990fda1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e192bbf1-1fb4-4cb3-8bbc-3f86d9caef5f", "af27a740-d133-44e4-894d-c4877aae5a05", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:48:40", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e19ba4dc-9450-4046-930c-784774011a8b", "d997d839-9c90-4e4e-9c22-b598baccf33f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e39b0448-24fd-4527-83c4-c48a499c2e30", "fc10a214-30bd-4748-8c2b-9ecf31b444ef", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e3f16695-1f7c-46cc-80db-957bb350bc61", "401d006f-c4de-48ed-a472-64cc5d112622", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09 11:27:51", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e420285e-27ad-4411-b367-f4fed5e797f9", "9dd77062-fe73-426e-a986-fe07c92b6f93", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e42ebac4-f01c-4215-870e-f6e8dd0f29c1", "2de14354-d094-40ea-bb75-38ebd1a061cd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e446b741-40db-43ce-b4ec-63cd118d2120", "5a6bdf41-3cb0-4af0-bd2d-1dfe96bada41", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e485b3c9-44b2-478d-95d9-28468b77a564", "137da19d-3c8a-4e0c-864c-78adab3f000e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-18 13:37:23", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-18");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e4ed78e5-4c43-4f2f-b2c7-48b21457260f", "1916acc1-a0fd-45cb-b791-7c27608e9b5b", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:38:04", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e51e6e93-4315-4b45-8edd-58d5efa81ea3", "a4c8813c-e1f6-443c-b33f-b2fabf9c3b99", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 20:33:28", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e58daa09-89f7-4b01-b7e1-42649e50f763", "28998d1d-b5b3-4592-b317-1aa323814aba", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e6336a69-4ead-4d8f-a3f8-50505fd60a3b", "164c8d6e-37e8-4cbb-a4c8-082249297fa6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e6909985-5ef8-4361-b839-99aeb36c67b6", "84e1849a-6908-48d5-aa9a-ea709642cab9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e6b13976-2c57-4f56-809e-a17b1ca5f51f", "b51510e6-7136-4a07-8be2-9a1bcef420a0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e7b82f18-a33b-4906-9707-43bd8b40b482", "0e12552e-40b7-41e9-9742-c2c6fd93a04f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e7ea993e-0117-4f46-8ffa-fca630cb2fb9", "6ca14165-31af-46f2-898c-3fc049aec967", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:31:27", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-24");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e80dacb2-4f61-434d-9aa0-d6ed10ddc850", "8af810b4-570d-4a02-8c46-535835eb2b36", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e85172f9-3193-4767-8653-24a1a49a471c", "283bba05-251e-477b-8202-f1fb2d389ff4", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18 13:52:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-18");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e91a75be-bbda-41f1-a25f-111708fc9f5c", "eef2ae5d-fa13-417d-8e1d-a257bc1a9fb3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e96bc0c7-b461-47b2-96a1-ff91799c3991", "7c76b7a9-8a32-427d-b94e-70bd91d908c8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eaee7a55-d4c9-4095-ab3d-40b37f592e18", "44e83e55-7a38-4078-a415-08b42be0123c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eafc8092-a58b-4a87-837b-95533d15fb2b", "2bbee167-9b5b-404a-951b-800cba36f1f3", "20692618-6042-40e6-b6b4-df381bb99c52", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-20 08:49:09", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eb215b10-9705-4a16-8811-4398c05bc3d5", "046a0ae2-be6b-4d01-a340-3c091952a041", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec63be41-95ee-4659-921d-6436c4270301", "e9b9bc9d-01e6-45a6-ba65-170f6863183e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2024-09-26 10:48:52", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec6417c0-c861-4848-baf5-f441bd63843b", "518e75a4-e99f-4966-9588-69a450ee8557", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec978ce2-1e86-434c-b4d5-7fa28f43ee5c", "c46897a7-206c-4a83-8797-9ae76198a482", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ecd1c53c-c835-4087-8a2e-169f02415d94", "55b16625-efca-4093-8df0-20fc838f21b1", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:22:37", "", "2024-07-13");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ed35151d-87be-4be4-a75c-fc58e5d51ce0", "4ad61ed1-58bd-4f81-bfd2-adf66a9d5397", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ed7a09c4-71d0-4f64-8033-08d80599354b", "3e818f20-b38e-44c2-8d1a-6832a026f6f1", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09 10:43:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee087588-a783-49b3-b36b-b81fa1cb84f8", "0f5f90a8-1d70-460e-af6b-89964655ad56", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eea23eaf-5eee-4bc0-8231-7ca6e2284115", "d8a3716a-239d-4b2e-9835-9ee38a174019", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eeb07de3-4511-4779-9d87-764460f9d759", "55374012-c28b-420e-9c2f-caaccfddafd8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eee07a88-33b5-439b-9b94-3c8ef4af62d9", "0fdf0dc6-bcbc-4ef8-814b-02b127b690d8", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:45:55", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ef6039c0-605a-4974-a211-80e5cd86ff1d", "138875b2-2627-4bfd-aed5-8c72510d1f1d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05 14:06:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-05");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ef7af322-194f-4c61-a27f-9d3b065c46de", "17a31de8-6041-4054-a510-d311ee456147", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f0727846-b6e3-482f-819e-dfb81bbb891b", "2c0629fc-bf08-4f60-b2d6-8cce42e54e07", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2024-09-30 17:05:27", "6ca14165-31af-46f2-898c-3fc049aec967", "2024-09-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f08198d2-259f-4bbc-962e-45d47c0998b7", "44be50fb-2c56-46e8-a03c-999e44739811", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15 10:18:51", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-15");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f0b36fd7-112e-448f-90bc-d6f59faeb573", "2bbee167-9b5b-404a-951b-800cba36f1f3", "c70cdcda-900f-4494-a44e-dd91e351938f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08 13:46:19", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f17fa926-d3ec-4833-9605-80ec2322e248", "ca497a41-e4ee-497a-9e36-9d33a56e0232", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f1a59f16-c6fd-4786-b343-f78b3680bdd6", "6ca14165-31af-46f2-898c-3fc049aec967", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26 10:23:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f25a96e3-3784-4554-bd03-fc8beba0dd65", "3c169618-5361-41d0-9940-1364ad4800db", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:47:42", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2bb5907-8aec-40b2-82fe-a8ee99e9d018", "eeb8b025-d5b9-4856-aef7-64a6591ebe15", "dd10064c-5e93-4914-b41c-25ca8c974e98", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:01:21", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-28");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2e825ea-6e17-416c-ba16-50701ee7609f", "fb60592e-dcad-4d67-af36-7d661faf1f41", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f330b749-71d0-4ab1-85aa-42fb37f6842e", "9a2a80f8-ef74-4fe3-9e8f-246942852c33", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f3542fc8-3b7c-4087-beb5-ae707dfc8004", "ed1ee4b3-eaab-4962-8ac7-a1d9d911956c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f3737f47-9a66-400f-b8df-b1ed10f84a5b", "9754bf8a-be8f-4f02-9eb8-3f2ebd3585bc", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25 09:40:05", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f3c30362-9d25-462a-995c-7a069ee819ba", "55b16625-efca-4093-8df0-20fc838f21b1", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-26 22:19:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f3f98a16-87b7-481f-bfd0-4eb2c86c5aec", "1f391ea1-80d2-465f-8c52-014f50416b2e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f41de248-ed12-4023-a30f-a5e91e05dfd7", "85d671f0-bede-45bd-9906-cbdd867b7206", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4395e6c-6956-4129-bb91-48db2aad1f02", "ca98aee8-a51f-489d-b95b-7d8a44968957", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4afb51d-d971-40b6-afa6-d20792b07300", "a00bd45f-65d2-4336-8423-bd17460c84ab", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4d5d069-7255-4576-9426-32bbacb4dd4c", "2bbee167-9b5b-404a-951b-800cba36f1f3", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-20 08:49:05", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4e6c42a-571d-4da9-9f21-7da17c4b85d8", "d3370dbe-eb57-4bea-8803-28d6f5f77cf1", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-03-21 13:19:18", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-03-21");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f509eb15-8775-4170-b145-3ed7eafca378", "3c169618-5361-41d0-9940-1364ad4800db", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-30 11:57:28", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5209457-6ff6-4faf-9481-69a678bcf0ed", "9e5b7403-4b0d-41d9-9375-48db2d224feb", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f532535b-534b-4a6d-8c2d-58992f303e74", "fd46218e-c05c-4b4b-afc9-bba8aedfd900", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f583c50f-af1f-4c36-93c0-03377100de31", "f203bca2-848d-42fb-a5cf-f0f2af67d005", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-09 13:35:57", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-09");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5a7639a-b6dc-45c3-aa1d-ca78f0ae2177", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25 13:00:04", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-09-25");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5dfda68-d0c3-4d3c-8020-444122815c27", "6d645a0c-9763-4fe9-832a-f6b99350986c", "116b3436-bce6-487e-817d-ec9e793e41ba", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:48:02", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5e229de-f32a-4db2-9699-24f60a0f15c4", "8798cb08-f2bc-4b89-a7fd-c352fc6fb8bf", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04 15:55:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f60be87e-afa2-443d-8a9f-5a219eac7ce4", "e4d3cd05-bf04-4f22-b03f-5036b5a82d7e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f637c07c-b808-4949-9982-d0175a5669ed", "63afe15b-b35b-4960-b8bb-c93d62bc7793", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f6942dc4-a4c7-40e3-b0e9-379109531172", "1916acc1-a0fd-45cb-b791-7c27608e9b5b", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-21 09:44:40", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-21");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f6f72efe-2e61-4cca-ae13-b8e249067640", "b730ccc4-b37d-48fb-ac55-7ea8935e196d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f6f9d6c0-af04-4a3c-a4dc-e1c4149d11ac", "504a9cb6-618f-4f9d-8c47-7cf7ca5f5e74", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f75620e9-41ff-49ee-b979-5e69fc769699", "5ef2c9c5-b13f-4a84-974f-d0d6e92314f0", "20692618-6042-40e6-b6b4-df381bb99c52", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:54:03", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17");
INSERT INTO `dt01_gen_role_access` VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "f78c6ab9-daa5-4529-907c-1d58d096c8eb", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "77738726-a358-414d-8043-1b3defa6d1d0", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f7b50ed1-6be4-4fcb-95b4-315ce0a59a09", "b766efeb-23aa-41e1-b028-da57b273f6f9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f81f4a81-7801-4645-8d45-a4bd6829f952", "f2589a63-5c60-431c-8494-32489a2fa4a1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8317095-48f6-4087-ac0c-59418adcdf14", "4638b39a-c303-44c3-af0e-a2628cb7415f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f89f9446-5a61-4a5e-8a5b-e8a2253ae7d2", "2bbee167-9b5b-404a-951b-800cba36f1f3", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23 14:49:29", "5f2976eb-85cf-4817-b448-8676576c8f68", "2024-12-23");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8bfb319-0bfe-4e82-8647-85df1ff2d3ca", "ff61977c-e2cd-4079-8e12-db796e6574ff", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f96f2a0b-e870-4248-af0e-523a76e5539a", "26756a21-c1b9-4134-a0ee-23d80848b03d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f9a39c80-a7b9-4e6c-8d63-8474c0e262fd", "43d9e23f-e345-4526-8dbf-820820f78fd7", "af82114a-23e2-4d2f-b787-0a693fd76d54", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20 17:05:31", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-20");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f9da40ee-3199-49e0-8149-c2397d455d30", "6d645a0c-9763-4fe9-832a-f6b99350986c", "20692618-6042-40e6-b6b4-df381bb99c52", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:55:32", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f9eaa880-58ac-4f6f-97a6-c5bc0998bc1a", "5e8abe2c-d030-47cc-b69e-c4ab64e0fb98", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f9f69758-e9b9-4b1b-94b5-dd81549a8fc5", "14acc9d8-1d3e-42fc-ab95-8a8ab1aca894", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-26 22:27:47", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-26");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fa2d38f2-89e7-489f-a057-baaa8070bfe7", "bba83dc3-d150-4cf4-bf61-851396a89305", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fa6e10a3-17a2-401c-915e-f10d06a901f7", "3153e86e-8a31-4bb6-8d87-a4cc007a9389", "dd10064c-5e93-4914-b41c-25ca8c974e98", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-21 09:44:53", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-04-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "faa74493-d2a5-4451-9d0f-e7ac21e5213d", "86ffb00f-e510-4463-9db9-01dc589ac6ea", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fab37ca3-f805-470b-a4ca-b5780069323e", "42cd3dc0-f79e-4439-a9ce-280e1e96aac3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb322256-7c53-42af-91b6-a58c22aa268a", "e3507a93-20ff-4ce6-850e-83f94a0151c1", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb98e35c-a274-4094-9a39-cb69a9d22b0e", "ad6477c1-af33-46a2-8e51-306b452e4f14", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fc8d03ff-bf39-47bb-8fd9-76bb8eded5b6", "cbc33035-c0e2-4898-8c05-46bed286d11b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fc8d1c99-71bc-4d5e-858b-4f1bb29e2f39", "6d645a0c-9763-4fe9-832a-f6b99350986c", "64502c81-163a-4ded-a7c9-3136024d26d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-27 11:42:48", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-01");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fc9e570c-c56a-4cfa-a0f4-790c721160ae", "a8fefdda-53aa-4ed7-a0c1-b72c446871d3", "79dd5083-f76f-41e5-8c60-bb1a318f229b", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:16:24", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fca810f2-4019-4521-9dd7-520bde3914d0", "897c3827-8859-4ba1-992b-3935090842d5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-12 15:17:48", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-12");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fd178792-09e6-44a8-901f-01dd51fcd296", "4565a85a-a4af-4cae-b27b-65115ab5e4d4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fd49b1ce-2d0b-429f-b246-86cb33369a7c", "6b6a2ab0-e25d-4eb3-8581-879c9faedee7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fe682203-ccbe-40aa-a58d-35ae3cf35c3a", "69bd72ec-c5ac-4c79-95ff-705c7054cce3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ff8541e5-0646-4b1f-9980-1be6aa425a1b", "450ab571-ec25-4410-857a-c7ea1ffd59b3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04 15:55:22", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-12-04");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ff9f4f7a-cc90-4185-a9eb-eee2e02485fe", "01efa257-7112-4666-aea1-b36becb4fb20", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ffa0edaf-c00a-404d-b8b8-75ba29f91e3c", "4f70e8c2-d898-432b-9eee-9b8e9cf5f142", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");
INSERT INTO `dt01_gen_role_access` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ffa7a872-9332-4c38-9419-a13d5585e853", "366657f6-3fd4-4c31-b349-e57cacfb9b74", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1", "", "2024-07-30 11:47:53", "", "2024-07-30");


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0029ec33-e60c-4002-82e0-530b63016c27", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "002f4be8-5c6a-417a-9862-c4112c06c0e0", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "266bd8f2-8e09-404b-985e-0196c14218fa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "006a6349-2bab-4ffd-a386-9fba8b8248f2", "6a954648-6b0b-4db0-88f2-7446218b85f5", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 13:33:00", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "00d818a5-53e2-447c-8710-d4c78b69c302", "77efc382-0004-4d48-9605-9ab954aaca94", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01287ad5-b3d3-4735-90e1-d7bfefec4217", "e36aed14-9eed-4435-ad86-9df696e90057", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01499b8b-243d-455d-a54a-ae9a82b3db9e", "e36aed14-9eed-4435-ad86-9df696e90057", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "015a8377-6c52-4160-b88a-1fde8a97f06e", "64502c81-163a-4ded-a7c9-3136024d26d8", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01684393-b48c-4c3f-ae57-be04d192144b", "0aa69419-0083-4a58-8557-3781a4944b05", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0182cb9e-f9d3-4dd0-b299-c0069a351c20", "6a954648-6b0b-4db0-88f2-7446218b85f5", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01a81d94-0130-4a49-ba15-ec79efdf0bc9", "dd10064c-5e93-4914-b41c-25ca8c974e98", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01c57db4-8d4e-4b03-b05f-07db19bfebf3", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01d482e6-1b20-4c00-b33a-bf5610acd444", "e36aed14-9eed-4435-ad86-9df696e90057", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "01e57543-9716-40c8-bfda-b4958a5ebec8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0220db1d-0183-4b72-9bba-962c58257b7f", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "025e0311-5831-44d8-9731-b15c7d71aa8e", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "026f9d98-d93b-4fca-a781-2f3eff591e65", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02dab332-b2c8-43d7-8589-ccaaa82400ce", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:52");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "02ddc524-e9fb-4e28-b3e0-1e965609fe15", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "03034918-3268-4773-bbdc-956730cf33a7", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "03084e5d-2989-4876-8355-31a3a1088909", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "035dba8c-8b85-4a17-89f8-5443fbc23590", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "03714d22-1583-4e5c-8105-d0d7b760d924", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "4610c39b-de32-450b-812d-db8c37fcc643", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "03dc0497-a3a3-4288-b7c8-491e32acf938", "64502c81-163a-4ded-a7c9-3136024d26d8", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "041032cb-7871-4a8d-90e5-d9ccef1fb490", "dd10064c-5e93-4914-b41c-25ca8c974e98", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "042d5f49-5bff-49da-a2d2-621424849349", "6a954648-6b0b-4db0-88f2-7446218b85f5", "039076f7-393b-4079-b65e-08a8eb673970", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-04 16:15:13", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "04a05690-8069-4744-9652-2bc810ab5e67", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0501fce3-d0b6-414e-baad-3676736daabf", "6a954648-6b0b-4db0-88f2-7446218b85f5", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0611c24b-b004-414a-9e28-5f41fcb4d8a2", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06222353-23f4-4571-b0aa-850e44259793", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06a5c0cc-9fda-43ce-bfc5-5a8ef3d4f9ab", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06e023c5-e486-41c2-ac7b-45735528a4e6", "e36aed14-9eed-4435-ad86-9df696e90057", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06e8bae5-b16a-459f-b8c5-9e49950faca0", "0aa69419-0083-4a58-8557-3781a4944b05", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "06ed7617-9e5e-4035-9765-526f2cf5a144", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "07697a30-4de8-411e-9f99-c9bb0fffdcc1", "e36aed14-9eed-4435-ad86-9df696e90057", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "078ec3f5-f58f-446d-bd96-4e59647e57ad", "77efc382-0004-4d48-9605-9ab954aaca94", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "07a2ff5c-0131-4206-8f2b-88b94d8bc470", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0817608d-077b-4cae-a7c2-f4307e021bfe", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "08182c54-a294-4bc6-a93f-7c9367d104b7", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "081e8df6-7619-4575-bb4c-cb24a725cc63", "7a9f1131-3120-4b11-8117-09a860500b46", "7111d133-d00a-4eda-8094-8bcceb227664", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:50:05", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:50:05");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "08bbb927-a8ab-4d0d-a216-3d9a399ab6db", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0974ee9b-896d-480f-a968-a429f9580078", "dd10064c-5e93-4914-b41c-25ca8c974e98", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0a150278-d4d6-47b7-ab61-e75daeec8d3e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0a80cadc-3cf9-413e-afad-05bee9047980", "116b3436-bce6-487e-817d-ec9e793e41ba", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:54:57", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:54:57");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0aaa3c1f-7b2b-4409-8fe3-106d60850134", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "123f022c-72ae-401b-9144-624dad3a906a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0ac36416-9152-4d46-a0b8-168d554f8822", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0ad5ec46-4d00-4fe9-83ff-fa25419f2132", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0af51a9b-ab6a-477a-9f6d-c395c4c7bda1", "77efc382-0004-4d48-9605-9ab954aaca94", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0afdef1b-5b94-47b0-80b2-58fa82a6aa08", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:48");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0b5c1317-5d0f-458a-b5fa-3b02a0be2b9f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0b7e657b-97e2-44f1-be6e-5769e218cc97", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0baf07f8-37ba-4e50-9854-4297a47935a1", "64502c81-163a-4ded-a7c9-3136024d26d8", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0c0c20c0-ba51-4144-b61a-25a2c2fe7710", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:52");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0c2f15ef-1de7-4d19-961c-da951c362da1", "64502c81-163a-4ded-a7c9-3136024d26d8", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0c79f604-9287-4f97-be75-0fc491f952a7", "77efc382-0004-4d48-9605-9ab954aaca94", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0c8a55e7-1634-46e0-9705-245d53a9e3bc", "6a954648-6b0b-4db0-88f2-7446218b85f5", "9a1cc085-6cc0-40ee-85fc-849357638db3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-12 15:29:50", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-12 15:29:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0cc99b8d-f019-4b50-9341-cb074d104077", "77efc382-0004-4d48-9605-9ab954aaca94", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0d0d9800-60cd-43af-ab49-ccaea8107a5a", "e36aed14-9eed-4435-ad86-9df696e90057", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0d15c9bb-7b3a-4992-ba86-67f87824c8ad", "f7f8d89c-be4c-424e-a292-78529889491b", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:19", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:19");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0d58277d-4aa1-44f0-8803-49bfb35f6241", "6a954648-6b0b-4db0-88f2-7446218b85f5", "15631583-ee35-4d29-9815-b868148c39d7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-18 11:20:20", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-18 11:20:19");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0d9c4456-221b-41fb-baf6-724f747a5589", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0de9b39a-70c6-4882-a4a8-9365e6230c45", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e108cdf-bb3f-409c-82db-3344da2c4481", "6a954648-6b0b-4db0-88f2-7446218b85f5", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e2eb762-4d88-438a-816d-83f3ab93aabd", "0aa69419-0083-4a58-8557-3781a4944b05", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e71ff50-a1b2-4f92-8bd0-b9bb8964c047", "0aa69419-0083-4a58-8557-3781a4944b05", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e75f0c7-4e56-4c78-914e-f6039dd22746", "0aa69419-0083-4a58-8557-3781a4944b05", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0e8e9c87-7dec-4aff-a811-fefa42004c5b", "6a954648-6b0b-4db0-88f2-7446218b85f5", "47b4877d-7fdf-41de-a2ec-c6f467250478", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0eb2cbf3-0154-4cfd-90fb-ba513d3d09b7", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0eda2b57-84d1-4c6b-a501-cb6d83abb995", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "868afde4-08e8-4899-b596-301c1bae2258", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0edbfff0-545b-4338-9f31-702d5dad797a", "64502c81-163a-4ded-a7c9-3136024d26d8", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0ee91447-d0fc-4652-8bb3-2a26f848e513", "e36aed14-9eed-4435-ad86-9df696e90057", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0f03fb58-98d0-43dd-9731-dd5b45b3b17e", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0f22178f-7491-40bd-839e-d8b49d472a14", "0aa69419-0083-4a58-8557-3781a4944b05", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "104dc96a-0a64-4867-9349-994a12cc3a0c", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1054dae6-3f08-4d5b-8e11-691cb95e8aad", "6a954648-6b0b-4db0-88f2-7446218b85f5", "07eab05f-be52-45ce-8a53-8dd69df443f4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 13:32:55", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "109527d9-20fc-4c9a-890f-48ce75518ebc", "77efc382-0004-4d48-9605-9ab954aaca94", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "10c8f76b-59e9-4d79-892e-af9d24734d40", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "ac2e3614-bff5-4855-b14f-6efeb598855c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "10d5ed5a-6960-48ea-835f-1562886090f6", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "10efdc1d-3c51-4a71-a56b-8a9e90d0dc3b", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "11403bae-69ef-41bd-917d-90b6a9d0cebd", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:54:14", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:54:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "11c5579c-1feb-476b-b51e-d831c64fdef4", "6a954648-6b0b-4db0-88f2-7446218b85f5", "6a3b9836-1cc2-4b8a-ba2f-a5dad734412c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-03 15:39:57", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-03 15:39:56");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "11ddbda2-8c05-4efb-9cff-ed94d76aa659", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1209500e-6f30-44a0-9df1-6095e7b42e12", "79dd5083-f76f-41e5-8c60-bb1a318f229b", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:18:11", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:18:11");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1256049d-585a-45ca-b5ba-6aa33d269603", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1283daaf-d3ca-4a21-9cf7-cbf453166f19", "64502c81-163a-4ded-a7c9-3136024d26d8", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "128fc33c-bc05-4c0b-b4e7-856d4c80a456", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12bb2f26-3056-40b9-a2fe-81f1d6829084", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12d36403-8f2d-4592-86b6-55e778e3e652", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "4610c39b-de32-450b-812d-db8c37fcc643", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "12f2b78a-963f-40a1-b314-1e28a167dedd", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13053dd1-6d1e-4da8-8d72-3c230deb10df", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13682468-fbeb-4e12-9417-90c5d1c265bb", "0aa69419-0083-4a58-8557-3781a4944b05", "b56ff379-5619-4064-b572-407671edc15e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13919691-836b-4a65-a0a1-5332af4aed73", "dd10064c-5e93-4914-b41c-25ca8c974e98", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13b7c83c-36e3-4dfa-a9e0-edb4e209a39f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13c9e816-0f07-4e82-9e15-bd2672fbaa45", "6a954648-6b0b-4db0-88f2-7446218b85f5", "8ace90ab-ffeb-49ab-a9ce-9dbf1d9b99d3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 13:23:03", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 13:23:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13d6127b-307b-41a1-9632-7153ff05c975", "dd10064c-5e93-4914-b41c-25ca8c974e98", "71dfb7c2-4abf-4f93-b989-7d78f255a074", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13eb1875-65ca-4632-a729-06ddd48b1837", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "13fe6cdb-1d54-4b29-abcf-c0a404e9eca9", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "143d449e-b436-482e-8cef-e64976c6d6ab", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "14be757c-5d55-4f7c-82a6-b1c7bc8b4491", "6a954648-6b0b-4db0-88f2-7446218b85f5", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "14e9bf7e-2045-49f4-b0ac-cd2bec56c8c9", "77efc382-0004-4d48-9605-9ab954aaca94", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "155629ee-ed4a-4f04-b943-a2be0597e175", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "156e6319-8d4d-46cf-98ed-240b1f9d91a8", "6a954648-6b0b-4db0-88f2-7446218b85f5", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "15e1d6de-a2e7-4d20-9d98-caece1cbcd00", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "16583660-5f0f-44e6-afee-20cd9b7be428", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1676956e-e5df-4fb1-a1c0-be5d5ffb1d8f", "dd10064c-5e93-4914-b41c-25ca8c974e98", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1762e82b-1a56-4a1b-88d3-33c384201947", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "17e0864e-83d8-4557-8931-4e18d0f7e768", "64502c81-163a-4ded-a7c9-3136024d26d8", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1851301f-4c34-4901-a658-0028559f2954", "6a954648-6b0b-4db0-88f2-7446218b85f5", "eaaba437-4823-4819-a912-7bbf789959fe", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 09:53:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 09:53:55");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "18617353-1f6a-47d5-9488-b36d3eb6cdc6", "77efc382-0004-4d48-9605-9ab954aaca94", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "18731a58-e28c-468a-a1b7-d4b3dc34618f", "dd10064c-5e93-4914-b41c-25ca8c974e98", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1886fc14-afbb-4e59-8ffb-ab8599e88924", "6a954648-6b0b-4db0-88f2-7446218b85f5", "73917c12-47af-4672-b57a-45b8cffb8e4e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-16 23:25:23", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "18e19aa6-a63d-4491-abe8-8eb2d4341d63", "77efc382-0004-4d48-9605-9ab954aaca94", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1949cc9d-2488-46cd-86d8-94280555a9a6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "19585095-ad4c-4340-b032-28a1e94714d5", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "33ecb1e0-a8f2-47ed-8919-3c4bd057abf1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:54:20", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:54:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "19b27bdd-52dd-4671-88f8-44709d81de9e", "64502c81-163a-4ded-a7c9-3136024d26d8", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "19c31d35-8b8b-473f-aa01-2f2f71ad1602", "e36aed14-9eed-4435-ad86-9df696e90057", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1a6ba424-1a38-4b6c-94ee-c01e5a7e9dce", "e36aed14-9eed-4435-ad86-9df696e90057", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ac55706-ed97-46e5-99a5-e5ad8d1b4361", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "e68bda4d-9e9f-4a89-bd23-ca80983eca32", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:02:35", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:02:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1b2d5fa3-2d6b-49b0-ae3a-e2644470e4ec", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ac2e3614-bff5-4855-b14f-6efeb598855c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 08:50:32", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1bc2a88f-cff9-4986-8ec5-3d1910f3580c", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1bf5af03-dabb-4d86-8931-4075f03c6e31", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1c326d26-a1cc-4bc4-a980-1270958c367a", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ca34d35-ea6c-4ca9-849d-8f236bc0c788", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:16", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:52");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ca5ded7-ed17-43f2-bcff-39d4ae1d650d", "64502c81-163a-4ded-a7c9-3136024d26d8", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1cd01b6e-b398-40fc-98e3-29ebc00024a5", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:49");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ce34c5d-0692-4607-8ef1-ab6edfa0bc63", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1d4de6ef-c8d0-47db-95a7-cfc7160abfa9", "77efc382-0004-4d48-9605-9ab954aaca94", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1d6fef80-d33b-40d5-a2fb-554c41bc4596", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1d970793-38a1-4f41-a5d5-12db3fd23684", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("a4633f72-4d67-4f65-a050-9f6240704151", "1dafa891-0d7c-4bbe-b35c-6bffc715d992", "f932eed5-c9f9-49fa-a635-a73f7e1461ec", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:10", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1db34ad2-721f-4ef6-b198-aeb6db50fb9f", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1deb6414-b74d-473a-8e57-dc4630dab542", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1dec2d85-77fd-489e-9701-df913c3bb8bc", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1e19247c-8ff9-417b-8374-e306b2b434e0", "dd10064c-5e93-4914-b41c-25ca8c974e98", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1e7ef070-c12f-4205-baaf-eeb6d2d93802", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1ee7a69e-1808-46e6-8ad3-7fe3c138c2dc", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1f0bbd74-4f02-4719-867e-fd274657a6cc", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1f56e9a6-5899-40a0-a04f-6d8d63147e5d", "64502c81-163a-4ded-a7c9-3136024d26d8", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1f9af6d2-3bde-4583-8998-66f392893c51", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "1fb2a08a-2305-4301-88ae-84cb2e998790", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2034bf7c-6e68-464a-a440-fb5d4d9c1a33", "77efc382-0004-4d48-9605-9ab954aaca94", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2044fb8d-febe-4f58-8ad7-83c7b656d3fe", "6a954648-6b0b-4db0-88f2-7446218b85f5", "35e888f3-2365-41ff-8d77-26cbffbb4d4b", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-12 10:11:09", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-12 10:11:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "204fe811-a83e-4ab2-b8ed-8f10c68dc96d", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08 13:53:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "20c6f7d1-18f1-474d-969b-d54c3bd132fd", "dd10064c-5e93-4914-b41c-25ca8c974e98", "df495870-8f19-41a1-943e-5d36ea0553db", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "20cbd5e3-de11-46d2-a949-ee538f35e82d", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "219684ca-6faf-4726-9887-a1d1ad3a3963", "77efc382-0004-4d48-9605-9ab954aaca94", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "219afa3a-3639-4605-b556-a63ab14b91fb", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "21a74141-903e-4a28-aa01-b4819cf9b715", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "21f67af4-b3f9-4973-97f7-e1740149c2c9", "dd10064c-5e93-4914-b41c-25ca8c974e98", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "22001dca-d12b-4fef-be6a-05d0dbc907cf", "0aa69419-0083-4a58-8557-3781a4944b05", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "224c32a5-52d6-4a2b-bcf2-080b07414a5f", "64502c81-163a-4ded-a7c9-3136024d26d8", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2262b99c-b82b-496e-abea-7a924dd34a85", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2b3eeae4-dbca-4acb-be9a-d434f15cd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-02 11:24:05", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-02 11:24:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2273a3b6-3ac7-4d27-82c0-701a8d5b3c4c", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "23051dde-0493-4e7a-9a62-866446dae982", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "23304843-07f3-42d5-809f-823849d432e9", "e36aed14-9eed-4435-ad86-9df696e90057", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2424bb86-2568-4fad-ab3b-f61c805e3f8e", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "245079d5-4b42-477f-b853-0d16d1ba1eb9", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "24555571-3a3c-4ed4-ba35-7c30f02f32ea", "64502c81-163a-4ded-a7c9-3136024d26d8", "e68bda4d-9e9f-4a89-bd23-ca80983eca32", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:16", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2469b500-ffe7-4658-965a-fec63fde0d69", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "24795ade-6dbf-4915-992a-95b2174a0673", "e36aed14-9eed-4435-ad86-9df696e90057", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "259a06d5-7753-4d7b-a709-65889eb956bf", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "25fed72d-9e54-4e05-b752-65d7ba82703f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "26d9eee6-d23a-497f-bbf0-a618176412ff", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "26ef5453-d0d7-438d-96d3-9f89a41e61ef", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "26fc3f07-bfac-4acf-a6a4-ae6efa06d412", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "273f5550-86e1-49ec-ab1b-246c6a4789d5", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2828371a-c66a-4f3b-b9c2-a3502f4f54df", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "28d9552b-e057-4a52-9645-9b10380454bc", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "28f44207-bee7-4273-b760-cbf7c4daecde", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "039076f7-393b-4079-b65e-08a8eb673970", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:37:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:37:44");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "29288556-f700-41db-baa5-8d72c1726441", "77efc382-0004-4d48-9605-9ab954aaca94", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "29612966-aef0-421a-84fc-b973374e16bd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "29cc2801-b1d3-40ae-83b0-0610ee6776e7", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "07eab05f-be52-45ce-8a53-8dd69df443f4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-25 23:22:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2a4ff69b-d847-4a30-a297-445f297714d4", "e36aed14-9eed-4435-ad86-9df696e90057", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2a9becc0-7621-4c02-9626-ce43a0f7adb2", "e36aed14-9eed-4435-ad86-9df696e90057", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2ab9f171-bba5-4d2e-969f-7570607f537f", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b0d9ed6-4229-4d1b-8ff1-858533361205", "0aa69419-0083-4a58-8557-3781a4944b05", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b79fc63-f741-4da6-995a-21a62fb1d386", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b934419-dd25-4649-9a1e-9c023e49073a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b963519-7ac3-46fd-b9d9-b94470f366cd", "77efc382-0004-4d48-9605-9ab954aaca94", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2b9e9a73-908c-4e52-8491-70ac7fb09eca", "6a954648-6b0b-4db0-88f2-7446218b85f5", "7c69522f-cebf-4377-945a-3324b0a26baa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2c6aec28-f8cf-48f5-af2c-d0f6e0631910", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:02:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:02:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2c73123b-5630-4405-803f-e2e3352b8de6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "eeb5b08f-596b-4966-8649-f3f119325a67", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2ca448ff-c9a2-48a7-a379-4b6588746fab", "e36aed14-9eed-4435-ad86-9df696e90057", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2cebedf5-e6f8-4977-a281-acdd2520e29c", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:27", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:27");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2d497b7f-bc1b-4ad8-a30a-c061f2febbf2", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-25 23:22:09", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2d5405fa-4f97-49b2-88dd-baec48c5f95e", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "123f022c-72ae-401b-9144-624dad3a906a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2e17a9f5-c210-4cd3-9b84-b6321667135a", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2e41a502-c0ef-4085-8eed-8a4c32e84db7", "0aa69419-0083-4a58-8557-3781a4944b05", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2e916cbe-28c4-484d-8bad-8f3e18e64154", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2ec06399-400e-4389-a89b-713fe23a8738", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2ec90e70-5599-4d7f-91f8-d1a392c448e7", "77efc382-0004-4d48-9605-9ab954aaca94", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f240980-343c-45ad-b390-0115693580c9", "64502c81-163a-4ded-a7c9-3136024d26d8", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f3722b1-b11a-4f6b-9708-d7873430f1dc", "e36aed14-9eed-4435-ad86-9df696e90057", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f4cd1da-c4ed-4059-84f0-d308a4ea00c3", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f4f3b78-d97f-4f8c-97de-d219a9c5763c", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "2f98f8d9-4d5e-4f0d-a065-de4c775bb2c5", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3066a913-5075-4d7e-948a-1bc5773cc167", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "308130b0-fdc7-4e95-adfa-e788ac360485", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "b56ff379-5619-4064-b572-407671edc15e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3089eceb-8609-4da9-83b6-65b959571ce0", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "313afb7e-b764-4a44-b9db-ced77e8363ae", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:08:24", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "31ec4113-c2f8-4fa0-9ed7-9faa6b7cecae", "64502c81-163a-4ded-a7c9-3136024d26d8", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3232a8a2-82bd-4a33-b933-73c8ba29e662", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-14 11:33:42", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32ae660a-ef1d-4c48-9ea7-95ad0ffeb384", "6a954648-6b0b-4db0-88f2-7446218b85f5", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32b0416a-3ecf-4b29-8de6-49f36af74795", "77efc382-0004-4d48-9605-9ab954aaca94", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32d755ba-5c44-49d6-aeef-db1b1689ec42", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "32efa67b-652f-49ef-aa44-e5f393141cfb", "77efc382-0004-4d48-9605-9ab954aaca94", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "33694cc9-5679-47c3-bc6b-503941cfdfa2", "e36aed14-9eed-4435-ad86-9df696e90057", "868afde4-08e8-4899-b596-301c1bae2258", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3413cba8-a83d-4f1c-87a9-c333d74294e2", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3461d551-fc5e-4b35-8f88-8d305756325e", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "34c4db66-d1ba-439f-99df-2db3abf76c70", "6a954648-6b0b-4db0-88f2-7446218b85f5", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "34d6579f-e28f-43d6-9c80-33f723f61380", "6a954648-6b0b-4db0-88f2-7446218b85f5", "56f6fcfd-ece1-493f-80f3-1948fe769fbd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 13:47:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 13:47:42");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "34f72244-4c9b-4d9c-ad37-0e24eb2e11b2", "77efc382-0004-4d48-9605-9ab954aaca94", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "35acca2d-b7d8-4794-a5dc-fdb5f8a8cd6c", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "361447a8-03ea-4269-8f68-af40f1b5ee71", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "eeb5b08f-596b-4966-8649-f3f119325a67", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "36451207-029d-4e6c-9657-d89caf796dba", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "364b9636-dd84-4881-b848-c73a0c9ff3a9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3674fbb6-898d-41cf-ad22-f4532402877c", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:48");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "369abe3b-b2c2-439c-ac42-bf8cca1cf802", "dd10064c-5e93-4914-b41c-25ca8c974e98", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "36ad7f6e-49f5-471d-a46e-b140ed547e13", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "36f1444d-3bf4-4062-9db2-887cd5581ff0", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "372534cb-d4f0-4b24-bae3-469d787f010c", "77efc382-0004-4d48-9605-9ab954aaca94", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "37643fd8-ea87-4a8a-92d3-a0c4ad586a0b", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "379adee7-7c21-46f1-961e-31fd3fbbca79", "e36aed14-9eed-4435-ad86-9df696e90057", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "37d619ce-2852-4215-ac15-397a4326194f", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3859b56c-9887-4947-ba81-bbda5a9a65b8", "0aa69419-0083-4a58-8557-3781a4944b05", "73917c12-47af-4672-b57a-45b8cffb8e4e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "385df03e-65f6-4965-a1e8-6926f86cfb19", "64502c81-163a-4ded-a7c9-3136024d26d8", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "38efc316-4d13-4e03-ba38-d2b4633ffac6", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "38f187e5-f892-4238-84c3-6064857798a1", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3a89b543-65b2-49ea-9f5b-60b56bce17e0", "64502c81-163a-4ded-a7c9-3136024d26d8", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:21:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3a8ba3e6-452b-46c1-a8dd-e153e021e4d6", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b1c4308-0b92-4614-875c-ea1c04f58944", "dd10064c-5e93-4914-b41c-25ca8c974e98", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b3939f5-aac5-430f-bfb9-113bd7a7edd4", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b49d364-a5b3-45c3-a968-1e35ee5c96ad", "e36aed14-9eed-4435-ad86-9df696e90057", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b69b83f-b9be-4186-81a7-a55fd665418b", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:04", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:48");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b95b543-ff03-41c4-af60-a43072a2b2fe", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3b9cec3d-7aad-43da-aeb8-b3dfa71777a8", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f71515e5-57b8-41de-9c49-5e494c497563", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3bc387e2-6a88-462b-ac02-fa5f40eb0e3a", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3bd2272a-1292-486d-bf90-98d397d94f41", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3c1e1e82-9a15-4d9b-bbdf-f3fee3e657a5", "6a954648-6b0b-4db0-88f2-7446218b85f5", "49e22574-cb55-450f-9d47-6b895b2caed3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3c6ae0b1-c284-4c4b-b1bd-d63640386de1", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3c6f82a2-a8f0-42f8-a2a7-3e30355bad1a", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3ce323be-8ec5-44f7-b9a7-0951120e2478", "6a954648-6b0b-4db0-88f2-7446218b85f5", "687b3adc-f1ad-4849-8bef-ee2121faddcc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-30 21:42:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-30 21:42:56");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3d6167e9-d883-4a93-b48b-c1e61d90eab6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3ddaec45-af26-4e98-8803-77f39e141ed9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3e0f529e-ef4b-44fb-af94-6f60cc8f0b4c", "64502c81-163a-4ded-a7c9-3136024d26d8", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3eb9fb14-2abd-47a4-80f5-bb8523e3b7da", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "bacde412-a651-4c8c-8237-155b39a4595b", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3ec49869-80fa-400f-9d7a-d69a0a2731c3", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 13:32:54", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3f2cd18a-9090-40c6-82de-eeeee6655228", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4063f75f-f8ad-4b9a-85ae-1c32afcb83cb", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "687b3adc-f1ad-4849-8bef-ee2121faddcc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:38", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:12");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "407257bb-084f-46b2-bda1-8b88a2606091", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d7ca1a2b-e684-4b50-824d-50540afaa994", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 08:45:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 08:45:34");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "40c96b1d-ca43-4205-bff5-5f81d7720d88", "77efc382-0004-4d48-9605-9ab954aaca94", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "40f12d06-4894-44ca-a299-0b1a14f831ef", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "41393c0f-7b7a-4b3a-a596-c0697c26eb36", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4145c359-25f5-4881-9f81-be12a6481243", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "414f76fb-629f-4022-a412-b68f4334167a", "0aa69419-0083-4a58-8557-3781a4944b05", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "415571f0-9277-4ba6-8c30-2658e3f05d5f", "0aa69419-0083-4a58-8557-3781a4944b05", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4188ca6a-6484-402e-8e53-be2103d1c0d8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "418f7b4b-da97-4e2d-b06b-c39719a3e04a", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "42219677-1370-4537-a223-77def50c41bc", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "424d70a5-7e2c-4462-85b9-98d1d1765132", "77efc382-0004-4d48-9605-9ab954aaca94", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "426823a0-8c06-4cd7-a16a-f9a6455198e7", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4270bee5-998f-4f7d-9057-73b183827ceb", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4289774b-261d-4c16-a0dc-892b52a7cde5", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "429caa0c-4ec6-43f0-b6d9-d95aec21c81c", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "42deba31-3be1-46bc-9267-e85c95c77a0f", "0aa69419-0083-4a58-8557-3781a4944b05", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "42ef2a80-fd13-4982-b6b7-185c2b889c25", "dd10064c-5e93-4914-b41c-25ca8c974e98", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "43581f7c-d2fd-42bb-b348-70cdcda66f93", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4366b996-bed1-4c42-b92d-8c4386c586f1", "64502c81-163a-4ded-a7c9-3136024d26d8", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "436b160a-1faf-4930-a119-b9ef556464a0", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4388035a-67d2-463f-9a6f-ce7991938011", "dd10064c-5e93-4914-b41c-25ca8c974e98", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "43a1ad5e-52b3-4a10-bf2a-df831271d333", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44295f3c-2364-45f8-9af7-167dc09f2d02", "6a954648-6b0b-4db0-88f2-7446218b85f5", "9ba71b79-b3dc-41f3-810d-016524a87fdc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-07 09:46:51", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-07 09:46:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44363f1a-0c93-4558-a802-3af5dd115a35", "6a954648-6b0b-4db0-88f2-7446218b85f5", "aba0746b-5fc8-4fb7-aa74-f1487cf42e2d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-07 21:46:16", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-07 21:46:15");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44403346-f1c5-4f26-8ebd-8c13a476a931", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "447fc3ac-a3f4-498b-8196-42efee2bb74c", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44a27d25-e37f-4f16-8a06-b5baf48797f9", "e36aed14-9eed-4435-ad86-9df696e90057", "e68bda4d-9e9f-4a89-bd23-ca80983eca32", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:19", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:19");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "44b1909d-3478-4b96-bbe9-f62f55d99901", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45146feb-365a-4a34-9178-fad7cb419fc6", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4554f60c-94e6-471b-86c9-056e5c0dcf55", "0aa69419-0083-4a58-8557-3781a4944b05", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45631ca1-38c1-4ff3-89c5-09452d043dda", "20692618-6042-40e6-b6b4-df381bb99c52", "dfff16fd-8bc6-410b-8500-3548cf245a86", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:47:45", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:47:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45ced394-94b1-4d55-a9a9-4502066542d3", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45eb676b-ad96-4721-9791-3f69fb324091", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "b56ff379-5619-4064-b572-407671edc15e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "45ec95fa-4e10-4dab-a36e-547432fe1734", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4644778b-c196-4d59-a915-e60666ed3f6d", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "123f022c-72ae-401b-9144-624dad3a906a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "46a36ca6-3ed2-499a-ac79-c7ceac7c74db", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "46f373ec-9317-4deb-b6a8-182e60c12370", "e36aed14-9eed-4435-ad86-9df696e90057", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "47021dae-7e1a-4d00-bf6f-0cd38d3e21aa", "64502c81-163a-4ded-a7c9-3136024d26d8", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:31");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4722369a-6bcc-4d75-9740-10d306ebcb38", "116b3436-bce6-487e-817d-ec9e793e41ba", "a3e946b9-29c1-4263-a911-87bc6eba561e", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:47:25", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:51:30");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4864bf7f-6d4e-4af6-b754-a89c2ff7f377", "dd10064c-5e93-4914-b41c-25ca8c974e98", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4884520f-6aac-4d95-b8b6-924ffee49d5b", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4885cc01-4b59-44e9-a8b2-63c718625552", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "48a69a86-14d9-4ee6-bdc7-ef455410add3", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:48");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "48d24281-5922-4d6b-8d2f-79a282563784", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:09", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:31");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4934b3b2-d20e-4a44-9cc7-3a86cf0e5d91", "6a954648-6b0b-4db0-88f2-7446218b85f5", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "493507a5-1500-4e9d-90e4-1987f7537420", "b121aaba-f544-4827-9fc6-e22602559a77", "28f66f08-643f-4808-9eca-956a43889705", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:13", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4976ffbd-b437-4b2a-acfd-6c89bb2d9c2a", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "497bcdea-d863-4cfa-a0f9-6e4aab8bb5fc", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "49981229-751b-45bf-b2b7-02800af0c545", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "47b4877d-7fdf-41de-a2ec-c6f467250478", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "49d08d6a-365a-4357-8962-0365312d09cf", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:57");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4a9276e5-d6db-451f-bf97-1f495a4f8287", "64502c81-163a-4ded-a7c9-3136024d26d8", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4a96f236-e4e1-48c2-afe4-f01fb2d631af", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4acebaf4-ef9d-44bf-8844-4705078005f5", "dd10064c-5e93-4914-b41c-25ca8c974e98", "99df9a77-d5a1-48b1-b3b5-a771ded109bf", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:58:39", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:58:39");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4ae7ba4a-f45f-47fe-8eb6-77558ef92253", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "d7ca1a2b-e684-4b50-824d-50540afaa994", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:21:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:21:56");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4afda625-adc7-4b79-9279-7b43bdecbe80", "e36aed14-9eed-4435-ad86-9df696e90057", "687b3adc-f1ad-4849-8bef-ee2121faddcc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:12");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4b2bbcb3-5688-4327-b47b-16aff77ea6bd", "64502c81-163a-4ded-a7c9-3136024d26d8", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4b508dfc-693a-4f92-847c-7f09d69fd234", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08 13:53:43");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4c69021d-01a0-4085-9a6f-b8af9577299a", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4d257f00-d80f-45d3-81ce-628eccbd5e68", "77efc382-0004-4d48-9605-9ab954aaca94", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4d7f1a98-f848-44f3-bae9-87efcce9cc66", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4da5181f-0fcb-48dd-9946-bd5f15798f48", "0aa69419-0083-4a58-8557-3781a4944b05", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4dbbc0b1-10c3-4fb1-8e5b-69522a88b3e4", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4dbf0d6d-52ac-4663-a20f-109d102a4cd1", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4dd3bd38-dcee-428c-a255-81e77a8a4f94", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-25 23:22:37");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4de05d42-7e0b-44fb-a67c-39a1d6a25ecd", "6a954648-6b0b-4db0-88f2-7446218b85f5", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4e19e4c8-a31a-43bd-b205-8a704c26337a", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4eb3ba0b-cf9d-4685-8024-231f648868c3", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "df495870-8f19-41a1-943e-5d36ea0553db", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4eefb394-221e-4aac-a7a0-51dbe1aff584", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f166b42-18b7-46e8-bb29-9cfa22639f75", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:49");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f504195-712f-431c-b97e-ebff59d78c68", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "9a1cc085-6cc0-40ee-85fc-849357638db3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-29 16:09:18", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-29 16:09:18");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f625dea-2dcf-4af1-b5fb-793b20d482e8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4f6e2423-92f8-42c6-a789-ef8bee0dda66", "e36aed14-9eed-4435-ad86-9df696e90057", "73917c12-47af-4672-b57a-45b8cffb8e4e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4fab9c66-ef56-4b56-9e69-4d405bf2b6cb", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "4fcdd1f2-a59c-46b7-8c51-e478e3e48f9a", "6a954648-6b0b-4db0-88f2-7446218b85f5", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "50128ac1-a0b9-47da-841c-c77f5f193240", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "71dfb7c2-4abf-4f93-b989-7d78f255a074", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:52:46", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "501557cf-284c-445d-a3c5-d1686a7a2d23", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "503104d8-93df-4166-8780-7cd65ff7c863", "0aa69419-0083-4a58-8557-3781a4944b05", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "50456331-e2a5-46bb-937c-383d60bc056f", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "50bdf2b7-c5e2-4fa9-aca7-73016ff5fc7e", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "bacde412-a651-4c8c-8237-155b39a4595b", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "50c96911-998f-4960-9269-b2df0a3df8c9", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "50f6c7eb-24ad-4379-af29-72bf169e8400", "6a954648-6b0b-4db0-88f2-7446218b85f5", "4610c39b-de32-450b-812d-db8c37fcc643", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "51233d1e-3b7e-4537-8823-2599c664f66a", "64502c81-163a-4ded-a7c9-3136024d26d8", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:21:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5151f097-4528-4215-ae2a-65e8b5721a09", "6a954648-6b0b-4db0-88f2-7446218b85f5", "", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-27 22:00:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-27 22:00:39");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "515562b4-5d3a-4a80-bb0c-55499d1a1885", "dd10064c-5e93-4914-b41c-25ca8c974e98", "351be4d9-c967-4d44-a1e6-171a98eec8cc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5167f8b5-08d2-491b-8d35-81ef84411adc", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "517cb908-8983-4df4-9fdd-fd0fa6554370", "0aa69419-0083-4a58-8557-3781a4944b05", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("a4633f72-4d67-4f65-a050-9f6240704151", "51a3d780-e044-4ea6-8f5d-9366e6449120", "f932eed5-c9f9-49fa-a635-a73f7e1461ec", "d00ef65d-9af6-405c-a8ef-b5e3dc312416", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:13", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:12");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "51f71ebe-2f3e-4dbe-9b98-f4090c3ef71f", "77efc382-0004-4d48-9605-9ab954aaca94", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "51fea687-1003-463e-96fb-a8d975634fc4", "6a954648-6b0b-4db0-88f2-7446218b85f5", "df495870-8f19-41a1-943e-5d36ea0553db", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:13:00", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "523b75bb-771f-4fc9-8d4c-62f3b75c5ef9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-07 11:59:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52b83d97-7525-4656-ab08-4f9b370d94fe", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52bde612-7ce7-489c-b1fa-68f28563b9e3", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52c93c7a-b6c2-45ac-91f1-741a053e1181", "0aa69419-0083-4a58-8557-3781a4944b05", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "52cd795f-5c08-4fa5-ae20-064146461b78", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "530bc982-c125-4409-b7bd-674547aec880", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "53e1faeb-3144-4ebb-95c1-048f72ece96e", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "53e4914e-2873-4c31-abcc-0676b11fb809", "64502c81-163a-4ded-a7c9-3136024d26d8", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5402cc4c-1cc2-4500-849e-06541ade4834", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "540aa73e-431e-43da-b9bc-0a8e255b9764", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "54394c56-1db3-47c6-ab30-c72647916858", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "547df086-d3dc-4003-8c48-26c20be41f73", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:38", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:57");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "548950b2-4c93-4f10-8ba5-359928473501", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "54b8223d-3254-41a2-ae5c-6578a5004d79", "0aa69419-0083-4a58-8557-3781a4944b05", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "54d0bdfd-1dd5-4f31-842b-f753f423a9a2", "f7f8d89c-be4c-424e-a292-78529889491b", "28f66f08-643f-4808-9eca-956a43889705", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "54ed347b-ace5-4c6e-a8c6-aaf93bd9052b", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "553f4942-ba2a-4410-849b-171821fae0f2", "64502c81-163a-4ded-a7c9-3136024d26d8", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "554e3861-0fd1-47d7-a59d-4caabf071a17", "e36aed14-9eed-4435-ad86-9df696e90057", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "55500c11-ea6c-44ac-a3b0-2df6e8859509", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "55b1d66d-d974-4e87-a337-4b6f53da1026", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-03 09:28:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5644ca98-3407-46ef-a25f-b96ea0a11daf", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "564ce1fb-4912-4fb3-9fb6-d8b3c8e7479e", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5661942a-22d7-4eb6-b62f-095e72823545", "dd10064c-5e93-4914-b41c-25ca8c974e98", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5681c3fc-a80c-4ea0-9fe4-64e835e6d925", "64502c81-163a-4ded-a7c9-3136024d26d8", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "56952bf0-75fc-494d-ab48-d3a73f48d715", "64502c81-163a-4ded-a7c9-3136024d26d8", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "56b799c2-5aaa-485b-a46b-65f9caa807a8", "20692618-6042-40e6-b6b4-df381bb99c52", "d7ca1a2b-e684-4b50-824d-50540afaa994", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-17 15:52:04", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-17 15:52:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "56deec4b-97bd-4951-9d08-bee8889f92c3", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "56e60283-39f1-4e22-88fc-2ee17746e5de", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "56e7acf6-08d7-4b4a-9289-b7809de2c87c", "0aa69419-0083-4a58-8557-3781a4944b05", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "570e2624-2a8b-4d3a-9543-639eef1aa7db", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-25 23:22:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "574e6166-9751-4173-aa8a-bccd8d767b20", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "57668f4b-e73b-4038-a30e-8a0d400ecc02", "af82114a-23e2-4d2f-b787-0a693fd76d54", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 09:02:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 09:02:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "57b621d3-7d4a-4b85-9991-b3d1418c4061", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "a3e946b9-29c1-4263-a911-87bc6eba561e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-29 16:09:20", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-29 16:09:19");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "57ce98b8-dcc3-4f75-b9e3-9d897d5f5ea4", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "583d0863-43a7-4b5b-8acd-9cfd7aa66678", "6a954648-6b0b-4db0-88f2-7446218b85f5", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "58553e0d-3a76-41da-bd77-cc69b8e6385e", "64502c81-163a-4ded-a7c9-3136024d26d8", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:21:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5856b9e4-a0c5-475e-ba2c-eb0c580de801", "77efc382-0004-4d48-9605-9ab954aaca94", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5869460a-4a0e-41af-b425-9333ae212110", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:57");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "58745f03-a9c9-4fe8-a3c7-859fc5e3eda0", "e36aed14-9eed-4435-ad86-9df696e90057", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "58d8bdd1-97c1-40ce-8e3b-cd2e1bfc8544", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "592b9bbd-ab73-4a49-8d51-292705e5c1d0", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5932cdc6-f20d-4e94-92a6-15c869d0f9eb", "116b3436-bce6-487e-817d-ec9e793e41ba", "9a1cc085-6cc0-40ee-85fc-849357638db3", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:47:24", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:51:56");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "599a15f1-7493-407c-bf01-5b9c7b19d140", "64502c81-163a-4ded-a7c9-3136024d26d8", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "599e7d64-5f1c-4482-86c3-59e4533d1ea3", "77efc382-0004-4d48-9605-9ab954aaca94", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5a57119e-0e68-4989-b178-838adef19657", "6a954648-6b0b-4db0-88f2-7446218b85f5", "8a89a915-4ec5-41e7-b55c-a357ff7e5e45", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-12 14:06:16", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-12 14:06:16");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5aabd261-84d8-4b8e-9e0e-eb5ca2f9295f", "0aa69419-0083-4a58-8557-3781a4944b05", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ab660c5-ec2c-41c5-9ad5-968b6faf32b9", "dd10064c-5e93-4914-b41c-25ca8c974e98", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5adaba6a-9481-4b78-a93d-cec860809c7e", "e36aed14-9eed-4435-ad86-9df696e90057", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5b1b0785-06d1-4656-b523-3f69baddbe87", "6a954648-6b0b-4db0-88f2-7446218b85f5", "8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-12 10:08:06", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-12 10:08:05");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5b880513-76d1-4938-8b1b-87e547f93a07", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ba865a5-98d5-47e0-9bf1-31b469ab9323", "e36aed14-9eed-4435-ad86-9df696e90057", "71dfb7c2-4abf-4f93-b989-7d78f255a074", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5bad9303-75ac-4784-ae15-999896d11ead", "f7f8d89c-be4c-424e-a292-78529889491b", "6a3b9836-1cc2-4b8a-ba2f-a5dad734412c", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:27", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:27");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c176aa4-077f-40d7-984d-cd2bd3643f4b", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c4c0779-070b-4bb9-87f2-83fbcca4cbae", "6a954648-6b0b-4db0-88f2-7446218b85f5", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c76cc11-362d-4256-832b-d91de74cfdfb", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "73917c12-47af-4672-b57a-45b8cffb8e4e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5c84e28a-78ba-4fea-9255-8e72d90b8795", "6a954648-6b0b-4db0-88f2-7446218b85f5", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5cc1690b-2955-4358-b9e6-a0af4456a8aa", "6a954648-6b0b-4db0-88f2-7446218b85f5", "bc60eda3-abcc-4469-9392-91614e7e9521", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-03 11:23:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-03 11:23:11");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5d16402d-eddc-44d3-ba30-d79248c9aaa6", "64502c81-163a-4ded-a7c9-3136024d26d8", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5d38e13c-6eff-4f3c-b321-81fe8a5c0bf3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5d4054fa-ce91-4553-b63f-254244fec83e", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:08:29", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5d7a8d11-88cb-4f59-840b-3b278090297a", "e36aed14-9eed-4435-ad86-9df696e90057", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5d96b8c5-4753-47fb-9adc-4bd11ece2c1e", "c70cdcda-900f-4494-a44e-dd91e351938f", "2352e62f-8145-4895-a130-9973e021961d", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 14:52:43", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 14:52:43");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5dcb5db6-c2c4-448b-a51c-a758997666e5", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5df13d6e-200b-41f4-9297-571c572667e8", "77efc382-0004-4d48-9605-9ab954aaca94", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5e1809b2-0e81-4d6d-a656-900d93a0e2a9", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5e248e65-07ab-4122-a779-6e8117c671af", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ec6d173-195c-4c87-ad98-d578300513ce", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5eca3fbc-ca7e-43ad-8b32-82d1311505b7", "dd10064c-5e93-4914-b41c-25ca8c974e98", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5f2a3b57-bdc8-4314-a28c-184ec366aea8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-03 09:28:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5f2bc1df-2ef7-490a-8b19-5c1869424fe2", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "600883bf-d3eb-42f9-991c-e3ec77e393ff", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-07 11:59:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6026b12a-bfed-426c-acb8-e01916b97ecf", "64502c81-163a-4ded-a7c9-3136024d26d8", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "60b08c07-6e8f-4652-8f45-31010662b6d4", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "60da81fc-f012-42bd-8d85-145a60a6e30c", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "60dfdf52-685d-49ad-92bd-60f00e2d40f9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "615736bc-782b-4b55-bb60-ce8ded277ceb", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:24");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "61ec4596-4aab-4d80-8721-8b28c4cf87b5", "0aa69419-0083-4a58-8557-3781a4944b05", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "623c9f2c-4172-4e96-afa1-8fe7de998093", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "62906b73-aeac-40e3-80bc-6af349e5df9a", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "62e3bafa-78a9-401d-b896-9c45883a29a7", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "868afde4-08e8-4899-b596-301c1bae2258", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "636174c6-385c-4cb1-bb83-5fb1105839c2", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6386eb2e-9b63-46be-aa6b-4d45cbac40b5", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c23d0cb1-f394-4b6c-b35d-e5d0c119f816", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-07 21:46:16", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-07 21:46:16");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "640112a5-8197-4c6c-8953-b85714783109", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6417c46d-d054-418c-ac27-7d7b0a3a84de", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6450030b-4c78-4a5e-ba2d-20234e553c65", "64502c81-163a-4ded-a7c9-3136024d26d8", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "64707bc0-2ff7-47ac-a5ca-e50989b5e4a7", "64502c81-163a-4ded-a7c9-3136024d26d8", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "648979ac-3a64-466c-a38c-a0c9a21bdfdb", "0aa69419-0083-4a58-8557-3781a4944b05", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65010331-bfca-4e4a-990c-a77a171cef95", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08 13:53:41");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6551b6e7-8d7e-45c4-87f2-cfc0a2c54701", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65838dd7-98ed-4c5d-a06b-541788f503a0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "65f54892-94ed-497e-94a0-9ba62808b1b6", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "71dfb7c2-4abf-4f93-b989-7d78f255a074", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "66249af5-bfaf-4d82-8b67-f84a8e6f344b", "0aa69419-0083-4a58-8557-3781a4944b05", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "668e6dac-4ffd-43cb-bfb3-0f497e72cd76", "0aa69419-0083-4a58-8557-3781a4944b05", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "672dfde7-2fc1-4daa-94d1-f3d6d9b912b4", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "67483cc9-4064-4bfc-9af4-1324c69a0b9a", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "675cf7a1-7838-4333-b4d7-62b99185657e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ff61f738-5cd8-49f9-9005-7236fdefdc6c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-16 23:25:23", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "67cc71e4-5b0f-4e0e-8d78-2362b20546bc", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "67ff8aff-0b48-4618-b205-d501b6aab9f4", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "681f9c70-0607-471f-a488-0ad6a481cc6b", "0aa69419-0083-4a58-8557-3781a4944b05", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "686f896b-7724-4c09-af3c-fc9cef661ab8", "dd10064c-5e93-4914-b41c-25ca8c974e98", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6890fbc1-178e-4f01-90e3-72d9a870c0dc", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "6a3b9836-1cc2-4b8a-ba2f-a5dad734412c", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:30", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:30");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "68bbb260-9e69-4302-a9bf-7e8de8681299", "0aa69419-0083-4a58-8557-3781a4944b05", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "68f73f41-9989-4a95-baa9-3efbaa15f33b", "0aa69419-0083-4a58-8557-3781a4944b05", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "69133c0f-d290-4fe1-acf7-9302739c6c8e", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:24");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "69dca67d-e018-4f8e-b7e3-f5b6a699b099", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "47b4877d-7fdf-41de-a2ec-c6f467250478", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "69f40783-3518-4adc-a890-b30cf7e76a77", "77efc382-0004-4d48-9605-9ab954aaca94", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a030c88-0735-4108-a841-6ea81adef44d", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6abd052d-5214-43ae-9c0c-58ff9499a9e0", "77efc382-0004-4d48-9605-9ab954aaca94", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6afb49f1-852f-47a9-84ae-08b9ed1201be", "77efc382-0004-4d48-9605-9ab954aaca94", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6b7400b0-7244-438d-ae97-71c73fd5090e", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:21:52", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:21:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6bcbf32c-89cc-4d2c-a60e-965e3fac7d3e", "64502c81-163a-4ded-a7c9-3136024d26d8", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6c3a609d-3dd1-4ac0-9a18-736db46241cf", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "825a61cb-a0ba-4e96-8dd8-6a93bc938ec2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:29", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:29");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6c469c54-83e1-41bd-ab2c-8b84abfa9b2b", "e36aed14-9eed-4435-ad86-9df696e90057", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6c786a19-1226-4abe-a3fb-db20b1889265", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6cd4f756-ff11-4434-bb37-069834ca26d3", "e36aed14-9eed-4435-ad86-9df696e90057", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6ce0c833-8fbb-4520-9e07-c4f060e25eb9", "77efc382-0004-4d48-9605-9ab954aaca94", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6cf40828-9a55-4575-a254-76f6f1e3f708", "6a954648-6b0b-4db0-88f2-7446218b85f5", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-31 13:47:52", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-31 13:47:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6cfa8efc-1c35-468f-80dc-5577f074afde", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d20d3d5-8bfe-4853-bfa0-2c748f3f23c7", "77efc382-0004-4d48-9605-9ab954aaca94", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d214f07-42d1-4c37-9c83-80f37e26cb42", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d669579-20ad-465c-a9a0-217e896ff47b", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6d875aa1-32e7-4602-80f2-b06ed7631d64", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6da9ea48-3bca-4803-b622-dc8355b7e1aa", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "73917c12-47af-4672-b57a-45b8cffb8e4e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6dad13d5-1ad7-442c-bcdf-3c403f2a491b", "b121aaba-f544-4827-9fc6-e22602559a77", "e68bda4d-9e9f-4a89-bd23-ca80983eca32", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:16", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6dc2c72e-0123-4fd7-a3cd-0ffa7951b9c6", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-29 16:09:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6dcd34eb-6063-495a-b45b-722cd8943ee9", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "bacde412-a651-4c8c-8237-155b39a4595b", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6e1ac4f2-c510-4a85-abe2-d7659cd00474", "77efc382-0004-4d48-9605-9ab954aaca94", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6e3a1bbd-7fa8-453f-8fd6-e52463a73b1b", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6e8420ab-c0d1-404f-963e-b3077ffcb797", "6a954648-6b0b-4db0-88f2-7446218b85f5", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6eaaa4e2-aa1a-4e98-895e-d7ca4f301331", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "47b4877d-7fdf-41de-a2ec-c6f467250478", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6ed2d9e4-7ab3-425e-9cf8-98801bca67a0", "7a9f1131-3120-4b11-8117-09a860500b46", "d7ca1a2b-e684-4b50-824d-50540afaa994", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-17 15:51:02", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-17 15:51:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6ee54df3-bf59-4aa6-b27e-781c69f0a910", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2352e62f-8145-4895-a130-9973e021961d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-16 18:54:00", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6f03baa1-473e-45f9-ae02-30b56ec0b17a", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6f23d6c5-564f-444f-bbd7-fb2341e691a9", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6f50a8ce-e338-4c4b-b869-b6d26774158a", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "123f022c-72ae-401b-9144-624dad3a906a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:35", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6f57ebca-f56e-4705-b35c-d0adad73a44e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "700fe10f-6b76-4f70-9f46-a3247b9cc402", "e36aed14-9eed-4435-ad86-9df696e90057", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "70c1713c-f3f2-497e-8304-51f88f4f269e", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "711434a6-4c82-4b5e-a716-5e7bdd7ebf4c", "64502c81-163a-4ded-a7c9-3136024d26d8", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7149573c-d454-42b6-92c8-8bf7865b5197", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7168026b-f5a0-4a62-b42f-fa4bd70acd38", "0aa69419-0083-4a58-8557-3781a4944b05", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "718dc507-37ee-445b-9aac-d8fbdcebd85e", "dd10064c-5e93-4914-b41c-25ca8c974e98", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "721a748b-ff7d-4736-b1bc-62b9ecaac92f", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "721edd2f-1e7b-4264-93f0-411d99d39f7f", "dd10064c-5e93-4914-b41c-25ca8c974e98", "f9e7f495-3ac1-4e07-99cc-14160791c745", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-24 18:32:51", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-24 18:32:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "725310d7-a89e-4e2f-839e-aad3718b33a1", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "725bdff4-0594-484f-9d52-020690a95992", "0aa69419-0083-4a58-8557-3781a4944b05", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7342288f-0906-4a33-b2d6-cf4c054d55ac", "6a954648-6b0b-4db0-88f2-7446218b85f5", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "73657692-9f7c-48f2-b86d-76b5db996575", "dd10064c-5e93-4914-b41c-25ca8c974e98", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "736f1d50-c32b-4a90-a198-a3a5201d47b6", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "73a7a7e4-2761-41f2-8c9d-3dd1e892146a", "77efc382-0004-4d48-9605-9ab954aaca94", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "73bc8057-f85e-42a0-b46f-744a15d13ee9", "6a954648-6b0b-4db0-88f2-7446218b85f5", "28f66f08-643f-4808-9eca-956a43889705", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-10 14:41:43", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-10 14:41:43");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "73ffbdcd-3d91-4633-9ced-4a1cc14e3997", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "742c6a5a-9b9a-40b4-982b-209d86f8f6d8", "dd10064c-5e93-4914-b41c-25ca8c974e98", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "749db794-d307-49b3-bf7a-c3df0bffe3bc", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "74f5ad9c-d9a4-4645-a88b-8e88d5331071", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7524c2e3-5fed-422e-aa1f-0446de57c729", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7585381c-7b26-470d-9298-ad25c73e4087", "e36aed14-9eed-4435-ad86-9df696e90057", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "75cdd40a-296c-4527-a77b-4cef491296b4", "64502c81-163a-4ded-a7c9-3136024d26d8", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "75d9cf17-7b88-4c05-bdfe-0b5f3948df30", "64502c81-163a-4ded-a7c9-3136024d26d8", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "76657691-e46d-411f-b579-d0ee68a575f4", "6a954648-6b0b-4db0-88f2-7446218b85f5", "45689c70-720c-4b4b-b757-f7f1fc80ad47", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-18 11:19:14", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-18 11:19:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "76807a24-31e7-4f37-8738-63ba1163e96c", "77efc382-0004-4d48-9605-9ab954aaca94", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "77051ebb-b73b-4d0a-a198-283a512c43c0", "64502c81-163a-4ded-a7c9-3136024d26d8", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "77075d32-212c-4330-8bf6-7fcf27f28643", "64502c81-163a-4ded-a7c9-3136024d26d8", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "77999709-4fd7-48c8-a820-f99870c3ca0c", "dd10064c-5e93-4914-b41c-25ca8c974e98", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "77e9de47-9312-48c5-b4e5-b444dae244a8", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "780fd774-8051-48ce-aeaf-160f720785d0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "8c9136b3-7e71-41b0-ba29-8856fd434a17", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-02 11:24:00", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-02 11:23:55");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "78788af8-0954-4939-9160-1a06d1822aef", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "789c2370-f7d9-4fc1-a6f1-1f425e0141d9", "77efc382-0004-4d48-9605-9ab954aaca94", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "78c94cf7-c2b6-47a7-8473-00597991f9de", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "78f74425-849c-4b57-a720-3e120f2fb709", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:54");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "78fb57bc-dd8c-47a0-93a4-b201390465c9", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "78ffe885-f5e7-4d06-ac94-e73fc04a5939", "0aa69419-0083-4a58-8557-3781a4944b05", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "79159a22-f94c-418c-bdd9-a04f8c180b43", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7928ea97-e012-41d5-b5ff-e57246e20ee9", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "793659fe-7248-415c-8a66-56ddbb6d7632", "77efc382-0004-4d48-9605-9ab954aaca94", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7996b90e-26ca-43c2-8043-6500247f6bd4", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7a207002-a958-4f07-8e6e-d5e59f2c5815", "e36aed14-9eed-4435-ad86-9df696e90057", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7a613a21-06d9-4458-9136-523bc39f1064", "dd10064c-5e93-4914-b41c-25ca8c974e98", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7ad3ca13-1d78-498d-ba59-2cdbdc163c20", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08 13:53:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7b064fb6-853a-4b04-96b8-f5a9650bcd7a", "dd10064c-5e93-4914-b41c-25ca8c974e98", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7b61f64d-2374-475a-bbaf-29655f39e5bc", "dd10064c-5e93-4914-b41c-25ca8c974e98", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7b6ec3dd-dac7-4c8b-8281-14e4c178b3eb", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7b9b439b-42bd-4ee4-b43c-b34749b8bdce", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7bce4aac-7747-4937-ad3f-8bd47e5372b8", "dd10064c-5e93-4914-b41c-25ca8c974e98", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7bf217e7-a7db-4a71-94d3-0fe2ed3552e8", "e36aed14-9eed-4435-ad86-9df696e90057", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c61a663-4042-4fb3-ba33-5ff889953159", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c6e00d7-6d0a-4d83-bcdc-e893261cf4de", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c72eeca-f0c8-49fd-ae41-a0b77d1cf480", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c7b6dac-f7e5-4fd7-9602-2093b9a68fb4", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7c81f5b9-ff91-4141-8a82-c307c5a9fb3a", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7cbd8194-f4da-4db1-adac-191a90a81752", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7d588f6b-8264-4840-b44f-8a9e847dae4d", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:52:43", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7db7326b-9da4-4f20-8a60-90fa9dda898c", "dd10064c-5e93-4914-b41c-25ca8c974e98", "868afde4-08e8-4899-b596-301c1bae2258", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7e9702c8-fd0f-4b72-8c4a-e85f287fe5b9", "6a954648-6b0b-4db0-88f2-7446218b85f5", "55df0fd0-271f-47ad-9e6f-f32cc2005d40", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-10 18:54:26", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-10 18:54:25");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7ee821d3-b7aa-4dd0-8612-ccf376f8d265", "e36aed14-9eed-4435-ad86-9df696e90057", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7f1f6325-eda3-429f-8377-d2b1beff6a2a", "f7f8d89c-be4c-424e-a292-78529889491b", "123f022c-72ae-401b-9144-624dad3a906a", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:36", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:36");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7fa37b08-4a56-4c46-bc9a-594fa5155328", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7fb5b776-3c14-4a35-9e24-258c74a5b7b7", "77efc382-0004-4d48-9605-9ab954aaca94", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7fcdd090-1d69-443b-a1f2-8df150d286a7", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7fcf2f95-ce8b-43f9-aa37-fa64bf18e7f6", "e36aed14-9eed-4435-ad86-9df696e90057", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7fdd4834-339d-4245-ab71-86b7be3bce29", "e36aed14-9eed-4435-ad86-9df696e90057", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "801287fb-88de-4bfe-bc14-af11be08bf7a", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f71515e5-57b8-41de-9c49-5e494c497563", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "80209a4d-6a5c-4c61-a0b1-9c1c690e4583", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "802329d8-f818-4043-9ac7-7cdd0c8dd8d6", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "803056ef-e8cc-4746-9977-a6143e60911d", "0aa69419-0083-4a58-8557-3781a4944b05", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "80390789-56e0-4ec7-949f-68ab2318411f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "80397389-ec23-415c-bb35-e448eee62431", "dd10064c-5e93-4914-b41c-25ca8c974e98", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8047e104-7924-46ef-a34e-6917100e1b4b", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "81194483-bcc8-4e39-81aa-956679044464", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8186d121-b6b8-4a9a-9cf8-8809f96e2b15", "6a954648-6b0b-4db0-88f2-7446218b85f5", "04fb4f1f-0728-46cf-8a81-4b951687b44c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-02 11:24:05", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-02 11:23:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8197206c-dedb-4e0d-9faa-c3f8c1dbbdd5", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "81a2debb-d778-4cb1-9cf2-47133e9a26ef", "dd10064c-5e93-4914-b41c-25ca8c974e98", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "81f68156-5c51-4698-a6db-a3537f41a2a3", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:49");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "82001bcf-7dbc-48cd-9f4f-fb85fc6574e7", "f7f8d89c-be4c-424e-a292-78529889491b", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:33", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "821a786a-f8e5-4469-adc5-a87a928465f8", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "822560b8-03c2-4253-8d24-2d61c750cc1c", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "82320ac8-4284-483c-9f98-0f7fdd22f8c2", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "28f66f08-643f-4808-9eca-956a43889705", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:13", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:18");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "823bc4f4-cb0c-4ba4-ab7d-75748cc7ff5f", "0aa69419-0083-4a58-8557-3781a4944b05", "123f022c-72ae-401b-9144-624dad3a906a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "823db3aa-ee08-46fa-8f9d-b29414425f39", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "82608f0a-1dc1-499a-a963-1f4b10405998", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "82910b7f-49f4-4cba-bc40-832eb8eb3995", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "eeb5b08f-596b-4966-8649-f3f119325a67", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "82c1f478-e82b-46af-99da-ae0553c68092", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "82d5ccd8-6d6a-4e1e-9a85-9a18a0272399", "e36aed14-9eed-4435-ad86-9df696e90057", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "832cfe22-22de-431f-9e01-e74714625523", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "834151cd-7bf0-49e0-acf8-33705336fe41", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8358c956-bc8d-4485-9416-56ebadfc11c7", "6a954648-6b0b-4db0-88f2-7446218b85f5", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8383a341-5167-4c0e-900d-29a104b35c0e", "e36aed14-9eed-4435-ad86-9df696e90057", "28f66f08-643f-4808-9eca-956a43889705", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:18", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:18");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8391243e-a19f-407e-a11d-134416948f01", "dd10064c-5e93-4914-b41c-25ca8c974e98", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "83b42755-0ce8-466d-87e8-704197eafe5f", "8a0e87d7-905f-4991-a260-fbb6bf294f9f", "d7ca1a2b-e684-4b50-824d-50540afaa994", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-17 15:24:01", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-17 15:24:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8418a2c8-937e-484f-96d0-a532627326fb", "6a954648-6b0b-4db0-88f2-7446218b85f5", "825a61cb-a0ba-4e96-8dd8-6a93bc938ec2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-03 15:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-03 15:38:44");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "841f151c-3d58-40ec-bcab-84a1caff930f", "64502c81-163a-4ded-a7c9-3136024d26d8", "28f66f08-643f-4808-9eca-956a43889705", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:13", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8446db1f-8022-493b-8ac2-7179e2602b5c", "dd10064c-5e93-4914-b41c-25ca8c974e98", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "845ec93e-9dfe-46fc-a29c-8be7b434fc83", "6a954648-6b0b-4db0-88f2-7446218b85f5", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "849366bb-a3d0-415c-8416-8890ea6f1ecf", "6a954648-6b0b-4db0-88f2-7446218b85f5", "951544df-6ad1-482d-89e0-4bd3d348e215", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:42:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "849704bd-07f7-4ebe-a41d-699f5f0ec5bc", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:52");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "84d82eb8-cc4e-412c-b17b-02da6d8c492d", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "84dfe3a5-0c32-4a85-b09f-73cd7d42e4df", "64502c81-163a-4ded-a7c9-3136024d26d8", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:21:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "85157dcd-8033-40ce-bd49-b1d148226c6d", "64502c81-163a-4ded-a7c9-3136024d26d8", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "853b28e0-aed6-4296-931f-44e81260d469", "e36aed14-9eed-4435-ad86-9df696e90057", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8572df4c-eb5f-4181-b3c9-0164f7aad64d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "858400ff-195d-4543-92eb-c0567b7067f4", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "86441c65-8247-443d-8d69-73e6ef3a4710", "e36aed14-9eed-4435-ad86-9df696e90057", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8676c319-38af-4f59-9887-892045f77f99", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "266bd8f2-8e09-404b-985e-0196c14218fa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "869456be-2de1-406e-b0c3-9af818a2692f", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "869e20c6-61d6-4609-ad2c-04737558522f", "64502c81-163a-4ded-a7c9-3136024d26d8", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "86a0ed9b-3ad7-4c6e-8357-96497545fa67", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c7e5c5cc-ce6d-4c2e-a05e-bf4e2bd9df41", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-14 10:01:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-14 10:01:16");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "86af7d56-16eb-4e88-b7e7-971a7fec98ab", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8702a049-aad1-4003-845f-307de3fdc920", "e36aed14-9eed-4435-ad86-9df696e90057", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "87376c2b-98ba-4754-8c60-0e21b9a1f17a", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "87fdef47-9048-4798-93dc-535a979dd694", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "882307f2-45c9-49fb-a293-ef0419f512a3", "6a954648-6b0b-4db0-88f2-7446218b85f5", "445c4e53-96b5-4f04-b7d9-60cc6ae88fe1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-12 14:16:04", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-12 14:16:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8824f827-1975-4be2-ae90-a3215d1868f7", "e36aed14-9eed-4435-ad86-9df696e90057", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "883556a1-db68-4182-9007-fd636284a7b4", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "884056f2-f3bc-4996-a5eb-7f453f78e41e", "dd10064c-5e93-4914-b41c-25ca8c974e98", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "88b94db5-1afd-4579-b800-ce6587acace7", "64502c81-163a-4ded-a7c9-3136024d26d8", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "88fe0d0e-18c6-418b-aefb-e83e2a69ebf7", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "43aff7d4-245c-4e5c-8433-cf173ca745fb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:54:24", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:54:24");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "890708da-3998-445f-b9a1-bcac282755a4", "77efc382-0004-4d48-9605-9ab954aaca94", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89093d23-c020-4466-b02b-2815d94940b7", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "890e026f-17ce-4954-b48a-7edda0343c9e", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-13 23:30:57", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:52");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89a56b18-2b8a-48bf-89de-8be38bd3f234", "77efc382-0004-4d48-9605-9ab954aaca94", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89d4da5b-50b8-42d3-95ac-2a7351107225", "dd10064c-5e93-4914-b41c-25ca8c974e98", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89e1bd75-fced-4623-bce7-23577b6dc0ef", "0aa69419-0083-4a58-8557-3781a4944b05", "df495870-8f19-41a1-943e-5d36ea0553db", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "89feb6f9-697f-432a-b34c-656c08126366", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8ac23f4d-a220-4f99-a111-0b7f9ebda576", "b121aaba-f544-4827-9fc6-e22602559a77", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:36", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:36");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b1d0edd-4ac4-46f8-aefc-5295d3415c00", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b204911-2463-43de-a486-2a76a65b6277", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b340866-896b-4b5b-be77-fd37be6b6f98", "e36aed14-9eed-4435-ad86-9df696e90057", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b8e8cdb-b58d-466b-9b7d-8df15525f9a1", "dd10064c-5e93-4914-b41c-25ca8c974e98", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b91787b-ab0e-4609-96de-db37754a4e2d", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8b98d03f-1d67-41bf-9822-5a6973402664", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:48");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8ba382b2-179d-4208-9419-b91e12031393", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:52:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8baed8b7-68d9-406c-abb8-8606d43ce662", "f7f8d89c-be4c-424e-a292-78529889491b", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:44");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8bb2e0fe-edf9-4f9c-873a-41916675aa2a", "77efc382-0004-4d48-9605-9ab954aaca94", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("a4633f72-4d67-4f65-a050-9f6240704151", "8bda10af-a907-4494-a21c-eb2d8f8220c1", "f932eed5-c9f9-49fa-a635-a73f7e1461ec", "9a1cc085-6cc0-40ee-85fc-849357638db3", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:12", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:12");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8c040fb3-7886-4b3e-b749-b7b13f9c7c0b", "dd10064c-5e93-4914-b41c-25ca8c974e98", "73917c12-47af-4672-b57a-45b8cffb8e4e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8ca844a9-19ee-435c-8bf4-c65bc5c22b89", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:06", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8cbf09c4-0418-420b-b6e5-50725d3253d0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "7111d133-d00a-4eda-8094-8bcceb227664", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 09:53:54", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 09:53:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8d21a61e-7944-4a8e-bc0c-742750e19906", "dd10064c-5e93-4914-b41c-25ca8c974e98", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8d8ff610-fa38-4999-8324-9ca2582519b6", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8e004fdc-7fc5-46a7-9dc7-ac24fbb9db73", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8e582ac3-80f5-4316-b57f-fe196197f9af", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8f22b0f3-d25a-4e7e-80c1-174def92e198", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8f28b3c9-58ef-482b-bbf3-b5ec74a13b8b", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f9e7f495-3ac1-4e07-99cc-14160791c745", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-22 09:50:31", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-22 09:50:30");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8f30bf18-6b60-48fd-b806-ac8977f3bdd6", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "123f022c-72ae-401b-9144-624dad3a906a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8fc0d126-7722-4a35-8e63-8faba56be9e9", "6a954648-6b0b-4db0-88f2-7446218b85f5", "43aff7d4-245c-4e5c-8433-cf173ca745fb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-31 15:07:27", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-31 15:07:25");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8fcd1693-9840-4651-ad88-254c1be6058b", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "90c3f612-3d93-49a8-96c3-e617d451e1e9", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "90d0ccf5-2eea-46cb-b5c9-a0fee92e3ec8", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "90ec4424-5dcf-4e5e-b448-7d67dcac3766", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "91022b9d-9374-4647-a1d1-152ec7cabb4a", "64502c81-163a-4ded-a7c9-3136024d26d8", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "91034cb4-831b-473e-ae1d-f3a7bf7f3280", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "91a8bd87-cdc9-43dd-8c69-b11994f0c6a8", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:24");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "91cb2e00-f81b-4f32-91bd-142270e1c971", "e36aed14-9eed-4435-ad86-9df696e90057", "b56ff379-5619-4064-b572-407671edc15e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9272806e-726d-4de5-b56d-b627d0423686", "dd10064c-5e93-4914-b41c-25ca8c974e98", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "92764384-3c98-4eba-9b01-4650a2b67750", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "932010d5-ed0f-4a60-8ccf-ea58da44af22", "0aa69419-0083-4a58-8557-3781a4944b05", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "933ba4e4-26cf-4280-8166-5c715b648c05", "dd10064c-5e93-4914-b41c-25ca8c974e98", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "93584678-f486-44a1-84ed-6160f4a61243", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "93b0d596-97f1-41a2-8557-25078030aebe", "8d352c1b-505a-4dd2-82c3-9b7c4b171819", "a894d7ed-a10e-4359-804e-8223fde34bbd", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:10", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "940846ba-94a1-4d88-87b3-65d86dbac054", "6a954648-6b0b-4db0-88f2-7446218b85f5", "cded1e6e-e203-4dda-ae26-a0c8b30d9f2e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-21 22:51:37", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-21 22:51:37");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "947e2fb5-488f-42fb-a520-f7b1568901c2", "64502c81-163a-4ded-a7c9-3136024d26d8", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:36", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:36");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "94993be2-461f-4efa-8d0a-1045163ee1a1", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "94cbadd9-b61d-4ea8-a88c-af56632c849d", "dd10064c-5e93-4914-b41c-25ca8c974e98", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "94f06ccc-c248-4f59-846b-2b43ce0caa83", "64502c81-163a-4ded-a7c9-3136024d26d8", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "954700c6-f853-4d06-b3da-386e58d21064", "64502c81-163a-4ded-a7c9-3136024d26d8", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9563c627-42aa-4813-bfb5-6ec50c49cbcf", "dd10064c-5e93-4914-b41c-25ca8c974e98", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "95b1838f-e3c3-4707-9a19-aa5673055d5f", "f7f8d89c-be4c-424e-a292-78529889491b", "e68bda4d-9e9f-4a89-bd23-ca80983eca32", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9625895e-7cfa-4e93-9974-3bad29be3b97", "6a954648-6b0b-4db0-88f2-7446218b85f5", "084bfaa9-8dda-4c7f-a54e-882496b77866", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-08 13:42:38", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-08 13:42:37");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "96817ae1-1940-4c34-8ae7-64b631503373", "64502c81-163a-4ded-a7c9-3136024d26d8", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("a4633f72-4d67-4f65-a050-9f6240704151", "96d9d401-d9af-43c4-9cb0-4ac3e394b39c", "f932eed5-c9f9-49fa-a635-a73f7e1461ec", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:01", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "96faa7f0-e548-494f-8bb8-19daebc5a152", "8d352c1b-505a-4dd2-82c3-9b7c4b171819", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:00", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "978f6993-30f6-4e2d-8b43-1d47da7f428f", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "49e22574-cb55-450f-9d47-6b895b2caed3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "97ed767e-bcb6-4449-b920-dcfb7c59defb", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-08-03 09:28:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "980f5a72-b238-4ce4-b812-bc29f3a036bb", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98207d80-06ad-4a7e-a332-aaee6cbed7dd", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9825a9fb-c69e-4692-b019-8110cf2951b0", "116b3436-bce6-487e-817d-ec9e793e41ba", "d00ef65d-9af6-405c-a8ef-b5e3dc312416", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:47:26", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:51:31");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98302201-1548-429d-bca9-41be3973c673", "64502c81-163a-4ded-a7c9-3136024d26d8", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98783853-4767-4e21-8bdd-2f7f86980a52", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "39425516-e7b9-42f9-b23b-02bf04bae967", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "987e11d3-2f20-428b-bc93-b784fd6a5331", "0aa69419-0083-4a58-8557-3781a4944b05", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98d21053-9c0c-47a8-a012-a917a744b690", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f9afc38a-bb61-4f98-b593-211766ec6133", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 13:32:54", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "98f01f27-8602-44a9-b72c-46543e17a616", "6a954648-6b0b-4db0-88f2-7446218b85f5", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9978e3cd-4e86-4fc3-a4ec-226bb62df3c7", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "998ea5b5-b782-4756-82b8-2cd013384e42", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "99b3ab4f-8a44-4d2a-9c92-bec6c079ca21", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9aa5e187-a2ca-4293-b758-4a79e24fc91d", "6a954648-6b0b-4db0-88f2-7446218b85f5", "71dfb7c2-4abf-4f93-b989-7d78f255a074", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 16:00:46", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9ad62dd6-6d45-492e-972b-501ca0cbf702", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9b5bef63-a790-461e-bb4f-ec0ec239e89e", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9ba42e7b-8ff3-4987-b459-af1aaf752063", "0aa69419-0083-4a58-8557-3781a4944b05", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9bddc681-1eea-42ae-ac01-693ebc8c568b", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9c2bd381-c028-4e9e-a085-53bd23f5567d", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9c7f739e-a912-4986-9d0a-404c24889551", "e36aed14-9eed-4435-ad86-9df696e90057", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9d130203-dab1-412f-b68a-7893a66a2b7d", "dd10064c-5e93-4914-b41c-25ca8c974e98", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9d33708d-a93a-4aca-ac7b-a436a38ec10a", "dd10064c-5e93-4914-b41c-25ca8c974e98", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9d3b4773-9eb5-41f6-84e0-aa1bdcc75e99", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9d3d4ca1-b6c2-493f-a0f9-7c746fc7f47f", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9d6cbd4b-a02c-440f-bbff-cd45255208cf", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9da39fce-0ab2-4567-b69e-264955bf76b9", "6a954648-6b0b-4db0-88f2-7446218b85f5", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9da57bba-b7e6-4b3b-a36a-48c8484e92b9", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9df63353-4278-4dd1-96bf-882779757565", "79dd5083-f76f-41e5-8c60-bb1a318f229b", "4610c39b-de32-450b-812d-db8c37fcc643", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:15:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:15:56");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9eaaccf0-7036-4ad1-a9a5-35c6d4353717", "6a954648-6b0b-4db0-88f2-7446218b85f5", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9eb13056-cc4a-4ee2-a8be-898f099c32b7", "6a954648-6b0b-4db0-88f2-7446218b85f5", "123f022c-72ae-401b-9144-624dad3a906a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9f3a5837-09d4-40bb-91c0-78e579dbe04c", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "9ffcbd61-29f6-439e-ad1c-ebd3be7b9bcd", "6a954648-6b0b-4db0-88f2-7446218b85f5", "bacde412-a651-4c8c-8237-155b39a4595b", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a045e44c-a31e-4513-ac7b-e05f78e898b4", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a052244e-8536-4a1a-8ccf-b56d23135902", "6a954648-6b0b-4db0-88f2-7446218b85f5", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a089ebac-2573-49f1-9278-779a931a8b3d", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:08:25", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a0e91bd4-00bc-4458-bd79-199aee7dc9d4", "dd10064c-5e93-4914-b41c-25ca8c974e98", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a0fe88e1-0b77-4853-a3df-44b3c5aa19c3", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a12c534f-2b11-4f5d-b8a4-daf75f495610", "0aa69419-0083-4a58-8557-3781a4944b05", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a16be0a3-4c23-4a6d-be13-006a77ff3409", "dd10064c-5e93-4914-b41c-25ca8c974e98", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2157b58-1789-44d9-b83e-f0b4f73063fe", "e36aed14-9eed-4435-ad86-9df696e90057", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a21a983f-5c39-49e9-a97a-fc9b360b0bb2", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a23bab19-affd-40de-b0ab-4e076acf6a60", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "a2631fed-0963-44f2-9305-ed70abdb0820", "8d352c1b-505a-4dd2-82c3-9b7c4b171819", "9a1cc085-6cc0-40ee-85fc-849357638db3", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:12", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:12");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2a84a47-42d5-4ed4-9ce4-f8a05621172e", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2a914f3-2e46-4d94-9fe8-4c72d5d5d122", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2cf5977-9193-4ea1-9b8e-e6d518b50038", "77efc382-0004-4d48-9605-9ab954aaca94", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2d40ad4-54e7-4b1a-bf54-538e80819028", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a2fd9050-eef0-4593-be6b-7093b19751f3", "0aa69419-0083-4a58-8557-3781a4944b05", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a326f89b-f44a-453d-b88e-c2ffb3cb40ba", "6a954648-6b0b-4db0-88f2-7446218b85f5", "38eab206-952d-4f00-8ef6-f683526ebd9e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 09:53:53", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 09:53:52");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a365327d-0619-4235-b589-3812e5de2d9c", "0aa69419-0083-4a58-8557-3781a4944b05", "351be4d9-c967-4d44-a1e6-171a98eec8cc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a3681d8f-9abd-4f4f-b6e6-9ec337b37dda", "77efc382-0004-4d48-9605-9ab954aaca94", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a3bc6326-c37f-4641-a94e-48f6d3b992b1", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a3dda9fa-7544-4b50-8ea6-14111b57bb2e", "e36aed14-9eed-4435-ad86-9df696e90057", "123f022c-72ae-401b-9144-624dad3a906a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a3fac999-2645-43e4-98b8-a9e7d948715f", "e36aed14-9eed-4435-ad86-9df696e90057", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a530d9dd-4b1a-4a44-aa54-21f6299006ea", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a53aab7b-5915-4808-b998-2e4d7742d9a6", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a55b00a5-8ba1-4450-9678-4ed187cf867f", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a56fc823-23f2-4e21-81cc-5b9e0674a328", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a5cbc8a2-d5f6-40c7-9162-a2446a75a717", "e36aed14-9eed-4435-ad86-9df696e90057", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a62f3c89-e543-4c57-8068-03d8e3a07cff", "64502c81-163a-4ded-a7c9-3136024d26d8", "4610c39b-de32-450b-812d-db8c37fcc643", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a63aa45d-c5e2-4e48-895d-2698cfd968a3", "64502c81-163a-4ded-a7c9-3136024d26d8", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a6485677-eff9-4129-9639-0f34d1401b66", "64502c81-163a-4ded-a7c9-3136024d26d8", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a6591a75-932e-4071-b8ff-c34ab19e4f3e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d00ef65d-9af6-405c-a8ef-b5e3dc312416", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-12 15:38:44", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-12 15:38:44");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a678e343-8f8e-4add-b228-b585e389bbf6", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a6b6787b-22ad-43d0-a595-e523c67cd8bc", "77efc382-0004-4d48-9605-9ab954aaca94", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a6b976cc-e5e4-482c-a2ab-7645036743fe", "0aa69419-0083-4a58-8557-3781a4944b05", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a6cbeee6-8d88-4595-9d93-172200f042a5", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a6d21301-9007-4edb-a3bf-fe5e126e5ff6", "64502c81-163a-4ded-a7c9-3136024d26d8", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a7431997-4397-4528-ac76-a8a494859d7b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a7b6e615-9d01-4448-8b86-d0e851c90fd6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a87ad24b-cfba-4bb2-a358-b753e69ef90c", "dd10064c-5e93-4914-b41c-25ca8c974e98", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a88af91b-c969-422f-9be5-43ade9a5df1f", "64502c81-163a-4ded-a7c9-3136024d26d8", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a92e983a-a59d-47bd-bfc5-c9c29a93ac75", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a9583911-70c8-4150-b24f-d2d99bc9a0aa", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "868afde4-08e8-4899-b596-301c1bae2258", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a9acdefe-35c6-47f7-b444-3f7ee7a6b972", "6a954648-6b0b-4db0-88f2-7446218b85f5", "", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-27 21:52:47", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-27 21:52:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "aa159d1c-37b0-4c01-9e68-391e02b6eb17", "77efc382-0004-4d48-9605-9ab954aaca94", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "aa2e0349-877e-45cc-9e37-55bebfa520a8", "64502c81-163a-4ded-a7c9-3136024d26d8", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ab196edb-58f8-4aac-b178-0f86d3f6fb99", "0aa69419-0083-4a58-8557-3781a4944b05", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ab71c216-1beb-48d6-9e22-d797a7f637ea", "6a954648-6b0b-4db0-88f2-7446218b85f5", "186c47fa-906d-410d-b41c-355eb52e7d10", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-14 21:44:19", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-14 21:44:19");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "abb7aa01-bc49-460b-a3ae-3fc356c4c0e9", "e36aed14-9eed-4435-ad86-9df696e90057", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac59edd5-aa1e-4a0f-a553-a5bee9945bf8", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:49");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac96541d-4c54-41e6-8b8e-e059680a42ea", "0aa69419-0083-4a58-8557-3781a4944b05", "39425516-e7b9-42f9-b23b-02bf04bae967", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "acde5445-de1b-48b0-acb5-cc42e06cbbc0", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:24");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "acf6fb51-b2a9-4bad-bb96-14cc58167ce5", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ad9264ff-e8e5-4be5-b94f-9db6d4c88778", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "f9afc38a-bb61-4f98-b593-211766ec6133", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-25 23:22:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "adcfc63d-5aca-412d-8f39-13f59c99845b", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ade07b18-c84c-403f-aaa4-10b91f8cc7ae", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae3c1cb5-0750-4538-adf6-d4792164d20e", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae4d6aca-f34e-403d-9900-940c6ecce903", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae501e57-63fd-436c-a0df-c966acc1ab24", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae88e5f8-2a1c-4a90-8993-8e858a63284e", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "df495870-8f19-41a1-943e-5d36ea0553db", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ae92a183-eb31-496d-a082-562b4559ed55", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "aef494fb-bc7c-4de3-b23c-1775237ceddc", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "af0b658e-86b8-49c5-8a4e-15b5cd154f2c", "e36aed14-9eed-4435-ad86-9df696e90057", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "af21f6d6-d87b-429c-8706-069b27798d0d", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "af5a85ae-72ae-4a2b-a7cc-59de6bc3d46c", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "e68bda4d-9e9f-4a89-bd23-ca80983eca32", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:16", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:19");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "af78f428-b7bb-4a74-9a00-1fd7e37f3c25", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "af918bc1-db5a-438d-89ff-5e55056d1be8", "e0dbcb16-a471-478c-8699-8fa92f84bc67", "266bd8f2-8e09-404b-985e-0196c14218fa", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 09:18:18", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 09:18:18");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b0d54c29-5cf9-4000-a555-695877461fb1", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "b56ff379-5619-4064-b572-407671edc15e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b0f7a3de-2c5e-4ca1-a554-d010e2bb3e25", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b1137505-f149-4f5b-85bb-17886b0c88d1", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b11ff0b6-3abb-4bce-9f20-c2782d839555", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b12b9174-78e1-4ea0-9c70-74f05147c2ed", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:49");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b1b8c407-5b91-48ad-b26e-5167101730da", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b1f74dea-a6c9-4884-8791-92933edbfb16", "0aa69419-0083-4a58-8557-3781a4944b05", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b24ed00d-29c3-40e6-8e2f-07541f9e2cc0", "0aa69419-0083-4a58-8557-3781a4944b05", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b267da2e-524f-4de7-aa10-35bce3c56583", "0aa69419-0083-4a58-8557-3781a4944b05", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b2cc9727-1a47-4337-a2cf-fcef014a7946", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b2ef125d-5c92-4117-8756-82da688711c9", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "28f66f08-643f-4808-9eca-956a43889705", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:02:34", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:02:34");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b304c82a-aedd-47f5-a226-a26f1c58c7d0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b30e6fd6-2be6-4156-aae8-fa3cfa0e6e9f", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b31a79c6-b45a-497a-89b6-be747bff5322", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:34", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:34");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b3441353-afb9-4e36-85bd-449ee93d8ecb", "64502c81-163a-4ded-a7c9-3136024d26d8", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b37ebe81-993e-4d82-bf92-0a4b79b09b6e", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b390b101-378a-4651-98e0-a4f4c04d9c37", "dd10064c-5e93-4914-b41c-25ca8c974e98", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b3992857-0304-4afb-810d-914e2fab340d", "0aa69419-0083-4a58-8557-3781a4944b05", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b3f7183a-c6e6-4220-8e49-536a69997a2f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "a3e946b9-29c1-4263-a911-87bc6eba561e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-23 21:48:26", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-04-23 21:48:26");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b40eb60b-7a70-40e2-b4d4-aa7232e4f051", "77efc382-0004-4d48-9605-9ab954aaca94", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b4b54c0c-495b-44b5-be10-97a27c50fa9a", "64502c81-163a-4ded-a7c9-3136024d26d8", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b4e233d5-2665-4254-a982-7d0d510abf2a", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b4f5ce28-210d-413a-8419-2a3e5817b638", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:48");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b5ade0d7-e102-40b1-8921-1181436ff811", "e36aed14-9eed-4435-ad86-9df696e90057", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b5e34d1b-fd70-4e4e-87c0-6803bb21361b", "77efc382-0004-4d48-9605-9ab954aaca94", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b5e8f4c9-7ed0-494c-ad66-acd66fcd140b", "e36aed14-9eed-4435-ad86-9df696e90057", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b5f24265-2a73-4f5f-a108-d89312327438", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b61a32c8-1d68-4925-be5d-913b66e271c8", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "b56ff379-5619-4064-b572-407671edc15e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b73218b6-304f-4946-a62e-c758e9a5cdc0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c820e1c6-18d9-4ab1-9fc1-df6e57a6f484", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-08 13:40:10", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-08 13:40:09");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b744815a-2ae2-4d23-8b34-6940a5ff6f2a", "0aa69419-0083-4a58-8557-3781a4944b05", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b7694941-eb01-4007-ab14-12c03949a101", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b7f5d21c-b1ec-4977-8efb-73089825f6d0", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b82fa907-2ab0-431a-abc1-7979ee9cf969", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b8764207-31b0-40f6-b091-bdd6dacd0061", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b8c39e46-d08a-4930-8325-1ad60e76ca25", "79dd5083-f76f-41e5-8c60-bb1a318f229b", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:21:37", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:21:37");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b8c7ab5e-68ad-4e30-8f7a-cd7debe4c8a9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b973389a-d160-4ab6-9a58-937869e1df6d", "0aa69419-0083-4a58-8557-3781a4944b05", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b9b77023-76e5-49ab-82d8-d6a1c533c596", "6a954648-6b0b-4db0-88f2-7446218b85f5", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b9c3b8d7-9ae0-4afb-8baf-4bcc63c05e0a", "77efc382-0004-4d48-9605-9ab954aaca94", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b9e09923-8a24-43c9-95e7-ffd4cc1748c5", "b121aaba-f544-4827-9fc6-e22602559a77", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:09", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:31");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bae99fa6-bd9e-4b6d-89e8-e74e6c90369c", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bafc65cc-a879-4c1c-b640-5b79bebe902f", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb2dd729-e40b-4175-b478-d20bc31aae71", "dd10064c-5e93-4914-b41c-25ca8c974e98", "123f022c-72ae-401b-9144-624dad3a906a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb3c59c5-62b7-4f22-8fef-6ec88d73fe1e", "e36aed14-9eed-4435-ad86-9df696e90057", "df495870-8f19-41a1-943e-5d36ea0553db", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb64a4fc-5dd1-40f1-8f51-1ddb10f344fd", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb722e77-78fa-4bd8-bf59-812823b7b8d3", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bb86f78d-f7a3-481a-af74-cbe0342ee429", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bba5d704-0ac7-4e5e-a949-303f753be057", "0aa69419-0083-4a58-8557-3781a4944b05", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bbcb21e8-6cf6-4b92-a25b-6ea80454e0bd", "f7f8d89c-be4c-424e-a292-78529889491b", "825a61cb-a0ba-4e96-8dd8-6a93bc938ec2", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:25", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:25");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bbcf9430-1169-4b06-9aea-a9ddd1b04b79", "dd10064c-5e93-4914-b41c-25ca8c974e98", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bc12e3d8-8892-41c0-a692-e5434e46b830", "e36aed14-9eed-4435-ad86-9df696e90057", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bc59b4c1-02ac-4d8c-a9ff-b95ad480c804", "77efc382-0004-4d48-9605-9ab954aaca94", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bc7ee89e-22b9-420b-93cb-c2100ef331b8", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:53:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:53:56");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bc829fc2-d164-4bb4-b078-f048d8a57985", "64502c81-163a-4ded-a7c9-3136024d26d8", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bca64b24-c47e-46bd-a829-cb265d44da33", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bcb63e07-3ce0-42d9-b32e-f8b9aac86751", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bd1cd27f-66a4-460c-b8ca-34d2f21c83ae", "6a954648-6b0b-4db0-88f2-7446218b85f5", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-25 23:22:38", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bd674a19-82ee-4675-94dc-3ec928e7f8d2", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bd894681-4f9e-4dcd-9012-08a7f6174958", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bd95cd18-ccc7-4aea-9916-a3f0abe601ff", "77efc382-0004-4d48-9605-9ab954aaca94", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bdae92a1-3c3a-4a89-a82a-6317a5781726", "0aa69419-0083-4a58-8557-3781a4944b05", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bdd55273-3abd-4a6c-b42e-d219b94a5cbb", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "be0c88ce-37ca-432c-b812-0a8a23e8c2fc", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bea75a87-22cd-4e1e-bbf4-682248b84b5f", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "beafdbf4-c6b7-48f7-8a0c-d3bf030a947f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f71515e5-57b8-41de-9c49-5e494c497563", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bed37faf-6797-44e7-b7ce-16d394e76390", "77efc382-0004-4d48-9605-9ab954aaca94", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bee00e12-52e7-4681-a30f-8ac19489c829", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf53d228-c4b2-4b05-9c12-7f618494fcf5", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf626fa1-d796-4dcd-abb1-0bd459b9671c", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf79f917-572c-4891-910b-6cfdee58e6a1", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bf990b03-77cc-42f7-9bc5-b6083bef130d", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "ff61f738-5cd8-49f9-9005-7236fdefdc6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bfc47039-f2a7-4c2b-8230-3bbb91624b34", "dd10064c-5e93-4914-b41c-25ca8c974e98", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "bfdf52f3-9814-4d8b-9624-6b12d064c43e", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c024b389-6991-4a7e-ae3f-82d83917a3d2", "6a954648-6b0b-4db0-88f2-7446218b85f5", "67075482-7943-4031-bb64-bd22997e5b3e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-07 16:07:08", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-07 16:07:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c029e021-eaba-43d8-9114-076ab55df3fe", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c032c5f3-fa2a-4eed-849f-d41c152a09ed", "77efc382-0004-4d48-9605-9ab954aaca94", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1606d9d-6330-420e-a452-439b68b317b5", "64502c81-163a-4ded-a7c9-3136024d26d8", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1b869bf-2a6c-4473-8b02-cd55d1fb78dc", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1c74841-8125-4d78-a839-54ea954b44dd", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c1fee360-5f44-4d0f-ae83-261438c850b7", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c21de226-e5c2-4577-af95-7b4442f54267", "64502c81-163a-4ded-a7c9-3136024d26d8", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c268836e-9f05-4c32-bf78-b8c0c63552dc", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:48");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c2ac28de-3294-4230-aa8b-2e0976e88036", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c2c580ce-4183-41b2-a813-e9f0d15e6ae7", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c36090e9-e09f-46e8-8661-58ff75a13452", "6a954648-6b0b-4db0-88f2-7446218b85f5", "", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-27 22:13:12", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-27 22:13:12");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c39b55ad-6be8-467b-95ff-ec582724b92a", "b121aaba-f544-4827-9fc6-e22602559a77", "687b3adc-f1ad-4849-8bef-ee2121faddcc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:38", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:38");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c3d5ef3a-a672-43d0-bb8d-c0c9480f88d2", "6a954648-6b0b-4db0-88f2-7446218b85f5", "77893ebe-697b-4a04-a158-5387c98a0041", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-06 09:47:18", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-06 09:47:18");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c4109229-9841-4f78-b238-003b9d2a8f43", "64502c81-163a-4ded-a7c9-3136024d26d8", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c45057e6-ca02-47b4-aa98-4dbf68124d6a", "6a954648-6b0b-4db0-88f2-7446218b85f5", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c474bb45-7269-49e3-8b0a-b20200c630c9", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c477059c-d2d1-4108-b1e6-44959e1eefc9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:49");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c47dee77-0f09-43a4-a264-072d9b58703b", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c4921f90-c380-4053-bf6b-e2de316789a6", "77efc382-0004-4d48-9605-9ab954aaca94", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c4ecb378-770c-42bd-a97c-e64cfdbb7e6b", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c50d9524-cca6-466a-88da-37d3c5b0877a", "0aa69419-0083-4a58-8557-3781a4944b05", "71dfb7c2-4abf-4f93-b989-7d78f255a074", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c5a9119d-b99b-4308-9c71-bb519ff75243", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "b56ff379-5619-4064-b572-407671edc15e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c5ca2ba6-5581-4801-8f1b-a01c2d61e39a", "64502c81-163a-4ded-a7c9-3136024d26d8", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c5e77a17-b3ab-47b3-856b-4d172bc7bf1c", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c5fa7016-0915-4ba7-ae15-a2ac6b1952d2", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "df495870-8f19-41a1-943e-5d36ea0553db", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:52:46", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c648d19a-47ba-46a6-9bfa-a845fab1fda4", "0aa69419-0083-4a58-8557-3781a4944b05", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c660931b-03be-4cc6-bb4e-4e754aa6f3a1", "77efc382-0004-4d48-9605-9ab954aaca94", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c6d891ad-6237-4d37-a8c5-21d3e95dea19", "dd10064c-5e93-4914-b41c-25ca8c974e98", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c753338b-fc76-4f0b-9735-8170e201e8f8", "f7f8d89c-be4c-424e-a292-78529889491b", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:53", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c789d059-e07e-4429-a83e-2ebe1f285500", "0aa69419-0083-4a58-8557-3781a4944b05", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c7adaa42-de9e-4a9b-9f05-74a819c2dfad", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "a894d7ed-a10e-4359-804e-8223fde34bbd", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c7b5b8a2-6c33-4a5f-80a2-6915bb047bc7", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c7f90336-cec3-420d-aa64-ac9e2c1fba2d", "dd10064c-5e93-4914-b41c-25ca8c974e98", "f9afc38a-bb61-4f98-b593-211766ec6133", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c88d7b7b-0628-4f4c-b204-93a59b2e41b4", "0aa69419-0083-4a58-8557-3781a4944b05", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c9058f7e-d217-443a-b0b3-573a07614cbf", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c91eb9d3-e49f-4d63-a31c-d4a77e376213", "64502c81-163a-4ded-a7c9-3136024d26d8", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:21:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c93a788e-301a-448b-999a-7d085c2c28fd", "77efc382-0004-4d48-9605-9ab954aaca94", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c95e588e-e63b-4847-920c-b4f49447ac4f", "e36aed14-9eed-4435-ad86-9df696e90057", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c9ed8e30-485f-4c4d-a124-07ca014c8d8d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca1753d7-a2c1-4d5f-8ebc-4f46cc733e13", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca2aed6f-d67e-4c9e-861b-8ef399a678f7", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "c3ef6c77-86a0-40dc-8f33-087871394836", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca3096fc-84d6-42b5-b7d2-5d2d25650315", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca50ff7c-7a67-448c-9d00-fd274a9984d0", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:48");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca5e0e13-f389-4505-9f95-c54e4c2ed467", "dd10064c-5e93-4914-b41c-25ca8c974e98", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca77e522-0a1b-4e89-ad7c-41dc9aedda70", "77efc382-0004-4d48-9605-9ab954aaca94", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca8a5d94-7745-4837-a095-44511cb7463e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ca92b35e-7261-40a6-a33d-60b5a98655ba", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb0e9c83-803b-454b-9859-943b306b69cf", "dd10064c-5e93-4914-b41c-25ca8c974e98", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb131fe1-1005-44d1-ba5e-e6623f93ecfc", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb4a6363-b516-47ef-981e-883f3ddc25a0", "77efc382-0004-4d48-9605-9ab954aaca94", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb53fedc-75fb-43b9-aa7f-6ee70168db25", "79dd5083-f76f-41e5-8c60-bb1a318f229b", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:15:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:15:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb8381c2-5aa4-4197-bd0b-141158335ee9", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cb9dbd08-b4c8-4781-99c6-0d5cd9ca771c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cc0d0d7e-3e47-4e4a-add7-cf57a43e93b6", "e36aed14-9eed-4435-ad86-9df696e90057", "ef759cae-8fd6-4e36-9790-439e03c3a503", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cc599145-449a-427b-af8a-7b803cd4ba3d", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cc7c3539-52ed-4904-8c16-ba49197952a0", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cca79d2c-8dbd-4a47-97e3-9b28c1da3cd8", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "38eab206-952d-4f00-8ef6-f683526ebd9e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:21:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:21:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd00c401-fc68-47cd-a297-e1202aacb01f", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "bacde412-a651-4c8c-8237-155b39a4595b", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd06ba27-2225-40be-8ed9-5030fb36a782", "0aa69419-0083-4a58-8557-3781a4944b05", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd0b41b2-6997-4fdd-81e9-3233906453ed", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd0b8515-1c15-4a12-91aa-be3de6f80840", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cd3a0398-be4f-48ed-8f02-e588a3a17e57", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:38", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:57");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cdc04918-35be-4935-b066-4b8ca0ecc842", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cdcc31a8-d4ff-4c78-8b47-bf0f7dfa47bb", "64502c81-163a-4ded-a7c9-3136024d26d8", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cde1974e-6d73-4dc3-9c4c-fabe7d0d8207", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ce3ee55e-152d-4963-8632-4d5b2b4773fa", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ce65ba47-bf0d-4d9b-893b-ecff026aa410", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:08:24", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ced78b2d-cb9f-42d4-9207-b06471dc1db8", "0aa69419-0083-4a58-8557-3781a4944b05", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cf321144-d158-4592-8c8f-08fda27c7947", "0aa69419-0083-4a58-8557-3781a4944b05", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "cfebfaef-7525-45fb-b1fc-6f9923b99682", "e36aed14-9eed-4435-ad86-9df696e90057", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:11", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:11");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d068f8ac-b0ef-47bd-af57-be5f29a06257", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d0b953a1-fdf6-4755-9fbc-082e8453bb8a", "e36aed14-9eed-4435-ad86-9df696e90057", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d1c46a49-69d6-46ba-8e68-0f0df7df98bd", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d1fb2046-af88-4513-8526-eb4b30a44b5a", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d2063b87-80cb-40bc-b580-640aa34f148c", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d288e9b7-7423-4258-914a-6f7244f47e53", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d295a3bd-a7ac-47e3-9199-292095a9599c", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d2988af9-cec0-43a4-acdb-6ed601e079a1", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d30d5bb7-c00e-4103-9f1a-f203b6e4438f", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d3544dd6-d7c1-4031-a984-b443fbc8a960", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d3851375-fe41-439e-990a-b48a31878b8d", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:36", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:28:11");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d3ae4cba-35c6-4029-b9fb-61c0f7d46d85", "0aa69419-0083-4a58-8557-3781a4944b05", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d4187b81-5d0a-4c51-901b-716d3b30d7c9", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "123f022c-72ae-401b-9144-624dad3a906a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d4693a32-2076-4c17-882d-eed9b6f3746e", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "71dfb7c2-4abf-4f93-b989-7d78f255a074", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d46ddd94-1018-4412-a1c9-6d33c6a1a52f", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d46f90f9-ea7e-40a4-afde-8a0453b35a8a", "dd10064c-5e93-4914-b41c-25ca8c974e98", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d47ba3e6-6c58-40ae-8546-d6fcc36ba60e", "e36aed14-9eed-4435-ad86-9df696e90057", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d4b60e27-05ed-4dc8-b8b7-1951f878e2ac", "e36aed14-9eed-4435-ad86-9df696e90057", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d50f88ad-ae76-4906-af94-8ecc23794e21", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d511bde2-3465-4a9c-ab6f-b9c35b04ae89", "dd10064c-5e93-4914-b41c-25ca8c974e98", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d523d019-0a28-4349-98f1-9298cb99baba", "0aa69419-0083-4a58-8557-3781a4944b05", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d5bed38e-efec-4e17-a025-528f44a3a001", "77efc382-0004-4d48-9605-9ab954aaca94", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d607b07a-efc0-40ea-93d8-bbec11ea4897", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "951544df-6ad1-482d-89e0-4bd3d348e215", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 23:24:32", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d6646d7e-7f3a-44f5-943b-ccabc623f5ce", "77efc382-0004-4d48-9605-9ab954aaca94", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d68b4564-c173-4e87-aa42-51959a5d6d39", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d6948899-cdf7-4eec-b019-ef9fc14967ab", "0aa69419-0083-4a58-8557-3781a4944b05", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d6fc1ead-f907-448f-8482-492166467134", "dd10064c-5e93-4914-b41c-25ca8c974e98", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d72498a6-c18d-48e4-a472-c5b24b2a99ab", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:16", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:52");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d73fb7a6-7e4c-4922-a38b-ab6ed9cada46", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d79c2b4d-3cb7-42fc-88d6-91182bd7a8c0", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d7b4f490-57b1-4c61-b8b7-471d8b06495e", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d7f08be4-a3a9-470d-8c04-8bff0f246b23", "64502c81-163a-4ded-a7c9-3136024d26d8", "abdabe47-4395-4f92-a66d-3d8844ff34bc", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d7f66ba1-205f-440d-ada5-3674d58dde3b", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8037411-cf03-4581-86d4-ac6c0bab82c8", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:57");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d82d7b65-27d7-49c8-bce7-b03b7b99c1e3", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d84077fe-95f6-4b2d-a6d3-18951434e25d", "dd10064c-5e93-4914-b41c-25ca8c974e98", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d844c0ee-00fa-4e68-ae26-d04428f66583", "6a954648-6b0b-4db0-88f2-7446218b85f5", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d88f65e8-5640-45d6-bbec-ff863db94ac7", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8b44da9-8c97-48cf-9ca0-27643647357d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-17 13:26:20", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d8d7f915-ea69-4c34-8c08-a7bbdfd6234d", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "39425516-e7b9-42f9-b23b-02bf04bae967", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d90a077a-60b6-43e5-a7cc-a3a13f2edb3d", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d94c0a0b-69b1-41dc-aa92-24db19945b1d", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d9cff002-10fe-4126-8873-fc7c211b2a0e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "d9d6fbf6-255a-4e6f-85a5-371ab616f4e9", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "da1e904b-a169-4e1f-965c-707944710f67", "6a954648-6b0b-4db0-88f2-7446218b85f5", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "da7fbf2d-fc03-48ae-8bb8-6611281c6ef1", "dd10064c-5e93-4914-b41c-25ca8c974e98", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "da8f288e-9ed2-47a7-b369-dbc7c2342537", "e36aed14-9eed-4435-ad86-9df696e90057", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "daaae3bc-a05b-47e6-987a-e55afbaa9a24", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "56f6fcfd-ece1-493f-80f3-1948fe769fbd", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:28", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:28");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dade1d5c-3f2a-4ce6-981f-ddae38f57b86", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "daeb723a-f90b-4634-8525-b9cb31ade5ee", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db1105d1-be70-48a1-9208-75359a3fdd2e", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "687b3adc-f1ad-4849-8bef-ee2121faddcc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:54:19", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-02-05 11:54:19");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db1ada1c-5fb9-4f2b-9d22-f6d5780b3772", "f7f8d89c-be4c-424e-a292-78529889491b", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:34", "6ca14165-31af-46f2-898c-3fc049aec967", "2025-02-25 17:30:34");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db1b28ef-0811-4622-9f40-5b8714c36557", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "38eab206-952d-4f00-8ef6-f683526ebd9e", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:51:10", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:51:10");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db3944cc-0065-48c7-8873-27cc0b57f53f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "b56ff379-5619-4064-b572-407671edc15e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db432a3f-a71d-4008-9f3c-ad0b30b2def2", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db59fe97-f44c-4442-a073-66ae190e9625", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db774219-e492-44eb-a22e-f5def4dedac8", "dd10064c-5e93-4914-b41c-25ca8c974e98", "b56ff379-5619-4064-b572-407671edc15e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db8e4018-82a5-4fd9-aece-933c6507df83", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "b56ff379-5619-4064-b572-407671edc15e", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "db9e1926-d4ff-4c64-ba86-bdce8243402b", "e36aed14-9eed-4435-ad86-9df696e90057", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc2714e6-1ede-4d0e-a361-b31d54009fcf", "e36aed14-9eed-4435-ad86-9df696e90057", "ff61f738-5cd8-49f9-9005-7236fdefdc6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc386815-5cc4-4683-ba79-0f1702464966", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-25 23:22:08", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc5b8c15-2e67-4bc9-92cd-357a08cebc68", "6a954648-6b0b-4db0-88f2-7446218b85f5", "0c00c0bb-a973-4d30-84b7-ed486a839431", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-18 09:08:58", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dc690cca-5208-4610-be82-b05b791937d3", "77efc382-0004-4d48-9605-9ab954aaca94", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dcc79844-acdb-4415-85cb-c494fbd79be2", "64502c81-163a-4ded-a7c9-3136024d26d8", "687b3adc-f1ad-4849-8bef-ee2121faddcc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:38", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:23:38");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dcf9edd8-c445-4250-a06f-a444b98791c0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dd92fad3-1185-4ca6-a920-d8ff93565948", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ddf1ac95-060a-4b99-af37-c164d0ab361b", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "47b4877d-7fdf-41de-a2ec-c6f467250478", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "de2af9b1-e8a1-4307-99f1-ace914eeae93", "8a0e87d7-905f-4991-a260-fbb6bf294f9f", "eaaba437-4823-4819-a912-7bbf789959fe", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:49:02", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:49:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "de4c083c-258e-45a8-8028-360473666cb5", "77efc382-0004-4d48-9605-9ab954aaca94", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "de9bbb49-f19c-4f69-9ad0-a8defcf9eba9", "e36aed14-9eed-4435-ad86-9df696e90057", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("a4633f72-4d67-4f65-a050-9f6240704151", "deef4a82-915a-42b5-a84d-030b291701b9", "f932eed5-c9f9-49fa-a635-a73f7e1461ec", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:00", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df23519f-da04-44ae-b8d8-3bfe65975b1b", "dd10064c-5e93-4914-b41c-25ca8c974e98", "ff61f738-5cd8-49f9-9005-7236fdefdc6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df757839-a7e1-404b-b61c-f40a8499d650", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "df82d5c8-874c-4c6f-b993-b9cadadb9830", "6a954648-6b0b-4db0-88f2-7446218b85f5", "33ecb1e0-a8f2-47ed-8919-3c4bd057abf1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-31 14:36:03", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-31 14:36:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dfa148e3-4aec-4abb-a425-ac86c634aae4", "dd10064c-5e93-4914-b41c-25ca8c974e98", "ac2e3614-bff5-4855-b14f-6efeb598855c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dfb8be98-2af5-4b53-a830-c778728482c4", "e36aed14-9eed-4435-ad86-9df696e90057", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dfdaf003-9964-4883-a1d5-2f5f7b6ae445", "e36aed14-9eed-4435-ad86-9df696e90057", "951544df-6ad1-482d-89e0-4bd3d348e215", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e00859ce-a7e4-456f-8efd-b1e5ab4e6890", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e06a0c32-f5cf-446e-8731-6d47ef059452", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e0df0602-b397-4e06-902d-92a15c6c76f3", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e1256edc-a6ce-4fe6-9c0c-9755c3c28c54", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e1260431-9707-45fa-a6cf-2420b5774bce", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e13a4fe2-d3e4-4f2f-ab30-9079959dc317", "6a954648-6b0b-4db0-88f2-7446218b85f5", "7320e775-9948-444e-b068-8e69745e77ab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-03 13:40:26", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-03 13:40:24");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e143fd47-0e32-493b-8b24-8305f5d1432a", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e15349c6-42d3-4d03-a443-9fe7721bac9d", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e1603581-f04d-4451-90c9-5e0fc00c5a94", "0aa69419-0083-4a58-8557-3781a4944b05", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e19d8474-ee11-44e7-9aa4-3245b6a3eab0", "e36aed14-9eed-4435-ad86-9df696e90057", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e1a4ba8e-fcf2-4d30-915a-837faca2c200", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e2824743-f863-4390-9930-9fb14ecf285b", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e291597e-ab59-4d62-a234-0419f79e6e18", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e2923e8b-a625-4758-8f25-237fb4e1d8f7", "6a954648-6b0b-4db0-88f2-7446218b85f5", "78d3e701-b660-4ea5-abb8-c935d1387e2d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e2b44658-b013-4abd-938b-d6f7e498c5ee", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e2eef1e7-4b6d-40e8-bd64-ece13bbbe723", "77efc382-0004-4d48-9605-9ab954aaca94", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e3025d41-cf09-4687-aa6d-5cc50ede2313", "e36aed14-9eed-4435-ad86-9df696e90057", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e302e8b7-6f99-4593-8de7-03f10e881312", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e31d6148-b962-44f1-83fb-54d813ee9e86", "e36aed14-9eed-4435-ad86-9df696e90057", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e35f0723-3189-4473-b37e-bbe8617693bc", "0aa69419-0083-4a58-8557-3781a4944b05", "7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e3ae3bce-990d-4ea9-bd55-8d6842e595e6", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e3c619d2-da54-47b0-aa9d-71e7edbe1759", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "d52c72cb-f61b-4354-9ffd-6200d2d7da85", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e4346d64-3d40-4fd3-a8af-4b8874705486", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e4ea7412-74e5-4472-9d83-1b3030ef38b0", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "e522fb7f-1f36-49f7-ba35-3a7a31152e27", "8d352c1b-505a-4dd2-82c3-9b7c4b171819", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:01", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e5986129-fe15-4281-bd17-02174c172fc2", "dd10064c-5e93-4914-b41c-25ca8c974e98", "029f2730-7ee9-4383-a409-4b5fe0d61fcc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e5a172b8-dd77-4bb4-8af3-6a542725a63d", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e5d043c9-df9a-46d7-b8e5-70addb78fa44", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "65e39b7b-a4ee-4045-a6f0-73667f5026d8", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e6d37669-32cb-4028-b7d2-702d8ae2d919", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-08 13:53:54");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e71fe5ef-71e9-42ad-b9da-a15d8fea6037", "e36aed14-9eed-4435-ad86-9df696e90057", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e733338c-b029-4916-a436-5192a22776fa", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "351be4d9-c967-4d44-a1e6-171a98eec8cc", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e7719df4-8ae0-48b0-8ccd-f92d30767b40", "6a954648-6b0b-4db0-88f2-7446218b85f5", "266bd8f2-8e09-404b-985e-0196c14218fa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e7b9591a-5381-4c12-827d-3532d9de699d", "dd10064c-5e93-4914-b41c-25ca8c974e98", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e851fda1-1a6e-4f7e-a62e-b31e66b59e7d", "77efc382-0004-4d48-9605-9ab954aaca94", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e85b6c4c-8933-4594-97a2-ead24f98b4ff", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e876c029-e119-410e-b97c-9e49c10bc354", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "7c69522f-cebf-4377-945a-3324b0a26baa", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e89b49a5-5517-4e3f-bb0c-dcd7a47d559f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "dfff16fd-8bc6-410b-8500-3548cf245a86", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 08:45:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 08:45:34");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e8afbedb-9e11-42f7-a1b0-d61bffffa1d3", "77efc382-0004-4d48-9605-9ab954aaca94", "c3ef6c77-86a0-40dc-8f33-087871394836", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e8b5dbc1-d2c8-46a2-87e0-824b030d7776", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "266bd8f2-8e09-404b-985e-0196c14218fa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e8c96319-f744-48e3-a511-eab78704dadb", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e8ed6d24-8570-40e4-8b74-2674866c78f1", "0aa69419-0083-4a58-8557-3781a4944b05", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e965ca37-65d8-4566-90bf-adaebbfefa05", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e98fac9f-c3c0-46fc-ac82-a332f362cb8d", "dd10064c-5e93-4914-b41c-25ca8c974e98", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e98fb7bd-462d-487a-9736-880f1fe64e51", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "868afde4-08e8-4899-b596-301c1bae2258", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e9a9268b-885b-4aec-80be-eaa448b0f7de", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "3d143838-e2e4-4d31-99a7-af6f1dca434d", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e9e50ad6-4e02-459b-92a7-8de0b8fbadd9", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "d7ca1a2b-e684-4b50-824d-50540afaa994", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-17 15:51:38", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-17 15:51:38");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e9f8002e-deec-49ef-8a25-ca8e93703621", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ea0c5cd0-5eda-45af-a686-3212872a9e97", "dd10064c-5e93-4914-b41c-25ca8c974e98", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ea110792-5602-4b67-a6b5-4309735db0a4", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:28", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:53");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ea179c19-719b-4dad-9163-b71c8b703a3a", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "ef759cae-8fd6-4e36-9790-439e03c3a503", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:49");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eaf5ca7c-44f9-4faf-905e-60d5f2b24080", "6a954648-6b0b-4db0-88f2-7446218b85f5", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eb243ff5-0556-4725-bd8e-97733f26acfd", "0aa69419-0083-4a58-8557-3781a4944b05", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec24938f-b2d6-4117-8dcf-ca0e8e86f29a", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:47");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec25fe26-98dd-43b1-aacb-382e226a9b0a", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec41080c-4183-4b2c-9aaf-a15a54c902d4", "77efc382-0004-4d48-9605-9ab954aaca94", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec4250c8-2899-4fce-922a-7c875d22a28f", "64502c81-163a-4ded-a7c9-3136024d26d8", "ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ec9b301f-c121-423f-b96c-ca1ce7f9ffba", "6a954648-6b0b-4db0-88f2-7446218b85f5", "351be4d9-c967-4d44-a1e6-171a98eec8cc", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 22:19:05", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ed3a55cd-c5d5-4fbe-ac50-ecfe1c148d23", "64502c81-163a-4ded-a7c9-3136024d26d8", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ed58a492-7115-45e2-97d7-c34babcd6471", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eda5d579-fb6b-461c-a0fb-623980d00dc2", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "edaca894-39f6-4322-b2bb-f5c817862015", "dd10064c-5e93-4914-b41c-25ca8c974e98", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee158d27-d762-46fb-9a1e-562c6131f009", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "1eebee7e-a774-4572-a660-8ab49f6a734a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee473723-8634-4a74-b071-fa6e818da9f2", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "5e9a1b26-93fe-4dbc-af0e-2967710e4483", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee5f1a1a-7e9f-413a-8614-ad717a7b1364", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "113cf5a2-ff11-4091-99d5-afb1c525b23d", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ee672c64-c113-4238-9d62-33cda8bac84e", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:42:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eebda58d-8f61-4e4b-9197-7c4818af7de0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1d1d4319-e834-4876-87a9-f3148e17514a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "eed3808f-cecf-448e-b448-511899270b52", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "68228796-8ea0-4b51-9fef-f9ba7a365f3e", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ef9267ad-4224-4f7e-8fef-0a3e9fe6048e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "efa402cb-3767-403d-b182-f16158c8dc7e", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1226a31c-fe9d-4102-9750-a4571a08a8b5", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:20");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "efcd58af-324b-408a-8dee-2674b4f5fe5e", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:21");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f045ebda-ac11-4c35-b4c5-6a12f20785e4", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f05df83b-7dc8-4b2a-9311-ca3243dbd919", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f0ee9b1e-990d-41fc-9579-19ca1731fabe", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "cbb9bd4f-15d9-4799-a942-b8601961adeb", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f10aebed-d5ac-4917-88f4-fc418bc15c68", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "ff61f738-5cd8-49f9-9005-7236fdefdc6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f1244a32-b92b-4f26-8837-3c73f1ba1572", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f138b16a-2f0f-413d-8530-1fde9804e9b6", "dd10064c-5e93-4914-b41c-25ca8c974e98", "f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f19d626a-762d-4e72-a4f2-1b8bc42a3ec4", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "45304d5b-390d-4618-a08d-793b475f37b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f1a75e7a-c571-48e1-b02c-c003d7565f47", "0aa69419-0083-4a58-8557-3781a4944b05", "868afde4-08e8-4899-b596-301c1bae2258", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f1dc7ec0-031c-4f61-abe3-290e7098cd27", "e0dbcb16-a471-478c-8699-8fa92f84bc67", "ac2e3614-bff5-4855-b14f-6efeb598855c", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 09:18:25", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 09:18:25");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f1e6ff5e-178b-4e98-89ed-4278f2966756", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f23ab071-d257-4876-85ad-631a852624cf", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c5a700bc-e6d0-495d-8b17-754b5033d5ec", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-08 13:40:58", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-05-08 13:40:57");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2983133-0bc9-4f94-80da-29dc653fe03a", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:04");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2ac538c-e15b-4f82-8d96-afe556337256", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2bc844b-e931-4d7f-894a-2b5f65f1ef01", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:32", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:03:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f2f4c27f-af13-4964-8eea-ca4afec1cc5e", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:39", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f337bdc4-aff5-442d-95ac-d373565f2e05", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f36097dd-7134-4070-9081-3ad8fef8883e", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:14");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f38f9bd6-1632-4df7-9698-93fc4b914a98", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "4610c39b-de32-450b-812d-db8c37fcc643", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:41", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:00");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f3af3cfc-0875-4876-a0f8-205d6abba76f", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4232f4e-6818-43a9-88eb-48075cad54ca", "64502c81-163a-4ded-a7c9-3136024d26d8", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:21:44", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4248d15-f72f-4a17-be63-4942223c4cca", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:49");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f435214c-82a8-4eb4-ad93-00647fad0e0e", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4ae5589-ad36-4e4a-b0f3-c07bd3db5062", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "1eebee7e-a774-4572-a660-8ab49f6a734a", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 12:55:03");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4be74c7-adb2-4055-984e-9f22040efa4f", "6a954648-6b0b-4db0-88f2-7446218b85f5", "a1933745-b711-4e3a-948c-330fd60c23ba", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-21 10:55:07", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-21 10:55:05");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f4c46e5b-8200-4500-9efe-9c5118e3c756", "6a954648-6b0b-4db0-88f2-7446218b85f5", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5bbdb2a-1e35-4765-b13b-8b3c05f828cf", "0aa69419-0083-4a58-8557-3781a4944b05", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5c52ae2-5658-42c5-8091-ca13a41208f7", "0aa69419-0083-4a58-8557-3781a4944b05", "99d2e39c-89a0-48bc-9117-2770c2d65caa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f5e923dd-fdff-4784-a06a-f097185621f6", "6a954648-6b0b-4db0-88f2-7446218b85f5", "868afde4-08e8-4899-b596-301c1bae2258", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:51");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f6142013-ee5d-4787-9c3f-792921a65517", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:58");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f7203179-02b1-4b87-b90d-7b6bd38fd3ee", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "07eab05f-be52-45ce-8a53-8dd69df443f4", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f7b6faa1-0ec8-4c4b-8e5c-142207cc8a71", "0aa69419-0083-4a58-8557-3781a4944b05", "ff61f738-5cd8-49f9-9005-7236fdefdc6c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f84e9bf9-b658-4357-8503-72d67f5d9b70", "0aa69419-0083-4a58-8557-3781a4944b05", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:45");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f875af03-7463-431a-97e6-2fee862d1abc", "64502c81-163a-4ded-a7c9-3136024d26d8", "f7d07231-f33e-4050-a6f8-c846cc6aa031", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f87c789f-cc9b-4b60-a2b2-75a72b919edc", "dd10064c-5e93-4914-b41c-25ca8c974e98", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8a11fa4-e6f4-4509-956d-19383f9eb8f2", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8ac2598-d52c-4440-a1e7-88c4d4a2b03f", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8d1d43b-aa50-42d2-b829-97e1ad8c5414", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f8f83ded-5e51-4560-a5c8-7f03695dc5d8", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "f8fd7571-006c-462a-9105-d6f3316f4a40", "8d352c1b-505a-4dd2-82c3-9b7c4b171819", "d00ef65d-9af6-405c-a8ef-b5e3dc312416", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:13", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 16:00:12");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f9088f75-7865-4880-aa8a-cdb79a1710f0", "6a954648-6b0b-4db0-88f2-7446218b85f5", "39425516-e7b9-42f9-b23b-02bf04bae967", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f931d62c-2c67-4a4b-b6dd-c2286782f3e6", "e36aed14-9eed-4435-ad86-9df696e90057", "351be4d9-c967-4d44-a1e6-171a98eec8cc", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f966b80e-d145-49ba-8cfd-15021d0ffe84", "0aa69419-0083-4a58-8557-3781a4944b05", "361f2f6f-ab8c-4abe-827e-985d40f04f31", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f9d4d8f1-75ae-4248-bccd-74828330292e", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-09-25 14:48:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fa3550d8-7c11-4469-a208-c98a18fab83e", "6a954648-6b0b-4db0-88f2-7446218b85f5", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-12 21:41:43", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fa556c0f-3f52-491d-893d-2fd50336e67f", "77efc382-0004-4d48-9605-9ab954aaca94", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "facc94e7-dd93-4776-88df-e7f3fdb752ef", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "04ee7f51-5847-4099-9d70-7b4f4d9a989c", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:23");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "faebdd2e-16c9-493b-8ec9-af306703112c", "dd10064c-5e93-4914-b41c-25ca8c974e98", "d7ca1a2b-e684-4b50-824d-50540afaa994", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 14:07:38", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 14:07:38");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb0d75f2-7ec5-4f62-beb6-83a9d8f32196", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb2ec8ff-36cc-414f-8e51-35db81593bb2", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "49e22574-cb55-450f-9d47-6b895b2caed3", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:42", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:55:01");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb350b85-4566-4b3c-9b10-a0f3752c5a94", "e36aed14-9eed-4435-ad86-9df696e90057", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb4eb5be-c216-4b9c-b1e1-34ae6c778212", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "7c69522f-cebf-4377-945a-3324b0a26baa", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:34:59", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-10-10 13:43:02");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb66e48a-4071-462e-b7fd-947a8a895b54", "77efc382-0004-4d48-9605-9ab954aaca94", "f9afc38a-bb61-4f98-b593-211766ec6133", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-23 14:00:35");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fb989582-aba1-4932-8b9a-9b133452d8ad", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:40", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:59");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fbd0ea3a-609d-4676-9fbe-9528fe8703fc", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "f71515e5-57b8-41de-9c49-5e494c497563", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fcc45995-83c7-4147-8725-83dcaf32e0f3", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:32:56", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-25 15:09:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fcfc6e5c-9321-4d17-9d71-f25dc74924ae", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1d1d4319-e834-4876-87a9-f3148e17514a", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fdba2ee5-1031-411d-9013-a87e9a0cf004", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "1048ed1d-fef4-4e19-9df3-21c5fdec338f", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:16:50", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:37:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fdbc2f94-c7f6-4ea3-9c7c-5e44d4d7cfa0", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-08-03 08:38:17", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-06 15:53:22");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fe425daa-e3e4-4b75-a99a-0bad350f3186", "e36aed14-9eed-4435-ad86-9df696e90057", "2acf8f9e-9143-4089-b4af-4da2aa25dab6", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fe7777b8-1b69-40bd-a044-00a56c25743c", "6a954648-6b0b-4db0-88f2-7446218b85f5", "c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:25:45", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-28 12:09:50");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fe7b553b-d9f1-4763-99bc-aa4faa822097", "e36aed14-9eed-4435-ad86-9df696e90057", "171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "fe876dfe-6866-4576-a80d-3a583fde6e83", "e36aed14-9eed-4435-ad86-9df696e90057", "eeb5b08f-596b-4966-8649-f3f119325a67", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ff2d20a4-366c-4c8b-abbd-825640317706", "64502c81-163a-4ded-a7c9-3136024d26d8", "d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:39:12", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-07-31 15:22:06");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ff6645d1-dd07-4aa7-8d6c-1c85803fac22", "e36aed14-9eed-4435-ad86-9df696e90057", "aa816bb5-2197-4c1a-90b2-f1e955063ca8", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:05:33");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ff85c992-15d9-4a31-a90b-280f71e0492d", "0aa69419-0083-4a58-8557-3781a4944b05", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "0", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:46");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ffadbaf6-c0e4-43e6-85d5-57ae86d7f606", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "0", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:30", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-13 22:38:32");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ffe16d90-a522-42a5-9e09-c69c4b5ece54", "6a954648-6b0b-4db0-88f2-7446218b85f5", "e68bda4d-9e9f-4a89-bd23-ca80983eca32", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-10 14:41:44", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-10 14:41:44");
INSERT INTO `dt01_gen_role_dt` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ffea35e7-1b3f-41d1-b087-0323818c5d87", "6a954648-6b0b-4db0-88f2-7446218b85f5", "99df9a77-d5a1-48b1-b3b5-a771ded109bf", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 09:20:44", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-17 09:20:43");


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
  `TRANS_ID` varchar(50) DEFAULT NULL,
  `USER_ID` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_role_ms` VALUES ("ed7552de-d428-4d3c-bf4a-3cb3cb11459c", "02991a18-f8ad-4d09-8621-19fe0ed8cf6a", "Default", "1", "458ff920-ee42-48f5-b018-c605b41aa7dd", "2024-07-25 23:13:54", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0983b5dd-6466-4d2d-a09f-f2e9f4fea5ff", "Master Supplier", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:37:15", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 11:37:15", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0aa69419-0083-4a58-8557-3781a4944b05", "Vice Director Approval", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:32", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:08:32", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "116b3436-bce6-487e-817d-ec9e793e41ba", "SmartBoard", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:47:05", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-05-02 08:47:05", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "20692618-6042-40e6-b6b4-df381bb99c52", "Invoice Manajer Approval", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:47:19", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:47:19", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3437eff0-ec3e-4180-b52d-0b09b6dc19dc", "Laporan Keuangan", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:01:34", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-22 11:01:34", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "Admin Tilaka", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "3876c700-10d2-4c84-b5dd-6aee7c6635dc", "Komite Keperawatan", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "49cade5b-72b9-4f61-8d5d-882fdb470d1a", "HRD", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5958eac2-afda-40e9-8870-4ccd9cda12d0", "Invoice Finance Approval", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:50:46", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:50:46", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "5ae4e33e-6005-4022-8f11-f5f8ad82fc20", "Default", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "64502c81-163a-4ded-a7c9-3136024d26d8", "Finance", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "6a954648-6b0b-4db0-88f2-7446218b85f5", "Developer", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("bb0e2dea-16d9-46ba-a5ee-fe831f543c0b", "6f62be70-a3e8-40f4-bf6c-86d6db10d277", "Developer", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "77738726-a358-414d-8043-1b3defa6d1d0", "IT Operation", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "79dd5083-f76f-41e5-8c60-bb1a318f229b", "User Tilaka", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:13:29", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-02-03 07:13:29", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "7a9f1131-3120-4b11-8117-09a860500b46", "Invoice Directur Approval", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:49:51", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:49:51", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("7e156928-9d6f-4a56-91be-08075e99be2d", "7dfcce8a-31a0-419a-87be-924fb46fd439", "Default", "1", "8e0f843b-339b-4cca-a4dc-decfe1f00240", "2024-07-23 12:16:20", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "8a0e87d7-905f-4991-a260-fbb6bf294f9f", "Invoice Vice Directur Approval", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:48:43", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-17 11:48:43", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "8d352c1b-505a-4dd2-82c3-9b7c4b171819", "Analis Data", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 15:59:53", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 15:59:53", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("ed7552de-d428-4d3c-bf4a-3cb3cb11459c", "9d0e6955-5522-4abe-bade-2afa2be615a8", "IT Operation", "1", "458ff920-ee42-48f5-b018-c605b41aa7dd", "2024-07-25 23:13:54", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a32efe3c-1327-47f8-90f5-eb484c79ecb3", "Monev", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "a4022fe1-2d74-4d72-8182-b9a0fc195ec0", "Director Approval", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:03", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 11:11:03", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "ac23d9e0-4eab-4af7-8f51-fb5869591bd2", "Manager", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:29", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-11-21 14:54:29", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "af82114a-23e2-4d2f-b787-0a693fd76d54", "Master Item Barang", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 09:01:32", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-07 09:01:32", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "b121aaba-f544-4827-9fc6-e22602559a77", "Keuangan", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:22:24", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-31 14:22:24", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "c70cdcda-900f-4494-a44e-dd91e351938f", "Good Receipt (PO)", "1", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 14:52:17", "5f2976eb-85cf-4817-b448-8676576c8f68", "2025-01-06 14:52:17", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "dd10064c-5e93-4914-b41c-25ca8c974e98", "PO", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:36:55", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-30 13:36:55", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e0dbcb16-a471-478c-8699-8fa92f84bc67", "Rekap KPI", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 09:17:59", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-03-13 09:17:59", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e16263f7-ee6e-4a6c-a604-67d0a89e1578", "Bendahara", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:21:44", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-20 10:21:44", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "e36aed14-9eed-4435-ad86-9df696e90057", "Finance Approval", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 10:52:29", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2024-11-23 10:52:29", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f23ab997-18fb-4a5a-8bd4-f524e29cfba2", "IT Operation", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-07-12 22:08:21", "", "2024-07-30 11:14:33", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("10c84edd-500b-49e3-93a5-a2c8cd2c8524", "f7f8d89c-be4c-424e-a292-78529889491b", "Finance Report", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:22", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-01-15 21:41:22", "", "");
INSERT INTO `dt01_gen_role_ms` VALUES ("a4633f72-4d67-4f65-a050-9f6240704151", "f932eed5-c9f9-49fa-a635-a73f7e1461ec", "Analis Data", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 15:59:53", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-04-23 15:59:53", "", "");


DROP TABLE IF EXISTS `dt01_gen_tte_hd`;

CREATE TABLE `dt01_gen_tte_hd` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `NO_FILE` varchar(100) NOT NULL,
  `FILENAME` varchar(1000) DEFAULT NULL,
  `JENIS_DOC` varchar(100) DEFAULT NULL,
  `NOTE_1` varchar(1000) DEFAULT NULL,
  `NOTE_2` varchar(1000) DEFAULT NULL,
  `LOCATION` varchar(100) DEFAULT NULL,
  `FILESIZE` int(11) DEFAULT 0,
  `DATE_UPLOAD_TILAKA` datetime DEFAULT NULL,
  `TYPE` varchar(1) DEFAULT 'S',
  `REQUEST_ID` varchar(36) DEFAULT NULL,
  `STATUS` varchar(100) DEFAULT '0',
  `RESPONSE` varchar(1000) DEFAULT NULL,
  `LINK_DOWNLOAD` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`NO_FILE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_tte_it`;

CREATE TABLE `dt01_gen_tte_it` (
  `ORG_ID` varchar(36) NOT NULL,
  `TRANS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_FILE` varchar(1000) NOT NULL,
  `REQUEST_ID` varchar(36) DEFAULT NULL,
  `NIK` varchar(100) NOT NULL,
  `USER_IDENTIFIER` varchar(1000) DEFAULT NULL,
  `TYPE` varchar(1) DEFAULT 'D',
  `TAG` varchar(100) DEFAULT NULL,
  `COORDINATE_X` int(11) DEFAULT NULL,
  `COORDINATE_Y` int(11) DEFAULT NULL,
  `PAGE` int(11) DEFAULT NULL,
  `LINK_SIGN` varchar(1000) DEFAULT NULL,
  `ORDER` int(11) DEFAULT 0,
  `SIGN_BY` varchar(36) DEFAULT NULL,
  `SIGN_DATE` datetime DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT '0' COMMENT '0 : New Data',
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_user_asst_dt`;

CREATE TABLE `dt01_gen_user_asst_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `ASST_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_user_data`;

CREATE TABLE `dt01_gen_user_data` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `USER_ID` varchar(36) NOT NULL,
  `USERNAME` varchar(4000) NOT NULL,
  `PASSWORD` varchar(4000) NOT NULL DEFAULT '3832333435363731',
  `NAME` varchar(1000) NOT NULL,
  `NAME_IDENTITY` varchar(1000) DEFAULT NULL,
  `NIK` varchar(100) NOT NULL COMMENT 'Nomor Induk Kepegawaian',
  `NIP` varchar(100) DEFAULT NULL COMMENT 'NIP PNS Jika DiPerlukan',
  `IDENTITY_NO` varchar(16) DEFAULT NULL COMMENT 'No KTP',
  `NPWP_NO` varchar(100) DEFAULT NULL,
  `SEX_ID` varchar(1) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(4000) DEFAULT NULL,
  `KATEGORI_ID` varchar(36) DEFAULT NULL,
  `USER_IDENTIFIER` varchar(1000) NOT NULL,
  `REGISTER_ID` varchar(36) NOT NULL,
  `TILAKA_ID` varchar(100) NOT NULL,
  `REVOKE_ID` varchar(39) NOT NULL,
  `ISSUE_ID` varchar(42) NOT NULL,
  `CERTIFICATE` varchar(1) NOT NULL,
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
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `ACTIVE_ID` varchar(36) DEFAULT NULL,
  `ACTIVE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  KEY `dt01_gen_user_data_ORG_ID_IDX` (`ORG_ID`,`NIK`,`ACTIVE`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `REF` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`TRANS_ID`),
  KEY `dt01_hrd_activity_dt_ORG_ID_IDX` (`ORG_ID`,`START_DATE`,`USER_ID`,`ATASAN_ID`,`STATUS`,`ACTIVE`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_activity_ms`;

CREATE TABLE `dt01_hrd_activity_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `ACTIVITY_ID` varchar(36) NOT NULL,
  `ACTIVITY` varchar(256) DEFAULT NULL,
  `DURASI` int(11) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT current_timestamp(),
  `PK` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`ACTIVITY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_address_dt`;

CREATE TABLE `dt01_hrd_address_dt` (
  `ADDRESS_ID` varchar(100) NOT NULL,
  `USER_ID` varchar(100) DEFAULT NULL,
  `ADDRESS_LABEL` varchar(255) DEFAULT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT sysdate(),
  `CREATED_BY` varchar(255) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(255) DEFAULT NULL,
  `PRIMARY` varchar(2) DEFAULT NULL,
  `ACTIVE` varchar(2) DEFAULT '1',
  PRIMARY KEY (`ADDRESS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`TRANSAKSI_ID`),
  KEY `dt01_hrd_assessment_dt_ORG_ID_IDX` (`ORG_ID`,`USER_ID`,`PERIODE`,`ACTIVE`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_assessment_ms`;

CREATE TABLE `dt01_hrd_assessment_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `ASSESSMENT_ID` varchar(36) NOT NULL,
  `ASSESSMENT` varchar(1000) DEFAULT NULL,
  `JENIS` varchar(1) DEFAULT NULL,
  `HEADER_ID` varchar(36) DEFAULT NULL,
  `KATEGORI_ID` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ASSESSMENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_contact_dt`;

CREATE TABLE `dt01_hrd_contact_dt` (
  `CONTACT_ID` varchar(100) NOT NULL,
  `USER_ID` varchar(100) DEFAULT NULL,
  `CONTACT_NAME` varchar(255) DEFAULT NULL,
  `CONTACT_PHONE` varchar(255) DEFAULT NULL,
  `CONTACT_ADDRESS` varchar(255) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_DATE` datetime DEFAULT sysdate(),
  `CREATED_BY` varchar(255) DEFAULT NULL,
  `RELATIONSHIP_ID` varchar(100) DEFAULT NULL,
  `CONTACT_PRIMARY` varchar(2) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CONTACT_ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `dt01_hrd_kategori_tenaga_ms`;

CREATE TABLE `dt01_hrd_kategori_tenaga_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `KATEGORI_ID` varchar(36) NOT NULL,
  `KATEGORI` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`KATEGORI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_mapping_activity`;

CREATE TABLE `dt01_hrd_mapping_activity` (
  `ORG_ID` varchar(36) NOT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `POSITION_ID` varchar(36) NOT NULL,
  `ACTIVITY_ID` varchar(36) NOT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_mapping_klinis`;

CREATE TABLE `dt01_hrd_mapping_klinis` (
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `KLINIS_ID` varchar(36) NOT NULL,
  `SUB_KLINIS_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_meeting_dt`;

CREATE TABLE `dt01_hrd_meeting_dt` (
  `ORG_ID` varchar(36) NOT NULL,
  `MEETING_ID` varchar(36) NOT NULL,
  `JENIS_ID` varchar(36) NOT NULL,
  `DATE` date NOT NULL,
  `START_TIME` varchar(5) NOT NULL,
  `END_TIME` varchar(5) NOT NULL,
  `MEETING` varchar(1000) NOT NULL,
  `DESCRIPTION` varchar(1000) NOT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`MEETING_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_meeting_ms`;

CREATE TABLE `dt01_hrd_meeting_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `MEETING_ID` varchar(36) NOT NULL,
  `MEETING` varchar(1000) NOT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`MEETING_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  PRIMARY KEY (`TRANS_ID`),
  KEY `dt01_hrd_position_dt_ORG_ID_IDX` (`ORG_ID`,`USER_ID`,`ATASAN_ID`,`POSITION_PRIMARY`,`STATUS`,`ACTIVE`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_position_ms`;

CREATE TABLE `dt01_hrd_position_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `POSITION_ID` varchar(36) NOT NULL,
  `POSITION` varchar(500) DEFAULT NULL,
  `DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `BAGIAN_ID` varchar(36) DEFAULT NULL,
  `UNIT_ID` varchar(36) DEFAULT NULL,
  `SUBUNIT_ID` varchar(36) DEFAULT NULL,
  `LEVEL` int(11) DEFAULT NULL,
  `RVU` int(11) DEFAULT NULL,
  `LEVEL_FUNGSIONAL` varchar(36) NOT NULL,
  `KATEGORI_ID_X` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATE_BY` varchar(36) NOT NULL,
  `LAST_UPDATE_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`POSITION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_relationship_ms`;

CREATE TABLE `dt01_hrd_relationship_ms` (
  `RELATIONSHIP_ID` varchar(100) NOT NULL,
  `RELATIONSHIP_NAME` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`RELATIONSHIP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_it_support_eticket_hd`;

CREATE TABLE `dt01_it_support_eticket_hd` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `SUBJECT` varchar(1000) DEFAULT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `SEVERITY_ID` varchar(36) DEFAULT '9f642ff7-4b89-49ee-bca4-acdd258f4361',
  `CATEGORY_ID` varchar(36) DEFAULT NULL,
  `PROBLEM_ID` varchar(36) DEFAULT NULL,
  `ATASAN_ID` varchar(36) DEFAULT NULL,
  `ATASAN_DATE` datetime DEFAULT NULL,
  `FOLLOWUP_ID` varchar(36) DEFAULT NULL,
  `FOLLOWUP_DATE` datetime DEFAULT NULL,
  `NOTE` text DEFAULT NULL,
  `ATTACHMENT` varchar(1) DEFAULT '0',
  `STATUS` varchar(1) DEFAULT '0',
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_coa_ms`;

CREATE TABLE `dt01_keu_coa_ms` (
  `COA_ID` varchar(36) NOT NULL,
  `KODE_AKUN` varchar(20) NOT NULL,
  `NAMA_AKUN` varchar(255) NOT NULL,
  `KATEGORI` varchar(100) NOT NULL,
  `COA_HEADER_ID` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`COA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_episode`;

CREATE TABLE `dt01_keu_episode` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `EPISODE_ID` varchar(36) NOT NULL,
  `PASIEN_ID` varchar(36) DEFAULT NULL,
  `PASIEN_ID_OLD` varchar(100) DEFAULT NULL,
  `NO_BILLING` varchar(100) DEFAULT NULL,
  `BOOKING_ID` varchar(6) DEFAULT NULL,
  `HARI_ID` varchar(1) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `JADWAL_POLI_ID` varchar(36) DEFAULT NULL,
  `KUOTA` varchar(3) DEFAULT NULL,
  `SLOT` varchar(1) DEFAULT NULL,
  `ANTRIAN` varchar(3) DEFAULT NULL,
  `SISA_ANTRIAN` varchar(3) DEFAULT NULL,
  `JAM_MULAI` varchar(5) DEFAULT NULL,
  `JAM_SELESAI` varchar(5) DEFAULT NULL,
  `DOKTER_ID` varchar(36) DEFAULT NULL,
  `POLI_ID` varchar(36) DEFAULT NULL,
  `RUANG_ID` varchar(36) DEFAULT NULL,
  `JENIS_EPISODE` varchar(1) DEFAULT NULL,
  `KELAS_ID` varchar(36) DEFAULT NULL,
  `PROVIDER_ID` varchar(36) DEFAULT NULL,
  `STATUS` varchar(2) DEFAULT '00',
  `METHOD_REGISTRASI` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`EPISODE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_jurnal_dt`;

CREATE TABLE `dt01_keu_jurnal_dt` (
  `ORG_ID` varchar(136) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `COA_ID` varchar(36) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `DEBIT` float DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_kelas_ms`;

CREATE TABLE `dt01_keu_kelas_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `KELAS_ID` varchar(36) NOT NULL,
  `KELAS` varchar(100) DEFAULT NULL,
  `URUT` int(11) DEFAULT 1,
  `ACTIVE` varchar(100) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`KELAS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_package_dt`;

CREATE TABLE `dt01_keu_package_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `PACKAGE_ID` varchar(36) DEFAULT NULL,
  `KELAS_ID` varchar(36) DEFAULT NULL,
  `HARGA` double DEFAULT 0,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_package_ms`;

CREATE TABLE `dt01_keu_package_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `PACKAGE_ID` varchar(36) NOT NULL,
  `PACKAGE` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`PACKAGE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_petty_cash_it`;

CREATE TABLE `dt01_keu_petty_cash_it` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `NO_KWITANSI` varchar(100) DEFAULT NULL,
  `NOTE` varchar(1000) DEFAULT NULL,
  `DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `NO_PEMESANAN` varchar(36) DEFAULT NULL,
  `REF_PETTYCASH_ID` varchar(36) DEFAULT NULL,
  `ACCEPT_ID` varchar(36) DEFAULT NULL,
  `ACCEPT_DATE` datetime DEFAULT NULL,
  `BEFORE_BALANCE` double DEFAULT 0,
  `CASH_IN` double DEFAULT 0,
  `CASH_OUT` double DEFAULT 0,
  `BALANCE` double DEFAULT 0,
  `STATUS` varchar(1) DEFAULT '0',
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_provider_ms`;

CREATE TABLE `dt01_keu_provider_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `PROVIDER_ID` varchar(36) NOT NULL,
  `PROVIDER_ID_OLD` varchar(100) DEFAULT NULL,
  `PROVIDER` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`PROVIDER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_keu_target_dt`;

CREATE TABLE `dt01_keu_target_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `BULAN` varchar(2) DEFAULT NULL,
  `TAHUN` varchar(4) DEFAULT NULL,
  `NILAI` float DEFAULT 0,
  `ACTIVE` varchar(1) DEFAULT '1',
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_lgu_assets_ms`;

CREATE TABLE `dt01_lgu_assets_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `NO_ASSETS` varchar(100) DEFAULT NULL,
  `BARANG_ID` varchar(36) DEFAULT NULL,
  `SERIAL_NUMBER` varchar(100) DEFAULT NULL,
  `NOTE` varchar(1000) DEFAULT NULL,
  `STATUS_ID` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_lgu_barang_ms`;

CREATE TABLE `dt01_lgu_barang_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `BARANG_ID` varchar(36) NOT NULL,
  `NAMA_BARANG` varchar(1000) DEFAULT NULL,
  `SATUAN_BELI_ID` varchar(36) DEFAULT NULL,
  `SATUAN_PAKAI_ID` varchar(36) DEFAULT NULL,
  `JENIS_ID` varchar(36) DEFAULT NULL,
  `TYPE` varchar(1) DEFAULT NULL,
  `FINAL_STOK` int(11) DEFAULT 0,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  `LAST_UPDATED_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`BARANG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_lgu_jenis_barang_ms`;

CREATE TABLE `dt01_lgu_jenis_barang_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `JENIS_ID` varchar(36) NOT NULL,
  `JENIS` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`JENIS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_lgu_mutasi_barang`;

CREATE TABLE `dt01_lgu_mutasi_barang` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `NO_PEMESANAN` varchar(100) DEFAULT NULL,
  `SURAT_JALAN` text DEFAULT NULL,
  `DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `LOCATION_ID` varchar(36) DEFAULT NULL,
  `BARANG_ID` varchar(36) DEFAULT NULL,
  `MASUK` double DEFAULT 0,
  `KELUAR` double DEFAULT 0,
  `QTY` int(11) DEFAULT 0,
  `JENIS_ID` varchar(10) DEFAULT NULL COMMENT '1 : Stok Opname',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_lgu_pemesanan_dt`;

CREATE TABLE `dt01_lgu_pemesanan_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `ITEM_ID` varchar(36) NOT NULL,
  `NO_PEMESANAN` varchar(100) DEFAULT NULL,
  `BARANG_ID` varchar(36) DEFAULT NULL,
  `STOCK` double DEFAULT 0,
  `QTY_REQ` double DEFAULT 0,
  `QTY_REQ_MANAGER` double DEFAULT 0,
  `QTY_MINTA` double DEFAULT 0,
  `QTY_MANAGER` double DEFAULT 0,
  `QTY_KEU` double DEFAULT 0,
  `QTY_WADIR` double DEFAULT 0,
  `QTY_DIR` double DEFAULT 0,
  `QTY_COM` double DEFAULT 0,
  `REQ_ID` varchar(36) DEFAULT NULL,
  `REQ_DATE` datetime DEFAULT NULL,
  `REQ_MANAGER_ID` varchar(36) DEFAULT NULL,
  `REQ_MANAGER_DATE` datetime DEFAULT NULL,
  `KAINS_ID` varchar(36) DEFAULT NULL,
  `KAINS_DATE` datetime DEFAULT NULL,
  `MANAGER_ID` varchar(36) DEFAULT NULL,
  `MANAGER_DATE` datetime DEFAULT NULL,
  `KEU_ID` varchar(36) DEFAULT NULL,
  `KEU_DATE` datetime DEFAULT NULL,
  `WADIR_ID` varchar(36) DEFAULT NULL,
  `WADIR_DATE` datetime DEFAULT NULL,
  `DIR_ID` varchar(36) DEFAULT NULL,
  `DIR_DATE` datetime DEFAULT NULL,
  `COM_ID` varchar(36) DEFAULT NULL,
  `COM_DATE` datetime DEFAULT NULL,
  `HARGA` double DEFAULT 0,
  `PPN` double DEFAULT 0,
  `HARGA_PPN` double DEFAULT 0,
  `TOTAL` double DEFAULT 0,
  `NOTE` text DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ITEM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_lgu_pemesanan_hd`;

CREATE TABLE `dt01_lgu_pemesanan_hd` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `NO_PEMESANAN` varchar(100) NOT NULL,
  `NO_SPU` varchar(100) DEFAULT NULL,
  `NO_PEMESANAN_UNIT` varchar(100) DEFAULT NULL,
  `PETTYCASH_ID` varchar(36) DEFAULT NULL,
  `JUDUL_PEMESANAN` varchar(1000) DEFAULT NULL,
  `NOTE` text DEFAULT NULL,
  `SUPPLIER_ID` varchar(36) DEFAULT NULL,
  `FROM_DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `DEPARTMENT_ID` varchar(36) DEFAULT NULL,
  `SUBTOTAL` double DEFAULT 0,
  `HARGA_PPN` double DEFAULT 0,
  `TOTAL` double DEFAULT 0,
  `ATTACHMENT` varchar(1) DEFAULT '0',
  `ATTACHMENT_NOTE` text DEFAULT NULL,
  `INVOICE` varchar(1) DEFAULT '0',
  `INVOICE_NO` text DEFAULT NULL,
  `REQUEST_ID` varchar(36) DEFAULT NULL,
  `REQUEST_DATE` datetime DEFAULT NULL,
  `REQUEST_MANAGER_ID` varchar(36) DEFAULT NULL,
  `REQUEST_MANAGER_DATE` datetime DEFAULT NULL,
  `KAINS_ID` varchar(36) DEFAULT NULL,
  `KAINS_DATE` varchar(36) DEFAULT NULL,
  `MANAGER_ID` varchar(36) DEFAULT NULL,
  `MANAGER_DATE` datetime DEFAULT NULL,
  `KEU_ID` varchar(36) DEFAULT NULL,
  `KEU_DATE` datetime DEFAULT NULL,
  `STATUS_VICE` varchar(1) DEFAULT NULL,
  `WADIR_ID` varchar(36) DEFAULT NULL,
  `WADIR_DATE` datetime DEFAULT NULL,
  `STATUS_DIR` varchar(1) DEFAULT NULL,
  `DIR_ID` varchar(36) DEFAULT NULL,
  `DIR_DATE` varchar(36) DEFAULT NULL,
  `STATUS_COM` varchar(1) DEFAULT NULL,
  `COM_ID` varchar(36) DEFAULT NULL,
  `COM_DATE` datetime DEFAULT NULL,
  `INV_KAINS_ID` varchar(36) DEFAULT NULL,
  `INV_KAINS_DATE` datetime DEFAULT NULL,
  `INV_MANAGER_ID` varchar(36) DEFAULT NULL,
  `INV_MANAGER_DATE` datetime DEFAULT NULL,
  `INV_VICE_ID` varchar(36) DEFAULT NULL,
  `INV_VICE_DATE` datetime DEFAULT NULL,
  `INV_DIR_ID` varchar(36) DEFAULT NULL,
  `INV_DIR_DATE` datetime DEFAULT NULL,
  `INV_KEU_ID` varchar(36) DEFAULT NULL,
  `INV_KEU_DATE` datetime DEFAULT NULL,
  `METHOD` varchar(1) DEFAULT NULL,
  `CITO` varchar(1) DEFAULT 'N',
  `TYPE` varchar(2) DEFAULT '0',
  `STATUS` varchar(2) DEFAULT '0',
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`NO_PEMESANAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_lgu_satuan_ms`;

CREATE TABLE `dt01_lgu_satuan_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `SATUAN_ID` varchar(36) NOT NULL,
  `SATUAN` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`SATUAN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_lgu_supplier_ms`;

CREATE TABLE `dt01_lgu_supplier_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `SUPPLIER_ID` varchar(36) NOT NULL,
  `SUPPLIER` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`SUPPLIER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_med_anamnesa_rj_hd`;

CREATE TABLE `dt01_med_anamnesa_rj_hd` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `PASIEN_ID` varchar(36) DEFAULT NULL,
  `EPISODE_ID` varchar(36) DEFAULT NULL,
  `HEIGHT` float DEFAULT 0,
  `WEIGHT` float DEFAULT 0,
  `BMI` float DEFAULT 0,
  `TEMP` float DEFAULT 0,
  `SYSTOLIC` float DEFAULT 0,
  `DIASTOLIC` float DEFAULT 0,
  `HR` float DEFAULT 0,
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_med_jadwal_dokter`;

CREATE TABLE `dt01_med_jadwal_dokter` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `POLI_ID` varchar(36) DEFAULT NULL,
  `HARI_ID` varchar(1) DEFAULT NULL,
  `JAM_MULAI` varchar(5) DEFAULT NULL,
  `JAM_SELESAI` varchar(5) DEFAULT NULL,
  `SLOT` varchar(100) DEFAULT NULL,
  `KUOTA_ONLINE` int(11) DEFAULT 0,
  `KUOTA_OTS` int(11) DEFAULT 0,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_med_kolegium_ms`;

CREATE TABLE `dt01_med_kolegium_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `KOLEGIUM_ID` varchar(36) NOT NULL,
  `KOLEGIUM` varchar(1000) DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `DESCRIPTION_ENG` varchar(1000) DEFAULT NULL,
  `ICON` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  PRIMARY KEY (`KOLEGIUM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_med_ok_chat_dt`;

CREATE TABLE `dt01_med_ok_chat_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `CHAT_ID` varchar(36) NOT NULL,
  `OPERASI_ID` varchar(36) DEFAULT NULL,
  `CHAT` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`CHAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_med_ok_hd`;

CREATE TABLE `dt01_med_ok_hd` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `PASIEN_ID` varchar(36) DEFAULT NULL,
  `EPISODE_ID` varchar(36) DEFAULT NULL,
  `PROVIDER_ID` varchar(36) DEFAULT NULL,
  `PACKAGE_ID` varchar(36) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `TIME_IN` varchar(5) DEFAULT NULL,
  `TIME_OUT` varchar(5) DEFAULT NULL,
  `DIAGNOSIS` varchar(1000) DEFAULT NULL,
  `BASIC_DIAGNOSIS` varchar(1000) DEFAULT NULL,
  `TINDAKAN` varchar(100) DEFAULT NULL,
  `INDIKASI_TINDAKAN` varchar(1000) DEFAULT NULL,
  `PROCEDURES` varchar(1000) DEFAULT NULL,
  `PURPOSE` varchar(1000) DEFAULT NULL,
  `RISK` varchar(1000) DEFAULT NULL,
  `PROGNOSIS` varchar(1000) DEFAULT NULL,
  `ALTERNATIVE` varchar(1000) DEFAULT NULL,
  `SAVE` varchar(1000) DEFAULT NULL,
  `DOKTER_OPR` varchar(36) DEFAULT NULL,
  `DOKTER_ANS` varchar(36) DEFAULT NULL,
  `DOKTER_ANK` varchar(36) DEFAULT NULL,
  `CITO` varchar(1) DEFAULT 'N',
  `STATUS` varchar(2) DEFAULT '0',
  `AGREE_ID` varchar(36) DEFAULT NULL,
  `AGREE_DATE` datetime DEFAULT NULL,
  `REASON_ID` varchar(36) DEFAULT NULL,
  `REASON_BY` varchar(36) DEFAULT NULL,
  `REASON_DATE` datetime DEFAULT NULL,
  `BENEFIT` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_med_poli_ms`;

CREATE TABLE `dt01_med_poli_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `POLI_ID` varchar(36) NOT NULL,
  `POLI_ID_OLD` varchar(100) DEFAULT NULL,
  `POLI` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`POLI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_receivedata_data_leka`;

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

DROP TABLE IF EXISTS `dt01_report_income_dt`;

CREATE TABLE `dt01_report_income_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANSAKSI_ID` varchar(36) NOT NULL,
  `DATE` date DEFAULT NULL,
  `U_RJ` decimal(10,0) DEFAULT 0,
  `U_RI` decimal(10,0) DEFAULT 0,
  `A_RJ` decimal(10,0) DEFAULT 0,
  `A_RI` decimal(10,0) DEFAULT 0,
  `B_RJ` decimal(10,0) DEFAULT 0,
  `B_RI` decimal(10,0) DEFAULT 0,
  `MCU_CASH` decimal(10,0) DEFAULT 0,
  `MCU_INV` decimal(10,0) DEFAULT 0,
  `LAIN` decimal(10,0) DEFAULT 0,
  `POB` decimal(10,0) DEFAULT 0,
  `K_URJ` int(11) DEFAULT 0,
  `K_URI` int(11) DEFAULT 0,
  `K_ARJ` int(11) DEFAULT 0,
  `K_ARI` int(11) DEFAULT 0,
  `K_BRJ` int(11) DEFAULT 0,
  `K_BRI` int(11) DEFAULT 0,
  `K_MCU_CASH` int(11) DEFAULT 0,
  `K_MCU_INV` int(11) DEFAULT 0,
  `ACTIVE` varchar(1) DEFAULT '1',
  PRIMARY KEY (`TRANSAKSI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_satusehat_bundle`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

