<?php
    class Modeldepartment extends CI_Model{

        function masterorganization($parameter){
            $query =
                    "
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        and   a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        ".$parameter."
                        order by org_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdepartment(){
            $query =
                    "
                        select a.department_id, concat(department,'-',ifnull(jabatan,''))keterangan
                        from dt01_hrd_department_ms a
                        where a.active='1'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
        function masterdatadepartment(){
            $query =
                    "
                        select a.department_id, header_id, department, jabatan, level_id, code,
                               (select name from dt01_gen_user_data where active=a.active and user_id=a.user_id)namapj
                        from dt01_hrd_department_ms a
                        where a.active='1'
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
            $sql =   $this->db->insert("dt01_hrd_department_ms",$data);
            return $sql;
        }

        function updatedepartment($data,$departmentid){           
            $sql =   $this->db->update("dt01_hrd_department_ms",$data,array("department_id"=>$departmentid));
            return $sql;
        }


    }
?>