<?php
	session_start();
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $nis = $_POST[nis];
   $id_kompetensi= $_POST[id_kompetensi];
   $jenis_nilai = $_POST[jenis_nilai];
   $semester = $_POST[semester];
  
   $nilai = $_POST[nilai];
   $Kode_Mp = $_POST[Kode_Mp];
   $kid = $_GET['kid'];
   $status = $_POST[status];
   $id_kelas = $_SESSION[id_kelas];
   $tahun = $_POST[tahun];
   $kodemp = $_POST[kodemp];
   switch ($mod)
   {
   		
   		case "tambah"	: 
		//echo $id_kelas;exit;											
	$jadwal = mysql_query("select * from kompetensi where Smester='$semester' and id_kelas='$id_kelas' AND Kode_Mp='$kodemp'")or die(mysql_error());
		$cek = mysql_fetch_array($jadwal);
		if(empty($cek)){
			
		$jum = $_POST['jum'];
		$nil = $_POST['nilai'];
		for($a=1;$a<=$jum;$a++){
			$mapel = $mem[$a];
			$nilai_pel = $nil[$a];
			$nis = $_POST[nis][$a];
			//echo $nilai_pel;
			if(!empty($nilai_pel)){
			 
			
				mysql_query("insert into kompetensi 
										values('','$nis','$id_kelas','$kodemp','$nilai_pel','$semester','$tahun')")or die(mysql_error());
				}
			}
			
	 		header("location:media.php?pages=kompetensi&kodemp=$kodemp&semester=$semester");
			}else{
			header("location:media.php?pages=kompetensi&action=tambah&nis=$nis&pesan=ada");
			}
		break;
		case "ubah"		: 
		
			mysql_query("Update kompetensi 
										SET Kode_Mp = '$Kode_Mp',Smester = '$semester',ketercapaian_kompetensi = '$nilai' 
										WHERE id_kompetensi = '$id_kompetensi'") or die (mysql_error());
			
		
						  header("location:media.php?pages=kompetensi");
						  break;
		case "hapus"	: mysql_query("delete from kompetensi where id_kompetensi = '$kid'");
						  header("location:media.php?pages=kompetensi&nis=$nis");
						  break;
		 
   }
 
?>