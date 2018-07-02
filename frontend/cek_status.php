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
              <h3 class="box-title">cek status pindah datang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <span class="bg-blue">
                  cek status
                </span>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIK Pemohon</label>

                  <div class="col-sm-10">
                    <select class="itemNik form-control"  onchange="cek_status()" name="itemNik" id="itemNik" >
                      
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor Registrasi</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly="true"  placeholder="Nomor Registrasi" name="noform" id="noform"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor Surat Keterangan Pindah</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly="true" placeholder="Nomor Surat Keterangan Pindah" name="nskp" id="nskp" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"   class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" readonly="true" class="form-control" placeholder="Email" name="email" id="email" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-2 control-label">Nama Lengkap Pemohon</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="namapemohon" name="namapemohon" id="namapemohon" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-2 control-label">Nik Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="niktujuan" name="niktujuan" id="niktujuan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="namatujuan" name="namatujuan" id="namatujuan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-2 control-label">Alamat Tujuan</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="alamattujuan" name="alamattujuan" id="alamattujuan" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"   class="col-sm-2 control-label">Status</label>

                  <div class="col-sm-10">
                    <input type="text" readonly="true" class="form-control"  placeholder="status" name="status" id="status" required>
                  </div>
                </div>
                
               

            </div>
            <!-- /.box-body -->
           
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