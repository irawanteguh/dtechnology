<?php
    class Modelexecutesign extends CI_Model{

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
                        and   a.status in ('0','1')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateauthurl($data,$urlid){           
            $sql =   $this->db->update("dt01_gen_auth_url_sign_dt",$data,array("URL_ID"=>$urlid));
            return $sql;
        }

        // function updatefile($data,$nofile){           
        //     $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("FILENAME"=>$nofile));
        //     return $sql;
        // }


    }
?>