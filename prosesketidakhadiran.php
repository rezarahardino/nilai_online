<?
	session_start();
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $nis = $_POST[nis];
   $id_ketidakhadiran= $_POST[id_ketidakhadiran];
   $jenis_nilai = $_POST[jenis_nilai];
   $semester = $_POST[semester];
   $semes = $_GET[semester];
   $sakit = $_POST[sakit];
   $ijin = $_POST[ijin];
   $alpha = $_POST[alpha];
   $keterangan = $_POST[keterangan];
   $Kode_Mp = $_POST[Kode_Mp];
   $kid = $_GET['kid'];
   $status = $_POST[status];
   $id_kelas = $_SESSION[id_kelas];
   $tahun = $_POST[tahun];
   switch ($mod)
   {
   		case "tambah"	: 
	/*		 mysql_query("insert into ketidakhadiran 
										values('','$nis','$semester','$id_kelas','$tahun','$sakit','$ijin','$alpha')")or die(mysql_error());*/
		$jum = $_POST['jum'];
		//echo $jum;
		for($a=1;$a<=$jum;$a++){
			$nis = $_POST[nis][$a];
			$ijin = $_POST[ijin][$a];
			$alpha = $_POST[alpha][$a];
			$sakit = $_POST[sakit][$a];
			$keterangan = $_POST[keterangan][$a];
			$n = $max[$a];
			//echo $nilai_pel;
		//	if(!empty($sakit)){
			 mysql_query("insert into ketidakhadiran 
										values('','$nis','$semester','$id_kelas','$tahun','$sakit','$ijin','$alpha','$keterangan')")or die(mysql_error());
			//	}
			}
								
													
	 		header("location:media.php?pages=ketidakhadiran");
		break;
		case "ubah"		: 
		
			mysql_query("Update ketidakhadiran 
										SET sakit = '$sakit',ijin = '$ijin',alpha = '$alpha',keterangan = '$keterangan', semester = '$semester' 
										WHERE id_ketidakhadiran = '$id_ketidakhadiran'") or die (mysql_error());
			
		
						  header("location:media.php?pages=ketidakhadiran");
						  break;
		case "hapus"	: mysql_query("delete from ketidakhadiran where id_ketidakhadiran = '$kid'");
						  header("location:media.php?pages=ketidakhadiran");
						  break;
		 
   }
 
?>