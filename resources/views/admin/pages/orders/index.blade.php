@extends('admin.layout.main_layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Orders</h1>
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
    <!-- <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#myModal">Add Food Category</button> -->
    
      <!-- DataTales -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders Record</h6>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Billing Name</th>
                        <th>Billing email</th>
                        <th>Billing Address</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th>ID</th>
                        <th>Billing Name</th>
                        <th>Billing email</th>
                        <th>Billing Address</th>
                     </tr>
                  </tfoot>
                  <tbody id="tabledata">
                     @foreach($orders as $order)
                     <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->billing_name }}</td>
                        <td>{{ $order->billing_email }}</td>
                        <td>{{ $order->billing_address }}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
@endsection