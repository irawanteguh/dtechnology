<?php
    class Modelsign extends CI_Model{

        function login($username,$password){
            $query =
                    "
                        select a.user_id
                        from dt01_gen_user_data a
                        where a.active='1'
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
                        select a.user_id, name, image_profile, org_id, group_id, username, level_user, suspended, upper(LEFT(a.name, 1)) initial, email, address, no_hp,
                               (select org_name from dt01_gen_organization_ms where active='1' and org_id=a.org_id)hospitalname,
                               (select website  from dt01_gen_organization_ms where active='1' and org_id=a.org_id)website,
                               (select trial    from dt01_gen_organization_ms where active='1' and org_id=a.org_id)trial,
                               (select holding  from dt01_gen_organization_ms where active='1' and org_id=a.org_id)holding,
                               (select department_id from dt01_hrd_position_ms where active='1' and org_id=a.org_id and position_id=(select position_id from dt01_hrd_position_dt where active='1' and org_id=a.org_id and user_id=a.user_id and position_primary='Y'))departmentid                              

                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.user_id='".$userid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function updatedata($data, $orgid, $userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("org_id"=>$orgid,"user_id"=>$userid));
            return $sql;
        }

    }
?>