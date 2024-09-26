@extends('layouts.web')

@section('title')
    <title>ThewayShop | Cart</title>
@endsection

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    @if (cartSummaryCount())
        <div class="cart-box-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Images</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quote->items as $item)
                                        <tr>
                                            <td class="thumbnail-img">
                                                <a href="#">
                                                    <img class="" src="{{ productImage($item->product_id) }}"
                                                        alt="" height="100px" />
                                                </a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="#">
                                                    {{ $item->name }}
                                                </a>
                                                <br>
                                                {{-- Decode and display custom options --}}
                                                @if ($item->custom_option)
                                                    @php
                                                        $customOptions = json_decode($item->custom_option, true);
                                                    @endphp

                                                    @foreach ($customOptions as $attrName => $attrValue)
                                                        <strong>{{ $attrName }}:</strong>
                                                        {{ $attrValue }} <br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="price-pr">
                                                <p>₹ {{ $item->price }}</p>
                                            </td>
                                            <td class="quantity-box">
                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        <input type="number" name="qty" size="4"
                                                            value="{{ $item->qty }}" min="1" max="20"
                                                            step="1" class="c-input-text qty text qty-box">
                                                        <div class="update-qty" style="display: none">
                                                            <input type="submit" class="btn btn-dark w-200" value="✓">

                                                        </div>
                                                    </form>
                                                </div>
                                            </td>

                                            <td class="total-pr">
                                                <p>₹ {{ $item->row_total }}</p>
                                            </td>
                                            <td class="remove-pr">
                                                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-lg-6 col-sm-6">
                        @if (session()->has('error'))
                            <div style="color: red;" class="callout callout-danger" style="margin-top: 20px;">
                                {{ session()->get('error') }}
                            </div>
                        @elseif(session()->has('success'))
                            <div style="color: green;" class="callout callout-success" style="margin-top: 20px;">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <form action="{{ route('coupon.apply', $quote->id) }}" method="POST">
                            @csrf
                            <div class="coupon-box">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" name="coupon" value="{{ $quote->coupon }}"
                                        placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                                    <div class="input-group-append">
                                        @if (!$quote->coupon)
                                            <button class="btn btn-theme" name="action" value="apply_coupon"
                                                type="submit">Apply Coupon</button>
                                        @else
                                            <button class="btn btn-theme" name="action" value="cancel"
                                                type="submit">Cancel</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-lg-8 col-sm-12"></div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="order-box">
                            <h3>Order summary</h3>
                            <div class="d-flex">
                                <h4>Sub Total</h4>
                                <div class="ml-auto font-weight-bold">₹ {{ $quote->subtotal }} </div>
                            </div>
                            <div class="d-flex">
                                <h4>Discount</h4>
                                <div class="ml-auto font-weight-bold"> $ 40 </div>
                            </div>
                            <hr class="my-1">
                            <div class="d-flex">
                                <h4>Coupon Discount</h4>
                                <div class="ml-auto font-weight-bold">-₹{{ $quote->coupon_discount ?? 0.0 }}</div>
                            </div>
                            <div class="d-flex">
                                <h4>Tax</h4>
                                <div class="ml-auto font-weight-bold"> $ 2 </div>
                            </div>
                            <div class="d-flex">
                                <h4>Shipping Cost</h4>
                                <div class="ml-auto font-weight-bold"> Free </div>
                            </div>
                            <hr>
                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div class="ml-auto h5">₹ {{ $quote->total }} </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12 d-flex shopping-box"><a href="{{route('checkout')}}"
                            class="ml-auto btn hvr-hover">Checkout</a> </div>
                </div>

            </div>
        </div>
    @endif
    <!-- End Cart -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.qty-box').on('change', function() {
                var form = $(this).closest('form');
                // alert(form);
                form.find('.update-qty').css('display', 'block');
            });
        });
    </script>

@endsection
