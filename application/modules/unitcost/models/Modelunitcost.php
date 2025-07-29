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
                            select '1'type, ''org_id, a.kd_jenis_prw layan_id, TRIM(SUBSTRING_INDEX(nm_perawatan, '-', -1)) nama_layan,
                                '1'jenis_id,
                                0 durasi,
                                0 cost,
                                0 com_1,
                                0 com_2,
                                0 com_3
                            from jns_perawatan_radiologi a
                            where a.status='x'
                            and   a.kd_jenis_prw not in (select layan_id_rs from dt01_keu_layan_ms where active='1' and org_id='".$orgid."' and layan_id_rs=a.kd_jenis_prw)
                            union
                            select '2'type, org_id, a.layan_id, nama_layan,
                                a.jenis_id,
                                durasi,
                                (
                                        SELECT ROUND(COALESCE(SUM(cost), 0) * 1.3, 0)
                                        FROM view_unit_cost_detail_all
                                        WHERE org_id = a.org_id AND layan_id = a.layan_id
                                    ) AS cost,
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

        // function detailcomponent($orgid, $layanid) {
        //     $query = "
        //     WITH internet_user_count AS (
        //         SELECT org_id, COUNT(*) AS jml
        //         FROM dt01_lgu_assets_ms
        //         WHERE internet = 'Y'
        //         GROUP BY org_id
        //     )
        
        //     SELECT 
        //         a.transaksi_id,
        //         a.jenis_id,
        //         CASE
        //             WHEN a.jenis_id = '1' THEN gm.master_name
        //             WHEN a.jenis_id = '2' THEN 'Gaji dan Remunerasi Pegawai'
        //             WHEN a.jenis_id = '3' THEN 'Alat Tulis Kantor'
        //             ELSE 'Unknown'
        //         END AS kategori,
        //         CASE
        //             WHEN a.jenis_id = '1' THEN a.assets_id
        //             WHEN a.jenis_id = '2' THEN a.position_id
        //             WHEN a.jenis_id = '3' THEN a.component_id
        //             ELSE 'Unknown'
        //         END AS namecomponentid,
        //         CASE
        //             WHEN a.jenis_id = '1' THEN lam.name
        //             WHEN a.jenis_id = '2' THEN CONCAT(p.position, ' ', COALESCE(lf.level, ''))
        //             WHEN a.jenis_id = '3' THEN dkc.component
        //             ELSE 'Unknown'
        //         END AS namecomponent,
        //         CASE
        //             WHEN a.jenis_id = '1' THEN CONCAT('Estimasi Penggunaan : ', v.estimasi_penggunaan_day, ' x / Hari')
        //             WHEN a.jenis_id = '2' THEN CONCAT(a.jml, ' Orang, Durasi Kegiatan : ', l.durasi, ' Menit / 1 Pasien')
        //             WHEN a.jenis_id = '3' THEN CONCAT(a.jml, ' ', dkc.satuan, ' Per Pasien')
        //             ELSE 'Unknown'
        //         END AS description,
        //         CASE
        //             WHEN a.jenis_id = '1' THEN v.costperpasien
        //             WHEN a.jenis_id = '2' THEN ROUND(((g.nilai + g.remunerasi) / (25*8*60)) * l.durasi * a.jml, 0)
        //             WHEN a.jenis_id = '3' THEN dkc.nilai * a.jml
        //             ELSE 'Unknown'
        //         END AS cost,
        //         IF(a.jenis_id = '2', g.nilai, 0) AS gaji,
        //         IF(a.jenis_id = '2', g.remunerasi, 0) AS remun,
        //         IF(a.jenis_id = '2', a.jml, 0) AS jmlsdm,
        //         IF(a.jenis_id = '1', v.nilai_perolehan, 0) AS nilaiasset,
        //         IF(a.jenis_id = '1', v.nilai_bunga_pinjaman, 0) AS nilaipinjaman,
        //         IF(a.jenis_id = '1', v.nilai_pemeliharaan, 0) AS nilaipemeliharaan,
        //         IF(a.jenis_id = '1', v.waktu_depresiasi, '') AS depresiasi,
        //         IF(a.jenis_id = '1', v.waktu_bunga, '') AS waktupinjaman,
        //         IF(a.jenis_id = '1', v.perolehantahunan, 0) AS perolehantahunan,
        //         IF(a.jenis_id = '1', v.perolehanbulanan, 0) AS perolehanbulanan,
        //         IF(a.jenis_id = '1', v.perolehanharian, 0) AS perolehanharian,
        //         IF(a.jenis_id = '1', v.perolehanpasien, 0) AS perolehanpasien,
        //         IF(a.jenis_id = '1', v.pinjamantahunan, 0) AS pinjamantahunan,
        //         IF(a.jenis_id = '1', v.pinjamanbulanan, 0) AS pinjamanbulanan,
        //         IF(a.jenis_id = '1', v.pinjamanharian, 0) AS pinjamanharian,
        //         IF(a.jenis_id = '1', v.pinjamanpasien, 0) AS pinjamanpasien,
        //         IF(a.jenis_id = '1', v.pemeliharaantahunan, 0) AS pemeliharaantahunan,
        //         IF(a.jenis_id = '1', v.pemeliharaanbulanan, 0) AS pemeliharaanbulanan,
        //         IF(a.jenis_id = '1', v.pemeliharaanharian, 0) AS pemeliharaanharian,
        //         IF(a.jenis_id = '1', v.pemeliharaanpasien, 0) AS pemeliharaanpasien,
        //         IF(a.jenis_id = '1', v.estimasi_penggunaan_day, 0) AS estimasi_penggunaan_day,
        //         IF(a.jenis_id = '1', v.costperpasien, 0) AS costperpasien
        
        //     FROM dt01_keu_unit_cost_dt a
        //     LEFT JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND a.jenis_id = '1'
        //     LEFT JOIN view_assets_detail v ON v.trans_id = a.assets_id AND a.jenis_id = '1'
        //     LEFT JOIN dt01_gen_master_ms gm ON gm.code = lam.jenis_id AND gm.jenis_id = 'Asset_1'
        //     LEFT JOIN dt01_hrd_gaji_ms g ON g.transaksi_id = a.position_id AND a.jenis_id = '2'
        //     LEFT JOIN dt01_hrd_position_ms p ON p.position_id = g.position_id
        //     LEFT JOIN dt01_gen_level_fungsional_ms lf ON lf.level_id = p.level_fungsional
        //     LEFT JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id
        //     LEFT JOIN dt01_keu_unit_cost_component_ms dkc ON dkc.component_id = a.component_id
        //     WHERE a.active = '1'
        //     AND a.org_id = '$orgid'
        //     AND a.layan_id = '$layanid'
        
        //     UNION ALL
        
        //     SELECT 
        //         a.transaksi_id, 'V' AS jenis_id, 'Tagihan Listrik', a.assets_id,
        //         CONCAT('Listrik ', lam.name),
        //         CONCAT('Estimasi Penggunaan Listrik : ', lam.vol_listrik, ' kW Selama : ', l.durasi, ' Menit'),
        //         ROUND((lam.vol_listrik * (l.durasi / 60) * dkc2.nilai), 0),
        //         0, 0, 0,
        //         0, 0, 0,
        //         '', '',
        //         0, 0, 0, 0,
        //         0, 0, 0, 0,
        //         0, 0, 0, 0,
        //         0, 0
        //     FROM dt01_keu_unit_cost_dt a
        //     JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND lam.listrik = 'Y'
        //     JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id
        //     JOIN dt01_keu_unit_cost_component_ms dkc2 ON dkc2.org_id = a.org_id AND dkc2.active = '1' AND dkc2.jenis_id = '1'
        //     WHERE a.active = '1'
        //     AND a.org_id = '$orgid'
        //     AND a.layan_id = '$layanid'
        
        //     UNION ALL
        
        //     SELECT 
        //         a.transaksi_id, 'V' AS jenis_id, 'Tagihan Internet', a.assets_id,
        //         CONCAT('Internet ', lam.name),
        //         CONCAT('Estimasi Penggunaan Internet : ', l.durasi, ' Menit'),
        //         ROUND(((dkc2.nilai / 43200) * l.durasi) / iuc.jml, 0),
        //         0, 0, 0,
        //         0, 0, 0,
        //         '', '',
        //         0, 0, 0, 0,
        //         0, 0, 0, 0,
        //         0, 0, 0, 0,
        //         0, 0
        //     FROM dt01_keu_unit_cost_dt a
        //     JOIN dt01_lgu_assets_ms lam ON lam.trans_id = a.assets_id AND lam.internet = 'Y'
        //     JOIN dt01_keu_layan_ms l ON l.layan_id = a.layan_id
        //     JOIN dt01_keu_unit_cost_component_ms dkc2 ON dkc2.org_id = a.org_id AND dkc2.active = '1' AND dkc2.jenis_id = '4'
        //     JOIN internet_user_count iuc ON iuc.org_id = a.org_id
        //     WHERE a.active = '1'
        //     AND a.org_id = '$orgid'
        //     AND a.layan_id = '$layanid'
        
        //     ORDER BY jenis_id ASC, kategori ASC, namecomponent ASC
        //     ";
        
        //     $recordset = $this->db->query($query);
        //     return $recordset->result();
        // }
        
        function detailcomponent($orgid, $layanid) {
            $query = "
                select *
                from view_unit_cost_detail_all
                where org_id = '$orgid'
                and   layan_id = '$layanid'
                order by jenis_id asc, kategori asc, namecomponent asc;
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