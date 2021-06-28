@extends('frontend.main_master')

@section('main_content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Shopping Details</h4>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC">
                            <table class="table">
                                <tr>
                                    <th> Shipping Name :</th>
                                    <th> {{ $order->name }}</th>
                                </tr>

                                <tr>
                                    <th> Shipping Phone :</th>
                                    <th> {{ $order->phone }}</th>
                                </tr>

                                <tr>
                                    <th> Shipping Email :</th>
                                    <th> {{ $order->email }}</th>
                                </tr>

                                <tr>
                                    <th> Division :</th>
                                    <th> {{ $order->division->division_name }}</th>
                                </tr>
                                <tr>
                                    <th> District :</th>
                                    <th> {{ $order->district->district_name }}</th>
                                </tr>
                                <tr>
                                    <th> State :</th>
                                    <th> {{ $order->state->state_name }}</th>
                                </tr>
                                <tr>
                                    <th> Post Code :</th>
                                    <th> {{ $order->post_code }}</th>
                                </tr>
                                <tr>
                                    <th> Order Date</th>
                                    <th> {{ $order->order_date }}</th>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

           
              {{-- 2nd  col-md-5  --}}

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Details
                            <i>
                             <span class="text-danger"> Invoice : {{ $order->invoice_no }}</span></i>
                        </h4>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC">
                            <table class="table">
                                <tr>
                                    <th>  Name :</th>
                                    <th> {{ $order->user->name }}</th>
                                </tr>

                                <tr>
                                    <th> Phone :</th>
                                    <th> {{ $order->user->phone }}</th>
                                </tr>

                                <tr>
                                    <th>  Email :</th>
                                    <th> {{ $order->user->email }}</th>
                                </tr>

                                <tr>
                                    <th> Payment Type :</th>
                                    <th> {{ $order->payment_method }}</th>
                                </tr>
                                <tr>
                                    <th> Transanction ID :</th>
                                    <th> {{ $order->transaction_id }}</th>
                                </tr>
                                <tr>
                                    <th> Order :</th>
                                    <th>  <span class="badge badge-pill badge-warning" style="background: #418DB9">
                                        {{ $order->status }}</span></th>
                                </tr>
                                <tr>
                                    <th> Order Total :</th>
                                    <th> {{ $order->amount }}</th>
                                </tr>
                                <tr>
                                    <th> Invoice :</th>
                                    <th class="text-danger"> {{ $order->invoice_no }}</th>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

           
        </div>



                                       <!------------ 2nd row ------------------->

                                       <div class="row">

                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr style="background: #e2e2e2">
                                                            <td class="col-md-1">
                                                                <label for="Date">Image</label>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                                <label for="Date">Product Name</label>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                                <label for="Date">Product Code</label>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                                <label for="Date">Size</label>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                                <label for="Date">Color</label>
                                                            </td>
                            
                                                            <td class="col-md-1">
                                                                <label for="Date">Quantity</label>
                                                            </td>

                                                            <td class="col-md-2">
                                                                <label for="Date">Price</label>
                                                            </td>
                                                        </tr>
                                                        
                                                        @foreach ($orderItem as $item)
                                                          
                                                        <tr>
                                                            <td class="col-md-1">
                                                                <label for="Date"><img src="{{ asset($item->product->product_thumbnail) }}" width="50px;" height="50px;"></label>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                                <label for="Date">{{ $item->product->product_name_en }}</label>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                                <label for="Date">{{ $item->product->product_code }}</label>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                                <label for="Date">{{ $item->size }}</label>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                                <label for="Date">
                                                                    {{ $item->color }}
                                                                    </label>
                                                            </td>
                            
                                                            <td class="col-md-1">
                                                                <label for="Date">
                                                                    {{ $item->qty }}
                                                                </label>
                                                            </td>

                                                            <td class="col-md-2">
                                                                <label for="Date">
                                                                    ${{ $item->price }} ( ${{ $item->price * $item->qty }} )
                                                                </label>
                                                            </td>
                                                        </tr>
                                                          
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                       </div>
    </div>
</div>

@endsection