<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="update text-center">
                    <h1>View-Product</h1>

                    <div class="search"> <!-- view_product sayfasında arama yapmak için oluşturduğum form -->
                        <form action="{{url('product_search')}}" method="get">
                            @csrf
                            <input type="search" name="search" class="form-control">
                            <input type="submit" class="btn btn-outline-primary mt-2" value="search"></input>
                        </form>
                    </div>

                    <table class="table table-striped table-hovered text-center mt-5 text-white table-bordered">

                        <thead class="bg-success">
                            <tr>
                                <th>İd</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>İmage</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $products)
                            <tr>
                                <td>{{$products->id}}</td>
                                <td>{{$products->title}}</td>
                                <td>{{!!Str::limit($products->description,50)}}</td>
                                <td>{{$products->price}}</td>
                                <td>{{$products->category}}</td>
                                <td>{{$products->quantity}}</td>
                                <td><img src="products/{{$products->image}}" width="120" height="120"></td>
                                <!-- sayfadaki yüklediğimiz resimleri görmek için productan resimleri çektim -->
                                <th>
                                    <a href="{{url('update_product',$products->id)}}" class="btn btn-success">Edit</a>
                                </th>
                                <th>
                                    <a href="{{url('delete_product',$products->id)}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
                {{$product->links()}}
            </div>
        </div>
        <!-- JavaScript files-->
        <script>
            function confirmation(ev) {
                ev.preventDefault();
                var urlToredirect = ev.currentTarget.getAttribute('href');
                console.log(urlToredirect);

                swal({
                        title: "Are you sure delete this",
                        text: "This delete will be parmanent",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })

                    .then((willCancel) => {
                        if (willCancel) {
                            window.location.href = urlToredirect;
                        }
                    });
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admincss/endor/popper.js/umd/popper.min.js')}}"> </script>
        <script src="{{asset('admincss/endor/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
        <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('admincss/js/charts-home.js')}}"></script>
        <script src="{{asset('admincss/js/front.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>