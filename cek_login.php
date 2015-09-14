<?php
include "config/koneksi.php";
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$username = $_POST[username];
$pass     = $_POST[password];

$login=mysql_query("SELECT * FROM t_user WHERE nama_user='$username' AND kata_kunci='$pass'") or die(mysql_error());
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
if ($ketemu > 0){
  session_start();
  session_register("nama_user");
  session_register("kata_kunci");
  session_register("status");

  $_SESSION[nama_user]  = $r[nama_user];
  $_SESSION[kata_kunci] = $r[kata_kunci];
  $_SESSION[status]     = $r[status];
  
  $sql = mysql_query("SELECT * FROM tkelas WHERE ID_Guru='$username'");
  $cek = mysql_num_rows($sql);
  $s = mysql_fetch_array($sql);
  if($cek>0){
	  $_SESSION[wali_kelas] = "wali_kelas";
	  $_SESSION[id_kelas] = $s['ID_Kelas'];
	  }
  
  header('location:media.php?pages=home');
}
else{
echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>";
  echo "<center><br><br><br><br><br><br><b>LOGIN GAGAL</b><br>
        Username atau Password Anda Salah<br><br><br>";
		echo "<div> <a href='index.php'><img src='images/seru.png'  height=147 width=176><br><br></a>
             </div>";
  echo "<input type=button class=simplebtn value='COBA LAGI' onclick=location.href='index.php'></a></center>";

}
?>
