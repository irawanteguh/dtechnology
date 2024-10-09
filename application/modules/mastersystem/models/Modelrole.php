<?php
    class Modelrole extends CI_Model{

        function masterrole($orgid){
            $query =
                    "
                        select a.role_id, role, DATE_FORMAT(CREATED_DATE,'%d.%m.%Y %H:%i:%s')createddate,
                            (select count(trans_id) from dt01_gen_role_access where org_id=a.org_id and active='1' and role_id=a.role_id)jmluser,
                            (select name from dt01_gen_user_data where user_id=a.created_by and active='1')createdby,
                            (
                                SELECT GROUP_CONCAT(
                                        (select modules_name from dt01_gen_modules_ms where modules_id=b.modules_id) SEPARATOR ';')
                                FROM dt01_gen_role_dt b
                                WHERE b.org_id=a.org_id
                                and   b.active='1'
                                and   b.role_id=a.role_id
                            )  modules
                        from dt01_gen_role_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by role asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertrole($data){           
            $sql =   $this->db->insert("dt01_gen_role_ms",$data);
            return $sql;
        }


    }
?>