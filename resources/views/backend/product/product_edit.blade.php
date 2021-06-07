@extends('admin.admin_master')

@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <div class="container-full">
     	  

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Edit Products</h4>
            
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form action="{{ route('product.update') }}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-12">	
                        {{-- 1st row start --}}
                        <div class="row">  
                            <div class="col-md-4">
                                <input type="hidden" name="id" value="{{ $product->id }}">

                                <div class="form-group validate">
                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" class="form-control" required>
                                            <option value="" selected="" disabled>Brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->brand_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                </div>
                        
                            </div> 
                            {{-- 1st col-md-4 end --}}

                            <div class="col-md-4">


                                <div class="form-group validate">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select   name="category_id" class="form-control" required>
                                            <option value="" selected="" disabled>Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                </div>

                            </div> 
                            {{-- 2nd col-md-4 end --}}

                            <div class="col-md-4">


                                <div class="form-group validate">
                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select  name="subcategory_id" class="form-control" required>
                                            <option value="" selected="" disabled>Subcategory</option>
                                            @foreach($subcategories as $sub)
                                            <option value="{{ $sub->id }}" {{ $sub->id == $product->subcategory_id ? 'selected' : '' }}>{{ $sub->subcategory_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                </div>

                            </div> 
                            {{-- 3rd col-md-4 end --}}
                        </div> 
                        {{-- 1st row end --}}


                    {{-- 2nd row start --}}
                        <div class="row">  
                            <div class="col-md-4">

                                <div class="form-group validate">
                                    <h5>Sub-Subcategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select  name="subsubcategory_id" class="form-control" required>
                                            <option value="" selected="" disabled>Sub-Subcategory</option>
                                            @foreach($subsubcategories as $subsub)
                                            <option value="{{ $subsub->id }}" {{ $subsub->id == $product->subsubcategory_id ? 'selected' : '' }}>{{ $subsub->subsubcategory_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('subsubcategory_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                </div>
                        
                            </div> 
                            {{-- 1st col-md-4 end --}}

                            <div class="col-md-4">


                                <div class="form-group">
                                    <h5>Product Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" class="form-control" value="{{ $product->product_name_en }}" required> </div>
                                        @error('product_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div> 
                            {{-- 2nd col-md-4 end --}}

                            <div class="col-md-4">


                                <div class="form-group">
                                    <h5>Product Name Hindi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_hin" class="form-control" value="{{ $product->product_name_hin }}" required> </div>
                                        @error('product_name_hin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                       
                               

                            </div> 
                            {{-- 3rd col-md-4 end --}}
                        </div> 
                        {{-- 2nd row end --}}


                         {{-- 3rd row start --}}
                         <div class="row">  
                            <div class="col-md-4">

                                <div class="form-group">
                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}" required> </div>
                                        @error('product_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        
                            </div> 
                            {{-- 1st col-md-4 end --}}

                            <div class="col-md-4">


                                <div class="form-group">
                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_qty" class="form-control" value="{{ $product->product_qty }}" required> </div>
                                        @error('product_qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div> 
                            {{-- 2nd col-md-4 end --}}

                            <div class="col-md-4">


                                <div class="form-group">
                                    <h5>Product Tags English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="product_tags_en" value="{{ $product->product_tags_en }}" data-role="tagsinput" placeholder="add tags" required/> </div>
                                        @error('product_tags_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                       
                               

                            </div> 
                            {{-- 3rd col-md-4 end --}}
                        </div> 
                        {{-- 3rd row end --}}




                         {{-- 4th row start --}}
                     <div class="row"> 
                            <div class="col-md-4"> 
                            <div class="form-group">
                                <h5>Product Tags Hindi <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{ $product->product_tags_hin }}" name="product_tags_hin" data-role="tagsinput" placeholder="add tags" required/> </div>
                                    @error('product_tags_hin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> 
                            </div>
                            {{-- 1st col-md-4 end --}}

                            <div class="col-md-4">


                                <div class="form-group">
                                    <h5>Product Size English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" value="{{ $product->product_size_en }}" name="product_size_en" data-role="tagsinput" placeholder="add tags" required/> </div>
                                        @error('product_size_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> 

                            </div> 
                            {{-- 2nd col-md-4 end --}}

                            <div class="col-md-4">


                                <div class="form-group">
                                    <h5>Product Size Hindi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" value="{{ $product->product_size_hin }}" name="product_size_hin" data-role="tagsinput" required/> </div>
                                        @error('product_size_hin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                       
                               

                            </div> 
                            {{-- 3rd col-md-4 end --}}
                        </div> 
                        {{-- 4th row end --}}


                {{-- 5th row start --}}
                        <div class="row"> 
                            <div class="col-md-6"> 
                            <div class="form-group">
                                <h5>Product Color English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{ $product->product_color_en }}" name="product_color_en" data-role="tagsinput" required /> </div>
                                    @error('product_color_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> 
                            </div>
                            {{-- 1st col-md-6 end --}}

                            <div class="col-md-6">


                                <div class="form-group">
                                    <h5>Product Color Hindi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" value="{{ $product->product_color_hin }}" name="product_color_hin" data-role="tagsinput"  required/> </div>
                                        @error('product_color_hin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> 

                            </div> 
                            {{-- 2nd col-md-6 end --}}

                        
                           
                        </div> 
                        {{-- 5th row end --}}





                         {{-- 6th row start --}}
                         <div class="row"> 



                            <div class="col-md-6">


                                <div class="form-group">
                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="selling_price" class="form-control" value="{{ $product->selling_price }}" required> </div>
                                        @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                       
                               

                            </div> 
                            <div class="col-md-6"> 
                            <div class="form-group">
                                <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text"  name="discount_price" class="form-control" value="{{ $product->discount_price }}" required> </div>
                                    @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> 
                            </div>
                           
                        </div> 
                        {{-- 6th row end --}}





                          {{-- 7th row start --}}
                          <div class="row"> 
                            <div class="col-md-6"> 
                            <div class="form-group">
                                <h5>Short Description English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text" required>{!!  $product->short_descp_en !!}</textarea>
                                </div>
                                   
                            </div> 
                            </div>
                            {{-- 1st col-md-4 end --}}

                            <div class="col-md-6">


                                <div class="form-group">
                                    <h5>Short description Hindi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_hin" id="textarea" class="form-control" required placeholder="Textarea text" required>{!!  $product->short_descp_hin !!}</textarea>
                                    </div>
                                       
                                </div> 

                            </div> 
                            {{-- 2nd col-md-4 end --}}

                          
                        </div> 
                        {{-- 7th row end --}}




                          {{-- 8th row start --}}
                          <div class="row"> 
                            <div class="col-md-6"> 
                            <div class="form-group">
                                <h5>Long Description English <span class="text-danger">*</span></h5>
                                <textarea id="editor1" name="long_descp_en" rows="10" cols="80" required>
                                    {!!  $product->long_descp_en !!}
                                     </textarea>
                                   
                            </div> 
                            </div>
                            {{-- 1st col-md-4 end --}}

                            <div class="col-md-6">


                                <div class="form-group">
                                    <h5>Long description Hindi <span class="text-danger">*</span></h5>
                                    <textarea id="editor2" name="long_descp_hin" rows="10" cols="80" required>
                                        {!!  $product->long_descp_hin !!}
                                     </textarea>
                                        
                                </div> 

                            </div> 
                            {{-- 2nd col-md-4 end --}}

                          
                        </div> 
                        {{-- 8th row end --}}

                <hr>
                        
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_2" name="hot_deals" required value="1" {{ $product->hot_deals == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_2">Hot Deals</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $product->featured == 1 ? 'checked' : '' }}>
                                        <label for="checkbox_3">Featured</label>
                                    </fieldset>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <div class="controls">
                                      <fieldset>
                                          <input type="checkbox" id="checkbox_4" name="special_offers" value="1" {{ $product->special_offers == 1 ? 'checked' : '' }}>
                                          <label for="checkbox_4">Special Offers</label>
                                      </fieldset>
                                      <fieldset>
                                          <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $product->special_deals == 1 ? 'checked' : '' }}>
                                          <label for="checkbox_5">Special Deals</label>
                                      </fieldset>
                                  </div>
                              </div>
                          </div>
                      </div>
                     
                      <div class="text-xs-right">
                        <input type="submit"  class="btn btn-rounded btn-primary mb-5" value="Update">
                      </div>
                  </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>


                            {{-- Multiple Image Update --}}
      <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box bt-3 border-info">
                    <div class="box-header">
                      <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                    </div>
        
                   <form action="{{ route('update.product.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">

                        @foreach ($multiImgs as $img)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="width: 280px; height: 130px;">
                                <div class="card-body">
                                  <h5 class="card-title">
                                      <a href="{{ route('product.multiimg.delete', $img->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete"><i class="fa fa-trash"></i></a>
                                  </h5>
                                  <p class="card-text">
                                      <div class="form-group">
                                          <label class="form-control-label">Change Image<span class="text-danger">*</span></label>
                                          <input type="file" name="multi_img[ {{ $img->id }} ]" class="form-control">
                                      </div>
                                  </p>
                              
                                </div>
                              </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-xs-right">
                        <input type="submit"  class="btn btn-rounded btn-primary mb-5" value="Update Image">
                      </div><br><br>
                   </form>
                  </div>

            </div>
        </div>
     

      </section>
      <!-- /.content -->


                        {{-- Product Thumbnail Update --}}
      <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box bt-3 border-info">
                    <div class="box-header">
                      <h4 class="box-title">Product Thumbnail <strong>Update</strong></h4>
                    </div>
        
                   <form action="{{ route('update.product.thumbnail') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="old_image" value="{{ $product->product_thumbnail }}">
                       
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset($product->product_thumbnail) }}" class="card-img-top" style="width: 280px; height: 130px;">
                                <div class="card-body">
                                  
                                  <p class="card-text">
                                      <div class="form-group">
                                          <label class="form-control-label">Change Image<span class="text-danger">*</span></label>
                                          <input type="file" name="product_thumbnail" class="form-control" onchange="mainThumbUrl(this)">
                                          <img id="mainThumb" >
                                      </div>
                                  </p>
                              
                                </div>
                              </div>
                        </div>
                      
                    </div>

                    <div class="text-xs-right">
                        <input type="submit"  class="btn btn-rounded btn-primary mb-5" value="Update Thumbnail">
                      </div><br><br>
                   </form>
                  </div>

            </div>
        </div>
     

      </section>
    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            $('select[name="category_id"]').on('change', function(){
                var category_id = $(this).val();
                if(category_id){
                    $.ajax({
                        url : "{{ url('/category/subcategory/ajax') }}/"+category_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            $('select[name="subsubcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en 
                                    + '</option>')
                            });
                        },
                    });
                } else{
                    alert('danger');
                }
            });



            $('select[name="subcategory_id"]').on('change', function(){
                var subcategory_id = $(this).val();
                if(subcategory_id){
                    $.ajax({
                        url : "{{ url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            var d = $('select[name="subsubcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en 
                                    + '</option>')
                            });
                        },
                    });
                } else{
                    alert('danger');
                }
            });
        });
        
        </script>

        <script>

            function mainThumbUrl(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#mainThumb').attr('src', e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);

                }
            }
        </script>


{{-- ---------------------------Show Multi  Code ------------------------ --}}

<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#prev_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>


@endsection