<?php
    class Modeldepartment extends CI_Model{

        function masterdepartment($orgid){
            $query =
                    "
                        select a.department_id, header_id, department, level_id,
                               (select name from dt01_gen_user_data where org_id=a.org_id and active=a.active and user_id=a.user_id)namapj
                        from dt01_gen_department_ms a
                        where a.org_id='".$orgid."'
                        order by level_id asc, department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masteruser($orgid){
            $query =
                    "
                        select a.username, name, user_id
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertdepartment($data){           
            $sql =   $this->db->insert("dt01_gen_department_ms",$data);
            return $sql;
        }

        function updatedepartment($data,$departmentid){           
            $sql =   $this->db->update("dt01_gen_department_ms",$data,array("department_id"=>$departmentid));
            return $sql;
        }


    }
?>