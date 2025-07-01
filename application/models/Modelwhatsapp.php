<?php
    class Modelwhatsapp extends CI_Model{

        function updatedevice($data, $transaksi){           
            $sql =   $this->db->update("dt01_whatsapp_device_ms",$data,array("transaksi_id"=>$transaksi));
            return $sql;
        }

    }
?>