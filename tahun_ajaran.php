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
		if($Result1){echo"<script>location='media.php?pages=mahatahun_ajaran'</script>";}
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
	

	$startRow_kategori = $pageNum_kategori * $maxRows_kategori;
	$query_kategori = "SELECT ttahun_ajaran.* FROM  ttahun_ajaran";
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
	$query_ek = "SELECT ttahun_ajaran.*  
							 FROM ttahun_ajaran 
							 	WHERE ttahun_ajaran.id = '" . $kid . "'
							 
							 ";
							 
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
	<h2><img src="images/table_tahun_ajaran.png" alt=""/></h2>
	<?php 
$action = $_GET['action'];
if(empty($action)){?>

<table width="1007" cellpadding="0" cellspacing="0">
<tr>
    
    <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold"><a href="media.php?pages=tahun_ajaran&amp;action=tambah" class="">Input Tahun Ajaran</a></td></tr>
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
    <td class="bgform">
    <form>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    
<tr class="tabelsorot">
	<th width="100" class="tabelsorot"><strong>No</strong></th>
	<th width="900" class="tabelsorot"><strong>Kode Tahun Ajaran</strong></th>
	<th width="900" class="tabelsorot"><strong>Tahun Ajaran</strong></th>
    <th width="86" class="tabelsorot" align="center"><strong>Actions</strong></th>
</tr>
 <?php $no = 1 ; 
 		do { ?>

	<tr class="tabelsorot">
    	<td class="tabelsorot" align="center"><?php echo $no++?></td>
		<td class="tabelsorot" align="center"><?php echo $row_kategori['id']?></td>
		<td class="tabelsorot" align="center"><?php echo $row_kategori['tahun']?></td>
       
       <td width="209" align="center" class="tabelsorot">
			
            <a href="media.php?pages=tahun_ajaran&amp;action=ubah&amp;kid=<?php echo $row_kategori['id'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="prosestahun.php?mod=hapus&amp;kid=<?php echo $row_kategori['id'];?>" title="Hapus Data" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');"><img src="images/tanda_delete.png" alt="" /></a>
            		</td>
	</tr>
	 <?php } while ($row_kategori = mysql_fetch_assoc($kategori)); ?>
	</table>
	
	</form>
</td>
</tr>
</table>

<?php }elseif($action=="tambah"){ 
$nis = $_GET[nis];
?>
		<form action="prosestahun.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('nis','','RisNum','nama','','R','id','','R');return document.MM_returnValue">
<table class="bgform" align="right" width="100%">
       <tr>
			<td class="bgform" colspan="10"><strong>Input Tahun Ajaran</strong></td>
		</tr>
		
        <tr><td colspan="10">&nbsp;</td></tr>
      <tr>
			<td width="34%">Kode Tahun Ajaran</td>
			<td>:</td>
			<td colspan="10"><div class="input text"><input type="text" name="kode" /></div></td>
		</tr>
      <tr>
			<td width="34%">Tahun Ajaran</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="tahun" value="<?php echo $row_ek['tahun']?>" /></div></td><td colspan="" width="80%" style="font-size:10px; color:#000">Format : (2011-2012)</td>
		</tr>
		
        <tr><td colspan="10">&nbsp;</td></tr>
        
       
		<tr>
			<td colspan="10" align="right">
	 <div class="type-button">
<div class="submit">
<input type="hidden" name="id" value="<?php echo $_GET[id]?>">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=tahun_ajaran">Cancel</a>
</div>        
	</div>
			</td>
		</tr>
        
        <tr>
			<td colspan="10" align="right">*) Data Harus Di Isi Dengan Benar !
            </td>
		</tr>
        
	</table>
</form>
<?php }elseif($action=="ubah"){ ?>
<form action="prosestahun.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
<table class="bgform" align="right" width="100%">

       <tr><td colspan="10"><strong>Edit Tahun Ajaran</strong></td></tr>
      
      <tr><td colspan="10">&nbsp;</td></tr>
      
      <tr>
			<td width="34%">Tahun Ajaran</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="tahun" value="<?php echo $row_ek['tahun']?>" /></div></td><td colspan="" width="80%" style="font-size:10px; color:#000">Format : (2011-2012)</td>
		</tr>
		
        <tr><td colspan="10">&nbsp;</td></tr>
        
       
        
		<tr>
		<tr>
			<td colspan="10" align="right">
	 <div class="type-button">
<div class="submit"><input type="hidden" name="id" value="<?php echo $row_ek['id']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=tahun_ajaran">Cancel</a>
</div>        
	</div>
			</td>
		</tr>
        <tr>
			<td colspan="10" align="right">*) Data Harus Di Isi Dengan Benar !
            </td>
		</tr>
	</table>
</form>

<?php } ?>