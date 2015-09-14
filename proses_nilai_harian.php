<?php
	session_start();
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $nis = $_POST[nis];
   $id_nilai_harian= $_POST[id_nilai_harian];
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
	$jadwal = mysql_query("select * from nilai_harian where Smester='$semester' and id_kelas='$id_kelas' AND Kode_Mp='$kodemp'")or die(mysql_error());
		$cek = mysql_fetch_array($jadwal);
		if(empty($cek)){
			
		$jum = $_POST['jum'];
		$nil = $_POST['UH1'];
		$nil2 = $_POST['UH2'];
		$nil3 = $_POST['UH3'];
		$nil4 = $_POST['UH4'];
		$nil5 = $_POST['UH5'];
		$nil6 = $_POST['UH6'];
		$nil7 = $_POST['UTS'];
		$nil8 = $_POST['UAS'];
		for($a=1;$a<=$jum;$a++){
			$mapel = $mem[$a];
			$nilai_pel = $nil[$a];
			$UH2 = $nil2[$a];
			$UH3 = $nil3[$a];
			$UH4 = $nil4[$a];
			$UH5 = $nil5[$a];
			$UH6 = $nil6[$a];
			$UTS = $nil7[$a];
			$UAS = $nil8[$a];
			$nis = $_POST[nis][$a];
			//echo $nilai_pel;
			if(!empty($nilai_pel)){
			 
			
				mysql_query("insert into nilai_harian 
										values('','$nis','$id_kelas','$kodemp','$nilai_pel','$UH2','$UH3','$UH4','$UH5','$UH6','$UTS','$UAS','$semester','$tahun')")or die(mysql_error());
				}
			}
			
	 		header("location:media.php?pages=nilai_harian&kodemp=$kodemp&semester=$semester");
			}else{
			header("location:media.php?pages=nilai_harian&action=tambah&nis=$nis&pesan=ada");
			}
		break;
		case "ubah"		: 
		
			mysql_query("Update nilai_harian 
										SET Kode_Mp = '$Kode_Mp',Smester = '$semester',UH1 = '$UH1',UH2 = '$UH2',UH3 = '$UH3',UH4 = '$UH4',UH5 = '$UH5',UH6 = '$UH6',UTS = '$UTS',UAS = '$UAS', 
										WHERE id_nilai_harian = '$id_nilai_harian'") or die (mysql_error());
			
		
						  header("location:media.php?pages=nilai_harian");
						  break;
		case "hapus"	: mysql_query("delete from nilai_harian where id_nilai_harian = '$kid'");
						  header("location:media.php?pages=nilai_harian&nis=$nis");
						  break;
		 
   }
 
?>