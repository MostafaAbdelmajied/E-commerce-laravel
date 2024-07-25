@extends('user.layout')
@section('body')

    <style>
        .small-circle {
            width: 100px;
            height: 100px;
        }
    </style>
    <div class="banner header-text">

        <table width="100%" class="mt-5">
        <thead>
            <tr>
                <td>Image</td>
                <td>Name</td>
                <td>Desc</td>
                <td>Quantity</td>
                <td>price</td>
                <td>Subtotal</td>
                <td>Remove</td>
                <td>Edit</td>
            </tr>
        </thead>

        <tbody>
            @if ($cart)

            @foreach ($cart as $id=>$product)
            <tr>
                <td><img style="height: 100px;" src="{{asset("storage/".$product['image'])}}" alt="product1"></td>
                <td><h6>{{$product['name']}}</h6></td>
                <td><h6>{{$product['desc']}}</h6></td>
                <td><h6>{{$product['quantity']}}</h6></td>
                <td><h6>{{$product['price']}}</h6></td>
                <td><h6>{{$product['price'] * $product['quantity']}}</h6></td>


                <td>
                    <form action="/cart/{{$id}}" method="POST" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-danger" form="delete-form">Remove</button>
                    </form>
                </td>

                <!-- Remove any cart item  -->
                <td></td>

            </tr>
            @endforeach
            @endif

        </tbody>
        <!-- confirm order  -->
        <!-- <td><button type="submit" name="" class="btn btn-success">Confirm</button></td> -->

    </table>

    <div class="mt-5">
        <form method="POST" action="/makeorder">
            @csrf
            <label for="date">Required Date</label>
            <input type="date" name="day" id="day">
            <button class="btn btn-info" type="submit">Make Order</button>
        </form>
    </div>
</div>

    @endsection