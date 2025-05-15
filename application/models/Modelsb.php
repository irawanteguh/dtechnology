<?php
    class Modelsb extends CI_Model{

        function dataquickreport(){
            $query =
                    "
                        select a.tgl_registrasi,
                            sum(case when a.kd_pj='BPJ' and a.status_lanjut ='Ralan' then 1 else 0 end)kunjunganbpjsrj,
                            sum(case when a.kd_pj='BPJ' and a.status_lanjut ='Ranap' then 1 else 0 end)kunjunganbpjsri,
                            sum(case when a.kd_pj='A09' and a.status_lanjut ='Ralan' then 1 else 0 end)kunjunganumumrj,
                            sum(case when a.kd_pj='A09' and a.status_lanjut ='Ranap' then 1 else 0 end)kunjunganumumri,
                            sum(case when a.kd_pj not in ('BPJ','A09') and a.status_lanjut ='Ralan' then 1 else 0 end)kunjunganasuransirj,
                            sum(case when a.kd_pj not in ('BPJ','A09') and a.status_lanjut ='Ranap' then 1 else 0 end)kunjunganasuransiri

                        from reg_periksa a
                        where a.stts<>'Batal'
                        and   a.tgl_registrasi BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE()
                        group by tgl_registrasi
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        
        
    }
?>