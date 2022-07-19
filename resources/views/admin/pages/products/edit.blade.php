@extends('admin.layout.main_layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="">
        <form action="{{ route('products.update',$product->id) }}" id="update-product-form" method="post" enctype="multipart/form-data">
            @csrf
        @method('PUT')
            <div class="row">
                <div class="text-center col-lg-12"> <img src="{{ url('image') }}/products/{{ $product->image }}" alt="" id="oldimage" height="200px"> </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="categoryname">Select Category</label>
                        <select name="category_id" id="categoryname" class="form-control" required>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @if($category->name == $cat->name) selected @endif >{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="oldcat" value="" hidden=""> </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ $product->name }}" required> </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea name="description" id="desc" class="form-control">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required> </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="noofserves">No of Serves</label>
                        <input type="number" class="form-control" id="noofserves" name="no_of_serves" placeholder="e-g 2, 3 or 5" value="{{ $product->no_of_serves }}" required> </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image"> </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success" id="update-product-btn">Update Product</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

