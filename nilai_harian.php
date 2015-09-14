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
	$query_ek = "SELECT nilai_harian.*, nilai_harian.Kode_Mp, tmatapelajaran.Nama_MP  
							 FROM nilai_harian
							 	INNER JOIN tmatapelajaran ON tmatapelajaran.Kode_Mp = nilai_harian.Kode_Mp
								WHERE nilai_harian.id_nilai_harian = '" . $kid . "'";
							 
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
	<h2><img src="images/table_nilai_harian.png" alt=""/></h2>
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
      <td width="20%">Nama Mata Pelajaran :</td>
      
      <td width="90%"><select name="KodeMp">
				<option value="">- Pilih Nama Mata Pelajaran -</option>
                <?php 
					$sql = mysql_query("SELECT DISTINCT(tmatapelajaran.Nama_MP),tmatapelajaran.Kode_Mp, tguru.Nama_Guru  FROM tjadwalpelajaran 
						
						INNER JOIN tkelas ON tkelas.ID_Kelas = tjadwalpelajaran.ID_Kelas
						INNER JOIN tmatapelajaran ON tmatapelajaran.Kode_Mp = tjadwalpelajaran.Kode_Mp
						INNER JOIN tguru ON tguru.NIP = tmatapelajaran.id_guru where tjadwalpelajaran.ID_Kelas='$_SESSION[id_kelas]' ORDER BY tmatapelajaran.Kode_Mp")or die(mysql_error());
					while($guru = mysql_fetch_array($sql)){
				?>
				<option value="<?php echo $guru['Kode_Mp']?>"><?php echo $guru['Nama_MP']. " (". $guru['Nama_Guru']?>)</option>
                <?php } ?>
			</select></td>
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
            	<td width="18"><strong>Nama Mata Pelajaran &nbsp;:&nbsp;</strong>
				<strong>&nbsp;<?php echo $row['Nama_MP'];?></strong></td>
                <td width="8">&nbsp;</td><td width="13">&nbsp;</td>
            </tr>
            
            <tr>
            	<td><strong>Semester&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; <?php echo $_POST['semester']?></strong></td>
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
      <?php if(isset($_POST['cari'])){?>
      <a href="media.php?pages=nilai_harian&action=tambah&kodemp=<?php echo $_POST['KodeMp']?>&semester=<?php echo $_POST[semester]?>" class=""><strong>Input Nilai Harian</strong></a>
     
      <?php } ?>
      </td>
      <?php } ?>
      </tr>
      <tr>
  <td class="search">
  	 <form action="" method="post">
    	<table width="68%">
   
    
     
      <tr> 
      <td width="25%">Cari Kelas :</td>
      
      <td colspan="4" width="26%"><input type="text" name="kelas" value="<? echo $_POST[kelas]; ?>"></td>
      </tr>
      <tr> 
      <td width="25%">Cari Tahun Ajaran :</td>
      
      <td width="18%"><input type="text" name="tahun" value="<? echo $_POST[tahun]; ?>"></td>
      <td colspan="3" width="80%" style="font-size:10px; color:#000">Format : (2011-2012)</td>
      </tr>
      <tr> 
      <td width="34%">Cari Semester :</td>
      
      <td colspan="6" width="26%"><input type="text" name="semester" value="<? echo $_POST[semester]; ?>"></td>
      </tr>
	    <tr> 
      <td width="25%">Cari NIS :</td>
      
      <td width="18%"><input type="text" name="nis" value="<? echo $_POST[nis]; ?>"></td>
      <td colspan="3" width="80%" style="font-size:10px; color:#000"></td>
      </tr>
      <tr>
      <td colspan="6" align="right"><input type="submit" name="cari2" value="Cari" /></td>
    </tr>
              <tr><td width="9%" colspan="6"><a href="cetak_nilai_harian_pdf.php?nis=<?php echo $_POST[nis]?>&kelas=<?php echo $_POST[kelas]?>&tahun=<?php echo $_POST[tahun]?>&semester=<?php echo $_POST[semester]?>" target="_blank">Cetak PDF</a></td></tr>

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
    <th width="200" class="tabelsorot"><strong>NIS</strong></th>
    <?php } ?>
    <th width="200" class="tabelsorot"><strong>Kelas</strong></th>
    
	<th width="450" class="tabelsorot"><strong>Nama Mata Pelajaran</strong></th>
	<th width="450" class="tabelsorot"><strong>Semester</strong></th>
    <th width="450" class="tabelsorot"><strong>Nilai Harian</strong></th>
    <th width="130" class="tabelsorot" align="center"><strong>Actions</strong></th>

</tr>
<?php 
	
$query='';
if($_SESSION[status]=="Siswa"){
	$query .= " AND nilai_harian.nis = '" . $_SESSION['nama_user'] . "'";
	}
	if(!empty($_POST[kelas])){
		  $query.= " AND tkelas.Nama_Kelas = '" . $_POST[kelas] . "'";
   }
   if(!empty($_POST[tahun])){
$query .= " AND ttahun_ajaran.tahun = '" . $_POST[tahun] . "'";
}
if(!empty($_POST[nis])){
	$query .= " AND nilai_harian.nis = '" . $_POST[nis] . "'";	
	}
	if(!empty($_POST[semester])){
	$query .= " AND nilai_harian.Smester = '" . $_POST[semester] . "'";								 
	}
		
		$tampil = mysql_query("SELECT tsiswa.Nama, tkelas.Nama_Kelas, nilai_harian.*, tmatapelajaran.Nama_MP  
							  
							 FROM tsiswa 
							 INNER JOIN ttahun_ajaran ON ttahun_ajaran.id = tsiswa.tahun_ajaran
							 	
								INNER JOIN nilai_harian ON nilai_harian.NIS = tsiswa.nis
							
								INNER JOIN tkelas ON tkelas.ID_Kelas = nilai_harian.id_kelas
								INNER JOIN tmatapelajaran ON tmatapelajaran.Kode_Mp = nilai_harian.Kode_Mp
								". $query)or die(mysql_error());
		
		$cek = mysql_num_rows($tampil);
	
	   
//}
	?>	
<?php $no = 1 ; ?>
 		
	<?php while ($row_kategori = mysql_fetch_assoc($tampil)){ ?>
	<tr class="tabelsorot">
		<td class="tabelsorot" align="center"><?php echo $no++?></td>
        <?php if(($_SESSION[status]!="Siswa")){?>
        <td class="tabelsorot" align="left"><?php echo $row_kategori['NIS']?></td>
        <?php } ?>
        <td class="tabelsorot" align="left"><?php echo $row_kategori['Nama_Kelas']?></td>
        
		<td class="tabelsorot" align="left"><?php echo $row_kategori['Nama_MP']?></td>
		<td class="tabelsorot" align="left"><?php echo $row_kategori['Smester'] ?></td>
        <td class="tabelsorot" align="center"><?php echo $row_kategori['kosong'] ?></td>
 		
        <td width="157" class="tabelsorot" align="center">
        	<a href="media.php?pages=nilai_harian&amp;action=view&amp;kid=<?php echo $row_kategori['id_nilai_harian'];?>" title="Lihat Data Lengkap"><img src="images/tanda_view.png" alt="" /></a>
      <?php if($_SESSION[wali_kelas]=="wali_kelas"){?>
    		<a href="media.php?pages=nilai_harian&amp;action=ubah&amp;kid=<?php echo $row_kategori['id_nilai_harian'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="proses_nilai_harian.php?mod=hapus&amp;kid=<?php echo $row_kategori['id_nilai_harian'];?>" title="Hapus Data" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');"><img src="images/tanda_delete.png" alt="" /></a>
            </td>
            <?php } ?>
            </tr>
            
	 <?php }?>
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
	   $jum = mysql_num_rows($tam);
?>
		<form action="proses_nilai_harian.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('nilai[1]','','R','nilai[2]','','R','tahun','','R');return document.MM_returnValue">
        <input type="hidden" name="jum" value="<?=$jum?>" />
<table class="bgform" align="right" width="100%">
        <tr>
        <td colspan="15"><strong>Input Nilai Harian</strong></td>
        </tr>
        <?php 
	   $sql = mysql_query("SELECT * FROM tmatapelajaran WHERE Kode_Mp='$_GET[kodemp]'")or die(mysql_error());
		$m = mysql_fetch_array($sql);
	   ?>
        <tr><td colspan="15">&nbsp;</td></tr>
       <tr><td colspan="15">Nama Mata Pelajaran &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?=$m[Nama_MP]?></td></tr>
        <tr><td colspan="15">Semester &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?=$_GET[semester]?></td></tr>
        
        <tr><td colspan="15">&nbsp;</td></tr>
          
        <tr class="tabelsorot">
        	<td width="70" class="tabelsorot" align="center">NIS</td>
            <td width="130" class="tabelsorot" align="center">Nama</td>
            <td width="10" class="tabelsorot" align="center">UH 1</td>
            <td width="10" class="tabelsorot" align="center">UH 2</td>
            <td width="10" class="tabelsorot" align="center">UH 3</td>
            <td width="10" class="tabelsorot" align="center">UH 4</td>
            <td width="10" class="tabelsorot" align="center">UH 5</td>
            <td width="10" class="tabelsorot" align="center">UH 6</td>
            <td width="10" class="tabelsorot" align="center">UTS</td>
            <td width="10" class="tabelsorot" align="center">UAS</td>
        </tr>
		   
      <?php 
		$i=1;
		while($row = mysql_fetch_array($tam)){?>
        <tr>
		<td class="" align="center"><?=$row[nis]?>
        <input type="hidden" size="5" name="nis[<?=$i?>]" value="<?=$row[nis]?>" />
        </td>
        <td class="" align="center"><?=$row[Nama]?></td>
		<td align="center"> 
        	<input type="text" size="2" name="UH1[<?=$i?>]" maxlength="3" />
         </td>
         <td align="center"> 
        	<input type="text" size="2" name="UH2[<?=$i?>]" maxlength="3" />
         </td>  
         <td align="center"> 
        	<input type="text" size="2" name="UH3[<?=$i?>]" maxlength="3" />
         </td>  
         <td align="center"> 
        	<input type="text" size="2" name="UH4[<?=$i?>]" maxlength="3" />
         </td>  
         <td align="center"> 
        	<input type="text" size="2" name="UH5[<?=$i?>]" maxlength="3" />
         </td>  
         <td align="center"> 
        	<input type="text" size="2" name="UH6[<?=$i?>]" maxlength="3" />
         </td>  
         <td align="center"> 
        	<input type="text" size="2" name="UTS[<?=$i?>]" maxlength="3" />
         </td>  
         <td align="center"> 
        	<input type="text" size="2" name="UAS[<?=$i?>]" maxlength="3" />
         </td>     
        </tr>
          <?php $i++; } ?> 
        
        <tr><td colspan="15">&nbsp;</td></tr>
           
        <tr>
		<td class="" align="">Tahun Ajaran</td>
        <td colspan="15">&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
		
<tr><td colspan="15">&nbsp;</td></tr>
        <?php if($_GET['pesan']=="ada"):?>
       <tr><td colspan="3">Siswa ini Sudah Ada Nilai Harian Pada Semester yang Anda Pilih ! Silahkan Pilih Semester Yang Lain</td></tr>
       <?php endif;?>
		<tr>
			<td colspan="15" align="right">
	 <div class="type-button">
<div class="submit">
<input type="hidden" name="semester" value="<?php echo $_GET[semester]?>">
<input type="hidden" name="kodemp" value="<?php echo $_GET[kodemp]?>">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=nilai_harian">Cancel</a>
</div>        
	</div>
			</td>
		</tr>
              <tr>
			<td colspan="15" align="right">*) Data Harus Di Isi Dengan Benar !
            </td>
		</tr>
	</table>
</form>
			        

<?php }elseif($action=="ubah"){ ?>
<form action="proses_nilai_harian.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		<table class="bgform" align="right" width="100%">
       
       <tr><td colspan="15"><strong>Edit Nilai Harian</strong></td></tr>
        <tr><td colspan="15">&nbsp;</td></tr>
        
       
        <tr>
		<td width="25%" class="" align="">Nama Mata Pelajaran</td>
        <td>:</td>
		<td class="" align=""><div class="input text">
		    <select name="Kode_Mp">
		        <option value="">- Pilih Nama Mata Pelajaran -</option>
		        <?php 
					$sql = mysql_query("SELECT * FROM tmatapelajaran ORDER BY Kode_Mp")or die(mysql_error());
					while($kelas = mysql_fetch_array($sql)){
						if($row_ek['Kode_Mp']==$kelas['Kode_Mp']){
				?>
		        <option value="<?php echo $kelas['Kode_Mp']?>" selected="<?php echo $row_ek['Kode_Mp']?>"><?php echo $kelas['Nama_MP']?></option>
				<?php }else{ ?>                
   		        <option value="<?php echo $kelas['Kode_Mp']?>"><?php echo $kelas['Nama_MP']?></option>

		        <?php }
					}
				?>
		        </select>
		</div></td>
		</tr>
       <tr>
			<td>Semester</td>
			<td>:</td>
			<td><div class="input text">
		    <select name="semester">
            <?php 
				$s = $row_ek['Smester'];
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
			<td>UH 1</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="UH1" size="2" value="<?php echo $row_ek['UH1']?>" /></td></tr>
            <tr>
            <td>UH 2</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="UH1" size="2" value="<?php echo $row_ek['UH2']?>" /></td></tr>
            <tr> 
  			<td>UH 3</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="UH1" size="2" value="<?php echo $row_ek['UH3']?>" /></td></tr>
            <tr>
   			<td>UH 4</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="UH1" size="2" value="<?php echo $row_ek['UH4']?>" /></td></tr>
   			<tr>
            <td>UH 5</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="UH1" size="2" value="<?php echo $row_ek['UH5']?>" /></td></tr> 
   			<tr>
            <td>UH 6</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="UH1" size="2" value="<?php echo $row_ek['UH6']?>" /></td></tr> 
   			<tr>
            <td>UTS</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="UH1" size="2" value="<?php echo $row_ek['UTS']?>" /></td></tr> 
   			<tr>
            <td>UAS</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="UH1" size="2" value="<?php echo $row_ek['UAS']?>" /></td>
		</tr>
		 
		
        <tr><td colspan="15">&nbsp;</td></tr>
        
		<tr>
			<td colspan="15" align="right">
	 <div class="type-button">
<div class="submit"><input type="hidden" name="id_nilai_harian" value="<?php echo $row_ek['id_nilai_harian']?>" />
<input type="hidden" name="nis" value="<?php echo $row_ek['NIS']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=nilai_harian">Cancel</a>
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
		<table class="bgform" align="right" width="100%">
        
       <tr><td colspan="3"><strong>Lihat Nilai Harian</strong></td></tr>
		<tr><td colspan="3">&nbsp;</td></tr>
        <tr>
			<td width="20%">NIS</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek[NIS]?></td>
		</tr>
      
		<tr>
			<td width="30%">Nama Mata Pelajaran</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['Nama_MP']?></td>
		</tr>
        <tr>
			<td width="20%">Semester</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['Smester']?></td>
		</tr>
        <tr>
			<td width="20%">UH 1</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['UH1']?></td>
		</tr>
        <tr>
			<td width="20%">UH 2</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['UH2']?></td>
		</tr>
		<tr>
			<td width="20%">UH 3</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['UH3']?></td>
		</tr>
  		<tr>
			<td width="20%">UH 4</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['UH4']?></td>
		</tr>
        <tr>
			<td width="20%">UH 5</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['UH5']?></td>
		</tr>
		<tr>
			<td width="20%">UH 6</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['UH6']?></td>
		</tr>
        <tr>
			<td width="20%">UTS</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['UTS']?></td>
		</tr>
                <tr>
			<td width="20%">UAS</td>
			<td>:</td>
			<td width="70%"><?php echo $row_ek['UAS']?></td>
		</tr>
		
		
        <tr><td colspan="3">&nbsp;</td></tr>
        
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<a href="media.php?pages=nilai_harian"><strong>Kembali</strong></a>
</div>        
	</div>
			</td>
		</tr>
         
        
	</table>
</form>
<?php } ?>