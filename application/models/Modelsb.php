<?php
    class Modelsb extends CI_Model{

        function dataquickreportkunjungan(){
            $query =
                    "
                        select a.tgl_registrasi,
                            sum(case when a.kd_pj='BPJ' and a.status_lanjut ='Ralan' then 1 else 0 end)kunjunganbpjsrj,
                            sum(case when a.kd_pj='BPJ' and a.status_lanjut ='Ranap' then 1 else 0 end)kunjunganbpjsri,
                            sum(case when a.kd_pj='A09' and a.status_lanjut ='Ralan' then 1 else 0 end)kunjunganumumrj,
                            sum(case when a.kd_pj='A09' and a.status_lanjut ='Ranap' then 1 else 0 end)kunjunganumumri,
                            sum(case when a.kd_pj not in ('BPJ','A09') and a.status_lanjut ='Ralan' then 1 else 0 end)kunjunganasuransirj,
                            sum(case when a.kd_pj not in ('BPJ','A09') and a.status_lanjut ='Ranap' then 1 else 0 end)kunjunganasuransiri

                        from reg_periksa a
                        where a.stts<>'Batal'
                        and   a.tgl_registrasi BETWEEN CURDATE() - INTERVAL 140 DAY AND CURDATE()
                        group by tgl_registrasi
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function dataquickreportpendapatan(){
            $query =
                    "
                        SELECT 
							b.tgl_byr, 
							(
						IFNULL(
							(SELECT SUM(pp.totalpiutang-pp.uangmuka)
							FROM piutang_pasien pp
							JOIN reg_periksa r ON pp.no_rawat = r.no_rawat
							WHERE r.kd_pj = 'BPJ'
								AND r.status_lanjut = 'ralan'
								AND r.stts <> 'Batal'
								AND DATE(r.tgl_registrasi) = b.tgl_byr
							), 0 )
						) AS bpjs_rajal,

							(
								SUM(CASE WHEN 
								(SELECT r.kd_pj FROM sikms.reg_periksa r WHERE r.no_rawat = b.no_rawat) = 'a09' 
								AND (SELECT r.status_lanjut FROM sikms.reg_periksa r WHERE r.no_rawat = b.no_rawat) = 'ralan'
								AND (SELECT r.stts FROM sikms.reg_periksa r WHERE r.no_rawat = b.no_rawat) <> 'Batal' 
								THEN b.totalbiaya ELSE 0 END)
							+
							IFNULL((
								SELECT SUM(pp.uangmuka)
								FROM piutang_pasien pp
								WHERE pp.tgl_piutang = b.tgl_byr
								AND pp.no_rawat IN (
									SELECT r2.no_rawat FROM reg_periksa r2
									WHERE r2.status_lanjut = 'ralan'
									AND r2.stts <> 'Batal'
								)
							),0)
						) AS umum_rajal,


							(
						IFNULL(
							(SELECT SUM(pp.totalpiutang-pp.uangmuka)
							FROM piutang_pasien pp
							JOIN reg_periksa r ON pp.no_rawat = r.no_rawat
							WHERE r.kd_pj NOT IN ('BPJ')
								AND r.status_lanjut = 'ralan'
								AND r.stts <> 'Batal'
								AND DATE(r.tgl_registrasi) = b.tgl_byr
							), 0 )
						) AS asuransi_rajal,

							
							(
						IFNULL(
							(SELECT SUM(pp.sisapiutang)
							FROM piutang_pasien pp
							JOIN reg_periksa r ON pp.no_rawat = r.no_rawat
							WHERE r.kd_pj = 'BPJ'
								AND r.status_lanjut = 'ranap'
								AND r.stts <> 'Batal'
								AND DATE(pp.tgl_piutang) = b.tgl_byr
							), 0 )
						) AS bpjs_ranap,

							(
							SUM(CASE WHEN 
								(SELECT r.kd_pj FROM sikms.reg_periksa r WHERE r.no_rawat = b.no_rawat) = 'a09' 
								AND (SELECT r.status_lanjut FROM sikms.reg_periksa r WHERE r.no_rawat = b.no_rawat) = 'ranap' 
								AND (SELECT r.stts FROM sikms.reg_periksa r WHERE r.no_rawat = b.no_rawat) <> 'Batal' 
								THEN b.totalbiaya ELSE 0 END) 
							+
							IFNULL((
								SELECT SUM(pp.uangmuka)
								FROM piutang_pasien pp
								WHERE pp.tgl_piutang = b.tgl_byr
								AND pp.no_rawat IN (
									SELECT r2.no_rawat FROM reg_periksa r2
									WHERE r2.status_lanjut = 'ranap'
									AND r2.stts <> 'Batal'
								)
							),0)
						) AS umum_ranap,


							(
						IFNULL(
							(SELECT SUM(pp.sisapiutang)
							FROM piutang_pasien pp
							JOIN reg_periksa r ON pp.no_rawat = r.no_rawat
							WHERE r.kd_pj NOT IN ('BPJ')
								AND r.status_lanjut = 'ranap'
								AND r.stts <> 'Batal'
								AND DATE(PP.tgl_piutang) = b.tgl_byr
							), 0 )
						) AS asuransi_ranap,

						IFNULL(
						(SELECT SUM(x.totalbiaya) 
						FROM sikmcu.billing X 
						WHERE x.tgl_byr = b.tgl_byr), 0
						) AS total_mcu,
							

						CEIL(
						IFNULL(
							(SELECT SUM(ts.jumlah_bayar)
							FROM tagihan_sadewa ts
							WHERE ts.no_nota LIKE 'PJ%'
								AND DATE(ts.tgl_bayar) = b.tgl_byr
							), 0 )
						) AS POB


						
						
						FROM sikms.billing b
						WHERE b.tgl_byr BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
						AND b.no_rawat = (SELECT no_rawat FROM reg_periksa WHERE stts <> 'Batal' AND no_rawat = b.no_rawat)
						GROUP BY b.tgl_byr
						ORDER BY b.tgl_byr;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
    }
?>