<?php
    class Modelreportkpi extends CI_Model{

        function periode(){
            $query =
                    "
                        select distinct date_format(a.start_date,'%m.%Y')periode, date_format(a.start_date,'%M %Y')keterangan
                        from dt01_hrd_activity_dt a
                        where a.active='1'
                        order by start_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function kepatuhaninput($orgid,$periodeid){
            $query =
                    "
                        select case 
                                    when dibuat >= efektif then
                                    100
                                    else
                                    round((dibuat/efektif)*100,2) 
                                end presentasi
                        from(
                            select sum(a.hours_month)efektif,
                                (select sum(total) from dt01_hrd_activity_dt where active=a.active and org_id=a.org_id and date_format(start_date, '%m.%Y')='".$periodeid."')dibuat
                            from dt01_gen_user_data a
                            where a.org_id='".$orgid."'
                            and   a.active='1'
                        )x       
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function kepatuhanvalidasi($orgid,$periodeid){
            $query =
                    "
                        select case
                                when x.totaldivalidasi >= totaldibuat then
                                100
                                else
                                round(((totaldivalidasi/totaldibuat)*100),2) 
                        end presentasi

                        from(
                        SELECT 
                            SUM(CASE WHEN a.active = '1' THEN total END) AS totaldibuat,
                            SUM(CASE WHEN a.status <> '0' THEN total END) AS totaldivalidasi
                        FROM dt01_hrd_activity_dt a
                        WHERE a.active = '1'
                        AND a.org_id = '".$orgid."'
                        AND DATE_FORMAT(a.start_date, '%m.%Y') = '".$periodeid."'
                        )x
       
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function reportkpi($orgid, $periodeid){
            $query = "
                WITH position_data AS (
                    SELECT 
                        dt.user_id,
                        dt.org_id,
                        ms.position
                    FROM dt01_hrd_position_dt dt
                    JOIN dt01_hrd_position_ms ms ON 
                        dt.position_id = ms.position_id AND 
                        ms.active = '1'
                    WHERE 
                        dt.active = '1' AND 
                        dt.status = '1' AND 
                        dt.position_primary = 'Y'
                ),
                assessment_data AS (
                    SELECT 
                        user_id, 
                        org_id,
                        COUNT(*) AS jmlkomponenpenilaian,
                        SUM(nilai) AS jmlnilaiassessment
                    FROM dt01_hrd_assessment_dt
                    WHERE periode = ?
                    GROUP BY user_id, org_id
                ),
                activity_data AS (
                    SELECT 
                        user_id, 
                        org_id, 
                        SUM(total) AS jmldisetujui
                    FROM dt01_hrd_activity_dt
                    WHERE 
                        active = '1' AND 
                        status = '1' AND 
                        DATE_FORMAT(start_date, '%m.%Y') = ?
                    GROUP BY user_id, org_id
                ),
                env_data AS (
                    SELECT 
                        org_id,
                        MAX(CASE WHEN environment_name = 'MAX_VALUE_ASSESSMENT' THEN prod END) AS max_value_assessment,
                        MAX(CASE WHEN environment_name = 'MAX_VALUE_ACTIVITY' THEN prod END) AS max_value_activity
                    FROM dt01_gen_enviroment_ms
                    GROUP BY org_id
                )

                SELECT 
                    u.org_id,
                    u.user_id,
                    u.name,
                    u.nik,
                    u.hours_month,
                    p.position,
                    COALESCE(ROUND(a.jmlnilaiassessment / NULLIF(a.jmlkomponenpenilaian, 0) * (e.max_value_assessment / 100) * 10, 0), 0) AS presentasiperilaku,
                    COALESCE(ROUND(
                        LEAST(COALESCE(act.jmldisetujui,0), u.hours_month) / u.hours_month * 
                        (e.max_value_activity / 100) * 100, 0), 0) AS presentasiactivity,
                    (
                        COALESCE(ROUND(a.jmlnilaiassessment / NULLIF(a.jmlkomponenpenilaian, 0) * (e.max_value_assessment / 100) * 10, 0), 0) +
                        COALESCE(ROUND(
                            LEAST(COALESCE(act.jmldisetujui,0), u.hours_month) / u.hours_month * 
                            (e.max_value_activity / 100) * 100, 0), 0)
                    ) AS resultkpi
                FROM dt01_gen_user_data u
                LEFT JOIN position_data p ON p.user_id = u.user_id AND p.org_id = u.org_id
                LEFT JOIN assessment_data a ON a.user_id = u.user_id AND a.org_id = u.org_id
                LEFT JOIN activity_data act ON act.user_id = u.user_id AND act.org_id = u.org_id
                LEFT JOIN env_data e ON e.org_id = u.org_id
                WHERE u.active = '1' AND u.org_id = ?
                ORDER BY u.name ASC
            ";

            $recordset = $this->db->query($query, array($periodeid, $periodeid, $orgid));
            return $recordset->result();
        }


        // function reportkpi($orgid,$periodeid){
        //     $query =
        //             "
        //                 select y.*,
        //                     presentasiperilaku+presentasiactivity resultkpi
        //                 from(
        //                     select x.*,
        //                             coalesce(round(jmlnilaiassessment/jmlkomponenpenilaian*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ASSESSMENT')*10,0),0) presentasiperilaku,
        //                             coalesce(round(case when jmldisetujui > hours_month then hours_month else jmldisetujui end /hours_month*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ACTIVITY')*100,0),0) presentasiactivity
        //                     from(
        //                         select a.org_id, user_id, name, nik, hours_month,
        //                             (select position from dt01_hrd_position_ms where active=a.active and org_id=a.org_id and position_id=(select position_id from dt01_hrd_position_dt where org_id=a.org_id and active='1' and status='1' and position_primary='Y' and user_id=a.user_id))position,
        //                             (select count(assessment_id) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeid."')jmlkomponenpenilaian,
        //                             (select sum(nilai) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeid."')jmlnilaiassessment,
        //                             (select sum(total) from dt01_hrd_activity_dt where active=a.active and org_id=a.org_id and user_id=a.user_id and status='1' and date_format(start_date, '%m.%Y')='".$periodeid."')jmldisetujui
        //                         from dt01_gen_user_data a
        //                         where a.active='1'
        //                         and   a.org_id='".$orgid."'
        //                     )x
        //                 )y
        //                 order by name asc        
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

    }
?>