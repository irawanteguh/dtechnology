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
                    DATE_FORMAT(tanggal, '%d.%m.%Y') AS parameter,
                    (select coalesce(u_rj,0) from dt01_report_income_dt where date=tanggal) urj,
                    (select coalesce(u_ri,0) from dt01_report_income_dt where date=tanggal) uri,
                    (select coalesce(a_rj,0) from dt01_report_income_dt where date=tanggal) arj,
                    (select coalesce(a_ri,0) from dt01_report_income_dt where date=tanggal) ari,
                    (select coalesce(b_rj,0) from dt01_report_income_dt where date=tanggal) brj,
                    (select coalesce(b_ri,0) from dt01_report_income_dt where date=tanggal) bri,
                    (select coalesce(lain) from dt01_report_income_dt where date=tanggal) lain,
                    (select coalesce(k_urj) from dt01_report_income_dt where date=tanggal) kurj,
                    (select coalesce(k_uri) from dt01_report_income_dt where date=tanggal) kuri,
                    (select coalesce(k_arj) from dt01_report_income_dt where date=tanggal) karj,
                    (select coalesce(k_ari) from dt01_report_income_dt where date=tanggal) kari,
                    (select coalesce(k_brj) from dt01_report_income_dt where date=tanggal) kbrj,
                    (select coalesce(k_bri) from dt01_report_income_dt where date=tanggal) kbri
                    
                FROM calendar;
            ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

        function cekdata($orgid,$date){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_report_income_dt a
                        where a.org_id='".$orgid."'
                        and   a.date='".$date."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertquickreport($data){           
            $sql =   $this->db->insert("dt01_report_income_dt",$data);
            return $sql;
        }

        function updatequickreport($orgid,$date,$data){           
            $sql =   $this->db->update("dt01_report_income_dt",$data,array("org_id"=>$orgid,"date"=>$date));
            return $sql;
        }


        



    }
?>