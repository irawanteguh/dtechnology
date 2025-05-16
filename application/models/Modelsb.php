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
                        select 
                            b.tgl_byr, 
                            sum(case when 
                                (select r.kd_pj from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'bpj' 
                                and
                                (select r.status_lanjut from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'ralan' 
                                and
                                (select r.stts from sikms.reg_periksa r where r.no_rawat = b.no_rawat) <> 'Batal' 
                                then b.totalbiaya else 0 end) as bpjs_rajal,
                            
                            sum(case when 
                                (select r.kd_pj from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'a09' 
                                and
                                (select r.status_lanjut from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'ralan'
                                and
                                (select r.stts from sikms.reg_periksa r where r.no_rawat = b.no_rawat) <> 'Batal' 
                                then b.totalbiaya else 0 end) as umum_rajal,
                            
                            sum(case when 
                                (select r.kd_pj from sikms.reg_periksa r where r.no_rawat = b.no_rawat) not in ('bpj', 'a09') 
                                and
                                (select r.status_lanjut from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'ralan'
                                and
                                (select r.stts from sikms.reg_periksa r where r.no_rawat = b.no_rawat) <> 'Batal'  
                                then b.totalbiaya else 0 end) as asuransi_rajal,
                            
                            sum(case when 
                                (select r.kd_pj from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'bpj' 
                                and
                                (select r.status_lanjut from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'ranap' 
                                and
                                (select r.stts from sikms.reg_periksa r where r.no_rawat = b.no_rawat) <> 'Batal' 
                                then b.totalbiaya else 0 end) as bpjs_ranap,
                            
                            sum(case when 
                                (select r.kd_pj from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'a09' 
                                and
                                (select r.status_lanjut from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'ranap' 
                                and
                                (select r.stts from sikms.reg_periksa r where r.no_rawat = b.no_rawat) <> 'Batal' 
                                then b.totalbiaya else 0 end) as umum_ranap,
                            
                            sum(case when 
                                (select r.kd_pj from sikms.reg_periksa r where r.no_rawat = b.no_rawat) not in ('bpj', 'a09') 
                                and
                                (select r.status_lanjut from sikms.reg_periksa r where r.no_rawat = b.no_rawat) = 'ranap' 
                                and
                                (select r.stts from sikms.reg_periksa r where r.no_rawat = b.no_rawat) <> 'Batal' 
                                then b.totalbiaya else 0 end) as asuransi_ranap,
                            
                            (select sum(x.totalbiaya) 
                            from sikmcu.billing x 
                            where x.tgl_byr = b.tgl_byr) as total_mcu

                        from sikms.billing b
                        where b.tgl_byr between curdate() - interval 140 day and curdate()
                        and   b.no_rawat=(select no_rawat from reg_periksa where stts<>'Batal' and no_rawat=b.no_rawat)
                        group by b.tgl_byr
                        order by b.tgl_byr;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        
        
    }
?>