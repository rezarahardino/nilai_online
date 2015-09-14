<?php
include"config/koneksi.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="content">
  
  <?php
if (! $_GET['detail']=="") {
$sql="SELECT tinformasi.* FROM tinformasi
			WHERE id= '".$_GET['detail']."'";
$qry = mysql_query($sql, $koneksi) or die ("Gagal Query");
$data  = @mysql_fetch_array($qry);
if($data['oleh']=="admin"){
			$oleh = "Admin";
			}else{
				$s = mysql_query("SELECT * FROM tguru WHERE NIP='".$data['oleh']."'");
				$r = mysql_fetch_array($s);
					$oleh = $r['Nama_Guru'];
				}
	
?>

    <tr>
      <td width="523"><h3><?php echo tgl_indo($data['created']);?></h3></td>
    </tr>
    <tr>
      <td width="523"><h4>Oleh : <?php echo $oleh ?></h4></td>
    </tr>
    <tr>
      <td><h3><?php echo $data['judul']; ?></h3></td>
    </tr>
    <tr>
      <td><p><?php echo $data['isi']; ?></p></td>
    </tr>
    <tr>
      <td><div align="center"><a href="?page=informasi" class="menu">Kembali</a></div></td>
    </tr>
  </table>
  <?php
}
?>
</div>
</body>
</html>