<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $kode= $_POST[kode];
   $nama = $_POST[nama];
   $lama = $_POST[lama];
   $id_guru= $_POST[id_guru];
   $tahun=$_POST[tahun];
   $kkm=$_POST[kkm];
   $kid = $_GET['kid'];
   switch ($mod)
   {
   		
   		case "tambah"	: 
		
		mysql_query("insert into tmatapelajaran 
										values('$kode','$nama','$id_guru', '$tahun', '$kkm')")or die(mysql_error());
													
	 		header("location:media.php?pages=mata_pelajaran");
		break;
		case "ubah"		: 
		  //move_uploaded_file($lokasi,"image/foto/$photo");
  		  mysql_query("Update tmatapelajaran 
										SET Nama_MP='$nama', id_guru='$id_guru', id_tahun_ajaran='$tahun', kkm='$kkm' WHERE  Kode_Mp = '$kode'") or die (mysql_error());										
						  header("location:media.php?pages=mata_pelajaran");
						  break;
		case "hapus"	: mysql_query("delete from tmatapelajaran where Kode_Mp = '$kid'");
						  header("location:media.php?pages=mata_pelajaran");
						  break;		
   }
?>