<?php

namespace Controller;

use Model\Calculator;

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    $className = end($parts);
    require_once __DIR__ . '../model/' . $className . '.php';
});
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $beneficiaries = $_POST['beneficiaries'] ?? [];
        $selectedPlan = $_POST['selected_plan'] ?? '';
        
        if (empty($beneficiaries) || empty($selectedPlan)) {
            throw new \Exception("Dados inválidos. Verifique se todos os campos foram preenchidos.");
        }
        $planPriceCalculator = new Calculator();
        $totalPrice = $planPriceCalculator->calculatePlanPrice($selectedPlan, $beneficiaries);

        $individualPrices = [];
        foreach ($beneficiaries as $beneficiary) {
            $age = $beneficiary['age'];
            $encryptedAge = base64_encode($age);
            $price = $planPriceCalculator->getPriceForAge($selectedPlan, $age);
            $individualPrices[] = ['name' => $beneficiary['name'], 'age' => $encryptedAge, 'price' => $price];
        }

        $response = [
            'individual_prices' => $individualPrices,
            'total_price' => $totalPrice,
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (\Exception $e) {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    header('Content-Type: application/json', true, 405);
    echo json_encode(['error' => 'Método não permitido. Utilize o método POST.']);
}
