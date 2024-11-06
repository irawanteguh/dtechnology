<?php
    class Modelreportkpi extends CI_Model{

        function periode(){
            $query =
                    "
                        select distinct date_format(a.start_date,'%m.%Y')periode, date_format(a.start_date,'%M %Y')keterangan
                        from dt01_hrd_activity_dt a
                        where a.active='1'
                        order by periode desc
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

        function reportkpi($orgid,$periodeid){
            $query =
                    "
                        select y.*,
                            presentasiperilaku+presentasiactivity resultkpi
                        from(
                            select x.*,
                                    coalesce(round(jmlnilaiassessment/jmlkomponenpenilaian*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ASSESSMENT')*10,0),0) presentasiperilaku,
                                    coalesce(round(case when jmldisetujui > hours_month then hours_month else jmldisetujui end /hours_month*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ACTIVITY')*100,0),0) presentasiactivity
                            from(
                                select a.org_id, user_id, name, nik, hours_month,
                                    (select position from dt01_hrd_position_ms where active=a.active and org_id=a.org_id and position_id=(select position_id from dt01_hrd_position_dt where org_id=a.org_id and active='1' and status='1' and position_primary='Y' and user_id=a.user_id))position,
                                    (select count(assessment_id) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeid."')jmlkomponenpenilaian,
                                    (select sum(nilai) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeid."')jmlnilaiassessment,
                                    (select sum(total) from dt01_hrd_activity_dt where active=a.active and org_id=a.org_id and user_id=a.user_id and status='1' and date_format(start_date, '%m.%Y')='".$periodeid."')jmldisetujui
                                from dt01_gen_user_data a
                                where a.active='1'
                                and   a.org_id='".$orgid."'
                            )x
                        )y
                        order by name asc        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>