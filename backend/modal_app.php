<?php

    include '../config/koneksi.php';
    $kdbarang = $_GET['kdbarang'];
    $barang = mysqli_query($con,"select nik_pemohon, id from datang_header where id='$kdbarang'");
    
    while($row=  mysqli_fetch_array($barang)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Approve Anggota</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="kontrol/c_app_datang.php" name="modal-popup" enctype="multipart/form-data" method="POST">
                
                    <div class="alert alert-success">Apakah anda yakin ingin approve data ini ?</div>
                
                            <div class="form-group">
                                <label class="col-lg-3 control-label">NIK</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="nik_pemohon" value="<?php echo $row['nik_pemohon']; ?>" readonly/>
                                       
                                        <input style="width: 200px;"  class="form-control" type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Keterangan</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="ket"  />
                                    </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-3 control-label"> Tanggal Ambil</label>
                              <div  class="col-lg-5">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="datepicker" name="tgl_ambil"  required>
                                  <span style="color: red">Format : bulan/tanggal/tahun (month/date/year)</span>
                                </div>
                              </div>
                            </div>
                            
                            
                
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Approve</button>
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Keluar</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    //$('.select2').select2()
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
 
  })
</script>