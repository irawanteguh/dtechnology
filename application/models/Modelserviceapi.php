<?php
    class Modelserviceapi extends CI_Model{

        function login($orgid,$username,$password){
            $query =
                    "
                        select a.user_id
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.username='".$username."'
                        and   a.password='".$password."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function datasession($userid){
            $query =
                    "
                        select a.user_id, name, image_profile, org_id, username, suspended, upper(LEFT(a.name, 1)) initial, email, address,
                               (select org_name from dt01_gen_organization_ms where active='1' and org_id=a.org_id)hospitalname,
                               (select website  from dt01_gen_organization_ms where active='1' and org_id=a.org_id)website,
                               (select trial    from dt01_gen_organization_ms where active='1' and org_id=a.org_id)trial                               

                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function savelog($data){           
            $sql =   $this->db->insert("dt01_service_api_logs_out",$data);
            return $sql;
        }

        function log($orgid){
            $query =
                    "
                        select a.request_url, source,
                            CASE
                                WHEN a.response_status BETWEEN 200 AND 299 THEN CONCAT(a.response_status, ' OK')
                                WHEN a.response_status BETWEEN 300 AND 399 THEN CONCAT(a.response_status, ' WRN')
                                WHEN a.response_status BETWEEN 400 AND 599 THEN CONCAT(a.response_status, ' ERR')
                                ELSE CONCAT(a.response_status, ' INFO')
                            END AS response_status,
                                CASE
                                    WHEN TIMESTAMPDIFF(SECOND, a.created_date, NOW()) < 60 THEN 'Just now'
                                    WHEN TIMESTAMPDIFF(HOUR, a.created_date, NOW()) < 1 THEN CONCAT(TIMESTAMPDIFF(MINUTE, a.created_date, NOW()), ' mins')
                                    WHEN TIMESTAMPDIFF(HOUR, a.created_date, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, a.created_date, NOW()), ' hrs')
                                    WHEN TIMESTAMPDIFF(DAY, a.created_date, NOW()) = 1 THEN '1 day'
                                    WHEN TIMESTAMPDIFF(DAY, a.created_date, NOW()) < 7 THEN CONCAT(TIMESTAMPDIFF(DAY, a.created_date, NOW()), ' days')
                                    WHEN TIMESTAMPDIFF(WEEK, a.created_date, NOW()) = 1 THEN '1 week'
                                    WHEN TIMESTAMPDIFF(WEEK, a.created_date, NOW()) < 4 THEN CONCAT(TIMESTAMPDIFF(WEEK, a.created_date, NOW()), ' weeks')
                                    ELSE DATE_FORMAT(a.created_date, '%b %e')
                                END AS created_date
                                
                        from dt01_service_api_logs_out a
                        where a.org_id='".$orgid."'
                        order by request_id desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdata($orgid,$date){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_report_income_dt_compare a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.date='".$date."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertquickreport($data){           
            $sql =   $this->db->insert("dt01_report_income_dt_compare",$data);
            return $sql;
        }

        function updatequickreport($orgid,$date,$data){           
            $sql =   $this->db->update("dt01_report_income_dt_compare",$data,array("org_id"=>$orgid,"date"=>$date));
            return $sql;
        }

    }

?>