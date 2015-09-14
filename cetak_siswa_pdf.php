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
$pdf->text(95,35,'DATA SISWA'.$tahun);
$yi = 60;
$ya = 54;
$pdf->setFont('Arial','',6);
$pdf->setFillColor(222,222,222);
$pdf->setXY(10,$ya);

$pdf->CELL(10,5,'NIS',1,0,'C',1);									
$pdf->CELL(25,5,'Nama',1,0,'C',1);
$pdf->CELL(15,5,'Jenis Kelamin',1,0,'C',1);
$pdf->CELL(12,5,'Agama',1,0,'C',1);
$pdf->CELL(15,5,'Tempat Lahir',1,0,'C',1);
$pdf->CELL(15,5,'Tanggal Lahir',1,0,'C',1);
$pdf->CELL(27,5,'Email',1,0,'C',1);
$pdf->CELL(10,5,'Kelas',1,0,'C',1);
$pdf->CELL(50,5,'Alamat',1,0,'C',1);
$pdf->CELL(16,5,'Telepon',1,0,'C',1);

$ya = $yi + $row;
include "config/koneksi.php";

$kat = $_GET[kat];
$key = $_GET[key];

if($kat=="nis"){
		$queryx=" where tsiswa.nis like '%".$key."%'";
	}
	
	if($kat=="nama"){
		$queryx=" where tsiswa.Nama like '%".$key."%'";
	}
	if($kat=="kelas"){
		$queryx=" where tkelas.Nama_Kelas like '%".$key."%'";
	}
$sql = mysql_query("SELECT tsiswa.*, tsiswa.nis, tkelas.Nama_Kelas FROM tsiswa 
						INNER JOIN tkelas ON tkelas.ID_Kelas = tsiswa.id_kelas
						".$queryx."ORDER BY tsiswa.nis")or die ("Error");
$i = 1;
$no = 1;
$max = 31;
$row = 6;
while($data = mysql_fetch_array($sql)){
$pdf->setXY(10,$ya);
$pdf->setFont('arial','',6);
$pdf->setFillColor(255,255,255);

$pdf->cell(10,5,$data[nis],1,0,'L',1);
$pdf->CELL(25,5,$data[Nama],1,0,'C',1);
$pdf->CELL(15,5,$data[Jenis_Kelamin],1,0,'C',1);
$pdf->CELL(12,5,$data[agama],1,0,'C',1);
$pdf->CELL(15,5,$data[Tempat_Lahir],1,0,'C',1);
$pdf->CELL(15,5,$data[Tgl_Lahir],1,0,'C',1);
$pdf->CELL(27,5,$data[Email],1,0,'C',1);
$pdf->CELL(10,5,$data[Nama_Kelas],1,0,'C',1);
$pdf->CELL(50,5,$data[Alamat],1,0,'C',1);
$pdf->CELL(16,5,$data[No_Telp],1,0,'C',1);




$ya = $ya+$row;
$no++;
$i++;
$dm[kode] = $data[kdprog];
}


$pdf->Output();
?>