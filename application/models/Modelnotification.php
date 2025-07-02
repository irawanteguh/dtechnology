<?php
    class Modelnotification extends CI_Model{

        function informationkpi($orgid){
            $query =
                    "
                        select x.*,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                            date_format(DATE_SUB(CURDATE(), INTERVAL 1 MONTH),'%m.%Y')
                                    else
                                        date_format(CURDATE(),'%m.%Y')
                                end periodeidassessment,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                        CONCAT(MONTHNAME(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)))
                                    else
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                end periodeketeranganassessment,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        date_format(DATE_SUB(CURDATE(), INTERVAL 1 MONTH),'%m.%Y')
                                    else
                                        date_format(CURDATE(),'%m.%Y')
                                end periodeidactivity,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        CONCAT(MONTHNAME(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)))
                                    else
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                end periodeketeranganactivity,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                    else
                                        CONCAT(MONTHNAME(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)))
                                end periodeketeranganbatassactivity,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                            CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                    else
                                        CONCAT(MONTHNAME(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)))
                                end keteranganbatasassessment

                        from(
                        select
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='START_VALID_ASSESSMENT') startassessment,
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='END_VALID_ASSESSMENT') endassessment,
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='END_VALID_ACTIVITY') endactivity
                        )x                     
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function selfreportkpi($orgid,$periodeidactivity,$periodeidassessment,$userid){
            $query =
                    "
                        select y.*,
                            presentasiperilaku+presentasiactivity resultkpi
                        from(
                            select x.*,
                                    coalesce(round(jmlnilaiassessment/jmlkomponenpenilaian*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ASSESSMENT')*10,0),0) presentasiperilaku,
                                    coalesce(round(case when jmldisetujui > hours_month then hours_month else jmldisetujui end /hours_month*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ACTIVITY')*100,0),0) presentasiactivity
                            from(
                                select a.org_id, user_id, name, hours_month,
                                    (select position from dt01_hrd_position_ms where active=a.active and org_id=a.org_id and position_id=(select position_id from dt01_hrd_position_dt where org_id=a.org_id and active='1' and status='1' and position_primary='Y' and user_id=a.user_id))position,
                                    (select count(assessment_id) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeidassessment."')jmlkomponenpenilaian,
                                    (select sum(nilai) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeidassessment."')jmlnilaiassessment,
                                    (select sum(total) from dt01_hrd_activity_dt where active=a.active and org_id=a.org_id and user_id=a.user_id and status='1' and date_format(start_date, '%m.%Y')='".$periodeidactivity."')jmldisetujui
                                from dt01_gen_user_data a
                                where a.active='1'
                                and   a.org_id='".$orgid."'
                                and   a.user_id='".$userid."'
                            )x
                        )y
                        order by name asc        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function broadcastwhatsapp($orgid){
            $query =
                    "
                        select a.transaksi_id, a.to, directory, body_1, body_2, body_3, body_4, body_5, body_6, body_7, body_8, body_9, body_10, type_file, document_name,
                            (select transaksi_id from dt01_whatsapp_device_ms where status='connected' and org_id=a.org_id and device_id=a.device_id)session
                        from dt01_whatsapp_broadcast_hd a
                        where a.active='1'
                        and   a.status='0'                   
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatestatusbroadcastwhatsapp($data, $transaksi){           
            $sql =   $this->db->update("dt01_whatsapp_broadcast_hd",$data,array("transaksi_id"=>$transaksi));
            return $sql;
        }

    }
?>