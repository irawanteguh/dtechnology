<?php
    class Modelrkk extends CI_Model{

        function listrkk($userid){
            
            $query =
                    "
                        select  distinct a.activity, pk, jenis_id, date_format(last_update_date,'%d.%m.%Y %H:%i:%s')tgldibuat,
                                (select concat(name,' ',area) from dt01_hrd_klinis_ms where active='1' and klinis_id=a.klinis_id)jenjangklinis,
                                (select nomor from dt01_hrd_klinis_ms where active='1' and klinis_id=a.klinis_id)nomorklinis,
                                (select kewenangan from dt01_hrd_kewenangan_klinis_ms where active='1' and kewenangan_id=a.kewenangan_id)kewenangan,
                                (select name from dt01_gen_user_data where user_id=a.last_update_by)dibuatoleh

                        from dt01_hrd_activity_ms a
                        where a.active='9'
                        and   a.jenis_id='N'
                        and   a.klinis_id in (
                                                select sub_klinis_id
                                                from dt01_hrd_mapping_klinis
                                                where active='1'
                                                and   klinis_id=(select klinis_id from dt01_gen_user_data where active='1' and user_id='".$userid."')
                                            )
                        order by nomorklinis desc, activity asc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>