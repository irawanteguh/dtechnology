<?php
    class Modeloutpatient extends CI_Model{

        function datapasien($parameter){
            $query =
                    "
                        select a.no_rkm_medis, nm_pasien, no_peserta, no_ktp, email, jk, date_format(tgl_lahir,'%d.%m.%Y')tgllahir, alamat,
                        CONCAT(
                                    TIMESTAMPDIFF(YEAR, a.tgl_lahir, CURDATE()), ' tahun ',
                                    TIMESTAMPDIFF(MONTH, a.tgl_lahir, CURDATE()) % 12, ' bulan ',
                                    DATEDIFF(CURDATE(), DATE_ADD(a.tgl_lahir, INTERVAL TIMESTAMPDIFF(MONTH, a.tgl_lahir, CURDATE()) MONTH)), ' hari'
                                ) AS umur
                                 
                        from pasien a
                        where a.no_rkm_medis='".$parameter."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterprovider(){
            $query =
                    "
                        select a.kd_pj providerid, png_jawab provider,
                            case when a.kd_pj='A09' then '1' else '0' end urut
                        from penjab a
                        where a.kd_pj<>'-'
                        order by urut desc, png_jawab
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdepartment($orgid){
            $query =
                    "
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.level_id='5'
                        and   a.department_id in ('294b0ec7-2b8c-4c4a-bfa1-4941d2b9d69c','e47a3989-52c2-4827-a62f-967a8cc05438','4a6bbe8d-da22-4024-b898-ed2b18f717c2')
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterorganization(){
            $query =
                    "
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        order by org_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterpoliklinik(){
            $query =
                    "
                        select a.kd_poli poli_id, nm_poli poli
                        from poliklinik a
                        where a.kd_poli not in ('-','IGDK','U0020')
                        order by nm_poli asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdoctor($orgid){
            $query =
                    "
                        select a.user_id, name,
                            (select kolegium from dt01_med_kolegium_ms where active='1' and org_id=a.org_id and kolegium_id=a.kolegium_id)kolegium
                        from dt01_gen_user_data a
                        where a.active='1'
                        and   a.kolegium_id is not null and a.kolegium_id <> ''
                        order by kolegium
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdokter($poliid,$hariid){
            $query =
                    "
                        select distinct a.kd_dokter user_id,
                            (select nm_dokter from dokter where kd_dokter=a.kd_dokter)name
                        from jadwal a
                        where a.kd_poli='".$poliid."'
                        and   a.hari_kerja='".$hariid."'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function jadwaldokter($poliid,$hariid,$dokterid,$date){
            $query =
                    "
                        select y.*
                        from(
                            select x.*,
                                kuota_online - jmlterdaftar sisakuota,
                                LPAD(jmlterdaftar+1, 3, '0') antrian,
                                LPAD(norawatreg+1, 5, '0') seqnorawat
                            from(
                                SELECT 
                                    LEFT(a.jam_mulai, 5) AS jam_mulai,
                                    LEFT(a.jam_selesai, 5) AS jam_selesai,
                                    a.kuota AS kuota_online,
                                    CHAR(64 + ROW_NUMBER() OVER (ORDER BY a.jam_mulai)) AS slot,
                                    (
                                    select count(b.no_rawat)
                                    from reg_periksa b
                                    where DATE(b.tgl_registrasi) = '".$date."'
                                    and   b.kd_poli=a.kd_poli
                                    and   b.kd_dokter=a.kd_dokter
                                    )jmlterdaftar,
                                    (
                                    select count(b.no_rawat)
                                    from reg_periksa b
                                    where DATE(b.tgl_registrasi) = '".$date."'
                                    )norawatreg
                                FROM jadwal a
                                WHERE a.kd_poli = '".$poliid."'
                                AND a.hari_kerja = '".$hariid."'
                                AND a.kd_dokter = '".$dokterid."'
                            )x
                        )y
                        where sisakuota > 0
                        order by slot asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function databooking($norawat){
            $query =
                    "
                        select concat(date_format(a.tgl_registrasi ,'%d.%m.%Y'),' ',jam_reg)tglpelayanan, no_reg nomorantrian, no_rkm_medis,
                            (select nm_pasien from pasien where no_rkm_medis=a.no_rkm_medis)namapasien,
                            (select nm_dokter from dokter where kd_dokter=a.kd_dokter)namadokter,
                            (select nm_poli from poliklinik where kd_poli=a.kd_poli)politujuan
                        from reg_periksa a
                        where a.no_rawat='".$norawat."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datasaran($orgid,$transid){
            $query =
                    "
                        select a.trans_id, code, nama, saran,
                               (select org_name from dt01_gen_organization_ms where org_id=a.org_id)nameorg,
                               (select device_id from dt01_whatsapp_device_ms where org_id='".$orgid."' and device_id in ('2221','2222','2223'))deviceid,
                               (select no_hp from dt01_gen_user_data where user_id=(select user_id from dt01_gen_department_ms where org_id='".$orgid."' and department_id in ('e47a3989-52c2-4827-a62f-967a8cc05438','294b0ec7-2b8c-4c4a-bfa1-4941d2b9d69c')))nohpmarketing,
                               (select name from dt01_gen_user_data where user_id=(select user_id from dt01_gen_department_ms where org_id='".$orgid."' and department_id in ('e47a3989-52c2-4827-a62f-967a8cc05438','294b0ec7-2b8c-4c4a-bfa1-4941d2b9d69c')))namamarketing,

                               (select no_hp from dt01_gen_user_data where user_id=(select user_id from dt01_gen_department_ms where org_id='".$orgid."' and department_id in ('83ab25eb-16bc-4228-83bc-6d2e52c93e12','ea687072-8a0b-4458-99ce-ba9f2fa9aa19')))nohpdirektur,
                               (select name from dt01_gen_user_data where user_id=(select user_id from dt01_gen_department_ms where org_id='".$orgid."' and department_id in ('83ab25eb-16bc-4228-83bc-6d2e52c93e12','ea687072-8a0b-4458-99ce-ba9f2fa9aa19')))namadirektur,

                               (select no_hp from dt01_gen_user_data where user_id=(select user_id from dt01_gen_department_ms where department_id='50e25656-cdaa-40a7-8c2c-585e2b42c505'))nohpdirekturpt,
                               (select name from dt01_gen_user_data where user_id=(select user_id from dt01_gen_department_ms where department_id='50e25656-cdaa-40a7-8c2c-585e2b42c505'))namadireakturpt
                               
                        from dt01_crm_saran_hd a
                        where a.trans_id='".$transid."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdatasaran($transid){
            $query =
                    "
                        select a.trans_id
                        from dt01_crm_saran_hd a
                        where a.trans_id='".$transid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertepisode($data){           
            $sql =   $this->db->insert("reg_periksa",$data);
            return $sql;
        }

        function insertsaran($data){           
            $sql =   $this->db->insert("dt01_crm_saran_hd",$data);
            return $sql;
        }

        function simpanboardcast($data){           
            $sql =   $this->db->insert("dt01_whatsapp_broadcast_hd",$data);
            return $sql;
        }

        function updatesaran($data,$userid){           
            $sql =   $this->db->update("dt01_crm_saran_hd",$data,array("trans_id"=>$userid));
            return $sql;
        }
    }
?>