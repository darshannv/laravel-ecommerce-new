@extends('frontend.main_master')


@section('main_content')

@section('title')
 Checkout Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->



<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	          <span>1</span>Checkout Method
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
					<h4 class="checkout-subtitle"><b>Shipping Address</b></h4>
					
					<form class="register-form" method="POST" action="{{ route('checkout.store') }}">
						@csrf
						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Shipping Name</b> <span>*</span></label>
					    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" value="{{ Auth::user()->name }}" id="exampleInputEmail1" placeholder="Name">
					  </div>

					  <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Shipping Email</b> <span>*</span></label>
					    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" value="{{ Auth::user()->email }}" id="exampleInputEmail1" placeholder="Email">
					  </div>

					  <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Shipping Phone </b><span>*</span></label>
					    <input type="tel" name="shipping_phone" class="form-control unicase-form-control text-input" value="{{ Auth::user()->phone }}" id="exampleInputEmail1" placeholder="Email">
					  </div>
					 
					  <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Post Code</b> <span>*</span></label>
					    <input type="tel" name="post_code" class="form-control unicase-form-control text-input" value="" id="exampleInputEmail1" placeholder="Post Code">
					  </div>
					
				</div>	
			
				<div class="col-md-6 col-sm-6 already-registered-login">
				
					<div class="form-group">
						<h5><b>Division Select</b> <span class="text-danger">*</span></h5>
						<div class="controls">
							<select  name="division_id" class="form-control">
								<option value="" selected="" disabled>Select Division</option>
								@foreach($divisions as $item)
								<option value="{{ $item->id }}">{{ $item->division_name }}</option>
								@endforeach
							</select>
							@error('division_id')
						<span class="text-danger">{{ $message }}</span>
					@enderror
					</div>
					</div>

					<div class="form-group">
						<h5><b>District Select</b> <span class="text-danger">*</span></h5>
						<div class="controls">
							<select  name="district_id" class="form-control">
								<option value="" selected="" disabled>Select District</option>
						
							</select>
							@error('district_id')
						<span class="text-danger">{{ $message }}</span>
					@enderror
					</div>
					</div>


					<div class="form-group">
						<h5><b>State Select</b> <span class="text-danger">*</span></h5>
						<div class="controls">
							<select  name="state_id" class="form-control">
								<option value="" selected="" disabled>Select State</option>
							
							</select>
							@error('state_id')
						<span class="text-danger">{{ $message }}</span>
					@enderror
					</div>
					</div>

					<div class="form-group">
					    <h5 for="exampleInputEmail1"><b>Notes</b> </h5>
					    <textarea type="tel" name="notes" class="form-control " rows="5" placeholder="Notes"></textarea>
					  </div>

					 
				
				</div>	
				<!-- already-registered-login -->	
			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					 
					  	<!-- checkout-step-06  -->
					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
			<div class="checkout-progress-sidebar ">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
						</div>
						<div class="">
							<ul class="nav nav-checkout-progress list-unstyled">
								@foreach ($carts as $item)
								<li>
									<strong>Image:</strong>
									<img src="{{ asset($item->options->image) }}" style="50px;"  height="50px;">
								</li>

								<li>
									<strong>Qty:</strong>
									( {{ $item->qty }} )

									<strong>Color:</strong>
									{{ $item->options->color }}

									<strong>Size:</strong>
									{{ $item->options->size }}
								</li>
								@endforeach
										<hr>
								<li>
									@if (Session::has('coupon'))
									<strong>SubTotal: </strong> ${{ $cartTotal }} <hr>

									<strong>Coupon Name: </strong> {{ session()->get('coupon')['coupon_name'] }}
									( {{ session()->get('coupon')['coupon_discount'] }}% ) <hr>

									<strong>Coupon Discount: </strong>${{ session()->get('coupon')['discount_amount'] }}
									<hr>

									<strong>Grand Total: </strong>${{ session()->get('coupon')['total_amount'] }}
									<hr>
									@else
									
									<strong>SubTotal: </strong> ${{ $cartTotal }} <hr>
									<strong>Grand Total: </strong> ${{ $cartTotal }} <hr>
							
									@endif
								</li>
							
								
							</ul>		
						</div>
					</div>
				</div>
</div> 
<!-- checkout-progress-sidebar --></div>








<div class="col-md-4">
	<!-- payment-progress-sidebar -->
<div class="checkout-progress-sidebar ">
<div class="panel-group">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="unicase-checkout-title">Select Payment Method</h4>
		</div>
		<div class="row">
				<div class="col-md-4">
					<label>Stripe</label>
					<input type="radio" name="payment_method" value="stripe"> 
					<img src="{{ asset('frontend/assets/images/payments/1.png') }}">
				</div>
				<div class="col-md-4">
					<label>Card</label>
					<input type="radio" name="payment_method" value="card"> 
					<img src="{{ asset('frontend/assets/images/payments/3.png') }}">

				</div>
				<div class="col-md-4">
					<label>Cash</label>
					<input type="radio" name="payment_method" value="cash"> 
					<img src="{{ asset('frontend/assets/images/payments/6.png') }}">

				</div>
		</div>
		<hr>
		<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>
	</div>
</div>
</div> 
<!-- payment-progress-sidebar --></div>




</form>


			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		</div><!-- /.container -->
</div><!-- /.body-content -->
<script>

$(document).ready(function(){
            $('select[name="division_id"]').on('change', function(){
                var division_id = $(this).val();
                if(division_id){
                    $.ajax({
                        url : "{{ url('/district-get/ajax') }}/"+division_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data){
							$('select[name="state_id"]').empty();
                            $('select[name="district_id"]').html('');
                            var d = $('select[name="district_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name 
                                    + '</option>')
                            });
                        },
                    });
                } else{
                    alert('danger');
                }
            });



            $('select[name="district_id"]').on('change', function(){
                var district_id = $(this).val();
                if(district_id){
                    $.ajax({
                        url : "{{ url('/state-get/ajax') }}/"+district_id,
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            var d = $('select[name="state_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name 
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
@endsection