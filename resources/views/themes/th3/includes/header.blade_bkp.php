
<?php
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        $pageurl = $_SERVER['REQUEST_URI'];

        $ip 			= clean_single_input($ip);
        $pageurl 	= clean_single_input($pageurl);


        update_visitor_count($ip, $pageurl);
        $langid1 = session()->get('locale')??1;
        ?>

<header class="header_top">
        <div class="row top_head_res w-100 d-flex justify-content-between container-fluid ">
            <ul class="social-icons col-12 col-md-6">
                <div class="d-flex align-items-center">
                <li><a href="#"><img src="{{ URL::asset('/public/themes/th3/assets/img/facebook.png')}}" alt="Facebook"  title="Facebook"  ></a></li>
                <li><a href="#"><img src="{{ URL::asset('/public/themes/th3/assets/img/twitter.png')}}" alt="Twitter"  title="Twitter"  ></a></li>
                <li><a href="#"><img src="{{ URL::asset('/public/themes/th3/assets/img/instagram.png')}}" alt="Instagram"  title="Instagram"  ></a></li>
                <li><a href="#"><img src="{{ URL::asset('/public/themes/th3/assets/img/ios.png')}}" alt="IOS"  title="IOS"  ></a></li>
                <li><a href="#"><img src="{{ URL::asset('/public/themes/th3/assets/img/android.png')}}" alt="android"  title="android"  ></a></li>
                <form  action="{{URL::to('search')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf

                    <div class="search me-2">
                        <input placeholder="Search..." type="text" name="search">
                        <button type="submit">Go</button>
                    </div>
                <!-- <input type="text" class="search-input" placeholder="Search..." name="search">
                <input name="cmdsubmit" type="submit" class="btn-success btn-xs" id="cmdsubmit" value="Search" />  -->
    </form>
                </div>
                <a class="skipcont align-items-center d-flex" href="#skipcont" title="{{get_title('skip',$langid1)->title}}">{{get_title('skip',$langid1)->title}}</a>
            </ul>
            <div class="top_header_btns gap-3 d-flex col-12 col-md-6">
                <select onchange="return change_language(this);" class="changeLang">
                        <?php
                    
                    $statusArray = get_language();
                    
                    foreach($statusArray as $key=>$value) {
                        ?>
                        <option value="<?php echo $key; ?>"  {{ session()->get('locale') == $key ? 'selected' : '' }}><?php echo $value; ?></option>
                    <?php  }?>
                </select> 
                <div class="align-items-center gap-2 d-flex">
                        <a href="javascript:void(0)" onclick="setActiveStyleSheet('blue'); return false;"><img class="border border-white border-2" src="{{ URL::asset('/public/themes/th3/assets/images/blue.png')}}" alt="Blue Theme" title="Blue Theme"></a>
                        <a href="javascript:void(0)" onclick="setActiveStyleSheet('outrageous_orange'); return false;"><img class="border border-white border-2" src="{{ URL::asset('/public/themes/th3/assets/images/outrageous_orange.png')}}" class="img_width" alt="Outrageous Red" title="Outrageous Red"></a>
                </div>
                <a class="align-items-center d-flex head_screen" href="{{ url('/screenreader') }}">{{get_title('screen-reader-access',$langid1)->title}} </a>
                <div class="theme-popup">
                    <input type="radio" name="theme" id="default" >
                    <input type="radio" name="theme" id="light">
                    <input type="radio" name="theme" id="dark">
                    <input type="checkbox" id="checkbox">
                  <label for="checkbox" class="theme-popup__button">
                    A
                  </label>
                  <div class="theme-popup__list-container">
                    <ul class="theme-popup__list">
                      <li id="fontincrease" href="javascript:void(0)">
                        <label for="default">  
                          <p>A+</p>
                        </label>
                      </li>
                      <li id="fontreset" href="javascript:void(0)">
                        <label for="light">
                          <p >A</p>
                        </label>
                      </li>
                      <li id="fontdecrease" href="javascript:void(0)">
                        <label for="dark">
                          <p>A-</p>
                        </label>
                      </li>
                    </ul>
                  </div>
                </div>
                
            </div>
        </div>
</header>
      
<!-- ----------------------Logo header Start-------------------------- -->

<div class="container-fluid px-md-5 px-3 d-flex justify-content-between header_logo">
        <div >
        <a href="{{ url('/')}}"><img src="{{ URL::asset('public/upload/admin/setting/')}}/{{!empty(get_setting($langid1)->logo)?get_setting($langid1)->logo:''}}" alt="{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}" class="w-75" title="{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}" /></a>
            
        </div>
        <div class="gov_logo gap-4 d-flex justify-content-end">
        <a  target="_blank" href="https://digitalindia.gov.in/"><img class="w-100" src="{{ URL::asset('/public/themes/th3/assets/img/Digital_India_logo.svg.png')}}"  alt="Digital India" title="Digital India" srcset="" srcset=""></a>
        <a  target="_blank" href="https://www.g20.org/en/"><img class="w-100" src="{{ URL::asset('/public/themes/th3/assets/img/g20-logo.png')}}" alt="G-20" title="G-20" srcset=""></a>
        <a  target="_blank" href="https://state.bihar.gov.in/main/CitizenHome.html"><img class="w-100" src="{{ URL::asset('/public/themes/th3/assets/img/BiharLogo.png')}}" alt="Bihar" title="Bihar" srcset=""></a>
        </div>
    </div>


<!-- ----------------------Navbar Start-------------------------- -->

    <div>
        <nav id="skipcont">
            <div class="navbar">
                <i class='bx bx-menu'></i>
                <div class="logo"><a  title="{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}" href="{{ url('/') }}">{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}</a></div>
                <div class="nav-links">
                    <div class="sidebar-logo">
                        <span class="logo-name"><a title="{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}" href="{{ url('/') }}">{{ !empty(get_setting($langid1)->website_name)?get_setting($langid1)->website_name:'Website Name' }}</a></span>
                        <i class='bx bx-x'></i>
                    </div>
                    <ul class="links">
                    <?php
                        $pos=[1,4];
                        $langid=session()->get('locale')??1;
                        $res= get_menu($langid,$pos,0) ; $i=1; 
                     
                         $pageurl = clean_single_input(request()->segment(2));
                          $nameurl=get_parent_menu_name($pageurl,$langid);
                          $nameurl1=!empty($nameurl->m_url)?$nameurl->m_url:''
                        ?>
                         
                          @foreach($res as $mod)
                        <li class="<?php if($mod->m_url== $pageurl || $mod->m_url==$nameurl1 ) echo "current" ?>" >
                            @if($mod->m_type==2)
                                <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                            @elseif($mod->m_type==3)
                            <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                        
                            @else
                            <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" >{{$mod->m_name}}</a>
                           
                            @endif
                            <?php  
                             if(has_child($mod->id, $mod->language_id) > 0){ ?>
                            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
                            <?php  $ress= get_menu($mod->language_id,$pos,$mod->id) ; $k=1;  $count=count($ress);  ?>
                            <ul class="htmlCss-sub-menu sub-menu <?php if($count==19 || $count==18 || $count==17 || $count==16|| $count==15|| $count==14|| $count==12 || $count==11 || $count==10){ echo 'double_column ';} else{ } ?>">
                           
                            
                                @foreach($ress as $mods)
                                <?php  if(has_child($mods->id, $mods->language_id) > 0){ ?>
                                    <li class="more <?php if($mods->m_url== $pageurl ) echo "current" ?>">
                                    <span>
                                        @if($mods->m_type==2)
                                            <a href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}" > {{$mods->m_name}}</a>
                                        @elseif($mods->m_type==3)
                                            <a target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}" >{{$mods->m_name}}</a>
                                        
                                        @else
                                        <a href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}" > {{$mods->m_name}}</a>
                                    
                                        @endif  
                                            <i class='bx bxs-chevron-right arrow more-arrow'></i>
                                        </span>
                                        <ul class="more-sub-menu sub-menu">
                                        <?php  $resss= get_menu($mods->language_id,$pos,$mods->id) ;  ?>
                                            @foreach($resss as $modss)
                                                <li <?php if($modss->m_url== $pageurl ) echo "current" ?> > 
                                                    @if($mods->m_type==2)
                                                        <a href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$modss->doc_uplode}}" title="{{$modss->m_name}}" > {{$modss->m_name}}</a>
                                                    @elseif($mods->m_type==3)
                                                        <a target="_blank" href="{{$modss->linkstatus}}" title="{{$modss->m_name}}" >{{$modss->m_name}}</a>
                                                    
                                                    @else
                                                    <a href="@if($modss->m_url=='#') '' @else {{ url('/pages') }}/{{$modss->m_url}} @endif" title="{{$modss->m_name}}" > {{$modss->m_name}}</a>
                                                
                                                    @endif  
                                             </li>
                                            @endforeach  
                                        </ul>
                                        <?php } else { ?>
                                    <li class="<?php if($mods->m_url== $pageurl) echo "current" ?>">
                                    
                                        @if($mods->m_type==2)
                                            <a href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}" > {{$mods->m_name}}</a>
                                        @elseif($mods->m_type==3)
                                            <a target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}" >{{$mods->m_name}}</a>
                                        
                                        @else
                                        <a href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}" > {{$mods->m_name}}</a>
                                    
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
                <div class="search-box">
                    <form  action="{{URL::to('search')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf
                    <i class='bx bx-search'></i>
                    <div class="input-box">
                    <div class="input-group p-2" style="flex-direction: row-reverse;">
                        <input placeholder="Search..." type="text" name="search">
                        <button class="btn btn-primary" type="submit">search</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </div>

   <script>

const checkbox = document.getElementById('checkbox');
  const dropdownContainer = document.querySelector('.theme-popup__list-container');

  // Add a click event listener to the checkbox
  checkbox.addEventListener('click', function (event) {
    event.stopPropagation(); // Prevent the click event from propagating to the document
    dropdownContainer.style.display = dropdownContainer.style.display === 'block' ? 'none' : 'block';
  });

  // Add a click event listener to the document to close the dropdown
  document.addEventListener('click', function (event) {
    if (dropdownContainer.style.display === 'block' && event.target !== checkbox) {
      dropdownContainer.style.display = 'none';
    }
  });
   </script>