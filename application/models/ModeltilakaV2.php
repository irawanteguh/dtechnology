<?php
    class ModeltilakaV2 extends CI_Model{
        
        function listuploadfile(){
            $query = "
                        WITH RECURSIVE split_assign AS (
                            SELECT
                                d.no_file,
                                d.assign,
                                d.source_file,
                                SUBSTRING_INDEX(d.assign, ';', 1) AS nik,
                                SUBSTRING(d.assign, LENGTH(SUBSTRING_INDEX(d.assign, ';', 1)) + 2) AS rest
                            FROM dt01_gen_document_file_dt d
                            WHERE d.active = '1'
                            AND d.assign<>''
                            AND d.status_file = '1'
                            AND d.status_sign = '0'

                            UNION ALL

                            SELECT
                                no_file,
                                assign,
                                source_file,
                                SUBSTRING_INDEX(rest, ';', 1),
                                SUBSTRING(rest, LENGTH(SUBSTRING_INDEX(rest, ';', 1)) + 2)
                            FROM split_assign
                            WHERE rest <> ''
                        )
                        SELECT
                            s.no_file,
                            s.assign,
                            s.source_file,
                            GROUP_CONCAT(
                                DISTINCT u.user_identifier
                                ORDER BY u.user_identifier
                                SEPARATOR ';'
                            ) AS useridentifiers
                        FROM split_assign s
                        JOIN dt01_gen_user_data u
                        ON u.nik = s.nik
                        GROUP BY
                            s.no_file,
                            s.assign,
                            s.source_file
                        LIMIT 10;

                    ";

            // echo $query; // debug bila perlu
            return $this->db->query($query)->result();
        }

        function listrequestsign(){
            $query = "
                        SELECT 
                            d.org_id,
                            o.org_name AS orgname,
                            d.no_file,
                            d.filename,
                            d.source_file,
                            u.user_id,

                            MAX(d.assign)          AS assign,
                            MAX(d.user_identifier) AS user_identifier,
                            MAX(d.status_sign)     AS status_sign,

                            DATE_FORMAT(
                                MAX(d.created_date),
                                '%d-%m-%Y %H:%i:%s'
                            ) AS tgljam,

                            GROUP_CONCAT(
                                DISTINCT u.name 
                                ORDER BY u.user_identifier 
                                SEPARATOR ';'
                            ) AS names,

                            GROUP_CONCAT(
                                DISTINCT u.email 
                                ORDER BY u.user_identifier 
                                SEPARATOR ';'
                            ) AS email

                        FROM dt01_gen_document_file_dt d
                        JOIN dt01_gen_user_data u 
                            ON FIND_IN_SET(u.nik, REPLACE(d.assign, ';', ',')) > 0
                        AND u.active='1'
                        AND u.quick_sign<>'N'

                        LEFT JOIN dt01_gen_organization_ms o
                            ON o.org_id = d.org_id
                        AND o.active = '1'

                        WHERE d.active = '1'
                        AND d.status_sign IN ('1','97')

                        GROUP BY 
                            d.org_id,
                            o.org_name,
                            d.no_file,
                            d.filename,
                            d.source_file

                        ORDER BY 
                            status_sign ASC

                        LIMIT 10;

                    ";

            // echo $query; // debug bila perlu
            return $this->db->query($query)->result();
        }

        function listdownload(){
            $query =
                    "
                        SELECT DISTINCT
                            a.request_id,
                            a.source_file,
                            a.user_identifier,
                            a.note
                        FROM dt01_gen_document_file_dt a
                        WHERE a.active = '1'
                        AND a.status_sign IN ('2','3')
                        ORDER BY
                            CASE
                                WHEN a.note IS NULL THEN 1
                                WHEN a.note = 'PROCESS' THEN 2
                                ELSE 3
                            END,
                            RAND()
                        LIMIT 50;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkdatauser($orgid,$userid){
            $query =
                    "
                        select a.quick_sign
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function updatetransaksi($data,$statussign,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("no_file"=>$nofile,"status_sign"=>$statussign,"active"=>"1"));
            return $sql;
        }

        function updatetransaksirequestid($data,$requestid){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("request_id"=>$requestid,"active"=>"1"));
            return $sql;
        }

        function updatedatauserid($data, $userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("user_id"=>$userid));
            return $sql;
        }

        
    }
?>