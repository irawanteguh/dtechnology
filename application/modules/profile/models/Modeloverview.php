<?php
    class Modeloverview extends CI_Model{

        function summarykpi($orgid,$userid){
            $query =
                    "
                        select y.*,
                            presentasiperilaku+presentasiactivity resultkpi
                        from(
                        select x.*,
                            coalesce(round(jmlnilaiassessment/jmlkomponenpenilaian*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ASSESSMENT')*10,0),0) presentasiperilaku,
                            coalesce(round(case when approve > hours_month then hours_month else approve end /hours_month*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ACTIVITY')*100,0),0) presentasiactivity
                        from(
                        select org_id, date_format(a.start_date,'%m.%Y')periode, 
                            (select hours_month from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)hours_month,
                            (select sum(nilai) from dt01_hrd_assessment_dt where org_id=a.org_id and user_id=a.user_id and periode=date_format(a.start_date,'%m.%Y'))jmlnilaiassessment,
                            (select count(assessment_id) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode=date_format(a.start_date,'%m.%Y'))jmlkomponenpenilaian,
                            sum(case when a.active='1' then total end)dibuat,
                            sum(case when a.active='1' and status='0' then total end)wait,
                            sum(case when a.active='1' and status='1' then total end)approve,
                            sum(case when a.active='1' and status='2' then total end)revisi,
                            sum(case when a.active='1' and status='9' then total end)tolak
                        from dt01_hrd_activity_dt a
                        where a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        group by date_format(a.start_date,'%m.%Y')
                        
                        )x
                        )y
                        order by periode desc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
    }
?>
