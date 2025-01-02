<?php
    class Modeloverview extends CI_Model{

        function dataeticket(){
            $query =
                    "
                        select a.*
                        from dt01_it_support_eticket_hd a
                        where a.active='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }



    }
?>