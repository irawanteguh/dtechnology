<?php
    class Modelimportaspaksarana extends CI_Model{
        function insertassets($data){           
            $sql =   $this->db->insert("dt01_lgu_assets_ms",$data);
            return $sql;
        }
    }
?>