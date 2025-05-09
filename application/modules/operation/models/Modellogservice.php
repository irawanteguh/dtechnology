<?php
    class Modellogservice extends CI_Model{

        function datalog($orgid,$startDate,$endDate){
            $query =
                    "
                        select a.*, date_format(created_date,'%d.%m.%Y %H:%i:%s')createddate
                        from dt01_service_api_logs_out a
                        where a.org_id='".$orgid."'
                        and   date(a.created_date) between '".$startDate."' and '".$endDate."'
                        order by request_id desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>