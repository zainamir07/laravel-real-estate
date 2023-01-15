@extends('layout.main')

@section('content')

<div class="container">
  <div class="mt-4 pt-5 text-center">
    <h2 class="pt-5 mt-4">My Listing</h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorem vitae exercitationem nemo quibusdam provident error tenetur esse aliquid a maiores aut, inventore atque quas reprehenderit ab nesciunt earum corrupti libero?</p>
  </div>
</div>

<div class="container mb-5">
<div class="card-body">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
           <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">
                Add New Property
            </button>
        </h6>
    </div>
    @if (session()->has('error'))
    <div class="alert alert-danger">{{session()->get('error')}}</div>
  @endif
  @if (session()->has('success'))
  <div class="alert alert-success">{{session()->get('success')}}</div>
  @endif

  @if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
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
                      <th>Address</th>
                      <th>Status</th>
                      <th>Created</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                    @foreach ($listing as $list)  
                    <tr class="text-muted">
                        <th><img src="{{url('Backend/listing_images')}}/{{$list->image}}" alt="" class="img-fluid circle" width="70px"> </th>
                        <th>{{$list->title}}</th>
                        <th>{{PurposeName($list->purpose)}}</th>
                        <th>{{Custom::userName($list->author_id)}}</th>
                        <th>Rs. {{$list->price}}</th>
                        <th>{{Custom::categoryName($list->category_id)}}</th>
                        <th>{{cityName($list->city)}}</th>
                        <th>{{status($list->status)}}</th>
                        <th>{{dateFormat($list->created_at)}}</th>
                        <th>
                            <span>
                             <a href="{{url('mylisting/edit')}}/{{$list->list_id}}" class="btn btn-primary"><i class="icon-edit"></i></a>                              
                             <a href="{{url('mylisting/delete')}}/{{$list->list_id}}" class="btn btn-sm deleteBtn  btn-danger"><i class="icon-trash"></i></a></span>
                         </th>
                    </tr>
                    @endforeach
                   
              </tbody>
          </table>
      </div>
  </div>
</div>

<!-- Create Listing Modal -->
<div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">List New Property</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{url('mylisting')}}" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="mb-3">
                         <label for="title" class="form-label">Title</label>
                         <input type="text"
                           class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter The Title">
                         <small id="helpId" class="form-text text-muted">@error('title')
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
                        <small id="helpId" class="form-text text-muted">@error('purpose')
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
                        <small id="helpId" class="form-text text-muted">@error('category')
                            {{$message}}
                        @enderror</small>
                      </div> 
            
                      <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                            <option value="I">Islamabad</option>
                            <option value="R">Rawalpindi</option>
                            <option value="L">Lahore</option>
                            <option value="L">Karachi</option>
                            <option value="M">Multan</option>
                            <option value="F">Faisalabad</option>
                        </select>
                        <small id="helpId" class="form-text text-muted">@error('city')
                            {{$message}}
                        @enderror</small>
                      </div>      
                      <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text"
                          class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Enter The Address">
                        <small id="helpId" class="form-text text-muted">@error('address')
                            {{$message}}
                        @enderror</small>
                      </div>  
                      <div class="mb-3">
                        <label for="address" class="form-label">Contact</label>
                        <input type="text"
                          class="form-control" name="contact" id="contact" aria-describedby="helpId" placeholder="Enter Your Contact">
                        <small id="helpId" class="form-text text-muted">@error('contact')
                            {{$message}}
                        @enderror</small>
                      </div>  
                      <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text"
                          class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="Enter The Price">
                        <small id="helpId" class="form-text text-muted">@error('price')
                            {{$message}}
                        @enderror</small>
                      </div>  
                      <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                       <input type="file" name="image" id="image" class="form-control">
                        <small id="helpId" class="form-text text-muted">@error('price')
                            {{$message}}
                        @enderror</small>
                      </div>  
                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                       <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        <small id="helpId" class="form-text text-muted">@error('description')
                            {{$message}}
                        @enderror</small>
                      </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<script>
    // var modalId = document.getElementById('modalId');

    // modalId.addEventListener('show.bs.modal', function (event) {
    //       // Button that triggered the modal
    //       let button = event.relatedTarget;
    //       // Extract info from data-bs-* attributes
    //       // let recipient = button.getAttribute('data-bs-whatever');

    //     // Use above variables to manipulate the DOM
    // });
</script>


<!-- Edit Listing Modal -->
{{-- <div class="modal fade" id="editmodalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
              <div class="modal-header">
                      <h5 class="modal-title" id="modalTitleId">List New Property</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
          <div class="modal-body">
              <div class="container-fluid">
                  <form action="{{url('mylisting')}}" method="post" enctype="multipart/form-data">
                      @csrf
                     <div class="mb-3">
                       <label for="title" class="form-label">Title</label>
                       <input type="text"
                         class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter The Title">
                       <small id="helpId" class="form-text text-muted">@error('title')
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
                      <small id="helpId" class="form-text text-muted">@error('purpose')
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
                      <small id="helpId" class="form-text text-muted">@error('category')
                          {{$message}}
                      @enderror</small>
                    </div> 
          
                    <div class="mb-3">
                      <label for="city" class="form-label">City</label>
                      <select name="city" id="city" class="form-control">
                          <option value="">Select City</option>
                          <option value="I">Islamabad</option>
                          <option value="R">Rawalpindi</option>
                          <option value="L">Lahore</option>
                          <option value="L">Karachi</option>
                          <option value="M">Multan</option>
                          <option value="F">Faisalabad</option>
                      </select>
                      <small id="helpId" class="form-text text-muted">@error('city')
                          {{$message}}
                      @enderror</small>
                    </div>      
                    <div class="mb-3">
                      <label for="address" class="form-label">Address</label>
                      <input type="text"
                        class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Enter The Address">
                      <small id="helpId" class="form-text text-muted">@error('address')
                          {{$message}}
                      @enderror</small>
                    </div>  
                    <div class="mb-3">
                      <label for="address" class="form-label">Contact</label>
                      <input type="text"
                        class="form-control" name="contact" id="contact" aria-describedby="helpId" placeholder="Enter Your Contact">
                      <small id="helpId" class="form-text text-muted">@error('contact')
                          {{$message}}
                      @enderror</small>
                    </div>  
                    <div class="mb-3">
                      <label for="price" class="form-label">Price</label>
                      <input type="text"
                        class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="Enter The Price">
                      <small id="helpId" class="form-text text-muted">@error('price')
                          {{$message}}
                      @enderror</small>
                    </div>  
                    <div class="mb-3">
                      <label for="image" class="form-label">Image</label>
                     <input type="file" name="image" id="image" class="form-control">
                      <small id="helpId" class="form-text text-muted">@error('price')
                          {{$message}}
                      @enderror</small>
                    </div>  
                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                     <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                      <small id="helpId" class="form-text text-muted">@error('description')
                          {{$message}}
                      @enderror</small>
                    </div>  
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                  </div>
              </form>
            </div>
          </div>
        </div> 
        </div> --}}
        
        
        @section('script')
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