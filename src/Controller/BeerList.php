<?php
// src/Controller/BeerList.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\BeerListImportService;

class BeerList
{
	private $beerListService;
	
	public function __construct(BeerListImportService $beerListService)
	{
		$this->beerListService = $beerListService;	
	}
	
	/**
	* @Route("/beerlist/{product_id}")
	*/
	public function getBeerList($product_id)
	{
		//$name = $this->beerListService->getBeerByProductId($product_id);
		
		$j = json_encode($this->beerListService->getBreversList());
		
		return new response('
		<html>
			<body>
				<h1>BeerList: </h1><h4>DATA:</h4><pre>'.$j.'</pre>
			</body>
		</html>');
	}
	
	private function v($var){
		$str = '<pre style="background-color:#00a;color:#fff;position:absolute;top:0px;left:0px;width:100%;">';
			
		foreach($var as $elem)
			$str += $elem;
			
		$str += "</pre>";
		
		return $str;			
	}
}
?>