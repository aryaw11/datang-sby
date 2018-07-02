<?php include"header.php"; 
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
              <h3 class="box-title">cek status permohonan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <div class="box-body">
              <hr>
              <span class="bg-yellow">
                <!-- Keluarga Yang Datang (Pengikut) -->
              </span>

              <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIK </label>

                  <div class="col-sm-10">
                    <!-- <select class=" form-control" name="nik" id="nik" ></select> -->
                    <input type="text" class="form-control"  placeholder="Nik" name="nik" id="nik" required >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor Registrasi</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="Nomor Registrasi" name="reg" id="reg" required >
                  </div>
                </div>

                <div class="box-footer"> 
                 <button type="submit" value="simpan"  class="btn btn-info pull-right">cek status</button>
               </div>
               <!-- /.box-footer -->

             </form>
           </div>
         </div>
         <?php if(isset($_POST['reg'])) { 
          include '../config/koneksi.php';
          $noform = $_POST['reg'];
          $nik = $_POST['nik'];
          $tujuan=mysqli_fetch_array(mysqli_query($con,"SELECT a.id, a.nik_kepkel_tujuan,
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
            WHERE a.nik_pemohon = b.nik AND a.nik_pemohon =  '$nik' and a.no_form= '$noform' "));

          $asal=mysqli_fetch_array(mysqli_query($con,"SELECT a.id,a.nik_pemohon , b. nama_lgkp , 
            (SELECT p.nama_prov FROM provinsi p WHERE p.no_prov= b.no_prop ) AS nama_prov ,
            (SELECT k.nama_kab FROM kabupaten k WHERE k.no_prov= b.no_prop AND k.no_kab =b.no_kab) AS nama_kab ,
            (SELECT h.nama_kec FROM kecamatan h WHERE h.no_prov= b.no_prop AND h.no_kab =b.no_kab AND h.no_kec=b.no_kec) AS nama_kec ,
            (SELECT r.nama_kel FROM kelurahan r WHERE r.no_prov= b.no_prop AND r.no_kab =b.no_kab AND r.no_kec=b.no_kec AND r.no_kel = b.no_kel) AS nama_kel ,
            b.alamat , a.swni , a.email_pemohon , a. telp_pemohon , b.no_rt , b.no_rw , b.no_kk
            FROM datang_header a , biodata_wni b
            WHERE a.nik_pemohon = b.nik AND a.nik_pemohon =  '$nik' and a.no_form= '$noform' ")); ?>

            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">cek status permohonan</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->

              <div class="box-body">
                <hr>
                <span class="bg-yellow">
                  <!-- Keluarga Yang Datang (Pengikut) -->
                </span>
                <form class="form-horizontal" action="proses_edit.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
                 <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-2 control-label">Nama Lengkap Pemohon</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="namapemohon" name="namapemohon" id="namapemohon" readonly="true" value="<?php echo $asal['nama_lgkp'];  ?>"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-2 control-label">Nik Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="niktujuan" name="niktujuan" id="niktujuan" readonly="true" value="<?php echo $tujuan['nik_kepkel_tujuan'];  ?>"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="namatujuan" name="namatujuan" id="namatujuan" readonly="true" value="<?php echo $tujuan['nama_lgkp'];  ?>"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-2 control-label">Alamat Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="alamattujuan" name="alamattujuan" id="alamattujuan" readonly="true" value="<?php echo $asal['alamat'];  ?>"  required>
                  </div>
                </div>

              </form>


            </div>
          </div>
          <hr>
        </div>
      </div>
      <!-- /.box-body -->


      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat Permohonan</h3>
            </div>
            <div class="box-body">
             <ul class="timeline">
              <?php 
              $header = $asal['id'];
              $q = " SELECT keterangan,tgl_app,flag_status FROM riwayat_app WHERE id_header='$header' and jenis_header='1' order by tgl_app desc";
  // echo $q;
              $qr = mysqli_query($con,$q);
              while($rows=  mysqli_fetch_array($qr)){
                ?>
                <li>
                  <i class="fa fa-envelope bg-blue"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $rows['tgl_app'] ?></span>
                    <?php if ($rows['flag_status']==1) { ?>
                    <h3 class="timeline-header">approve kecamatan</h3>
                    <?php } elseif ($rows['flag_status']==2) { ?>
                    <h3 class="timeline-header">approve operator dispenduk</h3>
                    <?php } else { } ?>
                    <div class="timeline-body">
                      <?php echo $rows['keterangan'] ?>
                    </div>
                <!-- <div class="timeline-footer">
                  <a href="form_pemohon.php?nik=<?php echo $rows['nik'] ?>" class="btn btn-primary btn-xs">Read more</a>
                  
                </div> -->
              </div>
            </li>
            <?php } ?>
            
          </ul>

        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.container -->
</div>
<!-- /.content-wrapper -->
<?php } include"footer.php"; ?>