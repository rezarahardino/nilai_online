<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $nis = $_POST[nis];
   $id_pengembangan_diri= $_POST[id_pengembangandiri];
   $jenis_nilai = $_POST[jenis_nilai];
   $semester = $_POST[semester];
   $semes = $_GET[semester];
   $nilai = $_POST[nilai];
   $Kode_Mp = $_POST[Kode_Mp];
   $kid = $_GET['kid'];
   $status = $_POST[status];
   $id_kelas = $_POST[id_kelas];
   $jenis = $_POST[jenis];
   $keterangan = $_POST[keterangan];
   $tahun = $_POST[tahun];
   switch ($mod)
   {
   		
   		case "tambah"	: 
		
			 mysql_query("insert into pengembangan_diri 
										values('','$nis','$semester','$id_kelas','$tahun','$jenis','$keterangan')")or die(mysql_error());
													
	 		header("location:media.php?pages=pengembangan&nis=$nis");
		break;
		case "ubah"		: 
		
			mysql_query("Update pengembangan_diri 
										SET jenis_kegiatan = '$jenis',semester = '$semester',keterangan = '$keterangan' 
										WHERE id_pengembangandiri = '$id_pengembangan_diri'") or die (mysql_error());
			
		
						  header("location:media.php?pages=pengembangan&nis=$nis");
						  break;
		case "hapus"	: mysql_query("delete from pengembangan_diri where id_pengembangandiri = '$kid'");
						  header("location:media.php?pages=pengembangan&nis=$nis");
						  break;
		 
   }
 
?>