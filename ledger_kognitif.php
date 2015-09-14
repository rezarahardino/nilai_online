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
    <title>LEDGER NILAI KOGNITIF</title>
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
        <td align="center"><strong>Ledger Daftar Nilai Kognitif</strong></td>
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
                        <th width="61%" colspan="<?=$rr?>">&nbsp;Nama Mata Pelajaran&nbsp;</th>
                        <th width="61%" rowspan="2">&nbsp;Jumlah&nbsp;</th>
                        <th width="61%" rowspan="2">&nbsp;Rata-Rata&nbsp;</th>
                        <th width="61%" rowspan="2">&nbsp;Ranking Kelas&nbsp;</th>
                    </tr>
                    
                    <tr bgcolor="#CCCCCC">
                    <?php 
					while($p=mysql_fetch_array($sql)){
					?>
                    
                    <th>&nbsp;<?php echo $p['Kode_Mp']?>&nbsp;</th>
                    <?php } ?>
                    </tr>
                 
                    <?php 
					$no=1;
					$sql_siswa = mysql_query("SELECT tsiswa.* FROM tsiswa 
WHERE tsiswa.id_kelas='$id_kelas' ORDER BY ranking desc");
$cek = mysql_num_rows($sql_siswa);
/*var_dump("SELECT tsiswa.* FROM tsiswa 
WHERE tsiswa.id_kelas='$id_kelas' ORDER BY ranking desc");*/
					while($row = mysql_fetch_array($sql_siswa)){
						
					?>
                   <tr>
                    <td align="center"><?php echo $no?></td>
                    <td>&nbsp;<?php echo $row[nis]?>&nbsp;</td>
                    <td align="left">&nbsp;<?php echo $row[Nama]?>&nbsp;</td>
                     <?php 
					 $sql_r = mysql_query("SELECT DISTINCT(Kode_Mp) FROM tjadwalpelajaran WHERE ID_Kelas='$id_kelas'");
					 $rata=0;
					while($p=mysql_fetch_array($sql_r)){
						$n = mysql_query("SELECT * FROM tnilai WHERE tnilai.Kode_Mp='$p[Kode_Mp]' and NIS='$row[nis]'")or die(mysql_error());
						$rs = mysql_fetch_array($n);
						//print_r($rs['nilai']);
						$rata = $rata + $rs['nilai'];
					?>
                    <td align="center">&nbsp;<?php echo $rs['nilai']?>&nbsp;</td>
                    <?php } ?>
                    <td align="center">&nbsp;<?php echo $rata?>&nbsp;</td>
                    <td align="center">&nbsp;<?php 
					$rank = $rata/ $rr;
					echo number_format($rank,2,',','.');
					mysql_query("UPDATE tsiswa SET ranking='$rank' WHERE nis='$row[nis]'")or die(mysql_error());
					?>&nbsp;</td>
                    <td align="center"><?php echo $no?></td>
                    </tr>
                    
                    <?php 
					$no++;
					} ?>
                    
                <tr><td colspan="12">&nbsp;</td></tr>
                   <tr>
                    <td colspan="3" align="left">Rata-Rata</td>
                     <?php 
					 $no=1;
					 $sql_r = mysql_query("SELECT DISTINCT(Kode_Mp), ID_Kelas FROM tjadwalpelajaran WHERE ID_Kelas='$id_kelas'");

$rata=0;
						while($row = mysql_fetch_array($sql_r)){
						$n = mysql_query("SELECT SUM(nilai) as nilai FROM tnilai WHERE tnilai.Kode_Mp='$row[Kode_Mp]' and ID_Kelas='$id_kelas'")or die(mysql_error());
						$rs2 = mysql_fetch_array($n);
						if($rs2['nilai']!=0){
					?>
                    <td align="center">&nbsp;<?php echo $rs2['nilai'] / $cek?>&nbsp;</td>
                    <?php
					 }
					}?>
                    
                    </tr>
                   <tr>
                    <td colspan="3" align="left">Nilai Maksimum</td>
                     <?php 
					 $no=1;
					 $sql_r = mysql_query("SELECT DISTINCT(Kode_Mp), ID_Kelas FROM tjadwalpelajaran WHERE ID_Kelas='$id_kelas'");

$rata=0;
						while($row = mysql_fetch_array($sql_r)){
						$n = mysql_query("SELECT Max(nilai) as nilai FROM tnilai WHERE tnilai.Kode_Mp='$row[Kode_Mp]' and ID_Kelas='$id_kelas'")or die(mysql_error());
						$rs2 = mysql_fetch_array($n);
						if($rs2['nilai']!=0){
					?>
                    <td align="center">&nbsp;<?php echo $rs2['nilai']?>&nbsp;</td>
                    <?php
					 }
					}?>
                    
                    </tr>
					                   <tr>
                    <td colspan="3" align="left">Nilai Minimum</td>
                     <?php 
					 $no=1;
					 $sql_r = mysql_query("SELECT DISTINCT(Kode_Mp), ID_Kelas FROM tjadwalpelajaran WHERE ID_Kelas='$id_kelas'");

$rata=0;
						while($row = mysql_fetch_array($sql_r)){
						$n = mysql_query("SELECT Min(nilai) as nilai FROM tnilai WHERE tnilai.Kode_Mp='$row[Kode_Mp]' and ID_Kelas='$id_kelas'")or die(mysql_error());
						$rs2 = mysql_fetch_array($n);
						if($rs2['nilai']!=0){
					?>
                    <td align="center">&nbsp;<?php echo $rs2['nilai']?>&nbsp;</td>
                    <?php
					 }
					}?>
                    
                    </tr>
                   <tr>
                    <td colspan="3" align="left">KKM</td>
                     <?php 
					 $no=1;
					 $sql_r = mysql_query("SELECT DISTINCT(Kode_Mp), ID_Kelas FROM tjadwalpelajaran WHERE ID_Kelas='$id_kelas'");

$rata=0;
						while($row = mysql_fetch_array($sql_r)){
						$n = mysql_query("SELECT SUM(kkm) as nilai_kkm FROM tmatapelajaran WHERE tmatapelajaran.Kode_Mp='$row[Kode_Mp]' ")or die(mysql_error());
						$rs2 = mysql_fetch_array($n);
						if($rs2['nilai_kkm']!=0){
					?>
                    <td align="center">&nbsp;<?php echo $rs2['nilai_kkm']?></td>
                    <?php
					 }
					}?>
                    
                    </tr>
                     <tr>
                    <td colspan="3" align="left">Jumlah > = KKM</td>
                     <?php 
					 $no=1;
					 $sql_r = mysql_query("SELECT DISTINCT(Kode_Mp), ID_Kelas FROM tjadwalpelajaran WHERE ID_Kelas='$id_kelas'");

$rata=0;
						while($row = mysql_fetch_array($sql_r)){
						$n = mysql_query("SELECT SUM(kkm) as nilai_kkm FROM tmatapelajaran WHERE tmatapelajaran.Kode_Mp='$row[Kode_Mp]' ")or die(mysql_error());
						$rs2 = mysql_fetch_array($n);
						if($rs2['nilai_kkm']!=0){
							
						$n_ = mysql_query("SELECT count(tnilai.NIS) as jml_nis FROM tnilai WHERE tnilai.Kode_Mp='$row[Kode_Mp]' AND id_kelas='$id_kelas' and nilai >= $rs2[nilai_kkm]")or die(mysql_error());
						$rs_ = mysql_fetch_array($n_);
					?>
                    <td align="center">&nbsp;<?php echo $rs_['jml_nis']?></td>
                    <?php
					 }
					}?>
                    
                    </tr>

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