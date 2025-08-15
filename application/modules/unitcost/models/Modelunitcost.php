<?php
    class Modelunitcost extends CI_Model{

        function masterorganization($parameter){
            $query =
                    "
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        ".$parameter."
                        order by org_name desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }
        
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

        function masterobat($orgid,$layanid){
            $query =
                    "
                        select a.barang_id, nama_barang, coalesce(h_beli,0)hargabeli,
                            (select satuan from dt01_lgu_satuan_ms where satuan_id=a.satuan_pakai_id)satuan,
                            coalesce((select jml from dt01_keu_unit_cost_dt where active='1' and org_id='".$orgid."' and jenis_id='4' and layan_id='".$layanid."' and barang_id=a.barang_id),0)jml
                        from dt01_lgu_barang_ms a
                        where a.active='1'
                        and   a.jenis_id='b3a2e1a0-0001-4a00-9001-000000000001'
                        order by nama_barang asc
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

        function cekdatafarmasi($orgid,$layanid,$barangid){
            $query =
                    "
                        select a.transaksi_id, position_id
                        from dt01_keu_unit_cost_dt a
                        where a.org_id='".$orgid."'
                        and   a.layan_id='".$layanid."'
                        and   a.barang_id='".$barangid."'
                        and   a.jenis_id='4'
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

        // CREATE OR REPLACE VIEW view_unit_cost_detail_all AS
        // WITH internet_user_count AS (
        //     SELECT
        //         sikms.dt01_lgu_assets_ms.ORG_ID AS org_id,
        //         COUNT(0) AS jml
        //     FROM
        //         sikms.dt01_lgu_assets_ms
        //     WHERE
        //         sikms.dt01_lgu_assets_ms.INTERNET = 'Y'
        //     GROUP BY
        //         sikms.dt01_lgu_assets_ms.ORG_ID
        // )
        // SELECT
        //     a.ORG_ID AS org_id,
        //     a.LAYAN_ID AS layan_id,
        //     a.TRANSAKSI_ID AS transaksi_id,
        //     a.JENIS_ID AS jenis_id,
        //     CASE
        //         WHEN a.JENIS_ID = '1' THEN gm.MASTER_NAME
        //         WHEN a.JENIS_ID = '2' THEN 'Gaji dan Remunerasi Pegawai'
        //         WHEN a.JENIS_ID = '3' THEN 'Alat Tulis Kantor'
        //         WHEN a.JENIS_ID = '4' THEN 'Obat dan BMHP'
        //         ELSE 'Unknown'
        //     END AS kategori,
        //     CASE
        //         WHEN a.JENIS_ID = '1' THEN a.ASSETS_ID
        //         WHEN a.JENIS_ID = '2' THEN a.POSITION_ID
        //         WHEN a.JENIS_ID = '3' THEN a.COMPONENT_ID
        //         WHEN a.JENIS_ID = '4' THEN a.BARANG_ID
        //         ELSE 'Unknown'
        //     END AS namecomponentid,
        //     CASE
        //         WHEN a.JENIS_ID = '1' THEN lam.NAME
        //         WHEN a.JENIS_ID = '2' THEN CONCAT(p.POSITION, ' ', COALESCE(lf.LEVEL, ''))
        //         WHEN a.JENIS_ID = '3' THEN dkc.COMPONENT
        //         WHEN a.JENIS_ID = '4' THEN frm.NAMA_BARANG
        //         ELSE 'Unknown'
        //     END AS namecomponent,
        //     CASE
        //         WHEN a.JENIS_ID = '1' THEN CONCAT('Estimasi Penggunaan : ', v.estimasi_penggunaan_day, ' x / Hari')
        //         WHEN a.JENIS_ID = '2' THEN CONCAT(a.JML, ' Orang, Durasi Kegiatan : ', l.DURASI, ' Menit / 1 Pasien')
        //         WHEN a.JENIS_ID = '3' THEN CONCAT(a.JML, ' ', dkc.SATUAN, ' Per Pasien')
        //         WHEN a.JENIS_ID = '4' THEN CONCAT('Penggunaan Obat / BMHP Sebanyak : ',a.JML, ' ',coalesce(frmsatuan.SATUAN,''), ' Per Pasien')
        //         ELSE 'Unknown'
        //     END AS description,
        //     CASE
        //         WHEN a.JENIS_ID = '1' THEN v.costperpasien
        //         WHEN a.JENIS_ID = '2' THEN ROUND((g.NILAI + g.REMUNERASI) / (25 * 8 * 60) * l.DURASI * a.JML, 0)
        //         WHEN a.JENIS_ID = '3' THEN dkc.NILAI * a.JML
        //         WHEN a.JENIS_ID = '4' THEN coalesce(frm.H_BELI * a.JML,0)
        //         ELSE 'Unknown'
        //     END AS cost,
        //     IF(a.JENIS_ID = '2', g.NILAI, 0) AS gaji,
        //     IF(a.JENIS_ID = '2', g.REMUNERASI, 0) AS remun,
        //     IF(a.JENIS_ID = '2', a.JML, 0) AS jmlsdm,
        //     IF(a.JENIS_ID = '1', v.nilai_perolehan, 0) AS nilaiasset,
        //     IF(a.JENIS_ID = '1', v.nilai_bunga_pinjaman, 0) AS nilaipinjaman,
        //     IF(a.JENIS_ID = '1', v.nilai_pemeliharaan, 0) AS nilaipemeliharaan,
        //     IF(a.JENIS_ID = '1', v.waktu_depresiasi, '') AS depresiasi,
        //     IF(a.JENIS_ID = '1', v.waktu_bunga, '') AS waktupinjaman,
        //     IF(a.JENIS_ID = '1', v.perolehantahunan, 0) AS perolehantahunan,
        //     IF(a.JENIS_ID = '1', v.perolehanbulanan, 0) AS perolehanbulanan,
        //     IF(a.JENIS_ID = '1', v.perolehanharian, 0) AS perolehanharian,
        //     IF(a.JENIS_ID = '1', v.perolehanpasien, 0) AS perolehanpasien,
        //     IF(a.JENIS_ID = '1', v.pinjamantahunan, 0) AS pinjamantahunan,
        //     IF(a.JENIS_ID = '1', v.pinjamanbulanan, 0) AS pinjamanbulanan,
        //     IF(a.JENIS_ID = '1', v.pinjamanharian, 0) AS pinjamanharian,
        //     IF(a.JENIS_ID = '1', v.pinjamanpasien, 0) AS pinjamanpasien,
        //     IF(a.JENIS_ID = '1', v.pemeliharaantahunan, 0) AS pemeliharaantahunan,
        //     IF(a.JENIS_ID = '1', v.pemeliharaanbulanan, 0) AS pemeliharaanbulanan,
        //     IF(a.JENIS_ID = '1', v.pemeliharaanharian, 0) AS pemeliharaanharian,
        //     IF(a.JENIS_ID = '1', v.pemeliharaanpasien, 0) AS pemeliharaanpasien,
        //     IF(a.JENIS_ID = '1', v.estimasi_penggunaan_day, 0) AS estimasi_penggunaan_day,
        //     IF(a.JENIS_ID = '1', v.costperpasien, 0) AS costperpasien
        // FROM
        //     sikms.dt01_keu_unit_cost_dt a
        //     LEFT JOIN sikms.dt01_lgu_assets_ms lam ON lam.TRANS_ID = a.ASSETS_ID AND a.JENIS_ID = '1'
        //     LEFT JOIN sikms.view_assets_detail v ON v.trans_id = a.ASSETS_ID AND a.JENIS_ID = '1'
        //     LEFT JOIN sikms.dt01_gen_master_ms gm ON gm.CODE = lam.JENIS_ID AND gm.JENIS_ID = 'Asset_1'
        //     LEFT JOIN sikms.dt01_hrd_gaji_ms g ON g.TRANSAKSI_ID = a.POSITION_ID AND a.JENIS_ID = '2'
        //     LEFT JOIN sikms.dt01_hrd_position_ms p ON p.POSITION_ID = g.POSITION_ID
        //     LEFT JOIN sikms.dt01_gen_level_fungsional_ms lf ON lf.LEVEL_ID = p.LEVEL_FUNGSIONAL
        //     LEFT JOIN sikms.dt01_keu_layan_ms l ON l.LAYAN_ID = a.LAYAN_ID
        //     LEFT JOIN sikms.dt01_keu_unit_cost_component_ms dkc ON dkc.COMPONENT_ID = a.COMPONENT_ID
        //     LEFT JOIN sikms.dt01_lgu_barang_ms frm ON frm.BARANG_ID = a.BARANG_ID
        //     LEFT JOIN sikms.dt01_lgu_satuan_ms frmsatuan ON frmsatuan.SATUAN_ID = frm.SATUAN_PAKAI_ID
        // WHERE
        //     a.ACTIVE = '1'
            
        // union all

        // SELECT
        //     a.ORG_ID,
        //     a.LAYAN_ID,
        //     a.TRANSAKSI_ID,
        //     'V',
        //     'Tagihan Listrik',
        //     a.ASSETS_ID,
        //     CONCAT('Listrik ', lam.NAME),
        //     CONCAT('Estimasi Penggunaan Listrik : ', lam.VOL_LISTRIK, ' kW Selama : ', l.DURASI, ' Menit'),
        //     ROUND(lam.VOL_LISTRIK * (l.DURASI / 60) * dkc2.NILAI, 0),
        //     0,0,0,0,0,0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0
        // FROM
        //     sikms.dt01_keu_unit_cost_dt a
        //     JOIN sikms.dt01_lgu_assets_ms lam ON lam.TRANS_ID = a.ASSETS_ID AND lam.LISTRIK = 'Y'
        //     JOIN sikms.dt01_keu_layan_ms l ON l.LAYAN_ID = a.LAYAN_ID
        //     JOIN sikms.dt01_keu_unit_cost_component_ms dkc2 ON dkc2.ORG_ID = a.ORG_ID AND dkc2.ACTIVE = '1' AND dkc2.JENIS_ID = '1'
        // WHERE
        //     a.ACTIVE = '1'
            
        // union all
        
        // SELECT
        //     a.ORG_ID,
        //     a.LAYAN_ID,
        //     a.TRANSAKSI_ID,
        //     'V',
        //     'Tagihan Internet',
        //     a.ASSETS_ID,
        //     CONCAT('Internet ', lam.NAME),
        //     CONCAT('Estimasi Penggunaan Internet : ', l.DURASI, ' Menit'),
        //     ROUND(dkc2.NILAI / 43200 * l.DURASI / iuc.jml, 0),
        //     0,0,0,0,0,0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0
        // FROM
        //     sikms.dt01_keu_unit_cost_dt a
        //     JOIN sikms.dt01_lgu_assets_ms lam ON lam.TRANS_ID = a.ASSETS_ID AND lam.INTERNET = 'Y'
        //     JOIN sikms.dt01_keu_layan_ms l ON l.LAYAN_ID = a.LAYAN_ID
        //     JOIN sikms.dt01_keu_unit_cost_component_ms dkc2 ON dkc2.ORG_ID = a.ORG_ID AND dkc2.ACTIVE = '1' AND dkc2.JENIS_ID = '4'
        //     JOIN internet_user_count iuc ON iuc.org_id = a.ORG_ID
        // WHERE
        //     a.ACTIVE = '1';
            


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

        function updatecomponentfarmasi($data,$orgid,$layanid,$barangid){           
            $sql =   $this->db->update("dt01_keu_unit_cost_dt",$data,array("org_id"=>$orgid,"layan_id"=>$layanid, "barang_id"=>$barangid, "jenis_id"=>"4"));
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