@extends('layouts.web')

@section('title')
    <title>ThewayShop | Checkout</title>
@endsection

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Account Login</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Click here to
                            Login</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formLogin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Login</button>
                    </form>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="title-left">
                        <h3>Create New Account</h3>
                    </div>
                    <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to
                            Register</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formRegister">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputName" class="mb-0">First Name</label>
                                <input type="text" class="form-control" id="InputName" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputLastname" class="mb-0">Last Name</label>
                                <input type="text" class="form-control" id="InputLastname" placeholder="Last Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputEmail1" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword1" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword1" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>
            </div>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="checkout-address">
                            <div class="title-left">
                                <h3>Billing address</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" name="billing_name" id="name"
                                        placeholder="" value="{{ old('billing_name') }}">
                                    @error('billing_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email Address *</label>
                                    <input type="email" class="form-control" name="billing_email" id="email"
                                        placeholder="" value="{{ old('billing_email') }}">
                                    @error('billing_email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Mobile *</label>
                                <input type="tel" class="form-control" name="billing_phone" id="phone"
                                    placeholder="" value="{{ old('billing_phone') }}">
                                @error('billing_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" name="billing_address" id="address"
                                    placeholder="" value="{{ old('billing_address') }}">
                                @error('billing_address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address2">Address 2 *</label>
                                <input type="text" class="form-control" name="billing_address_2" id="address2"
                                    placeholder="" value="{{ old('billing_address_2') }}">
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="country">Country *</label>
                                    <select class="wide w-100" id="country" name="billing_country">
                                        <option value="Choose..." data-display="Select">Choose...</option>
                                        <option value="United States">United States</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="state">State *</label>
                                    <select class="wide w-100" id="state" name="billing_state">
                                        <option data-display="Select">Choose...</option>
                                        <option>California</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="city">City *</label>
                                    <select class="wide w-100" id="city" name="billing_city">
                                        <option data-display="Select">Choose...</option>
                                        <option>California</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip *</label>
                                    <input type="text" class="form-control" name="billing_pincode" id="zip"
                                        placeholder="" value="{{ old('billing_pincode') }}">
                                    @error('billing_pincode')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="same-address">
                                        <label class="custom-control-label" for="same-address">Shipping address is the
                                            same as my
                                            billing address</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="ship_to_different_address"
                                            class="custom-control-input" id="shipto">
                                        <label class="custom-control-label" for="shipto" data-toggle="collapse"
                                            data-target="#shipping-address">Ship to different address</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-address collapse" id="shipping-address">
                            <div class="title-left">
                                <h3>Shipping address</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" name="shipping_name" id="name1"
                                        placeholder="" value="{{ old('shipping_name') }}">
                                    @error('shipping_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email *</label>
                                    <input type="text" class="form-control" name="shipping_email" id="email1"
                                        placeholder="" value="{{ old('shipping_email') }}">
                                    @error('shipping_email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="phone">Mobile *</label>
                                <input type="tel" class="form-control" name="shipping_phone" id="phone1"
                                    placeholder="" value="{{ old('shipping_phone') }}">
                                @error('shipping_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" name="shipping_address" id="address_1"
                                    placeholder="" value="{{ old('shipping_address') }}">
                                @error('shipping_address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address2">Address 2 *</label>
                                <input type="text" class="form-control" name="shipping_address_2" id="address_2"
                                    placeholder="" value="{{ old('shipping_address_2') }}">
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="country">Country *</label>
                                    <select class="wide w-100" id="country" name="shipping_country">
                                        <option value="Choose..." data-display="Select">Choose...</option>
                                        <option value="United States">United States</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="state">State *</label>
                                    <select class="wide w-100" id="state" name="shipping_state">
                                        <option data-display="Select">Choose...</option>
                                        <option>California</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="city">City *</label>
                                    <select class="wide w-100" id="city" name="shipping_city">
                                        <option data-display="Select">Choose...</option>
                                        <option>California</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip *</label>
                                    <input type="text" class="form-control" name="shipping_pincode" id="zip1"
                                        placeholder="" value="{{ old('shipping_pincode') }}">
                                    @error('shipping_pincode')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="shipping-method-box">
                                    <div class="title-left">
                                        <h3>Shipping Method</h3>
                                    </div>
                                    <div class="mb-4">
                                        <div class="custom-control custom-radio">
                                            <input id="shippingOption1" name="shipping_method" value="standard_delivery"
                                                class="custom-control-input" checked="checked" type="radio"
                                                data-cost="0.00">
                                            <label class="custom-control-label" for="shippingOption1">Standard Delivery
                                                (Free)</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="shippingOption2" name="shipping_method" value="express_delivery"
                                                class="custom-control-input" type="radio" data-cost="50">
                                            <label class="custom-control-label" for="shippingOption2">Express Delivery
                                                (₹50)</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="shippingOption3" name="shipping_method" value="next_business_day"
                                                class="custom-control-input" type="radio" data-cost="100">
                                            <label class="custom-control-label" for="shippingOption3">Next Business day
                                                (₹100)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">
                                    <div class="title-left">
                                        <h3>Shopping cart</h3>
                                    </div>
                                    <div class="rounded p-2 bg-light">
                                        @foreach ($quote->items as $item)
                                            <div class="media mb-2 border-bottom">
                                                <div class="media-body">
                                                    <img class="" src="{{ productImage($item->product_id) }}"
                                                        alt="" height="50px" />
                                                    <a href="detail.html">{{ $item->name }}</a>
                                                    <div class="small text-muted">Price: ₹ {{ $item->price }} <span
                                                            class="mx-2">|</span> Qty:
                                                        {{ $item->qty }} <span class="mx-2">|</span> Subtotal: ₹
                                                        {{ $item->row_total }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="order-box">
                                    <div class="title-left">
                                        <h3>Your order</h3>
                                    </div>
                                    <div class="d-flex">
                                        <div class="font-weight-bold">Product</div>
                                        <div class="ml-auto font-weight-bold">Total</div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex">
                                        <h4>Sub Total</h4>
                                        <div class="ml-auto font-weight-bold"> ₹ {{ $quote->subtotal }} </div>
                                    </div>
                                    <div class="d-flex">
                                        <h4>Discount</h4>
                                        <div class="ml-auto font-weight-bold"> $ 40 </div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex">
                                        <h4>Coupon Discount</h4>
                                        <div class="ml-auto font-weight-bold"> -₹
                                            {{ $quote->coupon_discount ?? 0.0 }}
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <h4>Tax</h4>
                                        <div class="ml-auto font-weight-bold"> $ 2 </div>
                                    </div>
                                    <div class="d-flex">
                                        <h4>Shipping Cost</h4>
                                        <div class="ml-auto font-weight-bold shipping_cost_sdd">+₹0.00</div>
                                    </div>
                                    <hr>
                                    <div class="d-flex gr-total">
                                        <h5>Grand Total</h5>
                                        <input type="hidden" class="total_amount_first" value="{{ $quote->total }}">
                                        <div class="ml-auto h5 total_amount"> ₹ {{ $quote->total }} </div>
                                    </div>
                                    <hr>

                                    <hr class="mb-4">
                                    <div class="title"> <span>Payment</span> </div>
                                    <div class="d-block my-3">
                                        <div class="custom-control custom-radio">
                                            <input id="credit" name="payment" type="radio"
                                                class="custom-control-input" value="credit_card">
                                            <label class="custom-control-label" for="credit">Credit card</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="debit" name="payment" type="radio"
                                                class="custom-control-input" value="debit_card">
                                            <label class="custom-control-label" for="debit">Debit card</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="paypal" name="payment" type="radio"
                                                class="custom-control-input" value="paypal">
                                            <label class="custom-control-label" for="paypal">Paypal</label>
                                        </div>
                                    </div>

                                    {{-- <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place
                                        Order</button> --}}

                                    <div class="col-12 d-flex shopping-box"> <button type="submit"
                                            class="ml-auto btn hvr-hover" style=" padding: 10px 20px; font-weight: 700; color: #ffffff; border: none;">Place Order</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Cart -->





    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $('input[name="shipping_method"]').change(function() {
            const cost = parseInt($(this).data('cost'));

            $('.shipping_cost_sdd').text('₹ ' + cost);

            // var amount = parseFloat($('.total_amount').text().replace('₹ ', ''));
            var amount = parseFloat($('.total_amount_first').val());
            var total = amount + cost;

            $('.total_amount').text('₹ ' + total);

            // alert('New Total Amount: ₹' + total);
        });
    </script>
@endsection
