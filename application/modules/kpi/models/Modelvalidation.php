<?php
    class Modelvalidation extends CI_Model{

        function liststaff($orgid,$userid,$periodeid){
            $query =
                    "
                        select y.*,
                            presentasiperilaku+presentasiactivity resultkpi
                        from(
                            select x.*,
                                coalesce(round(jmlnilaiassessment/jmlkomponenpenilaian*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ASSESSMENT')*10,0),0) presentasiperilaku,
                                coalesce(round(case when jmldisetujui > hours_month then hours_month else jmldisetujui end /hours_month*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ACTIVITY')*100,0),0) presentasiactivity
                            from(
                            WITH activity_summary AS (
                                SELECT 
                                    org_id,
                                    user_id,
                                    atasan_id,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' THEN total ELSE 0 END) AS jmldibuat,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and status = '0' THEN total ELSE 0 END) AS jmlwait,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and status = '1' THEN total ELSE 0 END) AS jmldisetujui,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and status = '2' THEN total ELSE 0 END) AS jmldirevisi,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and status = '9' THEN total ELSE 0 END) AS jmlditolak,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and atasan_id IS NOT NULL THEN total ELSE 0 END) AS jmldibuatsec,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and atasan_id IS NOT NULL AND status = '0' THEN total ELSE 0 END) AS jmlwaitsec,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and atasan_id IS NOT NULL AND status = '1' THEN total ELSE 0 END) AS jmldisetujuisec,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and atasan_id IS NOT NULL AND status = '2' THEN total ELSE 0 END) AS jmldirevisisec,
                                    SUM(CASE WHEN date_format(start_date, '%m.%Y') = '".$periodeid."' and atasan_id IS NOT NULL AND status = '9' THEN total ELSE 0 END) AS jmlditolaksec
                                FROM dt01_hrd_activity_dt
                                WHERE active = '1'
                                GROUP BY org_id, user_id
                            )
                            select datauser.*,
                                dataposisi.position,level_fungsional,
                                masteruser.name,upper(left(name, 1))initial,image_profile,email,kategori_id,klinis_id,hours_month,
                                (select level from dt01_gen_level_fungsional_ms where org_id=datauser.org_id and active='1' and level_id=dataposisi.level_fungsional)fungsionalprimary,
                                (select concat(name,' ',area) from dt01_hrd_klinis_ms where active='1' and klinis_id=masteruser.klinis_id)klinis,
                                (select coalesce(sum(nilai),0) from dt01_hrd_assessment_dt where org_id=datauser.org_id and user_id=datauser.user_id and periode='".$periodeid."')jmlnilaiassessment,
                                (select count(assessment_id)   from dt01_hrd_assessment_dt where org_id=datauser.org_id and user_id=datauser.user_id and periode='".$periodeid."')jmlkomponenpenilaian,
                                (select count(no_rawat)*3      from penilaian_awal_keperawatan_ralan where nip=(select nik from dt01_gen_user_data where active='1' and user_id=datauser.user_id and date_format(tanggal, '%m.%Y')='".$periodeid."') and no_rawat not in (select trans_id from dt01_hrd_activity_dt where active='1'))jmltambahan,
                                COALESCE(activity_summary.jmldibuat, 0) AS jmldibuat,
                                COALESCE(activity_summary.jmlwait, 0) AS jmlwait,
                                COALESCE(activity_summary.jmldisetujui, 0) AS jmldisetujui,
                                COALESCE(activity_summary.jmldirevisi, 0) AS jmldirevisi,
                                COALESCE(activity_summary.jmlditolak, 0) AS jmlditolak,
                                COALESCE(activity_summary.jmldibuatsec, 0) AS jmldibuatsec,
                                COALESCE(activity_summary.jmlwaitsec, 0) AS jmlwaitsec,
                                COALESCE(activity_summary.jmldisetujuisec, 0) AS jmldisetujuisec,
                                COALESCE(activity_summary.jmldirevisisec, 0) AS jmldirevisisec,
                                COALESCE(activity_summary.jmlditolaksec, 0) AS jmlditolaksec
                            from(
                                select a.org_id, user_id, position_primary, atasan_id, position_id
                                from dt01_hrd_position_dt a
                                where a.active='1'
                                and   a.status='1'
                                and   a.org_id='".$orgid."'
                                and   a.atasan_id='".$userid."'
                                and   a.user_id=(select user_id from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)
                                union
                                select a.org_id, user_id, 'X'position_primary, atasan_id, (select position_id from dt01_hrd_position_dt where active='1' and status='1' and org_id=a.org_id and user_id=a.user_id)position_id
                                from dt01_hrd_activity_dt a
                                where a.active='1'
                                and   a.status='0'
                                and   a.org_id='".$orgid."'
                                and   a.atasan_id='".$userid."'
                                and   a.user_id=(select user_id from dt01_gen_user_data where active='1' and org_id=a.org_id and user_id=a.user_id)
                                and   a.user_id not in (select user_id from dt01_hrd_position_dt where active='1' and status='1' and org_id=a.org_id and atasan_id=a.atasan_id)
                            )datauser,
                            dt01_hrd_position_ms   dataposisi,
                            dt01_gen_user_data     masteruser,
                            activity_summary
                            where dataposisi.active='1'
                            and   masteruser.active='1'
                            and   dataposisi.org_id=datauser.org_id
                            and   masteruser.org_id=datauser.org_id
                            and   dataposisi.position_id=datauser.position_id
                            and   masteruser.user_id=datauser.user_id
                            and   activity_summary.org_id=datauser.org_id
                            and   activity_summary.user_id=datauser.user_id
                            )x
                        )y
                        order by name asc      
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detailactivity($orgid,$atasanid,$userid){
            $query =
                    "
                    select x.*
                    from(
                            select '1'status, a.trans_id, activity_id, activity, date_format(start_date,'%d.%m.%Y')start_date, start_time_in, start_time_out, qty, user_id,
                                (select activity from dt01_hrd_activity_ms where org_id=a.org_id and active='1' and activity_id=a.activity_id)kegiatanutama
                            from dt01_hrd_activity_dt a
                            where a.active='1'
                            and   a.status='0'
                            and   a.org_id='".$orgid."'
                            and   a.atasan_id='".$atasanid."'
                            and   a.user_id='".$userid."'
                            union
                            select '2'status, no_rawat trans_id,'d2264ea0-54b6-443a-87b4-86ef3b4b62c0'activity_id,
                                    concat(
                                        'Melakukan Anamnesa Pasien Rawat Jalan No Rekam Medis : ',
                                        (select no_rkm_medis from reg_periksa where no_rawat=a.no_rawat),
                                        ' Atasnama : ',
                                        (select nm_pasien from pasien where no_rkm_medis =(select no_rkm_medis from reg_periksa where no_rawat=a.no_rawat)),
                                        ' By Integrated From Khanza'
                                    )activity,
                                    date_format(tanggal,'%d.%m.%Y')start_date,
                                    date_format(tanggal,'%H:%i')start_time_in,
                                    date_format(date_add(a.tanggal, INTERVAL 3 MINUTE), '%H:%i')start_time_out,
                                    1 qty,
                                    '".$userid."' user_id,
                                (select activity from dt01_hrd_activity_ms where active='1' and activity_id='d2264ea0-54b6-443a-87b4-86ef3b4b62c0')kegiatanutama
                            from penilaian_awal_keperawatan_ralan a
                            where a.nip = (select nik from dt01_gen_user_data where active='1' and user_id='".$userid."')
                            and   a.no_rawat not in (select trans_id from dt01_hrd_activity_dt where active='1')
                            and   a.tanggal > '2025-02-01'
                        )x
                        limit 100;
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

        function checkactivity($transid){
            $query =
                    "
                        select a.trans_id
                        from dt01_hrd_activity_dt a
                        where a.trans_id='".$transid."'        
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

        function insertactivity($data){           
            $sql =   $this->db->insert("dt01_hrd_activity_dt",$data);
            return $sql;
        }

    }
?>