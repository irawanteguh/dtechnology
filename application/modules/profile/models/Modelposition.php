<?php
    class Modelposition extends CI_Model{

        function historyposition($orgid,$userid){
            $query =
                    "
                        select a.trans_id, user_id, atasan_id, position_primary, status, DATE_FORMAT(a.START_DATE, '%d.%m.%Y') AS START_DATE, DATE_FORMAT(a.END_DATE, '%d.%m.%Y') AS END_DATE, DATE_FORMAT(CREATED_DATE,'%d.%m.%Y %H:%i:%s')CREATED_DATE,
                            (select position from dt01_hrd_position_ms where active='1' and org_id=a.org_id and position_id=a.position_id)position,
                            (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.atasan_id)nameatasan,
                            (select upper(LEFT(name, 1)) from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.atasan_id)initial,
                            (select image_profile from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.atasan_id)photoprofile,
                            (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh

                        from dt01_hrd_position_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        order by start_date desc, position_primary desc, CREATED_DATE DESC
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>