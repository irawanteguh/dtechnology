<?php
    class Modeldashboard extends CI_Model{

        function todolist($orgid,$userid){
            $query =
                    "
                        SELECT X.*,
                                case 
                                    when X.DUEDATE = '1' THEN 'Today'
                                    when X.DUEDATE = '2' then CONCAT('Due in ', X.DAYS_DIFF, ' Days')
                                    when X.DUEDATE = '3' then CONCAT('Due in ', X.DAYS_DIFF, ' Days')
                                    else CONCAT('Due in ', X.WEEKS_DIFF, ' Weeks')
                                end KETERANGAN,
                                case 
                                    when X.status = '1' and X.DAYS_DIFF < 1 then 
                                    '0'
                                    else
                                    '1'
                                end statusshow,
                                case
                                    WHEN x.status = '0' AND x.due_date < CURRENT_DATE THEN '1'
                                    WHEN x.status = '0' AND x.due_date >= CURRENT_DATE THEN '2'
                                    WHEN x.status = '1' THEN '3'
                                    ELSE '0'
                                end countstatus
                                
                        FROM(
                            SELECT a.*,
                                CASE
                                    WHEN DATE(a.DUE_DATE) <= CURDATE() THEN 1
                                    WHEN YEAR(a.DUE_DATE) = YEAR(CURDATE()) AND WEEK(a.DUE_DATE) = WEEK(CURDATE()) THEN 2
                                    WHEN MONTH(a.DUE_DATE) = MONTH(CURDATE()) THEN 3
                                    WHEN YEAR(a.DUE_DATE) = YEAR(CURDATE()) THEN 4
                                    ELSE 0
                                END DUEDATE,
                                DATEDIFF(a.DUE_DATE, CURDATE()) AS DAYS_DIFF,
                                TIMESTAMPDIFF(WEEK, CURDATE(), a.DUE_DATE) AS WEEKS_DIFF,
                                (select name from dt01_gen_user_data where active='1' and org_id='".$orgid."' and user_id=a.created_by)dibuatoleh
                                
                            FROM dt01_hrd_todo_dt a
                            WHERE a.active='1'
                            AND a.org_id='".$orgid."'
                            AND a.user_id='".$userid."'
                        )X
                        order by DUEDATE asc,  DUE_DATE  ASC
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function charttodolist($orgid,$userid){
            $query =
                    "
                        select
                                case
                                    WHEN a.status = '0' AND a.due_date < CURRENT_DATE THEN 'Over due date'
                                    WHEN a.status = '0' AND a.due_date >= CURRENT_DATE THEN 'Yet to start'
                                    WHEN a.status = '1' THEN 'Completed'
                                    ELSE 'Unknown'
                                end AS status,
                                    count(todo_id)jml
                        from dt01_hrd_todo_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        GROUP BY 
                                CASE
                                    WHEN a.status = '0' AND a.due_date < CURRENT_DATE THEN 'Over due date'
                                    WHEN a.status = '0' AND a.due_date >= CURRENT_DATE THEN 'Yet to start'
                                    WHEN a.status = '1' THEN 'Completed'
                                    ELSE 'Unknown'
                                END
                        order by status asc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datastaff($orgid,$userid){
            $query =
                    "
                        select y.*,
                            presentasiperilaku+presentasiactivity resultkpi
                        from(
                            select x.*,
                                (select level from dt01_gen_level_fungsional_ms where org_id=x.org_id and active='1' and level_id=x.levelfungsionalprimaryid)fungsionalprimary,
                                (select concat(name,' ',area) from dt01_hrd_klinis_ms where active='1' and klinis_id=x.klinis_id)klinis,
                                COALESCE(round(jmlnilaiassessment/jmlkomponenpenilaian*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ASSESSMENT')*10,0),0) presentasiperilaku,
                                COALESCE(round(case when jmldisetujui > hours_month then hours_month else jmldisetujui end /hours_month*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ACTIVITY')*100,0),0) presentasiactivity
                                                            
                            from(
                                select a.org_id, user_id,
                                        (select klinis_id from dt01_gen_user_data where active=a.active and org_id=a.org_id and user_id=a.user_id)klinis_id,
                                        (select kategori_id from dt01_gen_user_data where active=a.active and org_id=a.org_id and user_id=a.user_id)kategori_id,
                                        (select level_fungsional from dt01_hrd_position_ms where org_id=a.org_id and active='1' and position_id=a.position_id)levelfungsionalprimaryid,
                                        (select image_profile from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)image_profile,
                                        (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)name,
                                        (select upper(LEFT(name, 1)) from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)initial,
                                        (select position from dt01_hrd_position_ms where active='1' and org_id=a.org_id and position_id=a.position_id)position,
                                        (select hours_month from dt01_gen_user_data where active=a.active and org_id=a.org_id and user_id=a.user_id)hours_month,
                                        (select sum(total) from dt01_hrd_activity_dt where active=a.active and org_id=a.org_id and user_id=a.user_id and status='1')jmldisetujui,
                                        (select sum(nilai) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id)jmlnilaiassessment,
                                        (select count(assessment_id) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id)jmlkomponenpenilaian
                                        
                                from dt01_hrd_position_dt a
                                where a.active='1'
                                and   a.position_primary='Y'
                                and   a.org_id='".$orgid."'
                                and   a.atasan_id='".$userid."'
                            )x
                        )y
                        order by name asc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function prioritas(){
            $query =
                    "
                        select '0' id, 'Low' status
                        union
                        select '1' id, 'Medium Low' status
                        union
                        select '2' id, 'Medium High' status
                        union
                        select '3' id, 'High' status
                        order by id asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function inserttodolist($data){           
            $sql =   $this->db->insert("dt01_hrd_todo_dt",$data);
            return $sql;
        }

        function updatetodolist($data, $todoid){           
            $sql =   $this->db->update("dt01_hrd_todo_dt",$data,array("TODO_ID"=>$todoid));
            return $sql;
        }


    }
?>