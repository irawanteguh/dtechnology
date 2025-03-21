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
                        select a.transaksi_id, jam_mulai, jam_selesai, kuota_online
                        from dt01_med_jadwal_dokter a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.poli_id='".$poliid."'
                        and   a.user_id='".$dokterid."'
                        and   a.hari_id='".$hariid."'
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