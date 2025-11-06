<?php
    class Modelvalidation extends CI_Model{

        function liststaff($orgid,$userid,$periodeid){
            $query =
                    "
                    WITH activity_summary AS (
                        SELECT 
                            org_id,
                            user_id,
                            atasan_id,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' THEN total ELSE 0 END) AS jmldibuat,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND status = '0' THEN total ELSE 0 END) AS jmlwait,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND status = '1' THEN total ELSE 0 END) AS jmldisetujui,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND status = '2' THEN total ELSE 0 END) AS jmldirevisi,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND status = '9' THEN total ELSE 0 END) AS jmlditolak,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND atasan_id IS NOT NULL THEN total ELSE 0 END) AS jmldibuatsec,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND atasan_id IS NOT NULL AND status = '0' THEN total ELSE 0 END) AS jmlwaitsec,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND atasan_id IS NOT NULL AND status = '1' THEN total ELSE 0 END) AS jmldisetujuisec,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND atasan_id IS NOT NULL AND status = '2' THEN total ELSE 0 END) AS jmldirevisisec,
                            SUM(CASE WHEN DATE_FORMAT(start_date, '%m.%Y') = '".$periodeid."' AND atasan_id IS NOT NULL AND status = '9' THEN total ELSE 0 END) AS jmlditolaksec
                        FROM dt01_hrd_activity_dt
                        WHERE active = '1'
                        GROUP BY org_id, user_id
                    ),
                    assessment_summary AS (
                        SELECT 
                            org_id,
                            user_id,
                            SUM(nilai) AS total_nilai,
                            COUNT(assessment_id) AS total_komponen
                        FROM dt01_hrd_assessment_dt
                        WHERE  active='1'
                        and    periode = '".$periodeid."'
                        GROUP BY org_id, user_id
                    ),
                    env_assessment AS (
                        SELECT org_id, prod / 100 AS nilai
                        FROM dt01_gen_enviroment_ms
                        WHERE environment_name = 'MAX_VALUE_ASSESSMENT'
                    ),
                    env_activity AS (
                        SELECT org_id, prod / 100 AS nilai
                        FROM dt01_gen_enviroment_ms
                        WHERE environment_name = 'MAX_VALUE_ACTIVITY'
                    )
                    select  d.*,
                            p.position,
                            p.level_fungsional,
                            u.name,
                            UPPER(LEFT(u.name, 1)) AS initial,
                            u.image_profile,
                            u.email,
                            u.kategori_id,
                            u.klinis_id,
                            u.hours_month,
                            (select level from dt01_gen_level_fungsional_ms WHERE org_id = d.org_id AND active = '1' AND level_id = p.level_fungsional) AS fungsionalprimary,
                            (select CONCAT(name,' ',area) from dt01_hrd_klinis_ms WHERE active = '1' AND klinis_id = u.klinis_id) AS klinis,
                            (select count(no_rawat)*3      from penilaian_awal_keperawatan_ralan where nip=(select nik from dt01_gen_user_data where active='1' and user_id=d.user_id and date_format(tanggal, '%m.%Y')='".$periodeid."') and no_rawat not in (select trans_id from dt01_hrd_activity_dt where active='1'))jmltambahan,
                            COALESCE(a.total_nilai, 0) AS jmlnilaiassessment,
                            COALESCE(a.total_komponen, 0) AS jmlkomponenpenilaian,
                            COALESCE(act.jmldibuat, 0) AS jmldibuat,
                            COALESCE(act.jmlwait, 0) AS jmlwait,
                            COALESCE(act.jmldisetujui, 0) AS jmldisetujui,
                            COALESCE(act.jmldirevisi, 0) AS jmldirevisi,
                            COALESCE(act.jmlditolak, 0) AS jmlditolak,
                            COALESCE(act.jmldibuatsec, 0) AS jmldibuatsec,
                            COALESCE(act.jmlwaitsec, 0) AS jmlwaitsec,
                            COALESCE(act.jmldisetujuisec, 0) AS jmldisetujuisec,
                            COALESCE(act.jmldirevisisec, 0) AS jmldirevisisec,
                            COALESCE(act.jmlditolaksec, 0) AS jmlditolaksec,
                            ROUND(COALESCE(a.total_nilai,0) / NULLIF(a.total_komponen,0) * COALESCE(ea.nilai,0) * 10, 0) AS presentasiperilaku,
                            ROUND(CASE WHEN act.jmldisetujui > u.hours_month THEN u.hours_month ELSE act.jmldisetujui END / u.hours_month * COALESCE(ev.nilai,0) * 100, 0) AS presentasiactivity,
                            ROUND(COALESCE(a.total_nilai,0) / NULLIF(a.total_komponen,0) * COALESCE(ea.nilai,0) * 10, 0) + ROUND(CASE WHEN act.jmldisetujui > u.hours_month THEN u.hours_month ELSE act.jmldisetujui END / u.hours_month * COALESCE(ev.nilai,0) * 100, 0) AS resultkpi
                    from(
                            select a.org_id, user_id, position_primary, atasan_id, position_id
                            from dt01_hrd_position_dt a
                            where a.active = '1'
                            and   a.status = '1'
                            and   a.org_id = '".$orgid."'
                            and   a.atasan_id = '".$userid."'
                            and   EXISTS (
                                            select 1 
                                            from dt01_gen_user_data 
                                            where active = '1' 
                                            and   org_id = a.org_id 
                                            and   user_id = a.user_id
                                )
                            union
                            select a.org_id, user_id, 'X' AS position_primary, atasan_id, 
                                (select position_id from dt01_hrd_position_dt where active = '1' and status = '1' and org_id = a.org_id and user_id = a.user_id) AS position_id
                            from dt01_hrd_activity_dt a
                            where a.active = '1'
                            and   a.status = '0'
                            and   a.org_id = '".$orgid."'
                            and   a.atasan_id = '".$userid."'
                            and   EXISTS (
                                            select 1 
                                            from dt01_gen_user_data 
                                            where active = '1' 
                                            and org_id = a.org_id 
                                            and user_id = a.user_id
                                )
                            and  a.user_id NOT IN (
                                                    select user_id 
                                                    from dt01_hrd_position_dt 
                                                    where active = '1' 
                                                    and   status = '1' 
                                                    and   org_id = a.org_id 
                                                    and   atasan_id = a.atasan_id
                                )
                    )d
                    JOIN dt01_hrd_position_ms p ON p.active = '1' AND p.position_id = d.position_id
                    JOIN dt01_gen_user_data u ON u.active = '1' AND u.user_id = d.user_id
                    LEFT JOIN activity_summary act ON act.user_id = d.user_id
                    LEFT JOIN assessment_summary a ON a.user_id = d.user_id AND a.org_id = d.org_id
                    LEFT JOIN env_assessment ea ON ea.org_id = d.org_id
                    LEFT JOIN env_activity ev ON ev.org_id = d.org_id
                    ORDER BY u.name ASC;    
                ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detailactivity($orgid,$atasanid,$userid,$periodeid){
            $query =
                    "
                    select x.*
                    from(
                            select '1'status, a.trans_id, activity_id, activity, date_format(start_date,'%d.%m.%Y')start_date, start_time_in, start_time_out, qty, user_id,
                                (select activity from dt01_hrd_activity_ms where org_id=a.org_id and active='1' and activity_id=a.activity_id)kegiatanutama
                            from dt01_hrd_activity_dt a
                            where a.active='1'
                            and   a.status='0'
                            and   a.org_id='".$orgid."'
                            and   a.atasan_id='".$atasanid."'
                            and   a.user_id='".$userid."'
                            and   DATE_FORMAT(a.start_date, '%m.%Y') = '".$periodeid."'
                            union
                            select '2'status, no_rawat trans_id,'d2264ea0-54b6-443a-87b4-86ef3b4b62c0'activity_id,
                                    concat(
                                        'Melakukan Anamnesa Pasien Rawat Jalan No Rekam Medis : ',
                                        (select no_rkm_medis from reg_periksa where no_rawat=a.no_rawat),
                                        ' Atasnama : ',
                                        (select nm_pasien from pasien where no_rkm_medis =(select no_rkm_medis from reg_periksa where no_rawat=a.no_rawat)),
                                        ' By Integrated From Khanza'
                                    )activity,
                                    date_format(tanggal,'%d.%m.%Y')start_date,
                                    date_format(tanggal,'%H:%i')start_time_in,
                                    date_format(date_add(a.tanggal, INTERVAL 3 MINUTE), '%H:%i')start_time_out,
                                    1 qty,
                                    '".$userid."' user_id,
                                (select activity from dt01_hrd_activity_ms where active='1' and activity_id='d2264ea0-54b6-443a-87b4-86ef3b4b62c0')kegiatanutama
                            from penilaian_awal_keperawatan_ralan a
                            where a.nip = (select nik from dt01_gen_user_data where active='1' and user_id='".$userid."')
                            and   a.no_rawat not in (select trans_id from dt01_hrd_activity_dt where active='1')
                            and   a.tanggal > '2025-02-01'
                        )x
                        limit 100;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listassement($orgid){
            $query =
                    "
                        select a.assessment_id, assessment, jenis, header_id, kategori_id
                        from dt01_hrd_assessment_ms a
                        where a.org_id='".$orgid."'
                        order by kategori_id asc, assessment asc           
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkassessment($orgid,$userid,$periode,$assessmenid){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_hrd_assessment_dt a
                        where a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        and   a.periode='".$periode."'
                        and   a.assessment_id='".$assessmenid."'        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkactivity($transid){
            $query =
                    "
                        select a.trans_id
                        from dt01_hrd_activity_dt a
                        where a.trans_id='".$transid."'        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateassessment($data,$userid,$periode,$assessmenid){           
            $sql =   $this->db->update("dt01_hrd_assessment_dt",$data,array("user_id"=>$userid,"periode"=>$periode,"assessment_id"=>$assessmenid));
            return $sql;
        }

        function insertassessment($data){           
            $sql =   $this->db->insert("dt01_hrd_assessment_dt",$data);
            return $sql;
        }

        function validasikegiatan($data,$transid){           
            $sql =   $this->db->update("dt01_hrd_activity_dt",$data,array("trans_id"=>$transid));
            return $sql;
        }

        function insertactivity($data){           
            $sql =   $this->db->insert("dt01_hrd_activity_dt",$data);
            return $sql;
        }

    }
?>