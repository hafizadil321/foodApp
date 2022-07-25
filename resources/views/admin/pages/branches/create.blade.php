@extends('admin.layout.main_layout')
@section('content')
<!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="">
            <form action="{{ route('branches.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Branch Name</label>
                            <input type="text" id="name" class="form-control" name="name" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="latitude">Branch Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="longitude">Branch Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="address">Branch Address</label>
                            <textarea name="address" id="address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="image">Branch Image</label>
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