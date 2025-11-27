DROP TABLE IF EXISTS `dt01_gen_callback_it`;

CREATE TABLE `dt01_gen_callback_it` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `CALLBACK_ID` varchar(36) NOT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CALLBACK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_department_ms`;

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
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT NULL,
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
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `REQUEST_ID` varchar(36) DEFAULT NULL,
  `NOTE` text,
  `SOURCE_FILE` varchar(255) DEFAULT NULL,
  `STATUS_FILE` varchar(1) DEFAULT '0' COMMENT '0 : File Tidak Ada\r\n1 : File Ada\r\n2 : File Dilakukan Merge',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `USER_IDENTIFIER` varchar(1000) DEFAULT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`NO_FILE`,`ACTIVE`,`CREATED_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_document_ms`;

CREATE TABLE `dt01_gen_document_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `JENIS_DOC` varchar(10) NOT NULL,
  `DOCUMENT_NAME` varchar(100) DEFAULT NULL,
  `JENIS_ID` varchar(1) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`JENIS_DOC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "001", "Triase IGD", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "002", "SBPK", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "003", "Hasil Labor", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "004", "Hasil Radiologi", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "005", "Resume Medis Rajal", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "006", "Resume Medis Rawat Inap", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "007", "Laporan Operasi", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "008", "SPRI", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "009", "Penilaian Awal Medis IGD", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "010", "Penilaian Awal Medis Ranap", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "011", "Resep Obat", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "012", "Partograf", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "013", "Surat Kontrol", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "014", "Hasil Labor 1", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "015", "Hasil Labor 2", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "016", "Hasil Labor 3", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "017", "Hasil Labor 4", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "018", "Hasil Radiologi 2", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "019", "Resep Obat 1", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "020", "Resep Obat 2", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "021", "Resep Obat 3", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "022", "SEP", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "023", "SEP", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "048", "Hasil Radiologi", "1", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 22:20:43");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "052248", "Surat Izin Operasional Rumah Sakit (SIO RS) / Izin Penyelenggaraan RS dari Kemenkes", "2", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-19 11:39:24");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "065", "Surat Keterangan Lahir", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "066", "Billing", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "067", "Resep Obat", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "068", "SKDP", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "079", "SEP Ranap", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-04-15 10:54:25");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "086", "PA Jaringan", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-08-19 11:37:41");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "091", "Surat Kematian", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "092", "Hasil Labor 5", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "094", "Hasil Labor 7", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "095", "Hasil Labor 8", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "096", "Hasil Labor 9", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "097", "Hasil Labor 10", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "098", "Hasil Labor 11", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "099", "Document", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "100", "Hasil Labor 13", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "101", "Hasil Labor 14", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "102", "Hasil Labor 15", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "103", "Hasil Labor 16", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "104", "Hasil Labor 17", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "105", "Hasil Labor 18", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "106", "Hasil Labor 19", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "107", "Hasil Labor 20", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "108", "Hasil Radiologi 3", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "109", "Hasil Radiologi 4", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "110", "Hasil Radiologi 5", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "111", "Hasil Radiologi 6", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "112", "Resep Obat 4", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "113", "Resep Obat 5", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "114", "Resep Obat 6", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "115", "Resep Obat 7", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "116", "Resep Obat 8", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "117", "Resep Obat 9", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "118", "Resep Obat 10", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "119", "Resep Obat 11", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "120", "Resep Obat 12", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "121", "Resep Obat 13", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "122", "Resep Obat 14", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "123", "Resep Obat 15", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "124", "Resep Obat 16", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "125", "Resep Obat 17", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "126", "Resep Obat 18", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "127", "Resep Obat 19", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2024-12-19 10:55:34");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "144165", "Surat Izin Praktek (SIP)", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:01:01");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "146921", "Perjanjian Kerja Sama (PKS)", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:56:55");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "172295", "PJK3 RS", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:55:27");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "185672", "SIK", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:55:06");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "345667", "Tanda Daftar Rumah Sakit (TDRS) (jika masih berlaku).", "2", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-19 11:44:24");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "407032", "Kalibrasi", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:52:54");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "500941", "SKP DOKTER MCU", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:55:57");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "524949", "Izin IPAL", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:01:24");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "540397", "Nomor Induk Berusaha (NIB) dari OSS-RBA", "2", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-19 11:37:41");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "562550", "Sertifikat Akreditasi Rumah Sakit (KARS/LAM-KPRS)", "2", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-19 11:46:28");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "587974", "Izin B3", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:01:48");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "629594", "Akta Pendirian dan/atau Perubahan Badan Hukum (Notaris, Kemenkumham)", "2", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-19 11:36:30");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "700233", "Izin BAPETEN", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:53:14");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "719384", "Surat Domisili Usaha (jika masih diperlukan sesuai regulasi daerah)", "2", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-19 11:45:31");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "726867", "Standart Operasional Procedure", "2", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-20 23:52:23");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "730347", "Surat Izin Operasional Rumah Sakit (SIO RS)", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-28 14:35:57");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "777733", "Sertifikat Standar Bangunan & Prasarana RS (termasuk IMB/PBG)", "1", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-19 11:46:37");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "779590", "Ukes Pesawat Sinar X", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:53:42");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "786636", "Izin Genset", "2", "1", "45e8cc43-1d60-4c0e-b385-5559fbae5736", "2025-08-29 09:04:48");
INSERT INTO `dt01_gen_document_ms` VALUES ("d5e63fbc-01ec-4ba8-90b8-fb623438b99d", "827177", "NPWP Badan Usaha", "2", "1", "2f657e5b-c6fe-48d3-840c-ccb35da4f66d", "2025-08-19 11:45:10");
INSERT INTO `dt01_gen_document_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "xxx", "Tets", "1", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-03-14 22:06:13");


DROP TABLE IF EXISTS `dt01_gen_enviroment_ms`;

CREATE TABLE `dt01_gen_enviroment_ms` (
  `ORG_ID` varchar(36) NOT NULL,
  `ENV_ID` varchar(36) NOT NULL,
  `ENVIRONMENT_NAME` varchar(1000) NOT NULL,
  `DEV` varchar(1000) NOT NULL,
  `PROD` varchar(1000) DEFAULT NULL,
  `JENIS` varchar(1) DEFAULT '0',
  `URUT` int(11) DEFAULT '0',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ENV_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "0a9b8755-68ff-410f-aa9d-721d07f15c4a", "WA_GATEWAY", "http://192.168.102.13:5001", "http://192.168.102.13:5001", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "2621c461-0ecf-491e-8495-99166b904b2d", "END_VALID_ACTIVITY", "5", "7", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "3494fa6b-f012-4c40-8cae-70ab8a398b89", "KEY_EKLAIM", "af88024790f81eb9fafb3266bf0aae2c38f01f06b0f437ab2dac6686ecbd427f", "af88024790f81eb9fafb3266bf0aae2c38f01f06b0f437ab2dac6686ecbd427f", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "4b57850c-0445-4b5a-b397-57a09479f0bd", "CLIENTID_SATUSEHAT", "wYiLSpaT4s7GR24ZqGvC1iyG2GBDZeYGEYvDeonE750ahy8h", "wYiLSpaT4s7GR24ZqGvC1iyG2GBDZeYGEYvDeonE750ahy8h", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "4cf1de59-1805-4649-bfd9-054b067d527d", "CLIENT_ID_TILAKA", "be2642fe-a581-4a69-aaad-ed8174dddc7e", "883e32fc-b894-4fc8-bcf6-4c37ecf8dc33", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "4cf2982c-8906-43d4-8a69-bca58f0cbdf0", "SERVER_EKLAIM", "http://192.168.56.101/", "http://192.168.56.101/", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "4f07a29b-f73b-4c9a-8900-da9a7d716524", "MAX_VALUE_ASSESSMENT", "30", "60", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "53958b2a-6f73-4e4f-9703-40b64959d755", "CLIENT_SECRET_TILAKA", "3fa22ba0-7a81-4244-9694-b857f0e83cd8", "J6NMsVDWttBwSma06Z38AsDC7kmNu1gb", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "573a2b21-138b-4bcf-87a0-33ed3db1a574", "AUTHURL_SATUSEHAT", "https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1", "https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "5a9bc4e9-77f9-441d-8e69-2785a7e147f8", "TILAKA_BASE_URL", "https://sb-api.tilaka.id/", "https://sb-api.tilaka.id/", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "678bb734-3849-4a84-8c1b-3526c6029f95", "TILAKALITE_URL", "http://10.10.11.253:8088/", "http://10.10.11.77:8088/", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "67aeb868-636b-4e86-9cc1-690bbba5216d", "PATHFILE_POST_TILAKA", "/assets/document", "http://10.10.11.250/webappsagus/berkasrawat/pages/upload/", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "6938614d-276b-4161-a470-32156c1e3980", "PATHFILE_GET_TILAKA", "Z:document", "http://10.10.11.250/webappsagus/berkasrawat/pages/upload/", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "69723f27-ec38-4d73-920f-b51b6a2c444b", "CERTIFICATE", "PERSONAL", "CORPORATE", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "6ac2fbad-c514-4fcd-813d-b4845a5a5999", "MIDDLEWARE_NOTIFICATION", "TRUE", "TRUE", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2025-07-09 09:45:37");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "6bba06d0-4387-4585-95d1-42f3cbd6d682", "END_VALID_ASSESSMENT", "2", "7", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "7b31610f-f3de-4dde-86b6-6c22e8a2f309", "COORDINATE_X", "26", "60", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "90ff66de-ace0-491d-9843-74f8b7d57886", "CLIENTSECRET_SATUSEHAT", "dcBZIfHwKr81OivmudeTJr8411fTJSFRikeNdniISGZ9GrXAvHpsjQlrkumHBXiC", "dcBZIfHwKr81OivmudeTJr8411fTJSFRikeNdniISGZ9GrXAvHpsjQlrkumHBXiC", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "a7a2ef53-c1df-4911-9e02-f4bebfa9e4ee", "COORDINATE_Y", "24", "20", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "ae4ade89-db55-4d46-a7e9-25ceeeb56a50", "MAX_VALUE_ACTIVITY", "70", "40", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "b0034df2-52e3-4467-9b9f-f42359891bf4", "BASE_URL", "http://192.168.102.13/dtechnology/index.php", "http://192.168.102.13/dtechnology/index.php", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "b61b421d-b824-41a5-ad14-a4c412e4e11e", "HEIGHT", "30", "62", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "c952ea22-ef19-4aa6-9a11-0b639cdb9dbc", "ORG_ID", "10c84edd-500b-49e3-93a5-a2c8cd2c8524", "10c84edd-500b-49e3-93a5-a2c8cd2c8524", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 10:25:12");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "d1f96ded-4df9-4c4a-9b28-14814d91e392", "PATHFILE_POST_DTECH", "\\\\192.168.102.50\\nas\\document\\", "\\\\192.168.102.50\\nas\\document\\", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "dd94948b-d9c2-4acb-a0b9-e4258b213337", "SATUSEHAT_BASE_URL", "https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1", "https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "dfefa28c-c03a-425c-9557-ebb6d37ba4ee", "WIDTH", "40", "62", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "e847ce7a-835f-4a9a-a163-1f9e874497a0", "START_VALID_ASSESSMENT", "1", "1", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "fda0e07a-f1f9-4a7e-9b7f-5b2501dd5e8d", "PAGE", "1", "1", "0", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");
INSERT INTO `dt01_gen_enviroment_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "SIGNATUREIMAGES", "SIGNATUREIMAGES", "DEFAULT", "DEFAULT", "1", "0", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-26 09:21:18");


DROP TABLE IF EXISTS `dt01_gen_master_ms`;

CREATE TABLE `dt01_gen_master_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `MASTER_ID` varchar(36) NOT NULL,
  `CODE` varchar(100) DEFAULT NULL,
  `MASTER_NAME` varchar(1000) DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `COLOR` varchar(100) DEFAULT NULL,
  `ICON` varchar(100) DEFAULT NULL,
  `JENIS_ID` varchar(100) DEFAULT NULL,
  `URUT` int(11) DEFAULT '0',
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MASTER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_master_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "0998f038-ea8b-42b8-a7c4-77bfd3d43bb4", "2", "Request Sign", "Waiting Signing User", "info", "", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "0edaebdc-578a-4da8-bd0e-6983290c68f4", "1", "Upload File", "Waiting Request Sign", "info", "", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "21ae6cfe-b859-485b-8f5f-6715b3704e61", "99", "Failed Process", "Please Check Response", "danger", "", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "43fca9ab-d42c-45a9-a7a4-a4fe29ca630f", "98", "Software", "", "info", "", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "76548dc0-9aa9-4ab1-9d31-858f08aced4f", "4", "Process Download", "Waiting Download", "info", "", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "78be5ec4-358b-47c7-9c12-2d27b555989b", "3", "File In Process", "Waiting Process", "success", "", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "7ccbcea0-895a-4e78-b179-cc64e9879fa6", "0", "New Document", "Waiting Upload Tilaka Lite", "warning", "", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");
INSERT INTO `dt01_gen_master_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "f5eeac74-cdaf-4868-817e-574c98e755a1", "5", "Finish", "Document Available", "success", "", "Statussign_1", "2", "1", "55b16625-efca-4093-8df0-20fc838f21b1", "2025-01-03 21:34:16");


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
  `URUT` int(11) NOT NULL DEFAULT '0',
  `QUICK` varchar(1) DEFAULT 'N',
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MODULES_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_modules_ms` VALUES ("01b1b52a-7d47-4352-b145-37d9bb2646c3", "Tilaka", "", "45304d5b-390d-4618-a08d-793b475f37b7", "tilaka", "", "Y", "bi bi-filetype-pdf", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("029f2730-7ee9-4383-a409-4b5fe0d61fcc", "Request", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "request", "N", "bi bi-file-earmark-spreadsheet", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("039076f7-393b-4079-b65e-08a8eb673970", "Master Suppliers", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "mastersuppliers", "N", "bi bi-database-add", "0", "10", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("04dec2e8-317f-419d-8c38-61b23616e272", "Akreditasi RS", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "akreditasi", "", "Y", "bi bi-layers", "0", "998", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("04ee7f51-5847-4099-9d70-7b4f4d9a989c", "Environment", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "environment", "N", "bi bi-layers", "0", "6", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("04fb4f1f-0728-46cf-8a81-4b951687b44c", "Overview", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "overview", "N", "bi bi-question-octagon", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("0502bd27-48bf-4d6a-86f0-f7fbe482e9e9", "Simulasi Unit Cost", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "unitcost", "unitcost", "N", "bi-journal-bookmark", "0", "1", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("06901f1c-9a61-46d0-9ace-f01c20635b4b", "Buku Dagang", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "bukudagang", "bukudagang", "N", "bi-journal-bookmark", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("07eab05f-be52-45ce-8a53-8dd69df443f4", "User List", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "user", "N", "bi-people", "0", "1", "N", "9", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("084bfaa9-8dda-4c7f-a54e-882496b77866", "Repository Document", "", "c820e1c6-18d9-4ab1-9fc1-df6e57a6f484", "bsre", "repodocument", "N", "bi bi-archive", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("09939c62-e760-4858-ab0c-81640ccfece0", "Piutang", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "", "Y", "bi bi-layers", "0", "6", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("0c00c0bb-a973-4d30-84b7-ed486a839431", "Payment", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "payment", "N", "bi bi-cash-coin", "0", "10", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("0f614e4d-26f8-4bc2-a58f-2cb974dce6d0", "Piutang Lainnya", "", "09939c62-e760-4858-ab0c-81640ccfece0", "sb", "piutangbpjs", "N", "bi-wallet2", "0", "5", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("0fa18822-c902-4e86-9878-4e7822c4ed77", "Director Approval", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvaldirector", "N", "bi bi-ui-checks", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("0fc5b5fd-f7bd-4139-8568-c5187c5e6539", "Import Data", "", "8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "assets", "importdata", "N", "bi-file-earmark-text", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1048ed1d-fef4-4e19-9df3-21c5fdec338f", "Meeting", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "meeting", "N", "fa-solid fa-handshake", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("113cf5a2-ff11-4091-99d5-afb1c525b23d", "Training", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "training", "N", "bi bi-bookmark-star-fill", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1226a31c-fe9d-4102-9750-a4571a08a8b5", "Setting", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "setting", "N", "bi bi-gear", "0", "8", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("123f022c-72ae-401b-9144-624dad3a906a", "Years", "", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "monev", "kunjunganyears", "N", "bi bi-layers", "0", "3", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1493764d-621d-404e-a5f4-fec983fba347", "Risk Management", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "risk", "", "Y", "bi bi-layers", "0", "998", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("15631583-ee35-4d29-9815-b868148c39d7", "Reserve", "", "45689c70-720c-4b4b-b757-f7f1fc80ad47", "ok", "reserve", "N", "bi bi-calendar-plus", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("171a2550-9fa1-4fe8-84c3-7b61b7cc2c55", "Sign Document", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "signdocument", "N", "bi bi-vector-pen", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("186c47fa-906d-410d-b41c-355eb52e7d10", "Document", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "document", "N", "bi-file-earmark-text", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("18fe701d-5240-4a47-9b4e-8413a1cb2d7c", "Panduan Praktek Klinis", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "masterppk", "N", "i bi-cloud-arrow-up", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1d1d4319-e834-4876-87a9-f3148e17514a", "Daily", "", "ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "monev", "kunjungandaily", "N", "bi bi-layers", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1d64cd6c-a3d8-4b27-8eb3-b0526c7c0a59", "CFO Approval", "", "92525e76-d778-43c8-945b-f2b4bf192627", "paymentponew", "paymentcfo", "N", "bi bi-person-check", "0", "7", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("1eebee7e-a774-4572-a660-8ab49f6a734a", "Dashboard", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "dashboard", "dashboard", "N", "bi bi-grid", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2306f09a-42b9-4b2e-8ea4-4b3cbe830fe3", "Import ASPAK SARANA", "", "8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "assets", "importaspaksarana", "N", "bi-file-earmark-text", "0", "2", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2352e62f-8145-4895-a130-9973e021961d", "Goods Receipt", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "penerimaanbarang", "N", "bi bi-ui-checks", "0", "10", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("266ad13d-4096-4e9b-a1b4-46b46eff0a6c", "Employee", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "employee", "N", "bi bi-person-badge", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("266bd8f2-8e09-404b-985e-0196c14218fa", "Human Resource", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "hrd", "", "Y", "bi bi-people", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("28f66f08-643f-4808-9eca-956a43889705", "Income", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "report", "", "Y", "fa-solid fa-money-bill-trend-up", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2980ec1e-cdbc-4e8c-a000-78cbdacabb34", "Meeting", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "meeting", "schedulemeeting", "N", "fa-solid fa-handshake", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2acf8f9e-9143-4089-b4af-4da2aa25dab6", "Master Item", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "masterbarang", "N", "bi bi-database-add", "0", "10", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2b3eeae4-dbca-4acb-be9a-d434f15cd", "Tickets List", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "eticketlist", "N", "bi bi-question-octagon", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2d595ebf-2f7c-4746-b4ec-fdfc0dec29e6", "Grouping iDRG", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "groupingidrg", "N", "bi-archive", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("2f7dcd72-126e-44e0-a777-4e5aaaaf65cf", "Complaint Instalasi", "", "bc12409b-555f-4bc5-abff-39de931a3b24", "crm", "handlinginstalasi", "N", "bi-person-rolodex", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("32c77b91-425e-48fe-b7fc-8d6fce762bd1", "Chief Medical Officer", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvalcmo", "N", "bi bi-ui-checks", "0", "10", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("3305ffa5-cf74-4201-ba82-06778d0fd10e", "Surat Menyurat", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "surat", "", "Y", "bi bi-envelope-paper", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "Cash Advance", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "pettycash", "", "Y", "fa-solid fa-money-bill-trend-up", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("33ecb1e0-a8f2-47ed-8919-3c4bd057abf1", "Manager Approval", "", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "pettycash", "pettycashmanager", "N", "fa-solid fa-money-bill-trend-up", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("351be4d9-c967-4d44-a1e6-171a98eec8cc", "Director Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appdirector", "N", "bi bi-ui-checks", "0", "7", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("35e888f3-2365-41ff-8d77-26cbffbb4d4b", "Location", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "location", "N", "bi bi-geo-alt", "0", "3", "N", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("361f2f6f-ab8c-4abe-827e-985d40f04f31", "Activity", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "activity", "N", "bi bi-person-badge", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("369829a1-0c08-4672-a98a-b4bb20c03a87", "Simulasi Claim iDRG", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "claimidrg", "N", "i bi-cloud-arrow-up", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("381292cf-8f11-4b9d-a7ab-0975ca73d6c9", "Visual Grafik", "", "682c463e-6e88-42fd-8b84-62cc47182405", "mutu", "grafik", "N", "bi-bar-chart-line", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "Logistic 2.0.0.0", "2.0.0.0", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "logistiknew", "", "Y", "bi bi-box", "0", "7", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("38eab206-952d-4f00-8ef6-f683526ebd9e", "Finance Approval", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentfinance", "N", "bi bi-patch-plus", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("39425516-e7b9-42f9-b23b-02bf04bae967", "Vice Director Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appvice", "N", "bi bi-ui-checks", "0", "6", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("39f6caf9-433f-4266-b6bf-20b8451b5b3c", "Director Approval", "", "92525e76-d778-43c8-945b-f2b4bf192627", "paymentponew", "paymentdirector", "N", "bi bi-person-check", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("3d143838-e2e4-4d31-99a7-af6f1dca434d", "Activity", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "activity", "N", "bi bi-calendar3", "0", "3", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("3ed94f2b-9bca-41d4-b2dd-306d36bdefdb", "Coordinator Approval", "", "92525e76-d778-43c8-945b-f2b4bf192627", "paymentponew", "paymentcoordinator", "N", "bi bi-person-check", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("41d5b303-d4e8-4197-af7b-14a00e070236", "Vice Director Approval", "", "92525e76-d778-43c8-945b-f2b4bf192627", "paymentponew", "paymentvice", "N", "bi-person-check", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("43aff7d4-245c-4e5c-8433-cf173ca745fb", "Finance Approval", "", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "pettycash", "pettycashfinance", "N", "bi bi-patch-plus", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("445c4e53-96b5-4f04-b7d9-60cc6ae88fe1", "Registration", "", "8a89a915-4ec5-41e7-b55c-a357ff7e5e45", "admission", "registration", "N", "fa-solid fa-building-circle-check", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("45304d5b-390d-4618-a08d-793b475f37b7", "Bridging System", "", "", "", "", "C", "", "0", "997", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("45689c70-720c-4b4b-b757-f7f1fc80ad47", "Operating Room", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "ok", "", "Y", "fa-solid fa-bed-pulse", "0", "10", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("4610c39b-de32-450b-812d-db8c37fcc643", "Repository Document", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "repodocument", "N", "bi bi-archive", "0", "2", "N", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("46ea998e-6d8d-4aaa-9709-a3cb26268995", "Chief Pharmacist Officer", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvalcpo", "N", "bi bi-ui-checks", "0", "6", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("47b4877d-7fdf-41de-a2ec-c6f467250478", "Clinical Auth", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "clinicalauth", "N", "bi bi-people", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("49e22574-cb55-450f-9d47-6b895b2caed3", "Modules", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "mastermodules", "N", "bi bi-code-slash", "0", "0", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("4a0e79e8-e219-49a5-bfc4-70d2c9368bc0", "Session Whatsapp", "", "be411246-2878-4dba-b320-554e78749094", "whatsapp", "sessionwhatsapp", "N", "bi bi-box-arrow-in-right", "0", "5", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("4b005992-9db9-45ff-a44a-507a11392603", "Coordinator Approval", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvalkoordinator", "N", "bi bi-ui-checks", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "Master System", "", "266bd8f2-8e09-404b-985e-0196c14218fa", "hrd", "", "Y", "bi bi-database-fill", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("50e11dfd-7c94-4f7e-a66b-347b7e506fe5", "Manager Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appmanager", "N", "bi bi-patch-plus", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("510acdce-1c9c-49ab-8f91-fc8a77fc4dc4", "Registrasi", "", "01b1b52a-7d47-4352-b145-37d9bb2646c3", "tilaka", "registrasi", "N", "bi bi-people", "0", "1", "N", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5174bbc4-245d-40cc-91de-b5ec0963bcdf", "Summary", "", "78e83b81-6a97-4037-aaa3-ba964365c43c", "piutang", "summary", "N", "bi-file-earmark-medical", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5324920b-b8e8-4a30-8cd7-a609b5905a71", "Request", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "request", "N", "bi bi-file-earmark-spreadsheet", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("55df0fd0-271f-47ad-9e6f-f32cc2005d40", "Calendar", "", "45689c70-720c-4b4b-b757-f7f1fc80ad47", "ok", "calendar", "N", "bi bi-calendar3", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("56f6fcfd-ece1-493f-80f3-1948fe769fbd", "Procurement", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "monevpo", "monpo", "N", "bi bi-layers", "0", "0", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("589cf172-5ae7-4793-aa9e-f6ffe9c0e374", "Forecasting", "", "b23033e4-2079-44e0-89b0-c26a45c74802", "farmasi", "forecasting", "N", "bi bi-graph-up", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5a5c9286-bdcf-4e39-8c45-169dc334317c", "Finance Approval", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvalfinance", "N", "bi bi-ui-checks", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5e882da7-5b62-4031-8ea2-a849d1e0aa65", "Repository Document", "", "df495870-8f19-41a1-943e-5d36ea0553db", "tilakaV2", "repodocument", "N", "bi bi-archive", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("5e9a1b26-93fe-4dbc-af0e-2967710e4483", "Role List", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "role", "N", "bi-person-badge", "0", "2", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6329ddd6-a27c-427c-bd82-2ee278145a01", "Piutang", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "piutangsum", "N", "bi-box-arrow-in-down", "0", "10", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("635e52ec-e7d3-4a67-9616-fdadd0eceb61", "Nurse/Midwife Committee", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "komiteperawat", "", "Y", "fa-solid fa-user-nurse", "0", "6", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("65e39b7b-a4ee-4045-a6f0-73667f5026d8", "Daily", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "report", "daily", "N", "fa-solid fa-money-bill-trend-up", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("67075482-7943-4031-bb64-bd22997e5b3e", "Sign Document", "", "df495870-8f19-41a1-943e-5d36ea0553db", "tilakaV2", "signdocument", "N", "bi bi-vector-pen", "0", "3", "N", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("68228796-8ea0-4b51-9fef-f9ba7a365f3e", "Payroll", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "payroll", "", "N", "bi bi-cash-stack", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("682c463e-6e88-42fd-8b84-62cc47182405", "Indikator Mutu", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "mutu", "", "Y", "bi bi-layers", "0", "998", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("687b3adc-f1ad-4849-8bef-ee2121faddcc", "Submission", "", "337a0c78-4b48-482c-a24e-d60d5d6fc2d4", "pettycash", "pettycashit", "N", "fa-solid fa-money-bill-trend-up", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6a3b9836-1cc2-4b8a-ba2f-a5dad734412c", "Rawat Jalan", "", "825a61cb-a0ba-4e96-8dd8-6a93bc938ec2", "monevfarmasi", "rawatjalan", "N", "bi bi-layers", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6a46e562-67e5-43e9-bbce-e2a6fd0927b4", "Provider", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "provider", "N", "bi-building", "0", "1", "N", "9", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "IT Operation", "", "", "", "", "C", "", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6e7b2a67-7d3e-4149-8a1b-4ac778d0881e", "Schedule Shift", "", "266bd8f2-8e09-404b-985e-0196c14218fa", "hrd", "shift", "N", "bi bi-speedometer2", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("6f16eda7-a88e-4ee2-a29c-cc4eeef7ebc2", "Trend Kunjungan", "", "bc12409b-555f-4bc5-abff-39de931a3b24", "crm", "kunjungan", "N", "bi bi-graph-up", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7111d133-d00a-4eda-8094-8bcceb227664", "Director Approval", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentdirector", "N", "bi bi-patch-plus", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("71dfb7c2-4abf-4f93-b989-7d78f255a074", "Registrasi", "", "df495870-8f19-41a1-943e-5d36ea0553db", "tilakaV2", "registrasi", "N", "bi bi-people", "0", "1", "D", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("72fd278b-75dd-4a48-b435-f7efb996969b", "Indikator Unit", "", "682c463e-6e88-42fd-8b84-62cc47182405", "mutu", "indikatorunit", "N", "bi-bar-chart-line", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7320e775-9948-444e-b068-8e69745e77ab", "Anamnesa Rawat Jalan", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "anamnesarj", "N", "bi bi-people", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("73917c12-47af-4672-b57a-45b8cffb8e4e", "Casemix", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "casemix", "", "Y", "bi bi-person-raised-hand", "0", "11", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("73a00c77-2213-4317-8249-b9c668dafec5", "Visual Grafik", "", "a0803958-f45b-4857-8125-34e5aec072a1", "po", "grafik", "N", "bi-bar-chart-line", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("746012a8-b265-45d6-8f37-3b44f0134a5d", "Mutasi Rekening", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "rekening", "mutasi", "N", "bi bi-journal-text", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("77893ebe-697b-4a04-a158-5387c98a0041", "Attachment Claim", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "attachmentclaim", "N", "bi bi-question-octagon", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("78d3e701-b660-4ea5-abb8-c935d1387e2d", "FAQ", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "faq", "N", "bi bi-question-octagon", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("78e83b81-6a97-4037-aaa3-ba964365c43c", "Piutang", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "piutang", "", "Y", "bi-wallet2", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("78f2fea7-efe5-4d45-9dc2-9b94eb9d6f5d", "Master Client", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "masterclient", "N", "bi bi-database-fill", "0", "0", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:59:33");
INSERT INTO `dt01_gen_modules_ms` VALUES ("790fa060-ce1a-4819-aee5-89f71d23af32", "Detail Pendapatan", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "detailpendapatan", "N", "bi-cash-stack", "0", "2", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7bbea57e-90f9-4443-a040-eccb68adf3d3", "Details Of Clinical Authority", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "details", "N", "bi bi-people", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7c69522f-cebf-4377-945a-3324b0a26baa", "Developer", "", "", "", "", "C", "", "0", "999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7e0b2ac1-cdac-4eee-8392-fa92e227fa2c", "Template Design", "", "988c76dd-f5d3-4aca-bea2-1249f980bfc9", "masterroot", "templatedev", "N", "bi bi-compass", "0", "999", "N", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:25:26");
INSERT INTO `dt01_gen_modules_ms` VALUES ("7fbc53be-5182-4868-9051-bd0fead47b5e", "Request Payment", "", "92525e76-d778-43c8-945b-f2b4bf192627", "paymentponew", "paymentrequest", "N", "bi bi-receipt", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8004f8a1-e87b-4440-8421-db2f1e0fe1bb", "Asuransi", "", "78e83b81-6a97-4037-aaa3-ba964365c43c", "piutang", "asuransi", "N", "bi-file-earmark-medical", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8145d693-aa4c-4303-916c-d6bd6eac9d2d", "Piutang BPJS", "", "09939c62-e760-4858-ab0c-81640ccfece0", "sb", "piutangbpjs", "N", "bi-file-earmark-medical", "0", "2", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8153a09f-882f-4922-bd38-2d6b0e66d997", "Self Assessment", "", "04dec2e8-317f-419d-8c38-61b23616e272", "akreditasi", "selfassessment", "N", "bi-bar-chart-line", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("825a61cb-a0ba-4e96-8dd8-6a93bc938ec2", "Farmasi", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "monevfarmasi", "", "Y", "bi bi-layers", "0", "998", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("842e2951-3e7b-4d46-adc4-899ae8dc215b", "Chief Medical Device", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvalcmd", "N", "bi bi-ui-checks", "0", "7", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("868afde4-08e8-4899-b596-301c1bae2258", "Service API", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "logservice", "N", "bi bi-layers", "0", "5", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8961b50e-6274-49de-a0b2-203e2139f5c4", "Upload Claim", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "uploadclaim", "N", "i bi-cloud-arrow-up", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8a89a915-4ec5-41e7-b55c-a357ff7e5e45", "Admission InPatient", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "admission", "", "Y", "fa-solid fa-building-circle-check", "0", "9", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8ace90ab-ffeb-49ab-a9ce-9dbf1d9b99d3", "Indikasi Fragmentasi", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "fragmentasi", "N", "bi bi-question-octagon", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8b5e1a58-998a-405e-aa30-ece15e455973", "History", "", "", "", "", "A", "bi bi-clock-history", "0", "997", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8c9136b3-7e71-41b0-ba29-8856fd434a17", "View Tickets", "", "f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "support", "eticketview", "N", "bi bi-question-octagon", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8f476463-92c6-42e4-a6fb-4678a1354542", "Handling Complaint", "", "bc12409b-555f-4bc5-abff-39de931a3b24", "crm", "handling", "N", "bi bi-exclamation-circle-fill", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "Master System", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "mastersystem", "", "Y", "bi bi-database-fill", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "Assets", "", "cda2e6e6-99f8-415d-b52b-320b51b0028a", "assets", "", "Y", "bi-collection", "0", "12", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("92525e76-d778-43c8-945b-f2b4bf192627", "Payment Procurement", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "paymentponew", "", "Y", "bi bi-wallet2", "0", "8", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("938f304c-fb90-49e8-a85d-4c3340b325d5", "Document Legal", "", "ee9b62a0-72f3-42a9-af3f-3faadca592df", "document", "documentlegal", "N", "bi bi-person-raised-hand", "0", "999999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("951544df-6ad1-482d-89e0-4bd3d348e215", "User Access", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "useraccess", "N", "bi bi-layers", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("959f12c0-0fd7-42c2-ad45-9905afae026b", "Chief Technology Officer", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvalcto", "N", "bi bi-ui-checks", "0", "8", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("95b76da7-5f06-4bcf-b7c5-1db3c29bd743", "Finance Approval", "", "92525e76-d778-43c8-945b-f2b4bf192627", "paymentponew", "paymentfinance", "N", "bi bi-cash-stack", "0", "6", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("97ec06dd-7c5b-41ad-bdc5-f6b9bc04d826", "Status", "", "a0803958-f45b-4857-8125-34e5aec072a1", "po", "status", "N", "bi-journal-minus", "0", "5", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("988c76dd-f5d3-4aca-bea2-1249f980bfc9", "Master Root System", "", "7c69522f-cebf-4377-945a-3324b0a26baa", "masterroot", "", "Y", "bi bi-database-fill", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:59:33");
INSERT INTO `dt01_gen_modules_ms` VALUES ("990e096c-bb43-45ed-b15d-5d4c9639fbc8", "MCU", "", "78e83b81-6a97-4037-aaa3-ba964365c43c", "piutang", "mcu", "N", "bi-heart-pulse", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("99d2e39c-89a0-48bc-9117-2770c2d65caa", "SPK", "", "635e52ec-e7d3-4a67-9616-fdadd0eceb61", "komiteperawat", "", "N", "bi bi-people", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("99df9a77-d5a1-48b1-b3b5-a771ded109bf", "Request Payment", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentrequest", "N", "bi bi-receipt", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("9a1cc085-6cc0-40ee-85fc-849357638db3", "SmartBoard", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "sb", "", "Y", "bi bi-layers", "0", "998", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "Apps", "", "", "", "", "C", "", "0", "1", "N", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("9ba71b79-b3dc-41f3-810d-016524a87fdc", "Register", "", "45689c70-720c-4b4b-b757-f7f1fc80ad47", "ok", "register", "N", "bi bi-calendar-week", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a0803958-f45b-4857-8125-34e5aec072a1", "Purchase Order", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "po", "", "Y", "bi bi-layers", "0", "998", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a12feb54-1885-4be6-aa09-2c3523eec3dc", "Emergency Contact", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "emergencycontact", "N", "bi bi-book-half", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a1933745-b711-4e3a-948c-330fd60c23ba", "SPU", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "spu", "N", "bi bi-file-earmark-spreadsheet", "0", "0", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a2d9bdb5-2973-4d60-8cbd-4d88b4286f32", "Department", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "department", "N", "fa-solid fa-building-circle-check", "0", "3", "N", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a3e946b9-29c1-4263-a911-87bc6eba561e", "Hospital Insight", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "insight", "N", "bi-activity", "0", "2", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a6ff226b-2db1-445c-9fdb-482e6177d67f", "Chief Financial Officer", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvalcfo", "N", "bi bi-ui-checks", "0", "9", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a7da4795-00da-4e08-b273-f2a734dec0f6", "BPJS", "", "78e83b81-6a97-4037-aaa3-ba964365c43c", "piutang", "bpjs", "N", "bi-person-badge", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a894d7ed-a10e-4359-804e-8223fde34bbd", "Monitoring Evaluasi", "", "", "", "", "C", "", "0", "4", "N", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a9387d17-2917-4707-bf88-236df398669d", "Surat Masuk", "", "3305ffa5-cf74-4201-ba82-06778d0fd10e", "surat", "suratmasuk", "N", "bi bi-envelope-arrow-down", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("a94724c0-551e-4c2a-80a3-3c551aaa3e97", "CMO Approval", "", "92525e76-d778-43c8-945b-f2b4bf192627", "paymentponew", "paymentcmo", "N", "bi bi-person-check", "0", "8", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("aa816bb5-2197-4c1a-90b2-f1e955063ca8", "Backup Database", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "backupdb", "N", "bi bi-database-fill", "0", "3", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("aba0746b-5fc8-4fb7-aa74-f1487cf42e2d", "Medication Dispanse", "", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "md", "", "Y", "bi bi-filetype-pdf", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("abdabe47-4395-4f92-a66d-3d8844ff34bc", "Absence", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "absence", "absence", "N", "bi bi-clock", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ac002403-e625-4592-b10a-1550e0eeaf02", "Patient History", "", "fce6c4d3-42bc-490a-8b8f-5a150fcfeb4f", "patientservice", "history", "N", "bi-clipboard-heart", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ac2e3614-bff5-4855-b14f-6efeb598855c", "Report KPI", "", "266bd8f2-8e09-404b-985e-0196c14218fa", "hrd", "reportkpi", "N", "bi bi-speedometer2", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ad2aff45-72bb-4f2b-96da-2a9ab6cf33e4", "Stock Opname", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "stockopname", "N", "bi bi-boxes", "0", "10", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("adb30400-f2f2-4eeb-9c79-dc65748f3314", "Detail Pengeluaran", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "detailpengeluaran", "N", "bi-wallet2", "0", "3", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ae4f6173-4853-4a37-a935-143cc3c99f87", "Visual Grafik", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "grafik", "N", "bi-bar-chart-line", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("afdccf7a-59da-4300-beb5-f4eb08cd7f59", "Complaint Manager", "", "bc12409b-555f-4bc5-abff-39de931a3b24", "crm", "handlingmanager", "N", "bi bi-person-lines-fill", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("afee1cd8-72fd-42dc-b5a3-bfb9ec5dc276", "Detail Selisih", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "", "N", "bi-calculator", "0", "4", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b0613c2a-ce2a-4a2e-bc30-08857c34b2b5", "Piutang Asuransi", "", "09939c62-e760-4858-ab0c-81640ccfece0", "sb", "piutangbpjs", "N", "bi-shield-check", "0", "4", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b23033e4-2079-44e0-89b0-c26a45c74802", "Farmasi", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "farmasi", "", "Y", "bi bi-capsule", "0", "11", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b56ff379-5619-4064-b572-407671edc15e", "Education", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "education", "N", "bi bi-book-half", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b76026f2-1c07-4ac4-888c-d33a86ad910e", "Manager Approval", "", "38dbb019-da6f-4ad6-a2b6-c9b766b4b3ca", "logistiknew", "approvalmanager", "N", "bi bi-ui-checks", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "Careers", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "careers", "", "Y", "bi bi-person-raised-hand", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("bacde412-a651-4c8c-8237-155b39a4595b", "Connections", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "connection", "N", "bi bi-link-45deg", "0", "7", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("bc12409b-555f-4bc5-abff-39de931a3b24", "Customer Relationship Management", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "crm", "", "Y", "bi bi-people-fill", "0", "11", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("bc60eda3-abcc-4469-9392-91614e7e9521", "Commissioner Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appcom", "N", "bi bi-ui-checks", "0", "8", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("be411246-2878-4dba-b320-554e78749094", "Whatsapp", "", "45304d5b-390d-4618-a08d-793b475f37b7", "whatsapp", "", "Y", "bi bi-whatsapp", "0", "998", "N", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c1c69eb9-a775-4b56-a7ce-6deb3fec8fab", "Overview", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "overview", "N", "bi bi-speedometer2", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c23d0cb1-f394-4b6c-b35d-e5d0c119f816", "Canister", "", "aba0746b-5fc8-4fb7-aa74-f1487cf42e2d", "md", "canister", "N", "bi bi-filetype-pdf", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c3ef6c77-86a0-40dc-8f33-087871394836", "Document", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "document", "N", "bi bi-archive", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c5a700bc-e6d0-495d-8b17-754b5033d5ec", "Registration", "", "c820e1c6-18d9-4ab1-9fc1-df6e57a6f484", "bsre", "registrasi", "N", "bi bi-people", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c7e5c5cc-ce6d-4c2e-a05e-bf4e2bd9df41", "List Assets", "", "8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "assets", "listassets", "N", "bi-file-earmark-text", "0", "2", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c80fa5ef-7696-4975-9089-a327269cb974", "Piutang MCU", "", "09939c62-e760-4858-ab0c-81640ccfece0", "sb", "piutangbpjs", "N", "bi-heart-pulse", "0", "3", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("c820e1c6-18d9-4ab1-9fc1-df6e57a6f484", "BSRe", "", "45304d5b-390d-4618-a08d-793b475f37b7", "bsre", "", "Y", "bi bi-filetype-pdf", "0", "998", "N", "9", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cbb9bd4f-15d9-4799-a942-b8601961adeb", "Clinical Authority", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "rkk", "N", "bi bi-bookmark-star-fill", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cda2e6e6-99f8-415d-b52b-320b51b0028a", "Finance", "", "", "", "", "C", "", "0", "3", "N", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cdb63dd6-768a-41c7-b56e-01c5e803397f", "Lainnya", "", "78e83b81-6a97-4037-aaa3-ba964365c43c", "piutang", "lain", "N", "bi-credit-card-2-front", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cded1e6e-e203-4dda-ae26-a0c8b30d9f2e", "Manager Approval SPU", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "managerspu", "N", "bi bi-file-earmark-spreadsheet", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("cee04ef5-5635-4e4f-b703-ab50e6ef866a", "Master Indikator", "", "682c463e-6e88-42fd-8b84-62cc47182405", "mutu", "indikator", "N", "bi-bar-chart-line", "0", "1", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d00ef65d-9af6-405c-a8ef-b5e3dc312416", "Quick Report", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "quickreport", "N", "bi bi-layers", "0", "8", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d014e2f9-3d6d-49c7-8a00-63fde9a58b40", "Table Database", "", "6c105bb7-633d-4f59-b0d0-37b6dcc59bb7", "operation", "tabledb", "N", "bi bi-table", "0", "4", "N", "9", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d18f825c-eab9-4e5e-9822-23afa290ba9c", "Hutang", "", "a0803958-f45b-4857-8125-34e5aec072a1", "po", "hutang", "N", "bi-journal-minus", "0", "5", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d52c72cb-f61b-4354-9ffd-6200d2d7da85", "Finance Approval", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "appfinance", "N", "bi bi-ui-checks", "0", "5", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d7ca1a2b-e684-4b50-824d-50540afaa994", "Payment Procurement", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "paymentpo", "", "Y", "bi bi-box", "0", "8", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("d97e8a15-4a46-4389-a8ff-ab0f694d6d95", "Mapping Role", "", "8f9cf15d-8e83-4c75-bcc1-fff8ddd2e614", "mastersystem", "mappingrole", "N", "bi-link", "0", "4", "N", "9", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("df495870-8f19-41a1-943e-5d36ea0553db", "Tilaka V2", "", "45304d5b-390d-4618-a08d-793b475f37b7", "tilakaV2", "", "Y", "bi bi-filetype-pdf", "0", "998", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("dfff16fd-8bc6-410b-8500-3548cf245a86", "Manager Approval", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentmanager", "N", "bi bi-person-check", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("e3a75d9b-132f-47a5-8d3c-fbe2681474a5", "Careers List", "", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "careers", "careerslist", "N", "bi bi-question-octagon", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("e68bda4d-9e9f-4a89-bd23-ca80983eca32", "Daily", "", "28f66f08-643f-4808-9eca-956a43889705", "report", "incomedaily", "N", "fa-solid fa-money-bill-trend-up", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("eaaba437-4823-4819-a912-7bbf789959fe", "Vice Director Approval", "", "d7ca1a2b-e684-4b50-824d-50540afaa994", "paymentpo", "paymentvice", "N", "bi bi-patch-plus", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ebcdc5f7-660b-48cf-99d9-cdf72948af96", "Disposisi", "", "3305ffa5-cf74-4201-ba82-06778d0fd10e", "surat", "disposisi", "N", "bi bi-list-check", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ece1ad09-4d5e-4dcd-98b2-aba0a43aed8a", "Kunjungan", "", "a894d7ed-a10e-4359-804e-8223fde34bbd", "monev", "", "Y", "bi-bank", "0", "998", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ed75d745-1e43-47d4-9c7c-ac9d7b3a46cf", "Monitoring Asset", "", "8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "assets", "monitoringasset", "N", "bi-file-earmark-text", "0", "1", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ee9b62a0-72f3-42a9-af3f-3faadca592df", "Repository Document", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "document", "", "Y", "bi bi-file-earmark-pdf", "0", "999999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("eeb5b08f-596b-4966-8649-f3f119325a67", "Careers Apply", "", "b9e4aa99-b324-4c2c-9c1a-b7ee1e23e3b7", "careers", "careersapply", "N", "bi bi-question-octagon", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ef4a7111-1066-40c6-b43a-2642601c2502", "Buku Dagang", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "bukudagang", "N", "bi-journal-bookmark", "0", "7", "N", "1", "", "2024-04-29 23:10:27");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ef759cae-8fd6-4e36-9790-439e03c3a503", "Logistic", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "logistik", "", "Y", "bi bi-box", "0", "7", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f0f67e7f-5548-44b0-81aa-a60b3bcc39a0", "Import ASPAK ALKES", "", "8ff4efe7-c59a-4e50-8665-cac5174e9ee4", "assets", "importaspakalkes", "N", "bi-file-earmark-text", "0", "3", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "Medical devices", "", "", "", "", "C", "", "0", "997", "N", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f56a43c9-f28d-4230-a0ce-7bf5cd86f2df", "Support Center", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "support", "", "Y", "bi bi-person-raised-hand", "0", "999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f6467930-50af-4ced-a3c7-e8bca55176f9", "Manager Approval", "", "92525e76-d778-43c8-945b-f2b4bf192627", "paymentponew", "paymentmanager", "N", "bi bi-person-check", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f71515e5-57b8-41de-9c49-5e494c497563", "Position", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "position", "N", "bi bi-person-lines-fill", "0", "4", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f7d07231-f33e-4050-a6f8-c846cc6aa031", "Validation", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "validation", "N", "fa-solid fa-list-check", "0", "4", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f88541a9-c8a2-4194-a3a5-6f24e910366f", "Presence", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "kpi", "absensi", "N", "fa-solid fa-list-check", "0", "4", "Y", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:00:57");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f977f8cb-2d62-4f85-a403-93f7ec1fcde1", "Group Activity", "", "4ca01133-e004-428d-bc56-4e9e2dbdbbd6", "hrd", "groupactivity", "N", "bi bi-person-badge", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:31:40");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f9afc38a-bb61-4f98-b593-211766ec6133", "Leka", "", "f48e1e18-d42f-4d70-83e1-6210cdc22e5a", "medicaldevice", "leka", "N", "bi bi-grid", "0", "1", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("f9e7f495-3ac1-4e07-99cc-14160791c745", "Request", "", "ef759cae-8fd6-4e36-9790-439e03c3a503", "logistik", "requestnew", "N", "bi bi-file-earmark-spreadsheet", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "Profile", "", "9b873e90-d8fd-48f3-8c98-ec2aff0c207f", "profile", "", "Y", "bi bi-person", "0", "2", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("fce6c4d3-42bc-490a-8b8f-5a150fcfeb4f", "Patient Services", "", "", "", "", "C", "", "0", "2", "N", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("fd4bd82d-b1c2-4560-95ed-5124ca53e6c1", "Position", "", "fbd656eb-4a2f-4e32-b45c-44467a89a9aa", "profile", "position", "N", "bi bi-book-half", "0", "3", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ff61f738-5cd8-49f9-9005-7236fdefdc6c", "Validation Document", "", "73917c12-47af-4672-b57a-45b8cffb8e4e", "casemix", "validdoc", "N", "bi bi-question-octagon", "0", "9999", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 09:08:59");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ff681bdf-ca8d-4657-87d6-22f660434797", "Management", "", "", "", "", "A", "bi bi-speedometer2", "0", "997", "N", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 08:56:49");
INSERT INTO `dt01_gen_modules_ms` VALUES ("ffe927bc-c43b-4a68-a58f-0544a6e77742", "Mutasi Rekening", "", "9a1cc085-6cc0-40ee-85fc-849357638db3", "sb", "mutasi", "N", "bi-bank", "0", "10", "N", "1", "", "2024-04-29 23:10:27");


DROP TABLE IF EXISTS `dt01_gen_organization_ms`;

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
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ORG_ID`)
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
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`REF_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "1d388997-3327-4746-8e80-0d49f37d1303", "forking postman collection", "informasi langkah-langkah forking postman collection", "https://satusehat.kemkes.go.id/platform/docs/id/postman-workshop/forking/#forking-api", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "9fd2c349-c12b-470c-867c-f21b80df021c", "import postman collection", "formasi langkah-langkah import postman collection.", "https://satusehat.kemkes.go.id/platform/docs/id/postman-workshop/import/#import-api", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "b18e4ceb-2363-4377-985c-b35dcc0a4408", "Certification Practice Statement", "", "https://repository.tilaka.id/CP_CPS.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "c491f152-a328-4868-9331-87142f3f6415", "Kebijakan Privasi", "", "https://repository.tilaka.id/kebijakan-privasi.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "d00e3b9e-933b-42d8-a493-19a41a01cc9a", "Perjanjian Pemilik Sertifikat", "", "https://repository.tilaka.id/perjanjian-pemilik-sertifikat.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "d2b728d9-4f81-44bd-b2dc-acdf546123d8", "Kebijakan Jaminan", "", "https://repository.tilaka.id/kebijakan-jaminan.pdf", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "d326eb39-6755-4ff8-a094-d396102424e3", "Postman Collection Satu Sehat", "Akses Postman Collection SATUSEHAT melalui web browser Anda.", "https://s.id/PostmanSATUSEHAT", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "e4ff825f-b7d1-4aee-98a7-ae71409de23d", "Mail Hostinger", "Akses Email Hostinger", "https://mail.hostinger.com/", "1", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");
INSERT INTO `dt01_gen_referensi_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "ed77c32b-e6ea-4883-971e-999b2d522b10", "Link 9", "", "", "0", "ab24ee31-f74c-4f86-a07b-27196b57e7a6", "2024-04-27 22:59:17");


DROP TABLE IF EXISTS `dt01_gen_role_access`;

CREATE TABLE `dt01_gen_role_access` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `ROLE_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_role_access` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "64f2c65a-e57b-471d-8285-f98cb0369743", "6652e626-4438-4bff-aeef-164598310b94", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-17 16:08:58", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-17 16:08:57");
INSERT INTO `dt01_gen_role_access` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "ff412c05-90fe-4672-83ee-30960e5b4788", "49d35e2c-80f2-4a49-a566-e50271dfe53f", "346ddd36-438f-45a9-a22f-1b11b6dc32e4", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:39", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:30:38");


DROP TABLE IF EXISTS `dt01_gen_role_dt`;

CREATE TABLE `dt01_gen_role_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `ROLE_ID` varchar(36) DEFAULT NULL,
  `MODULES_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_role_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "145f40d0-4d6a-4241-a285-27978c75b964", "346ddd36-438f-45a9-a22f-1b11b6dc32e4", "45304d5b-390d-4618-a08d-793b475f37b7", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:07", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:07");
INSERT INTO `dt01_gen_role_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "82953e39-1b46-41f0-a497-4a09c454b50b", "346ddd36-438f-45a9-a22f-1b11b6dc32e4", "df495870-8f19-41a1-943e-5d36ea0553db", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:11", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:11");
INSERT INTO `dt01_gen_role_dt` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "c64736eb-cd41-4ed0-afdd-9e8c898bcd44", "346ddd36-438f-45a9-a22f-1b11b6dc32e4", "5e882da7-5b62-4031-8ea2-a849d1e0aa65", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:13", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:13");


DROP TABLE IF EXISTS `dt01_gen_role_ms`;

CREATE TABLE `dt01_gen_role_ms` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `ROLE_ID` varchar(36) NOT NULL,
  `ROLE` varchar(1000) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_UPDATED_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_role_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "346ddd36-438f-45a9-a22f-1b11b6dc32e4", "Default", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:02", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-26 21:29:02");
INSERT INTO `dt01_gen_role_ms` VALUES ("be3d71bc-484e-4971-9590-e31e10516c25", "34c2e933-4b1b-47cd-8497-71de44ac4e01", "Administrator Tilaka", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-17 16:05:58", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-17 16:05:58");


DROP TABLE IF EXISTS `dt01_gen_user_asst_dt`;

CREATE TABLE `dt01_gen_user_asst_dt` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `TRANS_ID` varchar(36) NOT NULL,
  `USER_ID` varchar(36) DEFAULT NULL,
  `ASST_ID` varchar(36) DEFAULT NULL,
  `ACTIVE` varchar(1) DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_gen_user_data`;

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
  `DUTY_DAYS` int(11) DEFAULT '0',
  `DUTY_HOURS` int(11) DEFAULT '0',
  `HOURS_MONTH` int(11) DEFAULT '0',
  `SUSPENDED` varchar(1) NOT NULL DEFAULT 'N',
  `KOLEGIUM_ID` varchar(36) DEFAULT NULL,
  `REASON_CODE` varchar(1) DEFAULT NULL,
  `NO_HP` varchar(100) DEFAULT NULL,
  `ACTIVE` varchar(1) NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(36) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ACTIVE_ID` varchar(36) DEFAULT NULL,
  `ACTIVE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `dt01_gen_user_data` VALUES ("d2287574-8d65-4897-a0f7-d74477bbe2d0", "be3d71bc-484e-4971-9590-e31e10516c25", "04a4884b-10fd-4036-86ca-ce012f00c678", "root2", "3832333435363731", "Administrator 2", "Administrator 2", "-", "", "7687686787686786", "", "", "peppitautade-1274@yopmail.com", "", "", "irawan6", "dc6c4189-7ef3-4818-80a1-264efb962cfb", "", "revb001d208-3610-421d-b881-dffd1393b385", "issue-3317bb04-c2c1-4532-8bc1-7f899102a68e", "", "", "2025-11-13 02:57:32", "2026-11-13 02:57:31", "", "N", "Y", "a3b109d6-b792-4883-b176-31bc762de98d", "", "0", "0", "0", "N", "", "1", "", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-13 08:56:18", "", "");
INSERT INTO `dt01_gen_user_data` VALUES ("d2287574-8d65-4897-a0f7-d74477bbe2d0", "be3d71bc-484e-4971-9590-e31e10516c25", "07d5263d-c614-463a-9b77-f6e4a7abd975", "root5", "3832333435363731", "Administrator 4", "Administrator 4", "0", "", "8546548765677654", "", "", "freheprannamei-5605@yopmail.com", "", "", "", "28d841a7-5bcf-4bd5-9a10-40226b9274bd", "", "", "", "", "", "", "", "", "N", "Y", "a3b109d6-b792-4883-b176-31bc762de98d", "", "0", "0", "0", "N", "", "", "", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-13 10:56:53", "", "");
INSERT INTO `dt01_gen_user_data` VALUES ("d2287574-8d65-4897-a0f7-d74477bbe2d0", "be3d71bc-484e-4971-9590-e31e10516c25", "49d35e2c-80f2-4a49-a566-e50271dfe53f", "root1", "3832333435363731", "Administrator 1", "Administrator 1", "0", "", "5675675675675675", "", "", "wauzoillausiri-3393@yopmail.com", "", "", "irawan7", "df4f5f62-8ffb-4801-a694-39ad8d8aadd1", "", "", "", "3", "Aktif", "2025-11-14 06:09:28", "2026-11-14 06:09:27", "", "N", "Y", "a3b109d6-b792-4883-b176-31bc762de98d", "", "0", "0", "0", "N", "", "", "-", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-13 10:33:33", "", "");
INSERT INTO `dt01_gen_user_data` VALUES ("d2287574-8d65-4897-a0f7-d74477bbe2d0", "be3d71bc-484e-4971-9590-e31e10516c25", "569a21b9-15d0-4b6e-8fe8-fb0210749b1a", "14567838", "3832333435363731", "Deni Hidayat", "Deni Hidayat", "14567838", "", "1401061003940003", "", "", "deniforstudying@gmail.com", "", "", "deni123", "d3f9c92b-5e2b-4cc2-9d35-cd8984f7469b", "", "", "", "3", "Aktif", "2025-11-17 11:03:07", "2026-11-17 11:03:06", "", "N", "Y", "a3b109d6-b792-4883-b176-31bc762de98d", "", "0", "0", "0", "N", "", "", "", "1", "", "2025-11-14 13:59:04", "", "");
INSERT INTO `dt01_gen_user_data` VALUES ("d2287574-8d65-4897-a0f7-d74477bbe2d0", "be3d71bc-484e-4971-9590-e31e10516c25", "6652e626-4438-4bff-aeef-164598310b94", "root", "3832333435363731", "Administrator", "Administrator", "1521027", "", "2312312312323432", "", "", "delauzenutro-5535@yopmail.com", "", "", "irawan3", "c597a73e-5a75-470d-bde6-83395b36d218", "", "", "", "3", "Aktif", "2025-11-11 03:00:03", "2026-11-11 03:00:02", "", "N", "Y", "83e9982c-814a-4349-89fb-cbee6f34e340", "", "0", "0", "0", "N", "", "", "081288646630", "1", "", "2025-11-07 08:10:00", "", "");
INSERT INTO `dt01_gen_user_data` VALUES ("d2287574-8d65-4897-a0f7-d74477bbe2d0", "be3d71bc-484e-4971-9590-e31e10516c25", "ce5a4a05-2426-489c-aba0-47fe3e88381b", "root3", "3832333435363731", "Administrator 3", "Administrator 3", "0", "", "7988797897897897", "", "", "xanneddaquoga-5473@yopmail.com", "", "", "irawan8", "c397772a-8a8c-459a-8db8-8523a7a97679", "", "", "", "", "", "", "", "", "N", "Y", "a3b109d6-b792-4883-b176-31bc762de98d", "", "0", "0", "0", "N", "", "", "", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-13 10:50:33", "", "");
INSERT INTO `dt01_gen_user_data` VALUES ("d2287574-8d65-4897-a0f7-d74477bbe2d0", "be3d71bc-484e-4971-9590-e31e10516c25", "fd87df09-c8c7-43a0-b4b6-95eb9ca8259e", "root4", "3832333435363731", "Administrator 5", "Administrator 5", "1521028", "", "6578686786786786", "", "", "quavapizocri-7628@yopmail.com", "", "", "irawan5", "bb990f06-63a8-4bf8-aa70-a97759814e19", "", "", "", "", "", "2025-11-12 10:00:03", "2026-11-12 10:00:02", "", "N", "Y", "a3b109d6-b792-4883-b176-31bc762de98d", "", "0", "0", "0", "N", "", "", "", "1", "6652e626-4438-4bff-aeef-164598310b94", "2025-11-12 16:48:25", "", "");


DROP TABLE IF EXISTS `dt01_hrd_position_dt`;

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
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_UPDATE_BY` varchar(36) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_hrd_position_ms`;

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
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_UPDATE_BY` varchar(36) NOT NULL,
  `LAST_UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`POSITION_ID`)
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

DROP TABLE IF EXISTS `dt01_sek_surat_hd`;

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
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TRANS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_sek_surat_it`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dt01_service_api_logs_out`;

CREATE TABLE `dt01_service_api_logs_out` (
  `ORG_ID` varchar(36) DEFAULT NULL,
  `REQUEST_ID` varchar(13) NOT NULL,
  `REQUEST_METHOD` varchar(6) DEFAULT NULL,
  `REQUEST_URL` text,
  `REQUEST_HEADERS` text,
  `REQUEST_BODY` text,
  `USER_AGENT` text,
  `REMOTE_ADDRESS` varchar(15) DEFAULT NULL,
  `RESPONSE_STATUS` varchar(3) DEFAULT NULL,
  `RESPONSE_HEADERS` text,
  `RESPONSE_BODY` text,
  `APPCONNECT_TIME_US` decimal(18,0) DEFAULT NULL,
  `CONNECT_TIME_US` decimal(18,0) DEFAULT NULL,
  `NAMELOOKUP_TIME_US` decimal(18,0) DEFAULT NULL,
  `PRETRANSFER_TIME_US` decimal(18,0) DEFAULT NULL,
  `REDIRECT_TIME_US` decimal(18,0) DEFAULT NULL,
  `STARTTRANSFER_TIME_US` decimal(18,0) DEFAULT NULL,
  `TOTAL_TIME_US` decimal(18,0) DEFAULT NULL,
  `SOURCE` varchar(1000) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`REQUEST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

