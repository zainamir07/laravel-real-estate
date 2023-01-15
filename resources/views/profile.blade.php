@extends('layout.main')

@section('content')
    
<div class="container">
    <div class="row">
            <div class="col-12">
                <!-- Page title -->
                <div class="my-5">
                    <h3>My Profile</h3>
                    <hr>
                </div>
                <!-- Form START -->
                <div class="row mb-5 gx-5">
                    <!-- Contact detail -->
                <form class="file-upload" action="{{url('profile')}}" method="post">
                    @csrf
                    <div class=" mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Contact detail</h4>
                                    @if (session()->has('error'))
                                    <div class="alert alert-danger">{{session()->get('error')}}</div>
                                  @endif
                                  @if (session()->has('success'))
                                  <div class="alert alert-success">{{session()->get('success')}}</div>
                                  @endif
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="First name" name="name" value="{{$user->name}}">
                                        <span class="text-danger small">@error('name')
                                            {{$message}}
                                        @enderror</span>
                                    </div>
                                     <!-- Email -->
                                     <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Email *</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Enter You Email Address" value="{{$user->email}}">
                                        <span class="text-danger small">@error('email')
                                            {{$message}}
                                        @enderror</span>
                                    </div>
                                    <div class="col-12 col-md-12">If you wanted to change your Password then change it, Otherwise leave this fields blank.</div>
                                    <!-- Old Password -->
                                    <div class="col-md-6">
                                        <label class="form-label">Old Password</label>
                                        <input type="password" name="oldPassword" class="form-control" placeholder="Enter Your Old Password" aria-label="Password">
                                    </div>
                                     <!-- Confirm Password -->
                                     <div class="col-md-6">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="" aria-label="Enter New Password">
                                        <span class="text-danger small">@error('password')
                                            {{$message}}
                                        @enderror</span>
                                    </div>
                                </div> <!-- Row END -->
                            </div>
                        </div>
                        <!-- button -->
                    <div class="gap-3 mb-5 d-md-flex justify-content-md-end text-center">
                        <button type="submit" class="btn btn-primary">Update profile</button>
                    </div>
                    </form> 
                    <!-- Form END -->
            </div>
        </div>
        </div>
        </div>

@endsection