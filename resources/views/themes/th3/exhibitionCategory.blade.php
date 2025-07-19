@extends('layouts.themes')

@section('content')
  @include("../themes.th3.includes.breadcrumb")
  <style>
    .card {
      transition: transform 0.3s ease-in-out;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-img-top {
      border-bottom: 1px solid #eee;
    }

    .card-title {
      color: #333;
      font-weight: 600;
    }

    .card-text {
      color: #666;
    }

    @media (min-width: 768px) {
      .row-cols-md-2 > * {
        flex: 0 0 auto;
        width: 50%;
      }
    }
    .image-container {
      position: relative;
      display: inline-block;
      overflow: hidden;
    }

    .thumbnail {
      display: block;
      transition: opacity 0.3s ease;
    }

    .full-size {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      transform: scale(0.8);
      transition: opacity 0.3s ease, transform 0.3s ease;
      pointer-events: none;
    }

    .image-container img {
      transition: opacity 0.3s ease;
    }
    .image-container:hover img {
      opacity: 1;
    }
  </style>
  
  @php
    $pageurl = clean_single_input(request()->segment(2));
    $langid1 = session()->get('locale')??1;
  @endphp 

  <div class="container mx-auto">
    <div class="row inner_page">
      <!-- <div class="sidebar flex-shrink-0 col-md-3 col-lg-3 p-3">
          <div class="left_menu">
              @include("../themes.th3.includes.sidebar")
          </div>
      </div> -->
      <div class="container my-5">
        <h2 class="text-center mb-4">{{ $exhibition_category->category }}</h2>

        @if(!$data->isEmpty())
          <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($data as $val)
              <div class="col">
                <div class="card h-100 shadow">
                  <div class="image-container">
                    <img src="{{ URL::asset('public/upload/admin/cmsfiles/exhibition/thumbnail/' . $val->category_txtuplode) }}" class="thumbnail" alt="{{ $val->title }}" >
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">{{ $val->title }}</h4>
                    <p class="card-text">{{ $val->description }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center">
            <img src="{{ URL::asset('public/upload/admin/cmsfiles/exhibition/thumbnail/' . $exhibition_category->txtuplode) }}" alt="{{ $exhibition_category->category }}" class="img-fluid rounded shadow">
          </div>
        @endif

      </div>
    </div>
  </div>

@endsection