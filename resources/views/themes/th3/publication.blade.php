@extends('layouts.themes') @section('content') @include("../themes.th3.includes.breadcrumb")
<!--************************breadcrumb********************-->
@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
<!--**********************************mid part******************-->
<section>
    <div class="container">
        <div class="row">
            @php $pageurl = clean_single_input(request()->segment(2)); $pos=[1,4,2,3]; $langid=session()->get('locale')??1; @endphp
           

                              <h2 class="public_heading">Publication</h2>       
                            <ul class="public_link_heading">
                               <li class="has-sub b my-2"> 
								<span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/training/schedule/Syllabus%20committee%20Report%202019.pdf" > 	Syllabus Committee Report-2019  </a>
							   </li>
							   <div class="border_btm"></div>
							   <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/somepdf/SpecificationQR.pdf" > Specification/Qrs of 18 Nos. of Test/Measuring Equipment's </a>
							   </li>
							   <div class="border_btm"></div>
							   <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/somepdf/syllabus%20committee%20report.pdf" > Syllabous Committee Report </a>
							   </li>
							   <div class="border_btm"></div>
							   <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/somepdf/TECH%20EVALUATION%20half%20loop%20antenna.pdf" > 	TECHNOLOGY EVALUATION OF STATIC & MOBILE HALF LOOP ANTENNA FOR HF COMMUNICATION IN SKIP ZONE </a>
							   </li>
							   <div class="border_btm"></div>
							   <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/somepdf/TECHNICAL%20SPECIFICATION%20OF%20HF%20TRANSCEIVER.pdf" > TECHNICAL SPECIFICATION OF HF TRANSCEIVER </a>
							   </li>
							   <div class="border_btm"></div>
                            </ul>
                           

            
                @php $pageurl = $title; @endphp
             <div class="last_update_para">
                <span class="page-updated-date px-3 text-end">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($pageurl) }} </span>
				</div>
            </div>
        </div>
    </div>
</section>

@endsection
