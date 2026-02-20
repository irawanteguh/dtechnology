<?php
    class Modelschedulemeeting extends CI_Model{

        function listmeeting($orgid){
            $query =
                    "
                        select a.meeting_id, meeting, description, DATE_FORMAT(a.date, '%d %M %Y') AS date, start_time, end_time, url, kategori_id,
                               ( select meeting from dt01_hrd_meeting_ms where active='1' and org_id=a.org_id and meeting_id=a.jenis_id)category
                        from dt01_hrd_meeting_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
    }
?>