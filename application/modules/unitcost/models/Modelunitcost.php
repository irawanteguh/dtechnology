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
                            a.assets_id,

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