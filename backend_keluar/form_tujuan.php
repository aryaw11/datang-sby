<?php include"header.php"; 
include '../config/koneksi.php';
$nik = $_GET['nik'];
$ketemu=mysqli_fetch_array(mysqli_query($con,"SELECT ALASAN_PINDAH from keluar_header where NIK_PEMOHON =  '$nik' "));
if ($ketemu[0] > 0) {
  $c=mysqli_fetch_array(mysqli_query($con," SELECT ALASAN_PINDAH,KLASIFIKASI_PINDAH,NO_PROV,NO_KAB,NO_KEC,NO_KEL,NO_RT,NO_RW,ALAMAT,JENIS_PINDAH,STATUS_KK_PINDAH,STATUS_KK_TDK_PINDAH,TGL_PINDAH FROM keluar_header where NIK_PEMOHON =  '$nik' "));
}
if(isset($_POST['alasanpindah'])) { 

  $alasanpindah = $_POST['alasanpindah'];
  $klasifikasipindah = $_POST['klasifikasipindah'];
  $provinsi = $_POST['provinsi'];
  $kabupaten = $_POST['kabupaten'];
  $kecamatan = $_POST['kecamatan'];
  $kelurahan = $_POST['kelurahan'];
  $nort = $_POST['nort'];
  $norw = $_POST['norw'];
  $alamat = $_POST['alamat'];
  $jenispindah = $_POST['jenispindah'];
  $tidakpindah = $_POST['tidakpindah'];
  $yapindah = $_POST['yapindah'];
  $tglpindah = date("Y-m-d", strtotime($_POST['tglpindah']));

  $qq="UPDATE `keluar_header` SET `ALASAN_PINDAH` = '$alasanpindah', `KLASIFIKASI_PINDAH` = '$klasifikasipindah', `NO_PROV` = '$provinsi' , `NO_KAB` = '$kabupaten' , `NO_KEC` = '$kecamatan' , `NO_KEL` = '$kelurahan' , `ALAMAT` = '$alamat', NO_RT = '$nort' ,NO_RW = '$norw' , `JENIS_PINDAH` = '$jenispindah' , `STATUS_KK_PINDAH` = '$tidakpindah' , `STATUS_KK_TDK_PINDAH` = '$yapindah' , TGL_PINDAH = '$tglpindah' WHERE  `keluar_header`.`NIK_PEMOHON` = '$nik';";
  $id =mysqli_query($con,$qq);
  //$c=mysqli_fetch_array(mysqli_query($con,"SELECT  "));
  if ($id) {
   echo '<div class="alert alert-success">data sukses di inputkan, selanjutnya isikan data tujuan </div>';

   echo "<script type=\"text/javascript\">
   setTimeout(' window.location.href = \"form_anggota.php?nik=$nik\"; ',2000);
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
              <h3 class="box-title">form pindah keluar</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <span class="bg-green">
                  Data Daerah Tujuan
                </span>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Alasan Pindah</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="alasanpindah">
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM reff_master where type = '4'";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if($row[0]==$c['ALASAN_PINDAH']){ $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $row[0] ?>" <?php echo $sl ?>><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Klasifikasi Pindah</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="klasifikasipindah">
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM reff_master where type = '5'";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if($row[0]==$c['KLASIFIKASI_PINDAH']){ $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $row[0] ?>" <?php echo $sl ?>><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Provinsi</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="provinsi" id="provinsi">
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM provinsi";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if($row[0]==$c['NO_PROV']){ $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $row[0] ?>" <?php echo $sl ?>><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Kabupaten</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="kabupaten" id="kabupaten">
                      <option value="">-- Pilih--</option>
                      <?php
                        if($ketemu[0]>0){
                        $prov = $c['NO_PROV'];
                        $kabu = $c['NO_KAB'];
                        $kab=mysqli_fetch_array(mysqli_query($con,"SELECT nama_kab from kabupaten where NO_PROV =  '$prov' and NO_KAB='$kabu' "));
                        $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $c['NO_KAB']; ?>" <?php echo $sl ?>><?php echo $kab['nama_kab'];?></option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Kecamatan</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="kecamatan" id="kecamatan">
                      <option value="">-- Pilih--</option>
                      <?php
                        if($ketemu[0]>0){
                        $prov = $c['NO_PROV'];
                        $kabu = $c['NO_KAB'];
                        $keca = $c['NO_KEC'];
                        $kec=mysqli_fetch_array(mysqli_query($con,"SELECT nama_kec from kecamatan where NO_PROV =  '$prov' and NO_KAB='$kabu' and NO_KEC = '$keca'"));
                        $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $c['NO_KEC']; ?>" <?php echo $sl ?>><?php echo $kec['nama_kec'];?></option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Kelurahan</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="kelurahan" id="kelurahan">
                      <option value="">-- Pilih--</option>
                      <?php
                        if($ketemu[0]>0){
                        $prov = $c['NO_PROV'];
                        $kabu = $c['NO_KAB'];
                        $keca = $c['NO_KEC'];
                        $kelu = $c['NO_KEL'];
                        $kel=mysqli_fetch_array(mysqli_query($con,"SELECT nama_kel from kelurahan where NO_PROV =  '$prov' and NO_KAB='$kabu' and NO_KEC = '$keca' and NO_KEl = '$kelu'"));
                        $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $c['NO_KEL']; ?>" <?php echo $sl ?>><?php echo $kel['nama_kel'];?></option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> No RT</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="nort" name="nort" id="nort" value="<?php if ($ketemu[0] > 0){ echo $c['NO_RT']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> No RW</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="norw" name="norw" id="norw" value="<?php if ($ketemu[0] > 0){ echo $c['NO_RW']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Alamat</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="alamat" name="alamat" id="alamat" value="<?php if ($ketemu[0] > 0){ echo $c['ALAMAT']; }?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Jenis Pindah</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="jenispindah">
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM reff_master where type = '2'";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if($row[0]==$c['JENIS_PINDAH']){ $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $row[0] ?>" <?php echo $sl ?>><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Status KK Bagi Yang Tidak Pindah</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="tidakpindah">
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM reff_master where type = '1'";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if($row[0]==$c['STATUS_KK_PINDAH']){ $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $row[0] ?>" <?php echo $sl ?>><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Status KK Bagi Yang Pindah</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="yapindah">
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM reff_master where type = '1'";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {
                        if($row[0]==$c['STATUS_KK_TDK_PINDAH']){ $sl = ' selected'; } else {$sl = '';}
                        ?>
                        <option value="<?php echo $row[0] ?>" <?php echo $sl ?>><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Tanggal Pindah</label>
                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="tglpindah" value="<?php if ($ketemu[0] > 0){ echo date("m/d/Y", strtotime($c['TGL_PINDAH'])); }?>" required>
                    </div>
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
<script type="text/javascript">
    $(document).ready(function(){   
    $('#provinsi').change(function(){
      $("#kabupaten").empty().append('<option value="">--Loading--</option>')
      $.get('api/ambilkota.php?propinsi='+$(this).val(), [], function(result){
        $("#kabupaten").empty();
        $("#kabupaten").append(result);
      }).error(function(result){
        console.log("error");
      });
    });
    
    $('#kabupaten').change(function(){
      $("#kecamatan").empty().append('<option value="">--Loading--</option>')
      $.get('api/ambilkecamatan.php?kota='+$(this).val()+'&propinsi='+$("#provinsi").val(), [], function(result){
        $("#kecamatan").empty();
        $("#kecamatan").append(result);
      }).error(function(result){
        console.log("error");
      });
    });
    
    $('#kecamatan').change(function(){
      $("#kelurahan").empty().append('<option value="">--Loading--</option>')
      $.get('api/ambilkelurahan.php?kec='+$(this).val()+'&propinsi='+$("#provinsi").val()+'&kota='+$("#kabupaten").val(), [], function(result){
        $("#kelurahan").empty();
        $("#kelurahan").append(result);
      }).error(function(result){
        console.log("error");
      });
    });    
    });
   
</script>