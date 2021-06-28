@extends('frontend.main_master')

@section('main_content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')

            <div class="col-md-2">
                
            </div>

            <div class="col-md-6">
                <div class="card">

                    <h3 class="text-center"><span class="text-info"><strong> Change Password</strong> </span>
                     </h3>
                     <div class="card-body">
                         <form action="{{ route('user.password.update') }}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Current Password </label>
                                <input type="password"  name="old_password" id="current_password" class="form-control" >
                                @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                              </div>

                              <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">New Password </label>
                                <input type="password"  name="password" id="password" class="form-control">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                              </div>

                              <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Confirm Password </label>
                                <input type="password"  name="password_confirmation" id="password_confirmation" class="form-control" >
                                @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                              </div>
                             
                              <div class="form-group">
                                <button class="btn btn-info">Update Password</button>
                              </div>
                             
                         </form>
                     </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection