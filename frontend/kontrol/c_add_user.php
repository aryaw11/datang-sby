<?php
    include '../../config/koneksi.php';

    //$kdbarang = $_POST['nik_pemohon'];
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $kecamatan = $_POST['kecamatan'];
    mysqli_query($con,"INSERT INTO `users` (`uid`, `user`, `pass`, `email`, `role`, `kec`) VALUES (NULL, '$username', '$password', '$email', 'kec', '$kecamatan');");
    echo '<script>window.location="../manajemen_user.php"</script>';
  	// echo $nik_pemohon." - ".$id_datang." - ".$id;
    //header('location:../form_anggota.php?nik=$nik_pemohon');
    
?>
