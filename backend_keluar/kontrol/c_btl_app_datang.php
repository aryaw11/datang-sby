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
    mysqli_query($con,"update keluar_header set flag_status = '$app' where id='$id'");
    $c=mysqli_fetch_array(mysqli_query($con,"SELECT nik_pemohon,email_pemohon from keluar_header where id =  '$id' "));
  	$nik_pemohon = $c['nik_pemohon'];
    echo "<script>alert('batal approve berhasi dengan NIK : ".$nik_pemohon." . ')</script>";
     // echo "<script type=\"text/javascript\">setTimeout(' window.location.href = \"../form_anggota.php?nik=$nik_pemohon\"; ',500);</script>";
      echo '<script>window.location="../list_datang.php"</script>';
  	// echo $nik_pemohon." - ".$id_datang." - ".$id;
    //header('location:../form_anggota.php?nik=$nik_pemohon');
    
?>
