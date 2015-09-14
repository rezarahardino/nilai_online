<?php 
session_start() ?>
<?php include "config/koneksi.php"; ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

	function GetSQLValueString($row_kategoriheValue, $row_kategoriheType, $row_kategoriheDefinedValue = "", $row_kategoriheNotDefinedValue = "") 
	{
	  $row_kategoriheValue = (!get_magic_quotes_gpc()) ? addslashes($row_kategoriheValue) : $row_kategoriheValue;
	
		  switch ($row_kategoriheType) {
			case "text":
			  $row_kategoriheValue = ($row_kategoriheValue != "") ? "'" . $row_kategoriheValue . "'" : "NULL";
			  break;    
			case "long":
			case "int":
			  $row_kategoriheValue = ($row_kategoriheValue != "") ? intval($row_kategoriheValue) : "NULL";
			  break;
			case "double":
			  $row_kategoriheValue = ($row_kategoriheValue != "") ? "'" . doubleval($row_kategoriheValue) . "'" : "NULL";
			  break;
			case "date":
			  $row_kategoriheValue = ($row_kategoriheValue != "") ? "'" . $row_kategoriheValue . "'" : "NULL";
			  break;
			case "defined":
			  $row_kategoriheValue = ($row_kategoriheValue != "") ? $row_kategoriheDefinedValue : $row_kategoriheNotDefinedValue;
			  break;
		  }
	  return $row_kategoriheValue;
	}

	$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
	if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
		$editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
	}

	if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form1")) {
	$insertSQL = sprintf("INSERT INTO t_user (USERNAME, PASSWORD, TYPE) VALUES (%s,%s,%s)",
						   GetSQLValueString($HTTP_POST_VARS['username'], "text"),
						   GetSQLValueString(md5($HTTP_POST_VARS['password']), "text"),
						   GetSQLValueString($HTTP_POST_VARS['type'], "text")
						   );
		//mysql_select_db($namadb,$sambung);
		echo $insertSQL;
		$Result1 = mysql_query($insertSQL) or die(mysql_error());
		if($Result1){echo"<script>location='media.php?pages=mahasiswa'</script>";}
		}
	

	if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form2")) {
	$tanggal = date('d-m-Y');
				$updateSQL = sprintf("UPDATE t_user SET nama_pegawai=%s,username=%s,password=%s, alamat_pegawai=%s, telepon=%s, 
										email=%s, level=%s WHERE nik=%s",
						   GetSQLValueString($HTTP_POST_VARS['nama'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['username'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['password'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['alamat_pegawai'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['telepon'], "text"),						   
						   GetSQLValueString($HTTP_POST_VARS['email'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['level'], "text"),
						    GetSQLValueString($HTTP_POST_VARS['nik'], "text")
						   );
			
			//mysql_select_db($namadb,$sambung);
			echo $updateSQL;
			$Result1 = mysql_query($updateSQL) or die(mysql_error());
			if($Result1){echo"<script>location='index.php?mod=admin'</script>";}
		}
	

	$maxRows_kategori = 20;
	$pageNum_kategori = 0;
	if (isset($HTTP_GET_VARS['pageNum_kategori'])) {
	  $pageNum_kategori = $HTTP_GET_VARS['pageNum_kategori'];
	}
	
	if($_POST[cari]=="Cari"){
	if($_POST[select]=="NIP"){
		$queryx=" where tguru.NIP like '%".$_POST[keyword]."%'";
	}
	
	if($_POST[select]=="Nama_Guru"){
		$queryx=" where tguru.Nama_Guru like '%".$_POST[keyword]."%'";
	}
}
	
	$startRow_kategori = $pageNum_kategori * $maxRows_kategori;
	$query_kategori = "SELECT tguru.* FROM tguru" . $queryx. " ORDER BY tguru.NIP";
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

	$kid = $_GET['NIP'];
	$query_ek = "SELECT tguru.* FROM tguru 
						WHERE tguru.NIP = '$kid'";
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
			if (p<1 || p==(val.length-1)) errors+='- '+nm+' Tidak Valid.\n';
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
	<h2><img src="images/table_guru.png" alt=""/></h2>
	<?php 
$action = $_GET['action'];
if(empty($action)){?>

<table width="1007" cellpadding="0" cellspacing="0">
<?php if(($_SESSION[status]!="Siswa")&&($_SESSION[status]!="Guru")){?>
<tr>
    
    <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold"><a href="media.php?pages=guru&amp;action=tambah" class="">Input Guru</a></td></tr>
    <?php } ?>
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
  <tr>
  	<td class="search">
     <form action="" method="post">
    	<table width="100%">
    <tr> 
      <td width="30%">Cari Berdasarkan :</td>
      <td width="9%"> <select name="select" class="">
          <option value="">- Pilih Type -</option>
          <option value="NIP" <? echo $_POST[select]=="NIP"?"selected":"";?>>NIP</option>
          <option value="Nama_Guru" <? echo $_POST[select]=="Nama_Guru"?"selected":"";?>>Nama</option>
        </select></td>
      <td width="14%"><input type="text" name="keyword" value="<? echo $_POST[keyword]; ?>"></td>
      <td width="30%"><input type="submit" name="cari" value="Cari"></td>
      <td width="50%"><a href="cetak_guru_pdf.php?kat=<?php echo $_POST[select]?>&key=<?php echo $_POST[keyword]?>" target="_blank">Cetak PDF</a>
    </tr>
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
	<th width="100" class="tabelsorot"><strong>NIP</strong></th>
	<th width="350" class="tabelsorot"><strong>Nama</strong></th>
	<th width="350" class="tabelsorot"><strong>Alamat</strong></th>
	<th width="150" class="tabelsorot"><strong>JK</strong></th>
    <th width="200" class="tabelsorot"><strong>Email</strong></th>
	<th width="150" class="tabelsorot" align="center"><strong>Actions</strong></th>
</tr>
 <?php $no = 1 ; 
 		do { ?>

	<tr class="tabelsorot">
		<td class="tabelsorot" align="center"><?php echo $no++?></td>
		<td class="tabelsorot"><?php echo $row_kategori['NIP']?></td>
		<td class="tabelsorot" align="left"><?php echo $row_kategori['Nama_Guru'] ?></td>
		<td class="tabelsorot"><?php echo $row_kategori['alamat']?></td>
		<td class="tabelsorot"><?php echo $row_kategori['Jenis_Kelamin']?></td>
        <td class="tabelsorot"><?php echo $row_kategori['email']?></td>
        
        <td class="tabelsorot" align="center">
			<a href="media.php?pages=guru&amp;action=view&amp;NIP=<?php echo $row_kategori['NIP'];?>" title="Lihat Data Lengkap"><img src="images/tanda_view.png" alt="" /></a>
            <?php if(($_SESSION[status]!="Siswa")&&($_SESSION[status]!="Guru")){?>
			<a href="media.php?pages=guru&amp;action=ubah&amp;NIP=<?php echo $row_kategori['NIP'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="prosesguru.php?mod=hapus&amp;kid=<?php echo $row_kategori['NIP'];?>" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');" title="Hapus Data"><img src="images/tanda_delete.png" alt="" /></a>		
            <?php } ?>
            </td>
	</tr>
	 <?php } while ($row_kategori = mysql_fetch_assoc($kategori)); ?>
	</table>
	
	</form>
</td>
</tr>
</table>

<?php }elseif($action=="tambah"){ ?>
		<form action="prosesguru.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('NIP','','R','nama','','R','tempat_lahir','','R','tgl1', '', 'R', 'alamat','','R', 'kode_pos', '', 'R', 'kota', '','R', 'telepon', '', 'R', 'email', '' ,'RisEmail');return document.MM_returnValue">
		<table class="bgform">
		 <tr>
			<td class="bgform" colspan="3"><strong>Input Data Guru</strong></td>
		</tr>
        <tr>
        	<td colspan="3" align="center"><strong>Keterangan Diri Guru</strong></td>
        </tr>
		<tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
			<td width="117">NIP</td>
			<td width="17">:</td>
			<td width="350">
			<input type="text" name="NIP" />
			</td>
		</tr>
        
        <tr>
			<td>Nama</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="nama" /></div></td>
		</tr>
		
		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td><div class="input text">
			<select name="jk">
				<option value="Pria">Pria</option>
				<option value="Wanita">Wanita</option>
			</select>
			</div>
			 </td>
		</tr>
		
        <tr>
			<td>Agama</td>
			<td>:</td>
			<td><div class="input text">
			<select name="agama">
				<option value="Islam">Islam</option>
				<option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
			</select>
			</div>
			 </td>
		</tr>
        
		<tr>
			<td>Tempat Lahir</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="tempat_lahir" /></div></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td>:</td>
			<td><div class="input text"><input size="15" type="text" readonly name="tgl1" id="tgl1">
    <input name="button" class="button" type="button" onClick="displayCalendar(document.form1.tgl1,'yyyy-mm-dd',this,true)" value="Calender"></div></td>
		</tr>
         <tr>
			<td>Email</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="email" /></div></td>
		</tr>
        
        <tr>
			<td>Pendidikan Terakhir</td>
			<td>:</td>
			<td><div class="input text">
            <select name="pendidikan">
             <option value="">- Pilih Pendidikan -</option>
            	<option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
            </div></td>
		</tr>
        
       <tr>
    	<td class="">Jabatan</td>
        <td>:</td>
        <td class="">
       
		    <select name="jabatan" >
		        <option value="">- Pilih Jabatan -</option>
                <option value="Kepala Sekolah">Kepala Sekolah</option>
                <option value="Wali Kelas">Wali Kelas</option>
                <option value="Guru">Guru</option>
             </select>
       
        </td>
        
    </tr>
        
        <tr>
			<td>Foto</td>
			<td>:</td>
			<td><div class="input text"><input type="file" name="foto" /></div></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
        	<td colspan="3" align="center"><strong>Keterangan Tempat Tinggal</strong></td>
        </tr>
        
	        <tr><td colspan="3">&nbsp;</td></tr>
		
        <tr>
			<td>Alamat</td>
			<td>:</td>
			<td><textarea name="alamat" cols="50" rows="5" ></textarea></td>
		</tr>
              
        <tr>
			<td>Kota</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="kota" /></div></td>
		</tr>
        
        <tr>
			<td>Kode Pos</td>
			<td>:</td>
			<td><div class="input text">
			  <input type="text" name="kodepos" />
		  </div></td>
		</tr>
        
		<tr>
			<td>Telepon</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="telepon" /></div></td>
		</tr>
		 <tr><td colspan="3">&nbsp;</td></tr>
         
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=guru">Cancel</a>
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
<form action="prosesguru.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		<table class="bgform">
        <tr><td colspan="3"><strong>Edit Data Guru</strong></td></tr>
		<tr>
        	<td colspan="3" align="center"><strong>Keterangan Diri Guru</strong></td>
        </tr>
        
		<tr>
			<td width="157">&nbsp;</td>
			<td width="17">&nbsp;</td>
			<td width="390">
			<input type="hidden" name="NIP" value="<?php echo $row_ek['NIP']?>" />
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="nama" value="<?php echo $row_ek['Nama_Guru']?>" /></div></td>
		</tr>

		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td><div class="input text">
			<select name="jk">
            	<?php if($row_ek['Jenis_Kelamin']=="Pria"){
					$selected = "Pria";
				?>
				<option value="Pria" selected="selected">Pria</option>
                <option value="Wanita">Wanita</option>
                <?php }else{ ?>
                <option value="Pria">Pria</option>
				<option value="Wanita"  selected="selected">Wanita</option>
                <?php } ?>
			</select>
			</div>
			 </td>
		</tr>
	
    <tr>
			<td>Agama</td>
			<td>:</td>
			<td><div class="input text">
            <select name="agama">
            <?php 
				switch($row_ek['agama']){
					case 'Islam':
						$Islam = "selected";
					break;
					case 'Kristen':
						$Kristen = "selected";
					break;
					case 'Hindu':
						$Hindu = "selected";
					break;
					case 'Buddha':
						$Buddha = "selected";
					break;
					case 'Konghucu':
						$Konghucu = "selected";
					break;
					
				}
			?>
            	<option value="Islam" <?php echo $Islam?>>Islam</option>
                <option value="Kristen" <?php echo $Kristen?>>Kristen</option>
                <option value="Hindu" <?php echo $Hindu?>>Hindu</option>
                <option value="Buddha" <?php echo $Buddha?>>Buddha</option>
                <option value="Konghucu" <?php echo $Konghucu?>>Konghucu</option>
                </select>
            </div></td>
		</tr>
        
		<tr>
			<td>Tempat Lahir</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="tempat_lahir" value="<?php echo $row_ek['tempat_lahir']?>" /></div></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td>:</td>
			<td><div class="input text"><input size="15" type="text" readonly name="tgl1" id="tgl1" value="<?php echo $row_ek['tgl_lahir']?>">
    <input name="button" class="button" type="button" onClick="displayCalendar(document.form2.tgl1,'yyyy-mm-dd',this,true)" value="Cal"></div></td>
		</tr>
        
        <tr>
			<td>Email</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="email" value="<?php echo $row_ek['email']?>"/></div></td>
		</tr>
        
        <tr>
			<td>Pendidikan Terakhir</td>
			<td>:</td>
			<td><div class="input text">
            <select name="pendidikan">
            <?php 
				switch($row_ek['Pendidikan_Terakhir']){
					case 'D1':
						$D1 = "selected";
					break;
					case 'D2':
						$D2 = "selected";
					break;
					case 'D3':
						$D3 = "selected";
					break;
					case 'S1':
						$S1 = "selected";
					break;
					case 'S2':
						$S2 = "selected";
					break;
					case 'S3':
						$S3 = "selected";
					break;
				}
			?>
            	<option value="D1" <?php echo $D1?>>D1</option>
                <option value="D2" <?php echo $D2?>>D2</option>
                <option value="D3" <?php echo $D3?>>D3</option>
                <option value="S1" <?php echo $S1?>>S1</option>
                <option value="S2" <?php echo $S2?>>S2</option>
                <option value="S3" <?php echo $S3?>>S3</option>
            </select>
            </div></td>
		</tr>
        
        <tr>
    	<td class="">
        	Jabatan
        </td><td>:</td>
        <td class="">
        <div class="input text">
		    <select name="jabatan">
            <?php 
				$s = $row_ek['jabatan'];
				switch($s){
					case 'Kepala Sekolah':
						$Kepala_Sekolah = "selected";
						break;
					case 'Wali Kelas':
						$Wali_Kelas = "selected";
						break;
					case 'Guru':
						$Guru = "selected";
						break;
				}
			?>
		        <option value="">- Pilih Jabatan -</option>
                <option value="Kepala Sekolah" <?php echo $Kepala_Sekolah?>>Kepala Sekolah</option>
                <option value="Wali Kelas" <?php echo $Wali_Kelas?>>Wali Kelas</option>
                <option value="Guru" <?php echo $Guru?>>Guru</option>
                </select>
        </div>
        </td>
        
    </tr>
    
        <tr>
			<td>Foto</td>
			<td>:</td>
			<td><div class="input text"><input type="file" name="foto" /></div></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
        	<td colspan="3" align="center"><strong>Keterangan Tempat Tinggal</strong></td>
        </tr>
        
         <tr><td colspan="3">&nbsp;</td></tr>
         
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><div class="input text"><textarea name="alamat" cols="50" rows="5"><?php echo $row_ek['alamat']?></textarea></div></td>
		</tr>
        
         <tr>
			<td>Kota</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="kota" value="<?php echo $row_ek['kota']?>" /></div></td>
		</tr>
        
		<tr>
			<td>Kode Pos</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="kodepos" value="<?php echo $row_ek['kodepos']?>" /></div></td>
		</tr>
              
        <tr>
			<td>Telepon</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="telepon" value="<?php echo $row_ek['No_Telp']?>"  /></div></td>
		</tr>
        
			<tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
        
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit"><input type="hidden" name="kode" value="<?php echo $row_ek['kode']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=guru">Cancel</a>
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

<?php }elseif($action=="view"){?>
<form action="prosesguru.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data">
<table class="bgform"  align="right" width="100%">
   <tr>
			<td class="bgform" colspan="3"><strong>Lihat Data Guru</strong></td>
		</tr>
	
    	<tr>
        	<td colspan="3" align="center"><strong>Keterangan Diri Guru</strong></td>
        </tr>
	      <tr><td valign="top" class="star2" colspan="2" align="left"><img src="<?php echo 'images/foto_guru/'. $row_ek['photo']?>" width="130" height="134" style="border:#FF0000; border:double" /></td>
	  <td></tr>
	
		<tr>
			<td width="143">NIP</td>
			<td width="13">:</td>
			<td width="191"><?php echo $row_ek['NIP']?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?php echo $row_ek['Nama_Guru']?></td>
		</tr>

		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td><?php 
				echo $row_ek['Jenis_Kelamin'];?>
			</td>
            </tr>
		<tr>
			<td>Agama</td>
			<td>:</td>
			<td><?php echo $row_ek['agama']?></td>
		</tr>
        <tr>
			<td>Tempat Lahir</td>
			<td>:</td>
			<td><?php echo $row_ek['tempat_lahir']?></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td>:</td>
			<td><?php echo tgl_indo($row_ek['tgl_lahir'])?></td>
		</tr>
        <tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo $row_ek['email']?></td>
		</tr>
        <tr>
			<td>Pendidikan Terakhir</td>
			<td>:</td>
			<td><?php echo $row_ek['Pendidikan_Terakhir']?></td>
		</tr>
          <tr>
			<td>Jabatan</td>
			<td>:</td>
			<td><?php echo $row_ek['jabatan']?></td>
		</tr>
        <tr>
			<td height="25">Foto</td>
			<td>:</td>
			<td><?php echo $row_ek['photo']?></td>
		</tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
        	<td colspan="3" align="center"><strong>Keterangan Tempat Tinggal</strong></td>
        </tr>
        
	        <tr><td colspan="3">&nbsp;</td></tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $row_ek['alamat']?></td>
		</tr>
        
        <tr>
			<td>Kota</td>
			<td>:</td>
			<td><?php echo $row_ek['kota']?></td>
		</tr>
        
		<tr>
			<td>Kode Pos</td>
			<td>:</td>
			<td><?php echo $row_ek['kodepos']?></td>
		</tr>
        
		<tr>
			<td>Telepon</td>
			<td>:</td>
			<td><?php echo $row_ek['No_Telp']?></td>
		</tr>
		
        <tr><td colspan="3">&nbsp;</td></tr>
		
		<tr>
		<td colspan="3" align="right"><a href="javascript:window.print()"><strong>Print</strong></a> | <a href="media.php?pages=guru"><strong>Kembali</strong></a></td>
	</tr>

</table>
</table>
</td>
</tr>
</form>
<?php } ?>