<?php
    class Modelrkk extends CI_Model{

        function listrkk($orgid,$userid){
            $query =
                    "
                        select  distinct a.activity, pk,
                                (select concat(name,' ',area) from dt01_hrd_klinis_ms where active='1' and klinis_id=a.pk)jenjangklinis,
                                (select nomor from dt01_hrd_klinis_ms where active='1' and klinis_id=a.pk)nomorklinis

                        from dt01_hrd_activity_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.pk in (
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