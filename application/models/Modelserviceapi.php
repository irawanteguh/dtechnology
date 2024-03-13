<?php
    class Modelserviceapi extends CI_Model{

        function savelog($data){           
            $sql =   $this->db->insert("dt01_service_api_logs_out",$data);
            return $sql;
        }

    }

?>