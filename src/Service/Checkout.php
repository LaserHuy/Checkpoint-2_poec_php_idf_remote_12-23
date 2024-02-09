<?php

namespace App\Service;

class Checkout
{
    /**
     * @param array $cart
     * multidimensional array of associative array
     * containing the indexes ['numberCupcake'] and ['unitPrice']
     * @return array
     * containing the total price at the first index,
     * and the total price minus the discount applied (50-cent) for every three cupcakes purchased at the second index
     * ⬇️ create the calculate() method here ⬇️
     */
    public function calculate(array $cart): array
    {
        $totalPrice = 0;
        $totalCupcakes = 0;
        $finalPrice = 0;
        foreach ($cart as $item) {
            $totalCupcakes += $item['numberCupcake'];
            $totalPrice += $item['numberCupcake'] * $item['unitPrice'];
        }
        $discountCupcakes = floor($totalCupcakes / 3);
        $discountAmount = $discountCupcakes * 0.5; // 50 cents discount per cupcake
        $finalPrice = $totalPrice - $discountAmount;
        return [$totalPrice, $finalPrice];
    }
}
