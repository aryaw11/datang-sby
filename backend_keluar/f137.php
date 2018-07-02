<?php
error_reporting(0);
include '../config/koneksi.php';
require_once ("../config/fpdf/fpdf.php");

$id = $_GET['id'];
define('FPDF_FONTPATH','font/');
class PDF extends FPDF
{
//Page header
function Header()
{
}

function Footer() {


}
}

//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$pdf->SetFillColor(236,232,212);
// $awal=mysqli_fetch_array(mysqli_query($con,"SELECT ID ,  NO_FORM ,  SWNI ,  EMAIL_PEMOHON ,  NIK_PEMOHON ,  TELP_PEMOHON ,  STATUS_KK_PINDAH ,  NIK_KEPKEL_TUJUAN ,  TELP_TUJUAN ,  TGL_DATANG ,  JENIS_PINDAH ,  CREATED_AT ,  CREATED_BY ,  IS_DELETE ,  TGL_APP ,  FLAG_STATUS  from datang_header where ID =  '$id' "));
// 	$sts= $awal['STATUS_KK_PINDAH'];
// 	$status_kk_pindah=mysqli_fetch_array(mysqli_query($con,"SELECT nama  from reff_master where ID =  '$sts' "));
// 	$jns= $awal['JENIS_PINDAH'];
// 	$jenis_pindah=mysqli_fetch_array(mysqli_query($con,"SELECT nama  from reff_master where ID =  '$sts' "));


// 	$TANGGAL_DATANG = date('d-m-Y', strtotime($awal['TGL_DATANG']));
	

	 $asal=mysqli_fetch_array(mysqli_query($con,"SELECT a.id,a.nik_pemohon,a.NO_FORM,b.no_kk,telp_pemohon,
    (SELECT z.nama_lgkp FROM biodata_wni z WHERE z.nik=a.nik_pemohon) AS nama_lgkp , 
    (SELECT p.nama_prov FROM provinsi p , biodata_wni q WHERE p.no_prov= q.no_prop AND q.nik = a.nik_pemohon) AS nama_prov ,
    (SELECT k.nama_kab FROM kabupaten k , biodata_wni w WHERE k.no_prov= w.no_prop AND k.no_kab =w.no_kab AND w.nik = a.nik_pemohon) AS nama_kab ,
    (SELECT h.nama_kec FROM kecamatan h , biodata_wni t WHERE h.no_prov= t.no_prop AND h.no_kab =t.no_kab AND h.no_kec=t.no_kec AND t.nik = a.nik_pemohon) AS nama_kec ,
    (SELECT r.nama_kel FROM kelurahan r , biodata_wni u WHERE r.no_prov= u.no_prop AND r.no_kab =u.no_kab AND r.no_kec=u.no_kec AND r.no_kel = u.no_kel
    AND u.nik = a.nik_pemohon) AS nama_kel ,
    (SELECT d.no_rt FROM biodata_wni d WHERE d.nik=a.nik_pemohon) AS no_rt , 
    (SELECT v.no_rw FROM biodata_wni v WHERE v.nik=a.nik_pemohon) AS no_rw , 
    (SELECT n.alamat FROM biodata_wni n WHERE n.nik=a.nik_pemohon) AS alamat , 
    (SELECT l.nama FROM reff_master l WHERE l.id=a.ALASAN_PINDAH) AS alasan_pindah,
    (SELECT o.nama FROM reff_master o WHERE o.id=a.KLASIFIKASI_PINDAH) AS klasifikasi_pindah,
    (SELECT o.nama FROM reff_master o WHERE o.id=a.JENIS_PINDAH) AS jenis_pindah,
    (SELECT o.nama FROM reff_master o WHERE o.id=a.`STATUS_KK_PINDAH`) AS status_kk_pindah,
    (SELECT o.nama FROM reff_master o WHERE o.id=a.`STATUS_KK_TDK_PINDAH`) AS status_kk_tdk_pindah,
     a.tgl_pindah 
    FROM keluar_header a , biodata_wni b
    WHERE a.nik_pemohon = b.nik AND a.ID =  '$id' "));

     $tujuan=mysqli_fetch_array(mysqli_query($con,"SELECT a.id, a.nik_pemohon,
    (SELECT z.nama_lgkp FROM biodata_wni z WHERE z.nik=a.nik_pemohon) AS nama_lgkp , 
    (SELECT p.nama_prov FROM provinsi p WHERE p.no_prov= a.no_prov ) AS nama_prov ,
    (SELECT k.nama_kab FROM kabupaten k WHERE k.no_prov= a.no_prov AND k.no_kab =a.no_kab ) AS nama_kab ,
    (SELECT h.nama_kec FROM kecamatan h  WHERE h.no_prov= a.no_prov AND h.no_kab =a.no_kab AND h.no_kec=a.no_kec) AS nama_kec ,
    (SELECT r.nama_kel FROM kelurahan r  WHERE r.no_prov= a.no_prov AND r.no_kab =a.no_kab AND r.no_kec=a.no_kec AND r.no_kel = a.no_kel) AS nama_kel ,
    (SELECT d.no_rt FROM biodata_wni d WHERE d.nik=a.nik_pemohon) AS no_rt , 
    (SELECT v.no_rw FROM biodata_wni v WHERE v.nik=a.nik_pemohon) AS no_rw , 
    (SELECT n.alamat FROM biodata_wni n WHERE n.nik=a.nik_pemohon) AS alamat 
    FROM keluar_header a , biodata_wni b
    WHERE a.nik_pemohon = b.nik AND a.ID = '$id' "));


$pdf->Cell(0,0,'F.1-37', 0, 0, 'R', false);	
$pdf->Ln(5);

$pdf->Cell(40,0,'PROVINSI', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nama_prov'], 0, 0, 'L', false);	
$pdf->Ln(5);

$pdf->Cell(40,0,'KABUPATEN/KOTA', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nama_kab'], 0, 0, 'L', false);	
$pdf->Ln(5);

$pdf->Cell(40,0,'KECAMATAN', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nama_kec'], 0, 0, 'L', false);	
$pdf->Ln(5);

$pdf->Cell(40,0,'DESA/KELURAHAN', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nama_kel'], 0, 0, 'L', false);	


$pdf->Ln(10);
$pdf->SetFont('Times','B',16);
$pdf->Cell(0,0,'FORMULIR PERMOHONAN PINDAH WNI', 0, 0, 'C', false);	
$pdf->Ln(6);
$pdf->SetFont('Times','B',14);
$pdf->Cell(0,0,'Antar Kabupaten/Kota atau  Antar Provinsi', 0, 0, 'C', false);	
$pdf->Ln(6);
$pdf->Cell(0,0,'No. '.$asal['NO_FORM'], 0, 0, 'C', false);	

$pdf->Ln(10);
$pdf->SetFont('Times','B',14);
$pdf->SetFillColor(236,232,212);
$pdf->Cell(0,5,'DATA DAERAH ASAL', 0, 0, 'L', true);	
$pdf->Ln(8);

$pdf->SetFont('Times','',12);
$pdf->Cell(5,0,'1.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Nomor Kartu Keluarga', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0, $asal['no_kk'], 0, 0, 'L', false);	
$pdf->Ln(5);

$pdf->Cell(5,0,'2.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Nama Kepala Keluarga', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nama_lgkp'], 0, 0, 'L', false);	
$pdf->Ln(5);

/*$pdf->Cell(5,0,'3.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Alamat', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(70,0,$ALAMAT, 0, 0, 'L', false);	
$pdf->Cell(10,0,'RT', 0, 0, 'L', false);	
$pdf->Cell(10,0,$RT, 0, 0, 'L', false);	
$pdf->Cell(10,0,'RW', 0, 0, 'L', false);	
$pdf->Cell(10,0,$RW, 0, 0, 'L', false);	
$pdf->Ln(5);*/
$L_ALAMAT=strlen(trim($asal['alamat']));
if($L_ALAMAT>40){
	$pdf->Cell(60,0,'', 0, 0, 'C', false);	
	$pdf->MultiCell(70,5,$asal['alamat'],0,'L',false);
	$pdf->Ln(5);
	$pdf->Cell(5,-25,'3.', 0, 0, 'C', false);	
	$pdf->Cell(50,-25,'Alamat', 0, 0, 'L', false);	
	$pdf->Cell(5,-25,':', 0, 0, 'C', false);	
	$pdf->Cell(70,0,'', 0, 0, 'C', false);	
	$pdf->Cell(7,-25,'RT', 0, 0, 'L', false);	
	$pdf->Cell(7,-25,$asal['no_rt'].'/', 0, 0, 'L', false);	
	$pdf->Cell(8,-25,'RW', 0, 0, 'L', false);	
	$pdf->Cell(7,-25,$asal['no_rw'], 0, 0, 'L', false);	
	$pdf->Ln(-5);

}elseif($L_ALAMAT>25){
	$pdf->Cell(5,0,'3.', 0, 0, 'C', false);	
	$pdf->Cell(50,0,'Alamat', 0, 0, 'L', false);	
	$pdf->Cell(5,0,':', 0, 0, 'C', false);	
	$pdf->Cell(100,0,$asal['alamat'], 0, 0, 'L', false);	
	$pdf->Cell(15,0,'RT/RW', 0, 0, 'L', false);	
	$pdf->Cell(15,0,' : '.$asal['no_rt'].'/'.$asal['no_rw'], 0, 0, 'L', false);	

}else{
	$pdf->Cell(5,0,'3.', 0, 0, 'C', false);	
	$pdf->Cell(50,0,'Alamat', 0, 0, 'L', false);	
	$pdf->Cell(5,0,':', 0, 0, 'C', false);	
	$pdf->Cell(70,0,$asal['alamat'], 0, 0, 'L', false);	
	$pdf->Cell(15,0,'RT/RW', 0, 0, 'L', false);	
	$pdf->Cell(10,0,' : '.$asal['no_rt'].'/'.$asal['no_rw'], 0, 0, 'L', false);	
}

$pdf->Ln(5);



$pdf->Cell(10,0,'', 0, 0, 'C', false);	
$pdf->Cell(45,0,'a. Desa/Kelurahan', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(60,0,$asal['nama_kel'], 0, 0, 'L', false);	
$pdf->Cell(25,0,'c. Kab/Kota', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nama_kab'], 0, 0, 'L', false);	
$pdf->Ln(5);

$pdf->Cell(10,0,'', 0, 0, 'C', false);	
$pdf->Cell(45,0,'b. Kecamatan', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(60,0,$asal['nama_kec'], 0, 0, 'L', false);	
$pdf->Cell(25,0,'d. Propinsi', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nama_prov'], 0, 0, 'L', false);	

$pdf->Ln(5);
$pdf->Cell(10,0,'', 0, 0, 'C', false);	
$pdf->Cell(45,0,'e. Kode Pos', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(60,0,"-", 0, 0, 'L', false);	
$pdf->Cell(25,0,'f. Telp', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['telp_pemohon'], 0, 0, 'L', false);	

$pdf->Ln(5);
$pdf->Cell(5,0,'3.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'NIK Pemohon', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nik_pemohon'], 0, 0, 'L', false);	
$pdf->Ln(5);

$pdf->Cell(5,0,'4.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Nama Lengkap', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['nama_lgkp'], 0, 0, 'L', false);	


$pdf->Ln(10);
$pdf->SetFont('Times','B',14);
$pdf->SetFillColor(236,232,212);
$pdf->Cell(0,5,'DATA DAERAH TUJUAN', 0, 0, 'L', true);	
$pdf->Ln(7);

$pdf->SetFont('Times','',12);
$pdf->Cell(5,0,'1.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Alasan Pindah', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['alasan_pindah'], 0, 0, 'L', false);	
$pdf->Ln(5);


$L_ALAMAT_DEST=strlen(trim($tujuan['alamat']));
if($L_ALAMAT_DEST>40){
	$pdf->Cell(60,0,'', 0, 0, 'C', false);	
	$pdf->MultiCell(70,5,$tujuan['alamat'],0,'L',false);
	$pdf->Ln(5);
	$pdf->Cell(5,-25,'2.', 0, 0, 'C', false);	
	$pdf->Cell(50,-25,'Alamat Tujuan Pindah', 0, 0, 'L', false);	
	$pdf->Cell(5,-25,':', 0, 0, 'C', false);	
	$pdf->Cell(70,0,'', 0, 0, 'C', false);	
	$pdf->Cell(7,-25,'RT', 0, 0, 'L', false);	
	$pdf->Cell(7,-25,$$tujuan['no_rt'].'/', 0, 0, 'L', false);	
	$pdf->Cell(8,-25,'RW', 0, 0, 'L', false);	
	$pdf->Cell(7,-25,$$tujuan['no_rw'], 0, 0, 'L', false);	
	$pdf->Ln(-5);
}elseif($L_ALAMAT_DEST>25){
	$pdf->Cell(5,0,'2.', 0, 0, 'C', false);	
	$pdf->Cell(50,0,'Alamat Tujuan Pindah', 0, 0, 'L', false);	
	$pdf->Cell(5,0,':', 0, 0, 'C', false);	
	$pdf->Cell(100,0,$$tujuan['alamat'], 0, 0, 'L', false);	
	$pdf->Cell(15,0,'RT/RW', 0, 0, 'L', false);	
	$pdf->Cell(10,0,' : '.$tujuan['no_rt'].'/'.$tujuan['no_rw'], 0, 0, 'L', false);	

}else{
	$pdf->Cell(5,0,'2.', 0, 0, 'C', false);	
	$pdf->Cell(50,0,'Alamat Tujuan Pindah', 0, 0, 'L', false);	
	$pdf->Cell(5,0,':', 0, 0, 'C', false);	
	$pdf->Cell(70,0,$tujuan['alamat'], 0, 0, 'L', false);	
	$pdf->Cell(15,0,'RT/RW', 0, 0, 'L', false);	
	$pdf->Cell(10,0,' : '.$tujuan['no_rt'].'/'.$tujuan['no_rw'], 0, 0, 'L', false);	
}

$pdf->Ln(5);


$pdf->Cell(10,0,'', 0, 0, 'C', false);	
$pdf->Cell(45,0,'a. Desa/Kelurahan', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(60,0,$tujuan['nama_kel'], 0, 0, 'L', false);	
$pdf->Cell(25,0,'c. Kab/Kota', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,'SURABAYA', 0, 0, 'L', false);	
$pdf->Ln(5);

$pdf->Cell(10,0,'', 0, 0, 'C', false);	
$pdf->Cell(45,0,'b. Kecamatan', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(60,0,$tujuan['nama_kec'], 0, 0, 'L', false);	
$pdf->Cell(25,0,'d. Propinsi', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,'JAWA TIMUR', 0, 0, 'L', false);	

$pdf->Ln(5);
$pdf->Cell(10,0,'', 0, 0, 'C', false);	
$pdf->Cell(45,0,'e. Kode Pos', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(60,0,'-', 0, 0, 'L', false);	
$pdf->Cell(25,0,'f. Telp', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$tujuan['telp_tujuan'], 0, 0, 'L', false);	
$pdf->Ln(5);

$pdf->Cell(5,0,'3.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Jenis Kepindahan', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['jenis_pindah'], 0, 0, 'L', false);	
$pdf->Ln(5);


$pdf->Cell(5,0,'4.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Status KK', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['status_kk_tdk_pindah'], 0, 0, 'L', false);	
$pdf->Ln(5);
$pdf->Cell(5,0,'', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Bagi Yang Tidak Pindah', 0, 0, 'L', false);	
$pdf->Ln(5);


$pdf->Cell(5,0,'5.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Status KK', 0, 0, 'L', false);	
$pdf->Cell(5,0,':', 0, 0, 'C', false);	
$pdf->Cell(0,0,$asal['status_kk_pindah'], 0, 0, 'L', false);	
$pdf->Ln(5);
$pdf->Cell(5,0,'', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Bagi Yang Pindah', 0, 0, 'L', false);	
$pdf->Ln(5);


$pdf->Cell(5,0,'6.', 0, 0, 'C', false);	
$pdf->Cell(50,0,'Keluarga Yang Datang', 0, 0, 'L', false);	
$pdf->Ln(7);

$pdf->SetFont('Times','',10);

$header = array(
	array("label"=>"NO", "length"=>10, "align"=>"C"),
	array("label"=>"NIK", "length"=>30, "align"=>"L"),
	array("label"=>"NAMA LENGKAP", "length"=>75, "align"=>"L"),
	
	array("label"=>"SHDK", "length"=>40, "align"=>"L"),
);

$pdf->SetFillColor(236,232,212);
foreach ($header as $kolom) {
	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
}	
$pdf->Ln(5);
$sql_dtl = "SELECT a.id , b.nik ,b.nama_lgkp ,(SELECT c.nama FROM reff_master c WHERE c.id = a.shdk) AS shdk
FROM keluar_detail a , biodata_wni b
WHERE a.nik_pemohon = b.nik AND a.id_keluar='$id' ";
$sqlbarang = mysqli_query($con,$sql_dtl);
$i = 0;
while ($data = mysqli_fetch_array($sqlbarang)){
	$pdf->Cell(10,5,$i++, 1, '0', 'C', false);	
	$pdf->Cell(30,5,$data['nik'], 1, '0', 'L', false);		
	$pdf->Cell(75,5,$data['nama_lgkp'], 1, '0', 'L', false);		
			
	$pdf->Cell(40,5,$data['shdk'], 1, '0', 'L', false);		
	$pdf->Ln(5);

}

$x = $pdf->GetX();
$y = $pdf->GetY();
$col1="Surat Keterangan Pindah (SKP) ini berlaku sebagai pengganti KTP selama KTP baru belum diterbitkan, paling lama 30 hari kerja sejak SKP diterbitkan.";
$pdf->MultiCell(0, 5, $col1, 0, 1);

$pdf->Ln(15);
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
$pdf->Cell(60,0,'', 0, 0, 'C', false);	
$pdf->Cell(71,0,'', 0, 0, 'C', false);	
$pdf->Cell(60,0,'Surabaya, '.ShowDate(date('y-m-d'),5), 0, 0, 'C', false);	
$pdf->Ln(5);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(20,0,'', 0, 0, 'C', false);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(70,0,'', 0, 0, 'C', false);	
$pdf->Cell(5,0,'', 0, 0, 'C', false);	
$pdf->Cell(60,0,'Dikeluarkan oleh :', 0, 0, 'C', false);	
$pdf->Ln(5);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(20,0,'', 0, 0, 'C', false);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(70,0,'', 0, 0, 'C', false);	
$pdf->Cell(5,0,'', 0, 0, 'C', false);	
$pdf->Cell(60,0,'Kepala Dinas Kependudukan dan', 0, 0, 'C', false);	
$pdf->Ln(5);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(20,0,'', 0, 0, 'C', false);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(70,0,'', 0, 0, 'C', false);	
$pdf->Cell(5,0,'', 0, 0, 'C', false);	
$pdf->Cell(60,0,'Pencatatan Sipil', 0, 0, 'C', false);	
$pdf->Ln(5);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(20,0,'', 0, 0, 'C', false);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(70,0,'', 0, 0, 'C', false);	
$pdf->Cell(5,0,'', 0, 0, 'C', false);	
$pdf->Cell(60,0,'', 0, 0, 'C', false);	
$pdf->Ln(15);
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(20,0,'', 0, 0, 'C', false);	
$pdf->Cell(70,0,'', 0, 0, 'C', false);	
$pdf->Cell(5,0,'', 0, 0, 'C', false);	
$pdf->Cell(60,0,'_________________________', 0, 0, 'C', false);	
$pdf->Ln(15);


// $pdf->Cell(0,0,'Keterangan :', 0, 0, 'L', false);	
// $pdf->Ln(7);
// $pdf->Cell(0,0,'*) Diisi Oleh Petugas', 0, 0, 'L', false);	
// $pdf->Ln(5);
// $pdf->Cell(0,0,'- Formulir ini diisi di Desa/Kelurahan.', 0, 0, 'L', false);	
// $pdf->Ln(5);
// $pdf->Cell(0,0,'- Lembar 1 dibawa oleh pemohon dan diarsipkan di Dinas Kependudukan dan Pencatatan Sipil.', 0, 0, 'L', false);	
// $pdf->Ln(5);
// $pdf->Cell(0,0,'- Lembar  2 untuk pemohon.', 0, 0, 'L', false);	
// $pdf->Ln(5);
// $pdf->Cell(0,0,'- Lembar  3 diarsipkan di Kecamatan.', 0, 0, 'L', false);	
// $pdf->Ln(5);


$pdf->Output();
?> 
