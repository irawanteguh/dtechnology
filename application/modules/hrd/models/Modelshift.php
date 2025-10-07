<?php
    class Modelshift extends CI_Model{
        function jadwalshift($orgid){
            $query =
                    "
                        SELECT 
                            a.transaksi_id,
                            a.user_id,
                            (SELECT name FROM dt01_gen_user_data WHERE active='1' AND user_id=a.user_id) AS name,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h1) AS h1,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h2) AS h2,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h3) AS h3,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h4) AS h4,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h5) AS h5,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h6) AS h6,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h7) AS h7,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h8) AS h8,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h9) AS h9,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h10) AS h10,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h11) AS h11,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h12) AS h12,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h13) AS h13,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h14) AS h14,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h15) AS h15,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h16) AS h16,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h17) AS h17,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h18) AS h18,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h19) AS h19,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h20) AS h20,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h21) AS h21,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h22) AS h22,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h23) AS h23,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h24) AS h24,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h25) AS h25,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h26) AS h26,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h27) AS h27,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h28) AS h28,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h29) AS h29,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h30) AS h30,
                            (SELECT CONCAT(jam_masuk,';',jam_keluar,';',code,';',color) FROM dt01_hrd_code_shift_ms WHERE active='1' AND shift_id=a.h31) AS h31
                        FROM dt01_hrd_jadwal_shift_dt a
                        WHERE a.org_id='".$orgid."'
                        AND a.tahun='2025'
                        AND a.bulan='09'
                        ORDER BY name ASC;
      
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>