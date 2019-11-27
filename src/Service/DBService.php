<?php
// src/Service/DBService;.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\BeerEntity;
use App\Entity\BrewerEntity;

use Doctrine\ORM\Tools\Pagination\Paginator;

class DBService
{
	private $entityManager;
	
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}
	
	public function getBeersList() : array
	{
		$data = $this->entityManager
			->getRepository(BeerEntity::class)
			->findAll();
		/*
		$data = $this->entityManager
        	->getRepository(BeerEntity::class)
			->createQueryBuilder('beers')
			->select(array('b'))
			->from('App\Entity\BeerEntity', 'b')
			->where('b.type = :type')
			->setParameter('type', 'Ale')
			->setMaxResults(20)
			->setFirstResult(0)
			->getQuery()
			->getResult();
		*/
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
		$data = $this->entityManager
        	->getRepository(BrewerEntity::class)
			->findAll();
		
		return $data;	
	}
}
?>