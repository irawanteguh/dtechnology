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
                        select a.transaksi_id, 
                            case
                                when a.jenis_id='1' then (select master_name from dt01_gen_master_ms where jenis_id = 'Asset_1' and code=(select jenis_id from dt01_lgu_assets_ms where trans_id=a.assets_id))
                                when a.jenis_id='2' then 'Gaji dan Remunerasi Pegawai'
                                when a.jenis_id='3' then 'Alat Tulis Kantor'
                                else 'Unknown'
                            end kategori,
                            case
                                when a.jenis_id='1' then (select name      from dt01_lgu_assets_ms where trans_id=a.assets_id)
                                when a.jenis_id='2' then (select position  from dt01_hrd_position_ms where position_id=(select position_id from dt01_hrd_gaji_ms where transaksi_id=a.position_id))
                                when a.jenis_id='3' then (select component from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
                                else 'Unknown'
                            end namecomponent,
                            case
                                when a.jenis_id='1' then (select concat('Estimasi Penggunaan : ',estimasi_penggunaan_day,' / Hari') from dt01_lgu_assets_ms where trans_id=a.assets_id)
                                when a.jenis_id='2' then concat(a.jml,' Orang, Durasi Kegiatan : ',(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'),' Menit',' / 1 Pasien')
                                when a.jenis_id='3' then (select concat(jml,' ',satuan,' Per Pasien') from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
                                else 'Unknown'
                            end description,
                            case
                                when a.jenis_id='1' then (select depresiasi_pasien from vw_aset where trans_id=a.assets_id)
                                when a.jenis_id='2' then (select round(((nilai/(25*8*60))*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae')*a.jml)+((remunerasi/(25*8*60))*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae')*a.jml),0) from dt01_hrd_gaji_ms where transaksi_id=a.position_id)
                                when a.jenis_id='3' then (select nilai*a.jml from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
                                else 0
                            end cost
                            
                                    
                        from dt01_keu_unit_cost_dt a
                        where a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        and   a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'

                        union

                        select a.transaksi_id, 
                            'Tagihan Listrik' kategori,
                            (select name from dt01_lgu_assets_ms where trans_id=a.assets_id) namecomponent,
                            (select concat('Durasi Kegiatan : ',durasi,' Menit') from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae')description,
                            (select round((nilai/1000)*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'),0) from dt01_keu_unit_cost_component_ms where jenis_id='1')cost
                                    
                        from dt01_keu_unit_cost_dt a
                        where a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        and   a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'
                        and   a.jenis_id='1'
                        and   a.assets_id=(select assets_id from dt01_lgu_assets_ms where trans_id=a.assets_id and jenis_id in ('1','2','3'))

                        union

                        select a.transaksi_id, 
                            'Biaya Pemeliharaan' kategori,
                            (select name from dt01_lgu_assets_ms where trans_id=a.assets_id) namecomponent,
                            ''description,
                            (select pemeliharaan_pasien from vw_aset where trans_id=a.assets_id) cost       
                                    
                        from dt01_keu_unit_cost_dt a
                        where a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        and   a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'
                        and   a.jenis_id='1'
                        and   a.assets_id=(select assets_id from dt01_lgu_assets_ms where trans_id=a.assets_id and jenis_id in ('1','2','3'))

                        union

                        select a.transaksi_id, 
                            'Bunga Angsuran' kategori,
                            case
                                when a.jenis_id='1' then (select name      from dt01_lgu_assets_ms where trans_id=a.assets_id)
                                when a.jenis_id='2' then (select position  from dt01_hrd_position_ms where position_id=(select position_id from dt01_hrd_gaji_ms where transaksi_id=a.position_id))
                                when a.jenis_id='3' then (select component from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
                                else 'Unknown'
                            end namecomponent,
                            case
                                when a.jenis_id='1' then ''
                                when a.jenis_id='2' then ''
                                when a.jenis_id='3' then ''
                                else 'Unknown'
                            end description,
                            case
                                when a.jenis_id='1' then (select bunga_pasien from vw_aset where trans_id=a.assets_id)
                                when a.jenis_id='2' then 0
                                when a.jenis_id='3' then 1
                                else 0
                            end cost
                            
                                    
                        from dt01_keu_unit_cost_dt a
                        where a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
                        and   a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'
                        and   a.assets_id=(select assets_id from dt01_lgu_assets_ms where trans_id=a.assets_id and jenis_id not in ('5'))

                        order by kategori asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>