<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$tgl=date("Y-m-d");
$jam = date("H:i");
include"config/fungsi_indotgl.php";
include"config/fungsi_hari.php";
//error_reporting(0);
if (empty($_SESSION['nama_user']) AND empty($_SESSION['kata_kunci'])){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>


 <center><br><br><br><br><br><br>Untuk Masuk <b>Halaman Ini</b><br>
  <center>Anda Harus <b>Login</b> Terlebih Dahulu<br><br>";
 echo "<div> <a href='index.php'><img src='images/kunci.png'></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN' onclick=location.href='index.php'></a></center>";
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="Nilai Online"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>Nilai Online SMA Negeri 1 Bumiayu</title>

<link rel="shortcut icon" href="images/logo.png">
<link rel="stylesheet" href="css/reset.css" type="text/css"/>
<link rel="stylesheet" href="css/screen.css" type="text/css"/>
<link rel="stylesheet" href="css/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize-light.css" type="text/css"/>
	

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.idtabs.js"></script>
<script type="text/javascript" src="js/jquery.datatables.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.js"></script>
<script type="text/javascript" src="js/jquery.ui.js"></script>

<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>
<script type="text/javascript" src="js/Geometr231_Hv_BT_400.font.js"></script>


<style type="text/css">
<!--
.style3 {
	color: #62A621;
	font-weight: bold;
}
-->
</style>
</head>

<body onLoad="show_clock(),SLIDES.play(),popup()">
	
	<div class="sidebar">
		<div class="logo clear">
		  <?php if ($_SESSION[status]=='Admin'){?>
		  <img src="images/logo_media.png"/>
		  <?php }else if ($_SESSION[status]=='Guru'){ ?>
         <img src="images/logo_media.png"/>
		<?php }else if ($_SESSION[status]=='Siswa'){ ?>
         <img src="images/logo_media.png"/>
		<?php } ?>
                
</div>
<div align="center"><font face="Tahoma" color="#0066FF"><?php echo hari(); ?>, <?php echo tgl_indo($tgl);?></font></div>
<div align="center"><script language="javascript" src="inc/liveclock_lite.js"></script>
</div>
<br></br>

		<div class="menu">
        
		  <ul>
		    <li><?php if ($_SESSION[status]=='Admin'){?>
         <img src="images/menu_admin.png" alt="" class="icon" />
          <?php }elseif($_SESSION[status]=='Siswa'){?>
			  <img src="images/menu_siswa.png" alt="" class="icon" />
			<?  }else{?>
              <img src="images/menu_guru.png" alt="" class="icon" />
              <? } ?>
				  <ul>
					<?php include "menu2.php"; ?>
			</ul>
			</li>
            </ul>
    </div>
    <p><?php include "kanan.php"; ?>&nbsp;</p>
   	</div>
	
	
	<div class="main"> <!-- *** mainpage layout *** -->
	<div class="main-wrap">
		<div class="header clear">
			<ul class="links clear">
			
          <li>..:: <strong>Selamat Datang <?php 
		  if($_SESSION['status']=="Siswa"){
			$sql = mysql_fetch_array(mysql_query("SELECT Nama From tsiswa WHERE nis='$_SESSION[nama_user]'"));  
			$nama = $sql['Nama'];
			  }elseif($_SESSION['status']=="Guru"){
				  $sql = mysql_fetch_array(mysql_query("SELECT Nama_Guru From tguru WHERE NIP='$_SESSION[nama_user]'"));
				  $nama = $sql['Nama_Guru'];
									  
				  }else{
					  $nama = "Admin";
					  }
		  
		  echo $nama?></strong>&nbsp;::..&nbsp;</li>

			        
            <li><a href="?pages=home"><img src="images/Home.png" alt="" class="icon" /><span class="text">Home</span></a></li>
			<li><a href="?pages=ganti_password"><img src="images/ganti_pass.png" alt="" class="icon" /><span class="text">Ganti Password</span></a></li>
			<li><a href="?pages=kontak_kami"><img src="images/kontak_kami.png" alt="" class="icon" /><span class="text">Kontak Kami</span></a></li>
			<li><a href="logout.php"><img src="images/ico_logout_24.png" alt="" class="icon" /><span class="text">Logout</span></a></li>
            </ul>
		</div>
		
		<div class="page clear">			
			<!-- MODAL WINDOW -->
			<div id="modal" class="modal-window">
				<!-- <div class="modal-head clear"><a onclick="$.fancybox.close();" href="javascript:;" class="close-modal">Close</a></div> -->
			</div>
			

		<div class="header clear" align="center">

			<p><a href="http://www.facebook.com/#!/group.php?gid=50429930777" target="_blank"><img src="images/link_fb.png" alt="" class="icon" width="196"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="http://v1.smansa-bumiayu.sch.id/index.php" target="_blank"><img src="images/link_smansa.png" alt="" class="icon" width="196"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div id="statusYM"><a href="ymsgr:sendIM?eryl_titan"><img src="http://opi.yahoo.com/online?u=eryl_titan&m=g&t=9/"></a></div></p>
           
        </div>
     
			<!-- CONTENT BOXES -->
			<!-- end of content-box -->
<div class="notification note-success">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="2%">&nbsp;</td>
      <td width="95%"><?php $page = $_GET['pages'];
	switch($page){
		default:
			$pages = "home.php"; 
			break;
			case 'user':
				$pages = "user.php";	
				$judul = "User Login";
			break;
			case 'siswa':
				$pages = "siswa.php";
				$judul = "Data Siswa";
			break;
			case 'guru':
				$pages = "guru.php";
				$judul = "Data Guru";
			break;
			case 'calon_siswa':
				$pages = "calon_siswa.php";
				$judul = "Data Calon Siswa";
			break;
			case 'cetak_rapor':
				$pages = "cetak_rapor.php";
				$judul = "Data Cetak Rapor";
			break;
			case 'cetak_ledger':
				$pages = "cetak_ledger.php";
				$judul = "Data Cetak Ledger";
			break;
			case 'cetak_pengambilan':
				$pages = "cetak_pengambilan.php";
				$judul = "Data Cetak Pengambilan Raport";
			break;

			case 'add_class':
				$pages = "add_class.php";
				$judul = "Tambahkan Ke Class";
			break;
			case 'kelas':
				$pages = "kelas.php";
				$judul = "Data Kelas";
			break;
			case 'ortu':
				$pages = "ortu.php";
				$judul = "Data Orang Tua";
			break;
			case 'mata_pelajaran':
				$pages = "mata_pelajaran.php";
				$judul = "Data Mata Pelajaran";
			break;
			case 'jadwal_pelajaran':
				$pages = "jadwal_pelajaran.php";
				$judul = "Data Jadwal Pelajaran";
			break;
			case 'jadwal_pelajaran_siswa':
				$pages = "jadwal_pelajaran_siswa.php";
				$judul = "Data Jadwal Pelajaran Anda";
			break;
			
			case 'me':
				$pages = "me.php";
				$judul = "Data User yang sedang Login";
			break;
			case 'me.guru':
				$pages = "me.guru.php";
				$judul = "Data User yang sedang Login";
			break;
			case 'nilai':
				$pages = "nilai.php";
				$judul = "Data Nilai Siswa";
			break;
			case 'nilai_harian':
				$pages = "nilai_harian.php";
				$judul = "Data Nilai Harian Siswa";
			break;
			case 'nilai_siswa':
				$pages = "nilai_siswa.php";
				$judul = "Data Nilai Siswa";
			break;
			case 'siswa_per_kelas':
				$pages = "siswa_per_kelas.php";
				$judul = "Data Siswa Berdasarkan Kelas";
			break;
			case 'ubah_password':
				$pages = "ubah_password.php";
				$judul = "Ubah Password";
			break;
			case 'tahun_ajaran':
				$pages = "tahun_ajaran.php";
				$judul = "tahun_ajaran";
			break;
			case 'isi_nilai_siswa':
				$pages = "isi_nilai_siswa.php";
				$judul = "isi_nilai_siswa";
			break;
			case 'kkm':
				$pages = "kkm.php";
				$judul = "kkm";
			break;
			case 'kepribadian':
				$pages = "kepribadian.php";
				$judul = "Kepribadian";
			break;
			case 'pengembangan':
				$pages = "pengembangan.php";
				$judul = "Pengembangan";
			break;
			case 'kompetensi':
				$pages = "kompetensi.php";
				$judul = "Kompetensi";
			break;
			case 'ketidakhadiran':
				$pages = "ketidakhadiran.php";
				$judul = "Ketidakhadiran";
			break;
			case 'catatanprestasi':
				$pages = "catatanprestasi.php";
				$judul = "Catatanprestasi";
			break;
			case 'ganti_password':
				$pages = "ganti_password.php";
				$judul = "Ganti Password";
			break;
			case 'proses_komentar':
				$pages = "proses_komentar.php";
				$judul = "proses_komentar";
			break;
			case 'kontak_kami':
				$pages = "kontak.php";
				$judul = "Kontak Kami";
			break;
			case 'view_kontak':
				$pages = "komentar_view.php";
				$judul = "Lihat Buku Tamu";
			break;
			case 'informasi':
				$pages = "informasi.php";
				$judul = "Informasi";
			break;
			case 'informasi_siswa':
				$pages = "informasi_siswa.php";
				$judul = "Informasi Siswa";
			break;
			case 'informasi_siswa2':
				$pages = "informasi_siswa2.php";
				$judul = "informasi_siswa2";
			break;
			case 'informasi_detail':
				$pages = "informasi_detail.php";
				$judul = "informasi_detail";
			break;
			case 'informasi':
			include "informasi_depan.php";
			break;
				
	} 
	if(!empty($pages)){
				include $pages;
			  }
	?></td>
      <td width="3%">&nbsp;</td>
    </tr>
  </table>
  
  
</div>

			<div class="clear">
				<!-- end of content-box -->
			
		</div><!-- end of page -->
		
		<div class="footer clear"></div>
	</div>
	</div>
</div>
	  
      
<div class="clear"></div></div>
<div id="footer" align="center"><strong> Copyright &copy; 20<?php echo date("y"); ?> Nilai Online SMA Negeri 1 Bumiayu</strong></div>
<div class="page clear"></div>


</body>

<meta http-equiv="content-type" content="text/html;charset=UTF-8">
</html>

<?php
}
?>

      