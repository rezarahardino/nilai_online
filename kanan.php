<?php
include"config/koneksi.php";

?>
<p><img src="images/logo_Informasi.png" width="196" height="35" /></p>
<link href="style/style.css" rel="stylesheet" type="text/css" />




 <?php 

		$tampil = mysql_query("SELECT id,judul,substr(isi,1,100) as isi,created, oleh  
							 FROM tinformasi ORDER BY id DESC ")or die(mysql_error());
		$cek = mysql_num_rows($tampil);
	   
	  
	?>	
 <?php $no = 1 ; ?>
<?php if($cek<=0):?><br />

 
<p><center><strong><marquee align="center" direction="left" height="50" scrollamount="3" width="80%" behavior="alternate">
Belum Ada Informasi</marquee></strong></center></p>

 
 <?php else:?>
 <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5" direction="up" width="100%" height="150" align="center">
 		<?php while ($row_kategori = mysql_fetch_assoc($tampil)){ 
		if($row_kategori['oleh']=="admin"){
			$oleh = "Admin";
			}else{
				$s = mysql_query("SELECT * FROM tguru WHERE NIP='".$row_kategori['oleh']."'");
				$r = mysql_fetch_array($s);
					$oleh = $r['Nama_Guru'];
				}
		?>
        
		<blockquote>


<h5><?php echo $row_kategori['created']; ?></h5>
<h5>Oleh : <?php echo $oleh ?></h5>
<h6><?php echo $row_kategori['judul']; ?></h6>
<h7><?php echo $row_kategori['isi']; ?>&nbsp;&nbsp;&nbsp;<a href="media.php?pages=informasi&amp;action=view&amp;kid=<?php echo $row_kategori['id'];?>">...Selengkapnya)</a></h7>


</blockquote>
</br></br>
<?php }  ?>
</marquee>
<?endif;?>

<br>&nbsp;</br>

<blockquote>
<?php
			  $ip      = $_SERVER['REMOTE_ADDR']; 
			  $tanggal = date("Ymd"); 
			  $waktu   = time(); 			
			  $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
			  if(mysql_num_rows($s) == 0){
				mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
			  } 
			  else{
				mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
			  }			
			  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
			  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
			  $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
			  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
			  $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
			  $bataswaktu       = time() - 300;
			  $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));			
			  $path = "counter/";
			  $ext = ".png";			
			  $tothitsgbr = sprintf("%06d", $tothitsgbr);
			  for ( $i = 0; $i <= 9; $i++ ){
				   $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
			  }			
			  echo "<span class='pengunjung'><img src=images/statistik3.png align=center><br></br>
			  <span class='pengunjung'><img src=images/online2.png> <strong>Pengunjung Online&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$pengunjungonline</strong><br></br>
					<span class='pengunjung'><img src=images/hariini2.png> <strong>Pengunjung Hari Ini&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;$hits[hitstoday]</strong><br />
				  ";
			?>
			</blockquote>

