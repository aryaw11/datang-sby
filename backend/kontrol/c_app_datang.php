<?php
    include '../../config/koneksi.php';
    include('../../config/phpmailer/class.phpmailer.php');
    include('../../config/phpmailer/class.smtp.php');
    //$kdbarang = $_POST['nik_pemohon'];
    session_start();
    if ($_SESSION['role']=='kec') {
      $app = '1' ;
      $psn = " berkas permohonan anda sudah di accept pihak kecamatan selanjutnya tunggu proses dispenduk";
      $dari= 'kecamatan';
    } elseif ($_SESSION['role']='opr') {
      $app = '2' ;
      $psn = "Berkas permohonan anda sudah di setujui oleh dispenduk, silahkan besok ambil di kecamatan";
      $dari = 'operator dispendukcapil';
    }
    $tgl = date('Y-m-d H:i:s');
    $id = $_POST['id'];
    $ambil = $_POST['tgl_ambil'];
    $ket = $_POST['ket'];
    mysqli_query($con,"update datang_header set flag_status = '$app' , tgl_app = '$tgl' where id='$id'");
    mysqli_query($con,"INSERT INTO `riwayat_app` (`id`, `id_header`, `keterangan`, `tgl_app`, `flag_status`, `jenis_header`) VALUES (NULL, '$id', '$ket', CURRENT_TIMESTAMP, '$app', '1');");
    $c=mysqli_fetch_array(mysqli_query($con,"SELECT nik_pemohon,email_pemohon,(SELECT nama_lgkp FROM biodata_wni WHERE biodata_wni.`NIK`=datang_header.`NIK_PEMOHON`) AS nama_lgkp FROM datang_header WHERE id = '$id' "));
  	$nik_pemohon = $c['nik_pemohon'];
    $nama = $c['nama_lgkp'];

    // email
    $subjek="PENDAFTARAN PERMOHONAN PINDAH DATANG DISPENDUKCAPIL";
    $body             = 
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PERMOHONAN SKTT ONLINE</title>
   
  <style type="text/css">
  @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

  /* Take care of image borders and formatting */

  img {
    max-width: 600px;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  a {
    text-decoration: none;
    border: 0;
    outline: none;
    color: #bbbbbb;
  }

  a img {
    border: none;
  }

  /* General styling */

  td, h1, h2, h3  {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
  }

  td {
    text-align: center;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #37302d;
    background: #ffffff;
    font-size: 16px;
  }

   table {
    border-collapse: collapse !important;
  }

  .headline {
    color: #ffffff;
    font-size: 36px;
  }

 .force-full-width {
  width: 100% !important;
 }

 .force-width-80 {
  width: 80% !important;
 }




  </style>

  <style type="text/css" media="screen">
      @media screen {
         /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
        td, h1, h2, h3 {
          font-family: \'Droid Sans\', \'Helvetica Neue\', \'Arial\', \'sans-serif\' !important;
        }
      }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
      }

      td[class="mobile-block"] {
        width: 100% !important;
        display: block !important;
      }


    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" class="force-full-width" height="100%" >
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
      <center>
        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
          <tr>
            <td align="center" valign="top">

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" style="margin:0 auto;">
                  <tr>
                    <td style="font-size: 30px; text-align:center;">
                      <br>
                        PERMOHONAN PINDAH DATANG
                      <br>
                      <br>
                    </td>
                  </tr>
                </table>

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#4dbfbf">
                  <tr>
                    <td>
                    <br>
                      <img src="http://dispendukcapil.surabaya.go.id/templates/ja_corona/images/logo.png"  alt="robot picture">
                    </td>
                  </tr>
                  <tr>
                    <td class="headline">
                      Good News!
                    </td>
                  </tr>
                  <tr>
                    <td>

                      <center>
                        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
                          <tr>
                            <td style="color:#187272;">
                            <br><b>'.$psn.'</b>
                             
                            <br>
                            <br>
                            </td>
                          </tr>
                        </table>
                      </center>

                    </td>
                  </tr>
                   
                </table>

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#f5774e">
                  <tr>
                    <td style="background-color:#f5774e;">

                    <center>
                      <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                        <tr>
                           
                          <td style="text-align:right; vertical-align:top; color:#933f24">
                          <br>
                          <br>
                            <span style="color:#ffffff;">'.$tgl.'</span> <br>
                            
                          </td>
                        </tr>
                      </table>


                      <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                        <tr>
                          <td  class="mobile-block" >
                          <br>
                          <br>

                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="color:#ffffff; background-color:#ac4d2f; padding: 10px 0px;">
                                 '.$nama.'
                                </td>
                              </tr>
                              <tr>
                                <td style="color:#ffffff; padding:10px 0px; background-color: #f7a084;">
                                  '.$nik_pemohon.'
                                </td>
                              </tr>
                            </table>

                            <br>
                          </td>
                        </tr>
                      </table>



                      <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                        <tr>
                          <td style="text-align:left; color:#933f24;">
                          <br>
                            Thank you for your participant. Please <a style="color:#ffffff;" href="http://dispendukcapil.surabaya.go.id/">contact us</a> with any questions regarding your order.
                          <br>
                          
                          <br>
                          <br>
                          </td>
                        </tr>
                      </table>
                    </center>



                    </td>
                  </tr>


                </table>

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
                   
                  <tr>
                    <td style="color:#bbbbbb; font-size:12px;">
                       © 2018 All Rights Reserved
                       <br>
                       <br>
                    </td>
                  </tr>
                </table>





            </td>
          </tr>
        </table>
    </center>
    </td>
  </tr>
</table>
</body>
</html>';
        $body             = eregi_replace("[\]",'',$body);

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
    $mail->FromName = $dari;
    $mail->AddAddress($email,$name);
    $mail->AddReplyTo($webmaster_email,$dari);
    //$mail->AddAttachment("module.txt"); // attachment
    //$mail->AddAttachment("new.jpg"); // attachment
    // $mail->IsHTML(true); 
    $mail->Subject = $subjek;
    $mail->MsgHTML($body);
    //$mail->Body = $pesan; 
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
