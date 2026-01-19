<?php
    class Modeltilaka extends CI_Model{

        // function datalisttransferfile(){
        //     $query =
        //             "
        //                 select a.no_file, source_file, assign, jenis_doc, pasien_idx, transaksi_idx, source_file
        //                 from dt01_gen_document_file_dt a
        //                 where a.active      = '1'
        //                 and   a.status_sign = '0'
        //                 order by created_date asc
        //                 limit 10;
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        // function dataliststatussign(){
        //     $query =
        //             "
        //                 select a.no_file, source_file, assign, user_identifier, jenis_doc, pasien_idx, transaksi_idx, source_file
        //                 from dt01_gen_document_file_dt a
        //                 where a.active      = '1'
        //                 and   a.status_sign = '1'
        //                 order by created_date asc
        //                 limit 10;
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        function checkstatusregister(){
            $query =
                    "
                        select a.user_id, register_id, user_identifier, name
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.certificate='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function datalistuploadfile($paramater){
        //     $query =
        //             "
        //                 select a.no_file, source_file, assign,
        //                         (select user_identifier from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)useridentifier
        //                 from dt01_gen_document_file_dt a
        //                 where a.active      = '1'
        //                 and   a.status_sign = '0'
        //                 and   a.status_file='1'
        //                 ".$paramater."
        //                 order by note asc, created_date asc
        //                 limit 20;
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        function datalistuploadfile($paramater){
            $query = "
                SELECT 
                    a.no_file,
                    a.source_file,
                    a.assign,
                    GROUP_CONCAT(u.user_identifier ORDER BY n.n SEPARATOR ';') AS useridentifier
                FROM dt01_gen_document_file_dt a

                /* numbers table (maks 10 assign, bisa ditambah) */
                JOIN (
                    SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL
                    SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL
                    SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL
                    SELECT 10
                ) n
                ON n.n <= 1 + LENGTH(a.assign) - LENGTH(REPLACE(a.assign, ';', ''))

                JOIN dt01_gen_user_data u
                ON u.org_id = a.org_id
                AND u.active = '1'
                AND u.nik = SUBSTRING_INDEX(
                                SUBSTRING_INDEX(a.assign, ';', n.n),
                                ';',
                                -1
                            )

                WHERE a.active = '1'
                AND a.status_sign = '0'
                AND a.status_file = '1'
                $paramater

                GROUP BY 
                    a.no_file, 
                    a.source_file, 
                    a.assign,
                    a.note,
                    a.created_date

                ORDER BY a.note ASC, a.created_date ASC
                LIMIT 20
            ";

            // echo $query; // debug bila perlu
            return $this->db->query($query)->result();
        }

        function listrequestsign(){
            $query =
                    "
                        SELECT 
                            a.org_id,
                            a.assign,
                            a.user_identifier,
                            DATE_FORMAT(a.created_date,'%d.%m.%Y') AS tgljam,

                            GROUP_CONCAT(u.name ORDER BY n.n SEPARATOR ';')  AS assignname,
                            GROUP_CONCAT(u.email ORDER BY n.n SEPARATOR ';') AS email

                        FROM dt01_gen_document_file_dt a

                        JOIN (
                            SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL
                            SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL
                            SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL
                            SELECT 10
                        ) n
                        ON n.n <= 1 + LENGTH(a.assign) - LENGTH(REPLACE(a.assign,';',''))

                        JOIN dt01_gen_user_data u
                        ON u.active = '1'
                        AND u.nik = SUBSTRING_INDEX(
                                        SUBSTRING_INDEX(a.assign,';',n.n),
                                        ';',
                                        -1
                                    )

                        WHERE a.active = '1'
                        AND a.status_sign = '1'

                        GROUP BY
                            a.org_id,
                            a.assign,
                            a.user_identifier,
                            a.created_date

                        LIMIT 1;



                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function filerequestsign($assign){
            $query =
                    "
                        select a.no_file, filename, status_sign, assign, user_identifier, source_file,
                                (select name          from dt01_gen_user_data   where active='1' and nik=a.assign)assignname,
                                (select document_name from dt01_gen_document_ms where active='1' and JENIS_DOC=a.JENIS_DOC)jenisdocumen,
                                (select org_name      from dt01_gen_organization_ms where active='1' and org_id=a.org_id)orgname
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.assign      = '".$assign."'
                        -- and   a.assign=(select nik from dt01_gen_user_data where active='1' and certificate='3' and nik=a.assign)
                        and   a.status_sign ='1'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
        function listdownload(){
            $query =
                    "
                        select distinct a.request_id, source_file, user_identifier,
                                (select name from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.status_sign in ('2','3')
                        limit 50;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("no_file"=>$nofile,"active"=>"1"));
            return $sql;
        }

        function updatetransaksi($data,$statussign,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("no_file"=>$nofile,"status_sign"=>$statussign,"active"=>"1"));
            return $sql;
        }

        function updatedatauserid($data, $userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("user_id"=>$userid));
            return $sql;
        }

        function updaterequestid($data,$requestid){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("request_id"=>$requestid));
            return $sql;
        }

        //Tilaka Reguler Sign
        function listexecute(){
            $query =
                    "
                        select distinct a.request_id, source_file, user_identifier,
                                (select name from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.status_sign='3'
                        limit 50;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listdownloadregulersign(){
            $query =
                    "
                        select distinct a.request_id, source_file, user_identifier,
                                (select name from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.status_sign='4'
                        order by source_file asc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        //Tilaka Reguler Sign
    }
?>