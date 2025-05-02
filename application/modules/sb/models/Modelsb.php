<?php
    class Modelsb extends CI_Model{

        function periode(){
            $query =
                    "
                        select distinct date_format(tgl_registrasi, '%Y')periode
                        from reg_periksa a
                        order by periode desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function akuncoa($tahun,$orgid) {

            $query = "
                    select a.coa_id, kode_akun, nama_akun, kategori, coa_header_id,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='01.".$tahun."' and b.coa_id=a.coa_id)debit_01,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='02.".$tahun."' and b.coa_id=a.coa_id)debit_02,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='03.".$tahun."' and b.coa_id=a.coa_id)debit_03,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='04.".$tahun."' and b.coa_id=a.coa_id)debit_04,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='05.".$tahun."' and b.coa_id=a.coa_id)debit_05,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='06.".$tahun."' and b.coa_id=a.coa_id)debit_06,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='07.".$tahun."' and b.coa_id=a.coa_id)debit_07,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='08.".$tahun."' and b.coa_id=a.coa_id)debit_08,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='09.".$tahun."' and b.coa_id=a.coa_id)debit_09,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='10.".$tahun."' and b.coa_id=a.coa_id)debit_10,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='11.".$tahun."' and b.coa_id=a.coa_id)debit_11,
                        (select sum(b.debit) from dt01_keu_jurnal_dt b where b.org_id='".$orgid."' and date_format(date,'%m.%Y')='12.".$tahun."' and b.coa_id=a.coa_id)debit_12
                    from dt01_keu_coa_ms a
                    order by kode_akun asc
            ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

        function jurnal($orgid) {

            $query = "
                    select a.transaksi_id, coa_id, date_format(a.date,'%m')bulan, date_format(a.date,'%d.%m.%Y')tanggal, debit,
                        (select nama_akun from dt01_keu_coa_ms where coa_id=a.coa_id)namakun,
                        (select kode_akun from dt01_keu_coa_ms where coa_id=a.coa_id)kodeakun
                    from dt01_keu_jurnal_dt a
                    where a.org_id='".$orgid."'
                    order by date desc, coa_id asc
            ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

        function databulan($tahun,$orgid) {
            $tanggal_awal = $tahun . '-01-01';
            $tanggal_akhir = $tahun . '-12-31';

            $query = "
                WITH RECURSIVE calendar AS (
                    SELECT DATE('$tanggal_awal') AS tanggal
                    UNION ALL
                    SELECT DATE_ADD(tanggal, INTERVAL 1 DAY)
                    FROM calendar
                    WHERE tanggal < DATE('$tanggal_akhir')
                )
                SELECT 
                    DATE_FORMAT(tanggal, '%d') AS tanggal,
                    CASE DAYOFWEEK(tanggal)
                        WHEN 1 THEN 'Minggu'
                        WHEN 2 THEN 'Senin'
                        WHEN 3 THEN 'Selasa'
                        WHEN 4 THEN 'Rabu'
                        WHEN 5 THEN 'Kamis'
                        WHEN 6 THEN 'Jumat'
                        WHEN 7 THEN 'Sabtu'
                    END AS nama_hari,
                    DATE_FORMAT(tanggal, '%m') AS bulan,
                    DATE_FORMAT(tanggal, '%Y') AS tahun,
                    DATE_FORMAT(tanggal, '%d.%m.%Y') AS parameter,
                    (select coalesce(u_rj,0)       from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) urj,
                    (select coalesce(u_ri,0)       from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) uri,
                    (select coalesce(a_rj,0)       from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) arj,
                    (select coalesce(a_ri,0)       from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) ari,
                    (select coalesce(b_rj,0)       from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) brj,
                    (select coalesce(b_ri,0)       from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) bri,
                    (select coalesce(mcu_cash,0)   from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) mcucash,
                    (select coalesce(mcu_inv,0)    from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) mcuinv,
                    (select coalesce(lain,0)       from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) lain,
                    (select coalesce(pob,0)        from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) pob,
                    (select coalesce(k_urj,0)      from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) kurj,
                    (select coalesce(k_uri,0)      from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) kuri,
                    (select coalesce(k_arj,0)      from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) karj,
                    (select coalesce(k_ari,0)      from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) kari,
                    (select coalesce(k_brj,0)      from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) kbrj,
                    (select coalesce(k_bri,0)      from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) kbri,
                    (select coalesce(k_mcu_cash,0) from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) kmcucash,
                    (select coalesce(k_mcu_inv,0)  from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date=tanggal) kmcuinv
                    
                FROM calendar;
            ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

        function cekdata($orgid,$date){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_report_income_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.date='".$date."'
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertquickreport($data){           
            $sql =   $this->db->insert("dt01_report_income_dt",$data);
            return $sql;
        }

        function insertjurnal($data){           
            $sql =   $this->db->insert("dt01_keu_jurnal_dt",$data);
            return $sql;
        }

        function updatequickreport($orgid,$date,$data){           
            $sql =   $this->db->update("dt01_report_income_dt",$data,array("org_id"=>$orgid,"date"=>$date));
            return $sql;
        }

    }
?>