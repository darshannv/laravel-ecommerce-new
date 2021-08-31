@extends('admin.admin_master')


@section('admin_content')

<div class="container-full">
    <div class="content">
       

               
            

                <div class="box">
                    <div class="box-header with-border">
                      <h4 class="box-title">Admin Profile Edit</h4>
                      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                                @csrf
                              <div class="row">
                                <div class="col-12">						
                                 <div class="row">

                                    <div class="col-md-6">

                                   
                                    <div class="form-group">
                                        <h5>Admin Name  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" value="{{ $editData->name }}" required="" > </div>
                                    </div>

                                </div>
                            
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Admin Email  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" class="form-control" value="{{ $editData->email }}" required="" ></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Profile Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="profile_photo_path" class="form-control" id="image" required=""> </div>
                                    </div>
                                   
                                </div>
                                <div class="col-md-6">

                                    <div class="widget-user-image">
                                        <img id="showImage" src="{{ (!empty($editData->profile_photo_path)) ? url('upload/admin_images/'.$editData->profile_photo_path) : url('upload/no_image.jpg') }}" style="height: 100px; width:100px;" >
                                      </div>
                                </div>
                            </div>

                         
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="update"/>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection