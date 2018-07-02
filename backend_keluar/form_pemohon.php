<?php include"header.php"; 
include '../config/koneksi.php';
if(isset($_GET['nik'])) {
$nik = $_GET['nik'];
$c=mysqli_fetch_array(mysqli_query($con,"SELECT a.id,a.nik_pemohon , b. nama_lgkp , 
(SELECT p.nama_prov FROM provinsi p WHERE p.no_prov= b.no_prop ) AS nama_prov ,
(SELECT k.nama_kab FROM kabupaten k WHERE k.no_prov= b.no_prop AND k.no_kab =b.no_kab) AS nama_kab ,
(SELECT h.nama_kec FROM kecamatan h WHERE h.no_prov= b.no_prop AND h.no_kab =b.no_kab AND h.no_kec=b.no_kec) AS nama_kec ,
(SELECT r.nama_kel FROM kelurahan r WHERE r.no_prov= b.no_prop AND r.no_kab =b.no_kab AND r.no_kec=b.no_kec AND r.no_kel = b.no_kel) AS nama_kel ,
b.alamat ,  a.email_pemohon , a. telp_pemohon , b.no_rt , b.no_rw , a.no_form
FROM keluar_header a , biodata_wni b
WHERE a.nik_pemohon = b.nik AND a.NIK_PEMOHON =  '$nik' "));
if(isset($_POST['noform'])) {  
  //$noform = $_POST['noform'];
  $nikpemohon = $_POST['itemName'];
  $email = $_POST['email'];
  $hp = $_POST['hp'];
  $tgl = date('Y-m-d H:i:s');
  $sql="UPDATE `keluar_header` SET `NIK_PEMOHON` = '$nikpemohon', `EMAIL_PEMOHON` = '$email' , `TELP_PEMOHON` = '$hp' , `CREATED_AT` = '$tgl'   WHERE  `keluar_header`.`NIK_PEMOHON` = '$nik';";
  $id = mysqli_query($con,$sql);
  $zz="UPDATE `keluar_detail` SET `NIK_PEMOHON` = '$nikpemohon' WHERE  `keluar_detail`.`NIK_PEMOHON` = '$nik';";
  $id = mysqli_query($con,$zz);
  //$c=mysqli_fetch_array(mysqli_query($con,"SELECT  "));
if ($id) {
   echo '<div class="alert alert-success">data sukses di update, selanjutnya isikan data tujuan </div>';

    echo "<script type=\"text/javascript\">
  setTimeout(' window.location.href = \"form_tujuan.php?nik=$nikpemohon\"; ',2000);
</script>";
   // echo $sql;
}
else {
  // echo $sql." --salah";
   echo '<div class="alert alert-warning">gagal di inputkan</div>';
}
 

 }
} else {
  function genNoForm($con, $date) {
    $gen=mysqli_fetch_array(mysqli_query($con,"SELECT no_form from keluar_header where NO_FORM like 'REGS/K/3578/$date/%' ORDER BY id DESC LIMIT 1  "));
    // $no_datang = 0;
    if (empty($gen[0])) {
     $no_datang = "REGS/K/3578/".$date."/0000";
    } else {
      $no_datang = $gen[0];
    }

 $no_datang = explode("/", $no_datang);
 $maxno_datang = str_pad((int) $no_datang[4] + 1, 4, '0', STR_PAD_LEFT);

 return "REGS/K/3578/$date/$maxno_datang";
}
  if(isset($_POST['noform'])) {  
  // $nskp = $_POST['nskp'];
  $noform = $_POST['noform'];
  $nikpemohon = $_POST['itemName'];
  $email = $_POST['email'];
  $hp = $_POST['hp'];
  $tgl = date('Y-m-d H:i:s');
  $ketemu=mysqli_num_rows(mysqli_query($con,"SELECT id from keluar_header where NIK_PEMOHON =  '$nikpemohon' "));
  if (empty($ketemu)) {
    $sql = "insert into keluar_header (NO_FORM,NIK_PEMOHON , EMAIL_PEMOHON,  TELP_PEMOHON , CREATED_AT ,IS_DELETE , FLAG_STATUS) values ('$noform','$nikpemohon','$email','$hp','$tgl','1','0')";
  $id = mysqli_query($con,$sql);
  $kepkel=mysqli_fetch_array(mysqli_query($con,"SELECT id from keluar_header where nik_pemohon='$nikpemohon' "));
  $shdk = '8';
  $id_datang = $kepkel['id'];
  $tgl = date('Y-m-d H:i:s');
  $qq="insert into keluar_detail (ID_KELUAR,NIK_PEMOHON,SHDK,CREATED_AT) values ('$id_datang','$nikpemohon','$shdk','$tgl')";
  $id = mysqli_query($con,$qq);
  //$c=mysqli_fetch_array(mysqli_query($con,"SELECT  "));
if ($id) {
  echo '<div class="alert alert-success">data sukses di inputkan, selanjutnya isikan data tujuan </div>';
  echo "<script type=\"text/javascript\">
  setTimeout(' window.location.href = \"form_tujuan.php?nik=$nikpemohon\"; ',2000);
</script>";
   echo $sql;
  }
      else {
        // echo $sql." --salah";
         echo '<div class="alert alert-warning">gagal di inputkan</div>';
      }
  }
  else {
    echo '<div class="alert alert-danger">data sudah ada, selanjutnya lanjutkan </div>';
    echo "<script type=\"text/javascript\">
    setTimeout(' window.location.href = \"form_pemohon.php?nik=$nikpemohon\"; ',2000);
    </script>";
  }
  
 

 }
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
              <h3 class="box-title">form pindah keluar</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <span class="bg-blue">
                  Pemohon
                </span>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor Registrasi</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly="true"  placeholder="Nomor Registrasi" name="noform" value="<?php if (isset($_GET['nik'])){ 
                      echo $c['no_form']; 
                    } else { echo genNoForm($con, date('dmY')); } ?>"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php if (isset($_GET['nik'])){ echo $c['email_pemohon']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIK Pemohon (Kepala Keluarga)</label>

                  <div class="col-sm-10">
                    <select class="itemName form-control"  onchange="cek_database()" name="itemName" id="itemName" >
                      <?php if (isset($_GET['nik'])) { ?>
                      <option value="<?php echo $c['nik_pemohon']; ?>" ><?php echo $c['nik_pemohon']; ?></option>
                      <?php } else {} ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="namapemohon" name="namapemohon" id="namapemohon" value="<?php if (isset($_GET['nik'])){ echo $c['nama_lgkp']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="provpemohon" name="provpemohon" id="provpemohon" value="<?php if (isset($_GET['nik'])){ echo $c['nama_prov']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="kabpemohon" name="kabpemohon" id="kabpemohon" value="<?php if (isset($_GET['nik'])){ echo $c['nama_kab']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="kecpemohon" name="kecpemohon" id="kecpemohon" value="<?php if (isset($_GET['nik'])){ echo $c['nama_kec']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="kelpemohon" name="kelpemohon" id="kelpemohon" value="<?php if (isset($_GET['nik'])){ echo $c['nama_kel']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No RT</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="No RT" name="rtpemohon" id="rtpemohon" value="<?php if (isset($_GET['nik'])){ echo $c['no_rt']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No RW</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="No RW" name="rwpemohon" id="rwpemohon" value="<?php if (isset($_GET['nik'])){ echo $c['no_rw']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="alamat" name="alamatpemohon" id="alamatpemohon" value="<?php if (isset($_GET['nik'])){ echo $c['alamat']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> No. Telp/Handphone</label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control"  placeholder="No. Telp/Handphone" name="hp" value="<?php if (isset($_GET['nik'])){ echo $c['telp_pemohon']; }?>" required>
                  </div>
                </div>
               

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-default">Cancel</button>
              <?php if (isset($_GET['nik'])) {?>
              <button type="submit" value="simpan"  class="btn btn-info pull-right">update & Next</button>
              <?php }  else {?>
              <button type="submit" value="simpan"  class="btn btn-info pull-right">Next</button>
              <?php } ?>
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
<!-- /.content-wrapper -->
<?php include"footer.php"; ?>