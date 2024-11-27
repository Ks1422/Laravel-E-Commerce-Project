<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style>
        .category {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <form action="{{url('view_category')}}" method="POST">
                    @csrf
                    <div class="category">
                        <input type="text" value="category" name="category">

                        <input type="submit" class="btn btn-primary m-1" value="Add Category">
                    </div>
                </form>
            </div>
            <div>
                <table class="table table-striped  text-center m-2 text-white">
                    <thead>
                        <tr>
                            <th class="text-white">Category Name</th>
                            <th class="text-white">Delete</th>
                            <th class="text-white">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td>{{($data->category_name)}}</td>
                            <td>
                                <a href="{{url('delete_category',$data->id)}}" class="btn btn-primary" onclick="confirmation(event)">Delete</a>
                            </td>
                            <td>
                                <a href="{{url('edit_category',$data->id)}}" class="btn btn-success">Edit</a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->

    <script>
        // sweetAlert kullanarak kullanıcıya  alert sundum
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