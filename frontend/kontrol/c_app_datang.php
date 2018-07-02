<?php
    include '../../config/koneksi.php';
    include('../../config/phpmailer/class.phpmailer.php');
    include('../../config/phpmailer/class.smtp.php');
    //$kdbarang = $_POST['nik_pemohon'];
    session_start();
    if ($_SESSION['role']=='kec') {
      $app = '1' ;
      $psn = "kecamatan";
    } elseif ($_SESSION['role']='opr') {
      $app = '2' ;
      $psn = "operator dispendukcapil";
    }
    $tgl = date('Y-m-d H:i:s');
    $id = $_POST['id'];
    mysqli_query($con,"update datang_header set flag_status = '$app' , tgl_app = '$tgl' where id='$id'");
    $c=mysqli_fetch_array(mysqli_query($con,"SELECT nik_pemohon,email_pemohon from datang_header where id =  '$id' "));
  	$nik_pemohon = $c['nik_pemohon'];

    // email
    $subjek="PENDAFTARAN PERMOHONAN PINDAH DATANG DISPENDUKCAPIL";
    $pesan="Permohonan anda sudah di approve oleh ".$psn;

    $mail = new PHPMailer();

    $mail->Host     = "ssl://smtp.gmail.com"; 
    $mail->Mailer   = "smtp";
    $mail->SMTPAuth = true; 

    $mail->Username = "noreply.elampid@gmail.com"; 
    $mail->Password = "tanyapakanang";
    $webmaster_email = "11aryaw@gmail.com"; 
    $email = $c['email_pemohon'];
    $name =  $c['nik_pemohon'];
    $mail->From = $webmaster_email;
    $mail->FromName = $psn;
    $mail->AddAddress($email,$name);
    $mail->AddReplyTo($webmaster_email,$psn);
    $mail->WordWrap = 50; 
    //$mail->AddAttachment("module.txt"); // attachment
    //$mail->AddAttachment("new.jpg"); // attachment
    $mail->IsHTML(true); 
    $mail->Subject = $subjek;
    $mail->Body = $pesan; 
    $mail->AltBody = "This is the body when user views in plain text format"; 
    if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    echo "<script>alert('approve berhasi dengan NIK : ".$nik_pemohon." , pemohon akan menerima notif di email ')</script>";
     // echo "<script type=\"text/javascript\">setTimeout(' window.location.href = \"../form_anggota.php?nik=$nik_pemohon\"; ',500);</script>";
      echo '<script>window.location="../list_datang.php"</script>';
    }
    else
    {
    echo "<script>alert('approve berhasi dengan NIK : ".$nik_pemohon." , pemohon akan menerima notif di email ')</script>";
     // echo "<script type=\"text/javascript\">setTimeout(' window.location.href = \"../form_anggota.php?nik=$nik_pemohon\"; ',500);</script>";
      echo '<script>window.location="../list_datang.php"</script>';
    }

  	// echo $nik_pemohon." - ".$id_datang." - ".$id;
    //header('location:../form_anggota.php?nik=$nik_pemohon');
    
?>
