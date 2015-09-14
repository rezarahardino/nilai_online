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
	$query_ek = "SELECT ketidakhadiran.*  
							 FROM ketidakhadiran 
							 	WHERE ketidakhadiran.id_ketidakhadiran = '" . $kid . "'";
							 
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
	<h2><img src="images/table_nilai_ketidakhadiran.png" alt=""/></h2>
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
      <td width="30%">Semester :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
       </td>
       <td><select name="semester">
       <option value="">- Pilih Semester -</option>
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
            </tr>
      
      <tr>      
      <td colspan="3" align="right"><input type="submit" name="cari" value="Cari"></td>
    </tr>
  </table>
    </form>   
  </td>
  </tr>
 <?php } ?>
 <?php 
 if(isset($_POST['cari'])){
	   //print_r($_GET['nis']);
	   $tam = mysql_query("SELECT tmatapelajaran.* from tmatapelajaran where Kode_Mp='$_POST[KodeMp]'")or die(mysql_error());
	   $row = mysql_fetch_array($tam);
	   $ada = mysql_num_rows($tam);
	  ?>
 <?php if($_SESSION[status]!="Siswa"){?>
       <tr> 
   <td class="search">
<table width="25" height="30" align="left"> 
        	
            <tr>
            	<td><strong>Semester&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?php echo $_POST['semester']?></strong></td>
                <td width="8">&nbsp;</td><td width="13">&nbsp;</td>
            </tr>
        </table>
   </td>
   
 </tr>
 <?php } ?>
 	<?php } ?>
   <tr>
   	  <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
   	  <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold">
      <?php if(!empty($_POST['cari'])){?>
      <a href="media.php?pages=ketidakhadiran&action=tambah&semester=<?php echo $_POST[semester]?>" class=""><strong>Input Nilai Ketidakhadiran</strong></a>
      <?php } ?>
      </td>
     <?php } ?>
      </tr>
   
   
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
      <td width="25%">Cari NIS :</td>
      
      <td width="18%"><input type="text" name="nis" value="<? echo $_POST[nis]; ?>"></td>
      <td colspan="3" width="80%" style="font-size:10px; color:#000"></td>
      </tr>
      <tr>
      <td colspan="6" align="right"><input type="submit" name="cari2" value="Cari" /></td>
    </tr>
      <tr><td width="9%" colspan="6"><a href="cetak_ketidakhadiran_pdf.php?nis=<?php echo $_POST[nis]?>&kelas=<?php echo $_POST[kelas]?>&tahun=<?php echo $_POST[tahun]?>&semester=<?php echo $_POST[semester]?>" target="_blank">Cetak PDF</a></td></tr>

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
    <th width="350" class="tabelsorot"><strong>NIS</strong></th>
    <?php } ?>
    <th width="350" class="tabelsorot"><strong>Kelas</strong></th>
    
	<th width="500" class="tabelsorot"><strong>Semester</strong></th>
    <th width="200" class="tabelsorot"><strong>Sakit</strong></th>
    <th width="200" class="tabelsorot"><strong>Ijin</strong></th>
    <th width="200" class="tabelsorot"><strong>Alpha</strong></th>
    <th width="300" class="tabelsorot"><strong>Keterangan</strong></th>

    <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
    <th width="150" class="tabelsorot" align="center"><strong>Actions</strong></th>
    <?php } ?>
</tr>
<?php 
			$query='';
		if($_SESSION[status]=="Siswa"){
	$query .= " AND ketidakhadiran.nis = '" . $_SESSION['nama_user'] . "' ";
	}
	if(!empty($_POST[kelas])){
		  $query.= " AND tkelas.Nama_Kelas = '" . $_POST[kelas] . "' ";
   }
   if(!empty($_POST[tahun])){
$query .= " AND ttahun_ajaran.tahun = '" . $_POST[tahun] . "' ";
}
if(!empty($_POST[nis])){
	$query .= " AND ketidakhadiran.nis = '" . $_POST[nis] . "' ";	
	}
	if(!empty($_POST[semester])){
	$query .= " AND ketidakhadiran.semester = '" . $_POST[semester] . "' ";								 
	}
	
	if(!empty($_SESSION[id_kelas])){
	$query .= " AND ketidakhadiran.id_kelas = '" . $_SESSION[id_kelas] . "' ";
}
		$tampil = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, ketidakhadiran.*  
							 FROM tsiswa 
							 	INNER JOIN ketidakhadiran ON ketidakhadiran.nis = tsiswa.nis
								INNER JOIN ttahun_ajaran ON ttahun_ajaran.id = tsiswa.tahun_ajaran
							 	INNER JOIN tkelas ON tkelas.ID_Kelas = ketidakhadiran.id_kelas
								where ketidakhadiran.id_ketidakhadiran <> ''
								". $query)or die(mysql_error());
		$cek = mysql_num_rows($tampil);
	
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
        <td class="tabelsorot" align="center"><?php echo $row_kategori['sakit'] ?></td>
        <td class="tabelsorot" align="center"><?php echo $row_kategori['ijin'] ?></td>
        <td class="tabelsorot" align="center"><?php echo $row_kategori['alpha'] ?></td>
        <td class="tabelsorot" align=""><?php echo $row_kategori['keterangan'] ?></td>
			
            <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
               
               <td class="tabelsorot" align="center">

			<a href="media.php?pages=ketidakhadiran&amp;action=ubah&amp;kid=<?php echo $row_kategori['id_ketidakhadiran'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="prosesketidakhadiran.php?mod=hapus&amp;kid=<?php echo $row_kategori['id_ketidakhadiran'];?>" title="Hapus Data" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');"><img src="images/tanda_delete.png" alt="" /></a></td>
            <?php } ?>
            		
	</tr>
	 <?php }  ?>
	</table>
	
	</form>
</td>
</tr>
</table>

<?php }elseif($action=="tambah"){ 
$nis = $_GET[nis];
$tam = mysql_query("SELECT tsiswa.* 
							 FROM tsiswa 
							 	WHERE tsiswa.id_kelas = '" . $_SESSION[id_kelas] . "'
							 
							 ")or die(mysql_error());
		//$rows = mysql_fetch_array($tam);					 
	    $jum = mysql_num_rows($tam);
?>
		<form action="prosesketidakhadiran.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('alpha[1]','','R','sakit[1]','','R','ijin[1]','','R');return document.MM_returnValue">
        <input type="hidden" name="jum" value="<?=$jum?>" />
<table class="bgform" align="right" width="100%">
        <tr><td colspan="7"><strong>Input Nilai Ketidakhadiran</strong></td></tr>
        
        <tr><td colspan="7">&nbsp;</td></tr>
       
        <tr><td colspan="7">Semester &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?=$_GET[semester]?></td></tr>
        
        <tr><td colspan="7">&nbsp;</td></tr>
          
        <tr class="tabelsorot">
        	<td width="50" class="tabelsorot" align="center">NIS</td>
            <td width="500" class="tabelsorot" align="center">Nama</td>
            <td width="100" class="tabelsorot" align="center">Sakit</td>
            <td width="100" class="tabelsorot" align="center">Ijin</td>
            <td width="100" class="tabelsorot" align="center">Alpha</td>
            <td width="250" class="tabelsorot" align="center">Keterangan</td>
        </tr>
		   
      <?php 
		$i=1;
		while($row = mysql_fetch_array($tam)){?>
        <tr>
		<td class="" align="center"><?=$row[nis]?>
        <input type="hidden" size="5" name="nis[<?=$i?>]" value="<?=$row[nis]?>" />
        </td>
        <td class="" align="center"><?=$row[Nama]?></td>
        
        <td align="center"><div class="input text">
        <input type="text" name="sakit[<?=$i?>]" maxlength="2" size="1" value="0" />
         </td>
		<td align="center"> 
        	<input type="text" name="ijin[<?=$i?>]" maxlength="2" size="1" value="0" />
         </td>   
         <td align="center"> 
        	<input type="text" name="alpha[<?=$i?>]" maxlength="2" size="1" value="0" />
         </td>
         <td align="center"> 
        	<input type="text" name="keterangan[<?=$i?>]" size="25"  />
         </td>
        </tr>
        
          <?php $i++; } ?> 
          
          <tr><td colspan="7">&nbsp;</td></tr>
       <tr>
		<td width="20%" class="" align="">Tahun Ajaran</td>
        
		<td class="" align="" colspan="7">&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
		    <select name="tahun">
		        <option value="">- Pilih Tahun Ajaran -</option>
		        <?php 
					$sql = mysql_query("SELECT * FROM ttahun_ajaran ORDER BY id")or die(mysql_error());
					while($kelas = mysql_fetch_array($sql)){
				?>
		        <option value="<?php echo $kelas['id']?>"><?php echo $kelas['tahun']?></option>
		        <?php } ?>
          </select>
		</td>    
    </tr>
        <tr><td colspan="7">&nbsp;</td></tr>
       
		<tr>
			<td colspan="7" align="right">
	 <div class="type-button">
<div class="submit">
<input type="hidden" name="semester" value="<?php echo $_GET[semester]?>">
<input type="hidden" name="kodemp" value="<?php echo $_GET[kodemp]?>">
<input type="hidden" name="id_kelas" value="<?php echo $rows[id_kelas]?>">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=ketidakhadiran">Cancel</a>
</div>        
	</div>
			</td>
		</tr>
         <tr>
			<td colspan="7" align="right">*) Data Harus Di Isi Dengan Benar !
            </td>
		</tr>
	</table>
</form>
<?php }elseif($action=="ubah"){ ?>
<form action="prosesketidakhadiran.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		<table class="bgform" align="right" width="90%">
        
      <tr><td colspan="3"><strong>Edit Nilai Ketidakhadiran</strong></td></tr>
      
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
			<td>Sakit</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="sakit" size="5" value="<?php echo $row_ek['sakit']?>" />
            </div></td>
		</tr>
		
        <tr>
			<td>Ijin</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="ijin" size="5" value="<?php echo $row_ek['ijin']?>" />
            </div></td>
		</tr>
		
		        <tr>
			<td>Alpha</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="alpha" size="5" value="<?php echo $row_ek['alpha']?>" />
            </div></td>
		</tr>
        
          <tr>
			<td>Keterangan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="keterangan" size="25" value="<?php echo $row_ek['keterangan']?>" />
            </div></td>
		</tr>
        
       <tr><td colspan="3">&nbsp;</td></tr>
       
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit"><input type="hidden" name="id_ketidakhadiran" value="<?php echo $row_ek['id_ketidakhadiran']?>" />
<input type="hidden" name="nis" value="<?php echo $row_ek['nis']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=ketidakhadiran">Cancel</a>
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