<?php include"header.php"; 
include '../config/koneksi.php';
$nik = $_GET['nik'];
$ketemu=mysqli_fetch_array(mysqli_query($con,"SELECT id,flag_status from datang_header where NIK_PEMOHON =  '$nik' "));
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
  $nikpemohon = $_GET['nik'];

//KK yang ditumpangi
  if (!empty($_FILES["FILE_KK_PINDAH"]["name"])) {
    $filename1 = $_FILES["FILE_KK_PINDAH"]["name"];
    $file_basename1 = substr($filename1, 0, strripos($filename1, '.')); // get file extention
    $file_ext1 = substr($filename1, strripos($filename1, '.')); // get file name
    $filesize1 = $_FILES["FILE_KK_PINDAH"]["size"];
    $newfilename1 = "FILE_KK_PINDAH - ".$nikpemohon . $file_ext1;  
    move_uploaded_file($_FILES["FILE_KK_PINDAH"]["tmp_name"], "../public/datang/" . $newfilename1);
    $FILE_KK_PINDAH="UPDATE `datang_header` SET `FILE_KK_PINDAH` = '$newfilename1' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
    mysqli_query($con,$FILE_KK_PINDAH);
  }
  //FILE_SKPWNI
  if (!empty($_FILES["FILE_SKPWNI"]["name"])) {
   $filename2 = $_FILES["FILE_SKPWNI"]["name"];
  $file_basename2 = substr($filename2, 0, strripos($filename2, '.')); // get file extention
  $file_ext2 = substr($filename2, strripos($filename2, '.')); // get file name
  $filesize2 = $_FILES["FILE_SKPWNI"]["size"];
  $newfilename2 = "FILE_SKPWNI - ".$nikpemohon . $file_ext2;  
  move_uploaded_file($_FILES["FILE_SKPWNI"]["tmp_name"], "../public/datang/" . $newfilename2);
  $FILE_SKPWNI="UPDATE `datang_header` SET `FILE_SKPWNI` = '$newfilename2' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FILE_SKPWNI);
  }
  
   //FILE_AKTA_KAWIN
  if (!empty($_FILES["FILE_AKTA_KAWIN"]["name"])) {
   $filename3 = $_FILES["FILE_AKTA_KAWIN"]["name"];
  $file_basename3 = substr($filename3, 0, strripos($filename3, '.')); // get file extention
  $file_ext3 = substr($filename3, strripos($filename3, '.')); // get file name
  $filesize3 = $_FILES["FILE_AKTA_KAWIN"]["size"];
  $newfilename3 = "FILE_AKTA_KAWIN - ".$nikpemohon . $file_ext3;  
  move_uploaded_file($_FILES["FILE_AKTA_KAWIN"]["tmp_name"], "../public/datang/" . $newfilename3);
  $FILE_AKTA_KAWIN="UPDATE `datang_header` SET `FILE_AKTA_KAWIN` = '$newfilename3' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FILE_AKTA_KAWIN);
  }
  
    //FILE_SURAT_JTT
  if (!empty($_FILES["FILE_SURAT_JTT"]["name"])) {
    $filename4 = $_FILES["FILE_SURAT_JTT"]["name"];
  $file_basename = substr($filename4, 0, strripos($filename4, '.')); // get file extention
  $file_ext4 = substr($filename4, strripos($filename4, '.')); // get file name
  $filesize4 = $_FILES["FILE_SURAT_JTT"]["size"];
  $newfilename4 = "FILE_SURAT_JTT - ".$nikpemohon . $file_ext4;  
  move_uploaded_file($_FILES["FILE_SURAT_JTT"]["tmp_name"], "../public/datang/" . $newfilename4);
  $FILE_SURAT_JTT="UPDATE `datang_header` SET `FILE_SURAT_JTT` = '$newfilename4' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FILE_SURAT_JTT);
  }
  
   //FILE_SURAT_KERJA
  if (!empty($_FILES["FILE_SURAT_KERJA"]["name"])) {
    $filename5 = $_FILES["FILE_SURAT_KERJA"]["name"];
  $file_basename5 = substr($filename5, 0, strripos($filename5, '.')); // get file extention
  $file_ext5 = substr($filename5, strripos($filename5, '.')); // get file name
  $filesize5 = $_FILES["FILE_SURAT_KERJA"]["size"];
  $newfilename5 = "FILE_SURAT_KERJA - ".$nikpemohon . $file_ext5;  
  move_uploaded_file($_FILES["FILE_SURAT_KERJA"]["tmp_name"], "../public/datang/" . $newfilename5);
  $FILE_SURAT_KERJA="UPDATE `datang_header` SET `FILE_SURAT_KERJA` = '$newfilename5' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FILE_SURAT_KERJA);
  }
  
  //FILE_FOTO_BERITA_KERJA
  if (!empty($_FILES["FILE_FOTO_BERITA_KERJA"]["name"])) {
    $filename6 = $_FILES["FILE_FOTO_BERITA_KERJA"]["name"];
  $file_basename6 = substr($filename6, 0, strripos($filename6, '.')); // get file extention
  $file_ext6 = substr($filename6, strripos($filename6, '.')); // get file name
  $filesize6 = $_FILES["FILE_FOTO_BERITA_KERJA"]["size"];
  $newfilename6 = "FILE_FOTO_BERITA_KERJA - ".$nikpemohon . $file_ext6;  
  move_uploaded_file($_FILES["FILE_FOTO_BERITA_KERJA"]["tmp_name"], "../public/datang/" . $newfilename6);
  $FILE_FOTO_BERITA_KERJA="UPDATE `datang_header` SET `FILE_FOTO_BERITA_KERJA` = '$newfilename6' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FILE_FOTO_BERITA_KERJA);
  }
  
   //FILE_BERITA_TINGGAL
  if (!empty($_FILES["FILE_BERITA_TINGGAL"]["name"])) {
    $filename7 = $_FILES["FILE_BERITA_TINGGAL"]["name"];
    $file_basename7 = substr($filename7, 0, strripos($filename7, '.')); // get file extention
    $file_ext7 = substr($filename7, strripos($filename7, '.')); // get file name
    $filesize7 = $_FILES["FILE_BERITA_TINGGAL"]["size"];
    $newfilename7 = "FILE_BERITA_TINGGAL - ".$nikpemohon . $file_ext7;  
    move_uploaded_file($_FILES["FILE_BERITA_TINGGAL"]["tmp_name"], "../public/datang/" . $newfilename7);
    $FILE_BERITA_TINGGAL="UPDATE `datang_header` SET `FILE_BERITA_TINGGAL` = '$newfilename7' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
    mysqli_query($con,$FILE_BERITA_TINGGAL);
  }

  //FILE_BERITA_TINGGAL
  if (!empty($_FILES["FILE_FOTO_BERITA_TINGGAL"]["name"])) {
  $filename8 = $_FILES["FILE_FOTO_BERITA_TINGGAL"]["name"];
  $file_basename8 = substr($filename8, 0, strripos($filename8, '.')); // get file extention
  $file_ext8 = substr($filename8, strripos($filename8, '.')); // get file name
  $filesize8= $_FILES["FILE_FOTO_BERITA_TINGGAL"]["size"];
  $newfilename8 = "FILE_FOTO_BERITA_TINGGAL - ".$nikpemohon . $file_ext8;  
  move_uploaded_file($_FILES["FILE_FOTO_BERITA_TINGGAL"]["tmp_name"], "../public/datang/" . $newfilename8);
  $FILE_FOTO_BERITA_TINGGAL="UPDATE `datang_header` SET `FILE_FOTO_BERITA_TINGGAL` = '$newfilename8' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FILE_FOTO_BERITA_TINGGAL);
  }
  //FILE_RT_RW
  if ($_FILES["FILE_RT_RW"]["name"]) {
  $filename9 = $_FILES["FILE_RT_RW"]["name"];
  $file_basename9 = substr($filename9, 0, strripos($filename9, '.')); // get file extention
  $file_ext9 = substr($filename9, strripos($filename9, '.')); // get file name
  $filesize9= $_FILES["FILE_RT_RW"]["size"];
  $newfilename9 = "FILE_RT_RW - ".$nikpemohon . $file_ext9;  
  move_uploaded_file($_FILES["FILE_RT_RW"]["tmp_name"], "../public/datang/" . $newfilename9);
  $FILE_RT_RW="UPDATE `datang_header` SET `FILE_RT_RW` = '$newfilename9' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FILE_RT_RW);
  }
  
  // FILE_BERITA_KERJA
if (!empty($_FILES["FILE_BERITA_KERJA"]["name"])) {
  $filename11 = $_FILES["FILE_BERITA_KERJA"]["name"];
  $file_basename11 = substr($filename11, 0, strripos($filename11, '.')); // get file extention
  $file_ext11 = substr($filename11, strripos($filename11, '.')); // get file name
  $filesize11= $_FILES["FILE_BERITA_KERJA"]["size"];
  $newfilename11 = "FILE_BERITA_KERJA - ".$nikpemohon . $file_ext11;  
  move_uploaded_file($_FILES["FILE_BERITA_KERJA"]["tmp_name"], "../public/datang/" . $newfilename11);
  $FILE_BERITA_KERJA="UPDATE `datang_header` SET `FILE_BERITA_KERJA` = '$newfilename11' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FILE_BERITA_KERJA);
}

if ($ketemu['flag_status']==0) {
  $flag = 0;
} elseif ($ketemu['flag_status']==1) {
  $flag = 1;
} elseif ($ketemu['flag_status']==2) {
  $flag = 2;
} else {
  $flag = 0;
}

  $IS_DELETE="UPDATE `datang_header` SET `IS_DELETE` = '0',FLAG_STATUS = '$flag' WHERE `datang_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$IS_DELETE);
  // echo $IS_DELETE;
    echo '<div class="alert alert-success">data sukses di inputkan, selanjutnya isikan data tujuan </div>';
    echo "<script type=\"text/javascript\">setTimeout(' window.location.href = \"index.php\"; ',2000);</script>";
 

 }
?>
<!-- Full Width Column -->
<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
     

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Dokumen Persyaratan</h3>
              <a href="#"><span class="badge btn-warning open_modal"  id='<?php echo $ketemu['id']; ?>'>view doc</span></a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
                
                
                <span class="bg-blue">
                  Dokumen Persyaratan
                </span>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> KK yang ditumpangi (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_KK_PINDAH" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Surat Keterangan Pindah WNI (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_SKPWNI" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Akta Kawin (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_AKTA_KAWIN" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Surat Jaminan Tempat Tinggal (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_SURAT_JTT" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Surat Jaminan Pekerjaan / Sekolah(.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_SURAT_KERJA" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Surat Pengantar RT/RW (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_RT_RW" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Berita Acara Verifikasi Pekerjaan / Sekolah(.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_BERITA_KERJA" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Foto Berita Acara Ver. Pekerjaan(.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_FOTO_BERITA_KERJA" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Berita Acara Verifikasi Tempat Tinggal (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_BERITA_TINGGAL" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Foto Berita Acara Ver. Tempat Tinggal (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_FOTO_BERITA_TINGGAL" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
               
              <hr>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="form_anggota.php?nik=<?php echo $_GET['nik'];?>" class="btn btn-default">back</a>
              <button type="submit" value="simpan" class="btn btn-info pull-right">Simpan</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- /.box -->
        <!-- general form elements disabled -->

        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>

    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.container -->
</div>
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<!-- /.content-wrapper -->
<?php include"footer.php"; ?>
<script type="text/javascript">
            $(document).ready(function (){
                $(".open_modal").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "view_doc.php",
                        type: "GET",
                        data : {kdbarang: m,},
                        success: function (ajaxData){
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>