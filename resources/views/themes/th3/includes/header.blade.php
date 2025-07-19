<?php
//header("Content-Security-Policy:default-src 'self';script-src 'self' 'unsafe-inline' 'unsafe-eval' https://platform.twitter.com https://syndication.twitter.com https://twitter.com https://www.youtube.com https://www.gstatic.com; style-src 'self' 'unsafe-inline';img-src 'self' https://pbs.twimg.com https://www.youtube.com https://*.twimg.com https://*.googleusercontent.com; frame-src 'self' https://www.youtube.com https://platform.twitter.com https://syndication.twitter.com; connect-src 'self' https://api.twitter.com;");
//header("Content-Security-Policy: default-src 'self';");

?>
<body onload="applyStoredTheme()">

    <?php
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    $pageurl = $_SERVER['REQUEST_URI'];
    $ip 		 = clean_single_input($ip);
    $pageurl = clean_single_input($pageurl);

    update_visitor_count($ip, $pageurl);
    $langid1 = session()->get('locale')??1;
  ?>

 
    <header>
        <div class="bg-black">
            <div class="container">
                <div class="d-block d-md-flex py-1 px-0 justify-content-between accessibility_menu gap-4">
                    <div class="top_bars">
                        <div>
                            <p class="text-white mb-0">Welcome to IGRMS</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="my-auto">
                                <a href="#skip" title="Skip To Main Content">
                                    <i class="fa-solid fa-share text-white my-auto"></i>
                                </a>
                            </div>
                             <ul class="m-0 p-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside"><img
                                            src="{{ asset('/public/themes/th3/assets/images/theme.png') }}"></a>
                                    <ul class="dropdown-menu shadow color_dropdown">
                                        <li><a class="dropdown-item" href="#"
                                                onclick="themeSwitcher('default')">Default</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="themeSwitcher('blue')">Orange</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#" onclick="themeSwitcher('BW')">Black &
                                                white</a></li>
                                    </ul>
                                </li>
                            </ul> 
                            <div class="custom-dropdown">

                                <a class="nav-link" href="#">
                                <im g src="{{ asset('/public/themes/th3/assets/images/theme.png') }}" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" class="custom-btn theme_btn1" data-menu="menu1"
                                    onclick="toggleCustomDropdown(event)">
                                </a>
                                <div class="custom-menu" id="menu1">
                                    <a class="theme_color" href="#" onclick="themeSwitcher('default')">
                                        <img src="{{ asset('/public/themes/th3/assets/images/violet.png') }}">
                                    </a>
                                    <a class="theme_color" href="#" onclick="themeSwitcher('blue')">
                                        <img src="{{ asset('/public/themes/th3/assets/images/orange.png') }}">
                                    </a>
                                </div>
                            </div>

                            <div class="custom-dropdown text_adj_img">
                                <a class="nav-link text_adj_img" href="#">
                                    <img src="{{ asset('/public/themes/th3/assets/images/text-inde.png') }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" data-menu="menu2"
                                    onclick="toggleCustomDropdown(event)" class="custom-btn">
                                </a>
                                <div class="custom-menu" id="menu2">
                                    <a class="dropdown-item" href="#" onclick="increaseFontSize()">A+</a>
                                    <a class="dropdown-item" href="#" onclick="resetFontSize()">A</a>
                                    <a class="dropdown-item" href="#" onclick="decreaseFontSize()">A-</a>
                                    <a href="#" class="px-2 border-white border mx-2"
                                        onclick="themeSwitcher('default')">A</a>
                                    <a href="#" class="text-black bg-white px-2 border border-black mx-2"
                                        onclick="themeSwitcher('BW')">A</a>

                                </div>
                            </div>
                        </div>


                        <!-- <div class="custom-dropdown">
                            <button class="custom-btn" data-menu="menu2" onclick="toggleCustomDropdown(event)">Dropdown
                                2</button>
                            <div class="custom-menu" id="menu2">
                                <a href="#">Option A</a>
                                <a href="#">Option B</a>
                                <a href="#">Option C</a>
                            </div>
                        </div> -->

                    </div>
                    <div class="d-flex justify-content-between justify-content-md-end gap-2 top_bar_detail">
                        <div class="my-auto screen_record">
                            <a href="{{ route('screenreader') }}"
                                class="screen_read_txt">{{get_title('screen-reader-access',$langid1)->title ?? ''}}</a>
                        </div>
                        <!-- contrast buttons  -->
                        <!-- <div class="d-none d-md-flex">

                            <a href="#" class="px-2 border-white border mx-1" onclick="themeSwitcher('BW')">A</a>
                            <a href="#" class="text-black bg-white px-2 border border-black mx-1"
                                onclick="themeSwitcher('default')">A</a>
                        </div> -->

                        <!-- font size buttons  -->
                        <div class="d-flex align-items-center gap-2 search_area_top">
                            <!-- Buttons for medium and larger screens -->
                            <!-- <div class="d-none d-md-block">
                                <a class="border px-1" href="#" onclick="increaseFontSize()">A+</a>
                            </div>
                            <div class="d-none d-md-block">
                                <a class="border px-1" href="#" onclick="resetFontSize()">A</a>
                            </div>
                            <div class="d-none d-md-block">
                                <a class="border px-1" href="#" onclick="decreaseFontSize()">A-</a>
                            </div>-->

                            <!-- Dropdown for small screens -->
                            <!-- <div class="dropdown d-md-none">
                                <button class="btn btn-secondary text_s_btn" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    A
                                </button>
                                <ul class="dropdown-menu header font_size" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" onclick="increaseFontSize()">A+</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="resetFontSize()">A</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="decreaseFontSize()">A-</a></li>
                                    <li><a href="#" class="px-2 border-white border mx-2">A</a></li>
                                    <li><a href="#" class="text-black bg-white px-2 border border-black mx-2">A</a></li>
                                </ul>
                            </div> -->


                            <div class="search-container">
                                <form action="{{ url('/search') }}" method="get" id="cse-search-box" class="searchbox searchbox-open searchbox-open2"
                                    accept-charset="utf-8">
                                    <input type="hidden" name="cx" value="013280925726808751639:juvtcf6w1h4">
                                    <input type="hidden" name="cof" value="FORID:10">
                                    <input type="hidden" name="ie" value="UTF-8">
                                    <label for="searchq" style="display: none; margin:0;">Search</label>
                                    <div class="search-container">
                                        <input class="border topbar_search" type="text" name="q" id="searchq" placeholder="Search.." required="" value=""
                                        spellcheck="false" data-ms-editor="true">
                                        <button type="submit" value="submit" name="search" title="submit-bottom" aria-label="submit"
                                        class="searchButton"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                                <!-- <input class="border topbar_search" type="text" placeholder="Search..">
                                <button class="searchButton" style=""><i class="fa fa-search"></i></button> -->
                            </div>


                        </div>
                        <!-- language change buttons  -->
                        <div class="d-flex gap-2 my-auto language_sec">
                            <!-- <a href="#">Hindi</a>
              <div class="border-end border-white"></div>
              <a href="#">English</a> -->
                            <!-- @if(session()->get('locale') == '1')
                <a href="#" onclick="return change_language(2);" class="changeLang">Hindi</a>
              @elseif(session()->get('locale') == '2')
                <a href="#" onclick="return change_language(1);" class="changeLang">English</a>
              @endif -->

                            <div class="col-md-1">
                                <!-- <ul class="d-flex align-item-center h-100"> -->
                                <ul class="d-flex gap-2 my-auto ps-0">
                                    <li>
                                        <select onchange="return change_language(this);" class="changeLang">
                                            <?php
                          $statusArray = get_language();
                          foreach($statusArray as $key=>$value) {
                      ?>
                                            <option value="<?php echo $key; ?>"
                                                {{ session()->get('locale') == $key ? 'selected' : '' }}>
                                                <?php echo $value; ?></option>
                                            <?php  }?>
                                        </select>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!---nav------>
    <!-- <style>  
    .navbar-nav .nav-link {
        font-size: 1.0rem; /* You can increase to 1.2rem if needed */
        text-align: center;
        font-weight: normal; /* Optional: ensures it's not bold */
    }

    .navbar-nav {
        justify-content: center;
        width: 100%;
    }

    .navbar-collapse {
        justify-content: center;
    }

    /* Optional: Home menu spacing */
    .navbar-nav .nav-item:first-child {
        margin-left: 1.0remrem;
    }
</style> -->


    
    <section class="header_sticky" id="skip">
        <div class="position-relative">
        <!-- <nav class="navbar navbar-expand-lg shadow position-absolute top-0 end-0 start-0 z-2 bg-megenta_tr"> -->
    <nav class="navbar navbar-expand-lg shadow top-0 end-0 start-0 z-2 bg-megenta_tr" id="myElement">
            <div class="container flex-column">
                <div class="website_logo w-100">
                    <div class="logo_image d-flex justify-content-between">
                    <img class="img-fluid" src="{{ asset('public/themes/th3/assets/images/MOC.png')}}" alt
                    srcset>
                        <img class="img-fluid" src="{{ asset('public/themes/th3/assets/images/header Logo.png')}}" alt
                            srcset>
                      
                            <!-- <img class="img-fluid" src="{{ asset('public/themes/th3/assets/images/ IGRMS.png')}}" alt
                            srcset> -->
                    </div>
                </div>
                <div class="w-100">

                    <div>
                        <button class="navbar-toggler float-end float-md-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbar-content" aria-expanded="true">
                            <div class="hamburger-toggle active">
                                <i class="fa-solid fa-bars text-white"></i>
                            </div>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-content">
    
                        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                            <?php
                                $pos=[1,4];
                                $langid=session()->get('locale')??1;
                                $res= get_menu($langid,$pos,0) ; $i=1;
                                // dd($res); 
                                
                                $pageurl = clean_single_input(request()->segment(2));
                                $nameurl=get_parent_menu_name($pageurl,$langid);
                                $nameurl1=!empty($nameurl->m_url)?$nameurl->m_url:'';
                                
                                ?>
    
                            @foreach($res as $mod)
                            <li
                                class="nav-item dropdown <?php if($mod->m_url== $pageurl || $mod->m_url==$nameurl1 ) echo " current" ?>">
                                @if($mod->m_type==2)
                                <a class="nav-link"
                                    href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}"
                                    title="{{$mod->m_name}}"> {{$mod->m_name}}</a>
                                @elseif($mod->m_type==3)
                                <a class="nav-link " href="{{$mod->linkstatus}}" title="{{$mod->m_name}}">
                                    {{$mod->m_name}}</a>
                                @else
                                <a class="nav-link @if(has_child($mod->id, $mod->language_id) > 0) {{'dropdown-toggle'}} @else {{''}} @endif "
                                    data-bs-toggle="{{ has_child($mod->id, $mod->language_id) > 0 ? 'dropdown' : ''}}"
                                    data-bs-auto-close="{{ has_child($mod->id, $mod->language_id) > 0 ? 'outside' : ''}}"
                                    href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif"
                                    title="{{$mod->m_name}}">{{$mod->m_name}}</a>
                                @endif
                                <?php  
                                    if(has_child($mod->id, $mod->language_id) > 0){ 
                                ?>
                                <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                                <?php  $ress= get_menu($mod->language_id,$pos,$mod->id) ; $k=1;  $count=count($ress); ?>
    
                                <ul
                                    class="dropdown-menu shadow <?php if($count==19 || $count==18 || $count==17 || $count==16|| $count==15|| $count==14|| $count==12 || $count==11 || $count==10){ echo 'double_column ';} else{ } ?>">
    
                                    @foreach($ress as $mods)
                                    <?php  if(has_child($mods->id, $mods->language_id) > 0){ ?>
                                    <li class="left_or_right <?php if($mods->m_url== $pageurl ) echo " current" ?>">
    
                                        @if($mods->m_type==2)
                                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown"
                                            href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}"
                                            title="{{$mods->m_name}}"> {{$mods->m_name}}</a>
                                        @elseif($mods->m_type==3)
                                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" target="_blank"
                                            href="{{$mods->linkstatus}}" title="{{$mods->m_name}}">{{$mods->m_name}}</a>
                                        @else
                                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown"
                                            href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif"
                                            title="{{$mods->m_name}}"> {{$mods->m_name}}</a>
                                        @endif
                                        <i class='bx bxs-chevron-right arrow more-arrow'></i>
    
                                        <ul class="dropdown-menu shadow">
                                            <?php  $resss= get_menu($mods->language_id,$pos,$mods->id) ;  ?>
                                            @foreach($resss as $modss)
                                            <li class="dropdown-item p-0" <?php if($modss->m_url== $pageurl ) echo "current" ?>>
                                                @if($mods->m_type==2)
                                                <a class="dropdown-item dropdown-toggle"
                                                    href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$modss->doc_uplode}}"
                                                    title="{{$modss->m_name}}"> {{$modss->m_name}}</a>
                                                @elseif($mods->m_type==3)
                                                <a class="dropdown-item dropdown-toggle" target="_blank"
                                                    href="{{$modss->linkstatus}}"
                                                    title="{{$modss->m_name}}">{{$modss->m_name}}</a>
                                                @else
                                                <a class="dropdown-item"
                                                    href="@if($modss->m_url=='#') '' @else {{ url('/pages') }}/{{$modss->m_url}} @endif"
                                                    title="{{$modss->m_name}}"> {{$modss->m_name}}</a>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        <?php } else { ?>
                                    <li class="dropdown-item p-0 <?php if($mods->m_url== $pageurl) echo " current" ?>">
    
                                        @if($mods->m_type==2)
                                        <a class="dropdown-item dropdown-toggle"
                                            href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}"
                                            title="{{$mods->m_name}}"> {{$mods->m_name}}</a>
                                        @elseif($mods->m_type==3)
                                        <a class="dropdown-item dropdown-toggle" target="_blank"
                                            href="{{$mods->linkstatus}}" title="{{$mods->m_name}}">{{$mods->m_name}}</a>
                                        @else
                                        <a class="dropdown-item "
                                            href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif"
                                            title="{{$mods->m_name}}"> {{$mods->m_name}}</a>
                                        @endif
                                        <?php } ?>
                                    </li>
                                    <?php $k++ ; ?>
                                    @endforeach
                                </ul>
                                <?php } ?>
                            </li>
                            <?php $i++ ; ?>
                            @endforeach
                        </ul>
    
    
                    </div>
                </div>
            </div>
        </nav>
        </div>
        </section> 
   



    <script>

  // Add class to last 5 li tags
document.querySelectorAll('.navbar-nav .nav-item:nth-last-child(-n+5)>.dropdown-menu .left_or_right').forEach(element => {
    element.classList.add('dropstart');
});

// Add class to all other li tags (except last 5)
document.querySelectorAll('.navbar-nav li:not(:nth-last-child(-n+5))>.dropdown-menu .left_or_right').forEach(element => {
    element.classList.add('dropend');
})[1][2]

</script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const captchaFooterLink = document.querySelector('a[href*="captcha.org/captcha.html?laravel"]');
        if (captchaFooterLink) {
            captchaFooterLink.style.display = 'none';
        }
    });
    </script>


