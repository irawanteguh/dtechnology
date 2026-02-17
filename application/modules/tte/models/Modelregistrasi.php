<?php
    class Modelregistrasi extends CI_Model{

        function datakaryawan($orgid){
            $query =
                    "
                        select x.*, upper(left(x.name, 1)) initial,
                               IF(NOW() < x.expired_date, '1', '0') AS status_expdate
                        from(
                            select a.*, date_format(start_Active, '%d.%m.%Y %H:%i:%s')startactive, date_format(expired_date, '%d.%m.%Y %H:%i:%s')expireddate
                            from dt01_gen_user_data a
                            where a.org_id='".$orgid."'
                            and   a.active='1'
                        )x
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkemail($orgid,$userid,$email){
            $query =
                    "
                        select a.*
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.user_id<>'".$userid."'
                        and   lower(a.email)=lower('".$email."')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function checknik($orgid,$userid,$nik){
            $query =
                    "
                        select a.*
                        from dt01_gen_user_data a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        and   a.user_id<>'".$userid."'
                        and   a.identity_no='".$nik."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function updatedatauserid($data, $userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("USER_ID"=>$userid));
            return $sql;
        }
    }
?>