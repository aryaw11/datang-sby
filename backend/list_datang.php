<?php include"header.php"; 
include '../config/koneksi.php';

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
              <h3 class="box-title">list pindah datang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
              <!-- <hr> -->
              <!-- <div class="box"> -->
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <a href="form_pemohon.php" class="btn btn-info ">tambah pengajuan</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK PEMOHON</th>
                        <th>NAMA PEMOHON</th>
                        <th>ALAMAT</th>
                        <th>TGL ENTRY</th>
                        <th>TGL APP</th>
                        <th>KEC</th>
                        <th>OPR</th>
                        <th>KONTROL</th>
                    </tr>
                </thead>
               <tbody>
                <?php
                $no = 1;
                if ($_SESSION['role']=='kec') {
                    $kec = $_SESSION['kec'];
                $sql = "SELECT a.nik ,b.nik_pemohon, a.nama_lgkp , a.alamat , b.created_at , b.tgl_app , b.flag_status , b.id FROM biodata_wni a , datang_header b WHERE a.nik=b.nik_pemohon and b.is_delete != '1' and a.no_kec='$kec' ";
                } else {
                    $sql = "SELECT a.nik ,b.nik_pemohon, a.nama_lgkp , a.alamat , b.created_at , b.tgl_app , b.flag_status , b.id FROM biodata_wni a , datang_header b WHERE a.nik=b.nik_pemohon and b.is_delete != '1'";
                }
                $sqlbarang = mysqli_query($con,$sql);
                        while ($data = mysqli_fetch_array($sqlbarang)){
                ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['nik'] ?></td>
                        <td><?php echo $data['nama_lgkp'] ?></td>
                        <td><?php echo $data['alamat'] ?></td>
                        <td><?php echo $data['created_at'] ?></td>
                        <td><?php echo $data['tgl_app'] ?></td>
                        <td> 
                          <!-- 1 kec , 2 opr -->
                          <?php if ($data['flag_status']==1 OR $data['flag_status']==2) { 
                            $a = "primary";
                            $b = "check-circle-o"; 
                            }else{
                            $a = "danger";
                            $b = "clock-o";
                            } ?>
                          <span class="btn btn-<?php echo $a ?> btn-flat btn-xs"><i class="fa fa-fw fa-<?php echo $b ?>"></i> </span>
                        </td>
                        <td><?php if ($data['flag_status']==2) { 
                            $a = "primary";
                            $b = "check-circle-o"; 
                            }else{
                            $a = "danger";
                            $b = "clock-o";
                            } ?>
                          <span class="btn btn-<?php echo $a ?> btn-flat btn-xs"><i class="fa fa-fw fa-<?php echo $b ?>"></i> </span></td>
                       
                        <td><a href="form_pemohon.php?nik=<?php echo $data['nik_pemohon'] ?>"><span class="badge btn-success">edit</span></a>
                            <!-- <a href="index.php?page=edit&id=2"><span class="badge btn-danger">delete</span></a> -->
                            <?php if ($_SESSION['role']=='kec') {  
                                if ($data['flag_status']==0) {?>
                                <a href="#"><span class="badge btn-primary open_app" id='<?php echo $data['id']; ?>'>approve</span></a>
                                <?php } elseif ($data['flag_status']==1) {  ?>
                                <a href="#"><span class="badge btn-danger open_btlapp" id='<?php echo $data['id']; ?>'>batal approve</span></a>
                                <?php } elseif ($data['flag_status']==2) {  ?>
                                <span class="badge btn-primary">approved opr</span>
                                <?php } else { } } elseif ($_SESSION['role']=='opr') {
                                if ($data['flag_status']==0) {?>
                                <span class="badge btn-primary">wait app kec</span>
                                <?php } elseif ($data['flag_status']==1) {  ?>
                                <a href="#"><span class="badge btn-danger open_app" id='<?php echo $data['id']; ?>'>approve</span></a>
                                <?php } elseif ($data['flag_status']==2) {  ?>
                                <a href="#"><span class="badge btn-danger open_btlapp" id='<?php echo $data['id']; ?>'>batal approve</span></a>
                                <?php }} else {}?>

                            
                            <a href="#"><span class="badge btn-warning open_modal"  id='<?php echo $data['id']; ?>'>view doc</span></a>
                            <a href="#"><span class="badge btn-info open_note" id='<?php echo $data['id']; ?>' >note</span></a>
                            <a target="_blank" href="f138.php?id=<?php echo $data['id'] ?>"><span class="badge btn-success">F.1-38</span></a>
                            <a target="_blank" href="f139.php?id=<?php echo $data['id'] ?>"><span class="badge btn-primary">F.1-39</span></a>
                        </td>
                    </tr>
                    <?php
                                $no++;
                                }
                            ?>

                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
         
            
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
<div id="ModalApp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div id="ModalBtlApp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div id="ModalNote" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<!-- /.content-wrapper -->
<?php include"footer.php"; ?>
      <script type="text/javascript">
            $(document).ready(function (){
                $(".open_modal").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "view_doc.php",
                        type: "GET",
                        data : {kdbarang: m,},
                        success: function (ajaxData){
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
        
        <script type="text/javascript">
            $(document).ready(function (){
                $(".open_delete").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "barang_delete.php",
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
        <script type="text/javascript">
            $(document).ready(function (){
                $(".open_app").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "modal_app.php",
                        type: "GET",
                        data : {kdbarang: m,},
                        success: function (ajaxData){
                            $("#ModalApp").html(ajaxData);
                            $("#ModalApp").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function (){
                $(".open_btlapp").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "modal_btl_app.php",
                        type: "GET",
                        data : {kdbarang: m,},
                        success: function (ajaxData){
                            $("#ModalBtlApp").html(ajaxData);
                            $("#ModalBtlApp").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function (){
                $(".open_note").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "note.php",
                        type: "GET",
                        data : {kdbarang: m,},
                        success: function (ajaxData){
                            $("#ModalNote").html(ajaxData);
                            $("#ModalNote").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>