<?php
    class Modelrepodocument extends CI_Model{

        function userassign($orgid){
            $query =
                    "
                        select a.nik, name
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.certificate='3'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function alldocument(){
            $query =
                    "
                        WITH base AS
                            (
                                SELECT
                                    a.transaksi_id,
                                    a.status_sign,
                                    a.storage_in,
                                    a.storage_out,
                                    a.no_file,
                                    a.url,
                                    a.type_of,
                                    a.provider_sign,
                                    a.from_in,
                                    a.type_certificate,
                                    a.quick_sign,
                                    a.note_1,
                                    a.note_2,
                                    a.request_id,
                                    a.response,
                                    a.download_date,
                                    a.created_date,
                                    DATE_FORMAT(a.created_date,'%d.%m.%Y %H:%i:%s') AS tglbuat,

                                    COALESCE(gd.document_name,a.jenis_doc) AS jenis_doc,

                                    cu.name AS dibuatoleh,

                                    (
                                        SELECT GROUP_CONCAT(
                                            b.name
                                            ORDER BY FIND_IN_SET(
                                                b.nik,
                                                REPLACE(a.signer_id,';',',')
                                            )
                                            SEPARATOR ';'
                                        )
                                        FROM dt01_gen_user_data b
                                        WHERE b.org_id = a.org_id
                                        AND FIND_IN_SET(
                                            b.nik,
                                            REPLACE(a.signer_id,';',',')
                                        )
                                    ) AS name,

                                    (
                                        SELECT GROUP_CONCAT(
                                            b.email
                                            ORDER BY FIND_IN_SET(
                                                b.nik,
                                                REPLACE(a.signer_id,';',',')
                                            )
                                            SEPARATOR ';'
                                        )
                                        FROM dt01_gen_user_data b
                                        WHERE b.org_id = a.org_id
                                        AND FIND_IN_SET(
                                            b.nik,
                                            REPLACE(a.signer_id,';',',')
                                        )
                                    ) AS email,

                                    (
                                        SELECT GROUP_CONCAT(
                                            b.user_identifier
                                            ORDER BY FIND_IN_SET(
                                                b.nik,
                                                REPLACE(a.signer_id,';',',')
                                            )
                                            SEPARATOR ';'
                                        )
                                        FROM dt01_gen_user_data b
                                        WHERE b.org_id = a.org_id
                                        AND FIND_IN_SET(
                                            b.nik,
                                            REPLACE(a.signer_id,';',',')
                                        )
                                    ) AS useridentifier,

                                    ms.color AS colorstatus,
                                    ms.master_name AS namestatus,
                                    ms.description AS descriptionstatus,

                                    ROW_NUMBER() OVER(
                                        PARTITION BY a.status_sign
                                        ORDER BY a.created_date DESC
                                    ) AS rn

                                FROM dt01_sign_document_dt a

                                LEFT JOIN dt01_gen_document_ms gd
                                    ON gd.jenis_doc = a.jenis_doc

                                LEFT JOIN dt01_gen_user_data cu
                                    ON cu.org_id = a.org_id
                                    AND cu.user_id = a.created_by

                                LEFT JOIN dt01_gen_master_ms ms
                                    ON ms.org_id = a.org_id
                                    AND ms.jenis_id='Statussign_2'
                                    AND ms.code=a.status_sign

                                WHERE a.active='1'
                            ),

                            status0 AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign='0'
                            ),

                            status1 AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign='1'
                                limit 10
                            ),

                            status2 AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign='2'
                                limit 10
                            ),

                            status3 AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign='3'
                                limit 10
                            ),

                            status4 AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign='4'
                                limit 10
                            ),

                            status5 AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign='5'
                                AND DATE(download_date) = CURDATE()
                            ),

                            status6 AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign='6'
                                limit 10
                            ),

                            status80 AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign='80'
                                limit 10
                            ),

                            statusfailed AS
                            (
                                SELECT *
                                FROM base
                                WHERE status_sign in ('95','96','97','98','99')
                                limit 10
                            )


                            SELECT *
                            FROM (
                                SELECT * FROM status0
                                UNION ALL
                                SELECT * FROM status1
                                UNION ALL
                                SELECT * FROM status2
                                UNION ALL
                                SELECT * FROM status3
                                UNION ALL
                                SELECT * FROM status4
                                UNION ALL
                                SELECT * FROM status5
                                UNION ALL
                                SELECT * FROM status6
                                UNION ALL
                                SELECT * FROM status80
                                UNION ALL
                                SELECT * FROM statusfailed
                            ) x

                            ORDER BY created_date DESC;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkdata($requestid){
            $query =
                    "
                        select a.response, user_identifier
                        from dt01_sign_document_dt a
                        where a.request_id='".$requestid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertdocument($data){           
            $sql =   $this->db->insert("dt01_sign_document_dt",$data);
            return $sql;
        }

        function updatedocument($data,$requestid){           
            $sql =   $this->db->update("dt01_sign_document_dt",$data,array("request_id"=>$requestid));
            return $sql;
        }

        function updatedatauserid($data, $userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("user_id"=>$userid));
            return $sql;
        }

        function updatedatauseridentifier($data, $useridentifier){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("user_identifier"=>$useridentifier));
            return $sql;
        }

        function insertcallback($data){           
            $sql =   $this->db->insert("dt01_gen_callback_it",$data);
            return $sql;
        }

    }
?>