<?php


namespace Model;

class Calculator
{
    private $planPriceReader;
    private $pricesData;
    
    public function __construct()
    {
        $this->planPriceReader = new PlansAndPrices();
        $this->pricesData = $this->planPriceReader->getPricesData();
    }

    public function calculatePlanPrice($selectedPlan, $beneficiaries)
    {
        $plansData = $this->planPriceReader->getPlansData();
        $plan = null;
        foreach ($plansData as $planData) {
            if ($planData['codigo'] == $selectedPlan) {
                $plan = $planData;
                break;
            }
        }

        if (!$plan) {
            throw new \Exception("Plano selecionado não encontrado.");
        }

        $totalPrice = 0;
        foreach ($beneficiaries as $beneficiary) {
            $age = $beneficiary['age'];
            $price = $this->getPriceForAge($plan['codigo'], $age);
            $totalPrice += $price;
        }

        return $totalPrice;
    }

    public function getPriceForAge($planCode, $age)
    {
        foreach ($this->pricesData as $priceData) {
         
            if ($priceData['codigo'] == $planCode) {
                if ($age <= 17) {
                    return $priceData['faixa1'];
                } elseif ($age >= 18 && $age <= 40) {
                    return $priceData['faixa2'];
                } else {
                    return $priceData['faixa3'];
                }
            }
        }

        throw new \Exception("Dados de preço para o plano e/ou idade não encontrados.");
    }
}