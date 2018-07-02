<?php
include '../../config/koneksi.php';
 
$kec = mysqli_query($con,"SELECT a.nik_pemohon , b.nama_lgkp
FROM datang_header a , biodata_wni b
WHERE a.nik_pemohon = b.nik AND a.is_delete = '0' AND a.nik_pemohon LIKE '%".$_GET['q']."%' OR b.nama_lgkp LIKE '%".$_GET['q']."%'  ");

$json = [];
while($k = mysqli_fetch_array($kec)){
     $json[] = ['id'=>$k['nik_pemohon'], 'text'=>$k['nik_pemohon']." - ".$k['nama_lgkp']];
}


echo json_encode($json);
?>