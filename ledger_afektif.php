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
    <title>LEDGER NILAI AFEKTIF</title>
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
        <td align="center"><strong>Ledger Daftar Nilai Afektif</strong></td>
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
                        <th width="25%" rowspan="2">&nbsp;Nama&nbsp;</th>
                        <th width="50%" colspan="<?=$rr?>">&nbsp;Nama Mata Pelajaran&nbsp;</th>
                        <th width="61%" colspan="5">&nbsp;Jumlah Kategori&nbsp;</th>
                    </tr>
                    
                    <tr bgcolor="#CCCCCC">
                    <?php 
					while($p=mysql_fetch_array($sql)){
					?>
                    
                    <th>&nbsp;<?php echo $p['Kode_Mp']?></th>
                    <?php } ?>
                    <th width="4%">&nbsp;A&nbsp;</th>
                    <th width="4%">&nbsp;B&nbsp;</th>
                    <th width="4%">&nbsp;C&nbsp;</th>
                    <th width="5%">&nbsp;D&nbsp;</th>
                    <th width="5%">&nbsp;E&nbsp;</th>
                    </tr>
                 
                    <?php 
					$no=1;
					$sql_siswa = mysql_query("SELECT tsiswa.* FROM tsiswa 
WHERE tsiswa.id_kelas='$id_kelas'");
$cek = mysql_num_rows($sql_siswa);
					while($row = mysql_fetch_array($sql_siswa)){
						
					?>
                   <tr>
                    <td align="center"><?php echo $no?></td>
                    <td>&nbsp;<?php echo $row[nis]?>&nbsp;</td>
                    <td align="left">&nbsp;<?php echo $row[Nama]?>&nbsp;</td>
                     <?php 
					 $sql_r = mysql_query("SELECT DISTINCT(Kode_Mp) FROM tjadwalpelajaran WHERE ID_Kelas='$id_kelas'");
					 $rataA=0;
					 $rataB=0;
					 $rataC=0;
					 $rataD=0;
					 $rataE=0;
					while($p=mysql_fetch_array($sql_r)){
						$n = mysql_query("SELECT * FROM tnilai WHERE tnilai.Kode_Mp='$p[Kode_Mp]' and NIS='$row[nis]'")or die(mysql_error());
						$rs = mysql_fetch_array($n);
						if($rs[predikat]=="A"){
						$rataA = $rataA + count($rs[predikat]);
						}
						
						if($rs[predikat]=="B"){
						$rataB = $rataB + count($rs[predikat]);
						}
						
						if($rs[predikat]=="C"){
						$rataC = $rataC + count($rs[predikat]);
						}
						
						if($rs[predikat]=="D"){
						$rataD = $rataD + count($rs[predikat]);
						}
						
						if($rs[predikat]=="E"){
						$rataE = $rataE + count($rs[predikat]);
						}
						
					?>
                    <td align="center">&nbsp;<?php echo $rs['predikat']?></td>
                   
                    <?php } ?>
                    
				<td align="center">&nbsp;<?php echo $rataA?>&nbsp;</td>
                <td align="center">&nbsp;<?php echo $rataB?>&nbsp;</td>
                <td align="center">&nbsp;<?php echo $rataC?>&nbsp;</td>
                <td align="center">&nbsp;<?php echo $rataD?>&nbsp;</td>
                <td align="center">&nbsp;<?php echo $rataE?>&nbsp;</td>
                    
					<?php $no++;} ?>
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