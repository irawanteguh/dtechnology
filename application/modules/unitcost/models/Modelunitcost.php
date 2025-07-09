<?php
    class Modelunitcost extends CI_Model{

        function masterlayanan($orgid){
            $query =
                    "
                        select a.layan_id, nama_layan,
                            (select master_name from dt01_gen_master_ms where jenis_id='Layan_1' and code=a.jenis_id)kategori
                        from dt01_keu_layan_ms a
                        WHERE a.active = '1'
                        AND a.org_id = '".$orgid."'
                        order by jenis_id asc

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detailcomponent($orgid){
            $query =
                    "
                        SELECT 
                            a.assets_id componentid,

                            -- Kategori dari master
                            gm.master_name AS kategori,

                            -- Nama komponen dari master aset
                            am.name AS namecomponent,

                            -- Data biaya per pasien dari view
                            b.jenis_id,
                            b.depresiasi_pasien,
                            b.bunga_pasien,
                            b.pemeliharaan_pasien,
                            b.total_biaya_per_pasien

                        FROM dt01_keu_unit_cost_dt a

                        -- Join ke view vw_aset berdasarkan no_assets dan org_id
                        LEFT JOIN vw_aset b 
                            ON b.trans_id = a.assets_id AND b.org_id = a.org_id

                        -- Join ke master aset untuk ambil nama
                        LEFT JOIN dt01_lgu_assets_ms am 
                            ON am.trans_id = a.assets_id

                        -- Join ke master kategori
                        LEFT JOIN dt01_gen_master_ms gm 
                            ON gm.jenis_id = 'Asset_1' AND gm.code = am.jenis_id

                        WHERE a.active = '1'
                        and   a.jenis_id='1'
                        AND a.org_id = '10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        and a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'

                        union

                        select a.position_id componentid, 'Gaji dan Remunerasi Pegawai'kategori,
                            (select concat(position,' ',a.jml,' Orang, durasi : ',(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'),' Menit') from dt01_hrd_position_ms where position_id=(select position_id from dt01_hrd_gaji_ms where transaksi_id=a.position_id))namecomponent,
                            'x'jenis_id,
                            0 depresiasi_pasien,
                            0 bunga_pasien,
                            0 pemeliharaan_pasien,
                            (select round(((nilai/(25*8*60))*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae')*a.jml)+((remunerasi/(25*8*60))*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae')*a.jml),0) from dt01_hrd_gaji_ms where transaksi_id=a.position_id)total_biaya_per_pasien
                        from dt01_keu_unit_cost_dt a
                        where a.jenis_id='2'
                        AND a.org_id = '10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        and a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'

                        union

                        select a.assets_id componentid, 'Tagihan Listrik'kategori,
                            (select concat(name,', durasi : ',(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'),' Menit') from dt01_lgu_assets_ms where trans_id=a.assets_id)namecomponent,
                            'Y'jenis_id,
                            0 depresiasi_pasien,
                            0 bunga_pasien,
                            0 pemeliharaan_pasien,
                            (select round((nilai/1000)*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'),0) from dt01_keu_unit_cost_component_ms where jenis_id='1')total_biaya_per_pasien
                        from dt01_keu_unit_cost_dt a
                        where a.jenis_id='1'
                        AND a.org_id = '10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        and a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'
                        and a.assets_id = (select assets_id from dt01_lgu_assets_ms where trans_id=a.assets_id and jenis_id in ('1','2','3'))

                        union

                        select a.component_id componentid, 'Alat Tulis Kantor'kategori,
                            (select concat(component,' ',a.jml,' ',satuan) from dt01_keu_unit_cost_component_ms where component_id=a.component_id)namecomponent,
                            'Z'jenis_id,
                            0 depresiasi_pasien,
                            0 bunga_pasien,
                            0 pemeliharaan_pasien,
                            (select nilai*a.jml from dt01_keu_unit_cost_component_ms where component_id=a.component_id)total_biaya_per_pasien
                        from dt01_keu_unit_cost_dt a
                        where a.jenis_id='3'
                        AND a.org_id = '10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        and a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'

                        order by jenis_id asc, namecomponent asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>