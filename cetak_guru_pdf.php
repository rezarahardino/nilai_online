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
	$this->Cell(180,20,'Sistem Informasi Nilai Online SMA Negeri 1 Bumiayu',0,0,'C');
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
$pdf->text(95,35,'DATA GURU'.$tahun);
$yi = 60;
$ya = 54;
$pdf->setFont('Arial','',6);
$pdf->setFillColor(222,222,222);
$pdf->setXY(7,$ya);

$pdf->CELL(25,5,'NIP',1,0,'C',1);									
$pdf->CELL(25,5,'Nama',1,0,'C',1);
$pdf->CELL(15,5,'Jenis Kelamin',1,0,'C',1);
$pdf->CELL(12,5,'Agama',1,0,'C',1);
$pdf->CELL(15,5,'Tempat Lahir',1,0,'C',1);
$pdf->CELL(15,5,'Tanggal Lahir',1,0,'C',1);
$pdf->CELL(27,5,'Email',1,0,'C',1);
$pdf->CELL(50,5,'Alamat',1,0,'C',1);
$pdf->CELL(16,5,'Telepon',1,0,'C',1);


$ya = $yi + $row;
include "config/koneksi.php";

$kat = $_GET[kat];
$key = $_GET[key];

if($kat=="NIP"){
		$queryx=" where tguru.NIP like '%".$key."%'";
	}
	
	if($kat=="Nama_Guru"){
		$queryx=" where tguru.Nama_Guru like '%".$key."%'";
	}
if($kat=="nis"){
		$queryx=" where tsiswa.nis like '%".$key."%'";
	}
	
	if($kat=="nama"){
		$queryx=" where tbiodata.Nama like '%".$key."%'";
	}
$sql = mysql_query("SELECT tguru.* FROM tguru" . $queryx. " ORDER BY tguru.NIP")or die ("salah sql");
$i = 1;
$no = 1;
$max = 31;
$row = 6;
while($data = mysql_fetch_array($sql)){
$pdf->setXY(7,$ya);
$pdf->setFont('arial','',6);
$pdf->setFillColor(255,255,255);

$pdf->cell(25,5,$data[NIP],1,0,'L',1);
$pdf->CELL(25,5,$data[Nama_Guru],1,0,'C',1);
$pdf->CELL(15,5,$data[Jenis_Kelamin],1,0,'C',1);
$pdf->CELL(12,5,$data[agama],1,0,'C',1);
$pdf->CELL(15,5,$data[tempat_lahir],1,0,'C',1);
$pdf->CELL(15,5,$data[tgl_lahir],1,0,'C',1);
$pdf->CELL(27,5,$data[email],1,0,'C',1);
$pdf->CELL(50,5,$data[alamat],1,0,'C',1);
$pdf->CELL(16,5,$data[No_Telp],1,0,'C',1);


$ya = $ya+$row;
$no++;
$i++;
$dm[kode] = $data[kdprog];
}


$pdf->Output();
?>