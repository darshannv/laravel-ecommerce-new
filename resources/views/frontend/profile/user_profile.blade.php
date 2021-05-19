@extends('frontend.main_master')

@section('main_content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
<br>
                <img class="card-img-top" style="border-radius: 50%" src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg') }}" height="150px;", width="150px;">
                <br><br>
                <ul class="list-group list-group-flush">

                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Dashboard</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('user.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>

                </ul>
                <br>
            </div>

            <div class="col-md-2">
                
            </div>

            <div class="col-md-6">
                <div class="card">

                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ Auth::user()->name }}, </strong> Update your Profile
                     </h3>
                     <div class="card-body">
                         <form action="{{ route('user.profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Name </label>
                                <input type="text"  name="name" class="form-control" value="{{ $user->name }}">
                               
                              </div>
                              <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email </label>
                                <input type="email"  name="email" class="form-control" value="{{ $user->email }}">
                              
                              </div>
                              <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Phone </label>
                                <input type="text"  name="phone" class="form-control" value="{{ $user->phone }}">
                               
                              </div>
                              <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Profile Image </label>
                                <input type="file"  name="profile_photo_path" class="form-control">
                               
                              </div>
                              <div class="form-group">
                                <button class="btn btn-info">Update</button>
                              </div>
                             
                         </form>
                     </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection