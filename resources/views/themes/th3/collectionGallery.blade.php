@extends('layouts.themes')

@section('content')
    @include("../themes.th3.includes.breadcrumb")

    @php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
    @endphp 

    <div class="container mx-auto">
    <div class="row inner_page">
        <!-- <div class="sidebar flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
            <div class="left_menu">
                @include("../themes.th3.includes.sidebar")
            </div>
        </div> -->

        <div class="col">
            <div class="content-div">
                <h3 class="">{{$title}}</h3>
            </div>
            <div class="row d-flex">
                <div class="container">
                    <div class="wrapper">
                    <div class="collection_readmore">
                        <div class="collection_content">
                            <h2 class="collection_title">{{ $data->title }}</h2>
                            <div class="collection_gallery">
                                @php
                                    $images = explode(',', $data->txtuplode);
                                @endphp
                                @foreach($images as $image)
                                    <div class="collection_image">
                                        <img src="{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/' . $image) }}" alt="Collection Image">
                                    </div>
                                @endforeach
                            </div>
                            <p class="collection_description">{{ $data->description }}</p>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection