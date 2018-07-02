<?php
    include '../../config/koneksi.php';

    //$kdbarang = $_POST['nik_pemohon'];
    session_start();
    if ($_SESSION['role']=='kec') {
      $app = '0' ;
      
    } elseif ($_SESSION['role']='opr') {
      $app = '1' ;
    
    }
    
    $id = $_POST['id'];
    // $ambil = $_POST['tgl_ambil'];
    $ket = $_POST['ket'];
    mysqli_query($con,"update datang_header set flag_status = '$app', tgl_app = '' where id='$id'");
    mysqli_query($con,"INSERT INTO `riwayat_app` (`id`, `id_header`, `keterangan`, `tgl_app`, `flag_status`, `jenis_header`) VALUES (NULL, '$id', '$ket', CURRENT_TIMESTAMP, '$app', '1');");
    $c=mysqli_fetch_array(mysqli_query($con,"SELECT nik_pemohon,email_pemohon from datang_header where id =  '$id' "));
    
  	$nik_pemohon = $c['nik_pemohon'];
    echo "<script>alert('batal approve berhasi dengan NIK : ".$nik_pemohon." . ')</script>";
     // echo "<script type=\"text/javascript\">setTimeout(' window.location.href = \"../form_anggota.php?nik=$nik_pemohon\"; ',500);</script>";
      echo '<script>window.location="../list_datang.php"</script>';
  	// echo $nik_pemohon." - ".$id_datang." - ".$id;
    //header('location:../form_anggota.php?nik=$nik_pemohon');
    
?>
