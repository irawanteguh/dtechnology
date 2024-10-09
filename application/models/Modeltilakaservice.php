<?php
    class Modeltilakaservice extends CI_Model{

        function dataupload($orgid,$status){
            $query =
                    "
                        select a.NO_FILE, STATUS_SIGN, SOURCE_FILE, NOTE,
                                (select USER_IDENTIFIER from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)useridentifier,
                                (select NAME            from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname,
                                (select DOCUMENT_NAME   from dt01_gen_document_ms where org_id=a.org_id and active='1' and JENIS_DOC=a.JENIS_DOC)jenisdocumen
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.status_file = '1'
                        and   a.org_id      = '".$orgid."'
                        ".$status."
                        and   a.assign  = (select assign from dt01_gen_user_data where org_id=a.org_id and active='1' and nik=a.assign and user_identifier<>'')
                        order by note asc
                        limit 100;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listrequestsign($orgid,$status){
            $query =
                    "
                        select distinct a.assign, user_identifier,
                                (select name from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        ".$status."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function filerequestsign($orgid,$status,$assign){
            $query =
                    "
                        select a.no_file, filename, status_sign, user_identifier, source_file,
                                (select NAME            from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname,
                                (select DOCUMENT_NAME   from dt01_gen_document_ms where org_id=a.org_id and active='1' and JENIS_DOC=a.JENIS_DOC)jenisdocumen
                        from dt01_gen_document_file_dt a
                        where a.active      = '1'
                        and   a.org_id      = '".$orgid."'
                        and   a.assign      = '".$assign."'
                        ".$status."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listexecute($orgid,$status){
            $query =
                    "
                        select distinct a.assign, user_identifier, request_id, user_identifier, no_file, source_file,
                                (select name from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        ".$status."
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
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("NO_FILE"=>$nofile));
            return $sql;
        }

        function updaterequestid($data,$requestid){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("REQUEST_ID"=>$requestid));
            return $sql;
        }

        function updatedatauseridentifier($data, $useridentifier){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("USER_IDENTIFIER"=>$useridentifier));
            return $sql;
        }

    }
?>