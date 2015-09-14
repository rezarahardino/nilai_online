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
	$query_ek = "SELECT kepribadian.* 
							 FROM kepribadian 
							 	WHERE kepribadian.id_kepribadian = '" . $kid . "'";
							 
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
	<h2><img src="images/table_nilai_kepribadian.png" alt=""/></h2>
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
      </tr>
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
  <?php } ?>
 <?php 
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
   <?php } ?>
   <?php }else{ ?>
       <tr> 
   <td class="">
   		<table width="25" height="30" align="left"> 
        	<tr>
            	<td width="18"><strong>Nama&nbsp;&nbsp; : &nbsp;&nbsp;</strong>
				<strong><?php echo $row['Nama'];?></strong></td>
                <td width="8">&nbsp;</td><td width="13">&nbsp;</td>
            </tr>
            
            <tr>
            	<td width="18"><strong>Kelas&nbsp;&nbsp; : &nbsp;&nbsp;</strong>
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
      <a href="media.php?pages=kepribadian&action=tambah&nis=<?php echo $_POST['keyword']?>&semester=<?=$_POST[semester]?>" class=""><strong>Input Nilai Kepribadian</strong></a>
      <?php }else{?>
      <a href="media.php?pages=kepribadian&action=tambah&nis=<?php echo $_GET['nis']?>&semester=<?=$_POST[semester]?>" class=""><strong>Input Nilai Kepribadian</strong></a>
      <?php } ?>
      </td>
      <?php } ?>
      </tr>
   
   <?php } ?>
   
    <tr>
    
  <td class="search">
  	 <form action="" method="post">
    	<table width="100%">
   
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
      <tr><td width="9%" colspan="6"><a href="cetak_kepribadian_pdf.php?nis=<?php echo $_POST[keyword]?>&kelas=<?php echo $_POST[kelas]?>&tahun=<?php echo $_POST[tahun]?>&semester=<?php echo $_POST[semester]?>" target="_blank">Cetak PDF</a></td></tr>

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
	<th width="70" class="tabelsorot"><strong>No</strong></th>
    <?php if(($_SESSION[status]!="Siswa")){?>
    <th width="200" class="tabelsorot"><strong>NIS</strong></th>
    
    <?php } ?>
    <th width="200" class="tabelsorot"><strong>Kelas</strong></th>

	<th width="250" class="tabelsorot"><strong>Semester</strong></th>
 	<th width="200" class="tabelsorot"><strong>Nilai Kepribadian</strong></th>
    <th width="80" class="tabelsorot" align="center"><strong>Actions</strong></th>
  
</tr>
<?php 
if($_SESSION[status]=="Siswa"){
	
	$tampil = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, kepribadian.*  
							 FROM tsiswa 
							 	INNER JOIN kepribadian ON kepribadian.nis = tsiswa.nis
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = kepribadian.id_kelas
								
								WHERE kepribadian.nis = '" . $_SESSION['nama_user'] . "'
							 
							 ")or die(mysql_error());
	$cek = mysql_num_rows($tampil);
	
}else{
	if(!empty($_GET['nis'])){
	$tampil = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, kepribadian.*  
							 FROM tsiswa 
							 	INNER JOIN kepribadian ON kepribadian.nis = tsiswa.nis
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = kepribadian.id_kelas
								WHERE kepribadian.nis = '" . $_GET['nis'] . "'
							 
							 ")or die(mysql_error());
							
	$cek = mysql_num_rows($tampil);
	}else{
		
		$query='';
		if($_SESSION[status]=="Siswa"){
	$query .= " AND tsiswa.nis = '" . $_SESSION['nama_user'] . "' ";
	}
	if(!empty($_SESSION[id_kelas])){
	$query .= " AND kepribadian.id_kelas = '" . $_SESSION[id_kelas] . "' ";
}

	if(!empty($_POST[kelas])){
		  $query.= " AND tkelas.Nama_Kelas LIKE '%" . $_POST[kelas] . "%' ";
   }
   if(!empty($_POST[tahun])){
$query .= " AND ttahun_ajaran.tahun = '" . $_POST[tahun] . "' ";
}
if(!empty($_POST[keyword])){
	$query .= " AND tsiswa.nis = '" . $_POST[keyword] . "' ";	
	}
	if(!empty($_POST[semester])){
	$query .= " AND kepribadian.semester = '" . $_POST[semester] . "' ";								 
	}
	
		$tampil = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, kepribadian.*
							 FROM tsiswa 
							 	INNER JOIN kepribadian ON kepribadian.nis = tsiswa.nis
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = kepribadian.id_kelas
								
								where kepribadian.id_kepribadian <> '' ". $query)or die(mysql_error());
								
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
   	    <td class="tabelsorot" align="left"><?php echo $row_kategori['kosong'] ?></td>


            
  <td class="tabelsorot" align="center">
					
            <a href="media.php?pages=kepribadian&amp;action=view&amp;kid=<?php echo $row_kategori['id_kepribadian'];?>" title="Lihat Data Lengkap"><img src="images/tanda_view.png" alt="" /></a>
            <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
			<a href="media.php?pages=kepribadian&amp;action=ubah&amp;kid=<?php echo $row_kategori['id_kepribadian'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="proseskepribadian.php?mod=hapus&amp;kid=<?php echo $row_kategori['id_kepribadian'];?>" title="Hapus Data" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');" title="Hapus Data" ><img src="images/tanda_delete.png" alt="" /></a>
            <?php } ?>
            </td>
            		
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
		<form action="proseskepribadian.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('nis','','R','tahun_ajaran','','R','alamat','','R');return document.MM_returnValue">
<table class="bgform" align="right" width="90%">
       <tr><td colspan="3"><strong>Input Nilai Kepribadian</strong></td></tr>
       <tr><td colspan="3">&nbsp;</td></tr>
    
     <tr>
			<td>Kedisiplinan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kedisiplinan" />
            </div></td>
		</tr>
        <tr>
			<td>Kebersihan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kebersihan" />
            </div></td>
		</tr>
        <tr>
			<td>Kesehatan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kesehatan" />
            </div></td>
		</tr>
        <tr>
			<td>Tanggung Jawab</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="tanggung_jawab" />
            </div></td>
		</tr>
        <tr>
			<td>Sopan Santun</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="sopan_santun" />
            </div></td>
		</tr>
        <tr>
			<td>Percaya Diri</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="percaya_diri" />
            </div></td>
		</tr>
        <tr>
			<td>Kompetetif</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kompetetif" />
            </div></td>
		</tr>
        <tr>
			<td>Hubungan Sosial</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="hubungan_sosial" />
            </div></td>
		</tr>
        <tr>
			<td>Kejujuran</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kejujuran" />
            </div></td>
		</tr>
        <tr>
			<td>Pelaksanaan Ibadah</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="pelaksanaan_ibadah" />
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
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=kepribadian">Cancel</a>
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
<form action="proseskepribadian.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		<table class="bgform" align="right" width="90%">
        
       <tr><td colspan="3"><strong>Edit Nilai Kepribadian</strong></td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        

		 <tr>
			<td>Semester</td>
			<td>:</td>
			<td><div class="input text">
		    <select name="semester">
            <?php 
				$s = $row_ek['semester'];
				switch($s){
					case 'Ganjil':
						$satu = "selected";
						break;
					case 'Genap':
						$dua = "selected";
						break;
					}
			?>
		        <option value="">- Pilih Semester -</option>
                <option value="Ganjil" <?php echo $satu;?>>Ganjil</option>
                <option value="Genap" <?php echo $dua;?>>Genap</option>
            </select></div></td>
		</tr>
		<tr>
			<td>Kedisplinan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kedisiplinan" value="<?=$row_ek['kedisiplinan']?>" />
            </div></td>
		</tr>
        <tr>
			<td>Kebersihan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kebersihan" value="<?=$row_ek['kebersihan']?>" />
            </div></td>
		</tr>
        <tr>
			<td>Kesehatan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kesehatan" value="<?=$row_ek['kesehatan']?>" />
            </div></td>
		</tr>
        <tr>
			<td>Tanggung Jawab</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="tanggung_jawab" value="<?=$row_ek['tanggung_jawab']?>" />
            </div></td>
		</tr>
        <tr>
			<td>Sopan Santun</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="sopan_santun" value="<?=$row_ek['sopan_santun']?>" />
            </div></td>
		</tr>
        <tr>
			<td>Percaya Diri</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="percaya_diri" value="<?=$row_ek['percaya_diri']?>" />
            </div></td>
		</tr>
         <tr>
			<td>Kompetetif</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kompetetif" value="<?=$row_ek['kompetetif']?>" />
            </div></td>
		</tr>
         <tr>
			<td>Hubungan Sosial</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="hubungan_sosial" value="<?=$row_ek['hubungan_sosial']?>" />
            </div></td>
		</tr>
        <tr>
			<td>Kejujuran</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="kejujuran" value="<?=$row_ek['kejujuran']?>" />
            </div></td>
		</tr>
        <tr>
			<td>Pelaksanaan Ibadah</td>
			<td>:</td>
			<td><div class="input text"><input type="text" size="50" name="pelaksanaan_ibadah" value="<?=$row_ek['pelaksanaan_ibadah']?>" />
            </div></td>
		</tr>
        
         <tr><td colspan="3">&nbsp;</td></tr>
         
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit"><input type="hidden" name="id_kepribadian" value="<?php echo $row_ek['id_kepribadian']?>" />
<input type="hidden" name="nis" value="<?php echo $row_ek['nis']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=kepribadian">Cancel</a>
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
<?php }elseif($action=="view"){ ?>
<form action="proseskepribadian.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		
        <table class="bgform" align="right" width="100%">
        
       <tr><td colspan="3"><strong>Lihat Nilai Kepribadian</strong></td></tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        
     <tr>
			<td width="30%">NIS</td>
			<td>:</td>
			<td width="70%"><div class="input text"><?=$row_ek['nis'];?></div></td>
		</tr>
		 <tr>
			<td class="" align="" width="25%">Semester</td>
			<td>:</td>
			<td class="" align="" width="70%"><div class="input text">
		    <?=$row_ek['semester'];?>
				</div></td>
		</tr>
		<tr>
			<td>Kedisplinan</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['kedisiplinan']?>
            </div></td>
		</tr>
        <tr>
			<td>Kebersihan</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['kebersihan']?>
            </div></td>
		</tr>
        <tr>
			<td>Kesehatan</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['kesehatan']?>
            </div></td>
		</tr>
        <tr>
			<td>Tanggung Jawab</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['tanggung_jawab']?>
            </div></td>
		</tr>
        <tr>
			<td>Sopan Santun</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['sopan_santun']?>
            </div></td>
		</tr>
        <tr>
			<td>Percaya Diri</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['percaya_diri']?>
            </div></td>
		</tr>
         <tr>
			<td>Kompetetif</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['kompetetif']?>
            </div></td>
		</tr>
         <tr>
			<td>Hubungan Sosial</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['hubungan_sosial']?>
            </div></td>
		</tr>
        <tr>
			<td>Kejujuran</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['kejujuran']?>
            </div></td>
		</tr>
        <tr>
			<td>Pelaksanaan Ibadah</td>
			<td>:</td>
			<td><div class="input text"><?=$row_ek['pelaksanaan_ibadah']?>
            </div></td>
		</tr>
        
         <tr><td colspan="3">&nbsp;</td></tr>
         
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit"> <a href="media.php?pages=kepribadian"><strong>Kembali</strong></a>
</div>        
	</div>
			</td>
		</tr>
	</table>
</form>

<?php } ?>