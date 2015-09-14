<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $username= $_POST[nama_user];
   $password = $_POST[password];
   //print_r($_POST[password]);exit;
   $type = $_POST[type];
   $id = $_POST[id];
    $kid = $_GET[kid];
   switch ($mod)
   {
   		
   		case "tambah"	: 
					mysql_query("insert into t_user 
										values('','$username','$password','$type')");
													
	 		header("location:media.php?pages=user");
		break;
		case "ubah"		: 
		mysql_query("update t_user set kata_kunci='$password' where id = '$id'")or die(mysql_error());
									
						  header("location:media.php?pages=user");
						  break;
		case "ubah_password"		: 
		mysql_query("update t_user set kata_kunci='$password' where nama_user = '$id'")or die(mysql_error());
									
						  header("location:media.php?pages=home");
						  break;
		case "hapus"	: mysql_query("delete from t_user where id = '$kid'");
						  header("location:media.php?pages=user");
						  break;
   }
 
?>