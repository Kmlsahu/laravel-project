@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h3>Coupon Edit</h3>
    <form role="form" action="{{ route('coupon.update', $coupon->id ) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8 box box-primary">
                <div class="form-group">
                    <label for="exampleInputTitle1">Title</label>
                    <input type="name" name="title" class="form-control" id="exampleInputTitle1" placeholder="Enter Title" value="{{ $coupon->title }}">
                    @error('title')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputStatus1">Status</label>
                    <select name="status" id="exampleInputStatus1" class="form-control">
                        <option value="" selected disabled>Status</option>
                        <option value="1" {{ ($coupon->status==1)? 'selected': NULL }}>Enable</option>
                        <option value="2" {{ ($coupon->status==2)? 'selected': NULL }}>Disable</option>
                    </select>
                    @error('status')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputCoupon_Code1">Coupon Code</label>
                    <input type="text" name="coupon_code" class="form-control" id="exampleInputCoupon_Code1" value="{{ $coupon->coupon_code }}">
                    @error('coupon_code')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputValid_From1">Valid From</label>
                    <input type="datetime-local" name="valid_from" class="form-control" id="exampleInputValid_From1" value="{{ $coupon->valid_from }}">
                    @error('valid_from')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputValidTo1">Valid To</label>
                    <input type="datetime-local" name="valid_to" class="form-control" id="exampleInputValidTo1" value="{{ $coupon->valid_to }}">
                    @error('valid_to')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputDiscount_To1">Discount Amount</label>
                    <input type="number" class="form-control" name="discount_amount" id="exampleInputDiscount_To1" step="0.01" placeholder="Enter discount amount" value="{{ $coupon->discount_amount }}">
                    @error('discount_amount')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection