<?php
    class Modelmenus extends CI_Model{

        function datamenus(){
            $query =
                    "
                        select a.modules_id, modules_name, icon
                        from dt01_gen_modules_ms a
                        where a.active='1'
                        and   a.parent='A'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>