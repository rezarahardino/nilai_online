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
$pdf->text(87,35,'JADWAL PELAJARAN'.$tahun);
$yi = 60;
$ya = 54;
$pdf->setFont('Arial','',6);
$pdf->setFillColor(222,222,222);
$pdf->setXY(50,$ya);

$pdf->CELL(15,5,'Hari',1,0,'C',1);									
$pdf->CELL(20,5,'Kelas',1,0,'C',1);
$pdf->CELL(30,5,'Nama Mata Pelajaran',1,0,'C',1);
$pdf->CELL(30,5,'Guru / Pengajar',1,0,'C',1);
$pdf->CELL(20,5,'Jam Pelajaran',1,0,'C',1);

$ya = $yi + $row;
include "config/koneksi.php";

$kelas = $_GET[kelas];
$hari = $_GET[hari];
$nis = $_GET[nip];

	
	if(!empty($hari)){
		$queryx=" where tjadwalpelajaran.Hari like '%".$hari."%'";
	
	}
	
	if(!empty($kelas)){
		$queryx=" where tjadwalpelajaran.id_kelas ='".$kelas."'";
		
	}
	
	if(!empty($nis)){
		$queryx=" where tguru.Nama_Guru like '%".$nis."%'";
		
	}
	
	if($_SESSION[status]=="Guru"){
		$queryx = " where tguru.NIP='$_SESSION[nama_user]'";
	}	

if($_SESSION[status]=="Siswa"){
	$sql = mysql_query("SELECT * FROM tsiswa WHERE nis='".$_SESSION[nama_user]."'");
		$result = mysql_fetch_array($sql);
		$id_kelas = $result['id_kelas'];
		$queryx = " where tjadwalpelajaran.id_kelas='$id_kelas'";
	}	
	
$sql = mysql_query("SELECT tjadwalpelajaran.*, tjadwalpelajaran.ID_Jadwal, tmatapelajaran.Nama_MP, tkelas.Nama_Kelas, tguru.Nama_Guru FROM tjadwalpelajaran
				   
						INNER JOIN tmatapelajaran ON tmatapelajaran.Kode_Mp = tjadwalpelajaran.Kode_Mp
						INNER JOIN tkelas ON tkelas.ID_Kelas = tjadwalpelajaran.ID_Kelas
						INNER JOIN tguru ON tguru.NIP =  tmatapelajaran.id_guru
						".$queryx." ORDER BY tjadwalpelajaran.urut")or die (mysql_error());
						
$i = 1;
$no = 1;
$max = 31;
$row = 6;
while($data = mysql_fetch_array($sql)){
$pdf->setXY(50,$ya);
$pdf->setFont('arial','',6);
$pdf->setFillColor(255,255,255);

$pdf->cell(15,5,$data[Hari],1,0,'C',1);
$pdf->CELL(20,5,$data[Nama_Kelas],1,0,'C',1);
$pdf->CELL(30,5,$data[Nama_MP],1,0,'C',1);
$pdf->CELL(30,5,$data[Nama_Guru],1,0,'C',1);
$pdf->CELL(20,5,$data[Jam_Pelajaran],1,0,'C',1);

$ya = $ya+$row;
$no++;
$i++;
$dm[kode] = $data[kdprog];
}


$pdf->Output();
?>