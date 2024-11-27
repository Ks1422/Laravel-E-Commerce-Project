<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
    <div class="hero_area">
        @include('home.header')

        <section class="shop_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Latest Products
                    </h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-10">
                        <div class="box">
                            <a href="">
                                <div class="img-box">
                                    <img src="/products/{{$data->image}}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h6>Product:
                                        <span>{{$data->title}}</span>
                                    </h6>
                                    <h6>Price:
                                        <span>{{$data->price}}</span>
                                    </h6>
                                    <h6>Category:
                                        <span>{{$data->category}}</span>

                                        <h6>Description
                                            <span>{{$data->description}}</span>
                                        </h6>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('home.footer')


</body>

</html>