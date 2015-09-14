<?php 
error_reporting(0);
//ob_start(); 
include "config/koneksi.php";
include "config/terbilang.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <title>PENGAMBILAN RAPOR</title>
</head>
<body>
<?php 
$id_kelas = $_POST['ID_Kelas'];
$sql_siswa = mysql_query("SELECT tkelas.* FROM tkelas 
WHERE tkelas.ID_Kelas='$id_kelas'");
$row_siswa = mysql_fetch_array($sql_siswa);


?>

<div class="line"></div>
        <table align="center">
<tr>
        <td align="center"><strong>Daftar Hadir Orang Tua Siswa</strong></td>
       </tr><div class="line"></div>
        <tr>
        <td align="center"><strong>SMA Negeri 1 Bumiayu</strong></td>
        </tr>
         </table>
        
<div class="line"></div>
        <table width="90%" align="center">
        <tr>
        <td width="88%">
        	 	<table>
            	<tr>
                	<td>Kelas&nbsp;</td>
                    <td>:</td>
                    <td>&nbsp;<?php echo $row_siswa['Nama_Kelas']?> </td>
                </tr>
               
                <tr>
              	<td>Tahun Ajaran&nbsp;</td>
                <td>:</td>
                <td>&nbsp;<?php $sql_tahun = mysql_query("SELECT tsiswa.*, ttahun_ajaran.tahun FROM tsiswa, ttahun_ajaran 
									WHERE tsiswa.id_kelas='$id_kelas' and ttahun_ajaran.id = tsiswa.tahun_ajaran");
							$r = mysql_fetch_array($sql_tahun);
								echo $r['tahun'];
?></td>
                </tr>
                <tr>
                <td>Semester&nbsp;</td>
                <td>:</td>
                <td>&nbsp;<?php echo $r['semester']?></td>
                </tr>
            </table>
        </td>
        </tr>    
        <tr>
        	<td colspan="4">
            	<table align="left" width="90%" border="1" cellpadding="1" cellspacing="2">
                <?php 
				$sql = mysql_query("SELECT DISTINCT(Kode_Mp) FROM tjadwalpelajaran WHERE ID_Kelas='$id_kelas'");
				$rr = mysql_num_rows($sql);
				?>
                	<tr bgcolor="#CCCCCC">
                    	<th width="2%" rowspan="2">&nbsp;No&nbsp;</th>
                        <th width="10%" rowspan="2">&nbsp;NIS&nbsp;</th>
                        <th width="12%" rowspan="2">&nbsp;Nama&nbsp;</th>
                        <th width="12%" rowspan="2">&nbsp;Nama Orang Tua / Wali&nbsp;</th>
                        <th width="14%" rowspan="2">&nbsp;Alamat&nbsp;</th>
                        <th colspan="2">&nbsp;Waktu Pengambilan&nbsp;</th>
                        <th width="14%" rowspan="2">&nbsp;Tanda Tangan&nbsp;</th>
                    </tr>
                    <tr bgcolor="#CCCCCC">
                    	<th width="10%" align="center">Tanggal</th>
                        <th width="10%" align="center">Jam</th>
                    </tr>
                    <?php 
					$no=1;
					$sql_siswa = mysql_query("SELECT tsiswa.* FROM tsiswa 
WHERE tsiswa.id_kelas='$id_kelas' ORDER BY ranking desc");
$cek = mysql_num_rows($sql_siswa);
					while($row = mysql_fetch_array($sql_siswa)){
						
					?>
                   <tr>
                    <td align="center"><?php echo $no?></td>
                    <td>&nbsp;<?php echo $row[nis]?>&nbsp;</td>
                    <td align="left">&nbsp;<?php echo $row[Nama]?>&nbsp;</td>
                    <td align="left">&nbsp;<?php echo $row[nama_org_tua]?>&nbsp;</td>
                    <td align="left">&nbsp;<?php echo $row[Alamat]?>&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                    </tr>
                    
                    <?php 
					$no++;
					} ?>
                    
                   </table>
                   </td>
                   </tr>
                   
                   <tr><td colspan="3">&nbsp;</td></tr>
       
                  <tr>
                   <td align="right" colspan="10">
                   		<table width="30%" align="right">
                        	<tr>
                            <td>
                            	<table>
                                	<tr>
                                    	<td>
                            	Bumiayu, .......................
                                <br><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Sekolah
                                	</td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr><td>&nbsp;</td></tr>
                                    
                                    <?php 
									$q = mysql_query("SELECT * FROM tguru WHERE jabatan='Kepala Sekolah'")or die(mysql_error());
									$sql = mysql_fetch_array($q);?>
                                    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $sql['Nama_Guru']?>)</td></tr>
                                    <tr><td><hr></td></tr>
                                    <tr><td><?php echo $sql['NIP']?></td></tr>
                                    </table>
                            </td>
                            </tr>
                        </table>
                   </td>
                   </tr>
                   </table>
</body>
</html>