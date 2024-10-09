<?php
    class Modelkunjungandaily extends CI_Model{


        function totalkunjungan(){
            $query =
                    "
                        SELECT x.*
                        FROM (
                            SELECT 
                                tgl_registrasi, 
                                DATE_FORMAT(tgl_registrasi, '%d.%m.%Y') AS periode, 
                                DATE_FORMAT(tgl_registrasi, '%d.%m') AS label,
                                COUNT(IF(status_lanjut = 'Ralan', 1, NULL)) AS jmlrj,
                                COUNT(IF(status_lanjut = 'Ranap', 1, NULL)) AS jmlri
                            FROM 
                                reg_periksa a
                            WHERE 
                                a.stts <> 'Batal' 
                                AND tgl_registrasi BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                            GROUP BY 
                                DATE_FORMAT(tgl_registrasi, '%d.%m.%Y')
                        ) x
                        ORDER BY 
                            tgl_registrasi ASC;


                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>