<?php
    class Modelunitcost extends CI_Model{

        function masterkategori(){
            $query =
                    "
                        select a.code, master_name
                        from dt01_gen_master_ms a
                        where a.jenis_id='Layan_1'
                        order by master_name
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterlayanan($orgid){
            $query =
                    "
                        select x.*,
                            (select master_name from dt01_gen_master_ms where jenis_id='Layan_1' and code=x.jenis_id)kategori
                        from(
                            select '1'type, a.kd_jenis_prw layan_id, TRIM(SUBSTRING_INDEX(nm_perawatan, '-', -1)) nama_layan,
                                '1'jenis_id,
                                0 durasi,
                                0 com_1,
                                0 com_2,
                                0 com_3
                            from jns_perawatan_radiologi a
                            where a.status='x'
                            and   a.kd_jenis_prw not in (select layan_id_rs from dt01_keu_layan_ms where active='1' and org_id='".$orgid."' and layan_id_rs=a.kd_jenis_prw)
                            union
                            select '2'type, a.layan_id, nama_layan,
                                   a.jenis_id,
                                   durasi,
                                   com_1,
                                   com_2,
                                   com_3
                            from dt01_keu_layan_ms a
                            where a.active = '1'
                            and   a.org_id = '".$orgid."'
                        )x
                        order by kategori asc, nama_layan asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function mastersdm($orgid,$layanid){
            $query =
                    "
                        select a.transaksi_id, nilai, remunerasi,
                            (select concat(b.position,' ',coalesce((select level from dt01_gen_level_fungsional_ms where level_id=b.level_fungsional),'')) from dt01_hrd_position_ms b where b.position_id=a.position_id)posisi,
                            (select level from dt01_hrd_position_ms where position_id=a.position_id)level,
                            coalesce((select jml from dt01_keu_unit_cost_dt where active='1' and org_id=a.org_id and jenis_id='2' and layan_id='".$layanid."' and position_id=a.transaksi_id),0)jml
                        from dt01_hrd_gaji_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by level desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masteratk($orgid,$layanid){
            $query =
                    "
                        select '3'jenis_id, a.component_id, component, satuan, nilai,
                               coalesce((select jml from dt01_keu_unit_cost_dt where active='1' and org_id=a.org_id and jenis_id='3' and layan_id='".$layanid."' and component_id=a.component_id),0)jml
                        from dt01_keu_unit_cost_component_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.jenis_id='5'
                        order by component asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function mastersarana($orgid,$layanid){
            $query =
                    "
                        select a.trans_id, name,
                            (select trans_id from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)transid,
                            (select active from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)active
                        from dt01_lgu_assets_ms a
                        where a.active='1'
                        and   a.jenis_id='2'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masteralkes($orgid,$layanid){
            $query =
                    "
                        select a.trans_id, name,
                            (select trans_id from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)transid,
                            (select active from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)active
                        from dt01_lgu_assets_ms a
                        where a.active='1'
                        and   a.jenis_id='1'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masternonalkes($orgid,$layanid){
            $query =
                    "
                        select a.trans_id, name,
                            (select trans_id from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)transid,
                            (select active from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)active
                        from dt01_lgu_assets_ms a
                        where a.active='1'
                        and   a.jenis_id='3'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterrumahtangga($orgid,$layanid){
            $query =
                    "
                        select a.trans_id, name,
                            (select trans_id from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)transid,
                            (select active from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)active
                        from dt01_lgu_assets_ms a
                        where a.active='1'
                        and   a.jenis_id='4'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function mastersoftware($orgid,$layanid){
            $query =
                    "
                        select a.trans_id, name,
                            (select trans_id from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)transid,
                            (select active from dt01_keu_unit_cost_dt where org_id=a.org_id and jenis_id='1' and layan_id='".$layanid."' and assets_id=a.trans_id)active
                        from dt01_lgu_assets_ms a
                        where a.active='1'
                        and   a.jenis_id='5'
                        order by name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdatasdm($orgid,$layanid,$positionid){
            $query =
                    "
                        select a.transaksi_id, position_id
                        from dt01_keu_unit_cost_dt a
                        where a.org_id='".$orgid."'
                        and   a.layan_id='".$layanid."'
                        and   a.position_id='".$positionid."'
                        and   a.jenis_id='2'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdataassets($orgid,$layanid,$assetsid){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_keu_unit_cost_dt a
                        where a.org_id='".$orgid."'
                        and   a.layan_id='".$layanid."'
                        and   a.assets_id='".$assetsid."'
                        and   a.jenis_id='1'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function cekdatacomponent($orgid,$layanid,$componentid){
            $query =
                    "
                        select a.transaksi_id, position_id
                        from dt01_keu_unit_cost_dt a
                        where a.org_id='".$orgid."'
                        and   a.layan_id='".$layanid."'
                        and   a.component_id='".$componentid."'
                        and   a.jenis_id='3'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        // function detailcomponent($orgid){
        //     $query =
        //             "
        //                 select a.transaksi_id, 
        //                     case
        //                         when a.jenis_id='1' then (select master_name from dt01_gen_master_ms where jenis_id = 'Asset_1' and code=(select jenis_id from dt01_lgu_assets_ms where trans_id=a.assets_id))
        //                         when a.jenis_id='2' then 'Gaji dan Remunerasi Pegawai'
        //                         when a.jenis_id='3' then 'Alat Tulis Kantor'
        //                         else 'Unknown'
        //                     end kategori,
        //                     case
        //                         when a.jenis_id='1' then (select name      from dt01_lgu_assets_ms where trans_id=a.assets_id)
        //                         when a.jenis_id='2' then (select position  from dt01_hrd_position_ms where position_id=(select position_id from dt01_hrd_gaji_ms where transaksi_id=a.position_id))
        //                         when a.jenis_id='3' then (select component from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
        //                         else 'Unknown'
        //                     end namecomponent,
        //                     case
        //                         when a.jenis_id='1' then (select concat('Estimasi Penggunaan : ',estimasi_penggunaan_day,' / Hari') from dt01_lgu_assets_ms where trans_id=a.assets_id)
        //                         when a.jenis_id='2' then concat(a.jml,' Orang, Durasi Kegiatan : ',(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'),' Menit',' / 1 Pasien')
        //                         when a.jenis_id='3' then (select concat(jml,' ',satuan,' Per Pasien') from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
        //                         else 'Unknown'
        //                     end description,
        //                     case
        //                         when a.jenis_id='1' then (select depresiasi_pasien from vw_aset where trans_id=a.assets_id)
        //                         when a.jenis_id='2' then (select round(((nilai/(25*8*60))*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae')*a.jml)+((remunerasi/(25*8*60))*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae')*a.jml),0) from dt01_hrd_gaji_ms where transaksi_id=a.position_id)
        //                         when a.jenis_id='3' then (select nilai*a.jml from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
        //                         else 0
        //                     end cost
                            
                                    
        //                 from dt01_keu_unit_cost_dt a
        //                 where a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
        //                 and   a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'

        //                 union

        //                 select a.transaksi_id, 
        //                     'Tagihan Listrik' kategori,
        //                     (select name from dt01_lgu_assets_ms where trans_id=a.assets_id) namecomponent,
        //                     (select concat('Durasi Kegiatan : ',durasi,' Menit') from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae')description,
        //                     (select round((nilai/1000)*(select durasi from dt01_keu_layan_ms where layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'),0) from dt01_keu_unit_cost_component_ms where jenis_id='1')cost
                                    
        //                 from dt01_keu_unit_cost_dt a
        //                 where a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
        //                 and   a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'
        //                 and   a.jenis_id='1'
        //                 and   a.assets_id=(select assets_id from dt01_lgu_assets_ms where trans_id=a.assets_id and jenis_id in ('1','2','3'))

        //                 union

        //                 select a.transaksi_id, 
        //                     'Biaya Pemeliharaan' kategori,
        //                     (select name from dt01_lgu_assets_ms where trans_id=a.assets_id) namecomponent,
        //                     ''description,
        //                     (select pemeliharaan_pasien from vw_aset where trans_id=a.assets_id) cost       
                                    
        //                 from dt01_keu_unit_cost_dt a
        //                 where a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
        //                 and   a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'
        //                 and   a.jenis_id='1'
        //                 and   a.assets_id=(select assets_id from dt01_lgu_assets_ms where trans_id=a.assets_id and jenis_id in ('1','2','3'))

        //                 union

        //                 select a.transaksi_id, 
        //                     'Bunga Angsuran' kategori,
        //                     case
        //                         when a.jenis_id='1' then (select name      from dt01_lgu_assets_ms where trans_id=a.assets_id)
        //                         when a.jenis_id='2' then (select position  from dt01_hrd_position_ms where position_id=(select position_id from dt01_hrd_gaji_ms where transaksi_id=a.position_id))
        //                         when a.jenis_id='3' then (select component from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
        //                         else 'Unknown'
        //                     end namecomponent,
        //                     case
        //                         when a.jenis_id='1' then ''
        //                         when a.jenis_id='2' then ''
        //                         when a.jenis_id='3' then ''
        //                         else 'Unknown'
        //                     end description,
        //                     case
        //                         when a.jenis_id='1' then (select bunga_pasien from vw_aset where trans_id=a.assets_id)
        //                         when a.jenis_id='2' then 0
        //                         when a.jenis_id='3' then 1
        //                         else 0
        //                     end cost
                            
                                    
        //                 from dt01_keu_unit_cost_dt a
        //                 where a.org_id='10c84edd-500b-49e3-93a5-a2c8cd2c8524'
        //                 and   a.layan_id='9f18804e-f8b7-4107-8026-d12f5ebc37ae'
        //                 and   a.assets_id=(select assets_id from dt01_lgu_assets_ms where trans_id=a.assets_id and jenis_id not in ('5'))

        //                 order by kategori asc
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        // function detailcomponent($orgid,$layanid){
        //     $query =
        //             "
        //                 select a.transaksi_id, a.jenis_id,
        //                         case
        //                             when a.jenis_id='1' then (select master_name from dt01_gen_master_ms where jenis_id = 'Asset_1' and code=(select jenis_id from dt01_lgu_assets_ms where trans_id=a.assets_id))
        //                             when a.jenis_id='2' then 'Gaji dan Remunerasi Pegawai'
        //                             when a.jenis_id='3' then ''
        //                             else 'Unknown'
        //                         end kategori,
        //                         case
        //                             when a.jenis_id='1' then a.assets_id
        //                             when a.jenis_id='2' then a.position_id
        //                             when a.jenis_id='3' then ''
        //                             else 'Unknown'
        //                         end namecomponentid,
        //                         case
        //                             when a.jenis_id='1' then (select name from dt01_lgu_assets_ms where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then (select concat(x.position,' ',coalesce((select level from dt01_gen_level_fungsional_ms where level_id=x.level_fungsional),''))  from dt01_hrd_position_ms x where x.position_id=(select position_id from dt01_hrd_gaji_ms where transaksi_id=a.position_id))
        //                             when a.jenis_id='3' then ''
        //                             else 'Unknown'
        //                         end namecomponent,
        //                         case
        //                             when a.jenis_id='1' then (select concat('Estimasi Penggunaan : ',estimasi_penggunaan_day,' x / Hari') from dt01_lgu_assets_ms where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then concat(a.jml,' Orang, Durasi Kegiatan : ',(select durasi from dt01_keu_layan_ms where layan_id='".$layanid."'),' Menit',' / 1 Pasien')
        //                             when a.jenis_id='3' then ''
        //                             else 'Unknown'
        //                         end description,
        //                         case
        //                             when a.jenis_id='1' then (select costperpasien from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then (select round(((nilai/(25*8*60))*(select durasi from dt01_keu_layan_ms where layan_id='".$layanid."')*a.jml)+((remunerasi/(25*8*60))*(select durasi from dt01_keu_layan_ms where layan_id='".$layanid."')*a.jml),0) from dt01_hrd_gaji_ms where transaksi_id=a.position_id)
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end cost,
        //                         case
        //                             when a.jenis_id='1' then 0
        //                             when a.jenis_id='2' then (select nilai from dt01_hrd_gaji_ms where transaksi_id=a.position_id)
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end gaji,
        //                         case
        //                             when a.jenis_id='1' then 0
        //                             when a.jenis_id='2' then (select remunerasi from dt01_hrd_gaji_ms where transaksi_id=a.position_id)
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end remun,
        //                         case
        //                             when a.jenis_id='1' then 0
        //                             when a.jenis_id='2' then a.jml
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end jmlsdm,
        //                         case
        //                             when a.jenis_id='1' then (select nilai_perolehan from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end nilaiasset,
        //                         case
        //                             when a.jenis_id='1' then (select nilai_bunga_pinjaman from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end nilaipinjaman,
        //                         case
        //                             when a.jenis_id='1' then (select nilai_pemeliharaan from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end nilaipemeliharaan,
        //                         case
        //                             when a.jenis_id='1' then (select waktu_depresiasi from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end depresiasi,
        //                         case
        //                             when a.jenis_id='1' then (select waktu_bunga from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end waktupinjaman,
        //                         case
        //                             when a.jenis_id='1' then (select perolehantahunan from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end perolehantahunan,
        //                         case
        //                             when a.jenis_id='1' then (select perolehanbulanan from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end perolehanbulanan,
        //                         case
        //                             when a.jenis_id='1' then (select perolehanharian from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end perolehanharian,
        //                         case
        //                             when a.jenis_id='1' then (select perolehanpasien from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end perolehanpasien,

        //                         case
        //                             when a.jenis_id='1' then (select pinjamantahunan from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end pinjamantahunan,
        //                         case
        //                             when a.jenis_id='1' then (select pinjamanbulanan from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end pinjamanbulanan,
        //                         case
        //                             when a.jenis_id='1' then (select pinjamanharian from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end pinjamanharian,
        //                         case
        //                             when a.jenis_id='1' then (select pinjamanpasien from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end pinjamanpasien,

        //                         case
        //                             when a.jenis_id='1' then (select pemeliharaantahunan from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end pemeliharaantahunan,
        //                         case
        //                             when a.jenis_id='1' then (select pemeliharaanbulanan from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end pemeliharaanbulanan,
        //                         case
        //                             when a.jenis_id='1' then (select pemeliharaanharian from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end pemeliharaanharian,
        //                         case
        //                             when a.jenis_id='1' then (select pemeliharaanpasien from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end pemeliharaanpasien,

        //                         case
        //                             when a.jenis_id='1' then (select estimasi_penggunaan_day from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end estimasi_penggunaan_day,
        //                         case
        //                             when a.jenis_id='1' then (select costperpasien from view_assets_detail where trans_id=a.assets_id)
        //                             when a.jenis_id='2' then 0
        //                             when a.jenis_id='3' then 0
        //                             else 'Unknown'
        //                         end costperpasien
        //                 from dt01_keu_unit_cost_dt a
        //                 where a.active='1'
        //                 and   a.org_id='".$orgid."'
        //                 and   a.layan_id='".$layanid."'
        //             ";

        //     $recordset = $this->db->query($query);
        //     $recordset = $recordset->result();
        //     return $recordset;
        // }

        // function detailcomponent($orgid, $layanid) {
        //     $query = "
        //         SELECT 
        //             a.transaksi_id,
        //             a.jenis_id,
        
        //             -- Kategori
        //             CASE
        //                 WHEN a.jenis_id = '1' THEN gm.master_name
        //                 WHEN a.jenis_id = '2' THEN 'Gaji dan Remunerasi Pegawai'
        //                 WHEN a.jenis_id = '3' THEN 'Alat Tulis Kantor'
        //                 ELSE 'Unknown'
        //             END AS kategori,
        
        //             -- Komponen ID
        //             CASE
        //                 WHEN a.jenis_id = '1' THEN a.assets_id
        //                 WHEN a.jenis_id = '2' THEN a.position_id
        //                 WHEN a.jenis_id = '3' THEN a.component_id
        //                 ELSE 'Unknown'
        //             END AS namecomponentid,
        
        //             -- Nama Komponen
        //             CASE
        //                 WHEN a.jenis_id = '1' THEN lam.name
        //                 WHEN a.jenis_id = '2' THEN CONCAT(p.position, ' ', COALESCE(lf.level, ''))
        //                 WHEN a.jenis_id = '3' THEN (select component from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
        //                 ELSE 'Unknown'
        //             END AS namecomponent,
        
        //             -- Deskripsi
        //             CASE
        //                 WHEN a.jenis_id = '1' THEN CONCAT('Estimasi Penggunaan : ', v.estimasi_penggunaan_day, ' x / Hari')
        //                 WHEN a.jenis_id = '2' THEN CONCAT(a.jml, ' Orang, Durasi Kegiatan : ', l.durasi, ' Menit / 1 Pasien')
        //                 WHEN a.jenis_id = '3' THEN (select concat(a.jml,' ',satuan,' Per Pasien') from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
        //                 ELSE 'Unknown'
        //             END AS description,
        
        //             -- Cost per pasien
        //             CASE
        //                 WHEN a.jenis_id = '1' THEN v.costperpasien
        //                 WHEN a.jenis_id = '2' THEN ROUND(((g.nilai / (25*8*60)) * l.durasi * a.jml) + ((g.remunerasi / (25*8*60)) * l.durasi * a.jml), 0)
        //                 WHEN a.jenis_id = '3' THEN (select nilai*a.jml from dt01_keu_unit_cost_component_ms where component_id=a.component_id)
        //                 ELSE 'Unknown'
        //             END AS cost,
        
        //             -- Gaji
        //             CASE WHEN a.jenis_id = '2' THEN g.nilai ELSE 0 END AS gaji,
        
        //             -- Remunerasi
        //             CASE WHEN a.jenis_id = '2' THEN g.remunerasi ELSE 0 END AS remun,
        
        //             -- Jumlah SDM
        //             CASE WHEN a.jenis_id = '2' THEN a.jml ELSE 0 END AS jmlsdm,
        
        //             -- Nilai perolehan
        //             CASE WHEN a.jenis_id = '1' THEN v.nilai_perolehan ELSE 0 END AS nilaiasset,
        //             CASE WHEN a.jenis_id = '1' THEN v.nilai_bunga_pinjaman ELSE 0 END AS nilaipinjaman,
        //             CASE WHEN a.jenis_id = '1' THEN v.nilai_pemeliharaan ELSE 0 END AS nilaipemeliharaan,
        
        //             -- Waktu depresiasi & pinjaman
        //             CASE WHEN a.jenis_id = '1' THEN v.waktu_depresiasi ELSE 0 END AS depresiasi,
        //             CASE WHEN a.jenis_id = '1' THEN v.waktu_bunga ELSE 0 END AS waktupinjaman,
        
        //             -- Perolehan
        //             CASE WHEN a.jenis_id = '1' THEN v.perolehantahunan ELSE 0 END AS perolehantahunan,
        //             CASE WHEN a.jenis_id = '1' THEN v.perolehanbulanan ELSE 0 END AS perolehanbulanan,
        //             CASE WHEN a.jenis_id = '1' THEN v.perolehanharian ELSE 0 END AS perolehanharian,
        //             CASE WHEN a.jenis_id = '1' THEN v.perolehanpasien ELSE 0 END AS perolehanpasien,
        
        //             -- Pinjaman
        //             CASE WHEN a.jenis_id = '1' THEN v.pinjamantahunan ELSE 0 END AS pinjamantahunan,
        //             CASE WHEN a.jenis_id = '1' THEN v.pinjamanbulanan ELSE 0 END AS pinjamanbulanan,
        //             CASE WHEN a.jenis_id = '1' THEN v.pinjamanharian ELSE 0 END AS pinjamanharian,
        //             CASE WHEN a.jenis_id = '1' THEN v.pinjamanpasien ELSE 0 END AS pinjamanpasien,
        
        //             -- Pemeliharaan
        //             CASE WHEN a.jenis_id = '1' THEN v.pemeliharaantahunan ELSE 0 END AS pemeliharaantahunan,
        //             CASE WHEN a.jenis_id = '1' THEN v.pemeliharaanbulanan ELSE 0 END AS pemeliharaanbulanan,
        //             CASE WHEN a.jenis_id = '1' THEN v.pemeliharaanharian ELSE 0 END AS pemeliharaanharian,
        //             CASE WHEN a.jenis_id = '1' THEN v.pemeliharaanpasien ELSE 0 END AS pemeliharaanpasien,
        
        //             -- Estimasi
        //             CASE WHEN a.jenis_id = '1' THEN v.estimasi_penggunaan_day ELSE 0 END AS estimasi_penggunaan_day,
        //             CASE WHEN a.jenis_id = '1' THEN v.costperpasien ELSE 0 END AS costperpasien
        
        //         FROM dt01_keu_unit_cost_dt a
        
        //         LEFT JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND a.jenis_id = '1'
        //         LEFT JOIN view_assets_detail v ON v.trans_id = a.assets_id AND a.jenis_id = '1'
        //         LEFT JOIN dt01_gen_master_ms gm ON gm.code = lam.jenis_id AND gm.jenis_id = 'Asset_1'
        
        //         LEFT JOIN dt01_hrd_gaji_ms g ON g.transaksi_id = a.position_id AND a.jenis_id = '2'
        //         LEFT JOIN dt01_hrd_position_ms p ON p.position_id = g.position_id
        //         LEFT JOIN dt01_gen_level_fungsional_ms lf ON lf.level_id = p.level_fungsional
        
        //         LEFT JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id
        
        //         WHERE a.active = '1'
        //         AND a.org_id = '$orgid'
        //         AND a.layan_id = '$layanid'

        //         union

        //         SELECT 
        //             a.transaksi_id,
        //             'V'jenis_id,

        //             -- Kategori
        //             'Tagihan Listrik' AS kategori,

        //             -- Komponen ID
        //             a.assets_id AS namecomponentid,

        //             -- Nama Komponen
        //             CONCAT('Listrik ',lam.name) AS namecomponent,

        //             -- Deskripsi
        //             CONCAT('Estimasi Penggunaan Listrik : ', lam.vol_listrik, ' kW Selama : ', l.durasi,' Menit') AS description,

        //             -- Cost per pasien
        //             lam.vol_listrik*(l.durasi/60)*(select nilai from dt01_keu_unit_cost_component_ms where active='1' and org_id=a.org_id and jenis_id='1') AS cost,

        //             -- Gaji
        //             0 AS gaji,

        //             -- Remunerasi
        //             0 AS remun,

        //             -- Jumlah SDM
        //             0 AS jmlsdm,

        //             -- Nilai perolehan
        //             0 AS nilaiasset,
        //             0 AS nilaipinjaman,
        //             0 AS nilaipemeliharaan,

        //             -- Waktu depresiasi & pinjaman
        //             '' AS depresiasi,
        //             '' AS waktupinjaman,

        //             -- Perolehan
        //             0 AS perolehantahunan,
        //             0 AS perolehanbulanan,
        //             0 AS perolehanharian,
        //             0 AS perolehanpasien,

        //             -- Pinjaman
        //             0 AS pinjamantahunan,
        //             0 AS pinjamanbulanan,
        //             0 AS pinjamanharian,
        //             0 AS pinjamanpasien,

        //             -- Pemeliharaan
        //             0 AS pemeliharaantahunan,
        //             0 AS pemeliharaanbulanan,
        //             0 AS pemeliharaanharian,
        //             0 AS pemeliharaanpasien,

        //             -- Estimasi
        //             0 AS estimasi_penggunaan_day,
        //             0 AS costperpasien

        //         FROM dt01_keu_unit_cost_dt a

        //         LEFT JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND a.jenis_id = '1'
        //         LEFT JOIN view_assets_detail v ON v.trans_id = a.assets_id AND a.jenis_id = '1'
        //         LEFT JOIN dt01_gen_master_ms gm ON gm.code = lam.jenis_id AND gm.jenis_id = 'Asset_1'

        //         LEFT JOIN dt01_hrd_gaji_ms g ON g.transaksi_id = a.position_id AND a.jenis_id = '2'
        //         LEFT JOIN dt01_hrd_position_ms p ON p.position_id = g.position_id
        //         LEFT JOIN dt01_gen_level_fungsional_ms lf ON lf.level_id = p.level_fungsional

        //         LEFT JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id

        //         WHERE a.active = '1'
        //         and a.assets_id = (select trans_id from dt01_lgu_assets_ms where org_id=a.org_id and active='1' and listrik='Y' and trans_id=a.assets_id)
        //         AND a.org_id = '$orgid'
        //         AND a.layan_id = '$layanid'
                
        //         order by jenis_id asc, kategori asc, namecomponent asc
        //     ";
        
        //     $recordset = $this->db->query($query);
        //     return $recordset->result();
        // }
        
        // function detailcomponent($orgid, $layanid) {
        //     $query = "

        //             SELECT 
        //                 a.transaksi_id,
        //                 a.jenis_id,

        //                 -- Kategori
        //                 CASE
        //                     WHEN a.jenis_id = '1' THEN gm.master_name
        //                     WHEN a.jenis_id = '2' THEN 'Gaji dan Remunerasi Pegawai'
        //                     WHEN a.jenis_id = '3' THEN 'Alat Tulis Kantor'
        //                     ELSE 'Unknown'
        //                 END AS kategori,

        //                 -- Komponen ID
        //                 CASE
        //                     WHEN a.jenis_id = '1' THEN a.assets_id
        //                     WHEN a.jenis_id = '2' THEN a.position_id
        //                     WHEN a.jenis_id = '3' THEN a.component_id
        //                     ELSE 'Unknown'
        //                 END AS namecomponentid,

        //                 -- Nama Komponen
        //                 CASE
        //                     WHEN a.jenis_id = '1' THEN lam.name
        //                     WHEN a.jenis_id = '2' THEN CONCAT(p.position, ' ', COALESCE(lf.level, ''))
        //                     WHEN a.jenis_id = '3' THEN dkc.component
        //                     ELSE 'Unknown'
        //                 END AS namecomponent,

        //                 -- Deskripsi
        //                 CASE
        //                     WHEN a.jenis_id = '1' THEN CONCAT('Estimasi Penggunaan : ', v.estimasi_penggunaan_day, ' x / Hari')
        //                     WHEN a.jenis_id = '2' THEN CONCAT(a.jml, ' Orang, Durasi Kegiatan : ', l.durasi, ' Menit / 1 Pasien')
        //                     WHEN a.jenis_id = '3' THEN CONCAT(a.jml, ' ', dkc.satuan, ' Per Pasien')
        //                     ELSE 'Unknown'
        //                 END AS description,

        //                 -- Cost per pasien
        //                 CASE
        //                     WHEN a.jenis_id = '1' THEN v.costperpasien
        //                     WHEN a.jenis_id = '2' THEN ROUND(((g.nilai + g.remunerasi) / (25*8*60)) * l.durasi * a.jml, 0)
        //                     WHEN a.jenis_id = '3' THEN dkc.nilai * a.jml
        //                     ELSE 'Unknown'
        //                 END AS cost,

        //                 -- Gaji & Remun
        //                 IF(a.jenis_id = '2', g.nilai, 0) AS gaji,
        //                 IF(a.jenis_id = '2', g.remunerasi, 0) AS remun,
        //                 IF(a.jenis_id = '2', a.jml, 0) AS jmlsdm,

        //                 -- Nilai Perolehan
        //                 IF(a.jenis_id = '1', v.nilai_perolehan, 0) AS nilaiasset,
        //                 IF(a.jenis_id = '1', v.nilai_bunga_pinjaman, 0) AS nilaipinjaman,
        //                 IF(a.jenis_id = '1', v.nilai_pemeliharaan, 0) AS nilaipemeliharaan,

        //                 -- Waktu
        //                 IF(a.jenis_id = '1', v.waktu_depresiasi, '') AS depresiasi,
        //                 IF(a.jenis_id = '1', v.waktu_bunga, '') AS waktupinjaman,

        //                 -- Perolehan, Pinjaman, Pemeliharaan, Estimasi, Cost
        //                 IF(a.jenis_id = '1', v.perolehantahunan, 0) AS perolehantahunan,
        //                 IF(a.jenis_id = '1', v.perolehanbulanan, 0) AS perolehanbulanan,
        //                 IF(a.jenis_id = '1', v.perolehanharian, 0) AS perolehanharian,
        //                 IF(a.jenis_id = '1', v.perolehanpasien, 0) AS perolehanpasien,
        //                 IF(a.jenis_id = '1', v.pinjamantahunan, 0) AS pinjamantahunan,
        //                 IF(a.jenis_id = '1', v.pinjamanbulanan, 0) AS pinjamanbulanan,
        //                 IF(a.jenis_id = '1', v.pinjamanharian, 0) AS pinjamanharian,
        //                 IF(a.jenis_id = '1', v.pinjamanpasien, 0) AS pinjamanpasien,
        //                 IF(a.jenis_id = '1', v.pemeliharaantahunan, 0) AS pemeliharaantahunan,
        //                 IF(a.jenis_id = '1', v.pemeliharaanbulanan, 0) AS pemeliharaanbulanan,
        //                 IF(a.jenis_id = '1', v.pemeliharaanharian, 0) AS pemeliharaanharian,
        //                 IF(a.jenis_id = '1', v.pemeliharaanpasien, 0) AS pemeliharaanpasien,
        //                 IF(a.jenis_id = '1', v.estimasi_penggunaan_day, 0) AS estimasi_penggunaan_day,
        //                 IF(a.jenis_id = '1', v.costperpasien, 0) AS costperpasien

        //             FROM dt01_keu_unit_cost_dt a
        //             LEFT JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND a.jenis_id = '1'
        //             LEFT JOIN view_assets_detail v ON v.trans_id = a.assets_id AND a.jenis_id = '1'
        //             LEFT JOIN dt01_gen_master_ms gm ON gm.code = lam.jenis_id AND gm.jenis_id = 'Asset_1'
        //             LEFT JOIN dt01_hrd_gaji_ms g ON g.transaksi_id = a.position_id AND a.jenis_id = '2'
        //             LEFT JOIN dt01_hrd_position_ms p ON p.position_id = g.position_id
        //             LEFT JOIN dt01_gen_level_fungsional_ms lf ON lf.level_id = p.level_fungsional
        //             LEFT JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id
        //             LEFT JOIN dt01_keu_unit_cost_component_ms dkc ON dkc.component_id = a.component_id
        //             WHERE a.active = '1'
        //             AND a.org_id = '$orgid'
        //             AND a.layan_id = '$layanid'

        //             UNION ALL

        //             SELECT 
        //                 a.transaksi_id,
        //                 'V' AS jenis_id,
        //                 'Tagihan Listrik' AS kategori,
        //                 a.assets_id AS namecomponentid,
        //                 CONCAT('Listrik ', lam.name) AS namecomponent,
        //                 CONCAT('Estimasi Penggunaan Listrik : ', lam.vol_listrik, ' kW Selama : ', l.durasi, ' Menit') AS description,
        //                 round((lam.vol_listrik * (l.durasi / 60) * dkc2.nilai),0) AS cost,
        //                 0 AS gaji, 0 AS remun, 0 AS jmlsdm,
        //                 0 AS nilaiasset, 0 AS nilaipinjaman, 0 AS nilaipemeliharaan,
        //                 '' AS depresiasi, '' AS waktupinjaman,
        //                 0 AS perolehantahunan, 0 AS perolehanbulanan, 0 AS perolehanharian, 0 AS perolehanpasien,
        //                 0 AS pinjamantahunan, 0 AS pinjamanbulanan, 0 AS pinjamanharian, 0 AS pinjamanpasien,
        //                 0 AS pemeliharaantahunan, 0 AS pemeliharaanbulanan, 0 AS pemeliharaanharian, 0 AS pemeliharaanpasien,
        //                 0 AS estimasi_penggunaan_day, 0 AS costperpasien

        //             FROM dt01_keu_unit_cost_dt a
        //             LEFT JOIN dt01_lgu_assets_ms lam 
        //                 ON lam.trans_id = a.assets_id AND lam.listrik = 'Y'
        //             LEFT JOIN dt01_keu_layan_ms l 
        //                 ON l.layan_id = a.layan_id
        //             LEFT JOIN dt01_keu_unit_cost_component_ms dkc2 
        //                 ON dkc2.org_id = a.org_id AND dkc2.active = '1' AND dkc2.jenis_id = '1'
        //             WHERE a.active = '1'
        //             AND a.org_id = '$orgid'
        //             AND a.layan_id = '$layanid'
        //             AND EXISTS (
        //                 SELECT 1 FROM dt01_lgu_assets_ms x 
        //                 WHERE x.org_id = a.org_id AND x.trans_id = a.assets_id AND x.listrik = 'Y'
        //             )

        //             UNION ALL

        //             SELECT 
		// 			    a.transaksi_id,
		// 			    'V' AS jenis_id,
		// 			    'Tagihan Internet' AS kategori,
		// 			    a.assets_id AS namecomponentid,
		// 			    CONCAT('Internet ', lam.name) AS namecomponent,
		// 			    CONCAT('Estimasi Penggunaan Internet : ', l.durasi, ' Menit') AS description,
		// 			    ROUND(((dkc2.nilai / 43200) * l.durasi) / (
		// 			        SELECT COUNT(*) 
		// 			        FROM dt01_lgu_assets_ms 
		// 			        WHERE internet = 'Y' AND org_id = a.org_id
		// 			    ), 0) AS cost,
		// 			    0 AS gaji, 0 AS remun, 0 AS jmlsdm,
		// 			    0 AS nilaiasset, 0 AS nilaipinjaman, 0 AS nilaipemeliharaan,
		// 			    '' AS depresiasi, '' AS waktupinjaman,
		// 			    0 AS perolehantahunan, 0 AS perolehanbulanan, 0 AS perolehanharian, 0 AS perolehanpasien,
		// 			    0 AS pinjamantahunan, 0 AS pinjamanbulanan, 0 AS pinjamanharian, 0 AS pinjamanpasien,
		// 			    0 AS pemeliharaantahunan, 0 AS pemeliharaanbulanan, 0 AS pemeliharaanharian, 0 AS pemeliharaanpasien,
		// 			    0 AS estimasi_penggunaan_day, 0 AS costperpasien
					
		// 			FROM dt01_keu_unit_cost_dt a
		// 			LEFT JOIN dt01_lgu_assets_ms lam 
		// 			    ON lam.trans_id = a.assets_id AND lam.internet = 'Y'
		// 			LEFT JOIN dt01_keu_layan_ms l 
		// 			    ON l.layan_id = a.layan_id
		// 			LEFT JOIN dt01_keu_unit_cost_component_ms dkc2 
		// 			    ON dkc2.org_id = a.org_id AND dkc2.active = '1' AND dkc2.jenis_id = '4'
		// 			WHERE a.active = '1'
		// 			    AND a.org_id = '$orgid'
        //                 AND a.layan_id = '$layanid'
		// 			    AND EXISTS (
		// 			        SELECT 1 FROM dt01_lgu_assets_ms x 
		// 			        WHERE x.org_id = a.org_id AND x.trans_id = a.assets_id AND x.internet = 'Y'
		// 			    )
        //             ORDER BY jenis_id ASC, kategori ASC, namecomponent ASC;

        //     ";
        
        //     $recordset = $this->db->query($query);
        //     return $recordset->result();
        // }

        function detailcomponent($orgid, $layanid) {
            $query = "
            WITH internet_user_count AS (
                SELECT org_id, COUNT(*) AS jml
                FROM dt01_lgu_assets_ms
                WHERE internet = 'Y'
                GROUP BY org_id
            )
        
            SELECT 
                a.transaksi_id,
                a.jenis_id,
                CASE
                    WHEN a.jenis_id = '1' THEN gm.master_name
                    WHEN a.jenis_id = '2' THEN 'Gaji dan Remunerasi Pegawai'
                    WHEN a.jenis_id = '3' THEN 'Alat Tulis Kantor'
                    ELSE 'Unknown'
                END AS kategori,
                CASE
                    WHEN a.jenis_id = '1' THEN a.assets_id
                    WHEN a.jenis_id = '2' THEN a.position_id
                    WHEN a.jenis_id = '3' THEN a.component_id
                    ELSE 'Unknown'
                END AS namecomponentid,
                CASE
                    WHEN a.jenis_id = '1' THEN lam.name
                    WHEN a.jenis_id = '2' THEN CONCAT(p.position, ' ', COALESCE(lf.level, ''))
                    WHEN a.jenis_id = '3' THEN dkc.component
                    ELSE 'Unknown'
                END AS namecomponent,
                CASE
                    WHEN a.jenis_id = '1' THEN CONCAT('Estimasi Penggunaan : ', v.estimasi_penggunaan_day, ' x / Hari')
                    WHEN a.jenis_id = '2' THEN CONCAT(a.jml, ' Orang, Durasi Kegiatan : ', l.durasi, ' Menit / 1 Pasien')
                    WHEN a.jenis_id = '3' THEN CONCAT(a.jml, ' ', dkc.satuan, ' Per Pasien')
                    ELSE 'Unknown'
                END AS description,
                CASE
                    WHEN a.jenis_id = '1' THEN v.costperpasien
                    WHEN a.jenis_id = '2' THEN ROUND(((g.nilai + g.remunerasi) / (25*8*60)) * l.durasi * a.jml, 0)
                    WHEN a.jenis_id = '3' THEN dkc.nilai * a.jml
                    ELSE 'Unknown'
                END AS cost,
                IF(a.jenis_id = '2', g.nilai, 0) AS gaji,
                IF(a.jenis_id = '2', g.remunerasi, 0) AS remun,
                IF(a.jenis_id = '2', a.jml, 0) AS jmlsdm,
                IF(a.jenis_id = '1', v.nilai_perolehan, 0) AS nilaiasset,
                IF(a.jenis_id = '1', v.nilai_bunga_pinjaman, 0) AS nilaipinjaman,
                IF(a.jenis_id = '1', v.nilai_pemeliharaan, 0) AS nilaipemeliharaan,
                IF(a.jenis_id = '1', v.waktu_depresiasi, '') AS depresiasi,
                IF(a.jenis_id = '1', v.waktu_bunga, '') AS waktupinjaman,
                IF(a.jenis_id = '1', v.perolehantahunan, 0) AS perolehantahunan,
                IF(a.jenis_id = '1', v.perolehanbulanan, 0) AS perolehanbulanan,
                IF(a.jenis_id = '1', v.perolehanharian, 0) AS perolehanharian,
                IF(a.jenis_id = '1', v.perolehanpasien, 0) AS perolehanpasien,
                IF(a.jenis_id = '1', v.pinjamantahunan, 0) AS pinjamantahunan,
                IF(a.jenis_id = '1', v.pinjamanbulanan, 0) AS pinjamanbulanan,
                IF(a.jenis_id = '1', v.pinjamanharian, 0) AS pinjamanharian,
                IF(a.jenis_id = '1', v.pinjamanpasien, 0) AS pinjamanpasien,
                IF(a.jenis_id = '1', v.pemeliharaantahunan, 0) AS pemeliharaantahunan,
                IF(a.jenis_id = '1', v.pemeliharaanbulanan, 0) AS pemeliharaanbulanan,
                IF(a.jenis_id = '1', v.pemeliharaanharian, 0) AS pemeliharaanharian,
                IF(a.jenis_id = '1', v.pemeliharaanpasien, 0) AS pemeliharaanpasien,
                IF(a.jenis_id = '1', v.estimasi_penggunaan_day, 0) AS estimasi_penggunaan_day,
                IF(a.jenis_id = '1', v.costperpasien, 0) AS costperpasien
        
            FROM dt01_keu_unit_cost_dt a
            LEFT JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND a.jenis_id = '1'
            LEFT JOIN view_assets_detail v ON v.trans_id = a.assets_id AND a.jenis_id = '1'
            LEFT JOIN dt01_gen_master_ms gm ON gm.code = lam.jenis_id AND gm.jenis_id = 'Asset_1'
            LEFT JOIN dt01_hrd_gaji_ms g ON g.transaksi_id = a.position_id AND a.jenis_id = '2'
            LEFT JOIN dt01_hrd_position_ms p ON p.position_id = g.position_id
            LEFT JOIN dt01_gen_level_fungsional_ms lf ON lf.level_id = p.level_fungsional
            LEFT JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id
            LEFT JOIN dt01_keu_unit_cost_component_ms dkc ON dkc.component_id = a.component_id
            WHERE a.active = '1'
            AND a.org_id = '$orgid'
            AND a.layan_id = '$layanid'
        
            UNION ALL
        
            SELECT 
                a.transaksi_id, 'V' AS jenis_id, 'Tagihan Listrik', a.assets_id,
                CONCAT('Listrik ', lam.name),
                CONCAT('Estimasi Penggunaan Listrik : ', lam.vol_listrik, ' kW Selama : ', l.durasi, ' Menit'),
                ROUND((lam.vol_listrik * (l.durasi / 60) * dkc2.nilai), 0),
                0, 0, 0,
                0, 0, 0,
                '', '',
                0, 0, 0, 0,
                0, 0, 0, 0,
                0, 0, 0, 0,
                0, 0
            FROM dt01_keu_unit_cost_dt a
            JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND lam.listrik = 'Y'
            JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id
            JOIN dt01_keu_unit_cost_component_ms dkc2 ON dkc2.org_id = a.org_id AND dkc2.active = '1' AND dkc2.jenis_id = '1'
            WHERE a.active = '1'
            AND a.org_id = '$orgid'
            AND a.layan_id = '$layanid'
        
            UNION ALL
        
            SELECT 
                a.transaksi_id, 'V' AS jenis_id, 'Tagihan Internet', a.assets_id,
                CONCAT('Internet ', lam.name),
                CONCAT('Estimasi Penggunaan Internet : ', l.durasi, ' Menit'),
                ROUND(((dkc2.nilai / 43200) * l.durasi) / iuc.jml, 0),
                0, 0, 0,
                0, 0, 0,
                '', '',
                0, 0, 0, 0,
                0, 0, 0, 0,
                0, 0, 0, 0,
                0, 0
            FROM dt01_keu_unit_cost_dt a
            JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND lam.internet = 'Y'
            JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id
            JOIN dt01_keu_unit_cost_component_ms dkc2 ON dkc2.org_id = a.org_id AND dkc2.active = '1' AND dkc2.jenis_id = '4'
            JOIN internet_user_count iuc ON iuc.org_id = a.org_id
            WHERE a.active = '1'
            AND a.org_id = '$orgid'
            AND a.layan_id = '$layanid'
        
            ORDER BY jenis_id ASC, kategori ASC, namecomponent ASC
            ";
        
            $recordset = $this->db->query($query);
            return $recordset->result();
        }
        

        function insertcomponent($data){           
            $sql =   $this->db->insert("dt01_keu_unit_cost_dt",$data);
            return $sql;
        }

        function updatecomponentassets($data,$orgid,$layanid,$assetsid){           
            $sql =   $this->db->update("dt01_keu_unit_cost_dt",$data,array("org_id"=>$orgid,"layan_id"=>$layanid, "assets_id"=>$assetsid, "jenis_id"=>"1"));
            return $sql;
        }

        function updatecomponentsdm($data,$orgid,$layanid,$positionid){           
            $sql =   $this->db->update("dt01_keu_unit_cost_dt",$data,array("org_id"=>$orgid,"layan_id"=>$layanid, "position_id"=>$positionid, "jenis_id"=>"2"));
            return $sql;
        }

        function updatecomponentrumahtangga($data,$orgid,$layanid,$componentid){           
            $sql =   $this->db->update("dt01_keu_unit_cost_dt",$data,array("org_id"=>$orgid,"layan_id"=>$layanid, "component_id"=>$componentid, "jenis_id"=>"3"));
            return $sql;
        }

        function insertsimulation($data){           
            $sql =   $this->db->insert("dt01_keu_layan_ms",$data);
            return $sql;
        }

        function updatesimulation($orgid,$layanid,$data){           
            $sql =   $this->db->update("dt01_keu_layan_ms",$data,array("org_id"=>$orgid,"layan_id"=>$layanid));
            return $sql;
        }

    }
?>