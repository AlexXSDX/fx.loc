<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($message = $this->checkErrors($request)) {
            return [
                "status"    => false,
                "message"   => $message
            ];
        }

        return [
            "status"    => true,
            "name"      => $this->name,
            "date"      => $this->date,
            "rate"      => $this->rate
        ];
    }

    /**
     * Checks if a date is in the past
     * @param  string $requestDate
     * @return boolean
     */
    protected function checkDate(string $requestDate) : bool
    {
        $nowTime        = time();
        $requestTime    = strToTime($requestDate);

        return ($requestTime < $nowTime);
    }

    /**
     * Returns a description of the error
     * @param  $request
     * @return string
     */
    protected function checkErrors($request) : string
    {
        if (!$this->checkDate($request->date))
            return "Bad date";

        if (!$this->resource)
            return "No rate";


        return "";
    }
}
