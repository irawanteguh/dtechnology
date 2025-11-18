<?php
    class Modeltilaka extends CI_Model{

        // function datalisttransferfile($orgid){
        //     $query =
        //             "
        //                 select a.no_file, source_file, assign, jenis_doc, pasien_idx, transaksi_idx, source_file
        //                 from dt01_gen_document_file_dt a
        //                 where a.active      = '1'
        //                 and   a.org_id='".$orgid."'
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

        function datalistuploadfile(){
            $query =
                    "
                        select a.no_file, source_file,
                                (select user_identifier from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)useridentifier
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.status_sign = '0'
                        and   a.assign=(select nik from dt01_gen_user_data where org_id=a.org_id and active='1' and certificate='3' and nik=a.assign)
                        order by created_date asc
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listrequestsign(){
            $query =
                    "
                        select distinct a.org_id, assign, user_identifier,
                                (select name from dt01_gen_user_data   where active='1' and nik=a.assign)assignname,
                                (select email from dt01_gen_user_data   where active='1' and nik=a.assign)email
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.assign=(select nik from dt01_gen_user_data where active='1' and certificate='3' and nik=a.assign)
                        and   a.status_sign ='1'
                        limit 1;
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
                        and   a.assign=(select nik from dt01_gen_user_data where active='1' and certificate='3' and nik=a.assign)
                        and   a.status_sign ='1'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function listexecute(){
        //     $query =
        //             "
        //                 select distinct a.no_file, user_identifier, request_id, user_identifier
        //                 from dt01_gen_document_file_dt a
        //                 where a.active='1'
        //                 and   a.status_sign = '3'
        //                 order by created_date desc
        //                 limit 10;
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        function listdownload(){
            $query =
                    "
                        select distinct a.request_id, source_file, user_identifier,
                                (select name from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.status_sign in ('2','3')
                        limit 10;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function checkfilename($filename){
        //     $query =
        //             "
        //                 select a.filename
        //                 from dt01_gen_document_file_dt a
        //                 where a.active='1'
        //                 and   a.filename='".$filename."'
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        function updatefile($data,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("no_file"=>$nofile));
            return $sql;
        }

        function updatedatauserid($data, $userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("USER_ID"=>$userid));
            return $sql;
        }

    }
?>