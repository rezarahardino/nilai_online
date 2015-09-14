<?php
function hari()
{
$hari2=date("w");
Switch ($hari2){
case 0 : $hari="Minggu";
Break;
case 1 : $hari="Senin";
Break;
case 2 : $hari="Selasa";
Break;
case 3 : $hari="Rabu";
Break;
case 4 : $hari="Kamis";
Break;
case 5 : $hari="Jumat";
Break;
case 6 : $hari="Sabtu";
Break;
}
return $hari;
}