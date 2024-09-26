@extends('layouts.web')

@section('title')
    <title>ThewayShop | {{ $products->url_key }}</title>
@endsection

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ $products->name }}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">{{ $products->name }} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($products->getMedia('image') as $image)
                                <div class="carousel-item {{ $i ? 'active' : '' }}"{{ $i = 0 }}> <img
                                        class="d-block w-100" src="{{ $image->getUrl() }}" alt="First slide"
                                        style="height: 400px"> </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                        </a>
                        <ol class="carousel-indicators">
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($products->getMedia('image') as $image)
                                <li data-target="#carousel-example-1" data-slide-to="0"
                                    class="{{ $i ? 'active' : '' }}"{{ $i = 0 }}>
                                    <img class="d-block w-100 img-fluid" src="{{ $image->getUrl() }}"
                                        style="height: 100px" />
                                </li>
                                @endforeach
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{ $products->name }}</h2>
                        @if (getProductPriceShow($products) == $products->special_price)
                            <h5> <del>₹{{ $products->price }}</del> ₹{{ $products->special_price }}</h5>
                        @else
                            <h5> ₹{{ $products->price }}</h5>
                        @endif
                        <p class="available-stock"><span> More than {{ $products->qty }} available / <a href="#">8
                             </a></span>0
                        <p>
                        <h4>Short Description:</h4>
                        {{ $products->short_description }}
                        <form action="{{ route('cart.store', $products->id) }}" method="POST">
                            @csrf
                            <ul>
                                @foreach ($attributes=[] as $attributeName => $attributeValues)
                                    <li>
                                        <div class="form-group size-st">
                                            <label class="size-label">{{ $attributeName }}</label>
                                            <select id="basic_{{ $attributeName }}"
                                                name="attribute_value[{{ $attributeName }}]"
                                                class="selectpicker show-tick form-control">
                                                <option value="">Select {{ $attributeName }}</option>
                                                @foreach ($attributeValues as $attributeValue)
                                                    <option value="{{ $attributeValue->name }}">
                                                        {{ $attributeValue->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                @endforeach
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Quantity</label>
                                        <input class="form-control" name="cart_item" value="1" min="1" max="20"
                                            type="number">
                                    </div>
                                </li>
                            </ul>

                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a>
                                    {{-- <a class="btn hvr-hover" data-fancybox-close="" href="#" type="submit">Add to cart</a> --}}
                                    <button type="submit" class="btn hvr-hover">Add to cart</button>
                                </div>
                            </div>
                        </form>
                        <div class="add-to-btn">
                            <div class="add-comp">
                                <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                                <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to
                                    Compare</a>
                            </div>
                            <div class="share-bar">
                                <a class="btn hvr-hover" href="#"><i class="fab fa-facebook"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-twitter"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p"
                                        aria-hidden="true"></i></a>
                                <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="row px-xl-6">
                <div class="col">
                    <div class="bg-light p-30">
                        <div class="nav nav-tabs mb-4">
                            <a class="nav-item nav-link text-dark active" data-toggle="tab"
                                href="#tab-pane-1">Description</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <p><strong>{{ $products->name }} description:&nbsp;</strong>
                                    {!! $products->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Related Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        @php
                            $rele = getProducts($products->related_product);
                        @endphp
                        @foreach ($rele as $product)
                            <div class="item">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <img src="{{ $product->getFirstMediaUrl('thumbnail_image') }}" class="img-fluid"
                                            alt="Image">
                                        <div class="mask-icon">
                                            <ul>
                                                <li><a href="{{ route('product', $product->url_key) }}"
                                                        data-toggle="tooltip" data-placement="right" title="View"><i
                                                            class="fas fa-eye"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                        title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right"
                                                        title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                            <a class="cart" href="{{ route('product', $product->url_key) }}">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="why-text full-width">
                                        <h4><a href="{{ route('product', $product->url_key) }}" style="text-decoration: none; color: inherit;">{{ $product->name }}</a></h4>
                                        <h5> <del>₹{{ $product->price }}</del> ₹{{ $product->special_price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
@endsection
