<?php
    class Modelposition extends CI_Model{

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

        function daftarjabatan($orgid){
            $query =
                    "
                        SELECT a.org_id, a.position_id, a.position, a.rvu, a.level_fungsional, a.department_id, a.bagian_id, a.unit_id,
                                date_format(last_update_date,'%d.%m.%Y %H:%i:%s')last_update_date,
                                (select replace(replace(department,'Wakil Direktur ',''),'Manajer ','') from dt01_gen_department_ms where active='1' and department_id=a.department_id)department,
                                (select replace(replace(department,'Wakil Direktur ',''),'Manajer ','') from dt01_gen_department_ms where active='1' and department_id=a.bagian_id)bagian,
                                (select replace(replace(department,'Wakil Direktur ',''),'Manajer ','') from dt01_gen_department_ms where active='1' and department_id=a.unit_id)unit,
                                (select ifnull(name, 'Unknown')  from dt01_gen_user_data where user_id=a.last_update_by) lastupdateby,
                                (select level                    from dt01_gen_level_fungsional_ms where active = '1' and level_id = a.level_fungsional) functional,

                                (select org_name   from dt01_gen_organization_ms where org_id=a.org_id)orgname,
                                (select b.nilai      from dt01_hrd_gaji_ms b where b.active='1' and b.org_id='".$orgid."' and b.position_id=a.position_id)gaji,
                                (select b.remunerasi from dt01_hrd_gaji_ms b where b.active='1' and b.org_id='".$orgid."' and b.position_id=a.position_id)remun,

                                (
                                    SELECT GROUP_CONCAT(
                                            b.user_id, ':',
                                            (SELECT image_profile 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND   org_id = b.org_id
                                                AND   user_id = b.user_id), ':',
                                            (SELECT name 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND   org_id = b.org_id
                                                AND   user_id = b.user_id), ':',
                                            (SELECT UPPER(LEFT(name, 1)) 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND   org_id = b.org_id
                                                AND   user_id = b.user_id)
                                        SEPARATOR '; ')
                                    FROM dt01_hrd_position_dt b
                                    WHERE b.active = '1'
                                    and b.org_id='".$orgid."'
                                    AND b.position_primary = 'Y'
                                    AND b.position_id = a.position_id
                                ) memberprimary,
                                (
                                    SELECT GROUP_CONCAT(
                                            b.user_id, ':',
                                            (SELECT image_profile 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND   org_id = b.org_id
                                                AND   user_id = b.user_id), ':',
                                            (SELECT name 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND   org_id = b.org_id
                                                AND   user_id = b.user_id), ':',
                                            (SELECT UPPER(LEFT(name, 1)) 
                                                FROM dt01_gen_user_data 
                                                WHERE active = '1' 
                                                AND   org_id = b.org_id
                                                AND   user_id = b.user_id)
                                        SEPARATOR '; ')
                                    FROM dt01_hrd_position_dt b
                                    WHERE b.active = '1'
                                    and b.org_id='".$orgid."'
                                    AND b.position_primary = 'N'
                                    AND b.position_id = a.position_id
                                ) membersecondry
                        FROM dt01_hrd_position_ms a
                        WHERE a.active = '1'
                        ORDER BY LEVEL DESC, POSITION ASC, RVU DESC, POSITION ASC
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterlevelfungsional($groupid){
            $query =
                    "
                        select 'x' level_id,':: General Level ::'level, 0 urut union
                        select a.level_id, level, urut
                        from dt01_gen_level_fungsional_ms a
                        where a.active='1'
                        and   a.group_id='".$groupid."'
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdatagajiremun($orgid,$positionid){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_hrd_gaji_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.position_id='".$positionid."'
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
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
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
                        select 'x' department_id,':: Head ::'department union
                        select a.department_id, replace(replace(department,'Wakil Direktur ',''),'Manajer ','')department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.header_id='".$headerid."'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertgajiremun($data){           
            $sql =   $this->db->insert("dt01_hrd_gaji_ms",$data);
            return $sql;
        }

        function updategajiremun($orgid,$positionid,$data){           
            $sql =   $this->db->update("dt01_hrd_gaji_ms",$data,array("org_id"=>$orgid,"position_id"=>$positionid));
            return $sql;
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