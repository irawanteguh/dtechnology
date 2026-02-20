<?php
    class Modelgrouper extends CI_Model{

        function listkunjungan(){
            $query =
                    "
                        select X.*, allobat-(obatkronis+obatkemo)obat
                        from(
                            select a.no_rawat, date_format(tgl_registrasi,'%d.%m.%Y')tgl_registrasi, jam_reg, no_rkm_medis, case when status_lanjut = 'Ralan' then 'OutPatient' else 'InPatient' end status_lanjut,
                                (select nm_dokter from dokter where kd_dokter=a.kd_dokter)namadokter,
                                (select upper(LEFT(nm_pasien, 1)) from pasien where no_rkm_medis=a.no_rkm_medis)initialpasien,
                                (select nm_pasien from pasien where no_rkm_medis=a.no_rkm_medis)namapasien,
                                (select no_peserta from pasien where no_rkm_medis=a.no_rkm_medis)no_peserta,
                                (select alamat from pasien where no_rkm_medis=a.no_rkm_medis)alamat,
                                (select case when jk = 'P' then 'Perempuan' else 'Laki-laki' end from pasien where no_rkm_medis=a.no_rkm_medis)jk,
                                (select no_ktp from pasien where no_rkm_medis=a.no_rkm_medis)noktp,
                                (select nm_poli from poliklinik where kd_poli=a.kd_poli)politujuan,
                                (select png_jawab from penjab where kd_pj=a.kd_pj)provider,
                                
                                (select no_peserta from pasien where no_rkm_medis=a.no_rkm_medis)nobpjs,
                                (select no_sep from bridging_sep_internal where no_rawat=a.no_rawat)nosep,
                                
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status in ('Ralan Dokter Paramedis','Ranap Dokter Paramedis') and nm_perawatan not like '%terapi%')prosedurnonbedah,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status in ('Ralan Dokter Paramedis','Ranap Dokter Paramedis') and nm_perawatan like '%terapi%')rehabmedik,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Operasi')prosedurbedah,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status in ('Ralan Dokter','Ranap Dokter'))konsultasi,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status in ('Ralan Paramedis','Ranap Paramedis'))keperawatan,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Radiologi')rad,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Laborat')lab,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Kamar')kamar,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status='Tambahan')bmhp,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status in ('Harian','Service'))sewaalat,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and status in ('Obat','Retur Obat','Resep Pulang'))allobat,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and nm_perawatan like '%kronis%')obatkronis,
                                (select COALESCE(SUM(totalbiaya), 0) from billing where no_rawat=a.no_rawat and nm_perawatan like '%kemo%')obatkemo
                                
                                
                            from reg_periksa a
                            where a.stts<>'Batal'
                            and   a.kd_pj='BPJ'
                            and   a.status_bayar='Sudah Bayar'
                        )X
                        limit 10;
                
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function kelasperawatan($type){
            $query =
                    "
                        select x.*
                        from(
                            select 'OutPatient'jenis, '3'value,'Kelas Reguler'keterangan union
                            select 'OutPatient'jenis, '1'value,'Kelas Eksekutif'keterangan union
                            select 'InPatient'jenis, '1'value,'Kelas 1'keterangan union
                            select 'InPatient'jenis, '2'value,'Kelas 2'keterangan union
                            select 'InPatient'jenis, '3'value,'Kelas 3'keterangan
                        )x
                        where x.jenis='".$type."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }



    }
?>