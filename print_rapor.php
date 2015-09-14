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
    <title>RAPOR</title>
</head>
<body>
<?php 
$nis = $_POST['NIS'];
$sql_siswa = mysql_query("SELECT tsiswa.*, tkelas.Nama_Kelas, tkelas.ID_Kelas FROM tsiswa 
INNER JOIN tkelas ON tkelas.ID_Kelas = tsiswa.id_kelas
WHERE tsiswa.nis='$nis'");
$cek = mysql_num_rows($sql_siswa);
$row_siswa = mysql_fetch_array($sql_siswa);
	if($cek <= 0){
		echo "<script language='javascript'>alert('NIS tidak Ditemukan' ); window.location.href='media.php?pages=cetak_rapor';</script>";exit;
	}else{
?>
<div class="line"></div>
        <table width="90%" align="center">
        <tr>
        <td width="40%">
        	<table class="mb40" align="center">
            	<tr>
                	<td>Nama&nbsp;</td>
                    <td>:</td>
                    <td>&nbsp;<?php echo $row_siswa['Nama']?></td>
                </tr>
                <tr>
                	<td>NIS&nbsp;</td>
                    <td>:</td>
                    <td>&nbsp;<?php echo $row_siswa['nis']?></td>
                </tr>
                <tr>
                	<td>Nama Sekolah&nbsp;</td>
                    <td>:</td>
                    <td>&nbsp;SMA Negeri 1 Bumiayu</td>
                </tr>
            </table>
        </td>
        <td width="88%">
        	 	<table>
            	<tr>
                	<td>Kelas / Semester&nbsp;</td>
                    <td>:</td>
                    <td>&nbsp;<?php echo $row_siswa['Nama_Kelas']?> / <?php echo $_POST['semester']?></td>
                </tr>
                <tr>
                	<td>Tahun Ajaran&nbsp;</td>
                    <td>:</td>
                    <td>&nbsp;<?php $sql_tahun = mysql_fetch_array(mysql_query("SELECT ttahun_ajaran.tahun FROM ttahun_ajaran 
										WHERE id='$_POST[tahun]'"));
										echo $sql_tahun['tahun'];
?></td>
                </tr>
                <tr>
                	<td>Program&nbsp;</td>
                    <td>:</td>
                    <td>&nbsp;<?php echo $row_siswa['program']?> / <?php echo $_POST['semester']?></td>
                </tr>
            </table>
        </td>
        </tr>    
        <tr>
        	<td colspan="4">
            <?php 
			$kriteria = $_POST['kriteria'];
			if($kriteria=="nilai_kkm"){
			?>
            	<table width="70%" border="1" cellpadding="1" cellspacing="2">
                	<tr bgcolor="#CCCCCC">
                    	<th rowspan="3">&nbsp;No&nbsp;</th>
                        <th rowspan="3">&nbsp;Komponen&nbsp;</th>
                        <th rowspan="3">&nbsp;KKM&nbsp;</th>
                        <th colspan="9">&nbsp;Nilai Hasil Belajar&nbsp;</th>
                    </tr>
                    <tr bgcolor="#CCCCCC">
                    <th colspan="2">&nbsp;Pengetahuan&nbsp;</th>
                    <th colspan="2">&nbsp;Praktik&nbsp;</th>
                    	<th>&nbsp;Sikap&nbsp;</th>
                    </tr>
                    <tr bgcolor="#CCCCCC">
                    <th>&nbsp;Angka&nbsp;</th>
                    <th>&nbsp;Huruf&nbsp;</th>
					<th>&nbsp;Angka&nbsp;</th>
                    <th>&nbsp;Huruf&nbsp;</th>                    
                    <th>&nbsp;Predikat&nbsp;</th>
                    </tr>
                    <?php $sql = mysql_query("SELECT DISTINCT(tmatapelajaran.Nama_MP),sum(tmatapelajaran.kkm)as nilai_kkm,tnilai.nilai,tnilai.predikat, tnilai.praktik 
					from tmatapelajaran 
					inner join tnilai on tmatapelajaran.Kode_Mp = tnilai.Kode_Mp
					where tnilai.Smester='$_POST[semester]' and tnilai.tahun_ajaran='$_POST[tahun]'
					 and tnilai.nis='$nis' GROUP BY tnilai.Kode_Mp
					")or die(mysql_error());
					
				
					$no=1;
					while($row = mysql_fetch_array($sql)){
						$akumulasi = ($row[nilai_kkm] + $row[nilai] + $row[praktik]) / 3;
					?>
                   <tr>
                    <td align="center"><?php echo $no?></td>
                    <td>&nbsp;<?php echo $row[Nama_MP]?>&nbsp;</td>
                    <td align="center"><?php echo $row[nilai_kkm]?>&nbsp;</td>
                    <td align="center"><?php echo $row[nilai]?>&nbsp;</td>
                    <td>&nbsp;<?php echo terbilang($row[nilai])?>&nbsp;</td>
                    <td align="center"><?php echo $row[praktik]?>&nbsp;</td>
                    <td>&nbsp;<?php echo terbilang($row[praktik])?>&nbsp;</td>
                    <td align="center"><?php  echo $row[predikat]?>
                    </td>
                    </tr>
                    
                    <?php 
					$no++;
					} ?>
                    
                </table>
                <?php }elseif($kriteria=="pengembangan"){ ?>
                <p><strong>&nbsp;Nilai Pengembangan Diri</strong></p>
                <table width="70%" border="1" cellpadding="1" cellspacing="2">
                	<tr bgcolor="#CCCCCC">
                    	<th width="5">&nbsp;No&nbsp;</th>
                        <th width="250">&nbsp;Jenis Kegiatan&nbsp;</th>
                        <th width="250">&nbsp;Keterangan&nbsp;</th>
                    </tr>
                    <?php $sql = mysql_query("SELECT pengembangan_diri.jenis_kegiatan, pengembangan_diri.keterangan
					from pengembangan_diri 
					where 
					
					pengembangan_diri.semester='$_POST[semester]' and pengembangan_diri.tahun_ajaran='$_POST[tahun]' and pengembangan_diri.nis='$nis'
					 
					")or die(mysql_error());
					
				
					$no=1;
					while($row = mysql_fetch_array($sql)){
						
					?>
                    <tr>
                    <td align="center"><?php echo $no?></td>
                    <td>&nbsp;<?php echo $row[jenis_kegiatan]?>&nbsp;</td>
                    <td>&nbsp;<?php echo $row[keterangan]?>&nbsp;</td>
                    </tr>
                    
                    <?php 
					$no++;
					} ?>
                </table>
                <p><strong>&nbsp;Nilai Akhlak Mulia Dan Kepribadian</strong></p>
                 <table width="70%" border="1" cellpadding="1" cellspacing="2">
                	<tr bgcolor="#CCCCCC">
                    	<th width="5">&nbsp;No&nbsp;</th>
                        <th width="200">&nbsp;Aspek Yang Dinilai&nbsp;</th>
                        <th width="300">&nbsp;Keterangan&nbsp;</th>
                    </tr>
                   
                    <tr>
                    <td align="center">1</td>
                    <td>&nbsp;Kedisiplinan&nbsp;</td>
                    <td>&nbsp;<?php 
					$s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo($sql1[kedisiplinan]);
					//echo $sql1['kedisplinan'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">2</td>
                    <td>&nbsp;Kebersihan&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['kebersihan'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">3</td>
                    <td>&nbsp;Kesehatan&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['kesehatan'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">4</td>
                    <td>&nbsp;Tanggung Jawab&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['tanggung_jawab'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">5</td>
                    <td>&nbsp;Sopan Santun&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['sopan_santun'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">6</td>
                    <td>&nbsp;Percaya Diri&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['percaya_diri'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">7</td>
                    <td>&nbsp;Kejujuran&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['kejujuran'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">8</td>
                    <td>&nbsp;Pelaksanaan Ibadah&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['pelaksanaan_ibadah'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">9</td>
                    <td>&nbsp;Kompetitif&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['kompetetif'];
					?></td>
                    </tr>
                    <tr>
                    <td align="center">10</td>
                    <td>&nbsp;Hubungan Sosial&nbsp;</td>
                    <td>&nbsp;<?php $s1 = mysql_query("SELECT kepribadian.*
					from kepribadian 
					where 
						kepribadian.semester='$_POST[semester]' and kepribadian.tahun_ajaran='$_POST[tahun]' and kepribadian.nis='$nis'
					 ")or die(mysql_error());
					
					$sql1 = mysql_fetch_array($s1);
					echo $sql1['hubungan_sosial'];
					?></td>
                    </tr>
                    
                    <?php 
					//$no++;
					//} ?>
                </table>
                <p><strong>&nbsp;Nilai Ketidakhadiran</strong></p>
                 <table width="70%" border="1" cellpadding="1" cellspacing="2">
                	<tr bgcolor="#CCCCCC">
                    	<th width="5">&nbsp;No&nbsp;</th>
                        <th width="250">&nbsp;Alasan Ketidakhadiran</th>
                        <th width="150">&nbsp;Hari&nbsp;</th>
                        <th width="400">&nbsp;Keterangan&nbsp;</th>
                        
                    </tr>
                  
                    <tr>
                    <td align="center">1</td>
                    <td>&nbsp;Sakit&nbsp;</td>
                    <td align="center">&nbsp;<?php 
					$sql2 = mysql_query("SELECT ketidakhadiran.*
					from ketidakhadiran 
					where 
					
					ketidakhadiran.semester='$_POST[semester]' and ketidakhadiran.tahun_ajaran='$_POST[tahun]' and ketidakhadiran.nis='$nis'
					 
					")or die(mysql_error());
					$s2 = mysql_fetch_array($sql2);
					echo $s2['sakit'];
					?></td>
                    <td>&nbsp;<?php echo $s2['keterangan']?></td>
                    </tr>
                    
                    <tr>
                    <td align="center">2</td>
                    <td>&nbsp;Ijin&nbsp;</td>
                    <td align="center">&nbsp;<?php $sql2 = mysql_query("SELECT ketidakhadiran.*
					from ketidakhadiran 
					where 
					
					ketidakhadiran.semester='$_POST[semester]' and ketidakhadiran.tahun_ajaran='$_POST[tahun]' and ketidakhadiran.nis='$nis'
					 
					")or die(mysql_error());
					$s2 = mysql_fetch_array($sql2);
					echo $s2['ijin'];
					?></td>
                    <td>&nbsp;<?php echo $s2['keterangan']?></td>
                    </tr>
                    
                    <tr>
                    <td align="center">3</td>
                    <td>&nbsp;Alpha&nbsp;</td>
                    <td align="center">&nbsp;<?php $sql2 = mysql_query("SELECT ketidakhadiran.*
					from ketidakhadiran 
					where 
					
					ketidakhadiran.semester='$_POST[semester]' and ketidakhadiran.tahun_ajaran='$_POST[tahun]' and ketidakhadiran.nis='$nis'
					 
					")or die(mysql_error());
					$s2 = mysql_fetch_array($sql2);
					echo $s2['alpha'];
					?></td>
                    <td>&nbsp;<?php echo $s2['keterangan']?></td>
                    </tr>
              </table>
              
            <p><strong></strong></p>
          
             
              <table width="70%" border="1" cellpadding="30" cellspacing="2">
             <tr>
                    <td>Catatan Wali Kelas : </td>
                    </tr>
                                                 
             </table>
             
             <p><strong></strong></p>
              <table width="70%" border="1" cellpadding="1" cellspacing="2">
              
                    <tr>
                    <td width="30%">&nbsp;Keterangan Naik Kelas :</td>
                    <td>&nbsp;Naik / Tidak Naik *)</td>
                    </tr></div>
                   </table>
                    
                    
				<?php }elseif($kriteria=="kompetensi"){ ?>
                    <p><strong>&nbsp;Nilai Kompetensi</strong></p>
                <table width="70%" border="1" cellpadding="1" cellspacing="2">
                	<tr bgcolor="#CCCCCC">
                    	<th width="5">&nbsp;No&nbsp;</th>
                        <th width="250">&nbsp;Komponen&nbsp;</th>
                        <th width="350">&nbsp;Ketercapaian Kompetensi&nbsp;</th>
                    </tr>
                    <?php $sql = mysql_query("SELECT DISTINCT(tmatapelajaran.Nama_MP),kompetensi.ketercapaian_kompetensi
					from tmatapelajaran 
					inner join kompetensi on tmatapelajaran.Kode_Mp = kompetensi.Kode_Mp
					
					where kompetensi.Smester='$_POST[semester]' and kompetensi.tahun_ajaran='$_POST[tahun]' and kompetensi.nis='$nis'
					 
					")or die(mysql_error());
					
				
					$no=1;
					while($row = mysql_fetch_array($sql)){
						
					?>
                    <tr>
                    <td align="center"><?php echo $no?></td>
                    <td>&nbsp;<?php echo $row[Nama_MP]?>&nbsp;</td>
                    <td>&nbsp;<?php echo $row[ketercapaian_kompetensi]?>&nbsp;</td>
                    </tr>
                    
                    <?php 
					$no++;
					} ?>
                </table>
				<?php }elseif($kriteria=="catatan"){ ?>
                <p><strong>&nbsp;Nilai Catatan Prestasi</strong></p>
                <table width="70%" border="1" cellpadding="1" cellspacing="2">
                	<tr bgcolor="#CCCCCC">
                    	<th width="5">&nbsp;No&nbsp;</th>
                        <th width="250">&nbsp;Kegiatan Yang Diikuti&nbsp;</th>
                        <th width="250">&nbsp;Bukti Sertifikasi&nbsp;</th>
                    </tr>
                    <?php 
					$date = date('Y');
					$sql = mysql_query("SELECT catatan_prestasi.kegiatan, catatan_prestasi.bukti_sertifikasi from catatan_prestasi 
					
					where catatan_prestasi.semester='$_POST[semester]' and catatan_prestasi.tahun_ajaran='$_POST[tahun]' and catatan_prestasi.nis='$nis'
					 
					")or die(mysql_error());
					
					$no=1;
					while($row = mysql_fetch_array($sql)){
						
					?>
                    <tr>
                    <td align="center"><?php echo $no?></td>
                    <td>&nbsp;<?php echo $row[kegiatan]?>&nbsp;</td>
                    <td>&nbsp;<?php echo $row[bukti_sertifikasi]?>&nbsp;</td>
                    </tr>
                    
                    <?php 
					$no++;
					} ?>
                </table>

                
                <?php }?>
            </td>
        </tr>
        
         <tr><td colspan="3">&nbsp;</td></tr>
         
        <tr>
            <td align="left" colspan="10">
        	<table width="84%">
            
            <tr>
                <td width="35%">
            <table>
            
            <tr>
               	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orang Tua / Wali</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>( ................................ )</td></tr>
            </table>
            </td>
                
                <td width="27%">
            <table>
                 <br>
                 
            <tr>
       
              	<td>&nbsp;&nbsp;&nbsp;&nbsp;Wali Kelas</td>
            </tr>
          
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><?php 
									$q = mysql_query("SELECT tguru.* FROM tkelas, tguru  WHERE ID_Kelas='$row_siswa[ID_Kelas]' AND tguru.NIP = tkelas.ID_Guru")or die(mysql_error());
									$sql = mysql_fetch_array($q);?></td></tr>
            
                                    <tr><td>(<?php echo $sql['Nama_Guru']?>)</td></tr>
                                     <tr><td><hr></td></tr>
                                    <tr><td><?php echo $sql['NIP']?></td></tr>
                                    </table>
                            </td>
                            <td width="38%">
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

</body>
</html>
<?php 
include "html2pdf/html2fpdf_helper.php"; 
$pdf=new HTML2FPDF();
ob_end_clean();
$htmlbuffer=ob_get_contents(); 
			 
			$pdf->AddPage();
			$pdf->SetFontSize(12);
			
			$pdf->SetFont('Arial','B',12);
			//$pdf->WriteHTML($htmlbuffer);
			//$pdf->Output("nilai.pdf","D");
			
	}
?>
