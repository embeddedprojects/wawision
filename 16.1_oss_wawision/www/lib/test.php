<?php

include "fpdf/class.rechnung.php";

$tmp = new PDFRechnung();



//$tmp->SetEnd("Wir haben vom 20.08.2009 bis 31.08.2009 Betriebsferien!");

$tmp->Output();


?>
