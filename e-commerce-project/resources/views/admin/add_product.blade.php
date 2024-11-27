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
                <h1 class="text-center">Add-Product</h1>
                <div class="add-product">
                    <form action="{{url('upload_product')}}" class="form-group" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Product title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div>
                            <label>Description</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div>
                            <label>price</label>
                            <input type="text" class="form-control" name="price">
                        </div>
                        <div>
                            <label>Quantiy</label>
                            <input type="number" class="form-control" name="qty">
                        </div>
                        <div>
                            <div class="mt-1">
                            <label>Product Category</label>
                            <select class="form-control" required name="category">
                                <option></option>
                                 @foreach($category as $category)
                                    <option value="{{$category->category_name}}">{{($category->category_name)}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="mt-2">
                                <label>Product İmage</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <input type="submit" value="Add Product" class="btn btn-outline-success m-4">
                        </div>
                    </form>
                </div>
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
