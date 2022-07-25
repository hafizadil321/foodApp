@extends('admin.layout.main_layout')
@section('content')
<div class="container-fluid"> <a href="{{ route('branches.create') }}" class="btn btn-block btn-info">Add New Branch</a>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Branch</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Branches Record</h6> </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Branch Name</th>
                            <th>Address</th>
                            <th>Brach Products</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Branch Name</th>
                            <th>Address</th>
                            <th>Brach Products</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody id="tabledata">
                        @foreach($branches as $branch)
                        <tr>
                            <td>{{ $branch->id }}</td>
                            <td>
                                <img src="/images/branches/{{ $branch->image }}" alt="" height="50px">
                            </td>
                            <td>{{ $branch->name }}</td>
                            <td class="text-center">
                                {{ $branch->address }}
                            </td>
                            <td class="text-center">
                                <a href="{{ url('branch_products/') }}/{{ $branch->id }}" class="btn btn-info"> Branck Products </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('branches.edit',$branch->id) }}" class="btn btn-info"> Edit </a>
                            </td>
                            <td class="text-center "> 
                                <form action="{{ route('branches.destroy',$branch->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you would like to delete this branch?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection