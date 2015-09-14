<?php
session_start();
require('pdf/fpdf.php');
class PDF extends FPDF
{
//Page header
function Header()
{
	//Logo
	//$this->Image('',12,10,33);
	//Arial bold 15
	$this->SetFont('Arial','B',15);
	//Move to the right
	$this->Cell(10);
	//Title
	$this->Cell(175,20,'Sistem Informasi Nilai Online SMA Negeri 1 Bumiayu',0,0,'C');
	//Line break
	$this->Ln(20);
}

//Page footer
function Footer(){
	//Position at 1.5 cm from bottom
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			}
}

$tgl = date('d - m - Y');

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$tahun = $_GET['tahun'];
$pdf->text(75,35,'LAPORAN NILAI KEPRIBADIAN');
$pdf->text(100,45,$tahun);
$yi = 60;
$ya = 54;
$pdf->setFont('Arial','',6);
$pdf->setFillColor(222,222,222);
$pdf->setXY(10,$ya);


$pdf->CELL(15,5,'NIS',1,0,'C',1);
$pdf->CELL(15,5,'Kelas',1,0,'C',1);	
$pdf->CELL(12,5,'Semester',1,0,'C',1);
$pdf->CELL(15,5,'Kedisplinan',1,0,'C',1);
$pdf->CELL(15,5,'Kebersihan',1,0,'C',1);
$pdf->CELL(15,5,'Kesehatan',1,0,'C',1);
$pdf->CELL(15,5,'Tng Jawab',1,0,'C',1);
$pdf->CELL(15,5,'Sopan Santun',1,0,'C',1);
$pdf->CELL(15,5,'Percaya Diri',1,0,'C',1);
$pdf->CELL(15,5,'Kompetetif',1,0,'C',1);	
$pdf->CELL(15,5,'Hub Sosial',1,0,'C',1);
$pdf->CELL(15,5,'Kejujuran',1,0,'C',1);
$pdf->CELL(15,5,'Plksn Ibadah',1,0,'C',1);


$ya = $yi + $row;
include "config/koneksi.php";

$kelas = $_GET[kelas];
$tahun = $_GET[tahun];
$nis = $_GET[nis];
$semester = $_GET[semester];
$query='';
if(!empty($kelas)){
		$queryx.=" and tkelas.Nama_Kelas like '%".$kelas."%'";
}	
if(!empty($tahun)){
	$queryx.=" and ttahun_ajaran.tahun like '%".$tahun."%'";

}	
if(!empty($nis)){
	$queryx.=" and kepribadian.nis like '%".$nis."%'";
	
}	
if(!empty($semester)){
	$queryx.=" and kepribadian.semester like '%".$semester."%'";
	
}

if($_SESSION[status]=="Siswa"){
	$queryx .= " and kepribadian.nis='$_SESSION[nama_user]' ";
	}

$sql = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, kepribadian.*
							 FROM tsiswa 
							 	INNER JOIN kepribadian ON kepribadian.nis = tsiswa.nis
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = kepribadian.id_kelas
								INNER JOIN ttahun_ajaran ON ttahun_ajaran.id = tsiswa.tahun_ajaran
								where kepribadian.id_kepribadian <> '' $queryx")or die ("Error");
$i = 1;
$no = 1;
$max = 31;
$row = 6;
while($data = mysql_fetch_array($sql)){
$pdf->setXY(10,$ya);
$pdf->setFont('arial','',6);
$pdf->setFillColor(255,255,255);


$pdf->cell(15,5,$data[nis],1,0,'C',1);
$pdf->cell(15,5,$data[Nama_Kelas],1,0,'C',1);
$pdf->CELL(12,5,$data[semester],1,0,'C',1);
$pdf->CELL(15,5,$data[kedisiplinan],1,0,'C',1);
$pdf->CELL(15,5,$data[kebersihan],1,0,'C',1);
$pdf->CELL(15,5,$data[kesehatan],1,0,'C',1);
$pdf->CELL(15,5,$data[tanggung_jawab],1,0,'C',1);
$pdf->CELL(15,5,$data[sopan_santun],1,0,'C',1);
$pdf->CELL(15,5,$data[percaya_diri],1,0,'C',1);
$pdf->CELL(15,5,$data[kompetetif],1,0,'C',1);
$pdf->CELL(15,5,$data[hubungan_sosial],1,0,'C',1);
$pdf->CELL(15,5,$data[kejujuran],1,0,'C',1);
$pdf->CELL(15,5,$data[pelaksanaan_ibadah],1,0,'C',1);

$ya = $ya+$row;
$no++;
$i++;
$dm[kode] = $data[kdprog];
}


$pdf->Output();
?>