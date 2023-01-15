@extends('admin.layout.main')
@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Listing</h1>
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
          {{implode('', $errors->all(':message'))}} 
          {{-- {{`<script>alert();</script>`}}   --}}
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
                    <a href="{{url('admin/listing')}}" class="btn btn-secondary btn-sm mt-2">Reset</a>
                  </div>
                </form>
              </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Purpose</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>City</th>
                                <th>Contact</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($listing as $list)  
                            <tr>
                                <th><img src="{{url('Backend/listing_images')}}/{{$list->image}}" alt="" class="img-fluid circle" width="70px"> </th>
                                <th>{{$list->title}}</th>
                                <th>{{PurposeName($list->purpose)}}</th>
                                <th>{{Custom::userName($list->author_id)}}</th>
                                <th>{{$list->price}}</th>
                                <th>{{Custom::categoryName($list->category_id)}}</th>
                                <th>{{cityName($list->city)}}</th>
                                <th>{{$list->Contact}}</th>
                                <th>{{dateFormat($list->created_at)}}</th>
                                <th>
                                    <button type="button" class="m-1 btn btn-sm editbtn btn-primary" value="{{$list->list_id}}"><i class="fa fa-edit"></i></button> 

                                    <a href="{{url('admin/listing/delete')}}/{{$list->list_id}}" class="m-1 btn btn-sm deleteBtn btn-danger"><i class="fa fa-trash"></i></a>
                                 </th>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $listing->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    

  
  <!--Create Listing Modal -->
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
          <form action="{{route('admin.listing')}}" method="post" enctype="multipart/form-data">
            @csrf
           <div class="mb-3">
             <label for="title" class="form-label">Title</label>
             <input type="text"
               class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter The Title">
             <small id="helpId" class="form-text text-danger">@error('title')
                 {{$message}}
             @enderror</small>
           </div>      
           <div class="mb-3">
            <label for="purpose" class="form-label">Purpose</label>
            <select name="purpose" id="purpose" class="form-control">
                <option value="">Select The Purpose</option>
                <option value="S">Sell</option>
                <option value="R">Rent</option>
            </select>
            <small id="helpId" class="form-text text-danger">@error('purpose')
                {{$message}}
            @enderror</small>
          </div> 
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-control">
                <option value="">Select The Category</option>
                @foreach($categories as $category)
                <option value='{{ $category->category_id}}'> {{ $category->category_name}}</option>
              @endforeach
            </select>
            <small id="helpId" class="form-text text-danger">@error('category')
                {{$message}}
            @enderror</small>
          </div> 

          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <select name="city" id="city" class="form-control">
                <option value="">Select The Purpose</option>
                <option value="I">Islamabad</option>
                <option value="R">Rawalpindi</option>
                <option value="L">Lahore</option>
                <option value="L">Karachi</option>
                <option value="M">Multan</option>
                <option value="F">Faisalabad</option>
            </select>
            <small id="helpId" class="form-text text-danger">@error('city')
                {{$message}}
            @enderror</small>
          </div>      
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text"
              class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Enter The Address">
            <small id="helpId" class="form-text text-danger">@error('address')
                {{$message}}
            @enderror</small>
          </div>  
          <div class="mb-3">
            <label for="address" class="form-label">Contact</label>
            <input type="text"
              class="form-control" name="contact" id="contact" aria-describedby="helpId" placeholder="Enter Your Contact">
            <small id="helpId" class="form-text text-danger">@error('contact')
                {{$message}}
            @enderror</small>
          </div>  
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text"
              class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="Enter The Price">
            <small id="helpId" class="form-text text-danger">@error('price')
                {{$message}}
            @enderror</small>
          </div>  
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
           <input type="file" name="image" id="image" class="form-control">
            <small id="helpId" class="form-text text-danger">@error('price')
                {{$message}}
            @enderror</small>
          </div>  
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
           <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
            <small id="helpId" class="form-text text-danger">@error('description')
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

{{-- Create Listing End --}}

  <!--Edit Listing Modal -->
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{url('admin/listing/update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="list_id" name="list_id" value="">
           <div class="mb-3">
             <label for="title" class="form-label">Title</label>
             <input type="text"
               class="form-control" name="edittitle" id="edittitle" aria-describedby="helpId" placeholder="Edit Title">
             <small id="helpId" class="form-text text-danger">
              @error('title')
                 {{$message}}
              @enderror</small>
           </div>      
           <div class="mb-3">
            <label for="purpose" class="form-label">Purpose</label>
            <select name="editpurpose" id="editpurpose" class="form-control">
                <option value="">Select The Purpose</option>
                <option value="S">Sell</option>
                <option value="R">Rent</option>
            </select>
            <small id="helpId" class="form-text text-danger">@error('purpose')
                {{$message}}
            @enderror</small>
          </div> 
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="editcategory" id="editcategory" class="form-control">
                <option value="">Select The Category</option>
                @foreach($categories as $category)
                <option value='{{ $category->category_id}}' > {{ $category->category_name}}</option>
              @endforeach
            </select>
            <small id="helpId" class="form-text text-danger">@error('category')
                {{$message}}
            @enderror</small>
          </div> 

          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <select name="editcity" id="editcity" class="form-control">
                <option value="">Select The Purpose</option>
                <option value="I">Islamabad</option>
                <option value="R">Rawalpindi</option>
                <option value="L">Lahore</option>
                <option value="L">Karachi</option>
                <option value="M">Multan</option>
                <option value="F">Faisalabad</option>
            </select>
            <small id="helpId" class="form-text text-danger">@error('city')
                {{$message}}
            @enderror</small>
          </div>      
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text"
              class="form-control" name="editaddress" id="editaddress" aria-describedby="helpId" placeholder="Enter The Address">
            <small id="helpId" class="form-text text-danger">@error('address')
                {{$message}}
            @enderror</small>
          </div>  
          <div class="mb-3">
            <label for="editContact" class="form-label">Contact</label>
            <input type="text"
              class="form-control" name="editContact" id="editContact" aria-describedby="helpId" placeholder="Enter Your Contact">
            <small id="helpId" class="form-text text-danger">@error('contact')
                {{$message}}
            @enderror</small>
          </div>  
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text"
              class="form-control" name="editprice" id="editprice" aria-describedby="helpId" placeholder="Enter The Price">
            <small id="helpId" class="form-text text-danger">@error('price')
                {{$message}}
            @enderror</small>
          </div>  
          <div class="mb-3">
            <div class="row">
              <div class="col-md-9 col-lg-9">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                <input type="hidden" value="" name="oldImage" id="oldImage">
              </div>
              <div class="col-md-3 col-lg-3">
                <img src="" id="editimage" name="editimage" width="70px" class="img-fluid" alt="">
              </div>
            </div>
            
           
           <small id="helpId" class="form-text text-danger">@error('price')
                {{$message}}
            @enderror</small>
          </div>  
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
           <textarea name="editdescription" id="editdescription" cols="30" rows="10" class="form-control"></textarea>
            <small id="helpId" class="form-text text-danger">@error('description')
                {{$message}}
            @enderror</small>
          </div>  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="updateList" class="btn btn-primary btn-submit">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>
{{-- Edit Listing End  --}}

@section('script')
    <script>
      $(document).ready(function(){
        $(document).on('click', '.editbtn', function(){
          let id = $(this).val();
          // alert(id);
          $('#editmodal').modal('show');

        $.ajax({
type: 'GET',
url: 'listing/edit/'+id,
success: function(response){
  console.log(response);
 $('#list_id').val(response.list_id.list_id);
 $('#edittitle').val(response.list_id.title);
 $('#editpurpose').val(response.list_id.purpose);
 $('#editcategory').val(response.list_id.category_id);
 $('#editcity').val(response.list_id.city);
 $('#editaddress').val(response.list_id.address);
 $('#editContact').val(response.list_id.Contact);
 $('#editprice').val(response.list_id.price);
 $('#editimage').attr("src", '/Backend/listing_images/'+response.list_id.image);
 $('#oldImage').val(response.list_id.image);
 $('#editdescription').val(response.list_id.description);
}
})
})


// $(".btn-submit").click(function(e){;
//           e.preventDefault();

//           var title = $("#edittitle").val();
//           var purpose =  $('#editpurpose').val();
//           // var category  $('#editcategory').val();
//           var city =  $('#editcity').val();
//           var address =  $('#editaddress').val();
//           var contact =  $('#editContact').val();
//           var price =  $('#editprice').val();
//           var description =  $('#editdescription').val();
//           $.ajax({
//             headers: {
//               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             type : 'post',
//         // url: $(this).attr('action'),
//               // method: 'post',
//               url: "{{ route('edit.validate') }}",
//               // data: {title:title, purpose:purpose, category:category, city:city, address:address, contact:contact, price:price, description:description},
//               data: {title:title},
//               success: function(data) {
//               console.log(data)
//                   // if($.isEmptyObject(data.error)){
//                   //     alert(data.success);
//                   // }else{
//                   //     printErrorMsg(data.error);
//                   // }
//               }
//           });
//       }); 


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


