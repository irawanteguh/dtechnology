<?php
    class Modeluploadfile extends CI_Model{

        function dataupload($orgid)
        {
            $query =
                    "
                        select x.*
                        from(
                        select a.NO_FILE, FILENAME, STATUS_SIGN,
                                (select USER_IDENTIFIER from dt01_gen_user_data where active='1' and nik=a.assign)useridentifier,
                                (select NAME from dt01_gen_user_data where active='1' and nik=a.assign)assignname,
                                (select DOCUMENT_NAME from dt01_gen_document_ms where active='1' and JENIS_DOC=a.JENIS_DOC)jenisdocumen
                        from dt01_gen_document_file_dt a
                        where a.org_id='".$orgid."'
                        and   a.status_sign in ('0','1')
                        )x
                        order by useridentifier asc

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$nofile){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("NO_FILE"=>$nofile));
            return $sql;
        }

        function insertauthurl($data){           
            $sql =   $this->db->insert("dt01_gen_auth_url_sign_dt",$data);
            return $sql;
        }

    }
?>