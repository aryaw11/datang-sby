<?php include"header.php"; ?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
       
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <!-- <li><a href="#">Layout</a></li> -->
          <li class="active">Top Notification</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
        <div class="col-md-6">
          <!-- The time line -->
           <h1>
          Notification Pindah Datang
          <!-- <small>Example 2.0</small> -->
        </h1>
          <ul class="timeline">
<?php 
include '../config/koneksi.php';
$uid = $_SESSION['user_session'];
if ($_SESSION['role']=='kec') {
  $kec = $_SESSION['kec'];
 $q = " SELECT (SELECT f.user FROM users f WHERE f.uid='3' ) as user, a.`NIK_PEMOHON` , b.* 
FROM datang_header a , note b , biodata_wni c
WHERE a.id=b.`id_datang` AND b.id_user = '3' AND b.`jenis`= '1' AND c.`NO_KEC`= '$kec' AND c.`NIK`=a.`NIK_KEPKEL_TUJUAN` order by b.created_at desc";
} else {
  $q = " SELECT a.id_datang,a.catatan ,a.created_at,(SELECT b.user FROM users b WHERE b.uid=a.id_user ) as user, (select c.nik_pemohon from datang_header c where c.id=a.id_datang ) as nik
 FROM note a WHERE a.id_user != '$uid' and a.jenis='1' order by a.created_at desc";


}
// echo $q;

    $qr = mysqli_query($con,$q);
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
                <div class="timeline-footer">
                  <a href="form_pemohon.php?nik=<?php echo $rows['nik'] ?>" class="btn btn-primary btn-xs">Read more</a>
                  
                </div>
              </div>
            </li>
            <?php } ?>
            
          </ul>
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <!-- The time line -->
          <h1>
          Notification Pindah Keluar
          <!-- <small>Example 2.0</small> -->
        </h1>
          <ul class="timeline">
<?php 
include '../config/koneksi.php';
$uid = $_SESSION['user_session'];
if ($_SESSION['role']=='kec') {
  $kec = $_SESSION['kec'];
 $q = " SELECT (SELECT f.user FROM users f WHERE f.uid='3' ) as user, a.`NIK_PEMOHON` , b.* 
FROM keluar_header a , note b , biodata_wni c
WHERE a.id=b.`id_datang` AND b.id_user = '3' AND b.`jenis`= '2' AND c.`NO_KEC`= '$kec' AND c.`NIK`=a.`NIK_PEMOHON` order by b.created_at desc";
} else {
  $q = " SELECT a.id_datang,a.catatan ,a.created_at,(SELECT b.user FROM users b WHERE b.uid=a.id_user ) as user, (select c.nik_pemohon from keluar_header c where c.id=a.id_datang ) as nik
 FROM note a WHERE a.id_user != '$uid' and a.jenis='2' order by a.created_at desc";


}
// echo $q;

    $qr = mysqli_query($con,$q);
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
                <div class="timeline-footer">
                  <a href="../backend_keluar/form_pemohon.php?nik=<?php echo $rows['nik'] ?>" class="btn btn-primary btn-xs">Read more</a>
                  
                </div>
              </div>
            </li>
            <?php } ?>
            
          </ul>
        </div>
      </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <?php include"footer.php"; ?>