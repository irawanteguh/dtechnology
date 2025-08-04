<?php
    class Modeldepartment extends CI_Model{

        function masterorganization($parameter){
            $query =
                    "
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        ".$parameter."
                        order by org_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
        function masterdepartment($groupid,$orgid){
            $query =
                    "
                        select a.department_id, header_id, department, level_id, code,
                               (select name from dt01_gen_user_data where active=a.active and user_id=a.user_id)namapj
                        from dt01_gen_department_ms a
                        where a.org_id='".$groupid."'
                        and   a.level_id='1'
                        union
                        select a.department_id, header_id, department, level_id, code,
                               (select name from dt01_gen_user_data where org_id=a.org_id and active=a.active and user_id=a.user_id)namapj
                        from dt01_gen_department_ms a
                        where a.org_id='".$orgid."'
                        and   a.level_id<>'1'
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