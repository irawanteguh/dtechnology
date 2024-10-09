<?php
    class Modelgroupactivity extends CI_Model{

        function daftarjabatan($orgid,$parameter){
            $query =
                    "
                        select a.ORG_ID, POSITION_ID, POSITION, RVU, LEVEL, LEVEL_FUNGSIONAL, DATE_FORMAT(LAST_UPDATE_DATE,'%d.%m.%Y %H:%i:%s')LASTUPDATEDATE,
                            (select IFNULL(name, 'Unknown')  from  dt01_gen_user_data where active = '1' and org_id = a.org_id and user_id = IFNULL(a.CREATED_BY, a.LAST_UPDATE_BY)) LASTUPDATEDBY,
                            (select level from dt01_gen_level_fungsional_ms where active='1' and level_id=a.LEVEL_FUNGSIONAL)FUNCTIONAL,
                            (select count(user_id) from dt01_hrd_position_dt where active='1' and status='1' and position_primary='Y' and org_id=a.org_id and position_id=a.position_id)jml
                        from dt01_hrd_position_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
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
                            select a.ORG_ID, ACTIVITY_ID, ACTIVITY, DURASI,
                                (SELECT IFNULL(name, 'Unknown')  FROM  dt01_gen_user_data WHERE active = '1' AND org_id = a.org_id AND user_id = IFNULL(a.CREATED_BY, a.LAST_UPDATE_BY)) LASTUPDATEDBY,
                                (select transaksi_id from dt01_hrd_mapping_activity where active='1' and org_id=a.org_id and activity_id=a.ACTIVITY_ID and position_id='".$positionid."')transidmapping
                            from dt01_hrd_activity_ms a
                            where a.active='1'
                            and   a.org_id='".$orgid."'
                            and   a.pk=''
                        )x
                        order by urut asc, activity asc, durasi asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkdata($orgid,$positionid,$activityid){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_hrd_mapping_activity a
                        where a.org_id='".$orgid."'
                        and   a.position_id='".$positionid."'
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