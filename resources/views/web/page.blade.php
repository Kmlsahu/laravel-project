@extends('layouts.web')

@section('title')

<title>THEWAYSHOP | {{$pages->title}}</title>
@endsection

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{$pages->title}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{'/'}}">Home</a></li>
                        <li class="breadcrumb-item active">{{$pages->title}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="noo-sh-title">
                         {{ $pages->heading}}
                    </h2>
                    <p>{!! $pages->description !!}</p>

                </div>
                <div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-thumbnail img-fluid" src="{{$pages->getFirstMediaUrl('image')}}" alt="" width="540px" height="540px" />
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- End About Page -->
@endsection