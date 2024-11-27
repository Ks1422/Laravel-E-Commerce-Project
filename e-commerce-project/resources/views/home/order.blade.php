<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <table class="table table-hovered text-center mt-3">
        <thead class="table-dark">
            <tr>
                <th>Product name</th>
                <th>Price</th>
                <th>Delivery Status</th>
                <th>İmage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $order)
            <tr>
                <td>{{$order->product->title}}</td>
                <td>{{$order->product->price}}</td>
                <td>{{$order->status}}</td>
                <td>
                    <img src="/products/{{$order->product->image}}" width="100" height="100">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('home.footer')


</body>

</html>