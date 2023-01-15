@extends('layout.main')
@section('content')

<div class="container mt-4 pt-5">
    <div class="mt-4 pt-5 container text-center">
      <h2>Dashboard</h2>
      {{-- <p>Create a new account <a href="{{route('register')}}">Register here</a></p> --}}
    </div>
  </div>
 
  
  <div class="container-xl px-4 mt-4">

    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Billing card 1-->
            <div class="card h-100 border-start-lg border-start-primary">
                <div class="card-body">
                    <div class="small text-muted">Total Listing</div>
                    <div class="h3">{{$listing}}</div>
                    <a class="text-arrow-icon small" href="{{url('mylisting')}}">
                        View All Listing 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <!-- Billing card 2-->
            <div class="card h-100 border-start-lg border-start-secondary">
                <div class="card-body">
                    <div class="small text-muted">Status</div>
                    <div class="h3 mt-2">{{status($userStatus)}}</div>
                    {{-- <a class="text-arrow-icon small text-secondary" href="#!">
                        View payment history
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <!-- Billing card 3-->
            <div class="card h-100 border-start-lg border-start-success">
                <div class="card-body">
                    <div class="small text-muted">Current plan</div>
                    <div class="h3 d-flex align-items-center">Free</div>
                    <a class="text-arrow-icon small text-success" href="#!">
                        Upgrade plan
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment methods card-->
    <div class="card card-header-actions mb-4">
        <div class="card-header d-flex justify-content-between align-iten-center ">
          <h5>Last Three Listings</h5>
            <button class="btn btn-sm btn-primary" type="button">Add New</button>
        </div>
        <div class="card-body px-0">
            <!-- Payment method 1-->
            @foreach ($showListing as $list)
                
            <div class="d-flex align-items-center justify-content-between px-4">
              <div class="d-flex align-items-center">
                     <i class="fab fa-cc-visa fa-2x cc-color-visa"></i>
                    <div class="ms-4">
                        <div class="small"><h6>{{$list->title}}</h6></div>
                        <div class="text-xs text-muted">{{dateFormat($list->created_at)}}</div>
                    </div>
                </div>
                <div class="ms-4">
                    <div class="badge bg-light text-dark me-3">{{Custom::categoryName($list->category_id)}}</div>
                    <a href="{{url('mylisting')}}">View</a>
                </div>
              </div>
              <hr>
              @endforeach
           
</div>
</div>
</div>

@endsection