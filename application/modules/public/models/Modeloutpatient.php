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

        function masterdepartment(){
            $query =
                    "
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.level_id='5'
                        order by department asc
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

        function datasaran($transid){
            $query =
                    "
                        select a.trans_id, code, nama, saran
                        from dt01_crm_saran_hd a
                        where a.trans_id='".$transid."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertepisode($data){           
            $sql =   $this->db->insert("dt01_crm_saran_hd",$data);
            return $sql;
        }
    }
?>