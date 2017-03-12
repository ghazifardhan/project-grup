<?php
/*
	need install tidy first, because too many invalid html
*/

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
	if(!empty($html))
	{
		foreach($html->find('div[class^="soal_ujian page"]') as $e)
		{
			$temp= array('pertanyaan'=>'', 'jawaban'=>array(), 'kunci'=>'');
			if(!empty($e->find('div[class="pertanyaan"]')))
			{
				foreach($e->find('div[class="pertanyaan"]') as $f)
				{
					$temp['pertanyaan'] = preg_replace('/\s+/', ' ',strip_tags($f->innertext));
				}
			}
			else{
				return "kosong";
			}

			if(!empty($e->find('table')))
			{
				foreach($e->find('table') as $f)
				{
					$a=0;
					foreach($f->find('tr') as $g)
					{
						if($a!=0) {
							$temp['jawaban'][] = str_replace('&nbsp;','', trim($g->find('td',1)->innertext()));
							$dt = !empty($g->find('td',0)->find('div',0)->find('input',0)->getAttribute('value'))? !empty($g->find('td',0)->find('div',0)->find('input',0)->getAttribute('value')) : -1;
							// if( $g->find('td',0)->find('div',0)->find('input',0)->getAttribute('value')==1) $temp['kunci']=$a;
							if( $dt==1) $temp['kunci']=$a;

						}
						$a++;
					}
				}
			}
			else{
				return "kosong";
			}
			$soal[] = $temp;
		}
		return $soal;
	}
	else{
		return "kosong";
	}
}
?>
