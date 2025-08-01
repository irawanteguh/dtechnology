<?php
    class Modelasuransi extends CI_Model{

        function rekening($orgid){
            $query =
                    "
                        select a.rekening_id, concat(account,' ',account_id)keterangan
                        from dt01_keu_rekening_ms a
                        where a.org_id='".$orgid."'
                        and   a.active='1'
                        order by account asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function masterunit($orgid,$parameter){
            $query =
                    "
                        select a.department_id, department
                        from dt01_gen_department_ms a
                        where a.org_id='".$orgid."'
                        ".$parameter."
                        and   a.active='1'
                        order by department asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function periode(){
            $query =
                    "
                        select distinct date_format(a.tgl_registrasi,'%m.%Y')periodeid, date_format(a.tgl_registrasi,'%M %Y')keterangan
                        from reg_periksa a
                        order by tgl_registrasi desc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function periodetahun(){
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

        function provider($orgid){
            $query =
                    "
                        select a.provider_id, provider
                        from dt01_keu_provider_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        order by provider asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function datapiutang($orgid){
            $query =
                    "
                        select x.*,
                            nilai-jmlterbayar sisa
                        from(
                            select a.piutang_id, no_tagihan, rekanan_id, note, nilai, jenis_id, periode, attachment,
                                DATE_FORMAT(a.date, '%d.%m.%Y') tgldate, 
                                DATE_FORMAT(a.last_update_date, '%d.%m.%Y %H:%i:%s') tgldibuat, 
                                (select name from dt01_gen_user_data where org_id=a.org_id and user_id=a.last_update_by)dibuatoleh,
                                (select provider from dt01_keu_provider_ms where org_id=a.org_id and provider_id=a.rekanan_id)rekanan,
                                (select coalesce(sum(nominal), 0) from dt01_keu_piutang_it  where org_id=a.org_id and piutang_id=a.piutang_id)jmlterbayar,
                                CONCAT(ELT(MONTH(STR_TO_DATE(periode, '%m.%Y')),'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'),' ',YEAR(STR_TO_DATE(periode, '%m.%Y'))) AS periode_indonesia,
                                
                                CASE 
                                    WHEN a.jenis_id = '1' THEN 'Rawat Jalan'
                                    WHEN a.jenis_id = '3' THEN 'Tagihan Klaim BPJS'
                                    WHEN a.jenis_id = '4' THEN 'Obat Kronis'
                                    WHEN a.jenis_id = '5' THEN 'Ambulance'
                                    WHEN a.jenis_id = '7' THEN 'Rawat Inap'
                                    ELSE 'Lainnya'
                                END AS jenistagihan,

                                -- Tambahan field bantu untuk ORDER BY
                                MONTH(STR_TO_DATE(periode, '%m.%Y')) bulan_order,
                                YEAR(STR_TO_DATE(periode, '%m.%Y')) tahun_order

                            from dt01_keu_piutang_hd a
                            where a.active = '1'
                            and   a.org_id='".$orgid."'
                            and   a.jenis_id in ('1','7')
                        ) x
                        order by rekanan_id asc, jenis_id asc, tahun_order asc, bulan_order asc;
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function historypembayaran($orgid,$tahun){
            $query =
                    "
                        SELECT 
                            a.piutang_id,
                            a.no_tagihan,
                            a.note,
                            a.rekanan_id,
                            a.nilai,
                            a.date,
                            p.provider,

                            -- Total nominal per bulan
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '01' THEN b.nominal ELSE 0 END) AS jml1,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '02' THEN b.nominal ELSE 0 END) AS jml2,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '03' THEN b.nominal ELSE 0 END) AS jml3,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '04' THEN b.nominal ELSE 0 END) AS jml4,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '05' THEN b.nominal ELSE 0 END) AS jml5,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '06' THEN b.nominal ELSE 0 END) AS jml6,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '07' THEN b.nominal ELSE 0 END) AS jml7,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '08' THEN b.nominal ELSE 0 END) AS jml8,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '09' THEN b.nominal ELSE 0 END) AS jml9,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '10' THEN b.nominal ELSE 0 END) AS jml10,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '11' THEN b.nominal ELSE 0 END) AS jml11,
                            SUM(CASE WHEN DATE_FORMAT(b.date, '%m') = '12' THEN b.nominal ELSE 0 END) AS jml12,

                            CONCAT(
                                    ELT(MONTH(STR_TO_DATE(periode, '%m.%Y')),
                                        'Januari','Februari','Maret','April','Mei','Juni',
                                        'Juli','Agustus','September','Oktober','November','Desember'),
                                    ' ',
                                    YEAR(STR_TO_DATE(periode, '%m.%Y'))
                                ) AS periode_indonesia,
                            CASE 
                                WHEN a.jenis_id = '1' THEN 'Rawat Jalan'
                                ELSE 'Rawat Inap'
                            END AS jenistagihan,

                            -- Tambahan total pembayaran tahun itu
                            SUM(COALESCE(b.nominal, 0)) AS total_terbayar,

                            -- Sisa tagihan
                            a.nilai - SUM(COALESCE(b.nominal, 0)) AS sisa_tagihan

                        FROM dt01_keu_piutang_hd a

                        LEFT JOIN dt01_keu_piutang_it b
                            ON a.piutang_id = b.piutang_id AND a.org_id = b.org_id
                            AND YEAR(b.date) = '".$tahun."' -- Tahun sebagai parameter

                        LEFT JOIN dt01_keu_provider_ms p
                            ON a.org_id = p.org_id AND a.rekanan_id = p.provider_id

                        WHERE a.org_id = '".$orgid."'
                        AND a.jenis_id = '1'

                        GROUP BY 
                            a.piutang_id, a.no_tagihan, a.note, a.rekanan_id, a.nilai, a.date, p.provider

                        ORDER BY 
                            p.provider ASC, a.date ASC;


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

        function insertpiutang($data){           
            $sql =   $this->db->insert("dt01_keu_piutang_hd",$data);
            return $sql;
        }

        function updatepiutang($piutangid,$data){           
            $sql =   $this->db->update("dt01_keu_piutang_hd",$data,array("piutang_id"=>$piutangid));
            return $sql;
        }

        function insertpembayaran($data){           
            $sql =   $this->db->insert("dt01_keu_piutang_it",$data);
            return $sql;
        }

        function insertrekening($data){           
            $sql =   $this->db->insert("dt01_keu_rekening_it",$data);
            return $sql;
        }
    }
?>