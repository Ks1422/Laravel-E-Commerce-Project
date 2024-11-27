<section class="slider_section">
  <div class="slider_container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-7">
                <div class="detail-box">
                  <h1>
                    Welcome To Our <br>
                    Gift Shop
                  </h1>
                  <p>
                    Sequi perspiciatis nulla reiciendis, rem, tenetur impedit, eveniet non necessitatibus error distinctio mollitia suscipit. Nostrum fugit doloribus consequatur distinctio esse, possimus maiores aliquid repellat beatae cum, perspiciatis enim, accusantium perferendis.
                  </p>
                  <a href="{{('/contact')}}">
                    Contact Us
                  </a>
                </div>
              </div>
              <div class="col-md-5 ">
                <div class="img-box">
                  <img style="width:600px" src="images/image3.jpeg" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- end slider section -->
</div>
<!-- end hero area -->

<!-- shop section -->

<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Latest Products
      </h2>
    </div>
    <div class="row">

      @foreach($product as $product)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="box">
          <a href="">
            <div class="img-box">
              <img src="products/{{$product->image}}" alt="">
            </div>
            <div class="detail-box">
              <h6>{{$product->title}}</h6>
              <h6>Price <br><span>{{$product->price}}</span></h6>
            </div>

          </a>
          <div class="details">
            <a href="{{url('product_details',$product->id)}}" class="btn btn-warning">Details</a>
            <a href="{{url('add_cart',$product->id)}}" class="btn btn-primary ml-4">Add Product</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="btn-box">
      <a href="">
        View All Products
      </a>
    </div>
  </div>
</section>