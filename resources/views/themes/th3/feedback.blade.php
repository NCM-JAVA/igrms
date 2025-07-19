@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")

<style>
div#ExampleCaptcha_CaptchaDiv {
    display: flex !important;
}
</style>

@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 

<section class="main">
      <div class="container">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-6 tab-100 order_c">
                    
                    <div class="">
                        <img src="{{ asset('/public/themes/th3/assets/images/feed-left.png') }}" alt="side Img" class="w-100">
                    </div>
                </div>
                <div class="col-md-6 rating-reveal tab-100">
                  @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                          <p>{{ $message }}</p>
                      </div>
                      @endif 
                      @if(Session::has('error'))
                      <div class="alert alert-danger">
                              {{ Session::get('error')}}
                      </div>
                      @endif
                      @if ($errors->any())
                      <div class="alert alert-danger">
                          <strong>Whoops!</strong> There were some problems with your input.<br><br>
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                    <div class="productRating">
                        <h2 class="ratingHead">Feel Free To Drop Us your Feedback.</h2>
                        <form class="form" action="{{route('feed_process')}}" method="post">
                          @csrf
                          <label for="name" class="form_lable">{{get_title('name',$langid1)->title}}</label>
                          <input type="text" name="name" class="form-control form-group"  />
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif

                          <label for="Email" class="form_lable">{{get_title('email',$langid1)->title}}</label>
                          <input type="text" name="email" class="form-control form-group"  />
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif

                          <label for="Message" class="form_lable">Message</label>
                          <textarea name="message" class="form-control form-group"></textarea>
                            @if($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif

                            <div class="row mb-3">
                              <label for="CaptchaCode" class="col-md-4 col-form-label text-md-end">{{get_title('captcha',$langid1)->title}}</label>
                                  <div class="col-md-6">
                                      {!! captcha_image_html('ExampleCaptcha') !!}
                                      <br/>
                                      <input type="text" class="form-control @error('CaptchaCode') is-invalid @enderror" id="CaptchaCode" name="CaptchaCode">
                                      @error('CaptchaCode')
                                          <span class="text-danger invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                      <input type="hidden" value="{{ session()->get('salt') }}" name="salttaxt">
                                  </div>
                            </div>
                          
                          <input class="login-button bg-megenta text-white btn" type="submit" value="{{get_title('submit',$langid1)->title}}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>


  @endsection