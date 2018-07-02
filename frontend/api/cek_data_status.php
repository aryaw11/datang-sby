<?php
$country  = (isset($_GET['itemNik']))? htmlspecialchars($_GET['itemNik']) :null;
include '../../config/koneksi.php';
$sql = "SELECT b.NIK_PEMOHON , 
(SELECT f.NAMA_LGKP FROM biodata_wni f WHERE f.nik = b.`NIK_PEMOHON`) AS NAMA_LGKP ,
b.NO_FORM,b.SWNI,b.EMAIL_PEMOHON,b.NIK_KEPKEL_TUJUAN,
(SELECT z.NAMA_LGKP FROM biodata_wni z WHERE z.nik = b.`NIK_KEPKEL_TUJUAN`) AS NAMA_LGKP_TUJUAN ,
(SELECT (SELECT h.nama_kec FROM kecamatan h WHERE h.no_prov= v.no_prop AND h.no_kab =v.no_kab AND h.no_kec=v.no_kec) FROM biodata_wni v WHERE v.nik = b.`NIK_KEPKEL_TUJUAN`) AS NAMA_KEC ,
(SELECT (SELECT r.nama_kel FROM kelurahan r WHERE r.no_prov= s.no_prop AND r.no_kab =s.no_kab AND r.no_kec=s.no_kec
   AND r.no_kel = s.no_kel) FROM biodata_wni s WHERE s.nik = b.`NIK_KEPKEL_TUJUAN`) AS NAMA_KEL ,
   (SELECT d.ALAMAT FROM biodata_wni d WHERE d.nik = b.`NIK_KEPKEL_TUJUAN`) AS ALAMAT ,
   (SELECT e.NO_RT FROM biodata_wni e WHERE e.nik = b.`NIK_KEPKEL_TUJUAN`) AS NO_RT,
   (SELECT t.NO_RW FROM biodata_wni t WHERE t.nik = b.`NIK_KEPKEL_TUJUAN`) AS NO_RW , b.FLAG_STATUS 
FROM datang_header b WHERE IS_DELETE= '0' AND b.NIK_PEMOHON='$country'";
// echo $sql;
$pegawai = mysqli_fetch_array(mysqli_query($con, $sql ));
$alamat="Kecamatan ".$pegawai['NAMA_KEC']." Kelurahan ".$pegawai['NAMA_KEL']." Alamat ".$pegawai['ALAMAT']." RT".$pegawai['NO_RT']."/RW".$pegawai['NO_RW'];

if ($pegawai['FLAG_STATUS']=='0') {
  $status = "proses";
} elseif ($pegawai['FLAG_STATUS']=='1') {
  $status = "approve kecamatan";
} elseif ($pegawai['FLAG_STATUS']=='2') {
  $status = "approve operator dispenduk";
} else {
  $status = "proses";
}
$data_pegawai = array('nama_lgkp'     =>  $pegawai['NAMA_LGKP'],
                   
                    'no_form'            =>  $pegawai['NO_FORM'],
                    'swni'            =>  $pegawai['SWNI'],
                    'email'            =>  $pegawai['EMAIL_PEMOHON'],
                'nik_tujuan'            =>  $pegawai['NIK_KEPKEL_TUJUAN'],
                'nama_lgkp_tujuan'            =>  $pegawai['NAMA_LGKP_TUJUAN'],
                'alamat'            =>  $alamat,
                'status'            =>  $status,
                );
 echo json_encode($data_pegawai);
 ?>