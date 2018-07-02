<?php include"header.php"; 
include '../config/koneksi.php';
$nikpemohon = $_GET['nik'];
$c=mysqli_fetch_array(mysqli_query($con,"SELECT id from datang_header where NIK_PEMOHON =  '$nikpemohon' "));
  $id_datang = $c['id'];
if(isset($_POST['NikAng'])) { 

  $NikAng = $_POST['NikAng'];
 
  $shdk = $_POST['shdk'];
  
  $tgl = date('Y-m-d H:i:s');
  $qq="insert into datang_detail (ID_DATANG,NIK_PEMOHON,SHDK,CREATED_AT) values ('$id_datang','$NikAng','$shdk','$tgl')";
$id =mysqli_query($con,$qq);

if ($id) {
   echo '<div class="alert alert-success">data sukses di inputkan </div>';

//     echo "<script type=\"text/javascript\">
//   setTimeout(' window.location.href = \"form_anggota.php?nik=$nikpemohon\"; ',2000);
// </script>";
}
else {
  // echo $sql;
   echo '<div class="alert alert-warning">gagal di inputkan</div>';
}
 

 }
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
              <h3 class="box-title">form pindah datang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
              <hr>
              <span class="bg-yellow">
                  Keluarga Yang Datang (Pengikut)
              </span>
              <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIK </label>

                  <div class="col-sm-10">
                    <select class="NikAng form-control"  onchange="cek_database_ang()" name="NikAng" id="NikAng" ></select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="namaang" name="namaang" id="namaang">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> SHDK</label>

                  <div class="col-sm-10">
                   <select class="form-control select2" name="shdk" >
                      <option value="">-- Pilih--</option>
                      <?php
                      $query = "SELECT * FROM reff_master where type = '3'";
                      $hasil = mysqli_query($con, $query);
                      while ($row = mysqli_fetch_array($hasil)) {                        ?>
                        <option value="<?php echo $row[0] ?>"><?php echo $row[1];?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="box-footer">
              <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
              <button type="submit" class="btn btn-success pull-right">tambah</button>
            </div>
            <!-- /.box-footer -->
          </form>
              <table class="table" id="subtable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>NAMA LENGKAP</th>
                    <th>SHDK</th>
                    <th>KONTROL</th>
                  </tr>
                </thead>
                <tbody>
                     <?php
                                $no = 1;
                                $sqlbarang = mysqli_query($con,"SELECT a.id,a.nik_pemohon , b. nama_lgkp , (SELECT c.nama FROM reff_master c WHERE c.id=a.shdk) AS shdk FROM datang_detail a , biodata_wni b WHERE a.nik_pemohon = b.nik AND a.id_datang = '$id_datang'");
                                while ($data = mysqli_fetch_array($sqlbarang)){
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $data['nik_pemohon'] ?></td>
                                <td><?php echo $data['nama_lgkp'] ?></td>
                                <td><?php echo $data['shdk'] ?></td>
                                <td>
                                    <a href="#" class='btn btn-danger open_delete' id='<?php echo $data['id']; ?>'><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                            <?php
                                $no++;
                                }
                            ?>
                </tbody>
              </table>
              <hr>
              <div class="box-footer">
              <!-- <button type="submit" class="btn btn-default">back</button> -->
              <a href="form_tujuan.php?nik=<?php echo $_GET['nik'];?>" class="btn btn-default">back</a>
              <a href="form_file.php?nik=<?php echo $_GET['nik'];?>" class="btn btn-info pull-right">next</a>
              <!-- <button type="submit" class="btn btn-info pull-right">Sign in</button> -->
            </div>
            </div>
            <!-- /.box-body -->
            
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
<div id="ModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<!-- /.content-wrapper -->
<?php include"footer.php"; ?>
<script type="text/javascript">
            $(document).ready(function (){
                $(".open_delete").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "modal_delete_anggota.php",
                        type: "GET",
                        data : {kdbarang: m,},
                        success: function (ajaxData){
                            $("#ModalDelete").html(ajaxData);
                            $("#ModalDelete").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>