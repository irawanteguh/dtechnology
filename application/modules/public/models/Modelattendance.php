<?php
    class Modelattendance extends CI_Model{

        function datauser($imageid){
            $query =
                    "
                        select a.image_id, user_id, confidence,
                            (select name from dt01_gen_user_data where active='1' and user_id=a.user_id)name,
                            (select nik from dt01_gen_user_data where active='1' and user_id=a.user_id)nik,
                            (select org_id from dt01_gen_user_data where active='1' and user_id=a.user_id)orgid,
                            (select org_name from dt01_gen_organization_ms where active='1' and org_id=(select org_id from dt01_gen_user_data where active='1' and user_id=a.user_id))rsname
                        from dt01_gen_facerecognition_hd a
                        where a.status='1'
                        and   a.image_id='".$imageid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertabsen($data){           
            $sql =   $this->db->insert("dt01_hrd_receive_absen",$data);
            return $sql;
        }

        function insertface($data){           
            $sql =   $this->db->insert("dt01_gen_facerecognition_hd",$data);
            return $sql;
        }
    }
?>