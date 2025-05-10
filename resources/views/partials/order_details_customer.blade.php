<style>
    .card {
        position: relative;
        height: 17rem;
        width: 48rem;
        aspect-ratio: 5/7;
        color: #ffffff;
        perspective: 50rem;
        background: #fff;
    }
.card::after {
    content: "";
    position: absolute;
    background: transparent;
    width: 386px;
    height: 442px;
    background-size: contain;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>

<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{__('Order id')}}: {{ $order->code }}</h5>
    
    <button type="button" class="close absolute-close-btn" style="background: transparent;border: 0;font-size: 20px;"
                data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
</div>

@php
    //dump($order);
    $status = $order->orderDetails->first()->delivery_status;
    $refund_request_addon = \App\Models\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="modal-body gry-bg px-3 pt-0">
    {{-- <div class="pt-4">
        <ul class="process-steps clearfix" style="display:flex;justify-content:space-evenly;">
            <li @if($status == 'pending') class="active" @else class="done" @endif>
                
                <div class="title">1 {{__('Order placed')}}</div>
            </li>
            <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif>
                
                <div class="title">2 {{__('On review')}}</div>
            </li>
            <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done" @endif>
                
                <div class="title">3 {{__('On delivery')}}</div>
            </li>
            <li @if($status == 'delivered') class="done" @endif>
                
                <div class="title">4 {{__('Delivered')}}</div>
            </li>
        </ul>
    </div> --}}
    <div class="card mt-4">
        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
            <div class="float-left text-black">{{__('Order Summary')}}</div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{__('Order Code')}}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Customer')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Email')}}:</td>
                            @if ($order->user_id != null)
                                <td>{{ $order->user->email }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Billing address')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{__('Order date')}}:</td>
                            <td>{{ date('d-m-Y H:m A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Order status')}}:</td>
                            {{--<td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>--}}
                          	<td>{{ ($order->payment_status == 'paid') ? 'Paid' : 'Failed' }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Total order amount')}}:</td>
                            <td>{{ $order->grand_total_currency.($order->grand_total_currency_price) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Payment method')}}:</td>
                            <td>Debit/Credit card  </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card mt-4" style="width: 32rem;overflow: auto;">
                <div class="card-header py-2 px-3 heading-6 strong-600 text-black">{{__('Order Details')}}</div>
                <div class="card-body pb-0">
                    <table class="details-table table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="60%">{{__('Product')}}</th>
                                {{--<th>{{__('Variation')}}</th>--}}
                                <th>{{__('Qty')}}</th>
                                {{--<th>{{__('Delivery Type')}}</th>--}}
                                <th>{{__('Price')}}</th>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                    <th>{{__('Refund')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if ($orderDetail->product != null)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a>
                                        @else
                                            <strong>{{ __('Product Unavailable') }}</strong>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        {{ $orderDetail->quantity }}
                                    </td>
                                    <td>{{ $order->grand_total_currency.bcdiv(convertPrice($orderDetail->price),1,2)}}</td>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        @php
                                            $no_of_max_day = \App\Models\BusinessSetting::where('type', 'refund_request_time')->first()->value;
                                            $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                            $today_date = Carbon\Carbon::now();
                                        @endphp
                                        <td>
                                            @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered')
                                                <a href="{{route('refund_request_send_page', $orderDetail->id)}}" class="btn btn-styled btn-sm btn-base-1">{{ __('Send') }}</a>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                <span class="strong-600">{{ __('Pending') }}</span>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                <span class="strong-600">{{ __('Approved') }}</span>
                                            @elseif ($orderDetail->product->refundable != 0)
                                                <span class="strong-600">{{ __('N/A') }}</span>
                                            @else
                                                <span class="strong-600">{{ __('Non-refundable') }}</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mt-4" style="width: 15rem;">
                <div class="card-header py-2 px-3 heading-6 strong-600 text-black">{{__('Order Ammount')}}</div>
                <div class="card-body pb-0">
                    <table class="table details-table">
                        <tbody>
                            <tr>
                                <th>{{__('Subtotal')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">{{ $order->grand_total_currency.$order->grand_total_currency_price }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Tax')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ $order->grand_total_currency.$order->orderDetails->sum('tax') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Coupon Discount')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ $order->grand_total_currency.$order->coupon_discount }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="strong-600">{{__('Total')}}</span></th>
                                <td class="text-right">
                                    <strong><span>{{ $order->grand_total_currency.$order->grand_total_currency_price }}</span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{--
            @if ($order->manual_payment && $order->manual_payment_data == null)
                <button onclick="show_make_payment_modal({{ $order->id }})" class="btn btn-block btn-base-1">{{__('Make Payment')}}</button>
            @endif
            --}}
        </div>
    </div>
</div>

<script type="text/javascript">
    function show_make_payment_modal(order_id){
        $.post('{{ route('checkout.make_payment') }}', {_token:'{{ csrf_token() }}', order_id : order_id}, function(data){
            $('#payment_modal_body').html(data);
            $('#payment_modal').modal('show');
            $('input[name=order_id]').val(order_id);
        });
    }
</script>
