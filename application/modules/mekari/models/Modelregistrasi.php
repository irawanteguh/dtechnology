<?php
    class Modelregistrasi extends CI_Model{

        function datakaryawan($orgid){
            $query =
                    "
                        SELECT
                            a.org_id,
                            a.user_id,
                            a.name,
                            NULLIF(a.email, '-') AS email,
                            a.nik,
                            a.identity_no,
                            UPPER(LEFT(a.name, 1)) AS initial,
                            a.image_profile,

                            m.id     AS idregistrasi,
                            m.status AS status,
                            m.url,
                            m.email  AS emailinvitation

                        FROM dt01_gen_user_data a

                        LEFT JOIN (
                            SELECT t1.*
                            FROM dt01_tte_user_mekari_dt t1
                            INNER JOIN (
                                SELECT org_id, user_id, MAX(created_date) AS max_created
                                FROM dt01_tte_user_mekari_dt
                                GROUP BY org_id, user_id
                            ) t2
                                ON t1.org_id = t2.org_id
                            AND t1.user_id = t2.user_id
                            AND t1.created_date = t2.max_created
                        ) m
                            ON m.org_id = a.org_id
                        AND m.user_id = a.user_id

                        WHERE a.org_id = '".$orgid."'
                        AND a.active = '1'

                        ORDER BY a.name ASC;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertusermekari($data){           
            $sql =   $this->db->insert("dt01_tte_user_mekari_dt",$data);
            return $sql;
        }
    }
?>