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
           

			<h2 class="public_heading">Technical Information</h2>      
                            <ul class="public_link_heading">
                               <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/somepdf/EOI_Digital_Truncking_Radio_System_compressed.pdf" > Invitation of EOI for acquiring Open Standard Digital Truncking Radio System for Chandigarh Police </a>
							   </li>
							   <div class="border_btm"></div>
							   <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/Office_Order/PS_LTE_Advisory.pdf" > Technical Advisory regarding Mission Critical Requirements of PS-LTE Networks </a>
							   </li>
							   <div class="border_btm"></div>
							   <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/somepdf/Specification%20%20of%20Half%20Loop%20Magnetic%20Antenna%20System.pdf" > Request for Comments of Vendors on Specification/QR of NVIS based Half Loop Magnetic Antenna System </a>
							   </li>
							   <div class="border_btm"></div>
							   <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/somepdf/Request%20for%20Comments%20of%20Vendors%20on%20Specification-QR%20of%20Radio%20Monitoring%20System%20HF-VHF-UHF.pdf" > Request for Comments of Vendors on Specification/QR of Radio Monitoring System HF/VHF/UHF </a>
							   </li>
							   <div class="border_btm"></div>
							   <li class="has-sub b my-2"> 
							   <span class="bullet_point">•</span>
									<a href="https://dcpw.gov.in/somepdf/Tech_specification.pdf" > Technical Specifications & Trial Directives of Digital Radios </a>
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
