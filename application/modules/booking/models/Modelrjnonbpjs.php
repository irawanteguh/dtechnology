<?php
    class Modelrjnonbpjs extends CI_Model{
        
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

        function databooking($norm){
            $query =
                    "
                        select date_format(a.date,'%d.%m.%Y')tglpelayanan, concat(a.slot,'-',antrian)nomorantrian, jam_mulai, jam_selesai, booking_id,
                            (select nm_pasien from pasien where no_rkm_medis=a.pasien_id_old)namapasien,
                            (select name from dt01_gen_user_data where active='1' and user_id=a.dokter_id)namadokter,
                            (select poli from dt01_med_poli_ms where active='1' and poli_id=a.poli_id)politujuan
                        from dt01_keu_episode a
                        where a.active='1'
                        and   a.status='00'
                        and   a.pasien_id_old='".$norm."'
                        order by created_date desc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function nobilling(){
            $query =
                    "
                        SELECT CONCAT(DATE_FORMAT(SYSDATE(), '%Y'), '/', DATE_FORMAT(SYSDATE(), '%m'), '/', DATE_FORMAT(SYSDATE(), '%d'), '/', LPAD(COUNT(a.no_rawat) + 1, 6, '0'))nobilling
                        FROM reg_periksa a
                        WHERE DATE(a.tgl_registrasi) = CURDATE();

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function masterprovider($orgid){
            $query =
                    "
                        select concat(a.provider_id,'_',provider_id_old)providerid, provider,
                               case when a.provider_id_old ='A09' then 0 else 1 end urut 
                        from dt01_keu_provider_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by urut asc, provider asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterpoliklinik($orgid){
            $query =
                    "
                        select poli_id, poli
                        from dt01_med_poli_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.poli_id<>'cd17b2ab-b76e-4f93-bf66-821036feff2a'
                        order by poli asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterdokter($orgid,$poliid,$hariid){
            $query =
                    "
                        select distinct a.user_id,
                            (select name from dt01_gen_user_data where active=a.active and org_id=a.org_id and user_id=a.user_id)name
                        from dt01_med_jadwal_dokter a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.poli_id='".$poliid."'
                        and   a.hari_id='".$hariid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function jadwaldokter($orgid,$poliid,$dokterid,$hariid){
            $query =
                    "
                        select y.*
                        from(
                            select x.*,
                                kuota_online - jmlterdaftar sisakuota,
                                LPAD(jmlterdaftar+1, 3, '0') antrian
                            from(
                                select a.transaksi_id, jam_mulai, jam_selesai, kuota_online, slot,
                                    (select count(episode_id) from dt01_keu_episode where active='1' and status<>'99' and org_id=a.org_id and jadwal_poli_id=a.transaksi_id)jmlterdaftar
                                from dt01_med_jadwal_dokter a
                                where a.active='1'
                                and   a.org_id='".$orgid."'
                                and   a.poli_id='".$poliid."'
                                and   a.user_id='".$dokterid."'
                                and   a.hari_id='".$hariid."'
                            )x
                        )y
                        where sisakuota > 0
                        order by slot asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertepisode($data){           
            $sql =   $this->db->insert("dt01_keu_episode",$data);
            return $sql;
        }

        
    }
?>