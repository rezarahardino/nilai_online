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
			if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
		  } else if (test!='R') { num = parseFloat(val);
			if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
			if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
			  min=test.substring(8,p); max=test.substring(p+1);
			  if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
		} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' harus diisi.\n'; }
	  } if (errors) alert('Warning..!\n'+errors);
	  document.MM_returnValue = (errors == '');
	}
//-->
</script>
<link href="css/load-styles.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="tool/dhtmlgoodies_calendar.css" media="screen"></LINK>
<SCRIPT type="text/javascript" src="tool/dhtmlgoodies_calendar.js"></script>
	<h2>GANTI PASSWORD</h2>
		<form action="proses_ganti_password.php" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('NIP','','R','nama','','R','tempat_lahir','','R','tgl1', '', 'R', 'alamat','','R', 'kode_pos', '', 'R', 'kota', '','R', 'telepon', '', 'R', 'email', '' ,'RisEmail');return document.MM_returnValue">
		<table class="bgform">
        <tr>
			<td class="bgform" colspan="3"><strong>Input Password</strong></td>
		</tr>
         <tr><td colspan="3">&nbsp;</td></tr>
      	<tr>
			<td>Password Lama</td>
			<td>:</td>
			<td><div class="input text"><input type="password" name="password_lama" /></div></td>
		</tr>
        		<tr>
			<td>Password Baru</td>
			<td>:</td>
			<td><div class="input text"><input type="password" name="password_baru" /></div></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
		
		<?php 
		if($_GET[pesan]=="kosong"){?>
        <tr>
        	<td colspan="3" align="center">Password Anda Tidak Sesuai !</td>
        </tr>
        <?php } ?>
        
        		
		<?php 
		if($_GET[pesan]=="berhasil"){?>
        <tr>
        	<td colspan="3" align="center">Anda Berhasil Merubah Password</td>
        </tr>
        <?php } ?>
        <tr><td colspan="3">&nbsp;</td></tr>
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Anda Yakin Untuk Merubah Password');"> <a href="media.php?pages=home">Cancel</a>
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
