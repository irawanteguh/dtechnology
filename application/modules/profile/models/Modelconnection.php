<?php
    class Modelconnection extends CI_Model{

        function datakaryawan($orgid,$userid){
            $query =
                    "
                        select a.user_id, name, image_profile, upper(LEFT(a.name, 1)) initial,
                                case 
                                    when '".$userid."' = a.atasan_id then
                                    'Y'
                                    else
                                    'N'
                                end staff,
                                (select position from dt01_hrd_position_ms where active='1' and org_id='".$orgid."' and position_id=(select position_id from dt01_hrd_position_dt where active='1' and org_id='".$orgid."' and user_id=a.user_id))position

                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by staff desc, name asc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>