<?php
// src/Controller/BeerList.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Service\DBService;
use App\Entity\BeerEntity;
use App\Entity\BrewerEntity;
use App\Helper\BeersListInput;

class BeerListController //extends FOSRestController
{
	private $DBService;
	
	public function __construct(DBService $DBService)
	{
		$this->DBService = $DBService;
	}
	
	/**
	* @Route("
		/beers/brewer/{brewer<\d+>?0}/name/{name<.*>?}/countrycode/{countrycode<.*>?}/type/{type<.*>?}/pricefrom/{pricefrom<\d*\.\d{0,2}>?0}/priceto/{priceto<\d+\.\d{0,2}>?0.0}/page/{page<\d+>?1}")
	* @Method("GET")
	*/
	public function getBeersList($brewer, $name, $countrycode, $type, $pricefrom, $priceto, $page) 
	{					
		$input = new BeersListInput();
				
		$input->name = $name;
		$input->priceFrom = $pricefrom;
		$input->priceTo = $priceto;
		$input->countrycode = $countrycode;
		$input->type = $type;
		$input->brewer = $brewer;
		$input->page = $page;
		
		$beerList = $this->DBService->getBeersList($input);
		
		$data = array();
		
		foreach($beerList as $beerElement){
			$data[] = $this->setBeerArrayEmelent($beerElement);
		}			
		
		return new JsonResponse($data);
	}
	
	/**
	* @Route("/beers")
	* @Method("GET")
	*/
	public function getBeersListAll()
	{
		$beerList = $this->DBService->getBeersList(new BeersListInput());
		
		$data = array();
		
		foreach($beerList as $beerElement){
			$data[] = $this->setBeerArrayEmelent($beerElement);
		}			
		
		return new JsonResponse($data);
	}

	/**
	* @Route("/beers/{id<\d+>}")	
	* @Method("GET")
	* @param $id
	*/
	public function getBeer(int $id) 
	{		
		$beer = $this->DBService->getBeer($id);
				
		$data = $this->setBeerArrayEmelent($beer);
		
		return new JsonResponse($data);
	}
	
	/**
	* @Route("/brewers/")	
	* @Method("GET")
	*/
	public function getBrewersList() 
	{		
		$brewerList = $this->DBService->getBrewersList();
				
		$data = array();
		
		foreach($brewerList as $brewerElement){
			$data[] = $this->setBrewerArrayEmelent($brewerElement);
		}			
				
		return new JsonResponse($data);
	}
	
	
	private function setBeerArrayEmelent(BeerEntity $element) : array
	{
		$data = [
				'id' => $element->getId(),
				'name' => $element->getName(),
				"country_code" => $element->getCountryCode(),
				"type" => $element->getType(),
				"price_per_litre" => $element->getPricePerLitre(),
				"brewer_id" => $element->getBrewer()->getId(),
				"brewer" => $element->getBrewer()->getName(),
				"image_url" => $element->getImageUrl()
			];
		
		return $data;
	}
	private function setBrewerArrayEmelent(BrewerEntity $element) : array
	{
		$data = [
			'id' => $element->getId(),
			'name' => $element->getName()
		];
		
		return $data;
	}
}
?>