<?php
    class Modelfragmentasi extends CI_Model{

        function datatransaksi(){
            $query =
                    "
                        select x.*,
                            datediff(x.tgl_registrasi, x.lastkunjungan)selisih,
                            (select nm_pasien from pasien where no_rkm_medis=x.no_rkm_medis)namapasien,
                            (select nm_dokter from dokter where kd_dokter=x.kd_dokter)namadokter,
                            (select nm_poli from poliklinik where kd_poli=x.kd_poli)namapoli,
                            (select nm_dokter from dokter where kd_dokter=x.dokterlast)dokterlast
                        from(
                            select a.no_rkm_medis, no_rawat, tgl_registrasi, kd_poli, kd_dokter,
                                (
                                        select b.tgl_registrasi 
                                        from reg_periksa b
                                        where b.status_lanjut ='Ralan'
                                        and   b.stts<>'Batal'
                                        and   b.kd_pj='BPJ'
                                        and   b.kd_poli=a.kd_poli
                                        and   b.no_rkm_medis =a.no_rkm_medis
                                        and   b.tgl_registrasi < a.tgl_registrasi
                                        order by tgl_registrasi  desc
                                        limit 1
                                )lastkunjungan,
                                (
                                        select b.kd_dokter 
                                        from reg_periksa b
                                        where b.status_lanjut ='Ralan'
                                        and   b.stts<>'Batal'
                                        and   b.kd_pj='BPJ'
                                        and   b.kd_poli=a.kd_poli
                                        and   b.no_rkm_medis =a.no_rkm_medis
                                        and   b.tgl_registrasi < a.tgl_registrasi
                                        order by tgl_registrasi  desc
                                        limit 1
                                )dokterlast
                            from reg_periksa a
                            where a.status_lanjut ='Ralan'
                            and   a.stts<>'Batal'
                            and   a.kd_pj='BPJ'
                        )x
                        order by tgl_registrasi  desc

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>