@extends('layouts.themes') @section('content') @include("../themes.th3.includes.breadcrumb")
<!--************************breadcrumb********************-->
@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
<!--**********************************mid part******************-->

<div class="row inner_page">
    <div class="sidebar flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
        @include("../themes.th3.includes.sidebar")
    </div> 
	
	
<section>
    <div class="container">
        <div class="row">
          
        <div class="col-xs-12 col-sm-12">
<div class="content-div">
<h2>Tourist Destination</h2>

</div>
</div>


        </div>
    </div>
</section>

@endsection
