<?php
    class Modelkunjungan extends CI_Model{
        
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

        function databulanan($tahun,$orgid) {
            $tanggal_awal  = $tahun . '-01-01';
            $tanggal_akhir = $tahun . '-11-31';

            $query = "
                        WITH RECURSIVE calendar AS (
                            SELECT DATE('$tanggal_awal') AS tanggal
                            UNION ALL
                            SELECT DATE_ADD(tanggal, INTERVAL 1 MONTH)
                            FROM calendar
                            WHERE tanggal < DATE('$tanggal_akhir')
                        )
                        SELECT X.*
                        FROM(
                            SELECT DATE_FORMAT(tanggal, '%M') AS periode,

                                (select coalesce(sum(k_urj+k_uri+k_arj+k_ari+k_brj+k_bri+k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjungantotal,
                                (select coalesce(sum(k_urj+k_uri),0) from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganumumtotal,
                                (select coalesce(sum(k_arj+k_ari),0) from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganasuransitotal,
                                (select coalesce(sum(k_brj+k_bri),0) from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganbpjstotal,
                                (select coalesce(sum(k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='".$orgid."' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganmcutotal

                            FROM calendar
                        )X;
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

        function databulananpiutang($tahun) {
            $query = "
                        select a.periode, jenis_id, sum(nilai)jml,
                        CASE 
                                WHEN a.jenis_id = '1' THEN 'Asuransi Rawat Jalan'
                                WHEN a.jenis_id = '2' THEN 'Medical Check Up'
                                WHEN a.jenis_id = '3' THEN 'Tagihan Klaim BPJS'
                                WHEN a.jenis_id = '4' THEN 'Obat Kronis'
                                WHEN a.jenis_id = '5' THEN 'Ambulance'
                                WHEN a.jenis_id = '6' THEN 'Lainnya'
                                WHEN a.jenis_id = '7' THEN 'Asuransi Rawat Inap'
                                ELSE 'Unknown'
                            END AS jenistagihan,
                            CASE 
                                WHEN a.jenis_id in ('3','4','5') THEN '1'
                                WHEN a.jenis_id = '2' THEN '2'
                                WHEN a.jenis_id in ('1','7') THEN '3'
                                ELSE '4'
                            END AS urutan,
                            MONTH(STR_TO_DATE(periode, '%m.%Y')) bulan_order,
                            YEAR(STR_TO_DATE(periode, '%m.%Y')) tahun_order
                            
                    from dt01_keu_piutang_hd a
                    where a.active='1'
                    and SUBSTRING(a.periode, 4, 4) = '".$tahun."'
                    group by periode, jenis_id
                    order by tahun_order ASC, bulan_order ASC;
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

        function dataharian($tahun) {
            $tanggal_awal = $tahun . '-01-01';
            $tanggal_akhir = $tahun . '-12-31';

            $query = "
                        WITH RECURSIVE calendar AS (
                            SELECT DATE('$tanggal_awal') AS tanggal
                            UNION ALL
                            SELECT DATE_ADD(tanggal, INTERVAL 1 DAY)
                            FROM calendar
                            WHERE tanggal < DATE('$tanggal_akhir')
                            AND tanggal < CURDATE()
                        )
                        select x.*
                        from(
                            select DATE_FORMAT(tanggal, '%d.%m.%Y')tanggal,
                            (select coalesce(sum(k_urj+k_uri+k_arj+k_ari+k_brj+k_bri+k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%d.%m.%Y')=date_format(tanggal,'%d.%m.%Y'))kunjungantotalrsms,
                            (select coalesce(sum(k_urj+k_uri+k_arj+k_ari+k_brj+k_bri+k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%d.%m.%Y')=date_format(tanggal,'%d.%m.%Y'))kunjungantotalrsiabm,
                            (select coalesce(sum(k_urj+k_uri+k_arj+k_ari+k_brj+k_bri+k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%d.%m.%Y')=date_format(tanggal,'%d.%m.%Y'))kunjungantotalrst
                            from calendar
                        )x;
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>