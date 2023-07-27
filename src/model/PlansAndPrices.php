<?php

namespace Model;

class PlansAndPrices
{
    private $plansData;
    private $pricesData;

    public function __construct()
    {
        $this->loadPlansData();
        $this->loadPricesData();
    }

    private function loadPlansData()
    {
        $plansJson = file_get_contents(__DIR__ . "/../resources/plans.json");
        $this->plansData = json_decode($plansJson, true);
    }

    private function loadPricesData()
    {
        $pricesJson = file_get_contents(__DIR__ . "/../resources/prices.json");
        $this->pricesData = json_decode($pricesJson, true);
    }

    public function getPlansData()
    {
        return $this->plansData;
    }

    public function getPricesData()
    {
        return $this->pricesData;
    }
}
