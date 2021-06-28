@extends('frontend.main_master')

@section('main_content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            <div class="col-md-2">

            </div>

            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr style="background: #dddbdb">
                                <td class="col-md-1">
                                    <label for="Date">Date</label>
                                </td>

                                <td class="col-md-3">
                                    <label for="Date">Total</label>
                                </td>

                                <td class="col-md-3">
                                    <label for="Date">Payment</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="Date">Invoice</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="Date">Order</label>
                                </td>

                                <td class="col-md-1">
                                    <label for="Date">Action</label>
                                </td>
                            </tr>
                            
                            @foreach ($orders as $order)
                              
                            <tr>
                                <td class="col-md-1">
                                    <label for="Date">{{ $order->order_date }}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for="Date">${{ $order->amount }}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for="Date">{{ $order->payment_method }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="Date">{{ $order->invoice_no }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="Date">
                                        <span class="badge badge-pill badge-warning" style="background: #418DB9">
                                            {{ $order->status }}</span>
                                        </label>
                                </td>

                                <td class="col-md-1">
                                    <label for="Date">
                                        <a href="{{ url('user/order-details/'.$order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye">View</i></a>
                                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-download"> Invoice</i></a>
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