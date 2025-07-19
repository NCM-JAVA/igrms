@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")

@php
  $pageurl = clean_single_input(request()->segment(2));
  $id = session()->get('locale')??1;
  $id1=!empty($m_flag_id)?$m_flag_id:$id;
  $pos=[1,4,2];
  $langid1 = session()->get('locale')??1;
  $res= get_menu($langid1,$pos,$id1);
@endphp

  <?php $hasSubmenu = false; ?>
  @foreach($res as $menuItem)
      <?php 
          $hasSubmenu = true; 
          break; 
      ?>
  @endforeach

<div class="container">
<div class="row inner_page">
  <div class="sidebar flex-shrink-0 {{ $hasSubmenu == false ? 'd-none' : 'col-md-3 col-lg-3 pe-3' }} ">
    <div class="left_menu">
      @include("../themes.th3.includes.sidebar")
    </div>
  </div>

  <div class="{{ $hasSubmenu == false ? 'col-12 col-lg-12 col-md-12' : 'col-12 col-lg-9 col-md-9' }} print_content">
    <div class="content-div pe-md-3 inner_page_start">
      <h3 class="">{{$data->m_name}}</h3>
      <p><?php echo !empty($data->content) ? $data->content : $data->description; ?></p>
    </div>
    </div>

    <!-- <span class="page-updated-date px-3 text-align-right print_remove">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span> -->
  </div>
</div>

@endsection