@extends('admin.admin_master')

@section('admin_content')



    <div class="container-full">
 

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Product List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Image</th>
                              <th>Product Name English</th>
                              <th>Product Name  Hin</th>
                              <th>Quantity</th>
                              <th>Actions</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                       
                        
                          @foreach ($products as $item)
                          <tr>
                            <td><img src="{{ asset($item->product_thumbnail) }}" style="width: 60px; height: 50px;"/></td>
                              <td>{{ $item->product_name_en }}</td>
                              <td>{{ $item->product_name_hin }}</td>
                              <td>{{ $item->product_qty }}</td>
                              <td>
                                  <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                  <a href="{{ route('category.delete', $item->id) }}" id="delete" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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

        
 
            
             <!-- /.box -->          
           </div>
       
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>



@endsection