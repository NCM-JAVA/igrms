@extends('layouts.themes') @section('content')
@php
  $langid1 = session()->get('locale')??1;
@endphp
<section class="banner-bg">
    <div class="">
     <div class="row">
            <section class="banner-bg">
    <div class="">



        <div class="row">
           
	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" class="banner_bottom_btn"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="banner_bottom_btn"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" class="banner_bottom_btn"></button>
  </div>
  
  <div class="carousel-inner">
  @if(!empty($banner)) @php $i = 0; @endphp
  @foreach($banner as $val)
    <div class="carousel-item @if($i==0) active @endif">
      <a href="{{$val->banner_link??''}}"><img src="{{ URL::asset('public/upload/admin/cmsfiles/banner/thumbnail/')}}/{{$val->txtuplode}}" class="banner_img w-100" alt="{{$val->title}}" title=""/></a>
    </div>
	@php $i++; @endphp @endforeach @endif
<div class="carousel-caption d-none d-md-block">
        <h5>DCPW</h5>
      </div>	
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
				

            


            <div class="col-md-3 col-xs-12 pt-lf banner-right">
                <div class="radiusrightBottom">
                </div>
            </div>

        </div>

    </div>
</section>



            <div class="news-section">
                <div class="news-head">
                    <span>What's New</span>
                </div>
                <div class="news-body">
                    <marquee class="marquee" behavior="scroll" direction="left" onMouseOver="this.stop()"
                        onMouseout="this.start()">
						@foreach($whatsnew as $mods) @if($mods->menutype==2)
        <a class="news_text"  target="_blank"  href="{{ url('/public/upload/admin/cmsfiles/whatsnews/') }}/{{$mods->txtuplode}}" title="{{$mods->title}}"> {{$mods->title}}</a>
        @elseif($mods->menutype==3)
        <a class="news_text" target="_blank" href="{{$mods->txtweblink}}" title="{{$mods->title}}">{{$mods->title}}</a>

        @else
        <a class="news_text" target="_blank"  href="@if($mods->page_url=='#') '' @else {{ url('/news') }}/{{$mods->page_url}} @endif" title="{{$mods->title}}"> {{$mods->title}}</a>

        @endif @endforeach
                    </marquee>
                </div>
            </div>


            <div class="col-md-3 col-xs-12 pt-lf banner-right">
                <div class="radiusrightBottom">
                </div>
            </div>

        </div>

    </div>
</section>
<!--end of banner area-->






<div class="banner-bg">
    <div class="container">
        <div class="row pt-3">
            <div class="col-lg-12 col-xs-12 col-md-9">
                <div class="main-section py-2">
                    <div class="top-section mb-4">
                        <div class="row align-items-stretch">
                            <div class="col-lg-3 bg-white shadow-lg rounded">
                                <div class="bw_bg">
                                    <h4 class="my-2 ps-2">Hon'ble Prime Minister</h4>
                                    <img class="img-fluid p-2 minister_img" src="http://125.20.102.85/dcpw/public/themes/th3/assets/images/Narendra_modi.jpg" alt="" srcset="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="column d-flex h-100 flex-column">
                                    <div class="head d-flex justify-content-center align-item-center gap-2 py-3">
                                        <h3 class="my-2">Director's Message</h3>
                                        <i class="fa fa-file-text font-x-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="body overflow-hidden h-100 bw_bg">
                                        <h4>Director's Name</h4>
                                        <p>This Department came into existence on 19.02.1946, initially as `Inspectorate
                                            of Wireless’ and was later accorded the status of Directorate of
                                            Coordination (Police Wireless), a subordinate organisation, under Ministry
                                            of Home Affairs in 1950. It was entrusted with the responsibility of
                                            coordinating for developing and establishing the Police Telecommunication
                                            network in the country and also to advise MHA on all Police
                                            Telecommunication matters, predominant being round the clock communication
                                            between the Centre and State/UT capitals through a network of presently 31
                                            Interstate Police Wireless Stations located in the State/UT capitals.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 bw_bg bg-white shadow-lg rounded">
                                <div>
                                    <div class="bw_bg">
                                    <h4 class="my-2 ps-2">Hon'ble Minister</h4>
                                    <!-- <hr> -->
                                         <img class="img-fluid p-2 minister_img" src="http://125.20.102.85/dcpw/public/themes/th3/assets/images/Amit_shah.png" alt="" srcset="">

                                     </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>

            </div>


        </div>
    </div>
</div>


<!--public notice-->
<section class="banner-bg">
    <div class="container">



        <div class="row">
            <div class="col-lg-12 col-xs-12 col-md-9">
                <div class="main-section py-3">
                    <div class="top-section">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="column bw_bg">
                                    <div class="head d-flex justify-content-center align-item-center gap-2 py-3">
                                        <h3 class="my-2">Latest News</h3>
                                        <i class="fa fa-newspaper-o font-x-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="body overflow-hidden">
                                        <marquee id="mymarquee2" class="marquee" behavior="scroll" direction="up"
                                            Scrollamount="3">

                                            <ul class="ps-0">
                                                @foreach($whatsnew as $mods) @if($mods->menutype==2)
		<li>
         <a class=""  target="_blank"  href="{{ url('/public/upload/admin/cmsfiles/whatsnews/') }}/{{$mods->txtuplode}}" title="{{$mods->title}}"> {{$mods->title}}</a>&nbsp<i class="bi bi-file-pdf" style="color: red;"></i><?php echo $mods->startdate; ?>
		</li>
        @elseif($mods->menutype==3)
		<li>
        <a class="" target="_blank" href="{{$mods->txtweblink}}" title="{{$mods->title}}">{{$mods->title}}</a>&nbsp<i class="bi bi-file-pdf" style="color: red;"></i><?php echo $mods->startdate; ?>
		</li>
        @else
			<li>
        <a class="" target="_blank"  href="@if($mods->page_url=='#') '' @else {{ url('/news') }}/{{$mods->page_url}} @endif" title="{{$mods->title}}"> {{$mods->title}}</a>&nbsp<i class="bi bi-file-pdf" style="color: red;"></i><?php echo $mods->startdate; ?>
		</li>
					@endif @endforeach
                                            </ul>
                                        </marquee>
                                        <div class="view-all mt-20">
                                            <span class="playpause">
                                                <a href="JavaScript:Void(0);" class="start-button" title="Play"
                                                    onClick="document.getElementById('mymarquee2').start();"
                                                    aria-label="Play">
                                                    <i class="fa fa-play"></i></a>
                                                <a href="JavaScript:Void(0);" class="stop-button" title="Pause"
                                                    onClick="document.getElementById('mymarquee2').stop();"
                                                    aria-label="Pause">
                                                    <i class="fa fa-pause"></i></a>
                                            </span>
                                            <span class="pull-right">
                                                <span class=""><a href="#" title="View All">View
                                                        All</a></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="column bw_bg">
                                    <div class="head d-flex justify-content-center align-item-center gap-2 py-3">
                                        <h3 class="my-2">Tender</h3>
                                        <i class="fa fa-file-text font-x-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="body overflow-hidden">
                                        <marquee id="mymarquee2" class="marquee" behavior="scroll" direction="up"
                                            Scrollamount="3">
                                            <ul class="ps-0">
                                                 @foreach($tenders as $mods) @if($mods->menutype==2)
		<li>
         <a class=""  target="_blank"  href="{{ url('public/upload/admin/cmsfiles/tenders/') }}/{{$mods->txtuplode}}" title="{{$mods->title}}"> {{$mods->tender_title}}</a>
		</li>
        @elseif($mods->menutype==2)
		<li>
        <a class="" target="_blank" href="{{$mods->txtuplode}}" title="{{$mods->tender_title}}">{{$mods->tender_title}}</a>
		</li>
        @else
			<li>
        <a class="" target="_blank"  href="@if($mods->page_url=='#') '' @else {{ url('public/upload/admin/cmsfiles/tenders') }}/{{$mods->txtuplode}} @endif" title="{{$mods->tender_title}}"> {{$mods->tender_title}}</a>&nbsp<i class="bi bi-file-pdf" style="color: red;"></i><?php echo $mods->start_date; ?>
		</li>
					@endif @endforeach 
                                            </ul>
                                        </marquee>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="column bw_bg">
                                    <div class="head d-flex justify-content-center align-item-center gap-2 py-3">
                                        <h3 class="my-2">Recruitment</h3>
                                        <i class="fa fa-users font-x-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="body overflow-hidden">
                                        <marquee id="mymarquee" class="marquee" behavior="scroll" direction="up"
                                            Scrollamount="3">
                                            <ul class="ps-0">
                                                @foreach($announcement as $mods) @if($mods->circularstype==5)
		<li>
         <a class=""  target="_blank"  href="{{ url('public/upload/admin/cmsfiles/circulars/') }}/{{$mods->txtuplode}}" title="{{$mods->title}}"> {{$mods->title}}</a>&nbsp<i class="bi bi-file-pdf" style="color: red;"></i><?php echo $mods->startdate; ?>
		</li>
					@endif @endforeach 
                                            </ul>
                                        </marquee>
                                    </div>
                                    <div class="view-all mt-20">
                                        <span class="playpause">

                                            <a href="JavaScript:Void(0);" class="start-button" title="Play"
                                                onClick="document.getElementById('mymarquee').start();"
                                                aria-label="Play">
                                                <i class="fa fa-play"></i></a>

                                            <a href="JavaScript:Void(0);" class="stop-button" title="Pause"
                                                onClick="document.getElementById('mymarquee').stop();"
                                                aria-label="Pause">
                                                <i class="fa fa-pause"></i></a>
                                        </span>
                                        <span class="pull-right">
                                            <span class=""><a href="#" title="View All">View
                                                    All</a></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="column bw_bg">
                                    <div class="head d-flex justify-content-center align-item-center gap-2 py-3">
                                        <h3 class="my-2">Important Notifications</h3>
                                        <i class="fa fa-comments-o font-x-large" aria-hidden="true"></i>
                                    </div>
                                    <div class="body overflow-hidden">
                                        <marquee id="mymarquee2" class="marquee" behavior="scroll" direction="up"
                                            Scrollamount="3">

                                            <ul class="ps-0">
        @foreach($announcement as $mods) @if($mods->circularstype == 4)
		<li>
         <a class=""  target="_blank"  href="{{ url('public/upload/admin/cmsfiles/circulars/') }}/{{$mods->txtuplode}}" title="{{$mods->title}}"> {{$mods->title}}</a><i class="bi bi-file-pdf" style="color: red;"></i><?php echo $mods->startdate; ?>
		</li>
					@endif @endforeach  
                                            </ul>
                                        </marquee>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <button class="blue-btn">
                                <a href="https://gem.gov.in/" class="tiles">
                                    <div class="practise-3-item about_img">
                                        <div>
                                            <div class="icon-box">
                                                <img src="http://125.20.102.85/dcpw/public/themes/th3/assets/images/technical_logo.png" title="Services-Banner"
                                                    alt="E-Services">
                                            </div>
                                            <h5>
												<!-- <a href="https://gem.gov.in/">Technical Information</a> -->
												<a href="{{ route('technical_info') }}"> Technical Information </a>
											</h5>
                                        </div>
                                    </div>
                                </a></button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <button class="blue-btn">
                                <a href="" class="tiles">
                                    <div class="practise-3-item devper_img">
                                        <div class="icon-box"><img src="http://125.20.102.85/dcpw/public/themes/th3/assets/images/publication_logo.png"
                                                title="MasterPlan-Banner" alt="Master Plan"></div>
                                        <h5>
											<!-- <a href="http://cisf.nic.in/">Publications</a> -->
											<a href="{{ route('publication') }}"> Publications </a>
										</h5>
                                    </div>
                                </a></button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12">
                            <button class="blue-btn">
                                <a href="" class="tiles">
                                    <div class="practise-3-item gis_img">
                                        <div class="icon-box"><img src="http://125.20.102.85/dcpw/public/themes/th3/assets/images/employee_logo.png" title="RTI-Banner"
                                                alt="RTI"></div>
                                        <h5><a href="#">Employees Corner</a></h5>
                                    </div>
                                </a></button>
                        </div>


                    </div>


                </div>

            </div>
            <div class="col-lg-3 col-xs-12 col-md-3"></div>
            <div class="right_section home-right-section" id="multilines2">
                <div class="noticeTicker tikerBlock">
                    <h6 class="top_main">
                        Public Notice/Advertisement<span class="ft_rt">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                        </span>
                    </h6>
                    <ul class="noticeTicker-list">

                    </ul>
                    <div class="view-all mt-20">
                        <span class="play">
                            <a href="JavaScript:Void(0);" class="start-button" title="Play" aria-label="Play">
                                <i class="fa fa-play" aria-hidden="true"></i>

                            </a>
                            <a href="JavaScript:Void(0);" class="stop-button" title="Pause" aria-label="Pause"><i
                                    class="fa fa-pause" aria-hidden="true"></i></a>
                        </span>
                        <span class="pull-right">
                            <span class=""><a href="#" title="View All">View
                                    All</a></span>
                        </span>
                    </div>
                </div>

                <div class="orderticker pt-20 tikerBlock">
                    <h3 class="top_main">
                        Orders/Circulars DRDO <span class="ft_rt">
                            <i class="fa fa-first-order" aria-hidden="true"></i>
                        </span>
                    </h3>

                    <ul class="orderticker-list">

                        <li class="border-bottom border-bottom2 border-bottom3 top_main2"></li>

                    </ul>
                    <div class="view-all mt-20">
                        <span class="playpause">
                            <a href="JavaScript:Void(0);" class="start-button" title="Play" aria-label="Play">
                                <i class="fa fa-play"></i></a>
                            <a href="JavaScript:Void(0);" class="stop-button" title="Pause" aria-label="Pause">
                                <i class="fa fa-pause"></i></a>
                        </span>
                        <span class="pull-right">
                            <span class=""><a href="#" title="View All">View
                                    All</a></span>
                        </span>
                    </div>
                </div>




                <!--        NEWS START TICKER  ------------------>
                <div class="newsTicker pt-20 tikerBlock">

                    <h3 class="top_main">
                        What's New<span class="ft_rt">
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>


                        </span>
                    </h3>
                    <ul class="tp-top newsTicker-list">



                    </ul>

                    <div class="view-all p-10 positionunset mt-20">
                        <span class="playpause">
                            <a href="JavaScript:Void(0);" class="start-button" title="Play" aria-label="Play">
                                <i class="fa fa-play"></i></a>
                            <a href="JavaScript:Void(0);" class="stop-button" title="Pause" aria-label="Pause">
                                <i class="fa fa-pause"></i></a>
                        </span>
                        <span class="pull-right">
                            <span class="">
                                <a href="#" title="View All">View All</a></span>
                        </span>
                    </div>
                </div>

                <!--        NEWS END TICKER  ------------------>

            </div>


        </div>





    </div>
</section>
<!--end of public notice-->

<!--six items-->
@endsection