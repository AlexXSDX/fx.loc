<?php

namespace App\Services\ForexFacade;

use App\Services\GetForex\I_GetForex;
use App\Services\UpdateForex\I_UpdateForex;

class ForexFacade implements I_ForexFacade
{
	protected $getForex;
	protected $updateForex;

	public function __construct(I_GetForex $getForex, I_UpdateForex $updateForex)
	{
		$this->getForex 	= $getForex;
		$this->updateForex 	= $updateForex;
	}

	public function execute() : bool
	{
		$forexData = $this->getForex->execute();

		if (empty($forexData))
			throw new \Exception("Empty data from Resource");

		$update = $this->updateForex->execute($forexData);

		return ($update) ? true : false;
	}
}