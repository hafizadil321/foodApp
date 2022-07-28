@extends('admin.layout.main_layout')
@section('content')
<div class="container-fluid"> <a href="{{ route('riders.create') }}" class="btn btn-block btn-info">Add New Rider</a>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Riders</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riders Record</h6> </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Branch</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Branch</th>
                        </tr>
                    </tfoot>
                    <tbody id="tabledata">
                        @foreach($riders as $rider)
                        <tr>
                            <td>{{ $rider->id }}</td>
                            <td>
                                <img src="{{ asset('images/riders') }}/{{ $rider->image }}" alt="" height="50px">
                            </td>
                            <td>{{ $rider->name }}</td>
                            <td>{{ $rider->email }}</td>
                            <td>{{ $rider->branch->name??'' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection