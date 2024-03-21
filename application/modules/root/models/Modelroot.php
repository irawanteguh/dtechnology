<?php
    class Modelroot extends CI_Model{

        function menu()
        {
            $query =
                    "
                        select a.*
                        from dt01_gen_modules_ms a
                        where a.active='1'
                        order by modules_name
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result_array();
            return $recordset;
        }


    }
?>