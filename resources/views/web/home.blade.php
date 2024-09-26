@extends('layouts.web')

@section('title')
    <title>ThewayShop</title>
@endsection

@section('content')

<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        <?php
        $i = 1;
        ?>
        @foreach($sliders as $slider)
        <li class="text-left <?= ($i) ? 'active' : ''; $i = 0 ?>">
            <img src="{{$slider->getFirstMediaUrl('image')}}" alt="" height="658.642px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>{{$slider->title}}<br>Welcome To <br> Thewayshop</strong></h1>
                        <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                        <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>

    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>

<!-- Start Categories  -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            @foreach(MidlCategory() as $category)

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{$category->getFirstMediaUrl('thumbnail_image')}}" alt="" />
                    <a class="btn hvr-hover" href="{{ route('category', $category->url_key) }}">{{$category->name}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Categories -->

<!-- Start Products  -->
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Products</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                </div>
            </div>
        </div>

        <div class="row special-list">
            @foreach(Product() as $product)
            <div class="col-lg-3 col-md-6 special-grid">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <div class="type-lb">
                            <p class="sale">Sale</p>
                        </div>
                        <img src="{{$product->getFirstMediaUrl('thumbnail_image')}}" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="{{ route('product', $product->url_key) }}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="{{ route('product', $product->url_key) }}">Add to Cart</a>
                        </div>
                    </div>

                    <div class="why-text full-width">
                        {{-- <h2>{{ $product->name }}</h2> --}}
                        <h2>
                            <a href="{{ route('product', $product->url_key) }}" style="text-decoration: none; color: inherit;">
                              {{ $product->name }}
                            </a>
                          </h2>
                        @if (getProductPriceShow($product) == $product->special_price)
                            <h5> <del>₹{{ $product->price }}</del>
                                ₹{{ $product->special_price }}</h5>
                        @else
                            <h5> ₹{{ $product->price }}</h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach                    
        </div>
    </div>
</div>
<!-- End Products  -->
@endsection