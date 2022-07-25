@extends('admin.layout.main_layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="">
        <form action="{{ route('branches.update',$branch->id) }}" id="update-branch-form" method="post" enctype="multipart/form-data">
            @csrf
        @method('PUT')
            <div class="row">
                <div class="text-center col-lg-12"> <img src="{{ url('images') }}/branchs/{{ $branch->image }}" alt="" id="oldimage" height="200px"> </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Branch Name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ $branch->name }}" required> </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="price">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $branch->latitude }}" required> </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="number" class="form-control" id="longitude" name="longitude" value="{{ $branch->longitude }}" required> </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control">{{ $branch->address }}</textarea>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image"> </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success" id="update-branch-btn">Update Branch</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

