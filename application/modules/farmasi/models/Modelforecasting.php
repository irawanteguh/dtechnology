<?php
    class Modelforecasting extends CI_Model{

        function periode(){
            $query =
                    "
                        WITH bulan_urut AS (
                        SELECT DISTINCT LAST_DAY(tgl_registrasi) AS periode_akhir
                        FROM reg_periksa
                        ),
                        urutan AS (
                        SELECT 
                            periode_akhir,
                            DATE_FORMAT(periode_akhir, '%M %Y') AS keterangan,
                            DATE_FORMAT(periode_akhir, '%m.%Y') AS p4,
                            DATE_FORMAT(DATE_SUB(periode_akhir, INTERVAL 1 MONTH), '%m.%Y') AS p3,
                            DATE_FORMAT(DATE_SUB(periode_akhir, INTERVAL 2 MONTH), '%m.%Y') AS p2,
                            DATE_FORMAT(DATE_SUB(periode_akhir, INTERVAL 3 MONTH), '%m.%Y') AS p1
                        FROM bulan_urut
                        )
                        SELECT 
                        CONCAT(p1, ';', p2, ';', p3, ';', p4) AS periodeid,
                        keterangan
                        FROM urutan
                        ORDER BY periode_akhir DESC;

                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

        function forecasting($bulan1,$bulan2,$bulan3,$bulan4){
            $query =
                    "
                        select x.*,
                            ((bulan_1+bulan_2+bulan_3+bulan_4)/4) ratarata,
                            (pemesanan+stok)total
                        from(
                            select a.kode_brng, nama_brng,
                                (select nama from kategori_barang where kode=a.kode_kategori)kategori,
                                (select nama_industri from industrifarmasi where kode_industri =a.kode_industri)industri,
                                
                                (select coalesce(sum(jml),0)    from detail_pemberian_obat where kode_brng=a.kode_brng and date_format(tgl_perawatan,'%m.%Y')='".$bulan1."')+
                                (select coalesce(sum(jumlah),0) from detailjual where kode_brng=a.kode_brng and nota_jual in (select nota_jual from penjualan where date_format(tgl_jual,'%m.%Y')='".$bulan1."'))
                                bulan_1,
                                
                                (select coalesce(sum(jml),0)    from detail_pemberian_obat where kode_brng=a.kode_brng and date_format(tgl_perawatan,'%m.%Y')='".$bulan2."')+
                                (select coalesce(sum(jumlah),0) from detailjual where kode_brng=a.kode_brng and nota_jual in (select nota_jual from penjualan where date_format(tgl_jual,'%m.%Y')='".$bulan2."'))
                                bulan_2,
                                
                                (select coalesce(sum(jml),0)    from detail_pemberian_obat where kode_brng=a.kode_brng and date_format(tgl_perawatan,'%m.%Y')='".$bulan3."')+
                                (select coalesce(sum(jumlah),0) from detailjual where kode_brng=a.kode_brng and nota_jual in (select nota_jual from penjualan where date_format(tgl_jual,'%m.%Y')='".$bulan3."'))
                                bulan_3,
                                
                                (select coalesce(sum(jml),0)    from detail_pemberian_obat where kode_brng=a.kode_brng and date_format(tgl_perawatan,'%m.%Y')='".$bulan4."')+
                                (select coalesce(sum(jumlah),0) from detailjual where kode_brng=a.kode_brng and nota_jual in (select nota_jual from penjualan where date_format(tgl_jual,'%m.%Y')='".$bulan4."'))
                                bulan_4,
                                
                                (select coalesce(sum(jumlah),0) from detailpesan where kode_brng=a.kode_brng and no_faktur in (select no_faktur from pemesanan where date_format(tgl_faktur,'%m.%Y')='".$bulan4."'))
                                pemesanan,
                                
                                (select coalesce(sum(stok),0) from gudangbarang where kode_brng=a.kode_brng)
                                stok
                            from databarang a
                            where a.status='1'
                        )x
                        order by nama_brng asc



                    ";

            $recordset = $this->db->query($query);
            $recordset = $recordset->result();
            return $recordset;
        }

    }
?>