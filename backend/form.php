<?php include"header.php"; 
$arrSHDK = array('KEPALA KELUARGA','SUAMI','ISTRI','ANAK','MENANTU','CUCU','ORANG TUA','MERTUA','FAMILI LAIN','PEMBANTU','LAINNYA');
$source_path = explode('/',$_SERVER['REQUEST_URI']);
$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/'.$source_path[1].'/upload/';
$cmbSHDK="<select name='mnuSHDK' class='form-control' id='mnuSHDK' >";
$cmbSHDK.="<option value=''>-- Pilih--</option>";
foreach($arrSHDK as $key => $value) {
  $no = ++$key;
  $cmbSHDK.= "<option value='$no'>$value</option>";
}
$cmbSHDK.="</select>";
if(isset($_GET['id'])) {$ID=(get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET ['id']);}
    
    if(!empty($ID)) {
        
        // $sql = ociparse($conn, "select a.*
        // from DATANG_HEADER a where ID = ".$ID );
        // ociexecute($sql);
        
        // while ($row = oci_fetch_array ($sql, OCI_ASSOC)) {
        //     $a_row = $row;        
        // }

    }
   
    if(isset($_POST['Simpan'])) {   
        $record['NO_FORM']      = genNoForm($conn, date('dmY'));
        $record['NO_PINDAH']    = strtoupper(strip_tags(trim($_POST['txtNoskp'])));
        $record['NO_KK']        = strip_tags(trim($_POST['txtNkk']));
        $record['NAMA_KEP']     = pReplace(strtoupper($_POST['txtNamaKep']));
        $record['NIK_PEMOHON']  = strip_tags(trim($_POST['txtNik']));
        $record['NAMA_PEMOHON'] = pReplace(strtoupper($_POST['txtNamaPemohon']));
        $record['SRC_DUSUN']    = pReplace(strtoupper($_POST['txtAlamat']));
        $record['SRC_RT']       = strip_tags(trim($_POST['txtRT']));
        $record['SRC_RW']       = strip_tags(trim($_POST['txtRW']));
        $record['SRC_PROP']     = $_POST['mnuProp'];
        $record['SRC_KAB']      = $_POST['txtIdKab'];
        $record['SRC_KEC']      = $_POST['txtIdKec'];
        $record['SRC_KEL']      = $_POST['txtIdKel'];
        $record['SRC_KODE_POS'] = strip_tags(trim($_POST['txtKdpos']));
        $record['SRC_TELP']     = strip_tags(trim($_POST['txtTelp']));
        $record['NK_NIK_KEP_KEL']   = strip_tags(trim($_POST['txtNkNik'])); 
        $record['NK_NAMA_KEP_KEL']  = pReplace(strtoupper($_POST['txtNKNamaKep'])); 
        $record['TGL_DATANG']       = "{TO_DATE('$_POST[tanggal]', 'dd/mm/yyyy')}"; 
        $record['NK_ALAMAT']        = pReplace(strtoupper($_POST['txtDestAlamat'])); 
        $record['NK_RT']            = strip_tags(trim($_POST['txtDestRT'])); 
        $record['NK_RW']            = strip_tags(trim($_POST['txtDestRW'])); 
        $record['TIPE_DATANG']      = $_POST['mnuJenis'];
        $record['STATUS_PINDAH']    = $_POST['mnuStatusKKPindah']; 
        $record['NK_PROP']          = $_POST['mnuPropDest'];
        $record['NK_KAB']           = $_POST['txtDestIdKab'];
        $record['NK_KEC']           = $_POST['txtDestIdKec'];
        $record['NK_KEL']           = $_POST['txtDestIdKel'];
        $record['NK_KODE_POS']      = strip_tags(trim($_POST['txtDestKdpos']));
        $record['NK_TELP']          = strip_tags(trim($_POST['txtDestTelp']));
        
        //created
        if(empty($ID)) {
          $record['CREATED_DATE']     = "{TO_DATE('".date('d/m/Y')."', 'dd/mm/yyyy')}";
          $record['FLAG_STATUS']      = 1;
        }
        $upload_status = true;
        $maxsize    = 200097;

    

        //Keluarga 
        if(isset($_FILES)) {
            foreach($_FILES as $key => $value) {
                // Dokumen Persyatan
                if(!empty($value['name'])) {

                    if(($value['size'] >= $maxsize)) {
                       $upload_status = false;
                       break;
                    }
                   $record[strtoupper($key)] = uploadFile($upload_dir, $_FILES[$key], $record['NIK_PEMOHON'], $key);
                   //$record[strtoupper($key).'_BLOB'] = uploadFileBlob($_FILES[$key]);
                }
            }
        }
        // tambahan baru
        if(empty($ID)) {
            $id = insertRecord($conn, "DATANG_HEADER", $record, "ID");
        } else {     
           $id = updateRecord($conn, "DATANG_HEADER", $record, $ID);
        }
        
     if(isset($_POST['txtNikDtl'])) {
            $iinsert = 0;
            $iupdate = 0;
            $idelete = 0;
            foreach($_POST['txtNikDtl'] as $key => $value) {
                $recorddetail = array();
                

                $recorddetail['ID_DATANG'] = $id;
                $recorddetail['NIK'] = strip_tags(trim($_POST['txtNikDtl'][$key]));
                $recorddetail['NAMA_LENGKAP'] = strtoupper($_POST['txtNamaDtl'][$key]);
                $recorddetail['SHDK'] = $_POST['mnuSHDK'][$key];
                $recorddetail['CREATED_DATE']     = date('d-m-Y');
              

                if($_POST['isdelete'][$key] == 1 ) {
                    deleteRecord($conn, "DATANG_DETAIL", "ID_DETAIL" , $key);
                    ++$idelete;
                } elseif($_POST['isedit'][$key] == 1 ) {
                    updateRecord($conn, "DATANG_DETAIL", $recorddetail, $key);
                    ++$iupdate;
                } else {
                    insertRecord($conn, "DATANG_DETAIL", $recorddetail, "ID_DETAIL");
                    ++$iinsert;
                }
                    
                $a_insert[] = $recorddetail;  
            }

           // debug($_POST);    
        }

        if($id) {
          
          header("Refresh:0; url= datang.php?id=".$id);
        }
    }
?>
<!-- Full Width Column -->
<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Top Navigation
        <small>Example 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Top Navigation</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <span class="bg-blue">
                  Pemohon
                </span>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor Surat Keterangan Pindah</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="Nomor Surat Keterangan Pindah" name="nskp">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Email" name="email" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIK Pemohon</label>

                  <div class="col-sm-10">
                    <select class="itemName form-control"  onchange="cek_database()" name="itemName" id="itemName" ></select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="namapemohon" name="namapemohon" id="namapemohon">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="provpemohon" name="provpemohon" id="provpemohon">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="kabpemohon" name="kabpemohon" id="kabpemohon">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="kecpemohon" name="kecpemohon" id="kecpemohon">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="kelpemohon" name="kelpemohon" id="kelpemohon">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No RT</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="No RT" name="rtpemohon" id="rtpemohon">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No RW</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="No RW" name="rwpemohon" id="rwpemohon">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="alamat" name="alamatpemohon" id="alamatpemohon">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> No. Telp/Handphone</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control"  placeholder="No. Telp/Handphone">
                  </div>
                </div>
                <span class="bg-green">
                  Data Daerah Tujuan
                </span>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Status KK Bagi Yang Pindah</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="statuskkpindah">
                      <option value="">-- Pilih--</option>
                      <option class="inputField" value="1">Numpang KK</option>
                      <option class="inputField" value="2">Membuat KK Baru</option>
                      <option class="inputField" value="3">Nomor KK Tetap</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> NIK Kepala Keluarga</label>

                  <div class="col-sm-10">
                    <!-- <input type="email" class="form-control"  placeholder="NikTujuan" name="NikTujuan"> -->
                    <select class="NikTujuan form-control"  onchange="cek_database_tujuan()" name="NikTujuan" id="NikTujuan" ></select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Nama Kepala Keluarga</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control"  placeholder="namatujuan" name="namatujuan" id="namatujuan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Tanggal Kedatangan</label>
                  <div class="col-sm-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="tgldatang">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Tujuan</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control"  placeholder="kectujuan" name="kectujuan" id="kectujuan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Tujuan</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control"  placeholder="keltujuan" name="keltujuan" id="keltujuan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No RT Tujuan</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control"  placeholder="No RT Tujuan" name="rttujuan" id="rttujuan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No RW Tujuan</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control"  placeholder="No RW Tujuan" name="rwtujuan" id="rwtujuan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Alamat Tujuan</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control"  placeholder="Alamat Tujuan" name="alamattujuan" id="alamattujuan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Jenis Kepindahan</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" name="jenispindah" >
                      <option value="">-- Pilih--</option>
                      <option value="1">KEP. KELUARGA</option>
                      <option value="2">KEP. KEL. DAN SELURUH ANGG. KELUARGA</option>
                      <option value="3">KEP.KEL DAN SBG. ANGG. KELUARGA</option>
                      <option value="4">ANGG.KELUARGA</option>
                    </select>
                  </div>
                </div>
                <span class="bg-blue">
                  Dokumen Persyaratan
                </span>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> KK yang ditumpangi (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_KK_PINDAH" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Surat Keterangan Pindah WNI (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_SKPWNI" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Akta Kawin (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_AKTA_KAWIN" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Surat Jaminan Tempat Tinggal (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_SURAT_JTT" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"> Surat Jaminan Pekerjaan / Sekolah(.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_SURAT_KERJA" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Surat Pengantar RT/RW (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_RT_RW" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Berita Acara Verifikasi Pekerjaan / Sekolah(.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_BERITA_KERJA" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Foto Berita Acara Ver. Pekerjaan(.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_FOTO_BERITA_KERJA" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Berita Acara Verifikasi Tempat Tinggal (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_BERITA_TINGGAL" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Foto Berita Acara Ver. Tempat Tinggal (.jpg)<span class="text-danger">*</span></label>

                  <div class="col-sm-10">
                    <input type="file" name="FILE_FOTO_BERITA_TINGGAL" >
                  </div>
                </div>
                <span class="bg-yellow">
                  Keluarga Yang Datang (Pengikut)
                </span>
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
                    <?php echo $cmbSHDK; ?>
                  </div>
                </div>
                <hr>
                <div class="form-group">

                  <div class="col-sm-10">
                  <input name="SimpanDtl" value="Tambah" type="button" class="btn btn-primary waves-effect waves-light"  onclick="return pValidasiDtl()"/>
                </div>
              </div>

              <hr>
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

                </tbody>
              </table>
              <hr>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-default">Cancel</button>
              <button type="submit" class="btn btn-info pull-right">Sign in</button>
            </div>
            <!-- /.box-footer -->
          </form>
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
<!-- /.content-wrapper -->
<?php include"footer.php"; ?>