<?php
    class Modeldetails extends CI_Model{
        
        function masterrkk(){
            $query =
                    "
                        select x.*,
                            (select name from dt01_hrd_klinis_ms where active='1' and klinis_id=x.klinis_id)klinis,
                            (select kewenangan from dt01_hrd_kewenangan_klinis_ms where active='1' and kewenangan_id=x.kewenangan_id)kewenangan,
                            (select name from dt01_gen_user_data where user_id=x.last_update_by)dibuatoleh 
                        from(
                            select a.activity_id, activity_id header_id, activity, jenis_id, klinis_id, kewenangan_id, last_update_by, date_format(last_update_date,'%d.%m.%Y %H:%i:%s')tgldibuat
                            from dt01_hrd_activity_ms a
                            where a.active='9'
                            and   a.perawat='Y'
                            and   a.jenis_id='H'
                            
                            union
                            
                            select a.activity_id, header_id, activity, jenis_id, klinis_id, kewenangan_id, last_update_by, date_format(last_update_date,'%d.%m.%Y %H:%i:%s')tgldibuat
                            from dt01_hrd_activity_ms a
                            where a.active='9'
                            and   a.perawat='Y'
                            and   a.jenis_id='N'
                        )x

                        order by header_id asc, jenis_id asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>