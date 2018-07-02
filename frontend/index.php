<?php include"header.php"; ?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <!-- <section class="content-header">
        <h1>
          Top Navigation
          <small>Example 2.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>
      </section> -->

      <!-- Main content -->
      <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Carousel</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">

                    <div class="carousel-caption">
                      First Slide
                    </div>
                  </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">

                    <div class="carousel-caption">
                      Second Slide
                    </div>
                  </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">

                    <div class="carousel-caption">
                      Third Slide
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Pemohon<br>Pindah Datang</span>
              <span class="info-box-number">1,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Pemohon<br>Pindah Keluar</span>
              <span class="info-box-number">410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Permohonan<br>Pindah Datang<br>Bulan ini</span>
              <span class="info-box-number">13,648</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Permohonan<br>Pindah Keluar<br>Bulan ini</span>
              <span class="info-box-number">93,139</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>


<div class="row">
    <div class="col-12">
        <div class="box box-solid">
            <div class="box-body">
            <h2 >Selamat Datang,</h2>

            <div >
                <p style="font-size:20px">Terima kasih telah membuka website kami. Berikut kami informasikan tata cara Pendaftaran Pindah Datang klik link berikut </p> <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Link</button>
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myLargeModalLabel">informasikan tata cara Pendaftaran Pindah Datang</h4>
                            </div>
                            <div class="modal-body">
                                <ul style="font-size:16px">
                                    <li style="line-height:28px">Scan dokumen persyaratan berikut ini sebelum mengisi form pendaftaran: </li>
                                    <ol>
                                        <li style="line-height:28px">Surat Keterangan Pindah WNI antar Kabupaten / Kota / Provinsi dari Dispenduk asal  </li>
                                        <li style="line-height:28px">Akta Kawin  </li> 
                                        <li style="line-height:28px">Surat Pernyataan mengenai keterangan Tempat Tinggal dari Kepala Keluarga yang diketahui oleh Ketua RT dan Ketua RW atau 
                                            Surat Pernyataan mengenai Jaminan Tempat Tinggal dari Kepala Keluarga yang akan ditumpangi, dan diketahui oleh Ketua RT dan Ketua RW, apabila menumpang pada domisili penduduk tersebut (Dilampiri oleh KTP dan Kartu Keluarga yang akan ditumpangi). <a href="d_jaminantinggal.php" target="_blank">Download</a></li> 
                                            <li style="line-height:28px">Surat Pernyataan Jaminan Pekerjaan / Sekolah..  <a href="d_jaminanpekerjaan.php" target="_blank">Download</a></li>  
                                            <li style="line-height:28px">Surat Pengantar RT/RW.  </li>  
                                            <li style="line-height:28px">KTP-EL asal.   </li>  
                                            <li style="line-height:28px">Berita Acara Verifikasi Pekerjaan / Sekolah.  </li>  
                                            <li style="line-height:28px">Foto Berita Acara Verifikasi Pekerjaan / Sekolah.  </li>  
                                            <li style="line-height:28px">Berita Acara Verifikasi Tempat Tinggal.  </li>  
                                            <li style="line-height:28px">Foto Berita Acara Verifikasi Tempat Tinggal.  </li>  

                                        </ol>
                                        <li style="line-height:28px">Mengisi form Pendaftaran dengan benar </li>  
                                        <li style="line-height:28px">Mencetak Tanda Bukti Pendaftaran </li> 

                                        <p style="font-style: italic"><strong>Catatan : </strong>
                                            <span class="error">&nbsp;*</span> Wajib diisi</p>

                                            <a href="index.php?page=add_datang" class="btn btn-primary waves-light waves-effect">Lanjut Daftar</a>
                                        </ul>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                  </div>


                </div>
            </div>
        </div> <!-- end row -->



        <!-- end row -->

        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <?php include"footer.php"; ?>