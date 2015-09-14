<?php 
session_start() ?>
<?php include "config/koneksi.php";

include "html2pdf/html2fpdf_helper.php"; 
$pdf=new HTML2FPDF();
			$pdf->AddPage();
			$htmlFile = "http://localhost/capruk/nilai_online_wahyu/print.php";
			$buffer = file_get_contents($htmlFile); 
			//$fp = fopen("sample.html","r");
			//$strContent = fread($fp, filesize("sample.html"));
			//fclose($fp);
			$pdf->SetFontSize(18);
			//$pdf->SetFont('Arial','B',12);
			$pdf->WriteHTML($buffer);
			$pdf->Output("nilai.pdf","D");
?>
