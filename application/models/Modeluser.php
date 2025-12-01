<?php
    class Modeluser extends CI_Model{

        function datauser($nik){
            $query =
                    "
                        select a.user_identifier, email
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.nik='".$nik."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

    }
?>