<?php
/*
	need install tidy first, because too many invalid html
*/
require("simple_html_dom.php");
$link = "http://tryoutunonline.com/index.php";
$html = file_get_html($link); 

$data = array();
foreach($html->find('div[class="collapse navbar-collapse main-nav"]') as $e) 
{
	foreach($e->find('li') as $f)
	{
		$bidStudi = trim($f->find('a',0)->plaintext);
		//$tab = str_replace("#","",$f->find('a',0)->href);echo $tab;
		$tab = $f->find('a',0)->href;
		foreach($html->find($tab) as $e)
		{
			foreach($e->find('div[class="col-md-3"]') as $f)
			{
				$kelas = $f->find('h3[class="box-title"]', 0)->innertext;
				foreach($f->find('a') as $g)
				{
					$judul = $g->innertext;
					$url = $g->href;
					$data[] = array(
						"kelas"=> $kelas,
						"bidstudi"=> $bidStudi,
						"judul"=> $judul,
						"url"=> "http://tryoutunonline.com/".$url,
					);
				}
			}
		}
	}
}

   print_r($data);
?>
