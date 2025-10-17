<?php
    class Modelhistory extends CI_Model{

        function daftarpasien($parameter){
            $query =
                    "
                        select a.no_rkm_medis, nm_pasien, no_ktp, nm_ibu, alamat,
                            date_format(a.tgl_lahir, '%d.%m.%Y')tgllahir,
                            case when a.jk = 'L' then 'Laki-laki' else 'Perempuan' end jeniskelamin
                        from pasien a
                        where a.no_rkm_medis='".$parameter."' or upper(a.nm_pasien) like upper('%".$parameter."%')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function historykunjungan($nomr){
            $query =
                    "
                        select a.no_rawat, tgl_registrasi, no_rkm_medis,
                            (select nm_dokter from dokter where kd_dokter=a.kd_dokter)namadokter,
                            (select nm_poli from poliklinik where kd_poli=a.kd_poli)namapoli
                            
                        from reg_periksa a
                        where a.stts not in ('Belum','Batal')
                        and   a.no_rkm_medis='".$nomr."'
                        order by tgl_registrasi desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function daftaralergipasien($nomr){
            $query =
                    "
                        select a.alergi
                        from catatan_pasien a
                        where a.alergi<>''
                        and   a.alergi<>'-'
                        and  a.no_rkm_medis='".$nomr."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function soapie($norawat){
            $query =
                    "
                        select a.tgl_perawatan, jam_rawat, suhu_tubuh, tensi, nadi, respirasi, tinggi, berat, spo2, gcs, keluhan, pemeriksaan, penilaian, rtl, instruksi, evaluasi,
                               (select nama from pegawai where nik=a.nip)nama
                        from pemeriksaan_ranap a
                        where a.no_rawat='".$norawat."'

                        union all

                        select a.tgl_perawatan, jam_rawat, suhu_tubuh, tensi, nadi, respirasi, tinggi, berat, spo2, gcs, keluhan, pemeriksaan, penilaian, rtl, instruksi, evaluasi,
                               (select nama from pegawai where nik=a.nip)nama
                        from pemeriksaan_ralan a
                        where a.no_rawat='".$norawat."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function catatanperawat($norawat){
            $query =
                    "
                        select a.tanggal, jam, uraian,
                            (select nama from pegawai where nik=a.nip)nama
                        from catatan_keperawatan_ranap a
                        where a.no_rawat='".$norawat."'
                        order by a.tanggal asc, jam asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>