<?php
    class Modelattachmentclaim extends CI_Model{

        function datatransaksi(){
            $query =
                    "
                        select a.no_rkm_medis, no_rawat, date_format(a.tgl_registrasi,'%d.%m.%Y')tglkunjungan, status_lanjut,
                            (select nm_dokter from dokter where kd_dokter=a.kd_dokter)namadokter,
                            (select nm_pasien from pasien where no_rkm_medis=a.no_rkm_medis)namapasien,
                            (select nm_poli from poliklinik where kd_poli=a.kd_poli)politujuan
                        from reg_periksa a
                        where a.kd_pj='BPJ'
                        and   a.stts not in ('belum','Batal')
                        and   a.no_rawat in (select transaksi_idx from dt01_gen_document_file_dt where active='1' and status_file='2' and transaksi_idx=a.no_rawat)
                        order by tgl_registrasi desc

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>