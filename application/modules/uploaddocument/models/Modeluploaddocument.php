<?php
    class Modeluploaddocument extends CI_Model{

        function insertsigndocument($data){           
            $sql =   $this->db->insert("dt01_gen_document_file_dt",$data);
            return $sql;
        }
        
    }
?>