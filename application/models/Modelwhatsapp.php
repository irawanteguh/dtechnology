<?php
    class Modelwhatsapp extends CI_Model{

        function broadcastwhatsapp($limit){
            $query =
                    "
                        select a.transaksi_id, a.no_hp, directory, body_1, body_2, body_3, body_4, body_5, body_6, body_7, body_8, body_9, body_10, type_file, document_name,
                            (select transaksi_id from dt01_whatsapp_device_ms where status='connected' and org_id=a.org_id and device_id=a.device_id)session
                        from dt01_whatsapp_broadcast_hd a
                        where a.active='1'
                        and   a.status='0'
                        ".$limit."                     
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatestatusbroadcastwhatsapp($data, $transaksi){           
            $sql =   $this->db->update("dt01_whatsapp_broadcast_hd",$data,array("transaksi_id"=>$transaksi));
            return $sql;
        }
        
        function updatedevice($data, $transaksi){           
            $sql =   $this->db->update("dt01_whatsapp_device_ms",$data,array("transaksi_id"=>$transaksi));
            return $sql;
        }

    }
?>