<?php
    class Modelinsight extends CI_Model{

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
        
        function datainsight($tahun) {
            $tanggal_awal = $tahun . '-01-01';
            $tanggal_akhir = $tahun . '-11-31';

            $query = "
                        WITH RECURSIVE calendar AS (
                            SELECT DATE('$tanggal_awal') AS tanggal
                            UNION ALL
                            SELECT DATE_ADD(tanggal, INTERVAL 1 MONTH)
                            FROM calendar
                            WHERE tanggal < DATE('$tanggal_akhir')
                        )
                        SELECT X.*,
                            pendapatantotalrsms-pengelurantotalrsms balancersms,
                            pendapatantotalrsiabm-pengelurantotalrsiabm balancersiabm,
                            pendapatantotalrst-pengelurantotalrst balancerst
                        FROM(
                            SELECT DATE_FORMAT(tanggal, '%M') AS periode,
                                (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain+mcu_cash+mcu_inv+pob),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pendapatantotalrsms,
                                (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain+mcu_cash+mcu_inv+pob),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pendapatantotalrsiabm,
                                (select coalesce(sum(u_rj+u_ri+a_rj+a_ri+b_rj+b_ri+lain+mcu_cash+mcu_inv+pob),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pendapatantotalrst,

                                (select coalesce(sum(debit),0) from dt01_keu_jurnal_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pengelurantotalrsms,
                                (select coalesce(sum(debit),0) from dt01_keu_jurnal_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pengelurantotalrsiabm,
                                (select coalesce(sum(debit),0) from dt01_keu_jurnal_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pengelurantotalrst,

                                (select coalesce(sum(nilai),0) from dt01_keu_target_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and bulan=date_format(tanggal,'%m') and tahun=date_format(tanggal,'%Y'))targetrsms,
                                (select coalesce(sum(nilai),0) from dt01_keu_target_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and bulan=date_format(tanggal,'%m') and tahun=date_format(tanggal,'%Y'))targetrsiabm,
                                (select coalesce(sum(nilai),0) from dt01_keu_target_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and bulan=date_format(tanggal,'%m') and tahun=date_format(tanggal,'%Y'))targetrst,

                                (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))umumtotalrsms,
                                (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))umumtotalrsiabm,
                                (select coalesce(sum(u_rj+u_ri),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))umumtotalrst,

                                (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))asuransitotalrsms,
                                (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))asuransitotalrsiabm,
                                (select coalesce(sum(a_rj+a_ri),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))asuransitotalrst,

                                (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))bpjstotalrsms,
                                (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))bpjstotalrsiabm,
                                (select coalesce(sum(b_rj+b_ri),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))bpjstotalrst,

                                (select coalesce(sum(lain),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))laintotalrsms,
                                (select coalesce(sum(lain),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))laintotalrsiabm,
                                (select coalesce(sum(lain),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))laintotalrst,

                                (select coalesce(sum(pob),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pobtotalrsms,
                                (select coalesce(sum(pob),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pobtotalrsiabm,
                                (select coalesce(sum(pob),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))pobtotalrst,

                                (select coalesce(sum(mcu_cash+mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))mcutotalrsms,
                                (select coalesce(sum(mcu_cash+mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))mcutotalrsiabm,
                                (select coalesce(sum(mcu_cash+mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))mcutotalrst,

                                (select coalesce(sum(k_urj+k_uri+k_arj+k_ari+k_brj+k_bri+k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjungantotalrsms,
                                (select coalesce(sum(k_urj+k_uri+k_arj+k_ari+k_brj+k_bri+k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjungantotalrsiabm,
                                (select coalesce(sum(k_urj+k_uri+k_arj+k_ari+k_brj+k_bri+k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjungantotalrst,

                                (select coalesce(sum(k_urj+k_uri),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganumumtotalrsms,
                                (select coalesce(sum(k_urj+k_uri),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganumumtotalrsiabm,
                                (select coalesce(sum(k_urj+k_uri),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganumumtotalrst,

                                (select coalesce(sum(k_arj+k_ari),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganasuransitotalrsms,
                                (select coalesce(sum(k_arj+k_ari),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganasuransitotalrsiabm,
                                (select coalesce(sum(k_arj+k_ari),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganasuransitotalrst,

                                (select coalesce(sum(k_brj+k_bri),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganbpjstotalrsms,
                                (select coalesce(sum(k_brj+k_bri),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganbpjstotalrsiabm,
                                (select coalesce(sum(k_brj+k_bri),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganbpjstotalrst,

                                (select coalesce(sum(k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganmcutotalrsms,
                                (select coalesce(sum(k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='d5e63fbc-01ec-4ba8-90b8-fb623438b99d' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganmcutotalrsiabm,
                                (select coalesce(sum(k_mcu_cash+k_mcu_inv),0) from dt01_report_income_dt where active='1' and org_id='a4633f72-4d67-4f65-a050-9f6240704151' and date_format(date,'%m.%Y')=date_format(tanggal,'%m.%Y'))kunjunganmcutotalrst

                            FROM calendar
                        )X;

                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }


    }
?>