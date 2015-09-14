<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $nis = $_POST[nis];
   $id_kepribadian= $_POST[id_kepribadian];
   $jenis_nilai = $_POST[jenis_nilai];
   $semester = $_POST[semester];
   $kedisiplinan = $_POST[kedisiplinan];
   $kebersihan = $_POST[kebersihan];
   $kesehatan = $_POST[kesehatan];
   $tanggung_jawab = $_POST[tanggung_jawab];
   $sopan_santun = $_POST[sopan_santun];
   $percaya_diri = $_POST[percaya_diri];
   $kompetetif = $_POST[kompetetif];
   $hubungan_sosial = $_POST[hubungan_sosial];
   $kejujuran = $_POST[kejujuran];
   $pelaksanaan_ibadah = $_POST[pelaksanaan_ibadah];
   
   $Kode_Mp = $_POST[Kode_Mp];
   $kid = $_GET['kid'];
   $status = $_POST[status];
   $id_kelas = $_POST[id_kelas];
   $tahun = $_POST[tahun];
   switch ($mod)
   {
   		
   		case "tambah"	: 
		
			 mysql_query("insert into kepribadian 
										values('','$nis','$semester','$id_kelas','$tahun','$Kode_Mp','$kedisiplinan', '$kebersihan', '$kesehatan', '$tanggung_jawab', '$sopan_santun', '$percaya_diri','$kompetetif', '$hubungan_sosial','$kejujuran', '$pelaksanaan_ibadah')")or die(mysql_error());
													
	 		header("location:media.php?pages=kepribadian&nis=$nis");
		break;
		case "ubah"		: 
		
			mysql_query("Update kepribadian 
										SET Kode_Mp = '$Kode_Mp',semester = '$semester', kedisiplinan = '$kedisiplinan',kebersihan='$kebersihan', kesehatan = '$kesehatan', tanggung_jawab = '$tanggung_jawab', sopan_santun='$sopan_santun', percaya_diri='$percaya_diri',kompetetif='$kompetetif', hubungan_sosial='$hubungan_sosial',kejujuran='$kejujuran', pelaksanaan_ibadah='$pelaksanaan_ibadah'
										WHERE id_kepribadian = '$id_kepribadian'") or die (mysql_error());
			
		
						  header("location:media.php?pages=kepribadian&nis=$nis");
						  break;
		case "hapus"	: mysql_query("delete from kepribadian where id_kepribadian = '$kid'");
						  header("location:media.php?pages=kepribadian&nis=$nis");
						  break;
		 
   }
?>