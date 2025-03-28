<?php
    class Modelposition extends CI_Model{

        function daftarjabatan($orgid,$parameter){
            $query =
                    "
                        SELECT a.ORG_ID, a.POSITION_ID, a.POSITION, a.RVU, a.LEVEL, a.LEVEL_FUNGSIONAL, department_id,
                                date_format(last_update_date,'%d.%m.%Y %H:%i:%s')last_update_date,
                                (select replace(replace(department,'Wakil Direktur ',''),'Manajer ','') from dt01_gen_department_ms where active='1' and org_id=a.org_id and department_id=a.department_id)department,
                                (select replace(replace(department,'Wakil Direktur ',''),'Manajer ','') from dt01_gen_department_ms where active='1' and org_id=a.org_id and department_id=a.bagian_id)bagian,
                                (select replace(replace(department,'Wakil Direktur ',''),'Manajer ','') from dt01_gen_department_ms where active='1' and org_id=a.org_id and department_id=a.unit_id)unit,
                                (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                                (SELECT IFNULL(name, 'Unknown')  FROM dt01_gen_user_data  WHERE active = '1'  AND org_id = a.org_id AND user_id = IFNULL(a.CREATED_BY, a.LAST_UPDATE_BY)) LASTUPDATEDBY,
                                (SELECT level FROM dt01_gen_level_fungsional_ms WHERE active = '1' AND level_id = a.LEVEL_FUNGSIONAL) FUNCTIONAL,
                                (
                                    SELECT GROUP_CONCAT(
                                            b.user_id, ':',
                                            (SELECT image_profile 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND org_id = a.org_id 
                                                AND user_id = b.user_id), ':',
                                            (SELECT name 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND org_id = a.org_id 
                                                AND user_id = b.user_id), ':',
                                            (SELECT UPPER(LEFT(name, 1)) 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND org_id = a.org_id 
                                                AND user_id = b.user_id)
                                        SEPARATOR '; ')
                                    FROM dt01_hrd_position_dt b
                                    WHERE b.active = '1'
                                    AND b.org_id = a.org_id
                                    AND b.position_primary = 'Y'
                                    AND b.position_id = a.position_id
                                ) memberprimary,
                                (
                                    SELECT GROUP_CONCAT(
                                            b.user_id, ':',
                                            (SELECT image_profile 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND org_id = a.org_id 
                                                AND user_id = b.user_id), ':',
                                            (SELECT name 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND org_id = a.org_id 
                                                AND user_id = b.user_id), ':',
                                            (SELECT UPPER(LEFT(name, 1)) 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND org_id = a.org_id 
                                                AND user_id = b.user_id)
                                        SEPARATOR '; ')
                                    FROM dt01_hrd_position_dt b
                                    WHERE b.active = '1'
                                    AND b.org_id = a.org_id
                                    AND b.position_primary = 'N'
                                    AND b.position_id = a.position_id
                                ) membersecondry
                        FROM dt01_hrd_position_ms a
                        WHERE a.active = '1'
                        AND a.org_id = '".$orgid."'
                        ORDER BY LEVEL DESC, POSITION ASC, RVU DESC, POSITION ASC
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdepartment($orgid){
            $query =
                    "
                        select a.department_id, replace(replace(department,'Wakil Direktur ',''),'Manajer ','')department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.level_id=3
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterbagian($orgid,$headerid){
            $query =
                    "
                        select a.department_id, replace(replace(department,'Wakil Direktur ',''),'Manajer ','')department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.level_id=4
                        and   a.header_id='".$headerid."'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterunit($orgid,$headerid){
            $query =
                    "
                        select 'x'department_id,':: Head ::'department union
                        select a.department_id, replace(replace(department,'Wakil Direktur ',''),'Manajer ','')department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.level_id=5
                        and   a.header_id='".$headerid."'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertmasterposition($data){           
            $sql =   $this->db->insert("dt01_hrd_position_ms",$data);
            return $sql;
        }

        function updatemasterposition($positionid,$data){           
            $sql =   $this->db->update("dt01_hrd_position_ms",$data,array("position_id"=>$positionid));
            return $sql;
        }

    }
?>