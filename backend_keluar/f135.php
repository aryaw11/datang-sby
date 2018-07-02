<?php
include '../config/koneksi.php';
$id=$_GET['id'];
	$asal=mysqli_fetch_array(mysqli_query($con,"SELECT a.id,a.nik_pemohon , b. nama_lgkp , 
	b.alamat ,  a.email_pemohon , a. telp_pemohon , b.no_rt , b.no_rw , b.no_kk , a.no_form , a.alamat as tujuan ,(SELECT h.nama_kec FROM kecamatan h , biodata_wni t WHERE h.no_prov= t.no_prop AND h.no_kab =t.no_kab AND h.no_kec=t.no_kec AND t.nik = a.nik_pemohon) AS nama_kec
	FROM keluar_header a , biodata_wni b
	WHERE a.nik_pemohon = b.nik AND a.ID =  '$id' "));
	$anggota=mysqli_num_rows(mysqli_query($con,"SELECT * FROM keluar_detail a 
	WHERE a.ID_KELUAR =  '$id' "));
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p style="text-align: right;">F.1-35</p>
<p style="text-align: center;"><strong>SURAT PENGANTAR PINDAH </strong></p>
<p style="text-align: center;"><strong>ANTAR KABUPATEN/KOTA ATAU ATAR PROVINSI </strong></p>
<p style="text-align: center;"><strong>NOMOR : <?php echo $asal['no_form']; ?></strong></p>
<p style="text-align: center;">&nbsp;</p>
<p>Yang bertanda tangan di bawah ini, menerangkan Permohonan Pindah Penduduk WNI dengan data sebagai</p>
<p>berikut :</p>
<p>&nbsp;</p>
<table style="height: 209px; width: 877px;">
<tbody>
<tr style="height: 23px;">
<td style="width: 284px; height: 23px;">1. NIK</td>
<td  >:</td>
<td style="width: 549px; height: 23px;">&nbsp;<?php echo $asal['nik_pemohon']; ?></td>
</tr>
<tr style="height: 23px;">
<td style="width: 284px; height: 23px;">2. Nama Lengkap</td>
<td  >:</td>
<td style="width: 549px; height: 23px;">&nbsp;<?php echo $asal['nama_lgkp']; ?></td>
</tr>
<tr style="height: 23px;">
<td style="width: 284px; height: 23px;">3. Nomor Kartu Keluarga</td>
<td  >:</td>
<td style="width: 549px; height: 23px;">&nbsp;<?php echo $asal['no_kk']; ?></td>
</tr>
<tr style="height: 23px;">
<td style="width: 284px; height: 23px;">4. Nama Kepala Keluarga</td>
<td  >:</td>
<td style="width: 549px; height: 23px;">&nbsp;<?php echo $asal['nama_lgkp']; ?></td>
</tr>
<tr style="height: 23px;">
<td style="width: 284px; height: 23px;">5. Alamat Sekarang</td>
<td  >:</td>
<td style="width: 549px; height: 23px;">&nbsp;<?php echo $asal['alamat']; ?></td>
</tr>
<tr style="height: 24px;">
<td style="width: 284px; height: 24px;">6. Alamat Tujuan Pindah</td>
<td  >:</td>
<td style="width: 549px; height: 24px;">&nbsp;<?php echo $asal['tujuan']; ?></td>
</tr>
<tr style="height: 24px;">
<td style="width: 284px; height: 24px;">7. Jumlah Keluarga Yang Pindah</td>
<td  >:</td>
<td style="width: 549px; height: 24px;">&nbsp;<?php echo $anggota. " orang"; ?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Orang Adapun Permohonan Pindah Penduduk WNI yang bersangkutan sebagaimana terlampir.</p>
<p>Demikian Surat Pengantar Pindah ini dibuat agar digunakan sebagaimana mestinya.</p>
<p>&nbsp;</p>
<?php
function ShowDate($str_date,$type=1){
	$T['Day']=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
	$T['Month']=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$T['S_Month']=array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agst","Sep","Okt","Nov","Des");
	
	$longday=$T['Day'][date("w",strtotime($str_date))]; // NAMA HARI
	$day=date("d",strtotime($str_date)); // TGL
	$month=$T['Month'][date("n",strtotime($str_date))]; // NAMA BULAN
	$s_month=$T['S_Month'][date("n",strtotime($str_date))]; // NAMA BULAN
	$year=date("Y",strtotime($str_date)); // TAHUN
	$s_year = date("y",strtotime($str_date));
	$hour=date("H",strtotime($str_date)); // JAM
	$minute=date("i",strtotime($str_date)); // MENIT
	$second=date("s",strtotime($str_date)); // DETIK
	
	if ($type==1){
		return $longday.", ".$day." ".$month." ".$year."  ".$hour.":".$minute.":".$second;
	}else if ($type==2){
		return $longday.", ".$day." ".$month." ".$year." - ".$hour.":".$minute." ";
	}else if ($type==3){
		return $longday.", ".$day." ".$month." ".$year;
	}else if ($type==4){
		return $day." ".$month." ".$year." - ".$hour.":".$minute." ";
	}else if ($type==5){
		return $day." ".$month." ".$year;
	}else if ($type==6){
		return $day." ".$s_month." ".$year;
	}else if($type==7){
		return $longday." ".$hour.":".$minute;
	}else if($type==8){
		return $month." ".$year;
	}else if($type==9){
		return $longday.", ".$day." ".$s_month." ".$s_year." - ".$hour.":".$minute." ";
	}
}
?>
<p style="text-align: right;">Surabaya, <?php echo ShowDate(date('y-m-d'),5) ?> <br>Camat Kec. <?php echo $asal['nama_kec'] ?></p>
<p style="text-align: right;">&nbsp;</p>
<p style="text-align: right;">&nbsp;</p>
<p style="text-align: right;">_________________________</p>

<script>

    window.print();
</script>
</body>
</html>