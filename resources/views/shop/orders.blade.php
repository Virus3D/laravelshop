<h2>Ваши заказы</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@foreach ($orders as $order)
    <div class="order">
        <h3>Заказ #{{ $order->id }}</h3>
        <p>Дата заказа: {{ $order->created_at }}</p>
        <p>Общая сумма: {{ $order->total }}</p>
        <p>Товары:</p>
        <ul>
            @foreach (json_decode($order->products) as $product)
                <li>{{ $product->name }} - Количество: {{ $product->quantity }} - Цена: {{ $product->price }}</li>
            @endforeach
        </ul>
        <form action="{{ route('orders.delete', $order->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот заказ?');">Удалить заказ</button>
        </form>
    </div>
@endforeach
<h3>Итоговая стоимость всех заказов: {{ $total }}</h3>
