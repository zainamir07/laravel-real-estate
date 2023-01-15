@extends('layout.main')

@section('content')

<div class="container">
  <div class="mt-4 pt-5 text-center">
    <h2 class="pt-5 mt-4">Login</h2>
    <p>Create a new account <a href="{{route('register')}}">Register here</a></p>
  </div>
</div>
<div class="container mb-5">
    <div class="row">
      <div class="col-md-6 m-auto">
        @if (session()->has('error'))
          <div class="alert alert-danger">{{session()->get('error')}}</div>
        @endif
        @if (session()->has('success'))
        <div class="alert alert-success">{{session()->get('success')}}</div>
        @endif
        <form action="{{route('login')}}" method="post">
          @csrf
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
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
      <div class="container">
        <div class="row">
          <p><strong>Admin Login:</strong> zainamir532@gmail.com ( <strong>Password:</strong> 1234 )</p>
          <p><strong>User Login:</strong> user1@gmail.com ( <strong>Password:</strong> 1234 )</p>
        </div>
      </div>
    </div>
</div>
@endsection