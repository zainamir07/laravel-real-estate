@extends('admin.layout.main')
@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Category</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>
            @if (session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
          @endif
          @if (session()->has('success'))
          <div class="alert alert-success">{{session()->get('success')}}</div>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($category as $cate)  
                            <tr>
                                <th>{{$cate->category_name}}</th>
                                <th>{{status($cate->category_status)}}</th>
                                <th>{{dateFormat($cate->created_at)}}</th>
                                <th>
                                    <button type="button" class="btn btn-sm editbtn btn-primary" id="editid" value="{{$cate->category_id}}"><i class="fa fa-edit"></i></button> 
                                    <a href="{{url('admin/category/delete')}}/{{$cate->category_id}}" class="btn btn-sm deleteBtn btn-danger"><i class="fa fa-trash"></i></a>

                                
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    

  
  <!--Create Category Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.category')}}" method="post">
            @csrf
           <div class="mb-3">
             <label for="category_name" class="form-label">Name</label>
             <input type="text"
               class="form-control" name="category_name" id="category_name" aria-describedby="helpId" placeholder="Category Name">
             <small id="helpId" class="form-text text-muted">@error('category_name')
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

  {{-- End Category Modal  --}}

  <!--Edit Category Modal -->
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('admin/category/update')}}" method="post">
            @csrf
           <div class="mb-3">
             <input type="hidden" id="cate_id" name="cate_id" value="">
             <label for="category_name" class="form-label">Name</label>
             <input type="text" class="form-control" id="cate_name" name="cate_name" value="">
             <small id="helpId" class="form-text text-muted">@error('cate_name')
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
<!--End Edit Category Modal -->

@endsection

@section('script')
    
<script>
  $(document).ready(function(){

$(document).on('click', '.editbtn', function(){
  let id = $(this).val();
  // alert(id);
  $('#editmodal').modal('show');

$.ajax({
type: 'GET',
url: 'category/edit/'+id,
success: function(response){
//  console.log(response.cate_id.category_name);
 $('#cate_id').val(response.cate_id.category_id);
 $('#cate_name').val(response.cate_id.category_name);
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



