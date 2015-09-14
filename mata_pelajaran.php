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
	if(!empty($_POST['cari'])){
		$query = "WHERE id_tahun_ajaran ='" . $_POST['tahun']. "'";
		}
	$query_kategori = "SELECT tmatapelajaran.*, tguru.Nama_Guru FROM tmatapelajaran  
	INNER JOIN tguru ON tguru.NIP =  tmatapelajaran.id_guru ". $query . "
	ORDER BY tmatapelajaran.Kode_Mp";
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

	$kid = $_GET['Kode_MP'];
	$query_ek = "SELECT tmatapelajaran.* FROM tmatapelajaran 
						WHERE tmatapelajaran.Kode_Mp = '$kid'";
						
	$ek = mysql_query($query_ek) or die(mysql_error());
	$row_ek = mysql_fetch_assoc($ek);
//	print_r($row_ek);
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
	<h2><img src="images/table_mata_pelajaran.png" alt=""/></h2>
	<?php 
$action = $_GET['action'];
if(empty($action)){?>
<table width="1007" cellpadding="0" cellspacing="0">
<?php if(($_SESSION[status]!="Siswa")&&($_SESSION[status]!="Guru")){?>
<tr>
    
    <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold"><a href="media.php?pages=mata_pelajaran&amp;action=tambah" class="">Input Mata Pelajaran</a></td></tr>
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
    <td class="search">
       <form action="" method="post">
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
    
    </td>
	    </tr>-->
    
  <tr>
    <td class="bgform">
    
    <form>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    
<tr class="tabelsorot">
	<th width="50" class="tabelsorot"><strong>No</strong></th>
	<th width="200" class="tabelsorot"><strong>Kode MaPel</strong></th>
	<th width="300" class="tabelsorot"><strong>Nama Mata Pelajaran</strong></th>
    <th width="300" class="tabelsorot"><strong>Guru / Pengajar</strong></th> 
    <th width="300" class="tabelsorot"><strong>KKM</strong></th>
    <?php if(($_SESSION[status]!="Siswa")&&($_SESSION[status]!="Guru")){?>
	<th width="86" class="tabelsorot" align="center"><strong>Actions</strong></th>
    <?php } ?>
</tr>
 <?php $no = 1 ; 
 		do { ?>
	<tr class="tabelsorot">
		<td class="tabelsorot" align="center"><?php echo $no++?></td>
		<td class="tabelsorot"><?php echo $row_kategori['Kode_Mp']?></td>
		<td class="tabelsorot" align="left"><?php echo $row_kategori['Nama_MP'] ?></td>
     	<td class="tabelsorot"><?php echo $row_kategori['Nama_Guru']?></td>
		<td class="tabelsorot" align="center"><?php echo $row_kategori['kkm']?></td>
        <?php if(($_SESSION[status]!="Siswa")&&($_SESSION[status]!="Guru")){?>
		
   <td class="tabelsorot" align="center">
			<a href="media.php?pages=mata_pelajaran&amp;action=view&amp;Kode_MP=<?php echo $row_kategori['Kode_Mp'];?>" title="Lihat Data Lengkap"><img src="image/tanda_view.png" alt="" /></a>
			<a href="media.php?pages=mata_pelajaran&amp;action=ubah&amp;Kode_MP=<?php echo $row_kategori['Kode_Mp'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="prosesmatapelajaran.php?mod=hapus&amp;kid=<?php echo $row_kategori['Kode_Mp'];?>" title="Hapus Data" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');"title="Hapus Data"><img src="images/tanda_delete.png" alt="" /></a></td>
            
        	
         <?php } ?>
            
	</tr>
    
	 <?php } while ($row_kategori = mysql_fetch_assoc($kategori)); ?>
	</table>
	</form>
	
</td>
</tr>
</table>

<?php }elseif($action=="tambah"){ ?>
		<form action="prosesmatapelajaran.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('Kode_Mp','','R','Nama_MP','','R','id_guru','','R',);return document.MM_returnValue">
		<table class="bgform">
		
        <tr>
			<td class="bgform" colspan="3"><strong>Input Mata Pelajaran</strong></td>
		</tr>
		
        <tr><td colspan="3">&nbsp;</td></tr>
        
		<tr>
			<td>Kode MaPel </td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="kode" /></div></td>
		</tr>
		<tr>
			<td>Nama Mata Pelajaran</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="nama" /></div></td>
		</tr>
       
		<tr>
		<td class="" align="">Guru / Pengajar</td>
        <td>:</td>
		<td class="" align=""><div class="input text">
		    <select name="id_guru">
		        <option value="">- Pilih Guru / Pengajar -</option>
		        <?php 
					//$sql = mysql_query("SELECT * FROM tguru where NIP not in (select tmatapelajaran.id_guru from tmatapelajaran) ORDER BY NIP")or die(mysql_error());
					$sql = mysql_query("SELECT * FROM tguru ORDER BY NIP")or die(mysql_error());
					while($kelas = mysql_fetch_array($sql)){
				?>
		        <option value="<?php echo $kelas['NIP']?>"><?php echo $kelas['Nama_Guru']?></option>
		        <?php } ?>
		        </select>
		</div></td>    
    </tr>
	<tr>
			<td>Nilai KKM</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="kkm" /></div></td>
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
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=mata_pelajaran">Cancel</a>
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
<form action="prosesmatapelajaran.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		<table class="bgform">
        
        <tr><td colspan="3"><strong>Edit Mata Pelajaran</strong></td></tr>
		
        <tr>
			<td width="166">&nbsp;</td>
			<td width="35">&nbsp;</td>
			<td width="353">
			<input type="hidden" name="kode" value="<?php echo $row_ek['Kode_Mp']?>" />
			</td>
		</tr>
        <tr>
			<td>Nama Mata Pelajaran</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="nama" value="<?php echo $row_ek['Nama_MP']?>" /></div></td>
		</tr>
        
		<tr>
		<td class="" align="">Guru / Pengajar</td>
        <td>:</td>
		<td class="" align=""><div class="input text">
		    <select name="id_guru">
		        <option value="">- Pilih Guru / Pengajar - </option>
		        <?php 
					$sql = mysql_query("SELECT * FROM tguru ORDER BY NIP")or die(mysql_error());
					while($kelas = mysql_fetch_array($sql)){
						if($row_ek['id_guru']==$kelas['NIP']){
				?>
		        <option value="<?php echo $kelas['NIP']?>" selected="<?php echo $row_ek['id_guru']?>"><?php echo $kelas['Nama_Guru']?></option>
		        <?php }else{ ?>
                <option value="<?php echo $kelas['NIP']?>"><?php echo $kelas['Nama_Guru']?></option>
                <?php } 
					}
				?>
		        </select>
		</div></td>    
    </tr>
	 <tr>
			<td>Nilai KKM</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="kkm" value="<?php echo $row_ek['kkm']?>" /></div></td>
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
<div class="submit"><input type="hidden" name="kode" value="<?php echo $row_ek['Kode_Mp']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=mata_pelajaran">Cancel</a>
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