<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $nis = $_POST[nis];
   $id_catatan= $_POST[id_catatan];
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
		
			 mysql_query("insert into catatan_prestasi 
										values('','$nis','$semester','$id_kelas','$tahun','$jenis','$keterangan')")or die(mysql_error());
													
	 		header("location:media.php?pages=catatanprestasi&nis=$nis");
		break;
		case "ubah"		: 
		
			mysql_query("Update catatan_prestasi 
										SET kegiatan = '$jenis',semester = '$semester',bukti_sertifikasi = '$keterangan' 
										WHERE id_catatan = '$id_catatan'") or die (mysql_error());
			
		
						  header("location:media.php?pages=catatanprestasi&nis=$nis");
						  break;
		case "hapus"	: mysql_query("delete from catatan_prestasi where id_catatan = '$kid'");
						  header("location:media.php?pages=catatanprestasi&nis=$nis");
						  break;
		 
   }
 
?>