<?php
    class Modelvalidation extends CI_Model{
        
        function liststaff($orgid,$userid,$periodeid){
            $query =
                    "
                        select z.*,
                               presentasiperilaku+presentasiactivity resultkpi
                        from(
                        	select y.*,
                        	       (select level from dt01_gen_level_fungsional_ms where org_id=y.org_id and active='1' and level_id=y.levelfungsionalprimaryid)fungsionalprimary,
                        	       (select concat(name,' ',area) from dt01_hrd_klinis_ms where active='1' and klinis_id=y.klinis_id)klinis,
                        	       COALESCE(round(jmlnilaiassessment/jmlkomponenpenilaian*(select prod/100 from dt01_gen_enviroment_ms where org_id=y.org_id and environment_name='MAX_VALUE_ASSESSMENT')*10,0),0) presentasiperilaku,
                        	       COALESCE(round(case when jmldisetujui > hours_month then hours_month else jmldisetujui end /hours_month*(select prod/100 from dt01_gen_enviroment_ms where org_id=y.org_id and environment_name='MAX_VALUE_ACTIVITY')*100,0),0) presentasiactivity
                        	from(
                        		select x.*,
                        			(select position from dt01_hrd_position_ms where active='1' and org_id=x.org_id and position_id=x.position_id)position,
                        			(select level_fungsional from dt01_hrd_position_ms where org_id=x.org_id and active='1' and position_id=x.position_id)levelfungsionalprimaryid,
                        			(select name from dt01_gen_user_data where active='1' and org_id=x.org_id and user_id=x.user_id)name,
                        			(select upper(LEFT(name, 1)) from dt01_gen_user_data where active='1' and org_id=x.org_id and user_id=x.user_id)initial,
                        			(select image_profile from dt01_gen_user_data where active='1' and org_id=x.org_id and user_id=x.user_id)image_profile,
                        			(select email from dt01_gen_user_data where active='1' and org_id=x.org_id and user_id=x.user_id)email,
                        			(select kategori_id from dt01_gen_user_data where active='1' and org_id=x.org_id and user_id=x.user_id)kategori_id,
                        			(select klinis_id from dt01_gen_user_data where active='1' and org_id=x.org_id and user_id=x.user_id)klinis_id,
                        			(select hours_month from dt01_gen_user_data where active='1' and org_id=x.org_id and user_id=x.user_id)hours_month,
                        			(select sum(nilai) from dt01_hrd_assessment_dt where org_id=org_id and user_id=x.user_id)jmlnilaiassessment,
                        			(select count(assessment_id) from dt01_hrd_assessment_dt where org_id=org_id and user_id=x.user_id)jmlkomponenpenilaian,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and DATE_FORMAT(start_date, '%m.%Y')='".$periodeid."')jmldibuat,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and status='0')jmlwait,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and status='1')jmldisetujui,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and status='2')jmldirevisi,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and status='9')jmlditolak,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and atasan_id=x.atasan_id)jmldibuatsec,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and atasan_id=x.atasan_id and status='0')jmlwaitsec,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and atasan_id=x.atasan_id and status='1')jmldisetujuisec,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and atasan_id=x.atasan_id and status='2')jmldirevisisec,
                        			(select sum(total) from dt01_hrd_activity_dt where active='1' and org_id=x.org_id and user_id=x.user_id and atasan_id=x.atasan_id and status='9')jmlditolaksec
                        		
                        		from(
                        			select a.org_id, user_id, position_primary, position_id, atasan_id
                        			from dt01_hrd_position_dt a
                        			where a.active='1'
                        			and   a.status='1'
                        			and   a.org_id='".$orgid."'
                        		    and   a.atasan_id='".$userid."'
                        			union
                        			select a.org_id, user_id, 'N' position_primary,(select position_id from dt01_hrd_position_dt where active='1' and status='1' and org_id=a.org_id and user_id=a.user_id)position_id, atasan_id
                        			from dt01_hrd_activity_dt a
                        			where a.active='1'
                        			and   a.status='0'
                        			and   a.org_id='".$orgid."'
                        		    and   a.atasan_id='".$userid."'
                        		)x
                        	)y
                        )z
                        order by position_primary desc, name asc         
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detailactivity($orgid,$atasanid,$userid){
            $query =
                    "
                        select a.trans_id, activity_id, activity, date_format(start_date,'%d.%m.%Y')start_date, start_time_in, start_time_out, qty,
                            (select activity from dt01_hrd_activity_ms where org_id=a.org_id and active='1' and activity_id=a.activity_id)kegiatanutama
                        from dt01_hrd_activity_dt a
                        where a.active='1'
                        and   a.status='0'
                        and   a.org_id='".$orgid."'
                        and   a.atasan_id='".$atasanid."'
                        and   a.user_id='".$userid."'       
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function listassement($orgid){
            $query =
                    "
                        select a.assessment_id, assessment, jenis, header_id, kategori_id
                        from dt01_hrd_assessment_ms a
                        where a.org_id='".$orgid."'
                        order by kategori_id asc, assessment asc           
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function checkassessment($orgid,$userid,$periode,$assessmenid){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_hrd_assessment_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        and   a.periode='".$periode."'
                        and   a.assessment_id='".$assessmenid."'        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function updateassessment($data,$userid,$periode,$assessmenid){           
            $sql =   $this->db->update("dt01_hrd_assessment_dt",$data,array("user_id"=>$userid,"periode"=>$periode,"assessment_id"=>$assessmenid));
            return $sql;
        }

        function insertassessment($data){           
            $sql =   $this->db->insert("dt01_hrd_assessment_dt",$data);
            return $sql;
        }

        function validasikegiatan($data,$transid){           
            $sql =   $this->db->update("dt01_hrd_activity_dt",$data,array("trans_id"=>$transid));
            return $sql;
        }

    }
?>