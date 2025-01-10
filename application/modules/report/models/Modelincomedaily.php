<?php
    class Modelincomedaily extends CI_Model{

        function billing(){
            $query =
                    "
                        select x.*,
                            biayareg+biayaobat+biayarad+biayalab+RJtindakanparamedic+RJtindakandokter+RJtindakandokterparamedic+operasi+ranapdokter+ranapdokterparamedic+ranapparamedis+kamar+dokter grandtotal
                        from(
                            select a.no_rawat, concat(date_format(tgl_registrasi,'%d.%m.%Y'),' ',jam_reg)date, no_rkm_medis norm, status_lanjut,
                                (select nm_pasien from pasien     where no_rkm_medis=a.no_rkm_medis)namapasien,
                                (select png_jawab from penjab     where kd_pj=a.kd_pj)provider,
                                (select nm_poli   from poliklinik where kd_poli=a.kd_poli)politujuan,
                                (select nm_dokter from dokter     where kd_dokter=a.kd_dokter)namadokter,
                                (select date_format(tgl_byr,'%d.%m.%Y')from billing where no_rawat=a.no_rawat and no='No.Nota')tglbilling,
                                (select replace(nm_perawatan,': ','')from billing where no_rawat=a.no_rawat and no='No.Nota')nobilling,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Registrasi' and no='Registrasi')biayareg,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Obat')biayaobat,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Radiologi')biayarad,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Laborat')biayalab,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Ralan Paramedis')RJtindakanparamedic,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Ralan Dokter')RJtindakandokter,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Ralan Dokter Paramedis')RJtindakandokterparamedic,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Operasi')operasi,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Ranap Dokter')ranapdokter,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Ranap Dokter Paramedis')ranapdokterparamedic,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Ranap Paramedis')ranapparamedis,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Kamar')Kamar,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Dokter')dokter
                            from reg_periksa a
                            where a.stts<>'Batal'
                            and   a.kd_pj='A09'
                            and   a.kd_poli='IGDK'
                            and   a.no_rawat in ('2025/01/06/000804','2025/01/06/000796')
                            and   a.no_rawat in (select no_rawat from billing where no_rawat=a.no_rawat and no='No.Nota' and tgl_byr='2025-01-06') 
                        )x
                        order by politujuan asc, date asc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>