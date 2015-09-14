
<html>
<head>
<title>View</title>
<body>

<p align="center"><font face="Arial" size="2">
<?
	
	include "config/conn.php";?> 
    <?
	$entries=4; //nilai awal==jumlah data yang ditampilkan setiap halaman
	
	//************awal paging************//
	$query=mysql_db_query($db,"select * from tinformasi",$koneksi); //input
	$get_pages=mysql_num_rows($query); //dapatkan jumlah semua data
	?>
	  </font>
	<?
	$page=(int)$_GET['id'];
	$offset=$page*$entries;
	
	//menampilkan data dengan menggunakan limit sesuai parameter paging yang diberikan
	$result=mysql_db_query($db,"select * from tinformasi order by id desc limit $offset,$entries",$koneksi); //output
	$jumlah=mysql_num_rows($query);
	
?>
</p>
<br>

	<?
	if ($jumlah){
		while ($row=mysql_fetch_array($result))
		{
			if($row['oleh']=="admin"){
			$oleh = "Admin";
			}else{
				$s = mysql_query("SELECT * FROM tguru WHERE NIP='".$row['oleh']."'");
				$r = mysql_fetch_array($s);
					$oleh = $r['Nama_Guru'];
				}
		?>
        <blockquote>
        <p><? echo tgl_indo($row[4]); ?></p>
        <h5>Oleh : <? echo $oleh ?></h5>
<h4><? echo $row[1]; ?></h4>
		
		  <p><? echo substr ($row[2],0,250); ?><a href="?page=informasi_detail&detail=<?php echo $row['id']; ?>" class="menu">...Selengkapnya)</a></p>
</blockquote>

	
		<?	
		} 
		}else{
		?><p align="center"><font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font></p><?
	}
	?>
    <p align="center"><?
	if ($get_pages>$entries)  //jika jumlah semua data lebih banyak dari nilai awal yang diberikan
	{
		echo "Halaman : ";
		$pages=1;
		while($pages<=ceil($get_pages/$entries))
		{
			if ($pages!=1)
			{
				echo " | ";
			}
		?>
		<!--Membuat link sesuai nama halaman-->
		<a href="media.php?page=informasi&id=<? echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><? echo $pages; ?></font></a>
 
		 <?
				$pages++;
		}
	}else{
		$pages=0;
	}
	
	//**************akhir paging*****************//
	
	?></p>
</table>
</body>
</html>
