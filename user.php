<?php 
session_start() ?>
<?php include "config/koneksi.php"; ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

	function GetSQLValueString($row_kategoriheValue, $row_kategorihestatus, $row_kategoriheDefinedValue = "", $row_kategoriheNotDefinedValue = "") 
	{
	  $row_kategoriheValue = (!get_magic_quotes_gpc()) ? addslashes($row_kategoriheValue) : $row_kategoriheValue;
	
		  switch ($row_kategorihestatus) {
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
	$insertSQL = sprintf("INSERT INTO t_user (nama_user, kata_kunci, status) VALUES (%s,%s,%s)",
						   GetSQLValueString($HTTP_POST_VARS['nama_user'], "text"),
						   GetSQLValueString(md5($HTTP_POST_VARS['kata_kunci']), "text"),
						   GetSQLValueString($HTTP_POST_VARS['status'], "text")
						   );
		//mysql_select_db($namadb,$sambung);
		echo $insertSQL;
		$Result1 = mysql_query($insertSQL) or die(mysql_error());
		if($Result1){echo"<script>location='media.php?pages=user'</script>";}
		}
	

	if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form2")) {
	$tanggal = date('d-m-Y');
				$updateSQL = sprintf("UPDATE t_user SET nama_pegawai=%s,nama_user=%s,password=%s, alamat_pegawai=%s, telepon=%s, 
										email=%s, level=%s WHERE nik=%s",
						   GetSQLValueString($HTTP_POST_VARS['nama'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['nama_user'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['password'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['alamat_pegawai'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['telepon'], "text"),						   
						   GetSQLValueString($HTTP_POST_VARS['email'], "text"),
						   GetSQLValueString($HTTP_POST_VARS['level'], "text"),
						    GetSQLValueString($HTTP_POST_VARS['nik'], "text")
						   );
			
			//mysql_select_db($namadb,$sambung);
			//echo $updateSQL;
			$Result1 = mysql_query($updateSQL) or die(mysql_error());
			if($Result1){echo"<script>location='media.php?mod=admin'</script>";}
		}
	

	$maxRows_kategori = 20;
	$pageNum_kategori = 0;
	if (isset($HTTP_GET_VARS['pageNum_kategori'])) {
	  $pageNum_kategori = $HTTP_GET_VARS['pageNum_kategori'];
	}
	$startRow_kategori = $pageNum_kategori * $maxRows_kategori;
	$q="";
	if(!empty($_POST[username])){
		$q.=" where nama_user LIKE '%". $_POST[username]."%' ";
		}
	$query_kategori = "SELECT * FROM t_user" .$q." ORDER BY nama_user";
	//var_dump("SELECT * FROM t_user" .$q." ORDER BY nama_user");
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

	$kid = $_GET['id'];
	$query_ek = "SELECT * FROM t_user 
						WHERE id = '$kid'";
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
<script language="JavaScript" status="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<script language="JavaScript" status="text/JavaScript">
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
		} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' Harus Diisi\n'; }
	  } if (errors) alert('Warning...!\n'+errors);
	  document.MM_returnValue = (errors == '');
	}
//-->
</script>
<style>
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 1px; }			
.style1 {color: #000000}
</style>
	<h2><img src="images/table_user.png" alt=""/></h2>
	<?php 
$action = $_GET['action'];
if(empty($action)){?>
	<table width="1007" cellpadding="0" cellspacing="0">
	  <tr>
	    <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold"><a href="media.php?pages=user&action=tambah" class="">Input User</a></td>
      </tr>
	  <tr>
	    <td colspan="3" class="viewer"><div align="right"> <font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> <a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, 0, $queryString_kategori); ?>"title="Urutan Pertama"><img src="images/tanda_first.png" alt="" /></a></strong>
        </font>
        <font color="#FFFFFF">
        <strong>
        <font size="1" face="Verdana, Arial, Helvetica, sans-serif">  <a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, max(0, $pageNum_kategori - 1), $queryString_kategori); ?>"title="Urutan Sebelumnya"><img src="images/tanda_previous.png" alt="" /></a> 
        
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
      <td width="17%">Cari Username :</td>
      <td width="20%"><input type="text" name="username" value="<? echo $_POST[username]; ?>"></td>
      <td width="45%"><input type="submit" name="cari" value="Cari"></td>
      </tr>
     
  </table>
  </form> 
  </td>
  </tr>
         
	 <tr>
	    <td class="bgform"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr class="tabelsorot">
	        <th class="tabelsorot" width="80"><strong>No</strong></th>
	        <th class="tabelsorot" width="364"><strong>Username</strong></th>
            <th class="tabelsorot" width="364"><strong>Password</strong></th>
	        <th class="tabelsorot" width="285"><strong>Status</strong></th>
	        <th class="tabelsorot" width="86" class="tabelheader" align="center"><strong>Actions</strong></th>
          </tr>
	      <?php $no = 1 ; 
 		do { ?>
	      <tr class="tabelsorot">
	        <td class="tabelsorot" align="center"><?php echo $no++?></td>
	        <td class="tabelsorot"><?php echo $row_kategori['nama_user']?></td>
            <td class="tabelsorot"><?php echo $row_kategori['kata_kunci']?></td>
	        <td class="tabelsorot" align="center"><?php echo $row_kategori['status'] ?></td>
	        <td class="tabelsorot" align="center">
            
	          <a href="media.php?pages=user&action=ubah&id=<?php echo $row_kategori['id'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a> <a href="prosesuser.php?mod=hapus&kid=<?php echo $row_kategori['id'];?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data');" title="Hapus Data"><img src="images/tanda_delete.png" alt="" /></a></th>
          </tr>
	      <?php } while ($row_kategori = mysql_fetch_assoc($kategori)); ?>
	      </table></td>
      </tr>
</table>
<form>
</form>
<?php }elseif($action=="tambah"){ ?>
<form method="post" action=<?php $_SERVER['PHP_SELF'];?>>
	<table class="bgform">
		<tr>
			<td class="bgform" colspan="3"><strong>Input User</strong></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
		<tr>
			<td width="29%">Pilih Type</td>
			<td width="6%">:</td>
            <td><div class="input text">
				<select name="group">
                <option value="">- Pilih Type -</option>
					<option value="Admin">Admin</option>
					<option value="Siswa">Siswa</option>
					<option value="Guru">Guru</option>
                   </select></div></td>
		</tr>
        <tr><td colspan="3">&nbsp;</td></tr>
		<tr>
			<td colspan="0" align="right">
	 <div class="status-button">
<div class="submit">
<input value="Submit" type="submit" name="submit"> <a href="media.php?pages=user"  class="links">Cancel</a>
</div>        
	</div>
			</td>
		</tr>
</table> 
</form>
<?php 
		$group = $_POST['group'];
		if(!empty($group)){?>
		<form action="prosesuser.php?mod=tambah" method="post" name="form1" id="form1" encstatus="multipart/form-data"  onSubmit="MM_validateForm('nama_user','','R','password','','R');return document.MM_returnValue">
		<table class="bgform">
		<tr>
			<td width="29%">Username</td>
			<td width="6%">:</td>
			<td>
			<div class="input text">
			<?php if($group=="Admin"){?>
				<input status="text" name="nama_user" />
			<?php }elseif($group=="Siswa"){?>
				<select name="nama_user">
				<option value="">- Pilih Siswa -</option>
					<?php 
						$sql = mysql_query("SELECT * FROM tsiswa where nis not in(select nama_user from t_user) order by nis")or die(mysql_error());
						while($data_mhs = mysql_fetch_array($sql)){
					?>
				<option value="<?php echo $data_mhs['nis']?>"><?php echo $data_mhs['nis']?></option>		
					<?php } ?>
				</select>
			<?php }elseif($group=="Guru"){?>
				<select name="nama_user">
				<option value="">- Pilih Guru -</option>
					<?php 
						$sql = mysql_query("SELECT * FROM tguru where NIP not in(select nama_user from t_user) order by NIP")or die(mysql_error());
						while($data_mhs = mysql_fetch_array($sql)){
					?>
				<option value="<?php echo $data_mhs['NIP']?>"><?php echo $data_mhs['NIP']?></option>		
					<?php } ?>
				</select>
             
		
			<?php } ?>
			</div>
			</td>
		</tr>
		<tr>
			<td width="29%">Password</td>
			<td width="6%">:</td>
			<td><div class="input text"><input type="password" name="password" /></div></td>
		</tr>

		<tr>
			<td width="29%">Status</td>
			<td width="6%">:</td>
			<td><div class="input text"><?php echo $_POST['group']?></div>
			 </td>
		</tr>
        <tr><td colspan="3">&nbsp;</td></tr>
		<tr>
			<td colspan="3" align="right">
	 <div class="status-button">
<div class="submit">
<input type="hidden" name="type" value="<?php echo $_POST['group']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=user" class="links">Cancel</a>
</div>        
	</div>
			</td>
		</tr>
         <tr>
			<td colspan="3" align="right">*) Data Harus Di Isi Dengan Benar !
            </td>
		</tr>
        
		<?php } ?>
	</table>
</form>
<?php }elseif($action=="ubah"){ ?>
<form action="prosesuser.php?mod=ubah" method="post" name="form1" id="form1" encstatus="multipart/form-data"  onSubmit="MM_validateForm('password','','R');return document.MM_returnValue">
		<table class="bgform">
        <tr><td colspan="3"><strong>Edit User</strong></td></tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><div class="input text"><input status="password" name="password" value="<?php echo $row_ek['kata_kunci']?>" /></div></td>
		</tr>
<tr>

	<tr><td colspan="3">&nbsp;</td></tr>
	
    		<td colspan="3" align="right">
	 <div class="status-button">
<div class="submit">
<input type="hidden" name="id" value="<?php echo $row_ek['id']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=user"  class="links">Cancel</a>
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