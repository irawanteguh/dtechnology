<?php
    class Modeltilaka extends CI_Model{

        function datalisttransferfile($orgid){
            $query =
                    "
                        select a.no_file, source_file, assign
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.org_id      = '".$orgid."'
                        and   a.status_sign = '0'
                        order by created_date asc
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datalistuploadfile($orgid){
            $query =
                    "
                        select a.no_file, source_file,
                                (select user_identifier from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)useridentifier
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.org_id      = '".$orgid."'
                        and   a.status_sign = '0'
                        and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
                        order by created_date asc
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function pencariandata($orgid,$status){
        //     $query =
        //             "
        //                 select a.no_file, source_file,
        //                     (select user_identifier from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)useridentifier,
        //                     (select name            from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname,
        //                     (select document_name   from dt01_gen_document_ms where org_id=a.org_id and active='1' and jenis_doc=a.jenis_doc)jenisdocument
        //                 from dt01_gen_document_file_dt a
        //                 where a.active      = '1'
        //                 and   a.status_file = '1'
        //                 and   a.org_id      = '".$orgid."'
        //                 and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
        //                 ".$status."
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        function listrequestsign($orgid,$status){
            $query =
                    "
                        select distinct a.assign, user_identifier,
                                (select name from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname,
                                (select email from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)email
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
                        ".$status."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function filerequestsign($orgid,$status,$assign){
            $query =
                    "
                        select a.no_file, filename, status_sign, assign, user_identifier, source_file,
                                (select name          from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname,
                                (select document_name from dt01_gen_document_ms where org_id=a.org_id and active='1' and JENIS_DOC=a.JENIS_DOC)jenisdocumen,
                                (select org_name      from dt01_gen_organization_ms where active='1' and org_id=a.org_id)orgname
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.org_id      = '".$orgid."'
                        and   a.assign      = '".$assign."'
                        and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
                        ".$status."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listexecute($orgid){
            $query =
                    "
                        select distinct a.no_file, user_identifier, request_id, user_identifier
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.status_sign = '3'
                        order by created_date desc
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listdownload($orgid){
            $query =
                    "
                        select distinct a.request_id, source_file, user_identifier,
                                (select name from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.status_sign ='4'
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkfilename($orgid,$filename){
            $query =
                    "
                        select a.filename
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.filename='".$filename."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("no_file"=>$nofile));
            return $sql;
        }

    }
?>