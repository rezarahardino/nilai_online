<?php 
session_start() ?>
<?php include "config/koneksi.php"; 
 ?>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,emotions,|,ltr,rtl,|,fullscreen",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		//theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<?php

	$maxRows_kategori = 20;
	$pageNum_kategori = 0;
	if (isset($HTTP_GET_VARS['pageNum_kategori'])) {
	  $pageNum_kategori = $HTTP_GET_VARS['pageNum_kategori'];
	}
	

	$startRow_kategori = $pageNum_kategori * $maxRows_kategori;
	$query_kategori = "SELECT tinformasi.*, tguru.Nama_Guru FROM tinformasi 
				INNER JOIN tguru ON tguru.NIP = tinformasi.oleh ".$queryx."
							 	ORDER BY tinformasi.id";						
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
	$query_ek = "SELECT tinformasi.* FROM tinformasi 
							 	WHERE tinformasi.id = '" . $kid . "'";
							 
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
	<h2><img src="images/table_informasi.png" alt=""/></h2>
	<?php 
	$action = $_GET['action'];
	if(empty($action)){?>
		<table width="900" cellpadding="0" cellspacing="0">
<?php //if($_SESSION[gilang_status]!="SISWA"){?>
<!--<tr>
    <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold"><a href="index__.php?pages=siswa&amp;action=tambah" class="">Data Baru</a> | <a href="index__.php?pages=siswa&amp;action=lihat" class="link_tambah">Kembali</a>  </tr>-->
   <?php //} ?>
   <!--<tr> 
		<td colspan="3" class="viewer"> 
			<div align="right">
				<font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
					<a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, 0, $queryString_kategori); ?>">First</a></strong>
				</font>
				<font color="#FFFFFF">
					<strong>
						<font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
							| <a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, max(0, $pageNum_kategori - 1), $queryString_kategori); ?>">
							Previous</a> 
							|<a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, min($row_kategoriotalPages_kategori, $pageNum_kategori + 1),
							$queryString_kategori); ?>">Next</a> 
							| <a href="<?php printf("%s?pageNum_kategori=%d%s", $currentPage, $row_kategoriotalPages_kategori, $queryString_kategori); ?>">Last</a>
						</font>
					</strong>
				</font>
			</div>
		</td>
  </tr>-->
   <?php if($_SESSION[status]!="Siswa"){?>
   <tr>
   	  <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold">
      <a href="media.php?pages=informasi&action=tambah" class="">Input Informasi</a>
      </td>
   </tr><?php } ?>
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
	<th width="30" class="tabelsorot"><strong>No</strong></th>
    <th width="120" class="tabelsorot"><strong>Judul</strong></th>
	<th width="200" class="tabelsorot"><strong>Informasi</strong></th>
	<th width="120" class="tabelsorot"><strong>Oleh</strong></th>
    <th width="100" class="tabelsorot"><strong>Created</strong></th>
    <th width="80" class="tabelsorot" align="center"><strong>Actions</strong></th>
  
</tr>
<?php 

		$tampil = mysql_query("SELECT id,judul,substr(isi,1,70) as isi,created, oleh  
							 FROM tinformasi ORDER BY id DESC")or die(mysql_error());
		$cek = mysql_num_rows($tampil);
	   
	  
	?>	
 <?php $no = 1 ; ?>
 <?php if($cek<=0):?>
 <!--tr><td colspan="4" align="center" class="title">Belum Ada Data Informasi</td></tr>-->
 <?php else:?>
 		<?php while ($row_kategori = mysql_fetch_assoc($tampil)){ 
		if($row_kategori['oleh']=="admin"){
			$oleh = "Admin";
			}else{
				$s = mysql_query("SELECT * FROM tguru WHERE NIP='".$row_kategori['oleh']."'");
				$r = mysql_fetch_array($s);
					$oleh = $r['Nama_Guru'];
				}
		?>

	<tr class="tabelsorot">
		<td class="tabelsorot" align="center"><?php echo $no++?></td>
        <td class="tabelsorot"><?php echo $row_kategori['judul']?></td>
		<td class="tabelsorot"><?php echo $row_kategori['isi']?></td>
		<td class="tabelsorot"><?php echo $oleh ?></td>
        <td class="tabelsorot" align="center"><?php echo $row_kategori['created'] ?></td>
        <td align="center" class="tabelsorot">
			
            <?php if($_SESSION[status]=="Siswa"){?>
           
            <a href="media.php?pages=informasi&amp;action=view&amp;kid=<?php echo $row_kategori['id'];?>" title="Lihat Data Lengkap"><img src="images/tanda_view.png" alt="" /></a>
           

            <?php }elseif($_SESSION[nama_user] == $row_kategori['oleh']){?>
            <a href="media.php?pages=informasi&amp;action=ubah&amp;kid=<?php echo $row_kategori['id'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="prosesinformasi.php?mod=hapus&amp;kid=<?php echo $row_kategori['id'];?>" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');" title="Hapus Data"><img src="images/tanda_delete.png" alt="" /></a>
            <?php }?>
            <a href="media.php?pages=informasi&amp;action=view&amp;kid=<?php echo $row_kategori['id'];?>" title="Lihat Data Lengkap"><img src="images/tanda_view.png" alt="" /></a>
         
            		</td>
	</tr>

	 <?php }  endif;?>
	</table>
	
	</form>
</td>
</tr>
</table>

<?php }elseif($action=="tambah"){ 
?>
		<form action="prosesinformasi.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('','','R');return document.MM_returnValue">
<table class="bgform" align="right" width="100%">
        <tr>
			<td class="bgform" colspan="3"><strong>Input Informasi</strong></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
			<td>Judul</td>
			<td>:</td>
			<td width="20%"><div class="input text"><input type="text" name="judul" />
            </div></td>
		</tr>

        <tr>
			<td>Informasi</td>
			<td>:</td>
			<td><div class="input text"><textarea name="isi" cols="50" rows="15"></textarea>
            </div></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
       
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=informasi">Cancel</a>
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
<form action="prosesinformasi.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('isi','','R', 'judul','','R');return document.MM_returnValue">
	<table class="bgform"  align="left" width="100%">
      <tr>
			<td class="bgform" colspan="3"><strong>Edit Informasi</strong></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
			<td>Judul</td>
			<td width="1%">:</td>
			<td width="68%"><div class="input text">
            <input type="text" name="judul" value="<?php echo $row_ek['judul']?>" />
            </div></td>
		</tr>
		<tr>
			<td>Informasi</td>
			<td>:</td>
			<td><div class="input text">
            <textarea name="isi" cols="50" rows="15"><?php echo $row_ek['isi']?></textarea>
            </div></td>
		</tr>
       
        <tr><td colspan="3">&nbsp;</td></tr>
        
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit"><input type="hidden" name="id" value="<?php echo $row_ek['id']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=informasi">Cancel</a>
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
<form action="prosesinformasi.php?mod=tambah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('isi','','R');return document.MM_returnValue">
		<table class="bgform" align="right" width="100%">
       <tr>
			<td class="bgform" colspan="3"><strong>Lihat Informasi</strong></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
			<td>Oleh</td>
			<td>:</td>
			<td><?php 
			$sql = mysql_fetch_array(mysql_query("SELECT Nama From tsiswa WHERE nis='$row_ek[oleh]'"));  
			$nama = $sql['Nama'];
			
			$sql2 = mysql_fetch_array(mysql_query("SELECT Nama_Guru From tguru WHERE NIP='$row_ek[oleh]'"));
			$oleh_guru = $sql2['Nama_Guru'];
				  
			  if(empty($nama) && empty($oleh_guru)){
				  $oleh="Admin";
			  }else{
					$oleh = $nama;
					$oleh2 = $oleh_guru;
				  }
			echo $oleh;
			echo $oleh_guru;
			?>
            </td>
		</tr>
        
        <tr>
			<td>Created</td>
			<td>:</td>
			<td>
            <?php echo $row_ek['created']?>
            </td>
		</tr>
        <tr>
			<td>Judul</td>
			<td>:</td>
			<td>
            <?php echo $row_ek['judul']?>
            </td>
		</tr>
        
         <tr>
			<td>Informasi</td>
			<td>:</td>
			<td>
            <?php echo $row_ek['isi']?>
            </td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<a href="media.php?pages=informasi"><strong>Kembali</strong></a>
</div>        
	</div>
			</td>
		</tr>
	</table>
</form>
<?php } ?>