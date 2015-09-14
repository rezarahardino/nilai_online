<? session_start();
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $password_lama= $_POST[password_lama];
   $password_baru= $_POST[password_baru];
   $sql_cek = mysql_query("SELECT * FROM t_user WHERE nama_user='" . $_SESSION[nama_user] . "' AND kata_kunci='$password_lama'")or die(mysql_error());
   $cek = mysql_num_rows($sql_cek);
   if($cek ==0){
	   header('location:media.php?pages=ganti_password&pesan=kosong');
   }else{
   mysql_query("Update t_user 
										SET kata_kunci = '$password_baru' WHERE  nama_user = '" . $_SESSION[nama_user] . "'") or die (mysql_error());
   header('location:media.php?pages=ganti_password&pesan=berhasil');
	}
 
?>