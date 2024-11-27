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

                <table class="table table-striped table-hovered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Customer name</th>
                            <th>Adress</th>
                            <th>Phone</th>
                            <th>Product Title</th>
                            <th>price</th>
                            <th>İmage</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->rec_address}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{$data->product->title}}</td>
                            <td>{{$data->product->price}}</td>
                            <td><img src="products/{{$data->product->image}}" width="120" alt=""></td>
                            <td>
                                @if($data->status=='in progress')
                                <span style="color:red">{{$data->status}}</span>
                                @elseif($data->status=='on the way')
                                <span style="color:skyblue;">{{$data->status}}</span>
                                @else
                                <span style="color:yellow;">{{$data->status}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('on_the_way',$data->id)}}" class="btn btn-danger">On the way</a>
                                <a href="{{url('delivered',$data->id)}}" class="btn btn-success mt-2">Delivered</a>

                            </td>
                            <td>
                                <a href="{{url('print_pdf',$data->id)}}" class="btn btn-info">Print PDF</a>
                        </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- JavaScript files-->
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