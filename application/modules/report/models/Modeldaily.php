<?php
    class Modeldaily extends CI_Model{

        function provider(){
            $query =
                    "
                        select 0 urut,'X'kd_pj,'All Provider' png_jawab
                        union
                        select 1 urut, a.kd_pj, png_jawab
                        from penjab a
                        where a.status='1'
                        and   a.kd_pj<>'-'
                        order by urut asc, png_jawab asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function billing($provider,$periode){
            $query =
                    "
                        select x.*,
                            (select nm_pasien from pasien where no_rkm_medis=x.no_rkm_medis)namapasien,
                            (select nm_poli from poliklinik where kd_poli=x.kd_poli)politujuan,
                            (select png_jawab from penjab where kd_pj=x.kd_pj)provider,
                            biayareg+biayaobat+biayarad+biayalab+RJtindakanparamedic+RJtindakandokter+RJtindakandokterparamedic+operasi+ranapdokter+ranapdokterparamedic+ranapparamedis+kamar+dokter grandtotal
                        from(
                            select a.no_rkm_medis, no_rawat, date_format(tgl_registrasi,'%d.%m.%Y')tgl_registrasi, jam_reg, status_lanjut, kd_poli, kd_pj,
                                (select replace(nm_perawatan,':','') from billing where no_rawat=a.no_rawat and status='-' and no='No.Nota')nobilling,
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
                            ".$provider."
                            ".$periode."
                            order by nobilling desc, tgl_registrasi desc
                        )x

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function billing_ranap(){
            // (select nm_pasien from pasien where no_rkm_medis=x.no_rkm_medis)namapasien,
            // (select nm_poli from poliklinik where kd_poli=x.kd_poli)politujuan,
            $query =
                    "
                        select x.*,
                            
                            
                            (select png_jawab from penjab where kd_pj=x.kd_pj)provider,
                            biayareg+biayaobat+biayarad+biayalab+RJtindakanparamedic+RJtindakandokter+RJtindakandokterparamedic+operasi+ranapdokter+ranapdokterparamedic+ranapparamedis+kamar+dokter grandtotal
                        from(
                            select a.no_rkm_medis, no_rawat, date_format(tgl_registrasi,'%d.%m.%Y')tgl_registrasi, jam_reg, status_lanjut, kd_poli, kd_pj,
                                (select replace(nm_perawatan,':','') from billing where no_rawat=a.no_rawat and status='-' and no='No.Nota')nobilling,
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
                            where a.status_lanjut='Ralan' and a.kd_pj <> 'A09' and a.kd_pj <> 'BPJ'
                            and date(tgl_registrasi) = CURDATE()
                            order by nobilling desc, tgl_registrasi desc
                        )x
                        where x.nobilling<>''
                        limit 50
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function billing_bpjs(){
            $query =
                    "
                        select x.*,
                            (select nm_pasien from pasien where no_rkm_medis=x.no_rkm_medis)namapasien,
                            (select nm_poli from poliklinik where kd_poli=x.kd_poli)politujuan,
                            (select png_jawab from penjab where kd_pj=x.kd_pj)provider,
                            biayareg+biayaobat+biayarad+biayalab+RJtindakanparamedic+RJtindakandokter+RJtindakandokterparamedic+operasi+ranapdokter+ranapdokterparamedic+ranapparamedis+kamar+dokter grandtotal
                        from(
                            select a.no_rkm_medis, no_rawat, date_format(tgl_registrasi,'%d.%m.%Y')tgl_registrasi, jam_reg, status_lanjut, kd_poli, kd_pj,
                                (select replace(nm_perawatan,':','') from billing where no_rawat=a.no_rawat and status='-' and no='No.Nota')nobilling,
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
                            where a.status_lanjut='Ralan' and a.kd_pj = 'BPJ'
                            and date(tgl_registrasi) = CURDATE()
                            order by nobilling desc, tgl_registrasi desc
                        )x
                        where x.nobilling<>''
                        limit 50
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function rozi(){
            $query =
                    "
                        select x.*,
                            (select nm_pasien from pasien where no_rkm_medis=x.no_rkm_medis)namapasien,
                            (select nm_poli from poliklinik where kd_poli=x.kd_poli)politujuan,
                            (select png_jawab from penjab where kd_pj=x.kd_pj)provider,
                            biayareg+biayaobat+biayarad+biayalab+RJtindakanparamedic+RJtindakandokter+RJtindakandokterparamedic+operasi+ranapdokter+ranapdokterparamedic+ranapparamedis+kamar+dokter grandtotal
                        from(
                            select a.no_rkm_medis, no_rawat, date_format(tgl_registrasi,'%d.%m.%Y')tgl_registrasi, jam_reg, status_lanjut, kd_poli, kd_pj,
                                (select replace(nm_perawatan,':','') from billing where no_rawat=a.no_rawat and status='-' and no='No.Nota')nobilling,
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
                             where a.status_lanjut='Ranap' and a.kd_pj = 'A09'
                            and date(tgl_registrasi) = CURDATE()
                            order by nobilling desc, tgl_registrasi desc
                        )x
                        where x.nobilling<>''
                        limit 50
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>