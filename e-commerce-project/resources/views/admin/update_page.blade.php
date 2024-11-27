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
                <div class="update">
                    <h1 class="text-center text-white">View-Product</h1>
                    <form action="{{url('edit_product',$data->id)}}" method="post" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label class="text-white">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$data->title}}">
                        </div>
                        <div>
                            <label class="text-white">Description</label>
                            <textarea name="description" class="form-control">{{$data->description}}</textarea>
                        </div>
                        <div>
                            <label class="text-white">Price</label>
                            <input type="text" class="form-control" name="price" value="{{$data->price}}">
                        </div>
                        <div>
                            <label class="text-white">Category</label>
                            <select class="form-control" name="category">
                                <option value="{{$data->category}}">{{$data->category}}</option>

                                @foreach($category as $category)
                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>

                        </div>

               

                        <div>
                            <div>
                                <label class="text-white">Quantity</label>
                                <input type="text" class="form-control" name="quantity" value="{{$data->quantity}}">
                            </div>
                            <div>
                                <label class="text-white">Current Image:</label>
                                <img width="120" height="120" src="/product/{{$data->image}}" class="mt-4">
                            </div>
                            <div>
                                <label class="text-white mt-5">New Image:</label>
                                <input type="file" name="image">
                            </div>
                        </div>
                    </form>
                    <div class="btn-update text-center mt-5">
                        <button type="submit" class="btn btn-success">update</button>
                    </div>
                </div>

            </div>
        </div>

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