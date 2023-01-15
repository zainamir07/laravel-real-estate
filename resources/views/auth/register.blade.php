@extends('layout.main')

@section('content')

<div class="container">
  <div class="mt-4 pt-5 text-center">
        <h2 class="mt-4 pt-5">Register</h2>
        <p>Already have an account <a href="{{route('login')}}">Login here</a></p>
    </div>
  </div>
    <div class="row mb-5 ">
      <div class="col-md-6 m-auto">
        <form action="{{route('register')}}" method="post">
          @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text"
            class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-danger">@error('name')
              {{$message}}
          @enderror</small>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
              class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-danger">@error('email')
                {{$message}}
            @enderror</small>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-danger">@error('password')
                {{$message}}
            @enderror</small>
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password"
              class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-danger">@error('password_confirmation')
                {{$message}}
            @enderror</small>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
        </form>
      </div>
    </div>
</div>
    
@endsection