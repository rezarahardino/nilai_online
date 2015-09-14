<?php 
session_start() ?>
<?php include "config/koneksi.php"; ?>
<?php
	$maxRows_kategori = 20;
	$pageNum_kategori = 0;
	if (isset($HTTP_GET_VARS['pageNum_kategori'])) {
	  $pageNum_kategori = $HTTP_GET_VARS['pageNum_kategori'];
	}
	

	$startRow_kategori = $pageNum_kategori * $maxRows_kategori;
	$query_kategori = "SELECT  tsiswa.nis FROM tsiswa 
						".$queryx."
						
	
	ORDER BY tsiswa.nis";
	$query_limit_kategori = sprintf("%s LIMIT %d, %d", $query_kategori, $startRow_kategori, $maxRows_kategori);
	$kategori = mysql_query($query_limit_kategori) or die(mysql_error());
	$row_kategori = mysql_fetch_assoc($kategori);

	if (isset($HTTP_GET_VARS['totalRows_kategori'])) {
	  $row_kategoriotalRows_kategori = $HTTP_GET_VARS['totalRows_kategori'];
	} else {
	  $all_kategori = mysql_query($query_kategori);
	  $row_kategoriotalRows_kategori = mysql_num_rows($all_kategori);
	}
	$row_kategoriotalPages_kategori = (int)($row_kategoriotalRows_kategori/$maxRows_kategori);

	$kid = $_GET['kid'];
	$query_ek = "SELECT catatan_prestasi.*  
							 FROM catatan_prestasi 
							 	WHERE catatan_prestasi.id_catatan = '" . $kid . "'";
							 
	$ek = mysql_query($query_ek) or die(mysql_error());
	$row_ek = mysql_fetch_assoc($ek);
	$row_kategoriotalRows_ek = mysql_num_rows($ek);

	$queryString_kategori = "";
	if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
		  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
		  $newParams = array();
		  foreach ($params as $param) {
				if (stristr($param, "pageNum_kategori") == false && 
					stristr($param, "totalRows_kategori") == false) {
				  array_push($newParams, $param);
				}
		  }
		  
		  if (count($newParams) != 0) {
				$queryString_kategori = "&" . implode("&", $newParams);
		  }
	}
	$queryString_kategori = sprintf("&totalRows_kategori=%d%s", $row_kategoriotalRows_kategori, $queryString_kategori);
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
	function MM_findObj(n, d) { //v4.01
	  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
	  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	  if(!x && d.getElementById) x=d.getElementById(n); return x;
	}
	
	function MM_validateForm() { //v4.0
	  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
	  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
		if (val) { nm=val.name; if ((val=val.value)!="") {
		  if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
			if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
		  } else if (test!='R') { num = parseFloat(val);
			if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
			if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
			  min=test.substring(8,p); max=test.substring(p+1);
			  if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
		} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' Harus Diisi.\n'; }
	  } if (errors) alert('Warning...!\n'+errors);
	  document.MM_returnValue = (errors == '');
	}
//-->
</script>
<link href="css/load-styles.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="tool/dhtmlgoodies_calendar.css" media="screen"></LINK>
<SCRIPT type="text/javascript" src="tool/dhtmlgoodies_calendar.js"></script>
	<h2><img src="images/table_nilai_catatan.png" alt=""/></h2>
	<?php 
	$action = $_GET['action'];
	if(empty($action)){?>
		<table width="1007" cellpadding="0" cellspacing="0">
<tr> 
		<td colspan="3" class="viewer"> 
			<div align="right">
				<font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
					<a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, 0, $queryString_kategori); ?>"title="Urutan Pertama"><img src="images/tanda_first.png" alt="" /></a></strong>
				</font>
				<font color="#FFFFFF">
					<strong>
						<font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
							 <a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, max(0, $pageNum_kategori - 1), $queryString_kategori); ?>"title="Urutan Sebelumnya"><img src="images/tanda_previous.png" alt="" /></a> 
							<a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, min($row_kategoriotalPages_kategori, $pageNum_kategori + 1),
							$queryString_kategori); ?>"title="Urutan Berikutnya"><img src="images/tanda_next.png" alt="" /></a> 
							 <a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, $row_kategoriotalPages_kategori, $queryString_kategori); ?>"title="Urutan Terakhir"><img src="images/tanda_last.png" alt="" /></a>
						</font>
					</strong>
				</font>
			</div>
		</td>
  </tr>
  
 <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
 <tr>
  <td class="search">
  	 <form action="" method="post">
    	<table width="100%">
        
    <tr> 
      <td width="20%">NIS :</td>
      
      <td width="90%"><input type="text" name="keyword" value="<? echo $_POST[keyword]; ?>"></td>
      <tr>
       <td width="30%">Semester :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
       </td>
       <td><select name="semester">
       <option value="">- Pilih Semester -</option>
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
           </tr>
      
      <tr>      
      <td colspan="3" align="right"><input type="submit" name="cari" value="Submit"></td>
    </tr>
  </table>
    </form>   
  </td>
  </tr>
 <?php 
  }
 if(!empty($_GET['nis'])){
	   //print_r($_GET['nis']);
	   $tam = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas  
							 FROM tsiswa 
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = tsiswa.id_kelas
								
								WHERE tsiswa.nis = '" . $_GET['nis'] . "' and tkelas.ID_Kelas='$_SESSION[id_kelas]'
							 
							 ")or die(mysql_error());
	//   }
	   $row = mysql_fetch_array($tam);
	   $ada = mysql_num_rows($tam);
	  ?>
  <tr>
  	<td class="search">
    	<!--Silahkan Masukan NIS terlebih dahulu.-->
    </td>
    </tr>
   <?php }elseif(!empty($_POST[keyword])){
		   $tam = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas  
							 FROM tsiswa 
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = tsiswa.id_kelas
								
								WHERE tsiswa.nis = '" . $_POST[keyword] . "' and tkelas.ID_Kelas='$_SESSION[id_kelas]'
							 ")or die(mysql_error());
	   $row = mysql_fetch_array($tam);
	   $ada = mysql_num_rows($tam);
   }
	   ?>
       <?php if(empty($ada)){?>
       <?php if($_SESSION[status]!="Siswa"){?>
   
   <?php 
	   }
   }else{ ?>
       <tr> 
   <td class="">
   		<table width="25" height="30" align="left"> 
        	<tr>
            	<td width="18"><strong>Nama&nbsp;&nbsp; : &nbsp;&nbsp;</strong>
				<strong><?php echo $row['Nama'];?></strong></td>
                <td width="8">&nbsp;</td><td width="13">&nbsp;</td>
            </tr>
            
            <tr>
            	<td><strong>Kelas&nbsp;&nbsp; : &nbsp;&nbsp;</strong>
				<strong><?php echo $row['Nama_Kelas']?></strong></td>
                <td width="8">&nbsp;</td><td width="13">&nbsp;</td>
            </tr>
        </table>
   </td>
   </tr>
   <tr>
      <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
   	  <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold">
      <?php if(!empty($_POST['keyword'])){?>
      <a href="media.php?pages=catatanprestasi&action=tambah&nis=<?php echo $_POST['keyword']?>&semester=<?php echo $_POST[semester]?>" class=""><strong>Input Nilai Catatan Prestasi</strong></a>
      <?php }else{?>
      <a href="media.php?pages=catatanprestasi&action=tambah&nis=<?php echo $_GET['nis']?>&semester=<?php echo $_POST[semester]?>" class=""><strong>Input Nilai Catatan Prestasi</strong></a>
      <?php } ?>
      </td>
      <?php } ?>
      </tr>
      
   <?php } ?>
      <tr>
  <td class="search">
  	 <form action="" method="post">
    	<table width="68%">
   
    
     
      <tr> 
      <td width="34%">Cari Kelas :</td>
      
      <td colspan="4" width="26%"><input type="text" name="kelas" value="<? echo $_POST[kelas]; ?>"></td>
      </tr>
      <tr> 
      <td width="25%">Cari Tahun Ajaran :</td>
      
      <td width="18%"><input type="text" name="tahun" value="<? echo $_POST[tahun]; ?>"></td>
      <td colspan="3" width="80%" style="font-size:10px; color:#000">Format : (2011-2012)</td>
      </tr>
      <tr> 
      <td width="25%">Cari Semester :</td>
      
      <td colspan="4" width="26%"><input type="text" name="semester" value="<? echo $_POST[semester]; ?>"></td>
      </tr>
      <tr>
      <td colspan="6" align="right"><input type="submit" name="cari" value="Cari" /></td>
    </tr>
     <tr><td width="9%" colspan="6"><a href="cetak_catatanprestasi_pdf.php?nis=<?php echo $_POST[keyword]?>&kelas=<?php echo $_POST[kelas]?>&tahun=<?php echo $_POST[tahun]?>&semester=<?php echo $_POST[semester]?>" target="_blank">Cetak PDF</a></td></tr>

<tr><td colspan="6">&nbsp;</td></tr>
    
   <?php if($_SESSION[status]=="Siswa"){?>
         <?php $sql = mysql_fetch_array(mysql_query("SELECT tsiswa.Nama,tsiswa.nis, tkelas.Nama_Kelas  From tsiswa, tkelas WHERE tsiswa.ID_Kelas = tkelas.ID_KElas AND tsiswa.nis='$_SESSION[nama_user]'"));  
			$nama = $sql['Nama'];
			$nis = $sql['nis'];
			$kelas = $sql['Nama_Kelas'];
?>
     <tr>
     	<td colspan="6"><strong>NIS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;<?php echo $nis?></strong></td>
     </tr>
     <tr>
     	<td colspan="6"><strong>Nama &nbsp; : &nbsp;<?php echo $nama?></strong></td>
     </tr>
     <tr>
     	<td colspan="6"><strong>Kelas &nbsp; : &nbsp;<?php echo $kelas?></strong></td>
     </tr>
     
     <tr><td colspan="6">&nbsp;</td></tr>
     
     <?php } ?>
     
  </table>
    </form>   
  </td>
  </tr>
<tr>
    <td class="bgform">
    <form>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    
<tr class="tabelsorot">
	<th width="100" class="tabelsorot"><strong>No</strong></th>
    <?php if(($_SESSION[status]!="Siswa")){?>
    <th width="300" class="tabelsorot"><strong>NIS</strong></th>
    <?php } ?>
    <th width="400" class="tabelsorot"><strong>Kelas</strong></th>
    
	<th width="400" class="tabelsorot"><strong>Semester</strong></th>
    <th width="500" class="tabelsorot"><strong>Kegiatan</strong></th>
    <th width="500" class="tabelsorot"><strong>Bukti Sertifikasi</strong></th>

    <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
    <th width="130" class="tabelsorot" align="center"><strong>Actions</strong></th>
    <?php } ?>
</tr>
<?php 
 if($_SESSION[status]=="Siswa"){
	 $tampil = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, catatan_prestasi.* 
							 FROM tsiswa 
							 	INNER JOIN catatan_prestasi ON catatan_prestasi.nis = tsiswa.nis
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = catatan_prestasi.id_kelas
								
								WHERE catatan_prestasi.nis = '" . $_SESSION['nama_user'] . "'
							 
							 ")or die(mysql_error());
	$cek = mysql_num_rows($tampil);
	
 }else{
	if(!empty($_GET['nis'])){
	$tampil = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, catatan_prestasi.* 
							 FROM tsiswa 
							 	INNER JOIN catatan_prestasi ON catatan_prestasi.nis = tsiswa.nis
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = catatan_prestasi.id_kelas
								
								WHERE catatan_prestasi.nis = '" . $_GET['nis'] . "'
							 
							 ")or die(mysql_error());
	$cek = mysql_num_rows($tampil);
	}else{
		
			$query='';
		if($_SESSION[status]=="Siswa"){
	$query .= " AND catatan_prestasi.nis = '" . $_SESSION['nama_user'] . "' ";
	}
	if(!empty($_POST[kelas])){
		  $query.= " AND tkelas.Nama_Kelas = '" . $_POST[kelas] . "' ";
   }
   if(!empty($_POST[tahun])){
$query .= " AND ttahun_ajaran.tahun = '" . $_POST[tahun] . "' ";
}
if(!empty($_POST[keyword])){
	$query .= " AND catatan_prestasi.nis = '" . $_POST[keyword] . "' ";	
	}if(!empty($_POST[semester])){
	$query .= " AND catatan_prestasi.semester = '" . $_POST[semester] . "' ";								 
	}
	if(!empty($_SESSION[id_kelas])){
	$query .= " AND catatan_prestasi.id_kelas = '" . $_SESSION[id_kelas] . "' ";
}
	
		$tampil = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, catatan_prestasi.*  
							 FROM tsiswa 
							 	INNER JOIN catatan_prestasi ON catatan_prestasi.nis = tsiswa.nis
								INNER JOIN ttahun_ajaran ON ttahun_ajaran.id = tsiswa.tahun_ajaran
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = catatan_prestasi.id_kelas
								where catatan_prestasi.id_catatan <> ''
								".$query)or die(mysql_error());
		
		$cek = mysql_num_rows($tampil);
	}
 }
	  
	?>	
 <?php $no = 1 ; ?>
 
 		<?php while ($row_kategori = mysql_fetch_assoc($tampil)){ ?>

	<tr class="tabelsorot">
		<td class="tabelsorot" align="center"><?php echo $no++?></td>
        <?php if(($_SESSION[status]!="Siswa")){?>
        <td class="tabelsorot" align="left"><?php echo $row_kategori['nis']?></td>
        <?php } ?>
        <td class="tabelsorot" align="left"><?php echo $row_kategori['Nama_Kelas']?></td>
        
		<td class="tabelsorot" align="left"><?php echo $row_kategori['semester'] ?></td>
        <td class="tabelsorot" align="left"><?php echo $row_kategori['kegiatan'] ?></td>
        <td class="tabelsorot" align="left"><?php echo $row_kategori['bukti_sertifikasi'] ?></td>
       
			
            <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
            
            <td class="tabelsorot" align="center">
			<a href="media.php?pages=catatanprestasi&amp;action=ubah&amp;kid=<?php echo $row_kategori['id_catatan'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="prosescatatan.php?mod=hapus&amp;kid=<?php echo $row_kategori['id_catatan'];?>" title="Hapus Data" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');"><img src="images/tanda_delete.png" alt="" /></a></td>
            <?php } ?>
            		
	</tr>
	 <?php } ?>
	</table>
	
	</form>
</td>
</tr>
</table>

<?php }elseif($action=="tambah"){ 
$nis = $_GET[nis];
$tam = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, tsiswa.id_kelas  
							 FROM tsiswa 
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = tsiswa.id_kelas
								
								WHERE tsiswa.nis = '" . $nis . "'
							 
							 ")or die(mysql_error());
	   $row = mysql_fetch_array($tam);
?>
		<form action="prosescatatan.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('nis','','R','nama','','R','alamat','','R');return document.MM_returnValue">
<table class="bgform" align="right" width="90%">
        <tr><td colspan="3"><strong>Input Nilai Catatan Prestasi</strong></td></tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
      
        <tr>
			<td>Kegiatan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="jenis" size="47" />
            </div></td>
		</tr>
		
        <tr>
			<td>Bukti Sertifikasi</td>
			<td>:</td>
			<td><div class="input text"><textarea name="keterangan" cols="50" rows="5"></textarea>
            </div></td>
		</tr>
		
		 <tr>
		<td class="" align="">Tahun Ajaran</td>
        <td>:</td>
		<td class="" align=""><div class="input text">
		    <select name="tahun">
		       <option value="">- Pilih Tahun Ajaran -</option>
		        <?php 
					$sql = mysql_query("SELECT * FROM ttahun_ajaran ORDER BY id")or die(mysql_error());
					while($kelas = mysql_fetch_array($sql)){
				?>
		        <option value="<?php echo $kelas['id']?>"><?php echo $kelas['tahun']?></option>
		        <?php } ?>
          </select>
		</div></td>    
    </tr>
        <tr><td colspan="3">&nbsp;</td></tr>
       
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<input type="hidden" name="nis" value="<?php echo $_GET[nis]?>">
<input type="hidden" name="semester" value="<?php echo $_GET[semester]?>">
<input type="hidden" name="id_kelas" value="<?php echo $row[id_kelas]?>">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=catatanprestasi">Cancel</a>
</div>        
	</div>
			</td>
		</tr>
         <tr>
			<td colspan="3" align="right">*) Data Harus Di Isi Dengan Benar !
            </td>
		</tr>
	</table>
</form>
<?php }elseif($action=="ubah"){ ?>
<form action="prosescatatan.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		<table class="bgform" align="right" width="90%">
      
       <tr><td colspan="3"><strong>Edit Nilai Catatan Prestasi</strong></td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
			<td>Semester</td>
			<td>:</td>
			<td><div class="input text">
		    <select name="semester">
            <?php 
				$s = $row_ek['semester'];
				switch($s){
					case 'Genap':
						$satu = "selected";
						break;
					case 'Ganjil':
						$dua = "selected";
						break;
					}
			?>
		        <option value="">- Pilih Semester -</option>
                <option value="Genap" <?php echo $satu;?>>Genap</option>
                <option value="Ganjil" <?php echo $dua;?>>Ganjil</option>
            </select></div></td>
		</tr>
		<tr>
			<td>Kegiatan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="jenis" size="47" value="<?php echo $row_ek['kegiatan']?>" />
            </div></td>
		</tr>
		
        <tr>
			<td>Keterangan</td>
			<td>:</td>
			<td><div class="input text"><textarea name="keterangan" cols="50" rows="5"><?php echo $row_ek['bukti_sertifikasi']?></textarea>
            </div></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
		
        <tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit"><input type="hidden" name="id_catatan" value="<?php echo $row_ek['id_catatan']?>" />
<input type="hidden" name="nis" value="<?php echo $row_ek['nis']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=catatanprestasi">Cancel</a>
</div>        
	</div>
			</td>
		</tr>
        
         <tr>
			<td colspan="3" align="right">*) Data Harus Di Isi Dengan Benar !
            </td>
		</tr>
        
	</table>
</form>

<?php } ?>