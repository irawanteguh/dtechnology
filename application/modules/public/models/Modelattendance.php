<?php
    class Modelattendance extends CI_Model{

        function datauser($userid){
            $query =
                    "
                        select a.org_id, user_id, name, nik,
                            (select org_name from dt01_gen_organization_ms where org_id=a.org_id)rsname
                        from dt01_gen_user_data a
                        where a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertabsen($data){           
            $sql =   $this->db->insert("dt01_hrd_receive_absen",$data);
            return $sql;
        }
    }
?>