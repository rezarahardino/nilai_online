<? session_start();
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $password= $_POST[password];
   $cpassword= $_POST[cpassword];
   
   $sql_cek = mysql_query("SELECT * FROM t_user WHERE nama_user='" . $_POST[username] . "'")or die(mysql_error());
   $cek = mysql_num_rows($sql_cek);
   if($cek ==0){
	   header('location:index.php?pages=lupa&pesan=kosong');
   }elseif($password != $cpassword){
	   header('location:index.php?pages=lupa&pesan=pass_salah');
	
   }else{
   mysql_query("Update t_user 
										SET kata_kunci = '$cpassword' WHERE  nama_user = '" . $_POST[username] . "'") or die (mysql_error());
   header('location:index.php?pesan=ok');
	}
 
?>