<?php
    class Modelemployee extends CI_Model{

        function cekdataprimary($orgid,$userid){
            $query =
                    "
                        select a.user_id, position_id,
                               (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)name,
                               (select position from dt01_hrd_position_ms where active='1' and org_id=a.org_id and position_id=a.position_id)position

                        from dt01_hrd_position_dt a
                        where a.active='1'
                        and   a.status='1'
                        and   a.position_primary='Y'
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function daftarjabatan($orgid){
            $query =
                    "
                        select a.position_id, position,
                            (select level from dt01_gen_level_fungsional_ms where active='1' and level_id=a.level_fungsional)fungsional
                        from dt01_hrd_position_ms a
                        where a.active='1'
                        and   a.group_id='".$orgid."'
                        order by level DESC, position asc, rvu desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterclassification($orgid,$groupid){
            $query =
                    "
                        select a.kategori_id, kategori
                        from dt01_hrd_kategori_tenaga_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."' or group_id='".$groupid."'
                        order by kategori asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function type(){
            $query =
                    "
                        select 'Y' id, 'Primary' type
                        union
                        select 'N' id, 'Secondary' type
                        order by type asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dutydays(){
            $query =
                    "
                        select '1' as id, '1 Day' as keterangan
                        union
                        select '2' as id, '2 Day' as keterangan
                        union
                        select '3' as id, '3 Day' as keterangan
                        union
                        select '4' as id, '4 Day' as keterangan
                        union
                        select '5' as id, '5 Day' as keterangan
                        union
                        select '6' as id, '6 Day' as keterangan
                        union
                        select '7' as id, '7 Day' as keterangan
                        union
                        select '8' as id, '8 Day' as keterangan
                        union
                        select '9' as id, '9 Day' as keterangan
                        union
                        select '10' as id, '10 Day' as keterangan
                        union
                        select '11' as id, '11 Day' as keterangan
                        union
                        select '12' as id, '12 Day' as keterangan
                        union
                        select '13' as id, '13 Day' as keterangan
                        union
                        select '14' as id, '14 Day' as keterangan
                        union
                        select '15' as id, '15 Day' as keterangan
                        union
                        select '16' as id, '16 Day' as keterangan
                        union
                        select '17' as id, '17 Day' as keterangan
                        union
                        select '18' as id, '18 Day' as keterangan
                        union
                        select '19' as id, '19 Day' as keterangan
                        union
                        select '20' as id, '20 Day' as keterangan
                        union
                        select '21' as id, '21 Day' as keterangan
                        union
                        select '22' as id, '22 Day' as keterangan
                        union
                        select '23' as id, '23 Day' as keterangan
                        union
                        select '24' as id, '24 Day' as keterangan
                        union
                        select '25' as id, '25 Day' as keterangan
                        union
                        select '26' as id, '26 Day' as keterangan
                        union
                        select '27' as id, '27 Day' as keterangan
                        union
                        select '28' as id, '28 Day' as keterangan
                        union
                        select '29' as id, '29 Day' as keterangan
                        union
                        select '30' as id, '30 Day' as keterangan
                        order by cast(id as int) asc;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dutyhours(){
            $query =
                    "
                        select '1' as id, '1 Hour' as keterangan
                        union
                        select '2' as id, '2 Hours' as keterangan
                        union
                        select '3' as id, '3 Hours' as keterangan
                        union
                        select '4' as id, '4 Hours' as keterangan
                        union
                        select '5' as id, '5 Hours' as keterangan
                        union
                        select '6' as id, '6 Hours' as keterangan
                        union
                        select '7' as id, '7 Hours' as keterangan
                        union
                        select '8' as id, '8 Hours' as keterangan
                        union
                        select '9' as id, '9 Hours' as keterangan
                        union
                        select '10' as id, '10 Hours' as keterangan
                        union
                        select '11' as id, '11 Hours' as keterangan
                        union
                        select '12' as id, '12 Hours' as keterangan
                        union
                        select '13' as id, '13 Hours' as keterangan
                        union
                        select '14' as id, '14 Hours' as keterangan
                        union
                        select '15' as id, '15 Hours' as keterangan
                        union
                        select '16' as id, '16 Hours' as keterangan
                        union
                        select '17' as id, '17 Hours' as keterangan
                        union
                        select '18' as id, '18 Hours' as keterangan
                        union
                        select '19' as id, '19 Hours' as keterangan
                        union
                        select '20' as id, '20 Hours' as keterangan
                        union
                        select '21' as id, '21 Hours' as keterangan
                        union
                        select '22' as id, '22 Hours' as keterangan
                        union
                        select '23' as id, '23 Hours' as keterangan
                        union
                        select '24' as id, '24 Hours' as keterangan
                        order by cast(id as int) asc;


                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masteremployee($orgid){
            $query =
                    "
                        SELECT 
                            y.*,
                            -- Nama level fungsional dari posisi utama
                            (
                                SELECT level 
                                FROM dt01_gen_level_fungsional_ms 
                                WHERE org_id = y.org_id 
                                AND active = '1' 
                                AND level_id = y.levelfungsionalprimaryid
                            ) AS fungsionalprimary

                        FROM (
                            SELECT 
                                x.*,

                                -- Nama atasan dari posisi utama
                                (
                                    SELECT name 
                                    FROM dt01_gen_user_data 
                                    WHERE org_id = x.org_id 
                                    AND active = '1' 
                                    AND user_id = x.atasanidprimary
                                ) AS atasanprimary,

                                -- Nama posisi utama
                                (
                                    SELECT position 
                                    FROM dt01_hrd_position_ms 
                                    WHERE active = '1' 
                                    AND position_id = x.positioidprimary
                                ) AS positionprimary,

                                -- Level fungsional ID dari posisi utama
                                (
                                    SELECT level_fungsional 
                                    FROM dt01_hrd_position_ms 
                                    WHERE active = '1' 
                                    AND position_id = x.positioidprimary
                                ) AS levelfungsionalprimaryid

                            FROM (
                                SELECT 
                                    a.org_id,
                                    a.user_id,
                                    a.name,
                                    a.email,
                                    a.nik,
                                    a.identity_no,
                                    a.image_profile,
                                    UPPER(LEFT(a.name, 1)) AS initial,
                                    a.kategori_id,
                                    a.duty_days,
                                    a.duty_hours,
                                    a.hours_month,
                                    a.active,
                                    a.suspended,

                                    -- Nama kategori tenaga
                                    (
                                        SELECT kategori 
                                        FROM dt01_hrd_kategori_tenaga_ms 
                                        WHERE org_id = a.org_id 
                                        AND active = '1' 
                                        AND kategori_id = a.kategori_id
                                    ) AS kategori,

                                    -- Posisi utama
                                    (
                                        SELECT trans_id 
                                        FROM dt01_hrd_position_dt 
                                        WHERE org_id = a.org_id 
                                        AND active = '1' 
                                        AND status = '1' 
                                        AND position_primary = 'Y' 
                                        AND user_id = a.user_id
                                    ) AS transidprimary,

                                    (
                                        SELECT atasan_id 
                                        FROM dt01_hrd_position_dt 
                                        WHERE org_id = a.org_id 
                                        AND active = '1' 
                                        AND status = '1' 
                                        AND position_primary = 'Y' 
                                        AND user_id = a.user_id
                                    ) AS atasanidprimary,

                                    (
                                        SELECT position_id 
                                        FROM dt01_hrd_position_dt 
                                        WHERE org_id = a.org_id 
                                        AND active = '1' 
                                        AND status = '1' 
                                        AND position_primary = 'Y' 
                                        AND user_id = a.user_id
                                    ) AS positioidprimary,

                                    -- Gabungan data posisi sekunder (secondary)
                                    (
                                        SELECT GROUP_CONCAT(
                                            b.trans_id, ':',
                                            b.position_id, ':',
                                            b.atasan_id, ':',
                                            COALESCE(p.position, ''), ':',
                                            COALESCE(f.level, ''), ':',
                                            COALESCE(u.name, '')
                                            SEPARATOR ';'
                                        )
                                        FROM dt01_hrd_position_dt b
                                        LEFT JOIN dt01_hrd_position_ms p 
                                            ON p.position_id = b.position_id 
                                        AND p.active = '1' 
                                        AND p.org_id = a.org_id
                                        LEFT JOIN dt01_gen_level_fungsional_ms f 
                                            ON f.level_id = p.level_fungsional 
                                        AND f.active = '1' 
                                        AND f.org_id = a.org_id
                                        LEFT JOIN dt01_gen_user_data u 
                                            ON u.user_id = b.atasan_id 
                                        AND u.active = '1' 
                                        AND u.org_id = a.org_id
                                        WHERE b.active = '1'
                                        AND b.status = '1'
                                        AND b.position_primary = 'N'
                                        AND b.org_id = a.org_id
                                        AND b.user_id = a.user_id
                                    ) AS membersecondry

                                FROM dt01_gen_user_data a
                                WHERE a.org_id = '".$orgid."'
                            ) x
                        ) y

                        ORDER BY y.positioidprimary asc, name asc

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertpenempatan($data){           
            $sql =   $this->db->insert("dt01_hrd_position_dt",$data);
            return $sql;
        }

        function updatepenempatan($data,$transid){           
            $sql =   $this->db->update("dt01_hrd_position_dt",$data,array("trans_id"=>$transid));
            return $sql;
        }

        function updateuserdata($data,$userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("user_id"=>$userid));
            return $sql;
        }

    }
?>