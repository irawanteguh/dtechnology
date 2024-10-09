<?php
    class Modelrkk extends CI_Model{

        function masterrkk(){
            $query =
                    "
                        select a.klinis_id, concat(a.name,' ',a.area)keterangan
                        from dt01_hrd_klinis_ms a
                        where a.active='1'
                        order by nomor asc, area asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masteremployee($orgid){
            $query =
                    "
                        select y.*,
                            (select level from dt01_gen_level_fungsional_ms where org_id='".$orgid."' and active='1' and level_id=y.levelfungsionalprimary)funsgionalprimary
                        from(
                            select x.*,
                                (select name             from dt01_gen_user_data   where org_id='".$orgid."' and active='1' and user_id=x.atasanidprimary)atasanprimary,
                                (select position         from dt01_hrd_position_ms where org_id='".$orgid."' and active='1' and position_id=x.positioidprimary)positionprimary,
                                (select level_fungsional from dt01_hrd_position_ms where org_id='".$orgid."' and active='1' and position_id=x.positioidprimary)levelfungsionalprimary
                            from(
                                select a.user_id, name, email, nik, identity_no, image_profile, upper(LEFT(a.name, 1)) initial,klinis_id,
                                    (select kategori from dt01_hrd_kategori_tenaga_ms where org_id='".$orgid."' and active='1' and kategori_id=a.kategori_id)kategori,
                                    (select concat(name,' ',area) from dt01_hrd_klinis_ms where active='1' and klinis_id=a.klinis_id)klinis,
                                    (select trans_id    from dt01_hrd_position_dt where org_id='".$orgid."' and active='1' and status='1' and position_primary='Y' and user_id=a.user_id)transidprimary,
                                    (select atasan_id   from dt01_hrd_position_dt where org_id='".$orgid."' and active='1' and status='1' and position_primary='Y' and user_id=a.user_id)atasanidprimary,
                                    (select position_id from dt01_hrd_position_dt where org_id='".$orgid."' and active='1' and status='1' and position_primary='Y' and user_id=a.user_id)positioidprimary

                                from dt01_gen_user_data a
                                where a.active='1'
                                and   a.org_id='".$orgid."'
                                and   a.kategori_id in ('65f1ccae-3ae6-4209-a66e-d7920b5824f5','b9710449-f5e4-4553-a962-f3b0f574dbc4')
                            )X
                        )y
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateuserdata($data,$userid){           
            $sql =   $this->db->update("dt01_gen_user_data",$data,array("user_id"=>$userid));
            return $sql;
        }

    }
?>