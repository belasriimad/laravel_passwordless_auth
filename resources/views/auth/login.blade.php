@extends('layouts.app')

@section('title')
    Login
@endsection


@section('content')
    <div class="row my-5">
        <div class="col-md-6 mx-auto mt-5">
            <div class="card">
                <div class="card-header">
                    Sign in
                </div>
                <div class="card-body">
                    @include('layouts.alerts')
                    <form method="POST" action="{{route('user.auth')}}">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                          <input type="email" id="email" name="email" class="form-control" 
                            readonly onfocus="this.removeAttribute('readonly');" 
                            style="background-color: #ffffff"/>
                          <label class="form-label" for="email">Email address</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection