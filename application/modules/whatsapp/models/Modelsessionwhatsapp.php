<?php
    class Modelsessionwhatsapp extends CI_Model{

        function masterorganization($parameter){
            $query =
                    "
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        ".$parameter."
                        order by org_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
        function masterdevice($orgid){
            $query =
                    "
                        select a.transaksi_id, device_id, device_name, username, phone, status
                        from dt01_whatsapp_device_ms a
                        where a.org_id='".$orgid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertdevice($data){           
            $sql =   $this->db->insert("dt01_whatsapp_device_ms",$data);
            return $sql;
        }

        function updatedevice($data, $transaksi){           
            $sql =   $this->db->update("dt01_whatsapp_device_ms",$data,array("transaksi_id"=>$transaksi));
            return $sql;
        }

    }
?>