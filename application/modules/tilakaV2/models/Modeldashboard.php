<?php
    class Modeldashboard extends CI_Model{

        function periode(){
            $query =
                    "
                        SELECT 
                        DATE_FORMAT(created_date, '%Y-%m') AS periode,
                        CONCAT(
                            ELT(MONTH(created_date),
                                'Januari','Februari','Maret','April','Mei','Juni',
                                'Juli','Agustus','September','Oktober','November','Desember'
                            ),
                            ' ',
                            YEAR(created_date)
                        ) AS keterangan
                    FROM dt01_gen_document_file_dt
                    GROUP BY 
                        YEAR(created_date),
                        MONTH(created_date)
                    ORDER BY 
                        YEAR(created_date) DESC,
                        MONTH(created_date) DESC;


                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dokumentteuser($orgid,$periode){
            $query =
                    "
                        SELECT 
                            a.assign,
                            u.name,
                            COUNT(a.no_file) AS jml
                        FROM dt01_gen_document_file_dt a
                        LEFT JOIN dt01_gen_user_data u
                            ON u.nik = a.assign
                        WHERE a.active = '1'
                        AND a.org_id = '".$orgid."'
                        AND a.status_sign = '5'
                        AND a.created_date >= CONCAT('".$periode."', '-01')
                        AND a.created_date <  CONCAT('".$periode."', '-01') + INTERVAL 1 YEAR
                        GROUP BY 
                            a.assign,
                            u.name
                        ORDER BY 
                            jml asc;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>