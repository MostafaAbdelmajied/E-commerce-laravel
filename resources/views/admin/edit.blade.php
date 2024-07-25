@extends("admin.layout")

@section("body")
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Editing Product</h4>
      <p class="card-description"> Editing Product </p>
      <form class="forms-sample" method="POST" action="{{url("products/update/$product->id")}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputName1">Name</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="name" value="{{$product->name}}">
            @error("name")
              <span style="color: #D92E0D">{{$message}}</span>
            @enderror
        </div>
            <div class="form-group">
              <label for="exampleTextarea1">description</label>
              <textarea class="form-control" id="exampleTextarea1" rows="4" name="description">{{$product->description}}</textarea>
              @error("description")
              <span style="color: #D92E0D">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail3">Price</label>
                <input type="number" class="form-control" id="exampleInputEmail3"   name="price" value="{{$product->price}}">
                @error("price")
                <span style="color: #D92E0D">{{$message}}</span>
              @enderror
            </div>
        <div class="form-group">
          <label for="exampleInputPassword4">Quantity</label>
          <input type="number" class="form-control" id="exampleInputPassword4" name="quantity" value="{{$product->quantity}}">
          @error("quantity")
          <span style="color: #D92E0D">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
          <label for="exampleSelectGender">category</label>
          <select class="form-control" id="exampleSelectGender" name="category_id">
            <option value="{{$product->category->id}}">{{$product->category->name}}</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
          @error("category")
          <span style="color: #D92E0D">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
          <label>Image</label>
          <input type="file" name="img[]" class="file-upload-default">
          <div class="input-group col-xs-12">
            <input type="file" class="form-control file-upload-info"  placeholder="Upload Image" name="image">

        </div>
            @error("image")
            <span style="color: #D92E0D">{{$message}}</span>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary me-2" name="submit">Submit</button>
        <a href="{{(! is_null(request()->server("HTTP_REFERER"))) ? url(request()->server("HTTP_REFERER")) : url("redirect") }}" class="btn btn-dark">Cancel</a>
      </form>
    </div>
  </div>
@endsection