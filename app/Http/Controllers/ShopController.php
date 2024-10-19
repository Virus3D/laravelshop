<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller {
    public function index() {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    public function addToCart(Request $request) {
        // Получаем текущее количество товаров в сессии
        $cart = session()->get('cart', []);

        // Получаем ID товара и количество из запроса
        $productId = $request->product_id;
        $quantity = $request->input('quantity', 1); // По умолчанию 1

        // Если товар уже в корзине, увеличиваем его количество, в противном случае добавляем его в корзину
        (isset($cart[$productId])) ? $cart[$productId] += $quantity : $cart[$productId] = $quantity;

        // Сохраняем корзину в сессию
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Товар добавлен в корзину.');
    }

    public function checkout() {
        $cart = session('cart', []);
        $products = Product::find(array_keys($cart)); // Получаем товары по ключам

        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id]; // Учитываем количество
        }

        return view('shop.checkout', compact('products', 'total', 'cart'));
    }
}
