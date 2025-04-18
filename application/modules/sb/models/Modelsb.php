<?php
    class Modelsb extends CI_Model{

        function periode(){
            $query =
                    "
                        select distinct date_format(tgl_registrasi, '%Y')periode
                        from reg_periksa a
                        order by periode desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function databulan($tahun) {
            $tanggal_awal = $tahun . '-01-01';
            $tanggal_akhir = $tahun . '-12-31';

            $query = "
                WITH RECURSIVE calendar AS (
                    SELECT DATE('$tanggal_awal') AS tanggal
                    UNION ALL
                    SELECT DATE_ADD(tanggal, INTERVAL 1 DAY)
                    FROM calendar
                    WHERE tanggal < DATE('$tanggal_akhir')
                )
                SELECT 
                    DATE_FORMAT(tanggal, '%d') AS tanggal,
                    CASE DAYOFWEEK(tanggal)
                        WHEN 1 THEN 'Minggu'
                        WHEN 2 THEN 'Senin'
                        WHEN 3 THEN 'Selasa'
                        WHEN 4 THEN 'Rabu'
                        WHEN 5 THEN 'Kamis'
                        WHEN 6 THEN 'Jumat'
                        WHEN 7 THEN 'Sabtu'
                    END AS nama_hari,
                    DATE_FORMAT(tanggal, '%m') AS bulan,
                    DATE_FORMAT(tanggal, '%Y') AS tahun,
                    DATE_FORMAT(tanggal, '%Y.%m.%d') AS parameter,
                    (select coalesce(u_rj,0) from dt01_report_income_dt where date=tanggal) urj,
                    (select coalesce(u_ri,0) from dt01_report_income_dt where date=tanggal) uri,
                    (select coalesce(a_rj,0) from dt01_report_income_dt where date=tanggal) arj,
                    (select coalesce(a_ri,0) from dt01_report_income_dt where date=tanggal) ari,
                    (select coalesce(b_rj,0) from dt01_report_income_dt where date=tanggal) brj,
                    (select coalesce(b_ri,0) from dt01_report_income_dt where date=tanggal) bri,
                    (select coalesce(lain) from dt01_report_income_dt where date=tanggal) lain
                    
                FROM calendar;
            ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

        



    }
?>