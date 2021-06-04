<?php

namespace App\Services\GetForex;

use GuzzleHttp\Client;

class GetForexFromCb implements I_GetForex
{
	const CRB_API_URL 	= "http://www.cbr.ru/scripts/XML_dynamic.asp";
	const START_DATE 	= "01/01/1999";

	protected $today;

	protected $forexName;
	protected $client;

	protected $result = [];

	public function __construct(Client $client, array $forexNames = ["usd", "eur"])
	{
		$this->today 		= date("d/m/Y");

		$this->client 		= $client;
		$this->forexNames 	= $forexNames;
	}

	/**
	 * Get rates from CRB Api
	 * @return array
	 */
	public function execute() : array
	{
		if (empty($this->forexNames))
			throw new \Exception("EmptyForexData");

		foreach ($this->forexNames as $fxName) {

			if (!array_key_exists($fxName, $this->CodeLib()))
				continue;

			$crbResponse 	= $this->getCrbResponse($fxName);
			libxml_use_internal_errors(true);
			$xml = simplexml_load_string($crbResponse);
			if (false === $xml)
				throw new \Exception("Error XML from API response");

			foreach ($xml as $worker)
				$this->result[$fxName][(string)$worker["Date"]] = (string)$worker->Value;
		}

		return $this->result;
	}

	/**
	 * Library of CRB currency codes
	 * @return array
	 */
	protected function codeLib() : array
	{
		return [
			"usd" => "R01235",
			"eur" => "R01239"
		];
	}

	/**
	 * Access to CRB Api
	 * @param  string $forexName
	 * @return string
	 */
	protected function getCrbResponse(string $forexName) : string
	{
		$code 			= $this->codeLib()[$forexName];
		$request 		= $this->client->request("GET", self::CRB_API_URL,
			["query" => [
				"date_req1"	=> self::START_DATE,
				"date_req2"	=> $this->today,
				"VAL_NM_RQ"	=> $code
			]]
		);
		$crbResponse	= $request->getBody()->getContents();

		return $crbResponse;
	}
}