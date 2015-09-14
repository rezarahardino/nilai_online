<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $ID_Kelas= $_POST[ID_Kelas];
   $nama_kelas = $_POST[nama_kelas];
   $id_guru = $_POST[id_guru];
   $nis = $_POST[nis];
   $kode = $_POST[kode];
   $tahun=$_POST[tahun];
   $program=$_POST[program];
   $tahun=$_POST[tahun];
   $kid = $_GET['kid'];
   switch ($mod)
   {
   		
   		case "tambah"	: 
		
		mysql_query("insert into tkelas 
										values('$ID_Kelas','$nama_kelas','$id_guru', '$tahun')")or die(mysql_error());
													
	 		header("location:media.php?pages=kelas");
		break;
		case "ubah"		: 
		  //move_uploaded_file($lokasi,"image/foto/$photo");
  		  mysql_query("Update tkelas 
										SET Nama_Kelas = '$nama_kelas',ID_Guru= '$id_guru', id_tahun_ajaran='$tahun' WHERE  ID_Kelas = '$ID_Kelas'") or die (mysql_error());
						  header("location:media.php?pages=kelas");
						  break;
		case "hapus"	: mysql_query("delete from tkelas where ID_Kelas = '$kid'");
						  header("location:media.php?pages=kelas");
						  break;
						  
   }
 
?>