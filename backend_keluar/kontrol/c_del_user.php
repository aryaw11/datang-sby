<?php
    include '../../config/koneksi.php';
    //$kdbarang = $_POST['nik_pemohon'];
    // $id_datang = $_POST['id_datang'];
    $id = $_POST['id'];
    mysqli_query($con,"delete from users where uid='$id'");

  	// echo $nik_pemohon." - ".$id_datang." - ".$id;
    header('location:../manajemen_user.php');

?>
