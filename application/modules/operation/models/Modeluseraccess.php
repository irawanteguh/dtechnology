<?php
    class Modeluseraccess extends CI_Model{

        function masteruser($orgid){
            $query =
                    "
                        select a.org_id, user_id, name
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterrole($orgid,$userid){
            $query =
                    "
                        select a.role_id, role,
                            (select trans_id from dt01_gen_role_access where org_id=a.org_id and role_id=a.role_id and active='1' and user_id='".$userid."')transidmapping
                        from dt01_gen_role_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by role asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkdata($orgid,$userid,$roleid){
            $query =
                    "
                        select a.trans_id
                        from dt01_gen_role_access a
                        where a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        and   a.role_id='".$roleid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatemapping($userid,$roleid,$data){           
            $sql =   $this->db->update("dt01_gen_role_access",$data,array("user_id"=>$userid,"role_id"=>$roleid));
            return $sql;
        }

        function insertmapping($data){           
            $sql =   $this->db->insert("dt01_gen_role_access",$data);
            return $sql;
        }



    }
?>