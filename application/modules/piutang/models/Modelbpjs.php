<?php
    class Modelbpjs extends CI_Model{

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

        function jenistagihan(){
            $query =
                    "
                        select '3'jenisid, 'Tagihan Klaim BPJS'keterangan union
                        select '4'jenisid, 'Obat Kronis'keterangan union
                        select '5'jenisid, 'Ambulance'keterangan
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
                        and   a.provider_id='20a4818e-cd3a-4694-889c-b5f5d6aafe7e'
                        order by provider asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

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

        function datapiutang($orgid){
            $query =
                    "
                        SELECT x.*,
                            nilai - jmlterbayar AS sisa
                        FROM (
                            SELECT 
                                a.piutang_id, 
                                no_tagihan, 
                                rekanan_id, 
                                DATE_FORMAT(a.date, '%d.%m.%Y') AS tgldate, 
                                note, 
                                nilai, 
                                jenis_id,
                                periode,
                                -- Format Indonesia
                                CONCAT(
                                    ELT(MONTH(STR_TO_DATE(periode, '%m.%Y')),
                                        'Januari','Februari','Maret','April','Mei','Juni',
                                        'Juli','Agustus','September','Oktober','November','Desember'),
                                    ' ',
                                    YEAR(STR_TO_DATE(periode, '%m.%Y'))
                                ) AS periode_indonesia,
                                
                                (SELECT provider 
                                FROM dt01_keu_provider_ms 
                                WHERE org_id = a.org_id AND provider_id = a.rekanan_id) AS rekanan,

                                (SELECT COALESCE(SUM(nominal), 0) 
                                FROM dt01_keu_piutang_it 
                                WHERE org_id = a.org_id AND piutang_id = a.piutang_id) AS jmlterbayar,

                                CASE 
                                    WHEN a.jenis_id = '3' THEN 'Tagihan Klaim BPJS'
                                    WHEN a.jenis_id = '4' THEN 'Obat Kronis'
                                    WHEN a.jenis_id = '5' THEN 'Ambulance'
                                    ELSE 'Lainnya'
                                END AS jenistagihan,

                                -- Tambahan field bantu untuk ORDER BY
                                MONTH(STR_TO_DATE(periode, '%m.%Y')) AS bulan_order,
                                YEAR(STR_TO_DATE(periode, '%m.%Y')) AS tahun_order

                            FROM dt01_keu_piutang_hd a
                            WHERE a.active = '1'
                            and   a.org_id='".$orgid."'
                            AND a.jenis_id IN ('3','4','5')
                        ) x
                        ORDER BY jenis_id ASC, tahun_order ASC, bulan_order ASC;

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
                            a.jenis_id,
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
                                WHEN a.jenis_id = '3' THEN 'Tagihan Klaim BPJS'
                                WHEN a.jenis_id = '4' THEN 'Obat Kronis'
                                WHEN a.jenis_id = '5' THEN 'Ambulance'
                                ELSE 'Lainnya'
                            END AS jenistagihan,

                            MONTH(STR_TO_DATE(periode, '%m.%Y')) AS bulan_order,
                            YEAR(STR_TO_DATE(periode, '%m.%Y')) AS tahun_order,

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
                        AND a.jenis_id in ('3','4','5')

                        GROUP BY 
                            a.piutang_id, a.no_tagihan, a.note, a.rekanan_id, a.nilai, a.date, p.provider

                        ORDER BY a.jenis_id ASC, tahun_order ASC, bulan_order ASC;


                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function insertpiutang($data){           
            $sql =   $this->db->insert("dt01_keu_piutang_hd",$data);
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