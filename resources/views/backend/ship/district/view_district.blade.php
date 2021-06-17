@extends('admin.admin_master')

@section('admin_content')



    <div class="container-full">
 

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">District List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Division Name</th>
                            <th>District Name</th>
                             <th>Actions</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                       
                        
                          @foreach ($districts as $item)
                          <tr>
                            <td>{{ $item->division->division_name }}</td>
                            <td>{{ $item->district_name }}</td>
                             

                              <td width="40%">
                                  <a href="{{ route('district.edit', $item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                  <a href="{{ route('district.delete', $item->id) }}" id="delete" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>

                                 
                              </td>
                              
                          </tr>
                          @endforeach
                      
                      </tbody>
                    
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

           
            <!-- /.box -->          
          </div>
          <!-- /.col -->

          <div class="col-4">

                                             <!-- Add Category -->
            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add District </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  
                    <form method="POST" action="{{ route('district.store') }}" >
                    @csrf
                        
                            <div class="container">
                                <div class="form-group">
                                    <h5>Division Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select  name="division_id" class="form-control">
                                            <option value="" selected="" disabled>Select Division Name</option>
                                            @foreach($divisions as $div)
                                            <option value="{{ $div->id }}">{{ $div->division_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                </div>

                          
                             <div class="form-group">
                                <h5>District Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="district_name"  class="form-control" > 
                                    @error('district_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                          </div>

   

                            <div class="text-xs-right">
                              
                              <input type="submit"  class="btn btn-rounded btn-primary mb-5" value="Add New">
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