<?php

    include '../config/koneksi.php';
    $kdbarang = $_GET['kdbarang'];
    $barang = mysqli_query($con,"select user,uid from users where uid='$kdbarang'");
    
    while($row=  mysqli_fetch_array($barang)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Delete User</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="kontrol/c_del_user.php" name="modal-popup" enctype="multipart/form-data" method="POST">
                
                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ?</div>
                
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Username</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="<?php echo $row['user']; ?>" readonly/>
                                        
                                        <input style="width: 200px;"  class="form-control" type="hidden" name="id" value="<?php echo $row['uid']; ?>" />
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