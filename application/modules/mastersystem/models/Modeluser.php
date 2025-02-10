<?php
    class Modeluser extends CI_Model{

        function masteruser($orgid){
            $query =
                    "
                        select a.user_id, username, name,
                               (
                                    SELECT GROUP_CONCAT(
                                            b.asst_id, ':',
                                            (SELECT name 
                                                        FROM dt01_gen_user_data 
                                                        WHERE active = '1' 
                                                        AND org_id = a.org_id 
                                                        AND user_id = b.asst_id), ':'
                                                SEPARATOR '; ')
                                    FROM dt01_gen_user_asst_dt b
                                    WHERE b.active = '1'
                                    AND b.org_id = a.org_id
                                    AND b.user_id = a.user_id
                                ) asstantname
                        from dt01_gen_user_data a
                        where a.active='1'
                        and a.org_id='".$orgid."'
                           
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

        function cekassistant($orgid,$userid,$asstid){
            $query =
                    "
                        select a.trans_id
                        from dt01_gen_user_asst_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        and   a.asst_id='".$asstid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertuser($data){           
            $sql =   $this->db->insert("dt01_gen_user_data",$data);
            return $sql;
        }

        function insertuserassistant($data){           
            $sql =   $this->db->insert("dt01_gen_user_asst_dt",$data);
            return $sql;
        }

    }
?>