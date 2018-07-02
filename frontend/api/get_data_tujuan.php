<?php
include '../../config/koneksi.php';
 
$kec = mysqli_query($con,"SELECT NIK, NAMA_LGKP,ID FROM BIODATA_WNI WHERE NIK LIKE '%".$_GET['q']."%' OR NAMA_LGKP LIKE '%".$_GET['q']."%'  ");

$json = [];
while($k = mysqli_fetch_array($kec)){
     $json[] = ['id'=>$k['NIK'], 'text'=>$k['NIK']." - ".$k['NAMA_LGKP']];
}


echo json_encode($json);
?>