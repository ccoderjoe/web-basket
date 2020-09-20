<!DOCTYPE html>
<html>
<head>
    <title>Shoes shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="container-sm">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Model</th>
            <th scope="col">Amount</th>
            <th scope="col">Price</th>
            <th scope="col">Value</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->products as $product)
            <tr>
                <td>
                    <img height="56px" src="{{ $product->image }}">
                </td>
                <td>
                    <h5>{{ $product->code }}</h5>
                </td>
                <td>
                    <span class="badge">{{ $product->pivot->count }}</span>
                    <div class="btn-group">
                        <form action="{{ route('basket-delete', $product) }}" method="POST">
                            <button type="submit" class="btn btn-danger">-</button>
                            @csrf
                        </form>
                        <form action="{{ route('basket-add', $product) }}" method="POST">
                            <button type="submit" class="btn btn-success">+</button>
                            @csrf
                        </form>
                    </div>
                </td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->getPriceForCount() }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4"><h5>Total value:</h5></td>
            <td><h5>{{ $order->getTotalValue() }}</h5></td>
        </tr>
        </tbody>
    </table>
    <div class="float-left m-3">
        <a type="button" class="btn btn-success" href="{{ route('home') }}">Continue shopping</a>
    </div>
    <div class="float-right m-3">
        <a type="button" class="btn btn-success" href="{{ route('basket-checkout') }}">Checkout</a>
    </div>
</div>

</body>
</html>
