<?php
$no_prop = $_GET['propinsi'];
$no_kab = $_GET['kota'];
$no_kec = $_GET['kec'];
include '../../config/koneksi.php';
$query = "SELECT * FROM kelurahan where no_prov='$no_prop' and no_kab='$no_kab' and no_kec = '$no_kec'";
$hasil = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($hasil)) {
	?>
	<option value="<?php echo $row[3] ?>" ><?php echo $row[4];?></option>
	<?php
}
?>
