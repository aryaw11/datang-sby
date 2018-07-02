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
              <h3 class="box-title">Monev</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
              <!-- <hr> -->
              <!-- <div class="box"> -->
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table   class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kecamatan</th>
                        <th>Jumlah Pemohon</th>
                        <th>Jumlah Anggota</th>
                        <th>Kontrol</th>
                    </tr>
                </thead>
               <tbody>
                <?php
                $no = 1;
                $sql = "SELECT a.`NO_KEC` , a.`NAMA_KEC` FROM kecamatan a WHERE a.NO_PROV = '35' AND a.NO_KAB='78' ORDER BY a.no_kec ";
                $sqlbarang = mysqli_query($con,$sql);
                        while ($data = mysqli_fetch_array($sqlbarang)){
                ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['NAMA_KEC'] ?></td>
                        <td><?php
                        $kdbarang = $data['NO_KEC'] ;
                        $barang = mysqli_query($con,"SELECT COUNT(b.nik_pemohon) AS pemohon FROM keluar_header b , biodata_wni c WHERE b.nik_pemohon=c.nik AND c.no_prop='35' AND c.no_kab='78' AND c.no_kec='$kdbarang'");
                        while($row=  mysqli_fetch_array($barang)){ 
                            if ($row['pemohon'] > 0 ) {
                                echo $row['pemohon'];
                            } else {
                                echo "-";
                            }
                         } ?>
            
                        </td>
                        <td><?php
                        $idbarang = $data['NO_KEC'] ;
                        $garang = mysqli_query($con,"SELECT COUNT(d.nik_pemohon) AS pemohon FROM keluar_header b , biodata_wni c , keluar_detail d WHERE b.nik_pemohon=c.nik AND c.no_prop='35' AND c.no_kab='78' AND d.id_keluar=b.id AND c.no_kec='$idbarang'");
                        while($rows=  mysqli_fetch_array($garang)){ 
                            if ($rows['pemohon'] > 0 ) {
                                echo $rows['pemohon'];
                            } else {
                                echo "-";
                            }
                         } ?>
            
                        </td>
                        <td>
                            <a target="_blank" href="monev_data.php?id=<?php echo $data['NO_KEC'] ?>"><span class="badge btn-primary">view</span></a>
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