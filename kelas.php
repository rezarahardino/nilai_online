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
			if($Result1){echo"<script>location='media.php?mod=admin'</script>";}
		}
	

	$maxRows_kategori = 20;
	$pageNum_kategori = 0;
	if (isset($HTTP_GET_VARS['pageNum_kategori'])) {
	  $pageNum_kategori = $HTTP_GET_VARS['pageNum_kategori'];
	}
	
	if(!empty($_POST['cari'])){
		$query = "WHERE id_tahun_ajaran ='" . $_POST['tahun']. "'";
		}
		
	$startRow_kategori = $pageNum_kategori * $maxRows_kategori;
	$query_kategori = "SELECT tkelas.*, tguru.Nama_Guru FROM tkelas INNER JOIN tguru ON tguru.NIP = tkelas.ID_Guru " . $query. " ORDER BY tkelas.ID_Kelas";
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

	$kid = $_GET['ID_Kelas'];
	$query_ek = "SELECT tkelas.* FROM tkelas 
						WHERE tkelas.ID_Kelas = '$kid'";
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
<link href="../elearning_yopi/css/load-styles.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../elearning_yopi/tool/dhtmlgoodies_calendar.css" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../elearning_yopi/tool/dhtmlgoodies_calendar.js"></script>
	<h2><img src="images/table_kelas.png" alt=""/></h2>
	<?php 
$action = $_GET['action'];
if(empty($action)){?>

<table width="1007" cellpadding="0" cellspacing="0">
<?php if($_SESSION[status]!="Guru"){?>
<tr>
    <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold"><a href="media.php?pages=kelas&amp;action=tambah" class="">Input Kelas</a></td>
</tr>
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
<!--tr>
    <td class="bgform"> <form action="" method="post">
    	<table width="100%">
    <tr> 
      <td width="17%">Cari Tahun Ajaran :</td>
      <td width="10%" class="search"><select name="tahun">
				<option value="">- Pilih Tahun Ajaran -</option>
                <?php 
					$sql = mysql_query("SELECT * FROM ttahun_ajaran ORDER BY id")or die(mysql_error());
					while($guru = mysql_fetch_array($sql)){
						if($_POST[tahun]==$guru[id]){
				?>
				<option value="<?php echo $guru['id']?>" selected="<?php echo $_POST[tahun]?>"><?php echo $guru['tahun']?></option>
                <?php }else{ ?>
                <option value="<?php echo $guru['id']?>"><?php echo $guru['tahun']?></option>
                <?php }
					}
				?>
			</select>
            </td>
             <td colspan="3" style="font-size:10px; color:#000">Format : (2011-2012)</td>
     </tr>
      <tr>
      <td colspan="6" width="60%" align="right"><input type="submit" name="cari" value="Cari"></td>
      
    </tr>
  </table>
    </form>
    </td></tr>-->
 
    
    <tr>
    <td class="bgform">
    <form>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    
<tr class="tabelsorot">
	<th width="50" class="tabelsorot"><strong>No</strong></th>
	<th width="400" class="tabelsorot"><strong>Kelas</strong></th>
	<th width="400" class="tabelsorot"><strong>Wali Kelas</strong></th>
	
    <?php if($_SESSION[status]!="Guru"){?>
    <th width="86" class="tabelsorot" align="center"><strong>Actions</strong></th>
    <?php } ?>
</tr>
 <?php $no = 1 ; 
 		do { ?>

	<tr class="tabelsorot">
		<td class="tabelsorot" align="center"><?php echo $no++?></td>
		<!--<td class="tabelisi"><?php echo $row_kategori['ID_Kelas']?></td>-->
		<td class="tabelsorot" align="left"><?php echo $row_kategori['Nama_Kelas'] ?></td>
		<td class="tabelsorot"><?php echo $row_kategori['Nama_Guru']?></td>
		
        <?php if($_SESSION[status]!="Guru"){?>
        <td class="tabelsorot" align="center">
		           
			<a href="media.php?pages=kelas&amp;action=ubah&amp;ID_Kelas=<?php echo $row_kategori['ID_Kelas'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="proseskelas.php?mod=hapus&amp;kid=<?php echo $row_kategori['ID_Kelas'];?>" title="Hapus Data" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');"><img src="images/tanda_delete.png" alt="" /></a>		
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
		<form action="proseskelas.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('ID_Kelas','','R','nama_kelas','','R','id_guru','','R');return document.MM_returnValue">
		<table class="bgform">
        
        <tr>
			<td class="bgform" colspan="3"><strong>Input Kelas</strong></td>
		</tr>
		
        <tr><td colspan="3">&nbsp;</td></tr>
        
		<tr>
			<td width="157">ID Kelas</td>
			<td width="17">:</td>
			<td width="390">
				<input type="text" name="ID_Kelas" maxlength="5" />
			</td>
		</tr>
		<tr>
			<td>Kelas</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="nama_kelas" /></div></td>
		</tr>

		<tr>
			<td>Wali Kelas</td>
			<td>:</td>
			<td><div class="input text">
			<select name="id_guru">
				<option value="">- Pilih Wali Kelas -</option>
                <?php 
					$sql = mysql_query("SELECT * FROM tguru  where NIP not in (select ID_Guru FROM tkelas) ORDER BY NIP")or die(mysql_error());
					while($guru = mysql_fetch_array($sql)){
				?>
				<option value="<?php echo $guru['NIP']?>"><?php echo $guru['Nama_Guru']?></option>
                <?php } ?>
			</select>
			</div>
			 </td>
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
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=kelas">Cancel</a>
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
<form action="proseskelas.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		<table class="bgform">
        
         <tr><td colspan="3"><strong>Edit Kelas</strong></td></tr>
         
		<tr>
			<td width="157">&nbsp;</td>
			<td width="17">&nbsp;</td>
			<td width="390">
			<input type="hidden" name="ID_Kelas" value="<?php echo $row_ek['ID_Kelas']?>" />
			</td>
		</tr>
		<tr>
			<td>Kelas</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="nama_kelas" value="<?php echo $row_ek['Nama_Kelas']?>" /></div></td>
		</tr>

		<tr>
			<td>Wali Kelas</td>
			<td>:</td>
			<td><div class="input text">
			<select name="id_guru">
				<option value="">- Pilih Guru -</option>
                <?php 
					$sql = mysql_query("SELECT * FROM tguru where NIP ORDER BY NIP")or die(mysql_error());
					while($guru = mysql_fetch_array($sql)){
						if($row_ek['ID_Guru'] == $guru['NIP']){
				?>
				<option value="<?php echo $guru['NIP']?>" selected="<?php echo $row_ek['ID_Guru']?>"><?php echo $guru['Nama_Guru']?></option>
                
                <?php }else{?>
				<option value="<?php echo $guru['NIP']?>"><?php echo $guru['Nama_Guru']?></option>
				
				<?php	
					}
				} ?>
			</select>
			</div>
			 </td>
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
						if($row_ek['id_tahun_ajaran']==$kelas['id']){
				?>
                
		        <option value="<?php echo $kelas['id']?>" selected="<?php echo $row_ek['id_tahun_ajaran']?>"><?php echo $kelas['tahun']?></option>
		        <?php }else{ ?>
                <option value="<?php echo $kelas['id']?>"><?php echo $kelas['tahun']?></option>
                <?php }
				
					}?>
		        </select>
		</div></td>    
    </tr>
    
    <tr><td colspan="3">&nbsp;</td></tr>
    
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=kelas">Cancel</a>
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