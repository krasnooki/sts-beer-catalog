<?php
// src/Service/beersListInput.php

namespace App\Helper;

class BeersListInput
{
	public $id = 0;
	public $name = '';
	public $priceFrom = '0.00';
	public $priceTo = '0.00';
	public $countrycode = '';
	public $type = '';
	public $brewer = 0;
	public $page = 1;
	public $limit = 20;
}
?>