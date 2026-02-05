<?php
    class Modelwebhook extends CI_Model{
        
        function insertwebhookkyc($data){           
            $sql =   $this->db->insert("dt01_webhook_dt_kyc",$data);
            return $sql;
        }


        
    }
?>