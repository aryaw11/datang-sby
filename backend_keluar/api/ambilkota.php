<?php
include '../../config/koneksi.php';

$propinsi = $_GET['propinsi'];

$query = "SELECT * FROM kabupaten where no_prov='$propinsi'";
$hasil = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($hasil)) {
	?>
	<option value="<?php echo $row[1] ?>" ><?php echo $row[2];?></option>
	<?php
}
?>
