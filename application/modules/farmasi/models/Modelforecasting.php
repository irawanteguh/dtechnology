<?php
    class Modelforecasting extends CI_Model{

        function dataforecasting(){
            $query =
                    "
                        SELECT 
                            a.kode_brng,
                            a.nama_brng,

                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 1 THEN dpo.jml ELSE 0 END), 0) AS jan,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 2 THEN dpo.jml ELSE 0 END), 0) AS feb,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 3 THEN dpo.jml ELSE 0 END), 0) AS mar,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 4 THEN dpo.jml ELSE 0 END), 0) AS apr,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 5 THEN dpo.jml ELSE 0 END), 0) AS mei,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 6 THEN dpo.jml ELSE 0 END), 0) AS jun,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 7 THEN dpo.jml ELSE 0 END), 0) AS jul,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 8 THEN dpo.jml ELSE 0 END), 0) AS ags,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 9 THEN dpo.jml ELSE 0 END), 0) AS sep,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 10 THEN dpo.jml ELSE 0 END), 0) AS okt,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 11 THEN dpo.jml ELSE 0 END), 0) AS nov,
                            ROUND(SUM(CASE WHEN MONTH(dpo.tgl_perawatan) = 12 THEN dpo.jml ELSE 0 END), 0) AS des

                        FROM databarang a
                        LEFT JOIN detail_pemberian_obat dpo 
                            ON dpo.kode_brng = a.kode_brng AND YEAR(dpo.tgl_perawatan) = 2025

                        WHERE a.status = '1'

                        GROUP BY a.kode_brng, a.nama_brng
                        ORDER BY a.nama_brng ASC;


                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>