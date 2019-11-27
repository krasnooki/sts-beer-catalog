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

class BeerListController //extends FOSRestController
{
	private $DBService;
	
	public function __construct(DBService $DBService)
	{
		$this->DBService = $DBService;
	}
	
	/**
	* @Route("/beers")
	* @Method("GET")
	*/
	public function getBeersList()
	{
		$beerList = $this->DBService->getBeersList();
		
		$data = array();
		
		foreach($beerList as $beerElement){
			$data[] = $this->setBeerArrayEmelent($beerElement);
		}			
		
		return new JsonResponse($data);
	}
	
	/**
	* @Route("/beers/{id}")	
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