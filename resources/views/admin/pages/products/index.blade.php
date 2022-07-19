@extends('admin.layout.main_layout')
@section('content')
<div class="container-fluid"> <a href="{{ route('products.create') }}" class="btn btn-block btn-info">Add New Product</a>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Product</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products Record</h6> </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>No of Serving</th>
                            <th>Price</th>
                            <th>View Details</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>No of Serving</th>
                            <th>Price</th>
                            <th>View Details</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody id="tabledata">
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <img src="/image/products/{{ $product->image }}" alt="" height="50px">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->no_of_serves }}</td>
                            <td>{{ $product->price }}</td>
                            <td class="text-center">
                                <a href="viewproduct.php?productid=-N4lOKfjxKB95D1EItZj" class="btn btn-success"> View </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.edit',$product->id) }}" class="btn btn-info"> Edit </a>
                            </td>
                            <td class="text-center "> 
                                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you would like to delete this Product?');">Delete</button>
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