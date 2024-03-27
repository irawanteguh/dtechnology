<?php
    class Modeltilakaservice extends CI_Model{

        function dataupload($orgid,$status)
        {
            $query =
                    "
                        select x.*
                        from(
                        select a.NO_FILE, FILENAME, STATUS_SIGN,
                                (select USER_IDENTIFIER from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)useridentifier,
                                (select NAME            from dt01_gen_user_data   where org_id=a.org_id and active='1' and nik=a.assign)assignname,
                                (select DOCUMENT_NAME   from dt01_gen_document_ms where org_id=a.org_id and active='1' and JENIS_DOC=a.JENIS_DOC)jenisdocumen
                        from dt01_gen_document_file_dt a
                        where a.org_id='".$orgid."'
                        and   a.status_sign ='".$status."'
                        )x
                        where x.useridentifier is not null
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dataexecutesign()
        {
            $query =
                    "
                        select a.*, DATE_FORMAT(CREATED_DATE,'%d.%m.%Y %H:%i:%s')tgljam,
                                (select NAME from dt01_gen_user_data where active='1' and USER_IDENTIFIER=A.USER_IDENTIFIER)name,
                                (select NIK from dt01_gen_user_data where active='1' and USER_IDENTIFIER=A.USER_IDENTIFIER)nik,
                                (select IDENTITY_NO from dt01_gen_user_data where active='1' and USER_IDENTIFIER=A.USER_IDENTIFIER)noktp,
                                (select EMAIL from dt01_gen_user_data where active='1' and USER_IDENTIFIER=A.USER_IDENTIFIER)email
                        from dt01_gen_auth_url_sign_dt a
                        where a.active='1'
                        and   a.status='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checknofile($filename)
        {
            $query =
                    "
                        select a.NO_FILE
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.filename='".$filename."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$nofile)
        {           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("NO_FILE"=>$nofile));
            return $sql;
        }

        function updatelinkdownload($data,$nofile)
        {           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("FILENAME"=>$nofile));
            return $sql;
        }

        function insertauthurl($data)
        {           
            $sql =   $this->db->insert("dt01_gen_auth_url_sign_dt",$data);
            return $sql;
        }

        function updateauthurl($data,$urlid){           
            $sql =   $this->db->update("dt01_gen_auth_url_sign_dt",$data,array("URL_ID"=>$urlid));
            return $sql;
        }

    }
?>