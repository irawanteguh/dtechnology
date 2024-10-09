<?php
    class Modelsigndocument extends CI_Model{

        function dataexecutesign($parameter){
            $query =
                    "
                        select distinct a.REQUEST_ID, USER_IDENTIFIER, URL, STATUS_SIGN,
                            (select NAME from dt01_gen_user_data where active='1' and USER_IDENTIFIER=A.USER_IDENTIFIER)name,
                            (select NIK from dt01_gen_user_data where active='1' and USER_IDENTIFIER=A.USER_IDENTIFIER)nik,
                            (select IDENTITY_NO from dt01_gen_user_data where active='1' and USER_IDENTIFIER=A.USER_IDENTIFIER)noktp,
                            (select EMAIL from dt01_gen_user_data where active='1' and USER_IDENTIFIER=A.USER_IDENTIFIER)email
                            
                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.status_sign in ('2','3')
                        and   a.user_identifier<>''
                        ".$parameter."
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkroleaccess($orgid,$userid){
            $query =
                    "
                        select a.trans_id
                        from dt01_gen_role_access a
                        where a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        and   a.role_id='34c2e933-4b1b-47cd-8497-71de44ac4e01'
                        and   a.active='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkuseridentifier($orgid,$userid){
            $query =
                    "
                        select a.user_identifier
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$urlid){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("REQUEST_ID"=>$urlid));
            return $sql;
        }


    }
?>