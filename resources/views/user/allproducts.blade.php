@extends("user.layout")
@section('body')
    <style>
        .header{
            position: unset;
        }
    </style>
    <div class="container">
      <div class="row">
        @foreach ($products as $product)

        <div class="col-md-4">
          <div class="product-item">
            <a href="#"><img  src="{{asset("storage/$product->image")}}" alt="" style="width: 100%; height: 350px;"></a>
            <div class="down-content">
              <a href="{{url("products/$product->id")}}"><h4>{{$product->name}}</h4></a>
              <h6>{{$product->price}}</h6>
              <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
              <form action="{{url('addtocart')}}" method="post">
                @csrf
                <input type="number" name="quantity" id="">
                <button type="submit">Add To Cart</button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
    </div>
</div>

{{$products->links()}}
@endsection