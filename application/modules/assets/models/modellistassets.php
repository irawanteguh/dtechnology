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
                        select a.trans_id, no_assets, name, spesifikasi, serial_number, tahun_pembuatan,
                                date_format(a.created_date, '%d.%m.%Y %H:%i:%s') tgldibuat,
                                date_format(a.tanggal_pembelian, '%d.%m.%Y') tglpembelian,
                                nilai_perolehan, nilai_bunga_pinjaman, nilai_pemeliharaan, nilai_residu, nilai_perijinan, nilai_konsultan, pajak,
                                nilai_ekonomis, masa_bunga,
                                estimasi_penggunaan_day,
                                (select master_name from dt01_gen_master_ms where jenis_id='Asset_1' and code=a.jenis_id)kategori,
                                (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh
                        from dt01_lgu_assets_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by kategori asc
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