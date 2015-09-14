<?php
include "config/koneksi.php";
// kontrol andmin
if ($_SESSION[status]=='Admin'){
	
/*	echo "<li><a href='?module=dataguru'><b>Data Guru</b></a></li>";
	echo "<li><a href='?module=datasiswa'><b>Data Siswa</b></a></li>";
    echo "<li><a href='?module=password'><b>Ganti Password</b></a></li>";
	echo "<li><a href='?module=modul'><b>Edit Modul Admin</b></a></li>";
	*/?>
	
    <a href="#"><center>Data Umum</center></a> 
    <br>
    <li>
			<a href="media.php">Home</a></li>
			<li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=user"  class="tabelisi">User</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=siswa" class="tabelisi">Data Siswa</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=guru" class="tabelisi">Data Guru</a></li>
            <li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=mata_pelajaran" class="comlabs-has-submenu menu-top">Data Mata Pelajaran</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=jadwal_pelajaran" class="comlabs-has-submenu menu-top">Jadwal Pelajaran</a></li>
            <li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=tahun_ajaran" class="comlabs-has-submenu menu-top">Tahun Ajaran</a></li>
            <li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=kelas" class="comlabs-has-submenu menu-top">Kelas</a></li>
			<li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=view_kontak" class="tabelisi">Kontak Kami</a></li>
            <li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=informasi" class="tabelisi">Informasi</a></li>
         </br>
         <br>
         <a href="#"><center>Rapor</center></a> 
         <br>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=nilai" class="tabelisi">Nilai</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=kepribadian" class="tabelisi">Nilai Kepribadian</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=pengembangan" class="tabelisi">Nilai Pengembangan Diri</a></li>
             <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=kompetensi" class="tabelisi">Nilai Kompetensi</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=ketidakhadiran" class="tabelisi">Nilai Ketidakhadiran</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=catatanprestasi" class="tabelisi">Nilai Catatan Prestasi</a></li>
			</br>
            <br>
            <a href="#"><center>Nilai Harian</center></a> 
            </br>
            <br>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=nilai_harian" class="tabelisi">Nilai Harian</a></li>
            </br>
            <br>
            <a href="#"><center>Laporan</center></a> 
            <br>
            </br>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=cetak_rapor" class="tabelisi">Cetak Rapor</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=cetak_ledger" class="tabelisi">Cetak Ledger</a></li>
             <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=cetak_pengambilan" class="tabelisi">Cetak Pengambilan Rapor</a></li>
           <br>
            </br>

            
<?php    
  
}
if ($_SESSION[status]=='Siswa'){
  ?>
  
   <a href="#"><center>Data Umum</center></a> 
   <br>
            <li>
			<a href="media.php">Home</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=jadwal_pelajaran" class="comlabs-has-submenu menu-top">Jadwal Pelajaran</a></li></br>
             <li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=informasi" class="tabelisi">Informasi</a></li>
            <br>
            <a href="#"><center>Rapor</center></a> 
            </br>
            <br>
			<li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=nilai" class="tabelisi">Nilai</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=kepribadian" class="tabelisi">Nilai Kepribadian</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=pengembangan" class="tabelisi">Nilai Pengembangan Diri</a></li>
             <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=kompetensi" class="tabelisi">Nilai Kompetensi</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=ketidakhadiran" class="tabelisi">Nilai Ketidakhadiran</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=catatanprestasi" class="tabelisi">Nilai Catatan Prestasi</a></li>
            </br>
            <br>
            <a href="#"><center>Nilai Harian</center></a> 
            </br>
            <br>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=nilai_harian" class="tabelisi">Nilai Harian</a></li>
            </br>
            <br>
            <a href="#"><center>Laporan</center></a> 
            </br>
            <br><li class="comlabs-has-submenu menu-top">
            <a href="media.php?pages=cetak_rapor" class="tabelisi">Cetak Rapor</a></li>
            </br>
            <br>
<?php } ?>
<?php 
if ($_SESSION[status]=='Guru'){
  ?>
  
   <a href="#"><center>Data Umum</center></a> 
   		<br>
        	<li>
			<a href="media.php">Home</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=siswa" class="tabelisi">Data Siswa</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=guru" class="tabelisi">Data Guru</a></li>
			<li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=mata_pelajaran" class="comlabs-has-submenu menu-top">Data Mata Pelajaran</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=jadwal_pelajaran" class="comlabs-has-submenu menu-top">Jadwal Pelajaran</a></li>
            <li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=kelas" class="comlabs-has-submenu menu-top">Kelas</a></li>
        <li class="comlabs-has-submenu menu-top">
          	<a href="media.php?pages=informasi" class="tabelisi">Informasi</a></li>
         </br>
         <br>
         <a href="#"><center>Rapor</center></a> 
            </br>
            <br>
			<li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=nilai" class="tabelisi">Nilai</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=kepribadian" class="tabelisi">Nilai Kepribadian</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=pengembangan" class="tabelisi">Nilai Pengembangan Diri</a></li>
             <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=kompetensi" class="tabelisi">Nilai Kompetensi</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=ketidakhadiran" class="tabelisi">Nilai Ketidakhadiran</a></li>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=catatanprestasi" class="tabelisi">Nilai Catatan Prestasi</a></li>
            </br>
            <br>
            <a href="#"><center>Nilai Harian</center></a> 
            </br>
            <br>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=nilai_harian" class="tabelisi">Nilai Harian</a></li>
			</br>
            <br>
            <a href="#"><center>Laporan</center></a> 
            </br>
            <br>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=cetak_rapor" class="tabelisi">Cetak Rapor</a></li>
            <?php if(isset($_SESSION[wali_kelas])):?>
            <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=cetak_ledger" class="tabelisi">Cetak Ledger</a></li>
             <li class="comlabs-has-submenu menu-top">
			<a href="media.php?pages=cetak_pengambilan" class="tabelisi">Cetak Pengambilan Rapor</a></li>
            </br>
            <br>
			<?php endif;?>

  <?php

}
?>
