<?php
    class Modelvaliddoc extends CI_Model{

        function datatransaksi($startDate,$endDate){
            $query =
                    "
                        select a.no_rawat, concat(date_format(tgl_registrasi, '%d.%m.%Y'),' ',jam_reg) tanggalmasuk, no_rkm_medis,
                            (select nm_dokter from dokter where kd_dokter=a.kd_dokter)namadokter,
                            (select nm_poli from poliklinik where kd_poli=a.kd_poli)poliklinik,
                            (select png_jawab from penjab where kd_pj=a.kd_pj)provider,
                            (select nm_pasien from pasien where no_rkm_medis=a.no_rkm_medis)namapasien,
                            (
                                SELECT GROUP_CONCAT(
                                    b.document_name, ':', IFNULL(c.no_file, 'NULL')
                                    SEPARATOR ';'
                                ) 
                                FROM dt01_gen_document_ms b
                                LEFT JOIN dt01_gen_document_file_dt c
                                ON c.jenis_doc = b.jenis_doc 
                                AND c.transaksi_idx = a.no_rawat
                                WHERE b.active = '1'
                                AND b.jenis_doc IN ('002', '005', '066')
                            ) AS document
                        from reg_periksa a
                        where a.stts ='Sudah'
                        and   a.status_lanjut ='Ralan'
                        and   a.kd_poli='U0005'
                        AND   a.tgl_registrasi BETWEEN '".$startDate."' AND '".$endDate."'
                        order by tgl_registrasi desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>