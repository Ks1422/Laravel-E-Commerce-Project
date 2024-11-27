<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .form-mycart-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .form-mycart {
            width: 30%;
            margin: 15px 0px 0px 10px;
        }

        .cart-table-container {
            width: 65%;
        }

        .table img {
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>
    <center>
        <div class="cart-table-container">
            @php $value = 0; @endphp
            @foreach($cart as $item) <!-- Her bir ürün için döngü -->
            <div class="card shadow p-4 m-3">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Image</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$item->product->title}}</td>
                            <td>{{$item->product->price}}</td>
                            <td>
                                <img width="50" height="50" src="/products/{{$item->product->image}}" alt="Product Image">
                            </td>
                           
                        </tr>
                    </tbody>
                </table>
            </div>
            @php $value += (int)$item->product->price; @endphp
            @endforeach

            <h3 class="mt-3">Total value of cart is: ${{$value}}</h3>


        </div>
        <div class="form-mycart-container" style="display: flex;justify-content:center;align-items:center">
            <!-- Form Alanı -->
            <div class="form-mycart">
                <form action="{{url('comfirm_order')}}" class="form" method="post">
                    @csrf
                    <label>Receiver Name</label>
                    <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">

                    <label>Rec address</label>
                    <textarea type="text" name="rec_address" class="form-control">{{Auth::user()->rec_address}}</textarea>

                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{Auth::user()->phone}}">

                    <input type="submit" class="btn btn-primary m-3" value="Cash on Delivery">
                    <a href="{{url('stripe',$value)}}" class="btn btn-success m-3">Pay using Card</a>
                </form>
            </div>


        </div>
    </center>
    @include('home.footer')
</body>

</html>