<?php
    class Modelvaliddoc extends CI_Model{

        function datatransaksi(){
            $query =
                    "
                        select a.no_rawat, concat(date_format(tgl_registrasi, '%d.%m.%Y'),' ',jam_reg) tanggalmasuk, no_rkm_medis,
                            (select nm_dokter from dokter where kd_dokter=a.kd_dokter)namadokter,
                            (select nm_poli from poliklinik where kd_poli=a.kd_poli)poliklinik,
                            (select png_jawab from penjab where kd_pj=a.kd_pj)provider,
                            (select nm_pasien from pasien where no_rkm_medis=a.no_rkm_medis)namapasien
                        from reg_periksa a
                        where a.stts ='Sudah'
                        and   a.status_lanjut ='Ralan'
                        and   date(tgl_registrasi) = CURDATE()
                        order by tgl_registrasi desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>