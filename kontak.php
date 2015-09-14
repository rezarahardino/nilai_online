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
			if (p<1 || p==(val.length-1)) errors+='- '+nm+' Tidak Valid\n';
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
	<h2>KONTAK KAMI</h2>
		<form action="#" method="post" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="MM_validateForm('NIP','','R','nama','','R','tempat_lahir','','R','tgl1', '', 'R', 'alamat','','R', 'kode_pos', '', 'R', 'kota', '','R', 'telepon', '', 'R', 'email', '' ,'RisEmail');return document.MM_returnValue">
		<table class="bgform">
		
        <tr>
			<td class="bgform" colspan="3"><strong>SMA Negeri 1 Bumiayu</strong></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
        <tr>
			<td>Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;  Jl. P. Diponegoro No. 02 Bumiayu 52273 Brebes Jawa Tengah</td>
        </tr>
        <tr>
			<td>Kode Pos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; 52273</td>
        </tr>
		<tr>
			<td>No Telepon&nbsp;&nbsp;:&nbsp; (0289) 432312</td>
        </tr>
        <tr><td colspan="3">&nbsp;</td></tr>
	</table>
	
    </form>
    <form id="form1" name="form1" method="post" action="?pages=proses_komentar" onSubmit="MM_validateForm('Nama','','R','Email', '' ,'RisEmail','Komentar','','R');return document.MM_returnValue">
  <table width="81%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCCCCC">
    <tr>
			<td class="bgform" colspan="3"><strong>Silahkan Masukan Kritik Dan Saran Anda</strong></td>
		</tr>
        
        <tr><td colspan="3">&nbsp;</td></tr>
        
    <tr>
      <td width="22%">Nama</td>
      <td width="78%"><label>
        <input name="Nama" type="text" id="Nama" value="<?php echo $Nama; ?>" maxlength="25" />
      <input name="id_komentar" type="hidden" id="id_komentar" value="<?php //echo kdauto('tkomentar',""); ?>" />
      </label></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label>
        <input name="Email" type="text" id="Email" value="<?php echo $Email; ?>" size="20" maxlength="30" />
      </label></td>
    </tr>
    <tr>
      <td>Komentar</td>
      <td><label>
        <textarea name="Komentar" id="Komentar" cols="45" rows="5"><?php echo $Komentar; ?></textarea>
      </label></td>
    </tr>
    
    <tr><td colspan="3">&nbsp;</td></tr>
    
    <tr>
	<td colspan="3" align="right">
	 <div class="type-button">
<div class="submit">
<input value="Kirim" type="submit" id="kirim" name="kirim" onClick="return confirm('Apakah Anda Yakin Dengan Data Yang Akan Dikirim');"> <a href="media.php?pages=home">Cancel</a>
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
