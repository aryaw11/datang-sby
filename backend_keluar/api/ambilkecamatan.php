<?php
$propinsi = $_GET['propinsi'];
$no_kab = $_GET['kota'];
include '../../config/koneksi.php';
$query = "SELECT * FROM kecamatan where no_prov='$propinsi' and no_kab='$no_kab'";
$hasil = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($hasil)) {
	?>
	<option value="<?php echo $row[2] ?>" ><?php echo $row[3];?></option>
	<?php
}
?>
