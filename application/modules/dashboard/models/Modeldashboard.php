<?php
    class Modeldashboard extends CI_Model{

        function todolist($orgid,$userid){
            $query =
                    "
                        SELECT 
                            X.*,
                            CASE 
                                WHEN X.duedate = 1 THEN 'Today'
                                WHEN X.duedate IN (2, 3) THEN CONCAT('Due in ', X.days_diff, ' Days')
                                ELSE CONCAT('Due in ', X.weeks_diff, ' Weeks')
                            END AS keterangan,
                            CASE 
                                WHEN X.status = '1' AND X.days_diff < 1 THEN '0'
                                ELSE '1'
                            END AS statusshow,
                            CASE
                                WHEN X.status = '0' AND X.due_date < CURRENT_DATE THEN '1'
                                WHEN X.status = '0' AND X.due_date >= CURRENT_DATE THEN '2'
                                WHEN X.status = '1' THEN '3'
                                ELSE '0'
                            END AS countstatus
                        FROM (
                            SELECT 
                                '1'jenis_id,
                                a.user_id, 
                                a.todo_id, 
                                a.todo, 
                                a.priority, 
                                a.status, 
                                a.due_date, 
                                a.active,
                                CASE
                                    WHEN DATE(a.due_date) <= CURDATE() THEN 1
                                    WHEN YEAR(a.due_date) = YEAR(CURDATE()) AND WEEK(a.due_date) = WEEK(CURDATE()) THEN 2
                                    WHEN MONTH(a.due_date) = MONTH(CURDATE()) THEN 3
                                    WHEN YEAR(a.due_date) = YEAR(CURDATE()) THEN 4
                                    ELSE 0
                                END AS duedate,
                                DATEDIFF(a.due_date, CURDATE()) AS days_diff,
                                TIMESTAMPDIFF(WEEK, CURDATE(), a.due_date) AS weeks_diff,
                                u.name AS dibuatoleh
                            FROM dt01_hrd_todo_dt a
                            LEFT JOIN dt01_gen_user_data u 
                                ON u.user_id = a.created_by 
                                AND u.active = '1'
                                AND u.org_id = a.org_id
                            WHERE 
                                a.active = '1'
                                AND a.org_id = '".$orgid."'
                                AND a.user_id = '".$userid."'

                            UNION ALL

                            SELECT 
                                '2'jenis_id,
                                a.created_by AS user_id, 
                                a.trans_id AS todo_id, 
                                CONCAT('Melengkapi Pengisian Asset ', a.name) AS todo, 
                                '2' AS priority, 
                                case
                                    when (a.tahun_perolehan is not null ) and (nilai_perolehan <> 0) and (waktu_depresiasi <> 0) and (estimasi_penggunaan_day <> 0) then
                                    '1'
                                    else
                                    '0'
                                end status,
                                a.created_date AS due_date, 
                                a.active,
                                CASE
                                    WHEN DATE(a.created_date) <= CURDATE() THEN 1
                                    WHEN YEAR(a.created_date) = YEAR(CURDATE()) AND WEEK(a.created_date) = WEEK(CURDATE()) THEN 2
                                    WHEN MONTH(a.created_date) = MONTH(CURDATE()) THEN 3
                                    WHEN YEAR(a.created_date) = YEAR(CURDATE()) THEN 4
                                    ELSE 0
                                END AS duedate,
                                DATEDIFF(a.created_date, CURDATE()) AS days_diff,
                                TIMESTAMPDIFF(WEEK, CURDATE(), a.created_date) AS weeks_diff,
                                u.name AS dibuatoleh
                            FROM dt01_lgu_assets_ms a
                            LEFT JOIN dt01_gen_user_data u 
                                ON u.user_id = a.created_by 
                                AND u.active = '1'
                                AND u.org_id = a.org_id
                            WHERE 
                                a.active = '1'
                                AND a.org_id = '".$orgid."'
                                AND a.created_by = '".$userid."'
                        ) X
                        ORDER BY X.duedate ASC, X.due_date ASC;                
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

        function datastaff($orgid,$userid,$periodeidactivity,$periodeidassessment){
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
                                        (select upper(left(name, 1)) from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)initial,
                                        (select position from dt01_hrd_position_ms where active='1' and org_id=a.org_id and position_id=a.position_id)position,
                                        (select hours_month from dt01_gen_user_data where active=a.active and org_id=a.org_id and user_id=a.user_id)hours_month,
                                        (select sum(total) from dt01_hrd_activity_dt where active=a.active and org_id=a.org_id and user_id=a.user_id and status='1' and date_format(start_date, '%m.%Y')='".$periodeidactivity."')jmldisetujui,
                                        (select sum(nilai) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeidassessment."')jmlnilaiassessment,
                                        (select count(assessment_id) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeidassessment."')jmlkomponenpenilaian
                                        
                                from dt01_hrd_position_dt a
                                where a.active='1'
                                and   a.position_primary='Y'
                                and   a.org_id='".$orgid."'
                                and   a.atasan_id='".$userid."'
                                and   a.user_id=(select user_id from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)
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