<?php
    class Modelserviceapi extends CI_Model{

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

    }

?>