<?php
include '../config/koneksi.php';
$kdbarang = $_GET['kdbarang'];
$barang = mysqli_query($con,"select FILE_KK_PINDAH,FILE_SKPWNI,FILE_AKTA_KAWIN,FILE_SURAT_JTT,FILE_SURAT_KERJA,FILE_RT_RW,FILE_BERITA_KERJA,FILE_FOTO_BERITA_KERJA,FILE_BERITA_TINGGAL,FILE_FOTO_BERITA_TINGGAL from datang_header where id='$kdbarang'");

while($row=  mysqli_fetch_array($barang)){
    ?>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myModalLabel">view document</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="proses_edit.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">KK yang ditumpangi</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_KK_PINDAH']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_KK_PINDAH'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Surat Keterangan Pindah WNI</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_SKPWNI']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_SKPWNI'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Akta Kawin</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_AKTA_KAWIN']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_AKTA_KAWIN'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Surat Jaminan Tempat Tinggal</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_SURAT_JTT']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_SURAT_JTT'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Surat Jaminan Pekerjaan / Sekolah</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_SURAT_KERJA']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_SURAT_KERJA'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Surat Pengantar RT/RW</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_RT_RW']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_RT_RW'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Berita Acara Verifikasi Pekerjaan / Sekolah</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_BERITA_KERJA']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_BERITA_KERJA'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Foto Berita Acara Ver. Pekerjaan</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_FOTO_BERITA_KERJA']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_FOTO_BERITA_KERJA'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Berita Acara Verifikasi Tempat Tinggal</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_BERITA_TINGGAL']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_BERITA_TINGGAL'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Foto Berita Acara Ver. Tempat Tinggal</label>
                        <div class="col-lg-10">
                            <?php if ($row['FILE_FOTO_BERITA_TINGGAL']) {?>
                            <img style="width: 50%;height: 50%" src="../public/datang/<?php echo $row['FILE_FOTO_BERITA_TINGGAL'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>



                    <div class="modal-footer">
                        
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Keluar</button>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</div>