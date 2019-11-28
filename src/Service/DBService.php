<?php
// src/Service/DBService.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\BeerEntity;
use App\Entity\BrewerEntity;
use App\Helper\BeersListInput;

use Doctrine\ORM\Tools\Pagination\Paginator;

class DBService
{
	private $entityManager;
	
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}
	
	public function getBeersList(BeersListInput $input) : array
	{
		$qb = $this->entityManager->createQueryBuilder('beers');
		
		$qb			
			->select('beer')
			->from('App\Entity\BeerEntity', 'beer');

		if($input->brewer != 0)
			$qb->andWhere($qb->expr()->eq('beer.brewer', $input->brewer));
		
		if($input->countrycode != '')
			$qb->andWhere($qb->expr()->eq('beer.country_code', $qb->expr()->literal($input->countrycode)));
		
		if($input->type != '')
			$qb->andWhere($qb->expr()->eq('beer.type', $qb->expr()->literal($input->type)));		
				
		if($input->name != '')
			$qb->andWhere($qb->expr()->like('beer.name', $qb->expr()->literal($input->name.'%')));
				
		if($input->priceFrom != '0.00')	
			$qb->andWhere($qb->expr()->gte('beer.price_per_litre', $input->priceFrom));
			
		if($input->priceTo != '0.00')
			$qb->andWhere($qb->expr()->lte('beer.price_per_litre', $input->priceTo));

		$qb	
			->orderby('beer.id', 'ASC')
			->setMaxResults($input->limit)
			->setFirstResult(($input->page - 1) * $input->limit)
			;

		$data = $qb
			->getQuery()
			->getResult()
			;
		
		
		//var_dump($qb->getDql());

		//$paginator = new Paginator($data, $fetchJoinCollection = true);		
		//$c = count($paginator);

		return $data;
	}
	
	public function getBeer(int $id) : object
	{		
		$data = $this->entityManager
			->getRepository(BeerEntity::class)
			->findOneById($id);
		
		return $data;
	}
	
	public function getBrewersList() : array
	{
		$id = 1;
		$name = 'tysk';
		$number = 5;
		
		$data = $this->entityManager
        	->getRepository(BrewerEntity::class)
			->findAll();
		
		return $data;	
	}
}
?>