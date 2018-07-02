<?php
$country  = (isset($_GET['NikTujuan']))? htmlspecialchars($_GET['NikTujuan']) :null;
include '../../config/koneksi.php';
$pegawai = mysqli_fetch_array(mysqli_query($con, "SELECT b.nik , b. nama_lgkp , (SELECT p.nama_prov FROM provinsi p WHERE p.no_prov= b.no_prop ) AS nama_prov , 
(SELECT k.nama_kab FROM kabupaten k WHERE k.no_prov= b.no_prop AND k.no_kab =b.no_kab) AS nama_kab ,
 (SELECT h.nama_kec FROM kecamatan h WHERE h.no_prov= b.no_prop AND h.no_kab =b.no_kab AND h.no_kec=b.no_kec) AS nama_kec ,
  (SELECT r.nama_kel FROM kelurahan r WHERE r.no_prov= b.no_prop AND r.no_kab =b.no_kab AND r.no_kec=b.no_kec
   AND r.no_kel = b.no_kel) AS nama_kel , b.alamat , b.no_rt , b.no_rw , b.no_kk 
   FROM biodata_wni b WHERE b.nik='$country'"));
$data_pegawai = array('nama_lgkp'   	=>  $pegawai['nama_lgkp'],
              		 
                    'no_kec'            =>  $pegawai['nama_kec'],
                    'no_kel'            =>  $pegawai['nama_kel'],
                    'no_rw'            =>  $pegawai['no_rw'],
            		'no_rt'            =>  $pegawai['no_rt'],
            		'alamat'            =>  $pegawai['alamat'],
                );
 echo json_encode($data_pegawai);
 ?>