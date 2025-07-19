  
@extends('layouts.themes') @section('content')
@php
  $langid1 = session()->get('locale')??1;
@endphp
    
    <!--** <section class="position-relative">
        <div class="carousel slide kb-carousel carousel-fade vh-100" id="carouselKenBurns" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>

          <div class="carousel-inner vh-100">

            @foreach($banner as $val)
            <div class="carousel-item active vh-100" data-bs-interval="6000">
              <img src="{{ URL::asset('public/upload/admin/cmsfiles/banner/thumbnail/')}}/{{$val->txtuplode}}" class="main_img d-block w-100 vh-100" alt="{{$val->title}}" title=""/>
              
              <div class="header_text">
                <div class="container">
                <h2 data-animation="animated">{{$val->title}}</h2>
                <span class="bottom_border_banner"></span>
                <h3 data-animation="animated">{{$val->description ? $val->description : 'A zoom effect with CSS3 new'}}</h3>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <button class="carousel-control-prev kb-control-prev" type="button"
            data-bs-target="#carouselKenBurns" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next kb-control-next" type="button"
            data-bs-target="#carouselKenBurns" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>***88--->
      <section class="position-relative">
  <div class="carousel slide kb-carousel vh-100" id="carouselKenBurns" data-bs-ride="carousel">

    {{-- Indicators --}}
    <div class="carousel-indicators">
      @foreach($banner as $key => $val)
        <button type="button"
                data-bs-target="#carouselKenBurns"
                data-bs-slide-to="{{ $key }}"
                class="{{ $key == 0 ? 'active' : '' }}"
                aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                aria-label="Slide {{ $key + 1 }}"></button>
      @endforeach
    </div>

    {{-- Slides --}}
    <div class="carousel-inner vh-100">
      @foreach($banner as $val)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }} vh-100" data-bs-interval="6000">
          <img src="{{ URL::asset('public/upload/admin/cmsfiles/banner/thumbnail/') }}/{{ $val->txtuplode }}"
               class="d-block w-100 h-100"
               style="object-fit: cover;"
               alt="{{ $val->title }}"
               title="{{ $val->title }}" />

          {{-- Optional text overlay --}}
          <div class="header_text">
            <div class="container text-center">
              <h2>{{ $val->title }}</h2>
              <span class="bottom_border_banner"></span>
              <h3>{{ $val->description ?: 'A static image slider' }}</h3>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Controls --}}
    <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselKenBurns" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button"
            data-bs-target="#carouselKenBurns" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>



      <!-- ********************Important links and news section https://codepen.io/erickarbe/pen/DEjqxv ******************** -->
      <section class="imp-links">
        <div class="container py-3">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="h-100">
                <div class="row bg-megenta h-inherit rounded-3">

                  <div class="mt-0 d-flex justify-content-between">
                    <div class="my-auto w-50">
                      <a href="{{ URL::to('pages/tenders') }}"
                        class="gap-2 p-3 link-item d-flex align-items-center text-decoration-none ms-4">
                        <!-- <img src="logo2.png" alt="Logo 1"> -->
                        <i class="fa-solid fa-book fs-1"></i>
                        <p
                          class="my-0 link-text fw-medium">Tenders</p>
                      </a>
                    </div>

                    <div class="d-flex">
                      <div class="my-2 vertical-rule"></div>
                    </div>

                    <div class="my-auto w-50">
                      <a href="#"
                        class="gap-2 p-3 link-item d-flex align-items-center text-decoration-none ms-4">
                        <i class="fa-solid fa-ticket fs-1"></i>
                        <p class="my-0 link-text fw-medium">E-Ticketing</p>
                      </a>
                    </div>
                  </div>
                  <div class="mt-0 d-flex" style="width: 100%;">
                    <hr class="mx-5 my-0 border-2 border-white opacity-100"
                      style="width: 100%;">
                    <hr class="mx-5 my-0 border-2 border-white opacity-100"
                      style="width: 100%;">
                  </div>
                  <div class="mt-0 d-flex justify-content-between">
                    <div class="my-auto w-50">
                      <a href="./pages/who-is-who"
                        class="gap-2 p-3 link-item d-flex align-items-center text-decoration-none ms-4">
                        <i class="fa-solid fa-users fs-1"></i>
                        <p class="my-0 link-text fw-medium">Who-is-Who</p>
                      </a>
                    </div>
                    <div class="d-flex">
                      <div class="my-2 vertical-rule"></div>
                    </div>
                    <div class="my-auto w-50">
                      <a href="#"
                        class="gap-2 p-3 link-item d-flex align-items-center text-decoration-none ms-4">
                        <i class="fa-regular fa-clock fs-1"></i>
                        <p class="my-0 link-text fw-medium">Museum Timings</p>
                      </a>
                    </div>
                  </div>
                  <div class="mt-0 d-flex" style="width: 100%;">
                    <hr class="mx-5 my-0 border-2 border-white opacity-100"
                      style="width: 100%;">
                    <hr class="mx-5 my-0 border-2 border-white opacity-100"
                      style="width: 100%;">
                  </div>
                  <div class="mt-0 d-flex justify-content-between">
                    <div class="my-auto w-50">
                      <a href="./public/upload/files/RatesofPaidservicesofIGRMS.pdf"
                        class="gap-2 p-3 link-item d-flex align-items-center text-decoration-none ms-4">
                        <i class="fa-solid fa-photo-film fs-1"></i>
                        <!--<p class="my-0 link-text fw-medium">Gallery
                          Section</p>-->
						<p class="my-0 link-text fw-medium">Rates of Paid services</p>
                      </a>
                    </div>
                    <div class="d-flex">
                      <div class="my-2 vertical-rule"></div>
                    </div>
                    <div class="my-auto w-50">
                      <a href="#"
                        class="gap-2 p-3 link-item d-flex align-items-center text-decoration-none ms-4">
                        <i class="fa-solid fa-briefcase fs-1"></i>
                        <p class="my-0 link-text fw-medium">E-Office</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="event-section h-100">
                <!-- <div class="px-3 pt-2 mb-2 d-flex justify-content-between">
                  <h5> 
                    @if($langid1 == 1)
                      Announcements
                    @else
                      घोषणाएँ
                    @endif
                  </h5>
                  <div class="px-2 border border-danger">
                    <a class="text-dark" href="{{ url('/pages/announcements') }}">View All</a>
                  </div>
                </div> -->
                <div class="mx-3 holder">
                  <!-- <ul id="ticker01">
                    @foreach($announcement as $val)
                    <li><i class="fa-solid fa-arrow-right"></i><a target="_blank" href="{{ URL::asset('public/upload/admin/cmsfiles/circulars/')}}/{{$val->txtuplode}}">{{$val->title}}</a></li>
                    <hr class="my-1">
                    @endforeach
                  </ul> -->

                  <nav class="d-flex justify-content-between">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><h5> 
                        <h5 class="text-dark">
                        @if($langid1 == 1)
                          Announcements
                        @else
                          घोषणाएँ
                        @endif</h5>
                      </button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        <h5 class="text-dark">
                        @if($langid1 == 1)
                          Vacancy
                        @else
                          रिक्ति
                        @endif</h5>
                      </button>
                      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                        <h5 class="text-dark">
                        @if($langid1 == 1)
                          Circulars
                        @else
                          परिपत्र
                        @endif</h5>
                      </button>
                    </div>
                    <div class="px-2 my-auto border border-danger">

                      <a class="text-dark" id="view-all-link" href="{{ url('/pages/announcements') }}">View All</a>
                      <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const tabLinks = document.querySelectorAll('.nav-link');
                            const viewAllLink = document.getElementById('view-all-link');

                            tabLinks.forEach(tab => {
                                tab.addEventListener('click', function () {
                                    if (tab.id === 'nav-home-tab') {
                                        viewAllLink.href = '{{ url("/pages/announcements") }}';
                                    } else if (tab.id === 'nav-profile-tab') {
                                        viewAllLink.href = '{{ url("/pages/vacancy") }}';
                                    } else if (tab.id === 'nav-contact-tab') {
                                        viewAllLink.href = '{{ url("/pages/circulars") }}';
                                    }
                                });
                            });
                        });
                    </script>
                    
                  </div>
                  </nav>
                  <div class="m-2 tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active nav_tab_selec logo-slider-Y" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                      <ul class="pb-2 logos-slide-Y nav_tab_sel h-100" id="ticker01">
                        @foreach($announcement as $val)
                        <li><i class="fa-solid fa-arrow-right"></i><a target="_blank" href="{{ URL::asset('public/upload/admin/cmsfiles/circulars/')}}/{{$val->txtuplode}}">{{$val->title}}</a></li>
                        <hr class="my-1">
                        @endforeach
                      </ul>
                    </div>
                    <div class="tab-pane fade nav_profile_selec logo-slider-Y" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <ul class="pb-2 logos-slide-Y h-100 nav_profile_sel" id="ticker01">
                        @foreach($vacancy as $val)
                          <li><i class="fa-solid fa-arrow-right"></i><a target="_blank" href="{{ URL::asset('public/upload/admin/cmsfiles/vacancy/')}}/{{$val->txtuplode}}">{{$val->title}}</a></li>
                          <hr class="my-1">
                        @endforeach
                      </ul>
                    </div>
                    <div class="tab-pane fade nav_contact_selec logo-slider-Y" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                      <ul class="pb-2 logos-slide-Y h-100 nav_contact_sel" id="ticker01">
                        @foreach($circular as $val)
                          <li><i class="fa-solid fa-arrow-right"></i><a target="_blank" href="{{ URL::asset('public/upload/admin/cmsfiles/circulars/')}}/{{$val->txtuplode}}">{{$val->title}}</a></li>
                          <hr class="my-1">
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
                  <script>
                      var copy = document.querySelector(".nav_tab_sel").cloneNode(true);
                      document.querySelector(".nav_tab_selec").appendChild(copy);

                      var copy = document.querySelector(".nav_profile_sel").cloneNode(true);
                      document.querySelector(".nav_profile_selec").appendChild(copy);

                      var copy = document.querySelector(".nav_contact_sel").cloneNode(true);
                      document.querySelector(".nav_contact_selec").appendChild(copy);
                  </script>
      </section>

      <!-- ********************about us and 360 VR section ******************** -->

      <section class="py-3 bg_gray">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-8 ps-lg-0">
              <div class="border-4 border-start border-warning">
                <h3 class="ms-2 text-dark fw-bold text-capitalize">
                  @if($langid1 == 1)
                    About the Museum
                  @else
                    संघ्रालय के बारे में
                  @endif
                </h3>
              </div></BR>
             
              <div class="about_text text-dark justify"> {!! strip_tags($sanghralaya->description, '<p><b><i><ul><ol><li><strong><em>') !!} </div>
            </div>
            <!-- 360 photo viewer section -->
            <div class="col-12 col-md-4" style="text-align-last:end">
                <a href="{{ url('pages/sanghralaya') }}" class="py-2 bg-white viewall borderVoilet text-nowrap" style="color:#000 !important">
                  View All 360VR
                  <i class="px-4 fa-solid fa-arrow-right arrow_icon"></i>
                </a> 

                <?php
                    $lastItem = $sanghralaya->first();
                ?>
                <div class="mt-3 sanghralaya_image">
                  <!-- @if($lastItem->txtuplode)
                    <img class="myCrop-img img-fluid" src="{{ URL::asset('public/upload/admin/cmsfiles/sanghralaya/thumbnail/')}}/{{$lastItem->txtuplode}}" class="card-img-top" alt="...">
                  @endif -->

                  <div id="panorama"></div>
                </div>

                <script>
                    pannellum.viewer('panorama', {
                        "type": "equirectangular",
                        "panorama": "{{ URL::asset('public/upload/admin/cmsfiles/sanghralaya/thumbnail/')}}/{{$lastItem->txtuplode}}",  
                        "autoLoad": true,               // Automatically loads the panorama
                        "autoRotate": -2,               // Enables auto-rotation
                        "autoRotateInactivityDelay": 3000 // Resumes auto-rotation after 3 seconds of inactivity
                    });
                </script>
                
            </div>
          </div>
        </div>
      </section>

      <!-- ******************* Exhivition section section ******************* -->
      <div class="py-2 bg-opacity-25 bg-secondary">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6 ps-lg-0">
              <!-- carousel part start  -->
              <div class="bg-white">
                <div class="border-2 border-bottom">
                  <h3 class="pt-2 ms-2 text-dark fw-normal text-capitalize">
                    @if($langid1 == 1)
                      Programme And Activities
                    @else       
                      प्रदर्शनी गैलरी
                    @endif
                  </h3>
                </div>
                <div id="carouselExample" class="p-1 carousel slide"
                  data-bs-ride="carousel">

                  <div class="carousel-inner exhibition_gallery">
                    @foreach($exhibition as $val)
                    <div class="carousel-item active">
                      <img
                        src="{{ URL::asset('public/upload/admin/cmsfiles/exhibition/thumbnail/')}}/{{$val->txtuplode}}"
                        class="d-block w-100 mid_carousel" alt="Slide 1">
                    </div>
                    @endforeach
                  </div>

                  <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark"
                      aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark"
                      aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="bg-white d-flex flex-column h-100">
                <div class="border-2">

                  <div class="row">
                    <div class="col-md-7">
                      <h3 class="pt-2 ms-2 text-dark fw-normal text-capitalize">
                        @if($langid1 == 1)
                          Exhibitions
                        @else
                          प्रदर्शनी श्रेणी
                        @endif
                      </h3>
                    </div>
                    <div class="mt-3 col-md-5 exhibition_viewall_btn">
                      <a href="{{ url('pages/exhibition') }}" class="py-2 text-right bg-white viewall borderVoilet text-nowrap" style="color:#000 !important">
                        View All
                        <i class="px-4 fa-solid fa-arrow-right arrow_icon"></i>
                      </a> 
                    </div>
                  </div>
                </div>

                <div class="d-flex flex-column justify-content-around h-100">

                  @foreach($exhibition as $val)
                    <div class="gap-3 mx-2 shadow d-flex">
                      <img
                        src="{{ URL::asset('public/upload/admin/cmsfiles/exhibition/thumbnail/')}}/{{$val->txtuplode}}"
                        alt srcset class="exhibition-img img-fluid">
                      <div class="my-auto">
                        <h5 class="text-megenta exhibition_heading">{{$val->category}}</h5>

                        <form action="{{ url('pages/exhibition-category-details') }}" method="GET" class="w-100">
                            
                            <input type="hidden" name="id" value="{{ $val->id }}">
                            <button type="submit" class="p-0 bg-white border-0 readmore text-nowrap exhibition_btn">
                              READ MORE
                            <!-- <i class="fa-solid fa-arrow-up-right-from-square right_up_arrow"></i> -->
                            </button>
                        </form>

                        <!-- <a href="#" class="p-2 w-100 text-end colorVoilet readmore text-nowrap">
                          READ MORE
                          <i class="fa-solid fa-arrow-up-right-from-square right_up_arrow"></i> -->
                        </a>
                      </div>
                    </div>
                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ******************* Card slider section  https://www.codeply.com/go/EIOtI7nkP8/bootstrap-carousel-with-multiple-cards ******************* -->
      <div class="my-4 position-relative bg_gray">
        <div class="container mx-auto ps-lg-0 slide-content">
          <div class="mb-1 border-4 border-start border-warning d-flex justify-content-between">
            <h3 class="ms-2 text-dark fw-bold text-capitalize">
                @if($langid1 == 1) COLLECTIONS @else संग्रह @endif
                <span class="colorVoilet fb-large"> > </span>
                @if($langid1 == 1) CATEGORY @else श्रेणी @endif
            </h3>
            <div class="mt-2">
              <a href="{{ url('pages/photo-collection') }}" class="py-2 bg-white viewall borderVoilet text-nowrap" style="color:#000 !important">
                View All
                <i class="px-4 fa-solid fa-arrow-right arrow_icon"></i>
              </a>
            </div>
          </div>
          <div class="card-wrapper swiper-wrapper">

            @foreach($photogallery as $val)
              @php
                $images = explode(',', $val->txtuplode);
                $firstImage = $images[0] ?? null;
              @endphp

              <div class="my-auto card swiper-slide">
                <img class="myCrop-img" src="{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/')}}/{{$firstImage}}" class="card-img-top" alt="...">
                <div class="my-card-body">
                  <h6 class="px-3 py-1 card-title">{{ $val->title }}</h6>
                  <p class="px-3 card-text">{{ $val->description }}</p>
                  <div class="d-flex justify-content-between bg-readmore w-100">
                  <form action="{{ url('pages/collection-details') }}" method="POST" class="w-100">
                    @csrf
                    <input type="hidden" name="id" value="{{ $val->id }}">
                    <button type="submit" class="p-2 border w-100 text-end colorVoilet fw-bolder readmore text-nowrap">
                      READ MORE
                      <i class="fa-solid fa-arrow-up-right-from-square right_up_arrow"></i>
                    </button>
                  </form>
                    <!-- <a href="{{ url('pages/collection-details', $val->id) }}" class="p-2 border w-100 text-end colorVoilet fw-bolder readmore text-nowrap">READ MORE
                      <i class="fa-solid fa-arrow-up-right-from-square right_up_arrow" ></i>
                    </a> -->
                  </div>
                </div>
              </div>
            @endforeach

          </div> 
        </div>

        <div class="swiper-button-next swiper-navBtn left-right-btn"> </div>
        <div class="swiper-button-prev swiper-navBtn left-right-btn"> </div>
      </div>

      <!-- ********************** card slider Javascript ********************** -->
      <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
      <script>
      var swiper = new Swiper(".slide-content",
          {
              slidesPerView: 4,
              spaceBetween: 13,
              loop: 'true',
              centerSlide: 'true',
              fade: 'true',
              grabCursor: 'true',
              pagination: {
                  el: ".swiper-pagination",
                  clickable: true,


              },
              autoplay: {
                  delay: 1500,
                },
              navigation: {
                  
                  nextEl: ".swiper-button-next",
                  prevEl: ".swiper-button-prev",
              },

              breakpoints: {
                  0: {
                      slidesPerView: 1,
                  },
                  630: {
                      slidesPerView: 2,
                  },
                  950: {
                      slidesPerView: 3,
                  },
                  1050: {
                      slidesPerView: 4,
                  }

              },
          });

      </script>

      <!-- ******************* google map section ******************* -->
      <div class="container px-lg-0">
        <div
          class="mb-1 border-4 border-start border-warning d-flex justify-content-between">
          <h3 class="ms-2 text-dark fw-bold text-capitalize">Locate Us</h3>
        </div>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29330.07888799474!2d77.35607110681272!3d23.23362903820703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397c5d52c51e9e93%3A0x31433bafdd6a7cbd!2sIndira%20Gandhi%20Rashtriya%20Manav%20Sangrahalaya!5e0!3m2!1sen!2sin!4v1717224035398!5m2!1sen!2sin"
          width="100%" height="300" style="border:0;" allowfullscreen
          loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <!-- --------------------------logo slider start -------------------------- -->

      <div class="py-3 bg-white brand-logo position-relative z-4">
        <div class="container logos">
          <div class="logo-slider" data-v-4ef8651c="">
              <div class="logos-slide" data-v-4ef8651c="">

                  @foreach($logos as $val)
                    <a href="{{ URL::to($val->logo_url) }}" target="_blank"><img src="{{ ('public/upload/admin/cmsfiles/logo/thumbnail/') }}{{$val->txtuplode}}" alt="Logo 1"></a>
                  @endforeach
                      
              </div>
          </div>
        </div>
      </div>
      <script>
    var copy = document.querySelector(".logos-slide").cloneNode(true);
    document.querySelector(".logo-slider").appendChild(copy);
</script>
<script>
  // Function to set position absolute to an element by its ID
function setAbsolutePosition(elementId, top = 0, left = 0) {
    const element = document.getElementById(elementId);
    if (element) {
        element.style.position = 'absolute';
    } else {
        console.error(`Element with ID "${elementId}" not found.`);
    }
}

// Example usage:
setAbsolutePosition('myElement', 100, 50);

</script>



<!-- *****************news modal popup start ***************** -->
<style>
    .modal-image-wrapper {
        position: relative;
        display: inline-block;
        border: 8px solid #ffffff; /* ✅ thick white border */
        border-radius: 10px;
        overflow: hidden;
        max-width: 100%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }

    .modal-image {
        max-width: 100%;
        height: auto;
        display: block;
        border-radius: 2px;
    }

    .modal.fade .modal-dialog {
        transform: scale(0.95);
        transition: transform 0.3s ease-in-out;
    }

    .modal.show .modal-dialog {
        transform: scale(1);
        z-index: 10;
    }

    .modal-backdrop.fade.show {
        z-index: -1;
    }

    .close-btn-top {
        position: absolute;
        top: 6px;
        right: 6px;
        background-color: #ffffff;
        border-radius: 50%;
        padding: 4px;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 20;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .btn-close-sm {
        width: 0.7rem;
        height: 0.7rem;
        filter: invert(1); /* to make it dark since bg is light */
    }

    .modal-content {
        background-color: transparent;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }
</style>

<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Close Button inside white border -->
            <div class="modal-image-wrapper">
                <button type="button"
                        class="btn-close btn-close-sm close-btn-top"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>

                <img src="{{ URL::asset('public/upload/admin/cmsfiles/events/thumbnail/') }}/{{ $eventNews->txtuplode }}"
                     class="modal-image"
                     alt="Modal Image">
            </div>

        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function () {
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    });
</script>

<!-- *****************news modal popup end ***************** -->

@endsection

