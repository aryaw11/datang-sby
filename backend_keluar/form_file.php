<?php include"header.php"; 
include '../config/koneksi.php';
$nik = $_GET['nik'];
$ketemu=mysqli_fetch_array(mysqli_query($con,"SELECT id,flag_status from keluar_header where NIK_PEMOHON =  '$nik' "));
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
  $nikpemohon = $_GET['nik'];

//KK yang ditumpangi
  if (!empty($_FILES["FL_KK"]["name"])) {
    $filename1 = $_FILES["FL_KK"]["name"];
    $file_basename1 = substr($filename1, 0, strripos($filename1, '.')); // get file extention
    $file_ext1 = substr($filename1, strripos($filename1, '.')); // get file name
    $filesize1 = $_FILES["FL_KK"]["size"];
    $newfilename1 = "FL_KK - ".$nikpemohon . $file_ext1;  
    move_uploaded_file($_FILES["FL_KK"]["tmp_name"], "../public/keluar/" . $newfilename1);
    $FL_KK="UPDATE `keluar_header` SET `FL_KK` = '$newfilename1' WHERE `keluar_header`.`NIK_PEMOHON` = '$nikpemohon' ";
    mysqli_query($con,$FL_KK);
  }
  //FILE_KTP
  if (!empty($_FILES["FL_KTP"]["name"])) {
   $filename2 = $_FILES["FL_KTP"]["name"];
  $file_basename2 = substr($filename2, 0, strripos($filename2, '.')); // get file extention
  $file_ext2 = substr($filename2, strripos($filename2, '.')); // get file name
  $filesize2 = $_FILES["FL_KTP"]["size"];
  $newfilename2 = "FL_KTP - ".$nikpemohon . $file_ext2;  
  move_uploaded_file($_FILES["FL_KTP"]["tmp_name"], "../public/keluar/" . $newfilename2);
  $FL_KTP="UPDATE `keluar_header` SET `FL_KTP` = '$newfilename2' WHERE `keluar_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$FL_KTP);
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

  $IS_DELETE="UPDATE `keluar_header` SET `IS_DELETE` = '0',FLAG_STATUS = '$flag' WHERE `keluar_header`.`NIK_PEMOHON` = '$nikpemohon' ";
  mysqli_query($con,$IS_DELETE);
  // echo $IS_DELETE;
    echo '<div class="alert alert-success">data sukses di inputkan, selanjutnya isikan data tujuan </div>';
    echo "<script type=\"text/javascript\">setTimeout(' window.location.href = \"list_datang.php\"; ',2000);</script>";
 

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
                  <label for="inputEmail3" class="col-sm-2 control-label"> KK (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FL_KK" accept="image/png,image/gif,image/jpeg">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> KTP (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FL_KTP" accept="image/png,image/gif,image/jpeg">
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