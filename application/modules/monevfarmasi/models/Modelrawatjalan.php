<?php
    class Modelrawatjalan extends CI_Model{


        function datamonev(){
            $query =
                    "
                        select x.*,
                            jml*hargamodal totalmodal,
                            jml*hargajual totaljual,
                            7*hargamodal obat_7,
                            23*0 obat_23,
                            (select nm_pasien from pasien where no_rkm_medis=x.norm)namapasien,
                            (select nm_dokter from dokter where kd_dokter=x.dokterid)namadokter,
                            (select nm_poli from poliklinik where kd_poli=x.poliid)namapoli
                        from(
                            select a.tgl_perawatan, no_rawat,
                                jml,
                                h_beli hargamodal,
                                biaya_obat hargajual,
                                (select nama_brng from databarang where kode_brng=a.kode_brng)namaobat,
                                (select no_rkm_medis from reg_periksa where no_rawat=a.no_rawat)norm,
                                (select kd_dokter from reg_periksa where no_rawat=a.no_rawat)dokterid,
                                (select kd_poli from reg_periksa where no_rawat=a.no_rawat)poliid
                                
                            from detail_pemberian_obat a
                            where a.status='Ralan'
                            and   a.no_rawat in ('2025/01/06/000656','2025/01/09/000202','2025/01/08/000038','2025/01/02/000111')
                            order by poliid asc, dokterid asc, tgl_perawatan desc, no_rawat asc, namaobat asc
                        )x
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>