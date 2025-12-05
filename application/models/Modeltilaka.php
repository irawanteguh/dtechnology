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

        function datalistuploadfile($paramater){
            $query =
                    "
                        select a.no_file, source_file, assign,
                                (select user_identifier from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)useridentifier
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.status_sign = '0'
                        ".$paramater."
                        order by note asc, created_date asc
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listrequestsign(){
            $query =
                    "
                        select distinct a.org_id, assign, user_identifier, date_format(created_date,'%d.%m.%Y')tgljam,
                                (select name from dt01_gen_user_data   where active='1' and nik=a.assign)assignname,
                                (select email from dt01_gen_user_data   where active='1' and nik=a.assign)email
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        -- and   a.assign=(select nik from dt01_gen_user_data where active='1' and certificate='3' and nik=a.assign)
                        and   a.status_sign ='1'
                        limit 10;
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
                        limit 50;
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
                        and a.assign='2102364'
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
                        and a.assign='2102364'
                        and   a.status_sign='4'
                        limit 50;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        //Tilaka Reguler Sign
    }
?>