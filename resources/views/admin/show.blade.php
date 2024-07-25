@extends("admin.layout")

@section("body")
    <h3>show product</h3>
    Product Name: {{$product->name}} <br>
    Category: {{$product->category->name}} <br>
    price : {{$product->price}} <br>
    Quantity : {{$product->quantity}} <br>
    product Image  <br> <img src="{{asset("storage/$product->image")}}" width="250px" hight="250px" alt=""> <p>{{$product->description}} </p> <hr>
    <form action="{{url("products/delete/$product->id")}}" method="post" class="my-2">
    <a href="{{url("products/edit/$product->id")}}" class="btn btn-primary" >Edit</a>
    @csrf
    <button type="submit" class="btn btn-danger"name="submit" >Delete</button>
    </form>
@endsection