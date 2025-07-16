<?php
    class modellistassets extends CI_Model{

        function masterbarang($orgid){
            $query =
                    "
                        select a.barang_id, nama_barang
                        from dt01_lgu_barang_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.type='2'
                        order by nama_barang asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function kategoriasset(){
            $query =
                    "
                        select a.code, master_name, icon, color
                        from dt01_gen_master_ms a
                        where a.active='1'
                        and   a.jenis_id='Asset_1'
                        order by master_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterassets($orgid){
            $query =
                    "
                        select a.trans_id, no_assets, no_laporan_penilaian_assets, name, spesifikasi, volume, tahun_pembuatan, estimasi_penggunaan_day, jenis_id,
                                date_format(a.created_date, '%d.%m.%Y %H:%i:%s') tgldibuat,
                                nilai_perolehan, nilai_bunga_pinjaman, nilai_pemeliharaan,
                                round((nilai_perolehan / volume),0) nilaibangunanpermeter,
                                waktu_depresiasi, waktu_bunga,
                                round(
                                        (
                                            (((nilai_perolehan / (waktu_depresiasi * 12)) / 30) / estimasi_penggunaan_day) +
                                            (((nilai_pemeliharaan / (waktu_depresiasi * 12)) / 30) / estimasi_penggunaan_day) +
                                            IF(
                                                waktu_bunga = 0 OR estimasi_penggunaan_day = 0,
                                                0,
                                                (((nilai_bunga_pinjaman / (waktu_bunga * 12)) / 30) / estimasi_penggunaan_day)
                                            )
                                        ),0
                                    )cost,
                                (select master_name from dt01_gen_master_ms where jenis_id='Asset_1' and code=a.jenis_id)kategori,
                                (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh
                        from dt01_lgu_assets_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by kategori asc, created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function masterassets($orgid){
        //     $query =
        //             "
        //                 SELECT 
        //                     a.no_assets, 
        //                     a.name, 
        //                     a.spesifikasi, 
        //                     a.serial_number, 
        //                     a.tahun_pembuatan, 
        //                     DATE_FORMAT(a.tanggal_pembelian, '%d.%m.%Y') AS tglpembelian,
        //                     a.nilai_ekonomis,
        //                     a.masa_bunga,
        //                     a.nilai_perolehan, 
        //                     a.nilai_pemeliharaan, 
        //                     a.nilai_bunga_pinjaman,
        //                     a.nilai_residu,
        //                     a.estimasi_penggunaan_day,

        //                     -- Depresiasi per periode
        //                     ROUND((a.nilai_perolehan - a.nilai_residu) / NULLIF(a.nilai_ekonomis, 0), 0) AS depresiasi_tahun,
        //                     ROUND((a.nilai_perolehan - a.nilai_residu) / NULLIF(a.nilai_ekonomis * 12, 0), 0) AS depresiasi_bulan,
        //                     ROUND((a.nilai_perolehan - a.nilai_residu) / NULLIF(a.nilai_ekonomis * 365, 0), 0) AS depresiasi_hari,
        //                     ROUND(((a.nilai_perolehan - a.nilai_residu) / NULLIF(a.nilai_ekonomis * 365, 0)) / NULLIF(a.estimasi_penggunaan_day, 0), 0) AS depresiasi_pasien,

        //                     ROUND((a.nilai_bunga_pinjaman) / NULLIF(a.masa_bunga, 0), 0) AS bunga_tahun,
        //                     ROUND((a.nilai_bunga_pinjaman) / NULLIF(a.masa_bunga * 12, 0), 0) AS bunga_bulan,
        //                     ROUND((a.nilai_bunga_pinjaman) / NULLIF(a.masa_bunga * 365, 0), 0) AS bunga_hari,
        //                     ROUND(((a.nilai_bunga_pinjaman) / NULLIF(a.masa_bunga * 365, 0)) / NULLIF(a.estimasi_penggunaan_day, 0), 0) AS bunga_pasien,

        //                     ROUND((a.nilai_pemeliharaan) / NULLIF(a.nilai_ekonomis, 0), 0) AS pemeliharaan_tahun,
        //                     ROUND((a.nilai_pemeliharaan) / NULLIF(a.nilai_ekonomis * 12, 0), 0) AS pemeliharaan_bulan,
        //                     ROUND((a.nilai_pemeliharaan) / NULLIF(a.nilai_ekonomis * 365, 0), 0) AS pemeliharaan_hari,
        //                     ROUND(((a.nilai_pemeliharaan) / NULLIF(a.nilai_ekonomis * 365, 0)) / NULLIF(a.estimasi_penggunaan_day, 0), 0) AS pemeliharaan_pasien,

        //                     -- Lama penggunaan (hari)
        //                     DATEDIFF(CURDATE(), a.tanggal_pembelian) AS hari_berjalan,

        //                     -- Total depresiasi sampai saat ini
        //                     ROUND(DATEDIFF(CURDATE(), a.tanggal_pembelian) * 
        //                         (((a.nilai_perolehan+a.nilai_pemeliharaan+nilai_bunga_pinjaman) - a.nilai_residu) / NULLIF(a.nilai_ekonomis * 365, 0)), 0) AS depresiasi_saat_ini,

        //                     -- Nilai buku sisa
        //                     ROUND(a.nilai_perolehan - 
        //                         (DATEDIFF(CURDATE(), a.tanggal_pembelian) * 
        //                         (((a.nilai_perolehan+a.nilai_pemeliharaan+nilai_bunga_pinjaman) - a.nilai_residu) / NULLIF(a.nilai_ekonomis * 365, 0))
        //                         ), 0) AS nilai_buku_sisa,

        //                     (select master_name from dt01_gen_master_ms where jenis_id='Asset_1' and code=a.jenis_id)kategori

        //                 FROM dt01_lgu_assets_ms a
        //                 WHERE a.active = '1'
        //                 AND a.org_id = '".$orgid."'
        //                 order by jenis_id asc

        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        function insertassets($data){           
            $sql =   $this->db->insert("dt01_lgu_assets_ms",$data);
            return $sql;
        }

    }
?>