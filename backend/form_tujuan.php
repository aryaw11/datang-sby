<?php include"header.php"; 
include '../config/koneksi.php';
$nik = $_GET['nik'];
$ketemu=mysqli_fetch_array(mysqli_query($con,"SELECT nik_kepkel_tujuan from datang_header where NIK_PEMOHON =  '$nik' "));
if ($ketemu[0] > 0) {
  $c=mysqli_fetch_array(mysqli_query($con,"SELECT a.id, a.nik_kepkel_tujuan,
    (SELECT z.nama_lgkp FROM biodata_wni z WHERE z.nik=a.nik_kepkel_tujuan) AS nama_lgkp , 
    (SELECT p.nama_prov FROM provinsi p , biodata_wni q WHERE p.no_prov= q.no_prop AND q.nik = a.nik_kepkel_tujuan) AS nama_prov ,
    (SELECT k.nama_kab FROM kabupaten k , biodata_wni w WHERE k.no_prov= w.no_prop AND k.no_kab =w.no_kab AND w.nik = a.nik_kepkel_tujuan) AS nama_kab ,
    (SELECT h.nama_kec FROM kecamatan h , biodata_wni t WHERE h.no_prov= t.no_prop AND h.no_kab =t.no_kab AND h.no_kec=t.no_kec AND t.nik = a.nik_kepkel_tujuan) AS nama_kec ,
    (SELECT r.nama_kel FROM kelurahan r , biodata_wni u WHERE r.no_prov= u.no_prop AND r.no_kab =u.no_kab AND r.no_kec=u.no_kec AND r.no_kel = u.no_kel
    AND u.nik = a.nik_kepkel_tujuan) AS nama_kel ,
    (SELECT d.no_rt FROM biodata_wni d WHERE d.nik=a.nik_kepkel_tujuan) AS no_rt , 
    (SELECT v.no_rw FROM biodata_wni v WHERE v.nik=a.nik_kepkel_tujuan) AS no_rw , 
    (SELECT n.alamat FROM biodata_wni n WHERE n.nik=a.nik_kepkel_tujuan) AS alamat , 
    a.telp_tujuan , a.tgl_datang , a.status_kk_pindah , a.jenis_pindah
    FROM datang_header a , biodata_wni b
    WHERE a.nik_pemohon = b.nik AND a.NIK_PEMOHON =  '$nik' "));
}
if(isset($_POST['statuskkpindah'])) { 

  $statuskkpindah = $_POST['statuskkpindah'];
  $nikpemohon = $_GET['nik'];
  $NikTujuan = $_POST['NikTujuan'];
  $tgldatang = date("Y-m-d", strtotime($_POST['tgldatang']));
  $jenispindah = $_POST['jenispindah'];
  $hp = $_POST['hp'];

  $qq="UPDATE `datang_header` SET `STATUS_KK_PINDAH` = '$statuskkpindah', `NIK_KEPKEL_TUJUAN` = '$NikTujuan', `TGL_DATANG` = '$tgldatang' , `TELP_TUJUAN` = '$hp' , `JENIS_PINDAH` = '$jenispindah'   WHERE  `datang_header`.`NIK_PEMOHON` = '$nikpemohon';";
  $id =mysqli_query($con,$qq);
  //$c=mysqli_fetch_array(mysqli_query($con,"SELECT  "));
  if ($id) {
   echo '<div class="alert alert-success">data sukses di inputkan, selanjutnya isikan data tujuan </div>';

   echo "<script type=\"text/javascript\">
   setTimeout(' window.location.href = \"form_anggota.php?nik=$nikpemohon\"; ',2000);
   </script>";
 }
 else {
  // echo $sql;
   echo '<div class="alert alert-warning">gagal di inputkan</div>';
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
              <h3 class="box-title">form pindah datang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <span class="bg-green">
                  Data Daerah Tujuan
                </span>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Status KK Bagi Yang Pindah</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="statuskkpindah">
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM reff_master where type = '1'";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if($row[0]==$c['status_kk_pindah']){ $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $row[0] ?>" <?php echo $sl ?>><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> NIK Kepala Keluarga</label>

                  <div class="col-sm-10">
                    <!-- <input type="email" class="form-control"  placeholder="NikTujuan" name="NikTujuan"> -->
                    <select class="NikTujuan form-control"  onchange="cek_database_tujuan()" name="NikTujuan" id="NikTujuan" >
                     <?php if ($ketemu[0] > 0) { ?>
                     <option value="<?php echo $c['nik_kepkel_tujuan']; ?>" ><?php echo $c['nik_kepkel_tujuan']; ?></option>
                      <?php } else {} ?> 
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Nama Kepala Keluarga</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="namatujuan" name="namatujuan" id="namatujuan" value="<?php if ($ketemu[0] > 0){ echo $c['nama_lgkp']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Tanggal Kedatangan</label>
                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="tgldatang" value="<?php if ($ketemu[0] > 0){ echo date("m/d/Y", strtotime($c['tgl_datang'])); }?>" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="kectujuan" name="kectujuan" id="kectujuan" value="<?php if ($ketemu[0] > 0){ echo $c['nama_kec']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="keltujuan" name="keltujuan" id="keltujuan" value="<?php if ($ketemu[0] > 0){ echo $c['nama_kel']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No RT Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="No RT Tujuan" name="rttujuan" id="rttujuan" value="<?php if ($ketemu[0] > 0){ echo $c['no_rt']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No RW Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="No RW Tujuan" name="rwtujuan" id="rwtujuan" value="<?php if ($ketemu[0] > 0){ echo $c['no_rw']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Alamat Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="Alamat Tujuan" name="alamattujuan" id="alamattujuan" value="<?php if ($ketemu[0] > 0){ echo $c['alamat']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> No. Telp/Handphone Tujuan</label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control"  placeholder="No. Telp/Handphone" name="hp" value="<?php if ($ketemu[0] > 0){ echo $c['telp_tujuan']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Jenis Kepindahan</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="jenispindah" >
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM reff_master where type = '2'";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if($row[0]==$c['jenis_pindah']){ $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $row[0] ?>" <?php echo $sl ?>><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a href="form_pemohon.php?nik=<?php echo $_GET['nik'];?>" class="btn btn-default">back</a>
              <?php if ($ketemu[0] > 0) {?>
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