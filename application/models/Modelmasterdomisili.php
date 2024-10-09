<?php
    class Modelmasterdomisili extends CI_Model{

        function cekdata($code){
            $query =
                    "
                        select a.code
                        from dt01_gen_domisili_ms a
                        where a.active='1'
                        and   a.code='".$code."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertdata($data){           
            $sql =   $this->db->insert("dt01_gen_domisili_ms",$data);
            return $sql;
        }
        
    }
?>