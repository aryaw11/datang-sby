<?php
    include '../../config/koneksi.php';

    //$kdbarang = $_POST['nik_pemohon'];
    
    $id = $_POST['id'];
    $user = $_POST['user'];
    $note = $_POST['note'];
    mysqli_query($con,"INSERT INTO `note` (`id_datang`, `id_user`, `catatan` ,`jenis`) VALUES ('$id', '$user', '$note','1');");
    echo '<script>window.location="../list_datang.php"</script>';
    
?>
