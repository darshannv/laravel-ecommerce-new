@extends('admin.admin_master')

@section('admin_content')



    <div class="container-full">
 

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-6">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Slider </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  
                    <form method="POST" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                    @csrf
                        
                    <input type="hidden" name="id" value="{{ $slider->id }}">
                    <input type="hidden" name="old_image" value="{{ $slider->slider_img }}">
                          <div class="container">

                            <div class="form-group">
                                <h5>Slider Image  <span class="text-danger">*</span></h5>
                                <div class="controls">
                               
                                    <input type="file" name="slider_img" class="form-control">
                                    @error('slider_img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>

                             <div class="form-group">
                                <h5>Slider Title </h5>
                                <div class="controls">
                                    <input type="text" name="title"  class="form-control" value="{{ $slider->title }}"> 
                                  
                          </div>

                            <div class="form-group">
                                <h5> Slider Description  </h5>
                                <div class="controls">
                                
                                    <textarea type="text" name="description" rows="3" class="form-control">{{ $slider->description }}</textarea>
                                   
                            </div>
                            </div>

                          

                            <div class="text-xs-right">
                              
                                <input type="submit"  class="btn btn-rounded btn-primary mb-5" value="Update">
                            </div>
                          </div>
                    </form>
                   </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
 
            
             <!-- /.box -->          
           </div>
       
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>



@endsection