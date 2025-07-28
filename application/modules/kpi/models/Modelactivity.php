<?php
    class Modelactivity extends CI_Model{

        function calender($orgid,$userid){
            $query =
                    "
                        select x.*
                        from(
                            select a.trans_id, status, activity,
                                concat(DATE_FORMAT(a.start_date, '%Y-%m-%d'),'T',start_time_in,':00') start_date,
                                concat(DATE_FORMAT(a.end_date, '%Y-%m-%d'),'T',end_time_out,':00') end_date,
                                (select activity from dt01_hrd_activity_ms where active='1' and activity_id=a.activity_id)kegiatanutama,
                                (select name from dt01_gen_user_data where active='1' and user_id=a.atasan_id)validatorkegiatan
                            from dt01_hrd_activity_dt a
                            where a.active='1'
                            and   a.org_id='".$orgid."'
                            and   a.user_id='".$userid."'
                            union
                            select a.no_rawat trans_id,
                                '0'status,
                                concat(
                                    'Melakukan Anamnesa Pasien Rawat Jalan No Rekam Medis : ',
                                    (select no_rkm_medis from reg_periksa where no_rawat=a.no_rawat),
                                    ' Atasnama : ',
                                    (select nm_pasien from pasien where no_rkm_medis =(select no_rkm_medis from reg_periksa where no_rawat=a.no_rawat)),
                                    ' By Integrated From Khanza'
                                )activity,
                                concat(date_format(a.tanggal, '%Y-%m-%d'),'T',date_format(a.tanggal, '%H:%i:%S')) start_date,
                                concat(date_format(date_add(a.tanggal, INTERVAL 3 MINUTE), '%Y-%m-%d'), 'T', date_format(date_add(a.tanggal, INTERVAL 3 MINUTE), '%H:%i:%S')) AS end_date,
                                (select activity from dt01_hrd_activity_ms where active='1' and activity_id='d2264ea0-54b6-443a-87b4-86ef3b4b62c0')kegiatanutama,
                                (select name from dt01_gen_user_data where user_id=(select atasan_id from dt01_hrd_position_dt where active='1' and position_primary='Y' and user_id='".$userid."'))validatorkegiatan
                            from penilaian_awal_keperawatan_ralan a
                            where a.nip = (select nik from dt01_gen_user_data where active='1' and user_id='".$userid."')
                            and   a.no_rawat not in (select trans_id from dt01_hrd_activity_dt where active='1')
                        )x
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekklinisactivity($activityid){
            $query =
                    "
                        select a.pk
                        from dt01_hrd_activity_ms a
                        where a.active='1'
                        and   a.activity_id='".$activityid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function cekklinisid($orgid,$groupid,$userid){
            $query =
                    "
                        select a.klinis_id
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."' or group_id='".$groupid."'
                        and   a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function cekatasanid($orgid,$userid,$paramater){
            $query =
                    "
                        select a.atasan_id
                        from dt01_hrd_position_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        ".$paramater."
                        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function activity($groupid,$userid,$pk){
            $query =
                    "
                        select x.*
                        from(
                                select concat(a.activity_id,':',durasi)activity_id, concat(activity,' Durasi ',durasi,' Menit')activity, durasi,
                                    (select nomor from dt01_hrd_klinis_ms a where active='1' and klinis_id=a.pk)urut
                                from dt01_hrd_activity_ms a
                                where a.active='1'
                                and   a.group_id='".$groupid."'
                                and   a.activity_id in ( select activity_id from dt01_hrd_mapping_activity where group_id='".$groupid."' and active='1' and position_id in (select position_id from dt01_hrd_position_dt where group_id='".$groupid."' and active='1' and status='1' and user_id='".$userid."'))
                                
                                union

                                select concat(a.activity_id,':',durasi)activity_id, concat(' [ ',(select concat(name,' ',area)  from dt01_hrd_klinis_ms where active='1' and klinis_id=a.pk),' ] ',activity,' Durasi ',durasi,' Menit')activity, durasi,
                                     (select nomor from dt01_hrd_klinis_ms a where active='1' and klinis_id=a.pk)urut
                                from dt01_hrd_activity_ms a
                                where a.active='1'
                                and   a.group_id='".$groupid."'
                                and   a.pk in ( select sub_klinis_id from dt01_hrd_mapping_klinis where active='1' ".$pk.")
                        )x
                        order by x.urut desc, x.activity asc, x.durasi asc
                                                                    
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekKegiatan($org_id, $user_id, $start_date, $start_time_in, $end_time_out){
            $query =
                    "
                        SELECT *
                        FROM dt01_hrd_activity_dt
                        WHERE org_id = '".$org_id."'
                        AND user_id = '".$user_id."'
                        AND start_date = '".$start_date."'
                        AND active = '1'
                        AND status IN ('0', '1')
                        AND (
                                        ('".$start_time_in."' BETWEEN start_time_in AND end_time_out) 
                                        OR ('".$end_time_out."' BETWEEN `start_time_in` AND end_time_out) 
                                        OR (`start_time_in` BETWEEN '".$start_time_in."' AND '".$end_time_out."') 
                                        OR (`end_time_out` BETWEEN '".$start_time_in."' AND '".$end_time_out."')
                                    )
                                                                    
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }     

        function volume($groupid,$activityid,$starttime,$endtime) {
            // Cleaned & parameterized where possible
            $groupid    = $this->db->escape_str($groupid);
            $activityid = $this->db->escape_str($activityid);
            $starttime  = $this->db->escape_str($starttime);
            $endtime    = $this->db->escape_str($endtime);

            $query = "
                SELECT x.*
                FROM (
                    SELECT 1 AS vol UNION ALL
                    SELECT 2 UNION ALL
                    SELECT 3 UNION ALL
                    SELECT 4 UNION ALL
                    SELECT 5 UNION ALL
                    SELECT 6 UNION ALL
                    SELECT 7 UNION ALL
                    SELECT 8 UNION ALL
                    SELECT 9 UNION ALL
                    SELECT 10 UNION ALL
                    SELECT 11 UNION ALL
                    SELECT 12 UNION ALL
                    SELECT 13 UNION ALL
                    SELECT 14 UNION ALL
                    SELECT 15 UNION ALL
                    SELECT 16 UNION ALL
                    SELECT 17 UNION ALL
                    SELECT 18 UNION ALL
                    SELECT 19 UNION ALL
                    SELECT 20 UNION ALL
                    SELECT 21 UNION ALL
                    SELECT 22 UNION ALL
                    SELECT 23 UNION ALL
                    SELECT 24 UNION ALL
                    SELECT 25 UNION ALL
                    SELECT 26 UNION ALL
                    SELECT 27 UNION ALL
                    SELECT 28 UNION ALL
                    SELECT 29 UNION ALL
                    SELECT 30 UNION ALL
                    SELECT 31 UNION ALL
                    SELECT 32 UNION ALL
                    SELECT 33 UNION ALL
                    SELECT 34 UNION ALL
                    SELECT 35 UNION ALL
                    SELECT 36 UNION ALL
                    SELECT 37 UNION ALL
                    SELECT 38 UNION ALL
                    SELECT 39 UNION ALL
                    SELECT 40
                ) x
                WHERE CAST(x.vol AS UNSIGNED) <= (
                    SELECT FLOOR(
                        (TIME_TO_SEC(STR_TO_DATE('$endtime', '%H:%i')) - TIME_TO_SEC(STR_TO_DATE('$starttime', '%H:%i'))) / 60 
                        / durasi
                    )
                    FROM dt01_hrd_activity_ms
                    WHERE active = '1' AND group_id = '$groupid' AND activity_id = '$activityid'
                    LIMIT 1
                )
                ORDER BY CAST(x.vol AS UNSIGNED) DESC
            ";

            $recordset = $this->db->query($query)->result();
            return $recordset;
        }

        function insertactivity($data){           
            $sql =   $this->db->insert("dt01_hrd_activity_dt",$data);
            return $sql;
        }

        function updateactivity($data,$transid){           
            $sql =   $this->db->update("dt01_hrd_activity_dt",$data,array("trans_id"=>$transid));
            return $sql;
        }

    }
?>