<?php
/*
	need install tidy first, because too many invalid html
*/
require("simple_html_dom.php");

function leechData($link) {

	$html = file_get_contents($link);

	$config = array(
	   'indent'         => true,
	   'output-xhtml'   => true,
	   'wrap'           => 200);

	$tidy = new tidy;
	$tidy->parseString($html, $config, 'utf8');
	$tidy->cleanRepair();

	$html = str_get_html($tidy);
	$soal = array();
	foreach($html->find('div[class^="soal_ujian page"]') as $e)
	{
		$temp= array('pertanyaan'=>'', 'jawaban'=>array(), 'kunci'=>'');
		foreach($e->find('div[class="pertanyaan"]') as $f)
		{
			$temp['pertanyaan'] = preg_replace('/\s+/', ' ',strip_tags($f->innertext));
		}

		foreach($e->find('table') as $f)
		{
			$a=0;
			foreach($f->find('tr') as $g)
			{
				if($a!=0) {
					$temp['jawaban'][] = str_replace('&nbsp;','', trim($g->find('td',1)->innertext()));
					if( $g->find('td',0)->find('div',0)->find('input',0)->getAttribute('value')==1) $temp['kunci']=$a;

				}
				$a++;
			}
		}
		$soal[] = $temp;
	}
	return $soal;
}
?>
