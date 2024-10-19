
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@foreach ($products as $product)
    <div>
        <h2>{{ $product->name }}</h2>
        <p>Цена: {{ $product->price }}</p>
        <form action="/add-to-cart" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Добавить в корзину</button>
        </form>
    </div>
@endforeach
