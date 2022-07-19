@extends('admin.layout.main_layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All food Categories</h1>
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
    <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#myModal">Add Food Category</button>
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title">Fill all fields to Add data</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
                  <div class="">
                     <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="name">Category Name</label>
                                 <input type="text" class="form-control" id="catname" name="name" placeholder="e-g burgers" required>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="catimage">Category Image(upload square)</label>
                                 <input type="file" class="form-control-file" id="catImage" name="image" required>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="caticon">Category Icon(upload png square)</label>
                                 <input type="file" class="form-control-file" id="catIcon" name="cat_icon" required>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label for="image">Choose Color (Hex #123456)</label>
                                 <input type="color" class="form-control-file" id="catcolorcode" name="color"  required>
                              </div>
                           </div>
                           <div class="col-lg-12 mt-5">
                              <div class="form-group">
                                 <button type="submit" class="btn btn-block btn-success" name="submit" id="addcategory" >Add data</button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- DataTales -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">food Category Record</h6>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Category Icon</th>
                        <th>Color Code</th>
                        <th>Edit</th>
                        <th>Delete</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Category Icon</th>
                        <th>Color Code</th>
                        <th>Edit</th>
                        <th>Delete</th>
                     </tr>
                  </tfoot>
                  <tbody id="tabledata">
                     @foreach($categories as $category)
                     <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                           <img src="{{ asset('image/category_image') }}/{{ $category->image }}" alt="" height="50px">
                        </td>
                        <td>
                           <img src="{{ asset('image/category_icon') }}/{{ $category->cat_icon }}" alt="" height="50px">
                        </td>
                        <td>{{ $category->color }}</td>
                        <td class="text-center">
                           <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-info"> Edit </a>
                        </td>
                        <td class="text-center ">
                           <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                            
                              <button type="submit" value="1655476221332" onclick="return confirm('Are you sure you would like to delete this Category?');" class="btn btn-danger btn-delete">Delete </button>
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