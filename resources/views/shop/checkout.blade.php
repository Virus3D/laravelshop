<h2>Корзина</h2>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@foreach ($products as $product)
    <p>{{ $product->name }} - {{ $product->price }} x {{ $cart[$product->id] }} = {{ $product->price * $cart[$product->id] }}</p>
@endforeach
<h3>Итого: {{ $total }}</h3>
<form action="/place-order" method="POST">
    @csrf
    <button type="submit">Оформить заказ</button>
</form>
