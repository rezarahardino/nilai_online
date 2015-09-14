<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $isi = $_POST[isi];
   $judul = $_POST[judul];
   $status = $_SESSION['gilang_status'];
   $id_user = $_SESSION[gilang_user];
   if($status == "GURU"){
		$sql = mysql_query("SELECT Nama_Guru FROM t_guru WHERE NIP='$id_user'")or die(mysql_error());	   
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
		
			 mysql_query("insert into tkomentarview 
										values('','$judul','$isi','$nama','$created')")or die(mysql_error());
													
	 		header("location:media.php?pages=komentarview");
		break;
		case "ubah"		: 
		
			mysql_query("Update tkomentarview 
										SET judul = '$judul', isi = '$isi',created = '$created' 
										WHERE id = '$id'") or die (mysql_error());
			
		
						  header("location:media.php?pages=komentar_view");
						  break;
		case "hapus"	: mysql_query("delete from tkomentar where id = '$kid'");
						  header("location:media.php?pages=view_kontak");
						  break;
		 
   }
 
?>
