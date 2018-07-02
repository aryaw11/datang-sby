<?php
include '../config/koneksi.php';
$kdbarang = $_GET['kdbarang'];
$barang = mysqli_query($con,"select FL_KK , FL_KTP from keluar_header where id='$kdbarang'");

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
                        <label class="col-lg-2 control-label">KK </label>
                        <div class="col-lg-10">
                            <?php if ($row['FL_KK']) {?>
                            <img style="width: 50%;height: 50%" src="../public/keluar/<?php echo $row['FL_KK'];?>">
                            <?php } else {?>
                             <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="belum di upload" readonly/>
                             <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">KTP</label>
                        <div class="col-lg-10">
                            <?php if ($row['FL_KTP']) {?>
                            <img style="width: 50%;height: 50%" src="../public/keluar/<?php echo $row['FL_KTP'];?>">
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