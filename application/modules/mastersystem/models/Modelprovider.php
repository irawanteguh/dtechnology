<?php
    class Modelprovider extends CI_Model{

        function masterprovider($orgid){
            $query =
                    "
                        select a.provider_id, provider_id_old, provider
                        from dt01_keu_provider_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by provider asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertmasterprovider($data){           
            $sql =   $this->db->insert("dt01_keu_provider_ms",$data);
            return $sql;
        }

    }
?>