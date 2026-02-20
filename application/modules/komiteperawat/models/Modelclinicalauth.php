<?php
    class Modelclinicalauth extends CI_Model{

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
        
        function masterrkk(){
            $query =
                    "
                        select a.klinis_id, concat(a.name,' ',a.area)keterangan
                        from dt01_hrd_klinis_ms a
                        where a.active='1'
                        order by nomor asc, area asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masteremployee($orgid){
            $query =
                    "
                        SELECT 
                            a.user_id,
                            a.name,
                            a.email,
                            a.nik,
                            a.identity_no,
                            a.image_profile,
                            UPPER(LEFT(a.name, 1)) AS initial,
                            a.klinis_id,
                            kat.kategori,
                            klinis_info.klinis,
                            pos.trans_id AS transidprimary,
                            pos.atasan_id AS atasanidprimary,
                            pos.position_id AS positioidprimary,
                            atasan.name AS atasanprimary,
                            posisi.position AS positionprimary,
                            posisi.level_fungsional AS levelfungsionalprimary,
                            level_fung.level AS funsgionalprimary,
                            creator.name AS createdby
                        FROM 
                            dt01_gen_user_data a
                        LEFT JOIN dt01_hrd_kategori_tenaga_ms kat 
                            ON kat.kategori_id = a.kategori_id 
                            AND kat.org_id = '".$orgid."' 
                            AND kat.active = '1'
                        LEFT JOIN (
                            SELECT klinis_id, CONCAT(name, ' ', area) AS klinis 
                            FROM dt01_hrd_klinis_ms 
                            WHERE active = '1'
                        ) klinis_info 
                            ON klinis_info.klinis_id = a.klinis_id
                        LEFT JOIN (
                            SELECT user_id, trans_id, atasan_id, position_id, COALESCE(last_update_by, created_by) AS created_by
                            FROM dt01_hrd_position_dt
                            WHERE active = '1' 
                            AND status = '1' 
                            AND position_primary = 'Y'
                            AND org_id = '".$orgid."' 
                        ) pos 
                            ON pos.user_id = a.user_id
                        LEFT JOIN dt01_gen_user_data atasan 
                            ON atasan.user_id = pos.atasan_id 
                            AND atasan.org_id = '".$orgid."' 
                            AND atasan.active = '1'
                        LEFT JOIN dt01_hrd_position_ms posisi 
                            ON posisi.position_id = pos.position_id 
                            AND posisi.org_id = '".$orgid."' 
                            AND posisi.active = '1'
                        LEFT JOIN dt01_gen_level_fungsional_ms level_fung 
                            ON level_fung.level_id = posisi.level_fungsional 
                            AND level_fung.org_id = '".$orgid."' 
                            AND level_fung.active = '1'
                        LEFT JOIN dt01_gen_user_data creator 
                            ON creator.user_id = pos.created_by 
                            AND creator.active = '1'
                        WHERE 
                            a.active = '1'
                            AND a.org_id = '".$orgid."' 
                            AND a.kategori_id IN (
                                '65f1ccae-3ae6-4209-a66e-d7920b5824f5',
                                'b9710449-f5e4-4553-a962-f3b0f574dbc4'
                            )
                        ORDER BY 
                            a.name ASC;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateuserdata($data,$userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("user_id"=>$userid));
            return $sql;
        }

    }
?>