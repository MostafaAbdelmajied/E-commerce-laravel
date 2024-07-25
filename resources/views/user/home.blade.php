@extends("user.layout")
@section("body")
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
      <div class="banner-item-01">
        <div class="text-content">
          <h4>Best Offer</h4>
          <h2>New Arrivals On Sale</h2>
        </div>
      </div>
      <div class="banner-item-02">
        <div class="text-content">
          <h4>Flash Deals</h4>
          <h2>Get your best products</h2>
        </div>
      </div>
      <div class="banner-item-03">
        <div class="text-content">
          <h4>Last Minute</h4>
          <h2>Grab last minute deals</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Latest Products</h2>
            <a href="{{url("products")}}">view all products <i class="fa fa-angle-right"></i></a>
          </div>
          <form action="{{url("search")}}" method="get">
            @csrf
            <input type="text" class="form-control" name="key">
            <button type="submit" class="btn btn-info">search</button>
        </form>
    </div>
        @foreach ($products as $product)

        <div class="col-md-4">
          <div class="product-item">
            <a href="#"><img  src="{{asset("storage/$product->image")}}" alt="not found" style="width: 100%; height: 350px;"></a>
            <div class="down-content">
              <a href="#"><h4>{{$product->name}}</h4></a>
              <h6>{{$product->price}}</h6>
              <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
              <form action="{{url("addtocart/$product->id")}}" method="post">
                @csrf
                <input type="number" name="quantity" id="" placeholder="number of parts" value="1" class="w-25">
                <button class="btn btn-info mt-2 w-30 h-20" type="submit">Add To Cart</button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
        {{$products->links()}}
      </div>
    </div>
  </div>
@endsection