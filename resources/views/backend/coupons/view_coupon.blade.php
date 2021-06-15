@extends('admin.admin_master')

@section('admin_content')



    <div class="container-full">
 

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Coupon List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Coupon Name</th>
                              <th>Coupon Discount</th>
                              <th>Coupon Validity</th>
                              <th>Coupon Status</th>
                              <th>Actions</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                       
                        
                          @foreach ($coupons as $item)
                          <tr>
                            <td>{{ $item->coupon_name }}</td>
                              <td>{{ $item->coupon_discount }}</td>
                              <td width="25%">
                                {{  Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y')}}
                             </td>
                              <td>

                                @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                <span class="badge badge-pill badge-success">Valid</span>
                                 @else
                                <span class="badge badge-pill badge-danger">InValid</span>
                          
                                 @endif
            
                               
                            
                            </td>

                              <td width="20%">
                                  <a href="{{ route('coupon.edit', $item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                  <a href="{{ route('coupon.delete', $item->id) }}" id="delete" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>

                                  {{-- @if($item->status == 1)
                                  <a href="{{ route('coupon.inactive', $item->id) }}" class="btn btn-secondary btn-sm" title="InActive now"><i class="fa fa-arrow-down"></i></a>
  
                                @else
                                <a href="{{ route('coupon.active', $item->id) }}" class="btn btn-info btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                @endif --}}
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
                 <h3 class="box-title">Add Coupon </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  
                    <form method="POST" action="{{ route('coupon.store') }}" >
                    @csrf
                        
                          <div class="container">
                             <div class="form-group">
                                <h5>Coupon Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="coupon_name"  class="form-control" > 
                                    @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                          </div>

                            <div class="form-group">
                                <h5>Coupon Discount(%)<span class="text-danger">*</span></h5>
                                <div class="controls">
                                
                                    <input type="text" name="coupon_discount"  class="form-control" >
                                    @error('coupon_discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <h5>Coupon Validity Date <span class="text-danger">*</span></h5>
                                <div class="controls">
                                
                                    <input type="date" name="coupon_validity"  class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('coupon_validity')
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