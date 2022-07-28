@extends('admin.layout.main_layout')
@section('content')
<!-- Begin Page Content -->
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
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="">
            <form action="{{ route('riders.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="desc">Email</label>
                            <input type="text" name="email" id="desc" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="c_password">Confirm Password</label>
                            <input type="password" class="form-control" id="c_password" name="c_password" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phone">Phone No</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required> </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="categoryname">Select Branch</label>
                            <select name="branch_id" id="branch_id" class="form-control" required>
                                <option value="" selected>Choose Category</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
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