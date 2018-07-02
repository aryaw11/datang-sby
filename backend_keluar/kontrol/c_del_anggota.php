<?php
    include '../../config/koneksi.php';
    //$kdbarang = $_POST['nik_pemohon'];
    $id_keluar = $_POST['id_keluar'];
    $id = $_POST['id'];
    mysqli_query($con,"delete from keluar_detail where id='$id'");
    $c=mysqli_fetch_array(mysqli_query($con,"SELECT nik_pemohon from keluar_header where id =  '$id_keluar' "));
  	$nik_pemohon = $c['nik_pemohon'];
  	// echo $nik_pemohon." - ".$id_datang." - ".$id;
    //header('location:../form_anggota.php?nik=$nik_pemohon');
     echo "<script type=\"text/javascript\">setTimeout(' window.location.href = \"../form_anggota.php?nik=$nik_pemohon\"; ',500);</script>";
?>
