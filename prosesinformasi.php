<?php
	session_start();
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $isi = $_POST[isi];
   $judul = $_POST[judul];
   $status = $_SESSION['status'];
   $id_user = $_SESSION[nama_user];
   if($status == "Guru"){
		$sql = mysql_query("SELECT NIP FROM tguru WHERE NIP='$id_user'")or die(mysql_error());	   
		$data_guru = mysql_fetch_array($sql);
		$nama = $data_guru['Nama_Guru'];
   }else{
		$nama = "Admin";   
   }
   $created = date('Y-m-d h:i:s');
   $id = $_POST[id];
   $kid = $_GET['kid'];
   switch ($mod)
   {
   		
   		case "tambah"	: 
		//echo $id_user;exit;
			 mysql_query("insert into tinformasi 
										values('','$judul','$isi','$id_user','$created')")or die(mysql_error());
													
	 		header("location:media.php?pages=informasi");
		break;
		case "ubah"		: 
		
			mysql_query("Update tinformasi 
										SET judul = '$judul', isi = '$isi',created = '$created' 
										WHERE id = '$id'") or die (mysql_error());
			
		
						  header("location:media.php?pages=informasi");
						  break;
		case "hapus"	: mysql_query("delete from tinformasi where id = '$kid'");
						  header("location:media.php?pages=informasi");
						  break;
		 
   }
 
?>