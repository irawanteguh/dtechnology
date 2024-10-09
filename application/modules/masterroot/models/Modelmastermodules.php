<?php
    class Modelmastermodules extends CI_Model{

        function masterapps(){
            $query =
                    "
                        select x.*
                        from(
                            select a.modules_id, modules_name, version, modules_header_id, parent, icon, active, status,
                                LOWER(package)package, LOWER(def_controller)def_controller,
                                CASE 
                                        WHEN a.status = '0' THEN 'Development'
                                        WHEN a.status = '1' THEN 'Staging'
                                        ELSE 'Production'
                                END statusdesc,
                                CASE
                                        WHEN a.modules_header_id  = '' THEN
                                        modules_id 
                                        else
                                        CASE
                                            WHEN modules_header_id IN ( select modules_id from dt01_gen_modules_ms where active='1' and modules_header_id  is not null and parent ='Y') THEN 
                                            ( select modules_id from dt01_gen_modules_ms where active='1' and modules_header_id  is not null and modules_id=a.modules_header_id and parent ='Y')||modules_header_id
                                            ELSE
                                            modules_header_id
                                        END
                                END headerid,
                                ( select modules_name  from dt01_gen_modules_ms where active ='1' AND modules_id=a.modules_header_id )modulesheader
                            from dt01_gen_modules_ms a
                            where a.active in ('1','9')
                            and   a.package <> ''
                            and   a.def_controller <> ''
                        )x
                        order by package asc, modules_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function modulesheader(){
            $query =
                    "
                        select 1 urut, 'null' modules_id,'::None Header::' modules_name
                        union all
                        select 2 urut, a.modules_id, CONCAT('Category : ', a.modules_name) modules_name
                        from dt01_gen_modules_ms a
                        where a.active='1'
                        and   a.parent='C'
                        union all
                        select 3 urut, a.modules_id, modules_name
                        from dt01_gen_modules_ms a
                        where a.active='1'
                        and   a.parent='Y'
                        and   a.package is not null
                        order by urut asc, modules_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function parent(){
            $query =
                    "
                        select 'Y' id, 'Ya' keterangan
                        union
                        select 'N' id, 'Tidak' keterangan
                        order by keterangan asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function modulesstatus(){
            $query =
                    "
                        select '0' id, 'Development' status
                        union
                        select '1' id, 'Staging' status
                        union
                        select '2' id, 'Production' status
                        order by status asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertmasterapps($data){           
            $sql =   $this->db->insert("dt01_gen_modules_ms",$data);
            return $sql;
        }

        function updatemasterapps($modulesid,$data){           
            $sql =   $this->db->update("dt01_gen_modules_ms",$data,array("modules_id"=>$modulesid));
            return $sql;
        }

    }
?>