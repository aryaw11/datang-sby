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
                    $('#provpemohon').val(obj.no_prop);
                    $('#namapemohon').val(obj.nama_lgkp);
                    $('#kabpemohon').val(obj.no_kab);
                    $('#kecpemohon').val(obj.no_kec);
                    $('#kelpemohon').val(obj.no_kel);
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
            function pValidasiDtl() {
        if ((document.getElementById('NikAng').value) == "") {
            alert ("NIK harus diisi");
            document.getElementById('NikAng').focus();
            return false;
        }
        var idx = 0;
        
        var table = $('table#subtable');
        var optSHDK = ["<?php echo implode('","',$arrSHDK)?>"];
        var nama = $('#namaang').val();
        // id_detail++;
        var html =
            '<tr>'+
            '<td width="3%" align="center">'+ (++idx) +
            '<input type="hidden" id="NikAng[]" name="NikAng[]" value="'+ $('#NikAng').val() +'" />' +
           
            //Usia belum
            '<input type="hidden" id="mnuSHDK[]" name="mnuSHDK[]" value="'+ $('#mnuSHDK').val() +'" />' +

            '<input type="hidden" id="isedit[]" name="isedit[]" value="0" />' +
            '<input type="hidden" id="isdelete[]" name="isdelete[]" value="0" />' +
            '</td>'+
            '<td width="18%">'+ $('#NikAng').val() +'</td>'+
            '<td width="35%">'+ $('#namaang').val() +'</td>'+
            '<td width="20%">'+ optSHDK[(new Number($('#mnuSHDK').val()) - 1)] +'</td>'+
            '<td width="10%" align="center"><img src="../public/images/b_drop.png" style="cursor:pointer" onclick="removeDetail(this, 0)" /></td>'+
            '</tr>';
            
        table.append(html);
    }
    
    function removeDetail(obj, isdelete) {
        if(isdelete) {
            $(obj).parents('tr').find('input[id^="isedit"]').val(0);
            $(obj).parents('tr').find('input[id^="isdelete"]').val(1);
            $(obj).parents('tr').hide();
            
            console.log($(obj).parents('tr').children('input[id^="isdelete"]'));    
        } else
            $(obj).parents('tr').remove();
    }
        </script>

        <!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
 
 
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../dist/js/demo.js"></script> -->
<!-- Page script -->
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
