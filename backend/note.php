<?php

    include '../config/koneksi.php';
    session_start();
    $kdbarang = $_GET['kdbarang'];
    $barang = mysqli_query($con,"select nik_pemohon, id from datang_header where id='$kdbarang'");
    
    while($row=  mysqli_fetch_array($barang)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">catatan</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="kontrol/c_note.php" name="modal-popup" enctype="multipart/form-data" method="POST">
                
                    <!-- <div class="alert alert-success">silahkan </div> -->
                
                            <div class="form-group">
                                <label class="col-lg-3 control-label">NIK</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="<?php echo $row['nik_pemohon']; ?>" readonly/>
                                       
                                        <input style="width: 200px;"  class="form-control" type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                        <input style="width: 200px;"  class="form-control" type="hidden" name="user" value="<?php echo $_SESSION['user_session']; ?>" />
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Catatan</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="note"  />
                                    </div>
                            </div>
                            
                            
                
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">simpan</button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Keluar</button>
                            </div>
            </form>
            <?php
    }
    
?>

            <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
<?php 
    $qr = mysqli_query($con," SELECT a.catatan ,a.created_at,(SELECT b.user FROM users b WHERE b.uid=a.id_user ) as user FROM note a WHERE a.id_datang = '$kdbarang' and a.jenis='1' order by a.created_at desc");
    while($rows=  mysqli_fetch_array($qr)){
?>
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo $rows['created_at'] ?></span>

                <h3 class="timeline-header"><a href="#"><?php echo $rows['user'] ?></a></h3>

                <div class="timeline-body">
                  <?php echo $rows['catatan'] ?>
                </div>
                <!-- <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div> -->
              </div>
            </li>
            <?php } ?>
            
          </ul>
        </div>
        <!-- /.col -->
      </div>

        </div>
    </div>
</div>