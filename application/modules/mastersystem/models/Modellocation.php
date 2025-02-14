<?php
    class Modellocation extends CI_Model{

        function masterlocation($orgid){
            $query =
                    "
                        select a.location_id, header_id, location, type, level_id,
                                (select name from dt01_gen_user_data where org_id=a.org_id and active=a.active and user_id=a.user_id)namapj
                        from dt01_gen_location_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by level_id asc, location asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertlocation($data){           
            $sql =   $this->db->insert("dt01_gen_location_ms",$data);
            return $sql;
        }

        function masteruser($orgid){
            $query =
                    "
                        select a.username, name, user_id
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>