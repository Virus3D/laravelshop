<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function index() {
        $orders = Order::all();
        $total = $orders->sum('total');
        return view('shop.orders', compact('orders', 'total'));
    }

    public function placeOrder(Request $request) {
        // Получаем корзину из сессии
        $cart = session('cart', []);
        $products = Product::find(array_keys($cart));

        // Проверяем наличие товаров
        if ($products->isEmpty()) {
            return redirect()->back()->with('error', 'Корзина пуста.');
        }

        $total = 0;
        $productList = []; // Это будет массив для хранения наименований товаров

        // Перебираем корзину и подсчитываем общую стоимость заказа
        foreach ($products as $product) {
            $quantity = $cart[$product->id]; // Получаем количество товара из корзины
            $productList[] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $product->price * $quantity // Подсчёт стоимости для данного товара
            ];
            $total += $product->price * $quantity; // Учитываем общую стоимость
        }

        // Создаем заказ
        $order = Order::create([
            'products' => json_encode($productList), // Сохраняем список товаров
            'total' => $total, // Сохраняем общую стоимость
        ]);

        // Очищаем корзину
        session()->forget('cart');

        return redirect()->back()->with('success', 'Заказ успешно оформлен. Номер заказа: ' . $order->id);
    }

    public function delete($id) {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Заказ не найден.');
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Заказ успешно удалён.');
    }
}
