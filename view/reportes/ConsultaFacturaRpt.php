<?php

include dirname(__FILE__).'\..\..\view\mpdf\mpdf.php';
 
//echo getcwd().''; //para ver ubicacion de directorio

$template = file_get_contents('view/reportes/template/ConsultaFacturaFinal.html');


$footer = file_get_contents('view/reportes/template/pieficha.html');



if(!empty($datos_reporte))
{
	
    foreach ($datos_reporte as $clave=>$valor) {
        echo $clave; echo "\n";
		$template = str_replace('{'.$clave.'}', $valor, $template);
	}
}

ob_end_clean();
//creacion del pdf
//$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0);
if ($_nombre_archivo == "")
{
	$mpdf=new mPDF();
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->allow_charset_conversion = true;
	$mpdf->charset_in = 'UTF-8';
	$mpdf->setAutoTopMargin = 'stretch';
	$mpdf->setAutoBottomMargin = 'stretch';
	$mpdf->SetHTMLFooter($footer);
	$mpdf->WriteHTML($template);
	$mpdf->debug = true;
	$mpdf->Output();
	
}
else 
{
	$mpdf=new mPDF();
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->allow_charset_conversion = true;
	$mpdf->charset_in = 'UTF-8';
	$mpdf->setAutoTopMargin = 'stretch';
	$mpdf->setAutoBottomMargin = 'stretch';
	$mpdf->SetHTMLFooter($footer);
	$mpdf->WriteHTML($template);
	$mpdf->debug = true;
	$mpdf->Output($_nombre_archivo );
	return ;
	
}


/*$content = $mpdf->Output('', 'S'); // Saving pdf to attach to email
$content = chunk_split(base64_encode($content));
$content = 'data:application/pdf;base64,'.$content;
print_r($content);*/
exit();
?>