<?php
    class Modelregistrasi extends CI_Model{

        function datakaryawan($orgid,$parameter){
            $query =
                    "
                        select x.*, upper(LEFT(x.name, 1)) initial
                        from(
                            select a.*
                            from dt01_gen_user_data a
                            where a.org_id='".$orgid."'
                            and   a.active='1'
                        )x
                        where upper(x.name) like '%".$parameter."%' or x.identity_no like '%".$parameter."%' or upper(x.email) like '%".$parameter."%' or upper(x.user_identifier) like '%".$parameter."%'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dataregistrasi($orgid,$userid){
                $query =
                    "
                        select a.*
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function updatedataregister($data, $registerid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("REGISTER_ID"=>$registerid));
            return $sql;
        }

        function updatedatauser($data, $userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("USER_ID"=>$userid));
            return $sql;
        }

        function updatedatauseridentifier($data, $useridentifier){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("USER_IDENTIFIER"=>$useridentifier));
            return $sql;
        }

        function updatedataissueid($data, $issueid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("ISSUE_ID"=>$issueid));
            return $sql;
        }


    }
?>