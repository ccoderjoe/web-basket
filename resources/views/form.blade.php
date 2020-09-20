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
    <h4 class="p-2">Please enter your credentials to continue</h4>
    <form action="{{ route('basket-confirm') }}" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="name">
        </div>
        <div class="form-group">
            <label for="phone">Phone number</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone" value="phone">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="email">
        </div>
        <div class="float-right">
            <h4 class="text-right">Your order total price<br><span class="badge badge-success">{{ $order->getTotalValue() }} $</span>
            </h4>
            <button type="submit" class="btn btn-primary float-right">Confirm</button>

        </div>
        @csrf
    </form>
</div>
</body>
</html>
