<?php			
if ($_POST['kirim']) {
	$id_komentar = $_POST['id_komentar'];
	$Nama= $_POST['Nama'];
	$Email = $_POST['Email'];
	$Komentar = $_POST['Komentar'];

	
		
	if (trim($Nama)=="") {
		$pesan[] = "Nama Harus Diisi";
	}
	if (trim($Email)=="") {
		$pesan[] = "Email Harus Diisi";
	}
	if (trim($Komentar)=="") {
		$pesan[] = "Komentar Harus Diisi";
	}
		if (! count($pesan)==0 ) {
		$Nama= $_POST['Nama'];
		$Email = $_POST['Email'];
		$Komentar = $_POST['Komentar'];
	
		include_once "kontak.php";
		echo "<meta http-equiv='refresh' content='5; url=?pages=kontak_kami'>";
		
		
		
		echo "<b><strong> Data Belum Lengkap : </strong></b><br>";
		foreach ($pesan as $indeks=>$pesan_tampil) {
			$urut_pesan++;
			echo "<font color='#FF0000'>";
			echo "$urut_pesan . $pesan_tampil <br>";
			echo "</font>";
		}
	    exit;
	}
	else {
		include_once "config/koneksi.php";
		$sql = " INSERT INTO tkomentar SET
					
					nama='$Nama',
					email='$Email',
					isi='$Komentar',
					created=Now()
					";
									
					
		mysql_query($sql) 
			  or die ("Gagal query simpan".mysql_error());
			  
		
		//include "kontakkami.php";
		echo "<meta http-equiv='refresh' content='5; url=?pages=kontak_kami'>";
		echo("<strong>Komentar Anda Sudah Terkirim</strong>");
		
			}
			
}
else {
	//echo "Buka File DagingTambahFm.php";
	//include "?page=kontakkami";
	echo "<meta http-equiv='refresh' content='5; url=media.php?pages=kontak_kami'>";
	//exit;
}
?>
