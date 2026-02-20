<?php
    class Modelmutiasari extends CI_Model{

        function masterkolegium($orgid){
            $query =
                    "
                        select a.kolegium_id, kolegium, description, description_eng, icon
                        from dt01_med_kolegium_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by kolegium asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdoctor($orgid){
            $query =
                    "
                        select a.user_id, name,
                            (select kolegium from dt01_med_kolegium_ms where active='1' and org_id=a.org_id and kolegium_id=a.kolegium_id)kolegium
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.kolegium_id is not null and a.kolegium_id <> ''
                        order by kolegium
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>