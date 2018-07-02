<?php
$country  = (isset($_GET['NikAng']))? htmlspecialchars($_GET['NikAng']) :null;
include '../../config/koneksi.php';
$pegawai = mysqli_fetch_array(mysqli_query($con, "select nama_lgkp,no_prop,no_kab,no_kec,no_kel,nik from biodata_wni where nik='$country'"));
$data_pegawai = array('nama_lgkp'   	=>  $pegawai['nama_lgkp'],
							'nik'   	=>  $pegawai['nik'],);
 echo json_encode($data_pegawai);
 ?>