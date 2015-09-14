<?php
	session_start();
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $nis = $_POST[nis];
   $ID_Nilai= $_POST[ID_Nilai];
   $jenis_nilai = $_POST[jenis_nilai];
   $semes = $_GET[semester];
   $semester = $_POST[semester];
   $nilai = $_POST[nilai];
   $Kode_Mp = $_POST[Kode_Mp];
   $kid = $_GET['kid'];
   $n = $_GET['n'];
   $status = $_POST[status];
   $id_kelas = $_SESSION[id_kelas];
   $tahun = $_POST[tahun];
   $kodemp = $_POST[kodemp];
   switch ($mod)
   {
   		
   		case "tambah"	: 
		//print_r($_POST);
		//exit;
		//cek nilai semester
		$jadwal = mysql_query("select * from tnilai where Smester='$semester' and id_kelas='$id_kelas' AND Kode_Mp='$kodemp'")or die(mysql_error());
		$cek = mysql_fetch_array($jadwal);
		if(empty($cek)){
			
		$jum = $_POST['jum'];
		$nil = $_POST['nilai'];
		$p = $_POST['praktik'];
		$pre = $_POST['predikat'];
		$max = $_POST['max'];
		for($a=1;$a<=$jum;$a++){
			$nis = $_POST[nis][$a];
			$nilai_pel = $nil[$a];
			$praktik = $p[$a];
			$predikat = $pre[$a];
			$n = $max[$a];
			//echo $nilai_pel;
			if(!empty($nilai_pel)){
			 mysql_query("insert into tnilai 
values('','$nis','$id_kelas','$kodemp','$nilai_pel','$praktik','$predikat','$semester','$tahun','')")or die(mysql_error());
				}
			}

			//exit;
	 		header("location:media.php?pages=nilai&kodemp=$kodemp&semester=$semester");
		}else{
			header("location:media.php?pages=nilai&kodemp=$kodemp&semester=$semester&pesan=ada");
			}
		break;
		case "tambah_nilai"	: 
		
			 mysql_query("insert into tnilai 
										values('','$nis','$id_kelas','$Kode_Mp','$nilai','$semester','$jenis_nilai')")or die(mysql_error());
													
	 		header("location:media.php?pages=isi_nilai_siswa&kode=$Kode_Mp");
		
		break;
		
		case "ubah"		: 
		
			mysql_query("Update tnilai 
										SET Smester = '$semester',nilai = '$nilai', praktik='$_POST[praktik]', predikat='$_POST[predikat]' 
										WHERE ID_Nilai = '$ID_Nilai'") or die (mysql_error());
			
		
						  header("location:media.php?pages=nilai");
						  break;
		case "hapus"	: mysql_query("delete from tnilai where ID_Nilai = '$kid'");
						  header("location:media.php?pages=nilai&nis=$n");
						  break;
		 
   }
 
?>