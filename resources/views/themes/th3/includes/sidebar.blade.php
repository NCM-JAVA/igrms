@php
    $pageurl = clean_single_input(request()->segment(2));
    $langid1 = session()->get('locale')??1;
	$id = session()->get('locale')??1;
    $pos=[1,4,2];
    $langid=session()->get('locale')??1;
    $id1=!empty($m_flag_id)?$m_flag_id:$id;
    $res= get_menu($langid,$pos,$id1) ; $i=1;  
@endphp   

<nav class="sidebar navbar navbar-expand-lg text-black shadow bg-megenta py-0 rounded-3">
    <div class="container">
        <div class>
            <button class="navbar-toggler collapsed float-end float-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-content">
                <div class="hamburger-toggle">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-between" id="sidebar-content">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0 w-100 justify-content-between flex-column">
                @foreach($res as $mod)
                    <li class="nav-item dropdown <?php if($mod->m_url== $pageurl) echo "current" ?> ">
                        @if($mod->m_type==2)
                            <a target="_blank" class="nav-link" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}"> {{$mod->m_name}} </a>
                        @elseif($mod->m_type==3)
                            <a class="nav-link" target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}">  {{$mod->m_name}} </a>
                        @else
                            <a  class="nav-link @if(has_child($mod->id, $mod->language_id) > 0) {{'dropdown-toggle'}} @else {{''}} @endif " data-bs-toggle="{{ has_child($mod->id, $mod->language_id) > 0 ? 'dropdown' : ''}}" data-bs-auto-close="{{ has_child($mod->id, $mod->language_id) > 0 ? 'outside' : ''}}" href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}">  {{$mod->m_name}} </a>
                        @endif

                        <?php  $ress= get_menu($mod->language_id,$pos,$mod->id) ;  ?>
                        <?php  if(has_child($mod->id, $mod->language_id) > 0){ ?>
                            <div class="collapse show" id="dashboard-collapse">
                                <ul class="dropdown-menu shadow">
                                    @foreach($ress as $mods)
                                        <li class="<?php if($mods->m_url== $pageurl) echo "current" ?> has-sub b">
                                            @if($mods->m_type==2)
                                                <a class="dropdown-item" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mods->doc_uplode}}" title="{{$mods->m_name}}" > <span style="color:#000">{{$mods->m_name}} </span></a>
                                            @elseif($mods->m_type==3)
                                                <a class="dropdown-item" target="_blank" href="{{$mods->linkstatus}}" title="{{$mods->m_name}}" > <span style="color:#000">{{$mods->m_name}} </span></a>
                                            @else
                                                <a class="dropdown-item" href="@if($mods->m_url=='#') '' @else {{ url('/pages') }}/{{$mods->m_url}} @endif" title="{{$mods->m_name}}" > <span>{{$mods->m_name}} </span></a>
                                            @endif  
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        <?php } ?>
                    </li>
                    <?php $i++ ; ?>
                @endforeach
            </ul>
        </div>
    </div>
</nav>