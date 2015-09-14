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
	$query_ek = "SELECT tkomentar.* FROM tkomentar 
							 	WHERE tkomentar.id = '" . $kid . "'";
							 
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
			if (p<1 || p==(val.length-1)) errors+='- '+nm+' Valid.\n';
		  } else if (test!='R') { num = parseFloat(val);
			if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
			if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
			  min=test.substring(8,p); max=test.substring(p+1);
			  if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
		} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' Harus Diisi.\n'; }
	  } if (errors) alert('Warning..!\n'+errors);
	  document.MM_returnValue = (errors == '');
	}
//-->
</script>
<link href="css/load-styles.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="tool/dhtmlgoodies_calendar.css" media="screen"></LINK>
<SCRIPT type="text/javascript" src="tool/dhtmlgoodies_calendar.js"></script>
	<h2><img src="images/table_kontak_kami.png" alt=""/></h2>
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

       <tr> 
   <td class="search">&nbsp;
   <form action="" method="post">
   <table>
    <tr> 
      <td width="20%">Cari Nama :</td>
      
      <td width="30%"><input type="text" name="nama" value="<? echo $_POST[nama]; ?>"></td>
      <td colspan="3" width="80%" style="font-size:10px; color:#000"><input type="submit" name="submit" value="Cari"></td>
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
	<th width="100" class="tabelsorot"><strong>No</strong></th>
	<th width="450" class="tabelsorot"><strong>Nama</strong></th>
	<th width="450" class="tabelsorot"><strong>Email</strong></th>
    <th width="600" class="tabelsorot"><strong>Komentar</strong></th>
    <th width="300" class="tabelsorot"><strong>Created</strong></th>
    <th width="200" class="tabelsorot" align="center"><strong>Actions</strong></th>
</tr>
<?php 

if(isset($_POST[nama])){
$query = "where nama like'%" . $_POST[nama] . "%'";
}
		$tampil = mysql_query("SELECT id,nama,substr(isi,1,70) as komentar,email, created  
							 FROM tkomentar " . $query ." ORDER BY id DESC")or die(mysql_error());
		$cek = mysql_num_rows($tampil);
	   
	  
	?>	
 <?php $no = 1 ; ?>
 <?php if($cek<=0):?>

 <?php else:?>
 		<?php while ($row_kategori = mysql_fetch_assoc($tampil)){ ?>

	<tr class="tabelsorot">
		<td class="tabelsorot" align="center"><?php echo $no++?></td>
		<td class="tabelsorot" align="left"><?php echo $row_kategori['nama']?></td>
		<td class="tabelsorot" align="left"><?php echo $row_kategori['email'] ?></td>
        <td class="tabelsorot" align="left"><?php echo $row_kategori['komentar'] ?></td>
        <td class="tabelsorot" align="center"><?php echo $row_kategori['created'] ?></td>
      
    <td class="tabelsorot" align="center">
			
			<a href="media.php?pages=view_kontak&amp;action=view&amp;kid=<?php echo $row_kategori['id'];?>" title="Lihat Data Lengkap"><img src="images/tanda_view.png" alt="" /></a>
            <a href="proseskomentarview.php?mod=hapus&amp;kid=<?php echo $row_kategori['id'];?>" title="Hapus Data" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');" title="Hapus Data"><img src="images/tanda_delete.png" alt="" /></a>
            		</td>
	</tr>
	 <?php }  endif;?>
	</table>
	
	</form>
</td>
</tr>
</table>

<?php }elseif($action=="view"){ ?>
<form action="#" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('isi','','R');return document.MM_returnValue">
		<table class="bgform" align="right" width="100%">
       <tr>
			<td class="bgform" colspan="3"><strong>Lihat Kontak Kami</strong></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
			<td>Nama</td>
			<td>:</td>
			<td><?php echo $row_ek['nama']?>
            </td>
		</tr>
        
        <tr>
			<td>Email</td>
			<td>:</td>
			<td>
            <?php echo $row_ek['email']?>
            </td>
		</tr>
        <tr>
			<td>Komentar</td>
			<td>:</td>
			<td>
            <?php echo $row_ek['isi']?>
            </td>
		</tr>
        
         <tr>
			<td>Created</td>
			<td>:</td>
			<td>
            <?php echo $row_ek['created']?>
            </td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<a href="media.php?pages=view_kontak"><strong>Kembali</strong></a>
</div>        
	</div>
			</td>
		</tr>
	</table>
</form>
<?php } ?>