<?php
    class Modelhistory extends CI_Model{

        function daftarpasien($parameter){
            $query =
                    "
                        select a.no_rkm_medis, nm_pasien, no_ktp, nm_ibu, alamat,
                            date_format(a.tgl_lahir, '%d.%m.%Y')tgllahir,
                            case when a.jk = 'L' then 'Laki-laki' else 'Perempuan' end jeniskelamin
                        from pasien a
                        where a.no_rkm_medis='".$parameter."' or upper(a.nm_pasien) like upper('%".$parameter."%')
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function daftaralergipasien(){
            $query =
                    "
                        select a.alergi
                        from catatan_pasien a
                        where a.alergi<>''
                        and   a.alergi<>'-'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function soapie(){
            $query =
                    "
                        select a.*,
                               (select nama from pegawai where nik=a.nip)nama
                        from pemeriksaan_ranap a
                        where a.no_rawat='2024/11/10/000080'
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function catatanperawat(){
            $query =
                    "
                        select a.tanggal, jam, uraian,
                            (select nama from pegawai where nik=a.nip)nama
                        from catatan_keperawatan_ranap a
                        where a.no_rawat='2024/11/10/000080'
                        order by a.tanggal asc, jam asc
                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }


    }
?>