<?php
    class Modelindikatorunit extends CI_Model{
        
        function periode(){
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

        function masterindikator($orgid,$periode,$department){
            $query = "
                        select a.mutu, definisi_operasional, numerator, denumerator, dimensi_mutu, tujuan, dasar_pemikiran, kriteria_inklusi, kriteria_eksklusi, formula,
                                metode_pengumpulan_data, sumber_data, instrumen_pengambilan_data, sampel, penyajian_data,
                                (select color       from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Mutu_1' and code=a.jenis_indikator)colorjenisindikator,
                                (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Mutu_1' and code=a.jenis_indikator)namejenisindikator,
                                (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Mutu_1' and code=a.periode_pengumpulan_data)periode_pengumpulan_data,
                                (select master_name from dt01_gen_master_ms where org_id=a.org_id and jenis_id='Mutu_1' and code=a.periode_analisis_pelaporan)periode_analisis_pelaporan

                        from dt01_mutu_ms a
                        where a.active='1'
                        and   a.org_id='".$orgid."'
                        and   a.mutu_id in (select mutu_id from dt01_mutu_unit_hd where active='1' and org_id='".$orgid."' and periode='".$periode."' $department)
                        order by jenis_indikator, mutu
                    ";

            $recordset = $this->db->query($query);
            return $recordset->result();
        }

    }
?>