<?php
    class Modelforecasting extends CI_Model{

        function dataforecasting(){
            $query =
                    "
                        SELECT 
                            a.kode_brng,
                            a.nama_brng,
                            kb.nama AS kategori,

                            -- Pemakaian (dari detail_pemberian_obat)
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 1 THEN dpo.jml ELSE 0 END) AS pakai_jan,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 2 THEN dpo.jml ELSE 0 END) AS pakai_feb,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 3 THEN dpo.jml ELSE 0 END) AS pakai_mar,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 4 THEN dpo.jml ELSE 0 END) AS pakai_apr,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 5 THEN dpo.jml ELSE 0 END) AS pakai_mei,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 6 THEN dpo.jml ELSE 0 END) AS pakai_jun,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 7 THEN dpo.jml ELSE 0 END) AS pakai_jul,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 8 THEN dpo.jml ELSE 0 END) AS pakai_ags,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 9 THEN dpo.jml ELSE 0 END) AS pakai_sep,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 10 THEN dpo.jml ELSE 0 END) AS pakai_okt,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 11 THEN dpo.jml ELSE 0 END) AS pakai_nov,
                            SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 12 THEN dpo.jml ELSE 0 END) AS pakai_des,

                            -- Pemesanan (dari detailpesan + pemesanan)
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 1 THEN dp.jumlah ELSE 0 END) AS pesan_jan,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 2 THEN dp.jumlah ELSE 0 END) AS pesan_feb,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 3 THEN dp.jumlah ELSE 0 END) AS pesan_mar,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 4 THEN dp.jumlah ELSE 0 END) AS pesan_apr,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 5 THEN dp.jumlah ELSE 0 END) AS pesan_mei,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 6 THEN dp.jumlah ELSE 0 END) AS pesan_jun,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 7 THEN dp.jumlah ELSE 0 END) AS pesan_jul,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 8 THEN dp.jumlah ELSE 0 END) AS pesan_ags,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 9 THEN dp.jumlah ELSE 0 END) AS pesan_sep,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 10 THEN dp.jumlah ELSE 0 END) AS pesan_okt,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 11 THEN dp.jumlah ELSE 0 END) AS pesan_nov,
                            SUM(CASE WHEN MONTH(p.tgl_faktur) = 12 THEN dp.jumlah ELSE 0 END) AS pesan_des

                        FROM databarang a

                        -- LEFT JOIN untuk pemakaian obat
                        LEFT JOIN detail_pemberian_obat dpo 
                            ON dpo.kode_brng = a.kode_brng AND YEAR(dpo.tgl_perawatan) = 2025

                        -- LEFT JOIN untuk pemesanan
                        LEFT JOIN detailpesan dp 
                            ON dp.kode_brng = a.kode_brng
                        LEFT JOIN pemesanan p 
                            ON dp.no_faktur = p.no_faktur AND YEAR(p.tgl_faktur) = 2025

                        -- JOIN kategori barang
                        LEFT JOIN kategori_barang kb 
                            ON a.kode_kategori = kb.kode

                        WHERE a.status = '1'

                        GROUP BY a.kode_brng, a.nama_brng, kb.nama
                        ORDER BY a.nama_brng ASC;



                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>