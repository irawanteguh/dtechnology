<?php
    class Modelsigndocument extends CI_Model{

        function checkissueid($orgid,$issueid){
            $query =
                    "
                        select a.*
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.issue_id='".$issueid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }
        
        function datasigndocument($parameter){
            $query =
                    "
                        select distinct a.request_id, user_identifier, url, status_sign, count(no_file)jmlfile,
                            (select name from dt01_gen_user_data where active='1' and user_identifier=a.user_identifier)name,
                            (select nik from dt01_gen_user_data where active='1' and user_identifier=a.user_identifier)nik,
                            (select identity_no from dt01_gen_user_data where active='1' and user_identifier=a.user_identifier)noktp,
                            (select email from dt01_gen_user_data where active='1' and user_identifier=a.user_identifier)email,
                            (select master_name     from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=a.status_sign)status,
                            (select description     from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=a.status_sign)descriptionstatus,
                            (select color           from dt01_gen_master_ms   where active='1' and jenis_id='Statussign_1' and code=a.status_sign)colorstatus

                        from dt01_gen_document_file_dt a
                        where a.active='1'
                        and   a.status_sign in ('2','3')
                        and   a.user_identifier<>''
                        ".$parameter."
                        group by request_id, user_identifier, url, status_sign
                        order by name asc, status_sign asc, created_date asc
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

        // function checkuseridentifier($orgid,$userid){
        //     $query =
        //             "
        //                 select a.user_identifier
        //                 from dt01_gen_user_data a
        //                 where a.active='1'
        //                 and   a.org_id='".$orgid."'
        //                 and   a.user_id='".$userid."'
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        // function checkissueid($orgid,$issueid){
        //     $query =
        //             "
        //                 select a.*
        //                 from dt01_gen_user_data a
        //                 where a.org_id='".$orgid."'
        //                 and   a.active='1'
        //                 and   a.issue_id='".$issueid."'
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->row();
        //     return $recordset;
        // }

        function updatefile($data,$urlid){           
            $sql =   $this->db->update("dt01_gen_document_file_dt",$data,array("REQUEST_ID"=>$urlid));
            return $sql;
        }

        function updatedatauseridentifier($data, $useridentifier){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("USER_IDENTIFIER"=>$useridentifier));
            return $sql;
        }


    }
?>