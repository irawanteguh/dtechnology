<?php
    class Modeluser extends CI_Model{

        function masteruser($orgid){
            $query =
                    "
                        select a.username, name
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekusername($username){
            $query =
                    "
                        select a.username
                        from dt01_gen_user_data a
                        where upper(username)=upper('".$username."')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertuser($data){           
            $sql =   $this->db->insert("dt01_gen_user_data",$data);
            return $sql;
        }


    }
?>