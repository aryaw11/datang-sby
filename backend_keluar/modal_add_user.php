<?php
include '../config/koneksi.php';
$kdbarang = $_GET['kdbarang'];

    ?>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myModalLabel">add user</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="kontrol/c_add_user.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">username</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control"  placeholder="username" name="username" id="username">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">email</label>

                      <div class="col-sm-10">
                        <input type="email" class="form-control"  placeholder="email" name="email" id="email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">password</label>

                      <div class="col-sm-10">
                        <input type="password" class="form-control"  placeholder="password" name="password" id="password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label"> Kecamatan</label>

                      <div class="col-sm-10">
                       <select class="form-control select2" name="kecamatan" >
                          <option value="">-- Pilih--</option>
                          <?php
                          $query = "SELECT no_kec , nama_kec FROM kecamatan WHERE NO_PROV = '35' AND NO_KAB ='78' ORDER BY no_kec ";
                          $hasil = mysqli_query($con, $query);
                          while ($row = mysqli_fetch_array($hasil)) {                        ?>
                            <option value="<?php echo $row[0] ?>"><?php echo $row[1];?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">simpan</button>
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Keluar</button>
                    </div>
                </form>
       
        </div>
    </div>
</div>