<?php

    include '../config/koneksi.php';
    $kdbarang = $_GET['kdbarang'];
    $barang = mysqli_query($con,"select nik_pemohon,id_keluar,id from keluar_detail where id='$kdbarang'");
    
    while($row=  mysqli_fetch_array($barang)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Delete Anggota</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="kontrol/c_del_anggota.php" name="modal-popup" enctype="multipart/form-data" method="POST">
                
                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ?</div>
                
                            <div class="form-group">
                                <label class="col-lg-3 control-label">NIK</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="<?php echo $row['nik_pemohon']; ?>" readonly/>
                                        <input style="width: 200px;"  class="form-control" type="hidden" name="id_keluar" value="<?php echo $row['id_keluar']; ?>" />
                                        <input style="width: 200px;"  class="form-control" type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                    </div>
                            </div>
                            
                            
                
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Keluar</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>