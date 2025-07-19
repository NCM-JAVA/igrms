@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")
     
@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
             
<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->
<div class="container">
  <div class="row inner_page">
    <div class="sidebar flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
      @include("../themes.th3.includes.sidebar")
      
    </div>
  
    <div class="accordion" id="accordionExample">
 <h3>FAQs</h3></br>
  <div class="accordion" id="accordionExample">

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading1">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
        1. What are the timings of the museum?
      </button>
    </h2>
    <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        The museum is open:<br>
        <strong>March to August:</strong> 10:30 A.M to 6:30 P.M<br>
        <strong>September to February:</strong> 10:00 A.M to 5:30 P.M
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading2">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
        2. What is the entry fee for the museum?
      </button>
    </h2>
    <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Entry is free for children up to 12 years.<br>
        Rs. 50/- per visitor.<br>
        50% concession for schools, students, and groups.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading3">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
        3. On which days does IGRMS remain closed?
      </button>
    </h2>
    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        IGRMS is closed on all Mondays and the following holidays:<br>
        Republic Day (January 26th), Independence Day (August 15th), Gandhi Jayanti (October 2nd), Holi, Rang Panchami, and Diwali.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading4">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
        4. Is it necessary to carry ID proof?
      </button>
    </h2>
    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, ID proof is required to avail concessions on entry fees.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading5">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
        5. Do I need to book tickets in advance?
      </button>
    </h2>
    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        No, advance booking is not necessary.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading6">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
        6. Can I book tickets online?
      </button>
    </h2>
    <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Currently, there is no facility to book tickets online. However, online payment can be made at the ticket window.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading7">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
        7. What places can I visit within the IGRMS premises?
      </button>
    </h2>
    <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        You can visit 10 open-air exhibitions and the indoor museum building <strong>Veethi Sankul</strong> with 12 permanent galleries.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading8">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
        8. Are guided tours available?
      </button>
    </h2>
    <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, guided tours are available on demand.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading9">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
        9. Is internal transportation available?
      </button>
    </h2>
    <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, Go Carts are available from Gate No. 01 and 02.<br>
        Charges: Rs. 50/- per person or Rs. 500/- for full vehicle.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading10">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
        10. Can I take photographs and videos inside the museum?
      </button>
    </h2>
    <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, mobile photography and videography is free.<br>
        For professional/commercial shoots (tripods, gadgets), charges apply: Rs. 2000/-
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading11">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
        11. What are the library timings? Do I need special permission?
      </button>
    </h2>
    <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>Library Timings:</strong> 10:00 A.M to 6:00 P.M (Monday to Saturday).<br>
        No special permission required for general visits.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading12">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
        12. Are internship facilities available for students and research scholars?
      </button>
    </h2>
    <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, unpaid internship programs are available for students and research scholars from disciplines related to Indian culture and museum studies.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading13">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
        13. Is there any shop in the museum?
      </button>
    </h2>
    <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, there are two museum shops:<br>
        One at Veethi Sankul (Indoor Museum) and another near the Coastal Village by Gate No. 02.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading14">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
        14. Is parking available inside the museum premises?
      </button>
    </h2>
    <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, free parking is available for visitors.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading15">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
        15. Is there a facility for museum membership?
      </button>
    </h2>
    <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, individuals, families, and institutions can become members under the "Friends of IGRMS" category.<br>
        <strong>Annual subscription:</strong> Rs. 2000/-
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading16">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
        16. Are cafeteria facilities available? Can groups pre-book food?
      </button>
    </h2>
    <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading16" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Yes, IGRMS has cafeteria facilities.<br>
        Visiting groups can pre-book food items before their visit.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading17">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
        17. How far is the museum from the railway station, ISBT, and airport?
      </button>
    </h2>
    <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading17" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        - Railway Station: 6 km<br>
        - Inter State Bus Terminal (ISBT): 10 km<br>
        - Airport: 10 km
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="heading18">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
        18. What facilities are available for differently-abled visitors?
      </button>
    </h2>
    <div id="collapse18" class="accordion-collapse collapse" aria-labelledby="heading18" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        Facilities include ramps for wheelchair movement and Braille scripts in exhibition areas for the visually challenged.
      </div>
    </div>
  </div>
</div>
</div></br></br>
<style>
  .accordion-button {
    color: purple; /* heading text color */
    font-weight: 600;
  }

  .accordion-button:not(.collapsed) {
    background-color: #f3e8ff; /* light purple background when open */
    color: purple;
    box-shadow: none;
  }

  .accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
  }
</style>

@endsection
