<?php
// src/Service/BeerListImportService;.php

namespace App\Service;

class BeerListImportService
{	
	private $data = [];
	
	public function __construct()
	{		
        $this->getOntarioBeerApi();
	}

	private function getOntarioBeerApi()
	{
		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_URL, 'http://www.ontariobeerapi.ca/beers/');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($curl);		
		$this->data = json_decode($response);
	}
		
	public function getBeersList()
	{
		return $this->data;
	}	
		
	public function getBeerByProductId($id)
	{
		$breverlist = array_filter(
			$this->data,
			function ($data) use (&$id){
				return $data->product_id == $id;
			}
		);
		
		return reset($breverlist);
	}
	
	public function getBrewersList()
	{
		$brewers = array_map(function($data){
			return $data->brewer;
		}, $this->data);
		
		$uniqueBrewers = array_unique($brewers);
		
		return array_values(array_intersect_key($this->data, $uniqueBrewers));
	}
	
	public function getSizesList()
	{
		$brewers = array_map(function($data){
			return $data->size;
		}, $this->data);
		
		$uniqueBrewers = array_unique($brewers);
		
		return array_values(array_intersect_key($this->data, $uniqueBrewers));
	}
}
?>