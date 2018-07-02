<footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="../dist/js/jquery-1.10.2.js"></script>
<!-- Select2 -->
<script src="../dist/js/select2/dist/js/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
            $('.itemName').select2({
                placeholder: 'Select an item',
                ajax: {
                    url: 'api/get_data_pemohon.php',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
             $('.NikTujuan').select2({
                placeholder: 'Select an item',
                ajax: {
                    url: 'api/get_data_tujuan.php',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
            $('.NikAng').select2({
                placeholder: 'Select an item',
                ajax: {
                    url: 'api/get_data_anggota.php',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        </script>
        <script type="text/javascript">
            function cek_database(){
                var itemName = $("#itemName").val();
                $.ajax({
                    url: 'api/cek_pemohon.php',
                    data:"itemName="+itemName ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#provpemohon').val(obj.nama_prov);
                    $('#namapemohon').val(obj.nama_lgkp);
                    $('#kabpemohon').val(obj.nama_kab);
                    $('#kecpemohon').val(obj.nama_kec);
                    $('#kelpemohon').val(obj.nama_kel);
                    $('#rwpemohon').val(obj.no_rw);
                    $('#rtpemohon').val(obj.no_rt);
                    $('#alamatpemohon').val(obj.alamat);

                });
            }
            function cek_database_tujuan(){
                var NikTujuan = $("#NikTujuan").val();
                $.ajax({
                    url: 'api/cek_tujuan.php',
                    data:"NikTujuan="+NikTujuan ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                     
                    $('#namatujuan').val(obj.nama_lgkp);
                    $('#kectujuan').val(obj.no_kec);
                    $('#keltujuan').val(obj.no_kel);
                    $('#rwtujuan').val(obj.no_rw);
                    $('#rttujuan').val(obj.no_rt);
                    $('#alamattujuan').val(obj.alamat);

                });
            }
            function cek_database_ang(){
                var NikAng = $("#NikAng").val();
                $.ajax({
                    url: 'api/cek_anggota.php',
                    data:"NikAng="+NikAng ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                     
                    $('#namaang').val(obj.nama_lgkp);

                });
            }
           
        </script>

        <!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
 
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../dist/js/demo.js"></script> -->
<!-- Page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'responsive'  : true,
      'autoWidth'   : false
    })
  })
</script>
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
</body>
</html>
