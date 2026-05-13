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
                            DATE_FORMAT(a.created_date, '%d.%m.%Y %H:%i:%s') AS tglbuat,

                            COALESCE(gd.document_name, a.jenis_doc) AS jenis_doc,

                            cu.name AS dibuatoleh,

                            (
                                SELECT GROUP_CONCAT(
                                    b.name
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE b.org_id = a.org_id
                                AND FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS name,

                            (
                                SELECT GROUP_CONCAT(
                                    b.email
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE b.org_id = a.org_id
                                AND FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS email,

                            (
                                SELECT GROUP_CONCAT(
                                    b.user_identifier
                                    ORDER BY FIND_IN_SET(
                                        b.nik,
                                        REPLACE(a.signer_id, ';', ',')
                                    )
                                    SEPARATOR ';'
                                )
                                FROM dt01_gen_user_data b
                                WHERE b.org_id = a.org_id
                                AND FIND_IN_SET(
                                    b.nik,
                                    REPLACE(a.signer_id, ';', ',')
                                )
                            ) AS useridentifier,

                            ms.color AS colorstatus,
                            ms.master_name AS namestatus,
                            ms.description AS descriptionstatus

                        FROM dt01_sign_document_dt a

                        LEFT JOIN dt01_gen_document_ms gd 
                            ON gd.jenis_doc = a.jenis_doc

                        LEFT JOIN dt01_gen_user_data cu 
                            ON cu.org_id = a.org_id 
                            AND cu.user_id = a.created_by

                        LEFT JOIN dt01_gen_master_ms ms 
                            ON ms.org_id = a.org_id 
                            AND ms.jenis_id = 'Statussign_2' 
                            AND ms.code = a.status_sign

                        WHERE a.active = '1'
                        AND (
                                a.status_sign IN ('0','1','2','3','4','7')

                                OR (
                                    a.status_sign = '5'
                                    AND DATE(a.download_date) = CURDATE()
                                )

                                OR (
                                    a.status_sign NOT IN ('0','1','2','3','4','5')
                                    AND a.created_date >= NOW() - INTERVAL 2 DAY
                                )
                            )

                        ORDER BY a.created_date DESC;
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