@include("user.head")

<div class="col-md-9">
    <div class="product-item">
      <a href="#"><img  src="{{asset("storage/$product->image")}}" alt="not found" ></a>
      <div class="down-content">
        <a href="#"><h4>{{$product->name}}</h4></a>
        <h6>{{$product->price}}</h6>
        <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
        <ul class="stars">
          <li><i class="fa fa-star"></i></li>
          <li><i class="fa fa-star"></i></li>
          <li><i class="fa fa-star"></i></li>
          <li><i class="fa fa-star"></i></li>
          <li><i class="fa fa-star"></i></li>
        </ul>
        <span>Reviews (24)</span>
      </div>
    </div>
  </div>
@include("user.footer")