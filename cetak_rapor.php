<?php 
session_start() ?>
<?php include "config/koneksi.php"; ?>
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
	<h2><img src="images/table_cetak_rapor.png" alt=""/></h2>
<table width="1007" cellpadding="0" cellspacing="0">
 
 <tr><td colspan="3">&nbsp;</td></tr>
 
 <tr>
  <td class="search">
  	 <form action="print_rapor.php" method="post"  onSubmit="MM_validateForm('NIS','','R');return document.MM_returnValue" target="_blank">
     
    	<table width="68%">
       
    <tr> 
      <td width="15%">Masukan NIS :</td>
      
      <td width="30%">
      <?php if($_SESSION[status]=="Siswa"){?>
      <input type="text" name="NIS" value="<? echo $_SESSION[nama_user]; ?>" readonly="readonly">
      <?php }else{ ?> 
      <input type="text" name="NIS" value="<? echo $_POST[keyword]; ?>">
      <?php } ?>
      </td>
       <tr>
      <td width="15%">Semester :</td>
       <td><select name="semester">
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
            </td>
          </tr>   
      <tr> 
      <td width="15%">Filter Tahun Ajaran :</td>
      
      <td width="30%"><select name="tahun">
				
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
			</select></td>
      </tr>
     
    <tr> 
      <td width="15%">Kriteria Nilai :</td>
      
      <td width="30%">
      <select name="kriteria">
      	<option value="nilai_kkm">Nilai Pengetahuan + KKM</option>
        <option value="kompetensi">Nilai Kompetensi</option>
        <option value="pengembangan">Nilai Pengembangan Diri + Nilai Kepribadian + Nilai Ketidakhadiran</option>
        <option value="catatan">Nilai Catatan Prestasi</option>        
      </select>
      </td>
      </tr>
  
          <tr>
           <td colspan="3" align="right">
      <input type="submit" name="cari" value="Cetak">
      </td>
    </tr>
  </table>
    </form>   
    </td>
    </tr>
     <tr><td colspan="3">&nbsp;</td></tr>
    </table>