@extends('admin.layout.main_layout')
@section('content')
<!-- Begin Page Content -->
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Page Heading -->
        <div class="">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="categoryname">Select Category</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="" selected>Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" id="name" class="form-control" name="name" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="description" id="desc" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="no_of_serves">No of Serves</label>
                            <input type="number" class="form-control" id="no_of_serves" name="no_of_serves" placeholder="e-g 2, 3 or 5" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required> </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection