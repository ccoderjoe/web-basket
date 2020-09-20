<!DOCTYPE html>
<html>
<head>
    <title>Shoes store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="d-flex flex-column align-items-center">
    @if(session()->has('success'))
        <h3 class="alert alert-success">{{ session()->get('success') }}</h3>
    @elseif (session()->has('danger'))
        <h3 class="alert alert-danger">{{ session()->get('danger') }}</h3>
    @endif
    <h2>Welcome to shoes store!</h2>
    <div class="p-2"><img src="https://media.kohlsimg.com/is/image/kohls/shoes-dp-dp-202000908-m-girls?scl=1&fmt=pjpeg"
                          alt="shoes image"></div>

    <h3 class="pt-4"><a href="{{ route('basket') }}">Shopping basket</a></h3>
</div>

<div class="d-flex flex-row justify-content-around pt-5">
    @foreach ($products as $product)
        <div class="card" style="width: 18rem;">
            <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body pt-4">
                <h5 class="card-text text-center"> {{ $product->description }}</h5>
                <h3 class="card-text text-center"> Only {{ $product->price}} $</h3>
                <div class="p-1 text-center">
                    <form action="{{ route('basket-add', $product->id ) }}" method="post">
                        <button type="submit" class="btn-success" role="button">Add to cart</button>
                        @csrf
                    </form>

                </div>
            </div>

        </div>
@endforeach


</body>
</html>
