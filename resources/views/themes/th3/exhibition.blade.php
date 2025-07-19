@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")

@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 

<div class="container">
    <div class="row inner_page">
        <div class="sidebar flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
            <div class="left_menu">
                @include("../themes.th3.includes.sidebar")
            </div>
        </div>

        <div class="col-lg-9 ">
            <div class="content-div ">
                <h3 class="">{{$title}}</h3>
            </div>
            <div class="row d-flex">
                @foreach($data as $val)
                    <div class="col-6 col-md-4 p-1">
                        <div class="photo-card">
                            <img style="aspect-ratio:4/2.5" src="{{ URL::asset('public/upload/admin/cmsfiles/exhibition/thumbnail/' . $val->txtuplode) }}" alt="Image 1">

                            <form action="{{ url('pages/exhibition-category-details') }}" method="GET" class="w-100">
                                
                                <input type="hidden" name="id" value="{{ $val->id }}" />
                                <button type="submit" class="w-100 text-end colorVoilet fw-bolder readmore border p-2 text-nowrap">
                                    {{ $val->category??''}}
                                    <i class="fa-solid fa-arrow-up-right-from-square right_up_arrow"></i>
                                </button>
                            </form>
                            <!-- <a href="{{ url('pages/exhibition-details', $val->id) }}" style="color:#000 !important">
                                <div class="category">{{ $val->category??''}}</div>
                            </a> -->
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- <p class="page-updated-date px-3 text-align-right">{{get_title('lastupdate',$langid1)->title}}:
                {{ get_last_updated_date($title) }} </p> -->
        </div>
    </div>
</div>

@endsection