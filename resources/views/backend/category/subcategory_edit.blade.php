@extends('admin.admin_master')

@section('admin_content')



    <div class="container-full">
 

      <!-- Main content -->
      <section class="content">
        <div class="row">

         
          <!-- /.col -->

          <div class="col-6">

                                             <!-- Add Category -->
            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit SubCategory </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  
                    <form method="POST" action="{{ route('subcategory.update') }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $subcategory->id }}">
                        
                          <div class="container">
                            

                                    <div class="form-group validate">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select  name="category_id" class="form-control">
                                                <option value="" selected="" disabled>Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    </div>
                                 
                             

                            <div class="form-group">
                                <h5>Category Name English  <span class="text-danger">*</span></h5>
                                <div class="controls">
                                
                                    <input type="text" name="subcategory_name_en"  class="form-control" value="{{ $subcategory->subcategory_name_en }}">
                                    @error('subcategory_name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Name Hindi  <span class="text-danger">*</span></h5>
                                <div class="controls">
                                
                                    <input type="text" name="subcategory_name_hin"  class="form-control" value="{{ $subcategory->subcategory_name_hin }}">
                                    @error('subcategory_name_hin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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