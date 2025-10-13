<?php
    class Modelabsensi extends CI_Model{

        function reportpresence($orgid,$userid){
            $query =
                    "
                        WITH RECURSIVE calendar AS (
                            SELECT DATE(CONCAT('2025-', LPAD('10', 2, '0'), '-01')) AS tanggal
                            UNION ALL
                            SELECT DATE_ADD(tanggal, INTERVAL 1 DAY)
                            FROM calendar
                            WHERE tanggal < LAST_DAY(CONCAT('2025-', LPAD('10', 2, '0'), '-01'))
                        )
                        select X.*,
                            (select color from dt01_hrd_code_shift_ms where shift_id=x.shiftid)colorshift,
                            (select code from dt01_hrd_code_shift_ms where shift_id=x.shiftid)codeshift,
                            (select jam_masuk from dt01_hrd_code_shift_ms where shift_id=x.shiftid)jammasuk,
                            (select jam_keluar from dt01_hrd_code_shift_ms where shift_id=x.shiftid)jamkeluar,
                            (select TIME(MIN(a.tgl_jam)) from dt01_hrd_receive_absen a where a.org_id='".$orgid."' and a.user_id='".$userid."' and DATE(a.tgl_jam) = STR_TO_DATE(X.periode, '%d.%m.%Y'))realjammasuk,
                            (select TIME(MAX(a.tgl_jam)) from dt01_hrd_receive_absen a where a.org_id='".$orgid."' and a.user_id='".$userid."' and DATE(a.tgl_jam) = STR_TO_DATE(X.periode, '%d.%m.%Y'))realjamkeluar,
                            (select latitude   from dt01_hrd_receive_absen a where a.org_id='".$orgid."' and a.user_id='".$userid."' and DATE(a.tgl_jam) = STR_TO_DATE(X.periode, '%d.%m.%Y') order by a.tgl_jam asc limit 1)latjammasuk,
                            (select longtitude from dt01_hrd_receive_absen a where a.org_id='".$orgid."' and a.user_id='".$userid."' and DATE(a.tgl_jam) = STR_TO_DATE(X.periode, '%d.%m.%Y') order by a.tgl_jam asc limit 1)longjammasuk,
                            (select latitude   from dt01_hrd_receive_absen a where a.org_id='".$orgid."' and a.user_id='".$userid."' and DATE(a.tgl_jam) = STR_TO_DATE(X.periode, '%d.%m.%Y') order by a.tgl_jam desc limit 1)latjamkeluar,
                            (select longtitude from dt01_hrd_receive_absen a where a.org_id='".$orgid."' and a.user_id='".$userid."' and DATE(a.tgl_jam) = STR_TO_DATE(X.periode, '%d.%m.%Y') order by a.tgl_jam desc limit 1)longjamkeluar,
                            (select transaksi_id   from dt01_hrd_receive_absen a where a.org_id='".$orgid."' and a.user_id='".$userid."' and DATE(a.tgl_jam) = STR_TO_DATE(X.periode, '%d.%m.%Y') order by a.tgl_jam asc limit 1)transmasuk,
                            (select transaksi_id from dt01_hrd_receive_absen a where a.org_id='".$orgid."' and a.user_id='".$userid."' and DATE(a.tgl_jam) = STR_TO_DATE(X.periode, '%d.%m.%Y') order by a.tgl_jam desc limit 1)transkeluar
                        FROM(
                            SELECT DATE_FORMAT(tanggal, '%d.%m.%Y') AS periode,
                                DATE_FORMAT(tanggal, '%d') AS date,
                                DATE_FORMAT(tanggal, '%m') AS month,
                                DATE_FORMAT(tanggal, '%Y') AS year,
                                DATE_FORMAT(tanggal, '%W') AS days,
                                (
                                    select  CASE DAY(tanggal)
                                            WHEN 1 THEN h1
                                            WHEN 2 THEN h2
                                            WHEN 3 THEN h3
                                            WHEN 4 THEN h4
                                            WHEN 5 THEN h5
                                            WHEN 6 THEN h6
                                            WHEN 7 THEN h7
                                            WHEN 8 THEN h8
                                            WHEN 9 THEN h9
                                            WHEN 10 THEN h10
                                            WHEN 11 THEN h11
                                            WHEN 12 THEN h12
                                            WHEN 13 THEN h13
                                            WHEN 14 THEN h14
                                            WHEN 15 THEN h15
                                            WHEN 16 THEN h16
                                            WHEN 17 THEN h17
                                            WHEN 18 THEN h18
                                            WHEN 19 THEN h19
                                            WHEN 20 THEN h20
                                            WHEN 21 THEN h21
                                            WHEN 22 THEN h22
                                            WHEN 23 THEN h23
                                            WHEN 24 THEN h24
                                            WHEN 25 THEN h25
                                            WHEN 26 THEN h26
                                            WHEN 27 THEN h27
                                            WHEN 28 THEN h28
                                            WHEN 29 THEN h29
                                            WHEN 30 THEN h30
                                            WHEN 31 THEN h31
                                            END
                                    from dt01_hrd_jadwal_shift_dt
                                    where bulan=DATE_FORMAT(tanggal, '%m')
                                    and tahun=DATE_FORMAT(tanggal, '%Y')
                                    and org_id='".$orgid."'
                                    and user_id='".$userid."'
                                )shiftid
                            FROM calendar
                        )X
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>