@php
$pageurl = clean_single_input(request()->segment(2));
$langid1=session()->get('locale')??1;
$nameurl=get_parent_menu_name($pageurl,$langid1);
// dd($nameurl->m_url);
@endphp


<section>
    <div class="px-4 mt-1 pt-1">
        <div class="container">
        <div aria-label="breadcrumb container">
            <ol class="breadcrumb mb-10 d-flex justify-content-between w-100">
                <div class="d-flex">
                    <li class="breadcrumb-item"><a href="{{ url('/')}}" title="{{get_title('home',$langid1)->title}}">
                            {{get_title('home',$langid1)->title}} </a></li>
                    @if(!empty($nameurl))
                    <li class="breadcrumb-item">
                        <a title="{{!empty($nameurl->m_name)?$nameurl->m_name:''}}"
                            href="{{ url('/pages') }}/{{!empty($nameurl->m_url)?$nameurl->m_url:''}}">
                            {{!empty($nameurl->m_name)?$nameurl->m_name:''}} </a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active">{{$title}}</li>
                </div>
                <li class="before_disable">
                    <a href="#" class="bg-megenta btn btn-xs"
                        onclick="goBack()">{{get_title('back',$langid1)->title ?? ''}}</a>
                    |
                    <button class="btn bg-megenta text-white btn-xs"
                        onclick="window.print()">{{get_title('print',$langid1)->title ?? ''}}</button>
                    <!-- |                               
                    <a href="javscript:void(0)" class="btn btn-primary btn-xs" onclick="generatePDF('history')">{{get_title('pdf',$langid1)->title ?? ''}}</a> -->
                </li>
            </ol>
        </div>
        </div>
    </div>
    <script>
    function goBack() {
        // console.log(window.history.go(-1));
        window.history.go(-1);
    }
    </script>
</section>