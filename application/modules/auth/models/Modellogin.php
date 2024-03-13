<?php
    class Modellogin extends CI_Model{

        function login($username,$password)
        {
            $query =
                    "
                        select a.name, LEFT(upper(a.name), 2) initialuser,
                               (select org_name from dt01_gen_organization_ms where active='1' and org_id=a.org_id)hospitalname
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