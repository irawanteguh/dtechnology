<?php
    class Modelselfassessment extends CI_Model{
        
        function bab(){
            $query =
                    "
                        select a.standart_id, standart, do
                        from dt01_akre_standart_ms a
                        where a.active='1'
                        and   a.jenis_id='B'
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
    }
?>