<?php
    class Modeldepartment extends CI_Model{

        

        function masterdepartment($orgid){
            $query =
                    "
                        select a.name, struktur_id, struktur_header_id,
                               (select name from dt01_gen_struktur_ms where active='1' and org_id=a.org_id and struktur_id=a.struktur_header_id)partof
                        from dt01_gen_struktur_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by struktur_header_id asc, nomor asc, partof asc, name asc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>