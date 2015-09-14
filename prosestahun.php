<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $id= $_POST[id];
   $tahun = $_POST[tahun];
   //print_r($_POST[password]);exit;
   $type = $_POST[type];
   $id = $_POST[id];
   $kode=$_POST[kode];
    $kid = $_GET[kid];
   switch ($mod)
   {
   		
   		case "tambah"	: 
					mysql_query("insert into ttahun_ajaran 
										values('$kode','$tahun')");
													
	 		header("location:media.php?pages=tahun_ajaran");
		break;
		case "ubah"		: 
		mysql_query("update ttahun_ajaran set tahun='$tahun' where id = '$id'")or die(mysql_error());
									
						  header("location:media.php?pages=tahun_ajaran");
						  break;
		
		case "hapus"	: mysql_query("delete from ttahun_ajaran where id = '$kid'");
						  header("location:media.php?pages=tahun_ajaran");
						  break;
   }
 
?>