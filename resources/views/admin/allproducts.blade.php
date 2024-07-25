@extends("admin.layout")

@section('body')
<table class="table">
    <thead>
      <tr>

        <th> Product Name </th>
        <th> description </th>
        <th> Product price </th>
        <th>Quantity</th>
        <th> category </th>
        <th> operations </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>

            <td >
                <img src="{{asset("storage/$product->image")}}" alt="" id="small-image" style="height: 100px;">
                {{-- <img src="{{asset("storage/$product->image")}}" alt="image" > --}}
                <span class="ps-2">{{$product->name}}</span>
            </td>
            <td> {{Str::substr($product->description, 0, 50) }} </td>
            <td> {{$product->price}} </td>
            <td> {{$product->quantity}} </td>
            <td> {{$product->category->name}} </td>
            <td>
                <a href="{{url("aa/products/show/$product->id")}}" class="badge badge-outline-success">Show</a>
                <a href="{{url("aa/products/edit/$product->id")}}" class="btn btn-primary" >Edit</a>
                <form action="{{url("aa/products/delete/$product->id")}}" method="post" class="my-2">
                @csrf
                <button type="submit" class="btn btn-danger" >Delete</button>
                </form>
            </td>
            </tr>
        @endforeach

    </tbody>
  </table>
  {{$products->links()}}
  @endsection