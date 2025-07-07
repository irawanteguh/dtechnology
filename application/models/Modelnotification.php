<?php
    class Modelnotification extends CI_Model{

        function informationkpi($orgid){
            $query =
                    "
                        select x.*,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                            date_format(DATE_SUB(CURDATE(), INTERVAL 1 MONTH),'%m.%Y')
                                    else
                                        date_format(CURDATE(),'%m.%Y')
                                end periodeidassessment,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                        CONCAT(MONTHNAME(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)))
                                    else
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                end periodeketeranganassessment,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        date_format(DATE_SUB(CURDATE(), INTERVAL 1 MONTH),'%m.%Y')
                                    else
                                        date_format(CURDATE(),'%m.%Y')
                                end periodeidactivity,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        CONCAT(MONTHNAME(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)))
                                    else
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                end periodeketeranganactivity,
                                case 
                                    when DAY(CURDATE()) <= endactivity then
                                        CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                    else
                                        CONCAT(MONTHNAME(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)))
                                end periodeketeranganbatassactivity,
                                case
                                    when DAY(CURDATE()) between startassessment and endassessment then
                                            CONCAT(MONTHNAME(CURDATE()), ' ', YEAR(CURDATE()))
                                    else
                                        CONCAT(MONTHNAME(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)), ' ', YEAR(DATE_ADD(CURDATE(), INTERVAL 1 MONTH)))
                                end keteranganbatasassessment

                        from(
                        select
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='START_VALID_ASSESSMENT') startassessment,
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='END_VALID_ASSESSMENT') endassessment,
                            (select prod from dt01_gen_enviroment_ms where active='1' and org_id='".$orgid."' and environment_name='END_VALID_ACTIVITY') endactivity
                        )x                     
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function selfreportkpi($orgid,$periodeidactivity,$periodeidassessment,$userid){
            $query =
                    "
                        select y.*,
                            presentasiperilaku+presentasiactivity resultkpi
                        from(
                            select x.*,
                                    coalesce(round(jmlnilaiassessment/jmlkomponenpenilaian*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ASSESSMENT')*10,0),0) presentasiperilaku,
                                    coalesce(round(case when jmldisetujui > hours_month then hours_month else jmldisetujui end /hours_month*(select prod/100 from dt01_gen_enviroment_ms where org_id=x.org_id and environment_name='MAX_VALUE_ACTIVITY')*100,0),0) presentasiactivity
                            from(
                                select a.org_id, user_id, name, hours_month,
                                    (select position from dt01_hrd_position_ms where active=a.active and org_id=a.org_id and position_id=(select position_id from dt01_hrd_position_dt where org_id=a.org_id and active='1' and status='1' and position_primary='Y' and user_id=a.user_id))position,
                                    (select count(assessment_id) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeidassessment."')jmlkomponenpenilaian,
                                    (select sum(nilai) from dt01_hrd_assessment_dt where org_id=org_id and user_id=a.user_id and periode='".$periodeidassessment."')jmlnilaiassessment,
                                    (select sum(total) from dt01_hrd_activity_dt where active=a.active and org_id=a.org_id and user_id=a.user_id and status='1' and date_format(start_date, '%m.%Y')='".$periodeidactivity."')jmldisetujui
                                from dt01_gen_user_data a
                                where a.active='1'
                                and   a.org_id='".$orgid."'
                                and   a.user_id='".$userid."'
                            )x
                        )y
                        order by name asc        
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function documenttte($orgid,$limit){
            $query =
                    "
                        select a.no_file, transaksi_idx, jenis_doc,
                               (select org_name from dt01_gen_organization_ms where org_id=a.org_id)namars
                        from dt01_gen_document_file_dt a
                        where a.org_id='".$orgid."'
                        and   a.jenis_doc='003'
                        and   a.status_sign='5'
                        and   a.no_file not in (select document_name from dt01_whatsapp_broadcast_hd where document_name=a.no_file)
                        order by created_date desc
                        ".$limit."                  
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function approvalpo($orgid,$parameter,$limit){
            $query =
                    "
                        select a.no_pemesanan, no_pemesanan_unit, judul_pemesanan, note,
                            (select org_name from dt01_gen_organization_ms where org_id=a.org_id)namars,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and department_id=a.department_id)departmen
                        from dt01_lgu_pemesanan_hd a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan not in (select ref_id from dt01_whatsapp_broadcast_hd where template_id='APPROVAL PO DIRECTOR' and ref_id=a.no_pemesanan)
                        ".$parameter."
                        order by created_date desc 
                        ".$limit."                  
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function informasikunjunganpasien($norawat){
            $query =
                    "
                        SELECT 
                            a.no_rkm_medis,
                            a.almt_pj,
                            DATE_FORMAT(a.tgl_registrasi, '%d.%m.%Y') AS tglkunjungan,
                            pl.nm_poli AS politujuan,
                            d.nm_dokter AS namadokter,
                            p.nm_pasien AS namapasien,
                            DATE_FORMAT(p.tgl_lahir, '%d.%m.%Y') AS bod,
                            CASE
                                WHEN LEFT(REPLACE(REPLACE(REPLACE(p.no_tlp, '-', ''), ' ', ''), '+62', '62'), 2) = '62' 
                                    THEN REPLACE(REPLACE(REPLACE(p.no_tlp, '-', ''), ' ', ''), '+62', '62')
                                WHEN LEFT(p.no_tlp, 1) = '0' 
                                    THEN CONCAT('62', SUBSTRING(REPLACE(REPLACE(p.no_tlp, '-', ''), ' ', ''), 2))
                                ELSE CONCAT('62', REPLACE(REPLACE(p.no_tlp, '-', ''), ' ', ''))
                            END AS nohp
                        FROM reg_periksa a
                        JOIN pasien p ON p.no_rkm_medis = a.no_rkm_medis
                        LEFT JOIN poliklinik pl ON pl.kd_poli = a.kd_poli
                        LEFT JOIN dokter d ON d.kd_dokter = a.kd_dokter
                        WHERE a.no_rawat = '".$norawat."';
           
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function simpanboardcast($data){           
            $sql =   $this->db->insert("dt01_whatsapp_broadcast_hd",$data);
            return $sql;
        }

    }
?>