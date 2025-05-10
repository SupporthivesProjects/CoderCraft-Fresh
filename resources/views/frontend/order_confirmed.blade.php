@extends('frontend.layouts.app')
@section('content')
    @if (Session::has('order_code'))
        @php
            $order_code = Session::get('order_code');
        @endphp
    @else
        @php
            $order_code = 'Session expired';
        @endphp
    @endif

    @if (Session::has('order_date'))
        @php
            $order_date = Session::get('order_date');
        @endphp
    @else
        @php
            $order_date = 'Session expired';
        @endphp
    @endif

    


    <section class="pay_S">
        <div class="PayS_div1">
            <img src="{{ asset('frontend/BrandSparkz/assets/img/intersect.png') }}" alt="" class="intersect">
            <div class="container">
                <div class="terms_div1">
                    <h3 class="terms_heading">Payment Successful</h3>
                    <p class="para_terms">Lorem ipsum dolor sit amet consectetur. Purus eget arcu non suscipit id.</p>
                </div>
            </div>
        </div>
        <div class="term2_main Ps_main">
            <div class="div_for_pS">
                <div class="div_for_ps_inner">
                    <h3 class="heading_of_pS">Order Summary</h3>
                </div>
                <table class="table table-borderless ">
                    <thead>
                        <tr class="table_ps">
                            <th scope="col">
                                <p class="head_ps">Product</p>
                            </th>
                            <th scope="col">
                                <p class="head_ps">No.&nbsp;Months</p>
                            </th>
                            <th scope="col">
                                <p class="head_ps for_center">Qty</p>
                            </th>
                            <th scope="col">
                                <p class="head_ps for_total1">Subtotal</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total=0;
                        @endphp
                        @foreach ($order as $key => $orderDetail)
                        @php
                           $product = \App\Models\Product::find($orderDetail->product->id);
                           $total = $total + round(convert_price($orderDetail->price),2);                           
                        @endphp
                        <tr class="table_ps">
                            <td scope="row">
                                <p class="data_ps"><span>{{ $product->name }}</span></p>
                            </td>
                            <td>
                                <p class="data_ps">{{ $product->subscription }}</p>
                            </td>
                            <td>
                                <p class="data_ps for_center">{{ $orderDetail->quantity }}</p>
                            </td>
                            <td>
                                <p class=" for_total">{{ single_price($orderDetail->price) }}</p>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td>
                                <p class="head_ps for_subtotal for_center">Total</p>
                            </td>
                            <td>
                                <p class="for_total for_bottom">{{ currency_symbol() }}{{ number_format($total,2) }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn_ps" onclick="window.location.href='{{ route('home') }}'">Return home</button>
            </div>
        </div>
    </section>

@endsection
@section('script')
   
@endsection
