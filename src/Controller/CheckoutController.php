<?php

namespace App\Controller;

use App\Service\Checkout;

class CheckoutController extends AbstractController
{
    public const CART_EXAMPLE = [
        ['numberCupcake' => 4, 'unitPrice' => 5.5],
        ['numberCupcake' => 3, 'unitPrice' => 2.5],
        ['numberCupcake' => 2, 'unitPrice' => 1.5],
    ];
    public function index(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cart'])) {
            $cart = array_filter($_POST['cart'], fn($cartItem) =>
                $cartItem['numberCupcake'] > 0 && $cartItem['unitPrice'] > 0);
        } else {
            $cart = self::CART_EXAMPLE;
        }
        $checkout = new Checkout();
        $bill = method_exists($checkout, 'calculate') ? $checkout->calculate($cart) : [0, 0];
        return $this->twig->render('Checkout/index.html.twig', [
            'cart' => $cart,
            'bill' => $bill
        ]);
    }
}
