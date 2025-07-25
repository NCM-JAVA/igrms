@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")
     
@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
             
<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->

<div class="row inner_page">
  <div class="sidebar flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
    @include("../themes.th3.includes.sidebar")
    
  </div>

  <div class="col-lg-9 ">
    <div class="content-div px-3">
        <h3 class="">{{$data->officers_name}}</h3>
       <br/>
        <p><?php echo !empty($data->contents)?$data->contents:$data->contents; ?></p>
    </div>


    <span class="page-updated-date px-3 text-align-right">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
  </div>
</div>

@endsection
