<?php
    class Modellogin extends CI_Model{

        function login($username,$password)
        {
            $query =
                    "
                        select a.*
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.username='".$username."'
                        and   a.password='".$password."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }


    }
?>