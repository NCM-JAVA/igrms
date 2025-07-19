@extends('layouts.themes') 
@section('content') 
    @include("../themes.th3.includes.breadcrumb")

    @php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
    @endphp 
<style>

</style>
    <section>
        <div class="container">
            <div class="row">
                @php $pageurl = clean_single_input(request()->segment(2)); $pos=[1,4,2,3]; $langid=session()->get('locale')??1; @endphp   
                <ul>
                    @foreach($results as $res) 
                        <li class="<?php if($res->m_url== $pageurl) echo "active" ?> has-sub b my-2"> 
                        @if($res->m_type==2)
                            <a class="text-primary" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$res->doc_uplode}}" title="{{$res->m_name}}"> <span><b>{{$res->m_name}} :</b> Indira Gandhi Rashtriya Manav Sangrahalaya </span></a>
                        @elseif($res->m_type==3)
                            <a class="text-primary" target="_blank" href="{{$res->linkstatus}}" title="{{$res->m_name}}"> <span><b>{{$res->m_name}} : </b>Indira Gandhi Rashtriya Manav Sangrahalaya </span></a>
                        @else
                            <a class="text-primary" href="@if($res->m_url=='#') '' @else {{ url('/pages') }}/{{$res->m_url}} @endif" title="{{$res->m_name}}"> <span><b>{{$res->m_name}} : </b> Indira Gandhi Rashtriya Manav Sangrahalaya </span></a><br>
                            <div class="text-success google_font">
                                <span>125.20.102.85/igrms ></span>
                                <span>{{$res->m_url}}</span>
                            </div>

                            <?php 
                                $content= strip_tags($res->content);
                                $limittext = Str::limit($content, 120, '...');
                            ?>
                            <p class="google_font">{{$limittext}}</p>
                        @endif
                    @endforeach
                </ul>

                @php $pageurl = $title; @endphp
                <!-- <span class="page-updated-date px-3 text-end">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($pageurl) }} </span> -->
            </div>
        </div>
    </section>

@endsection
