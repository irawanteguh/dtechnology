<?php
    class Modelrequest extends CI_Model{

        function masterorganization(){
            $query =
                    "
                        select 'x'org_id, '--Pilih Semua--'org_name union
                        select a.org_id, org_name
                        from dt01_gen_organization_ms a
                        where a.active='1'
                        and   a.holding='N'
                        order by org_name asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datapemesanan($orgid,$status,$orderby){
            $query =
                    "
                        select a.no_pemesanan, no_spu, no_pemesanan_unit, pettycash_id, judul_pemesanan, note, attachment, attachment_note, supplier_id, invoice, invoice_no, from_department_id, department_id, type, method methodid, status_vice, status_dir, status_com, subtotal, harga_ppn, total, cito, status,
                            date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh,
                            (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_2' and code=a.method)colorjenis,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_2' and code=a.method)namejenis,
                            (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_3' and code=a.status)colorstatus,
                            (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='PO_3' and code=a.status)namestatus,
                            (select department from dt01_gen_department_ms where org_id=a.org_id and active=a.active and department_id=a.department_id)unitpelaksana,
                            (select supplier from dt01_lgu_supplier_ms where org_id=a.org_id and active=a.active and supplier_id=a.supplier_id)namasupplier,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan)jmlitem,
                            (select count(item_id) from dt01_lgu_pemesanan_dt where org_id=a.org_id and active=a.active and no_pemesanan=a.no_pemesanan and total=0)itemhargakosong,

                            (
                                SELECT ph.transaksi_id
                                FROM dt01_lgu_penerimaan_hd ph
                                WHERE ph.active = '1'
                                AND ph.org_id = a.org_id
                                AND ph.no_pemesanan = a.no_pemesanan
                                ORDER BY ph.created_date DESC
                                LIMIT 1
                            ) AS nopenerimaan,

                            (select sum(subtotal) from dt01_lgu_penerimaan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan)subtotalterima,
                            (select sum(harga_ppn) from dt01_lgu_penerimaan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan)hargappnterima,
                            (select sum(total) from dt01_lgu_penerimaan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan)totalterima
                            
                        from dt01_lgu_pemesanan_hd a
                        where a.active='1'
                        and   a.version='2.0.0.0'
                        ".$orgid."
                        ".$status."
                        ".$orderby."
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datapenerimaan($orgid,$nopemesanan){
            $query =
                    "
                        select a.transaksi_id, no_penerimaan_unit, no_pemesanan, surat_jalan, note, subtotal, harga_ppn, total,
                            date_format(a.created_date, '%d.%m.%Y %H:%i:%s')tglbuat,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.created_by)dibuatoleh
                        from dt01_lgu_penerimaan_hd a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                        order by created_date desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function detailpembelianitem($orgid,$nopemesanan,$nopenerimaan){
            $query =
                    "
                        select a.item_id, no_pemesanan, barang_id, pt_qty_cmo qty, harga, ppn, harga_ppn, total, note,
                            (select nama_barang from dt01_lgu_barang_ms where barang_id=a.barang_id)namabarang,
                            (select coalesce(sum(qty),0) from dt01_lgu_penerimaan_dt where active='1' and no_pemesanan=a.no_pemesanan and barang_id=a.barang_id)qtyterimaall,
                            (
                                SELECT GROUP_CONCAT(
                                    CONCAT_WS(':',
                                        b.transaksi_id,
                                        b.qty,
                                        b.harga,
                                        b.ppn,
                                        b.harga_ppn,
                                        b.total,
                                        b.no_batch,
                                        b.no_pemesanan,
                                        b.no_penerimaan
                                    )
                                    ORDER BY b.created_date DESC SEPARATOR ';'
                                )
                                FROM dt01_lgu_penerimaan_dt b
                                WHERE b.active='1'
                                AND b.no_penerimaan='".$nopenerimaan."'
                                AND b.no_pemesanan=a.no_pemesanan
                                AND b.barang_id=a.barang_id
                            ) AS rincian
                        from dt01_lgu_pemesanan_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function barangidext($barangid){
            $query =
                    "
                        select barang_id_ext
                        from dt01_lgu_barang_ms
                        where barang_id='".$barangid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset ? $recordset->barang_id_ext : null;
        }


        function detailbarangspu($orgid,$nopemesanan){
            $query =
                    "
                        select a.item_id, barang_id, note, stock, qty_req, qty_req_manager, qty_minta, qty_manager, qty_keu, qty_wadir, qty_dir, qty_com, pt_qty_atem, pt_qty_farmasi, pt_qty_it, pt_qty_cfo, pt_qty_cmo, harga, harga_ppn, ppn, total,
                            (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_beli_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanbeli,
                            (select satuan from dt01_lgu_satuan_ms where active='1' and org_id=a.org_id and satuan_id=(select satuan_pakai_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))satuanpakai,
                            (select jenis from dt01_lgu_jenis_barang_ms where active='1' and org_id=a.org_id and jenis_id=(select jenis_id from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id))jenis,
                            (select nama_barang from dt01_lgu_barang_ms where org_id=a.org_id and barang_id=a.barang_id)namabarang,
                            (select coalesce(sum(masuk),0) from dt01_lgu_mutasi_barang where org_id=a.org_id and no_pemesanan=a.no_pemesanan and barang_id=a.barang_id)jmlmasuk,
                            (select org_name from dt01_gen_organization_ms where org_id=a.org_id)orgname,
                            (select no_pemesanan_unit from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan)nopesananunit,
                            (select date_format(created_date,'%d.%m.%Y %H:%i:%s') from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan)tglpemesanan,
                            (select supplier from dt01_lgu_supplier_ms where active=a.active and supplier_id=(select supplier_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))namasupplier,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select created_by from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))createdby,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select koordinator_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))koordinator,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select manager_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))manager,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select keu_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))finance,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select dir_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))director,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select cfo_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))cfo,
                            (select name from dt01_gen_user_data where org_id=a.org_id and user_id=(select cmo_id from dt01_lgu_pemesanan_hd where active='1' and org_id=a.org_id and no_pemesanan=a.no_pemesanan))cmo

                        from dt01_lgu_pemesanan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                        and   a.active='1'
                        order by namabarang asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function mastersupplier(){
            $query =
                    "
                        select a.supplier_id, supplier
                        from dt01_lgu_supplier_ms a
                        where a.active='1'
                        order by supplier asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterunit($orgid,$userid){
            $query =
                    "
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.active='1'
                        and   a.department is not null
                        and   a.org_id='".$orgid."'
                        and   a.user_id='".$userid."'
                        and   a.level_id in ('4','5')
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function method(){
            $query =
                    "
                        select a.code, master_name
                        from dt01_gen_master_ms a
                        where a.active='1'
                        and   a.jenis_id='PO_2'
                        order by urut asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function buatnopemesanan($orgid, $departmentid, $parameter){
            $query = "
                SELECT CONCAT(
                    LPAD(COALESCE(COUNT(hd.no_pemesanan), 0) + 1, 3, '0'),
                    '/',
                    COALESCE(dm.code,'XXX'),
                    '/',
                    DATE_FORMAT(CURDATE(), '%m'),
                    '/',
                    DATE_FORMAT(CURDATE(), '%Y')
                ) AS nomor_pemesanan
                FROM dt01_gen_department_ms dm
                LEFT JOIN dt01_lgu_pemesanan_hd hd
                    ON dm.org_id = hd.org_id
                    AND dm.department_id = hd.department_id
                    ".$parameter."
                    AND YEAR(hd.created_date) = YEAR(CURDATE())
                WHERE dm.org_id = ".$this->db->escape($orgid)."
                AND dm.department_id =".$this->db->escape($departmentid).";

            ";

            $recordset = $this->db->query($query)->row();
            return $recordset;
        }

        function nopenerimaan($orgid,$nopemesanan,$departmentid){
            $query = "
                        select CONCAT(
                                    LPAD(COALESCE(COUNT(a.no_pemesanan), 0) + 1, 3, '0'),
                                    '/',
                                    COALESCE(b.code,'XXX'),
                                    '/',
                                    DATE_FORMAT(CURDATE(), '%m'),
                                    '/',
                                    DATE_FORMAT(CURDATE(), '%Y'),
                                    '/',
                                    'TRM'
                                ) AS nomor_pemesanan
                        from dt01_lgu_penerimaan_hd a,
                            dt01_gen_department_ms b
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                        and   YEAR(a.created_date) = YEAR(CURDATE())
                        and   b.department_id='".$departmentid."'

                    ";

            $recordset = $this->db->query($query)->row();
            return $recordset;
        }

        function masterbarang($nopemesanan,$parameter){
            $query =
                    "
                        SELECT 
                            a.barang_id,
                            a.nama_barang,
                            b.item_id,
                            b.stock,
                            b.qty_minta AS qty,
                            b.qty_req,
                            b.harga,
                            b.ppn,
                            ROUND(b.harga_ppn, 0) AS hargappn,
                            ROUND(b.total, 0) AS total,
                            b.note,
                            satuan_beli.satuan AS satuanbeli,
                            satuan_pakai.satuan AS satuanpakai,
                            jenis.jenis,
                            h.harga AS harga_terakhir,
                            h.created_date AS tgl_harga_terakhir,
                            CASE 
                                WHEN b.item_id IS NULL THEN '0'
                                ELSE '1'
                            END AS status
                        FROM dt01_lgu_barang_ms a
                        LEFT JOIN dt01_lgu_pemesanan_dt b 
                            ON b.org_id = a.org_id 
                            AND b.barang_id = a.barang_id 
                            AND b.no_pemesanan = '".$nopemesanan."'
                            AND b.active = '1'
                        -- ambil harga terakhir via join dengan tabel agregat
                        LEFT JOIN (
                            SELECT p.org_id, p.barang_id, p.harga, p.created_date
                            FROM dt01_lgu_pemesanan_dt p
                            INNER JOIN (
                                SELECT org_id, barang_id, MAX(created_date) AS max_date
                                FROM dt01_lgu_pemesanan_dt
                                WHERE active = '1'
                                GROUP BY org_id, barang_id
                            ) m ON m.org_id = p.org_id 
                            AND m.barang_id = p.barang_id
                            AND m.max_date = p.created_date
                            WHERE p.active = '1'
                        ) h ON h.org_id = a.org_id 
                        AND h.barang_id = a.barang_id
                        LEFT JOIN dt01_lgu_satuan_ms satuan_beli 
                            ON satuan_beli.satuan_id = a.satuan_beli_id 
                            AND satuan_beli.org_id = a.org_id 
                            AND satuan_beli.active = '1'
                        LEFT JOIN dt01_lgu_satuan_ms satuan_pakai 
                            ON satuan_pakai.satuan_id = a.satuan_pakai_id 
                            AND satuan_pakai.org_id = a.org_id 
                            AND satuan_pakai.active = '1'
                        LEFT JOIN dt01_lgu_jenis_barang_ms jenis 
                            ON jenis.jenis_id = a.jenis_id 
                            AND jenis.org_id = a.org_id 
                            AND jenis.active = '1'
                        WHERE 
                            a.active = '1'
                            ".$parameter."
                        ORDER BY status DESC, a.nama_barang ASC;


                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterstatus($code){
            $query =
                    "
                        select a.master_name, color
                        from dt01_gen_master_ms a
                        where a.active='1'
                        and   a.jenis_id='PO_3'
                        and   a.code='".$code."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function chat($userid,$refid){
            $query = "
                        select x.*,
                            (select name from dt01_gen_user_data where active='1' and user_id=x.created_by)name,
                            (select upper(LEFT(name, 1))  from dt01_gen_user_data where active='1' and user_id=x.created_by)initial,
                            (select image_profile from dt01_gen_user_data where active='1' and user_id=x.created_by)image_profile,
                            case 
                                when '".$userid."' = x.created_by then 'out'
                                else 'in'
                            end type
                        from(
                            select a.chat, date_format(created_date,'%d.%m.%Y %H.%i.%s')jambuat, created_date createddate, created_by
                            from dt01_gen_chat_dt a
                            where a.active='1'
                            and   a.ref_id='".$refid."'
                        )x
                        order by createddate asc
                    ";

            $recordset = $this->db->query($query)->result();
            return $recordset;
        }

        function insertchat($data){           
            $sql =   $this->db->insert("dt01_gen_chat_dt",$data);
            return $sql;
        }

        function hitungdetail($orgid,$nopemesanan){
            $query =
                    "
                        select sum((total-harga_ppn))harga, round(sum(harga_ppn),0)harga_ppn, round(sum(total),0)total
                        from dt01_lgu_pemesanan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function hitungdetailpenerimaan($orgid,$nopenerimaan,$nopemesanan){
            $query =
                    "
                        select sum((total-harga_ppn))harga, round(sum(harga_ppn),0)harga_ppn, round(sum(total),0)total
                        from dt01_lgu_penerimaan_dt a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.no_penerimaan='".$nopenerimaan."'
                        and   a.no_pemesanan='".$nopemesanan."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function cekitemid($orgid,$nopemesanan,$barangid){
            $query =
                    "
                        select a.item_id
                        from dt01_lgu_pemesanan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_pemesanan='".$nopemesanan."'
                        and   a.barang_id='".$barangid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function cekitemidpenerimaan($orgid,$nopenerimaan,$nopemesanan,$barangid){
            $query =
                    "
                        select a.transaksi_id
                        from dt01_lgu_penerimaan_dt a
                        where a.org_id='".$orgid."'
                        and   a.no_penerimaan='".$nopenerimaan."'
                        and   a.no_pemesanan='".$nopemesanan."'
                        and   a.barang_id='".$barangid."'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function cekkoordinator($orgid,$nopemesanan){
            $query =
                    "
                        select head_koordinator
                        from dt01_gen_department_ms
                        where department_id=(
                                                select a.department_id
                                                from dt01_lgu_pemesanan_hd a
                                                where a.org_id='".$orgid."'
                                                and   a.no_pemesanan='".$nopemesanan."'
                                            )
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function checkbalancelast($orgid,$rekeningid){
            $query =
                    "
                        select a.balance
                        from dt01_keu_rekening_it a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.rekening_id='".$rekeningid."'
                        order by created_date desc
                        limit 1;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function nokwitansi($orgid,$rekeningid){
            $query =
                    "
                        select concat(                              
                            lpad(
                                coalesce(
                                    (
                                        select COUNT(transaksi_id)+1
                                        from dt01_keu_rekening_it
                                        where org_id='".$orgid."'
                                        and   rekening_id='".$rekeningid."'
                                        and   date_format(created_date, '%Y') = date_format(current_date, '%Y')
                                    ),
                                    1
                                ),
                                3,
                                '0'
                            ),
                            '/',(select code from dt01_keu_rekening_ms where rekening_id='".$rekeningid."'),'/KEU/',
                            date_format(now(), '%m'),
                            '/',
                            date_format(now(), '%Y')
                    ) nokwitansi

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->row();
            return $recordset;
        }

        function insertrekening($data){           
            $sql =   $this->db->insert("dt01_keu_rekening_it",$data);
            return $sql;
        }

        function insertheader($data){           
            $sql =   $this->db->insert("dt01_lgu_pemesanan_hd",$data);
            return $sql;
        }

        function insertsuratjalan($data){           
            $sql =   $this->db->insert("dt01_lgu_penerimaan_hd",$data);
            return $sql;
        }

        function updateheader($nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_hd",$data,array("no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function updateheaderpenerimaan($nopemesanan,$nopenerimaan,$data){           
            $sql =   $this->db->update("dt01_lgu_penerimaan_hd",$data,array("no_pemesanan"=>$nopemesanan,"transaksi_id"=>$nopenerimaan));
            return $sql;
        }

        function insertitem($data){           
            $sql =   $this->db->insert("dt01_lgu_pemesanan_dt",$data);
            return $sql;
        }

        function insertitempenerimaan($data){           
            $sql =   $this->db->insert("dt01_lgu_penerimaan_dt",$data);
            return $sql;
        }

        function updateitem($barangid,$nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_dt",$data,array("barang_id"=>$barangid,"no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function updateitempenerimaan($barangid,$nopenerimaan,$nopemesanan,$data){           
            $sql =   $this->db->update("dt01_lgu_penerimaan_dt",$data,array("barang_id"=>$barangid,"no_penerimaan"=>$nopenerimaan,"no_pemesanan"=>$nopemesanan));
            return $sql;
        }

        function updatepenerimaan($transaksiid,$data){           
            $sql =   $this->db->update("dt01_lgu_penerimaan_dt",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

        function updatedetailitem($itemid,$data){           
            $sql =   $this->db->update("dt01_lgu_pemesanan_dt",$data,array("item_id"=>$itemid));
            return $sql;
        }

        function insertstock($data){           
            $sql =   $this->db->insert("dt01_lgu_mutasi_barang",$data);
            return $sql;
        }

        function updatestock($transaksiid,$data){           
            $sql =   $this->db->update("dt01_lgu_mutasi_barang",$data,array("transaksi_id"=>$transaksiid));
            return $sql;
        }

    }
?>