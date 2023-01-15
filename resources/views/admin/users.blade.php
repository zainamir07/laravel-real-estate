@extends('admin.layout.main')
@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Users</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>
            @if (session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
          @endif
          @if (session()->has('success'))
          <div class="alert alert-success">{{session()->get('success')}}</div>
          @endif

          @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
          @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add More+
                    </button>
                </h6>
            </div>

           
            
            <div class="card-body">
              <div class="container pull-right">
                <form action="" method="get">
                  <div class="mb-3">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Search by Title or Price" value="{{$search}}">
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Search</button>
                    <a href="{{url('admin/users')}}" class="btn btn-secondary btn-sm mt-2">Reset</a>
                  </div>
                </form>
              </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)  
                            <tr>
                                {{-- <th><img src="{{url('Backend/listing_images')}}/{{$list->image}}" alt="" class="img-fluid circle" width="70px"> </th> --}}
                                <th>{{$user->name}}</th>
                                <th>{{$user->email}}</th>
                                <th>{{status($user->status)}}</th>
                                <th>{{dateFormat($user->created_at)}}</th>
                                <th>
                                  <button type="button" class="btn btn-sm editbtn btn-primary" value="{{$user->id}}"><i class="fa fa-edit"></i></button>  

                                    <a href="{{url('admin/users/delete')}}/{{$user->id}}" class="btn btn-sm deleteBtn btn-danger"><i class="fa fa-trash"></i></a>
                                 </th>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- <div class="row"> --}}
                      {{-- {{$products->links()}} --}}
                      {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                    {{-- </div> --}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    

  
  <!--Create User Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.users')}}" method="post" enctype="multipart/form-data">
            @csrf
           <div class="mb-3">
             <label for="name" class="form-label">Name</label>
             <input type="text"
               class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Enter The User Name">
             <small id="helpId" class="form-text text-muted">@error('name')
                 {{$message}}
             @enderror</small>
           </div>      
           <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
              class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Enter The User Email">
            <small id="helpId" class="form-text text-muted">@error('email')
                {{$message}}
            @enderror</small>
          </div>     
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Set The Password">
            <small id="helpId" class="form-text text-muted">@error('password')
                {{$message}}
            @enderror</small>
          </div>      
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password"
              class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpId" placeholder="Confirm Password">
            <small id="helpId" class="form-text text-muted">@error('password_confirmation')
                {{$message}}
            @enderror</small>
          </div>        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add+</button>
        </div>
    </form>
      </div>
    </div>
  </div>

   <!--Edit User Modal -->
   <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('admin/users/update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" id="user_id">
           <div class="mb-3">
             <label for="name" class="form-label">Name</label>
             <input type="text"
               class="form-control" name="editname" id="editname" aria-describedby="helpId" placeholder="Enter The User Name">
             <small id="helpId" class="form-text text-muted">@error('editname')
                 {{$message}}
             @enderror</small>
           </div>      
           <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
              class="form-control" name="editemail" id="editemail" aria-describedby="helpId" placeholder="Enter The User Email">
            <small id="helpId" class="form-text text-muted">@error('editemail')
                {{$message}}
            @enderror</small>
          </div>     
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password"
              class="form-control" name="editpassword" id="editpassword" aria-describedby="helpId" placeholder="Set The Password">
            <small id="helpId" class="form-text text-muted">@error('editpassword')
                {{$message}}
            @enderror</small>
          </div>      
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="editstatus" class="form-control" id="editstatus">
              <option value="">Select User Status</option>
              <option value="A">Active</option>
              <option value="P">Pending</option>
              <option value="B">Block</option>
            </select>
            <small id="helpId" class="form-text text-muted">@error('editstatus')
                {{$message}}
            @enderror</small>
          </div>        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>
   @section('script')
   <script>
    $(document).ready(function(){
      $(document).on('click', '.editbtn', function(){
        let id = $(this).val();
        // alert(id);
        $('#editmodal').modal('show');

      $.ajax({
type: 'GET',
url: 'users/edit/'+id,
success: function(response){
$('#user_id').val(response.user_id.id);
$('#editname').val(response.user_id.name);
$('#editemail').val(response.user_id.email);
$('#editstatus').val(response.user_id.status);
$('#editpassword').val(response.user_id.password);
}
})

})
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript">
    $('.deleteBtn').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          setTimeout(function() { 
            window.location.href = url;
          }, 2000);
        }
      })
    });
    </script>
   @endsection
        
@endsection


