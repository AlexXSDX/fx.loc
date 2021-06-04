<?php

namespace App\Services\UpdateForex;

use Carbon\Carbon;
use App\Models\Currency;

class UpdateForex implements I_UpdateForex
{
	public function execute(array $forexData)
	{
		foreach ($forexData as  $forexName => $data) {
			foreach ($data as $date => $rate) {
				$date 	= Carbon::createFromFormat("d.m.Y", $date)->format("Y-m-d");
				$rate   = str_replace (",", ".", $rate);
				$update = Currency::firstOrCreate(
		            [
		             "name" => $forexName,
		             "date" => $date
		            ],
		            [
		                "rate" => $rate
		            ]
	        	);
			}
		}

		return $update;
	}
}