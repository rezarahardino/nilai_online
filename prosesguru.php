<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $NIP= $_POST[NIP];
   $nama = $_POST[nama];
   $jk = $_POST[jk];
   $agama = $_POST[agama];
   $alamat = $_POST[alamat];
   $tempat_lahir = $_POST[tempat_lahir];
   $tgl1 = $_POST[tgl1];
   $alamat = $_POST[alamat];
   $kodepos = $_POST[kodepos];
   $telepon = $_POST[telepon];
   $email = $_POST[email];
   $kota = $_POST[kota]; 
   $pendidikan = $_POST[pendidikan];
   $jabatan = $_POST[jabatan];
   $lokasi = $_FILES[foto][tmp_name];
   $photo = $_FILES[foto][name];
   $password = $_POST[password];
   $type = "Guru";
   
   $kid = $_GET['kid'];
   
   $M = "SELECT max(id) as maxId, NIP FROM tguru GROUP BY id";
	$qM = mysql_query($M)or die(mysql_error());
	$tM = mysql_fetch_array($qM);
		
		$nilai = $tM['NIP'];	
		
		$noUrut = (int) substr($nilai, 11, 14);
		$noUrut++;
		
 		$newKode = $tgl1."-".sprintf("%03s", $noUrut);
   		//echo $newKode;exit;
   switch ($mod)
   {
		
   		case "tambah"	: 
		$sql = mysql_query("SELECT * FROM tguru WHERE NIP='$NIP'");
		$cek = mysql_num_rows($sql);
		if($cek > 0){
						echo "<script language='javascript'>alert('NIP Yang Anda Input Sudah Ada' ); window.location.href='media.php?pages=guru&action=tambah';</script>";exit;
	
		}else{
		if (!empty($lokasi))
		{
			 move_uploaded_file($lokasi,"images/foto_guru/$photo");
		mysql_query("insert into tguru 
										values('','$NIP','$nama','$alamat','$kodepos','$tempat_lahir','$tgl1','$jk','$agama','$kota','$email','$telepon','$pendidikan','$jabatan','$photo')")or die(mysql_error());
		/*mysql_query("insert into mst_user 
										values('','$newKode','$password','$type')")or die(mysql_error());*/
		
		}else{
		mysql_query("insert into tguru 
										values('','$NIP','$nama','$alamat','$kodepos','$tempat_lahir','$tgl1','$jk','$agama','$kota','$email','$telepon','$pendidikan','$jabatan','')")or die(mysql_error());	
		
		//mysql_query("insert into mst_user 
			//							values('','$newKode','$password','$type')")or die(mysql_error());
		
		}
	 		header("location:media.php?pages=guru");
		}
		break;
		
		case "ubah"		:
		if (!empty($lokasi))
		{
		  move_uploaded_file($lokasi,"images/foto_guru/$photo");
  		  mysql_query("Update tguru 
										SET Nama_Guru = '$nama',Jenis_Kelamin= '$jk',tempat_lahir= '$tempat_lahir',tgl_lahir= '$tgl1',alamat = '$alamat',kodepos= '$kodepos',No_Telp = '$telepon',email = '$email',kota = '$kota',agama='$agama', Pendidikan_Terakhir = '$pendidikan', jabatan = '$jabatan', photo='$photo' WHERE  NIP = '$NIP'") or die (mysql_error());
		}else{
			 mysql_query("Update tguru 
										SET Nama_Guru = '$nama',Jenis_Kelamin= '$jk',tempat_lahir= '$tempat_lahir',tgl_lahir= '$tgl1',alamat = '$alamat',kodepos= '$kodepos',No_Telp = '$telepon',email = '$email',kota = '$kota',agama='$agama', Pendidikan_Terakhir = '$pendidikan', jabatan = '$jabatan' WHERE  NIP = '$NIP'") or die (mysql_error());
		}
						  header("location:media.php?pages=guru");
						  break;
		case "hapus"	: mysql_query("delete from tguru where NIP = '$kid'");
						  header("location:media.php?pages=guru");
						  break;
   }
 
?>