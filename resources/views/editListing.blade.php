@extends('layout.main')

@section('content')

<div class="container">
  <div class="mt-4 pt-5 text-center">
    <h2 class="pt-5 mt-4">My Listing</h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorem vitae exercitationem nemo quibusdam provident error tenetur esse aliquid a maiores aut, inventore atque quas reprehenderit ab nesciunt earum corrupti libero?</p>
  </div>
</div>

<div class="container mb-5">
 <!-- Form START -->
 <div class="row mb-5 gx-5">
    <!-- Contact detail -->
<form class="file-upload" action="{{url('mylisting/update')}}/{{$list->list_id}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-xxl-0">
            <div class="bg-secondary-soft px-4 py-5 rounded">
                <div class="row g-3">
                    @if (session()->has('error'))
                    <div class="alert alert-danger">{{session()->get('error')}}</div>
                  @endif
                  @if (session()->has('success'))
                  <div class="alert alert-success">{{session()->get('success')}}</div>
                  @endif

                    <div class="mb-3 col-md-4">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" placeholder="" name="title" value="{{$list->title}}">
                        <span class="text-danger small">@error('name')
                            {{$message}}
                        @enderror</span>
                    </div>

                     <div class="mb-3 col-md-4">
                        <label for="purpose" class="form-label">Purpose</label>
                        <select name="purpose" id="purpose" class="form-control">
                            <option value="" >Select The Purpose</option>
                            <option value="S" @if ($list->purpose == "S") selected @endif>Sell</option>
                            <option value="R" @if ($list->purpose == "R") selected @endif>Rent</option>
                        </select>
                        <small id="helpId" class="form-text text-danger">@error('purpose')
                            {{$message}}
                        @enderror</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select The Category</option>
                            @foreach($categories as $category)
                            <option value='{{ $category->category_id}}' @if ($list->category_id == $category->category_id) selected @endif> {{ $category->category_name}}</option>
                          @endforeach
                        </select>
                        <small id="helpId" class="form-text text-danger">@error('category')
                            {{$message}}
                        @enderror</small>
                      </div> 

                      <div class=" col-md-4 mb-3">
                        <label for="city" class="form-label">City</label>
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                            <option value="I" @if ($list->city == "I") selected @endif>Islamabad</option>
                            <option value="R" @if ($list->city == "R") selected @endif>Rawalpindi</option>
                            <option value="L" @if ($list->city == "L") selected @endif>Lahore</option>
                            <option value="K" @if ($list->city == "K") selected @endif>Karachi</option>
                            <option value="M" @if ($list->city == "M") selected @endif>Multan</option>
                            <option value="F" @if ($list->city == "F") selected @endif>Faisalabad</option>
                        </select>
                        <small id="helpId" class="form-text text-danger">@error('city')
                            {{$message}}
                        @enderror</small>
                      </div>      
                      <div class="mb-3 col-md-4">
                        <label for="address" class="form-label">Address</label>
                        <input type="text"
                          class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Enter The Address" value="{{$list->address}}">
                        <small id="helpId" class="form-text text-danger">@error('address')
                            {{$message}}
                        @enderror</small>
                      </div>  
                      <div class="mb-3 col-md-4">
                        <label for="address" class="form-label">Contact</label>
                        <input type="text"
                          class="form-control" name="contact" id="contact" aria-describedby="helpId" placeholder="Enter Your Contact" value="{{$list->Contact}}">
                        <small id="helpId" class="form-text text-danger">@error('contact')
                            {{$message}}
                        @enderror</small>
                      </div>  
                      <div class="mb-3 col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="text"
                          class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="Enter The Price" value="{{$list->price}}">
                        <small id="helpId" class="form-text text-danger">@error('price')
                            {{$message}}
                        @enderror</small>
                      </div>  
                      <div class="mb-3 col-md-6">
                        <div class="row">
                            <div class="col-md-9">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                                <input type="hidden" value="{{$list->image}}" name="oldImage">
                            </div>
                            <div class="col-md-3">
                                <img src="{{url('Backend/listing_images')}}/{{$list->image}}" width="100px" alt="">
                                
                            </div>
                        </div>
                        
                        <small id="helpId" class="form-text text-danger">@error('price')
                            {{$message}}
                        @enderror</small>
                      </div>  
                      <div class="mb-3 col-md-6">
                        <label for="description" class="form-label">Description</label>
                       <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$list->description}}</textarea>
                        <small id="helpId" class="form-text text-danger">@error('description')
                            {{$message}}
                        @enderror</small>
                      </div>

                      

                  </div> <!-- Row END -->
            </div>
        </div>
        <!-- button -->
    <div class="gap-3 mb-5 d-md-flex justify-content-md-end text-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
    </form> 
    <!-- Form END -->
</div>
</div>

@endsection