@extends('admin.layout.main_layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="">
        <form action="{{ route('categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
        @method('PUT')
            <div class="row">
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
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="text" id="id" class="form-control" value="-N4mTufYW8X82Z2AWQiG" name="fieldid" hidden> </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Category Title</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" id="cattitle">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Color Code</label>
                        <input type="text" name="color" class="form-control" value="{{ $category->color }}" id="colorcode"> </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Current Image</label>
                        <br> <img src="{{ url('image/category_image')}}/{{ $category->image }}" alt="" id="image" height="100px"> </div>
                    <div class="form-group">
                        <label for="">Upload image if you want to change </label>
                        <br>
                        <input type="file" class="form-control-file" id="newimage" name="image"> </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Current Icon</label>
                        <br> <img src="{{ url('image/category_icon')}}/{{ $category->cat_icon }}" alt="" id="icon" height="100px"> </div>
                    <div class="form-group">
                        <label for="">Upload icon if you want to change </label>
                        <br>
                        <input type="file" class="form-control-file" id="newicon" name="cat_icon"> </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success" id="update">Update Record</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->

@endsection