<?php
    class Modelgroupactivity extends CI_Model{

        function daftarjabatan($orgid,$parameter){
            $query =
                    "
                        select a.org_id, position_id, position, rvu, level, level_fungsional, date_format(last_update_date,'%d.%m.%Y %H:%i:%s')lastupdatedate,
                            (select ifnull(name, 'Unknown')  from  dt01_gen_user_data where active = '1' and org_id = '".$orgid."' and user_id = ifnull(a.created_by, a.last_update_by)) lastupdateby,
                            (select level from dt01_gen_level_fungsional_ms where active='1' and level_id=a.LEVEL_FUNGSIONAL)functional,
                            (select count(user_id) from dt01_hrd_position_dt where active='1' and status='1' and position_primary='Y' and org_id='".$orgid."' and position_id=a.position_id)jml
                        from dt01_hrd_position_ms a
                        where a.active='1'
                        and   upper(a.position) like upper('%".$parameter."%')
                        order by LEVEL DESC, POSITION asc, RVU DESC, POSITION ASC
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function daftarkegiatan($orgid,$positionid){
            $query =
                    "
                        select x.*,
                               case
                                   when transidmapping <> '' then 
                                   '0'
                                   else
                                   '1'
                               end urut
                        from(
                            select a.org_id, activity_id, activity, durasi,
                                (SELECT ifnull(name, 'Unknown')  FROM  dt01_gen_user_data WHERE active = '1' and org_id = '".$orgid."' and user_id = ifnull(a.created_by, a.last_update_by)) lastupdateby,
                                (select transaksi_id from dt01_hrd_mapping_activity where active='1' and activity_id=a.activity_id and position_id='".$positionid."')transidmapping
                            from dt01_hrd_activity_ms a
                            where a.active='1'
                            and   a.pk=''
                        )x
                        order by urut asc, activity asc, durasi asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkdata($positionid,$activityid){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_hrd_mapping_activity a
                        where a.position_id='".$positionid."'
                        and   a.activity_id='".$activityid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatemapping($positionid,$activityid,$data){           
            $sql =   $this->db->update("dt01_hrd_mapping_activity",$data,array("position_id"=>$positionid,"activity_id"=>$activityid));
            return $sql;
        }

        function insertmapping($data){           
            $sql =   $this->db->insert("dt01_hrd_mapping_activity",$data);
            return $sql;
        }


    }
?>