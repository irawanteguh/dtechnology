<?php
    class Modelincomedaily extends CI_Model{

        function billing($parameter,$startDate,$endDate){
            $query =
                    "
                        select y.*,
                                case
                                    when y.kd_pj = 'BPJ' then
                                    case
                                        when y.status_lanjut = 'Ralan' then
                                        case
                                            when y.kd_poli = 'IGDK' then 197600
                                            when y.kd_poli = 'U0001' then 319800
                                            when y.kd_poli = 'U0002' then 197600
                                            when y.kd_poli = 'U0003' then 197600
                                            when y.kd_poli = 'U0005' then 197600
                                            when y.kd_poli = 'U0011' then 257100
                                            when y.kd_poli = 'U0012' then 197600
                                            when y.kd_poli = 'U0007' then 197600
                                            when y.kd_poli = 'U0006' then 197600
                                            when y.kd_poli = 'U0004' then 197600
                                            when y.kd_poli = 'U0018' then 197600
                                            when y.kd_poli = 'U0053' then 131300
                                            else
                                            0 
                                        end
                                        else
                                        grandtotal
                                    end
                                    else
                                    grandtotal
                                end estimasiklaim
                        from(
                            select x.*,
                                biayareg+biayaobat+biayarad+biayalab+RJtindakanparamedic+RJtindakandokter+RJtindakandokterparamedic+operasi+ranapdokter+ranapdokterparamedic+ranapparamedis+kamar+dokter grandtotal
                            from(
                                select a.no_rawat, concat(date_format(tgl_registrasi,'%d.%m.%Y'),' ',jam_reg)date, no_rkm_medis norm, status_lanjut, kd_pj, kd_poli, kd_dokter,
                                    case
                                        when a.status_lanjut = 'Ralan' then
                                        'OutPatient'
                                        else
                                        'InPatient'
                                    end jenisepisode,
                                    (select nm_pasien from pasien     where no_rkm_medis=a.no_rkm_medis)namapasien,
                                    (select png_jawab from penjab     where kd_pj=a.kd_pj)provider,
                                    (select nm_poli   from poliklinik where kd_poli=a.kd_poli)politujuan,
                                    (select nm_dokter from dokter     where kd_dokter=a.kd_dokter)namadokter,
                                    (select date_format(tgl_byr,'%d.%m.%Y')from billing where no_rawat=a.no_rawat and no='No.Nota')tglbilling,
                                    (select replace(nm_perawatan,': ','')from billing where no_rawat=a.no_rawat and no='No.Nota')nobilling,
                                    (select replace(nm_perawatan,': ','')from billing where no_rawat=a.no_rawat and no='Bangsal/Kamar')ruangperawatan,
                                    (select replace(nm_perawatan,': ','')from billing where no_rawat=a.no_rawat and no='Tgl.Perawatan')tglperawatan,
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
                                ".$parameter."
                                and   a.no_rawat in (select no_rawat from billing where no_rawat=a.no_rawat and no='No.Nota' and tgl_byr between '".$startDate."' and '".$endDate."') 
                            )x
                        )y
                        order by status_lanjut asc, politujuan asc, date asc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function analisa($startDate,$endDate){
            $query =
                    "
                        select y.kd_poli, kd_dokter, count(jmlpasien)jmlpasien, sum(grandtotal)totalbeban, sum(estimasiklaim)totalestimasi,
                            (select nm_poli   from poliklinik where kd_poli=y.kd_poli)politujuan,
                            (select nm_dokter from dokter     where kd_dokter=y.kd_dokter)namadokter
                        from(
                            select x.*,
                                biayareg+biayaobat+biayarad+biayalab+RJtindakanparamedic+RJtindakandokter+RJtindakandokterparamedic+operasi+ranapdokter+ranapdokterparamedic+ranapparamedis+kamar+dokter grandtotal,
                                case
                                        when x.kd_poli = 'IGDK' then 197600
                                        when x.kd_poli = 'U0001' then 319800
                                        when x.kd_poli = 'U0002' then 197600
                                        when x.kd_poli = 'U0003' then 197600
                                        when x.kd_poli = 'U0005' then 197600
                                        when x.kd_poli = 'U0011' then 257100
                                        when x.kd_poli = 'U0012' then 197600
                                        when x.kd_poli = 'U0007' then 197600
                                        when x.kd_poli = 'U0006' then 197600
                                        when x.kd_poli = 'U0004' then 197600
                                        when x.kd_poli = 'U0018' then 197600
                                        when x.kd_poli = 'U0053' then 131300
                                        else
                                        0 
                                end estimasiklaim
                            from(
                                select a.no_rawat, kd_poli, kd_dokter, 1 jmlpasien,
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
                                and a.kd_pj='BPJ'
                                and a.status_lanjut='Ralan'
                                and   a.kd_poli<>'IGDK'
                                -- and   a.no_rawat in ('2025/01/06/000804','2025/01/06/000796')
                                and   a.no_rawat in (select no_rawat from billing where no_rawat=a.no_rawat and no='No.Nota' and tgl_byr between '".$startDate."' and '".$endDate."') 
                            )x
                        )y
                        group by kd_poli, kd_dokter
                        order by politujuan asc, namadokter asc
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function rincianbilling($norawat,$type){
            $query =
                    "
                        select a.*
                        from billing a
                        where a.no_rawat='".$norawat."'
                        and   a.status='".$type."'
                        and   a.nm_perawatan<>':'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>