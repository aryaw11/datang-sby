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
              <h3 class="box-title">list user</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
              <!-- <hr> -->
              <!-- <div class="box"> -->
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <a href="#" class='btn btn-primary open_add' id='1'>tambah</a>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>NO</th>
                            <th>user</th>
                            <th>email </th>
                            <th>role</th>
                            <th>Aksi</th>
                    </tr>
                </thead>
               <tbody>
                <?php
                $no = 1;
                $sql = "SELECT * FROM users ";
                $sqlbarang = mysqli_query($con,$sql);
                        while ($data = mysqli_fetch_array($sqlbarang)){
                ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data[1] ?></td>
                        <td><?php echo $data[3] ?></td>
                        <td><?php echo $data[4] ?></td>
                        <td>
                        <a href="#" class='btn btn-danger open_delete' id='<?php echo $data[0]; ?>'><span class="glyphicon glyphicon-trash"></span></a></td>
                        
                        
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
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<!-- /.content-wrapper -->
<?php include"footer.php"; ?>
        <script type="text/javascript">
            $(document).ready(function (){
                $(".open_add").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "modal_add_user.php",
                        type: "GET",
                        data : {kdbarang: m,},
                        success: function (ajaxData){
                            $("#ModalAdd").html(ajaxData);
                            $("#ModalAdd").modal('show',{backdrop: 'true'});
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
                        url: "modal_delete_user.php",
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
        