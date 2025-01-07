<?php
    class Modelsigndocument extends CI_Model{

        function datasigndocument($orgid){
            $query =
                    "
                        select distinct a.org_id, nik, user_identifier, link_sign, status, count(no_file)jmlfile,
                            (select name from dt01_gen_user_data where active='1' and org_id=a.org_id and nik=a.nik)name,
                            (select identity_no from dt01_gen_user_data where active='1' and org_id=a.org_id and nik=a.nik)noktp,
                            (select email from dt01_gen_user_data where active='1' and org_id=a.org_id and nik=a.nik)email

                        from dt01_gen_tte_it a
                        where a.active='1'
                        and   a.type='D'
                        and   a.org_id='".$orgid."'
                        and   a.no_file=(select no_file from dt01_gen_tte_hd where active='1' and org_id=a.org_id and type='S' and status in ('3','4') and no_file=a.no_file)
                        group by org_id, nik, user_identifier, link_sign, status
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updatefile($data,$requestid){           
            $sql =   $this->db->update("dt01_gen_tte_hd",$data,array("request_id"=>$requestid));
            return $sql;
        }

        function updatesigner($data,$requestid){           
            $sql =   $this->db->update("dt01_gen_tte_it",$data,array("request_id"=>$requestid));
            return $sql;
        }


    }
?>