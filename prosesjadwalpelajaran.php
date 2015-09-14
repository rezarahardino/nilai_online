<?
   include "config/koneksi.php";   
   $mod = $_GET[mod];
   $ID_Kelas= $_POST[ID_Kelas];
   $hari = $_POST[hari];
   $id_guru = $_POST[id_guru];
   $jam = $_POST[jam];
   $Nama_MP = $_POST[Nama_MP];
   $kid = $_GET['kid'];
   $ID_Jadwal = $_POST[ID_Jadwal];
   $semester=$_POST[semester];
   $tahun = $_POST[tahun];
   if($hari=="Senin"){
		$urut=1;
   }elseif($hari=="Selasa"){
		$urut=2;
   }elseif($hari=="Rabu"){
		$urut=3;
   
   }elseif($hari=="Kamis"){
		$urut=4;
	}elseif($hari=="Jumat"){
		$urut=5;
	}elseif($hari=="Sabtu"){
		$urut=6;
	}
   switch ($mod)
   {
   		
   		case "tambah"	: 
		
		$jadwal = mysql_query("select * from tjadwalpelajaran where ID_Kelas='$ID_Kelas' AND  HARI='$hari' and Jam_Pelajaran='$jam' and semester='$semester' AND id_tahun_ajaran='$tahun'")or die(mysql_error());
		$cek = mysql_fetch_array($jadwal);
		
		$jadwal2 = mysql_query("select * from tjadwalpelajaran where Kode_Mp='$Nama_MP' AND  HARI='$hari' and Jam_Pelajaran='$jam' and semester='$semester' AND id_tahun_ajaran='$tahun'")or die(mysql_error());
		$cek2 = mysql_fetch_array($jadwal2);
		
		if(empty($cek)&& empty($cek2)){
		//var_dump("select * from tjadwalpelajaran where Kode_Mp='$Nama_MP' and HARI='$hari' and Jam_Pelajaran='$jam'");exit;
	
		mysql_query("insert into tjadwalpelajaran 
										values('','$ID_Kelas','$Nama_MP','$id_guru','$hari','$jam','$semester','$tahun', '$urut')")or die(mysql_error());
													
	 		header("location:media.php?pages=jadwal_pelajaran");
		}else{
			//header("location:media.php?pages=jadwal_pelajaran&action=tambah&pesan=1");
			echo "<script language='javascript'>alert('Jadwal Yang Anda Inputkan Sudah Ada' ); window.location.href='media.php?pages=jadwal_pelajaran&action=tambah';</script>";exit;
		}
		break;
		case "ubah"		: 
		  //move_uploaded_file($lokasi,"image/foto/$photo");
  		  mysql_query("Update tjadwalpelajaran 
										SET ID_Kelas = '$ID_Kelas',Kode_Mp='$Nama_MP',HARI= '$hari', Jam_Pelajaran='$jam', id_tahun_ajaran='$tahun', urut='$urut' WHERE  ID_Jadwal = '$ID_Jadwal'") or die (mysql_error());
						  header("location:media.php?pages=jadwal_pelajaran");
						  break;
		case "hapus"	: mysql_query("delete from tjadwalpelajaran where ID_Jadwal = '$kid'");
						  header("location:media.php?pages=jadwal_pelajaran");
						  break;
						  
		
   }
 
?>