@extends('admin.layout.main_layout')
@section('content')
<div class="container-fluid"> 
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Product</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><!--  --> Products Record</h6> </div>
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
                            <th>Status</th>
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
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody id="tabledata">
                        @foreach($products->products as $product)
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
$(document).ready(function(){
    $('.add_new_employee').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
                url: "{{ url('/update_employee') }}",
                method: 'post',
                data: {
                    id: jQuery('#edit_form').val(),
                    name: jQuery('#name').val(),
                    position: jQuery('#position').val(),
                    email: jQuery('#email').val(),
                },
                success: function(result){
                    $.unblockUI();
                    if (result.success == false) {
                        $('#error_msg').html(result.errors);
                    }else{
                        $('#registerModal').modal('hide');
                        const toast = swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            padding: '2em'
                        });

                        toast({
                            type: 'success',
                            title: 'Employee Updated Successfully',
                            padding: '2em',
                        })
                        
                        location.reload(true);
                    }
                }
            });
        
    });
});
</script>