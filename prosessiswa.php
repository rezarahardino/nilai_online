<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $nis= $_POST[nis];
   $nama = $_POST[nama];
   $panggilan = $_POST[panggilan];
   $jk = $_POST[jk];
   $agama = $_POST[agama];
   $alamat = $_POST[alamat];
   $tempat_lahir = $_POST[tempat_lahir];
   $tgl1 = $_POST[tgl1];
   $alamat = $_POST[alamat];
   $anak_ke=$_POST[anak_ke];
   $status_anak=$_POST[status_anak];
   $tinggal=$_POST[tinggal];
   $kode_pos = $_POST[kode_pos];
   $telepon = $_POST[telepon];
   $email = $_POST[email];
   $kota = $_POST[kota]; 
   $lokasi = $_FILES[foto][tmp_name];
   $photo = $_FILES[foto][name];
   $kid = $_GET['kid'];
   $ID_Kelas = $_POST[ID_Kelas];
   $program=$_POST[program];
   $kode=$_POST[kode];
   $nama_ortu = $_POST[nama_ortu];
   $alamat_ortu = $_POST[alamat_ortu];
   $telepon_ortu = $_POST[telepon_ortu];
   $pekerjaan = $_POST[pekerjaan];
   $tahun = $_POST[tahun];
   $semester=$_POST[semester];
   switch ($mod)
   {
   		
   		case "tambah"	: 
   		
		if (!empty($lokasi))
		{
			 
			//insert biodata
		  move_uploaded_file($lokasi,"images/foto_siswa/$photo");
  		   mysql_query("insert into tsiswa 
										values('$nis','$nama','$ID_Kelas','$program','$semester','$tahun','$panggilan','$jk','$agama','$tempat_lahir','$tgl1','$anak_ke','$status_anak','$tinggal','$alamat','$kota','$kode_pos','$telepon','$email','$photo','$nama_ortu','$alamat_ortu','$telepon_ortu','$pekerjaan')")or die(mysql_error());

}else{
					 mysql_query("insert into tsiswa 
										values('$nis','$nama','$ID_Kelas','$program','$semester','$tahun','$panggilan','$jk','$agama','$tempat_lahir','$tgl1',
										'$anak_ke',
										'$status_anak','$tinggal','$alamat','$kota','$kode_pos','$telepon','$email','','$nama_ortu','$alamat_ortu','$telepon_ortu','$pekerjaan')")or die(mysql_error());
					 
		}
															
	 		header("location:media.php?pages=siswa");
		break;
		
		case "ubah"		: 
		if (!empty($lokasi))
		{
		  move_uploaded_file($lokasi,"images/foto_siswa/$photo");
mysql_query("Update tsiswa 
										SET Nama = '$nama',id_kelas='$ID_Kelas',program='$program', semester='$semester', tahun_ajaran='$tahun', Jenis_Kelamin= '$jk',Tempat_lahir= '$tempat_lahir',Tgl_Lahir= '$tgl1',Alamat = '$alamat',anak_ke = '$anak_ke',status_anak = '$status_anak',tinggal = '$tinggal',Kode_Pos= '$kode_pos',No_Telp = '$telepon',Email = '$email',ID_KabKota = '$kota',agama='$agama', nama_org_tua = '$nama_ortu',alamat_org_tua = '$alamat_ortu',telepon_org_tua = '$telepon_ortu',pekerjaan = '$pekerjaan', photo='$photo' WHERE  nis = '$nis'") or die (mysql_error());
}else{
mysql_query("Update tsiswa 
										SET Nama = '$nama',id_kelas='$ID_Kelas',program='$program', semester='$semester', tahun_ajaran='$tahun', Jenis_Kelamin= '$jk',Tempat_lahir= '$tempat_lahir',agama='$agama',Tgl_Lahir= '$tgl1',Alamat = '$alamat',anak_ke = '$anak_ke',status_anak = '$status_anak',tinggal = '$tinggal',Kode_Pos= '$kode_pos',No_Telp = '$telepon',Email = '$email',ID_KabKota = '$kota',nama_org_tua = '$nama_ortu',alamat_org_tua = '$alamat_ortu',telepon_org_tua = '$telepon_ortu',pekerjaan = '$pekerjaan' WHERE  nis = '$nis'") or die (mysql_error());
}
						  header("location:media.php?pages=siswa");
						  break;
			
		case "hapus"	: mysql_query("delete from tsiswa where nis = '$kid'");
						  header("location:media.php?pages=siswa");
						  break;
   }
 
?>
