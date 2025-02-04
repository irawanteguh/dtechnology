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
                            (select nm_poli from poliklinik where kd_poli=x.poliid)namapoli,
                            reg+dokter+tindakan+obat+lab+rad totalbilling,
                            case
                                when x.poliid = 'IGDK' then 197600
                                when x.poliid = 'U0001' then 319800
                                when x.poliid = 'U0002' then 197600
                                when x.poliid = 'U0003' then 197600
                                when x.poliid = 'U0005' then 197600
                                when x.poliid = 'U0011' then 257100
                                when x.poliid = 'U0012' then 197600
                                when x.poliid = 'U0007' then 197600
                                when x.poliid = 'U0006' then 197600
                                when x.poliid = 'U0004' then 197600
                                when x.poliid = 'U0018' then 197600
                                when x.poliid = 'U0053' then 131300
                                else
                                0 
                            end hargaklaim
                        from(
                            select a.tgl_perawatan, no_rawat,
                                jml,
                                h_beli hargamodal,
                                biaya_obat hargajual,
                                (select nama_brng from databarang where kode_brng=a.kode_brng)namaobat,
                                (select no_rkm_medis from reg_periksa where no_rawat=a.no_rawat)norm,
                                (select kd_dokter from reg_periksa where no_rawat=a.no_rawat)dokterid,
                                (select kd_poli from reg_periksa where no_rawat=a.no_rawat)poliid,
                                (select coalesce(sum(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Registrasi' and no='Registrasi')reg,
                                (select coalesce(sum(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Dokter')dokter,
                                (select coalesce(sum(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Ralan Dokter')tindakan,
                                (select coalesce(sum(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Obat')obat,
                                (select coalesce(sum(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Laborat')lab,
                                (select coalesce(sum(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Radiologi')rad
                            from detail_pemberian_obat a
                            where a.status='Ralan'
                            and   a.no_rawat in ('2025/01/06/000656','2025/01/09/000202','2025/01/08/000038','2025/01/02/000111','2025/01/10/000051')
                            -- and   a.no_rawat in ('2025/01/06/000656','2025/01/10/000051')
                            order by poliid asc, dokterid asc, tgl_perawatan desc, no_rawat asc, namaobat asc
                        )x
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>