@extends('admin.admin_master')


@section('admin_content')

<div class="container-full">
    <div class="content">
       

               
            

                <div class="box">
                    <div class="box-header with-border">
                      <h4 class="box-title">Admin Change Password</h4>
                      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('admin.password.update') }}">
                                @csrf
                             						
                                 <div class="row">

                                    <div class="col-md-6">

                                   
                                    <div class="form-group">
                                        <h5>Current Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="old_password" id="current_password" class="form-control" > </div>
                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>New Password  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="password" id="password" class="form-control" ></div>
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Confirm Password  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  ></div>
                                            @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
                                    </div>
                                </div>
                            
                          

                         
                                
                            </div>
                            </form>
        
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                  </div>
    </div>
    
</div>



@endsection