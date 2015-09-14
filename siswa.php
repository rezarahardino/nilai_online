<?php 
session_start() ?>
<?php include "config/koneksi.php"; ?>
<?php
	$maxRows_kategori = 10;
	$pageNum_kategori = 0;
	if (isset($HTTP_GET_VARS['pageNum_kategori'])) {
	  $pageNum_kategori = $HTTP_GET_VARS['pageNum_kategori'];
	}
	$queryx='';
if($_POST[cari]=="Cari"){
	if($_POST[select]=="nis"){
		$queryx=" and tsiswa.nis like '%".$_POST[keyword]."%' ";
	}
	
	if($_POST[select]=="nama"){
		$queryx=" and tsiswa.Nama like '%".$_POST[keyword]."%' ";
	}
	if($_POST[select]=="kelas"){
		$queryx.=" and tkelas.Nama_Kelas like '%".$_POST[keyword]."%' ";
	}
}
	$startRow_kategori = $pageNum_kategori * $maxRows_kategori;
	$query_kategori = "SELECT tsiswa.* FROM tsiswa, tkelas WHERE tsiswa.id_kelas = tkelas.ID_Kelas  
						" .$queryx."
						
	
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

	$kid = $_GET['nis'];
	$query_ek = "SELECT tsiswa.*, ttahun_ajaran.tahun, tkelas.Nama_Kelas FROM tsiswa 
						INNER JOIN tkelas ON tkelas.ID_Kelas = tsiswa.id_kelas
						INNER JOIN ttahun_ajaran ON ttahun_ajaran.id = tsiswa.tahun_ajaran
						WHERE tsiswa.nis = '$kid'";
						
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
<script type="text/javascript" src="jquery/jquery-1.2.6.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-personalized-1.5.3.js"></script>
<script type="text/javascript" src="jquery/jquery.validate.pack.js"></script>
<script type="text/javascript">
			$(function(){
				
				// Tabs
				$('#tabs').tabs();
		
			});
	
		$(document).ready(function() {
		$("#form1").validate({
		messages: {
			email: {
				required: "Email Harus Di Isi",
				email: "Masukkan Email Yang Valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
		});
	})	
</script>
<style>
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 1px; }			
.style1 {color: #000000}
</style>
	<h2><img src="images/table_siswa.png" alt=""/></h2>
	<?php 
$action = $_GET['action'];
if(empty($action)){?>

<table width="1007" cellpadding="0" cellspacing="0">
<?php if(($_SESSION[status]!="Siswa")&&($_SESSION[status]!="Guru")){?>

<tr>
    <td width="952" align="right" valign="bottom" class="ac_over" style="font-weight:bold"><a href="media.php?pages=siswa&amp;action=tambah" class="">Input Siswa</a>
    
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
          <option value="nis" <? echo $_POST[select]=="nis"?"selected":"";?>>NIS</option>
          <option value="nama" <? echo $_POST[select]=="nama"?"selected":"";?>>Nama</option>
          <option value="kelas" <? echo $_POST[select]=="kelas"?"selected":"";?>>Kelas</option>
          </select></td>
      <td colspan="3" width="14%"><input type="text" name="keyword" value="<? echo $_POST[keyword]; ?>"></td>
      <td colspan="5" width="30%" align=""><input type="submit" name="cari" value="Cari"></td>
    
        
      <!-- tr>
      <td width="5%">Cari Tahun Ajaran :</td>
      <td colspan="5" width="5%" class="search"><select name="tahun">
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
            </tr>-->
                      
          <td width="50%"><a href="cetak_siswa_pdf.php?kat=<?php echo $_POST[select]?>&key=<?php echo $_POST[keyword]?>" target="_blank">Cetak PDF</a></td>
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
	<th width="50" class="tabelsorot"><strong>No</strong></th>
	<th width="100" class="tabelsorot"><strong>NIS</strong></th>
	<th width="150" class="tabelsorot"><strong>Nama</strong></th>
	<th width="250" class="tabelsorot"><strong>Alamat</strong></th>
	<th width="100" class="tabelsorot"><strong>JK</strong></th>
    <th width="175" class="tabelsorot"><strong>Email</strong></th>
	<th width="86" class="tabelsorot" align="center"><strong>Actions</strong></th>
</tr>
 <?php 
 if($_GET['pageNum_kategori']>0){
	$no = $_GET['pageNum_kategori'] * $maxRows_kategori;
 }else{
 $no = 1 ; 
 }
 		while ($row_kategori = mysql_fetch_assoc($kategori)) { ?>

	<tr class="tabelsorot">
		<td class="tabelsorot" align="center"><?php echo $no++?></td>
		<td class="tabelsorot"><?php echo $row_kategori['nis']?></td>
		<td class="tabelsorot"><?php echo $row_kategori['Nama'] ?></td>
		<td class="tabelsorot"><?php echo $row_kategori['Alamat']?></td>
		<td class="tabelsorot"><?php echo $row_kategori['Jenis_Kelamin']?></td>
        <td class="tabelsorot"><?php echo $row_kategori['Email']?></td>
		
        <td class="tabelsorot" align="center">
			<a href="media.php?pages=siswa&amp;action=view&amp;nis=<?php echo $row_kategori['nis'];?>" title="Lihat Data Lengkap"><img src="images/tanda_view.png" alt="" /></a>
            <?php if(($_SESSION[status]!="Siswa")&&($_SESSION[status]!="Guru")){?>
			<a href="media.php?pages=siswa&amp;action=ubah&amp;nis=<?php echo $row_kategori['nis'];?>" title="Edit Data"><img src="images/edit2.png" alt="" /></a>
			<a href="prosessiswa.php?mod=hapus&amp;kid=<?php echo $row_kategori['nis'];?>" onClick="return confirm('Apakah Anda Yakin Akan Menghapus Data');" title="Hapus Data"><img src="images/tanda_delete.png" alt="" /></a>
            <?php } ?>
       		  </td>
	</tr>
	 <?php }  ?>
	</table>
	
	</form>
</td>
</tr>
</table>

<?php }elseif($action=="tambah"){ ?>
	<form action="prosessiswa.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data" onSubmit="MM_validateForm('NIP','','R','nama','','R','tempat_lahir','','R','tgl1', '', 'R', 'alamat','','R', 'kode_pos', '', 'R', 'kota', '','R', 'telepon', '', 'R', 'email', '' ,'RisEmail');return document.MM_returnValue">
<table class="bgform"  align="right" width="100%">
       <tr>
			<td class="bgform" colspan="3"><strong>Input Data Siswa</strong></td>
		</tr>
		<tr>
        	<td colspan="3" align="center"><strong>Keterangan Diri Siswa</strong></td>
        </tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr>
			<td width="117">NIS</td>
			<td width="17">:</td>
			<td width="350">
			<input type="text" name="nis" />
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td width="2%">:</td>
			<td width="51%"><input type="text" name="nama" /></td>
		</tr>
		<tr>
			<td>Nama Panggilan</td>
			<td>:</td>
			<td><input type="text" name="panggilan" /></td>
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
			<td><input type="text" name="tempat_lahir" /></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td>:</td>
			<td><div class="input text"><input size="15" type="text" readonly name="tgl1" id="tgl1">
    <input name="button" class="button" type="button" onClick="displayCalendar(document.form1.tgl1,'yyyy-mm-dd',this,true)" value="Calender"></div></td>
		</tr>
         <tr>
			<td width="117">Anak Ke</td>
			<td width="17">:</td>
			<td width="350">
			<input type="text" name="anak_ke" />
			</td>
		</tr>
        <tr>
			<td>Status Anak</td>
			<td>:</td>
			<td><div class="input text"><select name="status_anak">
            <option value="Anak Kandung">Anak Kandung</option>
            	<option value="Anak Yatim">Anak Yatim</option>
                <option value="Anak Piatu">Anak Piatu</option>
                <option value="Anak Yatim Piatu">Anak Yatim Piatu</option>
            </select>
            </div></td>
		</tr>
        <tr>
			<td>Email</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="email" /></div></td>
		</tr>
         <tr>
		<td class="" align="">Kelas</td>
        <td>:</td>
		<td class="" align="">
		    <select name="ID_Kelas" >
		        <option value="">- Pilih Kelas -</option>
		        <?php 
					$sql = mysql_query("SELECT * FROM tkelas ORDER BY ID_Kelas")or die(mysql_error());
					while($kelas = mysql_fetch_array($sql)){
				?>
		        <option value="<?php echo $kelas['ID_Kelas']?>"><?php echo $kelas['Nama_Kelas']?></option>
		        <?php } ?>
          </select>
		</td>    
    </tr>
     <tr>
    	<td class="">
        	Program
        </td><td>:</td>
        <td class="">
       
		    <select name="program">
		        <option value="">- Pilih Program -</option>
                <option value="Umum">Umum</option>
                <option value="IPA">IPA</option>
                <option value="IPS">IPS</option>
             </select>
       
        </td>
        
    </tr>
    <tr>
    	<td>Semester</td>
        <td>:</td>
        <td>
		    <select name="semester">
             <option value="">- Pilih Semester -</option>
		         <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
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
			<td><input type="text" name="kota" /></td>
		</tr>
		<tr>
			<td>Kode Pos</td>
			<td>:</td>
			<td><input type="text" name="kode_pos" /></td>
		</tr>
       
		<tr>
			<td>Telepon</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="telepon" /></div></td>
		</tr>
		<td>Tinggal Dengan</td>
			<td>:</td>
			<td><div class="input text"><select name="tinggal">
            <option value="Orang Tua">Orang Tua</option>
            	<option value="Wali">Wali</option>
                <option value="Asrama">Asrama</option>
                <option value="Kost">Kost</option>
            </select>
            </div></td>
		</tr>
                 
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
        	<td colspan="3" align="center"><strong>Keterangan Orang Tua</strong></td>
        </tr>
	       
           <tr><td colspan="3">&nbsp;</td></tr>
           
		<tr>
			<td>Nama Orang Tua / Wali</td>
			<td>:</td>
			<td><input type="text" name="nama_ortu" /></td>
		</tr>
        <tr>
			<td>Alamat Orang Tua / Wali</td>
			<td>:</td>
			<td><input type="text" name="alamat_ortu" /></td>
		</tr>
        <tr>
			<td>Telepon Orang Tua / Wali</td>
			<td>:</td>
			<td><input type="text" name="telepon_ortu" /></td>
		</tr>
        <tr>
			<td>Pekerjaan Orang Tua / Wali</td>
			<td>:</td>
			<td><input type="text" name="pekerjaan" /></td>
		</tr>
        
          <tr><td colspan="3">&nbsp;</td></tr>
       
		<tr>
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=siswa">Cancel</a>
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
<form action="prosessiswa.php?mod=ubah" method="post" name="form2" id="form2" enctype="multipart/form-data"  onSubmit="MM_validateForm('nama','','R');return document.MM_returnValue">
		<table class="bgform" align="right" width="90%">
         
              <tr><td colspan="3"><strong>Edit Data Siswa</strong></td></tr>
		<tr>
        	<td colspan="3" align="center"><strong>Keterangan Diri Siswa</strong></td>
        </tr>
            
		<tr>
			<td width="157">&nbsp;</td>
			<td width="17">&nbsp;</td>
			<td width="390">
			<input type="hidden" name="nis" value="<?php echo $row_ek['nis']?>" />
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="nama" value="<?php echo $row_ek['Nama']?>" /></div></td>
		</tr>
	<tr>
			<td>Nama Panggilan</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="panggilan" value="<?php echo $row_ek['panggilan']?>" /></div></td>
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
			<td><div class="input text"><input type="text" name="tempat_lahir" value="<?php echo $row_ek['Tempat_Lahir']?>" /></div></td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td>:</td>
			<td><div class="input text"><input size="15" type="text" readonly name="tgl1" id="tgl1" value="<?php echo $row_ek['Tgl_Lahir']?>">
    <input name="button" class="button" type="button" onClick="displayCalendar(document.form2.tgl1,'yyyy-mm-dd',this,true)" value="Cal"></div></td>
		</tr>
        <tr>
			<td>Anak Ke</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="anak_ke" value="<?php echo $row_ek['anak_ke']?>" /></div></td>
		</tr>
        
        <tr>
        	<td>Status Anak</td>
        	<td>:</td>
        	<td><div class="input text">
        	<select name="status_anak">
        
			<?php 
        
        		switch($row_ek['status_anak']){
        		case 'Anak Kandung':
                 		$Anak_Kandung = "selected";
        		break;
        		case 'Anak Yatim':
	    	 			$Anak_Yatim = "selected";
        		break;
        		case 'Anak Piatu':
	     				$Anak_Piatu = "selected";
        		break;
        		case 'Anak Yatim Piatu':
	     				$Anak_Yatim_Piatu = "selected";
        		break;
        		}
				?>
	
				<option value="Anak Kandung" <?php echo $Anak_Kandung;?>>Anak Kandung</option>
				<option value="Anak Yatim" <?php echo $Anak_Yatim;?>>Anak Yatim</option>
				<option value="Anak Piatu" <?php echo $Anak_Piatu;?>>Anak Piatu</option>
				<option value="Anak Yatim Piatu" <?php echo $Anak_Yatim_Piatu;?>>Anak Yatim Piatu</option>
				</select>
			</div>
		</td>
	</tr>
        
       <tr>
			<td>Email</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="email" value="<?php echo $row_ek['Email']?>"/></div></td>
		</tr>
        <tr>
        <td class="" align="">Kelas</td>
        <td>:</td>
		<td class="" align=""><div class="input text">
		    <select name="ID_Kelas">
		        <option value="">- Pilih Kelas -</option>
		        <?php 
					$sql = mysql_query("SELECT * FROM tkelas ORDER BY ID_Kelas")or die(mysql_error());
					while($kelas = mysql_fetch_array($sql)){
						if($kelas['ID_Kelas'] == $row_ek['id_kelas']){
				?>
			        <option value="<?php echo $kelas['ID_Kelas']?>" selected="<?php echo $row_ek['id_kelas']?>"><?php echo $kelas['Nama_Kelas']?></option>
                <?php }else{?>
    	            <option value="<?php echo $kelas['ID_Kelas']?>"><?php echo $kelas['Nama_Kelas']?></option>
		        <?php }
				
					}?>
		        </select>
		</div></td>    
    </tr>
     <tr>
    	<td class="">
        	Program
        </td><td>:</td>
        <td class="">
        <div class="input text">
		    <select name="program">
            <?php 
				$s = $row_ek['program'];
				switch($s){
					case 'Umum':
						$Umum = "selected";
						break;
					case 'IPA':
						$IPA = "selected";
						break;
					case 'IPS':
						$IPS = "selected";
						break;
				}
			?>
		        <option value="">- Pilih Program -</option>
                <option value="Umum" <?php echo $Umum?>>Umum</option>
                <option value="IPA" <?php echo $IPA?>>IPA</option>
                <option value="IPS" <?php echo $IPS?>>IPS</option>
                </select>
        </div>
        </td>
        
    </tr>
    <tr>
    	<td>Semester</td>
        <td>:</td>
        <td><div class="input text">
		    <select name="semester">
            <?php 
				$s = $row_ek['semester'];
				switch($s){
					case 'Ganjil':
						$Ganjil = "selected";
						break;
					case 'Genap':
						$Genap = "selected";
						break;
					}
			?>
		        <option value="">- Pilih Semester -</option>
                <option value="Ganjil" <?php echo $Ganjil;?>>Ganjil</option>
                <option value="Genap" <?php echo $Genap;?>>Genap</option>
            </select></div>
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
						if($kelas['id'] == $row_ek['tahun_ajaran']){
				?>
		        <option value="<?php echo $kelas['id']?>" selected="<?php echo $row_ek['tahun_ajaran']?>"><?php echo $kelas['tahun']?></option>
                <?php }else{?>
                <option value="<?php echo $kelas['id']?>"><?php echo $kelas['tahun']?></option>
		        <?php } 
					}
				?>
		        </select>
		</div></td>    
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
			<td><div class="input text"><textarea name="alamat" cols="50" rows="5"><?php echo $row_ek['Alamat']?></textarea></div></td>
		</tr>
        
        <tr>
			<td>Kota</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="kota" value="<?php echo $row_ek['ID_KabKota']?>" /></div></td>
		</tr>
        
        <tr>
			<td>Kode Pos</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="kode_pos" value="<?php echo $row_ek['Kode_Pos']?>" /></div></td>
		</tr>
        
        <tr>
			<td>Telepon</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="telepon" value="<?php echo $row_ek['No_Telp']?>"  /></div></td>
		</tr>
               
       	<tr>
        	<td>Tinggal Dengan</td>
        	<td>:</td>
        	<td><div class="input text">
        	<select name="tinggal">
        
			<?php 
        
        	switch($row_ek['tinggal']){
        	case 'Orang Tua':
                 	$Orang_Tua = "selected";
        	break;
        	case 'Wali':
	     			$Wali = "selected";
        	break;
       		case 'Asrama':
	     			$Asrama = "selected";
        	break;
        	case 'Kost':
	     			$Kost = "selected";
        	break;
        	}
			?>
	
			<option value="Orang Tua" <?php echo $Orang_Tua;?>>Orang Tua</option>
			<option value="Wali" <?php echo $Wali;?>>Wali</option>
			<option value="Asrama" <?php echo $Asrama;?>>Asrama</option>
			<option value="Kost" <?php echo $Kost;?>>Kost</option>
			</select>
		</div>
	</td>
</tr>
		
        <tr><td colspan="3">&nbsp;</td></tr>
        		<tr>
        	<td colspan="3" align="center"><strong>Keterangan Orang Tua</strong></td>
        </tr>
	        <tr><td colspan="3">&nbsp;</td></tr>
		<tr>
			<td>Nama Orang Tua / Wali</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="nama_ortu" value="<?php echo $row_ek['nama_org_tua']?>" /></div></td>
		</tr>
        <tr>
			<td>Alamat Orang Tua / Wali</td>
			<td>:</td>
			<td><div class="input text"><textarea name="alamat_ortu" cols="50" rows="5"><?php echo $row_ek['alamat_org_tua']?></textarea></div></td>
		</tr>
        <tr>
			<td>Telepon Orang Tua / Wali</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="telepon_ortu" value="<?php echo $row_ek['telepon_org_tua']?>" /></div></td>
		</tr>
        <tr>
			<td>Pekerjaan Orang Tua / Wali</td>
			<td>:</td>
			<td><div class="input text"><input type="text" name="pekerjaan" value="<?php echo $row_ek['pekerjaan']?>" /></div></td>
		
        </tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
        
			<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit"><input type="hidden" name="kode" value="<?php echo $row_ek['kode']?>" />
<input value="Submit" type="submit" name="submit" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Dimasukkan');"> <a href="media.php?pages=siswa">Cancel</a>
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
<form action="prosessiswa.php?mod=tambah" method="post" name="form1" id="form1" enctype="multipart/form-data">
<table class="bgform" align="right" width="100%">
   <tr>
			<td class="bgform" colspan="3"><strong>Lihat Data Siswa</strong></td>
		</tr>
	
    	<tr>
        	<td colspan="3" align="center"><strong>Keterangan Diri Siswa</strong></td>
        </tr>
	      <tr>
          <td valign="top" class="star2" colspan="2" align="left"><img src="<?php echo 'images/foto_siswa/'. $row_ek['photo']?>" width="130" height="134" style="border:#FF0000; border:double" /></td>
	  <td>
      </tr>
		<tr>
			<td width="100" height="10">NIS</td>
			<td width="10">:</td>
			<td width="150"><?php echo $row_ek['nis']?></td>
		</tr>
		<tr>
			<td height="25">Nama</td>
			<td>:</td>
			<td><?php echo $row_ek['Nama']?></td>
		</tr>

		<tr>
			<td height="25">Nama Panggilan</td>
			<td>:</td>
			<td><?php echo $row_ek['panggilan']?></td>
		</tr>
        
		<tr>
			<td height="25">Jenis Kelamin</td>
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
			<td height="25">Tempat Lahir</td>
			<td>:</td>
			<td><?php echo $row_ek['Tempat_Lahir']?></td>
		</tr>
		<tr>
			<td height="24">Tanggal Lahir</td>
			<td>:</td>
			<td><?php echo tgl_indo($row_ek['Tgl_Lahir'])?></td>
		</tr>
        <tr>
			<td height="24">Anak Ke</td>
			<td>:</td>
			<td><?php echo $row_ek['anak_ke']?></td>
		</tr>
        <tr>
			<td height="24">Status Anak</td>
			<td>:</td>
			<td><?php echo $row_ek['status_anak']?></td>
		</tr>
        <tr>
			<td height="25">Email</td>
			<td>:</td>
			<td><?php echo $row_ek['Email']?></td>
		</tr>
        <tr>
			<td height="25">Kelas</td>
			<td>:</td>
			<td><?php echo $row_ek['Nama_Kelas']?></td>
		</tr>
         <tr>
			<td height="25">Program</td>
			<td>:</td>
			<td><?php echo $row_ek['program']?></td>
		</tr>
        <tr>
			<td height="25">Semester</td>
			<td>:</td>
			<td><?php echo $row_ek['semester']?></td>
		</tr>
        
        <tr>
			<td height="25">Tahun Ajaran</td>
			<td>:</td>
			<td><?php echo $row_ek['tahun']?></td>
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
			<td><?php echo $row_ek['Alamat']?></td>
		</tr>
        
          <tr>
			<td height="22">Kota</td>
			<td>:</td>
			<td><?php echo $row_ek['ID_KabKota']?></td>
		</tr>
        
        <tr>
			<td height="22">Kode Pos</td>
			<td>:</td>
			<td><?php echo $row_ek['Kode_Pos']?></td>
		</tr>
      
        <tr>
			<td height="22">Telepon</td>
			<td>:</td>
			<td><?php echo $row_ek['No_Telp']?></td>
		</tr>
        
        <tr>
			<td height="24">Tinggal Dengan</td>
			<td>:</td>
			<td><?php echo $row_ek['tinggal']?></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
        	<td colspan="3" align="center"><strong>Keterangan Orang Tua</strong></td>
        </tr>
	       
           <tr><td colspan="3">&nbsp;</td></tr>
		   
     	<tr>
			<td>Nama Orang Tua / Wali</td>
			<td>:</td>
			<td><?php echo $row_ek['nama_org_tua']?></td>
		</tr>
		<tr>
			<td height="22">Alamat Orang Tua / Wali</td>
			<td>:</td>
			<td><?php echo $row_ek['alamat_org_tua']?></td>
		</tr>
        <tr>
			<td height="22">Telepon Orang Tua / Wali</td>
			<td>:</td>
			<td><?php echo $row_ek['telepon_org_tua']?></td>
		</tr>
		<tr>
			<td height="25">Pekerjaan Orang Tua / Wali</td>
			<td>:</td>
			<td><?php echo $row_ek['pekerjaan']?></td>
		</tr>
        
		<tr><td colspan="3">&nbsp;</td></tr>

<tr>
		<td colspan="3" align="right"><a href="javascript:window.print()"><strong>Print</strong></a> | <a href="media.php?pages=siswa"><strong>Kembali</strong></a></td>
	</tr>
    
</table>
</table>
</td>
</tr>
</form>
<?php } ?>